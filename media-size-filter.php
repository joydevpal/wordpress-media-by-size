<?php
/**
 * Plugin Name: Media Size Filter
 * Plugin URI: http://joydevpal.com/plugins/media-size-filter
 * Description: Filter WordPress media images by size.
 * Author: Joydev Pal
 * Author URI: http://joydevpal.com
 * Version: 1.0.0
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.en.html
 * Text Domain: msf
 */

/**
 * Filter the Media list table columns to add a File Size column.
 *
 * @param array $posts_columns Existing array of columns displayed in the Media list table.
 * @return array Amended array of columns to be displayed in the Media list table.
 */
add_filter( 'manage_media_columns', 'jp_media_columns_filesize' );

function jp_media_columns_filesize( $posts_columns ) {
	$posts_columns['filesize'] = __( 'File Size', 'msf' );

	return $posts_columns;
}

/**
 * Display File Size custom column in the Media list table.
 *
 * @param string $column_name Name of the custom column.
 * @param int    $post_id Current Attachment ID.
 */
add_action( 'manage_media_custom_column', 'jp_media_custom_column_filesize', 10, 2 );

function jp_media_custom_column_filesize( $column_name, $post_id ) {
	if ( 'filesize' !== $column_name ) {
		return;
	}

	$bytes = filesize( get_attached_file( $post_id ) );

	echo size_format( $bytes, 2 );
}

/**
 * Adjust File Size column on Media Library page in WP admin
 */
add_action( 'admin_print_styles-upload.php', 'jp_filesize_column_filesize' );

function jp_filesize_column_filesize() {
	echo
	'<style>
		.fixed .column-filesize {
			width: 10%;
		}
	</style>';
}