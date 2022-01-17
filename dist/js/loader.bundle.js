/*! For license information please see loader.bundle.js.LICENSE.txt */
(self.webpackChunkground=self.webpackChunkground||[]).push([[716],{991:function(t,e,n){"use strict";n.r(e),n.d(e,{default:function(){return u}});var r=n(630),i=n(747),o=n(564),s=n.n(o),a=n(996),h=n.n(a);function c(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}var u=function(){function t(e){var n=this;!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),this.defaults={animation:!1},this.DOM={html:document.documentElement,body:document.body},this.options=e?h()(this.defaults,e):this.defaults,s()(this.DOM.body,{background:!0},(function(){n.init()}))}var e,n;return e=t,(n=[{key:"init",value:function(){this.DOM.html.classList.remove("has-no-js"),this.DOM.html.classList.add("has-js","is-loaded"),this.DOM.html.classList.remove("is-loading"),this.DOM.html.classList.add("is-loaded"),(0,r.Z)().any&&this.DOM.html.classList.add("is-mobile"),this.onLoaderComplete()}},{key:"onLoaderComplete",value:function(){var t,e;this.DOM.html.classList.add("is-loader-complete"),jQuery("#js-loader").fadeOut(),t="LOADER_COMPLETE",e=new window.CustomEvent(t,{detail:undefined}),window.dispatchEvent(e),i.f&&console.log("🚀 Triggered:",t)}}])&&c(e.prototype,n),Object.defineProperty(e,"prototype",{writable:!1}),t}()},747:function(t,e,n){"use strict";n.d(e,{f:function(){return r}});var r=!1},996:function(t){"use strict";var e=function(t){return function(t){return!!t&&"object"==typeof t}(t)&&!function(t){var e=Object.prototype.toString.call(t);return"[object RegExp]"===e||"[object Date]"===e||function(t){return t.$$typeof===n}(t)}(t)},n="function"==typeof Symbol&&Symbol.for?Symbol.for("react.element"):60103;function r(t,e){return!1!==e.clone&&e.isMergeableObject(t)?a((n=t,Array.isArray(n)?[]:{}),t,e):t;var n}function i(t,e,n){return t.concat(e).map((function(t){return r(t,n)}))}function o(t){return Object.keys(t).concat(function(t){return Object.getOwnPropertySymbols?Object.getOwnPropertySymbols(t).filter((function(e){return t.propertyIsEnumerable(e)})):[]}(t))}function s(t,e){try{return e in t}catch(t){return!1}}function a(t,n,h){(h=h||{}).arrayMerge=h.arrayMerge||i,h.isMergeableObject=h.isMergeableObject||e,h.cloneUnlessOtherwiseSpecified=r;var c=Array.isArray(n);return c===Array.isArray(t)?c?h.arrayMerge(t,n,h):function(t,e,n){var i={};return n.isMergeableObject(t)&&o(t).forEach((function(e){i[e]=r(t[e],n)})),o(e).forEach((function(o){(function(t,e){return s(t,e)&&!(Object.hasOwnProperty.call(t,e)&&Object.propertyIsEnumerable.call(t,e))})(t,o)||(s(t,o)&&n.isMergeableObject(e[o])?i[o]=function(t,e){if(!e.customMerge)return a;var n=e.customMerge(t);return"function"==typeof n?n:a}(o,n)(t[o],e[o],n):i[o]=r(e[o],n))})),i}(t,n,h):r(n,h)}a.all=function(t,e){if(!Array.isArray(t))throw new Error("first argument should be an array");return t.reduce((function(t,n){return a(t,n,e)}),{})};var h=a;t.exports=h},158:function(t,e,n){var r,i;"undefined"!=typeof window&&window,void 0===(i="function"==typeof(r=function(){"use strict";function t(){}var e=t.prototype;return e.on=function(t,e){if(t&&e){var n=this._events=this._events||{},r=n[t]=n[t]||[];return-1==r.indexOf(e)&&r.push(e),this}},e.once=function(t,e){if(t&&e){this.on(t,e);var n=this._onceEvents=this._onceEvents||{};return(n[t]=n[t]||{})[e]=!0,this}},e.off=function(t,e){var n=this._events&&this._events[t];if(n&&n.length){var r=n.indexOf(e);return-1!=r&&n.splice(r,1),this}},e.emitEvent=function(t,e){var n=this._events&&this._events[t];if(n&&n.length){n=n.slice(0),e=e||[];for(var r=this._onceEvents&&this._onceEvents[t],i=0;i<n.length;i++){var o=n[i];r&&r[o]&&(this.off(t,o),delete r[o]),o.apply(this,e)}return this}},e.allOff=function(){delete this._events,delete this._onceEvents},t})?r.call(e,n,e,t):r)||(t.exports=i)},564:function(t,e,n){var r,i;!function(o,s){"use strict";r=[n(158)],void 0===(i=function(t){return function(t,e){var n=t.jQuery,r=t.console;function i(t,e){for(var n in e)t[n]=e[n];return t}var o=Array.prototype.slice;function s(t,e,a){if(!(this instanceof s))return new s(t,e,a);var h,c=t;"string"==typeof t&&(c=document.querySelectorAll(t)),c?(this.elements=(h=c,Array.isArray(h)?h:"object"==typeof h&&"number"==typeof h.length?o.call(h):[h]),this.options=i({},this.options),"function"==typeof e?a=e:i(this.options,e),a&&this.on("always",a),this.getImages(),n&&(this.jqDeferred=new n.Deferred),setTimeout(this.check.bind(this))):r.error("Bad element for imagesLoaded "+(c||t))}s.prototype=Object.create(e.prototype),s.prototype.options={},s.prototype.getImages=function(){this.images=[],this.elements.forEach(this.addElementImages,this)},s.prototype.addElementImages=function(t){"IMG"==t.nodeName&&this.addImage(t),!0===this.options.background&&this.addElementBackgroundImages(t);var e=t.nodeType;if(e&&a[e]){for(var n=t.querySelectorAll("img"),r=0;r<n.length;r++){var i=n[r];this.addImage(i)}if("string"==typeof this.options.background){var o=t.querySelectorAll(this.options.background);for(r=0;r<o.length;r++){var s=o[r];this.addElementBackgroundImages(s)}}}};var a={1:!0,9:!0,11:!0};function h(t){this.img=t}function c(t,e){this.url=t,this.element=e,this.img=new Image}return s.prototype.addElementBackgroundImages=function(t){var e=getComputedStyle(t);if(e)for(var n=/url\((['"])?(.*?)\1\)/gi,r=n.exec(e.backgroundImage);null!==r;){var i=r&&r[2];i&&this.addBackground(i,t),r=n.exec(e.backgroundImage)}},s.prototype.addImage=function(t){var e=new h(t);this.images.push(e)},s.prototype.addBackground=function(t,e){var n=new c(t,e);this.images.push(n)},s.prototype.check=function(){var t=this;function e(e,n,r){setTimeout((function(){t.progress(e,n,r)}))}this.progressedCount=0,this.hasAnyBroken=!1,this.images.length?this.images.forEach((function(t){t.once("progress",e),t.check()})):this.complete()},s.prototype.progress=function(t,e,n){this.progressedCount++,this.hasAnyBroken=this.hasAnyBroken||!t.isLoaded,this.emitEvent("progress",[this,t,e]),this.jqDeferred&&this.jqDeferred.notify&&this.jqDeferred.notify(this,t),this.progressedCount==this.images.length&&this.complete(),this.options.debug&&r&&r.log("progress: "+n,t,e)},s.prototype.complete=function(){var t=this.hasAnyBroken?"fail":"done";if(this.isComplete=!0,this.emitEvent(t,[this]),this.emitEvent("always",[this]),this.jqDeferred){var e=this.hasAnyBroken?"reject":"resolve";this.jqDeferred[e](this)}},h.prototype=Object.create(e.prototype),h.prototype.check=function(){this.getIsImageComplete()?this.confirm(0!==this.img.naturalWidth,"naturalWidth"):(this.proxyImage=new Image,this.proxyImage.addEventListener("load",this),this.proxyImage.addEventListener("error",this),this.img.addEventListener("load",this),this.img.addEventListener("error",this),this.proxyImage.src=this.img.src)},h.prototype.getIsImageComplete=function(){return this.img.complete&&this.img.naturalWidth},h.prototype.confirm=function(t,e){this.isLoaded=t,this.emitEvent("progress",[this,this.img,e])},h.prototype.handleEvent=function(t){var e="on"+t.type;this[e]&&this[e](t)},h.prototype.onload=function(){this.confirm(!0,"onload"),this.unbindEvents()},h.prototype.onerror=function(){this.confirm(!1,"onerror"),this.unbindEvents()},h.prototype.unbindEvents=function(){this.proxyImage.removeEventListener("load",this),this.proxyImage.removeEventListener("error",this),this.img.removeEventListener("load",this),this.img.removeEventListener("error",this)},c.prototype=Object.create(h.prototype),c.prototype.check=function(){this.img.addEventListener("load",this),this.img.addEventListener("error",this),this.img.src=this.url,this.getIsImageComplete()&&(this.confirm(0!==this.img.naturalWidth,"naturalWidth"),this.unbindEvents())},c.prototype.unbindEvents=function(){this.img.removeEventListener("load",this),this.img.removeEventListener("error",this)},c.prototype.confirm=function(t,e){this.isLoaded=t,this.emitEvent("progress",[this,this.element,e])},s.makeJQueryPlugin=function(e){(e=e||t.jQuery)&&((n=e).fn.imagesLoaded=function(t,e){return new s(this,t,e).jqDeferred.promise(n(this))})},s.makeJQueryPlugin(),s}(o,t)}.apply(e,r))||(t.exports=i)}("undefined"!=typeof window?window:this)}}]);
//# sourceMappingURL=loader.bundle.js.map