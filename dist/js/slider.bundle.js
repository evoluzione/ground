"use strict";(self.webpackChunkground=self.webpackChunkground||[]).push([[309],{241:function(e,i,t){t.r(i),t.d(i,{default:function(){return a}});var n=t(188),s=t(996),l=t.n(s);function r(e,i){for(var t=0;t<i.length;t++){var n=i[t];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}n.tq.use([n.W_,n.tl,n.pt,n.oM,n.xW]);var a=function(){function e(i,t){var n=this;!function(e,i){if(!(e instanceof i))throw new TypeError("Cannot call a class as a function")}(this,e),this.element=i||".js-slider",this.defaults={init:!0,initialSlide:0,direction:"horizontal",speed:1600,loop:!0,effect:"slide",autoHeight:!1,parallax:!1,preloadImages:!0,observer:!0,observeParents:!0,lazy:{loadPrevNext:!0,loadPrevNextAmount:1,loadOnTransitionStart:!0},autoplay:{delay:5e3},pagination:{el:".js-slider-primary-pagination",clickable:!0,type:"bullets"},navigation:{prevEl:".js-slider-primary-navigation-prev",nextEl:".js-slider-primary-navigation-next"},slidesPerView:1,spaceBetween:0,breakpointsInverse:!0},this.options=t?l()(this.defaults,t):this.defaults,this.init(),window.addEventListener("NAVIGATE_END",(function(){n.init()})),window.addEventListener("infiniteScrollAppended",(function(){n.init()}))}var i,t;return i=e,(t=[{key:"init",value:function(){0!==document.querySelectorAll(this.element).length&&(this.slider=new n.tq(this.element,this.options))}},{key:"autoplayStart",value:function(){void 0!==this.slider&&this.slider.autoplay.start()}},{key:"autoplayStop",value:function(){void 0!==this.slider&&this.slider.autoplay.stop()}},{key:"destroy",value:function(e,i){void 0!==this.slider&&this.slider.destroy(e,i)}},{key:"slidePrev",value:function(e,i){void 0!==this.slider&&this.slider.slidePrev(e,i)}},{key:"slideNext",value:function(e,i){void 0!==this.slider&&this.slider.slideNext(e,i)}},{key:"slideTo",value:function(e,i,t){void 0!==this.slider&&this.slider.slideTo(e,i,t)}}])&&r(i.prototype,t),Object.defineProperty(i,"prototype",{writable:!1}),e}()}}]);
//# sourceMappingURL=slider.bundle.js.map