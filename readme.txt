=== Device Mockup Shortcodes ===
Contributors: mrdink
Tags: portfolio, shortcode, device, mockup, iphone
Requires at least: 3.0.1
Tested up to: 3.9
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Shortcodes for device mockups.

== Description ==

Shortcodes for device mockups.

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

Stacking

For stacking the devices on top of each other, add `stacked="open"` to the first device and `stacked="closed"` to the last device. You'll also need to apply the position of the inner device with `position="left"` or `position="right"`.

Example
`[device type="macbook" stacked="open"]CONTENT[/device][device type="iphone5" position="right" stacked="closed"]CONTENT[/device]`

== Installation ==

1. Upload `/device-mockups/` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Changelog ==

= 1.0 =
* Initial commit