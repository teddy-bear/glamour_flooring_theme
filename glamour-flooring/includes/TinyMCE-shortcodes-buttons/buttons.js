/**
 * TinyMCE Body types
 * @link http://stackoverflow.com/questions/24871792/tinymce-api-v4-windowmanager-open-what-widgets-can-i-configure-for-the-body-op
 */
(function () {
    /* Register the buttons */
    tinymce.create('tinymce.plugins.buttons', {
        init: function (editor, url) {
            /**
             * Content.
             */
            editor.addButton('add_content', {
                title: 'Add content',
                icon: 'dashicon dashicons-book',
                onclick: function () {
                    editor.windowManager.open({
                        title: 'Display content',
                        body: [
                            // Post type
                            {
                                type: 'listbox',
                                name: 'post_type',
                                label: 'Post type slug',
                                values: window.postTypes
                            },
                            // Category
                            {
                                type: 'textbox',
                                name: 'category',
                                label: 'Post category ID'
                            },
                            // Custom category
                            {
                                type: 'textbox',
                                name: 'custom_category',
                                label: 'Custom post type category name'
                            },
                            // Order by
                            {
                                type: 'listbox',
                                name: 'orderby',
                                label: 'Order by',
                                values: [
                                    {text: 'creation date', value: 'date'},
                                    {text: 'title', value: 'title'},
                                    {text: 'modified date', value: 'modified'},
                                    {text: 'random', value: 'rand'},
                                    {text: 'menu order', value: 'menu_order'}
                                ]
                            },
                            // Layout
                            {
                                type: 'listbox',
                                name: 'layout',
                                label: 'Layout',
                                values: [
                                    {text: 'primary', value: 'primary'},
                                    {text: 'services', value: 'services'},
                                    {text: 'testimonials', value: 'testimonials'},
                                    {text: 'team', value: 'team'},
                                    {text: 'posts', value: 'posts'},
                                    {text: 'video', value: 'video'},
                                    {text: 'logo', value: 'logo'}
                                ]
                            },
                            // Items quantity
                            {
                                type: 'textbox',
                                name: 'num',
                                label: 'Items quantity'
                            },
                            // Meta
                            {
                                type: 'listbox',
                                name: 'meta',
                                label: 'Display meta information',
                                values: [
                                    {text: 'no', value: 'false'},
                                    {text: 'yes', value: 'true'}
                                ]
                            },
                            // Thumbnail
                            {
                                type: 'listbox',
                                name: 'thumb',
                                label: 'Display thumbnail',
                                values: [
                                    {text: 'no', value: 'false'},
                                    {text: 'yes', value: 'true'}
                                ]
                            },
                            // Thumbnail width
                            {
                                type: 'textbox',
                                name: 'thumb_width',
                                label: 'Thumbnail width'
                            },
                            // Thumbnail height
                            {
                                type: 'textbox',
                                name: 'thumb_height',
                                label: 'Thumbnail height'
                            },
                            // Excerpt words limit
                            {
                                type: 'textbox',
                                name: 'excerpt_count',
                                label: 'Excerpt words limit'
                            },
                            // Content words limit
                            {
                                type: 'textbox',
                                name: 'content_count',
                                label: 'Content words limit'
                            },
                            // Read more link text
                            {
                                type: 'textbox',
                                name: 'more_text_single',
                                label: 'Read more link text'
                            },
                            // Wrapper CSS class
                            {
                                type: 'textbox',
                                name: 'css_class',
                                label: 'Wrapper CSS class'
                            },
                            // Single item CSS class
                            {
                                type: 'textbox',
                                name: 'class_item',
                                label: 'Single item CSS class'
                            }


                        ],
                        onsubmit: function (e) {

                            // Hint to hide empty attributes
                            var post_type = e.data.post_type ? ' post_type="' + e.data.post_type + '"' : '';
                            var category = e.data.category ? ' category="' + e.data.category + '"' : '';
                            var custom_category = e.data.custom_category ? ' custom_category="' + e.data.custom_category + '"' : '';
                            var orderby = e.data.orderby ? ' orderby="' + e.data.orderby + '"' : '';
                            var layout = e.data.layout != 'primary' ? ' layout="' + e.data.layout + '"' : '';
                            var num = e.data.num ? ' num="' + e.data.num + '"' : '';
                            var meta = e.data.meta == 'true' ? ' meta="' + e.data.meta + '"' : '';
                            var thumb = e.data.thumb == 'true' ? ' thumb="' + e.data.thumb + '"' : '';
                            var thumb_width = e.data.thumb_width ? ' thumb_width="' + e.data.thumb_width + '"' : '';
                            var thumb_height = e.data.thumb_height ? ' thumb_height="' + e.data.thumb_height + '"' : '';
                            var excerpt_count = e.data.excerpt_count ? ' excerpt_count="' + e.data.excerpt_count + '"' : '';
                            var content_count = e.data.content_count ? ' content_count="' + e.data.content_count + '"' : '';
                            var more_text_single = e.data.more_text_single ? ' more_text_single="' + e.data.more_text_single + '"' : '';
                            var css_class = e.data.css_class ? ' class="' + e.data.css_class + '"' : '';
                            var class_item = e.data.class_item ? ' class_item="' + e.data.class_item + '"' : '';

                            // Output shortcode
                            var content = '[content' + post_type + category + custom_category + layout + num + meta + thumb +
                                thumb_width + thumb_height + excerpt_count + content_count + more_text_single + css_class +
                                class_item + orderby + ']';
                            editor.insertContent(content);
                        }
                    });
                }
            });
            /**
             * Grid elements.
             */
            editor.addButton('grid_elements', {
                title: 'Grid elements',
                type: 'menubutton',
                icon: 'dashicon dashicons-welcome-widgets-menus',
                menu: [
                    // Container
                    {
                        text: 'Container',
                        onclick: function () {
                            editor.windowManager.open({
                                title: 'Additional attributes',
                                body: [
                                    {
                                        type: 'textbox',
                                        name: 'css_class',
                                        label: 'Custom class'
                                    }
                                ],
                                onsubmit: function (e) {
                                    // Wrap selected content with tags
                                    var selected_content = tinyMCE.activeEditor.selection.getContent();
                                    if (!selected_content) {
                                        selected_content = ' ';
                                    }

                                    // Hint to hide empty attributes
                                    var css_class = e.data.css_class ? ' class="' + e.data.css_class + '"' : '';

                                    // Output shortcode
                                    var content = '[container' + css_class + ']' + selected_content + '[/container]';
                                    editor.insertContent(content);
                                }
                            });
                        }
                    },
                    // Row
                    {
                        text: 'Row',
                        onclick: function () {
                            editor.windowManager.open({
                                title: 'Additional attributes',
                                body: [
                                    {
                                        type: 'textbox',
                                        name: 'css_class',
                                        label: 'Custom class'
                                    }
                                ],
                                onsubmit: function (e) {
                                    // Wrap selected content with tags
                                    var selected_content = tinyMCE.activeEditor.selection.getContent();
                                    if (!selected_content) {
                                        selected_content = ' ';
                                    }

                                    // Hint to hide empty attributes
                                    var css_class = e.data.css_class ? ' class="' + e.data.css_class + '"' : '';

                                    // Output shortcode
                                    var content = '[row' + css_class + ']' + selected_content + '[/row]';
                                    editor.insertContent(content);
                                }
                            });
                        }
                    },
                    // Row inner
                    {
                        text: 'Row inner',
                        onclick: function () {
                            editor.windowManager.open({
                                title: 'Additional attributes',
                                body: [
                                    {
                                        type: 'textbox',
                                        name: 'css_class',
                                        label: 'Custom class'
                                    }
                                ],
                                onsubmit: function (e) {
                                    // Wrap selected content with tags
                                    var selected_content = tinyMCE.activeEditor.selection.getContent();
                                    if (!selected_content) {
                                        selected_content = ' ';
                                    }

                                    // Hint to hide empty attributes
                                    var css_class = e.data.css_class ? ' class="' + e.data.css_class + '"' : '';

                                    // Output shortcode
                                    var content = '[row_inner' + css_class + ']' + selected_content + '[/row_inner]';
                                    editor.insertContent(content);
                                }
                            });
                        }
                    },
                    // Column
                    {
                        text: 'Column',
                        onclick: function () {
                            editor.windowManager.open({
                                title: 'Insert column',
                                body: [
                                    {
                                        type: 'listbox',
                                        name: 'column_width',
                                        label: 'Column width',
                                        fixedWidth: true,
                                        //classes: 'btn widget fixed-width',
                                        'values': [
                                            {text: '1', value: '1'},
                                            {text: '2', value: '2'},
                                            {text: '3', value: '3'},
                                            {text: '4', value: '4'},
                                            {text: '5', value: '5'},
                                            {text: '6', value: '6'},
                                            {text: '7', value: '7'},
                                            {text: '8', value: '8'},
                                            {text: '9', value: '9'},
                                            {text: '10', value: '10'},
                                            {text: '11', value: '11'},
                                            {text: '12', value: '12'}
                                        ]
                                    }
                                ],
                                onsubmit: function (e) {
                                    var selected_content = tinyMCE.activeEditor.selection.getContent();
                                    if (!selected_content) {
                                        selected_content = ' ';
                                    }
                                    editor.insertContent('[column class="col-sm-' + e.data.column_width + '"] ' + selected_content + ' [/column]');
                                }
                            });
                        }
                    },
                    // Column inner
                    {
                        text: 'Column inner',
                        onclick: function () {
                            editor.windowManager.open({
                                title: 'Insert column',
                                body: [
                                    {
                                        type: 'listbox',
                                        name: 'column_width',
                                        label: 'Column width',
                                        fixedWidth: true,
                                        'values': [
                                            {text: '1', value: '1'},
                                            {text: '2', value: '2'},
                                            {text: '3', value: '3'},
                                            {text: '4', value: '4'},
                                            {text: '5', value: '5'},
                                            {text: '6', value: '6'},
                                            {text: '7', value: '7'},
                                            {text: '8', value: '8'},
                                            {text: '9', value: '9'},
                                            {text: '10', value: '10'},
                                            {text: '11', value: '11'},
                                            {text: '12', value: '12'}
                                        ]
                                    }
                                ],
                                onsubmit: function (e) {
                                    var selected_content = tinyMCE.activeEditor.selection.getContent();
                                    if (!selected_content) {
                                        selected_content = ' ';
                                    }
                                    editor.insertContent('[column_inner class="col-sm-' + e.data.column_width + '"] ' + selected_content + ' [/column_inner]');
                                }
                            });
                        }
                    },
                    // Clear
                    {
                        text: 'Clear',
                        onclick: function () {
                            editor.insertContent('<div class="clear">[clear]</div>');
                        }
                    },
                    // Spacer
                    {
                        text: 'Spacer',
                        onclick: function () {
                            editor.insertContent('<div class="spacer">[spacer]</div>');
                        }
                    }
                ]
            });
            /**
             * Boxes (wrapper, block, text).
             */
            editor.addButton('boxes', {
                // Select dropdown
                type: 'listbox',
                title: 'Add box for styling',
                text: 'Boxes',
                fixedWidth: true,
                icon: false,
                onselect: function (e) {
                },
                values: [
                    // Wrapper
                    {
                        text: 'Wrapper',
                        onclick: function () {
                            editor.windowManager.open({
                                title: 'Additional attributes',
                                body: [
                                    {
                                        type: 'textbox',
                                        name: 'css_class',
                                        label: 'Custom class'
                                    }
                                ],
                                onsubmit: function (e) {
                                    // Wrap selected content with tags
                                    var selected_content = tinyMCE.activeEditor.selection.getContent();
                                    if (!selected_content) {
                                        selected_content = ' ';
                                    }
                                    // Hint to hide empty attributes
                                    var css_class = e.data.css_class ? ' class="' + e.data.css_class + '"' : '';

                                    // Output shortcode
                                    var content = '[wrapper' + css_class + ']' + selected_content + '[/wrapper]';
                                    editor.insertContent(content);
                                }
                            });
                        }
                    },
                    // Block
                    {
                        text: 'Block',
                        onclick: function () {
                            editor.windowManager.open({
                                title: 'Additional attributes',
                                body: [
                                    {
                                        type: 'textbox',
                                        name: 'css_class',
                                        label: 'Custom class'
                                    }
                                ],
                                onsubmit: function (e) {
                                    // Wrap selected content with tags
                                    var selected_content = tinyMCE.activeEditor.selection.getContent();
                                    if (!selected_content) {
                                        selected_content = ' ';
                                    }
                                    // Hint to hide empty attributes
                                    var css_class = e.data.css_class ? ' class="' + e.data.css_class + '"' : '';

                                    // Output shortcode
                                    var content = '[block' + css_class + ']' + selected_content + '[/block]';
                                    editor.insertContent(content);
                                }
                            });
                        }
                    },
                    // Text
                    {
                        text: 'Text',
                        onclick: function () {
                            editor.windowManager.open({
                                title: 'Additional attributes',
                                body: [
                                    {
                                        type: 'textbox',
                                        name: 'css_class',
                                        label: 'Custom class'
                                    }
                                ],
                                onsubmit: function (e) {
                                    // Wrap selected content with tags
                                    var selected_content = tinyMCE.activeEditor.selection.getContent();
                                    if (!selected_content) {
                                        selected_content = ' ';
                                    }
                                    // Hint to hide empty attributes
                                    var css_class = e.data.css_class ? ' class="' + e.data.css_class + '"' : '';

                                    // Output shortcode
                                    var content = '[text' + css_class + ']' + selected_content + '[/text]';
                                    editor.insertContent(content);
                                }
                            });
                        }
                    }
                ]

            });
            /**
             * Mobile detection.
             */
            editor.addButton('mobile_detect', {
                title: 'Output content depending on browser or device type',
                type: 'menubutton',
                icon: 'dashicon dashicons-visibility',
                //text: 'Mobile detect',
                //fixedWidth: true,
                menu: [
                    // Desktops or tablets
                    {
                        text: 'Desktops or tablets',
                        //icon: 'dashicon dashicons-desktop dashicons-tablet',
                        onclick: function () {
                            // Wrap selected content with code.
                            var selected_content = tinyMCE.activeEditor.selection.getContent();
                            if (!selected_content) {
                                selected_content = ' ';
                            }
                            // Output shortcode
                            var content = '[notphone]' + selected_content + '[/notphone]';
                            editor.insertContent(content);
                        }
                    },
                    {
                        text: 'Tablet & Mobile',
                        onclick: function () {
                            // Wrap selected content with code.
                            var selected_content = tinyMCE.activeEditor.selection.getContent();
                            if (!selected_content) {
                                selected_content = ' ';
                            }
                            // Output shortcode
                            var content = '[device]' + selected_content + '[/device]';
                            editor.insertContent(content);
                        }
                    },
                    {
                        text: 'Desktop only',
                        onclick: function () {
                            // Wrap selected content with code.
                            var selected_content = tinyMCE.activeEditor.selection.getContent();
                            if (!selected_content) {
                                selected_content = ' ';
                            }
                            // Output shortcode
                            var content = '[desktop]' + selected_content + '[/desktop]';
                            editor.insertContent(content);
                        }
                    },
                    {
                        text: 'Tablet only',
                        onclick: function () {
                            // Wrap selected content with code.
                            var selected_content = tinyMCE.activeEditor.selection.getContent();
                            if (!selected_content) {
                                selected_content = ' ';
                            }
                            // Output shortcode
                            var content = '[tablet]' + selected_content + '[/tablet]';
                            editor.insertContent(content);
                        }
                    },
                    {
                        text: 'Phone only',
                        onclick: function () {
                            // Wrap selected content with code.
                            var selected_content = tinyMCE.activeEditor.selection.getContent();
                            if (!selected_content) {
                                selected_content = ' ';
                            }
                            // Output shortcode
                            var content = '[phone]' + selected_content + '[/phone]';
                            editor.insertContent(content);
                        }
                    },
                    {
                        text: 'Advanced',
                        title: 'Rules for iOS, android & miscellaneous browsers',
                        //type: 'menubutton',
                        menu: [
                            {
                                text: 'iOS devices',
                                onclick: function () {
                                    // Wrap selected content with code.
                                    var selected_content = tinyMCE.activeEditor.selection.getContent();
                                    if (!selected_content) {
                                        selected_content = ' ';
                                    }
                                    // Output shortcode
                                    var content = '[ios]' + selected_content + '[/ios]';
                                    editor.insertContent(content);
                                }
                            },
                            {
                                text: 'iPhone',
                                onclick: function () {
                                    // Wrap selected content with code.
                                    var selected_content = tinyMCE.activeEditor.selection.getContent();
                                    if (!selected_content) {
                                        selected_content = ' ';
                                    }
                                    // Output shortcode
                                    var content = '[iPhone]' + selected_content + '[/iPhone]';
                                    editor.insertContent(content);
                                }
                            },
                            {
                                text: 'iPad',
                                onclick: function () {
                                    // Wrap selected content with code.
                                    var selected_content = tinyMCE.activeEditor.selection.getContent();
                                    if (!selected_content) {
                                        selected_content = ' ';
                                    }
                                    // Output shortcode
                                    var content = '[iPad]' + selected_content + '[/iPad]';
                                    editor.insertContent(content);
                                }
                            },
                            {
                                text: 'Android devices',
                                onclick: function () {
                                    // Wrap selected content with code.
                                    var selected_content = tinyMCE.activeEditor.selection.getContent();
                                    if (!selected_content) {
                                        selected_content = ' ';
                                    }
                                    // Output shortcode
                                    var content = '[android]' + selected_content + '[/android]';
                                    editor.insertContent(content);
                                }
                            },
                            {
                                text: 'Windows mobile devices',
                                onclick: function () {
                                    // Wrap selected content with code.
                                    var selected_content = tinyMCE.activeEditor.selection.getContent();
                                    if (!selected_content) {
                                        selected_content = ' ';
                                    }
                                    // Output shortcode
                                    var content = '[windowsmobile]' + selected_content + '[/windowsmobile]';
                                    editor.insertContent(content);
                                }
                            },
                            /*
                             Mobile browsers.
                             {
                             text: 'Chrome browser',
                             onclick: function () {
                             // Wrap selected content with code.
                             var selected_content = tinyMCE.activeEditor.selection.getContent();
                             if (!selected_content) {
                             selected_content = ' ';
                             }
                             // Output shortcode
                             var content = '[chrome]' + selected_content + '[/chrome]';
                             editor.insertContent(content);
                             }
                             },
                             {
                             text: 'IE',
                             title: 'Internet Explorer browser',
                             onclick: function () {
                             // Wrap selected content with code.
                             var selected_content = tinyMCE.activeEditor.selection.getContent();
                             if (!selected_content) {
                             selected_content = ' ';
                             }
                             // Output shortcode
                             var content = '[ie]' + selected_content + '[/ie]';
                             editor.insertContent(content);
                             }
                             },
                             {
                             text: 'Firefox',
                             title: 'Firefox browser',
                             onclick: function () {
                             // Wrap selected content with code.
                             var selected_content = tinyMCE.activeEditor.selection.getContent();
                             if (!selected_content) {
                             selected_content = ' ';
                             }
                             // Output shortcode
                             var content = '[firefox]' + selected_content + '[/firefox]';
                             editor.insertContent(content);
                             }
                             },
                             {
                             text: 'Safari',
                             title: 'Safari browser',
                             onclick: function () {
                             // Wrap selected content with code.
                             var selected_content = tinyMCE.activeEditor.selection.getContent();
                             if (!selected_content) {
                             selected_content = ' ';
                             }
                             // Output shortcode
                             var content = '[safari]' + selected_content + '[/safari]';
                             editor.insertContent(content);
                             }
                             },*/
                        ]
                    }
                ]

            });
            /**
             * Table
             */
            editor.addButton('table', {
                title: 'Table',
                icon: 'dashicon dashicons-grid-view',
                onclick: function () {
                    editor.windowManager.open({
                        title: 'Additional attributes',
                        body: [
                            {
                                type: 'textbox',
                                name: 'css_class',
                                label: 'Custom class (optional)'
                            }
                        ],
                        onsubmit: function (e) {

                            // Hint to hide empty attributes
                            var css_class = e.data.css_class ? ' ' + e.data.css_class : '';

                            // Output shortcode
                            var content = '<div class="table' + css_class + '"><table width="600"><tr><th>#</th><th>Name</th><th>Type</th></tr><tr><td>01</td><td>Name 1</td><td>Type A</td></tr><tr><td>02</td><td>Name 2</td><td>Type B</td></tr><tr><td>03</td><td>Name 3</td><td>Type C</td></tr></table></div>';
                            editor.insertContent(content);
                        }
                    });
                }
            });
            /**
             * Video
             */
            editor.addButton('video', {
                title: 'Video',
                icon: 'dashicon dashicons-video-alt3',
                onclick: function () {
                    editor.windowManager.open({
                        title: 'Additional attributes',
                        body: [
                            {
                                type: 'textbox',
                                name: 'css_class',
                                label: 'Custom class (optional)'
                            },
                            {
                                type: 'textbox',
                                name: 'video_content',
                                label: 'Video code',
                                multiline: true,
                            }
                        ],
                        onsubmit: function (e) {

                            // Hint to hide empty attributes
                            var css_class = e.data.css_class ? ' ' + e.data.css_class : '';

                            var video_content = e.data.video_content;

                            // Output shortcode
                            var content = '<div class="content-video' + css_class + '">' + video_content + '</div>';
                            editor.insertContent(content);
                        }
                    });
                }
            });
            /**
             * Map
             */
            editor.addButton('map', {
                title: 'Map',
                icon: 'dashicon dashicons-location-alt',
                onclick: function () {
                    editor.windowManager.open({
                        title: 'Additional attributes',
                        body: [
                            {
                                type: 'textbox',
                                name: 'css_class',
                                label: 'Custom class (optional)'
                            },
                            {
                                type: 'textbox',
                                name: 'map_code',
                                label: 'Map iframe code',
                                multiline: true
                            }
                        ],
                        onsubmit: function (e) {

                            // Hint to hide empty attributes
                            var css_class = e.data.css_class ? ' ' + e.data.css_class : '';

                            var map_code = e.data.map_code;

                            // Output shortcode
                            var content = '<div class="block-map' + css_class + '">' + map_code + '</div>';
                            editor.insertContent(content);
                        }
                    });
                }
            });
            /**
             * Address.
             */
            editor.addButton('address', {
                title: 'Address',
                icon: 'dashicon dashicons-location',
                onclick: function () {
                    editor.insertContent('[address]');
                }
            });
            /**
             * Phone.
             */
            editor.addButton('phone', {
                title: 'Phone',
                icon: 'dashicon dashicons-phone',
                onclick: function () {
                    editor.insertContent('[phone-number]');
                }
            });
            /**
             * Email.
             */
            editor.addButton('email', {
                title: 'Email',
                icon: 'dashicon dashicons-email-alt',
                onclick: function () {
                    editor.insertContent('[email]');
                }
            });
            /**
             * CSS Classes.
             */
            editor.addButton('classes', {
                title: 'Add styles to elements',
                type: 'menubutton',
                icon: 'dashicon dashicons-admin-generic',
                menu: [
                    // Default button
                    {
                        text: 'Default button',
                        onclick: function () {
                            tinyMCE.activeEditor.dom.toggleClass(tinyMCE.activeEditor.selection.getNode(), 'btn');
                        }
                    },
                    // Button large
                    {
                        text: 'Button large',
                        onclick: function () {
                            tinyMCE.activeEditor.dom.toggleClass(tinyMCE.activeEditor.selection.getNode(), 'btn-large');
                        }
                    },
                    // Custom button
                    /*					{
                     text: 'Custom button',
                     onclick: function () {
                     tinyMCE.activeEditor.dom.toggleClass(tinyMCE.activeEditor.selection.getNode(), 'btn-custom');
                     }
                     },*/
                    // Read more
                    {
                        text: 'Read more',
                        onclick: function () {
                            tinyMCE.activeEditor.dom.toggleClass(tinyMCE.activeEditor.selection.getNode(), 'more');
                        }
                    },
                    // List
                    {
                        text: 'List',
                        onclick: function () {
                            tinyMCE.activeEditor.dom.toggleClass(tinyMCE.activeEditor.selection.getNode(), 'list');
                        }
                    },
                    // List Custom
                    {
                        text: 'List decorated',
                        onclick: function () {
                            tinyMCE.activeEditor.dom.toggleClass(tinyMCE.activeEditor.selection.getNode(), 'list-custom');
                        }
                    }

                ]
            });
            /**
             * Sample text.
             */
            editor.addButton('lorem_ipsum', {
                title: 'insert sample text',
                icon: 'dashicon dashicons-media-text',
                //text: 'Lorem ipsum',
                onclick: function () {
                    editor.insertContent('<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id ligula nisl. Vivamus sit amet nisi metus. Vivamus vel metus tellus. Phasellus massa ante, elementum eget erat quis, ornare imperdiet nulla. Proin elementum vitae erat ac pharetra. Fusce mollis diam sit amet dui condimentum, a tristique nisl semper. Aenean a metus id orci vulputate suscipit nec id dolor.</p>' +
                        '<p>Proin vitae eleifend ipsum. In hac habitasse platea dictumst. Integer sodales a erat quis porta. Proin fringilla consectetur mi non mattis. Vivamus tincidunt arcu velit, ut tristique libero porta at. Phasellus lorem nulla, fringilla id bibendum id, aliquet nec nisi. In at gravida odio, eget sollicitudin tortor.</p>' +
                        '<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi nec finibus elit. Ut at tortor luctus metus posuere tempus in id est. Nunc molestie gravida laoreet. Morbi pulvinar magna vitae justo pretium, quis ultrices lorem porttitor. Fusce a libero arcu. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla facilisi. Donec auctor eros at tempor laoreet. Curabitur rhoncus rhoncus odio.</p>' +
                        '<p>Aliquam luctus neque dolor, a molestie odio cursus eget. Sed et sollicitudin lorem, nec elementum ex. Fusce tristique faucibus lacus sed suscipit. Integer aliquet augue in enim imperdiet, nec commodo velit dictum. Vivamus at pharetra lectus, a ultrices sem. Aliquam purus dui, porta a mauris in, laoreet pellentesque urna. Sed quis volutpat nibh, sed egestas lacus. Duis scelerisque justo id ullamcorper dignissim. Donec eget arcu eget tortor cursus porttitor et sed tellus. Ut non urna purus. Cras rutrum lacus quis felis posuer, elementum faucibus tortor pharetra.</p>' +
                        '<p>Phasellus auctor dignissim tortor, eget dapibus felis viverra id. Mauris quis diam a mi rhoncus condimentum id in mauris. Curabitur id ex ligula. Nullam vehicula tortor eget massa aliquet, vitae imperdiet augue mollis. Suspendisse ut nibh viverra, scelerisque nibh eu, molestie quam. Donec facilisis finibus sapien nec feugiat. Maecenas vulputate, turpis sed interdum vestibulum, libero quam euismod libero, nec hendrerit arcu sem ut nulla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Curabitur vehicula dolor ac nisl eleifend faucibus. Etiam vitae lectus dui. Ut ex arcu, accumsan eu pulvinar nec, auctor sed nisl. Nunc finibus imperdiet mi, id porta mauris sollicitudin id.</p>');
                }
            });
        }
    });
    /* Start the buttons */
    tinymce.PluginManager.add('custom_buttons', tinymce.plugins.buttons);
})();