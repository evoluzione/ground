"use strict";(self.webpackChunkground=self.webpackChunkground||[]).push([[272,388],{952:function(t,e,n){n.r(e),n.d(e,{default:function(){return a}});var r=n(9996),o=n.n(r),i=n(6358),c=n(7082);function u(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}i.p8.registerPlugin(c.i);var a=function(){function t(e,n){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),this.element=e,this.defaults={triggers:this.element},this.DOM={html:document.documentElement,body:document.body},this.options=n?o()(this.defaults,n):this.defaults,this.init(),this.initEvents(this.options.triggers)}var e,n;return e=t,(n=[{key:"init",value:function(){this.DOM.element=this.element}},{key:"initEvents",value:function(t){this.fireAnimation(t)}},{key:"updateEvents",value:function(t){var e=this;this.init(),setTimeout((function(){e.fireAnimation(t)}),1e3)}},{key:"fireAnimation",value:function(t){var e=t.dataset.scroll;c.i.create({trigger:t,start:"top 100%",toggleClass:e,toggleActions:"play none none none",once:!0})}}])&&u(e.prototype,n),Object.defineProperty(e,"prototype",{writable:!1}),t}()},2473:function(t,e,n){n.r(e),n.d(e,{default:function(){return s}});var r=n(952),o=n(6358),i=n(7082);function c(t){return(c="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function u(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}function a(t,e){return(a=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function f(t,e){if(e&&("object"===c(e)||"function"==typeof e))return e;if(void 0!==e)throw new TypeError("Derived constructors may only return object or undefined");return function(t){if(void 0===t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return t}(t)}function l(t){return(l=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}o.p8.registerPlugin(i.i);var s=function(t){!function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");Object.defineProperty(t,"prototype",{value:Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),writable:!1}),e&&a(t,e)}(p,t);var e,n,r,c,s=(r=p,c=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],(function(){}))),!0}catch(t){return!1}}(),function(){var t,e=l(r);if(c){var n=l(this).constructor;t=Reflect.construct(e,arguments,n)}else t=e.apply(this,arguments);return f(this,t)});function p(t,e){var n;return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,p),(n=s.call(this,t,e)).element=t||'[data-scroll="js-horizontal-scroll-section"]',n}return e=p,(n=[{key:"fireAnimation",value:function(t){var e=t.querySelector("[data-scroll-target]"),n=t.querySelectorAll("[data-scroll-section]"),r=parseInt(t.dataset.scrollScrub,10),c=o.p8.utils.toArray(n),u=0,a=function(){u=0,c.forEach((function(t){u+=t.offsetWidth}))};a(),i.i.addEventListener("refreshInit",a),o.p8.to(c,{x:function(){return"-".concat(u-window.innerWidth)},ease:"none",scrollTrigger:{trigger:e,pin:!0,scrub:r||!1,start:"center center",end:function(){return"+=".concat(u)},invalidateOnRefresh:!0}}),c.forEach((function(t,e){i.i.create({trigger:t,start:function(){return"top top-="+(t.offsetLeft-window.innerWidth/2)*(u/(u-window.innerWidth))},end:function(){return"+="+t.offsetWidth*(u/(u-window.innerWidth))},toggleClass:{targets:t,className:"active"}})}))}}])&&u(e.prototype,n),Object.defineProperty(e,"prototype",{writable:!1}),p}(r.default)}}]);
//# sourceMappingURL=ground-animationHorizontalScrollSection.bundle.js.map