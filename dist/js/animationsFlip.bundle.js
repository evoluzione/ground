"use strict";
(self["webpackChunkground"] = self["webpackChunkground"] || []).push([["animationsFlip"],{

/***/ "./js/animations/animationFlip.js":
/*!****************************************!*\
  !*** ./js/animations/animationFlip.js ***!
  \****************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ AnimationFlip; }
/* harmony export */ });
/* harmony import */ var _utilities_observer__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utilities/observer */ "./js/utilities/observer.js");
/* harmony import */ var deepmerge__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! deepmerge */ "./node_modules/deepmerge/dist/cjs.js");
/* harmony import */ var deepmerge__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(deepmerge__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var gsap__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! gsap */ "./node_modules/gsap/index.js");
/* harmony import */ var gsap_all__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! gsap/all */ "./node_modules/gsap/Flip.js");
/* harmony import */ var gsap_all__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! gsap/all */ "./node_modules/gsap/Draggable.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }





gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.registerPlugin(gsap_all__WEBPACK_IMPORTED_MODULE_3__.Flip, gsap_all__WEBPACK_IMPORTED_MODULE_4__.Draggable);

var AnimationFlip = /*#__PURE__*/function () {
  /**
   * @param {string} element - Selector
   * @param {Object} options - User options
   */
  function AnimationFlip(element, options) {
    var _this = this;

    _classCallCheck(this, AnimationFlip);

    this.element = element || '[data-flip]';
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
    window.addEventListener('NAVIGATE_OUT', function () {});
    window.addEventListener('NAVIGATE_IN', function () {});
    window.addEventListener('NAVIGATE_END', function () {});

    if (document.readyState !== "loading") {
      this.init();
      this.initEvents(this.options.triggers);
      (0,_utilities_observer__WEBPACK_IMPORTED_MODULE_0__.initObserver)(this.options.triggers, this.updateEvents);
    } else {
      window.addEventListener('LOADER_COMPLETE', function () {
        _this.init();

        _this.initEvents(_this.options.triggers);

        (0,_utilities_observer__WEBPACK_IMPORTED_MODULE_0__.initObserver)(_this.options.triggers, _this.updateEvents);
      });
    }
  }
  /**
   * Init
   */


  _createClass(AnimationFlip, [{
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
      var _this2 = this;

      gsap__WEBPACK_IMPORTED_MODULE_2__.gsap.utils.toArray(triggers).forEach(function (element) {
        _this2.defaultAnimation(element);
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
      this.defaultAnimation(element);
    }
    /**
     * default Animation
     */

  }, {
    key: "defaultAnimation",
    value: function defaultAnimation(item) {
      var flipFrom = item.querySelector('[data-flip-from]');
      var flipTo = item.querySelector('[data-flip-to]');
      var flipItem = item.querySelector('[data-flip-item]');
      var flipTrigger = item.querySelector('[data-flip-trigger]');
      gsap_all__WEBPACK_IMPORTED_MODULE_4__.Draggable.create(flipFrom);
      gsap_all__WEBPACK_IMPORTED_MODULE_4__.Draggable.create(flipTo);
      flipTrigger.addEventListener('click', function () {
        var state = gsap_all__WEBPACK_IMPORTED_MODULE_3__.Flip.getState(flipItem);
        flipItem.classList.toggle('active');

        if (flipItem.parentElement === flipFrom) {
          flipTo.appendChild(flipItem);
        } else {
          flipFrom.appendChild(flipItem);
        }

        gsap_all__WEBPACK_IMPORTED_MODULE_3__.Flip.from(state, {
          duration: 0.6,
          scale: true,
          absolute: true,
          ease: 'power3.inOut'
        });
      });
    }
  }]);

  return AnimationFlip;
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
//# sourceMappingURL=animationsFlip.bundle.js.map