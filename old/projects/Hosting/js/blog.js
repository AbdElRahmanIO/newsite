'use strict';

//quickview
$(".boxer").boxer();

//owl casousel
$(document).ready(function() {

    $("#owl-demo").owlCarousel({

        navigation: false,
        slideSpeed: 400,
        paginationSpeed: 400,
        singleItem: true
    });

});


/* ==========================================================================
 Tweet
 ========================================================================== */


$('.tweet').twittie({
    dateFormat: '%b. %d, %Y',
    template: '<i class="fa fa-twitter twitter-icon"></i>&nbsp;&nbsp;{{tweet}}<br> <a href="{{url}}" class="text-left" target="_blank">Details</a>',
    count: 3,
    hideReplies: true
});


/*flickr widget start*/
$('#flikr-wdgt').jflickrfeed({
    limit: 9,
    qstrings: {
        id: '141069235@N07'
    },
    itemTemplate: '<li>' +
        '<a rel="colorbox" href="{{image}}" title="{{title}}">' +
        '<img src="{{image_s}}" alt="{{title}}" />' +
        '</a>' +
        '</li>'
}, function(data) {
    $('#flikr-wdgt a').colorbox();
});

/*flickr widget end*/

/*plyr*/

$(document).ready(function() {
    plyr.setup();
    $('.hover-btn1').on('click', function() {
        $('.hover-btn').hide();
    });
    $('.post3-main-div').on('mouseleave', function() {
        $('.hover-btn').show();
    });
});
