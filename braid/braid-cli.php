<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Locally, to run with laradock, you may need to modify your wp-config with the following:
 * Replace:
 * define('DB_HOST', 'mysql');
 * 
 * With:
 * if (php_sapi_name() == 'cli') { define('DB_HOST', '127.0.0.1'); } else { define('DB_HOST', 'mysql'); }
 */

if (defined('WP_CLI') && WP_CLI) {
    class BraidThemeCLICommands extends WP_CLI_Command {
        public function welcome()
        {
            // RUN VIA `wp braid welcome`
            WP_CLI::line('Welcome, to Jurassic Park... na na na naaa na...');
            return false;
        }
    }
    
    WP_CLI::add_command('braid', 'BraidThemeCLICommands');
}
