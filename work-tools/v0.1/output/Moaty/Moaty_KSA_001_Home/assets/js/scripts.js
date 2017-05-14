//  HAVAS LYNX PM3 iPad Boilerplate  2.0
//  --------------------------------------
// Create HLI namespace if it doesn't already exist.
var HLI = HLI || {};

(function () {
    // Enable ECMAScript 5 'Strict Mode'.
    "use strict";

    // Global Literal Object: Site-wide functions
    // -------------------------------------------
    HLI.G = {
        touchEvent: null,
        // Sets `tap` touch event as a string
        // if viewing on an iPad and `click` if using a
        // browser. Note that `tap` is noticeably
        // faster on the iPad.
        renderTouchEvent: function () {
            if (navigator.userAgent.match(/iPad/i)) {
                HLI.G.touchEvent = "tap";
            } else {
                HLI.G.touchEvent = "click";
            }
        },
        init: function () {
            HLI.G.renderTouchEvent();
        }
    };

    HLI.Tabs = {
        init: function () {
            $('.overlay .tab-content:first-child, #Content .tab-content:first-child').addClass('tab-active');
            $('.js-tabs').find('li:first-child').addClass('active');
            HLI.Tabs.showTab();
        },
        showTab: function () {
            $('.js-tabs span').bind('tap click', function (event) {
                event.preventDefault();
                var toShow = $(this).data('show');
                $(this).parent().siblings().removeClass('active');
                $(this).parent().addClass('active');
                $(toShow).siblings().removeClass('tab-active');
                $(toShow).addClass('tab-active');
            });
        }
    };

    HLI.References = {
        init: function () {
            var $cta = $('.reference-cta'),
                $reference = $('.reference div'),
                $close = $('.reference-close');

            //on click of a reference, get the fetch the references & put them in the dom
            $cta.on('tap click', function (event) {

                event.preventDefault();

                var toGet = $(this).attr('href').substr(3).replace(/'-'/g, ""),
                    toGet = toGet.split('-');

                $reference.empty().html(HLI.References.get(toGet));

                HLI.References.openRefs();

            });

            //close ref
            $close.on('click', function(e) {
                e.preventDefault();
                HLI.References.closeRefs();
            });

        },
        //query
        get: function (toGet) {

            var refOutput = '';

            for (var i = 0; i < toGet.length; i++) {
                refOutput += '<p>' + references[toGet[i]] + '</p>';
            }

            return refOutput;


        },
        openRefs: function () {
        	//if the nav is open, close it
            if ($('nav.active').length) {
                HLI.Nav.toggle();
            }
            $("#References").addClass('active');

        },
        closeRefs: function () {
            $("#References").removeClass('active');
        }
    };



    HLI.Overlays = {
        openOl: function (event) {
            event.preventDefault();
            var tOverlayId = $(this).attr("href");
            $('#Overlays').addClass('active');
            $('.overlay-active', '#Overlays').removeClass('overlay-active');
            $(tOverlayId).addClass('overlay-active');

            $('.overlay-active .tab-content').eq(0).addClass('tab-active');
            //if the nav is open, close it
            if ($('nav.active').length) {
                HLI.Nav.toggle();
            }

        },
        closeOl: function (event) {
            event.preventDefault();
            $('#Overlays').removeClass('active');
            setTimeout(function () {
                $('.overlay-active', '#Overlays').removeClass('overlay-active');
            }, 300);
        },
        init: function () {

            var $cta = $('.overlay-cta'),
                $close = $('.overlay-close');

            $close.on('tap click', HLI.Overlays.closeOl);
            $cta.on('tap click', HLI.Overlays.openOl);

        }
    };

     HLI.Studies = {
        openSt: function (event) {
            event.preventDefault();
            var tStudyId = $(this).attr("href");
            $('#Studies').addClass('active');
            $('.study-active', '#Studies').removeClass('study-active');
            $(tStudyId).addClass('study-active');
            //if the nav is open, close it
            if ($('nav.active').length) {
                HLI.Nav.toggle();
            }
        },
        closeSt: function (event) {
            event.preventDefault();
            $('#Studies').removeClass('active');
            setTimeout(function () {
                $('.study-active', '#Studies').removeClass('study-active');
            }, 300);
        },
        init: function () {

            var $cta = $('.study-cta'),
                $close = $('.study-close');

            $close.on('tap click', HLI.Studies.closeSt);
            $cta.on('tap click', HLI.Studies.openSt);

        }
    };

    HLI.Nav = {
        current: null, //need to remember which item is active, so can reset it when the nav is closed (if the user has clicked a different item - the class is removed)
        scrollers: [],
        scrollItemWidth: null,
        init: function () {

            HLI.Nav.current = $('li.current').index(); //need to remember this

            //cache selectors
            var $handle = $('.primary .handle'),
                $secondary = $('.primary .parent'),
                $scroller = $('.primary .scroll-inner').length;

            $handle.on('tap click', HLI.Nav.toggle);
            $secondary.on('tap click', HLI.Nav.secondary);

        },
        toggle: function () {

            //if the navs not open, open it
            if (!$('nav.active').length) {
                $('nav').addClass('active');
            }
            //if it is, before we close it we want to do a few things:
            else {
                //remove all active classes
                $('nav.active').removeClass('active');
                $('.primary .clicked').removeClass('clicked');
                $('.primary div.current').removeClass('current');
                if(HLI.Nav.current > 0) {
                    $('.primary li.cta ').eq(HLI.Nav.current).addClass('current'); //re add the pages' active class when its closed
                }
                //if iscrolls exist, remove them
                if(HLI.Nav.scrollers.length) {
                	HLI.Nav.removeScroll();
                }
            }
        },
        secondary: function () {
            
            var $scroller = $('.scroll-inner').length;

            $('li.current, div.current').removeClass('current');
            $(this).addClass('clicked').siblings().removeClass('clicked');
            $('.scroll-wrap', this).addClass('current');
            HLI.Nav.scrollItemWidth = $('.current .scroll-inner li:first-child').width();
           
            //if there are scrolling navs, add iscroll
            if ($scroller >= 1) {
                HLI.Nav.addScroll();
            }
        },
        addScroll: function () {
            
            var $scroller = $('.scroll-inner').parent(),
                $scrollbar = $('.myScrollBarH').length,
                $scrollWidth,
                i,
                j;

            //if the scrollbars dont exist, iscroll hasnt been initiated yet so create instances
            if ($scrollbar === 0) {

                for (i = 0; i < $scroller.length; i++) {

                    var scrollerID = $scroller[i].id,
                        scrollItems = $('#' + scrollerID + ' .scroll-inner li').length;

                    $scrollWidth = scrollItems * 160;

                    HLI.Nav.scrollers.push(new iScroll(scrollerID, {
                        snap: false,
                        hideScrollbar: false,
                        hScroll: true,
                        vScroll: false,
                        hScrollbar: true,
                        vScrollbar: false,
                        scrollbarClass: 'myScrollBar',
                       	onBeforeScrollStart: function (event) {
				            event.preventDefault();
				            event.stopPropagation();
			            }
                    }));

                    //calculate widths so dont need to manually style
 					//and refresh because we're chaning the dom & iscrolls funny
                    $('#'+scrollerID+' .scroll-inner').css('width', $scrollWidth);
                    HLI.Nav.scrollers[i].refresh();

                }
            }
            //if they do we just want to refresh them
            else {
                for (i = 0; i < $scroller.length; i++) {
                    HLI.Nav.scrollers[i].refresh();
                }
            }
        },
        //wanna remove iscroll from memory when we dont need it
        removeScroll: function () {
            var $scroller = $('.scroll-inner').parent(),
                i;
            for (i = 0; i < $scroller.length; i++) {
                HLI.Nav.scrollers[i].destroy();
            }
            HLI.Nav.scrollers = [];
        }
    };
    
    $(function () {
        $(document).on('touchmove', function(e) { e.preventDefault(); });
        HLI.G.init();
        HLI.Nav.init();
        HLI.Overlays.init();
        HLI.Studies.init();
        HLI.References.init();
        HLI.Tabs.init();
        // Call onLoadCallback if it exists.
        if (typeof HLI.onLoadCallback === 'function') {
            HLI.onLoadCallback();
        }
    });
}());