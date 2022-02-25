!function(){var l=[function(e,t){var l;
/*!
  Copyright (c) 2018 Jed Watson.
  Licensed under the MIT License (MIT), see
  http://jedwatson.github.io/classnames
*/
!function(){"use strict";var o={}.hasOwnProperty;function i(){for(var e=[],t=0;t<arguments.length;t++){var l=arguments[t];if(l){var a,r=typeof l;if("string"==r||"number"==r)e.push(l);else if(Array.isArray(l))!l.length||(a=i.apply(null,l))&&e.push(a);else if("object"==r)if(l.toString===Object.prototype.toString)for(var n in l)o.call(l,n)&&l[n]&&e.push(n);else e.push(l.toString())}}return e.join(" ")}e.exports?e.exports=i.default=i:void 0===(l=function(){return i}.apply(t,[]))||(e.exports=l)}()}],a={};function b(e){var t=a[e];if(void 0!==t)return t.exports;t=a[e]={exports:{}};return l[e](t,t.exports,b),t.exports}b.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return b.d(t,{a:t}),t},b.d=function(e,t){for(var l in t)b.o(t,l)&&!b.o(e,l)&&Object.defineProperty(e,l,{enumerable:!0,get:t[l]})},b.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)};!function(){"use strict";var e=b(0),r=b.n(e);function n(e,t){for(var l=0;l<t.length;l++){var a=t[l];a.enumerable=a.enumerable||!1,a.configurable=!0,"value"in a&&(a.writable=!0),Object.defineProperty(e,a.key,a)}}var c=wp.i18n.__,o=wp.hooks.addFilter,s=wp.element.Fragment,i=wp.compose.createHigherOrderComponent,e=wp.components,u=e.ToggleControl,d=e.SelectControl,p=e.PanelBody,m=e.PanelRow,e=wp.blockEditor,v=e.InspectorAdvancedControls,f=e.InspectorControls,e=new(function(){function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e)}var t,l,a;return t=e,(l=[{key:"registerFullscreen",value:function(){var e=i(function(n){return function(e){e.name;var t=e.attributes,l=e.setAttributes,a=e.isSelected,r=t.fullscreen;return React.createElement(s,null,React.createElement(n,e),a&&React.createElement(v,null,React.createElement(u,{label:c("Full screen"),checked:!!r,onChange:function(){return l({fullscreen:!r})},help:c(r?"The block is fullscreen.":"The block is boxed.")})))}},"withAdvancedControls");wp.hooks.addFilter("blocks.registerBlockType","ground/custom-attributes",function(e,t){return void 0===e.attributes||t.includes("woocommerce")||(e.attributes=Object.assign(e.attributes,{fullscreen:{type:"boolean",default:!1}})),e}),o("editor.BlockEdit","ground/custom-advanced-control",e),o("blocks.getSaveContent.extraProps","ground/applyExtraClass",function(e,t,l){return void 0!==(l=l.fullscreen)&&l&&(e.className=r()(e.className,"fullscreen")),e})}},{key:"registerSpacerVariation",value:function(){var u=["core/spacer"];var e=i(function(i){return function(e){var t=e.name,l=e.attributes,a=e.setAttributes,r=e.isSelected,n=l.sizeSmall,o=l.sizeMedium,l=l.sizeLarge;if(!u.includes(t))return React.createElement(i,e);return a({sizeSmall:n||"!h-3"}),a({sizeMedium:o||"md:!h-6"}),a({sizeLarge:l||"lg:!h-12"}),React.createElement(s,null,React.createElement(i,e),r&&React.createElement(f,null,React.createElement(p,{title:c("Size","ground"),initialOpen:!0},React.createElement(m,null,React.createElement("fieldset",null,React.createElement(d,{label:"Small",value:n,options:[{label:"Disattivato",value:"0"},{label:"3",value:"!h-3"},{label:"6",value:"!h-6"},{label:"12",value:"!h-12"},{label:"24",value:"!h-24"},{label:"48",value:"!h-48"}],onChange:function(e){return a({sizeSmall:e})}}))),React.createElement(m,null,React.createElement("fieldset",null,React.createElement(d,{label:"Medium",value:o,options:[{label:"Disattivato",value:"0"},{label:"3",value:"md:!h-3"},{label:"6",value:"md:!h-6"},{label:"12",value:"md:!h-12"},{label:"24",value:"md:!h-24"},{label:"48",value:"md:!h-48"}],onChange:function(e){return a({sizeMedium:e})}}))),React.createElement(m,null,React.createElement("fieldset",null,React.createElement(d,{label:"Large",value:l,options:[{label:"Disattivato",value:"0"},{label:"3",value:"lg:!h-3"},{label:"6",value:"lg:!h-6"},{label:"12",value:"lg:!h-12"},{label:"24",value:"lg:!h-24"},{label:"48",value:"lg:!h-48"}],onChange:function(e){return a({sizeLarge:e})}}))))))}},"withAdvancedControls");wp.hooks.addFilter("blocks.registerBlockType","ground/spacer/custom-attributes",function(e){return void 0!==e.attributes&&u.includes(e.name)&&(e.attributes=Object.assign(e.attributes,{sizeSmall:{type:"string"},sizeMedium:{type:"string"},sizeLarge:{type:"string"}})),e}),o("editor.BlockEdit","ground/spacer/custom-advanced-control",e),o("blocks.getSaveContent.extraProps","ground/spacer/applyExtraClass",function(e,t,l){if(!u.includes(t.name))return e;var a=l.sizeSmall,t=l.sizeMedium,l=l.sizeLarge;return void 0!==a&&"0"!==a&&(e.className=r()(e.className,a)),void 0!==t&&"0"!==t&&(e.className=r()(e.className,t)),void 0!==l&&"0"!==l&&(e.className=r()(e.className,l)),e})}}])&&n(t.prototype,l),a&&n(t,a),Object.defineProperty(t,"prototype",{writable:!1}),e}());e.registerFullscreen(),e.registerSpacerVariation()}()}();