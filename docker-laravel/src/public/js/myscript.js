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

/***/ "./resources/js/myscript.js":
/*!**********************************!*\
  !*** ./resources/js/myscript.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// slider value showing
(function () {
  var valueBudget = document.getElementById('budget');
  var valueCookingTime = document.getElementById('cooking_time');
  var targetBudget = document.getElementById('target_budget');
  var targetCookingTime = document.getElementById('target_cooking_time');

  var rtnSliderValue = function rtnSliderValue(value, target) {
    return function () {
      target.innerHTML = value.value;
    };
  };

  valueBudget.addEventListener('input', rtnSliderValue(valueBudget, targetBudget));
  valueCookingTime.addEventListener('input', rtnSliderValue(valueCookingTime, targetCookingTime));
})();

(function () {
  document.getElementById('image_top').addEventListener('change', function () {
    // フォームで選択された全ファイルを取得
    var fileList = this.files;
    var targetImageTop = document.getElementById('target_image_top'); // 個数分の画像を表示する

    for (var i = 0, l = fileList.length; l > i; i++) {
      // Blob URLの作成
      var blobUrl = window.URL.createObjectURL(fileList[i]); // HTMLに書き出し (src属性にblob URLを指定)

      targetImageTop.innerHTML = '<img src="' + blobUrl + '" width="100%">';
    }
  });
  document.getElementById('image_seq1').addEventListener('change', function () {
    // フォームで選択された全ファイルを取得
    var fileList = this.files;
    var targetImageTop = document.getElementById('target_image_seq1'); // 個数分の画像を表示する

    for (var i = 0, l = fileList.length; l > i; i++) {
      // Blob URLの作成
      var blobUrl = window.URL.createObjectURL(fileList[i]); // HTMLに書き出し (src属性にblob URLを指定)

      targetImageTop.innerHTML = '<img src="' + blobUrl + '" width="100%">';
    }
  });
  document.getElementById('image_seq2').addEventListener('change', function () {
    // フォームで選択された全ファイルを取得
    var fileList = this.files;
    var targetImageTop = document.getElementById('target_image_seq2'); // 個数分の画像を表示する

    for (var i = 0, l = fileList.length; l > i; i++) {
      // Blob URLの作成
      var blobUrl = window.URL.createObjectURL(fileList[i]); // HTMLに書き出し (src属性にblob URLを指定)

      targetImageTop.innerHTML = '<img src="' + blobUrl + '" width="100%">';
    }
  });
  document.getElementById('image_seq3').addEventListener('change', function () {
    // フォームで選択された全ファイルを取得
    var fileList = this.files;
    var targetImageTop = document.getElementById('target_image_seq3'); // 個数分の画像を表示する

    for (var i = 0, l = fileList.length; l > i; i++) {
      // Blob URLの作成
      var blobUrl = window.URL.createObjectURL(fileList[i]); // HTMLに書き出し (src属性にblob URLを指定)

      targetImageTop.innerHTML = '<img src="' + blobUrl + '" width="100%">';
    }
  });
  document.getElementById('image_seq4').addEventListener('change', function () {
    // フォームで選択された全ファイルを取得
    var fileList = this.files;
    var targetImageTop = document.getElementById('target_image_seq4'); // 個数分の画像を表示する

    for (var i = 0, l = fileList.length; l > i; i++) {
      // Blob URLの作成
      var blobUrl = window.URL.createObjectURL(fileList[i]); // HTMLに書き出し (src属性にblob URLを指定)

      targetImageTop.innerHTML = '<img src="' + blobUrl + '" width="100%">';
    }
  });
})();

(function () {
  $(function swipeMenu() {
    alert('OK');
    console.log('swipeFunction');
    $("#app").bind("touchstart", onTouchStart);
    $("#app").bind("touchmove", onTouchMove);
    $("#app").bind("touchend", onTouchEnd);
    var status, position; //スワイプ開始時の横方向の座標を格納

    function onTouchStart(event) {
      position = getPosition(event);
    } //スワイプの方向（left／right）を取得


    function onTouchMove(event) {
      status = position > getPosition(event) ? "in" : "";
    } //スワイプ終了時に方向（left／right）をクラス名に指定


    function onTouchEnd(event) {
      $("#js-bootstrap-offcanvas").removeAttr("class").addClass(status);
    } //横方向の座標を取得


    function getPosition(event) {
      console.log('swipingNow');
      return event.originalEvent.touches[0].pageX;
    }
  });
})();

/***/ }),

/***/ 1:
/*!****************************************!*\
  !*** multi ./resources/js/myscript.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /work/resources/js/myscript.js */"./resources/js/myscript.js");


/***/ })

/******/ });