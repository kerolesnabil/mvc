$(document).ready(function () {
    $('.carousel').carousel({interaval: 5000});

    $("body").niceScroll();


    $(".gear-check").click(function () {
        $(".color-option").fadeToggle();
    });

    var colorLi = $(".color-option ul li");

    colorLi
        .eq(0).css("backgroundColor", "#E41B17").end()
        .eq(1).css("backgroundColor", "#d426d5").end()
        .eq(2).css("backgroundColor", "#009aff").end()
        .eq(3).css("backgroundColor", "#fff400");

    colorLi.click(function () {
        $("link[href*='theme']").attr("href", $(this).attr("data-value"));
    });


    var sctollButton = $("#scroll-top");

    $(window).scroll(function () {
        if ($(this).scrollTop() >= 700) {
            sctollButton.show();
        }
        else {
            sctollButton.hide();
        }
    });

    sctollButton.click(function () {
        $("html,body").animate({scrollTop: 0}, 600);
    });


});


$(window).load(function () {

    $(".loading-overlay").fadeOut(2000);
    $(".loading-overlay").remove();

});
