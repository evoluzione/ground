"use strict";
(self["webpackChunkground"] = self["webpackChunkground"] || []).push([["ground-scrollDirection"],{

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
  // eslint-disable-next-line no-unused-vars
  function ScrollDirection(element, options) {
    _classCallCheck(this, ScrollDirection);

    this.initEvents();
  }
  /**
   * Initialize events
   * @param {string} triggers - Selectors
   */


  _createClass(ScrollDirection, [{
    key: "initEvents",
    value: function initEvents() {
      // Initial state
      var scrollPos = document.body.getBoundingClientRect().top;
      var offset = -100;
      var htmlEl = document.documentElement.classList; // adding scroll event

      window.addEventListener('scroll', function () {
        var currentPos = document.body.getBoundingClientRect().top;

        if (scrollPos < offset) {
          htmlEl.add('body-scrolled');

          if (currentPos > scrollPos) {
            // scrolling up
            htmlEl.remove('scroll-direction-down');
            htmlEl.add('scroll-direction-up');
          } else {
            // Scrolling down
            htmlEl.remove('scroll-direction-up');
            htmlEl.add('scroll-direction-down');
          }
        } else {
          htmlEl.remove('body-scrolled');
        } // saves the new position for iteration.


        scrollPos = currentPos;
      });
    }
  }]);

  return ScrollDirection;
}();



/***/ })

}]);
//# sourceMappingURL=ground-scrollDirection.bundle.js.map