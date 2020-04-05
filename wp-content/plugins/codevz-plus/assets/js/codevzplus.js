/* Custom easing */
!function(n){"use strict";n.easing.jswing=n.easing.swing,n.extend(n.easing,{swing:function(n,t,e,i,s){return 0==t?e:t==s?e+i:(t/=s/2)<1?i/2*Math.pow(2,10*(t-1))+e:i/2*(2-Math.pow(2,-10*--t))+e},easeInOutExpo:function(n,t,e,i,s){return 0==t?e:t==s?e+i:(t/=s/2)<1?i/2*Math.pow(2,10*(t-1))+e:i/2*(2-Math.pow(2,-10*--t))+e}})}(jQuery);

/* imagesLoaded PACKAGED v4.1.3 */
!function(e,t){"function"==typeof define&&define.amd?define("ev-emitter/ev-emitter",t):"object"==typeof module&&module.exports?module.exports=t():e.EvEmitter=t()}("undefined"!=typeof window?window:this,function(){function e(){}var t=e.prototype;return t.on=function(e,t){if(e&&t){var i=this._events=this._events||{},n=i[e]=i[e]||[];return-1==n.indexOf(t)&&n.push(t),this}},t.once=function(e,t){if(e&&t){this.on(e,t);var i=this._onceEvents=this._onceEvents||{},n=i[e]=i[e]||{};return n[t]=!0,this}},t.off=function(e,t){var i=this._events&&this._events[e];if(i&&i.length){var n=i.indexOf(t);return-1!=n&&i.splice(n,1),this}},t.emitEvent=function(e,t){var i=this._events&&this._events[e];if(i&&i.length){var n=0,o=i[n];t=t||[];for(var r=this._onceEvents&&this._onceEvents[e];o;){var s=r&&r[o];s&&(this.off(e,o),delete r[o]),o.apply(this,t),n+=s?0:1,o=i[n]}return this}},t.allOff=t.removeAllListeners=function(){delete this._events,delete this._onceEvents},e}),function(e,t){"use strict";"function"==typeof define&&define.amd?define(["ev-emitter/ev-emitter"],function(i){return t(e,i)}):"object"==typeof module&&module.exports?module.exports=t(e,require("ev-emitter")):e.imagesLoaded=t(e,e.EvEmitter)}("undefined"!=typeof window?window:this,function(e,t){function i(e,t){for(var i in t)e[i]=t[i];return e}function n(e){var t=[];if(Array.isArray(e))t=e;else if("number"==typeof e.length)for(var i=0;i<e.length;i++)t.push(e[i]);else t.push(e);return t}function o(e,t,r){return this instanceof o?("string"==typeof e&&(e=document.querySelectorAll(e)),this.elements=n(e),this.options=i({},this.options),"function"==typeof t?r=t:i(this.options,t),r&&this.on("always",r),this.getImages(),h&&(this.jqDeferred=new h.Deferred),void setTimeout(function(){this.check()}.bind(this))):new o(e,t,r)}function r(e){this.img=e}function s(e,t){this.url=e,this.element=t,this.img=new Image}var h=e.jQuery,a=e.console;o.prototype=Object.create(t.prototype),o.prototype.options={},o.prototype.getImages=function(){this.images=[],this.elements.forEach(this.addElementImages,this)},o.prototype.addElementImages=function(e){"IMG"==e.nodeName&&this.addImage(e),this.options.background===!0&&this.addElementBackgroundImages(e);var t=e.nodeType;if(t&&d[t]){for(var i=e.querySelectorAll("img"),n=0;n<i.length;n++){var o=i[n];this.addImage(o)}if("string"==typeof this.options.background){var r=e.querySelectorAll(this.options.background);for(n=0;n<r.length;n++){var s=r[n];this.addElementBackgroundImages(s)}}}};var d={1:!0,9:!0,11:!0};return o.prototype.addElementBackgroundImages=function(e){var t=getComputedStyle(e);if(t)for(var i=/url\((['"])?(.*?)\1\)/gi,n=i.exec(t.backgroundImage);null!==n;){var o=n&&n[2];o&&this.addBackground(o,e),n=i.exec(t.backgroundImage)}},o.prototype.addImage=function(e){var t=new r(e);this.images.push(t)},o.prototype.addBackground=function(e,t){var i=new s(e,t);this.images.push(i)},o.prototype.check=function(){function e(e,i,n){setTimeout(function(){t.progress(e,i,n)})}var t=this;return this.progressedCount=0,this.hasAnyBroken=!1,this.images.length?void this.images.forEach(function(t){t.once("progress",e),t.check()}):void this.complete()},o.prototype.progress=function(e,t,i){this.progressedCount++,this.hasAnyBroken=this.hasAnyBroken||!e.isLoaded,this.emitEvent("progress",[this,e,t]),this.jqDeferred&&this.jqDeferred.notify&&this.jqDeferred.notify(this,e),this.progressedCount==this.images.length&&this.complete(),this.options.debug&&a&&a.log("progress: "+i,e,t)},o.prototype.complete=function(){var e=this.hasAnyBroken?"fail":"done";if(this.isComplete=!0,this.emitEvent(e,[this]),this.emitEvent("always",[this]),this.jqDeferred){var t=this.hasAnyBroken?"reject":"resolve";this.jqDeferred[t](this)}},r.prototype=Object.create(t.prototype),r.prototype.check=function(){var e=this.getIsImageComplete();return e?void this.confirm(0!==this.img.naturalWidth,"naturalWidth"):(this.proxyImage=new Image,this.proxyImage.addEventListener("load",this),this.proxyImage.addEventListener("error",this),this.img.addEventListener("load",this),this.img.addEventListener("error",this),void(this.proxyImage.src=this.img.src))},r.prototype.getIsImageComplete=function(){return this.img.complete&&void 0!==this.img.naturalWidth},r.prototype.confirm=function(e,t){this.isLoaded=e,this.emitEvent("progress",[this,this.img,t])},r.prototype.handleEvent=function(e){var t="on"+e.type;this[t]&&this[t](e)},r.prototype.onload=function(){this.confirm(!0,"onload"),this.unbindEvents()},r.prototype.onerror=function(){this.confirm(!1,"onerror"),this.unbindEvents()},r.prototype.unbindEvents=function(){this.proxyImage.removeEventListener("load",this),this.proxyImage.removeEventListener("error",this),this.img.removeEventListener("load",this),this.img.removeEventListener("error",this)},s.prototype=Object.create(r.prototype),s.prototype.check=function(){this.img.addEventListener("load",this),this.img.addEventListener("error",this),this.img.src=this.url;var e=this.getIsImageComplete();e&&(this.confirm(0!==this.img.naturalWidth,"naturalWidth"),this.unbindEvents())},s.prototype.unbindEvents=function(){this.img.removeEventListener("load",this),this.img.removeEventListener("error",this)},s.prototype.confirm=function(e,t){this.isLoaded=e,this.emitEvent("progress",[this,this.element,t])},o.makeJQueryPlugin=function(t){t=t||e.jQuery,t&&(h=t,h.fn.imagesLoaded=function(e,t){var i=new o(this,e,t);return i.jqDeferred.promise(h(this))})},o.makeJQueryPlugin(),o});

/* lightgallery 1.6.11 GPL + zoom + video */
if ( typeof jQuery.fn.lightGallery === "undefined" ) { 
	!function(a,b){"function"==typeof define&&define.amd?define(["jquery"],function(a){return b(a)}):"object"==typeof module&&module.exports?module.exports=b(require("jquery")):b(a.jQuery)}(this,function(a){!function(){"use strict";function b(b,d){if(this.el=b,this.$el=a(b),this.s=a.extend({},c,d),this.s.dynamic&&"undefined"!==this.s.dynamicEl&&this.s.dynamicEl.constructor===Array&&!this.s.dynamicEl.length)throw"When using dynamic mode, you must also define dynamicEl as an Array.";return this.modules={},this.lGalleryOn=!1,this.lgBusy=!1,this.hideBartimeout=!1,this.isTouch="ontouchstart"in document.documentElement,this.s.slideEndAnimatoin&&(this.s.hideControlOnEnd=!1),this.s.dynamic?this.$items=this.s.dynamicEl:"this"===this.s.selector?this.$items=this.$el:""!==this.s.selector?this.s.selectWithin?this.$items=a(this.s.selectWithin).find(this.s.selector):this.$items=this.$el.find(a(this.s.selector)):this.$items=this.$el.children(),this.$slide="",this.$outer="",this.init(),this}var c={mode:"lg-slide",cssEasing:"ease",easing:"linear",speed:600,height:"100%",width:"100%",addClass:"",startClass:"lg-start-zoom",backdropDuration:150,hideBarsDelay:6e3,useLeft:!1,closable:!0,loop:!0,escKey:!0,keyPress:!0,controls:!0,slideEndAnimatoin:!0,hideControlOnEnd:!1,mousewheel:!0,getCaptionFromTitleOrAlt:!0,appendSubHtmlTo:".lg-sub-html",subHtmlSelectorRelative:!1,preload:1,showAfterLoad:!0,selector:"",selectWithin:"",nextHtml:"",prevHtml:"",index:!1,iframeMaxWidth:"100%",download:!0,counter:!0,appendCounterTo:".lg-toolbar",swipeThreshold:50,enableSwipe:!0,enableDrag:!0,dynamic:!1,dynamicEl:[],galleryId:1};b.prototype.init=function(){var b=this;b.s.preload>b.$items.length&&(b.s.preload=b.$items.length);var c=window.location.hash;c.indexOf("lg="+this.s.galleryId)>0&&(b.index=parseInt(c.split("&slide=")[1],10),a("body").addClass("lg-from-hash"),a("body").hasClass("lg-on")||(setTimeout(function(){b.build(b.index)}),a("body").addClass("lg-on"))),b.s.dynamic?(b.$el.trigger("onBeforeOpen.lg"),b.index=b.s.index||0,a("body").hasClass("lg-on")||setTimeout(function(){b.build(b.index),a("body").addClass("lg-on")})):b.$items.on("click.lgcustom",function(c){try{c.preventDefault(),c.preventDefault()}catch(a){c.returnValue=!1}b.$el.trigger("onBeforeOpen.lg"),b.index=b.s.index||b.$items.index(this),a("body").hasClass("lg-on")||(b.build(b.index),a("body").addClass("lg-on"))})},b.prototype.build=function(b){var c=this;c.structure(),a.each(a.fn.lightGallery.modules,function(b){c.modules[b]=new a.fn.lightGallery.modules[b](c.el)}),c.slide(b,!1,!1,!1),c.s.keyPress&&c.keyPress(),c.$items.length>1?(c.arrow(),setTimeout(function(){c.enableDrag(),c.enableSwipe()},50),c.s.mousewheel&&c.mousewheel()):c.$slide.on("click.lg",function(){c.$el.trigger("onSlideClick.lg")}),c.counter(),c.closeGallery(),c.$el.trigger("onAfterOpen.lg"),c.$outer.on("mousemove.lg click.lg touchstart.lg",function(){c.$outer.removeClass("lg-hide-items"),clearTimeout(c.hideBartimeout),c.hideBartimeout=setTimeout(function(){c.$outer.addClass("lg-hide-items")},c.s.hideBarsDelay)}),c.$outer.trigger("mousemove.lg")},b.prototype.structure=function(){var b,c="",d="",e=0,f="",g=this;for(a("body").append('<div class="lg-backdrop"></div>'),a(".lg-backdrop").css("transition-duration",this.s.backdropDuration+"ms"),e=0;e<this.$items.length;e++)c+='<div class="lg-item"></div>';if(this.s.controls&&this.$items.length>1&&(d='<div class="lg-actions"><button class="lg-prev lg-icon">'+this.s.prevHtml+'</button><button class="lg-next lg-icon">'+this.s.nextHtml+"</button></div>"),".lg-sub-html"===this.s.appendSubHtmlTo&&(f='<div class="lg-sub-html"></div>'),b='<div class="lg-outer '+this.s.addClass+" "+this.s.startClass+'"><div class="lg" style="width:'+this.s.width+"; height:"+this.s.height+'"><div class="lg-inner">'+c+'</div><div class="lg-toolbar lg-group"><span class="lg-close lg-icon"></span></div>'+d+f+"</div></div>",a("body").append(b),this.$outer=a(".lg-outer"),this.$slide=this.$outer.find(".lg-item"),this.s.useLeft?(this.$outer.addClass("lg-use-left"),this.s.mode="lg-slide"):this.$outer.addClass("lg-use-css3"),g.setTop(),a(window).on("resize.lg orientationchange.lg",function(){setTimeout(function(){g.setTop()},100)}),this.$slide.eq(this.index).addClass("lg-current"),this.doCss()?this.$outer.addClass("lg-css3"):(this.$outer.addClass("lg-css"),this.s.speed=0),this.$outer.addClass(this.s.mode),this.s.enableDrag&&this.$items.length>1&&this.$outer.addClass("lg-grab"),this.s.showAfterLoad&&this.$outer.addClass("lg-show-after-load"),this.doCss()){var h=this.$outer.find(".lg-inner");h.css("transition-timing-function",this.s.cssEasing),h.css("transition-duration",this.s.speed+"ms")}setTimeout(function(){a(".lg-backdrop").addClass("in")}),setTimeout(function(){g.$outer.addClass("lg-visible")},this.s.backdropDuration),this.s.download&&this.$outer.find(".lg-toolbar").append('<a id="lg-download" target="_blank" download class="lg-download lg-icon"></a>'),this.prevScrollTop=a(window).scrollTop()},b.prototype.setTop=function(){if("100%"!==this.s.height){var b=a(window).height(),c=(b-parseInt(this.s.height,10))/2,d=this.$outer.find(".lg");b>=parseInt(this.s.height,10)?d.css("top",c+"px"):d.css("top","0px")}},b.prototype.doCss=function(){return!!function(){var a=["transition","MozTransition","WebkitTransition","OTransition","msTransition","KhtmlTransition"],b=document.documentElement,c=0;for(c=0;c<a.length;c++)if(a[c]in b.style)return!0}()},b.prototype.isVideo=function(a,b){var c;if(c=this.s.dynamic?this.s.dynamicEl[b].html:this.$items.eq(b).attr("data-html"),!a)return c?{html5:!0}:(console.error("lightGallery :- data-src is not pvovided on slide item "+(b+1)+". Please make sure the selector property is properly configured. More info - http://sachinchoolur.github.io/lightGallery/demos/html-markup.html"),!1);var d=a.match(/\/\/(?:www\.)?youtu(?:\.be|be\.com|be-nocookie\.com)\/(?:watch\?v=|embed\/)?([a-z0-9\-\_\%]+)/i),e=a.match(/\/\/(?:www\.)?vimeo.com\/([0-9a-z\-_]+)/i),f=a.match(/\/\/(?:www\.)?dai.ly\/([0-9a-z\-_]+)/i),g=a.match(/\/\/(?:www\.)?(?:vk\.com|vkontakte\.ru)\/(?:video_ext\.php\?)(.*)/i);return d?{youtube:d}:e?{vimeo:e}:f?{dailymotion:f}:g?{vk:g}:void 0},b.prototype.counter=function(){this.s.counter&&a(this.s.appendCounterTo).append('<div id="lg-counter"><span id="lg-counter-current">'+(parseInt(this.index,10)+1)+'</span> / <span id="lg-counter-all">'+this.$items.length+"</span></div>")},b.prototype.addHtml=function(b){var c,d,e=null;if(this.s.dynamic?this.s.dynamicEl[b].subHtmlUrl?c=this.s.dynamicEl[b].subHtmlUrl:e=this.s.dynamicEl[b].subHtml:(d=this.$items.eq(b),d.attr("data-sub-html-url")?c=d.attr("data-sub-html-url"):(e=d.attr("data-sub-html"),this.s.getCaptionFromTitleOrAlt&&!e&&(e=d.attr("title")||d.find("img").first().attr("alt")))),!c)if(void 0!==e&&null!==e){var f=e.substring(0,1);"."!==f&&"#"!==f||(e=this.s.subHtmlSelectorRelative&&!this.s.dynamic?d.find(e).html():a(e).html())}else e="";".lg-sub-html"===this.s.appendSubHtmlTo?c?this.$outer.find(this.s.appendSubHtmlTo).load(c):this.$outer.find(this.s.appendSubHtmlTo).html(e):c?this.$slide.eq(b).load(c):this.$slide.eq(b).append(e),void 0!==e&&null!==e&&(""===e?this.$outer.find(this.s.appendSubHtmlTo).addClass("lg-empty-html"):this.$outer.find(this.s.appendSubHtmlTo).removeClass("lg-empty-html")),this.$el.trigger("onAfterAppendSubHtml.lg",[b])},b.prototype.preload=function(a){var b=1,c=1;for(b=1;b<=this.s.preload&&!(b>=this.$items.length-a);b++)this.loadContent(a+b,!1,0);for(c=1;c<=this.s.preload&&!(a-c<0);c++)this.loadContent(a-c,!1,0)},b.prototype.loadContent=function(b,c,d){var e,f,g,h,i,j,k=this,l=!1,m=function(b){for(var c=[],d=[],e=0;e<b.length;e++){var g=b[e].split(" ");""===g[0]&&g.splice(0,1),d.push(g[0]),c.push(g[1])}for(var h=a(window).width(),i=0;i<c.length;i++)if(parseInt(c[i],10)>h){f=d[i];break}};if(k.s.dynamic){if(k.s.dynamicEl[b].poster&&(l=!0,g=k.s.dynamicEl[b].poster),j=k.s.dynamicEl[b].html,f=k.s.dynamicEl[b].src,k.s.dynamicEl[b].responsive){m(k.s.dynamicEl[b].responsive.split(","))}h=k.s.dynamicEl[b].srcset,i=k.s.dynamicEl[b].sizes}else{if(k.$items.eq(b).attr("data-poster")&&(l=!0,g=k.$items.eq(b).attr("data-poster")),j=k.$items.eq(b).attr("data-html"),f=k.$items.eq(b).attr("href")||k.$items.eq(b).attr("data-src"),k.$items.eq(b).attr("data-responsive")){m(k.$items.eq(b).attr("data-responsive").split(","))}h=k.$items.eq(b).attr("data-srcset"),i=k.$items.eq(b).attr("data-sizes")}var n=!1;k.s.dynamic?k.s.dynamicEl[b].iframe&&(n=!0):"true"===k.$items.eq(b).attr("data-iframe")&&(n=!0);var o=k.isVideo(f,b);if(!k.$slide.eq(b).hasClass("lg-loaded")){if(n)k.$slide.eq(b).prepend('<div class="lg-video-cont lg-has-iframe" style="max-width:'+k.s.iframeMaxWidth+'"><div class="lg-video"><iframe class="lg-object" frameborder="0" src="'+f+'"  allowfullscreen="true"></iframe></div></div>');else if(l){var p="";p=o&&o.youtube?"lg-has-youtube":o&&o.vimeo?"lg-has-vimeo":"lg-has-html5",k.$slide.eq(b).prepend('<div class="lg-video-cont '+p+' "><div class="lg-video"><span class="lg-video-play"></span><img class="lg-object lg-has-poster" src="'+g+'" /></div></div>')}else o?(k.$slide.eq(b).prepend('<div class="lg-video-cont "><div class="lg-video"></div></div>'),k.$el.trigger("hasVideo.lg",[b,f,j])):k.$slide.eq(b).prepend('<div class="lg-img-wrap"><img class="lg-object lg-image" src="'+f+'" /></div>');if(k.$el.trigger("onAferAppendSlide.lg",[b]),e=k.$slide.eq(b).find(".lg-object"),i&&e.attr("sizes",i),h){e.attr("srcset",h);try{picturefill({elements:[e[0]]})}catch(a){console.warn("lightGallery :- If you want srcset to be supported for older browser please include picturefil version 2 javascript library in your document.")}}".lg-sub-html"!==this.s.appendSubHtmlTo&&k.addHtml(b),k.$slide.eq(b).addClass("lg-loaded")}k.$slide.eq(b).find(".lg-object").on("load.lg error.lg",function(){var c=0;d&&!a("body").hasClass("lg-from-hash")&&(c=d),setTimeout(function(){k.$slide.eq(b).addClass("lg-complete"),k.$el.trigger("onSlideItemLoad.lg",[b,d||0])},c)}),o&&o.html5&&!l&&k.$slide.eq(b).addClass("lg-complete"),!0===c&&(k.$slide.eq(b).hasClass("lg-complete")?k.preload(b):k.$slide.eq(b).find(".lg-object").on("load.lg error.lg",function(){k.preload(b)}))},b.prototype.slide=function(b,c,d,e){var f=this.$outer.find(".lg-current").index(),g=this;if(!g.lGalleryOn||f!==b){var h=this.$slide.length,i=g.lGalleryOn?this.s.speed:0;if(!g.lgBusy){if(this.s.download){var j;j=g.s.dynamic?!1!==g.s.dynamicEl[b].downloadUrl&&(g.s.dynamicEl[b].downloadUrl||g.s.dynamicEl[b].src):"false"!==g.$items.eq(b).attr("data-download-url")&&(g.$items.eq(b).attr("data-download-url")||g.$items.eq(b).attr("href")||g.$items.eq(b).attr("data-src")),j?(a("#lg-download").attr("href",j),g.$outer.removeClass("lg-hide-download")):g.$outer.addClass("lg-hide-download")}if(this.$el.trigger("onBeforeSlide.lg",[f,b,c,d]),g.lgBusy=!0,clearTimeout(g.hideBartimeout),".lg-sub-html"===this.s.appendSubHtmlTo&&setTimeout(function(){g.addHtml(b)},i),this.arrowDisable(b),e||(b<f?e="prev":b>f&&(e="next")),c){this.$slide.removeClass("lg-prev-slide lg-current lg-next-slide");var k,l;h>2?(k=b-1,l=b+1,0===b&&f===h-1?(l=0,k=h-1):b===h-1&&0===f&&(l=0,k=h-1)):(k=0,l=1),"prev"===e?g.$slide.eq(l).addClass("lg-next-slide"):g.$slide.eq(k).addClass("lg-prev-slide"),g.$slide.eq(b).addClass("lg-current")}else g.$outer.addClass("lg-no-trans"),this.$slide.removeClass("lg-prev-slide lg-next-slide"),"prev"===e?(this.$slide.eq(b).addClass("lg-prev-slide"),this.$slide.eq(f).addClass("lg-next-slide")):(this.$slide.eq(b).addClass("lg-next-slide"),this.$slide.eq(f).addClass("lg-prev-slide")),setTimeout(function(){g.$slide.removeClass("lg-current"),g.$slide.eq(b).addClass("lg-current"),g.$outer.removeClass("lg-no-trans")},50);g.lGalleryOn?(setTimeout(function(){g.loadContent(b,!0,0)},this.s.speed+50),setTimeout(function(){g.lgBusy=!1,g.$el.trigger("onAfterSlide.lg",[f,b,c,d])},this.s.speed)):(g.loadContent(b,!0,g.s.backdropDuration),g.lgBusy=!1,g.$el.trigger("onAfterSlide.lg",[f,b,c,d])),g.lGalleryOn=!0,this.s.counter&&a("#lg-counter-current").text(b+1)}g.index=b}},b.prototype.goToNextSlide=function(a){var b=this,c=b.s.loop;a&&b.$slide.length<3&&(c=!1),b.lgBusy||(b.index+1<b.$slide.length?(b.index++,b.$el.trigger("onBeforeNextSlide.lg",[b.index]),b.slide(b.index,a,!1,"next")):c?(b.index=0,b.$el.trigger("onBeforeNextSlide.lg",[b.index]),b.slide(b.index,a,!1,"next")):b.s.slideEndAnimatoin&&!a&&(b.$outer.addClass("lg-right-end"),setTimeout(function(){b.$outer.removeClass("lg-right-end")},400)))},b.prototype.goToPrevSlide=function(a){var b=this,c=b.s.loop;a&&b.$slide.length<3&&(c=!1),b.lgBusy||(b.index>0?(b.index--,b.$el.trigger("onBeforePrevSlide.lg",[b.index,a]),b.slide(b.index,a,!1,"prev")):c?(b.index=b.$items.length-1,b.$el.trigger("onBeforePrevSlide.lg",[b.index,a]),b.slide(b.index,a,!1,"prev")):b.s.slideEndAnimatoin&&!a&&(b.$outer.addClass("lg-left-end"),setTimeout(function(){b.$outer.removeClass("lg-left-end")},400)))},b.prototype.keyPress=function(){var b=this;this.$items.length>1&&a(window).on("keyup.lg",function(a){b.$items.length>1&&(37===a.keyCode&&(a.preventDefault(),b.goToPrevSlide()),39===a.keyCode&&(a.preventDefault(),b.goToNextSlide()))}),a(window).on("keydown.lg",function(a){!0===b.s.escKey&&27===a.keyCode&&(a.preventDefault(),b.$outer.hasClass("lg-thumb-open")?b.$outer.removeClass("lg-thumb-open"):b.destroy())})},b.prototype.arrow=function(){var a=this;this.$outer.find(".lg-prev").on("click.lg",function(){a.goToPrevSlide()}),this.$outer.find(".lg-next").on("click.lg",function(){a.goToNextSlide()})},b.prototype.arrowDisable=function(a){!this.s.loop&&this.s.hideControlOnEnd&&(a+1<this.$slide.length?this.$outer.find(".lg-next").removeAttr("disabled").removeClass("disabled"):this.$outer.find(".lg-next").attr("disabled","disabled").addClass("disabled"),a>0?this.$outer.find(".lg-prev").removeAttr("disabled").removeClass("disabled"):this.$outer.find(".lg-prev").attr("disabled","disabled").addClass("disabled"))},b.prototype.setTranslate=function(a,b,c){this.s.useLeft?a.css("left",b):a.css({transform:"translate3d("+b+"px, "+c+"px, 0px)"})},b.prototype.touchMove=function(b,c){var d=c-b;Math.abs(d)>15&&(this.$outer.addClass("lg-dragging"),this.setTranslate(this.$slide.eq(this.index),d,0),this.setTranslate(a(".lg-prev-slide"),-this.$slide.eq(this.index).width()+d,0),this.setTranslate(a(".lg-next-slide"),this.$slide.eq(this.index).width()+d,0))},b.prototype.touchEnd=function(a){var b=this;"lg-slide"!==b.s.mode&&b.$outer.addClass("lg-slide"),this.$slide.not(".lg-current, .lg-prev-slide, .lg-next-slide").css("opacity","0"),setTimeout(function(){b.$outer.removeClass("lg-dragging"),a<0&&Math.abs(a)>b.s.swipeThreshold?b.goToNextSlide(!0):a>0&&Math.abs(a)>b.s.swipeThreshold?b.goToPrevSlide(!0):Math.abs(a)<5&&b.$el.trigger("onSlideClick.lg"),b.$slide.removeAttr("style")}),setTimeout(function(){b.$outer.hasClass("lg-dragging")||"lg-slide"===b.s.mode||b.$outer.removeClass("lg-slide")},b.s.speed+100)},b.prototype.enableSwipe=function(){var a=this,b=0,c=0,d=!1;a.s.enableSwipe&&a.doCss()&&(a.$slide.on("touchstart.lg",function(c){a.$outer.hasClass("lg-zoomed")||a.lgBusy||(c.preventDefault(),a.manageSwipeClass(),b=c.originalEvent.targetTouches[0].pageX)}),a.$slide.on("touchmove.lg",function(e){a.$outer.hasClass("lg-zoomed")||(e.preventDefault(),c=e.originalEvent.targetTouches[0].pageX,a.touchMove(b,c),d=!0)}),a.$slide.on("touchend.lg",function(){a.$outer.hasClass("lg-zoomed")||(d?(d=!1,a.touchEnd(c-b)):a.$el.trigger("onSlideClick.lg"))}))},b.prototype.enableDrag=function(){var b=this,c=0,d=0,e=!1,f=!1;b.s.enableDrag&&b.doCss()&&(b.$slide.on("mousedown.lg",function(d){b.$outer.hasClass("lg-zoomed")||b.lgBusy||a(d.target).text().trim()||(d.preventDefault(),b.manageSwipeClass(),c=d.pageX,e=!0,b.$outer.scrollLeft+=1,b.$outer.scrollLeft-=1,b.$outer.removeClass("lg-grab").addClass("lg-grabbing"),b.$el.trigger("onDragstart.lg"))}),a(window).on("mousemove.lg",function(a){e&&(f=!0,d=a.pageX,b.touchMove(c,d),b.$el.trigger("onDragmove.lg"))}),a(window).on("mouseup.lg",function(g){f?(f=!1,b.touchEnd(d-c),b.$el.trigger("onDragend.lg")):(a(g.target).hasClass("lg-object")||a(g.target).hasClass("lg-video-play"))&&b.$el.trigger("onSlideClick.lg"),e&&(e=!1,b.$outer.removeClass("lg-grabbing").addClass("lg-grab"))}))},b.prototype.manageSwipeClass=function(){var a=this.index+1,b=this.index-1;this.s.loop&&this.$slide.length>2&&(0===this.index?b=this.$slide.length-1:this.index===this.$slide.length-1&&(a=0)),this.$slide.removeClass("lg-next-slide lg-prev-slide"),b>-1&&this.$slide.eq(b).addClass("lg-prev-slide"),this.$slide.eq(a).addClass("lg-next-slide")},b.prototype.mousewheel=function(){var a=this;a.$outer.on("mousewheel.lg",function(b){b.deltaY&&(b.deltaY>0?a.goToPrevSlide():a.goToNextSlide(),b.preventDefault())})},b.prototype.closeGallery=function(){var b=this,c=!1;this.$outer.find(".lg-close").on("click.lg",function(){b.destroy()}),b.s.closable&&(b.$outer.on("mousedown.lg",function(b){c=!!(a(b.target).is(".lg-outer")||a(b.target).is(".lg-item ")||a(b.target).is(".lg-img-wrap"))}),b.$outer.on("mousemove.lg",function(){c=!1}),b.$outer.on("mouseup.lg",function(d){(a(d.target).is(".lg-outer")||a(d.target).is(".lg-item ")||a(d.target).is(".lg-img-wrap")&&c)&&(b.$outer.hasClass("lg-dragging")||b.destroy())}))},b.prototype.destroy=function(b){var c=this;b||(c.$el.trigger("onBeforeClose.lg"),a(window).scrollTop(c.prevScrollTop)),b&&(c.s.dynamic||this.$items.off("click.lg click.lgcustom"),a.removeData(c.el,"lightGallery")),this.$el.off(".lg.tm"),a.each(a.fn.lightGallery.modules,function(a){c.modules[a]&&c.modules[a].destroy()}),this.lGalleryOn=!1,clearTimeout(c.hideBartimeout),this.hideBartimeout=!1,a(window).off(".lg"),a("body").removeClass("lg-on lg-from-hash"),c.$outer&&c.$outer.removeClass("lg-visible"),a(".lg-backdrop").removeClass("in"),setTimeout(function(){c.$outer&&c.$outer.remove(),a(".lg-backdrop").remove(),b||c.$el.trigger("onCloseAfter.lg")},c.s.backdropDuration+50)},a.fn.lightGallery=function(c){return this.each(function(){if(a.data(this,"lightGallery"))try{a(this).data("lightGallery").init()}catch(a){console.error("lightGallery has not initiated properly")}else a.data(this,"lightGallery",new b(this,c))})},a.fn.lightGallery.modules={}}()});
	!function(a,b){"function"==typeof define&&define.amd?define(["jquery"],function(a){return b(a)}):"object"==typeof exports?module.exports=b(require("jquery")):b(jQuery)}(this,function(a){!function(){"use strict";var b=function(){var a=!1,b=navigator.userAgent.match(/Chrom(e|ium)\/([0-9]+)\./);return b&&parseInt(b[2],10)<54&&(a=!0),a},c={scale:1,zoom:!0,actualSize:!0,enableZoomAfter:300,useLeftForZoom:b()},d=function(b){return this.core=a(b).data("lightGallery"),this.core.s=a.extend({},c,this.core.s),this.core.s.zoom&&this.core.doCss()&&(this.init(),this.zoomabletimeout=!1,this.pageX=a(window).width()/2,this.pageY=a(window).height()/2+a(window).scrollTop()),this};d.prototype.init=function(){var b=this,c='<span id="lg-zoom-in" class="lg-icon"></span><span id="lg-zoom-out" class="lg-icon"></span>';b.core.s.actualSize&&(c+='<span id="lg-actual-size" class="lg-icon"></span>'),b.core.s.useLeftForZoom?b.core.$outer.addClass("lg-use-left-for-zoom"):b.core.$outer.addClass("lg-use-transition-for-zoom"),this.core.$outer.find(".lg-toolbar").append(c),b.core.$el.on("onSlideItemLoad.lg.tm.zoom",function(c,d,e){var f=b.core.s.enableZoomAfter+e;a("body").hasClass("lg-from-hash")&&e?f=0:a("body").removeClass("lg-from-hash"),b.zoomabletimeout=setTimeout(function(){b.core.$slide.eq(d).addClass("lg-zoomable")},f+30)});var d=1,e=function(c){var d,e,f=b.core.$outer.find(".lg-current .lg-image"),g=(a(window).width()-f.prop("offsetWidth"))/2,h=(a(window).height()-f.prop("offsetHeight"))/2+a(window).scrollTop();d=b.pageX-g,e=b.pageY-h;var i=(c-1)*d,j=(c-1)*e;f.css("transform","scale3d("+c+", "+c+", 1)").attr("data-scale",c),b.core.s.useLeftForZoom?f.parent().css({left:-i+"px",top:-j+"px"}).attr("data-x",i).attr("data-y",j):f.parent().css("transform","translate3d(-"+i+"px, -"+j+"px, 0)").attr("data-x",i).attr("data-y",j)},f=function(){d>1?b.core.$outer.addClass("lg-zoomed"):b.resetZoom(),d<1&&(d=1),e(d)},g=function(c,e,g,h){var i,j=e.prop("offsetWidth");i=b.core.s.dynamic?b.core.s.dynamicEl[g].width||e[0].naturalWidth||j:b.core.$items.eq(g).attr("data-width")||e[0].naturalWidth||j;var k;b.core.$outer.hasClass("lg-zoomed")?d=1:i>j&&(k=i/j,d=k||2),h?(b.pageX=a(window).width()/2,b.pageY=a(window).height()/2+a(window).scrollTop()):(b.pageX=c.pageX||c.originalEvent.targetTouches[0].pageX,b.pageY=c.pageY||c.originalEvent.targetTouches[0].pageY),f(),setTimeout(function(){b.core.$outer.removeClass("lg-grabbing").addClass("lg-grab")},10)},h=!1;b.core.$el.on("onAferAppendSlide.lg.tm.zoom",function(a,c){var d=b.core.$slide.eq(c).find(".lg-image");d.on("dblclick",function(a){g(a,d,c)}),d.on("touchstart",function(a){h?(clearTimeout(h),h=null,g(a,d,c)):h=setTimeout(function(){h=null},300),a.preventDefault()})}),a(window).on("resize.lg.zoom scroll.lg.zoom orientationchange.lg.zoom",function(){b.pageX=a(window).width()/2,b.pageY=a(window).height()/2+a(window).scrollTop(),e(d)}),a("#lg-zoom-out").on("click.lg",function(){b.core.$outer.find(".lg-current .lg-image").length&&(d-=b.core.s.scale,f())}),a("#lg-zoom-in").on("click.lg",function(){b.core.$outer.find(".lg-current .lg-image").length&&(d+=b.core.s.scale,f())}),a("#lg-actual-size").on("click.lg",function(a){g(a,b.core.$slide.eq(b.core.index).find(".lg-image"),b.core.index,!0)}),b.core.$el.on("onBeforeSlide.lg.tm",function(){d=1,b.resetZoom()}),b.zoomDrag(),b.zoomSwipe()},d.prototype.resetZoom=function(){this.core.$outer.removeClass("lg-zoomed"),this.core.$slide.find(".lg-img-wrap").removeAttr("style data-x data-y"),this.core.$slide.find(".lg-image").removeAttr("style data-scale"),this.pageX=a(window).width()/2,this.pageY=a(window).height()/2+a(window).scrollTop()},d.prototype.zoomSwipe=function(){var a=this,b={},c={},d=!1,e=!1,f=!1;a.core.$slide.on("touchstart.lg",function(c){if(a.core.$outer.hasClass("lg-zoomed")){var d=a.core.$slide.eq(a.core.index).find(".lg-object");f=d.prop("offsetHeight")*d.attr("data-scale")>a.core.$outer.find(".lg").height(),e=d.prop("offsetWidth")*d.attr("data-scale")>a.core.$outer.find(".lg").width(),(e||f)&&(c.preventDefault(),b={x:c.originalEvent.targetTouches[0].pageX,y:c.originalEvent.targetTouches[0].pageY})}}),a.core.$slide.on("touchmove.lg",function(g){if(a.core.$outer.hasClass("lg-zoomed")){var h,i,j=a.core.$slide.eq(a.core.index).find(".lg-img-wrap");g.preventDefault(),d=!0,c={x:g.originalEvent.targetTouches[0].pageX,y:g.originalEvent.targetTouches[0].pageY},a.core.$outer.addClass("lg-zoom-dragging"),i=f?-Math.abs(j.attr("data-y"))+(c.y-b.y):-Math.abs(j.attr("data-y")),h=e?-Math.abs(j.attr("data-x"))+(c.x-b.x):-Math.abs(j.attr("data-x")),(Math.abs(c.x-b.x)>15||Math.abs(c.y-b.y)>15)&&(a.core.s.useLeftForZoom?j.css({left:h+"px",top:i+"px"}):j.css("transform","translate3d("+h+"px, "+i+"px, 0)"))}}),a.core.$slide.on("touchend.lg",function(){a.core.$outer.hasClass("lg-zoomed")&&d&&(d=!1,a.core.$outer.removeClass("lg-zoom-dragging"),a.touchendZoom(b,c,e,f))})},d.prototype.zoomDrag=function(){var b=this,c={},d={},e=!1,f=!1,g=!1,h=!1;b.core.$slide.on("mousedown.lg.zoom",function(d){var f=b.core.$slide.eq(b.core.index).find(".lg-object");h=f.prop("offsetHeight")*f.attr("data-scale")>b.core.$outer.find(".lg").height(),g=f.prop("offsetWidth")*f.attr("data-scale")>b.core.$outer.find(".lg").width(),b.core.$outer.hasClass("lg-zoomed")&&a(d.target).hasClass("lg-object")&&(g||h)&&(d.preventDefault(),c={x:d.pageX,y:d.pageY},e=!0,b.core.$outer.scrollLeft+=1,b.core.$outer.scrollLeft-=1,b.core.$outer.removeClass("lg-grab").addClass("lg-grabbing"))}),a(window).on("mousemove.lg.zoom",function(a){if(e){var i,j,k=b.core.$slide.eq(b.core.index).find(".lg-img-wrap");f=!0,d={x:a.pageX,y:a.pageY},b.core.$outer.addClass("lg-zoom-dragging"),j=h?-Math.abs(k.attr("data-y"))+(d.y-c.y):-Math.abs(k.attr("data-y")),i=g?-Math.abs(k.attr("data-x"))+(d.x-c.x):-Math.abs(k.attr("data-x")),b.core.s.useLeftForZoom?k.css({left:i+"px",top:j+"px"}):k.css("transform","translate3d("+i+"px, "+j+"px, 0)")}}),a(window).on("mouseup.lg.zoom",function(a){e&&(e=!1,b.core.$outer.removeClass("lg-zoom-dragging"),!f||c.x===d.x&&c.y===d.y||(d={x:a.pageX,y:a.pageY},b.touchendZoom(c,d,g,h)),f=!1),b.core.$outer.removeClass("lg-grabbing").addClass("lg-grab")})},d.prototype.touchendZoom=function(a,b,c,d){var e=this,f=e.core.$slide.eq(e.core.index).find(".lg-img-wrap"),g=e.core.$slide.eq(e.core.index).find(".lg-object"),h=-Math.abs(f.attr("data-x"))+(b.x-a.x),i=-Math.abs(f.attr("data-y"))+(b.y-a.y),j=(e.core.$outer.find(".lg").height()-g.prop("offsetHeight"))/2,k=Math.abs(g.prop("offsetHeight")*Math.abs(g.attr("data-scale"))-e.core.$outer.find(".lg").height()+j),l=(e.core.$outer.find(".lg").width()-g.prop("offsetWidth"))/2,m=Math.abs(g.prop("offsetWidth")*Math.abs(g.attr("data-scale"))-e.core.$outer.find(".lg").width()+l);(Math.abs(b.x-a.x)>15||Math.abs(b.y-a.y)>15)&&(d&&(i<=-k?i=-k:i>=-j&&(i=-j)),c&&(h<=-m?h=-m:h>=-l&&(h=-l)),d?f.attr("data-y",Math.abs(i)):i=-Math.abs(f.attr("data-y")),c?f.attr("data-x",Math.abs(h)):h=-Math.abs(f.attr("data-x")),e.core.s.useLeftForZoom?f.css({left:h+"px",top:i+"px"}):f.css("transform","translate3d("+h+"px, "+i+"px, 0)"))},d.prototype.destroy=function(){var b=this;b.core.$el.off(".lg.zoom"),a(window).off(".lg.zoom"),b.core.$slide.off(".lg.zoom"),b.core.$el.off(".lg.tm.zoom"),b.resetZoom(),clearTimeout(b.zoomabletimeout),b.zoomabletimeout=!1},a.fn.lightGallery.modules.zoom=d}()});
	!function(a,b){"function"==typeof define&&define.amd?define(["jquery"],function(a){return b(a)}):"object"==typeof module&&module.exports?module.exports=b(require("jquery")):b(a.jQuery)}(this,function(a){!function(){"use strict";function b(a,b,c,d){var e=this;if(e.core.$slide.eq(b).find(".lg-video").append(e.loadVideo(c,"lg-object",!0,b,d)),d)if(e.core.s.videojs)try{videojs(e.core.$slide.eq(b).find(".lg-html5").get(0),e.core.s.videojsOptions,function(){!e.videoLoaded&&e.core.s.autoplayFirstVideo&&this.play()})}catch(a){console.error("Make sure you have included videojs")}else!e.videoLoaded&&e.core.s.autoplayFirstVideo&&e.core.$slide.eq(b).find(".lg-html5").get(0).play()}function c(a,b){var c=this.core.$slide.eq(b).find(".lg-video-cont");c.hasClass("lg-has-iframe")||(c.css("max-width",this.core.s.videoMaxWidth),this.videoLoaded=!0)}function d(b,c,d){var e=this,f=e.core.$slide.eq(c),g=f.find(".lg-youtube").get(0),h=f.find(".lg-vimeo").get(0),i=f.find(".lg-dailymotion").get(0),j=f.find(".lg-vk").get(0),k=f.find(".lg-html5").get(0);if(g)g.contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}',"*");else if(h)try{$f(h).api("pause")}catch(a){console.error("Make sure you have included froogaloop2 js")}else if(i)i.contentWindow.postMessage("pause","*");else if(k)if(e.core.s.videojs)try{videojs(k).pause()}catch(a){console.error("Make sure you have included videojs")}else k.pause();j&&a(j).attr("src",a(j).attr("src").replace("&autoplay","&noplay"));var l;l=e.core.s.dynamic?e.core.s.dynamicEl[d].src:e.core.$items.eq(d).attr("href")||e.core.$items.eq(d).attr("data-src");var m=e.core.isVideo(l,d)||{};(m.youtube||m.vimeo||m.dailymotion||m.vk)&&e.core.$outer.addClass("lg-hide-download")}var e={videoMaxWidth:"855px",autoplayFirstVideo:!0,youtubePlayerParams:!1,vimeoPlayerParams:!1,dailymotionPlayerParams:!1,vkPlayerParams:!1,videojs:!1,videojsOptions:{}},f=function(b){return this.core=a(b).data("lightGallery"),this.$el=a(b),this.core.s=a.extend({},e,this.core.s),this.videoLoaded=!1,this.init(),this};f.prototype.init=function(){var e=this;e.core.$el.on("hasVideo.lg.tm",b.bind(this)),e.core.$el.on("onAferAppendSlide.lg.tm",c.bind(this)),e.core.doCss()&&e.core.$items.length>1&&(e.core.s.enableSwipe||e.core.s.enableDrag)?e.core.$el.on("onSlideClick.lg.tm",function(){var a=e.core.$slide.eq(e.core.index);e.loadVideoOnclick(a)}):e.core.$slide.on("click.lg",function(){e.loadVideoOnclick(a(this))}),e.core.$el.on("onBeforeSlide.lg.tm",d.bind(this)),e.core.$el.on("onAfterSlide.lg.tm",function(a,b){e.core.$slide.eq(b).removeClass("lg-video-playing")}),e.core.s.autoplayFirstVideo&&e.core.$el.on("onAferAppendSlide.lg.tm",function(a,b){if(!e.core.lGalleryOn){var c=e.core.$slide.eq(b);setTimeout(function(){e.loadVideoOnclick(c)},100)}})},f.prototype.loadVideo=function(b,c,d,e,f){var g="",h=1,i="",j=this.core.isVideo(b,e)||{};if(d&&(h=this.videoLoaded?0:this.core.s.autoplayFirstVideo?1:0),j.youtube)i="?wmode=opaque&autoplay="+h+"&enablejsapi=1",this.core.s.youtubePlayerParams&&(i=i+"&"+a.param(this.core.s.youtubePlayerParams)),g='<iframe class="lg-video-object lg-youtube '+c+'" width="560" height="315" src="//www.youtube.com/embed/'+j.youtube[1]+i+'" frameborder="0" allowfullscreen></iframe>';else if(j.vimeo)i="?autoplay="+h+"&api=1",this.core.s.vimeoPlayerParams&&(i=i+"&"+a.param(this.core.s.vimeoPlayerParams)),g='<iframe class="lg-video-object lg-vimeo '+c+'" width="560" height="315"  src="//player.vimeo.com/video/'+j.vimeo[1]+i+'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';else if(j.dailymotion)i="?wmode=opaque&autoplay="+h+"&api=postMessage",this.core.s.dailymotionPlayerParams&&(i=i+"&"+a.param(this.core.s.dailymotionPlayerParams)),g='<iframe class="lg-video-object lg-dailymotion '+c+'" width="560" height="315" src="//www.dailymotion.com/embed/video/'+j.dailymotion[1]+i+'" frameborder="0" allowfullscreen></iframe>';else if(j.html5){var k=f.substring(0,1);"."!==k&&"#"!==k||(f=a(f).html()),g=f}else j.vk&&(i="&autoplay="+h,this.core.s.vkPlayerParams&&(i=i+"&"+a.param(this.core.s.vkPlayerParams)),g='<iframe class="lg-video-object lg-vk '+c+'" width="560" height="315" src="//vk.com/video_ext.php?'+j.vk[1]+i+'" frameborder="0" allowfullscreen></iframe>');return g},f.prototype.loadVideoOnclick=function(a){var b=this;if(a.find(".lg-object").hasClass("lg-has-poster")&&a.find(".lg-object").is(":visible"))if(a.hasClass("lg-has-video")){var c=a.find(".lg-youtube").get(0),d=a.find(".lg-vimeo").get(0),e=a.find(".lg-dailymotion").get(0),f=a.find(".lg-html5").get(0);if(c)c.contentWindow.postMessage('{"event":"command","func":"playVideo","args":""}',"*");else if(d)try{$f(d).api("play")}catch(a){console.error("Make sure you have included froogaloop2 js")}else if(e)e.contentWindow.postMessage("play","*");else if(f)if(b.core.s.videojs)try{videojs(f).play()}catch(a){console.error("Make sure you have included videojs")}else f.play();a.addClass("lg-video-playing")}else{a.addClass("lg-video-playing lg-has-video");var g,h,i=function(c,d){if(a.find(".lg-video").append(b.loadVideo(c,"",!1,b.core.index,d)),d)if(b.core.s.videojs)try{videojs(b.core.$slide.eq(b.core.index).find(".lg-html5").get(0),b.core.s.videojsOptions,function(){this.play()})}catch(a){console.error("Make sure you have included videojs")}else b.core.$slide.eq(b.core.index).find(".lg-html5").get(0).play()};b.core.s.dynamic?(g=b.core.s.dynamicEl[b.core.index].src,h=b.core.s.dynamicEl[b.core.index].html,i(g,h)):(g=b.core.$items.eq(b.core.index).attr("href")||b.core.$items.eq(b.core.index).attr("data-src"),h=b.core.$items.eq(b.core.index).attr("data-html"),i(g,h));var j=a.find(".lg-object");a.find(".lg-video").append(j),a.find(".lg-video-object").hasClass("lg-html5")||(a.removeClass("lg-complete"),a.find(".lg-video-object").on("load.lg error.lg",function(){a.addClass("lg-complete")}))}},f.prototype.destroy=function(){this.videoLoaded=!1},a.fn.lightGallery.modules.video=f}()});
}

/* Tilt.js 1.1.21 */
!function(t){"use strict";var _typeof="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t};!function(t){"function"==typeof define&&define.amd?define(["jquery"],t):"object"===("undefined"==typeof module?"undefined":_typeof(module))&&module.exports?module.exports=function(i,s){return void 0===s&&(s="undefined"!=typeof window?require("jquery"):require("jquery")(i)),t(s),s}:t(jQuery)}(function(t){return t.fn.tilt=function(i){var s=function(){this.ticking||(requestAnimationFrame(g.bind(this)),this.ticking=!0)},e=function(){var i=this;t(this).on("mousemove",o),t(this).on("mouseenter",a),this.settings.reset&&t(this).on("mouseleave",h),this.settings.glare&&t(window).on("resize",u.bind(i))},n=function(){var i=this;void 0!==this.timeout&&clearTimeout(this.timeout),t(this).css({transition:this.settings.speed+"ms "+this.settings.easing}),this.settings.glare&&this.glareElement.css({transition:"opacity "+this.settings.speed+"ms "+this.settings.easing}),this.timeout=setTimeout(function(){t(i).css({transition:""}),i.settings.glare&&i.glareElement.css({transition:""})},this.settings.speed)},a=function(i){this.ticking=!1,t(this).css({"will-change":"transform"}),n.call(this),t(this).trigger("tilt.mouseEnter")},r=function(i){return"undefined"==typeof i&&(i={pageX:t(this).offset().left+t(this).outerWidth()/2,pageY:t(this).offset().top+t(this).outerHeight()/2}),{x:i.pageX,y:i.pageY}},o=function(t){this.mousePositions=r(t),s.call(this)},h=function(){n.call(this),this.reset=!0,s.call(this),t(this).trigger("tilt.mouseLeave")},l=function(){var i=t(this).outerWidth(),s=t(this).outerHeight(),e=t(this).offset().left,n=t(this).offset().top,a=(this.mousePositions.x-e)/i,r=(this.mousePositions.y-n)/s,o=(this.settings.maxTilt/2-a*this.settings.maxTilt).toFixed(2),h=(r*this.settings.maxTilt-this.settings.maxTilt/2).toFixed(2),l=Math.atan2(this.mousePositions.x-(e+i/2),-(this.mousePositions.y-(n+s/2)))*(180/Math.PI);return{tiltX:o,tiltY:h,percentageX:100*a,percentageY:100*r,angle:l}},g=function(){return this.transforms=l.call(this),this.reset?(this.reset=!1,t(this).css("transform","perspective("+this.settings.perspective+"px) rotateX(0deg) rotateY(0deg)"),void(this.settings.glare&&(this.glareElement.css("transform","rotate(180deg) translate(-50%, -50%)"),this.glareElement.css("opacity","0")))):(t(this).css("transform","perspective("+this.settings.perspective+"px) rotateX("+("x"===this.settings.axis?0:this.transforms.tiltY)+"deg) rotateY("+("y"===this.settings.axis?0:this.transforms.tiltX)+"deg) scale3d("+this.settings.scale+","+this.settings.scale+","+this.settings.scale+")"),this.settings.glare&&(this.glareElement.css("transform","rotate("+this.transforms.angle+"deg) translate(-50%, -50%)"),this.glareElement.css("opacity",""+this.transforms.percentageY*this.settings.maxGlare/100)),t(this).trigger("change",[this.transforms]),void(this.ticking=!1))},c=function(){var i=this.settings.glarePrerender;if(i||t(this).append('<div class="js-tilt-glare"><div class="js-tilt-glare-inner"></div></div>'),this.glareElementWrapper=t(this).find(".js-tilt-glare"),this.glareElement=t(this).find(".js-tilt-glare-inner"),!i){var s={position:"absolute",top:"0",left:"0",width:"100%",height:"100%"};this.glareElementWrapper.css(s).css({overflow:"hidden"}),this.glareElement.css({position:"absolute",top:"50%",left:"50%","pointer-events":"none","background-image":"linear-gradient(0deg, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%)",width:""+2*t(this).outerWidth(),height:""+2*t(this).outerWidth(),transform:"rotate(180deg) translate(-50%, -50%)","transform-origin":"0% 0%",opacity:"0"})}},u=function(){this.glareElement.css({width:""+2*t(this).outerWidth(),height:""+2*t(this).outerWidth()})};return t.fn.tilt.destroy=function(){t(this).each(function(){t(this).find(".js-tilt-glare").remove(),t(this).css({"will-change":"",transform:""}),t(this).off("mousemove mouseenter mouseleave")})},t.fn.tilt.getValues=function(){var i=[];return t(this).each(function(){this.mousePositions=r.call(this),i.push(l.call(this))}),i},t.fn.tilt.reset=function(){t(this).each(function(){var i=this;this.mousePositions=r.call(this),this.settings=t(this).data("settings"),h.call(this),setTimeout(function(){i.reset=!1},this.settings.transition)})},this.each(function(){var s=this;this.settings=t.extend({maxTilt:t(this).is("[data-tilt-max]")?t(this).data("tilt-max"):20,perspective:t(this).is("[data-tilt-perspective]")?t(this).data("tilt-perspective"):300,easing:t(this).is("[data-tilt-easing]")?t(this).data("tilt-easing"):"cubic-bezier(.03,.98,.52,.99)",scale:t(this).is("[data-tilt-scale]")?t(this).data("tilt-scale"):"1",speed:t(this).is("[data-tilt-speed]")?t(this).data("tilt-speed"):"400",transition:!t(this).is("[data-tilt-transition]")||t(this).data("tilt-transition"),axis:t(this).is("[data-tilt-axis]")?t(this).data("tilt-axis"):null,reset:!t(this).is("[data-tilt-reset]")||t(this).data("tilt-reset"),glare:!!t(this).is("[data-tilt-glare]")&&t(this).data("tilt-glare"),maxGlare:t(this).is("[data-tilt-maxglare]")?t(this).data("tilt-maxglare"):1},i),this.init=function(){t(s).data("settings",s.settings),s.settings.glare&&c.call(s),e.call(s)},this.init()})},t("[data-tilt]").tilt(),!0});}(jQuery);

/* Theia Sticky 1.6.0 */
!function(i){"use strict";i.fn.theiaStickySidebar=function(t){function e(t,e){var a=o(t,e);a||(console.log("TSS: Body width smaller than options.minWidth. Init is delayed."),i(document).on("scroll."+t.namespace,function(t,e){return function(a){var n=o(t,e);n&&i(this).unbind(a)}}(t,e)),i(window).on("resize."+t.namespace,function(t,e){return function(a){var n=o(t,e);n&&i(this).unbind(a)}}(t,e)))}function o(t,e){return t.initialized===!0||!(i("body").width()<t.minWidth)&&(a(t,e),!0)}function a(t,e){t.initialized=!0;var o=i("#theia-sticky-sidebar-stylesheet-"+t.namespace);0===o.length&&i("head").append(i('<style id="theia-sticky-sidebar-stylesheet-'+t.namespace+'">.theiaStickySidebar:after {content: ""; display: table; clear: both;}</style>')),e.each(function(){function e(){a.fixedScrollTop=0,a.sidebar.css({"min-height":"1px"}),a.stickySidebar.css({position:"static",width:"",transform:"none"})}function o(t){var e=t.height();return t.children().each(function(){e=Math.max(e,i(this).height())}),e}var a={};if(a.sidebar=i(this),a.options=t||{},a.container=i(a.options.containerSelector),0==a.container.length&&(a.container=a.sidebar.parent()),a.sidebar.parents().css("-webkit-transform","none"),a.sidebar.css({position:a.options.defaultPosition,overflow:"visible","-webkit-box-sizing":"border-box","-moz-box-sizing":"border-box","box-sizing":"border-box"}),a.stickySidebar=a.sidebar.find(".theiaStickySidebar"),0==a.stickySidebar.length){var s=/(?:text|application)\/(?:x-)?(?:javascript|ecmascript)/i;a.sidebar.find("script").filter(function(i,t){return 0===t.type.length||t.type.match(s)}).remove(),a.stickySidebar=i("<div>").addClass("theiaStickySidebar").append(a.sidebar.children()),a.sidebar.append(a.stickySidebar)}a.marginBottom=parseInt(a.sidebar.css("margin-bottom")),a.paddingTop=parseInt(a.sidebar.css("padding-top")),a.paddingBottom=parseInt(a.sidebar.css("padding-bottom"));var r=a.stickySidebar.offset().top,d=a.stickySidebar.outerHeight();a.stickySidebar.css("padding-top",1),a.stickySidebar.css("padding-bottom",1),r-=a.stickySidebar.offset().top,d=a.stickySidebar.outerHeight()-d-r,0==r?(a.stickySidebar.css("padding-top",0),a.stickySidebarPaddingTop=0):a.stickySidebarPaddingTop=1,0==d?(a.stickySidebar.css("padding-bottom",0),a.stickySidebarPaddingBottom=0):a.stickySidebarPaddingBottom=1,a.previousScrollTop=null,a.fixedScrollTop=0,e(),a.onScroll=function(a){if(a.stickySidebar.is(":visible")){if(i("body").width()<a.options.minWidth)return void e();if(a.options.disableOnResponsiveLayouts){var s=a.sidebar.outerWidth("none"==a.sidebar.css("float"));if(s+50>a.container.width())return void e()}var r=i(document).scrollTop(),d="static";if(r>=a.sidebar.offset().top+(a.paddingTop-a.options.additionalMarginTop)){var c,p=a.paddingTop+t.additionalMarginTop,b=a.paddingBottom+a.marginBottom+t.additionalMarginBottom,l=a.sidebar.offset().top,f=a.sidebar.offset().top+o(a.container),h=0+t.additionalMarginTop,g=a.stickySidebar.outerHeight()+p+b<i(window).height();c=g?h+a.stickySidebar.outerHeight():i(window).height()-a.marginBottom-a.paddingBottom-t.additionalMarginBottom;var u=l-r+a.paddingTop,S=f-r-a.paddingBottom-a.marginBottom,y=a.stickySidebar.offset().top-r,m=a.previousScrollTop-r;"fixed"==a.stickySidebar.css("position")&&"modern"==a.options.sidebarBehavior&&(y+=m),"stick-to-top"==a.options.sidebarBehavior&&(y=t.additionalMarginTop),"stick-to-bottom"==a.options.sidebarBehavior&&(y=c-a.stickySidebar.outerHeight()),y=m>0?Math.min(y,h):Math.max(y,c-a.stickySidebar.outerHeight()),y=Math.max(y,u),y=Math.min(y,S-a.stickySidebar.outerHeight());var k=a.container.height()==a.stickySidebar.outerHeight();d=(k||y!=h)&&(k||y!=c-a.stickySidebar.outerHeight())?r+y-a.sidebar.offset().top-a.paddingTop<=t.additionalMarginTop?"static":"absolute":"fixed"}if("fixed"==d){var v=i(document).scrollLeft();a.stickySidebar.css({position:"fixed",width:n(a.stickySidebar)+"px",transform:"translateY("+y+"px)",left:a.sidebar.offset().left+parseInt(a.sidebar.css("padding-left"))-v+"px",top:"0px"})}else if("absolute"==d){var x={};"absolute"!=a.stickySidebar.css("position")&&(x.position="absolute",x.transform="translateY("+(r+y-a.sidebar.offset().top-a.stickySidebarPaddingTop-a.stickySidebarPaddingBottom)+"px)",x.top="0px"),x.width=n(a.stickySidebar)+"px",x.left="",a.stickySidebar.css(x)}else"static"==d&&e();"static"!=d&&1==a.options.updateSidebarHeight&&a.sidebar.css({"min-height":a.stickySidebar.outerHeight()+a.stickySidebar.offset().top-a.sidebar.offset().top+a.paddingBottom}),a.previousScrollTop=r}},a.onScroll(a),i(document).on("scroll."+a.options.namespace,function(i){return function(){i.onScroll(i)}}(a)),i(window).on("resize."+a.options.namespace,function(i){return function(){i.stickySidebar.css({position:"static"}),i.onScroll(i)}}(a)),"undefined"!=typeof ResizeSensor&&new ResizeSensor(a.stickySidebar[0],function(i){return function(){i.onScroll(i)}}(a))})}function n(i){var t;try{t=i[0].getBoundingClientRect().width}catch(i){}return"undefined"==typeof t&&(t=i.width()),t}var s={containerSelector:"",additionalMarginTop:0,additionalMarginBottom:0,updateSidebarHeight:!0,minWidth:0,disableOnResponsiveLayouts:!0,sidebarBehavior:"modern",defaultPosition:"relative",namespace:"TSS"};return t=i.extend(s,t),t.additionalMarginTop=parseInt(t.additionalMarginTop)||0,t.additionalMarginBottom=parseInt(t.additionalMarginBottom)||0,e(t,this),this}}(jQuery);

/* Codevz Watch 1.1 */
!function(n,t){"use strict";var e=function(n,t,e){var r;return function(){var u=this,i=arguments;r?clearTimeout(r):e&&n.apply(u,i),r=setTimeout(function(){e||n.apply(u,i),r=null},t||100)}};jQuery.fn[t]=function(n){return n?this.on("DOMNodeInserted DOMNodeRemoved",e(n)):this.trigger(t)}}(jQuery,"codevzWatch");

/* Codevz plus 2.7 */
var Codevz_Plus = (function($) {
	"use strict";

	if ( ! $.fn.codevz ) {
		$.fn.codevz = function( n, i ) {
			$( this ).each(function( a ) {
				var e = $( this );

				if ( e.data( 'codevz' ) !== n || $( '.vc_editor' ).length ) {
					i.apply( e.data( 'codevz', n ), [a] );
				}
			});
		}
	}

	var body = $( 'body' ),
		wind = $( window ),
		lightbox_exclude = '.product a,.esgbox,.jg-entry,.prettyphoto,.cz_grid_title,.ngg-fancybox,.fancybox,.lightbox',
		lightbox_selector = '.cz_lightbox:not(.cz_no_lightbox),.cz_a_lightbox:not(.cz_no_lightbox) a:not(.cz_no_lightbox),a[href*="youtube.com/watch?"]:not(.cz_no_lightbox),a[href*="youtu.be/watch?"]:not(.cz_no_lightbox),a[href*="vimeo.com/"]:not(.cz_no_lightbox),a[href*=".jpg"]:not(' + lightbox_exclude + '),a[href*=".jpeg"]:not(' + lightbox_exclude + '),a[href*=".png"]:not(' + lightbox_exclude + '),a[href*=".gif"]:not(' + lightbox_exclude + ')',
		runScrollTime = 0;

	return {
		init: function() {
			this.popup();
			this.css();
			this.tabs();
			this.tilt();
			this.menus();
			this.login();
			this.counter();
			this.lazyLoad();
			this.parallax();
			this.accordion();
			this.countdown();
			this.backtotop();
			this.separator();
			this.nicescroll();
			this.image_zoom();
			this.content_box();
			this.extra_panel();
			this.woocommerce();
			this.team_tooltip();
			this.lightGallery();
			this.progress_bar();
			this.inline_video();
			this.before_after();
			this.sticky_columns();
			this.show_more_less();
			this.responsive_text();
			this.dwqa_textarea_lh();
			this.load_google_map_js();
			this.working_hours_line();
			this.fix_wp_editor_google_fonts();
			this.runScroll();
		},

		/*
		 *  Trigger scroll
		 */
		runScroll: function() {
			clearTimeout( runScrollTime );
			runScrollTime = setTimeout(function() {

				Codevz_Plus.fix_vc_stretch();

				if ( ! $( '.compose-mode').length ) {
					wind.trigger( 'resize' );
				}

				wind.trigger( 'scroll' );

			}, 500 );
		},

		/*
		 *  Check element in viewport
		 */
		inview: function( e, i ) {
			var docViewTop = wind.scrollTop(),
				docViewBottom = docViewTop + wind.height(),
				elemTop = e.offset().top,
				elemBottom = elemTop + e.height();

			i = i ? 800 : 0;
			return ( ( elemTop <= docViewBottom + i ) && ( elemBottom >= docViewTop - i ) );
		},

		/*
		 *  Fix VC stretch row for boxed layouts
		 */
		fix_vc_stretch: function() {
			if ( $( '.layout_1, .layout_2' ).length ) {
				if ( $( '[data-vc-stretch-content]' ).length || $( '.compose-mode' ).length ) {
					wind.off( 'resize.cz_fix_row' ).on( 'resize.cz_fix_row', function() {
						setTimeout(function() {
							$( '[data-vc-stretch-content]' ).each(function() {
								var la = $( '.inner_layout' ),
									eh = ( la.width() - la.find( '.page_content > .row' ).width() ) / 2;

								$( this ).css({
									'width': la.width(),
									'left': body.hasClass( 'rtl' ) ? eh : -eh,
									'margin-left': 0,
									'margin-right': 0,
								});
							});
						}, 200 );
					});

					// Fix front-end
					if ( $( '.compose-mode' ).length ) {
						setTimeout(function() {
							wind.trigger( 'resize' );
						}, 100 );
					}
				}
			}
		},

		/*
		*   Responsive smart font size
		*/
		responsive_text: function() {
			var px_to_vw = function( s, w ) {
					var n = s.match(/\d+/) - 2, v = ( n / (w / 100 ));
					return v > 2 ? v + 'vw' : n + 'px';
				},
				elms = $( '.cz_smart_fs' ).find( '.cz_wpe_content [style*="font-size"]' ),
				winWidth, cz = 'resize.cz_responsive_text';

			if ( elms.length ) {
				wind.off( cz ).on( cz, function() {
					winWidth = wind.width();
					if ( winWidth <= 1170 ) {
						elms.removeClass( 'js_smart_fs' ).codevz( 'smart_fs', function() {
							var en = $( this ), style, match;

							if ( en.attr( 'data-ori-style' ) ) {
								return;
							}

							if ( ! en.attr( 'data-ori-style' ) ) {
								style = en.attr( 'style' );
								en.attr( 'data-ori-style', style );
							}

							match = style.match( /font-size: \d+.\w+px|font-size: \w+px/ );

							if ( match ) {
								var nu = match[0].match( /\d+/ );
								if ( nu && nu[0] > 18 ) {
									var vw = px_to_vw( match[0], winWidth ),
										cw = en.closest( '.cz_wpe_content' ).width(),
										pw = en.closest( '.cz_smart_fs' ).parent().width();

									if ( cw > pw ) {
										var tt = pw / cw;
										vw = vw.match(/\d+/) * tt;
										if ( winWidth == pw ) {
											vw = vw - 2;
										}
										vw = ( vw - 2 ) + 'vw';
									}

									vw && en.attr( 'style', style.replace( match[0], 'font-size: ' + vw ) );
								}
							}
						});
					} else {
						$( '[data-ori-style]' ).each(function() {
							var en = $( this );
							en.attr( 'style', en.attr( 'data-ori-style' ) ).removeAttr( 'data-ori-style' );
						});
					}
				});
			}
		},

		/*
		*   Move all data styles to head
		*/
		css: function() {
			$( '[data-cz-style]' ).codevz( 'data_style', function() {
				var d = $( this ), s = d.data( 'cz-style' );
				
				if ( ! $( '#codevz_inline_styles' ).length ) {
					$( 'head' ).append( '<style id="codevz_inline_styles"></style>' );
				}

				$( '#codevz_inline_styles' ).append( s );
				setTimeout(function() {
					d.removeAttr( 'data-cz-style' );
				}, 500 );
			});
		},

		/*
		*   lightGallery
		*/
		lightGallery: function() {
			if ( $.fn.lightGallery && ! body.hasClass( 'no_lightbox' ) ) {
				var d = body.data( 'lightGallery' );

				d && d.destroy( true );
				$( '.codevz_ajax' ).find( lightbox_selector ).addClass( 'no-ajax' );
				body.attr( 'data-lightGallery', 1 ).lightGallery({selector: lightbox_selector});
			}
		},

		/*
		*   Sticky columns
		*/
		sticky_columns: function() {

			// Fixed Side
			$( '.fixed_side' ).codevz( 'fixed_side', function() {
				var en 		= $( this ),
					ff_pos 	= en.hasClass( 'fixed_side_left' ) ? 'left' : 'right',
					inla 	= $( '.inner_layout' );

				// Sticky
				en.theiaStickySidebar({additionalMarginTop: 0,updateSidebarHeight: false});

				// Size's
				wind.on( 'resize', function() {
					if ( en.css( 'display' ) === 'none' ) {
						inla.css( 'width', '100%' );
					} else {
						en.css( 'height', wind.height() - parseInt( $( '#layout' ).css( 'marginTop' ) + body.css( 'marginTop' ) ) );
						inla.css( 'width', 'calc( 100% - ' + en.outerWidth() + 'px )' );
					}
				});
			});

			// Sticky sidebars & content
			$( '.cz_sticky .row > aside, .cz_sticky_col' ).codevz( 'sticky', function() {
				$( this ).theiaStickySidebar({additionalMarginTop: ( $( '.header_is_sticky:not(.smart_sticky)' ).height() + 60 ),updateSidebarHeight: false});
			});
		},

		/*
		*   Back to top button
		*/
		backtotop: function() {
			$( '.backtotop, a[href*="#top"]' ).codevz( 'backtotop', function() {
				var en = $( this );

				en.on( 'click', function( e ) {
					$( 'html, body' ).animate({scrollTop: 0}, 1200, 'easeInOutExpo');
					e.preventDefault();
				});

				if ( en.hasClass( 'backtotop' ) ) {
					wind.on( 'scroll', function() {
						if ( $( this ).scrollTop() < 600 ) {
							en.fadeOut( 'fast' ).next( '.fixed_contact' ).css({right: 30});
						} else {
							en.fadeIn( 'fast' ).next( '.fixed_contact' ).css({right: ( en.outerHeight() + 34 )});

							// JivoChat FIX
							var jch = $( '._bottom_3v' );
							if ( jch.length ) {

								if ( $( '.headerBox_2k' ).css( 'display' ) == 'block' ) {
									jch = $( '.headerBox_2k' ).height() - 20;
								} else {
									jch = jch.height() - 20;
								}
								
								en.css( 'marginBottom', jch ).next( '.fixed_contact' ).css( 'marginBottom', jch );

							} else if ( $( '.__jivoMobileButton' ).length ) {

								jch = $( '.__jivoMobileButton' ).height() - 10;

								en.css( 'marginBottom', jch ).next( '.fixed_contact' ).css( 'marginBottom', jch );

							}
						}
					});
				}
			});

			// Fixed contact form
			$( '.fixed_contact' ).codevz( 'fixed_contact', function() {
				$( this ).on( 'click', function(e) {
					$( this ).next('.fixed_contact').fadeToggle( 'fast' ).css({bottom: $( this ).height() + parseInt( $( this ).css('margin-bottom') ) + 40 });
					e.stopPropagation();
				});
				body.on( 'click', function (e) {
					if ( $( 'div.fixed_contact' ).is(':visible') ) {
						$( 'div.fixed_contact' ).fadeOut( 'fast' );
					}
				});
			});
		},

		/*
		*   Line between working hours content
		*/
		working_hours_line: function() {
			wind.off( 'resize.cz_whlb' ).on( 'resize.cz_whlb', function() {
				$( '.cz_wh_line_between .cz_wh_line' ).codevz( 'whlb', function() {
					var en = $( this ), 
						pa = en.parent(), 
						ic = pa.find( 'span i' ),
						ll = pa.find( '.cz_wh_left b' ).outerWidth( true ) + ( ic.length ? ic.outerWidth( true ) + 8 : 0 ) + 12 + 'px',
						rr = pa.find( '.cz_wh_right' ).outerWidth( true ) + 12 + 'px',
						is_rtl = body.hasClass( 'rtl' );

					en.attr( 'style', en.attr( 'style' ) ).css({
						'left': ( is_rtl ? rr : ll ),
						'right': ( is_rtl ? ll : rr )
					});
				});
			});
		},

		/*
		*   Team members tooltip
		*/
		team_tooltip: function() {
			body.on({
				mouseenter: function () {
					$( '.cz_team_content', this ).fadeIn( 100 );
				},
				mouseleave: function () {
					$( '.cz_team_content', this ).fadeOut( 100 );
				},
				mousemove: function (e) {
					var w  = $( '.cz_team_content', this ).width() / 2,
						x = e.offsetX,
						y = e.offsetY + 30;

					$( '.cz_team_content', this ).css({top: y, left: x});
				}
			}, '.cz_team_6 .cz_team_img, .cz_team_7 .cz_team_img' );
		},

		/*
		*   String to slug
		*/
		stringToSlug: function( str ) {
			var s = '',
				t = $.trim( str );

			s = t.replace(/[^a-z0-9-]/gi, '-').replace(/-+/g, '_').replace(/^-|-$/g, '');
			return s.toLowerCase();
		},

		/*
		*   Fix missed google fonts
		*/
		fix_wp_editor_google_fonts: function() {
			$( '.wpb_text_column, .cz_wpe_content' ).find( '[style*="font-family"]' ).not( 'i' ).codevz( 'fonts', function() {
				var f_fonts = [], o_fonts, el, id, defs;

				el = $( this ).css( 'font-family' ),
				defs = [
					'FontAwesome', 
					'fontelo', 
					'Open Sans', 
					'Arial', 
					'Impact', 
					'monospace', 
					'Tahoma', 
					'sans-serif', 
					'Sans serif', 
					'VC-Icons', 
					'Arial Black', 
					'Comic Sans MS', 
					'Lucida Sans Unicode', 
					'Trebuchet MS', 
					'Verdana', 
					'Courier New', 
					'Lucida Console', 
					'Palatino Linotype', 
					'Times New Roman'
				];

				if ( typeof el !== 'undefined' && el && f_fonts.indexOf( el ) == -1 && defs.indexOf( el ) == -1 && el.indexOf( ',' ) <= 0 ) {
					f_fonts.push( el );
				}

				$('link[href*="fonts.googleapis.com"]').each(function() {
					o_fonts += $( this ).attr( 'href' );
				});
				$.each(f_fonts, function(n, i) {
					i = i.replace( /\s/g, '+' ).replace( /\"|\'/g, '' ),
					id = 'cz_gfont_' + Codevz_Plus.stringToSlug( i );

					if ( o_fonts && o_fonts.indexOf( i ) <= 0 && ! $( '#' + id ).length ) {
						$( 'head' ).append( '<link id="' + id + '" href="https://fonts.googleapis.com/css?family=' + i + ':100,200,300,400,500,600,700,800,900" rel="stylesheet">' );
					}
				});
			});
		},

		/*
		*   Popup modal box
		*/
		popup: function( i ) {
			$( '.cz_popup_modal' ).codevz( 'popup_clone', function() {
				var en 		= $( this ),
					outer 	= en.parent();

				// Move popup to footer
				if ( outer.length && ! en.closest( '.vc_cz_popup' ).length ) {
					body.append( outer[0].outerHTML);
					outer.remove();
				}
			});

			// Reset wpb bar
			if ( $( '.compose-mode' ).length ) {
				$( '.cz_edit_popup_link', parent.document.body ).remove();
			}

			$( '.cz_popup_modal' ).each(function() {
				var dis = $( this ),
					idd = dis.attr( 'id' ),
					ovl = dis.data( 'overlay-bg' ),
					par = $( '#' + idd ).closest( '.vc_cz_popup' ),
					lcj;

				// Fix CF7 Pro inside Popup
				if ( typeof cz_scripts != 'undefined' && ! $( '.cz_ajax_loader' ).length && dis.find( '.wpcf7' ).length ) {
					if ( typeof cz_scripts.cf7 != 'undefined' ) {
						lcj = document.createElement("script");
						lcj.type = "text/javascript";
						lcj.src = cz_scripts.cf7;
						document.getElementsByTagName("body")[0].appendChild( lcj );
					}
				}

				// Fix lightbox
				if ( $.fn.lightGallery ) {
					$( '#' + idd ).lightGallery({selector: lightbox_selector});
				}

				// Open popup
				$( "a[href*='#" + idd + "']" ).off().on( 'click', function(e) {
					par.fadeIn( 'fast' );
					$( '#' + idd ).fadeIn( 'fast' ).delay( 1000 ).addClass( 'cz_show_popup' );
					$( '.cz_overlay', dis ).css( 'background', ovl ).fadeIn( 'fast' );
					
					if ( typeof Codevz_Plus.slick != 'undefined' ) {
						Codevz_Plus.slick();
					}

					Codevz_Plus.nicescroll();

					e.preventDefault();
				});

				// Fix multiple same popup
				dis.attr( 'data-popup', idd );

				// Start
				if ( $( '#' + idd ).length ) {

					// WPBakery frontend
					if ( par.length ) {

						// Add popup link to wpb bar
						$( '#' + idd ).each(function() {
							$( '.vc_navbar-nav', parent.document.body ).append( '<li class="vc_pull-right cz_edit_popup_link"><a class="vc_icon-btn vc_post-settings edit_' + idd + '" data-id="' + idd + '" href="#' + idd + '" title="Popup: ' + idd + '"><i class="vc-composer-icon fa fa-window-restore" style="font-family: FontAwesome !important"></i></li>' );
						});

						// Set popup styling
						par.attr( 'style', $( '#' + idd ).attr( 'style' ) );				

						// Open popup
						$( '.edit_' + idd, parent.document.body ).off().on( 'click', function(e) {
							par.fadeIn( 'fast' );
							$( '#' + idd ).fadeIn( 'fast' ).delay( 1000 ).addClass( 'cz_show_popup' );
							$( '.cz_overlay', dis ).css( 'background', ovl ).fadeIn( 'fast' );
							e.preventDefault();
						});

						// Delete popup
						$( "#" + idd + " .cz_close_popup, #cz_close_popup, .cz_overlay, a[href*='#cz_close_popup']" ).off();
						$( '.vc_control-btn-delete', par ).on('click', function() {
							$( '.edit_' + idd, parent.document.body ).closest( 'li' ).remove();
						});
					}

					// Close popup
					$( "#" + idd + " .cz_close_popup, #cz_close_popup, .cz_overlay, a[href*='#cz_close_popup']" ).on( 'click', function(e) {
						$( '.cz_overlay' ).fadeOut( 'fast' ).removeClass( 'cz_show_popup' ).css( 'background', '' );
						$( '.vc_cz_popup, .vc_cz_popup, #' + idd ).hide().removeClass( 'cz_show_popup' );

						// Check session for future visits
						if ( dis.hasClass( 'cz_popup_show_once' ) ) {
							localStorage.setItem( idd, 1 );
						}

						// Fix nice scroll popup
						if ( dis.find( '[data-nice]' ).length ) {
							var pa = dis.find( '[data-nice]' ).parent();
							pa.getNiceScroll().remove();
						}
					});

					// If popup is always show, then remove session
					if ( dis.hasClass( 'cz_popup_show_always' ) && localStorage.getItem( idd ) ) {
						localStorage.removeItem( idd );
					}

					// Check visibility mode on page load
					if ( dis.hasClass( 'cz_popup_page_start' ) && ! localStorage.getItem( idd ) ) {
						$( '.vc_cz_popup, #' + idd ).fadeIn( 'fast' ).delay( 1000 ).addClass( 'cz_show_popup' );
						$( '.cz_overlay', dis ).css( 'background', ovl ).fadeIn( 'fast' );
						setTimeout(function(){
							if ( typeof Codevz_Plus.slick != 'undefined' ) {
								Codevz_Plus.slick();
							}
						}, 1000 );
					} else if ( dis.hasClass( 'cz_popup_page_loaded' ) && ! localStorage.getItem( idd ) ) {
						wind.on( 'load', function() {
							$( ' .vc_cz_popup, #' + idd ).fadeIn( 'fast' ).delay( 1000 ).addClass( 'cz_show_popup' );
							$( '.cz_overlay', dis ).css( 'background', ovl ).fadeIn( 'fast' );
							setTimeout(function(){
								if ( typeof Codevz_Plus.slick != 'undefined' ) {
									Codevz_Plus.slick();
								}
							}, 1000 );
						});
					}
				} else {
					console.log( 'Popup not found, id: #' + idd );
				}
			});
		},

		/*
		*   Tabs
		*/
		tabs: function() {
			$( '.compose-mode' ).length && $( '.cz_tabs' ).data( 'js_tabs', 0 );
			$( '.cz_tabs' ).codevz( 'tabs', function() {
				var dis = $( this ),
					nav = dis.hasClass( 'cz_tabs_nav_after' ) ? 'append' : 'prepend';

				// Convert tabs nav
				if ( ! $( '.cz_tabs_nav', dis ).length ) {
					dis[nav]( '<div class="cz_tabs_nav clr"><div class="clr"></div></div>' );
				}
				$( '.cz_tabs_nav div', dis ).html('');

				$( '.cz_tab_a', dis ).each(function() {
					$( '.cz_tabs_nav div', dis ).prepend( $( this ).removeClass( 'vc_empty-element' ).clone() );
				});
				
				// Mobile dropdown
				if ( ! dis.find( '> select' ).length ) {
					dis.prepend( '<select />' );
				}
				$( '.cz_tabs_nav div a', dis ).each(function() {
					dis.find( '> select' ).append( $( '<option />' ).attr( 'value', $(this).data( 'tab' ) ).html( $(this).text() ) );
				});
				dis.find( '> select' ).on( 'change', function() {
					dis.find( 'a[data-tab="' + this.value + '"]' ).trigger( 'click' );
				});
				
				// onClick tabs nav
				var click = dis.hasClass( 'cz_tabs_on_hover' ) ? 'hover click' : 'click';
				$( '.cz_tab_a' ).on( click, function() {
					var en  = $( this ),
						id  = en.data( 'tab' ),
						par = en.closest('.cz_tabs'),
						tab = $( '#' + id, par );

					if ( tab.is(':visible') && en.attr( 'href' ).length < 2 ) {
						return false;
					}

					// Set tab active class
					en.addClass('active cz_active').siblings().removeClass('active cz_active');

					if ( $( '.compose-mode' ).length ) {
						$( '.cz_tab', par ).closest( '.vc_cz_tab' ).hide();
						tab.closest( '.vc_cz_tab' ).show();
					} else {
						$( '.cz_tab', par ).hide();
						tab.show();
					}

					// Fix grid
					if ( tab.find( '.cz_grid' ).data( 'isotope' ) ) {
						setTimeout(function() {
							tab.find( '.cz_grid' ).isotope( 'layout' );
						}, 100 );
					}

					if ( tab.find( '.cz_grid_carousel' ).hasClass( 'slick-slider' ) ) {
						setTimeout(function() {
							tab.find( '.cz_grid_carousel' ).slick( 'reinit' );
						}, 100 );
					}

					if ( en.attr( 'href' ).length < 2 ) {
						return false;
					}
				});

				// Activate first
				$( '.cz_tabs_nav a', dis ).removeClass( 'hide' )[ ( $( '.compose-mode' ).length ? 'last' : 'first' ) ]().trigger( 'click' ).addClass('active cz_active');
			});
		},

		/*
		*   Apply line height 4 tinymce DWQA
		*/
		dwqa_textarea_lh: function() {
			$( '.mce-container iframe' ).codevz( 'mce', function() {
				var en = $( this );

				setTimeout(function() {
					en.contents().find( 'head' ).append( '<style>body,body *{line-height:26px !important;font-size:16px;font-family:Open Sans}</style>' );
				}, 500 );
			});
		},

		/*
		*   Before & After, image comparission
		*/		
		before_after: function() {
			$( '.cz_image_container' ).codevz( 'b4a', function() {
				var c 		= $( this ), de = $( '.cz_handle', c ), re = $( '.cz_resize_img', c ),
					cz_1 	= 'mousedown.cz_b4a vmousedown.cz_b4a touchstart.cz_b4a', 
					cz 		= 'mousemove.cz_b4a vmousemove.cz_b4a touchmove.cz_b4a',
					cz_2 	= 'mouseup.cz_b4a vmouseup.cz_b4a touchend.cz_b4a',
					pageX, lv, wv;

				de.off( cz_1 ).on( cz_1, function(e) {
					pageX = ( e.type == 'touchstart' ) ? e.originalEvent.touches[0].pageX : e.pageX;

					de.addClass( 'draggable' );
					re.addClass( 'resizable' );
			 
					var dw = de.outerWidth(),
						xp = de.offset().left + dw - pageX,
						co = c.offset().left,
						cw = c.outerWidth(),
						minLeft = co + 10,
						maxLeft = co + cw - dw - 10;
					
					de.parents().off( cz ).on( cz, function(e) {
						pageX = ( e.type == 'touchmove' ) ? e.originalEvent.touches[0].pageX : e.pageX, 
						lv = pageX + xp - dw;
						
						if ( lv < minLeft ) {
							lv = minLeft;
						} else if ( lv > maxLeft) {
							lv = maxLeft;
						}
			 
						wv = (lv + dw/2 - co)*100/cw+'%';
						
						$( '.draggable', c ).css('left', wv).on( cz_2, function() {
							$(this).removeClass( 'draggable' );
							re.removeClass( 'resizable' );
							de.parents().off( cz );
						});
						$( '.resizable', c ).css('width', wv); 
						
					}).on( cz_2, function(e){
						de.removeClass( 'draggable' );
						re.removeClass( 'resizable' );
						de.parents().off( cz ).off( cz_2 );
					});
					e.preventDefault();
				}).on( cz_2, function(e) {
					de.removeClass( 'draggable' );
					re.removeClass( 'resizable' );
					de.parents().off( cz );
				});
			});
		},

		/*
		*   Woocommerce custom scripts
		*/
		woocommerce: function() {

			// Product quantity field
			if ( $( '.quantity' ).length ) {
				if ( ! $( '.quantity-nav' ).length ) {
					$('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter( '.quantity input' );
				}
				$( '.quantity' ).codevz( 'quantity', function() {
					var spinner = $(this),
						input = spinner.find('input[type="number"]'),
						btnUp = spinner.find('.quantity-up'),
						btnDown = spinner.find('.quantity-down'),
						min = input.attr('min') || 1,
						max = input.attr('max') || 999;

					$( '.quantity-nav' ).css( 'color', input.css( 'color' ) );

					btnUp.on( 'click', function() {
						var oldValue = parseFloat(input.val());
						if (oldValue >= max) {
							var newVal = oldValue;
						} else {
							var newVal = oldValue + 1;
						}
						spinner.find("input").val( newVal ).trigger("change");
					});

					btnDown.on( 'click', function() {
						var oldValue = parseFloat(input.val());
						if (oldValue <= min) {
							var newVal = oldValue;
						} else {
							var newVal = oldValue - 1;
						}
						spinner.find( "input" ).val( newVal ).trigger( "change" );
					});
				});
			}

			// Prevent submit login and register with empty inputs
			if ( $( '.woocommerce-form-login, .woocommerce-form-register' ).length ) {
				$( '.woocommerce-form-login, .woocommerce-form-register' ).on( 'click', 'button', function() {
					var check;

					$( this ).closest( 'form' ).find( 'input' ).css( 'animation', 'none' ).each(function() {
						if ( ! $( this ).val() ) {
							$( this ).select().css( 'animation', 'BtnFxAbsorber .8s forwards' );
							check = false;
							return false;
						} else {
							check = true;
						}
					});

					if ( ! check ) {
						return false;
					}
				});
			}

			// Disable product page lightbox
			$( '.woo-disable-lightbox .woocommerce-product-gallery__wrapper > div:first-child a' ).removeAttr( 'href' ).css( 'cursor', 'default' );
		},

		/*
		*   Extra panel
		*/
		extra_panel: function() {
			var h_top_bar = $( '.hidden_top_bar' ),
				c_overlay = '.cz_overlay';

			if ( h_top_bar.length ) {
				h_top_bar.on( 'click', function(e) {
					e.stopPropagation();
				});
				$( '> i', h_top_bar ).on( 'click', function (e) {
					$( c_overlay ).fadeToggle( 'fast' );
					$( this ).toggleClass( 'fa-angle-down fa-angle-up' );
					h_top_bar.toggleClass( 'show_hidden_top_bar' );
					e.stopPropagation();
				});
				body.on( 'click', function (e) {
					if ( $( '.show_hidden_top_bar' ).length ) {
						$( '> i', h_top_bar ).addClass( 'fa-angle-down' ).removeClass( 'fa-angle-up' );
						h_top_bar.removeClass( 'show_hidden_top_bar' );
						$( c_overlay ).fadeOut( 'fast' );
					}
				});
			}
		},

		/*
		*   Show More and Show Less
		*/
		show_more_less: function() {
			$( '.cz_sml' ).codevz( 'sml', function() {
				var dis = $( this ),
					h = $( '.cz_sml_inner', dis ).css( 'height' );

				$( '> a', dis ).off().on( 'click', function(e) {
					dis.toggleClass( 'cz_sml_open' );

					$( '.cz_sml_inner', dis ).animate({
						'height': dis.hasClass( 'cz_sml_open' ) ? $( '.cz_sml_inner div:first-child', dis ).outerHeight( true ) : h
					});

					e.preventDefault();
					return false;
				});
			});
		},

		/*
		*   Ajax login, register and pasword recovery
		*/
		login: function() {
			$( 'input, form' ).codevz( 'form', function() {
				$( this ).attr( 'autocomplete', 'off' );
			});

			// Forms slides
			$( '.cz_lrpr' ).codevz( 'lrpr', function() {
				var en = $( this );

				$( 'a[href*="#"]', en ).on( 'click', function(e) {
					$( this.hash, en ).slideDown().siblings().slideUp();
					e.preventDefault();
					return false;
				});
			});

			// Ajax submit form
			$( '.cz_lrpr form' ).codevz( 'lrprform', function() {
				var form = $( this ), 
					check = false, 
					inputs = form.find( 'input' );

				form.off().on( 'submit', function() {
					inputs.css( 'animation', 'none' ).each(function() {
						if ( ! $( this ).val() ) {
							$( this ).select().css( 'animation', 'BtnFxAbsorber .8s forwards' );
							check = false;
							return false;
						} else {
							check = true;
						}
					});

					if ( $( '.cz_loader', form ).length ) {
						return false;
					}

					if ( check ) {
						var btn = form.find( 'input[type="submit"]' );
						btn.attr( 'disabled', 'disabled' ).addClass( 'cz_loader' );
						form.find( '.cz_msg' ).slideUp( 100 );

						$.post( $( '#intro' ).data( 'ajax' ) || ajaxurl, form.serialize(), function( msg ) {
							if ( msg ) {
								form.find( '.cz_msg' ).html( msg ).slideDown( 100 );
								btn.removeClass( 'cz_loader' );
							} else {
								var redirect = form.closest( '.cz_lrpr' ).data( 'redirect' );
								if ( redirect ) {
									window.location = redirect;
								} else {
									window.location.reload( true );
								}
							}
							btn.removeAttr( 'disabled' );
						});
					}

					return false;
				});
			});
		},

		/*
		*   For visual composer draggable element
		*/
		front_end_draggable: function( s ) {
			setTimeout(function() {
				$( s ).codevz( 'vc_dde', function() {
					var en = $( this ),
						inner = $( '.cz_free_position_element, .cz_hotspot', en );

					en.css({'top': inner.data( 'top' ), 'left': inner.data( 'left' )}).draggable({
						drag: function() {
							var pos = $( this ).position(),
								col = $( this ).closest(".wpb_column");

							if ( ! $( ".ui-draggable", parent.document.body ).hasClass( 'vc_active' ) ) {
								$( '> .vc_controls .vc-c-icon-mode_edit', en ).trigger( 'click' );
							}

							$( ".css_top", parent.document.body ).val( pos.top / col.height() * 100 + "%" );
							$( ".css_left", parent.document.body ).val( pos.left / col.width() * 100 + "%" );
						}
					});

					inner.css({'top': 'auto', 'left': 'auto'});
				});
			}, 500 );
		},

		/*
		*   Click on image to view inline video
		*/
		inline_video: function() {
			$( '.cz_video_inline' ).codevz( 'video', function() {
				var en = $( this );

				$( '.cz_no_lightbox', en ).on('click', function(e) {
					var height = $( 'img', en ).height();

					if ( ! $( 'iframe', en ).length ) {
						var src = $( this ).attr( 'href' ),
							src = src.substr( src.indexOf( "=" ) + 1 ),
							iframe = '<iframe src="https://www.youtube-nocookie.com/embed/' + src + '?autoplay=1&amp;rel=0&amp;showinfo=0" allowfullscreen></iframe>';

							$( this ).fadeOut( 'fast' ).css('position','absolute');
							en.append( iframe );
							en.find('iframe').css({
								'position': 'relative',
								'width': '100%',
								'height': height
							});
					}

					if ( ! $( this ).parent().find('.close_inline_video').length ) {
						en.append('<i class="fa fa-remove close_inline_video"></i>');
						$( '.close_inline_video' ).on('click', function(e) {
							$( this ).parent().find('iframe').detach();
							$( this ).parent().find('.cz_no_lightbox').fadeIn( 'fast' ).css('position','relative');
							$( this ).detach();
						});
					}

					e.preventDefault();
				});

			});
		},

		/*
		*   Lazyload
		*/
		lazyLoad: function() {
			var time,
				$isotope,
				lazy = function() {
					clearTimeout( time );
					time = setTimeout(function() {
						$( 'img[data-src]' ).each(function() {
							var en = $( this ), 
								check = ( en.closest( '.cz_grid' ).length && ! en.closest( '.cz_tabs' ).length ) ? en.is( ':visible' ) : 1;

							if ( ! en.hasClass( 'lazyDone' ) && Codevz_Plus.inview( en, 1 ) && check ) {
								en.attr( 'src', en.data( 'src' ) ).attr( 'data-src', '' );

								if ( en.closest( '.cz_grid' ).data( 'isotope' ) ) {
									$isotope = en.closest( '.cz_grid' );
									en.parent().imagesLoaded().progress(function( imgLoad, image ) {
										$isotope.isotope( 'layout' );
										en.addClass( 'lazyDone' ).attr( 'srcset', en.data( 'srcset' ) ).attr( 'sizes', en.data( 'sizes' ) ).removeAttr( 'data-srcset data-sizes data-czlz' );
									});
								} else {
									en.parent().imagesLoaded().progress(function( imgLoad, image ) {
										en.addClass( 'lazyDone' ).attr( 'srcset', en.data( 'srcset' ) ).attr( 'sizes', en.data( 'sizes' ) ).removeAttr( 'data-srcset data-sizes data-czlz' );
									});
								}
							}
						});
					}, 50 );

					if ( ! $( '[data-czlz]' ).length ) {
						wind.off( 'scroll.cz_lazyload' );
					}
				};
			
			wind.on( 'scroll.cz_lazyload', lazy );
		},

		/*
		*   Parallax elements on Scroll and mouseMove
		*/
		parallax: function() {

			// On Mouse Move
			var mparallax = $( '[class^="cz_mparallax_"], [class*=" cz_mparallax_"]' );
			if ( mparallax.length ) {
				wind.off( 'mousemove.mparallax' ).on( 'mousemove.mparallax', function(e) {
					var w = $(window).width(),
						h = $(window).height(),
						x = e.pageX,
						y = e.pageY;

					mparallax.each(function() {
						if ( Codevz_Plus.inview( $( this ) ) ) {
							var en = $( this ),
								cl = en.attr( "class" ),
								sp = -( ( parseInt( cl.replace(/[^\d-]/g, "") ) || 50 ) * 10 ),
								xx  = parseInt( x - en.offset().left - ( parseInt( en.width() / 2 ) ) ),
								yy  = parseInt( y - en.offset().top - ( parseInt( en.height() / 2 ) ) ),
								xx  = xx / w,
								yy  = yy / h,
								tr = "translate3d(" + Math.round( xx * sp ) + "px," + Math.round( yy * sp ) + "px, 0px)";

							en.css({'transform': tr});
						}
					});
				});
			}

			// On Scroll
			var all = $( '[class^="cz_parallax_"], [class*=" cz_parallax_"]' ).not( '.js_parallax' ).length;
			$( '[class^="cz_parallax_"], [class*=" cz_parallax_"]' ).codevz( 'parallax', function( index ) {
				var b = $( this ),
					c = b.attr( "class" ),
					d = wind.height(),
					f = c ? c.replace(/[^\d-]/g, "") : "undefined";
				
				b.css({});
				"undefined" !== f && f && (f = parseInt(c.replace(/[^\d-]/g, "")) / 100);

			  var g, h, j, k = b,
				  l = ($(document).height(), k.offset().top),
				  m = (k.outerHeight(), f),
				  n = "foreground",
				  i = ( c.indexOf("_v_") >= 0 ) ? 'v' : 'h',
				  p = k.data("offset");

			  g = m ? m : 0, h = n, j = p ? p : 0;

			  wind.on("scroll.cz_parallax", function() {
				var b = $(document).height(),
					c = k.offset().top,
					e = (k.outerHeight(), $(this).scrollTop()) + 250,
					q = Math.round((c - e) * g), 
					r = Math.round((c - d / 2 - e) * g - j);

				if ( k.hasClass( 'cz_parallax_stop' ) ) {
					r = r<0 ? 0 : r;
				}

				"background" == h ? "v" == i && k.is(":in-viewport") ? k.css({
				  "background-position": "center " + -q + "px"
				}) : "h" == i && k.css({
				  "background-position": -q + "px center"
				}) : "foreground" == h && e < b && ("v" == i ? k.css({
				  transform: "translateY(" + r + "px)"
				}) : "h" == i && k.css({
				  transform: "translateX(" + r + "px)"
				}))
			  });

			    // Front
				if ( all == ( index + 1 ) ) {
					Codevz_Plus.runScroll();
				}
			});
		},

		/*
		*   Counter
		*/
		counter: function() {
			var all = $( '.cz_counter' ).length;
			
			$( '.cz_counter' ).codevz( 'counter', function(i) {
				var dis = $( this ), 
					del = wind.width() <= 480 ? 0 : parseInt( dis.data( 'delay' ) ) || 0, 
					eln = $( '.cz_counter_num', dis ),
					num = eln.text(),
					dur = parseInt( dis.data( 'duration' ) ),
					com = !dis.data( 'disable-comma' ),
					tls = com ? Math.ceil( num ).toLocaleString() : Math.ceil( num );

				// If duration is 0
				if ( dur == 0 || wind.width() <= 768 ) {
					eln.html( tls );
					return;
				}

				// If once done
				if ( dis.hasClass( 'done' ) ) {
					if ( num == '0' ) {
						dis.removeClass( 'done' );
					} else {
						return;
					}
				}
				eln.html('0');

				// On page scrolling
				wind.on( 'scroll.cz_counter', function() {
					if ( Codevz_Plus.inview( dis ) && ! dis.hasClass( 'done' ) ) {
						dis.addClass( 'done' ).delay( del ).prop( 'Counter', 0 ).animate({ Counter: parseInt( num ) }, {
							duration: dur,
							easing: 'swing',
							step: function () {
								num = com ? Math.ceil( this.Counter ).toLocaleString() : Math.ceil( this.Counter );
								eln.text( num );
							},
							complete: function() {
								eln.text( tls );
							}
						});
					}

					if ( ! $( '.cz_counter:not(.done)' ).length ) {
						wind.off( 'scroll.cz_counter' );
					}
				});

				// Front
				if ( all == ( i + 1 ) ) {
					Codevz_Plus.runScroll();
				}
			});
		},

		/*
		*   Accordion and Toggle
		*/
		accordion: function() {
			$( '.cz_acc' ).codevz( 'acc', function() {
				var acc = $( this ),
					arrows = acc.data( 'arrows' );

				// Add arrows
				$( '.cz_acc_open_icon, .cz_acc_close_icon', acc ).remove();
				$( '.cz_acc_child', acc ).append( '<i class="cz_acc_open_icon ' + arrows.open + '"></i><i class="cz_acc_close_icon ' + arrows.close + '"></i>' );

				// First open
				if ( acc.hasClass( 'cz_acc_first_open' ) ) {
					$( '> div > div:first', acc ).addClass( 'cz_isOpen' ).find( '.cz_acc_child_content' ).show();
					$( '> div > div:first .cz_acc_open_icon', acc ).hide().next('i').show();
				}
			});

			// onClick
			$( '.cz_acc_child' ).codevz( 'acc_child', function() {
				$( this ).off().on( 'click', function() {
					var dis = $( this ),
						clo = dis.closest('.cz_acc'),
						con = dis.next();

					if ( con.is(':visible') ) {
						$( '.cz_acc_open_icon', dis ).show().next('i').hide();
						con.slideUp().parent().removeClass( 'cz_isOpen' );
						return;
					}

					if ( ! clo.hasClass( 'cz_acc_toggle' ) ) {
						$( '.cz_acc_open_icon', clo ).show().next('i').hide();
						clo.find('.cz_acc_child_content').slideUp().parent().removeClass( 'cz_isOpen' );
					}

					$( '.cz_acc_open_icon', dis ).hide().next('i').show();
					con.slideToggle().parent().toggleClass( 'cz_isOpen' );

					// Fix grid
					if ( con.find( '.cz_grid' ).data( 'isotope' ) ) {
						setTimeout(function() {
							con.find( '.cz_grid' ).isotope( 'layout' );
						}, 250 );
					}

					return false;
				});
			});
		},

		/*
		*   Split content box to two section
		*/
		content_box: function() {
			$( '.cz_split_box_left, .cz_split_box_right' ).codevz( 'split_box', function() {
				var dis = $( this ),
					fnc = function() {
						$( '.cz_split_box', dis ).css( 'height', $( '.cz_box_front', dis ).height() );

						if ( ! dis.hasClass( 'cz_box_hide_arrow' ) && ! dis.find( '.cz_box_front_inner > span' ).length ) {
							dis.find( '.cz_box_front_inner' ).prepend( '<span></span>' );
						}
					};

				dis.parent().find( '.cz_box_front_inner' ).off().codevzWatch( function() {
					fnc();
				});

				wind.on( 'resize.cz_split_box', function() {
					fnc();
				});
			});

			// Content box scroll
			setTimeout(function() {
				$( '.cz_scroll' ).codevz( 'cb_scroll', function() {
					$( this ).niceScroll({
						cursorcolor: $( this ).data( 'scroll-color' ) ? $( this ).data( 'scroll-color' ) : "#111111",
						railpadding: {top: 20, right: 10, left: 10, bottom: 20},
						cursoropacitymin: 0.4,
						cursoropacitymax: 1,
						cursorwidth: "5px",
						cursorborderradius: "50px",
						cursorborder: "0"
					});
				});
			}, 50 );

			// Flip box live
			if ( $( '.compose-mode' ).length && $( '.cz_box_backed' ).length && ! $( '.cz_vc_disable_flipbox', parent.document.body ).length ) {
				
				$( '.cz_vc_preview', parent.document.body ).after( '<li class="vc_pull-right cz_vc_disable_flipbox"><a href="javascript:;"><i class="fa fa-cube"></i> Disable flip box</a></li>' );

				$( '.cz_vc_disable_flipbox', parent.document.body ).on( 'click', function() {
					$( this ).toggleClass( 'cz_vc_disable_flipbox_disabled' );
					$( '.cz_box_backed, .cz_box_backed_disabled' ).toggleClass( 'cz_box_backed cz_box_backed_disabled' );
				});

			}
		},

		/*
		*   NiceScroll
		*/
		nicescroll: function() {
			var nice = $( '[data-nice]' );
			
			if ( nice.length ) {
				nice.each(function() {
					var en = $( this ),
						pa = en.parent();

					$( 'html' ).css( 'overflow', 'initial' );

					pa.getNiceScroll().remove();

					pa.niceScroll( $.extend({cursoropacitymin: 0.3}, en.data( 'nice' ) ) );
					setTimeout(function() {
						wind.trigger( 'resize' );
					}, 1500 );
				});

				// Fix dynamic content
				var timesRun = 0, interval;
				clearInterval( interval );
				interval = setInterval(function() {
					timesRun += 1;
					if ( timesRun === 10 ) {
						clearInterval( interval );
					}
					
					wind.trigger( 'resize' );
					nice.getNiceScroll().resize();
				}, 2000 );
			}
		},

		/*
		*   Count down, Count up and Loop timer
		*/
		countdown: function() {
			$( '[data-countdown]' ).codevz( 'countdown', function() {
				var dis = $( this ), 
					o = dis.data( 'countdown' ), 
					d = new Date( new Date().valueOf() + o.date * 1000 ),
					day_of = o.elapse ? '%n' : '%d',
					html_y = ( o.y !== '' ) ? '<li><span>%-Y</span><p>' + o.y + '%!Y:' + o.p + ';</p></li>' : '',
					html_d = ( o.d !== '' && html_y ) ? '<li><span>' + day_of + '</span><p>' + o.d + '%!n:' + o.p + ';</p></li>' : ( ( o.d !== '' ) ? '<li><span>%D</span><p>' + o.d + '%!d:' + o.p + ';</p></li>' : '' ),
					html_h = ( o.h !== '' ) ? '<li><span>%-H</span><p>' + o.h + '%!H:' + o.p + ';</p></li>' : '',
					html_m = ( o.m !== '' ) ? '<li><span>%-M</span><p>' + o.m + '%!M:' + o.p + ';</p></li>' : '',
					html_s = ( o.s !== '' ) ? '<li><span>%-S</span><p>' + o.s + '%!S:' + o.p + ';</p></li>' : '';

				dis.countdown( d, { elapse: o.elapse } ).on( 'update.countdown', function( e ) {
					dis.html( e.strftime( html_y + html_d + html_h + html_m + html_s ) );
				}).on('finish.countdown', function( e ) {
					dis.html( e.strftime( '<li><span>0</span></li><li><span>0</span></li><li><span>0</span></li><li><span>0</span></li>' ) );
					dis.addClass( 'ended' ).append( '<li class="expired">' + o.ex + '</li>' );
				});
			});
		},

		/*
		*   Progress bar and Inforgraphic icons
		*/
		progress_bar: function() {
			$( '.progress_bar' ).codevz( 'pbar', function(i) {
				var dis = $( this ),
					num = $( 'b', dis ).html(),
					del = i * 100;

				if ( wind.width() <= 768 ) {
					dis.addClass('done').find('span').css( 'width', num );
					$( 'b', dis ).show().html( num );
					return;
				}

				wind.on( 'scroll.cz_progress', function() {
					if ( Codevz_Plus.inview( dis ) && ! dis.hasClass( 'done' ) ) {
						dis.addClass('done').find('span').delay( del ).animate({width: parseInt( num ) + '%'}, 400 );

						$( 'b', dis ).delay( del ).prop( 'Counter', 0 ).animate({ Counter: parseInt( num ) }, {
							duration: 2000,
							easing: 'swing',
							step: function() {
								$( 'b', dis ).show().text( Math.ceil( this.Counter ).toLocaleString() + '%' );
							}
						});
					}

					if ( ! $( '.progress_bar:not(.done)' ).length ) {
						wind.off( 'scroll.cz_progress' );
					}
				});
			});

			$( '.cz_progress_bar_icon' ).codevz( 'pbar_icon', function() {
				var dis = $( this ),
					num = dis.data('number');

				wind.on( 'scroll.cz_pbar_icon', function() {
					if ( Codevz_Plus.inview( dis ) && ! dis.hasClass( 'done' ) ) {
						dis.addClass('done').find('> div').animate({width: parseInt( num ) + '%'}, 400 );
					}

					if ( ! $( '.cz_progress_bar_icon:not(.done)' ).length ) {
						wind.off( 'scroll.cz_pbar_icon' );
					}
				});
			});
		},

		/*
		*   Image zoom on mouse hover
		*/
		image_zoom: function() {
			var all = $( '.cz_image_hover_zoom' ).length;

			$( '.cz_image_hover_zoom' ).codevz( 'zoom', function() {
				var dis = $( this ), img = $( 'a', dis ).attr('href'), big;

				wind.on( 'scroll.cz_zoom', function() {
					if ( Codevz_Plus.inview( dis, 1 ) && ! big ) {

						$( '.cz_img_for_zoom', dis ).detach();
						$( 'img', dis ).addClass('cz_dimg');
						$( 'a', dis ).append('<img class="cz_img_for_zoom" src="' + img + '" />');
						big = $( '.cz_img_for_zoom', dis );
						$( 'a', dis ).off().on({
							mouseenter: function() {
								big.fadeIn( 'fast' );
							},
							mouseleave: function() {
								big.fadeOut( 'fast' );
							},
							mousemove: function(e) {
								var y = e.pageY - $( e.currentTarget ).offset().top,
									x = e.pageX - $( e.currentTarget ).offset().left,
									ii = $( '.cz_dimg', dis ),
									yy = ( big.height() - ii.height() ) / ii.height(),
									xx = ( big.width() - ii.width() ) / ii.width();

								big.css({
									'top': - ( y * yy ),
									'left': - ( x * xx )
								});
							}
						});
					}

					if ( all == $( '.cz_img_for_zoom' ).length ) {
						wind.off( 'scroll.cz_zoom' );
					}
				}).scroll();
			});
		},

		/*
		*   Google maps
		*/
		load_google_map_js: function() {
			if ( $( '.gmap' ).length ) {
				if ( ! $( '#cz_google_map_api_js' ).length ) {
					var ak = $( '.gmap' ).data("api-key");
					var sc = document.createElement('script');
					sc.setAttribute('id','cz_google_map_api_js');
					sc.setAttribute('src','//maps.google.com/maps/api/js?key='+ak+'&callback=Codevz_Plus.load_google_map_js');
					document.head.appendChild(sc);
				}
				
				$( '.gmap' ).html( '' ).each(function() {
					var dis = $( this );
					var id = dis.attr('id') ;
					var f = 'mapfucntion_'+id+ '();';
					try{eval(f);}catch(e){}
					dis.addClass('done');
				});
			}
		},

		/*
		*   Tilt FX
		*/
		tilt: function() {
			$( '[data-tilt]' ).codevz( 'tilt', function() {
				var tilt = $( this ).tilt({
					maxTilt: 6
				});
				tilt.on('tilt.mouseEnter', function() {
					$( this ).css({ 'animation-name': 'none' });
				});
			});
		},

		/*
		*   Menus hover FX
		*/
		menus: function() {
			$( '.cz-menu-hover-text .sf-menu > .cz > a > span' ).codevz( 'mht', function() {
				$( this ).after( $( this ).clone().addClass( 'cz-menu-hover-span' ) );
			});
		},

		separator: function() {

			// Width related to vc full width
			$( '[data-vc-full-width] .cz_sep' ).codevz( 'cz_sep', function() {
				var en = $( this ),
					vc = en.closest( '[data-vc-full-width]' ),
					sc = vc.data( 'vc-stretch-content' );
					
				if ( vc.length ) {
					wind.on( 'resize.cz_separator', function() {
						setTimeout(function() {
							en.css( 'width', sc ? '100%' : vc.css( 'width' ) ).css( 'left', sc ? '0' : ( parseInt( vc.css( 'left' ) ) + ( body.hasClass( 'rtl' ) ? 15 : -15 ) ) + 'px' );
						}, 100 );
					});
				}
			});

			if ( ! $( '#cz_sep_style' ).length ) {
				$( 'head' ).append( '<style id="cz_sep_style" type="text/css"></style>' );
			}
			$( '.cz_separator' ).codevz( 'separator', function() {
				var dis = $( this );
				var id = dis.attr( 'id');
				var bc = dis.data( 'before-color' );
				var ac = dis.data( 'after-color' );
				var cc = $( 'style#cz_sep_style' ).html();
				if ( typeof ac != "undefined" ) {ac='#'+id+ac}else{ac='';}
				$( 'style#cz_sep_style' ).html(cc+'#'+id+bc+ac);
			});
		}
	};

})(jQuery);

/* Codevz_Plus */
jQuery(document).ready(function() {
	Codevz_Plus.init();
});
