=== WP-DailyBooth ===
Contributors: isharis
Tags: social, widget, shortcode, template
Tested up to: 3.1.2
Stable tag: 1.0.3

Add <a href='http://dailybooth.com'>dailybooth</a> updates to your blog posts, pages and sidebar.

== Description ==

Embed <a href='http://dailybooth.com'>dailybooth</a> updates to blog posts / pages or add them to widgetized areas such as sidebar.

This plugin is developed by <a href='http://mharis.net'>Muhammad Haris</a>. Follow him on twitter <a href='http://twitter.com/mharis'>@mharis</a>.

You can add dailybooth updates to blog posts and pages with the following shortcode:

`[dailybooth id=jon images=3 width=50 height=50 caption=false]`

You can add dailybooth updates to wordpress themes with the following template tag:

`<?php $dailyBooth = new WP_DailyBooth; $dailyBooth->images($id = 'jon', $images = '3', $width = '50', $height = '50', $caption = false); ?>`

Images, width and height paramters are optional for both the shortcode and template tag.

You can add dailybooth updates to widgetized areas such as sidebar with the included widget.

== Installation ==

1. Upload `wp-dailybooth` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Usage instructions are written under the description tab.