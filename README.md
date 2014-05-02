# Device Mockups

WordPress shortcodes for [Pixelsign's device mockups](http://aarnis.com/)

### Device Examples

```
[device type="iphone5"]
iPhone Content
[/device]
```

```
[device type="ipad"]
iPad Content
[/device]
```

```
[device type="imac"]
iMac Content
[/device]
```

```
[device type="macbook"]
Macbook Content
[/device]
```

```
[device type="s3"]
Galaxy S3 Content
[/device]
``

```
[device type="nexus7"]
Nexus 7 Content
[/device]
```

```
[device type="surface"]
Surface Content
[/device]
```

```
[device type="lumia920"]
Lumia 920 Content
[/device]
```

### Stacking

For stacking the devices on top of each other, add `stacked="open"` to the first device and `stacked="closed"` to the last device. You'll also need to apply the position of the inner device with `position="left"` or `position="right"`.

Example
```
[device type="macbook" stacked="open"]
CONTENT
[/device]
[device type="iphone5" position="right" stacked="closed"]
CONTENT
[/device]
```

### Attributes
- color: black/white
- orientation: portrait/landscape
- stacked: open/closed
- position: left/right

---
#### Forked from

https://github.com/pixelsign/html5-device-mockups