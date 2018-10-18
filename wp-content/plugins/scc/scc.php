<?php

/*
Plugin Name: Scc
Description: Scc
Version: 0.1
Author: Alquimia WRG (@AlquimiaWRG)
Author URI: http://www.alquimiawrg.com
Network: false
License: GPL2
*/

/*
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

defined( 'ABSPATH' ) or die( 'You may not access this script from outside Wordpress.' );

if ( ! function_exists( 'add_action' ) ) {
  echo 'I can do nothing for you when called directly.';
  exit;
}

define( 'SCC__VERSION', '0.1' );
define( 'SCC__MINIMUM_WP_VERSION', '4.1.1' );
define( 'SCC__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SCC__CLASSES_DIR', SCC__PLUGIN_DIR . 'classes/' );

require_once SCC__CLASSES_DIR . 'class-scc.php';
new Scc();
