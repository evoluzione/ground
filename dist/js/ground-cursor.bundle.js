"use strict";(self.webpackChunkground=self.webpackChunkground||[]).push([[990],{910:function(e,t,r){r.r(t),r.d(t,{default:function(){return a}});var n=r(9996);function o(e,t){for(var r=0;r<t.length;r++){var n=t[r];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}var a=function(){function e(t,r){var o=this;!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.element=t||".js-cursor",this.defaults={triggers:this.element},this.options=r?(0,n.deepmerge)(this.defaults,r):this.defaults,window.addEventListener("load",(function(){o.init()})),this.init()}var t,r;return t=e,(r=[{key:"init",value:function(){var e=document.querySelector(".js-cursor"),t=e.querySelector(".js-cursor-outer"),r={x:-100,y:-100},n={x:0,y:0};window.addEventListener("mousemove",(function(e){r.x=e.clientX,r.y=e.clientY}));requestAnimationFrame((function o(){(function(){var o=Math.round(r.x-n.x),a=Math.round(r.y-n.y);n.x+=.1*o,n.y+=.1*a;var u=function(e,t){return 180*Math.atan2(t,e)/Math.PI}(o,a),i=function(e,t){var r=Math.sqrt(Math.pow(e,2)+Math.pow(t,2));return Math.min(r/1500,.15)}(o,a),c="scale("+(1+i)+", "+(1-i)+")",s="rotate("+u+"deg)",f="translate3d("+n.x+"px ,"+n.y+"px, 0)";e.style.transform=f,t.style.transform=s+c})(),requestAnimationFrame(o)})),document.querySelectorAll("[cursor-class]").forEach((function(t){t.addEventListener("mouseenter",(function(){var t=this.getAttribute("cursor-class");e.classList.add(t)})),t.addEventListener("mouseleave",(function(){var t=this.getAttribute("cursor-class");e.classList.remove(t)}))})),document.querySelectorAll("a, button, input, .js-cursor-hover").forEach((function(t){t.addEventListener("mouseenter",(function(){e.classList.add("hover")})),t.addEventListener("mouseleave",(function(){e.classList.remove("hover")}))}))}}])&&o(t.prototype,r),Object.defineProperty(t,"prototype",{writable:!1}),e}()},9996:function(e){var t=function(e){return function(e){return!!e&&"object"==typeof e}(e)&&!function(e){var t=Object.prototype.toString.call(e);return"[object RegExp]"===t||"[object Date]"===t||function(e){return e.$$typeof===r}(e)}(e)},r="function"==typeof Symbol&&Symbol.for?Symbol.for("react.element"):60103;function n(e,t){return!1!==t.clone&&t.isMergeableObject(e)?i((r=e,Array.isArray(r)?[]:{}),e,t):e;var r}function o(e,t,r){return e.concat(t).map((function(e){return n(e,r)}))}function a(e){return Object.keys(e).concat(function(e){return Object.getOwnPropertySymbols?Object.getOwnPropertySymbols(e).filter((function(t){return e.propertyIsEnumerable(t)})):[]}(e))}function u(e,t){try{return t in e}catch(e){return!1}}function i(e,r,c){(c=c||{}).arrayMerge=c.arrayMerge||o,c.isMergeableObject=c.isMergeableObject||t,c.cloneUnlessOtherwiseSpecified=n;var s=Array.isArray(r);return s===Array.isArray(e)?s?c.arrayMerge(e,r,c):function(e,t,r){var o={};return r.isMergeableObject(e)&&a(e).forEach((function(t){o[t]=n(e[t],r)})),a(t).forEach((function(a){(function(e,t){return u(e,t)&&!(Object.hasOwnProperty.call(e,t)&&Object.propertyIsEnumerable.call(e,t))})(e,a)||(u(e,a)&&r.isMergeableObject(t[a])?o[a]=function(e,t){if(!t.customMerge)return i;var r=t.customMerge(e);return"function"==typeof r?r:i}(a,r)(e[a],t[a],r):o[a]=n(t[a],r))})),o}(e,r,c):n(r,c)}i.all=function(e,t){if(!Array.isArray(e))throw new Error("first argument should be an array");return e.reduce((function(e,r){return i(e,r,t)}),{})};var c=i;e.exports=c}}]);
//# sourceMappingURL=ground-cursor.bundle.js.map