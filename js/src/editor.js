(function () {
    tinymce.PluginManager.add('device_mockups_tc_button', function (editor, url) {
        editor.addButton('device_mockups_tc_button', {
            title: 'Device Mockup',
            type: 'menubutton',
            icon: 'icon dashicons-smartphone',
            menu: [

                // Device
                {
                    text: 'Device',
                    onclick: function () {
                        editor.windowManager.open({
                            title: 'Add a device',
                            body: [
                                {
                                    type: 'textbox',
                                    name: 'link',
                                    label: 'Link'
                                },
                                {
                                    type: 'listbox',
                                    name: 'type',
                                    label: 'Type',
                                    'values': [
                                        {text: '', value: ''},
                                        {text: 'iPhone 6', value: 'iphone6'},
                                        {text: 'iPhone 6 Plus', value: 'iphone6-plus'},
                                        {text: 'iPhone 5s', value: 'iphone5s'},
                                        {text: 'iPhone 5', value: 'iphone5'},
                                        {text: 'iPad', value: 'ipad'},
                                        {text: 'iMac', value: 'imac'},
                                        {text: 'Macbook Pro', value: 'macbook'},
                                        {text: 'Galaxy S3', value: 's3'},
                                        {text: 'Nexus 7', value: 'nexus'},
                                        {text: 'Surface', value: 'surface'},
                                        {text: 'Lumia 920', value: 'lumia920'}
                                    ]
                                },
                                {
                                    type: 'listbox',
                                    name: 'color',
                                    label: 'Color',
                                    'values': [
                                        {text: '', value: ''},
                                        {text: 'Black', value: 'black'},
                                        {text: 'White', value: 'white'},
                                        {text: 'Gold', value: 'gold'},
                                        {text: 'Silver', value: 'silver'}
                                    ]
                                },
                                {
                                    type: 'listbox',
                                    name: 'orientation',
                                    label: 'Orientation',
                                    'values': [
                                        {text: '', value: ''},
                                        {text: 'Portrait', value: 'portrait'},
                                        {text: 'Landscape', value: 'landscape'}
                                    ]
                                },
                                {
                                    type: 'textbox',
                                    name: 'width',
                                    label: 'Width'
                                },
                                {
                                    type: 'textbox',
                                    name: 'content',
                                    label: 'Content'
                                }],
                            onsubmit: function (e) {
                                editor.insertContent('[device link="' + e.data.link + '" type="' + e.data.type + '" color="' + e.data.color + '" orientation="' + e.data.orientation + '" width="' + e.data.width + '"]' + e.data.content + '[/device]');
                            }
                        });
                    }
                },

                // Browser
                {
                    text: 'Browser',
                    onclick: function () {
                        editor.windowManager.open({
                            title: 'Add a browser',
                            body: [
                                {
                                    type: 'textbox',
                                    name: 'link',
                                    label: 'Link'
                                },
                                {
                                    type: 'listbox',
                                    name: 'type',
                                    label: 'Type',
                                    'values': [
                                        {text: '', value: ''},
                                        {text: 'Chrome', value: 'chrome'},
                                        {text: 'Firefox', value: 'firefox'},
                                        {text: 'Safari', value: 'safari'}
                                    ]
                                },
                                {
                                    type: 'textbox',
                                    name: 'width',
                                    label: 'Width'
                                },
                                {
                                    type: 'textbox',
                                    name: 'content',
                                    label: 'Content'
                                }],
                            onsubmit: function (e) {
                                editor.insertContent('[browser link="' + e.data.link + '" type="' + e.data.type + '" width="' + e.data.width + '"]' + e.data.content + '[/browser]');
                            }
                        });
                    }
                },
            ]
        });
    });
})();