"use strict";(self.webpackChunkground=self.webpackChunkground||[]).push([[487,388],{952:function(t,e,n){n.r(e),n.d(e,{default:function(){return u}});var r=n(9996),o=n.n(r),i=n(6358),a=n(7082);function c(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}i.p8.registerPlugin(a.i);var u=function(){function t(e,n){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),this.element=e,this.defaults={triggers:this.element},this.DOM={html:document.documentElement,body:document.body},this.options=n?o()(this.defaults,n):this.defaults,this.init(),this.initEvents(this.options.triggers)}var e,n;return e=t,(n=[{key:"init",value:function(){this.DOM.element=this.element}},{key:"initEvents",value:function(t){this.fireAnimation(t)}},{key:"updateEvents",value:function(t){var e=this;this.init(),setTimeout((function(){e.fireAnimation(t)}),1e3)}},{key:"fireAnimation",value:function(t){var e=t.dataset.scroll;a.i.create({trigger:t,start:"top 100%",toggleClass:e,toggleActions:"play none none none"})}}])&&c(e.prototype,n),Object.defineProperty(e,"prototype",{writable:!1}),t}()},3857:function(t,e,n){n.r(e),n.d(e,{default:function(){return s}});var r=n(952),o=n(6358),i=n(7082);function a(t){return(a="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function c(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}function u(t,e){return(u=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function l(t,e){if(e&&("object"===a(e)||"function"==typeof e))return e;if(void 0!==e)throw new TypeError("Derived constructors may only return object or undefined");return function(t){if(void 0===t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return t}(t)}function f(t){return(f=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}o.p8.registerPlugin(i.i);var s=function(t){!function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");Object.defineProperty(t,"prototype",{value:Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),writable:!1}),e&&u(t,e)}(s,t);var e,n,r,i,a=(r=s,i=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],(function(){}))),!0}catch(t){return!1}}(),function(){var t,e=f(r);if(i){var n=f(this).constructor;t=Reflect.construct(e,arguments,n)}else t=e.apply(this,arguments);return l(this,t)});function s(t,e){var n;return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,s),(n=a.call(this,t,e)).element=t||'[data-scroll="js-sprite-images"]',n}return e=s,(n=[{key:"fireAnimation",value:function(t){var e=t.querySelector("[data-scroll-target]"),n=t.querySelector("[data-scroll-canvas]"),r=t.querySelector("[data-scroll-target-animate]"),i=n.getContext("2d"),a=parseInt(t.dataset.scrollFrames,10),c=t.dataset.scrollPath;n.width=900,n.height=859;for(var u,l=[],f={frame:0},s=0;s<a;s++){var p=new Image;p.src=(u=s,"".concat(c,"/").concat((u+1).toString().padStart(4,"0"),".jpg")),l.push(p)}function y(){i.clearRect(0,0,n.width,n.height),i.drawImage(l[f.frame],0,0)}o.p8.timeline({scrollTrigger:{trigger:e,start:"center center",end:"+=400%",scrub:.5,pin:!0}}).to(f,{frame:a-1,snap:"frame",onUpdate:y,duration:20},"together").fromTo(r,{scale:.95},{scale:1,duration:20},"together"),l[0].onload=y}}])&&c(e.prototype,n),Object.defineProperty(e,"prototype",{writable:!1}),s}(r.default)}}]);
//# sourceMappingURL=ground-animationSpriteImages.bundle.js.map