/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  el: '#app'
});

/**
 * nav drawer
 *
 */
/*
The MIT License (MIT)
Copyright (c) 2014 Phil Hughes
Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:
The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*/
(function () { var a = function (a, b) { return function () { return a.apply(b, arguments); }; }; !(function (b, c) { var d, e, f; e = (function () { function c (c) { this.element = c, this._clickEvent = a(this._clickEvent, this), this.element = b(this.element), this.nav = this.element.closest('.nav'), this.dropdown = this.element.parent().find('.dropdown-menu'), this.element.on('click', this._clickEvent), this.nav.closest('.navbar-offcanvas').on('click', (function (a) { return function () { if (a.dropdown.is('.shown')) return a.dropdown.removeClass('shown').closest('.open').removeClass('open'); }; }(this))); } return c.prototype._clickEvent = function (a) { return this.dropdown.hasClass('shown') || a.preventDefault(), a.stopPropagation(), b('.dropdown-toggle').not(this.element).closest('.open').removeClass('open').find('.dropdown-menu').removeClass('shown'), this.dropdown.toggleClass('shown'), this.element.parent().toggleClass('open'); }, c; }()), f = (function () { function d (c, d, e, f) { this.button = c, this.element = d, this.location = e, this.offcanvas = f, this._getFade = a(this._getFade, this), this._getCss = a(this._getCss, this), this._touchEnd = a(this._touchEnd, this), this._touchMove = a(this._touchMove, this), this._touchStart = a(this._touchStart, this), this.endThreshold = 130, this.startThreshold = this.element.hasClass('navbar-offcanvas-right') ? b('body').outerWidth() - 60 : 20, this.maxStartThreshold = this.element.hasClass('navbar-offcanvas-right') ? b('body').outerWidth() - 20 : 60, this.currentX = 0, this.fade = !!this.element.hasClass('navbar-offcanvas-fade'), b(document).on('touchstart', this._touchStart), b(document).on('touchmove', this._touchMove), b(document).on('touchend', this._touchEnd); } return d.prototype._touchStart = function (a) { if (this.startX = a.originalEvent.touches[0].pageX, this.element.is('.in')) return this.element.height(b(c).outerHeight()); }, d.prototype._touchMove = function (a) { var c; if (b(a.target).parents('.navbar-offcanvas').length > 0) return !0; if (this.startX > this.startThreshold && this.startX < this.maxStartThreshold) { if (a.preventDefault(), c = a.originalEvent.touches[0].pageX - this.startX, c = this.element.hasClass('navbar-offcanvas-right') ? -c : c, Math.abs(c) < this.element.outerWidth()) return this.element.css(this._getCss(c)), this.element.css(this._getFade(c)); } else if (this.element.hasClass('in') && (a.preventDefault(), c = a.originalEvent.touches[0].pageX + (this.currentX - this.startX), c = this.element.hasClass('navbar-offcanvas-right') ? -c : c, Math.abs(c) < this.element.outerWidth())) return this.element.css(this._getCss(c)), this.element.css(this._getFade(c)); }, d.prototype._touchEnd = function (a) { var c, d, e; return b(a.target).parents('.navbar-offcanvas').length > 0 || (d = !1, e = a.originalEvent.changedTouches[0].pageX, Math.abs(e) !== this.startX ? (c = this.element.hasClass('navbar-offcanvas-right') ? Math.abs(e) > this.endThreshold + 50 : e < this.endThreshold + 50, this.element.hasClass('in') && c ? (this.currentX = 0, this.element.removeClass('in').css(this._clearCss()), this.button.removeClass('is-open'), d = !0) : Math.abs(e - this.startX) > this.endThreshold && this.startX > this.startThreshold && this.startX < this.maxStartThreshold ? (this.currentX = this.element.hasClass('navbar-offcanvas-right') ? -this.element.outerWidth() : this.element.outerWidth(), this.element.toggleClass('in').css(this._clearCss()), this.button.toggleClass('is-open'), d = !0) : this.element.css(this._clearCss()), this.offcanvas.bodyOverflow(d)) : void 0); }, d.prototype._getCss = function (a) { return a = this.element.hasClass('navbar-offcanvas-right') ? -a : a, { '-webkit-transform': 'translate3d(' + a + 'px, 0px, 0px)', '-webkit-transition-duration': '0s', '-moz-transform': 'translate3d(' + a + 'px, 0px, 0px)', '-moz-transition': '0s', '-o-transform': 'translate3d(' + a + 'px, 0px, 0px)', '-o-transition': '0s', transform: 'translate3d(' + a + 'px, 0px, 0px)', transition: '0s' }; }, d.prototype._getFade = function (a) { return this.fade ? { opacity: a / this.element.outerWidth() } : {}; }, d.prototype._clearCss = function () { return { '-webkit-transform': '', '-webkit-transition-duration': '', '-moz-transform': '', '-moz-transition': '', '-o-transform': '', '-o-transition': '', transform: '', transition: '', opacity: '' }; }, d; }()), c.Offcanvas = d = (function () { function d (c) { var d; this.element = c, this.bodyOverflow = a(this.bodyOverflow, this), this._sendEventsAfter = a(this._sendEventsAfter, this), this._sendEventsBefore = a(this._sendEventsBefore, this), this._documentClicked = a(this._documentClicked, this), this._close = a(this._close, this), this._open = a(this._open, this), this._clicked = a(this._clicked, this), this._navbarHeight = a(this._navbarHeight, this), d = !!this.element.attr('data-target') && this.element.attr('data-target'), d ? (this.target = b(d), this.target.length && !this.target.hasClass('js-offcanvas-done') && (this.element.addClass('js-offcanvas-has-events'), this.location = this.target.hasClass('navbar-offcanvas-right') ? 'right' : 'left', this.target.addClass(this._transformSupported() ? 'offcanvas-transform js-offcanvas-done' : 'offcanvas-position js-offcanvas-done'), this.target.data('offcanvas', this), this.element.on('click', this._clicked), this.target.on('transitionend', (function (a) { return function () { if (a.target.is(':not(.in)')) return a.target.height(''); }; }(this))), b(document).on('click', this._documentClicked), this.target.hasClass('navbar-offcanvas-touch') && new f(this.element, this.target, this.location, this), this.target.find('.dropdown-toggle').each(function () { return new e(this); }), this.target.on('offcanvas.toggle', (function (a) { return function (b) { return a._clicked(b); }; }(this))), this.target.on('offcanvas.close', (function (a) { return function (b) { return a._close(b); }; }(this))), this.target.on('offcanvas.open', (function (a) { return function (b) { return a._open(b); }; }(this))))) : console.warn('Offcanvas: `data-target` attribute must be present.'); } return d.prototype._navbarHeight = function () { if (this.target.is('.in')) return this.target.height(b(c).outerHeight()); }, d.prototype._clicked = function (a) { return a.preventDefault(), this._sendEventsBefore(), b('.navbar-offcanvas').not(this.target).trigger('offcanvas.close'), this.target.toggleClass('in'), this.element.toggleClass('is-open'), this._navbarHeight(), this.bodyOverflow(); }, d.prototype._open = function (a) { if (a.preventDefault(), !this.target.is('.in')) return this._sendEventsBefore(), this.target.addClass('in'), this.element.addClass('is-open'), this._navbarHeight(), this.bodyOverflow(); }, d.prototype._close = function (a) { if (a.preventDefault(), !this.target.is(':not(.in)')) return this._sendEventsBefore(), this.target.removeClass('in'), this.element.removeClass('is-open'), this._navbarHeight(), this.bodyOverflow(); }, d.prototype._documentClicked = function (a) { var c; if (c = b(a.target), !c.hasClass('offcanvas-toggle') && c.parents('.offcanvas-toggle').length === 0 && c.parents('.navbar-offcanvas').length === 0 && !c.hasClass('navbar-offcanvas') && this.target.hasClass('in')) return a.preventDefault(), this._sendEventsBefore(), this.target.removeClass('in'), this.element.removeClass('is-open'), this._navbarHeight(), this.bodyOverflow(); }, d.prototype._sendEventsBefore = function () { return this.target.hasClass('in') ? this.target.trigger('hide.bs.offcanvas') : this.target.trigger('show.bs.offcanvas'); }, d.prototype._sendEventsAfter = function () { return this.target.hasClass('in') ? this.target.trigger('shown.bs.offcanvas') : this.target.trigger('hidden.bs.offcanvas'); }, d.prototype.bodyOverflow = function (a) { if (a == null && (a = !0), this.target.is('.in') ? b('body').addClass('offcanvas-stop-scrolling') : b('body').removeClass('offcanvas-stop-scrolling'), a) return this._sendEventsAfter(); }, d.prototype._transformSupported = function () { var a, b, c, d; return b = document.createElement('div'), d = 'translate3d(0px, 0px, 0px)', c = /translate3d\(0px, 0px, 0px\)/g, b.style.cssText = '-webkit-transform: ' + d + '; -moz-transform: ' + d + '; -o-transform: ' + d + '; transform: ' + d, a = b.style.cssText.match(c), a.length != null; }, d; }()), b.fn.bsOffcanvas = function () { return this.each(function () { return new d(b(this)); }); }, b(function () { return b('[data-toggle="offcanvas"]').each(function () { return b(this).bsOffcanvas(); }), b(c).on('resize', function () { return b('.navbar-offcanvas.in').each(function () { return b(this).height('').removeClass('in'); }), b('.offcanvas-toggle').removeClass('is-open'), b('body').removeClass('offcanvas-stop-scrolling'); }), b('.offcanvas-toggle').each(function () { return b(this).on('click', function (a) { var c, d; if (!b(this).hasClass('js-offcanvas-has-events') && (d = b(this).attr('data-target'), c = b(d))) return c.height(''), c.removeClass('in'), b('body').css({ overflow: '', position: '' }); }); }); }); }(window.jQuery, window)); }).call(this);

// slider value showing
(function () {
    var valueBudget = document.getElementById('budget');
    var valueCookingTime = document.getElementById('cooking_time');
    var targetBudget = document.getElementById('target_budget');
    var targetCookingTime = document.getElementById('target_cooking_time');

    var rtnSliderValue = function (value, target) {
      return function () {
        target.innerHTML = value.value;
      };
    };
    valueBudget.addEventListener('input', rtnSliderValue(valueBudget, targetBudget));
    valueCookingTime.addEventListener('input', rtnSliderValue(valueCookingTime, targetCookingTime));
  })();

(function(){
document.getElementById('image_top').addEventListener('change', function () {
  // フォームで選択された全ファイルを取得
  var fileList = this.files;
  var targetImageTop = document.getElementById('target_image_top');
  // 個数分の画像を表示する
  for (var i = 0, l = fileList.length; l > i; i++) {
    // Blob URLの作成
    var blobUrl = window.URL.createObjectURL(fileList[i]);

    // HTMLに書き出し (src属性にblob URLを指定)
    targetImageTop.innerHTML = '<img src="' + blobUrl + '" width="100%">';
  }
})

document.getElementById('image_seq1').addEventListener('change', function () {
    // フォームで選択された全ファイルを取得
    var fileList = this.files;
    var targetImageTop = document.getElementById('target_image_seq1');
    // 個数分の画像を表示する
    for (var i = 0, l = fileList.length; l > i; i++) {
      // Blob URLの作成
      var blobUrl = window.URL.createObjectURL(fileList[i]);

      // HTMLに書き出し (src属性にblob URLを指定)
      targetImageTop.innerHTML = '<img src="' + blobUrl + '" width="100%">';
    }
  })

document.getElementById('image_seq2').addEventListener('change', function () {
    // フォームで選択された全ファイルを取得
    var fileList = this.files;
    var targetImageTop = document.getElementById('target_image_seq2');
    // 個数分の画像を表示する
    for (var i = 0, l = fileList.length; l > i; i++) {
      // Blob URLの作成
      var blobUrl = window.URL.createObjectURL(fileList[i]);

      // HTMLに書き出し (src属性にblob URLを指定)
      targetImageTop.innerHTML = '<img src="' + blobUrl + '" width="100%">';
    }
  })
document.getElementById('image_seq3').addEventListener('change', function () {
    // フォームで選択された全ファイルを取得
    var fileList = this.files;
    var targetImageTop = document.getElementById('target_image_seq3');
    // 個数分の画像を表示する
    for (var i = 0, l = fileList.length; l > i; i++) {
      // Blob URLの作成
      var blobUrl = window.URL.createObjectURL(fileList[i]);

      // HTMLに書き出し (src属性にblob URLを指定)
      targetImageTop.innerHTML = '<img src="' + blobUrl + '" width="100%">';
    }
  })
  document.getElementById('image_seq4').addEventListener('change', function () {
    // フォームで選択された全ファイルを取得
    var fileList = this.files;
    var targetImageTop = document.getElementById('target_image_seq4');
    // 個数分の画像を表示する
    for (var i = 0, l = fileList.length; l > i; i++) {
      // Blob URLの作成
      var blobUrl = window.URL.createObjectURL(fileList[i]);

      // HTMLに書き出し (src属性にblob URLを指定)
      targetImageTop.innerHTML = '<img src="' + blobUrl + '" width="100%">';
    }
  })
})();
