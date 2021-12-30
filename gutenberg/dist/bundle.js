!function(){var r={184:function(e,t){var r;
/*!
  Copyright (c) 2018 Jed Watson.
  Licensed under the MIT License (MIT), see
  http://jedwatson.github.io/classnames
*/
!function(){"use strict";var c={}.hasOwnProperty;function s(){for(var e=[],t=0;t<arguments.length;t++){var r=arguments[t];if(r){var n,a=typeof r;if("string"==a||"number"==a)e.push(r);else if(Array.isArray(r))!r.length||(n=s.apply(null,r))&&e.push(n);else if("object"==a)if(r.toString===Object.prototype.toString)for(var l in r)c.call(r,l)&&r[l]&&e.push(l);else e.push(r.toString())}}return e.join(" ")}e.exports?e.exports=s.default=s:void 0===(r=function(){return s}.apply(t,[]))||(e.exports=r)}()}},n={};function v(e){var t=n[e];if(void 0!==t)return t.exports;t=n[e]={exports:{}};return r[e](t,t.exports,v),t.exports}v.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return v.d(t,{a:t}),t},v.d=function(e,t){for(var r in t)v.o(t,r)&&!v.o(e,r)&&Object.defineProperty(e,r,{enumerable:!0,get:t[r]})},v.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)};!function(){"use strict";var e=v(184),l=v.n(e);function a(e,t){for(var r=0;r<t.length;r++){var n=t[r];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}var i=wp.i18n.__,c=wp.hooks.addFilter,u=wp.element.Fragment,e=wp.editor,p=e.InspectorControls,s=e.InspectorAdvancedControls,d=wp.compose.createHigherOrderComponent,e=wp.components,o=e.ToggleControl,m=e.SelectControl,f=e.PanelBody,g=e.PanelRow,e=new(function(){function e(){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e)}var t,r,n;return t=e,(r=[{key:"registerFullscreen",value:function(){var e=d(function(l){return function(e){e.name;var t=e.attributes,r=e.setAttributes,n=e.isSelected,a=t.fullscreen;return React.createElement(u,null,React.createElement(l,e),n&&React.createElement(s,null,React.createElement(o,{label:i("Full screen"),checked:!!a,onChange:function(){return r({fullscreen:!a})},help:i(a?"The block is fullscreen.":"The block is boxed.")})))}},"withAdvancedControls");wp.hooks.addFilter("blocks.registerBlockType","ground/custom-attributes",function(e){return void 0!==e.attributes&&(e.attributes=Object.assign(e.attributes,{fullscreen:{type:"boolean",default:!1}})),e}),c("editor.BlockEdit","ground/custom-advanced-control",e),c("blocks.getSaveContent.extraProps","ground/applyExtraClass",function(e,t,r){return void 0!==(r=r.fullscreen)&&r&&(e.className=l()(e.className,"fullscreen")),e})}},{key:"registerSpacerVariation",value:function(){var o=["core/spacer"];var e=d(function(s){return function(e){var t=e.name,r=e.attributes,n=e.setAttributes,a=e.isSelected,l=r.sizeSmall,c=r.sizeMedium,r=r.sizeLarge;if(!o.includes(t))return React.createElement(s,e);t=["0","1","2","3","4","5","6"].map(function(e){return{label:e,value:e}});return n({sizeSmall:l||"1"}),n({sizeMedium:c||"3"}),n({sizeLarge:r||"5"}),React.createElement(u,null,React.createElement(s,e),a&&React.createElement(p,null,React.createElement(f,{title:i("Size (rem)","ground"),initialOpen:!0},React.createElement(g,null,React.createElement("fieldset",null,React.createElement(m,{label:"Small",value:l,options:t,onChange:function(e){return n({sizeSmall:e})}}))),React.createElement(g,null,React.createElement("fieldset",null,React.createElement(m,{label:"Medium",value:c,options:t,onChange:function(e){return n({sizeMedium:e})}}))),React.createElement(g,null,React.createElement("fieldset",null,React.createElement(m,{label:"Large",value:r,options:t,onChange:function(e){return n({sizeLarge:e})}}))))))}},"withAdvancedControls");wp.hooks.addFilter("blocks.registerBlockType","ground/spacer/custom-attributes",function(e){return void 0!==e.attributes&&o.includes(e.name)&&(e.attributes=Object.assign(e.attributes,{sizeSmall:{type:"string"},sizeMedium:{type:"string"},sizeLarge:{type:"string"}})),e}),c("editor.BlockEdit","ground/spacer/custom-advanced-control",e),c("blocks.getSaveContent.extraProps","ground/spacer/applyExtraClass",function(e,t,r){if(!o.includes(t.name))return e;var n=r.sizeSmall,t=r.sizeMedium,r=r.sizeLarge;function a(e,t){return{sm:["spacer-0","spacer-1","spacer-2","spacer-3","spacer-4","spacer-5","spacer-6"],md:["spacer-md-0","spacer-md-1","spacer-md-2","spacer-md-3","spacer-md-4","spacer-md-5","spacer-md-6"],lg:["spacer-lg-0","spacer-lg-1","spacer-lg-2","spacer-lg-3","spacer-lg-4","spacer-lg-5","spacer-lg-6"]}[e][t]||""}return void 0!==n&&"0"!==n&&(e.className=l()(e.className,a("sm",n))),void 0!==t&&"0"!==t&&(e.className=l()(e.className,a("md",t))),void 0!==r&&"0"!==r&&(e.className=l()(e.className,a("lg",r))),e})}}])&&a(t.prototype,r),n&&a(t,n),e}());e.registerFullscreen(),e.registerSpacerVariation()}()}();