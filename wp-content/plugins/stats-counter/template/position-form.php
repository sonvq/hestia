<script type="text/javascript">
    function showSidebars()
    {
        if ( jQuery("#sidebar-code").prop( 'checked' ) ) {
            jQuery("#sidebars-view").show('slow');
        } else {
            jQuery("#sidebars-view").hide('slow');
        }
    }
    function showTemplates()
    {
        if ( jQuery("#template-code").prop( 'checked' ) ) {
            jQuery("#template-view").show('slow');
        } else {
            jQuery("#template-view").hide('slow');
        }
    }
    function showManual()
    {
        if ( jQuery("#manual-code").prop( 'checked' ) ) {
            jQuery("#manual-view").show('slow');
        } else {
            jQuery("#manual-view").hide('slow');
        }
    }
    function showsView()
    {
        showSidebars();
        showTemplates();
        showManual();
    }
    function testCounter()
    {
        jQuery("#test-img-loader").css('display', 'block');
        jQuery("#status-test-counter").css('display', 'none');
        jQuery("#status-test-counter").html('');
        jQuery.ajax({
            url: ajaxurl,
            data : "action=testCounter",
            type: 'post',
            dataType: 'json',
            success: function(data) {
                jQuery("#test-img-loader").css('display', 'none');
                jQuery("#status-test-counter").css('display', 'block');
                color = 'red';
                if (data.status == 'success') {
                    color = 'green';
                }
                jQuery("#status-test-counter").css('color', color);
                jQuery("#status-test-counter").html(data.status);
            }
        });
    }
</script>
<div class="form-position">
    <form action="<?php echo admin_url( 'admin-post.php?action=savePosition' ); ?>" method="post">
        <div class="position-title">Counter implementation & counter on-page position</div>
        <div class="content">
            <div class="block-position">
                <div style="float: left;">
                    <input type="radio" name="code-add" id="autom-code" value="auto" onclick="showsView();" <?php echo (isset($insall_to['method-position']) && $insall_to['method-position'] == 'auto' ) ? 'checked="checked"' : (!isset($insall_to['method-position']) ? 'checked="checked"' : '' ); ?> /><label for="autom-code">Automatic</label>
                </div>
                <div class="text-info">
                    Automatically try to find position for Counter integration
                </div>
            </div>
            <div class="block-position">
                <div style="float: left;">
                    <div class="">
                        <input type="radio" name="code-add" id="sidebar-code" onclick="showsView();" value="sidebar" <?php echo (isset($insall_to['method-position']) && $insall_to['method-position'] == 'sidebar' ) ? 'checked="checked"' : ''; ?> /><label for="sidebar-code">Other on-page location</label>
                        <div class="view-info" id="sidebars-view" style="display: <?php echo (isset($insall_to['widget']) && isset($insall_to['method-position']) && $insall_to['method-position'] == 'sidebar' ? 'block' : 'none' )?> ;">
                            <div style="margin-left:20px;display: inline;">Select an available widget block:</div>
                            <select name="sidebar-position">
                                <?php foreach($sidebars as $sidebar) {
                                    ?>
                                    <option <?php echo (isset($insall_to['widget']) && $insall_to['widget'] == $sidebar ? 'selected="selected" ' : '' )?> value="<?php echo $sidebar?>" id="p_<?php echo $sidebar?>" ><?php echo $sidebar?></option>
                                    <?php
                                }?>
                            </select>
                        </div>
                    </div>
                </div>   
                <div class="text-info" > 
                    By open of 'Appearance' -> '<a href="<?php echo admin_url( 'widgets.php' ); ?>" target="_blank">Widgets</a>' you can move your Counter inside of selected widget
                </div>
            </div>   
            <div class="block-position">
                <div style="float: left;">
                    <div class="">
                        <input type="radio" name="code-add" id="template-code" onclick="showsView();" value="template" <?php echo (isset($insall_to['method-position']) && $insall_to['method-position'] == 'template' ) ? 'checked="checked"' : ''; ?> /><label for="template-code">Other location due theme template file</label>
                        <div class="view-info" id="template-view" style="display: <?php echo (isset($insall_to['method-position']) && $insall_to['method-position'] == 'template' ? 'block' : 'none' )?> ;">
                            <div style="margin-left:20px;display: inline;">Select an available theme template file:</div>
                            <select name="template-position">
                                <?php foreach($files as $file) {  
                                    ?>
                                    <option <?php echo (isset($insall_to['position']) && $insall_to['position'] == $file ? 'selected="selected" ' : '' )?> value="<?php echo $file?>" id="p_<?php echo $file?>" ><?php echo $file?></option>
                                    <?php
                                }?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="text-info" >
                    Automatically adding the Counter code into specified file of your theme template
                </div>
            </div>
            <div class="block-position">
                <div style="float: left;">
                    <input type="radio" name="code-add" id="manual-code" value="manual" onclick="showsView();" <?php echo (isset($insall_to['method-position']) && $insall_to['method-position'] == 'manual' ) ? 'checked="checked"' : '';?>  /><label for="manual-code">Manual installation</label>
                    <div class="view-info" id="manual-view" style="margin-top:5px;display: <?php echo (isset($insall_to['method-position']) && $insall_to['method-position'] == 'manual' ? 'block' : 'none' )?> ;">
                        <div style="margin-left:20px;">
                            <div>Please, copy this Counter code and past it <br />into HTML of your theme template</div>
                            <div style="float: left;">
                                <textarea cols="38" rows="3" onclick="this.focus();this.select();"><?php echo $code; ?></textarea>
                            </div>
                            <div style="float: left; margin-left: 2px; width: 90px; position: relative; height: 76px;">
                                <div id="status-test-counter" style="display: none; text-align: center; width: 100%;"></div>
                                <div id="test-img-loader"  style="display: none; margin-top: 5px;" >
                                    <img id="test-img-loader" src="<?php echo plugins_url('/img/loading.gif', dirname(__FILE__));?>" alt="loading" title="loading">
                                </div>
                                <div style="position: absolute; bottom: 0;">
                                    <input type="button" style="margin-left:23px;height: auto; line-height: normal;" value="test" onclick="testCounter();"  class="button button-primary" /><br />
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="text-info" >
                    If you are familiar with editing HTML, copy the Counter code and simply paste it into the source code of your theme template 
                </div>

            </div>

            <div class="button-save">
                <input type="submit" style="font-size: 20px; font-weight: 800; height: 30px; width: 70px;" value="Save" class="button-wpadm" />
                <input style="margin-left: 20px; height: 30px; width: 70px;" type="button" value="Cancel" class="button-wpadm" onclick="savePostition();" />
            </div>

        </div>
    </form>
</div>

    
   
    