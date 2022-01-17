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
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

/* eslint-disable no-unused-vars */
 // import { getTemplateUrl } from '../utilities/paths';




gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.registerPlugin(gsap_all__WEBPACK_IMPORTED_MODULE_3__.ScrollTrigger);

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
      // TODO: js pin non funziona
      gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.utils.toArray(triggers).forEach(function (element) {// else {
        // 	this.animationDefault(element);
        // }
      });
    }
    /**
     * Update events
     * @param {Object} target - New selector
     */

  }, {
    key: "updateEvents",
    value: function updateEvents(target) {
      this.init();
      setTimeout(function () {// else {
        // 	this.animationDefault(target);
        // }
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