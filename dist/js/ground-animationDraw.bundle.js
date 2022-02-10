"use strict";(self.webpackChunkground=self.webpackChunkground||[]).push([[587,388],{952:function(t,e,r){r.r(e),r.d(e,{default:function(){return u}});var n=r(9996),o=r.n(n),i=r(6358),a=r(7082);function s(t,e){for(var r=0;r<e.length;r++){var n=e[r];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(t,n.key,n)}}i.p8.registerPlugin(a.i);var u=function(){function t(e,r){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),this.element=e,this.defaults={triggers:this.element},this.DOM={html:document.documentElement,body:document.body},this.options=r?o()(this.defaults,r):this.defaults,this.init(),this.initEvents(this.options.triggers)}var e,r;return e=t,(r=[{key:"init",value:function(){this.DOM.element=this.element}},{key:"initEvents",value:function(t){this.fireAnimation(t)}},{key:"updateEvents",value:function(t){var e=this;this.init(),setTimeout((function(){e.fireAnimation(t)}),1e3)}},{key:"fireAnimation",value:function(t){var e=t.dataset.scroll;a.i.create({trigger:t,start:"top 100%",toggleClass:e,toggleActions:"play none none none"})}}])&&s(e.prototype,r),Object.defineProperty(e,"prototype",{writable:!1}),t}()},4451:function(t,e,r){r.r(e),r.d(e,{default:function(){return D}});var n,o,i,a,s,u=r(952),c=r(6358),f=function(){return"undefined"!=typeof window},l=function(){return n||f()&&(n=window.gsap)&&n.registerPlugin&&n},h=/[-+=\.]*\d+[\.e\-\+]*\d*[e\-\+]*\d*/gi,y={rect:["width","height"],circle:["r","r"],ellipse:["rx","ry"],line:["x2","y2"]},p=function(t){return Math.round(1e4*t)/1e4},d=function(t){return parseFloat(t)||0},g=function(t,e){var r=d(t);return~t.indexOf("%")?r/100*e:r},b=function(t,e){return d(t.getAttribute(e))},m=Math.sqrt,v=function(t,e,r,n,o,i){return m(Math.pow((d(r)-d(t))*o,2)+Math.pow((d(n)-d(e))*i,2))},w=function(t){return console.warn(t)},_=function(t){return"non-scaling-stroke"===t.getAttribute("vector-effect")},O=function(t){if(!(t=o(t)[0]))return 0;var e,r,n,i,a,s,u,c=t.tagName.toLowerCase(),f=t.style,l=1,p=1;_(t)&&(p=t.getScreenCTM(),l=m(p.a*p.a+p.b*p.b),p=m(p.d*p.d+p.c*p.c));try{r=t.getBBox()}catch(t){w("Some browsers won't measure invisible elements (like display:none or masks inside defs).")}var d=r||{x:0,y:0,width:0,height:0},g=d.x,O=d.y,j=d.width,k=d.height;if(r&&(j||k)||!y[c]||(j=b(t,y[c][0]),k=b(t,y[c][1]),"rect"!==c&&"line"!==c&&(j*=2,k*=2),"line"===c&&(g=b(t,"x1"),O=b(t,"y1"),j=Math.abs(j-g),k=Math.abs(k-O))),"path"===c)i=f.strokeDasharray,f.strokeDasharray="none",e=t.getTotalLength()||0,l!==p&&w("Warning: <path> length cannot be measured when vector-effect is non-scaling-stroke and the element isn't proportionally scaled."),e*=(l+p)/2,f.strokeDasharray=i;else if("rect"===c)e=2*j*l+2*k*p;else if("line"===c)e=v(g,O,g+j,O+k,l,p);else if("polyline"===c||"polygon"===c)for(n=t.getAttribute("points").match(h)||[],"polygon"===c&&n.push(n[0],n[1]),e=0,a=2;a<n.length;a+=2)e+=v(n[a-2],n[a-1],n[a],n[a+1],l,p)||0;else"circle"!==c&&"ellipse"!==c||(s=j/2*l,u=k/2*p,e=Math.PI*(3*(s+u)-m((3*s+u)*(s+3*u))));return e||0},j=function(t,e){if(!(t=o(t)[0]))return[0,0];e||(e=O(t)+1);var r=i.getComputedStyle(t),n=r.strokeDasharray||"",a=d(r.strokeDashoffset),s=n.indexOf(",");return s<0&&(s=n.indexOf(" ")),(n=s<0?e:d(n.substr(0,s)))>e&&(n=e),[-a||0,n-a||0]},k=function(){f()&&(document,i=window,s=n=l(),o=n.utils.toArray,a=-1!==((i.navigator||{}).userAgent||"").indexOf("Edge"))},P={version:"3.9.1",name:"drawSVG",register:function(t){n=t,k()},init:function(t,e,r,n,o){if(!t.getBBox)return!1;s||k();var u,c,f,l=O(t);return this._style=t.style,this._target=t,e+""=="true"?e="0 100%":e?-1===(e+"").indexOf(" ")&&(e="0 "+e):e="0 0",c=function(t,e,r){var n,o,i=t.indexOf(" ");return i<0?(n=void 0!==r?r+"":t,o=t):(n=t.substr(0,i),o=t.substr(i+1)),(n=g(n,e))>(o=g(o,e))?[o,n]:[n,o]}(e,l,(u=j(t,l))[0]),this._length=p(l),this._dash=p(u[1]-u[0]),this._offset=p(-u[0]),this._dashPT=this.add(this,"_dash",this._dash,p(c[1]-c[0])),this._offsetPT=this.add(this,"_offset",this._offset,p(-c[0])),a&&(f=i.getComputedStyle(t)).strokeLinecap!==f.strokeLinejoin&&(c=d(f.strokeMiterlimit),this.add(t.style,"strokeMiterlimit",c,c+.01)),this._live=_(t)||~(e+"").indexOf("live"),this._nowrap=~(e+"").indexOf("nowrap"),this._props.push("drawSVG"),1},render:function(t,e){var r,n,o,i,a=e._pt,s=e._style;if(a){for(e._live&&(r=O(e._target))!==e._length&&(n=r/e._length,e._length=r,e._offsetPT&&(e._offsetPT.s*=n,e._offsetPT.c*=n),e._dashPT?(e._dashPT.s*=n,e._dashPT.c*=n):e._dash*=n);a;)a.r(t,a.d),a=a._next;o=e._dash||t&&1!==t&&1e-4||0,r=e._length-o+.1,i=e._offset,o&&i&&o+Math.abs(i%e._length)>e._length-.2&&(i+=i<0?.1:-.1)&&(r+=.1),s.strokeDashoffset=o?i:i+.001,s.strokeDasharray=r<.2?"none":o?o+"px,"+(e._nowrap?999999:r)+"px":"0px, 999999px"}},getLength:O,getPosition:j};l()&&n.registerPlugin(P);var x=r(7082);function M(t){return(M="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function S(t,e){for(var r=0;r<e.length;r++){var n=e[r];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(t,n.key,n)}}function A(t,e){return(A=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function E(t,e){if(e&&("object"===M(e)||"function"==typeof e))return e;if(void 0!==e)throw new TypeError("Derived constructors may only return object or undefined");return function(t){if(void 0===t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return t}(t)}function T(t){return(T=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}c.p8.registerPlugin(x.i,P);var D=function(t){!function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");Object.defineProperty(t,"prototype",{value:Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),writable:!1}),e&&A(t,e)}(a,t);var e,r,n,o,i=(n=a,o=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],(function(){}))),!0}catch(t){return!1}}(),function(){var t,e=T(n);if(o){var r=T(this).constructor;t=Reflect.construct(e,arguments,r)}else t=e.apply(this,arguments);return E(this,t)});function a(t,e){var r;return function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,a),(r=i.call(this,t,e)).element=t||'[data-scroll="js-draw"]',r}return e=a,(r=[{key:"fireAnimation",value:function(t){var e=t.querySelectorAll("path"),r=parseInt(t.dataset.scrollScrub,10);c.p8.timeline({scrollTrigger:{trigger:t,scrub:r||!1,toggleActions:"play none none none"}}).from(e,{drawSVG:0})}}])&&S(e.prototype,r),Object.defineProperty(e,"prototype",{writable:!1}),a}(u.default)},9996:function(t){var e=function(t){return function(t){return!!t&&"object"==typeof t}(t)&&!function(t){var e=Object.prototype.toString.call(t);return"[object RegExp]"===e||"[object Date]"===e||function(t){return t.$$typeof===r}(t)}(t)},r="function"==typeof Symbol&&Symbol.for?Symbol.for("react.element"):60103;function n(t,e){return!1!==e.clone&&e.isMergeableObject(t)?s((r=t,Array.isArray(r)?[]:{}),t,e):t;var r}function o(t,e,r){return t.concat(e).map((function(t){return n(t,r)}))}function i(t){return Object.keys(t).concat(function(t){return Object.getOwnPropertySymbols?Object.getOwnPropertySymbols(t).filter((function(e){return t.propertyIsEnumerable(e)})):[]}(t))}function a(t,e){try{return e in t}catch(t){return!1}}function s(t,r,u){(u=u||{}).arrayMerge=u.arrayMerge||o,u.isMergeableObject=u.isMergeableObject||e,u.cloneUnlessOtherwiseSpecified=n;var c=Array.isArray(r);return c===Array.isArray(t)?c?u.arrayMerge(t,r,u):function(t,e,r){var o={};return r.isMergeableObject(t)&&i(t).forEach((function(e){o[e]=n(t[e],r)})),i(e).forEach((function(i){(function(t,e){return a(t,e)&&!(Object.hasOwnProperty.call(t,e)&&Object.propertyIsEnumerable.call(t,e))})(t,i)||(a(t,i)&&r.isMergeableObject(e[i])?o[i]=function(t,e){if(!e.customMerge)return s;var r=e.customMerge(t);return"function"==typeof r?r:s}(i,r)(t[i],e[i],r):o[i]=n(e[i],r))})),o}(t,r,u):n(r,u)}s.all=function(t,e){if(!Array.isArray(t))throw new Error("first argument should be an array");return t.reduce((function(t,r){return s(t,r,e)}),{})};var u=s;t.exports=u}}]);
//# sourceMappingURL=ground-animationDraw.bundle.js.map