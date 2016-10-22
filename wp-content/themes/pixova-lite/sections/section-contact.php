<?php


$pixova_lite_section__title = get_theme_mod('pixova_lite_contact_section_title', __('Contact us', 'pixova-lite') );
$pixova_lite_section__sub_title = get_theme_mod('pixova_lite_contact_section_sub_title', __('And we\'ll reply in no time', 'pixova-lite') );

// section args
$pixova_lite_contact_section_address = get_theme_mod('pixova_lite_address', __('Street 221B Baker Street, London, UK', 'pixova-lite') );
$pixova_lite_contact_section_phone = get_theme_mod('pixova_lite_phone', '+444 974 525');
$pixova_lite_contact_section_email = get_theme_mod('pixova_lite_email', 'office@machothemes.com');
$pixova_lite_contact_cf7_form = get_theme_mod('pixova_lite_contact_section_cf7', '');


echo '<section class="has-padding" id="contact">';
	echo '<div class="container">';
		echo '<div class="row">';
			echo '<div class="text-center">';
				echo '<h2 class="section-heading light-section-heading">';
					echo esc_html( $pixova_lite_section__title );
					echo '<span>'.esc_html( $pixova_lite_section__sub_title ).'</span>';
				echo '</h2><!--/.section-heading.light-section-heading-->';
			echo '</div><!--/.text-center-->';
		echo '</div><!--/.row-->';

		echo '<div class="row">';

		echo '<div class="col-md-3">';
			echo '<div class="mt-contact-info">';
				echo '<h3>'.__('Address', 'pixova-lite').'</h3>';
				echo '<p class="contact-info-details address">';
					echo esc_html( $pixova_lite_contact_section_address );
				echo '</p>';

				echo '<h3>'.__('Customer Support', 'pixova-lite').'</h3>';
				echo '<p class="contact-info-details">'.__('Phone: ', 'pixova-lite').esc_html( $pixova_lite_contact_section_phone );
					echo '<br />';
					echo __('Email: ', 'pixova-lite').esc_html( $pixova_lite_contact_section_email );
					echo '<br />';
				echo '</p><!--/.contact-info-details-->';
			echo '</div><!--/.mt-contact-info-->';
		echo '</div><!--/.col-md-3-->';


		echo '<div class="col-md-9">';


					if(  isset($pixova_lite_contact_cf7_form)  && !empty($pixova_lite_contact_cf7_form) && $pixova_lite_contact_cf7_form !== 'default') {

						$shortcode = '[contact-form-7 id="'.esc_html( $pixova_lite_contact_cf7_form ).'"]';
						echo do_shortcode($shortcode);

					} else {
						echo __('No contact form selected. Please go to Customize -> Contact section and select a contact form from the drop-down.', 'pixova-lite');
					}


		echo '</div><!--/.row-->';
	echo '</div><!--/.col-md-9-->';
echo '</section>';
