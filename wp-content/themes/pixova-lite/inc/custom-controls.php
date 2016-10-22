<?php

if(!defined('ABSPATH')){
  die(); // no direct access
}

if ( !class_exists('WP_Customize_Control') ) {
  return null;
}


/**
 * Customize for textarea, extend the WP customizer
 *
 * @since Pixova Lite 1.0.0
 */
if( !class_exists('Pixova_Lite_Textarea_Custom_Control') ) {
    class Pixova_Lite_Textarea_Custom_Control extends WP_Customize_Control
    {

        public $type = 'textarea';

        public function render_content()
        {

           ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                  <textarea class="large-text" cols="20" rows="5" <?php $this->link(); ?>>
                    <?php echo esc_textarea($this->value()); ?>
                  </textarea>
            </label>
            <?php
        }
    }
}

/**
 * Customize for disabled HTML elements, extend the WP customizer
 *
 * @since Pixova Lite 1.32
 */
if( !class_exists('Pixova_Lite_Disabled_Custom_Control') ) {
    class Pixova_Lite_Disabled_Custom_Control extends WP_Customize_Control
    {

        public function render_content()
        {

	         switch($this->type) {

		        case 'textarea':
		         echo '<div class="'.$this->type.'-pro-feature">';
		            echo '<span class="pro-badge">PRO</span>';
		         ?>
		           <label>
		                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
		                  <textarea class="large-text" cols="20" rows="5" <?php $this->link(); ?> disabled >
		                    <?php echo esc_textarea($this->value()); ?>
		                  </textarea>
		            </label>
		         <?php echo '</div><!--/pro-feature-->';
		        break;

		        case 'text':
		          echo '<div class="'.$this->type.'-pro-feature">';
		            echo '<span class="pro-badge">PRO</span>';
		        ?>
                 <label>
		                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		                  <input type="text" value="<?php echo esc_html( $this->value() ); ?>" class="large-text" <?php $this->link(); ?> disabled >
		            </label>


		        <?php echo '</div><!--/pro-feature-->';
		        break;

		         case 'checkbox':
		          echo '<div class="'.$this->type.'-pro-feature">';
		            echo '<span class="pro-badge">PRO</span>';
		        ?>
                 <label>
		                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		                  <input type="checkbox" value="<?php echo esc_html( $this->value() ); ?>" <?php $this->link(); ?> disabled >
		            </label>


		        <?php echo '</div><!--/pro-feature-->';
		        break;
	        } // end SWITCH statement
        }
    }
}

/**
 * Customize for Numbers, extend the WP customizer
 *
 *@since Pixova Lite 1.0.0
 */
if( !class_exists( 'Pixova_Lite_Number_Custom_Control' ) ) {
    class Pixova_Lite_Number_Custom_Control extends WP_Customize_Control
    {

        public $type = 'number';

        public function render_content()
        {
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <input type="number" <?php $this->link(); ?> value="<?php echo intval($this->value()); ?>"/>
            </label>
            <?php
        }
    }
}


/**
 * Customize for Contact Form 7, extend the WP Customizer
 *
 * adds a custom control for rendering created contact forms in the customizer.
 * @since Pixova Lite 1.0.0
 */
if(!class_exists('Pixova_Lite_CF7_Custom_Control')) {
    class Pixova_Lite_CF7_Custom_Control extends WP_Customize_Control
    {

    /**
     * Returns true / false if the plugin: Contact Form 7 is activated;
     *
     * This right here disables the control for selecting a contact form IF the plugin isn\'t active
     *
     * @since Pixova Lite 1.15
     *
    * @return bool
     */
    public function active_callback( ) {

        require_once ABSPATH . 'wp-admin/includes/plugin.php';

        if( is_plugin_active('contact-form-7/wp-contact-form-7.php') ) {
            return true;
        } else {
            return false;
        }
    }

        public function pixova_lite_get_cf7_forms()
        {

            global $wpdb;

            // no more php warnings
            $contact_forms = array();

            // check if CF7 is activated
            if ( $this->active_callback()) {
                $cf7 = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE post_type = 'wpcf7_contact_form' ");
                if ($cf7) {

                    foreach ($cf7 as $cform) {
                        $contact_forms[$cform->ID] = $cform->post_title;
                    }
                } else {
                    $contact_forms[0] = __('No contact forms found', 'pixova-lite');
                }
            }
            return $contact_forms;
        }

        public function render_content()
        {
            $Pixova_Lite_contact_forms = $this->pixova_lite_get_cf7_forms();

            if (!empty($Pixova_Lite_contact_forms) ) { ?>

                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <select <?php $this->link(); ?> style="width:100%;">

                <?php echo '<option selected="selected" value="default">'.__('Select your contact form', 'pixova-lite').'</option>';

                foreach ($Pixova_Lite_contact_forms as $form_id => $form_title) {
                    echo '<option value="' . sanitize_key( $form_id ). '" >' . esc_html( $form_title ). '</option>';
                }

                echo '</select>';
            }
        }
    }
}

/**
 * Customize for premium features, extend the WP Customizer
 *
 * @since Pixova Lite 1.0.0
 */
if( !class_exists( 'Pixova_Lite_Theme_Support' ) ) {
    class Pixova_Lite_Theme_Support extends WP_Customize_Control
    {
        public function render_content()
        { ?>

            <div class="pro-version">
                <?php _e('In order to be able to change the section order, you need to upgrade to the PRO version.', 'pixova-lite'); ?>
            </div>

            <div class="pro-box">
                <a href="<?php echo esc_url('http://www.machothemes.com/themes/pixova/');?>" target="_blank" class="upgrade" id="review_pro"><?php _e( 'View PRO version','pixova-lite' ); ?></a>
            </div>

       <?php }
    }
}

/**
 * Customize for premium features, extend the WP Customizer
 *
 * @since Pixova Lite 1.0.8
 */
if( !class_exists( 'Pixova_Lite_Theme_Support_Googlemap' ) ) {
    class Pixova_Lite_Theme_Support_Googlemap extends WP_Customize_Control
    {
         public function render_content()
        { ?>

            <div class="pro-version">
                <?php _e('In order to be able to add Google Maps, you need to upgrade to the PRO version.', 'pixova-lite'); ?>
            </div>

            <div class="pro-box">
                <a href="<?php echo esc_url('http://www.machothemes.com/themes/pixova/');?>" target="_blank" class="upgrade" id="review_pro"><?php _e( 'View PRO version','pixova-lite' ); ?></a>
            </div>

       <?php }
    }
}

/**
     * Customize for premium features, extend the WP Customizer
     *
     * @since Pixova Lite 1.0.8
     */
if( !class_exists('Pixova_Lite_Theme_Support_Pricing') ) {
    class Pixova_Lite_Theme_Support_Pricing extends WP_Customize_Control
    {
        public function render_content()
        { ?>

            <div class="pro-version">
                <?php _e('In order to be able to add pricing tables, you need to upgrade to the PRO version.', 'pixova-lite'); ?>
            </div>

            <div class="pro-box">
                <a href="<?php echo esc_url('http://www.machothemes.com/themes/pixova/');?>" target="_blank" class="upgrade" id="review_pro"><?php _e( 'View PRO version','pixova-lite' ); ?></a>
            </div>

       <?php }
    }
}

/**
 * Customize for premium features, extend the WP Customizer
 *
 * @since Pixova Lite 1.0.8
 */
if( !class_exists( 'Pixova_Lite_WP_Document_Customizer_Control') ) {
    class Pixova_Lite_WP_Document_Customize_Control extends WP_Customize_Control
    {
        public $type = 'new_menu';

        //Render the control's content
        public function render_content()
        {
            ?>
            <div class="pro-box">
            <a href="<?php echo esc_url('http://www.machothemes.com/themes/pixova/');?>" target="_blank" class="document" id="review_pro"><?php _e('Theme Documentation', 'pixova-lite'); ?></a>

            <div>
            <div class="pro-version">
                <?php _e('By upgrading to the PRO version you are unlocking the full potential of Pixova. You will get: unlimited sliders / carousels, unlimited Google Maps, Unlimited Team Members, Section Ordering, Control over theme typography and colors. Upgrade NOW!', 'pixova-lite'); ?>
            </div>
            <?php
        }
    }
}

/**
 * Customize for premium features, extend the WP Customizer
 *
 * @since Pixova Lite 1.0.8
 */
if( !class_exists( 'Pixova_Lite_WP_Pro_Customize_Control' ) ) {
    class Pixova_Lite_WP_Pro_Customize_Control extends WP_Customize_Control {

        public $type = 'new_menu';

        //Render the control's content.
        public function render_content() {
            ?>
            <div class="pro-box">
                <a href="<?php echo esc_url('http://www.machothemes.com/themes/pixova/');?>" target="_blank" class="upgrade" id="review_pro"><?php _e( 'View PRO version','pixova-lite' ); ?></a>
            </div>
            <?php
        }
    }
}

/**
 * Customize for premium features, extend the WP Customizer
 *
 * @since Pixova Lite 1.0.8
 */
if( !class_exists( 'Pixova_Lite_WP_Review_Customize_Control') ) {
    class Pixova_Lite_WP_Review_Customize_Control extends WP_Customize_Control {

            public $type = 'new_menu';

            // Render the control's content.
            public function render_content() {
                ?>
                <div class="pro-box">
                    <a href="<?php echo esc_url( __('https://wordpress.org/support/view/theme-reviews/pixova-lite#postform/', 'pixova-lite'));?>" target="_blank" class="review" id="review_pro"><?php _e( 'Add a review','pixova-lite' ); ?></a>
                </div>
                <?php
            }
        }
   }