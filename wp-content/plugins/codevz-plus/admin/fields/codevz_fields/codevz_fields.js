/* Mousewheel 3.1.13 */
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):"object"==typeof exports?module.exports=a:a(jQuery)}(function(a){function b(b){var g=b||window.event,h=i.call(arguments,1),j=0,l=0,m=0,n=0,o=0,p=0;if(b=a.event.fix(g),b.type="mousewheel","detail"in g&&(m=-1*g.detail),"wheelDelta"in g&&(m=g.wheelDelta),"wheelDeltaY"in g&&(m=g.wheelDeltaY),"wheelDeltaX"in g&&(l=-1*g.wheelDeltaX),"axis"in g&&g.axis===g.HORIZONTAL_AXIS&&(l=-1*m,m=0),j=0===m?l:m,"deltaY"in g&&(m=-1*g.deltaY,j=m),"deltaX"in g&&(l=g.deltaX,0===m&&(j=-1*l)),0!==m||0!==l){if(1===g.deltaMode){var q=a.data(this,"mousewheel-line-height");j*=q,m*=q,l*=q}else if(2===g.deltaMode){var r=a.data(this,"mousewheel-page-height");j*=r,m*=r,l*=r}if(n=Math.max(Math.abs(m),Math.abs(l)),(!f||f>n)&&(f=n,d(g,n)&&(f/=40)),d(g,n)&&(j/=40,l/=40,m/=40),j=Math[j>=1?"floor":"ceil"](j/f),l=Math[l>=1?"floor":"ceil"](l/f),m=Math[m>=1?"floor":"ceil"](m/f),k.settings.normalizeOffset&&this.getBoundingClientRect){var s=this.getBoundingClientRect();o=b.clientX-s.left,p=b.clientY-s.top}return b.deltaX=l,b.deltaY=m,b.deltaFactor=f,b.offsetX=o,b.offsetY=p,b.deltaMode=0,h.unshift(b,j,l,m),e&&clearTimeout(e),e=setTimeout(c,200),(a.event.dispatch||a.event.handle).apply(this,h)}}function c(){f=null}function d(a,b){return k.settings.adjustOldDeltas&&"mousewheel"===a.type&&b%120===0}var e,f,g=["wheel","mousewheel","DOMMouseScroll","MozMousePixelScroll"],h="onwheel"in document||document.documentMode>=9?["wheel"]:["mousewheel","DomMouseScroll","MozMousePixelScroll"],i=Array.prototype.slice;if(a.event.fixHooks)for(var j=g.length;j;)a.event.fixHooks[g[--j]]=a.event.mouseHooks;var k=a.event.special.mousewheel={version:"3.1.12",setup:function(){if(this.addEventListener)for(var c=h.length;c;)this.addEventListener(h[--c],b,!1);else this.onmousewheel=b;a.data(this,"mousewheel-line-height",k.getLineHeight(this)),a.data(this,"mousewheel-page-height",k.getPageHeight(this))},teardown:function(){if(this.removeEventListener)for(var c=h.length;c;)this.removeEventListener(h[--c],b,!1);else this.onmousewheel=null;a.removeData(this,"mousewheel-line-height"),a.removeData(this,"mousewheel-page-height")},getLineHeight:function(b){var c=a(b),d=c["offsetParent"in a.fn?"offsetParent":"parent"]();return d.length||(d=a("body")),parseInt(d.css("fontSize"),10)||parseInt(c.css("fontSize"),10)||16},getPageHeight:function(b){return a(b).height()},settings:{adjustOldDeltas:!0,normalizeOffset:!0}};a.fn.extend({mousewheel:function(a){return a?this.bind("mousewheel",a):this.trigger("mousewheel")},unmousewheel:function(a){return this.unbind("mousewheel",a)}})});

/* Simple masonry */
!function(a){function b(b){var c=Math.min.apply(Math,b);return a.inArray(c,b)}function c(a){for(var b=[],c=0;c<a;c++)b.push(0);return b}function d(b){var c=a(b).outerWidth(),d=a(b).offsetParent().width();return{width:100*c/d,num:Math.floor(d/c)}}Array.max=function(a){return Math.max.apply(Math,a)},a.easing.__Slide=function(a,b,c,d,e){return d*Math.sqrt(1-(b=b/e-1)*b)+c},a.simplemasonry=function(e,f){var g={animate:!1,easing:"__Slide",timeout:800},h=a.extend({},g,f),i=a(e),j=this;a.extend(j,{refresh:function(){var b=a("img",e),c=b.length,d=0;b.length>0&&i.addClass("sm-images-waiting").removeClass("sm-images-loaded"),b.on("load",function(a){d++,d==c&&(j.resize(),i.removeClass("sm-images-waiting").addClass("sm-images-loaded"))}),j.resize()},resize:function(){var e=i.children(":visible"),f=d(e[0]),g=f.width,j=f.num,k=c(j),l=function(c){var d=a(this).outerHeight(),f=b(k),i=Math.round(f*g*10)/10,j={left:i+"%",top:k[f]+"px"};a(this).css({position:"absolute"}).stop(),h.animate?a(this).animate(j,h.timeout,h.easing):a(this).css(j),k[f]+=d};e.css({overflow:"hidden",zoom:"1"}).each(l),i.css({position:"relative",height:Array.max(k)+"px"})}}),a(window).resize(j.resize),i.addClass("sm-loaded"),j.refresh()},a.fn.simplemasonry=function(b){if("string"!=typeof b)return this.each(function(){if(void 0==a(this).data("simplemasonry")){var c=new a.simplemasonry(this,b);a(this).data("simplemasonry",c)}});var c=a(this).data("simplemasonry"),d=Array.prototype.slice.call(arguments,1);return c[b]?c[b].apply(c,d):void 0}}(jQuery);

/* imagesLoaded PACKAGED v4.1.3 */
!function(e,t){"function"==typeof define&&define.amd?define("ev-emitter/ev-emitter",t):"object"==typeof module&&module.exports?module.exports=t():e.EvEmitter=t()}("undefined"!=typeof window?window:this,function(){function e(){}var t=e.prototype;return t.on=function(e,t){if(e&&t){var i=this._events=this._events||{},n=i[e]=i[e]||[];return-1==n.indexOf(t)&&n.push(t),this}},t.once=function(e,t){if(e&&t){this.on(e,t);var i=this._onceEvents=this._onceEvents||{},n=i[e]=i[e]||{};return n[t]=!0,this}},t.off=function(e,t){var i=this._events&&this._events[e];if(i&&i.length){var n=i.indexOf(t);return-1!=n&&i.splice(n,1),this}},t.emitEvent=function(e,t){var i=this._events&&this._events[e];if(i&&i.length){var n=0,o=i[n];t=t||[];for(var r=this._onceEvents&&this._onceEvents[e];o;){var s=r&&r[o];s&&(this.off(e,o),delete r[o]),o.apply(this,t),n+=s?0:1,o=i[n]}return this}},t.allOff=t.removeAllListeners=function(){delete this._events,delete this._onceEvents},e}),function(e,t){"use strict";"function"==typeof define&&define.amd?define(["ev-emitter/ev-emitter"],function(i){return t(e,i)}):"object"==typeof module&&module.exports?module.exports=t(e,require("ev-emitter")):e.imagesLoaded=t(e,e.EvEmitter)}("undefined"!=typeof window?window:this,function(e,t){function i(e,t){for(var i in t)e[i]=t[i];return e}function n(e){var t=[];if(Array.isArray(e))t=e;else if("number"==typeof e.length)for(var i=0;i<e.length;i++)t.push(e[i]);else t.push(e);return t}function o(e,t,r){return this instanceof o?("string"==typeof e&&(e=document.querySelectorAll(e)),this.elements=n(e),this.options=i({},this.options),"function"==typeof t?r=t:i(this.options,t),r&&this.on("always",r),this.getImages(),h&&(this.jqDeferred=new h.Deferred),void setTimeout(function(){this.check()}.bind(this))):new o(e,t,r)}function r(e){this.img=e}function s(e,t){this.url=e,this.element=t,this.img=new Image}var h=e.jQuery,a=e.console;o.prototype=Object.create(t.prototype),o.prototype.options={},o.prototype.getImages=function(){this.images=[],this.elements.forEach(this.addElementImages,this)},o.prototype.addElementImages=function(e){"IMG"==e.nodeName&&this.addImage(e),this.options.background===!0&&this.addElementBackgroundImages(e);var t=e.nodeType;if(t&&d[t]){for(var i=e.querySelectorAll("img"),n=0;n<i.length;n++){var o=i[n];this.addImage(o)}if("string"==typeof this.options.background){var r=e.querySelectorAll(this.options.background);for(n=0;n<r.length;n++){var s=r[n];this.addElementBackgroundImages(s)}}}};var d={1:!0,9:!0,11:!0};return o.prototype.addElementBackgroundImages=function(e){var t=getComputedStyle(e);if(t)for(var i=/url\((['"])?(.*?)\1\)/gi,n=i.exec(t.backgroundImage);null!==n;){var o=n&&n[2];o&&this.addBackground(o,e),n=i.exec(t.backgroundImage)}},o.prototype.addImage=function(e){var t=new r(e);this.images.push(t)},o.prototype.addBackground=function(e,t){var i=new s(e,t);this.images.push(i)},o.prototype.check=function(){function e(e,i,n){setTimeout(function(){t.progress(e,i,n)})}var t=this;return this.progressedCount=0,this.hasAnyBroken=!1,this.images.length?void this.images.forEach(function(t){t.once("progress",e),t.check()}):void this.complete()},o.prototype.progress=function(e,t,i){this.progressedCount++,this.hasAnyBroken=this.hasAnyBroken||!e.isLoaded,this.emitEvent("progress",[this,e,t]),this.jqDeferred&&this.jqDeferred.notify&&this.jqDeferred.notify(this,e),this.progressedCount==this.images.length&&this.complete(),this.options.debug&&a&&a.log("progress: "+i,e,t)},o.prototype.complete=function(){var e=this.hasAnyBroken?"fail":"done";if(this.isComplete=!0,this.emitEvent(e,[this]),this.emitEvent("always",[this]),this.jqDeferred){var t=this.hasAnyBroken?"reject":"resolve";this.jqDeferred[t](this)}},r.prototype=Object.create(t.prototype),r.prototype.check=function(){var e=this.getIsImageComplete();return e?void this.confirm(0!==this.img.naturalWidth,"naturalWidth"):(this.proxyImage=new Image,this.proxyImage.addEventListener("load",this),this.proxyImage.addEventListener("error",this),this.img.addEventListener("load",this),this.img.addEventListener("error",this),void(this.proxyImage.src=this.img.src))},r.prototype.getIsImageComplete=function(){return this.img.complete&&void 0!==this.img.naturalWidth},r.prototype.confirm=function(e,t){this.isLoaded=e,this.emitEvent("progress",[this,this.img,t])},r.prototype.handleEvent=function(e){var t="on"+e.type;this[t]&&this[t](e)},r.prototype.onload=function(){this.confirm(!0,"onload"),this.unbindEvents()},r.prototype.onerror=function(){this.confirm(!1,"onerror"),this.unbindEvents()},r.prototype.unbindEvents=function(){this.proxyImage.removeEventListener("load",this),this.proxyImage.removeEventListener("error",this),this.img.removeEventListener("load",this),this.img.removeEventListener("error",this)},s.prototype=Object.create(r.prototype),s.prototype.check=function(){this.img.addEventListener("load",this),this.img.addEventListener("error",this),this.img.src=this.url;var e=this.getIsImageComplete();e&&(this.confirm(0!==this.img.naturalWidth,"naturalWidth"),this.unbindEvents())},s.prototype.unbindEvents=function(){this.img.removeEventListener("load",this),this.img.removeEventListener("error",this)},s.prototype.confirm=function(e,t){this.isLoaded=e,this.emitEvent("progress",[this,this.element,t])},o.makeJQueryPlugin=function(t){t=t||e.jQuery,t&&(h=t,h.fn.imagesLoaded=function(e,t){var i=new o(this,e,t);return i.jqDeferred.promise(h(this))})},o.makeJQueryPlugin(),o});

/* Fix admin google fonts */
function czStringToSlug(e){return jQuery.trim(e).replace(/[^a-z0-9-]/gi,"-").replace(/-+/g,"_").replace(/^-|-$/g,"").toLowerCase()}
function codevz_fix_admin_fonts(x){x=x?x:jQuery("#wpb_tinymce_content_ifr").contents().find("body");setTimeout(function(){var f_fonts=[],o_fonts;x.find('*').each(function(){var e=jQuery(this).css("font-family"),o=["FontAwesome","fontelo","Open Sans","Arial","Impact","monospace","Tahoma","sans-serif","Sans serif","VC-Icons","Arial Black","Comic Sans MS","Lucida Sans Unicode","Trebuchet MS","Verdana","Courier New","Lucida Console","Palatino Linotype","Times New Roman"];void 0!==e&&e&&-1==f_fonts.indexOf(e)&&-1==o.indexOf(e)&&e.indexOf(",")<=0&&f_fonts.push(e)}),jQuery('link[href*="fonts.googleapis.com"]').each(function(){o_fonts+=jQuery(this).attr("href")}),jQuery.each(f_fonts,function(e,o){o=o.replace(/\s/g,"+").replace(/\"/g,"");var n="cz_gfont_"+czStringToSlug(o);o_fonts&&o_fonts.indexOf(o)<=0&&!jQuery("#"+n).length&&jQuery("head").append('<link id="'+n+'" href="https://fonts.googleapis.com/css?family='+o+':100,200,300,400,500,700,900" rel="stylesheet">')});}, 1000);}

/* Codevz Admin Custom JS */
;(function ( $, window, document, undefined ) {
  'use strict';

  $(document).ready( function() {

    var wind = $(window),
        inView = function(e, t) {
          return ( t ? t : 800 ) >= e.offset().top;
        };

    // Hide plugins notifications
    if ( $( '.wp-admin' ).length ) {
      var mute_plugins = $( '.plugins' ).find( '[data-slug="slider-revolution"], [data-slug="wpbakery-visual-composer"], [data-slug="revslider"], [data-slug="js_composer"]' );
      if ( mute_plugins.length ) {
        mute_plugins.each(function() {
          $( this ).next( '.plugin-update-tr' ).next( '.plugin-update-tr' ).hide();
        });
      }
      $( '#message.rs-update-notice-wrap, #vc_license-activation-notice' ).hide().find( 'a' ).trigger( 'click' );
      $( '.update-nag' ).each(function() {
        var string = $( this ).html();
        if ( string && string.toLowerCase().indexOf("visual") >= 0 ) {
          $( this ).hide();
        }
      });
    }

    // Post formats switch
    if ( $( '.post-formats-select' ).length ) {
      var pf_radio = $( '#post-formats-select input' ),
          pf_select = $( '.post-formats-select' );

      pf_select.on( 'change', function() {
        pf_radio.filter('[value=' + $( this ).val() + ']').prop( 'checked', true ).trigger( 'change' );
      });
      pf_radio.on( 'click', function() {
        $( '[data-section="codevz_page_meta_post_format_settings"' ).trigger( 'click' );
        pf_select.val( $( this ).val() ).trigger( 'change' );
      });
    }

    // Custom sidebars
    if ( $( '.sidebars-column-2' ).length ) {
      $( '.sidebars-column-2' ).append( '<div class="widgets-holder-wrap cz-custom-sidebar"><div class="sidebar-name"><h2>Add Custom Sidebar<span class="spinner"></span></h2></div><div class="cz_sidebar_cn"><input name="cz_sidebar_name" type="text" placeholder="Name ..."><input type="submit" name="cz_add_sidebar" class="button button-primary" value="Add"></div></div>' );
    
      $( '[name="cz_add_sidebar"]' ).on( 'click', function(e) {
        var en = $( this ), spinner = en.closest( '.widgets-holder-wrap' ).find( '.spinner' );

        if ( ! en.hasClass( 'cz_doing' ) ) {
          en.addClass( 'cz_doing' );
          spinner.addClass( 'is-active' );

          $.ajax({
            type: "GET",
            url: ajaxurl,
            dataType: 'html',
            data: 'action=codevz_custom_sidebars&add_sidebar=1&sidebar_name=' + $( '[name="cz_sidebar_name"]' ).val(),
            success: function( data ) {
              if ( data === 'done' ) {
                location.reload();
              } else {
                confirm( 'Something went wrong, Please try again.' );
                spinner.removeClass( 'is-active' );
                en.removeClass( 'cz_doing' );
              }
            },
            error: function( e ) {
              console.log( e );
              spinner.removeClass( 'is-active' );
              en.removeClass( 'cz_doing' );
            }
          });
        }

        e.preventDefault();
      });

      $( '#widgets-right [id*="cz-custom-"]' ).each( function() {
        var en = $( this );

        if ( ! en.find( '.cz-remove-sidebar' ).length ) {
          en.find( '.sidebar-name' ).append( '<a href="#" class="cz-remove-sidebar" title="Delete this sidebar"><div class="dashicons dashicons-no-alt"></div></a>' );
        }
      });

      $( '.cz-remove-sidebar' ).on( 'click', function(e) {
        var en = $( this ), spinner = en.closest( '.widgets-holder-wrap' ).find( '.spinner' );

        if ( ! en.hasClass( 'cz_doing' ) && confirm( 'Are you sure?' ) ) {
          en.addClass( 'cz_doing' );
          spinner.addClass( 'is-active' );

          $.ajax({
            type: "GET",
            url: ajaxurl,
            dataType: 'html',
            data: 'action=codevz_custom_sidebars&remove_sidebar=1&sidebar_name=' + en.closest( '.widgets-sortables' ).attr( 'id' ),
            success: function( data ) {
              if ( data === 'done' ) {
                location.reload();
              } else {
                confirm( 'Something went wrong, Please try again.' );
                spinner.removeClass( 'is-active' );
                en.removeClass( 'cz_doing' );
              }
            },
            error: function( e ) {
              console.log( e );
              spinner.removeClass( 'is-active' );
              en.removeClass( 'cz_doing' );
            }
          });
        }

        e.preventDefault();
      });
    }

    // VC Templates
    if ( $( '.vc_templates-template-type-default_templates' ).length ) {
      $( '.vc_templates-button, .vc_templatera_button, #vc_templates-more-layouts, #vc_templatera-more-layouts' ).on( 'click.cz_templates', function() {

        // Filters
        var filters = $( '.cz_vc_filters' ),
            dtt     = $( '[data-tab="default_templates"]' ),
            vupc    = $( '.vc_ui-panel-content-container' ),
            last_li = $( '[data-vc-ui-element-target="[data-tab=default_templates]"]' ).html( filters.data( 'tab-title' ) ).parent('li'),
            vutl    = $( '.vc_ui-template-list' ),
            time    = null;

        last_li.prependTo( last_li.parent() );
        last_li.find( 'button' ).trigger( 'click' );

        dtt.find( '.vc_col-md-12' ).addClass( 'vc_col-md-2' ).removeClass( 'vc_col-md-12' ).html( '' ).append( filters );
        dtt.find( '.vc_column' ).addClass( 'vc_col-md-10 cz_templates_items' ).removeClass( 'vc_col-md-12' );
        
        filters.removeClass( 'hidden' ).find( 'li' ).each(function() {
          var dis = $( this ),
              count = $( '.cz_templates_items .' + dis.data( 'filter' ) ).length;

          if ( count ) {
            dis.append( '<span>' + count + '</span>' );
          } else {
            dis.remove();
          }
          
          dis.on( 'click', function() {
            var cls = dis.data( 'filter' );

            dis.addClass( 'cz_active' ).siblings().removeClass( 'cz_active' );
            $( '.cz_templates_items .vc_ui-template-list .vc_ui-template' ).addClass( 'cz_deactive' );
            $( '.cz_templates_items .vc_ui-template-list .' + cls ).removeClass( 'cz_deactive' );

            vupc.resize();
            setTimeout(function() {
              vupc.scroll();
            }, 250 );
          });
        });

        // Masonry templates
        $( '.vc_templates-list-default_templates' ).simplemasonry({animate: false});

        // Lazyload templates
        vupc.off( 'scroll' ).on( 'scroll', function(e) {
          $( '.vc_templates-template-type-default_templates:not(.cz_lazyDone,.cz_deactive)' ).slice(0,10).each(function(i) {
            var dis = $( this );

            if ( ! dis.hasClass( 'cz_lazyDone' ) && inView( dis, e.currentTarget.scrollTop + e.currentTarget.clientHeight ) ) {
              var cls    = dis.attr( 'class' ),
                  title  = cls.match( /\d+_jpg/g );

              $( '.vc_ui-list-bar-item-trigger', dis ).html( '<img src="https://xtratheme.com/img/templates/' + title[0].replace( /_/g, '.' ) + '" />' + cls );
              vupc.imagesLoaded(function() {
                  vupc.resize();
              });
              dis.addClass( 'cz_lazyDone' );
            }
          });
        });

        $( '.vc_templates-template-type-default_templates' ).on( 'click', '.vc_ui-list-bar-item-trigger', function() {
          var dis = $( this );
          dis.addClass( 'cz_template_loader_after' ).find( 'img' ).css( 'opacity', '0.3' );
          setTimeout(function() {
            dis.removeClass( 'cz_template_loader_after' ).find( 'img' ).css( 'opacity', '1' );
          }, 4000 );
        });

        // Search tempaltes
        $( '.vc_ui-search-box-input' ).on( 'keyup', 'input', function() {
          clearTimeout( time );
          time = setTimeout(function() {
            vupc.resize();
            vupc.scroll();
          }, 250 );
        });

        vupc.scroll();
        $( this ).off( 'click.cz_templates' );
      });

      // Front-end templates button
      $('#vc_inline-frame').load(function(){
        $('#vc_inline-frame').contents().find( '#vc_templates-more-layouts' ).on( 'click', function() {
          $( '.vc_templates-button' ).trigger( 'click' );
        });
      });
    }

    // Eye icon for vc preview
    if ( $( '#vc_navbar' ).length ) {
      $( '#vc_navbar .vc_navbar-nav' ).append('<li class="vc_pull-right cz_vc_preview"><a href="javascript:;" class="vc_icon-btn vc_post-settings" title="Quick Preview"><i class="vc-composer-icon fa fa-eye" style="font-family: FontAwesome !important"></i></a></li>');
      $( '.cz_vc_preview' ).on( 'click', 'a', function(e) {

        $( 'i', this ).toggleClass( 'fa-eye fa-eye-slash' ).attr( 'disabled', 'disabled' );
        
        var i = $( '#vc_inline-frame' ).contents().find( 'body' );

        if ( $( 'i', this ).hasClass( 'fa-eye-slash' ) ) {
          i.append('<style id="cz_vc_preview_css">.compose-mode .vc_row:hover{z-index: auto !important}.vc_controls, .cz_edit_popup_link, .vc_welcome, .vc_empty-element, div .vc_empty:hover, .compose-mode .vc_element.vc_hold-hover>.wpb_row>.vc_element:before, .compose-mode .vc_element.vc_hover>.wpb_row>.vc_element:before, .compose-mode .vc_element:hover>.wpb_row>.vc_element:before, .view-mode .vc_element.vc_hold-hover>.wpb_row>.vc_element:before, .view-mode .vc_element.vc_hover>.wpb_row>.vc_element:before, .view-mode .vc_element:hover>.wpb_row>.vc_element:before {display: none !important} .compose-mode .vc_vc_row>.vc_parallax, .compose-mode .vc_vc_row>[data-vc-full-width=true], .compose-mode .vc_vc_row_inner, .compose-mode .vc_vc_section>.vc_parallax, .compose-mode .vc_vc_section>[data-vc-full-width=true], .compose-mode .vc_vc_video {padding-top: 0;padding-bottom: 0}@media (max-width:767px) {.compose-mode .vc_hidden-xs,.view-mode .vc_hidden-xs{display:none!important}}@media (min-width:768px) and (max-width:991px) {.compose-mode .vc_hidden-sm,.view-mode .vc_hidden-sm{display:none!important;}}@media (min-width:992px) and (max-width:1199px) {.compose-mode .vc_hidden-md,.view-mode .vc_hidden-md{display:none!important}}@media (min-width:1200px) {.compose-mode .vc_hidden-lg,.view-mode .vc_hidden-lg{display:none!important}}.compose-mode .page_content [id^=cz_]:hover,.compose-mode *{outline:none !important}.compose-mode .page_content .cz_gap{background:none}.compose-mode .vc_element .vc_element-container, .view-mode .vc_element .vc_element-container,.compose-mode .vc_empty-shortcode-element, .compose-mode .vc_templatera, .compose-mode .vc_vc_column_text, .compose-mode .vc_vc_widget_sidebar{min-height:unset}</style>');
        } else {
          $( '#cz_vc_preview_css', i ).remove();
        }

        if ( $( '.cz_btn_inline', i ).length ) {
          $( '.cz_btn_inline', i ).closest( '.vc_cz_button' ).toggleClass( 'cz_btn_inline' );
        }

        e.preventDefault();
        return false;
      });
    }

    // Slider Option
    $.fn.csf_slider = function() {
      return this.each(function() {

        $( this ).html('<div></div>');

        var dis    = $( this ),
            input  = dis.prev('input'),
            slider = $( '> div', dis ),
            data   = dis.data( 'options' ),
            step   = parseInt( data.step ) || 1,
            min    = parseInt( data.min ) || 0,
            max    = parseInt( data.max ) || 100,
            unit, val;

        // Connect 4 fields to each other
        var nParent = input.closest( '.csf-field-codevz_sizes' );
        if ( nParent.length ) {
          $( '.fa-link', nParent ).off().on( 'click', function() {
              dis.find( 'input' ).trigger( 'focus' );
              $( this ).toggleClass( 'cz_connect' );
          });
        }


          slider.slider({
            range: 'min',
            value: parseInt( input.val() || 0 ),
            step: step,
            min: min,
            max: max,
            slide: function( e, o ) {
              unit = input.val().replace(/[ 0-9]/g, '').replace('-', '');
              input.val( parseInt( o.value || 0 ) + ( unit || data.unit ) ).trigger( 'change' );
            }
          });

          // If border is custom
          val = ( input.val().indexOf(' ') >= 0 ) ? 'addClass' : 'removeClass';
          dis.parent()[val]( 'cz_border_custom_val' );

          // Focus input run mousewheel and keydown
          if ( ! input.closest( '.cz_border_custom_val' ).length ) {

            input.on( 'focus', function() {
            // Turn ON mousewheel and keydown
            input.off('mousewheel keydown').on( "mousewheel keydown", function( e, delta ) {

              var unit = input.val().replace(/[ 0-9]/g, '').replace('-', ''),
                  val  = parseInt( input.val() || 0 );

              // Keyboard Up
              if ( e.which == 38 ) {
                  input.val( ( val + step ) + ( unit || data.unit ) ).trigger( 'change' );
                  slider.slider({ value: val + step });
              } else if ( e.which == 40 ) {
                  input.val( ( val - step ) + ( unit || data.unit ) ).trigger( 'change' );
                  slider.slider({ value: val - step });
              }

              // Return false space on 4 fileds
              if ( e.keyCode == 32 && ( dis.closest('.csf-field-codevz_sizes').length || dis.closest('.csf-field-codevz_box_shadow').length ) ) { 
                return false;
              }

              // Mousewheel Up
              if ( typeof delta != 'undefined' ) {
                if ( delta > 0 ) {
                    input.val( ( val + step ) + ( unit || data.unit ) ).trigger( 'change' );
                    slider.slider({ value: val + step });
                } else {
                    input.val( ( val - step ) + ( unit || data.unit ) ).trigger( 'change' );
                    slider.slider({ value: val - step });
                }

                return false;
              }

            }); // End mousewheel keydown
            }); // End focus

          } // End check closest( '.cz_border_custom_val' ).length

          input.on( 'keyup change', function() {

            val = input.val();

            slider.slider({ value: parseInt( val || '0' ) });

            // Connect all fields together
            if ( $( '.fa-link', nParent ).hasClass('cz_connect') ) {
              $( 'input', nParent ).val( val );
              $( '.csf-slider > div', nParent ).slider({ value: parseInt( val ) });
            }

            // If border is custom
            dis.parent()[( val.indexOf(' ') >= 0 ? 'addClass' : 'removeClass' )]( 'cz_border_custom_val' );

          }).on( 'keyup', function() {

              slider.slider({ value: parseInt( input.val() || '0' ) });

          }).on( 'focusout', function() {

              // Turn OFF mousewheel and keydown
              input.off('mousewheel keydown');

              // Fix Unit
              val = input.val();
              if ( $.isNumeric( val ) ) {
                input.val( val + data.unit ).trigger( 'change' );
              } else if ( val == '-' ) {
                input.val( null ).trigger( 'change' );
              }

          }); // End input.on()

      }); // End return this
    }; // End csf_slider

    // Codevz Presets tab for VC
    $.fn.csf_cz_presets = function() {
      return this.each(function() {
        
        var dis = $( this ),
            skp = dis.attr( 'class' ) + '_class',
            tab = dis.closest( '.vc_edit-form-tab' ).attr( 'id' ).split('-').pop(),
            nk, nv, k, v, 
            setCustomFields = function( k, v, par, nk ) {
              // Set icon
              if ( v.indexOf( 'fa-' ) >= 0 ) {
                par.find( '.csf-icon-remove' ).removeClass( 'hidden' );
                par.find( '.csf-icon-preview' ).removeClass( 'hidden' ).html( '<i class="' + v + '"></i>' );
              }

              // Set checkbox
              if ( nk.attr( 'type' ) == 'checkbox' ) {
                nk.prop( 'checked', 1 ).val( 1 ).attr( 'checked', 'checked' ).trigger( 'change' );
              }

              // Set content
              if ( k == 'content' ) {
                  par.find( '[name="wpb_tinymce_content"]' ).val( v ).trigger( 'change' );
                  par.find( '#wpb_tinymce_content_ifr' ).contents().find( 'body' ).html( v );
              }

              // Set image field
              if ( k.indexOf( 'image' ) >= 0 && v.indexOf( ':' ) >= 0 ) {
                var iid = ( v.indexOf("?id=") >= 0 ) ? v.split('?id=')[1] : v;
                nk.parent().find( 'ul' ).html( '<li class="added"><div class="inner" style="width:80px;height:80px;overflow:hidden;text-align:center;"><img src="' + v + '" data-image-id="' + iid + '" class="vc_ce-image"></div><a href="#" class="vc_icon-remove"><i class="vc-composer-icon vc-c-icon-close"></i></a></li>' );
                v = iid;
              }
            },
            setPreset = function( s, par, gr ) {
              $.each( s, function( k, v ) {

                // Set CSS Box
                if ( v.indexOf( 'vc_custom' ) >= 0 ) {
                  v = v.substring( v.lastIndexOf("{") + 1, v.lastIndexOf("}") );
                  v = v.split(';');
                  k = par.find( '[data-vc-shortcode-param-name="' + k + '"]' );

                  $.each( v, function(kk, vv) {
                    vv = vv.split(': ');
                    nk = $.trim( vv[0] ).replace( /-/g, '_' );
                    nv = $.trim( vv[1] ).replace( / !important/g, '' );

                    // Set border color
                    if ( nk.indexOf( 'border' ) >= 0 ) {
                      nk = ( nk.indexOf( 'color' ) >= 0 ) ? 'border_color' : ( ( nk.indexOf( 'style' ) >= 0 ) ? 'border_style' : nk );
                    }

                    // Set others
                    k.find( '[name="' + nk + '"]' ).val( nv ).trigger( 'change' );

                    // Set Background image
                    if ( nk == 'background_image' ) {
                      nv = nv.substring( nv.lastIndexOf("(") + 1, nv.lastIndexOf(")") );
                      var prm = ( nv.indexOf("?id=") >= 0 ) ? nv.split('?id=')[1] : v;
                      k.find( 'ul.vc_image' ).html( '<li class="added"><div class="inner" style="width:80px;height:80px;overflow:hidden;text-align:center;"><img src="' + nv + '" data-image-id="' + prm + '" class="vc_ce-image"></div><a href="#" class="vc_icon-remove"><i class="vc-composer-icon vc-c-icon-close"></i></a></li>' );
                    }
                  });

                // Set Box and Text shadow fields
                } else if ( k.indexOf( 'shadow' ) >= 0 ) {

                  nk = par.find( '[name="' + k + '"]' ).closest( '.codevz-boxshadow' );
                  v = v.split('|');

                  $.each( v, function(kk, vv) {
                    vv = vv.split(':');
                    var nnk = $.trim( vv[0] );
                    nv = $.trim( vv[1] );

                    if ( nnk.indexOf( 'style' ) >= 0 ) {
                      nk.find( 'select' ).val( nv ).trigger( 'change' );
                    } else if ( nnk.indexOf( 'color' ) >= 0 ) {
                      nk.find( '.czbs-colorpicker' ).val( nv ).trigger( 'change' );
                    } else {
                      nk.find( '[data-id="' + nnk + '"]' ).val( parseInt( nv ) ).trigger( 'change' );
                    }
                  });

                // Others
                } else {

                  nk = par.find( '[name="' + k + '"]' );

                  // Set and fix custom fields
                  setCustomFields( k, v, par, nk );

                  // Groups
                  if ( v.indexOf( '%20' ) >= 0 ) {
                    var group = $.parseJSON( decodeURIComponent( v ) ),
                        pare = par.find( '[data-vc-shortcode-param-name="' + k + '"]' );

                    // Add new group items
                    if ( pare.find( 'li.vc_param' ).length < 1 ) {
                      for (var i = group.length - 2; i >= 0; i--) {
                        pare.find( '.vc_param_group-add_content' ).trigger( 'click' );
                      }
                    }

                    // Set each group li fields
                    var group_li = pare.find( 'li.vc_param' ), nnk;
                    $.each( group, function( kk, vv ) {
                      $.each( vv, function( kkk, vvv ) {
                        nnk = $( group_li[ kk ] ).find( '[name="' + k + '_' + kkk + '"]' );
                        if ( skp.indexOf( kkk ) < 0 || ! nnk.val() ) {
                          setCustomFields( kkk, vvv, $( group_li[ kk ] ), nnk );
                          vvv && nnk.val( vvv ).trigger( 'change' );
                        }
                      });
                    });
                  }

                  v && nk.val( v ).trigger( 'change' );
                }

              });
            };

        // Get presets
        $( '[data-tab-index="' + tab + '"] button' ).on( 'click', function() {
          if ( ! $( this ).hasClass( 'cz_presets_done' ) ) {
            $.ajax({
              type: "GET",
              url: ajaxurl,
              dataType: 'html',
              data: 'action=cz_presets&type=' + dis.data( 'presets' ),
              success: function( data ) {

                // Presets & Masonry
                dis.html( data ).simplemasonry({animate: false});
                dis.imagesLoaded(function() {
                  wind.resize();
                });

                // Fix google fonts
                codevz_fix_admin_fonts( dis );

                // Disable links, inputs
                dis.on( 'click', 'a', function() {
                  $( this ).closest( '[data-shortcode]' ).trigger( 'click' );
                  return false;
                });
                $( 'input', dis ).attr( 'disabled', 'disabled' );

                // Click on presets
                dis.on( 'click', '[data-shortcode]', function(e) {

                  var disa  = $( this ),
                      s     = disa.data( 'shortcode' ),
                      par   = disa.closest( '.vc_panel-tabs' ), diz, std,
                      r     = confirm("Warning: If you confirm this, ALL FIELDS * will override and you will lose old settings of this element.");
                  
                  if ( ! r ) {return;}

                  // Fix multiple clicks
                  if ( disa.attr( 'disabled' ) != 'disabled' ) {
                    disa.attr( 'disabled', 'disabled' ).addClass( 'cz_presets_loader_after' );

                    // Reset all fields
                    var opts = par.find( '[name], .czbs-select' ).not( '[name="id"]' );
                    opts.each(function(i) {
                      var diz = $( this ),
                          nam = diz.attr( 'name' ),
                          std = diz.closest( '[data-param_settings]' ).data( 'param_settings' ) || {},
                          std = std.value || std.std || '';

                      if ( skp.indexOf( nam ) < 0 || ! diz.val() ) {

                        if ( nam != 'alpha' ) {
                          diz.val( std ).prop( 'selectedIndex', 0 ).trigger( 'change' );

                          // Reset icon
                          if ( diz.parent().find( '.csf-icon-remove' ).length && ! std ) {
                            diz.parent().find( '.csf-icon-remove' ).trigger( 'click' );
                          }

                          // unCheck checkbox
                          if ( diz.attr( 'type' ) == 'checkbox' && ! std ) {
                            diz.val( false ).prop( 'checked', false ).trigger( 'change' );
                          }
                        }

                        // Start setting presets
                        if ( ( i + 1 ) === opts.length ) {
                          $( 'ul.vc_image' ).html( '' ); // Clear background

                          setTimeout( function() {
                            $.when( setPreset( s, par ) ).done(function() {
                              setTimeout(function() {
                                disa.removeAttr( 'disabled' ).removeClass( 'cz_presets_loader_after' );
                              }, 2000 );
                              $( '[data-vc-ui-element="button-save"]' ).trigger( 'click' );
                            });
                          }, 500 );
                        }

                      } else {
                        delete s[ nam ]
                      }

                    });
                  }

                  e.preventDefault();
                  return false;
                });

              },
              error: function( e ) {
                console.log( e );
              }
            });
          }
          $( this ).addClass( 'cz_presets_done' );
        });

      });
    };

    // Image select for vc
    $.fn.csf_cz_image_select = function() {
      return this.each(function() {
        var dis = $( this );

        $( 'input', dis ).on( 'change', function() {
          if ( this.checked ) {
            var val = $( this ).val();
            $( 'input[type="hidden"]', dis ).val( val ).trigger( 'change' );
          }
        });
      });
    };

    // Customize VC CSS_Editor
    $.fn.cz_vc_editor = function() {
      return this.each(function() {
        var dis = $( this ),
            brr = $( '[name="border_radius"]', dis ),
            brr_val = brr.val(),
            brr_val = ( brr_val == 'null' || ! brr_val ) ? '' : brr_val;

        // Change border radius field to input with slider
        brr.after( '<div class="csf-field csf-field-slider"><input type="text" name="border_radius" class="vc_border-radius cz_slider" value="' + brr_val + '"><div class="csf-slider" data-options="{&quot;unit&quot;:&quot;px&quot;,&quot;step&quot;:1,&quot;min&quot;:0,&quot;max&quot;:120}"></div><div class="clear"></div></div>' );
        brr.remove();

        // Add background positions
        $( '[name="background_style"]', dis ).append( '<option value="cover;background-position: top">Cover, Top</option><option value="cover;background-position: bottom">Cover, Bottom</option><option value="no-repeat;background-position: left top">No repeat, Top left</option><option value="no-repeat;background-position: center top">No repeat, Top center</option><option value="no-repeat;background-position: right top">No repeat, Top right</option><option value="no-repeat;background-position: left bottom">No repeat, Bottom left</option><option value="no-repeat;background-position: center bottom">No repeat, Bottom center</option><option value="no-repeat;background-position: right bottom">No repeat, Bottom right</option>' );
      });
    };

    // Set shortcode unique ID
    $.fn.cz_live_shortcode_id = function() {
      return this.each(function() {
        var id = Math.floor(Math.random() * 99999) + 11111;
        $( this ).val( 'cz_' + id ).trigger( 'change' );
      });
    };

    // Mobile header customize change iframe
    $( '#accordion-section-codevz_theme_options-mobile_header' ).on( 'click', function() {
      $( '[data-device="mobile"]' ).trigger( 'click' );
      $( '.customize-section-back' ).on( 'click.cz', function() {
        $( '[data-device="desktop"]' ).trigger( 'click' );
        $( this ).off( 'click.cz' );
      });
    });

    // Funcs
    $.fn.codevzSerializeObject=function(){var e={};return $.each(this.serializeArray(),function(a,r){var n=r.name.match(/(.*?)\[(.*?)\]/);if(null!==n){var u=new String(n[1]),i=new String(n[2]);e[u]||(e[u]={}),e[u][i]?$.isArray(e[u][i])?e[u][i].push(r.value):(e[u][i]={},e[u][i].push(r.value)):e[u][i]=r.value}else{var l=new String(r.name);e[l]?$.isArray(e[l])?e[l].push(r.value):(e[l]={},e[l].push(r.value)):e[l]=r.value}}),e};
    function cssToObj(css) {
      if ( !css ) {return;}

      var i, ii, p, v, ob = {}, obj = {},
        custom = css.match( "CDVZ(.*)CDVZ" ),
        rtl    = css.match( "RTL(.*)RTL" ),
        css    = css.indexOf( 'CDVZ' ) >= 0 ? css.substring( 0, css.indexOf( 'CDVZ' ) ) : css,
        css    = css.indexOf( 'RTL' ) >= 0 ? css.substring( 0, css.indexOf( 'RTL' ) ) : css,
        s      = css.split(/:(?![^(]*\))(?![^"']*["'](?:[^"']*["'][^"']*["'])*[^"']*$)|;/g),
        bg_index = [ 'orientation', 'color', 'color2', 'color3' ],
        orientations = [ 'top', 'right', 'bottom', 'left' ];

      // Prepare inners
      obj['margin'] = {};
      obj['padding'] = {};
      obj['background'] = {};
      obj['box-shadow'] = {};
      obj['text-shadow'] = {};
      obj['border-width'] = {};
      if ( custom ) {
        obj['custom'] = custom[1];
      }
      if ( rtl ) {
        obj['rtl'] = rtl[1];
      }
      
      for ( i = 0; i < s.length; i += 2 ) {
        p = s[i], v = s[i+1], ob = {};

        if ( ! p || ! v ) {continue;}

        if ( p === 'background-color' ) {
          obj['background']['color'] = v;
        } else if ( p === 'background-repeat' ) {
          obj['background']['repeat'] = v;
        } else if ( p === 'background-position' ) {
          obj['background']['position'] = v;
        } else if ( p === 'background-attachment' ) {
          obj['background']['attachment'] = v;
        } else if ( p === 'background-size' ) {
          obj['background']['size'] = v;
        } else if ( p === 'background-image' ) {
          if ( v.indexOf( 'url(' ) >= 0 && v.indexOf( ')' ) >= 0 ) {
            obj['background']['image'] = v.split( 'url(' )[1].split( ')' )[0];
            if ( v.indexOf( ',linear' ) >= 0 ) {
              obj['background']['layer'] = '1';
            }
          }
          if ( v.indexOf( 'gradient' ) >= 0 ) {
            var lg = v.match( /linear-gradient\((.*)\)/ );
            v = lg[1].match( /rgba\(.*?\)|#\w+|\w+\s\w+|\w+|-\w+/g );
            if ( v[1] == v[2] ) {
              v[2] = '';
            }
            $.each( v, function( bp, bv ) {
              obj['background'][ bg_index[bp] ] = ( ( bv == 'url' ) ? '' : bv );
            });
          }
        } else if ( p === 'padding' || p === 'margin' || p === 'border-width' ) {
          ob = v.match(/\S+/g);
          if ( ob.length == 4 ) {
            obj[p]['top'] = ob[0];
            obj[p]['right'] = ob[1];
            obj[p]['bottom'] = ob[2];
            obj[p]['left'] = ob[3];
          } else if ( ob.length == 3 ) {
            obj[p]['top'] = ob[0];
            obj[p]['right'] = ob[1];
            obj[p]['bottom'] = ob[2];
            obj[p]['left'] = ob[1];
          } else if ( ob.length == 2 ) {
            obj[p]['top'] = ob[0];
            obj[p]['right'] = ob[1];
            obj[p]['bottom'] = ob[0];
            obj[p]['left'] = ob[1];
          } else if ( ob.length == 1 ) {
            obj[p]['top'] = ob[0];
            obj[p]['right'] = ob[0];
            obj[p]['bottom'] = ob[0];
            obj[p]['left'] = ob[0];
          }

        } else if ( p === 'padding-top' ) {
          obj['padding']['top'] = v;

        } else if ( p === 'padding-right' ) {
          obj['padding']['right'] = v;

        } else if ( p === 'padding-bottom' ) {
          obj['padding']['bottom'] = v;

        } else if ( p === 'padding-left' ) {
          obj['padding']['left'] = v;

        } else if ( p === 'margin-top' ) {
          obj['margin']['top'] = v;

        } else if ( p === 'margin-right' ) {
          obj['margin']['right'] = v;

        } else if ( p === 'margin-bottom' ) {
          obj['margin']['bottom'] = v;

        } else if ( p === 'margin-left' ) {
          obj['margin']['left'] = v;

        } else if ( p === 'border-top-width' ) {
          obj['border-width']['top'] = v;
          obj['border-top-width'] = v;

        } else if ( p === 'border-right-width' ) {
          obj['border-width']['right'] = v;
          obj['border-right-width'] = v;

        } else if ( p === 'border-bottom-width' ) {
          obj['border-width']['bottom'] = v;
          obj['border-bottom-width'] = v;

        } else if ( p === 'border-left-width' ) {
          obj['border-width']['left'] = v;
          obj['border-left-width'] = v;

        } else if ( p.indexOf( 'shadow' ) >= 0 ) {

          v = v.match( /rgba\(.*?\)|#\w+|-\w+|\w+/g );
          obj[p]['x'] = v[0];
          obj[p]['y'] = v[1];
          obj[p]['blur'] = v[2];

          if ( typeof v[3] === 'string' && v[3].indexOf( 'px' ) >= 0 ) {

            obj[p]['color'] = v[4];

            if ( p.indexOf( 'box-shadow' ) >= 0 ) {
              obj[p]['spread'] = v[3];
              if ( typeof v[5] === 'string' ) {
                obj[p]['mode'] = v[5];
              }
            }

          } else {
            obj[p]['color'] = v[3];
          }

        } else if ( p == 'transform' ) {
          v = v.match( /\w+/g );
          obj[p] = v[ v.length - 1 ];

        } else if ( p == 'filter' ) {
          p = v.indexOf( 'blur' ) >= 0 ? 'blur' : 'grayscale';
          v = v.match( /(\d+)%|(\d+)px/g );
          obj[p] = v[0];

        } else if ( p == 'content' ) {
          obj[p] = v.replace( /"/g, '' );

        } else if ( p.indexOf( 'border' ) >= 0 && p.indexOf( 'style' ) >= 0 ) {
          obj['border-style'] = v;

        } else {
          obj[p] = v;
        }
      }

      return obj;
    }

    function objToCSS(obj) {
      if ( ! obj ) {return;}

      var css = '', bg_layer;
      $.each( obj, function( property, val ) {
        if ( val ) {
          if ( typeof val == 'object' ) {
            if ( property == 'background' ) {
              $.each( val, function( bp, bv ) {
                if ( bp == 'position' || bp == 'size' || bp == 'repeat' || bp == 'attachment' ) {
                  css += 'background-' + bp + ':' + bv + ';';
                } else if ( bp == 'layer' && bv ) {
                  bg_layer = bv;
                }
              });

              val = $.extend({image: '',color: '',color2: '',color3: '',orientation: ''}, val);

              var image = val['image'] ? 'url(' + val['image'] + ')' : '',
                c1 = val['color'],
                c2 = val['color2'],
                c3 = val['color3'],
                is_color = ( c1 || c2 || c3 ),
                empty_cl = ( ! c1.length + ! c2.length + ! c3.length ),
                linear = val['orientation'] ? val['orientation'] : '0deg',
                linear = linear + ( c1 ? ',' + c1 + ( ( ! c2 && ! c3 ) ? ',' + c1 : '' ) : '' ),
                linear = linear + ( c2 ? ',' + c2 + ( ( ! c1 && ! c3 ) ? ',' + c2 : '' ) : '' ),
                linear = linear + ( c3 ? ',' + c3 + ( ( ! c1 && ! c2 ) ? ',' + c3 : '' ) : '' ),
                linear_gr = 'linear-gradient(' + linear + ')';

              if ( empty_cl <= 1 ) {
                css += 'background-color:transparent;';
              }

              if ( is_color && image ) {
                css += 'background-image:' + ( bg_layer ? image + ',' + linear_gr : linear_gr + ',' + image ) + ';';
              } else if ( image ) {
                css += 'background-image:' + image + ';';
              } else if ( empty_cl == 2 ) {
                css += 'background-color:' + c1 + c2 + c3 + ';';
              } else if ( linear && is_color ) {
                css += 'background-image:' + linear_gr + ';';
              }

            } else if ( property == 'margin' || property == 'padding' || property == 'border-width' ) {

              if ( Object.keys( val ).length == 4 ) {
                if ( val['top'] === val['right'] && val['bottom'] === val['left'] && val['top'] === val['left'] ) {
                  css += property + ':' + val['top'] + ';';
                } else if ( val['top'] !== val['bottom'] && val['right'] === val['left'] ) {
                  css += property + ':' + val['top'] + ' ' + val['right'] + ' ' + val['bottom'] + ';';
                } else if ( val['top'] === val['bottom'] && val['right'] === val['left'] ) {
                  css += property + ':' + val['top'] + ' ' + val['right'] + ';';
                } else {
                  css += property + ':' + val['top'] + ' ' + val['right'] + ' ' + val['bottom'] + ' ' + val['left'] + ';';
                }
              } else {
                $.each( val, function( obp, obv ) {
                  var width = ( property == 'border-width' ) ? '-width' : '',
                      new_pro = ( property == 'border-width' ) ? 'border' : property;
                  css += new_pro + '-' + obp + width + ':' + obv + ';';
                });
              }

            } else if ( property.indexOf( 'shadow' ) >= 0 ) {

              if ( typeof val === 'object' ) {
                val = jQuery.extend({}, {
                  x:      '0px',
                  y:      '0px',
                  blur:   '0px',
                  spread: '0px',
                  color:  '#000',
                  mode:   'outset',
                }, val );

                css += property + ':';
                $.each( val, function( k, v ) {
                  if ( ( k === 'spread' || k === 'mode' ) && property.indexOf( 'text-shadow' ) >= 0 ) {
                    v = null;
                  }

                  if ( v ) {
                    if ( k !== 'mode' ) {
                      css += ( k === 'x' ) ? v : ' ' + v;
                    } else {
                       css += ( v === 'inset' ) ? ' ' + v : '';
                    }
                  }
                });
                css += ';';
              }

            }

          } else if ( property == 'custom' ) {
            css += 'CDVZ' + val + 'CDVZ';

          } else if ( property == 'rtl' ) {
            css += 'RTL' + val + 'RTL';

          } else if ( property == 'content' ) {
            css += 'content:"' + val.replace( /"|:|;/g, '' ) + '";';

          } else if ( property == 'transform' ) {
            css += 'transform:rotate(' + val + ');';

          } else if ( property == 'blur' ) {
            css += 'filter:blur(' + val + ');';

          } else if ( property == 'grayscale' ) {
            css += 'filter:grayscale(' + val + ');';

          } else if ( property != 'live_id' && property != 'selector' ) {
            css += property + ':' + val + ';';
          }
        }
      });

      return css;
    }
    var kit_modal = $( '#cz_modal_kit' ), copied_d, copied_t, copied_m, copied_h, rgba_reset, reopen_modal;
    
    // Fix font - icon select in customizer
    $( '.wp-customizer' ).off( 'click.cz' ).on( 'click.cz', '.csf-font-add, .csf-icon-add', function(e) {
      if ( kit_modal.hasClass( 'ui-dialog-content' ) ) {
        var issk = $( this ).closest( '#cz_modal_kit' ).length;
        kit_modal.dialog( 'close' );
        setTimeout( function() {
          $( '#csf-modal-font, #csf-modal-icon' ).off( 'click.cz2' ).on( 'click.cz2', '.csf-font-close, .csf-icon-close, a', function(e) {
            if ( e.target.className.indexOf( 'fa' ) < 0 && kit_modal.hasClass( 'ui-dialog-content' ) && issk ) {
              kit_modal.dialog( 'open' );
            }
          });
        }, 500 );
      }
    });

    // Reload scripts
    $(document).on('csf-reload-script', function( event, $this ) {
      $this.find('.vc_css-editor').not('.csf-no-script').cz_vc_editor();
      $this.find('.csf-slider').not('.csf-no-script').csf_slider();
      $this.find('.cz_presets').not('.csf-no-script').csf_cz_presets();
      $this.find('[data-param_type="cz_image_select"]').not('.csf-no-script').csf_cz_image_select();
      $this.find('.cz_sc_id_field').not('.csf-no-script').cz_live_shortcode_id();

      // Block reveal dependency
      $this.find( '.vc_param-animation-style, .animation' ).on( 'change', function() {
        var val = $( this ).val();

        if ( val.indexOf( 'cz_brfx_' ) >= 0 || val.indexOf( 'cz_grid_brfx_' ) >= 0 ) {
          $this.find( '[data-vc-shortcode-param-name="sk_brfx"]' ).removeClass( 'vc_dependent-hidden hidden' );
        } else {
          $this.find( '[data-vc-shortcode-param-name="sk_brfx"]' ).addClass( 'vc_dependent-hidden hidden' );
        }
      }).trigger( 'change' );

      // Scroll menu styling btn to menu sk
      $( '.cz_menu_sk' ).each(function() {
        $( this ).on( 'click', function(e) {
          if ( $( '.wp-full-overlay-sidebar-content' ).length ) {
            $( '.wp-full-overlay-sidebar-content' ).animate({ scrollTop: $( this.hash ).position().top - 50 });
          }
          e.preventDefault();
        });
      });

      // Image dropdown param
      var iSelect = $( '.codevz_image_select' );
      iSelect.find( '> div' ).off().on( 'click', function(e) {
        var en = $( this ), 
            id = en.attr( 'data-id' ),
            ul = en.next( 'ul' );

        iSelect.find( 'ul' ).not( ul ).hide();
        en.find( 'i' ).toggleClass( 'fa-angle-down fa-angle-up' );

        ul.find( 'li[data-id="' + id + '"]' ).addClass( 'codevz_on' ).siblings().removeClass( 'codevz_on' );

        ul.toggle().find( 'li' ).off().on( 'click', function() {
          var li = $( this ),
              new_id = li.attr( 'data-id' );

          li.addClass( 'codevz_on' ).siblings().removeClass( 'codevz_on' );
          en.parent().find( 'input' ).val( new_id ).trigger( 'change' );
          en.attr( 'data-id', new_id ).find( '> img' ).attr( 'src', li.find( 'img' ).attr( 'src' ) );
          en.find( 'span span' ).html( li.attr( 'data-title' ) );
          en.next( 'ul' ).hide();
          en.find( 'i' ).attr( 'class', 'fa fa-angle-down' );
        });
      });
      $( 'body' ).on( 'click', function(e) {
          if ( ! $( e.target ).is( '.codevz_image_select *' ) ) {
              iSelect.find( 'ul' ).hide();
              iSelect.find( '> div i' ).attr( 'class', 'fa fa-angle-down' );
          }
      });

      // Advanced Background
      $( '.cz_advance_bg' ).off().on( 'click', function(e) {
        $( this ).hide();
        kit_modal.find( '.cz_bg_advanced' ).show();
        e.preventDefault();
      });

      // Close StyleKit on VC modal changes
      $( '.vc_ui-close-button, .vc_edit-form-tab-control, .vc_ui-panel-footer span, .vc_control-btn-layout, .vc_control-btn-edit, .vc_post-settings, .custom_columns, .vc-c-icon-mode_edit, .vc_ui-minimize-button' ).off().on( 'click', function() {
        if ( $( this ).data( 'vc-ui-element' ) == 'button-save' && $( '.compose-mode' ).length ) {
          return;
        }
        if ( kit_modal.hasClass( 'ui-dialog-content' ) ) {
          kit_modal.dialog( 'close' );
        }
      });

      // In the vc front-end
      $( '#vc_inline-frame' ).contents().find( ".vc_ui-close-button, .vc_ui-panel-footer span, .vc_control-btn-layout, .vc_control-btn-edit, .vc_post-settings, .custom_columns, .vc-c-icon-mode_edit, .vc_ui-minimize-button" ).off().on( 'click', function() {
        if ( kit_modal.hasClass( 'ui-dialog-content' ) ) {
          kit_modal.dialog( 'close' );
        }
      });

      // Advanced Show all _css_
      $( '.cz_advanced_tab span' ).off().on( 'click', function() {
        if ( ! $( this ).hasClass( 'cz_active' ) ) {
          $( this ).addClass( 'cz_active' ).siblings().removeClass( 'cz_active' ).closest( 'ul' ).toggleClass( 'cz_all_css_on' );
        }
      });

      // StyleKit value detection
      var vup = $( '.vc_ui-panel-window-inner' );
      if ( vup.length ) {
        vup.find( '.cz_sk_btn' ).each( function() {
          var en = $( this ),
              val = en.prev( '[name]' ).val(),
              out = '';

          en.parent().find( '> span' ).remove();

          if ( val && ! en.next( 'span' ).length ) {
            if ( val.indexOf( 'background' ) >= 0 ) {
              out += 'background';
            }
            if ( val.indexOf( 'font-size' ) >= 0 ) {
              out += out ? ', ' : '';
              out += 'font-size';
            }
            if ( val.indexOf( 'color' ) == 0 || val.indexOf( ';color' ) > 0 ) {
              out += out ? ', ' : '';
              out += 'color';
            }
            if ( val.indexOf( 'border-color' ) >= 0 ) {
              out += out ? ', ' : '';
              out += 'border color';
            }

            if ( out ) {
              en.parent().find( '.sk_btn_preview_image' ).after( '<span>[' + out + ']</span>' );
            }
          }
        });
      }

      // Fix niceScroll in modal
      setTimeout(function() {
        kit_modal.find( '.wp-picker-container' ).on( 'click', function() {
          setTimeout(function() {
            kit_modal.getNiceScroll().resize();
          }, 200 );
        });
      }, 1000 );

      // Preview image click
      $( '.sk_btn_preview_image' ).off().on( 'click', function(e) {

        $( this ).parent().find( '.cz_sk_btn' ).trigger( 'click' );

        e.preventDefault();
      });

      // StyleKit Button and data
      $this.find( '.cz_sk_btn' ).each( function() {

        var en = $( this ),
            val = en.parent().find( 'input' ).val(),
            preview_img = en.parent().find( '.sk_btn_preview_image' ),
            prev_img = val.match( /(http|https):\/\/[^ ]+(\.gif|\.jpg|\.jpeg|\.png)/gm );

        if ( val ) {
          en.addClass( 'active_stylekit' );
        }

        if ( prev_img && prev_img[0] ) {
          preview_img.css( 'display', 'inline-block' );
        }

        en.off().on( 'click', function( e ) {

          e.preventDefault();

          var en    = $( this ),
              par   = en.closest( '.vc_param' ).length ? en.parent() : $( 'body' ),
              inp   = en.prev( '[name]' ),
              name  = inp.attr( 'name' ),
              hvrid = inp.data( 'hover_id' ),
              id    = name.match( /\w+/g ),
              id    = id[ id.length - 1 ],
              nameT = name.replace( id, id + '_tablet' ),
              nameM = name.replace( id, id + '_mobile' ),
              csf   = inp.data( 'fields' ) + ' padding margin',
              csf_ar= csf.split( ' ' ),
              form  = $( 'form', kit_modal ),
              vcm   = en.closest( '.vc_ui-panel-content-container' ),
              vcp   = en.closest( '.ui-draggable' ),
              notvc = !vcm.length,
              nameH = vcm.length ? inp.data( 'hover_id' ) : name.replace( id, id + '_hover' ),
              customizer = $( '.wp-customizer' ).length,
              form_timeout = 0,
              reset_kit = function( r ) {
                kit_modal.removeClass( 'cz_show_all_sk' ).parent().find( '.cz_advanced_mode' ).removeClass( 'cz_advanced_mode_active' ).find( 'i' ).removeClass( 'fa-toggle-on' );
                
                en.removeClass( 'active_stylekit' );
               
                form.off( 'keyup change' );

                // Reset Process
                kit_modal.find( '[name]' ).not( '[name="live_id"]' ).val( '' ).trigger( 'change' ).closest( 'form' ).find( '.csf-icon-preview, .csf-font-remove, .csf-icon-remove' ).trigger( 'click' ).find( 'i:not(.fa-remove)' ).removeClass();
                kit_modal.find( '.cz_connect' ).removeClass( 'cz_connect' );
                kit_modal.find( '[name="background[orientation]"]' ).val( '90deg' ).trigger( 'change' );
                kit_modal.find( '.wp-picker-clear' ).trigger( 'click' );
                $( '.cz_advance_bg' ).show();
                kit_modal.find( '.cz_bg_advanced' ).hide();

                if ( r != 2 ) {
                  kit_modal.find( '[name]' ).closest( '.cz_sk_row > div > .csf-field' )[ r ? 'addClass' : 'hide' ]().closest( '.cz_sk_row' )[ r ? 'addClass' : 'hide' ]();
                }
                if ( r == 1 ) {
                  name  = kit_modal.find( '[name="live_id"]' ).val(),
                  id    = name.match( /\w+/g ),
                  id    = id[ id.length - 1 ],
                  nameT = name.replace( id, id + '_tablet' ),
                  nameM = name.replace( id, id + '_mobile' );
                  par.find( '[name="' + name + '"], [name="' + nameT + '"], [name="' + nameM + '"]' ).val( '' ).trigger( 'change' );
                }

                // Update hidden field
                clearTimeout( form_timeout );
                form_timeout = setTimeout(function() {
                  form.on( 'keyup change', '[name]', function() {
                    var new_vals = form.find('[name]').filter(function() {return !!$( this ).val();}).codevzSerializeObject();

                    new_vals = objToCSS( new_vals );

                    if ( new_vals ) {

                      en.addClass( 'active_stylekit' );

                      var prev_img = new_vals.match( /(http|https):\/\/[^ ]+(\.gif|\.jpg|\.jpeg|\.png)/gm );

                      if ( prev_img && prev_img[0] ) {
                        preview_img.css( 'background-image', 'url(' + prev_img[0] + ')' ).css( 'display', 'inline-block' );
                      } else {
                        preview_img.removeAttr( 'style' );
                      }

                    } else {

                      en.removeClass( 'active_stylekit' );
                      preview_img.removeAttr( 'style' );

                    }


                    par.find( '[name="' + $( '[name="live_id"]', form ).val() + '"]' ).val( new_vals ).trigger( 'change' );
                  });
                }, 100 );
              },
              show_csf = function() {
                $.each( csf_ar, function(i, k) {
                  if ( k === 'border' ) {
                    kit_modal.find( '[name="border-style"], [name="border-color"], [name="border-radius"]' ).closest( '.csf-field' ).show().closest( '.cz_sk_row' ).show();
                    kit_modal.find( '[name="border-width[top]"]' ).parents( '.csf-field' ).last().show().closest( '.cz_sk_row' ).show();
                  } else if ( k === 'border-color' ) {
                    kit_modal.find( '[name="border-style"]' ).val( 'solid' ).trigger( 'change' );
                  } else if ( k === 'padding' || k === 'margin' ) {
                    kit_modal.find( '[name="' + k + '[top]"]' ).parents( '.csf-field' ).last().show().closest( '.cz_sk_row' ).show();
                  } else if ( k === 'box-shadow' || k === 'text-shadow' ) {
                    kit_modal.find( '[name="' + k + '[x]"]' ).parents( '.csf-field' ).last().show().closest( '.cz_sk_row' ).show();
                  } else if ( k === 'background' ) {
                    kit_modal.find( '[name="' + k + '[image]"]' ).parents( '.csf-field' ).last().show().closest( '.cz_sk_row' ).show();
                    if ( kit_modal.find( '[name="background[color2]"]' ).val() || kit_modal.find( '[name="background[color3]"]' ).val() ) {
                      $( '.cz_advance_bg' ).trigger( 'click' );
                    }
                  } else if ( k === 'svg' ) {
                    kit_modal.find( '[name="_class_svg_type"], [name="_class_svg_size"], [name="_class_svg_color"]' ).closest( '.csf-field' ).show().closest( '.cz_sk_row' ).show();
                  } else {
                    kit_modal.find( '[name="' + k + '"]' ).closest( '.csf-field' ).show().closest( '.cz_sk_row' ).show();
                  }
                });

                kit_modal.find( '[name]' ).each(function() {
                  var pn = $( this );
                  if ( pn.val() && pn.attr( 'name' ) != 'live_id' && pn.attr( 'name' ) != 'background[orientation]' ) {
                    pn.closest( '.csf-field' ).show().closest( '.cz_sk_row' ).show();
                    pn.closest( 'fieldset' ).closest( '.csf-field' ).show();
                  }
                });

                kit_modal.find( '.cz_sk_row > .cz_hr' ).hide().each(function() {
                  var n = $( this ).next( '.col' );
                  if ( n.find('> .csf-field').css('display') == 'block' || n.next( '.col' ).find('> .csf-field').css('display') == 'block' || n.next( '.col' ).next( '.col' ).find('> .csf-field').css('display') == 'block' ) {
                    $( this ).show();
                  } else {
                    $( this ).hide();
                  }
                });
              },
              set_values = function( arr, l ) {
                $.each( arr, function( key, val ) {
                  var input_n = kit_modal.find( '[name="' + key + '"]' ), input_n2;
                  
                  if ( typeof val == 'object' ) {
                    $.each( val, function( k, v ) {
                      input_n2 = kit_modal.find( '[name="' + key + '[' + k + ']"]' );
                      input_n2.val( v ).trigger( 'change' );
                      if ( input_n2.hasClass( 'wp-color-picker' ) ) {
                        input_n2.wpColorPicker( 'color', v );
                        if ( v && v.indexOf( 'rgba' ) >= 0 ) {
                          var alpha = parseFloat( v.replace(/^.*,(.+)\)/, '$1') ) || 1;
                          input_n2.closest( '.wp-picker-container' ).find( '.csf-alpha-slider > span' ).css( 'left', ( alpha * 100 ) + '%' );
                          input_n2.closest( '.wp-picker-container' ).find( '.csf-alpha-text' ).html( alpha );
                        }
                      }
                    });
                  } else {
                    input_n.val( val ).trigger( 'change' );

                    if ( key === 'font-family' && val ) {
                      input_n.parent().find( '.csf-font-remove' ).removeClass( 'hidden' );
                    } else if ( key === '_class_indicator' && val ) {
                      input_n.parent().find( '.csf-icon-remove, .csf-icon-preview' ).removeClass( 'hidden' ).find( 'i' ).addClass( val );
                    }
                  }

                  if ( input_n.hasClass( 'wp-color-picker' ) ) {
                    input_n.wpColorPicker( 'color', val );
                    if ( val && val.indexOf( 'rgba' ) >= 0 ) {
                      var alpha = parseFloat( val.replace(/^.*,(.+)\)/, '$1') ) || 1;
                      input_n.closest( '.wp-picker-container' ).find( '.csf-alpha-slider > span' ).css( 'left', ( alpha * 100 ) + '%' );
                      input_n.closest( '.wp-picker-container' ).find( '.csf-alpha-text' ).html( alpha );
                    }
                  }
                });
                kit_modal.find( '[name="live_id"]' ).val( l ).trigger( 'change' );

                show_csf();
              },
              resizes = function() {
                kit_modal.css({
                  'width': parseInt( vcm.css( 'width' ) ) - 70 + 'px',
                  'height': parseInt( vcm.css( 'height' ) ) - 20 + 'px',
                  'max-height': parseInt( vcm.css( 'height' ) ) + 'px',
                }).closest( '.ui-dialog' ).css({
                  'top': parseInt( vcp.css( 'top' ) ) + 130 + 'px',
                  'left': parseInt( vcp.css( 'left' ) ) + 30 + 'px',
                  'width': parseInt( vcm.css( 'width' ) ) - 40 + 'px',
                  'height': parseInt( vcm.css( 'height' ) ) - 20 + 'px',
                });
              };

          // Fix hover ID for menus
          if ( nameH ) {
            if ( nameH.indexOf( 'menu-item' ) >= 0 ) {
              nameH = nameH.replace( '_hover', '' ).replace( '[', '_hover[' );
            }
            if ( nameH.indexOf( '_css_menu_a_' ) >= 0 ) {
             nameH = nameH.replace( '_hover]', ']' ).replace( '_css_menu_a_', '_css_menu_a_hover_' );
            }
            if ( nameH.indexOf( '_css_menu_ul_a_' ) >= 0 ) {
             nameH = nameH.replace( '_hover]', ']' ).replace( '_css_menu_ul_a_', '_css_menu_ul_a_hover_' );
            }
          }

          // RTL convert
          if ( $( 'body' ).hasClass( 'rtl' ) ) {
            inp.val( inp.val().replace( /RTL/g, '' ) );
          }

          // First load
          reset_kit();

          var new_css = cssToObj( inp.val() );

          if ( new_css ) {
            en.addClass( 'active_stylekit' );
          }

          set_values( new_css, name );

          // Modal kit dialog
          if ( ! kit_modal.hasClass( 'ui-dialog-content' ) ) {
            kit_modal.csf_reload_script().dialog({
              autoOpen: false,
              title: en.text(),
              closeText: '',
              height: 'auto',
              width: ( notvc ? 500 : vcm.width() - 60 ),
              maxHeight: ( notvc ? wind.height() * 0.6 : vcm.height() - 20 ),
              draggable: ( notvc ? true : false ),
              resizable: ( notvc ? true : false ),
              position: {of: ( notvc ? wind : vcm ),my:'center',at:'center'},
              open: function() {
                var titlebar = kit_modal.prev( '.ui-dialog-titlebar' );

                titlebar.find( '.fa-desktop' ).addClass( 'cz_sk_active_tab' ).siblings().removeClass( 'cz_sk_active_tab' );
                
                vcm.css( 'filter', 'blur(2px)' );

                titlebar.find( 'button' ).attr( 'data-title', 'Close' );
             
                titlebar.find( '.ui-dialog-title' ).attr( 'data-title', 'Normal Styles' );
              },
              close: function() {vcm.css( 'filter', 'blur(0px)' );}
            }).closest( '.ui-dialog' ).css({position:"fixed"});

            setTimeout(function() {
              kit_modal.dialog( "open" );
            }, 50 );

            // Reload sizes
            if ( ! notvc ) {
              vcp.off( 'drag.cz_sk resize.cz_sk' ).on( 'drag.cz_sk resize.cz_sk', resizes );
              wind.off( 'resize.cz_sk' ).on( 'resize.cz_sk', resizes );
            }
          } else {
            kit_modal.dialog( "open" ).prev( '.ui-dialog-titlebar' ).find( '.ui-dialog-title' ).html( en.text() );
            resizes();
            setTimeout(function() {
              kit_modal.getNiceScroll().resize();
            }, 200 );
          }

          // NiceScroll
          kit_modal.scrollTop(0).niceScroll({cursorcolor: "#7d7d7d",cursorborder: "0",cursorborderradius: "4px",cursoropacitymin: '0.7', cursorwidth: "8px",background: "rgba(125, 125, 125, 0.25)"});

          // NiceScroll fix
          kit_modal.find( '[name="border-style"], .cz_advance_bg' ).off( 'change.cz_nice click.cz_nice' ).on( 'change.cz_nice click.cz_nice', function() {
            setTimeout(function() {
              kit_modal.getNiceScroll().resize();
            }, 200 );
          });

          // dialog title icons
          var mTitle = kit_modal.prev( '.ui-dialog-titlebar' );

          // Hover
          mTitle.find( '.ui-dialog-title' ).removeClass( 'cz_deactive' ).parent().find( '.cz_sk_hover' ).removeClass( 'cz_active' );
          if ( hvrid && nameH ) {
            !mTitle.find( '.cz_sk_hover' ).length && mTitle.append( '<span class="cz_sk_hover" data-title="Hover Styles">Hover</span>' );
            mTitle.find( '.cz_sk_hover' ).off( 'click' ).on( 'click', function() {
              var en = $( this );
              reset_kit( 2 );
              set_values( cssToObj( $( '[name="' + nameH + '"]' ).val() ), nameH );
              mTitle.find( '.fa-desktop' ).addClass( 'cz_sk_active_tab' ).siblings().removeClass( 'cz_sk_active_tab' );
              en.addClass( 'cz_active' ).parent().find( '.ui-dialog-title' ).addClass( 'cz_deactive' );
            });
            mTitle.find( '.ui-dialog-title' ).off( 'click' ).on( 'click', function() {
              var en = $( this );
              reset_kit( 2 );
              set_values( cssToObj( $( '[name="' + name + '"]' ).val() ), name );
              en.removeClass( 'cz_deactive' ).parent().find( '.cz_sk_hover' ).removeClass( 'cz_active' );
            });
          } else {
            mTitle.find( '.cz_sk_hover' ).off( 'click' ).remove();
            mTitle.find( '.ui-dialog-title' ).off( 'click' ).removeClass( 'cz_deactive' );
          }

          // Reset button
          if ( ! mTitle.find( '.fa-refresh' ).length ) {
            mTitle.append( '<i class="fa fa-refresh" data-title="Reset"></i>' ).find( '.fa-refresh' ).on( 'click', function() {
              reset_kit( 1 );
            });
          }

          // Responsive buttons
          !mTitle.find( '.fa-mobile' ).length && mTitle.append( '<i class="fa fa-mobile" data-title="On Mobile"></i>' );
          !mTitle.find( '.fa-tablet' ).length && mTitle.append( '<i class="fa fa-tablet" data-title="On Tablet"></i>' );
          !mTitle.find( '.fa-desktop' ).length && mTitle.append( '<i class="fa fa-desktop cz_sk_active_tab" data-title="On Desktop"></i>' );
          
          mTitle.find( '.fa-tablet, .fa-mobile' ).removeClass( 'cz_deactive_tm cz_sk_active_tab' );
          mTitle.find( '.fa-desktop' ).addClass( 'cz_sk_active_tab' );
          if ( par.hasClass( 'cz_sk' ) || en.closest( '[id*="header_1"],[id*="header_2"],[id*="header_3"],[id*="header_5"],[id*="fixed_side_1"]' ).length || en.closest( '.csf-field-group' ).length || en.closest( '[id*="mobile_header"]' ).length ) {
            mTitle.find( '.fa-tablet, .fa-mobile' ).addClass( 'cz_deactive_tm' );
          }
          if ( ! par.find( '[name="' + nameM + '"]' ).length ) {
            mTitle.find( '.fa-mobile' ).addClass( 'cz_deactive_tm' );
          }
          if ( ! par.find( '[name="' + nameT + '"]' ).length ) {
            mTitle.find( '.fa-tablet' ).addClass( 'cz_deactive_tm' );
          }
          mTitle.find( '.fa-desktop, .fa-tablet, .fa-mobile' ).off().on( 'click', function() {
            var en = $( this ),
                nn = en.hasClass( 'fa-desktop' ) ? name : en.hasClass( 'fa-tablet' ) ? nameT : nameM;

            if ( en.hasClass( 'cz_sk_active_tab' ) || en.hasClass( 'cz_deactive_tm' ) ) {return;}
            mTitle.find( '.ui-dialog-title' ).removeClass( 'cz_deactive' ).parent().find( '.cz_sk_hover' ).removeClass( 'cz_active' );

            reset_kit( 2 );
            set_values( cssToObj( par.find( '[name="' + nn + '"]' ).val() ), nn );
            en.addClass( 'cz_sk_active_tab' ).siblings().removeClass( 'cz_sk_active_tab' );

            mTitle.find( '.fa-file-o,.fa-files-o' ).addClass( 'hide' );

            // Customizer trigger
            if ( customizer ) {
              if ( en.hasClass( 'fa-tablet' ) ) {
                $( '.preview-tablet' ).trigger( 'click' );
              } else if ( en.hasClass( 'fa-mobile' ) ) {
                $( '.preview-mobile' ).trigger( 'click' );
              } else {
                $( '.preview-desktop' ).trigger( 'click' );
              }

              $( '.ui-dialog-titlebar-close' ).off( 'click.cz_customizer_' ).on( 'click.cz_customizer_', function() {
                $( '.preview-desktop' ).trigger( 'click' );
              });
            }
          });

          // Copy/Paste
          if ( ! mTitle.find( '.fa-file-o' ).length && ! mTitle.find( '.fa-files-o' ).length ) {
            mTitle.append( '<i class="fa fa-file-o hide" data-title="Copy"></i><i class="fa fa-files-o hide" data-title="Paste"></i>' );
          }
          mTitle.find( '.fa-file-o' ).addClass( 'hide' ).off().on( 'click', function() {
            copied_d = par.find( '[name="' + name + '"]' ).val(),
            copied_t = par.find( '[name="' + nameT + '"]' ).val(),
            copied_m = par.find( '[name="' + nameM + '"]' ).val();
            copied_h = par.find( '[name="' + nameH + '"]' ).val();
            $( this ).addClass( 'cz_copied' ).attr( 'data-title', 'Copied: ' + en.text() );
            $( '.fa-files-o' ).addClass( 'cz_paste' ).attr( 'data-title', 'Paste ( ' + en.text() + ' ) here' );
          });
          mTitle.find( '.fa-files-o' ).addClass( 'hide' ).off().on( 'click', function() {
            mTitle.find( '.fa-desktop' ).addClass( 'cz_sk_active_tab' ).siblings().removeClass( 'cz_sk_active_tab' );
            copied_d && par.find( '[name="' + name + '"]' ).val( copied_d ).trigger( 'change' ).next( 'a' ).trigger( 'click' );
            copied_t && par.find( '[name="' + nameT + '"]' ).val( copied_t ).trigger( 'change' );
            copied_m && par.find( '[name="' + nameM + '"]' ).val( copied_m ).trigger( 'change' );
            copied_h && par.find( '[name="' + nameH + '"]' ).val( copied_h ).trigger( 'change' );
          });

          // Show all SK options
          if ( ! mTitle.find( '.fa-toggle-off' ).length ) {
            mTitle.append( '<i class="cz_advanced_mode" data-title="Advanced Mode"><i class="fa fa-toggle-off"></i></i>' );
          }
          mTitle.find( '.cz_advanced_mode' ).off().on( 'click', function() {
            $( this ).toggleClass( 'cz_advanced_mode_active' ).find( 'i' ).toggleClass( 'fa-toggle-on' );
            kit_modal.toggleClass( 'cz_show_all_sk' );
            mTitle.find( '.fa-file-o,.fa-files-o' ).toggleClass( 'hide' );
          });

        }); // style kit btn
      }); // each btn

    }); // csf reload

    // Fix options for Appearance > Menus
    if ( $( '#menu-management' ).length ) {
      $( '#menu-management .item-edit' ).on('click', function(e) {
        $( this ).closest('li').csf_reload_script();
      });

      // Fix for Pending new menu item
      $('ul.menu').on('change', 'li', function() {
        if ( $( this ).hasClass('pending') ) {
          $( this ).csf_reload_script();
        }
      });
    }
    
  });

})( jQuery, window, document );