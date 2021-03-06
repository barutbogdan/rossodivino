/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
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
/******/ 	// identity function for calling harmory imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmory exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		Object.defineProperty(exports, name, {
/******/ 			configurable: false,
/******/ 			enumerable: true,
/******/ 			get: getter
/******/ 		});
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
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports) {

"use strict";
eval("'use strict';\n\n$(document).ready(function () {\n    $('.realisation-products').owlCarousel({\n        margin: 0,\n        nav: true,\n        dots: false,\n        autoplayTimeout: 8000,\n        autoplayHoverPause: false,\n        responsive: {\n            0: {\n                items: 2\n            },\n            450: {\n                items: 3\n            },\n            650: {\n                items: 4\n            },\n            991: {\n                items: 4\n            },\n            1200: {\n                items: 5\n            }\n        }\n    });\n\n    $('.realisation-products-carousel').owlCarousel({\n        items: 1,\n        margin: 0,\n        nav: true,\n        dots: false,\n        autoplayTimeout: 8000,\n        autoplayHoverPause: false,\n        navText: [\"<i class='fas fa-chevron-left'></i>\", \"<i class='fas fa-chevron-right'></i>\"]\n    });\n\n    $('.realisation-products .item a').click(function () {\n        var tab_id = $(this).attr('data-tab');\n\n        $('.realisation-products .item').removeClass('current');\n        $('.tab-content').removeClass('current');\n\n        $(this).parent().addClass('current');\n        $(\"#\" + tab_id).addClass('current');\n    });\n\n    $('.realisation-products .item:first').addClass('current');\n    $('.tab-content:first').addClass('current');\n});//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL3BhZ2VzL3JlYWxpc2F0aW9ucy5qcz9jODJjIl0sInNvdXJjZXNDb250ZW50IjpbIid1c2Ugc3RyaWN0JztcblxuJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24gKCkge1xuICAgICQoJy5yZWFsaXNhdGlvbi1wcm9kdWN0cycpLm93bENhcm91c2VsKHtcbiAgICAgICAgbWFyZ2luOiAwLFxuICAgICAgICBuYXY6IHRydWUsXG4gICAgICAgIGRvdHM6IGZhbHNlLFxuICAgICAgICBhdXRvcGxheVRpbWVvdXQ6IDgwMDAsXG4gICAgICAgIGF1dG9wbGF5SG92ZXJQYXVzZTogZmFsc2UsXG4gICAgICAgIHJlc3BvbnNpdmU6IHtcbiAgICAgICAgICAgIDA6IHtcbiAgICAgICAgICAgICAgICBpdGVtczogMlxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIDQ1MDoge1xuICAgICAgICAgICAgICAgIGl0ZW1zOiAzXG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgNjUwOiB7XG4gICAgICAgICAgICAgICAgaXRlbXM6IDRcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICA5OTE6IHtcbiAgICAgICAgICAgICAgICBpdGVtczogNFxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIDEyMDA6IHtcbiAgICAgICAgICAgICAgICBpdGVtczogNVxuICAgICAgICAgICAgfVxuICAgICAgICB9XG4gICAgfSk7XG5cbiAgICAkKCcucmVhbGlzYXRpb24tcHJvZHVjdHMtY2Fyb3VzZWwnKS5vd2xDYXJvdXNlbCh7XG4gICAgICAgIGl0ZW1zOiAxLFxuICAgICAgICBtYXJnaW46IDAsXG4gICAgICAgIG5hdjogdHJ1ZSxcbiAgICAgICAgZG90czogZmFsc2UsXG4gICAgICAgIGF1dG9wbGF5VGltZW91dDogODAwMCxcbiAgICAgICAgYXV0b3BsYXlIb3ZlclBhdXNlOiBmYWxzZSxcbiAgICAgICAgbmF2VGV4dDogW1wiPGkgY2xhc3M9J2ZhcyBmYS1jaGV2cm9uLWxlZnQnPjwvaT5cIiwgXCI8aSBjbGFzcz0nZmFzIGZhLWNoZXZyb24tcmlnaHQnPjwvaT5cIl1cbiAgICB9KTtcblxuICAgICQoJy5yZWFsaXNhdGlvbi1wcm9kdWN0cyAuaXRlbSBhJykuY2xpY2soZnVuY3Rpb24gKCkge1xuICAgICAgICB2YXIgdGFiX2lkID0gJCh0aGlzKS5hdHRyKCdkYXRhLXRhYicpO1xuXG4gICAgICAgICQoJy5yZWFsaXNhdGlvbi1wcm9kdWN0cyAuaXRlbScpLnJlbW92ZUNsYXNzKCdjdXJyZW50Jyk7XG4gICAgICAgICQoJy50YWItY29udGVudCcpLnJlbW92ZUNsYXNzKCdjdXJyZW50Jyk7XG5cbiAgICAgICAgJCh0aGlzKS5wYXJlbnQoKS5hZGRDbGFzcygnY3VycmVudCcpO1xuICAgICAgICAkKFwiI1wiICsgdGFiX2lkKS5hZGRDbGFzcygnY3VycmVudCcpO1xuICAgIH0pO1xuXG4gICAgJCgnLnJlYWxpc2F0aW9uLXByb2R1Y3RzIC5pdGVtOmZpcnN0JykuYWRkQ2xhc3MoJ2N1cnJlbnQnKTtcbiAgICAkKCcudGFiLWNvbnRlbnQ6Zmlyc3QnKS5hZGRDbGFzcygnY3VycmVudCcpO1xufSk7XG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIHJlc291cmNlcy9hc3NldHMvanMvcGFnZXMvcmVhbGlzYXRpb25zLmpzIl0sIm1hcHBpbmdzIjoiQUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EiLCJzb3VyY2VSb290IjoiIn0=");

/***/ }
/******/ ]);
//# sourceMappingURL=realisations.js.map
