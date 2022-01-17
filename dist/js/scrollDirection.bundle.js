"use strict";
(self["webpackChunkground"] = self["webpackChunkground"] || []).push([["scrollDirection"],{

/***/ "./js/components/scrollDirection.js":
/*!******************************************!*\
  !*** ./js/components/scrollDirection.js ***!
  \******************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ ScrollDirection; }
/* harmony export */ });
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

var ScrollDirection = /*#__PURE__*/function () {
  /**
   * @param {string} element - Selector
   * @param {Object} options - User options
   */
  function ScrollDirection(element, options) {
    _classCallCheck(this, ScrollDirection);

    // window.addEventListener('DOMContentLoaded', () => {
    this.initEvents(); // });
  }
  /**
   * Initialize events
   * @param {string} triggers - Selectors
   */


  _createClass(ScrollDirection, [{
    key: "initEvents",
    value: function initEvents() {
      // Initial state
      var scrollPos = 0; // adding scroll event

      window.addEventListener('scroll', function () {
        if (scrollPos < -96) {
          // detects new state and compares it with the new one
          if (document.body.getBoundingClientRect().top > scrollPos) {
            if (document.documentElement.classList.contains('scroll-direction-down')) {
              document.documentElement.classList.replace('scroll-direction-down', 'scroll-direction-up');
            } else {
              document.documentElement.classList.add('scroll-direction-up');
            }
          } else if (document.documentElement.classList.contains('scroll-direction-up')) {
            document.documentElement.classList.replace('scroll-direction-up', 'scroll-direction-down');
          } else {
            document.documentElement.classList.add('scroll-direction-down');
          }

          document.documentElement.classList.add('body-scrolled');
        } else {
          if (document.documentElement.classList.contains('body-scrolled')) {
            document.documentElement.classList.remove('body-scrolled');
          }
        } // saves the new position for iteration.


        scrollPos = document.body.getBoundingClientRect().top;
      });
    }
  }]);

  return ScrollDirection;
}();



/***/ })

}]);
//# sourceMappingURL=scrollDirection.bundle.js.map