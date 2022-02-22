"use strict";
(self["webpackChunkground"] = self["webpackChunkground"] || []).push([["ground-widgetAccordion"],{

/***/ "./js/components/widgetAccordion.js":
/*!******************************************!*\
  !*** ./js/components/widgetAccordion.js ***!
  \******************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ WidgetAccordion; }
/* harmony export */ });
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

var WidgetAccordion = /*#__PURE__*/function () {
  /**
   * @param {string} element - Selector
   * @param {Object} options - User options
   */
  function WidgetAccordion(element, options) {
    _classCallCheck(this, WidgetAccordion);

    // window.addEventListener('DOMContentLoaded', () => {
    this.initEvents(); // });
  }
  /**
   * Initialize events
   * @param {string} triggers - Selectors
   */


  _createClass(WidgetAccordion, [{
    key: "initEvents",
    value: function initEvents() {
      var elName = '.woocommerce-widget-layered-nav';
      var $el = jQuery(elName);

      if ($el.length == 0) {
        return;
      }

      jQuery(elName).each(function (key, value) {
        var currentWidget = value;
        var currentWidgetTitle = jQuery(currentWidget).find('.widgettitle');
        jQuery(currentWidgetTitle).on('click', function () {
          jQuery(currentWidget).toggleClass('widget-is-open');
        });
      });
    }
  }]);

  return WidgetAccordion;
}();



/***/ })

}]);
//# sourceMappingURL=ground-widgetAccordion.bundle.js.map