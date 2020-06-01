function tagArrange (){
    var x = $(window).width();
    //windowの分岐幅をyに代入
    const y = 991.98;
    if (x <= y) {
        $('#tag_container').addClass('row').removeClass('container');
        $('#tag_group1').addClass('col-6').removeClass('row');
        $('#tag_group2').addClass('col-6').removeClass('row');

    }else{
        $('#tag_container').addClass('container').removeClass('row');
        $('#tag_group1').addClass('row').removeClass('col-6');
        $('#tag_group2').addClass('row').removeClass('col-6');
    }
    }
    $(window).on('load resize', function (){
        tagArrange();
    });
