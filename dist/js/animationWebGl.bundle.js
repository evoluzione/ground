"use strict";
(self["webpackChunkground"] = self["webpackChunkground"] || []).push([["animationWebGl"],{

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

/***/ }),

/***/ "./js/webGl/animationWebGl.js":
/*!************************************!*\
  !*** ./js/webGl/animationWebGl.js ***!
  \************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ AnimationWebGl; }
/* harmony export */ });
/* harmony import */ var _utilities_observer__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utilities/observer */ "./js/utilities/observer.js");
/* harmony import */ var _utilities_paths__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../utilities/paths */ "./js/utilities/paths.js");
/* harmony import */ var dat_gui__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! dat.gui */ "./node_modules/dat.gui/build/dat.gui.module.js");
/* harmony import */ var gsap__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! gsap */ "./node_modules/gsap/index.js");
/* harmony import */ var gsap_ScrollTrigger__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! gsap/ScrollTrigger */ "./node_modules/gsap/ScrollTrigger.js");
/* harmony import */ var three__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! three */ "./node_modules/three/build/three.module.js");
/* harmony import */ var three_examples_jsm_controls_OrbitControls_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! three/examples/jsm/controls/OrbitControls.js */ "./node_modules/three/examples/jsm/controls/OrbitControls.js");
/* harmony import */ var three_examples_jsm_loaders_GLTFLoader_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! three/examples/jsm/loaders/GLTFLoader.js */ "./node_modules/three/examples/jsm/loaders/GLTFLoader.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

/* eslint-disable no-unused-vars */


 // Gsap



gsap__WEBPACK_IMPORTED_MODULE_3__.gsap.registerPlugin(gsap_ScrollTrigger__WEBPACK_IMPORTED_MODULE_4__.ScrollTrigger); // Three


 // Loaders

 // import { RectAreaLightHelper } from 'three/examples/jsm/helpers/RectAreaLightHelper.js';

var AnimationWebGl = /*#__PURE__*/function () {
  function AnimationWebGl() {
    _classCallCheck(this, AnimationWebGl);

    this.element = '[data-scroll="js-webgl"]';
    this.DOM = {
      html: document.documentElement,
      body: document.body
    };
    this.options = {
      triggers: this.element
    };
    this.updateEvents = this.updateEvents.bind(this);
    window.addEventListener('DOMContentLoaded', function () {}); // window.addEventListener('LOADER_COMPLETE', () => {

    this.init();
    this.initEvents(this.options.triggers);
    (0,_utilities_observer__WEBPACK_IMPORTED_MODULE_0__.initObserver)(this.options.triggers, this.updateEvents); // });
  }
  /**
   * Init
   */


  _createClass(AnimationWebGl, [{
    key: "init",
    value: function init() {
      this.DOM.element = document.querySelectorAll(this.element);
    }
    /**
     * Initialize events
     * @param {string} triggers - Selectors
     */

  }, {
    key: "initEvents",
    value: function initEvents(triggers) {
      var _this = this;

      gsap__WEBPACK_IMPORTED_MODULE_3__.gsap.utils.toArray(triggers).forEach(function (element) {
        _this.startAnimation(element);
      });
    }
    /**
     * Update events
     * @param {Object} target - New selector
     */

  }, {
    key: "updateEvents",
    value: function updateEvents(target) {
      this.init();
      this.startAnimation(target);
    }
    /**
     *  Start Animation
     */

  }, {
    key: "startAnimation",
    value: function startAnimation(item) {
      var target = item.querySelector('[data-scroll-target]');
      var canvas = item.querySelector('[data-scroll-canvas]');
      var targetScrub = parseInt(item.dataset.scrollScrub, 10);
      var templateUrl = (0,_utilities_paths__WEBPACK_IMPORTED_MODULE_1__.getTemplateUrl)();
      /**
       * Loaders
       */

      var gltfLoader = new three_examples_jsm_loaders_GLTFLoader_js__WEBPACK_IMPORTED_MODULE_6__.GLTFLoader();
      var cubeTextureLoader = new three__WEBPACK_IMPORTED_MODULE_7__.CubeTextureLoader();
      /**
       * Base
       */
      // Debug

      var gui = new dat_gui__WEBPACK_IMPORTED_MODULE_2__.GUI();
      var debugObject = {};
      gui.hide(); // Scene

      var scene = new three__WEBPACK_IMPORTED_MODULE_7__.Scene(); // Sizes

      var sizes = {
        width: window.innerWidth,
        height: window.innerHeight
      };
      window.addEventListener('resize', function () {
        // Update sizes
        sizes.width = window.innerWidth;
        sizes.height = window.innerHeight; // Update camera

        camera.aspect = sizes.width / sizes.height;
        camera.updateProjectionMatrix(); // Update renderer

        renderer.setSize(sizes.width, sizes.height);
        renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
      });
      /**
       * Update all materials
       */

      var sceneWireframe = false;

      var updateAllMaterials = function updateAllMaterials() {
        scene.traverse(function (child) {
          if (child instanceof three__WEBPACK_IMPORTED_MODULE_7__.Mesh && child.material instanceof three__WEBPACK_IMPORTED_MODULE_7__.MeshStandardMaterial) {
            // child.material.envMap = environmentMap
            child.material.envMapIntensity = debugObject.envMapIntensity;
            child.material.needsUpdate = true;
            child.castShadow = true;
            child.receiveShadow = true;
            child.material.wireframe = sceneWireframe; // child.material.depthTest = true
            // child.material.opacity = 0.3;
            // child.material.transparent = true
          }
        });
      };
      /**
       * Environment map
       */


      var environmentMap = cubeTextureLoader.load([templateUrl + '/img/textures/environmentMaps/2/px.jpg', templateUrl + '/img/textures/environmentMaps/2/nx.jpg', templateUrl + '/img/textures/environmentMaps/2/py.jpg', templateUrl + '/img/textures/environmentMaps/2/ny.jpg', templateUrl + '/img/textures/environmentMaps/2/pz.jpg', templateUrl + '/img/textures/environmentMaps/2/nz.jpg']);
      environmentMap.encoding = three__WEBPACK_IMPORTED_MODULE_7__.sRGBEncoding; // scene.background = environmentMap

      scene.environment = environmentMap;
      debugObject.envMapIntensity = 5;
      gui.add(debugObject, 'envMapIntensity').min(0).max(10).step(0.001).onChange(updateAllMaterials);
      var mixer = null;
      /**
       * Models
       */

      gltfLoader.load(templateUrl + '/img/models/iphone_12_pro/scene.gltf', function (gltf) {
        // Animate
        mixer = new three__WEBPACK_IMPORTED_MODULE_7__.AnimationMixer(gltf.scene);

        if (gltf.animations[0]) {
          var action = mixer.clipAction(gltf.animations[0]);
          action.play();
        }

        gltf.scene.scale.set(0.04, 0.04, 0.04);
        gltf.scene.position.set(0, -4, 0);
        gltf.scene.rotation.y = Math.PI * 0.25;
        gltf.scene.rotation.z = Math.PI * 0.2;
        scene.add(gltf.scene);
        gui.add(gltf.scene.rotation, 'y').min(-Math.PI).max(Math.PI).step(0.001).name('rotation Y');
        gui.add(gltf.scene.rotation, 'z').min(-Math.PI).max(Math.PI).step(0.001).name('rotation Z');
        updateAllMaterials();
        scrollAnimate(gltf.scene);
      });
      /**
       * Lights
       */

      var directionalLight = new three__WEBPACK_IMPORTED_MODULE_7__.DirectionalLight('#ffffff', 3);
      directionalLight.position.set(0.25, 3, -2.25);
      directionalLight.castShadow = true;
      directionalLight.shadow.camera.far = 15;
      directionalLight.shadow.mapSize.set(1024, 1024);
      scene.add(directionalLight); // const directionalLightCameraHelper = new CameraHelper(directionalLight.shadow.camera)
      // scene.add(directionalLightCameraHelper)

      gui.add(directionalLight, 'intensity').min(0).max(10).step(0.001).name('lightIntensity');
      gui.add(directionalLight.position, 'x').min(-5).max(5).step(0.001).name('lightX');
      gui.add(directionalLight.position, 'y').min(-5).max(5).step(0.001).name('lightY');
      gui.add(directionalLight.position, 'z').min(-5).max(5).step(0.001).name('lightZ');
      /**
       * Objects
       */
      // Material

      var material = new three__WEBPACK_IMPORTED_MODULE_7__.MeshStandardMaterial();
      material.roughness = 0.4;
      material.wireframe = false;
      var cube = new three__WEBPACK_IMPORTED_MODULE_7__.Mesh(new three__WEBPACK_IMPORTED_MODULE_7__.BoxGeometry(2, 2, 2), material);
      cube.receiveShadow = true;
      cube.wireframe = true;
      scene.add(cube); // Debug
      // gui.add(cube.rotation, 'x').min(0).max(100).step(1).name('Cube Rotation')

      gui.add(cube, 'visible');
      gui.add(material, 'wireframe');
      gui.addColor;
      /**
       * Camera
       */
      // Base camera

      var camera = new three__WEBPACK_IMPORTED_MODULE_7__.PerspectiveCamera(75, sizes.width / sizes.height, 0.1, 100);
      camera.position.set(4, 1, -4);
      scene.add(camera); //Orbit Controls

      var controls = new three_examples_jsm_controls_OrbitControls_js__WEBPACK_IMPORTED_MODULE_5__.OrbitControls(camera, canvas);
      controls.enableDamping = true;
      controls.enableZoom = false;
      controls.enablePan = false;
      controls.autoRotate = false;
      controls.enabled = true;
      /**
       * Renderer
       */

      var renderer = new three__WEBPACK_IMPORTED_MODULE_7__.WebGLRenderer({
        canvas: canvas,
        // alpha: true,
        antialias: true
      });
      renderer.setSize(sizes.width, sizes.height);
      renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
      renderer.physicallyCorrectLights = true;
      renderer.outputEncoding = three__WEBPACK_IMPORTED_MODULE_7__.sRGBEncoding;
      renderer.toneMapping = three__WEBPACK_IMPORTED_MODULE_7__.ACESFilmicToneMapping;
      renderer.toneMappingExposure = 3;
      renderer.shadowMap.enabled = true;
      renderer.shadowMap.type = three__WEBPACK_IMPORTED_MODULE_7__.PCFSoftShadowMap;
      gui.add(renderer, 'toneMapping', {
        No: three__WEBPACK_IMPORTED_MODULE_7__.NoToneMapping,
        Linear: three__WEBPACK_IMPORTED_MODULE_7__.LinearToneMapping,
        Reinhard: three__WEBPACK_IMPORTED_MODULE_7__.ReinhardToneMapping,
        Cineon: three__WEBPACK_IMPORTED_MODULE_7__.CineonToneMapping,
        ACESFilmic: three__WEBPACK_IMPORTED_MODULE_7__.ACESFilmicToneMapping
      }).onFinishChange(function () {
        renderer.toneMapping = Number(renderer.toneMapping);
        updateAllMaterials();
      });
      gui.add(renderer, 'toneMappingExposure').min(0).max(10).step(0.001);
      /**
       * Animate
       */

      var clock = new three__WEBPACK_IMPORTED_MODULE_7__.Clock();
      var previousTime = 0;

      var tick = function tick() {
        var elapsedTime = clock.getElapsedTime();
        var deltaTime = elapsedTime - previousTime;
        previousTime = elapsedTime; // Update controls

        controls.update(); //Update mixer

        if (mixer) {
          mixer.update(deltaTime);
        } // Render


        renderer.render(scene, camera); // Call tick again on the next frame

        window.requestAnimationFrame(tick);
      };

      tick(); // console.log(scene.children)
      // console.log(scene.children.PerspectiveCamera)

      var tl = gsap__WEBPACK_IMPORTED_MODULE_3__.gsap.timeline({
        scrollTrigger: {
          trigger: target,
          start: 'center center',
          end: '+=200%',
          scrub: targetScrub || false,
          pin: true,
          toggleActions: 'play none play reverse'
        }
      });

      var scrollAnimate = function scrollAnimate(model) {
        tl.from(cube.rotation, {
          z: 4
        }) // .from(camera.position, { y: 4, x: 4 })
        .from(model.rotation, {
          x: 0,
          y: -0.4,
          z: 0
        });
      };
    }
  }]);

  return AnimationWebGl;
}();



/***/ })

}]);
//# sourceMappingURL=animationWebGl.bundle.js.map