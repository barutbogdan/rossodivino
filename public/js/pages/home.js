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
eval("'use strict';\n\n$(document).ready(function () {\n\n\t$('.hero-slider').on('initialized.owl.carousel', function () {\n\t\t$('.hero .before-slider').addClass('n');\n\t\t$('.hero .hero-slider').removeClass('n');\n\t}).owlCarousel({\n\t\tloop: true,\n\t\tmargin: 0,\n\t\tnav: true,\n\t\tautoplay: true,\n\t\tdots: false,\n\t\tautoplayTimeout: 8000,\n\t\tautoplayHoverPause: false,\n\t\tanimateOut: 'fadeOut',\n\t\tanimateIn: 'fadeIn',\n\t\tnavText: [\"<i class='fas fa-arrow-left'></i>\", \"<i class='fas fa-arrow-right'></i>\"],\n\t\tresponsive: {\n\t\t\t0: {\n\t\t\t\titems: 1\n\t\t\t},\n\t\t\t600: {\n\t\t\t\titems: 1\n\t\t\t},\n\t\t\t1000: {\n\t\t\t\titems: 1\n\t\t\t}\n\t\t}\n\t});\n\n\t$('.home-products').owlCarousel({\n\t\tloop: true,\n\t\tmargin: 0,\n\t\tnav: true,\n\t\tautoplay: true,\n\t\tdots: false,\n\t\tautoplayTimeout: 8000,\n\t\tautoplayHoverPause: false,\n\t\tresponsive: {\n\t\t\t0: {\n\t\t\t\titems: 2\n\t\t\t},\n\t\t\t450: {\n\t\t\t\titems: 3\n\t\t\t},\n\t\t\t991: {\n\t\t\t\titems: 3\n\t\t\t},\n\t\t\t1200: {\n\t\t\t\titems: 4\n\t\t\t}\n\t\t}\n\t});\n\t$('.articles-slider').owlCarousel({\n\t\tloop: true,\n\t\tmargin: 8,\n\t\tnav: true,\n\t\tautoplay: true,\n\t\tdots: false,\n\t\tautoplayTimeout: 8000,\n\t\tautoplayHoverPause: false,\n\t\tnavText: [\"<i class='fas fa-chevron-left'></i>\", \"<i class='fas fa-chevron-right'></i>\"],\n\t\tresponsive: {\n\t\t\t0: {\n\t\t\t\titems: 1\n\t\t\t},\n\t\t\t550: {\n\t\t\t\titems: 2\n\t\t\t},\n\t\t\t991: {\n\t\t\t\titems: 3\n\t\t\t},\n\t\t\t1200: {\n\t\t\t\titems: 3\n\t\t\t}\n\t\t}\n\t});\n\n\t$(window).on('scroll', function () {\n\t\tvar header = $('header #header').outerHeight();\n\t\tvar slider = $('.hero').outerHeight();\n\t\tvar about = $('.about-us').outerHeight();\n\t\tvar contact = $('.small-contact').outerHeight();\n\t\tvar services = $('.services-section').outerHeight();\n\t\tvar testimonials = $('.testimonials-area').outerHeight();\n\t\tvar scroll = $(window).scrollTop();\n\t\tif (scroll > header + slider + about + contact + services + testimonials + 100) {\n\t\t\tconsole.log('test');\n\t\t\t$('.fact-section .fact').each(function (index, value) {\n\t\t\t\tvar limit = parseInt($(value).find('h2').attr('data-limit'));\n\t\t\t\tsetInterval(function () {\n\t\t\t\t\tvar v = $(value).find('h2').text();\n\t\t\t\t\tif (v < limit) {\n\t\t\t\t\t\t$(value).find('h2').text(parseInt(v) + 1);\n\t\t\t\t\t}\n\t\t\t\t}, 300);\n\t\t\t});\n\t\t}\n\t});\n});//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL3BhZ2VzL2hvbWUuanM/M2E1ZCJdLCJzb3VyY2VzQ29udGVudCI6WyIndXNlIHN0cmljdCc7XG5cbiQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uICgpIHtcblxuXHQkKCcuaGVyby1zbGlkZXInKS5vbignaW5pdGlhbGl6ZWQub3dsLmNhcm91c2VsJywgZnVuY3Rpb24gKCkge1xuXHRcdCQoJy5oZXJvIC5iZWZvcmUtc2xpZGVyJykuYWRkQ2xhc3MoJ24nKTtcblx0XHQkKCcuaGVybyAuaGVyby1zbGlkZXInKS5yZW1vdmVDbGFzcygnbicpO1xuXHR9KS5vd2xDYXJvdXNlbCh7XG5cdFx0bG9vcDogdHJ1ZSxcblx0XHRtYXJnaW46IDAsXG5cdFx0bmF2OiB0cnVlLFxuXHRcdGF1dG9wbGF5OiB0cnVlLFxuXHRcdGRvdHM6IGZhbHNlLFxuXHRcdGF1dG9wbGF5VGltZW91dDogODAwMCxcblx0XHRhdXRvcGxheUhvdmVyUGF1c2U6IGZhbHNlLFxuXHRcdGFuaW1hdGVPdXQ6ICdmYWRlT3V0Jyxcblx0XHRhbmltYXRlSW46ICdmYWRlSW4nLFxuXHRcdG5hdlRleHQ6IFtcIjxpIGNsYXNzPSdmYXMgZmEtYXJyb3ctbGVmdCc+PC9pPlwiLCBcIjxpIGNsYXNzPSdmYXMgZmEtYXJyb3ctcmlnaHQnPjwvaT5cIl0sXG5cdFx0cmVzcG9uc2l2ZToge1xuXHRcdFx0MDoge1xuXHRcdFx0XHRpdGVtczogMVxuXHRcdFx0fSxcblx0XHRcdDYwMDoge1xuXHRcdFx0XHRpdGVtczogMVxuXHRcdFx0fSxcblx0XHRcdDEwMDA6IHtcblx0XHRcdFx0aXRlbXM6IDFcblx0XHRcdH1cblx0XHR9XG5cdH0pO1xuXG5cdCQoJy5ob21lLXByb2R1Y3RzJykub3dsQ2Fyb3VzZWwoe1xuXHRcdGxvb3A6IHRydWUsXG5cdFx0bWFyZ2luOiAwLFxuXHRcdG5hdjogdHJ1ZSxcblx0XHRhdXRvcGxheTogdHJ1ZSxcblx0XHRkb3RzOiBmYWxzZSxcblx0XHRhdXRvcGxheVRpbWVvdXQ6IDgwMDAsXG5cdFx0YXV0b3BsYXlIb3ZlclBhdXNlOiBmYWxzZSxcblx0XHRyZXNwb25zaXZlOiB7XG5cdFx0XHQwOiB7XG5cdFx0XHRcdGl0ZW1zOiAyXG5cdFx0XHR9LFxuXHRcdFx0NDUwOiB7XG5cdFx0XHRcdGl0ZW1zOiAzXG5cdFx0XHR9LFxuXHRcdFx0OTkxOiB7XG5cdFx0XHRcdGl0ZW1zOiAzXG5cdFx0XHR9LFxuXHRcdFx0MTIwMDoge1xuXHRcdFx0XHRpdGVtczogNFxuXHRcdFx0fVxuXHRcdH1cblx0fSk7XG5cdCQoJy5hcnRpY2xlcy1zbGlkZXInKS5vd2xDYXJvdXNlbCh7XG5cdFx0bG9vcDogdHJ1ZSxcblx0XHRtYXJnaW46IDgsXG5cdFx0bmF2OiB0cnVlLFxuXHRcdGF1dG9wbGF5OiB0cnVlLFxuXHRcdGRvdHM6IGZhbHNlLFxuXHRcdGF1dG9wbGF5VGltZW91dDogODAwMCxcblx0XHRhdXRvcGxheUhvdmVyUGF1c2U6IGZhbHNlLFxuXHRcdG5hdlRleHQ6IFtcIjxpIGNsYXNzPSdmYXMgZmEtY2hldnJvbi1sZWZ0Jz48L2k+XCIsIFwiPGkgY2xhc3M9J2ZhcyBmYS1jaGV2cm9uLXJpZ2h0Jz48L2k+XCJdLFxuXHRcdHJlc3BvbnNpdmU6IHtcblx0XHRcdDA6IHtcblx0XHRcdFx0aXRlbXM6IDFcblx0XHRcdH0sXG5cdFx0XHQ1NTA6IHtcblx0XHRcdFx0aXRlbXM6IDJcblx0XHRcdH0sXG5cdFx0XHQ5OTE6IHtcblx0XHRcdFx0aXRlbXM6IDNcblx0XHRcdH0sXG5cdFx0XHQxMjAwOiB7XG5cdFx0XHRcdGl0ZW1zOiAzXG5cdFx0XHR9XG5cdFx0fVxuXHR9KTtcblxuXHQkKHdpbmRvdykub24oJ3Njcm9sbCcsIGZ1bmN0aW9uICgpIHtcblx0XHR2YXIgaGVhZGVyID0gJCgnaGVhZGVyICNoZWFkZXInKS5vdXRlckhlaWdodCgpO1xuXHRcdHZhciBzbGlkZXIgPSAkKCcuaGVybycpLm91dGVySGVpZ2h0KCk7XG5cdFx0dmFyIGFib3V0ID0gJCgnLmFib3V0LXVzJykub3V0ZXJIZWlnaHQoKTtcblx0XHR2YXIgY29udGFjdCA9ICQoJy5zbWFsbC1jb250YWN0Jykub3V0ZXJIZWlnaHQoKTtcblx0XHR2YXIgc2VydmljZXMgPSAkKCcuc2VydmljZXMtc2VjdGlvbicpLm91dGVySGVpZ2h0KCk7XG5cdFx0dmFyIHRlc3RpbW9uaWFscyA9ICQoJy50ZXN0aW1vbmlhbHMtYXJlYScpLm91dGVySGVpZ2h0KCk7XG5cdFx0dmFyIHNjcm9sbCA9ICQod2luZG93KS5zY3JvbGxUb3AoKTtcblx0XHRpZiAoc2Nyb2xsID4gaGVhZGVyICsgc2xpZGVyICsgYWJvdXQgKyBjb250YWN0ICsgc2VydmljZXMgKyB0ZXN0aW1vbmlhbHMgKyAxMDApIHtcblx0XHRcdGNvbnNvbGUubG9nKCd0ZXN0Jyk7XG5cdFx0XHQkKCcuZmFjdC1zZWN0aW9uIC5mYWN0JykuZWFjaChmdW5jdGlvbiAoaW5kZXgsIHZhbHVlKSB7XG5cdFx0XHRcdHZhciBsaW1pdCA9IHBhcnNlSW50KCQodmFsdWUpLmZpbmQoJ2gyJykuYXR0cignZGF0YS1saW1pdCcpKTtcblx0XHRcdFx0c2V0SW50ZXJ2YWwoZnVuY3Rpb24gKCkge1xuXHRcdFx0XHRcdHZhciB2ID0gJCh2YWx1ZSkuZmluZCgnaDInKS50ZXh0KCk7XG5cdFx0XHRcdFx0aWYgKHYgPCBsaW1pdCkge1xuXHRcdFx0XHRcdFx0JCh2YWx1ZSkuZmluZCgnaDInKS50ZXh0KHBhcnNlSW50KHYpICsgMSk7XG5cdFx0XHRcdFx0fVxuXHRcdFx0XHR9LCAzMDApO1xuXHRcdFx0fSk7XG5cdFx0fVxuXHR9KTtcbn0pO1xuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyByZXNvdXJjZXMvYXNzZXRzL2pzL3BhZ2VzL2hvbWUuanMiXSwibWFwcGluZ3MiOiJBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EiLCJzb3VyY2VSb290IjoiIn0=");

/***/ }
/******/ ]);
//# sourceMappingURL=home.js.map
