
(function() {
  jQuery(function swipeMenu() {
    let status = [];

    $('#swipe-aria').bind('touchstart', onTouchStart);
    $('#swipe-aria').bind('touchmove', onTouchMove);
    $('#swipe-aria').bind('touchend', onTouchEnd);

    $('#nav-button').on('click', function clickToggle() {
      if ($('#nav-button').hasClass('not-clicked')) {
        $('#js-bootstrap-offcanvas').removeClass('out').addClass('in');
        $('#nav-button').removeClass('not-clicked').addClass('clicked');
        $('#swipe-aria').removeClass('true').addClass('false');
        status = ['out', 'in', 'not-clicked', 'clicked']; // left swipe
      } else if ($('#nav-button').hasClass('clicked')) {
        $('#js-bootstrap-offcanvas').removeClass('in').addClass('out');
        $('#nav-button').removeClass('clicked').addClass('not-clicked');
        $('#swipe-aria').removeClass('false').addClass('true');
        status = ['in', 'out', 'clicked', 'not-clicked']; // right swipe
      }
    });

    //
    /**
     *スワイプ開始時の横方向の座標を格納
     * @param {float} event
     */
    function onTouchStart(event) {
      startPosition = getPosition(event);
    }
    /**
     *スワイプの方向を取得(数値でトリガー感度を調節)
     * @param {float} event
     */
    function onTouchMove(event) {
      if (startPosition < getPosition(event) + 15) {
        // right swipe
        status = ['in', 'out', 'clicked', 'not-clicked', 'false', 'true'];
      } else {
        // left swipe
        status = ['out', 'in', 'not-clicked', 'clicked', 'true', 'false'];
      }
    }

    /**
     *スワイプ終了時にstatusをクラス名に指定
     * @param {float} event
     */
    function onTouchEnd(event) {
      $('#js-bootstrap-offcanvas').removeClass(status[0]).addClass(status[1]);
      $('#nav-button').removeClass(status[2]).addClass(status[3]);
      $('#swipe-aria').removeClass(status[4]).addClass(status[5]);
      console.log(status);
    }

    /**
     * 横方向の座標を取得
     * @param {float} event
     * @return {object}
     */
    function getPosition(event) {
      const position = event.originalEvent.touches[0].pageX;
      return position;
    }
  });
})();
