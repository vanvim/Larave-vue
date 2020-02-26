$("#slideshow > img:gt(0)").hide();

setInterval(function() {
    $('#slideshow > img:first')
        .fadeOut(3000)
        .next()
        .fadeIn(3000)
        .end()
        .appendTo('#slideshow');
},  3000);