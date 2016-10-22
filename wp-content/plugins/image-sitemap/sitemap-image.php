<?php
/*
Plugin Name: Image Sitemap
Plugin URI: http://teguh.website
Description: Generate the sitemap then submit the sitemap to webmaster tools to get high traffics from image search engine. Open the <a href="tools.php?page=image-sitemap-generate-page">settings page</a> to generate your image sitemap. This Image Sitemap is mixing of code from Google XML Sitemap for Images (creator: Amit Agarwal) and XML Image Sitemap (creator: Eric Nagel). 
Author: Prayoga Teguh
Version: 1.3
Author URI: http://teguh.website
*/

add_action('admin_menu', 'teguh_image_sitemap');

function teguh_image_sitemap() {
    if(function_exists('add_submenu_page')) add_submenu_page('tools.php', __('Image Sitemap', 'image-sitemap'),
	    __('Image Sitemap', 'image-sitemap'), 'manage_options', 'image-sitemap-generate-page', 'image_sitemap_generate');
}

/* @author  VJTD3 <http://www.VJTD3.com> */
function IsImageSitemapWritable($filename) {
    if(!is_writable($filename)) {
        if(!@chmod($filename, 0666)) {
            $pathtofilename = dirname($filename);
            if(!is_writable($pathtofilename)) {
                if(!@chmod($pathtoffilename, 0666)) {
                    return false;
                }
            }
        }
    }
    return true;
}

function image_sitemap_generate () {
  if ($_POST ['submit']) {
    $st = image_sitemap_loop ();
     if (!$st) {
echo '<br /><div class="error"><h2>Oops!</h2><p>Error on generating sitemap, please check your website permission (chmod) or check that you already create a post that contain image or not. Please try it again later.</p></div>';	
exit();
}
?>

<div class="wrap">
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];
if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<div style="padding:10px 20px; background-color:#eee; font-size:.95em; font-family:Georgia;margin:20px">
  <h2>XML Sitemap for Images</h2>
  Successfully generate the sitemap. Your image sitemap is located <a href="<?php $sitemapurl = get_bloginfo('url') . "/sitemap-image.xml"; echo $sitemapurl;?>"target="_blank">here</a> please submit it to Search Engine Webmaster Tools or ping it to <a href="http://www.google.com/webmasters/sitemaps/ping?sitemap=<?php $sitemapurl = get_bloginfo('url') . "/sitemap-image.xml"; echo $sitemapurl;?>"target="_blank">google</a>, <a href="http://www.bing.com/ping?sitemap=<?php $sitemapurl = get_bloginfo('url') . "/sitemap-image.xml"; echo $sitemapurl;?>"target="_blank">bing</a>, <a href="http://blogs.yandex.ru/pings/?status=success&url=<?php $sitemapurl = get_bloginfo('url') . "/sitemap-image.xml"; echo $sitemapurl;?>"target="_blank">yandex</a>.
</div>
<?php } else { ?>
<div class="wrap">
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<div style="width:800px; padding:10px 20px; background-color:#eee; font-size:.95em; font-family:Georgia;margin:20px">
  <h2>XML Sitemap for Images</h2>
  <form id="options_form" method="post" action="">
    <div class="submit">
      <input type="submit" name="submit" id="sb_submit" value="Generate Image Sitemap" />
    </div>
  </form>
</div>
<?php }
}

function image_sitemap_loop () {
	global $wpdb;
	$posts = $wpdb->get_results("SELECT p1.* FROM $wpdb->posts p1
							LEFT JOIN $wpdb->posts p2 on p2.ID=p1.post_parent
							WHERE p1.post_type = 'attachment' and p2.post_status = 'publish'
							AND p1.post_mime_type like 'image%'
							ORDER BY p1.post_date desc");

	if (empty ($posts)) {
	   return false;
	} else {
          $xml   = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
		  $xml  .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n";

		  $thisPostID = 0;
		  
          foreach ($posts as $post) {
		if ($post->post_parent != 0) {
			$permalink = get_permalink($post->post_parent);
			if (strstr($permalink, '/?attachment_id=') === false) {
				if ($thisPostID != $post->post_parent) {

					if ($thisPostID != 0) {
						// Close the previous one
						$xml .= "</url>\n";
					} // ends if ($thisPostID != 0)

					$xml .= "<url>\n";
					$xml .= "\t<loc>$permalink</loc>\n";

					$thisPostID = $post->post_parent;
				} // ends if ($thisPostID != $post->post_parent)

				$xml .= "\t<image:image>\n";
				$xml .= " \t\t<image:loc>" . $post->guid . "</image:loc>\n";
				if (!empty($post->post_excerpt)) {
					$xml .= " \t\t<image:caption>" . htmlspecialchars($post->post_excerpt, ENT_COMPAT, 'UTF-8') . "</image:caption>\n";
				} // ends if (!empty($post->post_excerpt))
				elseif (!empty($post->post_title)) {
					$xml .= " \t\t<image:caption>" . htmlspecialchars($post->post_title, ENT_COMPAT, 'UTF-8') . "</image:caption>\n";
				} // ends if (!empty($post->post_title))
				$xml .= "\t</image:image>\n";
			} // ends if (!$permalink)
		} // ends if ($post->post_parent != 0)
	} // ends foreach ($posts as $post)

	$xml .= "</url>\n";
	$xml .= "\n</urlset>";
        }

        $image_sitemap_url = $_SERVER["DOCUMENT_ROOT"].'/sitemap-image.xml';
        if(IsImageSitemapWritable($_SERVER["DOCUMENT_ROOT"]) || IsImageSitemapWritable($image_sitemap_url)) {
            if(file_put_contents($image_sitemap_url, $xml)) {
                   return true;
            }
        }
   return false;
 }
?>