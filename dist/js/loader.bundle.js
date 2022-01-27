"use strict";
(self["webpackChunkground"] = self["webpackChunkground"] || []).push([["loader"],{

/***/ "./js/components/loader.js":
/*!*********************************!*\
  !*** ./js/components/loader.js ***!
  \*********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ Loader; }
/* harmony export */ });
/* harmony import */ var ismobilejs__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ismobilejs */ "./node_modules/ismobilejs/esm/index.js");
/* harmony import */ var _utilities_trigger__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../utilities/trigger */ "./js/utilities/trigger.js");
/* harmony import */ var imagesloaded__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! imagesloaded */ "./node_modules/imagesloaded/imagesloaded.js");
/* harmony import */ var imagesloaded__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(imagesloaded__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var deepmerge__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! deepmerge */ "./node_modules/deepmerge/dist/cjs.js");
/* harmony import */ var deepmerge__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(deepmerge__WEBPACK_IMPORTED_MODULE_3__);
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

/**
 * Loader module
 * Initial site loader
 */





var Loader = /*#__PURE__*/function () {
  function Loader(options) {
    var _this = this;

    _classCallCheck(this, Loader);

    this.defaults = {
      animation: false
    };
    this.DOM = {
      html: document.documentElement,
      body: document.body
    };
    this.options = options ? deepmerge__WEBPACK_IMPORTED_MODULE_3___default()(this.defaults, options) : this.defaults;
    imagesloaded__WEBPACK_IMPORTED_MODULE_2___default()(this.DOM.body, {
      background: true
    }, function () {
      _this.init();
    });
  }

  _createClass(Loader, [{
    key: "init",
    value: function init() {
      this.DOM.html.classList.remove('has-no-js');
      this.DOM.html.classList.add('has-js', 'is-loaded'); // Reset Scroll
      // window.scrollTo(0, 0);
      // Update html class

      this.DOM.html.classList.remove('is-loading');
      this.DOM.html.classList.add('is-loaded');

      if ((0,ismobilejs__WEBPACK_IMPORTED_MODULE_0__["default"])().any) {
        this.DOM.html.classList.add('is-mobile');
      }

      this.onLoaderComplete();
    }
  }, {
    key: "onLoaderComplete",
    value: function onLoaderComplete() {
      this.DOM.html.classList.add('is-loader-complete');
      jQuery('#js-loader').fadeOut();
      (0,_utilities_trigger__WEBPACK_IMPORTED_MODULE_1__.trigger)('LOADER_COMPLETE');
    }
  }]);

  return Loader;
}();



/***/ }),

/***/ "./js/utilities/environment.js":
/*!*************************************!*\
  !*** ./js/utilities/environment.js ***!
  \*************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "DEBUG_MODE": function() { return /* binding */ DEBUG_MODE; }
/* harmony export */ });
/**
 * Shared constants
 */
var DEBUG_MODE = false;

/***/ }),

/***/ "./js/utilities/trigger.js":
/*!*********************************!*\
  !*** ./js/utilities/trigger.js ***!
  \*********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "trigger": function() { return /* binding */ trigger; }
/* harmony export */ });
/* harmony import */ var _environment__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./environment */ "./js/utilities/environment.js");
/**
 * Event dispatcher
 */

/**
 * Event trigger
 * @param {DOMString} eventName - Representing the name of the event.
 * @param {*} detail - Additional parameters to pass along to the event handler.
 */

function trigger(eventName, detail) {
  var event = new window.CustomEvent(eventName, {
    detail: detail
  });
  window.dispatchEvent(event);

  if (_environment__WEBPACK_IMPORTED_MODULE_0__.DEBUG_MODE) {
    // eslint-disable-next-line no-console
    console.log('🚀 Triggered:', eventName);
  }
}

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
//# sourceMappingURL=loader.bundle.js.map