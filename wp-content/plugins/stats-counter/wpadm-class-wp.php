<?php 
    if (! defined("WPADM_URL_BASE")) {
        define("WPADM_URL_BASE", 'http://secure.wpadm.com/');
    }
    if (!defined("PAGES_NEXT_PREV_COUNT_STAT")) {   
        define("PAGES_NEXT_PREV_COUNT_STAT", 3);
    }
    if(session_id() == '') {
        session_start();
    }

    require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "libs/error.class.php";
    require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "libs/wpadm.server.main.class.php";
    if (! class_exists("wpadm_wp_stat") ) {

        add_action('wp_ajax_position_form', array('wpadm_wp_stat', 'position_form') );
        add_action('wp_ajax_testCounter', array('wpadm_wp_stat', 'test_counter') );
        add_action('admin_post_savePosition', array('wpadm_wp_stat', 'saveSettingPosition') );
        add_action('admin_post_setCodeToTemplate', array('wpadm_wp_stat', 'setCodeToTemplate') );

        add_action('admin_notices', array('wpadm_wp_stat', 'notice'));
        add_action('admin_post_statsHideNotice', array('wpadm_wp_stat', 'hideNotice') );

        class wpadm_wp_stat extends wpadm_class  {

            static private $data_counter = array(); 
            static private $templates = array('footer.php', 'index.php', 'single.php', 'archive.php', 'page.php');

            static private $file_hash = "";
            static private $die = true;
            
            static private $table_prefix = 'stats_';

            /**
            * add link to plugins panel
            * 
            * @param array $links
            * @param string $file
            */
            public static function manage_link($links, $file)
            {
                if (strpos($file, self::getPathPlugin()) !== false) {
                    $settings_link = '<a href="admin.php?page=stats_counter">Statistic</a>';
                    array_unshift($links, $settings_link);
                }
                return $links;
            }
            public static function hideNotice()
            {

                $setting = get_option(self::$table_prefix . "setting", array() );
                if (!isset($setting['notice']['stats'])) {
                    $setting['notice']['stats'] = false;
                }
                update_option(self::$table_prefix . "setting", $setting);

                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }

            public static function notice()
            {
                $setting = get_option(self::$table_prefix . "setting", array() );
                if (file_exists(plugin_dir_path( __FILE__ ) . "temp/notice") && (!isset($setting['notice']['stats']) || ( isset($setting['notice']['stats']) && $setting['notice']['stats'] !== false ) ) ) {
                ?> 
                <div class="clear"></div>
                <div class="updated" style="position: relative;"> 
                    <p style="font-size: 15px;">
                        Support us with your <a href="https://wordpress.org/support/view/plugin-reviews/stats-counter?filter=5" target="_blank">5 stars review</a>! It will help us to make "Stats Counter" plugin better! Please, <a href="https://wordpress.org/support/view/plugin-reviews/stats-counter?filter=5" target="_blank">leave your review</a>
                    </p>
                    <div style="position: absolute; top:5px; right: 5px;">
                        [<a href="<?php echo admin_url( 'admin-post.php?action=statsHideNotice' );?>" >hide message</a>]
                    </div>
                </div>
                <?php
                }
            }

            public static function test_counter()
            {
                if (!function_exists('wp_safe_remote_get')) {
                    include ABSPATH . WPINC . "/http.php";
                }
                $res = array('status' => 'fail');
                $res['status'] = self::checkCounterInUrl( home_url('/') );
                if ($res['status'] != 'success') {   /// check posts in wordpress
                    $args = array(
                    'post_type'        => 'post',
                    'post_status'      => 'publish',
                    'suppress_filters' => true 
                    );
                    $posts_array = get_posts( $args ); 
                    $i = rand(0, count($posts_array ) - 1 );  // http://localhost/wp-stats/?p=111
                    if ( isset( $posts_array[$i]->guid ) && !empty( $posts_array[$i]->guid ) ) {
                        $res['status'] = self::checkCounterInUrl( $posts_array[$i]->guid ); 
                    }
                    if ($res['status'] != 'success') {     /// check pages in wordpress
                        $args = array(
                        'post_type'        => 'page',
                        'post_status'      => 'publish',
                        'suppress_filters' => true 
                        );
                        $posts_array = get_posts( $args ); 
                        $i = rand(0, count($posts_array ) - 1 );  // http://localhost/wp-stats/?p=111
                        if ( isset( $posts_array[$i]->guid ) && !empty( $posts_array[$i]->guid ) ) {
                            $res['status'] = self::checkCounterInUrl( $posts_array[$i]->guid ); 
                        }
                    }
                }
                if (self::$die) {
                    echo json_encode($res);
                    wp_die();
                } else {
                    return $res;
                }
            }
            private static function checkCounterInUrl($url)
            {
                if (!function_exists('wp_safe_remote_get')) {
                    include ABSPATH . WPINC . "/http.php";
                }
                $res = 'fail';
                $request = wp_remote_get( $url ); 
                if (!is_wp_error($request)) {
                    $search = str_replace(array(".", "/"), array("\.", "\/") , SERVER_URL_STAT );
                    if (preg_match("/<div id=\"counter24\">.*$search/i", $request['body'])) {
                        $res = 'success';
                    }
                }
                return $res;
            }

            public static function saveSettingPosition()
            {
                if (isset($_POST['code-add'])) {
                    self::deleteWidget();
                    self::deleteCodeTemplate();
                    $w = self::getDataFlag();
                    $w['method-position'] = $w['method'] = trim( strip_tags( stripslashes( $_POST['code-add'] ) ) );
                    if ($w['method-position'] == 'auto') {
                        self::unset_($w, 'method');
                    } elseif ( $w['method-position'] == 'template' ) {
                        $w['position'] = trim( strip_tags( stripslashes( $_POST['template-position'] ) ) );
                        $w['html'] = 0;
                        $w = array_merge($w, self::getReplace($w['position']));
                    } elseif( $w['method-position'] == 'manual' ) {
                        $w['method'] = 'manual';
                    } elseif ( $w['method-position'] == 'sidebar' ) {
                        $w['widget'] = $_POST['sidebar-position'];
                        self::addWidget($_POST['sidebar-position']);
                    }
                    self::setDataFlag($w);    
                }
                header("Location: " . admin_url( 'admin.php?page=stats_counter' ) );
                exit;

            }

            private static function getReplace($position)
            {   
                $w = array();
                $code = get_option(_PREFIX_STAT . 'counter_code');  
                switch($position) {
                    case 'index.php' :
                        $w['from'] = "<?php get_footer(); ?>";
                        $w['to'] = "<!-- start counter24 --> $code <!-- end counter24 -->\<\?php get_footer\(\)\; \?\>";
                        $w['del_to'] = "<!-- start counter24 -->(.*)<!-- end counter24 -->";
                        $w['del_from'] = "";
                        break;
                    case 'footer.php' : 
                        $w['from'] = "</body>";
                        $w['to'] = "<!-- start counter24 --> $code <!-- end counter24 --><\/body>";
                        $w['del_to'] = "<!-- start counter24 -->(.*)<!-- end counter24 -->";
                        $w['del_from'] = "";
                        break;
                    case 'single.php' : 
                        $w['from'] = "<?php get_footer(); ?>";
                        $w['to'] = "<!-- start counter24 --> $code <!-- end counter24 -->\<\?php get_footer\(\)\; \?\>";
                        $w['del_to'] = "<!-- start counter24 -->(.*)<!-- end counter24 -->";
                        $w['del_from'] = "";
                        break;
                    case 'archive.php' : 
                        $w['from'] = "<?php get_footer(); ?>";
                        $w['to'] = "<!-- start counter24 --> $code <!-- end counter24 -->\<\?php get_footer\(\)\; \?\>";
                        $w['del_to'] = "<!-- start counter24 -->(.*)<!-- end counter24 -->";
                        $w['del_from'] = "";
                        break;
                    case 'page.php' : 
                        $w['from'] = "<?php get_footer(); ?>";
                        $w['to'] = "<!-- start counter24 --> $code <!-- end counter24 -->\<\?php get_footer\(\)\; \?\>";
                        $w['del_to'] = "<!-- start counter24 -->(.*)<!-- end counter24 -->";
                        $w['del_from'] = "";
                        break;
                }
                return $w;
            }
            private static function unset_(&$array, $key) 
            {
                if (isset($array[$key])) {
                    unset($array[$key]);
                } 
            }

            public static function position_form()
            {

                $n = count(self::$templates);
                $sidebars = get_option( 'sidebars_widgets' );
                self::unset_($sidebars, 'wp_inactive_widgets');
                self::unset_($sidebars, 'array_version');
                $sidebars = array_keys($sidebars);
                $path = get_template_directory();
                $files = array();
                for($i = 0; $i < $n; $i++) {
                    if (file_exists($path . "/" . self::$templates[$i])) {  // search  get_footer() function
                        $html = file_get_contents($path . "/" . self::$templates[$i]);
                        if (strpos($html, 'get_footer()') !== false) {
                            $files[] = self::$templates[$i];
                        }
                    }
                }
                $code = get_option(_PREFIX_STAT . 'counter_code');
                $insall_to = self::getDataFlag();
                ob_start();
                include dirname(__FILE__) . DIRECTORY_SEPARATOR . "template" . DIRECTORY_SEPARATOR . "position-form.php";
                $html = ob_get_clean();
                echo json_encode( array('html' => $html) );
                wp_die();
            }

            protected static function add_options_plugin($result)
            {
                if (isset($result['status']) && $result['status'] == "ok" && 
                isset($result['default_image']) && isset($result['default_hidden']) && 
                isset($result['code']) && isset($result['images']) && isset($result['image_color_text'])) {
                    add_option(_PREFIX_STAT . 'counter_id', $result['counter_id'], '', true);
                    add_option(_PREFIX_STAT . 'default_image', $result['default_image'], '', true);
                    add_option(_PREFIX_STAT . 'default_hidden', $result['default_hidden'], '', true);
                    add_option(_PREFIX_STAT . 'counter_code', $result['code']);
                    add_option(_PREFIX_STAT . 'image_color', $result['image_color']);
                    add_option(_PREFIX_STAT . 'images', $result['images'], '', true);
                    add_option(_PREFIX_STAT . 'email', $result['email'], '', true);
                    add_option(_PREFIX_STAT . 'password', $result['password'], '', true);
                    add_option(_PREFIX_STAT . 'protected_password', $result['protect_password'], '', true);
                    add_option(_PREFIX_STAT . 'image_color_text', (string)$result['image_color_text'], '', 'yes');
                    self::$data_counter['counter_id'] = $result['counter_id'];
                    self::$data_counter['images'] = $result['images'];
                }
            }

            protected static function getPluginName()
            {

                preg_match("|wpadm_wp_(.*)|", __CLASS__, $m);
                return $m[1];
            }
            protected static function getPathPlugin()
            {
                return "stats_counter";
            }


            public static function wpadm_show_stat()
            {

                $show = (!is_super_admin() || !is_admin()) || !get_option(_PREFIX_STAT . 'counter_id');
                if (!$show) {
                    if (isset($_POST['send'])) {
                        $new_instance['counter_hidden'] = isset($_POST['hidden_counter']) && $_POST['hidden_counter'] == 1 ? 2 : 0;
                        $new_instance['counter_image'] = get_option(_PREFIX_STAT . 'default_image');
                        $new_instance['counter_image_color'] = isset($_POST['color_image']) ? $_POST['color_image'] : "#ffffff";
                        $new_instance['counter_image_color_text'] = isset($_POST['color_text']) ? $_POST['color_text'] : "#000000";
                        $new_instance['counter_protected_password'] = isset($_POST['password_counter']) && $_POST['password_counter'] == 1  ? $_POST['password_counter'] : 0;
                        $data_post_default = array(
                        "action" => "get_count_image_on_setting", 
                        "image" => $new_instance['counter_image'], 
                        "hidden" => $new_instance['counter_hidden'], 
                        "image_color" => $new_instance['counter_image_color'],
                        "image_color_text" => $new_instance['counter_image_color_text'],
                        "protected_password" => $new_instance['counter_protected_password'],
                        "wpadm" => 1,
                        );
                        $result_default_image_setting = wpadm_wp_stat::sendToServer($data_post_default, true);

                        if (isset($result_default_image_setting['code'])) {
                            update_option(_PREFIX_STAT . 'counter_code', $result_default_image_setting['code']);
                            update_option(_PREFIX_STAT . 'default_hidden', $new_instance['counter_hidden']);
                            update_option(_PREFIX_STAT . 'image_color', $new_instance['counter_image_color']);
                            update_option(_PREFIX_STAT . 'image_color_text', $new_instance['counter_image_color_text']);
                            update_option(_PREFIX_STAT . 'protected_password', $new_instance['counter_protected_password']);
                        }
                    }
                    $data = array('action' => 'get_statistic');
                    // hash
                    self::$file_hash = plugin_dir_path( __FILE__ ) . "temp/data.stat";
                    self::checkDir();
                    $data_hash = self::getHash();
                    $data['count_hash'] = count($data_hash);
                    $data['time_hash'] = filemtime(self::$file_hash);
                    if ($data['count_hash'] == 0) {
                        $data['first'] = true;
                    }          
                    //end hash  
                    $month_now = date("n");
                    $year_now = date("Y");
                    $start_today = date("j");
                    $id_counter = get_option(_PREFIX_STAT . 'counter_id');
                    $date_week = self::getWeekDates();
                    if ($res = self::sendToServer($data, true)) {   
                        if ( isset($res["stat"]['all']['years']) && !file_exists(plugin_dir_path( __FILE__ ) . "temp/notice") && $res["stat"]['all']['years'] > 0) {
                            if (!is_dir(plugin_dir_path( __FILE__ ) . "temp") ) {
                                mkdir(plugin_dir_path( __FILE__ ) . "temp", 0755);
                            }
                            file_put_contents(plugin_dir_path( __FILE__ ) . "temp/notice", 1);
                        }
                        if (isset($res["stat"]['all']['months'])) {
                            $browser = isset($res["stat"]['all']['details']['browser']) ? self::sort_data($res["stat"]['all']['details']['browser']) : array();
                            $os = isset($res["stat"]['all']['details']['os']) ? self::sort_data($res["stat"]['all']['details']['os']) : array();
                            $data_screen = isset($res["stat"]['all']['details']['data_screen']) ? self::sort_data($res["stat"]['all']['details']['data_screen']) : array();
                            $data_bit = isset($res["stat"]['all']['details']['data_bit']) ? self::sort_data($res["stat"]['all']['details']['data_bit']) : array();
                            $data_countries = isset($res["stat"]['all']['details']['countries']) ? self::sort_data($res["stat"]['all']['details']['countries']) : array(); 
                            $data_city = isset($res["stat"]['all']['details']['cities']) ? self::sort_data($res["stat"]['all']['details']['cities']) : array();
                        }

                        if (isset($res['stat']['record']['data']) && isset($res['stat']['count_data'])) {  
                            $data_hash = self::chackArray($res['stat']['record']['data'], $data_hash, $res['stat']['record']['visitors_count']);
                            $data['count_hash'] = count($data_hash);
                            if ($data['count_hash'] > $res['stat']['count_data']) {
                                $temp = array_chunk($data_hash, $res['stat']['count_data']);
                                $data_hash = $temp[0];
                            }
                            self::saveHash($data_hash);
                        }
                    }
                    $record = self::getHash();
                    $stat_chart_day = (isset($res["stat"]['all']["all_month"]) ? $res["stat"]['all']["all_month"] : array());
                    $stat_chart_month = (isset($res["stat"]['all']["months"]) ? $res["stat"]['all']["months"] : array());
                    $stat_chart_week = (isset($res["stat"]['week_days_stat']) ? $res["stat"]['week_days_stat'] : array());
                    $sort_data = array();
                    krsort($stat_chart_day);
                    foreach($stat_chart_day as $k => $v ) {
                        foreach($v as $u => $y) {
                            krsort($y);
                            $v[$u] = $y;
                        }
                        krsort($v);
                        $sort_data[$k] = $v;
                    }
                    $stat_chart_day = $sort_data;
                }
                $error = parent::getError(true);
                $msg = parent::getMessage(true); 
                $show_auth = !get_option('wpadm_pub_key');
                $counter_id = get_option(_PREFIX_STAT . 'counter_id');
                $hidden = get_option(_PREFIX_STAT . 'default_hidden', '0');
                $password_protected = get_option(_PREFIX_STAT . 'protected_password', '0');
                $image = get_option(_PREFIX_STAT . 'default_image', '9');
                $image_color = get_option(_PREFIX_STAT . 'image_color', '#ffffff');
                $image_color_text = get_option(_PREFIX_STAT . 'image_color_text');
                ob_start();
                require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "template" . DIRECTORY_SEPARATOR . "wpadm_show.php";
                echo ob_get_clean();
            }
            static function checkDir()
            {
                if (!is_dir(plugin_dir_path( __FILE__ ) . "temp")) {
                    mkdir(plugin_dir_path( __FILE__ ) . "temp");
                }
            }
            /**
            * check hash and server data
            */
            static function chackArray($ar1, $ar2, $count_array)
            {
                if (count($ar2) > 0) {
                    $unique = array();
                    foreach ($ar2 as $elem) {
                        $flag = self::inArray($elem, $ar1);
                        if ($flag !== false) {
                            unset($ar1[$flag]);
                        } 
                        $unique[] = $elem;
                    }
                    if (count($ar1) > 0) {
                        foreach($ar1 as $k => $v) {
                            if (isset($count_array[$ar1[$k][10]])) {
                                $ar1[$k][10] = $count_array[$ar1[$k][10]];
                            }
                        }
                        $unique = array_merge_recursive($ar1, $ar2);
                    }
                    return $unique;
                } else {
                    foreach ($ar1 as $key =>$elem) {
                        if (isset($count_array[$ar1[$key][10]])) {
                            $ar1[$key][10] = $count_array[$ar1[$key][10]];
                        }
                    }
                    return $ar1;
                }
            }
            /**
            * search element in array
            */
            static function inArray($element, $array) 
            {
                $f = false;
                $elem_hash = md5($element[4]);
                foreach($array as $i => $value) {
                    if ($elem_hash == md5($array[$i][4])) {
                        $f = $i;
                        break;
                    }
                }
                return $f;
            }
            static function getWeekDates()
            {

                $week_day = date("w");
                $week_day = ($week_day == 0) ? 7 : $week_day;
                $day_now = date("j");
                $end_week_day = $day_now + (7 - $week_day);
                $start_week_day = $day_now - ($week_day - 1);
                $day_in_month = date("t");
                $day_in_month_pref = date("t", mktime(0,0,0, date("n")-1));
                $now_month = date("n");
                $change_month = "";
                if($end_week_day > $day_in_month) {
                    $day_next_month = $end_week_day - $day_in_month  ;
                    $end_week_day = $day_next_month;
                    $change_month = $now_month + 1;
                } 
                if($start_week_day < 1) {
                    $day_next_month = $day_in_month_pref + $start_week_day; // т.к. число  $start_week_day отрецательное
                    $start_week_day = $day_next_month; 
                    $change_month = $now_month - 1;
                }
                $year_change  = $year = 0;

                if ($change_month != "" && $change_month < 1) {   
                    $year_change = date("Y") - 1;   
                    $change_month = 12;
                } elseif ($change_month != "" && $change_month > 12) {
                    $year_change = date("Y") + 1;
                    $change_month = 1;
                } 

                $year = date("Y");

                if ($change_month != "" && $change_month > $now_month) {       
                    if (!empty($year_change) && $year_change > $year) {
                        $dates_start_week = mktime(0,0,0, $now_month, $start_week_day, $year);
                        $date_end_week = mktime(23, 59,59, $change_month, $end_week_day, $year_change);
                    } elseif (!empty($year_change) && $year_change < $year) {
                        $dates_start_week = mktime(0,0,0, $change_month , $start_week_day, $year_change);
                        $date_end_week = mktime(23, 59,59, $now_month, $end_week_day, $year);
                    } else {                            
                        $dates_start_week = mktime(0,0,0, $now_month, $start_week_day, $year);
                        $date_end_week = mktime(23, 59,59, $change_month, $end_week_day, $year);
                    }

                } elseif ($change_month != "" && $change_month < $now_month) { 
                    if (!empty($year_change) && $year_change > $year) {
                        $dates_start_week = mktime(0,0,0, $now_month, $start_week_day, $year);
                        $date_end_week = mktime(23, 59, 59, $change_month, $end_week_day, $year_change);
                    } elseif (!empty($year_change) && $year_change < $year) {
                        $dates_start_week = mktime(0,0,0, $change_month, $start_week_day, $year_change);
                        $date_end_week = mktime(23, 59, 59, $now_month, $end_week_day, $year);
                    } else {
                        $dates_start_week = mktime(0,0,0, $change_month, $start_week_day, $year);
                        $date_end_week = mktime(23, 59, 59, $now_month, $end_week_day, $year);
                    }
                } else {
                    if (!empty($year_change) && $year_change > $year) {
                        $dates_start_week = mktime(0,0,0, $now_month, $start_week_day, $year);
                        $date_end_week = mktime(23, 59,59, $now_month, $end_week_day, $year);
                    } elseif (!empty($year_change) && $year_change < $year) {
                        $dates_start_week = mktime(0,0,0, $now_month, $start_week_day, $year);
                        $date_end_week = mktime(23, 59,59, $now_month, $end_week_day, $year);
                    }
                    $dates_start_week = mktime(0,0,0, $now_month, $start_week_day, $year);
                    $date_end_week = mktime(23, 59,59, $now_month, $end_week_day, $year);
                }
                $array_dates['start_week_time'] = $dates_start_week;
                $array_dates['end_week_time'] = $date_end_week;
                return $array_dates;

            }

            static function saveHash($data = array())
            {
                file_put_contents(self::$file_hash, base64_encode(serialize($data)));
            }
            static function getHash() 
            {
                $data = array();
                if (file_exists(self::$file_hash)) {
                    $contant = file_get_contents(self::$file_hash);
                    $data =  unserialize(base64_decode($contant));
                } else {
                    self::saveHash();
                }
                return $data;
            }
            static function sort_data($data = array())
            {
                $max = 0;
                $record_data = array();
                $is_array = false;
                foreach($data as $data_id => $data_value) {
                    if (is_array($data_value)) {
                        $max = $max + $data_value['count'];
                        $record_data[] = $data_value['count']; 
                        $is_array = true;
                    } else {
                        $max = $max + $data_value;
                        $record_data[] = $data_value;
                    }
                }    
                if ($is_array) {
                    array_multisort($record_data, SORT_DESC, SORT_NUMERIC, $data);
                } else {
                    arsort($data);
                }

                return array("max" => $max, "data" => $data);
            }

            public static function widgets_initial()
            {
                register_widget('wpadm_widget_stat');
                parent::$plugin_name = 'stat';
            }
            static public function log($txt, $class='') {
                $log_file = self::getTmpDir() . '/log.log';
                file_put_contents($log_file, date("Y-m-d H:i:s") ."\t{$class}\t{$txt}\n", FILE_APPEND);
            }
            static function getTmpDir()
            {
                $dirname = dirname(__FILE__) . '/tmp';
                if(!is_dir($dirname)) {
                    mkdir($dirname, 0755, true);
                }
                return $dirname;
            }

            public static function on_activate()
            {
                $data_post = array("action" => "create_new_counter", "site_url" => get_option('siteurl'), 'wpadm' => 1);
                if ($result = parent::sendToServer($data_post, true)) {  
                    self::add_options_plugin($result);
                    self::widgets_initial();
                }
            }

            static function deleteToTheme()
            {
                if ( file_exists( dirname(__FILE__) . "/widget") ) {
                    $path = get_template_directory(); 
                    foreach(self::$templates as $i => $template) {
                        if (file_exists($path . "/$template")) {
                            $html = file_get_contents($path . "/$template");
                            $replace = self::getReplace($template);
                            if ( preg_match_all("/{$replace['del_to']}/", $html, $del ) ) {
                                $html = preg_replace("/{$replace['del_to']}/", $replace['del_from'], $html);
                                file_put_contents($path . "/$template", $html);
                            }
                        }
                    }
                }
            }

            static function on_deactivate()
            {
                self::deleteToTheme();
                delete_option(_PREFIX_STAT . 'counter_id');
                delete_option(_PREFIX_STAT . 'images');
                delete_option(_PREFIX_STAT . 'default_image');
                delete_option(_PREFIX_STAT . 'default_hidden');
                delete_option(_PREFIX_STAT . 'counter_code');
                delete_option(_PREFIX_STAT . 'image_color');
                delete_option(_PREFIX_STAT . 'email');
                delete_option(_PREFIX_STAT . 'password');
                delete_option(_PREFIX_STAT . 'image_color_text');
                if ( file_exists( dirname(__FILE__) . "/widget") ) {
                    @unlink( dirname(__FILE__) . "/widget");
                }
            }


            public static function draw_menu()
            {

                $menu_position = '1.9998887771'; 
                if(self::checkInstallWpadmPlugins()) {
                    $page = add_menu_page(
                    'WPAdm', 
                    'WPAdm', 
                    "read", 
                    'wpadm_plugins', 
                    'wpadm_plugins',
                    plugins_url('/wpadm-logo.png', __FILE__),
                    $menu_position     
                    );
                    add_submenu_page(
                    'wpadm_plugins', 
                    "Stats Counter",
                    "Stats Counter",
                    'read',
                    'stats_counter',
                    array('wpadm_wp_stat', 'wpadm_show_stat')
                    );
                } else {
                    $page = add_menu_page(
                    'Stats Counter', 
                    'Stats Counter', 
                    "read", 
                    'stats_counter', 
                    array('wpadm_wp_stat', 'wpadm_show_stat'),
                    plugins_url('/wpadm-logo.png', __FILE__),
                    $menu_position     
                    );

                    add_submenu_page(
                    'stats_counter', 
                    "WPAdm",
                    "WPAdm",
                    'read',
                    'wpadm_plugins',
                    'wpadm_plugins'
                    );
                }

            }
            public static function checkInstallWpadmPlugins()
            {
                $return = false;
                $i = 1;
                foreach(parent::$plugins as $plugin => $version) {
                    if (parent::check_plugin($plugin)) {
                        $i ++;
                    }
                }
                if ($i > 2) {
                    $return = true;
                }
                return $return;
            }

            public static function adding_files_style()
            {
                if (isset($_GET['page']) && ($_GET['page'] == 'stats_counter' || $_GET['page'] == 'wpadm_plugins')) {
                    wp_register_style('wpadm_counter_jquery_minicolors_css', plugins_url("template/css/jquery.minicolors.css",__FILE__));
                    wp_register_style('css-admin-stats', plugins_url("template/css/admin-style-wpadm.css", __FILE__));
                    wp_enqueue_style('wpadm_counter_jquery_minicolors_css');
                    wp_enqueue_style('css-admin-stats');
                }
            }
            public static function adding_files_script()
            {
                if (isset($_GET['page']) && ($_GET['page'] == 'stats_counter' || $_GET['page'] == 'wpadm_plugins' ) ) {
                    wp_register_script('wpadm_counter_script', plugins_url("template/js/counter.js",__FILE__));
                    wp_register_script('wpadm_chart', plugins_url("template/js/chart.min.js",__FILE__));
                    wp_enqueue_script('wpadm_chart');
                    wp_enqueue_script('wpadm_counter_script');
                    wp_register_script('wpadm_counter_jquery_minicolors_js', plugins_url("template/js/jquery.minicolors.js",__FILE__));
                    wp_enqueue_script('wpadm_counter_jquery_minicolors_js');
                }
            }
            public static function setCodeToTemplate()
            {
                $w = self::getDataFlag();
                if (isset($w['add_to_template']) && $w['add_to_template'] == 1 ) {
                    if (isset($_POST['set_template'])) {
                        if ($_POST['set_template'] == 1) {
                            $path = get_template_directory();
                            foreach(self::$templates as $template) {
                                $r = self::getReplace($template);
                                $html = file_get_contents($path . "/$template");
                                if (!preg_match("/<\!-- start counter24 -->(.*)<!-- end counter24 -->/", $html)) {
                                    $code = get_option(_PREFIX_STAT . 'counter_code');
                                    $search = isset($r['from']) ? str_replace('\\', '', $r['from']) : '</body>';
                                    $replace = isset($r['to']) ? str_replace('\\', '', $r['to']) : "<!-- start counter24 --> $code <!-- end counter24 --></body>";
                                    if (strpos($html, $search) === false) {
                                        $search = str_replace(array('?>', '<?php', ' '), '', $search);
                                        $replace = ' ?>' . $replace ;
                                    }
                                    $html = str_replace($search, $replace, $html);
                                    file_put_contents($path . "/$template", $html);
                                    if ( self::checkWidgetInMainPage() ) {
                                        break;
                                    } else {
                                        $html = file_get_contents($path . "/$template");
                                        if ( preg_match_all("/{$r['del_to']}/", $html, $del ) ) {
                                            $html = preg_replace("/{$r['del_to']}/", $r['del_from'], $html);
                                            file_put_contents($path . "/$template", $html);
                                        }
                                    }
                                }
                            }
                            $w['install'] = 1;
                            $w['html'] = 1;
                        } else {
                            $w['templates'] = 0;
                            $w['install'] = 0;
                            $w['add_to_template'] = 0;
                        }

                        self::setDataFlag($w); 
                    }
                }
                header('location:' . $_SERVER['HTTP_REFERER']);
                exit;
            }

            public static function install_template_notice()
            {
                $w = self::getDataFlag();
                if (isset($w['add_to_template']) && $w['add_to_template'] == 1 ) {
                ?>
                <div class="update-nag"> 
                    <div style="height: 25px;">
                        In Your web page code counter is don't found add code to the template theme.
                        <script>
                            function setAddTemplate(type)
                            {
                                document.form_add_to_template.set_template.value = type;
                                document.form_add_to_template.submit();
                            }
                        </script>
                        <form style="float: right; margin-bottom: 0; margin-left: 30px; margin-top: -4px;" name="form_add_to_template" action="<?php echo admin_url( 'admin-post.php?action=setCodeToTemplate' ); ?>" method="post">
                            <input type="hidden" value="0" id="set_template" name="set_template">
                            <input type="button" onclick="setAddTemplate(1)" value="Yes" class="button-wpadm" />
                            <input type="button" onclick="setAddTemplate(0)" value="No" class="button-wpadm button-wpadm-cancel" />
                        </form>
                    </div>
                </div>
                <?php
                }
            }
            public static function initWidget($sidebar_id = false)
            {
                if (!file_exists(dirname(__FILE__) . "/flag_init" )) {
                    file_put_contents(dirname(__FILE__) . "/flag_init", 1);
                    $w = self::getDataFlag();
                    if (!isset($w['widget_check']) && !isset($w['method'])) {
                        $w['widget_check'] = 1;
                        self::setDataFlag($w);
                        if ( ( $sidebar = self::checkWidget() ) === false) {   
                            self::addWidget($sidebar_id);
                        } else {
                            $w = self::getDataFlag();
                            $w['widget'] = $sidebar;
                            $w['install'] = 1;
                            self::setDataFlag( $w );
                        }
                        $w = self::getDataFlag();
                        if ( !isset( $w['install'] ) ) { 
                            if ( self::checkWidgetInMainPage() === false ) {
                                if ( !self::addToFooter() ) {
                                    $w = self::getDataFlag();
                                    $w['add_to_template'] = 1;
                                    self::setDataFlag($w);
                                }
                            }
                        }
                    } else {
                        if(isset($w['method'])) {
                            unset($w['method']);
                        }
                    }
                    $w = self::getDataFlag();
                    if (isset($w['widget_check'])) {
                        unset($w['widget_check']);
                    }
                    self::setDataFlag($w);
                    unlink(dirname(__FILE__) . "/flag_init");
                }
                return false;
            }

            private static function addToTheme()
            {
                $w = self::getDataFlag(); 
                if (!isset($w['html']) || (isset($w['html'])  )) {   //&& $w['html'] == 0
                    $path = get_template_directory();
                    $file = isset($w['position']) ? $w['position'] : 'footer.php';  
                    if (file_exists($path . "/$file")) {
                        $html = file_get_contents($path . "/$file");
                        if (!preg_match("/<\!-- start counter24 -->(.*)<!-- end counter24 -->/", $html)) {
                            $code = get_option(_PREFIX_STAT . 'counter_code');
                            $search = isset($w['from']) ? str_replace('\\', '', $w['from']) : '</body>';
                            $replace = isset($w['to']) ? str_replace('\\', '', $w['to']) : "<!-- start counter24 --> $code <!-- end counter24 --></body>";
                            if (strpos($html, $search) === false) {
                                $search = str_replace(array('?>', '<?php', ' '), '', $search);
                                $replace = ' ?>' . $replace ;
                            }
                            $html = str_replace($search, $replace, $html);
                            file_put_contents($path . "/$file", $html);
                            $w['html'] = 1;
                            self::setDataFlag($w);
                        }
                    }
                }
            }

            public static function checkWidgetInMainPage()  
            {
                if (!function_exists('wp_safe_remote_get')) {
                    include ABSPATH . WPINC . "/http.php";
                }
                $res = wp_remote_get( home_url('/') );
                if (is_wp_error($res)) {

                } else {
                    $search = str_replace(array(".", "/"), array("\.", "\/") , SERVER_URL_STAT );
                    if (preg_match("/<div id=\"counter24\">.*$search/i", $res['body'])) {
                        $w = self::getDataFlag();
                        $w['install'] = 1;
                        self::setDataFlag($w);
                        return true;   /// change on true
                    }
                }
                return false;

            }
            private static function addToFooter()
            {
                $w = self::getDataFlag();
                if (!isset($w['footer']) || (isset($w['footer']) && $w['footer'] == 0)) {
                    $w['footer'] = 1;
                    self::setDataFlag($w);
                    $res = wp_remote_get( home_url('/') );
                    if (!is_wp_error($res)) {
                        $search = str_replace(array(".", "/"), array("\.", "\/") , SERVER_URL_STAT );
                        if (preg_match("/<div id=\"counter24\">.*$search/i", $res['body'])) {
                            $w['install'] = 1;
                            self::setDataFlag($w);
                            return true;
                        }
                        self::unset_($w, 'footer');
                        self::setDataFlag($w);
                    }
                }
                return false;
            }
            public static function addFooter()
            {
                if ( file_exists( dirname(__FILE__) . "/widget" ) ) {
                    $w = self::getDataFlag();
                    if (isset($w['footer']) && $w['footer'] == 1) {
                        $code = get_option(_PREFIX_STAT . 'counter_code');
                        echo $code;
                    }
                }
            }
            public static function addWidget($sidebar_id = false)
            {
                $sidebars_widgets = get_option( 'sidebars_widgets' );
                if ($sidebars_widgets) {
                    if ($sidebar_id === false || empty($sidebar_id)) {
                        $not_active = array('wp_inactive_widgets', 'array_version');
                        foreach($sidebars_widgets as $sidebar => $widget) {
                            if (!in_array($sidebar, $not_active)) {
                                $id = count( $sidebars_widgets[$sidebar] );
                                if ($id == 0) {
                                    $id = 2;
                                }
                                $widget_ = $sidebars_widgets[$sidebar][$id - 1];
                                $id_widget = explode("-", $widget_ );
                                if (!isset($id_widget[1])) {
                                    $id_widget[1] = 1;
                                }
                                if (isset($sidebars_widgets[$sidebar]) && is_array($sidebars_widgets[$sidebar]) && !in_array("wpadm_counter_widget-" . $id_widget[1], $sidebars_widgets[$sidebar])) {
                                    $sidebars_widgets[$sidebar] = array_merge($sidebars_widgets[$sidebar] , array( "wpadm_counter_widget-" . $id_widget[1] ));
                                    $w = self::getDataFlag();
                                    $w['widget'] = $sidebar;
                                    $w['install'] = 1;
                                    self::setDataFlag( $w );
                                    $ops = get_option( 'widget_wpadm_counter_widget' );
                                    $ops[$id_widget[1]] = array(
                                    'title' => 'WPADM Counter',
                                    );
                                    update_option( 'widget_wpadm_counter_widget', $ops ); 
                                    update_option( 'sidebars_widgets', $sidebars_widgets );
                                    break;
                                }
                            }
                        }
                    } else {
                        if (isset($sidebars_widgets[$sidebar_id])) {
                            $id = count( $sidebars_widgets[$sidebar_id] ); 
                            $widget_ = $sidebars_widgets[$sidebar_id][$id-1];
                            $id_widget = explode("-", $widget_ );
                            if (!isset($id_widget[1])) {
                                $id_widget[1] = 1;
                            }
                            if (!in_array("wpadm_counter_widget-" . $id_widget[1], $sidebars_widgets[$sidebar_id])) {
                                $sidebars_widgets[$sidebar_id] = array_merge($sidebars_widgets[$sidebar_id] , array( "wpadm_counter_widget-" . $id_widget[1] ));
                                $ops = get_option( 'widget_wpadm_counter_widget' );
                                $ops[$id_widget[1]] = array(
                                'title' => 'WPADM Counter',
                                );
                                update_option( 'widget_wpadm_counter_widget', $ops ); 
                                update_option( 'sidebars_widgets', $sidebars_widgets );
                                return "Add widget to $sidebar_id";
                            } else {
                                return 'In this sidebar(' . $sidebar_id . ') widget exist';
                            } 
                        } else {
                            return 'This is sidebar(' . $sidebar_id . ') not exist';
                        }
                    }
                }
                return false;
            }
            private static function setDataFlag( $data )
            {
                file_put_contents( dirname(__FILE__) . "/widget", base64_encode( serialize( $data ) ) );
            }
            private static function getDataFlag()
            {
                $w = array();
                if ( !file_exists( dirname(__FILE__) . "/widget" ) ) {
                    file_put_contents( dirname(__FILE__) . "/widget" ,  base64_encode( serialize( $w ) ) );
                } else {
                    $w = unserialize( base64_decode( file_get_contents( dirname(__FILE__) . "/widget" ) ) );
                }
                return $w;
            }

            public static function checkWidget()
            {
                $sidebars_widgets = get_option( 'sidebars_widgets' );
                $check = false;
                if($sidebars_widgets) {
                    foreach($sidebars_widgets as $key => $sidebar) {
                        if (is_array($sidebar)) {
                            foreach($sidebar as $k => $w) {
                                if (stripos($w, "wpadm_counter_widget") !== false) {
                                    $check = $key;
                                    break;
                                }
                            }
                        }
                        if ($check) {
                            break;
                        }
                    }
                }
                return $check;
            }
            public static function deleteWidget()
            {
                $sidebars_widgets = get_option( 'sidebars_widgets' );
                $del = false;
                foreach($sidebars_widgets as $key => $sidebar) {
                    if (is_array($sidebar)) {
                        foreach($sidebar as $k => $w) {
                            if (stripos($w, "wpadm_counter_widget") !== false) {
                                $del = true;
                                unset($sidebars_widgets[$key][$k]);
                            }
                        }
                    }
                }
                if ($del) {
                    update_option( 'sidebars_widgets', $sidebars_widgets );
                    delete_option( 'widget_wpadm_counter_widget' );
                    return true;
                }
                return false;
            }

        }

    }

?>