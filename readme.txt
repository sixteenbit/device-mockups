=== Device Mockups ===
Contributors: mrdink, phikai
Donate link: http://drop.byjust.in/3YqO
Tags: portfolio, shortcode, device, mockup, iphone, responsive, gallery
Requires at least: 3.0.1
Tested up to: 4.3.1
Stable tag: 1.5.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Show your work in high resolution, responsive device mockups using only shortcodes.

== Description ==
Show your work in high resolution, responsive device mockups using only shortcodes. Wrap images, videos, or any other content within a few simple shortcodes to display them within any of the pre-packaged devices mockups, which are easily selectable from within the editor.

[Device Mockups Documentation](http://dm.byjust.in)

= Available shortcodes =
* [device][/device]
* [browser][/browser]
* [dm-gallery]

= Device Attributes =
* type: imac, iphone6, iphone6-plus, iphone5s, iphone5, s3, lumia920, ipad, nexus7, or surface
* color: black, white, gold, or silver
* orientation: portrait or landscape
* stacked: open or closed
* position: left or right
* link
* width: pixels or percentage
* hide: left or right

= Browser Attributes =
* type: chrome, firefox, or safari
* link
* width: pixels or percentage

= Recommended Image Sizes =
* iPhone 6 – 1334×750
* iPhone 6 Plus – 1920×1080
* iPhone 5s – 1136×640
* iPhone 5 – 640×1136
* iPad – 2048×1536
* iMac – 1920×1200
* Macbook Pro – 1440×900
* Galaxy S3 – 720×1280
* Nexus 7 – 1920×1200
* Surface – 1920×1080
* Lumia 920 – 768×1280
* Chrome – 1440×900
* Firefox – 1440×900
* Safari – 1440×900

Please help by reporting any bugs/feature request at the link below.

= Bugs: =
* Report at: [Github Issue Tracker](https://github.com/mrdink/device-mockups/issues)

= Questions/Comments =
* https://byjust.in/contact/

== Installation ==
1. Upload `/device-mockups/` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Screenshots ==
1. Devices
2. Stacking
3. Browsers

== Changelog ==
= 1.5.2 =
* optimized output to work better with other shortcodes i.e. page builders
* removed conditional statements to check for if shortcode is used to enqueue and moved enqueue within the shortcode function
* shortcodes will work within widgets now

= 1.5.0 =
* semi-major update
* re-wrote entire code base
* styles and scripts only enqueue when shortcodes are used
* re-organized tinymce button
* switched to slick.js for gallery slider
* added internalization

= 1.4.2 =
* pull request from @irazasyed to fix the custom url to the plugin dir
* removed README.md

= 1.4.0 =
* added FlexSlider
* fixed a CSS  issues with iPhone 6
* fixed stacking button in editor
* reverted to node-sass
* updated file structure

= 1.3.1 =
* URL fix in the readme.txt
* image optimization

= 1.3.0 =
* added iPhone 6, iPhone 6 Plus, and iPhone 5s
* added an attribute to hide the left or right of the device (currently doesn't work with stacking) - idea credit to @raphaelkross
* added browsers (chrome, firefox, and safari)
* added hiding but currently in beta
* added documentation link to plugin
* and much more

= 1.2.1 =
* added icons to support WP 4.0 installer (Created by @timm3h)
* added more browser prefixes

= 1.1.9 =
* fixed a bug reported by Barn2Media

= 1.1.8 =
* added width attribute. (Example width="80%" or width="400px")
* note that `width` isn't for overall width of `stacked` devices. I suggest wrapping the `stacked` items in a div and applying a max-width

= 1.1.7 =
* added the ability to wrap a link around a device screen

= 1.1.4 =
* added missing styles for stacked devices

= 1.1.3 =
* added the unminified CSS file and removed Neat
* added conditionals for data attributes
* added screenshot for shortcodes button
* added version string to CSS

= 1.1.1 =
* fixed a conditional statement that was outputting classes that weren't needed

= 1.1 =
* added TinyMCE button for predefined shortcodes

= 1.0.2 =
* formatting fixes for readme.txt :)

= 1.0.1 =
* readme.txt fixes

= 1.0 =
* Initial commit
