<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com
 * @since      1.0.0
 *
 * @package    Upload_2_Search
 * @subpackage Upload_2_Search/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Upload_2_Search
 * @subpackage Upload_2_Search/includes
 * @author     Raj Sumith <email>
 */
class Upload_2_Search_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();

		$tablename = $wpdb->prefix . "students_data";

		$sql = "CREATE TABLE $tablename (
			id mediumint(11) NOT NULL AUTO_INCREMENT,
			studentID1 varchar(80),
			studentID2 varchar(80),
			classroom varchar(80),
			PRIMARY KEY (id)
		) $charset_collate;";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}

}
