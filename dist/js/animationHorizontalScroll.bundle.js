"use strict";
(self["webpackChunkground"] = self["webpackChunkground"] || []).push([["animationHorizontalScroll"],{

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
        toggleActions: 'play none none none' // markers: true,
        // once: true,

      });
    }
  }]);

  return AnimationDefault;
}();



/***/ }),

/***/ "./js/animations/animationHorizontalScroll.js":
/*!****************************************************!*\
  !*** ./js/animations/animationHorizontalScroll.js ***!
  \****************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ AnimationHorizontalScroll; }
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

var AnimationHorizontalScroll = /*#__PURE__*/function (_AnimationDefault) {
  _inherits(AnimationHorizontalScroll, _AnimationDefault);

  var _super = _createSuper(AnimationHorizontalScroll);

  function AnimationHorizontalScroll(element, options) {
    var _this;

    _classCallCheck(this, AnimationHorizontalScroll);

    _this = _super.call(this, element, options);
    _this.element = element || '[data-scroll="js-horizontal-scroll"]';
    return _this;
  }

  _createClass(AnimationHorizontalScroll, [{
    key: "fireAnimation",
    value: function fireAnimation(item) {
      var target = item.querySelector('[data-scroll-target]');
      var targetContainer = item.querySelector('[data-scroll-target-animate]');
      var targetScrub = parseInt(item.dataset.scrollScrub, 10);
      gsap__WEBPACK_IMPORTED_MODULE_1__.gsap.to(targetContainer, {
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
          scrub: targetScrub || false
        }
      });
    }
  }]);

  return AnimationHorizontalScroll;
}(_animationDefault__WEBPACK_IMPORTED_MODULE_0__["default"]);



/***/ }),

/***/ "./node_modules/deepmerge/dist/cjs.js":
/*!********************************************!*\
  !*** ./node_modules/deepmerge/dist/cjs.js ***!
  \********************************************/
/***/ (function(module) {



var isMergeableObject = function isMergeableObject(value) {
	return isNonNullObject(value)
		&& !isSpecial(value)
};

function isNonNullObject(value) {
	return !!value && typeof value === 'object'
}

function isSpecial(value) {
	var stringValue = Object.prototype.toString.call(value);

	return stringValue === '[object RegExp]'
		|| stringValue === '[object Date]'
		|| isReactElement(value)
}

// see https://github.com/facebook/react/blob/b5ac963fb791d1298e7f396236383bc955f916c1/src/isomorphic/classic/element/ReactElement.js#L21-L25
var canUseSymbol = typeof Symbol === 'function' && Symbol.for;
var REACT_ELEMENT_TYPE = canUseSymbol ? Symbol.for('react.element') : 0xeac7;

function isReactElement(value) {
	return value.$$typeof === REACT_ELEMENT_TYPE
}

function emptyTarget(val) {
	return Array.isArray(val) ? [] : {}
}

function cloneUnlessOtherwiseSpecified(value, options) {
	return (options.clone !== false && options.isMergeableObject(value))
		? deepmerge(emptyTarget(value), value, options)
		: value
}

function defaultArrayMerge(target, source, options) {
	return target.concat(source).map(function(element) {
		return cloneUnlessOtherwiseSpecified(element, options)
	})
}

function getMergeFunction(key, options) {
	if (!options.customMerge) {
		return deepmerge
	}
	var customMerge = options.customMerge(key);
	return typeof customMerge === 'function' ? customMerge : deepmerge
}

function getEnumerableOwnPropertySymbols(target) {
	return Object.getOwnPropertySymbols
		? Object.getOwnPropertySymbols(target).filter(function(symbol) {
			return target.propertyIsEnumerable(symbol)
		})
		: []
}

function getKeys(target) {
	return Object.keys(target).concat(getEnumerableOwnPropertySymbols(target))
}

function propertyIsOnObject(object, property) {
	try {
		return property in object
	} catch(_) {
		return false
	}
}

// Protects from prototype poisoning and unexpected merging up the prototype chain.
function propertyIsUnsafe(target, key) {
	return propertyIsOnObject(target, key) // Properties are safe to merge if they don't exist in the target yet,
		&& !(Object.hasOwnProperty.call(target, key) // unsafe if they exist up the prototype chain,
			&& Object.propertyIsEnumerable.call(target, key)) // and also unsafe if they're nonenumerable.
}

function mergeObject(target, source, options) {
	var destination = {};
	if (options.isMergeableObject(target)) {
		getKeys(target).forEach(function(key) {
			destination[key] = cloneUnlessOtherwiseSpecified(target[key], options);
		});
	}
	getKeys(source).forEach(function(key) {
		if (propertyIsUnsafe(target, key)) {
			return
		}

		if (propertyIsOnObject(target, key) && options.isMergeableObject(source[key])) {
			destination[key] = getMergeFunction(key, options)(target[key], source[key], options);
		} else {
			destination[key] = cloneUnlessOtherwiseSpecified(source[key], options);
		}
	});
	return destination
}

function deepmerge(target, source, options) {
	options = options || {};
	options.arrayMerge = options.arrayMerge || defaultArrayMerge;
	options.isMergeableObject = options.isMergeableObject || isMergeableObject;
	// cloneUnlessOtherwiseSpecified is added to `options` so that custom arrayMerge()
	// implementations can use it. The caller may not replace it.
	options.cloneUnlessOtherwiseSpecified = cloneUnlessOtherwiseSpecified;

	var sourceIsArray = Array.isArray(source);
	var targetIsArray = Array.isArray(target);
	var sourceAndTargetTypesMatch = sourceIsArray === targetIsArray;

	if (!sourceAndTargetTypesMatch) {
		return cloneUnlessOtherwiseSpecified(source, options)
	} else if (sourceIsArray) {
		return options.arrayMerge(target, source, options)
	} else {
		return mergeObject(target, source, options)
	}
}

deepmerge.all = function deepmergeAll(array, options) {
	if (!Array.isArray(array)) {
		throw new Error('first argument should be an array')
	}

	return array.reduce(function(prev, next) {
		return deepmerge(prev, next, options)
	}, {})
};

var deepmerge_1 = deepmerge;

module.exports = deepmerge_1;


/***/ })

}]);
//# sourceMappingURL=animationHorizontalScroll.bundle.js.map