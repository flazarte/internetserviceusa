/*
 2017 Julian Garnier
 Released under the MIT license
*/
var $jscomp$this=this;
(function(u,r){"function"===typeof define&&define.amd?define([],r):"object"===typeof module&&module.exports?module.exports=r():u.anime=r()})(this,function(){function u(a){if(!g.col(a))try{return document.querySelectorAll(a)}catch(b){}}function r(a){return a.reduce(function(a,c){return a.concat(g.arr(c)?r(c):c)},[])}function v(a){if(g.arr(a))return a;g.str(a)&&(a=u(a)||a);return a instanceof NodeList||a instanceof HTMLCollection?[].slice.call(a):[a]}function E(a,b){return a.some(function(a){return a===b})}
function z(a){var b={},c;for(c in a)b[c]=a[c];return b}function F(a,b){var c=z(a),d;for(d in a)c[d]=b.hasOwnProperty(d)?b[d]:a[d];return c}function A(a,b){var c=z(a),d;for(d in b)c[d]=g.und(a[d])?b[d]:a[d];return c}function R(a){a=a.replace(/^#?([a-f\d])([a-f\d])([a-f\d])$/i,function(a,b,c,h){return b+b+c+c+h+h});var b=/^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(a);a=parseInt(b[1],16);var c=parseInt(b[2],16),b=parseInt(b[3],16);return"rgb("+a+","+c+","+b+")"}function S(a){function b(a,b,c){0>
c&&(c+=1);1<c&&--c;return c<1/6?a+6*(b-a)*c:.5>c?b:c<2/3?a+(b-a)*(2/3-c)*6:a}var c=/hsl\((\d+),\s*([\d.]+)%,\s*([\d.]+)%\)/g.exec(a);a=parseInt(c[1])/360;var d=parseInt(c[2])/100,c=parseInt(c[3])/100;if(0==d)d=c=a=c;else{var e=.5>c?c*(1+d):c+d-c*d,k=2*c-e,d=b(k,e,a+1/3),c=b(k,e,a);a=b(k,e,a-1/3)}return"rgb("+255*d+","+255*c+","+255*a+")"}function w(a){if(a=/([\+\-]?[0-9#\.]+)(%|px|pt|em|rem|in|cm|mm|ex|pc|vw|vh|deg|rad|turn)?/.exec(a))return a[2]}function T(a){if(-1<a.indexOf("translate"))return"px";
if(-1<a.indexOf("rotate")||-1<a.indexOf("skew"))return"deg"}function G(a,b){return g.fnc(a)?a(b.target,b.id,b.total):a}function B(a,b){if(b in a.style)return getComputedStyle(a).getPropertyValue(b.replace(/([a-z])([A-Z])/g,"$1-$2").toLowerCase())||"0"}function H(a,b){if(g.dom(a)&&E(U,b))return"transform";if(g.dom(a)&&(a.getAttribute(b)||g.svg(a)&&a[b]))return"attribute";if(g.dom(a)&&"transform"!==b&&B(a,b))return"css";if(null!=a[b])return"object"}function V(a,b){var c=T(b),c=-1<b.indexOf("scale")?
1:0+c;a=a.style.transform;if(!a)return c;for(var d=[],e=[],k=[],h=/(\w+)\((.+?)\)/g;d=h.exec(a);)e.push(d[1]),k.push(d[2]);a=k.filter(function(a,c){return e[c]===b});return a.length?a[0]:c}function I(a,b){switch(H(a,b)){case "transform":return V(a,b);case "css":return B(a,b);case "attribute":return a.getAttribute(b)}return a[b]||0}function J(a,b){var c=/^(\*=|\+=|-=)/.exec(a);if(!c)return a;b=parseFloat(b);a=parseFloat(a.replace(c[0],""));switch(c[0][0]){case "+":return b+a;case "-":return b-a;case "*":return b*
a}}function C(a){return g.obj(a)&&a.hasOwnProperty("totalLength")}function W(a,b){function c(c){c=void 0===c?0:c;return a.el.getPointAtLength(1<=b+c?b+c:0)}var d=c(),e=c(-1),k=c(1);switch(a.property){case "x":return d.x;case "y":return d.y;case "angle":return 180*Math.atan2(k.y-e.y,k.x-e.x)/Math.PI}}function K(a,b){var c=/-?\d*\.?\d+/g;a=C(a)?a.totalLength:a;if(g.col(a))b=g.rgb(a)?a:g.hex(a)?R(a):g.hsl(a)?S(a):void 0;else{var d=w(a);a=d?a.substr(0,a.length-d.length):a;b=b?a+b:a}b+="";return{original:b,
numbers:b.match(c)?b.match(c).map(Number):[0],strings:b.split(c)}}function X(a,b){return b.reduce(function(b,d,e){return b+a[e-1]+d})}function L(a){return(a?r(g.arr(a)?a.map(v):v(a)):[]).filter(function(a,c,d){return d.indexOf(a)===c})}function Y(a){var b=L(a);return b.map(function(a,d){return{target:a,id:d,total:b.length}})}function Z(a,b){var c=z(b);if(g.arr(a)){var d=a.length;2!==d||g.obj(a[0])?g.fnc(b.duration)||(c.duration=b.duration/d):a={value:a}}return v(a).map(function(a,c){c=c?0:b.delay;
a=g.obj(a)&&!C(a)?a:{value:a};g.und(a.delay)&&(a.delay=c);return a}).map(function(a){return A(a,c)})}function aa(a,b){var c={},d;for(d in a){var e=G(a[d],b);g.arr(e)&&(e=e.map(function(a){return G(a,b)}),1===e.length&&(e=e[0]));c[d]=e}c.duration=parseFloat(c.duration);c.delay=parseFloat(c.delay);return c}function ba(a){return g.arr(a)?x.apply(this,a):M[a]}function ca(a,b){var c;return a.tweens.map(function(d){d=aa(d,b);var e=d.value,k=I(b.target,a.name),h=c?c.to.original:k,h=g.arr(e)?e[0]:h,n=J(g.arr(e)?
e[1]:e,h),k=w(n)||w(h)||w(k);d.isPath=C(e);d.from=K(h,k);d.to=K(n,k);d.start=c?c.end:a.offset;d.end=d.start+d.delay+d.duration;d.easing=ba(d.easing);d.elasticity=(1E3-Math.min(Math.max(d.elasticity,1),999))/1E3;g.col(d.from.original)&&(d.round=1);return c=d})}function da(a,b){return r(a.map(function(a){return b.map(function(b){var c=H(a.target,b.name);if(c){var d=ca(b,a);b={type:c,property:b.name,animatable:a,tweens:d,duration:d[d.length-1].end,delay:d[0].delay}}else b=void 0;return b})})).filter(function(a){return!g.und(a)})}
function N(a,b,c){var d="delay"===a?Math.min:Math.max;return b.length?d.apply(Math,b.map(function(b){return b[a]})):c[a]}function ea(a){var b=F(fa,a),c=F(ga,a),d=Y(a.targets),e=[],g=A(b,c),h;for(h in a)g.hasOwnProperty(h)||"targets"===h||e.push({name:h,offset:g.offset,tweens:Z(a[h],c)});a=da(d,e);return A(b,{animatables:d,animations:a,duration:N("duration",a,c),delay:N("delay",a,c)})}function m(a){function b(){return window.Promise&&new Promise(function(a){return P=a})}function c(a){return f.reversed?
f.duration-a:a}function d(a){for(var b=0,c={},d=f.animations,e={};b<d.length;){var g=d[b],h=g.animatable,n=g.tweens;e.tween=n.filter(function(b){return a<b.end})[0]||n[n.length-1];e.isPath$0=e.tween.isPath;e.round=e.tween.round;e.eased=e.tween.easing(Math.min(Math.max(a-e.tween.start-e.tween.delay,0),e.tween.duration)/e.tween.duration,e.tween.elasticity);n=X(e.tween.to.numbers.map(function(a){return function(b,c){c=a.isPath$0?0:a.tween.from.numbers[c];b=c+a.eased*(b-c);a.isPath$0&&(b=W(a.tween.value,
b));a.round&&(b=Math.round(b*a.round)/a.round);return b}}(e)),e.tween.to.strings);ha[g.type](h.target,g.property,n,c,h.id);g.currentValue=n;b++;e={isPath$0:e.isPath$0,tween:e.tween,eased:e.eased,round:e.round}}if(c)for(var k in c)D||(D=B(document.body,"transform")?"transform":"-webkit-transform"),f.animatables[k].target.style[D]=c[k].join(" ");f.currentTime=a;f.progress=a/f.duration*100}function e(a){if(f[a])f[a](f)}function g(){f.remaining&&!0!==f.remaining&&f.remaining--}function h(a){var h=f.duration,
k=f.offset,m=f.delay,O=f.currentTime,p=f.reversed,q=c(a),q=Math.min(Math.max(q,0),h);q>k&&q<h?(d(q),!f.began&&q>=m&&(f.began=!0,e("begin")),e("run")):(q<=k&&0!==O&&(d(0),p&&g()),q>=h&&O!==h&&(d(h),p||g()));a>=h&&(f.remaining?(t=n,"alternate"===f.direction&&(f.reversed=!f.reversed)):(f.pause(),P(),Q=b(),f.completed||(f.completed=!0,e("complete"))),l=0);if(f.children)for(a=f.children,h=0;h<a.length;h++)a[h].seek(q);e("update")}a=void 0===a?{}:a;var n,t,l=0,P=null,Q=b(),f=ea(a);f.reset=function(){var a=
f.direction,b=f.loop;f.currentTime=0;f.progress=0;f.paused=!0;f.began=!1;f.completed=!1;f.reversed="reverse"===a;f.remaining="alternate"===a&&1===b?2:b};f.tick=function(a){n=a;t||(t=n);h((l+n-t)*m.speed)};f.seek=function(a){h(c(a))};f.pause=function(){var a=p.indexOf(f);-1<a&&p.splice(a,1);f.paused=!0};f.play=function(){f.paused&&(f.paused=!1,t=0,l=f.completed?0:c(f.currentTime),p.push(f),y||ia())};f.reverse=function(){f.reversed=!f.reversed;t=0;l=c(f.currentTime)};f.restart=function(){f.pause();
f.reset();f.play()};f.finished=Q;f.reset();f.autoplay&&f.play();return f}var fa={update:void 0,begin:void 0,run:void 0,complete:void 0,loop:1,direction:"normal",autoplay:!0,offset:0},ga={duration:1E3,delay:0,easing:"easeOutElastic",elasticity:500,round:0},U="translateX translateY translateZ rotate rotateX rotateY rotateZ scale scaleX scaleY scaleZ skewX skewY".split(" "),D,g={arr:function(a){return Array.isArray(a)},obj:function(a){return-1<Object.prototype.toString.call(a).indexOf("Object")},svg:function(a){return a instanceof
SVGElement},dom:function(a){return a.nodeType||g.svg(a)},str:function(a){return"string"===typeof a},fnc:function(a){return"function"===typeof a},und:function(a){return"undefined"===typeof a},hex:function(a){return/(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(a)},rgb:function(a){return/^rgb/.test(a)},hsl:function(a){return/^hsl/.test(a)},col:function(a){return g.hex(a)||g.rgb(a)||g.hsl(a)}},x=function(){function a(a,c,d){return(((1-3*d+3*c)*a+(3*d-6*c))*a+3*c)*a}return function(b,c,d,e){if(0<=b&&1>=b&&
0<=d&&1>=d){var g=new Float32Array(11);if(b!==c||d!==e)for(var h=0;11>h;++h)g[h]=a(.1*h,b,d);return function(h){if(b===c&&d===e)return h;if(0===h)return 0;if(1===h)return 1;for(var k=0,l=1;10!==l&&g[l]<=h;++l)k+=.1;--l;var l=k+(h-g[l])/(g[l+1]-g[l])*.1,n=3*(1-3*d+3*b)*l*l+2*(3*d-6*b)*l+3*b;if(.001<=n){for(k=0;4>k;++k){n=3*(1-3*d+3*b)*l*l+2*(3*d-6*b)*l+3*b;if(0===n)break;var m=a(l,b,d)-h,l=l-m/n}h=l}else if(0===n)h=l;else{var l=k,k=k+.1,f=0;do m=l+(k-l)/2,n=a(m,b,d)-h,0<n?k=m:l=m;while(1e-7<Math.abs(n)&&
10>++f);h=m}return a(h,c,e)}}}}(),M=function(){function a(a,b){return 0===a||1===a?a:-Math.pow(2,10*(a-1))*Math.sin(2*(a-1-b/(2*Math.PI)*Math.asin(1))*Math.PI/b)}var b="Quad Cubic Quart Quint Sine Expo Circ Back Elastic".split(" "),c={In:[[.55,.085,.68,.53],[.55,.055,.675,.19],[.895,.03,.685,.22],[.755,.05,.855,.06],[.47,0,.745,.715],[.95,.05,.795,.035],[.6,.04,.98,.335],[.6,-.28,.735,.045],a],Out:[[.25,.46,.45,.94],[.215,.61,.355,1],[.165,.84,.44,1],[.23,1,.32,1],[.39,.575,.565,1],[.19,1,.22,1],
[.075,.82,.165,1],[.175,.885,.32,1.275],function(b,c){return 1-a(1-b,c)}],InOut:[[.455,.03,.515,.955],[.645,.045,.355,1],[.77,0,.175,1],[.86,0,.07,1],[.445,.05,.55,.95],[1,0,0,1],[.785,.135,.15,.86],[.68,-.55,.265,1.55],function(b,c){return.5>b?a(2*b,c)/2:1-a(-2*b+2,c)/2}]},d={linear:x(.25,.25,.75,.75)},e={},k;for(k in c)e.type=k,c[e.type].forEach(function(a){return function(c,e){d["ease"+a.type+b[e]]=g.fnc(c)?c:x.apply($jscomp$this,c)}}(e)),e={type:e.type};return d}(),ha={css:function(a,b,c){return a.style[b]=
c},attribute:function(a,b,c){return a.setAttribute(b,c)},object:function(a,b,c){return a[b]=c},transform:function(a,b,c,d,e){d[e]||(d[e]=[]);d[e].push(b+"("+c+")")}},p=[],y=0,ia=function(){function a(){y=requestAnimationFrame(b)}function b(b){var c=p.length;if(c){for(var e=0;e<c;)p[e]&&p[e].tick(b),e++;a()}else cancelAnimationFrame(y),y=0}return a}();m.version="2.0.1";m.speed=1;m.running=p;m.remove=function(a){a=L(a);for(var b=p.length-1;0<=b;b--)for(var c=p[b],d=c.animations,e=d.length-1;0<=e;e--)E(a,
d[e].animatable.target)&&(d.splice(e,1),d.length||c.pause())};m.getValue=I;m.path=function(a,b){var c=g.str(a)?u(a)[0]:a,d=b||100;return function(a){return{el:c,property:a,totalLength:c.getTotalLength()*(d/100)}}};m.setDashoffset=function(a){var b=a.getTotalLength();a.setAttribute("stroke-dasharray",b);return b};m.bezier=x;m.easings=M;m.timeline=function(a){var b=m(a);b.duration=0;b.children=[];b.add=function(a){v(a).forEach(function(a){var c=a.offset,d=b.duration;a.autoplay=!1;a.offset=g.und(c)?
d:J(c,d);a=m(a);a.duration>d&&(b.duration=a.duration);b.children.push(a)});return b};return b};m.random=function(a,b){return Math.floor(Math.random()*(b-a+1))+a};return m});

/* charming.js */
!function(e){"undefined"==typeof module?this.charming=e:module.exports=e}(function(e,n){"use strict";n=n||{};var t=n.tagName||"span",o=null!=n.classPrefix?n.classPrefix:"char",r=1,a=function(e){for(var n=e.parentNode,a=e.nodeValue,c=a.length,l=-1;++l<c;){var d=document.createElement(t);o&&(d.className=o+r,r++),d.appendChild(document.createTextNode(a[l])),n.insertBefore(d,e)}n.removeChild(e)};return function c(e){for(var n=[].slice.call(e.childNodes),t=n.length,o=-1;++o<t;)c(n[o]);e.nodeType===Node.TEXT_NODE&&a(e)}(e),e});

/**
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2017, Codrops
 * http://www.codrops.com
 */
{
	const config = {
		cora: {
			in: {
				base: {
					duration: 600,
					easing: 'easeOutQuint',
					scale: [0,1],
					rotate: [-180,0],
					opacity: {
						value: 1,
						easing: 'linear',
						duration: 100
					}
				},
				content: {
					duration: 300,
					delay: 250,
					easing: 'easeOutQuint',
					translateY: [20,0],
					opacity: {
						value: 1,
						easing: 'linear',
						duration: 100
					}
				},
				trigger: {
					duration: 300,
					easing: 'easeOutExpo',
					scale: [1,0.9],
					color: '#6fbb95'
				}
			},
			out: {
				base: {
					duration: 150,
					delay: 50,
					easing: 'easeInQuad',
					scale: 0,
					opacity: {
						delay: 100,
						value: 0,
						easing: 'linear'
					}
				},
				content: {
					duration: 100,
					easing: 'easeInQuad',
					translateY: 20,
					opacity: {
						value: 0,
						easing: 'linear'
					}
				},
				trigger: {
					duration: 300,
					delay: 50,
					easing: 'easeOutExpo',
					scale: 1,
					color: '#666'
				}
			}
		},
		smaug: {
			in: {
				base: {
					duration: 200,
					easing: 'easeOutQuad',
					rotate: [35,0],
					opacity: {
						value: 1,
						easing: 'linear',
						duration: 100
					}
				},
				content: {
					duration: 1000,
					delay: 50,
					easing: 'easeOutElastic',
					translateX: [50,0],
					rotate: [10, 0],
					opacity: {
						value: 1,
						easing: 'linear',
						duration: 100
					}
				},
				trigger: {
					translateX: [
						{value: '-30%', duration: 130, easing: 'easeInQuad'},
						{value: ['30%','0%'], duration: 900, easing: 'easeOutElastic'}
					],
					opacity: [
						{value: 0, duration: 130, easing: 'easeInQuad'},
						{value: 1, duration: 130, easing: 'easeOutQuad'}
					],
					color: [
						{value: '#6fbb95', duration: 1, delay: 130, easing: 'easeOutQuad'}
					]
				}
			},
			out: {
				base: {
					duration: 200,
					delay: 100,
					easing: 'easeInQuad',
					rotate: -35,
					opacity: 0
				},
				content: {
					duration: 200,
					easing: 'easeInQuad',
					translateX: -30,
					rotate: -10,
					opacity: 0
				},
				trigger: {
					translateX: [
						{value: '-30%', duration: 200, easing: 'easeInQuad'},
						{value: ['30%','0%'], duration: 200, easing: 'easeOutQuad'}
					],
					opacity: [
						{value: 0, duration: 200, easing: 'easeInQuad'},
						{value: 1, duration: 200, easing: 'easeOutQuad'}
					],
					color: [
						{value: '#666', duration: 1, delay: 200, easing: 'easeOutQuad'}
					]
				}
			}
		},
		uldor: {
			in: {
				base: {
					duration: 400,
					easing: 'easeOutExpo',
					scale: [0.5,1],
					opacity: {
						value: 1,
						easing: 'linear',
						duration: 100
					}
				},
				path: {
					duration: 900,
					easing: 'easeOutElastic',
					d: 'M 33.5,31 C 33.5,31 145,31 200,31 256,31 367,31 367,31 367,31 367,110 367,150 367,190 367,269 367,269 367,269 256,269 200,269 145,269 33.5,269 33.5,269 33.5,269 33.5,190 33.5,150 33.5,110 33.5,31 33.5,31 Z'
				},
				content: {
					duration: 900,
					easing: 'easeOutElastic',
					delay: 100,
					scale: [0.8,1],
					opacity: {
						value: 1,
						easing: 'linear',
						duration: 100
					}
				},
				trigger: {
					translateY: [
						{value: '-50%', duration: 100, easing: 'easeInQuad'},
						{value: ['50%','0%'], duration: 100, easing: 'easeOutQuad'}
					],
					opacity: [
						{value: 0, duration: 100, easing: 'easeInQuad'},
						{value: 1, duration: 100, easing: 'easeOutQuad'}
					],
					color: {
						value: '#6fbb95', 
						duration: 1, 
						delay: 100, 
						easing: 'easeOutQuad'
					}
				}
			},
			out: {
				base: {
					duration: 200,
					easing: 'easeInExpo',
					scale: 0.5,
					opacity: {
						value: 0,
						duration: 75,
						easing: 'linear'
					}
				},
				path: {
					duration: 200,
					easing: 'easeOutQuint',
					d: 'M 79.5,66 C 79.5,66 128,106 202,105 276,104 321,66 321,66 321,66 287,84 288,155 289,226 318,232 318,232 318,232 258,198 200,198 142,198 80.5,230 80.5,230 80.5,230 112,222 111,152 110,82 79.5,66 79.5,66 Z'
				},
				content: {
					duration: 100,
					easing: 'easeOutQuint',
					scale: 0.8,
					opacity: {
						value: 0,
						duration: 50,
						easing: 'linear'
					}
				},
				trigger: {
					translateY: [
						{value: '50%', duration: 100, easing: 'easeInQuad'},
						{value: ['-50%','0%'], duration: 100, easing: 'easeOutQuad'}
					],
					opacity: [
						{value: 0, duration: 100, easing: 'easeInQuad'},
						{value: 1, duration: 100, easing: 'easeOutQuad'}
					],
					color: {
						value: '#666', 
						duration: 1, 
						delay: 100, 
						easing: 'easeOutQuad'
					}
				}
			}
		},
		dori: {
			in: {
				base: {
					duration: 800,
					easing: 'easeOutElastic',
					translateY: [60,0],
					scale: [0.5,1],
					opacity: {
						value: 1,
						easing: 'linear',
						duration: 100
					}
				},
				path: {
					duration: 1200,
					delay: 50,
					easing: 'easeOutElastic',
					elasticity: 700,
					d: 'M 22,74.2 22,202 C 22,202 82,202 103,202 124,202 184,202 184,202 L 200,219 216,202 C 216,202 274,202 297,202 320,202 378,202 378,202 L 378,74.2 C 378,74.2 318,73.7 200,73.7 82,73.7 22,74.2 22,74.2 Z'
				},
				content: {
					duration: 300,
					delay: 100,
					easing: 'easeOutQuint',
					translateY: [20,0],
					opacity: {
						value: 1,
						easing: 'linear',
						duration: 100
					}
				},
				trigger: {
					translateY: [
						{value: '-50%', duration: 100, easing: 'easeInQuad'},
						{value: ['50%','0%'], duration: 100, easing: 'easeOutQuad'}
					],
					opacity: [
						{value: 0, duration: 100, easing: 'easeInQuad'},
						{value: 1, duration: 100, easing: 'easeOutQuad'}
					],
					color: {
						value: '#6fbb95', 
						duration: 1, 
						delay: 100, 
						easing: 'easeOutQuad'
					}
				}
			},
			out: {
				base: {
					duration: 200,
					easing: 'easeInQuad',
					translateY: 60,
					scale: 0.5,
					opacity: {
						value: 0,
						delay: 100,
						duration: 100,
						easing: 'linear'
					}
				},
				path: {
					duration: 200,
					easing: 'easeInQuad',
					d: 'M 22,108 22,236 C 22,236 64,216 103,212 142,208 184,212 184,212 L 200,229 216,212 C 216,212 258,207 297,212 336,217 378,236 378,236 L 378,108 C 378,108 318,83.7 200,83.7 82,83.7 22,108 22,108 Z'
				},
				content: {
					duration: 100,
					easing: 'easeInQuad',
					translateY: 20,
					opacity: {
						value: 0,
						easing: 'linear'
					}
				},
				trigger: {
					translateY: [
						{value: '-50%', duration: 100, easing: 'easeInQuad'},
						{value: ['50%','0%'], duration: 100, easing: 'easeOutQuad'}
					],
					opacity: [
						{value: 0, duration: 100, easing: 'easeInQuad'},
						{value: 1, duration: 100, easing: 'easeOutQuad'}
					],
					color: {
						value: '#666', 
						duration: 1, 
						delay: 100, 
						easing: 'easeOutQuad'
					}
				}
			}
		},
		walda: {
			in: {
				base: {
					duration: 100,
					easing: 'linear',
					opacity: 1
				},
				deco: {
					duration: 500,
					easing: 'easeOutExpo',
					scaleY: [0,1]
				},
				content: {
					duration: 125,
					easing: 'easeOutExpo',
					delay: function(t,i) {
						return i*15;
					},
					easing: 'linear',
					translateY: ['50%','0%'],
					opacity: [0,1]
				},
				trigger: {
					translateX: [
						{value: '30%', duration: 100, easing: 'easeInQuad'},
						{value: ['-30%','0%'], duration: 100, easing: 'easeOutQuad'}
					],
					opacity: [
						{value: 0, duration: 100, easing: 'easeInQuad'},
						{value: 1, duration: 100, easing: 'easeOutQuad'}
					],
					color: [
						{value: '#6fbb95', duration: 1, delay: 100, easing: 'easeOutQuad'}
					]
				}
			},
			out: {
				base: {
					duration: 100,
					delay: 100,
					easing: 'linear',
					opacity: 0
				},
				deco: {
					duration: 400,
					easing: 'easeOutExpo',
					scaleY: 0
				},
				content: {
					duration: 1,
					easing: 'linear',
					opacity: 0
				},
				trigger: {
					translateX: [
						{value: '30%', duration: 100, easing: 'easeInQuad'},
						{value: ['-30%','0%'], duration: 100, easing: 'easeOutQuad'}
					],
					opacity: [
						{value: 0, duration: 100, easing: 'easeInQuad'},
						{value: 1, duration: 100, easing: 'easeOutQuad'}
					],
					color: [
						{value: '#666', duration: 1, delay: 100, easing: 'easeOutQuad'}
					]
				}
			},	
		},
		gram: {
			in: {
				base: {
					duration: 400,
					easing: 'easeOutQuint',
					scaleX: [1.2,1],
					opacity: {
						value: 1,
						easing: 'linear',
						duration: 50
					}
				},
				path: {
					duration: 600,
					easing: 'easeOutQuint',
					d: 'M 92.4,79 C 136,79 156,79.1 200,79.4 244,79.7 262,79 308,79 354,79 381,111 381,150 381,189 346,220 308,221 270,222 236,221 200,221 164,221 130,222 92.4,221 54.4,220 19,189 19,150 19,111 48.6,79 92.4,79 Z'
				},
				content: {
					delay: 100,
					scale: {
						value: [0.8,1],
						duration: 300,
						easing: 'easeOutQuint'
					},
					opacity: {
						value: [0,1],
						easing: 'linear',
						duration: 100
					}
				},
				trigger: {
					duration: 300,
					easing: 'easeOutQuint',
					scale: [1,0.9],
					color: '#6fbb95'
				}
			},
			out: {
				base: {
					duration: 200,
					easing: 'easeInQuint',
					scaleX: 1.1,
					scaleY: 0.9,
					opacity: {
						value: 0,
						delay: 100,
						duration: 150,
						easing: 'linear'
					}
				},
				path: {
					duration: 200,
					easing: 'easeInQuint',
					d: 'M 92.4,79 C 136,79 154,115 200,116 246,117 263,80.4 308,79 353,77.6 381,111 381,150 381,189 346,220 308,221 270,222 236,188 200,188 164,188 130,222 92.4,221 54.4,220 19,189 19,150 19,111 48.6,79 92.4,79 Z'
				},
				content: {
					duration: 150,
					easing: 'easeInQuint',
					scale: 0.8,
					opacity: {
						value: 0,
						duration: 100,
						easing: 'linear'
					}
				},
				trigger: {
					duration: 200,
					easing: 'easeInQuint',
					scale: 1,
					color: '#666'
				}
			}
		},
		narvi: {
			in: {
				base: {
					duration: 1,
					easing: 'linear',
					opacity: 1
				},
				path: {
					duration: 800,
					easing: 'easeOutQuint',
					rotate: [0,90],
					opacity: {
						value: 1,
						duration: 200,
						easing: 'linear'
					}
				},
				content: {
					duration: 600,
					easing: 'easeOutQuint',
					translateX: [50,0],
					opacity: {
						value: 1,
						duration: 100,
						easing: 'linear'
					}
				},
				trigger: {
					translateX: [
						{value: '-30%', duration: 100, easing: 'easeInQuint'},
						{value: ['30%','0%'], duration: 250, easing: 'easeOutQuint'}
					],
					opacity: [
						{value: 0, duration: 100, easing: 'easeInQuint'},
						{value: 1, duration: 250, easing: 'easeOutQuint'}
					],
					color: [
						{value: '#6fbb95', duration: 1, delay: 100, easing: 'easeOutQuint'}
					]
				}
			},
			out: {
				base: {
					duration: 100,
					delay: 400,
					easing: 'linear',
					opacity: 0
				},
				path: {
					duration: 500,
					delay: 0,
					easing: 'easeInOutQuint',
					rotate: 0,
					opacity: {
						value: 0,
						duration: 50,
						delay: 210,
						easing: 'linear'
					}
				},
				content: {
					duration: 500,
					easing: 'easeInOutQuint',
					translateX: 100,
					opacity: {
						value: 0,
						duration: 50,
						delay: 210,
						easing: 'linear'
					}
				},
				trigger: {
					translateX: [
						{value: '30%', duration: 200, easing: 'easeInQuint'},
						{value: ['-30%','0%'], duration: 200, easing: 'easeOutQuint'}
					],
					opacity: [
						{value: 0, duration: 200, easing: 'easeInQuint'},
						{value: 1, duration: 200, easing: 'easeOutQuint'}
					],
					color: [
						{value: '#666', duration: 1, delay: 200, easing: 'easeOutQuint'}
					]
				}
			}
		},
		indis: {
			in: {
				base: {
					duration: 500,
					easing: 'easeOutQuint',
					translateY: [100,0],
					opacity: {
						value: 1,
						duration: 50,
						easing: 'linear'
					}
				},
				shape: {
					duration: 350,
					easing: 'easeOutBack',
					scaleY:  {
						value: [1.3,1],
						duration: 1300,
						easing: 'easeOutElastic',
						elasticity: 500
					},
					scaleX: {
						value: [0.3,1],
						duration: 1300,
						easing: 'easeOutElastic',
						elasticity: 500
					},
				},
				path: {
					duration: 450,
					easing: 'easeInOutQuad',
					d: 'M 44.5,24 C 148,24 252,24 356,24 367,24 376,32.9 376,44 L 376,256 C 376,267 367,276 356,276 252,276 148,276 44.5,276 33.4,276 24.5,267 24.5,256 L 24.5,44 C 24.5,32.9 33.4,24 44.5,24 Z'
				},	
				content: {
					duration: 300,
					delay: 50,
					easing: 'easeOutQuad',
					translateY: [10,0],
					opacity: {
						value: 1,
						easing: 'linear',
						duration: 100
					}
				},
				trigger: {
					translateY: [
						{value: '-50%', duration: 100, easing: 'easeInQuad'},
						{value: ['50%','0%'], duration: 100, easing: 'easeOutQuad'}
					],
					opacity: [
						{value: 0, duration: 100, easing: 'easeInQuad'},
						{value: 1, duration: 100, easing: 'easeOutQuad'}
					],
					color: {
						value: '#6fbb95', 
						duration: 1, 
						delay: 100, 
						easing: 'easeOutQuad'
					}
				}
			},
			out: {
				base: {
					duration: 320,
					delay: 50,
					easing: 'easeInOutQuint',
					scaleY: 1.5,
					scaleX: 0,
					translateY: -100,
					opacity: {
						value: 0,
						duration: 100,
						delay: 130,
						easing: 'linear'
					}
				},
				path: {
					duration: 300,
					delay: 50,
					easing: 'easeInOutQuint',
					d: 'M 44.5,24 C 138,4.47 246,-6.47 356,24 367,26.9 376,32.9 376,44 L 376,256 C 376,267 367,279 356,276 231,240 168,241 44.5,276 33.8,279 24.5,267 24.5,256 L 24.5,44 C 24.5,32.9 33.6,26.3 44.5,24 Z'
				},
				content: {
					duration: 300,
					easing: 'easeInOutQuad',
					translateY: -40,
					opacity: {
						value: 0,
						duration: 100,
						delay: 135,
						easing: 'linear'
					}
				},
				trigger: {
					translateY: [
						{value: '-50%', duration: 100, easing: 'easeInQuad'},
						{value: ['50%','0%'], duration: 100, easing: 'easeOutQuad'}
					],
					opacity: [
						{value: 0, duration: 100, easing: 'easeInQuad'},
						{value: 1, duration: 100, easing: 'easeOutQuad'}
					],
					color: {
						value: '#666', 
						duration: 1, 
						delay: 100, 
						easing: 'easeOutQuad'
					}
				}
			}
		},
		amras: {
			in: {
				base: {
					duration: 1,
					delay: 50,
					easing: 'linear',
					opacity: 1
				},
				path: {
					duration: 800,
					delay: 100,
					easing: 'easeOutElastic',
					delay: function(t,i) {
						return i*20;
					},
					scale: [0,1],
				},	
				content: {
					duration: 300,
					delay: 250,
					easing: 'easeOutExpo',
					scale: [0.7,1],
					opacity: {
						value: 1,
						easing: 'linear',
						duration: 100
					}
				},
				trigger: {
					translateY: [
						{value: '50%', duration: 100, easing: 'easeInQuad'},
						{value: ['-50%','0%'], duration: 100, easing: 'easeOutQuad'}
					],
					opacity: [
						{value: 0, duration: 100, easing: 'easeInQuad'},
						{value: 1, duration: 100, easing: 'easeOutQuad'}
					],
					color: {
						value: '#6fbb95', 
						duration: 1, 
						delay: 100, 
						easing: 'easeOutQuad'
					}
				}
			},
			out: {
				base: {
					duration: 1,
					delay: 450,
					easing: 'linear',
					opacity: 0
				},
				path: {
					duration: 500,
					easing: 'easeOutExpo',
					delay: function(t,i,c) {
						return (c-i-1)*40;
					},
					scale: 0
				},
				content: {
					duration: 300,
					easing: 'easeOutExpo',
					scale: 0.7,
					opacity: {
						value: 0,
						duration: 100,
						easing: 'linear'
					}
				},
				trigger: {
					translateY: [
						{value: '-50%', duration: 100, easing: 'easeInQuad'},
						{value: ['50%','0%'], duration: 100, easing: 'easeOutQuad'}
					],
					opacity: [
						{value: 0, duration: 100, easing: 'easeInQuad'},
						{value: 1, duration: 100, easing: 'easeOutQuad'}
					],
					color: {
						value: '#666', 
						duration: 1, 
						delay: 100, 
						easing: 'easeOutQuad'
					}
				}
			}
		},
		hador: {
			in: {
				base: {
					duration: 1,
					delay: 100,
					easing: 'linear',
					opacity: 1
				},
				path: {
					duration: 1000,
					easing: 'easeOutExpo',
					delay: function(t,i) {
						return i*150;
					},
					scale: [0,1],
					translateY: function(t,i,c) {
						return i === c-1 ? ['50%','0%'] : 0;
					},
					rotate: function(t,i,c) {
						return i === c-1 ? [90,0] : 0;
					}
				},	
				content: {
					duration: 600,
					delay: 750,
					easing: 'easeOutExpo',
					scale: [0.5,1],
					opacity: {
						value: 1,
						easing: 'linear',
						duration: 400
					}
				},
				trigger: {
					translateX: [
						{value: '30%', duration: 200, easing: 'easeInExpo'},
						{value: ['-30%','0%'], duration: 200, easing: 'easeOutExpo'}
					],
					opacity: [
						{value: 0, duration: 200, easing: 'easeInExpo'},
						{value: 1, duration: 200, easing: 'easeOutExpo'}
					],
					color: [
						{value: '#6fbb95', duration: 1, delay: 200, easing: 'easeOutExpo'}
					]
				}
			},
			out: {
				base: {
					duration: 1,
					delay: 450,
					easing: 'linear',
					opacity: 0
				},
				path: {
					duration: 300,
					easing: 'easeOutExpo',
					delay: function(t,i,c) {
						return (c-i-1)*50;
					},
					scale: 0
				},	
				content: {
					duration: 200,
					easing: 'easeOutExpo',
					scale: 0.7,
					opacity: {
						value: 0,
						duration: 50,
						easing: 'linear'
					}
				},
				trigger: {
					translateX: [
						{value: '30%', duration: 100, easing: 'easeInQuad'},
						{value: ['-30%','0%'], duration: 100, easing: 'easeOutQuad'}
					],
					opacity: [
						{value: 0, duration: 100, easing: 'easeInQuad'},
						{value: 1, duration: 100, easing: 'easeOutQuad'}
					],
					color: [
						{value: '#666', duration: 1, delay: 100, easing: 'easeOutQuad'}
					]
				}
			}
		},
		malva: {
			in: {
				base: {
					translateX: [
						{value: 3, duration: 100, delay: 150, easing: 'linear'},
						{value: -3, duration: 100, easing: 'linear'},
						{value: 3, duration: 100, easing: 'linear'},
						{value: -3, duration: 100, easing: 'linear'},
						{value: 3, duration: 100, easing: 'linear'},
						{value: -3, duration: 100, easing: 'linear'},
						{value: 3, duration: 100, easing: 'linear'},
						{value: -3, duration: 100, easing: 'linear'},
						{value: 0, duration: 100, easing: [0.1,1,0.3,1]},
					],
					translateY: [
						{value: -3, duration: 100, delay: 150, easing: 'linear'},
						{value: 3, duration: 100, easing: 'linear'},
						{value: -3, duration: 100, easing: 'linear'},
						{value: 3, duration: 100, easing: 'linear'},
						{value: -3, duration: 100, easing: 'linear'},
						{value: 3, duration: 100, easing: 'linear'},
						{value: -3, duration: 100, easing: 'linear'},
						{value: 3, duration: 100, easing: 'linear'},
						{value: 0, duration: 100, easing: [0.1,1,0.3,1]},
					],
					scale: [
						{value: [0,1.1], duration: 150,easing: [0.1,1,0.3,1]},
						{value: 1.4, duration: 800,easing: 'linear'},
						{value: 1, duration: 150, easing: [0.1,1,0.3,1] },
					],
					opacity: {
						value: 1,
						easing: 'linear',
						duration: 1
					}
				},
				content: {
					duration: 100,
					easing: 'linear',
					opacity: 1
				},
				trigger: {
					duration: 300,
					easing: 'easeOutExpo',
					scale: [1,0.9],
					color: '#6fbb95'
				}
			},
			out: {
				base: {
					duration: 150,
					delay: 50,
					easing: 'easeInQuad',
					scale: 0,
					opacity: {
						delay: 100,
						value: 0,
						easing: 'linear'
					}
				},
				content: {
					duration: 100,
					easing: 'easeInQuad',
					opacity: {
						value: 0,
						easing: 'linear'
					}
				},
				trigger: {
					duration: 300,
					delay: 50,
					easing: 'easeOutExpo',
					scale: 1,
					color: '#666'
				}
			}
		},
		sadoc: {
			in: {
				base: {
					duration: 1,
					delay: 100,
					easing: 'linear',
					opacity: 1,
					translateY: {
						value: [-40,0],
						duration: 800,
						easing: 'easeOutElastic'
					}
				},
				path: {
					duration: 600,
					easing: 'easeInOutSine',
					strokeDashoffset: [anime.setDashoffset, 0],
					fill: {
						duration: 400,
						delay: 500,
						easing: 'linear'
					}
				},
				content: {
					duration: 800,
					delay: 420,
					easing: 'easeOutElastic',
					translateY: [20,0],
					opacity: {
						value: 1,
						easing: 'linear',
						duration: 100
					}
				},
				trigger: {
					translateY: [
						{value: '50%', duration: 100, easing: 'easeInQuad'},
						{value: ['-50%','0%'], duration: 100, easing: 'easeOutQuad'}
					],
					opacity: [
						{value: 0, duration: 100, easing: 'easeInQuad'},
						{value: 1, duration: 100, easing: 'easeOutQuad'}
					],
					color: {
						value: '#6fbb95', 
						duration: 1,
						delay: 100, 
						easing: 'easeOutQuad'
					}
				}
			},
			out: {
				base: {
					duration: 1,
					delay: 400,
					easing: 'linear',
					opacity: 0
				},
				path: {
					duration: 300,
					easing: 'easeInOutSine',
					strokeDashoffset: anime.setDashoffset,
					fill: {
						duration: 400,
						easing: 'linear'
					}
				},
				content: {
					duration: 200,
					easing: 'easeOutExpo',
					translateY: 20,
					opacity: {
						value: 0,
						easing: 'linear',
						duration: 50
					}
				},
				trigger: {
					translateY: [
						{value: '50%', duration: 100, easing: 'easeInQuad'},
						{value: ['-50%','0%'], duration: 100, easing: 'easeOutQuad'}
					],
					opacity: [
						{value: 0, duration: 100, easing: 'easeInQuad'},
						{value: 1, duration: 100, easing: 'easeOutQuad'}
					],
					color: {
						value: '#666', 
						duration: 1, 
						delay: 100, 
						easing: 'easeOutQuad'
					}
				}
			}
		}
	};

	const tooltips = Array.from(document.querySelectorAll('.tooltip'));
	
	class Tooltip {
		constructor(el) {
			this.DOM = {};
			this.DOM.el = el;
			this.type = this.DOM.el.getAttribute('data-type');
			this.DOM.trigger = this.DOM.el.querySelector('.tooltip__trigger');
			this.DOM.triggerSpan = this.DOM.el.querySelector('.tooltip__trigger-text');
			this.DOM.base = this.DOM.el.querySelector('.tooltip__base');
			this.DOM.shape = this.DOM.base.querySelector('.tooltip__shape');
			if( this.DOM.shape ) {
				this.DOM.path = this.DOM.shape.childElementCount > 1 ? Array.from(this.DOM.shape.querySelectorAll('path')) : this.DOM.shape.querySelector('path');
			}
			this.DOM.deco = this.DOM.base.querySelector('.tooltip__deco');
			this.DOM.content = this.DOM.base.querySelector('.tooltip__content');

			this.DOM.letters = this.DOM.content.querySelector('.tooltip__letters');
			if( this.DOM.letters ) {
				// Create spans for each letter.
				charming(this.DOM.letters);
				// Redefine content.
				this.DOM.content = this.DOM.letters.querySelectorAll('span');
			}
			this.initEvents();
		}
		initEvents() {
			this.mouseenterFn = () => {
				this.mouseTimeout = setTimeout(() => {
					this.isShown = true;
					this.show();
				}, 75);
			}
			this.mouseleaveFn = () => {
				clearTimeout(this.mouseTimeout);
				if( this.isShown ) {
					this.isShown = false;
					this.hide();
				}
			}
			this.DOM.trigger.addEventListener('mouseenter', this.mouseenterFn);
			this.DOM.trigger.addEventListener('mouseleave', this.mouseleaveFn);
			this.DOM.trigger.addEventListener('touchstart', this.mouseenterFn);
			this.DOM.trigger.addEventListener('touchend', this.mouseleaveFn);
		}
		show() {
			this.animate('in');
		}
		hide() {
			this.animate('out');
		}
		animate(dir) {
			if ( config[this.type][dir].base ) {
				anime.remove(this.DOM.base);
				let baseAnimOpts = {targets: this.DOM.base};
				anime(Object.assign(baseAnimOpts, config[this.type][dir].base));
			}
			if ( config[this.type][dir].shape ) {
				anime.remove(this.DOM.shape);
				let shapeAnimOpts = {targets: this.DOM.shape};
				anime(Object.assign(shapeAnimOpts, config[this.type][dir].shape));
			}
			if ( config[this.type][dir].path ) {
				anime.remove(this.DOM.path);
				let shapeAnimOpts = {targets: this.DOM.path};
				anime(Object.assign(shapeAnimOpts, config[this.type][dir].path));
			}
			if ( config[this.type][dir].content ) {
				anime.remove(this.DOM.content);
				let contentAnimOpts = {targets: this.DOM.content};
				anime(Object.assign(contentAnimOpts, config[this.type][dir].content));
			}
			if ( config[this.type][dir].trigger ) {
				anime.remove(this.DOM.triggerSpan);
				let triggerAnimOpts = {targets: this.DOM.triggerSpan};
				anime(Object.assign(triggerAnimOpts, config[this.type][dir].trigger));
			}
			if ( config[this.type][dir].deco ) {
				anime.remove(this.DOM.deco);
				let decoAnimOpts = {targets: this.DOM.deco};
				anime(Object.assign(decoAnimOpts, config[this.type][dir].deco));
			}
		}
		destroy() {
			this.DOM.trigger.removeEventListener('mouseenter', this.mouseenterFn);
			this.DOM.trigger.removeEventListener('mouseleave', this.mouseleaveFn);
			this.DOM.trigger.removeEventListener('touchstart', this.mouseenterFn);
			this.DOM.trigger.removeEventListener('touchend', this.mouseleaveFn);
		}
	}

	const init = (() => tooltips.forEach(t => new Tooltip(t)))();
};
