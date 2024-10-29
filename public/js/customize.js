/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/customize.js":
/*!******************************************!*\
  !*** ./resources/assets/js/customize.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function ($) {
  wp.customize('aw_offcanvas_background_color_setting', function (value) {
    value.bind(function (newval) {
      jQuery('#offcanvas_container').css({
        'background-color': newval
      });
      jQuery('#offcanvas_menu_inner > li.menu-item > ul > li.menu-item > ul').css({
        'background-color': newval
      });
    });
  });
  wp.customize('aw_offcanvas_border_right_color_setting', function (value) {
    value.bind(function (newval) {
      jQuery('#offcanvas_container .ps__rail-y').css({
        'background-color': newval
      });
    });
  });
  wp.customize('aw_offcanvas_border_color_setting', function (value) {
    value.bind(function (newval) {
      jQuery('#offcanvas_container li.menu-item').children('a').css({
        'border-bottom-color': newval
      });
      jQuery('#offcanvas_container .close-sidebar-inner').css({
        'border-bottom-color': newval
      });
    });
  });
  wp.customize('aw_offcanvas_font_color_setting', function (value) {
    value.bind(function (newval) {
      jQuery('#offcanvas_container li.menu-item').children('a').css({
        'color': newval
      });
      jQuery('#offcanvas_container .close-sidebar-inner').children('span').eq(0).css({
        color: newval
      });
    });
  });
  wp.customize('aw_offcanvas_open_font_setting', function (value) {
    value.bind(function (newval) {
      jQuery('#offcanvas_container li.menu-item.visible').children('a').css({
        'color': newval
      });
    });
  });
  wp.customize('aw_offcanvas_open_background_setting', function (value) {
    value.bind(function (newval) {
      jQuery('#offcanvas_container li.menu-item.visible').children('a').css({
        'background-color': newval
      });
    });
  });
  wp.customize('aw_offcanvas_close_background_setting', function (value) {
    value.bind(function (newval) {
      jQuery('#offcanvas_container .close-sidebar-inner').css({
        'background-color': newval
      });
    });
  });
  wp.customize('aw_offcanvas_close_color_setting', function (value) {
    value.bind(function (newval) {
      jQuery('#offcanvas_container .close-sidebar-inner span').css({
        'color': newval
      });
      jQuery('#offcanvas_container .close-sidebar-inner .fa').css({
        'color': newval
      });

      if (document.getElementById('aw-offcanvas-close-style')) {
        document.getElementById('aw-offcanvas-close-style').remove();
      }

      var css = document.createElement("style");
      css.setAttribute('id', 'aw-offcanvas-close-style');
      css.type = "text/css";
      css.innerHTML = "#offcanvas_container .close-sidebar-inner .fa:before { background-color: " + newval + " } #offcanvas_container .close-sidebar-inner .fa:after { background-color: " + newval + " }";
      document.body.appendChild(css);
    });
  });
})(jQuery);

/***/ }),

/***/ 1:
/*!************************************************!*\
  !*** multi ./resources/assets/js/customize.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/werbeagenturaweos/www/wordpressPlugins/aweos-offcanvas-menu/trunk/resources/assets/js/customize.js */"./resources/assets/js/customize.js");


/***/ })

/******/ });