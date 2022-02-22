"use strict";
(self["webpackChunkground"] = self["webpackChunkground"] || []).push([["ground-modal"],{

/***/ "./js/components/modal.js":
/*!********************************!*\
  !*** ./js/components/modal.js ***!
  \********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ Modal; }
/* harmony export */ });
/* harmony import */ var _utilities_observer__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utilities/observer */ "./js/utilities/observer.js");
/* harmony import */ var photoswipe__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! photoswipe */ "./node_modules/photoswipe/dist/photoswipe.js");
/* harmony import */ var photoswipe__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(photoswipe__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var photoswipe_dist_photoswipe_ui_default__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! photoswipe/dist/photoswipe-ui-default */ "./node_modules/photoswipe/dist/photoswipe-ui-default.js");
/* harmony import */ var photoswipe_dist_photoswipe_ui_default__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(photoswipe_dist_photoswipe_ui_default__WEBPACK_IMPORTED_MODULE_2__);
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

/**
 * Modal module
 * Lightbox library for presenting various types of media
 */




var Deepmerge = __webpack_require__(/*! deepmerge */ "./node_modules/deepmerge/dist/cjs.js");

var Modal = /*#__PURE__*/function () {
  /**
   * @param {string} element - Selector
   * @param {Object} options - User options
   */
  function Modal(element, options) {
    _classCallCheck(this, Modal);

    this.element = element || '[data-modal]';
    this.defaults = {
      triggers: this.element // '[href$=".jpg"], [href$=".png"], [href$=".gif"], [href$=".jpeg"], [href$=".webp"]'

    };
    this.DOM = {
      html: document.documentElement,
      body: document.body
    };
    this.options = options ? Deepmerge(this.defaults, options) : this.defaults;
    this.updateEvents = this.updateEvents.bind(this);
    this.openPhotoSwipe = this.openPhotoSwipe.bind(this);
    this.clickedItem = this.clickedItem.bind(this); // window.addEventListener('DOMContentLoaded', () => {

    this.init();
    this.initEvents(this.options.triggers);
    (0,_utilities_observer__WEBPACK_IMPORTED_MODULE_0__.initObserver)(this.options.triggers, this.updateEvents); // });
  }

  _createClass(Modal, [{
    key: "init",
    value: function init() {
      this.DOM.element = document.querySelectorAll(this.element);
      this.DOM.pswpElement = document.querySelectorAll('.pswp')[0];
    }
    /**
     * Initialize events
     * @param {string} triggers - Selectors
     */

  }, {
    key: "initEvents",
    value: function initEvents(triggers) {
      var elements = document.querySelectorAll(triggers);

      for (var i = 0; i < elements.length; i++) {
        elements[i].addEventListener('click', this.clickedItem);
      }
    }
    /**
     * Update events
     * @param {string} target - New selector
     */

  }, {
    key: "updateEvents",
    value: function updateEvents(target) {
      target.addEventListener('click', this.clickedItem);
    }
  }, {
    key: "getItems",
    value: function getItems(currentTarget) {
      this.items = [];
      var item;
      var size;
      var sel = document.querySelectorAll("[data-modal=\"".concat(event.currentTarget.dataset.modal, "\"]"));

      if (event.currentTarget.dataset.modal === '') {
        var element = event.currentTarget;
        size = element.getAttribute('data-modal-size').split('x');
        item = {
          src: element.getAttribute('href'),
          w: parseInt(size[0], 10),
          h: parseInt(size[1], 10),
          el: element
        };

        if (element.getElementsByTagName('img')[0] !== undefined) {
          item.msrc = element.getElementsByTagName('img')[0].getAttribute('src');
        }

        if (element.getAttribute('data-modal-caption')) {
          item.title = element.getAttribute('data-modal-caption');
        }

        this.items.push(item);
      } else {
        for (var index = 0; index < sel.length; index++) {
          var _element = sel[index];
          size = _element.getAttribute('data-modal-size').split('x');
          item = {
            src: _element.getAttribute('href'),
            w: parseInt(size[0], 10),
            h: parseInt(size[1], 10),
            firstSlide: currentTarget.isEqualNode(_element),
            el: _element
          };

          if (_element.getElementsByTagName('img')[0] !== undefined) {
            item.msrc = _element.getElementsByTagName('img')[0].getAttribute('src');
          }

          if (_element.getAttribute('data-modal-caption')) {
            item.title = _element.getAttribute('data-modal-caption');
          }

          this.items.push(item);
        }
      }

      return this.items;
    }
  }, {
    key: "clickedItem",
    value: function clickedItem(event) {
      this.openPhotoSwipe(event);
    }
  }, {
    key: "openPhotoSwipe",
    value: function openPhotoSwipe(event) {
      var _this = this;

      event.preventDefault();
      var index;
      var items = this.getItems(event.currentTarget);

      if (items.length > 0) {
        for (var i = 0; i < items.length; i++) {
          var element = items[i];

          if (element.firstSlide) {
            index = i;
          }
        }
      }

      this.swiperOptions = {
        index: index,
        history: false,
        shareEl: false,
        getThumbBoundsFn: function getThumbBoundsFn(index) {
          var thumbnail = items[index].el.getElementsByTagName('img')[0];
          var pageYScroll = window.pageYOffset || document.documentElement.scrollTop;
          var rect = thumbnail.getBoundingClientRect();
          return {
            x: rect.left,
            y: rect.top + pageYScroll,
            w: rect.width
          };
        }
      };
      this.gallery = new photoswipe__WEBPACK_IMPORTED_MODULE_1__.PhotoSwipe(this.DOM.pswpElement, photoswipe_dist_photoswipe_ui_default__WEBPACK_IMPORTED_MODULE_2__.PhotoSwipeUIDefault, items, this.swiperOptions);
      this.gallery.init();
      this.onOpen();
      this.gallery.listen('close', function () {
        _this.onClose();
      });
    }
  }, {
    key: "onOpen",
    value: function onOpen() {
      this.DOM.html.classList.add('is-modal-open');
    }
  }, {
    key: "onClose",
    value: function onClose() {
      this.DOM.html.classList.remove('is-modal-open');
    }
  }, {
    key: "destroy",
    value: function destroy() {
      this.gallery.destroy();
    }
  }]);

  return Modal;
}();



/***/ }),

/***/ "./js/utilities/observer.js":
/*!**********************************!*\
  !*** ./js/utilities/observer.js ***!
  \**********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "initObserver": function() { return /* binding */ initObserver; }
/* harmony export */ });
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it.return != null) it.return(); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

/**
 * Observe DOM Node Changes
 * @param {string} triggers - Selectors
 * @param {requestCallback} cb - The callback that handles the response.
 *
 * @see https://stackoverflow.com/questions/56608748/how-to-use-queryselectorall-on-the-added-nodes-in-a-mutationobserver
 */
function initObserver(triggers, callback) {
  var filterSelector = function filterSelector(selector, mutationsList) {
    // We can't create a NodeList; let's use a Set
    var result = new Set(); // Loop through the mutationsList...

    var _iterator = _createForOfIteratorHelper(mutationsList),
        _step;

    try {
      for (_iterator.s(); !(_step = _iterator.n()).done;) {
        var addedNodes = _step.value.addedNodes;

        var _iterator2 = _createForOfIteratorHelper(addedNodes),
            _step2;

        try {
          for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
            var node = _step2.value;

            // console.log(node);
            // If it's an element...
            if (node.nodeType === 1) {
              // Add it if it's a match
              if (node.matches(selector)) {
                result.add(node);
              } // Add any children


              var _iterator3 = _createForOfIteratorHelper(node.querySelectorAll(selector)),
                  _step3;

              try {
                for (_iterator3.s(); !(_step3 = _iterator3.n()).done;) {
                  var entry = _step3.value;
                  result.add(entry);
                }
              } catch (err) {
                _iterator3.e(err);
              } finally {
                _iterator3.f();
              }
            }
          }
        } catch (err) {
          _iterator2.e(err);
        } finally {
          _iterator2.f();
        }
      }
      /* mutationsList.map((e) => e.addedNodes).forEach((n) => {
      		if (n.nodeType === 1) {
      			if (n.matches(selector)) {
      				result.add(n);
      			}
      			// Add any children
      			n.querySelectorAll(selector).forEach((c) => result.add(c));
      		}
      	}); */

    } catch (err) {
      _iterator.e(err);
    } finally {
      _iterator.f();
    }

    return _toConsumableArray(result); // Result is an array, or just return the set
  };

  var observerCallback = function observerCallback(mutationsList) {
    var result = filterSelector(triggers, mutationsList);
    result.forEach(function (element) {
      callback(element);
    });
  };

  var config = {
    childList: true,
    attributes: false,
    characterData: false,
    subtree: true
  };
  var observer = new MutationObserver(observerCallback);
  observer.observe(document.documentElement, config); //observer.disconnect();
}

/***/ })

}]);
//# sourceMappingURL=ground-modal.bundle.js.map