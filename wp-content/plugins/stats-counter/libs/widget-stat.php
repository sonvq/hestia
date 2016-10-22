<?php
/**
* error 
*           
* 100 - mothod not exist
* 101 - error method api
* 102 - error in the received data 
* 103 - error 
* 
* notice 
* 401 - activate user 
* 
* success
* 201 - registaration and acivate ok
* 202 - acivate plugin ok
* 
*/
if ( ! class_exists("wpadm_widget_stat")) {
    class wpadm_widget_stat extends WP_Widget {
        function __construct()
        {
            $widget_ops = array( 'classname' => 'wpadm_counter_widget', 'description' => 'Stats counter' );

            $control_ops = array( 'width' => 400, 'height' => 550, 'id_base' => 'wpadm_counter_widget' );
            if (version_compare(phpversion(), '5.0.0', '>=')) {
                parent::__construct('wpadm_counter_widget', 'Stats Counter', $widget_ops, $control_ops);
            } else {
                $this->WP_Widget('wpadm_counter_widget', 'Stats Counter', $widget_ops, $control_ops );
            }
        }
        function widget( $args, $instance ) 
        {
            $code = get_option(_PREFIX_STAT . 'counter_code');
            echo $code;
        }
        function form( $instance ) 
        {
            ob_start();
            include dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "template" . DIRECTORY_SEPARATOR . "settings_form.php"; 
            $form = ob_get_clean();
            echo $form;
        }

        function update( $new_instance, $old_instance ) 
        {
            
        }
    }
}