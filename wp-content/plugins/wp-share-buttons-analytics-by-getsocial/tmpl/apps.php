<div class="app-grid">
    <?php $i = 0; foreach($plan_categories as $cat): $count = 0; ?>
        <?php
            foreach($apps as $app => $settings):
                if($settings['category'] == $cat){ $count++; }
            endforeach;
        ?>
        <div class="app-group active">
            <div class="app-group-title">
                <h2><?php echo $plan_categories_name[$i] ?> <span>(<?php echo $count; echo $count > 1 ? ' Apps' : ' App' ?>)</span></h2>
                <a class="app-group-toggle" href="javascript:void(0)">
                    <i class="fa fa-minus-square"></i><span>Open</span>
                </a>
            </div>            
            <div class="app-group-body gs-clearfix">
                <?php foreach($apps as $app => $settings): ?>
                    <?php if($settings['category'] == $cat): ?>
                        <div class="app-link-wrapper <?php if($settings['nocode']){ echo 'filter-nocode'; } ?> filter-<?php echo plan_class($settings['plan']); ?> filter-<?php echo $settings['category']; ?>">
                            <div class="app-link">
                                <?php if ($settings['nocode']): ?>
                                    <div class="app-badge nocode">No Code</div>
                                <?php endif; ?>
                                <div class="app-badge-group">
                                    <?php if ($settings['new']): ?>
                                        <div class="app-badge new">New</div>
                                    <?php endif; ?>
                                    <?php if ($plan_current == 'one' && $settings['plan'] > 1): ?>
                                        <div class="app-badge plan-<?php echo plan_class($settings['plan']); ?>">
                                            <?php echo plan_name($settings['plan']); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="app-image">
                                    <?php if ($settings['active']): ?>
                                        <div class="installed">
                                            <span>
                                                <i class="fa fa-check-circle"></i>
                                                Installed
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                    <img src="<?php echo plugins_url('../img/apps/'.$settings['file'].'.png', __FILE__) ?>" alt="">
                                </div>
                                <div class="app-link-info">
                                    <p class="app-title"><span><?php echo $app ?></span></p>
                                    <p><?php echo $settings['desc'] ?></p>
                                </div>
                                <div class="app-link-buttons">
                                    <div>
                                        <?php if (!$settings['only_activate'] || ( isset($settings['only_activate']) && !$settings['active'] )): ?>
                                            <?php // Show modals when user is free and apps are activate only ?>
                                            <?php if (!$GS->is_pro() && $settings['only_activate']): ?> 
                                                <?php if ($app == 'Copy Paste Share Tracking'): ?>
                                                    <a id="install-copy-and-share" href="#" class="gs-button gs-primary trans border getsocial-tab only-activate">
                                                        Install App
                                                    </a>
                                                <?php endif; ?>
                                                
                                                <?php if ($app == 'Google Analytics'): ?>
                                                    <a id="install-ga-analytics" href="#" class="gs-button gs-primary trans border getsocial-tab only-activate">
                                                        Install App
                                                    </a>
                                                <?php endif; ?>
                                                
                                                <?php if ($app == 'MailChimp'): ?>
                                                    <a id="install-mailchimp" href="#" class="gs-button gs-primary trans border getsocial-tab only-activate">
                                                        Install App
                                                    </a>
                                                <?php endif; ?>
                                            <?php // Non Free users can install everything ?>
                                            <?php else: ?>
                                                <?php 
                                                // Prevent instalation of mailchimp app without Price Alert or Subscriber Bar
                                                $prevent_install = "";

                                                if ($app == 'MailChimp' && !$apps['Price Alert']['active'] && !$apps['Subscriber Bar']['active']):
                                                    $prevent_install = 'prevent="true"';
                                                endif; ?>
                                                <a href="<?php echo $settings['href'] ?>" target="<?php echo ($settings['only_activate'] && $app != 'MailChimp' ? '' : '_blank') ?>" class="gs-button gs-primary trans border getsocial-tab <?php echo ($settings['only_activate'] ? 'only-activate' : ''); ?>" <?php echo $prevent_install; ?>>
                                                    
                                                    <?php echo ($settings['active']) ? 'Edit App' : 'Install App' ?>

                                                    <?php // show woocommerce toogle in price alert ?>
                                                    <?php if ($app == 'Price Alert' && !$settings['active']): ?>
                                                        <span class="gs-tooltip">
                                                            <img src="<?php echo plugins_url('../img/woocommerce.png', __FILE__ ) ?>" alt="WooCommerce">
                                                            <div>Requires WooCommerce Plugin</div>
                                                        </span>
                                                    <?php endif; ?>                                    
                                                </a>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if ($settings['active']): ?>
                                            <a href="javascript:void(0)" class="gs-button disable trans border stop deactivate" data-disable-app="<?php echo $GS->api_url('sites/disable/'.get_option('gs-api-key').'/'.$settings['file']) ?>">
                                                Deactivate
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>

    <?php $i++; endforeach; ?>
</div>

<footer>
    <a id="gs-backToTop" href="javascript:void(0)" class="gs-button gs-primary"><i class="fa fa-angle-up"></i> Back to Top</a>

    <?php if (!$GS->is_pro()): ?>
    &nbsp;&nbsp;&nbsp;&nbsp;or&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="<?php echo $GS->gs_account() ?>/sites/gs-wordpress/billing/select_tier?api_key=<?php echo $GS->api_key ?>&amp;source=wordpress" target="_blank" class="gs-button plan-two">Upgrade to STARTER</a>
    <?php endif; ?>
</footer>
