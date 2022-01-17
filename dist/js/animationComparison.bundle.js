"use strict";
(self["webpackChunkground"] = self["webpackChunkground"] || []).push([["animationComparison"],{

/***/ "./js/animations/animationComparison.js":
/*!**********************************************!*\
  !*** ./js/animations/animationComparison.js ***!
  \**********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ AnimationComparison; }
/* harmony export */ });
/* harmony import */ var deepmerge__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! deepmerge */ "./node_modules/deepmerge/dist/cjs.js");
/* harmony import */ var deepmerge__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(deepmerge__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _utilities_observer__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../utilities/observer */ "./js/utilities/observer.js");
/* harmony import */ var gsap__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! gsap */ "./node_modules/gsap/index.js");
/* harmony import */ var gsap_all__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! gsap/all */ "./node_modules/gsap/ScrollTrigger.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

/* eslint-disable no-unused-vars */




gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.registerPlugin(gsap_all__WEBPACK_IMPORTED_MODULE_3__.ScrollTrigger);

var AnimationComparison = /*#__PURE__*/function () {
  /**
   * @param {string} element - Selector
   * @param {Object} options - User options
   */
  function AnimationComparison(element, options) {
    _classCallCheck(this, AnimationComparison);

    this.element = element || '[data-scroll="js-comparison"]';
    ;
    this.defaults = {
      triggers: this.element
    };
    this.DOM = {
      html: document.documentElement,
      body: document.body
    };
    this.options = options ? deepmerge__WEBPACK_IMPORTED_MODULE_0___default()(this.defaults, options) : this.defaults;
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
    (0,_utilities_observer__WEBPACK_IMPORTED_MODULE_1__.initObserver)(this.options.triggers, this.updateEvents); // });
  }
  /**
   * Init
   */


  _createClass(AnimationComparison, [{
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

      // TODO: js pin non funziona
      gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.utils.toArray(triggers).forEach(function (element) {
        if (element.dataset.scroll === 'js-comparison') {
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

      this.init();
      setTimeout(function () {
        if (target.dataset.scroll === 'js-comparison') {
          _this2.animationComparison(target);
        } else if (target.dataset.scroll === 'js-parallax') {
          _this2.animationParallax(target);
        } else if (target.dataset.scroll === 'js-video') {
          _this2.animationVideo(target);
        } else {
          // TODO: individuare il trigger
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

  return AnimationComparison;
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
//# sourceMappingURL=animationComparison.bundle.js.map