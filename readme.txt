=== Device Mockups ===
Contributors: mrdink
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=9CZ54JHH93S2Y
Tags: portfolio, shortcode, device, mockup, iphone, responsive
Requires at least: 3.0.1
Tested up to: 3.9
Stable tag: 1.1.8
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Shortcodes for responsive device mockups.

== Description ==

Device Mockups is a collection of shortcodes to display screenshots, videos, or any content within a responsive device.

= Attributes: =
* color: black/white
* orientation: portrait/landscape
* stacked: open/closed
* position: left/right
* link
* width

= Recommended Image Sizes: =
* iPhone 5 - 640×1136
* iPad - 2048×1536
* iMac - 1920x1200
* Macbook Pro (Retina) - 1440x900
* Galaxy S3 - 720x1280
* Nexus 7 - 1920x1200
* Surface - 1920 x 1080
* Lumia 920 - 768 x 1280

Note that these are only recommendations.

= Stacking: =
For stacking the devices on top of each other, add `stacked="open"` to the first device and `stacked="closed"` to the last device. You'll also need to apply the position of the inner device with `position="left"` or `position="right"`.

= Example: =
`[device type="macbook" stacked="open"]CONTENT[/device][device type="iphone5" position="right" stacked="closed"]CONTENT[/device]`

= Usage: =
`[device type="iphone5"]
iPhone Content
[/device]`

`[device type="ipad"]
iPad Content
[/device]`

`[device type="imac"]
iMac Content
[/device]`

`[device type="macbook"]
Macbook Content
[/device]`

`[device type="s3"]
Galaxy S3 Content
[/device]`

`[device type="nexus7"]
Nexus 7 Content
[/device]`

`[device type="surface"]
Surface Content
[/device]`

`[device type="lumia920"]
Lumia 920 Content
[/device]`

Please help by reporting any bugs/feature request at the link below.

= Bugs: =
* Report at: [Github Issue Tracker](https://github.com/mrdink/device-mockups/issues)

= Questions/Comments: =
* http://byjust.in/contact/

= Credit: =
* [Pixelsign](http://aarnis.com/)

== Installation ==

1. Upload `/device-mockups/` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Screenshots ==

1. Stacked option
2. TinyMCE shortcode generator

== Changelog ==

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
