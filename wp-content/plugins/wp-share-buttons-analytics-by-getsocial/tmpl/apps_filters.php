<div id="app-grid-filters">
    <div class="app-grid-filter-holder">
        <a href="javascript:void(0)" id="clear-filter" class="gs-button gs-error trans" style="display: none"><i class="fa fa-times-circle"></i> Clear filter</a>

        <?php if ($plan_current == 'one'): ?>
            <a href="javascript:void(0)" class="gs-button plan-two trans gs-tooltip" data-filter="two">Starter Apps <div>Apps that are only available in the <strong>Starter Plan</strong></div></a>
        <?php endif; ?>

        <a href="javascript:void(0)" class="gs-button gs-success nocode trans gs-tooltip" data-filter="nocode">No Code <div>Apps that <strong>require no code</strong> to be installed</div></a>
        <a href="javascript:void(0)" id="app-filter" class="gs-button gs-primary trans"><i class="fa fa-filter"></i> Category</a>
        <div id="app-filter-dropdown">
            <a href="javascript:void(0)" class="gs-button gs-primary trans filter-btn js-app-one" data-filter="sharing">Sharing Apps</a>
            <a href="javascript:void(0)" class="gs-button gs-primary trans filter-btn js-app-one" data-filter="follow">Follow Apps</a>
            <a href="javascript:void(0)" class="gs-button gs-primary trans filter-btn js-app-one" data-filter="tracking_engagement">Tracking & Engagement Apps</a>
            <a href="javascript:void(0)" class="gs-button gs-primary trans filter-btn js-app-nocode" data-filter="ecommerce_integrations">eCommerce & Integrations</a>
        </div>
    </div>
</div>