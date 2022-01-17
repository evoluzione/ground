"use strict";
(self["webpackChunkground"] = self["webpackChunkground"] || []).push([["search"],{

/***/ "./js/components/search.js":
/*!*********************************!*\
  !*** ./js/components/search.js ***!
  \*********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ Search; }
/* harmony export */ });
/* harmony import */ var _utilities_paths__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utilities/paths */ "./js/utilities/paths.js");
/* harmony import */ var _utilities_debounce__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../utilities/debounce */ "./js/utilities/debounce.js");
/* harmony import */ var _utilities_environment__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../utilities/environment */ "./js/utilities/environment.js");
/* harmony import */ var ismobilejs__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ismobilejs */ "./node_modules/ismobilejs/esm/index.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

/**
 * Search module
 */





var Search = /*#__PURE__*/function () {
  /**
   * @param {string} element - Selector
   */
  function Search(element) {
    var _this = this;

    _classCallCheck(this, Search);

    this.element = element || 'js-ajax-search';
    this.DOM = {
      html: document.documentElement,
      body: document.body,
      element: document.getElementById(this.element),
      searchMobile: document.getElementById('js-search-mobile'),
      searchClose: document.getElementById('js-search-close'),
      searchForm: document.getElementById('js-search-form'),
      searchDesktop: document.getElementById('js-search-desktop'),
      searchFormAjax: document.getElementById('js-ajax-search'),
      searchResult: document.getElementById('js-ajax-search-result'),
      searchInput: document.getElementById('js-ajax-search-input')
    };
    this.adminAjaxUrl = "".concat((0,_utilities_paths__WEBPACK_IMPORTED_MODULE_0__.getSiteUrl)(), "/wp-admin/admin-ajax.php");
    this.searchLoadingClass = 'is-search-loading'; // window.addEventListener('DOMContentLoaded', () => {

    this.init(); // });

    window.addEventListener('resize', function () {
      if (!(0,ismobilejs__WEBPACK_IMPORTED_MODULE_3__["default"])().any) {
        _this.DOM.html.classList.remove('is-search-open');

        _this.DOM.searchForm.classList.remove('is-search-open');

        _this.init();
      }
    });
  }

  _createClass(Search, [{
    key: "init",
    value: function init() {
      var _this2 = this;

      if (window.matchMedia('(max-width: 1024px)').matches) {
        if (this.DOM.searchMobile) this.DOM.searchMobile.append(this.DOM.searchFormAjax);
      } else {
        if (this.DOM.searchDesktop) this.DOM.searchDesktop.append(this.DOM.searchFormAjax);
      }

      if (this.DOM.element.length === 0) {
        return;
      }

      var debounceInput = (0,_utilities_debounce__WEBPACK_IMPORTED_MODULE_1__.debounce)(function () {
        _this2.search();
      }, 250);
      this.DOM.searchInput.addEventListener('input', function () {
        _this2.DOM.html.classList.add('is-search-open');

        _this2.DOM.searchForm.classList.add('is-search-open');
      });
      this.DOM.searchInput.addEventListener('input', debounceInput);
      this.DOM.searchClose.addEventListener('click', function () {
        _this2.DOM.searchValue = '';
      });
    }
  }, {
    key: "search",
    value: function search() {
      var _this3 = this;

      var searchValue = this.DOM.searchInput.value;
      this.DOM.searchClose.addEventListener('click', function () {
        _this3.DOM.searchValue = '';
      });

      if (searchValue === '') {
        this.DOM.searchResult.innerHTML = '';
        return;
      }

      this.beforeSend();
      window.fetch(this.adminAjaxUrl, {
        method: 'post',
        headers: {
          'content-type': 'application/x-www-form-urlencoded; charset=UTF-8'
        },
        body: "action=data_fetch&keyword=".concat(searchValue)
      }).then(function (res) {
        return res.text();
      }).then(function (html) {
        return _this3.success(html);
      }).catch(function (error) {
        if (_utilities_environment__WEBPACK_IMPORTED_MODULE_2__.DEBUG_MODE) {
          // eslint-disable-next-line no-console
          console.error('🔥Error:', error);
        }
      });
    }
  }, {
    key: "beforeSend",
    value: function beforeSend() {
      this.DOM.element.classList.add(this.searchLoadingClass);
      this.DOM.searchResult.innerHTML = '';
    }
  }, {
    key: "success",
    value: function success(html) {
      this.DOM.element.classList.remove(this.searchLoadingClass);
      this.DOM.searchResult.innerHTML = html;
    }
  }]);

  return Search;
}();



/***/ }),

/***/ "./js/utilities/debounce.js":
/*!**********************************!*\
  !*** ./js/utilities/debounce.js ***!
  \**********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "debounce": function() { return /* binding */ debounce; }
/* harmony export */ });
/**
 * Debounce
 */

/**
 * Returns a function, that, as long as it continues to be invoked, will not be triggered.
 * The function will be called after it stops being called for N milliseconds.
 * If 'immediate' is passed, trigger the function on the leading edge, instead of the trailing.
 * @see https://davidwalsh.name/javascript-debounce-function
 * @param {function} func - Function to wrap
 * @param {number} wait - Timeout in ms (`100`)
 * @param {boolean} immediate - Whether to execute at the beginning (`false`)
 */
function debounce(func, wait, immediate) {
  var timeout; // This is the function that is actually executed when
  // the DOM event is triggered.

  return function executedFunction() {
    // Store the context of this and any
    // parameters passed to executedFunction
    var context = this; // eslint-disable-next-line prefer-rest-params

    var args = arguments; // The function to be called after
    // the debounce time has elapsed

    var later = function later() {
      // null timeout to indicate the debounce ended
      timeout = null; // Call function now if you did not on the leading end

      if (!immediate) func.apply(context, args);
    }; // Determine if you should call the function
    // on the leading or trail end


    var callNow = immediate && !timeout; // This will reset the waiting every function execution.
    // This is the step that prevents the function from
    // being executed because it will never reach the
    // inside of the previous setTimeout

    clearTimeout(timeout); // Restart the debounce waiting period.
    // setTimeout returns a truthy value (it differs in web vs node)

    timeout = setTimeout(later, wait); // Call immediately if you're dong a leading
    // end execution

    if (callNow) func.apply(context, args);
  };
}

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

/***/ "./js/utilities/paths.js":
/*!*******************************!*\
  !*** ./js/utilities/paths.js ***!
  \*******************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "getTemplateUrl": function() { return /* binding */ getTemplateUrl; },
/* harmony export */   "getSiteUrl": function() { return /* binding */ getSiteUrl; },
/* harmony export */   "getCurrentUrl": function() { return /* binding */ getCurrentUrl; }
/* harmony export */ });
/**
 * Paths
 */

/**
 * Get template url
 * @returns {string}
 */
function getTemplateUrl() {
  return document.body.dataset.templateUrl;
}
/**
 * Get site url
 * @returns {string}
 */

function getSiteUrl() {
  return "".concat(window.location.protocol, "//").concat(window.location.host);
}
/**
 * Get current url
 * @returns {string}
 */

function getCurrentUrl() {
  return "".concat(window.location.protocol, "//").concat(window.location.host).concat(window.location.pathname).concat(window.location.search);
}

/***/ })

}]);
//# sourceMappingURL=search.bundle.js.map