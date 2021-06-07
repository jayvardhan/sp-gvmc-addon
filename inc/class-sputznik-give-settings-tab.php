<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! class_exists( 'Sputznik_Give_Settings_Tab' ) ) :

	class Sputznik_Give_Settings_Tab extends Give_Settings_Page {

		public function __construct() {
			$this->id    = 'spgmctab';
			$this->label = __( 'Sputznik', 'spgmc' );

			$this->default_tab = 'spgmc-mailchimp-options';

			parent::__construct();
		}

		
		/**
		 * Get settings array.
		 *
		 * @return array
		 */
		public function get_settings() {
			$settings = [];

			$current_section = give_get_current_setting_section();

			switch ( $current_section ) {
				case 'spgmc-mailchimp-options':
					$settings = [
						[
							'id'   => 'give_title_data_control_2',
							'type' => 'title',
						],
						[
							'name'    => __( 'Api Key', 'spgmc' ),
							'id'      => 'spgmc_mailchimp_api_key',
							'type'    => 'text',
						],
						[
							'id'   => 'give_title_data_control_2',
							'type' => 'sectionend',
						],
					];
					break;
			}

			return $settings;
		}

		
		/**
		 * Get sections.
		 *
		 * @return array
		 */
		public function get_sections() {
			$sections = [
				'spgmc-mailchimp-options' => __( 'MailChimp Options', 'spgmc' )
			];

			return apply_filters( 'give_get_sections_' . $this->id, $sections );
		}

	}

endif;

return new Sputznik_Give_Settings_Tab();
