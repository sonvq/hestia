<?php
/**
 * Class WPAdm_Method_Stat
 */
if (!class_exists('WPAdm_Method_Stat')) {
    class WPAdm_Method_Stat extends WPAdm_Method_Class{
    
        /**
         * Uniqueid of user
         * @var string
         */
        private static $cookie_stat_id = '';
    
        /**
         * Flag indicating already inserted js-code in the page or not yet
         * @var int 0|1
         */
        private static $js_has_been = 0;
    
        /**
         * @return WPAdm_result
         */
        public function getResult() {
            $limit = 1000;
            error_reporting(E_ALL);
            global $wpdb;
            $sql = "
                SELECT
                     `id`, `dt`, `type`, `value`, `url`, `request`, `cookie_stat_id`, `dt_day`
                FROM `{$wpdb->prefix}wpadm_stat` order by id limit {$limit}";
            $list = $wpdb->get_results($sql, ARRAY_A);
    //        $list = array_map("unserialize", array_unique(array_map("serialize", $list)));
    //        print_r(count($list));
            $sql = "DELETE FROM `{$wpdb->prefix}wpadm_stat` order by id limit {$limit}";
            $wpdb->query($sql);
    
            $this->result->setResult(WPAdm_Result::WPADM_RESULT_SUCCESS);
            $final = (int)(count($list) < $limit);
            if(function_exists('gzcompress')) {
                $data = array(
                    'zip' =>1,
                    'list'=>gzcompress(serialize($list),9),
                    'final' => $final,
                );
            } else {
                $data = array(
                    'zip' =>0,
                    'list'=>serialize($list),
                    'final' => $final,
                );
            }
            $this->result->setData($data);
            error_reporting(0);
            return $this->result;
        }
    
        /**
         * Save stat
         * @param array $a $_SERVER
         * @deprecated
         */
        static function save_from_server($a) {
            global $wpdb;
    
            $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
            $url .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
            $url .= $_SERVER["REQUEST_URI"];
    
    
            $request = $_SERVER["REQUEST_URI"];
    
            if ($request == '/?tlc_transients_request') {
                return;
            }
    
            file_put_contents(dirname(__FILE__) .'/log.log', print_r($_SERVER, true) . "\n", FILE_APPEND);
    
            $stat_id = self::getCookieStatId();
            $values = array();
            //$values[] =
            $sql = $wpdb->prepare(
                "INSERT INTO {$wpdb->prefix}wpadm_stat
                  (`dt`, `dt_day`, `type`, `value`, `url`, `request`, `cookie_stat_id`)
                 values
                  (now(), date_format(now(), '%%Y-%%m-%%d'), 'remote_addr', '%s', '%s', '%s', '{$stat_id}'),
                  (now(), date_format(now(), '%%Y-%%m-%%d'), 'http_user_agent', '%s', '%s', '%s', '{$stat_id}')
                ",
                $a['REMOTE_ADDR'], $url, $request,
                $a['HTTP_USER_AGENT'], $url, $request
            );
    
            if (isset($a['HTTP_REFERER'])) {
                $sql = $wpdb->prepare(
                    "INSERT INTO {$wpdb->prefix}wpadm_stat
                      (`dt`, `dt_day`, `type`, `value`, `url`, `request`, `cookie_stat_id`)
                     values
                      (now(), date_format(now(), '%%Y-%%m-%%d'), 'http_referer', '%s', '%s', '%s', '{$stat_id}')
                    ",
                    (isset($a['HTTP_REFERER']) ? $a['HTTP_REFERER'] : ''), $url, $request
                );
                //file_put_contents(dirname('__FILE__') . '/log.log', print_r($a, true)."\n" , FILE_APPEND);
            }
            $wpdb->query($sql);
        }
    
        public static function save_img_info_from_server() {
            global $wpdb;
            $values = array();
            $stat_id = self::getCookieStatId();;
    
            if(isset($_GET['i'])) {
                $info = unserialize(base64_decode($_GET['i']));
                if (is_array($info)) {
                    $url = $info['url'];
                    $request = $info['request'];
                }
    
                if (is_array($info) && isset($info['HTTP_REFERER'])) {
                    $values[]= "(now(), date_format(now(), '%Y-%m-%d'), 'http_referer', '{$info['HTTP_REFERER']}', '{$url}', '{$request}', '{$stat_id}')";
                }
    
            } else {
                $info = array();
            }
    
    
            if (isset($_GET['w']) && isset($_GET['h'])) {
                $w = (int)$_GET['w'];
                $h = (int)$_GET['h'];
                if ($w && $h) {
                    $size =  "{$w}x{$h}";
                    $values[] = "(now(), date_format(now(), '%Y-%m-%d'), 'screen_resolution', '{$size}', '', '', '{$stat_id}')";
                }
                $values[] = "(now(), date_format(now(), '%Y-%m-%d'), 'http_user_agent', '{$_SERVER['HTTP_USER_AGENT']}', '', '', '{$stat_id}')";
            }
    
            $values[] = "(now(), date_format(now(), '%Y-%m-%d'), 'remote_addr', '{$_SERVER['REMOTE_ADDR']}', '{$url}', '{$request}', '{$stat_id}')";
            $values = implode(',', $values);
            $sql =
                "INSERT INTO {$wpdb->prefix}wpadm_stat
                          (`dt`, `dt_day`, `type`, `value`, `url`, `request`, `cookie_stat_id`)
                         values
                          {$values}
                        ";
            $wpdb->query($sql);
        }
    
        public static function generateCookieStatId() {
            // generating a random string
            $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
            $numChars = strlen($chars);
            $wpadm_stat_id = '';
            for ($i = 0; $i < 16; $i++) {
                $wpadm_stat_id .= substr($chars, rand(1, $numChars) - 1, 1);
            }
            self::setCookieStatId($wpadm_stat_id);
        }
    
        /**
         * @param string $cookie_stat_id
         */
        public static function setCookieStatId($cookie_stat_id)
        {
            self::$cookie_stat_id = $cookie_stat_id;
    
            $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
            $url .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
            $url .= $_SERVER["REQUEST_URI"];
        }
    
        /**
         * @return string
         */
        public static function getCookieStatId()
        {
            if (empty(self::$cookie_stat_id) && isset($_COOKIE['wpadm_stat_id'])) {
                self::setCookieStatId($_COOKIE['wpadm_stat_id']);
            } elseif (!isset($_COOKIE['wpadm_stat_id'])) {
                self::generateCookieStatId();
            }
    
            return self::$cookie_stat_id;
        }
    
    
        /**
         * Adds an invisible image on the page
         * Need to obtain the user's screen resolution
         * @return string
         */
        public static function generate_js_for_page() {
            $js = '<img id="wpadm_img_stat_counter" style=\'display: none;\' src=\''.plugins_url( 'wpadm/img/spacer.gif' ).'\'>' . "\n";
            $js .= '<script type="text/javascript">';
    
            // Add cookies to mark visitor
            // Need to count unique visitors
            $send_full_info = 0;
            if (!isset($_COOKIE['wpadm_stat_id'])) {
                $stat_id = self::getCookieStatId();
    
                $js .=
                    'var d = new Date();
                    d = new Date(d.getYear(), d.getMonth(), d.getDate(), 23, 59)
                    document.cookie = "wpadm_stat_id='.$stat_id.';expires="+d.toUTCString();' . "\n";
                $send_full_info = 1;
            }
    
            $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
            $url .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
            $url .= $_SERVER["REQUEST_URI"];
            $request = $_SERVER["REQUEST_URI"];
    
            $info = array(
                'HTTP_REFERER' => $_SERVER['HTTP_REFERER'],
                'request' => $request,
                'url' => $url
            );
            $s_info = urlencode(base64_encode(serialize($info)));
    
            $src = '"/?wpadm_i_s&';
            $src .= 'i='.$s_info;
            $src_noscript = $src;
    
            if ($send_full_info == 1) {
                $src .= '&w="+screen.width+"&h="+screen.height+"&r="+Math.random()';
            } else {
                $src .='"';
                $src_noscript = $src;
            }
    
            $js .= 'var src = ' . $src  . "\n";
            $js .= 'document.getElementById("wpadm_img_stat_counter").src=src;' ."\n";
            //$js .= 'console.log(src);' ."\n";
            $js .= '</script>' . "\n";
            $js .= '<noscript><img style=\'display: none;\' src=\''.$src_noscript.'\'></noscript>';
    
            self::setJsHasBeen(1);
            return $js;
        }
    
        /**
         * @param boolean $js_has_been
         */
        public static function setJsHasBeen($js_has_been)
        {
            self::$js_has_been = $js_has_been;
        }
    
        /**
         * @return boolean
         */
        public static function getJsHasBeen()
        {
            return self::$js_has_been;
        }
    }
}