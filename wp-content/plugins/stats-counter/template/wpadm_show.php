<script src="<?php echo plugin_dir_url(__FILE__) . 'js/jquery.arcticmodal-0.3.min.js'?>" type="text/javascript"></script>
<link rel='stylesheet'  href='<?php echo plugin_dir_url(__FILE__) . 'js/jquery.arcticmodal-0.3.css'?>' type='text/css' media='all' />
<div class="wrap">
    <script>

        function blickForm(id, t)
        {
            if(t.checked == true) {
                t.checked = false;
            }
            l = jQuery('#' + id).length;
            showRegistInfo(false);
            if (l > 0) {
                blick(id);
            } 
        }
        function blick(id)
        {
            border = jQuery('#' + id).css('border-top-color');
            if (border == 'rgb(0, 150, 214)') {
                jQuery('#' + id).css({ 'border' : '10px solid #ffba00'});
            } else {
                jQuery('#' + id).css({ 'border' : '10px solid #0096d6'});
            }
            setTimeout('blick("' + id + '")', 700);
        }

        function showSettingInfo()
        {
            display = jQuery('#setting-form').css('display');
            if (display == 'none') {
                jQuery('#setting-form').show('slow');
                jQuery('#detail-show').html("Hide");
                jQuery('#stat-title-setting').css("padding" , "0px 0px");
                jQuery('#choice-icon').removeClass("dashicons-arrow-down").addClass('dashicons-arrow-up');
            } else {
                jQuery('#setting-form').hide('slow');
                jQuery('#detail-show').html("Show");
                jQuery('#stat-title-setting').css("padding" , "20px 0px");
                jQuery('#choice-icon').removeClass("dashicons-arrow-up").addClass('dashicons-arrow-down');
            }
        }
        function showRegistInfo(show)
        {
            display = jQuery('#cf_activate').css('display');
            if (display == 'none') {
                jQuery('#cf_activate').show('slow');
                jQuery('#registr-show').html("Hide");
                jQuery('#title-regisr').css("padding" , "0px 0px");
                jQuery('#registr-choice-icon').removeClass("dashicons-arrow-down").addClass('dashicons-arrow-up');
            } else {
                if (show) {
                    jQuery('#cf_activate').hide('slow');
                    jQuery('#registr-show').html("Show");
                    jQuery('#title-regisr').css("padding" , "20px 0px");
                    jQuery('#registr-choice-icon').removeClass("dashicons-arrow-up").addClass('dashicons-arrow-down');
                }
            }
        }

        function showFormPosition()
        {
            var data_request = {
                'action': 'position_form',
            };
            jQuery.arcticmodal({
                type: 'ajax',
                url: ajaxurl,
                ajax: {
                    data : data_request,
                    type: 'post',
                    cache: false,
                    dataType: 'json',
                    success: function(data, el, responce) {
                        var h = jQuery('<div id="support_form_over" class="box-modal" style="display:block;">'+responce.html+'</div>');
                        data.body.html(h);
                    }
                },
                beforeClose: function(data, el) {

                }
            });
        }
        function savePostition()
        {
            jQuery.arcticmodal('close');
        }
    </script>  
    <h2>WPADM Statistic</h2>

    <?php if (!empty($error)) {
            echo '<div class="error" style="text-align: center; color: red; font-weight:bold;">
            <p style="font-size: 16px;">
            ' . $error . '
            </p></div>'; 
    }?>
    <?php if (!empty($msg)) {
            echo '<div class="updated" style="text-align: center; color: red; font-weight:bold;">
            <p style="font-size: 16px;">
            ' . $msg . '
            </p></div>'; 
    }?>
    <?php if (!$show) {?>

        <div id="form-registr" class="stat-form-counter inline" style="border: 10px solid #0096d6;">
            <?php if (!$show_auth) { ?>
                <form method="post" action="<?php echo WPADM_URL_BASE . "user/login" ; ?>" autocomplete="off" target="_blank">
                    <input type="hidden" value="<?php echo $counter_id; ?>" name="counter">
                    <div style="text-align: center; font-size: 20px; clear: both; margin-bottom: 20px;">WPAdm Sign-In</div>
                    <div class="wpadm-registr-info" style="width: 40%;">
                        <input class="input-small" type="email" required="required" name="username" placeholder="Email" style="margin-top: 15px;">
                        <br />
                        <input class="input-small" type="password" required="required" name="password" placeholder="Password" style="margin-top: 15px;">
                        <br />
                        <input class="button-wpadm" type="submit" value="Sign-In" name="submit" style="margin-top: 20px;">
                        <br />
                    </div>
                    <div class="inline" style="width: 57%;border-left:1px solid #fff;margin-left: 0; padding-left: 10px;">
                        Enter your email and password from an account at <a href="http://www.wpadm.com" target="_blank" style="color: #fff;" >www.wpadm.com</a>.<br /> After submitting user credentials you will be redirected to your Admin area on <a href="http://www.wpadm.com" style="color: #fff;" target="_blank">www.wpadm.com</a>.
                    </div> 
                </form>
                <?php } else { ?>

                <div class="stat-wpadm-info-title" id="title-regisr" style="padding :20px 0px; margin-top:11px;">
                    Free Sign Up to use more functionality...
                </div>
                <div id="cf_activate" class="cfContentContainer" style="display: none;">
                    <form method="post" action="<?php echo admin_url( 'admin-post.php?action=wpadm_activate_plugin' )?>" >
                        <div class="stat-wpadm-registr-info" style="">
                            <table class="form-table stat-table-registr" style="">
                                <tbody>
                                    <tr valign="top">
                                        <th scope="row">
                                            <label for="email">E-mail</label>
                                        </th>
                                        <td>
                                            <input id="email" class="" type="text" name="email" value="">
                                        </td>
                                    </tr>
                                    <tr valign="top">
                                        <th scope="row">
                                            <label for="password">Password</label>
                                        </th>
                                        <td>
                                            <input id="password" class="" type="password" name="password" value="">
                                        </td>
                                    </tr>
                                    <tr valign="top">
                                        <th scope="row">
                                            <label for="password-confirm">Password confirm</label>
                                        </th>
                                        <td>
                                            <input id="password-confirm" class="" type="password" name="password-confirm" value="">
                                        </td>
                                    </tr>
                                    <tr valign="top">
                                        <th scope="row">
                                        </th>
                                        <td>
                                            <input class="button-wpadm" type="submit" value="Register & Activate" name="submit">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="stat-wpadm-info" id="registr-info" style="margin-bottom: 2px;">
                            <span style="font-weight:bold; font-size: 14px;">If you are NOT registered at WPAdm,</span> enter your email and password to use as your Account Data for authorization on WPAdm. <br /><span style="font-weight: bold;font-size: 14px;">If you already have an account at WPAdm</span> and you want to Sign-In, so please, enter your registered credential data (email and password twice).
                        </div>
                    </form>


                </div>
                <div class="clear"></div> 
                <div class="block-button-show" style="">
                    <div class="block-click" onclick="showRegistInfo(true);">
                        <span id="registr-show">Show</span>
                        <div id="registr-choice-icon" class="dashicons dashicons-arrow-down" style=""></div>
                    </div>
                </div>

                <?php } ?>
        </div>
        <div style="display: none;" id="position-code"></div>
        <div class="stat-form-counter inline stat-setting" style="border: 10px solid #0096d6;">
            <div id="stat-title-setting" style="">Counter Settings</div>
            <div id="setting-form" style="display: none;">
                <form method="post" action="">
                    <div id="preview-image" style=" ">
                        <div class="block-preview-image" style="">
                            <div class="title-preveiw-image" style="">PREVIEW</div>
                            <style>
                                #image-counter  {
                                    text-align: left;
                                    font-size: 9px;
                                    line-height: 10px;
                                    width: 88px; 
                                    height: 31px; 
                                    font-size: 9px; 
                                    border: 1px solid <?php echo $image_color_text; ?>; 
                                    color: <?php echo $image_color_text; ?> ; 
                                    background: <?php echo $image_color; ?>;
                                }
                            </style>
                            <div class="image-block" style="">
                                <div class="image-block-in" style=" ">
                                    <div id="image-counter" style="" title="WPAdm Image">
                                        <img style="" src="<?php echo plugins_url( 'wpadm-logo.png' , dirname(__FILE__) );?>">
                                        <div class="text-image-counter" style="">
                                            All&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;98762<br />
                                            Month&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1987<br />
                                            Today&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;198<br />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-block first-info-block" style="">
                        <div class="info-block-detail">
                            <input type="text" class="" id="text-color-background" name="color_image" />
                            <script>
                                jQuery(document).ready(function(){
                                    jQuery('#text-color-background').minicolors({control:"wheel", position:"bottom right", defaultValue : "<?php echo $image_color; ?>",
                                        change : function () {
                                            jQuery("#image-counter").css('background', this.value);
                                        },
                                        hide : function() {
                                            jQuery("#image-counter").css('background', this.value);
                                        }
                                    });
                                });
                            </script>
                        </div>
                        <div class="info-block-detail detail-title">
                            <label for="text-color-background">Background Color</label>
                        </div>
                        <div class="info-block-detail detail-title details-info">Counter background color</div> 
                    </div>
                    <div class="info-block">
                        <div class="info-block-detail">
                            <input type="text" class="" id="text-color-text" name="color_text" />
                            <script>
                                jQuery(document).ready(function(){
                                    jQuery('#text-color-text').minicolors({control:"wheel", position:"bottom right", defaultValue : "<?php echo $image_color_text; ?>",
                                        change : function () {
                                            jQuery("#image-counter").css({'color':this.value, 'border' : '1px solid ' + this.value})
                                        },
                                        hide : function() {
                                            jQuery("#image-counter").css({'color':this.value, 'border' : '1px solid ' + this.value})
                                        }
                                    });
                                });
                            </script>
                        </div>
                        <div class="info-block-detail detail-title">
                            <label for="text-color-text">Text Color</label>
                        </div>
                        <div class="info-block-detail detail-title details-info" style="">Counter text color</div>
                    </div>
                    <div class="info-block">
                        <div class="info-block-detail checkbox-info">
                            <input type="checkbox" value="1" name="hidden_counter" onclick="<?php if (!$show_auth) { echo ''; } else { echo "blickForm('form-registr', this);";}?>" id="hidden_counter" <?php echo ($hidden == 2) ? "checked=\"checked\" " : ""?> >
                        </div>
                        <div class="info-block-detail detail-title" >
                            <label for="hidden_counter">Hidden</label>
                        </div>
                        <div class="info-block-detail detail-title details-info" >Invisible Counter on the web page</div>
                    </div>
                    <div class="info-block">
                        <div class="info-block-detail checkbox-info">
                            <input type="checkbox" onclick="<?php if (!$show_auth) { echo ''; } else { echo "blickForm('form-registr', this);";}?>" value="1" name="password_counter" id="password_counter" <?php echo ($password_protected == 1) ? "checked=\"checked\" " : ""?> >
                        </div>
                        <div class="info-block-detail detail-title" >
                            <label for="password_counter">Password protect</label>
                        </div>
                        <div class="info-block-detail detail-title details-info" >
                            Protect Stats with Password on 
                        </div>
                        <div class="info-block-detail detail-title details-info" style="margin: 0px; float: right;">
                            <a style="color:#ffba00; " href="<?php echo SERVER_URL_VISIT_STAT . "en/$counter_id" . "0" . $hidden ; ?>" target="_blank" style="color: ;"><?php echo SERVER_URL_STAT . "/en/$counter_id" . $image . $hidden ; ?></a>
                        </div>
                    </div>
                    <div class="clear"></div>  
                    <div class="stat-setting-save">
                        <div style="float:left; margin-left: 35px;">
                            <input class="button-wpadm" onclick="showFormPosition();" value="Position" type="button" />
                        </div>
                        <input type="submit" name="send" value="Save Settings" class="button-wpadm" />
                    </div>
                </form>
            </div>
            <div class="clear"></div>  
            <div style="padding:10px; cursor: pointer; text-align: center;">
                <div style="padding-top: 10px;  font-size: 16px; border-top:1px solid #fff;" onclick="showSettingInfo();">
                    <span id="detail-show">Show</span>
                    <div id="choice-icon" class="dashicons dashicons-arrow-down" style=""></div>
                </div>
            </div>
        </div>
        <div class="clear"></div>   
        <div class="stat_block">
            <div class="stat_title">
                <?php echo "Statistic for your Counter"; ?>
            </div>
            <div class="stat_all">
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="stat">
                            </th>
                            <th class="stat">
                                <span class="header-table">Today</span><br>
                                <?php echo date("d.m.Y"); ?>
                            </th>
                            <th class="stat">
                                <span class="header-table">
                                    Week
                                </span>
                                <br>
                                <?php echo date("d.m.Y", $date_week['start_week_time']) . ' - ' . date("d.m.Y", $date_week['end_week_time']); ?>
                            </th>
                            <th class="stat">
                                <span class="header-table">
                                    Month
                                </span>
                                <br>
                                <?php echo date("F"); ?>
                            </th>
                            <th class="stat">
                                <span class="header-table">All</span>
                            </th>
                        </tr>
                        <tr >
                            <td class="stat">
                                Visitors
                            </td>
                            <td class="stat">
                                <?php
                                    echo (isset($res["stat"]['all']["all_month"][$year_now][$month_now][$start_today]) ? $res["stat"]['all']["all_month"][$year_now][$month_now][$start_today] : "0"); ?>
                            </td>
                            <td class="stat">
                                <?php echo (isset($res['stat']['week_stat']) ? $res['stat']['week_stat'] : "0"); ?> 
                            </td>
                            <td class="stat">
                                <?php 
                                    if (isset($res["stat"]['all']["all_month"][$year_now][$month_now])) {
                                        $count = 0;
                                        foreach($res["stat"]['all']["all_month"][$year_now][$month_now] as $val) {
                                            $count += $val;
                                        }
                                        echo $count;
                                    } else {
                                        echo 0;
                                    }

                                ?> 
                            </td>
                            <td class="stat">
                                <?php echo (isset($res['stat']['all']['years']) ? $res['stat']['all']['years'] : "0"); ?>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
            <?php if (isset($stat_chart_day) && count($stat_chart_day) > 0) { ?>
                <script type="text/javascript">
                    jQuery(document).ready(function() {
                        <?php 
                            $count_date = 1;
                            $c = count($stat_chart_day);
                            $count_date = ceil($c/15)+1;
                            $label = $data = "[";
                            $i = 0;
                            $exit = false;
                            foreach ($stat_chart_day as $k => $v) {
                                foreach($v as $m => $days) {
                                    foreach($days as $day => $count){
                                        if (strlen($day) == 1) {
                                            $day = "0{$day}";
                                        }
                                        if (strlen($m) == 1) {
                                            $m = "0{$m}";
                                        }
                                        $label .= "'$day.$m.$k', ";
                                        $data .= "'$count', ";
                                        if ($i == 35) {
                                            $exit = true;
                                            break;
                                        }
                                        $i++;
                                    }
                                    if($exit) {
                                        break;
                                    }
                                }
                                if($exit) {
                                    break;
                                }

                            }
                            $label = substr($label, 0, strlen($label) - 2) . ']';
                            $data = substr($data, 0, strlen($data) - 2) . ']';
                            echo 'var l = ' . $label . ";\r\n"; 
                            echo 'var d = ' . $data . ";\r\n"; 
                        ?>
                        ctx = document.getElementById("stat-days-chart").getContext("2d"); 
                        var data = {
                            labels: l,
                            datasets: [
                            {
                                label: "Visitors",
                                fillColor: "rgba(151,187,205,0.6)",
                                strokeColor: "rgba(151,187,205,1)",
                                pointColor: "rgba(151,187,205,1)",
                                pointStrokeColor: "#fff",
                                pointHighlightFill: "#fff",
                                pointHighlightStroke: "rgba(220,220,220,1)",
                                data: d
                            },

                            ]
                        };

                        var LineChart = new Chart(ctx).Line(data, {scaleGridLineColor : "rgba(0,0,0,0.5)", scaleLineColor: "rgba(0,0,0,0.6)",});

                    });


                </script>
                <?php } ?>
            <?php if (isset($stat_chart_month) && count($stat_chart_month) > 0) { ?>
                <script type="text/javascript">
                    jQuery(document).ready(function() {
                        <?php 
                            $label = $data = '[';
                            foreach ($stat_chart_month as $month => $days) {
                                $label .= "'$month', "; 
                                $data .= "'$days', "; 
                            }
                            $label = substr($label, 0, strlen($label) - 2) . ']';
                            $data = substr($data, 0, strlen($data) - 2) . ']';
                            echo 'var l = ' . $label . ";\r\n"; 
                            echo 'var d = ' . $data . ";\r\n";

                        ?>
                        ctx = document.getElementById("stat-month-chart").getContext("2d"); 
                        var data = {
                            labels: l,
                            datasets: [
                            {
                                label: "Visitors On Month",
                                fillColor: "rgba(0,242,14,0.6)",
                                strokeColor: "rgba(0,242,14,1)",
                                pointColor: "rgba(0,242,14,1)",
                                pointStrokeColor: "#fff",
                                pointHighlightFill: "#fff",
                                pointHighlightStroke: "rgba(220,220,220,1)",
                                data: d
                            },

                            ]
                        };
                        var LineChart = new Chart(ctx).Line(data, {scaleGridLineColor : "rgba(0,0,0,0.5)", scaleLineColor: "rgba(0,0,0,0.6)",});
                    });
                </script>
                <?php } ?>
            <?php
                if (isset($stat_chart_week) && count($stat_chart_week) > 0) { ?>
                <script type="text/javascript">
                    jQuery(document).ready(function() { 

                        <?php 
                            $label = $data = '[';
                            foreach ($stat_chart_week as $days => $c) {
                                $label .= "'{$days}', "; 
                                $data .= "'{$c}', "; 
                            }
                            $label = substr($label, 0, strlen($label) - 2) . ']';
                            $data = substr($data, 0, strlen($data) - 2) . ']';
                            echo 'var l = ' . $label . ";\r\n"; 
                            echo 'var d = ' . $data . ";\r\n";
                        ?>
                        ctx = document.getElementById("stat-week-chart").getContext("2d"); 
                        var data = {
                            labels: l,
                            datasets: [
                            {
                                label: "Week Visitors",
                                fillColor: "rgba(244,82,57,0.5)",
                                strokeColor: "rgba(244,82,57,0.8)",
                                highlightFill: "rgba(244,82,57,0.75)",
                                highlightStroke: "rgba(244,82,57,1)",
                                data: d
                            },

                            ]
                        };
                        var LineChart = new Chart(ctx).Bar(data, {scaleGridLineColor : "rgba(0,0,0,0.5)", scaleLineColor: "rgba(0,0,0,0.6)", scaleShowVerticalLines: false});

                    }); 

                </script>
                <?php } ?>
            <?php if (isset($browser) && count($browser) > 0) { ?>
                <script type="text/javascript">
                    jQuery(document).ready(function() { 
                        <?php 
                            $i = 0;
                            $label = $data = "[";
                            foreach ($browser['data'] as $b) {
                                $procent = round(($b['count']/$browser['max'] )*100, 2);
                                $label .= "'{$b[0]['name']}', "; 
                                $data .= "'{$procent}', ";
                                if ($i == 5) {
                                    break;
                                }
                                $i++;
                            }
                            $label = substr($label, 0, strlen($label) - 2) . ']';
                            $data = substr($data, 0, strlen($data) - 2) . ']';
                            echo 'var l = ' . $label . ";\r\n"; 
                            echo 'var d = ' . $data . ";\r\n";
                        ?>
                        ctx = document.getElementById("stat-browser-chart").getContext("2d"); 
                        var data = {
                            labels: l,
                            datasets: [
                            {
                                label: "Browser Brand",
                                fillColor: "rgba(126,0,251,0.5)",
                                strokeColor: "rgba(126,0,251,0.8)",
                                highlightFill: "rgba(126,0,251,0.75)",
                                highlightStroke: "rgba(126,0,251,1)",
                                data: d
                            },

                            ]
                        };
                        var LineChart = new Chart(ctx).Bar(data, {scaleGridLineColor : "rgba(0,0,0,0.5)", scaleLineColor: "rgba(0,0,0,0.6)",barShowStroke : false, scaleShowVerticalLines: false});

                    }); 
                </script>
                <?php } ?>
            <?php 
                if (isset($os) && count($os) > 0) { ?>
                <script type="text/javascript">
                    jQuery(document).ready(function() {
                        <?php 
                            $i = 0;
                            $label = $data = "[";
                            foreach ($os['data'] as $o) {
                                $procent = round(($o['count']/$os['max'] )*100, 2);
                                $label .= "'{$o[0]['operating_systems']}', "; 
                                $data .= "'{$procent}', ";
                                if ($i == 5) {
                                    break;
                                }
                                $i++;
                            }
                            $label = substr($label, 0, strlen($label) - 2) . ']';
                            $data = substr($data, 0, strlen($data) - 2) . ']';
                            echo 'var l = ' . $label . ";\r\n"; 
                            echo 'var d = ' . $data . ";\r\n";
                        ?>
                        ctx = document.getElementById("stat-os-chart").getContext("2d"); 
                        var data = {
                            labels: l,
                            datasets: [
                            {
                                label: "OS Brand",
                                fillColor: "rgba(251,128,4,0.5)",
                                strokeColor: "rgba(251,128,4,0.8)",
                                highlightFill: "rgba(251,128,4,0.75)",
                                highlightStroke: "rgba(251,128,4,1)",
                                data: d
                            },

                            ]
                        };
                        var LineChart = new Chart(ctx).Bar(data, {scaleGridLineColor : "rgba(0,0,0,0.5)", scaleLineColor: "rgba(0,0,0,0.6)",barShowStroke : false, scaleShowVerticalLines: false});

                    });

                </script>
                <?php } ?> 
            <?php if (isset($data_screen) && count($data_screen) > 0) { ?>
                <script type="text/javascript">
                    jQuery(document).ready(function() { 
                        <?php 
                            $i = 0;
                            $label = $data = "[";
                            foreach ($data_screen['data'] as $key => $ds) {
                                $procent = round(($ds/$data_screen['max'] )*100, 2);
                                $label .= "'{$key}', "; 
                                $data .= "'{$procent}', ";
                                if ($i == 5) {
                                    break;
                                }
                                $i++;
                            }
                            $label = substr($label, 0, strlen($label) - 2) . ']';
                            $data = substr($data, 0, strlen($data) - 2) . ']';
                            echo 'var l = ' . $label . ";\r\n"; 
                            echo 'var d = ' . $data . ";\r\n";
                        ?>
                        ctx = document.getElementById("stat-data-screen-chart").getContext("2d"); 
                        var data = {
                            labels: l,
                            datasets: [
                            {
                                label: "Statistic Data Screen",
                                fillColor: "rgba(0,7,255,0.5)",
                                strokeColor: "rgba(0,7,255,0.8)",
                                highlightFill: "rgba(0,7,255,0.75)",
                                highlightStroke: "rgba(0,7,255,1)",
                                data: d
                            },

                            ]
                        };
                        var LineChart = new Chart(ctx).Bar(data, {scaleGridLineColor : "rgba(0,0,0,0.5)", scaleLineColor: "rgba(0,0,0,0.6)",barShowStroke : false, scaleShowVerticalLines: false});
                    });
                </script>
                <?php } ?>
            <?php if (isset($data_bit) && count($data_bit) > 0) { ?>
                <script type="text/javascript">
                    jQuery(document).ready(function() { 
                        <?php 
                            $i = 0;
                            $label = $data = "["; 
                            foreach ($data_bit['data'] as $key => $db) {
                                $procent = round(($db/$data_bit['max'] )*100, 2);
                                $label .= "'{$key} bit', "; 
                                $data .= "'{$procent}', ";
                                if ($i == 5) {
                                    break;
                                }
                                $i++;
                            }
                            $label = substr($label, 0, strlen($label) - 2) . ']';
                            $data = substr($data, 0, strlen($data) - 2) . ']';
                            echo 'var l = ' . $label . ";\r\n"; 
                            echo 'var d = ' . $data . ";\r\n";
                        ?>
                        ctx = document.getElementById("stat-data-bit-chart").getContext("2d"); 
                        var data = {
                            labels: l,
                            datasets: [
                            {
                                label: "Statistic Data Bit",
                                fillColor: "rgba(32,216,83,0.5)",
                                strokeColor: "rgba(32,216,83,0.8)",
                                highlightFill: "rgba(32,216,83,0.75)",
                                highlightStroke: "rgba(32,216,83,1)",
                                data: d
                            },

                            ]
                        };
                        var LineChart = new Chart(ctx).Bar(data, {scaleGridLineColor : "rgba(0,0,0,0.5)", scaleLineColor: "rgba(0,0,0,0.6)",barShowStroke : false, scaleShowVerticalLines: false});
                    });
                </script>
                <?php } ?>
            <div class="chart-box" style="text-align: center;">
                <div class="chart-box-title">Unique Visitors</div>
                <div class="charts">
                    <canvas id="stat-days-chart" style="width: 100%; height: 250px;"></canvas>
                </div>
            </div>
            <div style="text-align: center;">
                <div class="inline" style="width: 48.0%;">
                    <div class="chart-box">
                        <div class="chart-box-title">Visitors per Mounth</div>
                        <div class="charts">
                            <canvas id="stat-month-chart" style="width: 100%; height: 250px;"></canvas>
                        </div>
                    </div>
                </div>
                <div class="inline" style="width: 48.0%;">
                    <div class="chart-box">
                        <div class="chart-box-title">Visitors per Week</div>
                        <div class="charts">
                            <canvas id="stat-week-chart" style="width: 100%; height: 250px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div style="clear: both;"></div>
            <div style="text-align: center;">
                <div class="inline" style="width: 48.0%;">
                    <div class="chart-box">
                        <div class="chart-box-title">Browser Brand</div>
                        <div class="charts">
                            <canvas id="stat-browser-chart" style="width: 100%; height: 250px;"></canvas>
                        </div>
                    </div>
                </div>
                <div class="inline" style="width: 48.0%;">
                    <div class="chart-box">
                        <div class="chart-box-title">OS Brand</div>
                        <div class="charts">
                            <canvas id="stat-os-chart" style="width: 100%; height: 250px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div style="clear: both;"></div> 
            <div style="text-align: center;">
                <div class="inline" style="width: 48.0%;">
                    <div class="chart-box">
                        <div class="chart-box-title">Statistic Data Screen</div>
                        <div class="charts">
                            <canvas id="stat-data-screen-chart" style="width: 100%; height: 250px;"></canvas>
                        </div>
                    </div>
                </div>
                <div class="inline" style="width: 48.0%;">
                    <div class="chart-box">
                        <div class="chart-box-title">Statistic Data Bit</div>
                        <div class="charts">
                            <canvas id="stat-data-bit-chart" style="width: 100%; height: 250px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div style="clear: both;"></div>
            <div align="center" style=" margin-top: 15px;">
                <?php if (isset($data_countries) && isset($data_city) && count($data_city) > 0 && count($data_countries) > 0) { ?>
                    <table class="table_stat w-4" cellspacing="1" cellpadding="2" border="0">
                        <tr>
                            <th align="center">Statistics by Country</th>
                            <th align="center">Statistics by City</th>
                        </tr>
                        <tr>
                            <td align="center" valign="top"> 
                                <?php 
                                    $i = 1;  
                                    $count = count($data_countries['data']);
                                    foreach ($data_countries['data'] as $country => $val) {

                                        $procent = round($val['count']/$data_countries['max']*100, 2) . "%";
                                        $code = strtolower($val['code']);
                                        if ($i == 1) {
                                            echo "<div id=\"ovt_country\" class=\"moovdiv\"> 
                                            <table class=\"table-stat-moovdiv\">
                                            ";
                                        }
                                    ?>
                                    <tr >
                                        <td class="w-2">
                                            <?php echo $country;?>
                                        </td>
                                        <td class="w-2">
                                            <div class="progress">
                                                <div class="progress_load" style="width: <?php echo  $procent; ?>"></div>
                                            </div>
                                        </td>
                                        <td class="w-3">
                                            <?php echo $procent; ?>
                                        </td>
                                    </tr>
                                    <?php 
                                        if ($i == 5 || $count == $i) {
                                            echo "
                                            </table>
                                            </div>";
                                            break;
                                        }
                                        $i++;
                                } ?>  

                            </td>
                            <td align="center" valign="top">
                                <?php 
                                    $i = 1;  
                                    $count = count($data_city['data']);
                                    foreach ($data_city['data'] as $city => $val) {

                                        $procent = round($val/$data_countries['max']*100, 2) . "%";

                                        if ($i == 1) {
                                            echo "<div id=\"ovt_city\" class=\"moovdiv\"> 
                                            <table class=\"table-stat-moovdiv\">
                                            ";
                                        }
                                    ?>
                                    <tr >
                                        <td class="w-2">
                                            <?php echo utf8_encode($city);?>
                                        </td>
                                        <td class="w-2">
                                            <div class="progress">
                                                <div class="progress_load" style="width: <?php echo  $procent; ?>"></div>
                                            </div>
                                        </td>
                                        <td class="w-3">
                                            <?php echo $procent; ?>
                                        </td>
                                    </tr>
                                    <?php 
                                        if ($i == 5 || $count == $i) {
                                            echo "
                                            </table>
                                            </div>";
                                            break;
                                        }
                                        $i++;
                                } ?>  
                            </td>
                        </tr>
                    </table>
                    <?php } ?>
            </div>
        </div>
        <div>
            <table class="table">
                <tr>
                    <th class="w2">Date</th>
                    <th class="w1" colspan="2">IP - Flag Counter</th>
                    <th class="w1">System</th>
                    <th class="w1">Browser</th>
                    <th class="w3">Referer</th>
                    <th class="w2">Landing Page</th>
                </tr>
                <?php if (isset($record)) {
                        $i = 0;
                        foreach($record as $key => $value){ 
                            $hash = md5($value[4].$value[3]['ip']);
                        ?>
                        <tr>
                            <td>
                                <?php echo $value[4] ?>
                            </td>
                            <td style="text-align: right; padding-right: 10px; width: 100px;">
                                <a href="javascript:void(0)" onclick="openInfoDetail('<?php echo $hash;?>')"><?php echo $value[3]['ip'];?></a>
                            </td>
                            <td style="text-align: left; width: 30px;">
                                <img src="<?php echo IMG_STAT . 'system/geo/' . $value[3]['country_code'] . '.gif'?>" alt="<?php echo $value[3]['country'];?>" title="<?php echo $value[3]['country'];?>" />
                            </td>
                            <td class="stat">
                                <img src="<?php echo IMG_STAT . $value[6]['img']; ?>" alt="<?php echo($value[6]['operating_systems']); ?>" title="<?php echo($value[6]['operating_systems']); ?>">
                            </td>
                            <td class="stat">
                                <img src="<?php echo IMG_STAT . $value[5]['img']?>" title="<?php echo $value[5]['name']; ?>" alt="<?php echo $value[5]['name']; ?>">
                            </td>
                            <td style="text-align: left;">
                                <?php 
                                    if ($value[7] == "-" && $value[9] == '') {
                                        echo "";                                           //
                                    } elseif($value[7] == "-" && $value[9] != '') {
                                        echo '<a href="' . $value[9] . '" target="_blank" title="' . $value[9] . '">' . ((isset($value[9]{81})) ? substr($value[9],0, 80) . "..." : $value[9]) . '</a>';
                                    } elseif ($value[7] != "-" && $value[8] != "") {
                                        echo '<a href="' . $value[9] . '" target="_blank" alt="' . $value[9] . '">' . $value[7] .': ' . $value[8] . '</a>';
                                    } else {
                                        echo $value[7].$value[8].$value[9];
                                    }
                                ?>
                            </td>
                            <td style="text-align: left;">
                                <?php  
                                    if (!empty($value[11]['url_landing'])) {
                                        $landing_url = (strpos($value[11]['url_landing'], "http://") === false && strpos($value[11]['url_landing'], "https://") === false) ? "http://{$value[11]['url_landing']}" : $value[11]['url_landing'];
                                        echo '<a href="' . $landing_url . '" title="' . $landing_url . '">' . $landing_url . '</a>';
                                    } else {
                                        echo "";
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr id="<?php echo $hash;?>" style="display: none; "> 
                            <td colspan="7" width="100%" style="text-align: center;">
                                <div class="info_stat_all">
                                    <table class="info">
                                        <tr style="border:0;">
                                            <td align="left" style="background:#bee7e7;">Date</td>
                                            <td align="left"><?php echo $value[4];?></td>
                                            <td align="left" style="background:#bee7e7;">Referer Searching</td> 
                                            <td align="left"><?php echo $value[7]; ?></td> 
                                        </tr>
                                        <tr style="border:0;">
                                            <td align="left" style="background:#bee7e7;">IP</td>
                                            <td align="left"><?php echo $value[3]['ip'];?></td>
                                            <td align="left" style="background:#bee7e7;">Referer Query</td> 
                                            <td align="left"><?php echo $value[8]; ?></td> 
                                        </tr>
                                        <tr style="border:0;">
                                            <td align="left" style="background:#bee7e7;">Country</td>
                                            <td align="left"><IMG src="<?php echo IMG_STAT . 'system/geo/' . $value[3]['country_code'] . '.gif';?>" alt="<?php echo $value[3]['country'];?>" title="<?php echo $value[3]['country'];?>"></td>
                                            <td align="left" style="background:#bee7e7;">Referer</td> 
                                            <td align="left"><?php echo $value[9]; ?></td>
                                        </tr>
                                        <tr style="border:0;">
                                            <td align="left" style="background:#bee7e7;">City</td>
                                            <td align="left"><?php echo $value[3]['city'];?></td>
                                            <td align="left" style="background:#bee7e7;">Landing Page</td> 
                                            <td align="left">
                                                <?php  
                                                    if (!empty($value[11]['url_landing'])) {
                                                        $landing_url = (strpos($value[11]['url_landing'], "http://") === false && strpos($value[11]['url_landing'], "https://") === false) ? "http://{$value[11]['url_landing']}" : $value[11]['url_landing'];
                                                        echo '<a href="' . $landing_url . '" title="' . $landing_url . '">' . $landing_url . '</a>';
                                                    } else {
                                                        echo "-";
                                                    }
                                                ?>
                                            </td> 

                                        </tr>
                                        <tr>
                                            <td align="left" style="background:#bee7e7;border:0px;">System</td>
                                            <td align="left">
                                                <img src="<?php echo IMG_STAT . $value[6]['img']; ?>" alt="<?php echo($value[6]['operating_systems']); ?>" title="<?php echo($value[6]['operating_systems']); ?>">  <?php echo($value[6]['operating_systems']); ?>
                                            </td>
                                            <td align="left" style="background:#bee7e7;border:0px;">Possible text-query</td>
                                            <td align="left"><?php echo $value[11]['text_landing']?></td>
                                        </tr>
                                        <tr>
                                            <td align="left" style="background:#bee7e7;border:0px;">Browser</td>
                                            <td align="left">
                                                <img src="<?php echo  IMG_STAT . $value[5]['img']?>" title="<?php echo $value[5]['name']; ?>" alt="<?php echo $value[5]['name']; ?>"> <?php echo str_replace("Browser ", "", $value[5]['name']); ?>
                                            </td> 
                                            <td colspan="2"></td> 
                                        </tr>
                                    </table> 
                                </div>
                            </td>
                        </tr>
                        <?php if ($i == 200) {
                                break;
                            }
                        }
                } ?>
            </table>
            <div style="text-align:center; padding: 20px; background: #fff; border-left: 1px solid #b7c6ff; border-bottom: 1px solid #b7c6ff;border-right: 1px solid #b7c6ff;">
                <input type="button" value="Open more Stats data..." class="button-wpadm" onclick="window.open('<?php echo SERVER_URL_VISIT_STAT . "en/$counter_id" . $image . $hidden ;?>')" />
                <span style="line-height:25px;">(will opened in new window)</span></div>
        </div>
        <?php }?>
</div>