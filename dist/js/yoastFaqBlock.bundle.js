"use strict";
(self["webpackChunkground"] = self["webpackChunkground"] || []).push([["yoastFaqBlock"],{

/***/ "./js/components/yoastFaqBlock.js":
/*!****************************************!*\
  !*** ./js/components/yoastFaqBlock.js ***!
  \****************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ YoastFaqBlock; }
/* harmony export */ });
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var YoastFaqBlock = /*#__PURE__*/_createClass(function YoastFaqBlock() {
  _classCallCheck(this, YoastFaqBlock);

  // ----- TO DO -----
  // Test this solution and move inside Javascript Class: Soluzione basata sul blocco FAQ di Yoast SEO.
  var faqSingleTriggers = document.querySelectorAll('.schema-faq-question');
  faqSingleTriggers.forEach(function (trigger) {
    return trigger.addEventListener('click', toggleAccordion);
  });

  function toggleAccordion() {
    var items = document.querySelectorAll('.schema-faq-section');
    var thisItem = this.parentNode;
    items.forEach(function (item) {
      if (thisItem == item) {
        thisItem.classList.toggle('is-open');
        return;
      }

      item.classList.remove('is-open');
    });
  }
});



/***/ })

}]);
//# sourceMappingURL=yoastFaqBlock.bundle.js.map