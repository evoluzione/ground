"use strict";(self.webpackChunkground=self.webpackChunkground||[]).push([[488],{952:function(t,e,n){n.r(e),n.d(e,{default:function(){return u}});var i=n(9996),o=n.n(i),r=n(6358),s=n(7082);function a(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}r.p8.registerPlugin(s.i);var u=function(){function t(e,n){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),this.element=e,this.defaults={triggers:this.element},this.DOM={html:document.documentElement,body:document.body},this.options=n?o()(this.defaults,n):this.defaults,this.init(),this.initEvents(this.options.triggers)}var e,n;return e=t,(n=[{key:"init",value:function(){this.DOM.element=this.element}},{key:"initEvents",value:function(t){this.fireAnimation(t)}},{key:"updateEvents",value:function(t){var e=this;this.init(),setTimeout((function(){e.fireAnimation(t)}),1e3)}},{key:"fireAnimation",value:function(t){var e=t.dataset.scroll;s.i.create({trigger:t,start:"top 100%",toggleClass:e,toggleActions:"play none none none"})}}])&&a(e.prototype,n),Object.defineProperty(e,"prototype",{writable:!1}),t}()}}]);
//# sourceMappingURL=animationDefault.bundle.js.map