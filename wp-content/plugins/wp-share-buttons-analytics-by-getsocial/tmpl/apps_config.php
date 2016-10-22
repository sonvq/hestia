<?php
    $plan_current = 'one';

    $plans = array(
        'Free' => 'one',
        'Starter' => 'two',
        'Growth' => 'three',
        'Insights' => 'four'
    );
    $categories = array(
        'Sharing Apps' => 'sharing',
        'Follow Apps' => 'follow',
        'Tracking & Engagement Apps' => 'tracking_engagement',
        'eCommerce & Integrations' => 'ecommerce_integrations'
    );
    $apps = array(
        'Horizontal Sharing Bar' => array(
            'file' => 'sharing-bar',
            'category' => 'sharing',
            'nocode' => false,
            'new' => false,
            'plan' => 1,
            'active' => $GS->is_active('sharing_bar'),
            'only_activate' => false,
            'href' => $GS->gs_account() . '/sites/gs-wordpress/groups/new?api_key=' . $GS->api_key . '&amp;source=wordpress' . $GS->utms('sharing-bar'),
            'desc' => "Use one of our templates or design your own social sharing bar. Customize size, shape & colour and pick from 15 social networks."
        ),
        'Mobile Sharing Bar' => array(
            'file' => 'mobile-bar',
            'category' => 'sharing',
            'nocode' => true,
            'new' => false,
            'plan' => 2,
            'active' => $GS->is_active('mobile_bar'),
            'only_activate' => false,
            'href' => $GS->gs_account() . '/sites/gs-wordpress/mobile_bar/new?api_key=' . $GS->api_key . '&amp;source=wordpress' . $GS->utms('mobile-bar'),
            "desc" => "Mobile Web is one of the fastest growing platform both in traffic and shares. Don't miss out on the opportunity to boost your traffic with our slick mobile web sharing interface. No code needed."
        ),
        'Floating Sharing Bar' => array(
            'file' => 'floating-bar',
            'category' => 'sharing',
            'nocode' => true,
            'new' => false,
            'plan' => 1,
            'active' => $GS->is_active('floating_bar'),
            'only_activate' => false,
            'href' => $GS->gs_account() . '/sites/gs-wordpress/floating_bar/new?api_key=' . $GS->api_key . '&amp;source=wordpress' . $GS->utms('floating-bar'),
            "desc" => "Use one of our templates or design your own floating sharing bar. Customize size, shape & placement and pick from 15 social networks."
        ),
        'Image Sharing' => array(
            'file' => 'image-sharing',
            'category' => 'sharing',
            'nocode' => true,
            'new' => false,
            'plan' => 2,
            'active' => $GS->is_active('image_sharing'),
            'only_activate' => false,
            'href' => $GS->gs_account() . '/sites/gs-wordpress/image_sharing/new?api_key=' . $GS->api_key . '&amp;source=wordpress' . $GS->utms('image-sharing'),
            "desc" => "Increase shares on images on your website. Great for media-based websites."
        ),
        'Copy Paste Share Tracking' => array(
            'file' => 'address-tracker',
            'category' => 'tracking_engagement',
            'nocode' => true,
            'new' => false,
            'plan' => 2,
            'active' => $GS->is_active('address_tracking'),
            'only_activate' => true,
            'href' => $GS->api_url('sites/activate/' . get_option('gs-api-key') . '/address-tracker'),
            "desc" => "Don't lose track of shares made through copying and pasting an URL on the address bar to social networks, email or other platforms."
        ),
        'Native Sharing Bar' => array(
            'file' => 'native-bar',
            'category' => 'sharing',
            'nocode' => false,
            'new' => false,
            'plan' => 1,
            'active' => $GS->is_active('native_bar'),
            'only_activate' => false,
            'href' => $GS->gs_account() . '/sites/gs-wordpress/native_bar/new?api_key=' . $GS->api_key . '&amp;source=wordpress' . $GS->utms('native-bar'),
            'desc' => "It doesn't get much more classic than this. Your native sharing buttons with tracking abilities. Great for those who want to keep it real."
        ),
        'Horizontal Follow Bar' => array(
            'file' => 'follow-bar',
            'category' => 'follow',
            'nocode' => false,
            'new' => true,
            'plan' => 1,
            'active' => $GS->is_active('follow_bar'),
            'only_activate' => false,
            'href' => $GS->gs_account() . '/sites/gs-wordpress/follow_bar/new?api_key=' . $GS->api_key . '&amp;source=wordpress' . $GS->utms('follow-bar'),
            'desc' => "Grow your follower base in Facebook, Twitter, Pinterest and more with these beautiful free follow buttons."
        ),
        'Floating Follow Bar' => array(
            'file' => 'floating-follow-bar',
            'category' => 'follow',
            'nocode' => true,
            'new' => true,
            'plan' => 1,
            'active' => $GS->is_active('floating_follow_bar'),
            'only_activate' => false,
            'href' => $GS->gs_account() . '/sites/gs-wordpress/follow_floating_bar/new?api_key=' . $GS->api_key . '&amp;source=wordpress' . $GS->utms('floating-follow-bar'),
            'desc' => "Grow your follower base in Facebook, Twitter, Pinterest and more with these beautiful free follow buttons."
        ),
        'Mobile Follow Bar' => array(
            'file' => 'mobile-follow-bar',
            'category' => 'follow',
            'nocode' => true,
            'new' => true,
            'plan' => 2,
            'active' => $GS->is_active('mobile_follow_bar'),
            'only_activate' => false,
            'href' => $GS->gs_account() . '/sites/gs-wordpress/follow_mobile_bar/new?api_key=' . $GS->api_key . '&amp;source=wordpress' . $GS->utms('mobile-follow-bar'),
            'desc' => "Don't miss out on the opportunity to convert mobile visitors into brand followers with our mobile follow buttons."
        ),
        'Welcome Bar' => array(
            'file' => 'welcome-bar',
            'category' => 'tracking_engagement',
            'nocode' => true,
            'new' => false,
            'plan' => 1,
            'active' => $GS->is_active('welcome_bar'),
            'only_activate' => false,
            'href' => $GS->gs_account() . '/sites/gs-wordpress/welcome_bars/new?api_key=' . $GS->api_key . '&amp;source=wordpress' . $GS->utms('welcome-bar'),
            "desc" => "Easily lead your visitors to a specific link. Great to generate conversions, engage with promotions and increase traffic. No code needed."
        ),
        'Subscriber Bar' => array(
            'file' => 'subscriber-bar',
            'category' => 'tracking_engagement',
            'nocode' => true,
            'new' => false,
            'plan' => 2,
            'active' => $GS->is_active('subscriber_bar'),
            'only_activate' => false,
            'href' => $GS->gs_account() . '/sites/gs-wordpress/subscribe_bars/new?api_key=' . $GS->api_key . '&amp;source=wordpress' . $GS->utms('subscriber-bar'),
            "desc" => "Easily capture emails from your visitors by providing them with an engaging top bar. Export data to your favorite CRM or e-Mail marketing software."
        ),
        'Big Total Shares Horizontal' => array(
            'file' => 'social-bar-big-counter',
            'category' => 'sharing',
            'nocode' => false,
            'new' => false,
            'plan' => 2,
            'active' => $GS->is_active('social_bar_big_counter'),
            'only_activate' => false,
            'href' => $GS->gs_account() . '/sites/gs-wordpress/big_counter_sharing_bar/new?api_key=' . $GS->api_key . '&amp;source=wordpress' . $GS->utms('social-bar-big-counter'),
            'desc' => "Increase engagement by showing the total number of shares in a big counter on the left of your horizontal share bar."
        ),
        'Big Total Shares Floating' => array(
            'file' => 'floating-bar-big-counter',
            'category' => 'sharing',
            'nocode' => true,
            'new' => false,
            'plan' => 2,
            'active' => $GS->is_active('floating_bar_big_counter'),
            'only_activate' => false,
            'href' => $GS->gs_account() . '/sites/gs-wordpress/big_counter_floating_bar/new?api_key=' . $GS->api_key . '&amp;source=wordpress' . $GS->utms('floating-bar-big-counter'),
            'desc' => "Increase engagement by showing the total number of shares in a big counter on top of your floating share bar."
        ),
        'Custom Sharing Actions' => array(
            'file' => 'custom-actions',
            'category' => 'sharing',
            'nocode' => false,
            'new' => false,
            'plan' => 1,
            'active' => $GS->is_active('custom_actions'),
            'only_activate' => false,
            'href' => $GS->gs_account() . '/sites/gs-wordpress/elements/new?api_key=' . $GS->api_key . '&amp;source=wordpress' . $GS->utms('custom-actions'),
            'desc' => "Sometimes we need to say more than a simple 'Like'. Here you'll find more than 50 custom stories such as Awesome, Wish or Love."
        ),
        'Price Alert' => array(
            'file' => 'price-alert',
            'category' => 'ecommerce_integrations',
            'nocode' => false,
            'new' => false,
            'plan' => 2,
            'active' => $GS->is_active('price_alert'),
            'only_activate' => false,
            'href' => $GS->gs_account() . '/sites/gs-wordpress/price_alerts/new?api_key=' . $GS->api_key . '&amp;source=wordpress' . $GS->utms('price-alert'),
            'desc' => "Allow your visitors to get notified when a price drop occurs on a product they want to purchase. Increase sales and fight cart abandonment."
        ),
        'Google Analytics' => array(
            'file' => 'ga_integration',
            'category' => 'ecommerce_integrations',
            'nocode' => true,
            'new' => false,
            'plan' => 2,
            'active' => $GS->is_active('ga_integration'),
            'only_activate' => true,
            'href' => $GS->api_url('sites/activate/' . get_option('gs-api-key') . '/ga_integration'),
            'desc' => "Integrate your GetSocial sharing activity with Google Analytics and have all of your analytics in one place. No code required"
        ),
        'MailChimp' => array(
            'file' => 'mailchimp',
            'category' => 'ecommerce_integrations',
            'nocode' => true,
            'new' => true,
            'plan' => 2,
            'active' => $GS->is_active('mailchimp'),
            'only_activate' => true,
            'href' => $GS->gs_account() . 'auth/mailchimp',
            'desc' => "Automatically connect your Subscriber Bar & Price Alert features with your Mailchimp account"
        ),
    );

    $plan_class = array_values($plans);
    $plan_name = array_keys($plans);
    $plan_categories = array_values($categories);
    $plan_categories_name = array_keys($categories);

    function plan_class($plan_id) {
        global $plan_class;
        return $plan_class[$plan_id - 1];
    }

    function plan_name($plan_id) {
        global $plan_name;
        return $plan_name[$plan_id - 1];
    }
?>