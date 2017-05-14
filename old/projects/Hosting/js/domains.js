'use strict';

//upper and down icon

$('.select-1').select2();   

$("#checkAll").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
});

function toggleChevron(e) {
    $(e.target)
        .prev('.panel-heading')
        .find("i.indicator")
        .toggleClass('mdi-hardware-keyboard-arrow-down mdi-hardware-keyboard-arrow-up');
}
$('#accordion').on('hidden.bs.collapse', toggleChevron);
$('#accordion').on('shown.bs.collapse', toggleChevron);

 //wow
 new WOW().init();



/* ==========================================================================
 Tweet
 ========================================================================== */


$('.tweet').twittie({
    dateFormat: '%b. %d, %Y',
    template: '{{tweet}}<br> <a href="{{url}}" target="_blank">Details</a>',
    count:1,
    hideReplies: true
});