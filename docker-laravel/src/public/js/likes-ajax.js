$(function() {
/**
 * mark a LIKE onto creator's post
 * @param {object} likeId
 * @return {void}
 */
  const likes = $('[data-like]');
  for (const like of likes) {
    like.addEventListener('click', function() {
    // eslint-disable-next-line no-invalid-this
      const self = $(this);
      const likeId = self.data('like');
      const userId = self.data('user');
      const initialCount = self.data('count');
      self.prop('disabled', true);
      // jsのajax使う前に記述
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
      });
      $.ajax({
        // headers: {
        //   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        // },
        type: 'POST', // GETかPOSTか
        url: 'like/' + likeId, // url+ファイル名 .htmlは省略可
        dataType: 'html',
        results: {
        //   'likeId': likeId,
          'userId': userId,
        },
        timeout: 10000,
      }).done(function(results) {
        $(`#count_${likeId}`).html(results);// 展開したいタグのidを指定
        if ($(`#btn_${likeId}`).html().indexOf('いいね済み') != -1) { // いいね済みの時
          $(`#btn_${likeId}`).html(`
        <i class="fas fa-heart"></i> いいね <span>${initialCount}</span>
        `);
          console.log('いいね済みの時');
        } else {
          $(`#btn_${likeId}`).html(`
        <i class="fas fa-heart"></i> いいね済み <span>${initialCount + 1}</span>
        `);
          console.log('mada');
        }
        $('[data-like]').off();
      }).fail(function(jqXHR, textStatus, errorThrown) {
        alert('ファイルの取得に失敗しました。');
        console.log('ajax通信に失敗しました');
        console.log(jqXHR.status);
        console.log(textStatus);
        console.log(errorThrown.message);
      }).always(function() {
        self.prop('disabled', false);
      });
    });
  }
});
