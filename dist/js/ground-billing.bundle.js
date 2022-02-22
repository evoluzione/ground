"use strict";
(self["webpackChunkground"] = self["webpackChunkground"] || []).push([["ground-billing"],{

/***/ "./js/components/billing.js":
/*!**********************************!*\
  !*** ./js/components/billing.js ***!
  \**********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ Billing; }
/* harmony export */ });
/* harmony import */ var imagesloaded__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! imagesloaded */ "./node_modules/imagesloaded/imagesloaded.js");
/* harmony import */ var imagesloaded__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(imagesloaded__WEBPACK_IMPORTED_MODULE_0__);
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }



var Billing = /*#__PURE__*/function () {
  function Billing() {
    var _this = this;

    _classCallCheck(this, Billing);

    this.DOM = {
      html: document.documentElement,
      body: document.body,
      element: document.querySelector('.woocommerce-cart'),
      billingMethod: document.querySelector('#billing_customer_type')
    };
    imagesloaded__WEBPACK_IMPORTED_MODULE_0___default()(this.DOM.body, {
      background: true
    }, function () {
      _this.init();
    });
  }

  _createClass(Billing, [{
    key: "init",
    value: function init() {
      var _this2 = this;

      var billingCheckbox = document.getElementById('billing_invoice');

      if (!billingCheckbox) {
        return;
      }

      if (billingCheckbox.checked === true) {
        this.toggleBillingField(this.DOM.billingMethod.value, true);
      } else {
        this.toggleBillingField('', false);
      }

      billingCheckbox.addEventListener('input', function (event) {
        if (event.target.checked === true) {
          _this2.toggleBillingField(_this2.DOM.billingMethod.value, true);
        } else {
          _this2.toggleBillingField(_this2.DOM.billingMethod.value, false);
        }
      });
      this.DOM.billingMethod.addEventListener('change', function () {
        _this2.toggleBillingField(_this2.DOM.billingMethod.value, true);
      });
    }
  }, {
    key: "toggleBillingField",
    value: function toggleBillingField(billingMethod, show) {
      if (show) {
        document.querySelector('#billing_customer_type_field').style.display = 'inherit';
        document.querySelector('#billing_company_field').style.display = 'inherit';
        document.querySelector('#billing_vat_field').style.display = 'inherit';
        document.querySelector('#billing_fiscal_code_field').style.display = 'inherit';
        document.querySelector('#billing_pec_field').style.display = 'inherit';
        document.querySelector('#billing_sdi_field').style.display = 'inherit';

        if (billingMethod === 'privato') {
          document.querySelector('#billing_company_field').style.display = 'none';
          document.querySelector('#billing_vat_field').style.display = 'none'; // document.querySelector('#billing_fiscal_code_field').style.display = 'none';

          document.querySelector('#billing_pec_field').style.display = 'none';
          document.querySelector('#billing_sdi_field').style.display = 'none';
        }
      } else {
        document.querySelector('#billing_customer_type_field').style.display = 'none';
        document.querySelector('#billing_company_field').style.display = 'none';
        document.querySelector('#billing_vat_field').style.display = 'none';
        document.querySelector('#billing_fiscal_code_field').style.display = 'none';
        document.querySelector('#billing_pec_field').style.display = 'none';
        document.querySelector('#billing_sdi_field').style.display = 'none';
      }
    }
  }]);

  return Billing;
}();



/***/ })

}]);
//# sourceMappingURL=ground-billing.bundle.js.map