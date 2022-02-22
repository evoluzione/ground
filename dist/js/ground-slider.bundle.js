"use strict";
(self["webpackChunkground"] = self["webpackChunkground"] || []).push([["ground-slider"],{

/***/ "./js/components/slider.js":
/*!*********************************!*\
  !*** ./js/components/slider.js ***!
  \*********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ Slider; }
/* harmony export */ });
/* harmony import */ var swiper__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! swiper */ "./node_modules/swiper/swiper.esm.js");
/* harmony import */ var deepmerge__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! deepmerge */ "./node_modules/deepmerge/dist/cjs.js");
/* harmony import */ var deepmerge__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(deepmerge__WEBPACK_IMPORTED_MODULE_1__);
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

/**
 * Slider module
 * Modern mobile touch slider with hardware accelerated transitions
 * @see http://idangero.us/swiper
 */
//import Swiper from 'swiper/bundle';


swiper__WEBPACK_IMPORTED_MODULE_0__.Swiper.use([swiper__WEBPACK_IMPORTED_MODULE_0__.Navigation, swiper__WEBPACK_IMPORTED_MODULE_0__.Pagination, swiper__WEBPACK_IMPORTED_MODULE_0__.Autoplay, swiper__WEBPACK_IMPORTED_MODULE_0__.Lazy, swiper__WEBPACK_IMPORTED_MODULE_0__.EffectFade]);

var Slider = /*#__PURE__*/function () {
  /**
   * @param {string} element - Selector
   * @param {Object} options - User options
   */
  function Slider(element, options) {
    var _this = this;

    _classCallCheck(this, Slider);

    this.element = element || '.js-slider';
    this.defaults = {
      init: true,
      initialSlide: 0,
      direction: 'horizontal',
      speed: 1600,
      loop: true,
      effect: 'slide',
      autoHeight: false,
      parallax: false,
      preloadImages: true,
      observer: true,
      observeParents: true,
      lazy: {
        loadPrevNext: true,
        loadPrevNextAmount: 1,
        loadOnTransitionStart: true
      },
      autoplay: {
        delay: 5000
      },
      pagination: {
        el: '.js-slider-primary-pagination',
        clickable: true,
        type: 'bullets'
      },
      navigation: {
        prevEl: '.js-slider-primary-navigation-prev',
        nextEl: '.js-slider-primary-navigation-next'
      },
      slidesPerView: 1,
      spaceBetween: 0,
      breakpointsInverse: true
      /* breakpoints: {
      	// when window width is >= xs
      	480: {
      		slidesPerView: 1,
      		// slidesPerView: 'auto',
      		// freeMode: true,
      		// spaceBetween: 48
      	},
      	// when window width is >= sm
      	768: {
      		slidesPerView: 1,
      		// freeMode: false,
      	},
      	// when window width is >= md
      	992: {
      		slidesPerView: 1,
      	},
      	// when window width is >= lg
      	1200: {
      		slidesPerView: 1,
      	},
      	// when window width is >= xl
      	1440: {
      		slidesPerView: 1,
      	},
      }, */

    };
    this.options = options ? deepmerge__WEBPACK_IMPORTED_MODULE_1___default()(this.defaults, options) : this.defaults; // window.addEventListener('DOMContentLoaded', () => {

    this.init(); // });

    window.addEventListener('NAVIGATE_END', function () {
      _this.init();
    });
    window.addEventListener('infiniteScrollAppended', function () {
      _this.init();
    });
  }
  /**
   * Initialize plugin
   */


  _createClass(Slider, [{
    key: "init",
    value: function init() {
      if (document.querySelectorAll(this.element).length === 0) {
        return;
      }

      this.slider = new swiper__WEBPACK_IMPORTED_MODULE_0__.Swiper(this.element, this.options);
    }
    /**
     * Start autoplay
     */

  }, {
    key: "autoplayStart",
    value: function autoplayStart() {
      if (this.slider === undefined) {
        return;
      }

      this.slider.autoplay.start();
    }
    /**
     * Stop autoplay
     */

  }, {
    key: "autoplayStop",
    value: function autoplayStop() {
      if (this.slider === undefined) {
        return;
      }

      this.slider.autoplay.stop();
    }
    /**
     * Destroy slider instance and detach all events listeners
     * @param {boolean} deleteInstance - Set it to false (by default it is true) to not to delete Swiper instance
     * @param {boolean} cleanStyles - Set it to true (by default it is true) and all custom styles will be removed from slides, wrapper and container.
     */

  }, {
    key: "destroy",
    value: function destroy(deleteInstance, cleanStyles) {
      if (this.slider === undefined) {
        return;
      }

      this.slider.destroy(deleteInstance, cleanStyles);
    }
    /**
     * Run transition to previous slide
     * @param {number} speed - transition duration (in ms). Optional
     * @param {boolean} runCallbacks Set it to false (by default it is true) and transition will not produce transition events. Optional
     */

  }, {
    key: "slidePrev",
    value: function slidePrev(speed, runCallbacks) {
      if (this.slider === undefined) {
        return;
      }

      this.slider.slidePrev(speed, runCallbacks);
    }
    /**
     * Run transition to next slide
     * @param {number} speed - transition duration (in ms). Optional
     * @param {boolean} runCallbacks - Set it to false (by default it is true) and transition will not produce transition events. Optional
     */

  }, {
    key: "slideNext",
    value: function slideNext(speed, runCallbacks) {
      if (this.slider === undefined) {
        return;
      }

      this.slider.slideNext(speed, runCallbacks);
    }
    /**
     * Run transition to the slide with index number equal to 'index' parameter for the duration equal to 'speed' parameter.
     * @param {number} index - index number of slide
     * @param {number} speed - transition duration (in ms). Optional
     * @param {boolean} runCallbacks Set it to false (by default it is true) and transition will not produce transition events. Optional
     */

  }, {
    key: "slideTo",
    value: function slideTo(index, speed, runCallbacks) {
      if (this.slider === undefined) {
        return;
      }

      this.slider.slideTo(index, speed, runCallbacks);
    }
  }]);

  return Slider;
}();



/***/ })

}]);
//# sourceMappingURL=ground-slider.bundle.js.map