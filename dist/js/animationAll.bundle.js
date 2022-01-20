"use strict";
(self["webpackChunkground"] = self["webpackChunkground"] || []).push([["animationAll"],{

/***/ "./js/animations/animationAll.js":
/*!***************************************!*\
  !*** ./js/animations/animationAll.js ***!
  \***************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ AnimationsAll; }
/* harmony export */ });
/* harmony import */ var _utilities_observer__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utilities/observer */ "./js/utilities/observer.js");
/* harmony import */ var deepmerge__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! deepmerge */ "./node_modules/deepmerge/dist/cjs.js");
/* harmony import */ var deepmerge__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(deepmerge__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var gsap__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! gsap */ "./node_modules/gsap/index.js");
/* harmony import */ var gsap_all__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! gsap/all */ "./node_modules/gsap/ScrollTrigger.js");
/* harmony import */ var gsap_all__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! gsap/all */ "./node_modules/gsap/SplitText.js");
/* harmony import */ var gsap_all__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! gsap/all */ "./node_modules/gsap/DrawSVGPlugin.js");
/* harmony import */ var gsap_all__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! gsap/all */ "./node_modules/gsap/MorphSVGPlugin.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

/* eslint-disable no-unused-vars */
 // import { getTemplateUrl } from '../utilities/paths';




gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.registerPlugin(gsap_all__WEBPACK_IMPORTED_MODULE_3__.ScrollTrigger, gsap_all__WEBPACK_IMPORTED_MODULE_4__.SplitText, gsap_all__WEBPACK_IMPORTED_MODULE_5__.DrawSVGPlugin, gsap_all__WEBPACK_IMPORTED_MODULE_6__.MorphSVGPlugin);

var AnimationsAll = /*#__PURE__*/function () {
  /**
   * @param {string} element - Selector
   * @param {Object} options - User options
   */
  function AnimationsAll(element, options) {
    _classCallCheck(this, AnimationsAll);

    this.element = element || '[data-scroll]';
    this.defaults = {
      triggers: this.element
    };
    this.DOM = {
      html: document.documentElement,
      body: document.body
    };
    this.options = options ? deepmerge__WEBPACK_IMPORTED_MODULE_1___default()(this.defaults, options) : this.defaults;
    this.updateEvents = this.updateEvents.bind(this);
    window.addEventListener('DOMContentLoaded', function () {});
    gsap_all__WEBPACK_IMPORTED_MODULE_3__.ScrollTrigger.addEventListener('scrollStart', function () {});
    gsap_all__WEBPACK_IMPORTED_MODULE_3__.ScrollTrigger.addEventListener('scrollEnd', function () {});
    gsap_all__WEBPACK_IMPORTED_MODULE_3__.ScrollTrigger.addEventListener('refreshInit', function () {});
    gsap_all__WEBPACK_IMPORTED_MODULE_3__.ScrollTrigger.addEventListener('refresh', function () {});
    window.addEventListener('NAVIGATE_OUT', function () {// ScrollTrigger.update();
      // ScrollTrigger.refresh();
    });
    window.addEventListener('resize', function () {// ScrollTrigger.update();
      // ScrollTrigger.refresh();
    });
    window.addEventListener('NAVIGATE_IN', function () {});
    window.addEventListener('NAVIGATE_END', function () {}); // window.addEventListener('LOADER_COMPLETE', () => {

    this.init();
    this.initEvents(this.options.triggers);
    (0,_utilities_observer__WEBPACK_IMPORTED_MODULE_0__.initObserver)(this.options.triggers, this.updateEvents); // });
  }
  /**
   * Init
   */


  _createClass(AnimationsAll, [{
    key: "init",
    value: function init() {
      this.DOM.element = document.querySelectorAll(this.element);
    }
    /**
     * Initialize events
     * @param {string} triggers - Selectors
     */

  }, {
    key: "initEvents",
    value: function initEvents(triggers) {
      var _this = this;

      // ScrollTrigger.defaults({
      // 	markers: false,
      // 	ease: 'power3',
      // })
      gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.utils.toArray(triggers).forEach(function (element) {
        if (element.dataset.scroll === 'js-split-text') {
          _this.animationSplitText(element);
        } else if (element.dataset.scroll === 'js-rotation') {
          _this.animationRotation(element);
        } else if (element.dataset.scroll === 'js-batch') {
          _this.animationBatch(element);
        } else if (element.dataset.scroll === 'js-scale') {
          _this.animationScale(element);
        } else if (element.dataset.scroll === 'js-draw') {
          _this.animationDraw(element);
        } else if (element.dataset.scroll === 'js-bg-color') {
          _this.animationChangeBgColor(element);
        } else if (element.dataset.scroll === 'js-pin') {
          _this.animationPin(element);
        } else if (element.dataset.scroll === 'js-sprite-images') {
          _this.animationSpriteImages(element);
        } else if (element.dataset.scroll === 'js-horizontal-scroll') {
          _this.animationHorizontalScroll(element);
        } else if (element.dataset.scroll === 'js-horizontal-scroll-container') {
          _this.animationHorizontalScrollContainer(element);
        } else if (element.dataset.scroll === 'js-horizontal-scroll-section') {
          _this.animationHorizontalScrollSection(element);
        } else if (element.dataset.scroll === 'js-comparison') {
          _this.animationComparison(element);
        } else if (element.dataset.scroll === 'js-parallax') {
          _this.animationParallax(element);
        } else if (element.dataset.scroll === 'js-video') {
          _this.animationVideo(element);
        } else {
          _this.animationDefault(element);
        }
      });
    }
    /**
     * Update events
     * @param {Object} target - New selector
     */

  }, {
    key: "updateEvents",
    value: function updateEvents(target) {
      var _this2 = this;

      this.init(); // console.log(target.dataset.scroll);

      setTimeout(function () {
        if (target.dataset.scroll === 'js-split-text') {
          _this2.animationSplitText(target);
        } else if (target.dataset.scroll === 'js-rotation') {
          _this2.animationRotation(target);
        } else if (target.dataset.scroll === 'js-batch') {
          _this2.animationBatch(target);
        } else if (target.dataset.scroll === 'js-scale') {
          _this2.animationScale(target);
        } else if (target.dataset.scroll === 'js-draw') {
          _this2.animationDraw(target);
        } else if (target.dataset.scroll === 'js-bg-color') {
          _this2.animationChangeBgColor(target);
        } else if (target.dataset.scroll === 'js-pin') {
          _this2.animationPin(target);
        } else if (target.dataset.scroll === 'js-sprite-images') {
          _this2.animationSpriteImages(target);
        } else if (target.dataset.scroll === 'js-horizontal-scroll') {
          _this2.animationHorizontalScroll(target);
        } else if (target.dataset.scroll === 'js-horizontal-scroll-container') {
          _this2.animationHorizontalScrollContainer(target);
        } else if (target.dataset.scroll === 'js-horizontal-scroll-section') {
          _this2.animationHorizontalScrollSection(target);
        } else if (target.dataset.scroll === 'js-comparison') {
          _this2.animationComparison(target);
        } else if (target.dataset.scroll === 'js-parallax') {
          _this2.animationParallax(target);
        } else if (target.dataset.scroll === 'js-video') {
          _this2.animationVideo(target);
        } else {
          _this2.animationDefault(target);
        }
      }, 1000);
    }
    /**
     * default Animation
     */

  }, {
    key: "animationDefault",
    value: function animationDefault(item) {
      var targetClass = item.dataset.scroll;
      gsap_all__WEBPACK_IMPORTED_MODULE_3__.ScrollTrigger.create({
        trigger: item,
        start: 'top 100%',
        toggleClass: targetClass,
        toggleActions: 'play none none none' // markers: true,
        // once: true,

      });
    }
    /**
     * splitText Animation
     */

  }, {
    key: "animationSplitText",
    value: function animationSplitText(item) {
      gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.set(item, {
        autoAlpha: 1
      });
      var targetSplitBy = item.dataset.scrollSplittext;
      var targetScrub = parseInt(item.dataset.scrollScrub, 10);
      var tl = gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.timeline({
        scrollTrigger: {
          trigger: item,
          start: 'top 90%',
          end: 'bottom 60%',
          scrub: targetScrub || false,
          // markers: true,
          toggleActions: 'play none play reset'
        }
      });

      if (targetSplitBy === 'chars') {
        var itemSplitted = new gsap_all__WEBPACK_IMPORTED_MODULE_4__.SplitText(item, {
          type: 'chars'
        });
        tl.from(itemSplitted.chars, {
          yPercent: 100,
          opacity: 0,
          stagger: 0.05,
          duration: 0.5,
          ease: 'back.inOut'
        });
      }

      if (targetSplitBy === 'words') {
        var _itemSplitted = new gsap_all__WEBPACK_IMPORTED_MODULE_4__.SplitText(item, {
          type: 'words'
        });

        tl.from(_itemSplitted.words, {
          yPercent: 100,
          opacity: 0,
          stagger: 0.05,
          duration: 0.5,
          ease: 'back.inOut'
        });
      }

      if (targetSplitBy === 'lines') {
        var _itemSplitted2 = new gsap_all__WEBPACK_IMPORTED_MODULE_4__.SplitText(item, {
          type: 'lines'
        });

        tl.from(_itemSplitted2.lines, {
          y: 20,
          opacity: 0,
          stagger: 0.01,
          duration: 0.01,
          ease: 'back.inOut'
        });
      }
    }
    /**
     * rotation Animation
     */

  }, {
    key: "animationRotation",
    value: function animationRotation(item) {
      var targetScrub = parseInt(item.dataset.scrollScrub, 10);
      var tl = gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.timeline({
        scrollTrigger: {
          trigger: item,
          start: 'top 90%',
          end: 'bottom 80%',
          scrub: targetScrub || false,
          toggleActions: 'play none play reverse'
        }
      });
      tl.from(item, {
        x: 400,
        rotation: 360
      });
    }
    /**
     * batch Animation
     */

  }, {
    key: "animationBatch",
    value: function animationBatch(item) {
      var target = item.querySelectorAll('[data-scroll-target]'); // gsap.set(target, { y: 100, opacity: 0 });

      gsap_all__WEBPACK_IMPORTED_MODULE_3__.ScrollTrigger.batch(target, {
        interval: 0.1,
        // time window (in seconds) for batching to occur.
        batchMax: 3,
        // maximum batch size (targets)
        onEnter: function onEnter(batch) {
          return gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.to(batch, {
            autoAlpha: 1,
            stagger: 0.1,
            overwrite: true
          });
        },
        onLeave: function onLeave(batch) {
          return gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.set(batch, {
            autoAlpha: 0,
            overwrite: true
          });
        },
        onEnterBack: function onEnterBack(batch) {
          return gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.to(batch, {
            autoAlpha: 1,
            stagger: 0.1,
            overwrite: true
          });
        },
        onLeaveBack: function onLeaveBack(batch) {
          return gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.set(batch, {
            autoAlpha: 0,
            overwrite: true
          });
        }
      }); // ScrollTrigger.addEventListener('refreshInit', () =>
      // 	gsap.set(target, { y: 0 })
      // )
    }
    /**
     * scale Animation
     */

  }, {
    key: "animationScale",
    value: function animationScale(item) {
      var targetScrub = parseInt(item.dataset.scrollScrub, 10);
      var tl = gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.timeline({
        scrollTrigger: {
          trigger: item,
          start: 'top 100%',
          end: 'bottom 0%',
          scrub: targetScrub || false,
          toggleActions: 'play none play reverse'
        }
      });
      tl.to(item, {
        scale: 1.5
      });
    }
    /**
     * parallax Animation
     */

  }, {
    key: "animationParallax",
    value: function animationParallax(item) {
      var targetScrub = parseInt(item.dataset.scrollScrub, 10);
      var tl = gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.timeline({
        scrollTrigger: {
          trigger: item,
          toggleActions: 'play pause none none',
          scrub: targetScrub || 2
        }
      });
      tl.to(item, {
        y: -item.dataset.scrollSpeedY * 100 || 0,
        x: -item.dataset.scrollSpeedX * 100 || 0
      });
    }
    /**
     * video Animation
     */

  }, {
    key: "animationVideo",
    value: function animationVideo(item) {
      var targetVideo = item.querySelector('[data-scroll-target]');
      gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.timeline({
        scrollTrigger: {
          trigger: item,
          start: 'top bottom',
          end: 'bottom top',
          markers: false,
          onEnter: function onEnter() {
            return targetVideo.play();
          },
          onLeave: function onLeave() {
            targetVideo.pause();
            targetVideo.currentTime = 0;
          },
          onEnterBack: function onEnterBack() {
            return targetVideo.play();
          },
          onLeaveBack: function onLeaveBack() {
            targetVideo.pause();
            targetVideo.currentTime = 0;
          }
        }
      });
    }
    /**
     * darwSvg Animation
     */

  }, {
    key: "animationDraw",
    value: function animationDraw(item) {
      var target = item.querySelectorAll('path');
      var targetScrub = parseInt(item.dataset.scrollScrub, 10);
      var tl = gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.timeline({
        scrollTrigger: {
          trigger: item,
          scrub: targetScrub || false,
          toggleActions: 'play none none none'
        }
      });
      tl.from(target, {
        drawSVG: 0
      });
    }
    /**
     * backgroundColor Animation
     */

  }, {
    key: "animationChangeBgColor",
    value: function animationChangeBgColor(item) {
      var target = document.body;
      var targetColor = item.dataset.scrollBgcolor;
      var tl = gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.timeline({
        scrollTrigger: {
          trigger: item,
          scrub: 1,
          toggleActions: 'play reset play reset'
        }
      });
      tl.to(target, {
        backgroundColor: targetColor,
        ease: 'power1'
      });
    }
    /**
     * pin Animation
     */

  }, {
    key: "animationPin",
    value: function animationPin(item) {
      var target = item.querySelectorAll('[data-scroll-target]');
      var targetElement = item.querySelectorAll('[data-scroll-target-animate]');
      var targetScrub = parseInt(item.dataset.scrollScrub, 10);
      var tl = gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.timeline({
        scrollTrigger: {
          trigger: target,
          start: 'center center',
          // end: '+=200%',
          // toggleClass: 'active',
          scrub: targetScrub || false,
          pin: true,
          pinReparent: true,
          anticipatePin: 1
        }
      });
      tl.from(targetElement, {
        scale: 0.6,
        transformOrigin: 'center center'
      });
    }
    /**
     * pin Image Sequence https://codepen.io/GreenSock/pen/yLOVJxd
     */

  }, {
    key: "animationSpriteImages",
    value: function animationSpriteImages(item) {
      var target = item.querySelector('[data-scroll-target]');
      var canvas = item.querySelector('[data-scroll-canvas]');
      var targetContainer = item.querySelector('[data-scroll-target-animate]');
      var context = canvas.getContext('2d');
      var frameCount = parseInt(item.dataset.scrollFrames, 10);
      var framePath = item.dataset.scrollPath;
      canvas.width = 900;
      canvas.height = 859;

      var currentFrame = function currentFrame(index) {
        return "".concat(framePath, "/").concat((index + 1).toString().padStart(4, '0'), ".jpg");
      }; // `https://www.apple.com/105/media/us/airpods-pro/2019/1299e2f5_9206_4470_b28e_08307a42f19b/anim/sequence/large/01-hero-lightpass/${(index + 1).toString().padStart(4, '0')}.jpg`


      var images = [];
      var frames = {
        frame: 0
      };

      for (var i = 0; i < frameCount; i++) {
        var img = new Image();
        img.src = currentFrame(i);
        images.push(img);
      }

      var tl = gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.timeline({
        scrollTrigger: {
          trigger: target,
          start: 'center center',
          end: '+=400%',
          scrub: 0.5,
          pin: true,
          pinReparent: true,
          anticipatePin: 1
        }
      });
      tl.to(frames, {
        frame: frameCount - 1,
        snap: 'frame',
        onUpdate: render,
        duration: 20
      }, 'together').fromTo(targetContainer, {
        scale: 0.95
      }, {
        scale: 1,
        duration: 20
      }, 'together');
      images[0].onload = render;

      function render() {
        context.clearRect(0, 0, canvas.width, canvas.height);
        context.drawImage(images[frames.frame], 0, 0);
      }
    }
    /**
     * pin Horizontal Animation
     */

  }, {
    key: "animationHorizontalScroll",
    value: function animationHorizontalScroll(item) {
      var target = item.querySelector('[data-scroll-target]');
      var targetContainer = item.querySelector('[data-scroll-target-animate]');
      var targetScrub = parseInt(item.dataset.scrollScrub, 10);
      gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.to(targetContainer, {
        x: function x() {
          return -targetContainer.getBoundingClientRect().width + target.getBoundingClientRect().width;
        },
        ease: 'none',
        scrollTrigger: {
          trigger: target,
          invalidateOnRefresh: true,
          start: 'center center',
          end: function end() {
            return '+=' + targetContainer.offsetWidth;
          },
          pin: true,
          pinReparent: true,
          anticipatePin: 1,
          scrub: targetScrub || false
        }
      });
    }
    /**
     * pin Horizontal Container Animation
     */

  }, {
    key: "animationHorizontalScrollContainer",
    value: function animationHorizontalScrollContainer(item) {
      var target = item.querySelector('[data-scroll-target]');
      var panel = item.querySelectorAll('[data-scroll-panel]');
      var targetScrub = item.dataset.scrollScrub;
      console.log(targetScrub);
      var sections = gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.utils.toArray(panel);
      var scrollTween = gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.to(sections, {
        xPercent: -100 * (sections.length - 1),
        ease: 'none',
        // <-- IMPORTANT!
        scrollTrigger: {
          trigger: target,
          pin: true,
          scrub: targetScrub || false,
          //snap: directionalSnap(1 / (sections.length - 1)),
          end: '+=3000'
        }
      });
      gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.to('.js-box-1', {
        y: -130,
        duration: 2,
        ease: 'elastic',
        scrollTrigger: {
          trigger: '.js-box-1',
          containerAnimation: scrollTween,
          start: 'left center',
          toggleActions: 'play none play reverse' // markers: true,

        }
      });
      gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.to('.js-box-2', {
        y: 320,
        backgroundColor: 'red',
        ease: 'none',
        scrollTrigger: {
          trigger: '.js-box-2',
          containerAnimation: scrollTween,
          start: 'center 80%',
          end: 'center 20%',
          scrub: 2 // markers: true

        }
      });
    }
    /**
     * pin Horizontal Section Animation
     */

  }, {
    key: "animationHorizontalScrollSection",
    value: function animationHorizontalScrollSection(item) {
      var target = item.querySelector('[data-scroll-target]');
      var section = item.querySelectorAll('[data-scroll-section]');
      var targetScrub = parseInt(item.dataset.scrollScrub, 10);
      var sections = gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.utils.toArray(section);
      var maxWidth = 0;

      var getMaxWidth = function getMaxWidth() {
        maxWidth = 0;
        sections.forEach(function (section) {
          maxWidth += section.offsetWidth;
        });
      };

      getMaxWidth();
      gsap_all__WEBPACK_IMPORTED_MODULE_3__.ScrollTrigger.addEventListener('refreshInit', getMaxWidth);
      gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.to(sections, {
        x: function x() {
          return "-".concat(maxWidth - window.innerWidth);
        },
        ease: 'none',
        scrollTrigger: {
          trigger: target,
          pin: true,
          pinReparent: true,
          scrub: targetScrub || false,
          start: 'center center',
          end: function end() {
            return "+=".concat(maxWidth);
          },
          invalidateOnRefresh: true
        }
      }); // ADD SKEW
      // let proxy = { skew: 0 },
      // 	skewSetter = gsap.quickSetter(section, 'skewX', 'deg'), // fast
      // 	clamp = gsap.utils.clamp(-10, 10) // don't let the skew go beyond [X] degrees.
      // END SKEW

      sections.forEach(function (sct, i) {
        gsap_all__WEBPACK_IMPORTED_MODULE_3__.ScrollTrigger.create({
          trigger: sct,
          start: function start() {
            return 'top top-=' + (sct.offsetLeft - window.innerWidth / 2) * (maxWidth / (maxWidth - window.innerWidth));
          },
          end: function end() {
            return '+=' + sct.offsetWidth * (maxWidth / (maxWidth - window.innerWidth));
          },
          toggleClass: {
            targets: sct,
            className: 'active'
          } // ADD SKEW
          // onUpdate: (self) => {
          // 	let skew = clamp(self.getVelocity() / -500)
          // 	// only do something if the skew is MORE severe. Remember, we're always tweening back to 0, so if the user slows their scrolling quickly, it's more natural to just let the tween handle that smoothly rather than jumping to the smaller skew.
          // 	if (Math.abs(skew) > Math.abs(proxy.skew)) {
          // 		proxy.skew = skew
          // 		gsap.to(proxy, {
          // 			skew: 0,
          // 			duration: 0.5,
          // 			ease: 'circ',
          // 			overwrite: true,
          // 			onUpdate: () => skewSetter(proxy.skew),
          // 		})
          // 	}
          // },
          // END SKEW

        });
      }); // SKEW: make the right edge "stick" to the scroll bar. force3D: true improves performance
      // gsap.set(section, { transformOrigin: 'center center', force3D: true })
      // END SKEW
    }
    /**
     * comparison Animation
     */

  }, {
    key: "animationComparison",
    value: function animationComparison(item) {
      var target = item.querySelector('[data-scroll-target]');
      var targetMedia = item.querySelectorAll('[data-scroll-target-media]');
      var targetImage = item.querySelectorAll('[data-scroll-target-media] img');
      var targetScrub = parseInt(item.dataset.scrollScrub, 10);
      var tl = gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.timeline({
        scrollTrigger: {
          trigger: target,
          start: 'center center',
          end: function end() {
            return "+=".concat(target.offsetWidth);
          },
          scrub: targetScrub || false,
          pin: true,
          pinReparent: true,
          anticipatePin: 1
        },
        defaults: {
          ease: 'none'
        }
      });
      tl.fromTo(targetMedia, {
        xPercent: 100,
        x: 0
      }, {
        xPercent: 0
      }).fromTo(targetImage, {
        xPercent: -100,
        x: 0
      }, {
        xPercent: 0
      }, 0);
    }
  }]);

  return AnimationsAll;
}();



/***/ }),

/***/ "./js/utilities/observer.js":
/*!**********************************!*\
  !*** ./js/utilities/observer.js ***!
  \**********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "initObserver": function() { return /* binding */ initObserver; }
/* harmony export */ });
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it.return != null) it.return(); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

/**
 * Observe DOM Node Changes
 * @param {string} triggers - Selectors
 * @param {requestCallback} cb - The callback that handles the response.
 *
 * @see https://stackoverflow.com/questions/56608748/how-to-use-queryselectorall-on-the-added-nodes-in-a-mutationobserver
 */
function initObserver(triggers, callback) {
  var filterSelector = function filterSelector(selector, mutationsList) {
    // We can't create a NodeList; let's use a Set
    var result = new Set(); // Loop through the mutationsList...

    var _iterator = _createForOfIteratorHelper(mutationsList),
        _step;

    try {
      for (_iterator.s(); !(_step = _iterator.n()).done;) {
        var addedNodes = _step.value.addedNodes;

        var _iterator2 = _createForOfIteratorHelper(addedNodes),
            _step2;

        try {
          for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
            var node = _step2.value;

            // console.log(node);
            // If it's an element...
            if (node.nodeType === 1) {
              // Add it if it's a match
              if (node.matches(selector)) {
                result.add(node);
              } // Add any children


              var _iterator3 = _createForOfIteratorHelper(node.querySelectorAll(selector)),
                  _step3;

              try {
                for (_iterator3.s(); !(_step3 = _iterator3.n()).done;) {
                  var entry = _step3.value;
                  result.add(entry);
                }
              } catch (err) {
                _iterator3.e(err);
              } finally {
                _iterator3.f();
              }
            }
          }
        } catch (err) {
          _iterator2.e(err);
        } finally {
          _iterator2.f();
        }
      }
      /* mutationsList.map((e) => e.addedNodes).forEach((n) => {
      		if (n.nodeType === 1) {
      			if (n.matches(selector)) {
      				result.add(n);
      			}
      			// Add any children
      			n.querySelectorAll(selector).forEach((c) => result.add(c));
      		}
      	}); */

    } catch (err) {
      _iterator.e(err);
    } finally {
      _iterator.f();
    }

    return _toConsumableArray(result); // Result is an array, or just return the set
  };

  var observerCallback = function observerCallback(mutationsList) {
    var result = filterSelector(triggers, mutationsList);
    result.forEach(function (element) {
      callback(element);
    });
  };

  var config = {
    childList: true,
    attributes: false,
    characterData: false,
    subtree: true
  };
  var observer = new MutationObserver(observerCallback);
  observer.observe(document.documentElement, config); //observer.disconnect();
}

/***/ })

}]);
//# sourceMappingURL=animationAll.bundle.js.map