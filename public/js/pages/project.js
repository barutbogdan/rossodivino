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
eval("'use strict';\n\n$(document).ready(function () {\n\n\t$('.project-slider').owlCarousel({\n\t\tloop: true,\n\t\tmargin: 0,\n\t\tnav: false,\n\t\tautoplay: true,\n\t\tdots: false,\n\t\tautoplayTimeout: 8000,\n\t\tautoplayHoverPause: false,\n\t\tanimateOut: 'fadeOut',\n\t\tanimateIn: 'fadeIn',\n\t\tnavText: [\"<i class='fas fa-arrow-left'></i>\", \"<i class='fas fa-arrow-right'></i>\"],\n\t\tresponsive: {\n\t\t\t0: {\n\t\t\t\titems: 1\n\t\t\t},\n\t\t\t600: {\n\t\t\t\titems: 1\n\t\t\t},\n\t\t\t1000: {\n\t\t\t\titems: 1\n\t\t\t}\n\t\t}\n\t});\n});//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL3BhZ2VzL3Byb2plY3QuanM/YjNmOSJdLCJzb3VyY2VzQ29udGVudCI6WyIndXNlIHN0cmljdCc7XG5cbiQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uICgpIHtcblxuXHQkKCcucHJvamVjdC1zbGlkZXInKS5vd2xDYXJvdXNlbCh7XG5cdFx0bG9vcDogdHJ1ZSxcblx0XHRtYXJnaW46IDAsXG5cdFx0bmF2OiBmYWxzZSxcblx0XHRhdXRvcGxheTogdHJ1ZSxcblx0XHRkb3RzOiBmYWxzZSxcblx0XHRhdXRvcGxheVRpbWVvdXQ6IDgwMDAsXG5cdFx0YXV0b3BsYXlIb3ZlclBhdXNlOiBmYWxzZSxcblx0XHRhbmltYXRlT3V0OiAnZmFkZU91dCcsXG5cdFx0YW5pbWF0ZUluOiAnZmFkZUluJyxcblx0XHRuYXZUZXh0OiBbXCI8aSBjbGFzcz0nZmFzIGZhLWFycm93LWxlZnQnPjwvaT5cIiwgXCI8aSBjbGFzcz0nZmFzIGZhLWFycm93LXJpZ2h0Jz48L2k+XCJdLFxuXHRcdHJlc3BvbnNpdmU6IHtcblx0XHRcdDA6IHtcblx0XHRcdFx0aXRlbXM6IDFcblx0XHRcdH0sXG5cdFx0XHQ2MDA6IHtcblx0XHRcdFx0aXRlbXM6IDFcblx0XHRcdH0sXG5cdFx0XHQxMDAwOiB7XG5cdFx0XHRcdGl0ZW1zOiAxXG5cdFx0XHR9XG5cdFx0fVxuXHR9KTtcbn0pO1xuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyByZXNvdXJjZXMvYXNzZXRzL2pzL3BhZ2VzL3Byb2plY3QuanMiXSwibWFwcGluZ3MiOiJBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBIiwic291cmNlUm9vdCI6IiJ9");

/***/ }
/******/ ]);
//# sourceMappingURL=project.js.map
