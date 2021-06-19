<?php
class BraidVite {
	protected $is_dev;
	protected $dev_host;
	protected $theme_base = '';

	public function __construct( $is_dev = false, $dev_host = 'http://localhost:3000' ) {
		$this->is_dev   = $is_dev;
		$this->dev_host = rtrim( $dev_host, '/' );
		if ( function_exists( 'get_template_directory_uri' ) && ! $is_dev ) {
			$this->theme_base = get_template_directory_uri();
		}
	}

	public function vite( $entry ) {
		return $this->vite_js( $entry ) . $this->vite_css( $entry );
	}

	public function vite_js( $entry ) {
		return $this->js_tag( $entry ) . $this->js_preload_imports( $entry );
	}

	public function vite_css( $entry ) {
		return $this->css_tag( $entry );
	}

	protected function js_tag( $entry ) {
		$url = $this->is_dev ? $this->dev_host . '/' . $entry : $this->asset_url( $entry );
		if ( ! $url ) {
			return '';
		}
		// @codingStandardsIgnoreStart
		return '<script type="module" crossorigin src="' . $this->theme_base . $url . '"></script>';
		// @codingStandardsIgnoreEnd
	}

	protected function js_preload_imports( $entry ) {
		if ( $this->is_dev ) {
			return '';
		}
		$res = '';
		foreach ( $this->import_urls( $entry ) as $url ) {
			$res .= '<link rel="modulepreload" href="' . $this->theme_base . $url . '">';
		}
		return $res;
	}

	protected function css_tag( string $entry ) {
		if ( $this->is_dev ) {
			return '';
		}
		$tags = '';
		foreach ( $this->css_urls( $entry ) as $url ) {
			// @codingStandardsIgnoreStart
			$tags .= '<link rel="stylesheet" href="' . $this->theme_base . $url . '">';
			// @codingStandardsIgnoreEnd
		}
		return $tags;
	}

	protected function get_manifest() {
		// @codingStandardsIgnoreStart
		$content = file_get_contents( __DIR__ . '/../dist/manifest.json' );
		// @codingStandardsIgnoreEnd
		return json_decode( $content, true );
	}

	protected function asset_url( $entry ) {
		$manifest = $this->get_manifest();
		return isset( $manifest[ $entry ] ) ? '/dist/' . $manifest[ $entry ]['file'] : '';
	}

	protected function import_urls( $entry ) {
		$urls     = array();
		$manifest = $this->get_manifest();

		if ( ! empty( $manifest[ $entry ]['imports'] ) ) {
			foreach ( $manifest[ $entry ]['imports'] as $imports ) {
				$urls[] = '/dist/' . $manifest[ $imports ]['file'];
			}
		}
		return $urls;
	}

	protected function css_urls( $entry ) {
		$urls     = array();
		$manifest = $this->get_manifest();

		if ( ! empty( $manifest[ $entry ]['css'] ) ) {
			foreach ( $manifest[ $entry ]['css'] as $file ) {
				$urls[] = '/dist/' . $file;
			}
		}
		return $urls;
	}
}
