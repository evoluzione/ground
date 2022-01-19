"use strict";
(self["webpackChunkground"] = self["webpackChunkground"] || []).push([["animationDefault"],{

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



/***/ })

}]);
//# sourceMappingURL=animationDefault.bundle.js.map