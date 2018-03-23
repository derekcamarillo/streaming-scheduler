/*
* Video.js Logo-overlay
* https://github.com/marufactory2/videojs-logo-overlay.git
*
* Copyright (c) 2016 marufactory
* Licensed under the Apache-2.0 license.
*/

(function(vjs) {
    'use strict';

    var default_option = {
        src: '',
        link: '#',
        linkTarget: '_blank',
        margin: 0,
        position: 'TL',
        userActive: false,
        baseMinSize: [640, 360],
        baseMaxSize: [1280, 720]
    };

    /**
     * set logo container margin
     * @param {Object} container logo image container
     * @param {Object} image     logo image element
     * @param {Object} ratio     logo image size ratio
     */
    var setMargin = function(container, settings, ratio) {
        if (ratio === null) {
            ratio = 1;
        }
        if (typeof settings.margin == 'object') {
            if (settings.margin.length > 0) { //Array
                if (settings.margin.length == 2) { //[top/bottom, right/left]
                    container.style.marginTop = container.style.marginBottom = settings.margin[0]*ratio + 'px';
                    container.style.marginRight = container.style.marginLeft = settings.margin[1]*ratio + 'px';
                } else if (settings.margin.length == 4) { //[top, right, bottom, left]
                    container.style.marginTop = settings.margin[0]*ratio + 'px';
                    container.style.marginRight = settings.margin[1]*ratio + 'px';
                    container.style.marginBottom = settings.margin[2]*ratio + 'px';
                    container.style.marginLeft = settings.margin[3]*ratio + 'px';
                }
            } else { //Object
                var dic = {'top': 'marginTop', 'bottom': 'marginBottom', 'left': 'marginLeft', 'right': 'marginRight'};
                for (var key in settings.margin) {
                    if (key === 'top' || key === 'bottom' || key === 'left' || key === 'right') {
                        container.style[dic[key]] = settings.margin[key]*ratio + 'px';
                    }
                }
            }
        } else if (typeof settings.margin == 'number') { //Number
            container.style.margin = settings.margin*ratio + 'px';
        }
    };

    /**
     * set logo image size
     * @param {Object} player    sbsplayer
     * @param {Object} container logo image container
     * @param {Object} image     logo image
     * @param {Object} settings  plugin options
     */
    var setSize = function(player, container, image, settings) {
        if (typeof settings.height !== 'undefined') {
            image.height = settings.height;
        }
        if (typeof settings.width !== 'undefined') {
            image.width = settings.width;
        }

        var org_size = [image.width, image.height],
        org_margin = [container.style.marginTop, container.style.marginRight, container.style.marginBottom, container.style.marginLeft],
        player_el = document.getElementById(player.id()).parentElement;

        //onResize handler
        window.onresize = function() {
            var ratio, ratio_w, ratio_h,
            w = player_el.offsetWidth,
            h = player_el.offsetHeight;

            if (settings.baseMinSize[0] > w || settings.baseMinSize[1] > h) {
                ratio_w = w / settings.baseMinSize[0];
                ratio_h = h / settings.baseMinSize[1];
                ratio = (ratio_w > ratio_h) ? ratio_h : ratio_w;
            } else if (settings.baseMaxSize[0] < w || settings.baseMaxSize[1] < h) {
                ratio_w = w / settings.baseMaxSize[0];
                ratio_h = h / settings.baseMaxSize[1];
                ratio = (ratio_w > ratio_h) ? ratio_w : ratio_h;
            } else {
                ratio = 1;
            }

            image.height = org_size[1] * ratio;
            image.width = org_size[0] * ratio;

            setMargin(container, settings, ratio);
        };
        window.onresize();

        player.el().appendChild(container);
    };

    /**
     * plugin initialize
     * @param  {Object} options    plugin options
     */
    var logoOverlay = function(options) {
        //merge options
        var mergeOptions = vjs.mergeOptions || vjs.util.mergeOptions,
        settings = mergeOptions(default_option, options),
        player = this;

        //set container element
        var container = document.createElement('a');
        container.id = 'logo_overlay_image_container';
        container.href = settings.link;
        container.target = settings.linkTarget;
        container.className = (settings.userActive) ? 'user-active' : 'not-active';
        container.className += ' ' + settings.position;

        //set image element
        var image = document.createElement('img');
        if (image.addEventListener) {
            image.addEventListener('load', function() {
                setSize(player, container, image, settings);
            });
        } else {
            image.attachEvent('onload', function() {
                setSize(player, container, image, settings);
            });
        }
        image.id = 'logo_overlay_image';
        image.src = settings.src;

        //add image to container
        container.appendChild(image);
    };

    vjs.plugin('logoOverlay', logoOverlay);

}(window.videojs));
