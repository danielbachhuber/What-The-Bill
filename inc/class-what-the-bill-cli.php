<?php

class What_The_Bill_CLI extends WP_CLI_Command {


	/**
	 * Import our bills from Legiscan
	 * 
	 * @subcommand import-bills-from-legiscan
	 * @synopsis <api-key>
	 */
	public function import_bills_from_legiscan( $args ) {

		/** do what ever we need **/
		WP_CLI::line( "Shello ocean" );

	}

	/**
	 * Import bills from a folder
	 * 
	 * @subcommand import-bills-from-dir
	 * @synopsis <dir>
	 */
	public function import_bills_from_dir( $args ) {

		list( $dir ) = $args;

		if ( ! is_dir( $dir ) )
			WP_CLI::error( sprintf( "Invalid dir: %s", $dir ) );

		WP_CLI::line( sprintf( "Importing dir: %s", $dir ) );
		foreach( glob( $dir . '/*' ) as $file ) {

			if ( ! is_file( $file ) )
				continue;

			$bill_data = file_get_contents( $file );
			$bill_data = json_decode( $bill_data );
			if ( ! is_object( $bill_data ) )
				continue;
			$result = $this->import_legiscan_bill( $bill_data );
			if ( is_wp_error( $result ) )
				WP_CLI::line( sprintf( "Error importing file: %s", $file ) );
			else
				WP_CLI::line( sprintf( "Successfully imported file: %s", $file ) );
		}
		WP_CLI::success( "All files imported." );
	}

	/**
	 * Import or update a bill from Legiscan
	 */
	private function import_legiscan_bill( $bill_data ) {
		global $wpdb;

		if ( 'OK' != $bill_data->status )
			return new WP_Error( 'invalid-bill' );

		$bill = $bill_data->bill;

		$post_id = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key='legiscan_id' AND meta_value=%d", $bill->bill_id ) );
		if ( ! $post_id ) {
			$post = array(
					'post_title' => $bill->bill_number,
					'post_type' => 'bill',
					'post_status' => 'publish',
				);
			$post_id = wp_insert_post( $post );
		}

		$fields = array(
				'bill_number' => 'id',
				'description' => 'summary',
				'bill_id' => 'legiscan_id',
				'history' => 'history',
			);
		foreach( $fields as $b_key => $pm_key ) {
			update_post_meta( $post_id, $pm_key, $bill->$b_key, true );
		}
		return true;

	}

}
WP_CLI::add_command( 'what-the-bill', 'What_The_Bill_CLI' );