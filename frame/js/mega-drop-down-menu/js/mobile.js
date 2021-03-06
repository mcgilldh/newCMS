/*!
 * jQuery Mobile Events
 * by Ben Major (www.ben-major.co.uk)
 *
 * Copyright 2011, Ben Major
 * Licensed under the MIT License:
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 * 
 */
(function(e){function h(){var e=i();if(e!==s){s=e;n.trigger("orientationchange")}}function b(t,n,r){var i=r.type;r.type=n;e.event.dispatch.call(t,r);r.type=i}e.attrFn=e.attrFn||{};var t={swipe_h_threshold:50,swipe_v_threshold:50,taphold_threshold:750,doubletap_int:500,touch_capable:"ontouchstart"in document.documentElement&&navigator.userAgent.toLowerCase().indexOf("chrome")==-1,orientation_support:"orientation"in window&&"onorientationchange"in window,startevent:"ontouchstart"in document.documentElement&&navigator.userAgent.toLowerCase().indexOf("chrome")==-1?"touchstart":"mousedown",endevent:"ontouchstart"in document.documentElement&&navigator.userAgent.toLowerCase().indexOf("chrome")==-1?"touchend":"mouseup",moveevent:"ontouchstart"in document.documentElement&&navigator.userAgent.toLowerCase().indexOf("chrome")==-1?"touchmove":"mousemove",tapevent:"ontouchstart"in document.documentElement&&navigator.userAgent.toLowerCase().indexOf("chrome")==-1?"tap":"click",scrollevent:"ontouchstart"in document.documentElement&&navigator.userAgent.toLowerCase().indexOf("chrome")==-1?"touchmove":"scroll",hold_timer:null,tap_timer:null};e.each("tapstart tapend tap singletap doubletap taphold swipe swipeup swiperight swipedown swipeleft scrollstart scrollend orientationchange".split(" "),function(t,n){e.fn[n]=function(e){return e?this.bind(n,e):this.trigger(n)};e.attrFn[n]=true});e.event.special.tapstart={setup:function(){var n=this,r=e(n);r.bind(t.startevent,function(e){if(e.which&&e.which!==1){return false}else{b(n,"tapstart",e);return true}})}};e.event.special.tapend={setup:function(){var n=this,r=e(n);r.bind(t.endevent,function(e){b(n,"tapend",e);return true})}};e.event.special.taphold={setup:function(){var n=this,r=e(n),i,s,o={x:0,y:0};r.bind(t.startevent,function(e){if(e.which&&e.which!==1){return false}else{r.data("tapheld",false);i=e.target;o.x=e.originalEvent.targetTouches?e.originalEvent.targetTouches[0].pageX:e.pageX;o.y=e.originalEvent.targetTouches?e.originalEvent.targetTouches[0].pageY:e.pageY;t.hold_timer=window.setTimeout(function(){var t=e.originalEvent.targetTouches?e.originalEvent.targetTouches[0].pageX:e.pageX,s=e.originalEvent.targetTouches?e.originalEvent.targetTouches[0].pageY:e.pageY;if(e.target==i&&o.x==t&&o.y==s){r.data("tapheld",true);b(n,"taphold",e)}},t.taphold_threshold);return true}}).bind(t.endevent,function(){r.data("tapheld",false);window.clearTimeout(t.hold_timer)})}};e.event.special.doubletap={setup:function(){var n=this,r=e(n),i,s;r.bind(t.startevent,function(e){if(e.which&&e.which!==1){return false}else{r.data("doubletapped",false);i=e.target;return true}}).bind(t.endevent,function(e){var o=(new Date).getTime();var u=r.data("lastTouch")||o+1;var a=o-u;window.clearTimeout(s);if(a<t.doubletap_int&&a>0&&e.target==i&&a>100){r.data("doubletapped",true);window.clearTimeout(t.tap_timer);b(n,"doubletap",e)}else{r.data("lastTouch",o);s=window.setTimeout(function(e){window.clearTimeout(s)},t.doubletap_int,[e])}r.data("lastTouch",o)})}};e.event.special.singletap={setup:function(){var n=this,r=e(n),i=null,s=null,o={x:0,y:0};r.bind(t.startevent,function(e){if(e.which&&e.which!==1){return false}else{s=(new Date).getTime();i=e.target;o.x=e.originalEvent.targetTouches?e.originalEvent.targetTouches[0].pageX:e.pageX;o.y=e.originalEvent.targetTouches?e.originalEvent.targetTouches[0].pageY:e.pageY;return true}}).bind(t.endevent,function(e){if(e.target==i){end_pos_x=e.originalEvent.changedTouches?e.originalEvent.changedTouches[0].pageX:e.pageX;end_pos_y=e.originalEvent.changedTouches?e.originalEvent.changedTouches[0].pageY:e.pageY;t.tap_timer=window.setTimeout(function(){if(!r.data("doubletapped")&&!r.data("tapheld")&&o.x==end_pos_x&&o.y==end_pos_y){b(n,"singletap",e)}},t.doubletap_int)}})}};e.event.special.tap={setup:function(){var n=this,r=e(n),i=false,s=null,o,u={x:0,y:0};r.bind(t.startevent,function(e){if(e.which&&e.which!==1){return false}else{i=true;u.x=e.originalEvent.targetTouches?e.originalEvent.targetTouches[0].pageX:e.pageX;u.y=e.originalEvent.targetTouches?e.originalEvent.targetTouches[0].pageY:e.pageY;o=(new Date).getTime();s=e.target;return true}}).bind(t.endevent,function(e){var r=e.originalEvent.targetTouches?e.originalEvent.changedTouches[0].pageX:e.pageX,a=e.originalEvent.targetTouches?e.originalEvent.changedTouches[0].pageY:e.pageY;if(s==e.target&&i&&(new Date).getTime()-o<t.taphold_threshold&&u.x==r&&u.y==a){b(n,"tap",e)}})}};e.event.special.swipe={setup:function(){function u(e){s.x=e.originalEvent.targetTouches?e.originalEvent.targetTouches[0].pageX:e.pageX;s.y=e.originalEvent.targetTouches?e.originalEvent.targetTouches[0].pageY:e.pageY;o.x=s.x;o.y=s.y;i=true}function a(e){e.stopPropagation();o.x=e.originalEvent.targetTouches?e.originalEvent.targetTouches[0].pageX:e.pageX;o.y=e.originalEvent.targetTouches?e.originalEvent.targetTouches[0].pageY:e.pageY;window.clearTimeout(t.hold_timer);var n;var u=r.attr("data-xthreshold"),a=r.attr("data-ythreshold"),f=typeof u!=="undefined"&&u!==false&&parseInt(u)?parseInt(u):t.swipe_h_threshold,l=typeof a!=="undefined"&&a!==false&&parseInt(a)?parseInt(a):t.swipe_v_threshold;if(s.y>o.y&&s.y-o.y>l){n="swipeup"}if(s.x<o.x&&o.x-s.x>f){n="swiperight"}if(s.y<o.y&&o.y-s.y>l){n="swipedown"}if(s.x>o.x&&s.x-o.x>f){n="swipeleft"}if(n!=undefined&&i){s.x=0;s.y=0;o.x=0;o.y=0;r.trigger("swipe").trigger(n);i=false}}function f(e){i=false}var n=this,r=e(n),i=false,s={x:0,y:0},o={x:0,y:0};r.bind(t.startevent,u);r.bind(t.moveevent,a);r.bind(t.endevent,f)}};e.event.special.scrollstart={setup:function(){function o(e,t){i=t;b(n,i?"scrollstart":"scrollend",e)}var n=this,r=e(n),i,s;r.bind(t.scrollevent,function(e){if(!i){o(e,true)}clearTimeout(s);s=setTimeout(function(){o(e,false)},50)})}};var n=e(window),r,i,s,o,u,a={0:true,180:true};if(t.orientation_support){var f=window.innerWidth||e(window).width(),l=window.innerHeight||e(window).height(),c=50;o=f>l&&f-l>c;u=a[window.orientation];if(o&&u||!o&&!u){a={"-90":true,90:true}}}e.event.special.orientationchange=r={setup:function(){if(t.orientation_support){return false}s=i();n.bind("throttledresize",h);return true},teardown:function(){if(t.orientation_support){return false}n.unbind("throttledresize",h);return true},add:function(e){var t=e.handler;e.handler=function(e){e.orientation=i();return t.apply(this,arguments)}}};e.event.special.orientationchange.orientation=i=function(){var e=true,n=document.documentElement;if(t.orientation_support){e=a[window.orientation]}else{e=n&&n.clientWidth/n.clientHeight<1.1}return e?"portrait":"landscape"};e.event.special.throttledresize={setup:function(){e(this).bind("resize",d)},teardown:function(){e(this).unbind("resize",d)}};var p=250,d=function(){g=(new Date).getTime();y=g-v;if(y>=p){v=g;e(this).trigger("throttledresize")}else{if(m){window.clearTimeout(m)}m=window.setTimeout(h,p-y)}},v=0,m,g,y;e.each({scrollend:"scrollstart",swipeup:"swipe",swiperight:"swipe",swipedown:"swipe",swipeleft:"swipe"},function(t,n){e.event.special[t]={setup:function(){e(this).bind(n,e.noop)}}})})(jQuery)




jQuery.fn.megaMenu = function() {

    
    var megaMenu = $(this),
        menuItem = $(megaMenu).children('li'),
        menuItemLink = $(menuItem).children('.menuitem_drop'),
        menuDropDown = $(menuItem).children('div'),
        menuButton = $('.megamenu_button');

    if ("ontouchstart" in document.documentElement) {
        
        $(menuDropDown).css({'-webkit-transition':'none', 'transition':'none'}).hide();
        $(menuItem).css({'-webkit-transition':'none', 'transition':'none'}).addClass('noactive');

        if ($(window).width() < 768) {
            $(menuItem).hide(0);
            $(menuButton).show(0);
            $(menuButton).children('a').bind('tap', function() {
                $(menuButton).toggleClass('megamenu_button_active')
                $(menuItem).not(":eq(0)").toggle(0);
            });
        }
        
        $(menuItemLink).bind('tap', function() {
                        
            var $this = $(this);
            $this.parent(menuItem).siblings().addClass('noactive').removeClass('active').find(menuDropDown).hide(0);
            $this.parent(menuItem).toggleClass('active noactive').find(menuDropDown)
                .delay(300)
                .toggle(0);
            
        });
            
    }

    
}


$(document).ready(function($){

    $('.megamenu').megaMenu();
    
    var optionsForm = {target:'#alert'}; 
    $('#contactForm').ajaxForm(optionsForm); 

});
