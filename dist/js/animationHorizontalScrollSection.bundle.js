"use strict";(self.webpackChunkground=self.webpackChunkground||[]).push([[122,488],{952:function(t,e,r){r.r(e),r.d(e,{default:function(){return a}});var n=r(9996),o=r.n(n),i=r(6358),c=r(7082);function u(t,e){for(var r=0;r<e.length;r++){var n=e[r];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(t,n.key,n)}}i.p8.registerPlugin(c.i);var a=function(){function t(e,r){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),this.element=e,this.defaults={triggers:this.element},this.DOM={html:document.documentElement,body:document.body},this.options=r?o()(this.defaults,r):this.defaults,this.init(),this.initEvents(this.options.triggers)}var e,r;return e=t,(r=[{key:"init",value:function(){this.DOM.element=this.element}},{key:"initEvents",value:function(t){this.fireAnimation(t)}},{key:"updateEvents",value:function(t){var e=this;this.init(),setTimeout((function(){e.fireAnimation(t)}),1e3)}},{key:"fireAnimation",value:function(t){var e=t.dataset.scroll;c.i.create({trigger:t,start:"top 100%",toggleClass:e,toggleActions:"play none none none"})}}])&&u(e.prototype,r),Object.defineProperty(e,"prototype",{writable:!1}),t}()},2473:function(t,e,r){r.r(e),r.d(e,{default:function(){return s}});var n=r(952),o=r(6358),i=r(7082);function c(t){return(c="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function u(t,e){for(var r=0;r<e.length;r++){var n=e[r];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(t,n.key,n)}}function a(t,e){return(a=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function f(t,e){if(e&&("object"===c(e)||"function"==typeof e))return e;if(void 0!==e)throw new TypeError("Derived constructors may only return object or undefined");return function(t){if(void 0===t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return t}(t)}function l(t){return(l=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}o.p8.registerPlugin(i.i);var s=function(t){!function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");Object.defineProperty(t,"prototype",{value:Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),writable:!1}),e&&a(t,e)}(y,t);var e,r,n,c,s=(n=y,c=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],(function(){}))),!0}catch(t){return!1}}(),function(){var t,e=l(n);if(c){var r=l(this).constructor;t=Reflect.construct(e,arguments,r)}else t=e.apply(this,arguments);return f(this,t)});function y(t,e){var r;return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,y),(r=s.call(this,t,e)).element=t||'[data-scroll="js-horizontal-scroll-section"]',r}return e=y,(r=[{key:"fireAnimation",value:function(t){var e=t.querySelector("[data-scroll-target]"),r=t.querySelectorAll("[data-scroll-section]"),n=parseInt(t.dataset.scrollScrub,10),c=o.p8.utils.toArray(r),u=0,a=function(){u=0,c.forEach((function(t){u+=t.offsetWidth}))};a(),i.i.addEventListener("refreshInit",a),o.p8.to(c,{x:function(){return"-".concat(u-window.innerWidth)},ease:"none",scrollTrigger:{trigger:e,pin:!0,scrub:n||!1,start:"center center",end:function(){return"+=".concat(u)},invalidateOnRefresh:!0}}),c.forEach((function(t,e){i.i.create({trigger:t,start:function(){return"top top-="+(t.offsetLeft-window.innerWidth/2)*(u/(u-window.innerWidth))},end:function(){return"+="+t.offsetWidth*(u/(u-window.innerWidth))},toggleClass:{targets:t,className:"active"}})}))}}])&&u(e.prototype,r),Object.defineProperty(e,"prototype",{writable:!1}),y}(n.default)},9996:function(t){var e=function(t){return function(t){return!!t&&"object"==typeof t}(t)&&!function(t){var e=Object.prototype.toString.call(t);return"[object RegExp]"===e||"[object Date]"===e||function(t){return t.$$typeof===r}(t)}(t)},r="function"==typeof Symbol&&Symbol.for?Symbol.for("react.element"):60103;function n(t,e){return!1!==e.clone&&e.isMergeableObject(t)?u((r=t,Array.isArray(r)?[]:{}),t,e):t;var r}function o(t,e,r){return t.concat(e).map((function(t){return n(t,r)}))}function i(t){return Object.keys(t).concat(function(t){return Object.getOwnPropertySymbols?Object.getOwnPropertySymbols(t).filter((function(e){return t.propertyIsEnumerable(e)})):[]}(t))}function c(t,e){try{return e in t}catch(t){return!1}}function u(t,r,a){(a=a||{}).arrayMerge=a.arrayMerge||o,a.isMergeableObject=a.isMergeableObject||e,a.cloneUnlessOtherwiseSpecified=n;var f=Array.isArray(r);return f===Array.isArray(t)?f?a.arrayMerge(t,r,a):function(t,e,r){var o={};return r.isMergeableObject(t)&&i(t).forEach((function(e){o[e]=n(t[e],r)})),i(e).forEach((function(i){(function(t,e){return c(t,e)&&!(Object.hasOwnProperty.call(t,e)&&Object.propertyIsEnumerable.call(t,e))})(t,i)||(c(t,i)&&r.isMergeableObject(e[i])?o[i]=function(t,e){if(!e.customMerge)return u;var r=e.customMerge(t);return"function"==typeof r?r:u}(i,r)(t[i],e[i],r):o[i]=n(e[i],r))})),o}(t,r,a):n(r,a)}u.all=function(t,e){if(!Array.isArray(t))throw new Error("first argument should be an array");return t.reduce((function(t,r){return u(t,r,e)}),{})};var a=u;t.exports=a}}]);
//# sourceMappingURL=animationHorizontalScrollSection.bundle.js.map