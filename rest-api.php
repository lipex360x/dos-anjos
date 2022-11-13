<?php
/*
  Plugin Name: WP REST API
  Version: 1.0
  Author: lipex360
  Author URI: https://www.udemy.com/user/bradschiff/
*/

if( ! defined( 'ABSPATH' ) ) exit;

$plugin_dir = plugin_dir_path(__FILE__);

require_once($plugin_dir . 'src/modules/index.php');