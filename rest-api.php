<?php
/*
  Plugin Name: WP REST API
  Version: 1.0
  Author: lipex360
  Description: Wordpress API REST Plugin
  Author URI: https://github.com/lipex360x/wp-rest-api
*/

if(!defined('ABSPATH')) exit;

$plugin_dir = plugin_dir_path(__FILE__);

require_once($plugin_dir . 'src/core/index.php');
require_once($plugin_dir . 'src/modules/index.php');