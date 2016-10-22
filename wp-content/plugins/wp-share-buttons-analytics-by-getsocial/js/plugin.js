function forceUpdate(event){
    var data = {
        'action': 'gs_update'
    };

    // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
    jQuery.post(ajaxurl, data, function(response) { console.log('getsocial.io updated');});
}

function forceUpdateWithValues(){

    jQuery.get(jQuery('main').attr('data-href'), {}, function(response){
        var data = {
            'action': 'gs_update_with_values',
            'response': response
        };

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        jQuery.post(ajaxurl, data , function(response) {
            console.log('getsocial.io updated w/values');
        });
    });
}

var getsocial_window;

jQuery('.getsocial-tab').on('click', function(e){
    e.preventDefault();
    $this = jQuery(this);

    if(!$this.hasClass('only-activate')){
        getsocial_window = window.open($this.attr('href'));
    }
})

function handleMessage(event){
    currEvent = event.data;

    switch (currEvent){
        case 'publish':
            forceUpdate(currEvent);
            break;
        default:
            break;
    }
}

jQuery(function($){

    jQuery('#contact_us').on('click', function(e){
        e.stopPropagation();
    });

    jQuery('#api-key-form').submit(function(){
        var wp_data = jQuery(this).serialize();
        jQuery('.notification-bar').hide();


        if (validateEmail(jQuery(this).find('#gs-api-key').val())) {
            jQuery('.notification-bar').hide();
            jQuery('.notification-bar.gs-error').show().find('p').html('API KEY is not an e-mail.');
        } else {
            if(jQuery(this).find('#gs-api-key').val() == 0) {
                jQuery('.notification-bar').hide();
                jQuery('.notification-bar.gs-error').show().find('p').html('API KEY cannot be blank.');
            } else {
                if(jQuery(this).find('#gs-api-key').val().length != 20) {
                    jQuery('.notification-bar').hide();
                    jQuery('.notification-bar.gs-error').show().find('p').html('API KEY must have 20 digits.');
                } else {
                    jQuery(this).find('input').prop('disabled', true);
                    jQuery(this).find('.loading-create').addClass('active');
                    jQuery(this).find('input[type="submit"]').hide();

                    jQuery.post(document.getElementById('check-key-href').innerHTML, { api_key: jQuery(this).find('#gs-api-key').val() }, function(data){
                        if (data.success) {
                            jQuery.post( 'options.php', wp_data).success( function(response){
                                jQuery('.loading-create').removeClass('active');
                                jQuery('.notification-bar.starting').show();

                                setTimeout('window.location.reload();', 3000);
                            });
                        } else {
                            jQuery('.loading-create').removeClass('active');
                            jQuery('#api-key-form').find('input[type="submit"]').show();
                            jQuery('#api-key-form').find('input').prop('disabled', false);
                            jQuery('.notification-bar').hide();
                            jQuery('.notification-bar.gs-error').show().find('p').html('API KEY is invalid.');
                        }
                    });
                }
            }
        }

        return false;
    });

    jQuery('.create-gs-account').on('click', function(e){
        e.preventDefault();

        jQuery('.notification-bar').hide();
        jQuery('.create-gs-account').hide();
        jQuery('.loading-create').addClass('active');

        jQuery.post(jQuery(this).attr('href'), { source: 'wordpress' }, function(data){
            if(data.errors != undefined){
                jQuery('.loading-create').removeClass('active');
                jQuery('.account-info').hide();
                jQuery('.notification-bar.gs-error').show().find('p').html(data.errors[0]);
                jQuery('.api-key').show();
            } else {
                jQuery('#gs-api-key').attr('value', data.api_key);
                jQuery('#api-key-form').trigger('submit');
            }
        });
    });

    if(jQuery('.graphs').length > 0){
        var $graphs = jQuery('.graphs'),
            graph_api = $graphs.attr('data-graph-api');

        $.get(graph_api, function(data){
            $.each(['total_visits', 'total_shares', 'total_leads'], function(i,stat){
                jQuery('.'+stat).html(data[stat]);
            });
        })
    }

    jQuery(document).on('click', '.deactivate', function(e){
        e.preventDefault();

        $this = jQuery(this);

        if(confirm('Are you sure you want to deactivate the application?') == true){
            $.post($this.attr('data-disable-app'), function(data){
                if(window.location.href.match(/delete/)) {
                    window.location.reload();
                } else {
                    window.location = window.location.href+'&delete=1'
                }
            });
        }
    });

    jQuery(document).on('click', '.only-activate', function(e){

        if ($(this)[0].pathname == "/auth/mailchimp") {

            if ($(this).attr('prevent')) {
                alert("You need to install Subscriber Bar or Price Alert to work with MailChimp");
            } else {
                window.open($(this).attr('href'), '_blank')
            }
            return;
        }

        e.preventDefault();

        $.post($(this).attr('href'), function(data){
            window.location = window.location.href+'&update=1'
        });

        return false;
    });

    if (!window.addEventListener){
        window.attachEvent('onmessage', handleMessage);
    } else {
        window.addEventListener('message', handleMessage);
    }

   /** ==================================== *\
     *    HEADER SUBMENU ACTION
     * ===================================== */
    $('.submenu-link > a').on('click', function(e){
        e.stopPropagation();

        var $menu = $(this).next('.submenu-wrapper'),
            $menu_list = $menu.find('.submenu'),
            $link = $(this).closest('.submenu-link'),
            $link_list = $('.submenu-link');

        if( $menu.is(':visible') ){
            $menu_list.removeClass('active');
            $link_list.removeClass('active');
            $menu.stop().delay(200).hide(0);
        } else {
            var $link_active = $('.submenu-link.active'),
                $menu_active = $('.submenu.active');

            $menu_active.removeClass('active');
            $link_active.removeClass('active');
            $menu_active.parent().stop().delay(200).hide(0);

            $menu.stop().show();

            var $menu_height = $menu.find('.submenu').outerHeight();

            $menu.css({ height: $menu_height });
            $menu_list.addClass('active');
            $link.addClass('active');
        }
    });

    $('body').on('click', function(e) {
        var clickedElement = e.target;

        if( $(clickedElement).attr('id') !== 'help' ){
            if($('div.submenu-wrapper').is(':visible')) {
                $('.submenu.active').removeClass('active');
                $('.submenu-link.active').removeClass('active');
                $('div.submenu-wrapper').stop().delay(200).hide(0);
            }
            if( $('.uv-popover').is(':visible') ){
                $('.uv-popover').hide().removeClass().addClass('uv-popover  uv-is-hidden').removeAttr('style id');
            }
        }
    });

    /** ==================================== *\
     *    APP FILTER DROPDOWN
     * ===================================== */
    var app_title_parent = $('#app-title'),
        app_title = app_title_parent.children('span'),
        app_title_text = app_title.html();

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    function clearFilters() {
        $('div.app-link-wrapper').show();
        $('div.app-group').show();
        app_title.html(app_title_text);
        app_title_parent.removeClass('filter-on');
        $('#clear-filter').hide();
        $('div.app-grid-filter-holder a').addClass('trans');
        $('#app-finder').show();

        // update app title count
        $.each($('.app-group'), function(i, group){
            $(group).find('.app-group-title h2 span').html("(" + $(group).find('.app-link-wrapper').length + " Apps)");
        });
    }

    function filterApps() {

        var filters = [],
            title = '',
            categoryFilter = '';

        $('div.app-grid-titles-wrapper').show();
        $('div.app-link-wrapper').hide();

        $('div.app-grid-filter-holder').find('a').each(function(i, el) {
            var filter = $(el).data('filter'),
                filterIsActive = !$(el).hasClass('trans'),
                isCategoryFilter = $(el).parent().attr('id') === 'app-filter-dropdown',
                filter_name = filter === 'two' ? 'starter' : filter;

            if(typeof(filter) === 'undefined') return;

            if(filterIsActive){
                filters.push('filter-' + filter);

                if(title.length > 0) title += '<i class="fa fa-plus"></i>';

                if(isCategoryFilter) {
                    categoryFilter = filter;

                    title += '<span class="filter-primary gs-tooltip">' + capitalizeFirstLetter(filter_name) + ' Apps';
                    title += "<div>";
                    title += 'Apps that are <strong>related to ' + capitalizeFirstLetter(filter_name) + '</strong>';
                } else {
                    title += '<span class="filter-' + filter + ' gs-tooltip ' + (filter === 'nocode' ? 'nocode' : '') + '">' + capitalizeFirstLetter(filter_name) + ' Apps';
                    title += "<div>";
                    title += filter === 'nocode' ? "Apps that <strong>require no code</strong> to be installed" : "Apps that are only available in the <strong>" + capitalizeFirstLetter(filter_name)  + " Plan</strong>";
                }

                title += "</div></span>";
            }
        });

        if(filters.length > 0) {
            $('div.app-link-wrapper.' + filters.join('.')).show();
            $('div.app-link-wrapper.' + filters.join('.')).parents('.app-group').first().show();
            app_title_parent.addClass('filter-on');
            app_title.html(title.replace('_', ' '));
            $('#clear-filter').show();
            $('#app-finder').hide();
        } else {
            clearFilters();
        }

        $.each($('.app-group'), function(i, group){

            var selectedApps = $(group).find('.app-link-wrapper').filter(function () { 
                return this.style.display == 'block'; 
            });
            
            if (selectedApps.length == 0) {
                $(group).hide();
            } else {
                $(group).find('.app-group-title h2 span').html("(" + selectedApps.length + " Apps)");
            }
        });
    }

    $('div.app-grid-filter-holder').find('a:not(#app-filter):not(.gs-error)').on('click', function() {
        var enableFilter = $(this).hasClass('trans'),
            isCategoryFilter = $(this).parent().attr('id') === 'app-filter-dropdown';

        // disable other filters
        if(isCategoryFilter) {
            $('div.app-grid-filter-holder').find('a:not(#app-filter):not(.gs-error)').each(function(i, el) { $(el).addClass('trans') });
        }

        if(enableFilter) {
            $(this).removeClass('trans');

            if(isCategoryFilter) { $('#app-filter').removeClass('trans'); }
        } else {
            $(this).addClass('trans');

            if(isCategoryFilter) { $('#app-filter').addClass('trans'); }
        }

        filterApps();
    });

    $('#clear-filter').on('click', function() {
        clearFilters();
    });

    /** ==================================== *\
     *    APP GRID TOGGLE
     * ===================================== */
    if( $('.app-group').length > 0 ){
        $('.app-group-title').find('a').on('click', function(){
            var group_toggle = $(this),
                group_parent = group_toggle.closest('.app-group'),
                group_body = group_parent.find('.app-group-body');

            group_toggle.find('i').toggleClass('fa-minus-square fa-plus-square');
            group_parent.toggleClass('active');
            group_body.slideToggle(250);
        });
    }

    /** ==================================== *\
     *    ALERT CLOSE BUTTON
     * ===================================== */
    $('.alert-block').children('.close').on('click', function(){
        var wrap = $(this).closest('.alert-block');

        if(wrap.length === 1){
            wrap.remove();
        } else {
            $(this).remove();
        }
    });

    /** ==================================== *\
     *    SCROLL TO TOP
     * ===================================== */
    $('#gs-backToTop').on('click', function(){
        $('html, body').animate({ scrollTop: 0 }, 400);
    });

    /** ==================================== *\
     *    MODAL ACTION
     * ===================================== */

    var detectIE = document.addEventListener && !window.requestAnimationFrame;

    function modal(trigger) {
        jQuery(trigger).on('click', function(event){
            event.stopPropagation()
            var modal_link = jQuery(this).attr('id'),
                modal_id = jQuery('#' + modal_link + '-modal');

            if( !modal_id.hasClass('active') ){
                modal_id.removeClass('hide').addClass('active');

                if(detectIE){
                    modal_id.find('.gs-modal').css({ 'opacity' : 1 });
                }
                
                jQuery('body').addClass('no-scroll');
            }
        });
    }
    modal('#settings');

    modal('#install-ga-analytics');

    modal('#install-copy-and-share');

    modal('#install-mailchimp');

    jQuery('.modal-close').on('click', function(){
        jQuery('.modal-wrapper.active').stop().removeClass('active').addClass('rewind').delay(detectIE ? 0 : 700).queue(function(){
            jQuery(this).removeClass('rewind').addClass('hide');

            if(detectIE){
                jQuery(this).find('.gs-modal').css({ 'opacity' : 0 });
            }

            jQuery('body').removeClass('no-scroll');
            jQuery.dequeue(this);
        });
    });

    setInterval('forceUpdateWithValues()', 5000);

    function validateEmail(email) {
        var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        return re.test(email);
    }
});
