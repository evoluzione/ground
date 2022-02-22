"use strict";
(self["webpackChunkground"] = self["webpackChunkground"] || []).push([["ground-animationHorizontalScrollSection"],{

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



/***/ }),

/***/ "./js/animations/animationHorizontalScrollSection.js":
/*!***********************************************************!*\
  !*** ./js/animations/animationHorizontalScrollSection.js ***!
  \***********************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ AnimationHorizontalScrollSection; }
/* harmony export */ });
/* harmony import */ var _animationDefault__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./animationDefault */ "./js/animations/animationDefault.js");
/* harmony import */ var gsap__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! gsap */ "./node_modules/gsap/index.js");
/* harmony import */ var gsap_all__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! gsap/all */ "./node_modules/gsap/ScrollTrigger.js");
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



gsap__WEBPACK_IMPORTED_MODULE_1__.gsap.registerPlugin(gsap_all__WEBPACK_IMPORTED_MODULE_2__.ScrollTrigger);

var AnimationHorizontalScrollSection = /*#__PURE__*/function (_AnimationDefault) {
  _inherits(AnimationHorizontalScrollSection, _AnimationDefault);

  var _super = _createSuper(AnimationHorizontalScrollSection);

  function AnimationHorizontalScrollSection(element, options) {
    var _this;

    _classCallCheck(this, AnimationHorizontalScrollSection);

    _this = _super.call(this, element, options);
    _this.element = element || '[data-scroll="js-horizontal-scroll-section"]';
    return _this;
  }

  _createClass(AnimationHorizontalScrollSection, [{
    key: "fireAnimation",
    value: function fireAnimation(item) {
      var target = item.querySelector('[data-scroll-target]');
      var section = item.querySelectorAll('[data-scroll-section]');
      var targetScrub = parseInt(item.dataset.scrollScrub, 10);
      var sections = gsap__WEBPACK_IMPORTED_MODULE_1__.gsap.utils.toArray(section);
      var maxWidth = 0;

      var getMaxWidth = function getMaxWidth() {
        maxWidth = 0;
        sections.forEach(function (section) {
          maxWidth += section.offsetWidth;
        });
      };

      getMaxWidth();
      gsap_all__WEBPACK_IMPORTED_MODULE_2__.ScrollTrigger.addEventListener('refreshInit', getMaxWidth);
      gsap__WEBPACK_IMPORTED_MODULE_1__.gsap.to(sections, {
        x: function x() {
          return "-".concat(maxWidth - window.innerWidth);
        },
        ease: 'none',
        scrollTrigger: {
          trigger: target,
          pin: true,
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
        gsap_all__WEBPACK_IMPORTED_MODULE_2__.ScrollTrigger.create({
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
  }]);

  return AnimationHorizontalScrollSection;
}(_animationDefault__WEBPACK_IMPORTED_MODULE_0__["default"]);



/***/ })

}]);
//# sourceMappingURL=ground-animationHorizontalScrollSection.bundle.js.map