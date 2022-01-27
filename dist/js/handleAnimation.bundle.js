"use strict";
(self["webpackChunkground"] = self["webpackChunkground"] || []).push([["handleAnimation"],{

/***/ "./js/animations/handleAnimation.js":
/*!******************************************!*\
  !*** ./js/animations/handleAnimation.js ***!
  \******************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ HandleAnimation; }
/* harmony export */ });
/* harmony import */ var _utilities_observer__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utilities/observer */ "./js/utilities/observer.js");
/* harmony import */ var gsap__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! gsap */ "./node_modules/gsap/index.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

/* eslint-disable no-unused-vars */



var HandleAnimation = /*#__PURE__*/function () {
  // List all the Classes we can add dynamically

  /**
   * @type {string[]}
   */

  /**
   * @type {promise[]}
   */
  function HandleAnimation() {
    _classCallCheck(this, HandleAnimation);

    _defineProperty(this, "AnimationSplitText", void 0);

    _defineProperty(this, "AnimationRotation", void 0);

    _defineProperty(this, "AnimationPin", void 0);

    _defineProperty(this, "AnimationComparison", void 0);

    _defineProperty(this, "AnimationDefault", void 0);

    _defineProperty(this, "AnimationBatch", void 0);

    _defineProperty(this, "AnimationScale", void 0);

    _defineProperty(this, "AnimationDraw", void 0);

    _defineProperty(this, "AnimationBgColor", void 0);

    _defineProperty(this, "AnimationSpriteImages", void 0);

    _defineProperty(this, "AnimationHorizontalScroll", void 0);

    _defineProperty(this, "AnimationHorizontalScrollContainer", void 0);

    _defineProperty(this, "AnimationHorizontalScrollSection", void 0);

    _defineProperty(this, "AnimationParallax", void 0);

    _defineProperty(this, "AnimationVideo", void 0);

    _defineProperty(this, "animationToActivate", []);

    _defineProperty(this, "promiseList", []);

    _defineProperty(this, "hasCssAnimation", false);

    this.initEvents('[data-scroll]');
    (0,_utilities_observer__WEBPACK_IMPORTED_MODULE_0__.initObserver)('[data-scroll]', this.updateEvents);
  }
  /**
   * Init events to run animations
   * @param {*} triggers 
   */


  _createClass(HandleAnimation, [{
    key: "initEvents",
    value: function initEvents(triggers) {
      this.getAnimationToActivate(triggers);
      this.populatePromiseList();
      this.resolveAllPromise(triggers);
    }
    /**
     * Get all animations we need in array 
     * @param {*} triggers 
     */

  }, {
    key: "getAnimationToActivate",
    value: function getAnimationToActivate(triggers) {
      var _this = this;

      gsap__WEBPACK_IMPORTED_MODULE_1__.gsap.utils.toArray(triggers).forEach(function (element) {
        var dataAttribute = element.dataset.scroll;

        var isInArray = _this.animationToActivate.includes(dataAttribute);

        if (isInArray) return;

        if (!_this.hasCssAnimation && dataAttribute.substring(0, 2) !== 'js') {
          _this.hasCssAnimation = true;
        }

        _this.animationToActivate.push(dataAttribute);
      }); // console.log(this.animationToActivate);
      // console.log(this.hasCssAnimation);
    }
    /**
     * Create an array of promises to import partials
     */

  }, {
    key: "populatePromiseList",
    value: function populatePromiseList() {
      var _this2 = this;

      if (this.animationToActivate.includes('js-split-text')) {
        var promise = Promise.all(/*! import() | animationSplitText */[__webpack_require__.e("vendors-node_modules_gsap_ScrollTrigger_js"), __webpack_require__.e("vendors-node_modules_deepmerge_dist_cjs_js-node_modules_gsap_SplitText_js"), __webpack_require__.e("animationSplitText")]).then(__webpack_require__.bind(__webpack_require__, /*! ./animationSplitText */ "./js/animations/animationSplitText.js")).then(function (module) {
          _this2.AnimationSplitText = module.default;
          return module.default.name;
        }).catch(function (error) {
          return console.log(error);
        });
        this.promiseList.push(promise);
      }

      if (this.animationToActivate.includes('js-rotation')) {
        var _promise = Promise.all(/*! import() | animationRotation */[__webpack_require__.e("vendors-node_modules_gsap_ScrollTrigger_js"), __webpack_require__.e("animationRotation")]).then(__webpack_require__.bind(__webpack_require__, /*! ./animationRotation */ "./js/animations/animationRotation.js")).then(function (module) {
          _this2.AnimationRotation = module.default;
          return module.default.name;
        }).catch(function (error) {
          return console.log(error);
        });

        this.promiseList.push(_promise);
      }

      if (this.animationToActivate.includes('js-pin')) {
        var _promise2 = Promise.all(/*! import() | animationPin */[__webpack_require__.e("vendors-node_modules_gsap_ScrollTrigger_js"), __webpack_require__.e("animationPin")]).then(__webpack_require__.bind(__webpack_require__, /*! ./animationPin */ "./js/animations/animationPin.js")).then(function (module) {
          _this2.AnimationPin = module.default;
          return module.default.name;
        }).catch(function (error) {
          return console.log(error);
        });

        this.promiseList.push(_promise2);
      }

      if (this.animationToActivate.includes('js-comparison')) {
        var _promise3 = Promise.all(/*! import() | animationComparison */[__webpack_require__.e("vendors-node_modules_gsap_ScrollTrigger_js"), __webpack_require__.e("animationComparison")]).then(__webpack_require__.bind(__webpack_require__, /*! ./animationComparison */ "./js/animations/animationComparison.js")).then(function (module) {
          _this2.AnimationComparison = module.default;
          return module.default.name;
        }).catch(function (error) {
          return console.log(error);
        });

        this.promiseList.push(_promise3);
      }

      if (this.animationToActivate.includes('js-batch')) {
        var _promise4 = Promise.all(/*! import() | animationBatch */[__webpack_require__.e("vendors-node_modules_gsap_ScrollTrigger_js"), __webpack_require__.e("animationBatch")]).then(__webpack_require__.bind(__webpack_require__, /*! ./animationBatch */ "./js/animations/animationBatch.js")).then(function (module) {
          _this2.AnimationBatch = module.default;
          return module.default.name;
        }).catch(function (error) {
          return console.log(error);
        });

        this.promiseList.push(_promise4);
      }

      if (this.animationToActivate.includes('js-scale')) {
        var _promise5 = Promise.all(/*! import() | animationScale */[__webpack_require__.e("vendors-node_modules_gsap_ScrollTrigger_js"), __webpack_require__.e("animationScale")]).then(__webpack_require__.bind(__webpack_require__, /*! ./animationScale */ "./js/animations/animationScale.js")).then(function (module) {
          _this2.AnimationScale = module.default;
          return module.default.name;
        }).catch(function (error) {
          return console.log(error);
        });

        this.promiseList.push(_promise5);
      }

      if (this.animationToActivate.includes('js-draw')) {
        var _promise6 = Promise.all(/*! import() | animationDraw */[__webpack_require__.e("vendors-node_modules_gsap_ScrollTrigger_js"), __webpack_require__.e("vendors-node_modules_deepmerge_dist_cjs_js-node_modules_gsap_DrawSVGPlugin_js"), __webpack_require__.e("animationDraw")]).then(__webpack_require__.bind(__webpack_require__, /*! ./animationDraw */ "./js/animations/animationDraw.js")).then(function (module) {
          _this2.AnimationDraw = module.default;
          return module.default.name;
        }).catch(function (error) {
          return console.log(error);
        });

        this.promiseList.push(_promise6);
      }

      if (this.animationToActivate.includes('js-bg-color')) {
        var _promise7 = Promise.all(/*! import() | animationBgColor */[__webpack_require__.e("vendors-node_modules_gsap_ScrollTrigger_js"), __webpack_require__.e("animationBgColor")]).then(__webpack_require__.bind(__webpack_require__, /*! ./animationBgColor */ "./js/animations/animationBgColor.js")).then(function (module) {
          _this2.AnimationBgColor = module.default;
          return module.default.name;
        }).catch(function (error) {
          return console.log(error);
        });

        this.promiseList.push(_promise7);
      }

      if (this.animationToActivate.includes('js-sprite-images')) {
        var _promise8 = Promise.all(/*! import() | animationSpriteImages */[__webpack_require__.e("vendors-node_modules_gsap_ScrollTrigger_js"), __webpack_require__.e("animationSpriteImages")]).then(__webpack_require__.bind(__webpack_require__, /*! ./animationSpriteImages */ "./js/animations/animationSpriteImages.js")).then(function (module) {
          _this2.AnimationSpriteImages = module.default;
          return module.default.name;
        }).catch(function (error) {
          return console.log(error);
        });

        this.promiseList.push(_promise8);
      }

      if (this.animationToActivate.includes('js-horizontal-scroll')) {
        var _promise9 = Promise.all(/*! import() | animationHorizontalScroll */[__webpack_require__.e("vendors-node_modules_gsap_ScrollTrigger_js"), __webpack_require__.e("animationHorizontalScroll")]).then(__webpack_require__.bind(__webpack_require__, /*! ./animationHorizontalScroll */ "./js/animations/animationHorizontalScroll.js")).then(function (module) {
          _this2.AnimationHorizontalScroll = module.default;
          return module.default.name;
        }).catch(function (error) {
          return console.log(error);
        });

        this.promiseList.push(_promise9);
      }

      if (this.animationToActivate.includes('js-horizontal-scroll-container')) {
        var _promise10 = Promise.all(/*! import() | animationHorizontalScrollContainer */[__webpack_require__.e("vendors-node_modules_gsap_ScrollTrigger_js"), __webpack_require__.e("animationHorizontalScrollContainer")]).then(__webpack_require__.bind(__webpack_require__, /*! ./animationHorizontalScrollContainer */ "./js/animations/animationHorizontalScrollContainer.js")).then(function (module) {
          _this2.AnimationHorizontalScrollContainer = module.default;
          return module.default.name;
        }).catch(function (error) {
          return console.log(error);
        });

        this.promiseList.push(_promise10);
      }

      if (this.animationToActivate.includes('js-horizontal-scroll-section')) {
        var _promise11 = Promise.all(/*! import() | animationHorizontalScrollSection */[__webpack_require__.e("vendors-node_modules_gsap_ScrollTrigger_js"), __webpack_require__.e("animationHorizontalScrollSection")]).then(__webpack_require__.bind(__webpack_require__, /*! ./animationHorizontalScrollSection */ "./js/animations/animationHorizontalScrollSection.js")).then(function (module) {
          _this2.AnimationHorizontalScrollSection = module.default;
          return module.default.name;
        }).catch(function (error) {
          return console.log(error);
        });

        this.promiseList.push(_promise11);
      }

      if (this.animationToActivate.includes('js-parallax')) {
        var _promise12 = Promise.all(/*! import() | animationParallax */[__webpack_require__.e("vendors-node_modules_gsap_ScrollTrigger_js"), __webpack_require__.e("animationParallax")]).then(__webpack_require__.bind(__webpack_require__, /*! ./animationParallax */ "./js/animations/animationParallax.js")).then(function (module) {
          _this2.AnimationParallax = module.default;
          return module.default.name;
        }).catch(function (error) {
          return console.log(error);
        });

        this.promiseList.push(_promise12);
      }

      if (this.animationToActivate.includes('js-video')) {
        var _promise13 = Promise.all(/*! import() | animationVideo */[__webpack_require__.e("vendors-node_modules_gsap_ScrollTrigger_js"), __webpack_require__.e("animationVideo")]).then(__webpack_require__.bind(__webpack_require__, /*! ./animationVideo */ "./js/animations/animationVideo.js")).then(function (module) {
          _this2.AnimationVideo = module.default;
          return module.default.name;
        }).catch(function (error) {
          return console.log(error);
        });

        this.promiseList.push(_promise13);
      }

      if (this.hasCssAnimation) {
        var _promise14 = Promise.all(/*! import() | animationDefault */[__webpack_require__.e("vendors-node_modules_gsap_ScrollTrigger_js"), __webpack_require__.e("animationDefault")]).then(__webpack_require__.bind(__webpack_require__, /*! ./animationDefault */ "./js/animations/animationDefault.js")).then(function (module) {
          _this2.AnimationDefault = module.default;
          return module.default.name;
        }).catch(function (error) {
          return console.log(error);
        });

        this.promiseList.push(_promise14);
      }
    }
    /**
     * Resolve all promises and then fire animation instances
     * @param {*} triggers 
     */

  }, {
    key: "resolveAllPromise",
    value: function resolveAllPromise(triggers) {
      var _this3 = this;

      // Once all promises are resolved
      Promise.all(this.promiseList).then(function (res) {
        // console.log(res);
        _this3.fireAnimations(triggers);
      });
    }
    /**
     * Loop the nodes to activate correct animation
     * @param {*} triggers 
     */

  }, {
    key: "fireAnimations",
    value: function fireAnimations(triggers) {
      var _this4 = this;

      gsap__WEBPACK_IMPORTED_MODULE_1__.gsap.utils.toArray(triggers).forEach(function (element) {
        _this4.getAnimation(element);
      });
    }
    /**
     * Select the correct animation to fire
     * @param {*} element 
     */

  }, {
    key: "getAnimation",
    value: function getAnimation(element) {
      switch (element.dataset.scroll) {
        case 'js-split-text':
          new this.AnimationSplitText(element);
          break;

        case 'js-rotation':
          new this.AnimationRotation(element);
          break;

        case 'js-batch':
          new this.AnimationBatch(element);
          break;

        case 'js-scale':
          new this.AnimationScale(element);
          break;

        case 'js-draw':
          new this.AnimationDraw(element);
          break;

        case 'js-bg-color':
          new this.AnimationBgColor(element);
          break;

        case 'js-pin':
          new this.AnimationPin(element);
          break;

        case 'js-sprite-images':
          new this.AnimationSpriteImages(element);
          break;

        case 'js-horizontal-scroll':
          new this.AnimationHorizontalScroll(element);
          break;

        case 'js-horizontal-scroll-container':
          new this.AnimationHorizontalScrollContainer(element);
          break;

        case 'js-horizontal-scroll-section':
          new this.AnimationHorizontalScrollSection(element);
          break;

        case 'js-comparison':
          new this.AnimationComparison(element);
          break;

        case 'js-parallax':
          new this.AnimationParallax(element);
          break;

        case 'js-video':
          new this.AnimationVideo(element);
          break;

        default:
          new this.AnimationDefault(element);
          break;
      }
    }
  }]);

  return HandleAnimation;
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
//# sourceMappingURL=handleAnimation.bundle.js.map