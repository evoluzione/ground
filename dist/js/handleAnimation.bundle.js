"use strict";(self.webpackChunkground=self.webpackChunkground||[]).push([[130],{7777:function(t,n,i){i.r(n),i.d(n,{default:function(){return s}});var e=i(274),o=i(6358);function a(t,n){for(var i=0;i<n.length;i++){var e=n[i];e.enumerable=e.enumerable||!1,e.configurable=!0,"value"in e&&(e.writable=!0),Object.defineProperty(t,e.key,e)}}function r(t,n,i){return n in t?Object.defineProperty(t,n,{value:i,enumerable:!0,configurable:!0,writable:!0}):t[n]=i,t}var s=function(){function t(){!function(t,n){if(!(t instanceof n))throw new TypeError("Cannot call a class as a function")}(this,t),r(this,"AnimationSplitText",void 0),r(this,"AnimationRotation",void 0),r(this,"AnimationPin",void 0),r(this,"AnimationComparison",void 0),r(this,"AnimationDefault",void 0),r(this,"AnimationBatch",void 0),r(this,"AnimationScale",void 0),r(this,"AnimationDraw",void 0),r(this,"AnimationBgColor",void 0),r(this,"AnimationSpriteImages",void 0),r(this,"AnimationHorizontalScroll",void 0),r(this,"AnimationHorizontalScrollContainer",void 0),r(this,"AnimationHorizontalScrollSection",void 0),r(this,"AnimationParallax",void 0),r(this,"AnimationVideo",void 0),r(this,"animationToActivate",[]),r(this,"promiseList",[]),r(this,"hasCssAnimation",!1),r(this,"triggers","[data-scroll]"),this.initEvents()}var n,s;return n=t,(s=[{key:"initEvents",value:function(){this.getAnimationToActivate(this.triggers),this.populatePromiseList(),this.resolveAllPromise(this.triggers),(0,e.g)("[data-scroll]",this.updateEvents)}},{key:"getAnimationToActivate",value:function(t){var n=this;o.p8.utils.toArray(t).forEach((function(t){var i=t.dataset.scroll;n.animationToActivate.includes(i)||(n.hasCssAnimation||"js"===i.substring(0,2)||(n.hasCssAnimation=!0),n.animationToActivate.push(i))}))}},{key:"populatePromiseList",value:function(){var t=this;if(this.animationToActivate.includes("js-split-text")){var n=Promise.all([i.e(82),i.e(99)]).then(i.bind(i,7143)).then((function(n){return t.AnimationSplitText=n.default,n.default.name})).catch((function(t){return console.log(t)}));this.promiseList.push(n)}if(this.animationToActivate.includes("js-rotation")){var e=Promise.all([i.e(82),i.e(70)]).then(i.bind(i,7968)).then((function(n){return t.AnimationRotation=n.default,n.default.name})).catch((function(t){return console.log(t)}));this.promiseList.push(e)}if(this.animationToActivate.includes("js-pin")){var o=Promise.all([i.e(82),i.e(486)]).then(i.bind(i,2030)).then((function(n){return t.AnimationPin=n.default,n.default.name})).catch((function(t){return console.log(t)}));this.promiseList.push(o)}if(this.animationToActivate.includes("js-comparison")){var a=Promise.all([i.e(82),i.e(794)]).then(i.bind(i,1437)).then((function(n){return t.AnimationComparison=n.default,n.default.name})).catch((function(t){return console.log(t)}));this.promiseList.push(a)}if(this.animationToActivate.includes("js-batch")){var r=Promise.all([i.e(82),i.e(364)]).then(i.bind(i,7934)).then((function(n){return t.AnimationBatch=n.default,n.default.name})).catch((function(t){return console.log(t)}));this.promiseList.push(r)}if(this.animationToActivate.includes("js-scale")){var s=Promise.all([i.e(82),i.e(469)]).then(i.bind(i,9119)).then((function(n){return t.AnimationScale=n.default,n.default.name})).catch((function(t){return console.log(t)}));this.promiseList.push(s)}if(this.animationToActivate.includes("js-draw")){var l=Promise.all([i.e(82),i.e(298)]).then(i.bind(i,4451)).then((function(n){return t.AnimationDraw=n.default,n.default.name})).catch((function(t){return console.log(t)}));this.promiseList.push(l)}if(this.animationToActivate.includes("js-bg-color")){var c=Promise.all([i.e(82),i.e(951)]).then(i.bind(i,6572)).then((function(n){return t.AnimationBgColor=n.default,n.default.name})).catch((function(t){return console.log(t)}));this.promiseList.push(c)}if(this.animationToActivate.includes("js-sprite-images")){var u=Promise.all([i.e(82),i.e(650)]).then(i.bind(i,3857)).then((function(n){return t.AnimationSpriteImages=n.default,n.default.name})).catch((function(t){return console.log(t)}));this.promiseList.push(u)}if(this.animationToActivate.includes("js-horizontal-scroll")){var h=Promise.all([i.e(82),i.e(300)]).then(i.bind(i,5577)).then((function(n){return t.AnimationHorizontalScroll=n.default,n.default.name})).catch((function(t){return console.log(t)}));this.promiseList.push(h)}if(this.animationToActivate.includes("js-horizontal-scroll-container")){var f=Promise.all([i.e(82),i.e(0)]).then(i.bind(i,989)).then((function(n){return t.AnimationHorizontalScrollContainer=n.default,n.default.name})).catch((function(t){return console.log(t)}));this.promiseList.push(f)}if(this.animationToActivate.includes("js-horizontal-scroll-section")){var m=Promise.all([i.e(82),i.e(122)]).then(i.bind(i,2473)).then((function(n){return t.AnimationHorizontalScrollSection=n.default,n.default.name})).catch((function(t){return console.log(t)}));this.promiseList.push(m)}if(this.animationToActivate.includes("js-parallax")){var d=Promise.all([i.e(82),i.e(292)]).then(i.bind(i,8369)).then((function(n){return t.AnimationParallax=n.default,n.default.name})).catch((function(t){return console.log(t)}));this.promiseList.push(d)}if(this.animationToActivate.includes("js-video")){var v=Promise.all([i.e(82),i.e(273)]).then(i.bind(i,8496)).then((function(n){return t.AnimationVideo=n.default,n.default.name})).catch((function(t){return console.log(t)}));this.promiseList.push(v)}if(this.hasCssAnimation){var A=Promise.all([i.e(82),i.e(488)]).then(i.bind(i,952)).then((function(n){return t.AnimationDefault=n.default,n.default.name})).catch((function(t){return console.log(t)}));this.promiseList.push(A)}}},{key:"resolveAllPromise",value:function(t){var n=this;Promise.all(this.promiseList).then((function(i){n.fireAnimations(t)}))}},{key:"fireAnimations",value:function(t){var n=this;o.p8.utils.toArray(t).forEach((function(t){n.getAnimation(t)}))}},{key:"getAnimation",value:function(t){switch(t.dataset.scroll){case"js-split-text":new this.AnimationSplitText(t);break;case"js-rotation":new this.AnimationRotation(t);break;case"js-batch":new this.AnimationBatch(t);break;case"js-scale":new this.AnimationScale(t);break;case"js-draw":new this.AnimationDraw(t);break;case"js-bg-color":new this.AnimationBgColor(t);break;case"js-pin":new this.AnimationPin(t);break;case"js-sprite-images":new this.AnimationSpriteImages(t);break;case"js-horizontal-scroll":new this.AnimationHorizontalScroll(t);break;case"js-horizontal-scroll-container":new this.AnimationHorizontalScrollContainer(t);break;case"js-horizontal-scroll-section":new this.AnimationHorizontalScrollSection(t);break;case"js-comparison":new this.AnimationComparison(t);break;case"js-parallax":new this.AnimationParallax(t);break;case"js-video":new this.AnimationVideo(t);break;default:new this.AnimationDefault(t)}}}])&&a(n.prototype,s),Object.defineProperty(n,"prototype",{writable:!1}),t}()},274:function(t,n,i){function e(t,n){var i="undefined"!=typeof Symbol&&t[Symbol.iterator]||t["@@iterator"];if(!i){if(Array.isArray(t)||(i=o(t))||n&&t&&"number"==typeof t.length){i&&(t=i);var e=0,a=function(){};return{s:a,n:function(){return e>=t.length?{done:!0}:{done:!1,value:t[e++]}},e:function(t){throw t},f:a}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var r,s=!0,l=!1;return{s:function(){i=i.call(t)},n:function(){var t=i.next();return s=t.done,t},e:function(t){l=!0,r=t},f:function(){try{s||null==i.return||i.return()}finally{if(l)throw r}}}}function o(t,n){if(t){if("string"==typeof t)return a(t,n);var i=Object.prototype.toString.call(t).slice(8,-1);return"Object"===i&&t.constructor&&(i=t.constructor.name),"Map"===i||"Set"===i?Array.from(t):"Arguments"===i||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(i)?a(t,n):void 0}}function a(t,n){(null==n||n>t.length)&&(n=t.length);for(var i=0,e=new Array(n);i<n;i++)e[i]=t[i];return e}function r(t,n){new MutationObserver((function(i){(function(t,n){var i,r,s=new Set,l=e(n);try{for(l.s();!(i=l.n()).done;){var c,u=e(i.value.addedNodes);try{for(u.s();!(c=u.n()).done;){var h=c.value;if(1===h.nodeType){h.matches(t)&&s.add(h);var f,m=e(h.querySelectorAll(t));try{for(m.s();!(f=m.n()).done;){var d=f.value;s.add(d)}}catch(t){m.e(t)}finally{m.f()}}}}catch(t){u.e(t)}finally{u.f()}}}catch(t){l.e(t)}finally{l.f()}return function(t){if(Array.isArray(t))return a(t)}(r=s)||function(t){if("undefined"!=typeof Symbol&&null!=t[Symbol.iterator]||null!=t["@@iterator"])return Array.from(t)}(r)||o(r)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()})(t,i).forEach((function(t){n(t)}))})).observe(document.documentElement,{childList:!0,attributes:!1,characterData:!1,subtree:!0})}i.d(n,{g:function(){return r}})}}]);
//# sourceMappingURL=handleAnimation.bundle.js.map