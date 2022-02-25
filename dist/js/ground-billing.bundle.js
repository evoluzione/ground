/*! For license information please see ground-billing.bundle.js.LICENSE.txt */
(self.webpackChunkground=self.webpackChunkground||[]).push([[251],{1856:function(e,t,i){"use strict";i.r(t),i.d(t,{default:function(){return s}});var n=i(7564),o=i.n(n);function r(e,t){for(var i=0;i<t.length;i++){var n=t[i];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}var s=function(){function e(){var t=this;!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.DOM={html:document.documentElement,body:document.body,element:document.querySelector(".woocommerce-cart"),billingMethod:document.querySelector("#billing_customer_type")},o()(this.DOM.body,{background:!0},(function(){t.init()}))}var t,i;return t=e,(i=[{key:"init",value:function(){var e=this,t=document.getElementById("billing_invoice");t&&(!0===t.checked?this.toggleBillingField(this.DOM.billingMethod.value,!0):this.toggleBillingField("",!1),t.addEventListener("input",(function(t){!0===t.target.checked?e.toggleBillingField(e.DOM.billingMethod.value,!0):e.toggleBillingField(e.DOM.billingMethod.value,!1)})),this.DOM.billingMethod.addEventListener("change",(function(){e.toggleBillingField(e.DOM.billingMethod.value,!0)})))}},{key:"toggleBillingField",value:function(e,t){t?(document.querySelector("#billing_customer_type_field").style.display="inherit",document.querySelector("#billing_company_field").style.display="inherit",document.querySelector("#billing_vat_field").style.display="inherit",document.querySelector("#billing_fiscal_code_field").style.display="inherit",document.querySelector("#billing_pec_field").style.display="inherit",document.querySelector("#billing_sdi_field").style.display="inherit","privato"===e&&(document.querySelector("#billing_company_field").style.display="none",document.querySelector("#billing_vat_field").style.display="none",document.querySelector("#billing_pec_field").style.display="none",document.querySelector("#billing_sdi_field").style.display="none")):(document.querySelector("#billing_customer_type_field").style.display="none",document.querySelector("#billing_company_field").style.display="none",document.querySelector("#billing_vat_field").style.display="none",document.querySelector("#billing_fiscal_code_field").style.display="none",document.querySelector("#billing_pec_field").style.display="none",document.querySelector("#billing_sdi_field").style.display="none")}}])&&r(t.prototype,i),Object.defineProperty(t,"prototype",{writable:!1}),e}()},7158:function(e,t,i){var n,o;"undefined"!=typeof window&&window,void 0===(o="function"==typeof(n=function(){"use strict";function e(){}var t=e.prototype;return t.on=function(e,t){if(e&&t){var i=this._events=this._events||{},n=i[e]=i[e]||[];return-1==n.indexOf(t)&&n.push(t),this}},t.once=function(e,t){if(e&&t){this.on(e,t);var i=this._onceEvents=this._onceEvents||{};return(i[e]=i[e]||{})[t]=!0,this}},t.off=function(e,t){var i=this._events&&this._events[e];if(i&&i.length){var n=i.indexOf(t);return-1!=n&&i.splice(n,1),this}},t.emitEvent=function(e,t){var i=this._events&&this._events[e];if(i&&i.length){i=i.slice(0),t=t||[];for(var n=this._onceEvents&&this._onceEvents[e],o=0;o<i.length;o++){var r=i[o];n&&n[r]&&(this.off(e,r),delete n[r]),r.apply(this,t)}return this}},t.allOff=function(){delete this._events,delete this._onceEvents},e})?n.call(t,i,t,e):n)||(e.exports=o)},7564:function(e,t,i){var n,o;!function(r,s){"use strict";n=[i(7158)],void 0===(o=function(e){return function(e,t){var i=e.jQuery,n=e.console;function o(e,t){for(var i in t)e[i]=t[i];return e}var r=Array.prototype.slice;function s(e,t,l){if(!(this instanceof s))return new s(e,t,l);var a,d=e;"string"==typeof e&&(d=document.querySelectorAll(e)),d?(this.elements=(a=d,Array.isArray(a)?a:"object"==typeof a&&"number"==typeof a.length?r.call(a):[a]),this.options=o({},this.options),"function"==typeof t?l=t:o(this.options,t),l&&this.on("always",l),this.getImages(),i&&(this.jqDeferred=new i.Deferred),setTimeout(this.check.bind(this))):n.error("Bad element for imagesLoaded "+(d||e))}s.prototype=Object.create(t.prototype),s.prototype.options={},s.prototype.getImages=function(){this.images=[],this.elements.forEach(this.addElementImages,this)},s.prototype.addElementImages=function(e){"IMG"==e.nodeName&&this.addImage(e),!0===this.options.background&&this.addElementBackgroundImages(e);var t=e.nodeType;if(t&&l[t]){for(var i=e.querySelectorAll("img"),n=0;n<i.length;n++){var o=i[n];this.addImage(o)}if("string"==typeof this.options.background){var r=e.querySelectorAll(this.options.background);for(n=0;n<r.length;n++){var s=r[n];this.addElementBackgroundImages(s)}}}};var l={1:!0,9:!0,11:!0};function a(e){this.img=e}function d(e,t){this.url=e,this.element=t,this.img=new Image}return s.prototype.addElementBackgroundImages=function(e){var t=getComputedStyle(e);if(t)for(var i=/url\((['"])?(.*?)\1\)/gi,n=i.exec(t.backgroundImage);null!==n;){var o=n&&n[2];o&&this.addBackground(o,e),n=i.exec(t.backgroundImage)}},s.prototype.addImage=function(e){var t=new a(e);this.images.push(t)},s.prototype.addBackground=function(e,t){var i=new d(e,t);this.images.push(i)},s.prototype.check=function(){var e=this;function t(t,i,n){setTimeout((function(){e.progress(t,i,n)}))}this.progressedCount=0,this.hasAnyBroken=!1,this.images.length?this.images.forEach((function(e){e.once("progress",t),e.check()})):this.complete()},s.prototype.progress=function(e,t,i){this.progressedCount++,this.hasAnyBroken=this.hasAnyBroken||!e.isLoaded,this.emitEvent("progress",[this,e,t]),this.jqDeferred&&this.jqDeferred.notify&&this.jqDeferred.notify(this,e),this.progressedCount==this.images.length&&this.complete(),this.options.debug&&n&&n.log("progress: "+i,e,t)},s.prototype.complete=function(){var e=this.hasAnyBroken?"fail":"done";if(this.isComplete=!0,this.emitEvent(e,[this]),this.emitEvent("always",[this]),this.jqDeferred){var t=this.hasAnyBroken?"reject":"resolve";this.jqDeferred[t](this)}},a.prototype=Object.create(t.prototype),a.prototype.check=function(){this.getIsImageComplete()?this.confirm(0!==this.img.naturalWidth,"naturalWidth"):(this.proxyImage=new Image,this.proxyImage.addEventListener("load",this),this.proxyImage.addEventListener("error",this),this.img.addEventListener("load",this),this.img.addEventListener("error",this),this.proxyImage.src=this.img.src)},a.prototype.getIsImageComplete=function(){return this.img.complete&&this.img.naturalWidth},a.prototype.confirm=function(e,t){this.isLoaded=e,this.emitEvent("progress",[this,this.img,t])},a.prototype.handleEvent=function(e){var t="on"+e.type;this[t]&&this[t](e)},a.prototype.onload=function(){this.confirm(!0,"onload"),this.unbindEvents()},a.prototype.onerror=function(){this.confirm(!1,"onerror"),this.unbindEvents()},a.prototype.unbindEvents=function(){this.proxyImage.removeEventListener("load",this),this.proxyImage.removeEventListener("error",this),this.img.removeEventListener("load",this),this.img.removeEventListener("error",this)},d.prototype=Object.create(a.prototype),d.prototype.check=function(){this.img.addEventListener("load",this),this.img.addEventListener("error",this),this.img.src=this.url,this.getIsImageComplete()&&(this.confirm(0!==this.img.naturalWidth,"naturalWidth"),this.unbindEvents())},d.prototype.unbindEvents=function(){this.img.removeEventListener("load",this),this.img.removeEventListener("error",this)},d.prototype.confirm=function(e,t){this.isLoaded=e,this.emitEvent("progress",[this,this.element,t])},s.makeJQueryPlugin=function(t){(t=t||e.jQuery)&&((i=t).fn.imagesLoaded=function(e,t){return new s(this,e,t).jqDeferred.promise(i(this))})},s.makeJQueryPlugin(),s}(r,e)}.apply(t,n))||(e.exports=o)}("undefined"!=typeof window?window:this)}}]);
//# sourceMappingURL=ground-billing.bundle.js.map