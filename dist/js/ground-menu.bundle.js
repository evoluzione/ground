"use strict";
(self["webpackChunkground"] = self["webpackChunkground"] || []).push([["ground-menu"],{

/***/ "./js/components/menu.js":
/*!*******************************!*\
  !*** ./js/components/menu.js ***!
  \*******************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ Menu; }
/* harmony export */ });
/* harmony import */ var ismobilejs__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ismobilejs */ "./node_modules/ismobilejs/esm/index.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }



var Menu = /*#__PURE__*/function () {
  /**
   * @param {string} element - Selector
   */
  function Menu(element) {
    var _this = this;

    _classCallCheck(this, Menu);

    _defineProperty(this, "multiLevelMenu", function (item, whichMenu) {
      var subMenu = null;
      var subMenuImage = null;
      item.target.parentNode.childNodes.forEach(function (sub) {
        sub.classList && sub.classList.contains('navigation__sub-menu') ? subMenu = sub : null;
        sub.classList && sub.classList.contains('navigation__image') ? subMenuImage = sub : null;
      });

      if (subMenu && whichMenu) {
        //console.log('multiLevelMenu click');
        // console.log('item', item);
        // console.log('whichMenu', whichMenu);
        // console.log('this.defaults.level', this.defaults.level);
        item.preventDefault();
        item.target.parentElement.classList.add('level' + _this.defaults.level);

        _this.DOM.html.classList.add('is-sub-navigation-open');

        subMenu.classList.add('is-active');
        subMenuImage && subMenuImage.classList.add('is-active');
        _this.defaults.level++;
        var translation = -100 * _this.defaults.level;
        whichMenu.style.cssText += 'transform: translateX(' + translation + '%);';

        _this.DOM.menuBody.scrollTo({
          top: 0,
          left: 0,
          behavior: 'smooth'
        });
      }
    });

    _defineProperty(this, "multiLevelBack", function (whichMenu) {
      //console.log('multiLevelBack');
      //console.log('whichMenu', whichMenu);
      if (_this.defaults.level > 0) {
        _this.defaults.level--;

        _this.DOM.element.forEach(function (item) {
          if (item.classList.contains('level' + _this.defaults.level)) {
            item.classList.remove('level' + _this.defaults.level);
            item.childNodes.forEach(function (t) {
              return t.classList && t.classList.contains('is-active') ? t.classList.remove('is-active') : null;
            });
          }
        });

        var translation = -100 * _this.defaults.level;
        whichMenu.style.cssText += 'transform: translateX(' + translation + '%);';
        _this.defaults.level == 0 ? _this.DOM.html.classList.remove('is-sub-navigation-open') : null;
      }
    });

    this.element = element || '.navigation__item.has-children';
    this.defaults = {
      triggers: this.element,
      level: 0
    };
    this.DOM = {
      element: document.querySelectorAll(this.element),
      html: document.querySelector('html'),
      back: document.querySelectorAll('.js-back'),
      navicon: document.querySelector('.js-navicon'),
      menuBody: document.querySelector('.js-menu-body'),
      menuContainer: document.querySelector('.js-menu-container'),
      closeOverviewPanel: document.querySelector('.js-close-overlay-panel'),
      closePanel: document.querySelector('.js-close-panel'),
      menuPanel: document.querySelector('.js-navigation-panel')
    }; // window.addEventListener('DOMContentLoaded', () => {

    this.init(); // });

    window.addEventListener('resize', function () {
      if (!ismobilejs__WEBPACK_IMPORTED_MODULE_0__["default"].any) {
        if (_this.DOM.menuContainer) _this.DOM.menuContainer.style.cssText += 'transform: none';
        if (_this.DOM.menuPanel) _this.DOM.menuPanel.style.cssText += 'transform: none';

        _this.DOM.html.classList.remove('is-navigation-open');

        _this.DOM.html.classList.remove('is-sub-navigation-open');

        _this.DOM.html.classList.remove('is-overlay-panel-open');

        _this.reset();

        _this.init();
      }
    });
  }

  _createClass(Menu, [{
    key: "reset",
    value: function reset() {
      var _this2 = this;

      var _loop = function _loop(i) {
        _this2.DOM.element.forEach(function (item) {
          if (item.classList.contains('level' + i)) {
            item.classList.remove('level' + i);
            item.childNodes.forEach(function (t) {
              return t.classList && t.classList.contains('is-active') ? t.classList.remove('is-active') : null;
            });
          }
        });
      };

      for (var i = 0; i <= this.defaults.level - 1; i++) {
        _loop(i);
      }

      this.defaults.level = 0;
    } //Gestione dei submenu delle navigation @whichmenu serve per dirgli a quale menu faccio riferimento , @item quale bottone ho cliccato

  }, {
    key: "init",
    value: function init() {
      var _this3 = this;

      if (this.DOM.element.length === 0) {
        return;
      } //Gestione livelli delle navigation


      this.DOM.element.forEach(function (item) {
        //console.log(this.defaults.level, 'primadelclick');
        item.addEventListener('click', function (t) {
          t.stopImmediatePropagation(); //console.log('click');

          if (window.matchMedia('(max-width: 1024px)').matches) {
            //Attivo la transtion sul container dell'header per il mobile
            _this3.multiLevelMenu(t, _this3.DOM.menuContainer);
          } else {
            //Attivo la transtion sul panel-primary per il desk
            if (t.target.parentNode.classList.contains('navigation__item--panel-primary')) {
              _this3.multiLevelMenu(t, _this3.DOM.menuPanel);
            }
          }
        });
      }); //Gestione livelli del back per le navigation

      this.DOM.back.forEach(function (b) {
        b.addEventListener('click', function (t) {
          t.stopImmediatePropagation();

          if (window.matchMedia('(max-width: 1024px)').matches) {
            //Attivo il back transtion sul container dell'header per il mobile
            _this3.multiLevelBack(_this3.DOM.menuContainer);
          } else {
            //Attivo il back transtion sul panel-primary per il desk
            _this3.multiLevelBack(_this3.DOM.menuPanel);
          }
        });
      }); //Attivo l'hover nella navigation header solo del desk

      if (window.matchMedia('(min-width: 1024px)').matches) {
        this.DOM.element.forEach(function (item) {
          var timerHandle = null;
          item.addEventListener('mouseenter', function () {
            clearTimeout(timerHandle);

            _this3.DOM.html.classList.add('is-navigation-hover');

            timerHandle = setTimeout(function () {
              item.classList.add('is-hover');
            }, 200);
          });
          item.addEventListener('mouseleave', function () {
            clearTimeout(timerHandle);

            _this3.DOM.html.classList.remove('is-navigation-hover');

            if (item.classList.contains('is-hover')) {
              timerHandle = setTimeout(function () {
                item.classList.remove('is-hover');
              }, 200);
            }
          });
        });
      } //Se clicco la navicon resetto tutto


      this.DOM.navicon.addEventListener('click', function (t) {
        //console.log('navicon');
        t.stopImmediatePropagation();

        _this3.DOM.html.classList.remove('is-sub-navigation-open');

        _this3.DOM.menuContainer.style.cssText += 'transform: none';
        if (_this3.DOM.menuPanel) _this3.DOM.menuPanel.style.cssText += 'transform: none';

        _this3.DOM.html.classList.remove('is-overlay-panel-open');

        _this3.reset();
      }); //Se clicco il close di navigation panel resetto tutto

      if (this.DOM.closePanel) {
        this.DOM.closePanel.addEventListener('click', function (t) {
          //console.log('closePanel');
          t.stopImmediatePropagation();

          _this3.DOM.html.classList.remove('is-sub-navigation-open');

          _this3.DOM.menuContainer.style.cssText += 'transform: none';
          if (_this3.DOM.menuPanel) _this3.DOM.menuPanel.style.cssText += 'transform: none';

          _this3.DOM.html.classList.remove('is-overlay-panel-open');

          _this3.reset();
        });
      } //Se clicco l'overlay-panel di navigation panel resetto tutto - da fare solo se non sono mobile


      if (!(0,ismobilejs__WEBPACK_IMPORTED_MODULE_0__["default"])().any) {
        if (this.DOM.closeOverviewPanel) {
          this.DOM.closeOverviewPanel.addEventListener('click', function (t) {
            t.stopImmediatePropagation();

            _this3.DOM.html.classList.remove('is-sub-navigation-open');

            _this3.DOM.menuContainer.style.cssText += 'transform: none';
            if (_this3.DOM.menuPanel) _this3.DOM.menuPanel.style.cssText += 'transform: none';

            _this3.DOM.html.classList.remove('is-overlay-panel-open');

            _this3.reset();
          });
        }
      }
    }
  }]);

  return Menu;
}();



/***/ })

}]);
//# sourceMappingURL=ground-menu.bundle.js.map