$(function() {
/**
 * mark a LIKE onto creator's post
 * @param {object} likeId
 * @return {void}
 */
  function ajaxPost(likeId) {
    $.ajax({
      type: 'POST', // GETかPOSTか
      url: 'like', // url+ファイル名 .htmlは省略可
      dataType: 'html', // 他にjsonとか選べるとのこと
      results: {likeId: likeId},
    }).done(function(results) {
      $(`#count_${likeId}`).html(results);// 展開したいタグのidを指定
      if ($(`#btn_${likeId}`).html() == 'like') {
        $(`#btn_${likeId}`).html('unlike');
      } else {
        $(`#btn_${likeId}`).html('like');
      }
    }).fail(function(jqXHR, textStatus, errorThrown) {
      alert('ファイルの取得に失敗しました。');
      console.log('ajax通信に失敗しました');
      console.log(jqXHR.status);
      console.log(textStatus);
      console.log(errorThrown.message);
    }).always(function() {
      self.prop('disabled', false);
    });
  }
  // run individual likes editing method
  const likeElements = document.getElementsByName('likes');

  for (const likeElement of likeElements) {
    likeElement.addEventListener('click', function(ev) {
      if (!likeElement) {
        return;
      }
      // eslint-disable-next-line no-invalid-this
      const likeId = likeElement.getAttribute('data-like');
      likeElement.prop('disabled', true);
      ajaxPost(likeId);
    //   targetlike = document.getElementById(`target_${likeId}`);
    });
  }
});
