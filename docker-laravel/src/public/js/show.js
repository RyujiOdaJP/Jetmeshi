(function() {
  $('.if-showpage-disable-anchor').unwrap();
  $('.report').on('click', function(ev) {
    const reviewId = $(this).data('id');
    $('#review_id').val(reviewId);
  });
})();
