/**
 * Arrnge() will align items according to window size.
 * @param {Void} arrange()
 *
 */
function arrange() {
  const x = $(window).width();
  // windowの分岐幅をyに代入
  const y1 = 991.98;
  // const y2 = 767.98;
  if (x <= y1) {
    $('#tag_container').addClass('row').removeClass('container');
    $('#tag_group1').addClass('col-6').removeClass('row');
    $('#tag_group2').addClass('col-6').removeClass('row');
  } else {
    $('#tag_container').addClass('container').removeClass('row');
    $('#tag_group1').addClass('row').removeClass('col-6');
    $('#tag_group2').addClass('row').removeClass('col-6');
  }

  // if (x <= y2) {
  //     $('div.slide_container').addClass('container').removeClass('row');
  //     let Els = $('div.slide_show');
  //     for (let El of Els){
  //         $(El).addClass('container').removeClass('col-5');
  //     }
  // }else {
  //     $('div.slide_container').addClass('row').removeClass('container');
  //     let Els = $('div.slide_show');
  //     for (let El of Els){
  //         $(El).addClass('col-5').removeClass('container');
  // }
  // }
}
$(window).on('load resize', function() {
  arrange();
});
