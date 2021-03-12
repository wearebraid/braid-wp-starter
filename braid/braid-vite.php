<?php

class BraidVite {

  protected $isDev;
  protected $devHost;
  protected $theme_base = '';

  public function __construct($isDev = false, $devHost = 'http://localhost:3000')
  {
    $this->isDev = $isDev;
    $this->devHost = rtrim($devHost, '/');
    if (function_exists('get_template_directory_uri') && !$isDev) {
      $this->theme_base = get_template_directory_uri();
    }
  }

  public function vite($entry)
  {
    return $this->jsTag($entry) .
      $this->jsPreloadImports($entry) .
      $this->cssTag($entry);
  }

  protected function jsTag($entry)
  {
    $url = $this->isDev ? $this->devHost . '/' . $entry : $this->assetUrl($entry);
    if (!$url) {
      return '';
    }
    return '<script type="module" crossorigin src="' . $this->theme_base . $url . '"></script>';
  }

  protected function jsPreloadImports($entry)
  {
    if ($this->isDev) { return ''; }
    $res = '';
    foreach ($this->importsUrls($entry) as $url) {
      $res .= '<link rel="modulepreload" href="' . $this->theme_base . $url . '">';
    }
    return $res;
  }

  protected function cssTag(string $entry)
  {
    if ($this->isDev) { return ''; }
    $tags = '';
    foreach ($this->cssUrls($entry) as $url) {
      $tags .= '<link rel="stylesheet" href="' . $this->theme_base . $url . '">';
    }
    return $tags;
  }

  protected function getManifest()
  {
    $content = file_get_contents(__DIR__ . '/../dist/manifest.json');
    return json_decode($content, true);
  }

  protected function assetUrl($entry)
  {
    $manifest = $this->getManifest();
    return isset($manifest[$entry]) ? '/dist/' . $manifest[$entry]['file'] : '';
  }

  protected function importsUrls($entry)
  {
    $urls = [];
    $manifest = $this->getManifest();

    if (!empty($manifest[$entry]['imports'])) {
      foreach ($manifest[$entry]['imports'] as $imports) {
        $urls[] = '/dist/' . $manifest[$imports]['file'];
      }
    }
    return $urls;
  }

  protected function cssUrls($entry)
  {
    $urls = [];
    $manifest = $this->getManifest();

    if (!empty($manifest[$entry]['css'])) {
      foreach ($manifest[$entry]['css'] as $file) {
        $urls[] = '/dist/' . $file;
      }
    }
    return $urls;
  }

}