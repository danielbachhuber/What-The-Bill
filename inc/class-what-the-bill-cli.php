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

}
WP_CLI::add_command( 'what-the-bill', 'What_The_Bill_CLI' );