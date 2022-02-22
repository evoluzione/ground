"use strict";
(self["webpackChunkground"] = self["webpackChunkground"] || []).push([["ground-animationComparison"],{

/***/ "./js/animations/animationComparison.js":
/*!**********************************************!*\
  !*** ./js/animations/animationComparison.js ***!
  \**********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ AnimationComparison; }
/* harmony export */ });
/* harmony import */ var _animationDefault__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./animationDefault */ "./js/animations/animationDefault.js");
/* harmony import */ var deepmerge__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! deepmerge */ "./node_modules/deepmerge/dist/cjs.js");
/* harmony import */ var deepmerge__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(deepmerge__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _utilities_observer__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../utilities/observer */ "./js/utilities/observer.js");
/* harmony import */ var gsap__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! gsap */ "./node_modules/gsap/index.js");
/* harmony import */ var gsap_all__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! gsap/all */ "./node_modules/gsap/ScrollTrigger.js");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } Object.defineProperty(subClass, "prototype", { value: Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }), writable: false }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } else if (call !== void 0) { throw new TypeError("Derived constructors may only return object or undefined"); } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

/* eslint-disable no-unused-vars */





gsap__WEBPACK_IMPORTED_MODULE_3__.gsap.registerPlugin(gsap_all__WEBPACK_IMPORTED_MODULE_4__.ScrollTrigger);

var AnimationComparison = /*#__PURE__*/function (_AnimationDefault) {
  _inherits(AnimationComparison, _AnimationDefault);

  var _super = _createSuper(AnimationComparison);

  function AnimationComparison(element, options) {
    var _this;

    _classCallCheck(this, AnimationComparison);

    _this = _super.call(this, element, options);
    _this.element = element || '[data-scroll="js-comparison"]';
    ;
    return _this;
  }

  _createClass(AnimationComparison, [{
    key: "fireAnimation",
    value: function fireAnimation(item) {
      var target = item.querySelector('[data-scroll-target]');
      var targetMedia = item.querySelectorAll('[data-scroll-target-media]');
      var targetImage = item.querySelectorAll('[data-scroll-target-media] img');
      var targetScrub = parseInt(item.dataset.scrollScrub, 10);
      var tl = gsap__WEBPACK_IMPORTED_MODULE_3__.gsap.timeline({
        scrollTrigger: {
          trigger: target,
          start: 'center center',
          end: function end() {
            return "+=".concat(target.offsetWidth);
          },
          scrub: targetScrub || false,
          pin: true
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
}(_animationDefault__WEBPACK_IMPORTED_MODULE_0__["default"]);



/***/ }),

/***/ "./js/animations/animationDefault.js":
/*!*******************************************!*\
  !*** ./js/animations/animationDefault.js ***!
  \*******************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ AnimationDefault; }
/* harmony export */ });
/* harmony import */ var deepmerge__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! deepmerge */ "./node_modules/deepmerge/dist/cjs.js");
/* harmony import */ var deepmerge__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(deepmerge__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var gsap__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! gsap */ "./node_modules/gsap/index.js");
/* harmony import */ var gsap_all__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! gsap/all */ "./node_modules/gsap/ScrollTrigger.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

/* eslint-disable no-unused-vars */
// import { initObserver } from '../utilities/observer';
// import { getTemplateUrl } from '../utilities/paths';



gsap__WEBPACK_IMPORTED_MODULE_1__.gsap.registerPlugin(gsap_all__WEBPACK_IMPORTED_MODULE_2__.ScrollTrigger);

var AnimationDefault = /*#__PURE__*/function () {
  /**
   * @param {string} element - Selector
   * @param {Object} options - User options
   */
  function AnimationDefault(element, options) {
    _classCallCheck(this, AnimationDefault);

    this.element = element;
    this.defaults = {
      triggers: this.element
    };
    this.DOM = {
      html: document.documentElement,
      body: document.body
    };
    this.options = options ? deepmerge__WEBPACK_IMPORTED_MODULE_0___default()(this.defaults, options) : this.defaults; // this.updateEvents = this.updateEvents.bind(this);
    // window.addEventListener('DOMContentLoaded', () => {});
    // ScrollTrigger.addEventListener('scrollStart', () => {});
    // ScrollTrigger.addEventListener('scrollEnd', () => {});
    // ScrollTrigger.addEventListener('refreshInit', () => {});
    // ScrollTrigger.addEventListener('refresh', () => {});
    // window.addEventListener('NAVIGATE_OUT', () => {
    // 	// ScrollTrigger.update();
    // 	// ScrollTrigger.refresh();
    // });
    // window.addEventListener('resize', () => {
    // 	// ScrollTrigger.update();
    // 	// ScrollTrigger.refresh();
    // });
    // window.addEventListener('NAVIGATE_IN', () => {});
    // window.addEventListener('NAVIGATE_END', () => {});
    //  window.addEventListener('LOADER_COMPLETE', () => {

    this.init();
    this.initEvents(this.options.triggers); // initObserver(this.options.triggers, this.updateEvents);
    //  });
  }
  /**
   * Init
   */


  _createClass(AnimationDefault, [{
    key: "init",
    value: function init() {
      this.DOM.element = this.element;
    }
    /**
     * Initialize events
     * @param {string} triggers - Selectors
     */

  }, {
    key: "initEvents",
    value: function initEvents(triggers) {
      this.fireAnimation(triggers); // gsap.utils.toArray(triggers).forEach((element) => {
      // 	if (element.dataset.scroll === 'js-split-text') {
      // 	}  else {
      // 		this.animationDefault(target);
      // 	}
      // });
    }
    /**
     * Update events
     * @param {Object} target - New selector
     */

  }, {
    key: "updateEvents",
    value: function updateEvents(target) {
      var _this = this;

      this.init();
      setTimeout(function () {
        _this.fireAnimation(target);
      }, 1000);
    }
    /**
     * Fire the animation
     * @param {node} item
     */

  }, {
    key: "fireAnimation",
    value: function fireAnimation(item) {
      var targetClass = item.dataset.scroll;
      gsap_all__WEBPACK_IMPORTED_MODULE_2__.ScrollTrigger.create({
        trigger: item,
        start: 'top 100%',
        toggleClass: targetClass,
        toggleActions: 'play none none none',
        once: true // markers: true,

      });
    }
  }]);

  return AnimationDefault;
}();



/***/ })

}]);
//# sourceMappingURL=ground-animationComparison.bundle.js.map