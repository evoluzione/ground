"use strict";(self.webpackChunkground=self.webpackChunkground||[]).push([[464],{458:function(e,t,n){n.r(t),n.d(t,{default:function(){return i}});var s=n(921),a=n(630);function c(e,t){for(var n=0;n<t.length;n++){var s=t[n];s.enumerable=s.enumerable||!1,s.configurable=!0,"value"in s&&(s.writable=!0),Object.defineProperty(e,s.key,s)}}var i=function(){function e(t){var n=this;!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.element=t||"js-ajax-search",this.DOM={html:document.documentElement,body:document.body,element:document.getElementById(this.element),searchMobile:document.getElementById("js-search-mobile"),searchClose:document.getElementById("js-search-close"),searchForm:document.getElementById("js-search-form"),searchDesktop:document.getElementById("js-search-desktop"),searchFormAjax:document.getElementById("js-ajax-search"),searchResult:document.getElementById("js-ajax-search-result"),searchInput:document.getElementById("js-ajax-search-input")},this.adminAjaxUrl="".concat("".concat(window.location.protocol,"//").concat(window.location.host),"/wp-admin/admin-ajax.php"),this.searchLoadingClass="is-search-loading",this.init(),window.addEventListener("resize",(function(){(0,a.Z)().any||(n.DOM.html.classList.remove("is-search-open"),n.DOM.searchForm.classList.remove("is-search-open"),n.init())}))}var t,n;return t=e,(n=[{key:"init",value:function(){var e=this;if(window.matchMedia("(max-width: 1024px)").matches?this.DOM.searchMobile&&this.DOM.searchMobile.append(this.DOM.searchFormAjax):this.DOM.searchDesktop&&this.DOM.searchDesktop.append(this.DOM.searchFormAjax),0!==this.DOM.element.length){var t,n,s,a=(t=function(){e.search()},250,function(){var e=this,a=arguments,c=function(){s=null,t.apply(e,a)},i=n;clearTimeout(s),s=setTimeout(c,250),i&&t.apply(e,a)});this.DOM.searchInput.addEventListener("input",(function(){e.DOM.html.classList.add("is-search-open"),e.DOM.searchForm.classList.add("is-search-open")})),this.DOM.searchInput.addEventListener("input",a),this.DOM.searchClose.addEventListener("click",(function(){e.DOM.searchValue=""}))}}},{key:"search",value:function(){var e=this,t=this.DOM.searchInput.value;this.DOM.searchClose.addEventListener("click",(function(){e.DOM.searchValue=""})),""!==t?(this.beforeSend(),window.fetch(this.adminAjaxUrl,{method:"post",headers:{"content-type":"application/x-www-form-urlencoded; charset=UTF-8"},body:"action=data_fetch&keyword=".concat(t)}).then((function(e){return e.text()})).then((function(t){return e.success(t)})).catch((function(e){s.f&&console.error("🔥Error:",e)}))):this.DOM.searchResult.innerHTML=""}},{key:"beforeSend",value:function(){this.DOM.element.classList.add(this.searchLoadingClass),this.DOM.searchResult.innerHTML=""}},{key:"success",value:function(e){this.DOM.element.classList.remove(this.searchLoadingClass),this.DOM.searchResult.innerHTML=e}}])&&c(t.prototype,n),Object.defineProperty(t,"prototype",{writable:!1}),e}()},921:function(e,t,n){n.d(t,{f:function(){return s}});var s=!1}}]);
//# sourceMappingURL=search.bundle.js.map