"use strict";(self.webpackChunkground=self.webpackChunkground||[]).push([[976],{3349:function(t,e,n){n.r(e),n.d(e,{default:function(){return f}});var r=n(274),i=n(9996),o=n.n(i),a=n(6358),u=n(5826),l=n(7859);function c(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}a.p8.registerPlugin(l.B,u._);var f=function(){function t(e,n){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),this.element=e||"[data-flip]",this.defaults={triggers:this.element},this.DOM={html:document.documentElement,body:document.body},this.options=n?o()(this.defaults,n):this.defaults,this.updateEvents=this.updateEvents.bind(this),this.init(),this.initEvents(this.options.triggers),(0,r.g)(this.options.triggers,this.updateEvents)}var e,n;return e=t,(n=[{key:"init",value:function(){this.DOM.element=document.querySelectorAll(this.element)}},{key:"initEvents",value:function(t){var e=this;a.p8.utils.toArray(t).forEach((function(t){e.defaultAnimation(t)}))}},{key:"updateEvents",value:function(t){this.init(),this.defaultAnimation(element)}},{key:"defaultAnimation",value:function(t){var e=t.querySelector("[data-flip-from]"),n=t.querySelector("[data-flip-to]"),r=t.querySelector("[data-flip-item]"),i=t.querySelector("[data-flip-trigger]");u._.create(e),u._.create(n),i.addEventListener("click",(function(){var t=l.B.getState(r);r.classList.toggle("active"),r.parentElement===e?n.appendChild(r):e.appendChild(r),l.B.from(t,{duration:.6,scale:!0,absolute:!0,ease:"power3.inOut"})}))}}])&&c(e.prototype,n),Object.defineProperty(e,"prototype",{writable:!1}),t}()},274:function(t,e,n){function r(t,e){var n="undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"];if(!n){if(Array.isArray(t)||(n=i(t))||e&&t&&"number"==typeof t.length){n&&(t=n);var r=0,o=function(){};return{s:o,n:function(){return r>=t.length?{done:!0}:{done:!1,value:t[r++]}},e:function(t){throw t},f:o}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var a,u=!0,l=!1;return{s:function(){n=n.call(t)},n:function(){var t=n.next();return u=t.done,t},e:function(t){l=!0,a=t},f:function(){try{u||null==n.return||n.return()}finally{if(l)throw a}}}}function i(t,e){if(t){if("string"==typeof t)return o(t,e);var n=Object.prototype.toString.call(t).slice(8,-1);return"Object"===n&&t.constructor&&(n=t.constructor.name),"Map"===n||"Set"===n?Array.from(t):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?o(t,e):void 0}}function o(t,e){(null==e||e>t.length)&&(e=t.length);for(var n=0,r=new Array(e);n<e;n++)r[n]=t[n];return r}function a(t,e){new MutationObserver((function(n){(function(t,e){var n,a,u=new Set,l=r(e);try{for(l.s();!(n=l.n()).done;){var c,f=r(n.value.addedNodes);try{for(f.s();!(c=f.n()).done;){var s=c.value;if(1===s.nodeType){s.matches(t)&&u.add(s);var d,y=r(s.querySelectorAll(t));try{for(y.s();!(d=y.n()).done;){var h=d.value;u.add(h)}}catch(t){y.e(t)}finally{y.f()}}}}catch(t){f.e(t)}finally{f.f()}}}catch(t){l.e(t)}finally{l.f()}return function(t){if(Array.isArray(t))return o(t)}(a=u)||function(t){if("undefined"!=typeof Symbol&&null!=t[Symbol.iterator]||null!=t["@@iterator"])return Array.from(t)}(a)||i(a)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()})(t,n).forEach((function(t){e(t)}))})).observe(document.documentElement,{childList:!0,attributes:!1,characterData:!1,subtree:!0})}n.d(e,{g:function(){return a}})}}]);
//# sourceMappingURL=ground-animationFlip.bundle.js.map