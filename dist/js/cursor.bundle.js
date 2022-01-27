"use strict";
(self["webpackChunkground"] = self["webpackChunkground"] || []).push([["cursor"],{

/***/ "./js/components/cursorV2.js":
/*!***********************************!*\
  !*** ./js/components/cursorV2.js ***!
  \***********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ Cursor; }
/* harmony export */ });
/* harmony import */ var deepmerge__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! deepmerge */ "./node_modules/deepmerge/dist/cjs.js");
/* harmony import */ var deepmerge__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(deepmerge__WEBPACK_IMPORTED_MODULE_0__);
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }



var Cursor = /*#__PURE__*/function () {
  /**
   * @param {string} element - Selector
   * @param {Object} options - User options
   */
  function Cursor(element, options) {
    var _this = this;

    _classCallCheck(this, Cursor);

    this.element = element || '.js-cursor';
    this.defaults = {
      triggers: this.element
    };
    this.options = options ? (0,deepmerge__WEBPACK_IMPORTED_MODULE_0__.deepmerge)(this.defaults, options) : this.defaults;
    window.addEventListener('load', function () {
      _this.init();
    }); // window.addEventListener('DOMContentLoaded', () => {

    this.init(); // });
  }
  /**
   * Init
   */


  _createClass(Cursor, [{
    key: "init",
    value: function init() {
      var cursor = document.querySelector('.js-cursor');
      var cursorCircle = cursor.querySelector('.js-cursor-outer');
      var mouse = {
        x: -100,
        y: -100
      }; // mouse pointer's coordinates

      var pos = {
        x: 0,
        y: 0
      }; // cursor's coordinates

      var speed = 0.1; // between 0 and 1

      var updateCoordinates = function updateCoordinates(e) {
        mouse.x = e.clientX;
        mouse.y = e.clientY;
      };

      window.addEventListener('mousemove', updateCoordinates);

      function getAngle(diffX, diffY) {
        return Math.atan2(diffY, diffX) * 180 / Math.PI;
      }

      function getSqueeze(diffX, diffY) {
        var distance = Math.sqrt(Math.pow(diffX, 2) + Math.pow(diffY, 2));
        var maxSqueeze = 0.15;
        var accelerator = 1500;
        return Math.min(distance / accelerator, maxSqueeze);
      }

      var updateCursor = function updateCursor() {
        var diffX = Math.round(mouse.x - pos.x);
        var diffY = Math.round(mouse.y - pos.y);
        pos.x += diffX * speed;
        pos.y += diffY * speed;
        var angle = getAngle(diffX, diffY);
        var squeeze = getSqueeze(diffX, diffY);
        var scale = 'scale(' + (1 + squeeze) + ', ' + (1 - squeeze) + ')';
        var rotate = 'rotate(' + angle + 'deg)';
        var translate = 'translate3d(' + pos.x + 'px ,' + pos.y + 'px, 0)';
        cursor.style.transform = translate;
        cursorCircle.style.transform = rotate + scale;
      };

      function loop() {
        updateCursor();
        requestAnimationFrame(loop);
      }

      requestAnimationFrame(loop);
      var cursorModifiers = document.querySelectorAll('[cursor-class]');
      cursorModifiers.forEach(function (cursorModifier) {
        cursorModifier.addEventListener('mouseenter', function () {
          var className = this.getAttribute('cursor-class');
          cursor.classList.add(className);
        });
        cursorModifier.addEventListener('mouseleave', function () {
          var className = this.getAttribute('cursor-class');
          cursor.classList.remove(className);
        });
      });
      var cursorModifiersDefaultHover = document.querySelectorAll('a, button, input, .js-cursor-hover');
      cursorModifiersDefaultHover.forEach(function (cursorModifierDefaultHover) {
        cursorModifierDefaultHover.addEventListener('mouseenter', function () {
          var className = 'hover';
          cursor.classList.add(className);
        });
        cursorModifierDefaultHover.addEventListener('mouseleave', function () {
          var className = 'hover';
          cursor.classList.remove(className);
        });
      });
    }
  }]);

  return Cursor;
}();



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
//# sourceMappingURL=cursor.bundle.js.map