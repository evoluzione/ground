"use strict";
(self["webpackChunkground"] = self["webpackChunkground"] || []).push([["magnet"],{

/***/ "./js/components/magnetV2.js":
/*!***********************************!*\
  !*** ./js/components/magnetV2.js ***!
  \***********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ Magnet; }
/* harmony export */ });
/* harmony import */ var gsap__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! gsap */ "./node_modules/gsap/index.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

/**
 * Magnet module
 * Mouse interactions
 */


var Magnet = /*#__PURE__*/function () {
  /**
   * @param {string} element - Selector
   * @param {Object} options - User options
   */
  function Magnet(element, options) {
    _classCallCheck(this, Magnet);

    this.element = element || '.js-magnet'; // window.addEventListener('DOMContentLoaded', () => {

    this.init(); // });
  }

  _createClass(Magnet, [{
    key: "init",
    value: function init() {
      if (this.element.length == 0) {
        return;
      }

      var hoverMouse = function hoverMouse($el) {
        $el.each(function () {
          var $self = jQuery(this);
          var hover = false;
          var offsetHoverMax = $self.attr('offset-hover-max') || 0.7;
          var offsetHoverMin = $self.attr('offset-hover-min') || 0.5;

          var attachEventsListener = function attachEventsListener() {
            jQuery(window).on('mousemove', function (e) {
              //
              var hoverArea = hover ? offsetHoverMax : offsetHoverMin; // cursor

              var cursor = {
                x: e.clientX,
                y: e.clientY + jQuery(window).scrollTop()
              }; // size

              var width = $self.outerWidth();
              var height = $self.outerHeight(); // position

              var offset = $self.offset();
              var elPos = {
                x: offset.left + width / 2,
                y: offset.top + height / 2
              }; // comparaison

              var x = cursor.x - elPos.x;
              var y = cursor.y - elPos.y; // dist

              var dist = Math.sqrt(x * x + y * y); // mutex hover

              var mutHover = false; // anim

              if (dist < width * hoverArea) {
                mutHover = true;

                if (!hover) {
                  hover = true;
                }

                onHover(x, y);
              } // reset


              if (!mutHover && hover) {
                onLeave();
                hover = false;
              }
            });
          };

          var onHover = function onHover(x, y) {
            gsap__WEBPACK_IMPORTED_MODULE_0__.gsap.to($self, 0.4, {
              x: x * 0.8,
              y: y * 0.8,
              //scale: .9,
              rotation: x * 0.05,
              ease: 'power3inOut'
            });
          };

          var onLeave = function onLeave() {
            gsap__WEBPACK_IMPORTED_MODULE_0__.gsap.to($self, 0.7, {
              x: 0,
              y: 0,
              scale: 1,
              rotation: 0,
              ease: 'elastic'
            });
          };

          attachEventsListener();
        });
      };

      hoverMouse(jQuery(this.element));
    }
  }]);

  return Magnet;
}();



/***/ })

}]);
//# sourceMappingURL=magnet.bundle.js.map