<!doctype html>
<html lang="ru">
<head>
	<title>Исторический формуляр УГЗ МЧС Беларуси</title>
	<meta charset="UTF-8">
	<meta name="description" content="Исторический формуляр Университета гражданской защиты МЧС Республики Беларусь" />
	<meta name="keywords" content="исторический, формуляр, Университет гражданской защиты МЧС Республики Беларусь, история, УГЗ, УГЗ МЧС, УГЗ МЧС Беларуси" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">

	<script type="text/javascript" src="./jquery/jquery.min.1.7.js"></script>
	<script type="text/javascript" src="./jquery/jquery-ui-1.8.20.custom.min.js"></script>
	<script type="text/javascript" src="./jquery/modernizr.2.5.3.min.js"></script>
	<!-- <script type="text/javascript" src="../jquery/modernizr.2.5.3.min.js" tppabs="https://flashpageflip.com/demos/jquery/modernizr.2.5.3.min.js"></script> -->
	<script type="text/javascript" src="./js/hash.js"></script>
</head>
<body>
    <div id="canvas">
        <div class="zoom-icon zoom-icon-in">
			<!-- Zoom icon here -->
        </div>

        <div class="magazine-viewport">
            <div class="container">
                <div class="magazine">
                    <!-- Next button -->
                    <div ignore="1" class="next-button"></div>
                    <!-- Previous button -->
                    <div ignore="1" class="previous-button"></div>
                </div>
            </div>

            <div class="bottom">
                <div id="slider-bar" class="fpf-slider">
                    <div id="slider"></div>
                </div>
            </div>
        </div>

        <div id="footer">
            <div style='color: #000; position: absolute; top: 1em; left: 1em'>
                <a href="https://ucp.by/areas-of-activity/patrioticheskoe-vospitanie/">Назад</a>
            </div>
            <div id="navcontainer">
                <ul id="navlist">
                    <li></li>
                    <li class="nav-front"><a href="javascript:frontCover();"></a></li>
                    <li class="nav-prev"><a href="javascript:previousPage();"></a></li>
                    <li id="pageNums" style="font-family:tahoma; font-size:0.9em; display: inline-block; width:101px">...</li>
                    <li class="nav-next"><a href="javascript:nextPage();"></a></li>
                    <li class="nav-back"><a href="javascript:backCover();"></a></li><li style="margin-right:20px"></li>
                </ul>
            </div>
        </div>

    </div>

    <script type="text/javascript">

    function loadApp() {

        $('#canvas').fadeIn(1000);

        var flipbook = $('.magazine');

        // Check if the CSS was already loaded

        if (flipbook.width()==0 || flipbook.height()==0) {
            setTimeout(loadApp, 10);
            return;
        }

        // Create the flipbook
        
        flipbook.turn({

                // Magazine width

                width: 2048,

                // Magazine height

                height: 768,

                // Duration in millisecond

                duration: 1,

                // Hardware acceleration

                acceleration: !isChrome(),

                // Enables gradients

                gradients: true,

                // Auto center this flipbook

                autoCenter: true,

                // Elevation from the edge of the flipbook when turning a page

                elevation: 50,

                // The number of pages

                pages: 82,

                // Display mode

                display: "double",

                direction: "ltr",

                //page: 6,

                // Events

                when: {
                    turning: function(event, page, view) {

                        var book = $(this),
                        currentPage = book.turn('page'),
                        pages = book.turn('pages');

                        // Update the current URI

                        Hash.go('page/' + page).update();

                        // Play flip sound
                        var browserName=navigator.appName;
                        if (browserName!="Microsoft Internet Explorer" && browserName.indexOf("Safari")!=-1) {
                            if(! /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                                flipsound.playclip();
                            };
                        };

                        // Show and hide navigation buttons

                        disableControls(page);

                    },

                    turned: function(event, page, view) {

                        disableControls(page);

                        $(this).turn('center');

                        $('#slider').slider('value', getViewNumber($(this), page));

                        //bulunulan sayfa
                        var view = $(".magazine").turn("view").join(" - ");

                        if ($(this).turn('page') == $(this).turn('pages')){
                            view = $(this).turn('pages');
                        }else if($(this).turn('page') == 1){
                            view = 1;
                        }

                        $("#pageNums").html(view + " / " + $(this).turn('pages'));

                        if (page==1) {
                            $(this).turn('peel', 'br');
                        }

                    },

                    missing: function (event, pages) {

                        // Add pages that aren't in the magazine

                        for (var i = 0; i < pages.length; i++)
                            addPage(pages[i], $(this));

                    }
                }

        });

        // Zoom.js

        $('.magazine-viewport').zoom({
            flipbook: $('.magazine'),

            max: function() {

                return largeMagazineWidth()/$('.magazine').width();

            },

            when: {
                swipeLeft: function() {

                    $(this).zoom('flipbook').turn('next');

                },

                swipeRight: function() {

                    $(this).zoom('flipbook').turn('previous');

                },

                resize: function(event, scale, page, pageElement) {

                    if (scale==1)
                        loadSmallPage(page, pageElement);
                    else
                        loadLargePage(page, pageElement);

                },

                zoomIn: function () {

                    $('#slider-bar').hide();
                    $('.made').hide();
                    $('.magazine').removeClass('animated').addClass('zoom-in');
                    $('.zoom-icon').removeClass('zoom-icon-in').addClass('zoom-icon-out');

                    if (!window.escTip && !$.isTouch) {
                        escTip = true;

                        $('<div />', {'class': 'exit-message'}).
                            html('<div>Press ESC to exit</div>').
                                appendTo($('body')).
                                delay(2000).
                                animate({opacity:0}, 500, function() {
                                    $(this).remove();
                                });
                    }
                },

                zoomOut: function () {

                    $('#slider-bar').fadeIn();
                    $('.exit-message').hide();
                    $('.made').fadeIn();
                    $('.zoom-icon').removeClass('zoom-icon-out').addClass('zoom-icon-in');

                    setTimeout(function(){
                        $('.magazine').addClass('animated').removeClass('zoom-in');
                        resizeViewport();
                    }, 0);

                }
            }
        });

        // Zoom event

        if ($.isTouch)
            $('.magazine-viewport').bind('zoom.doubleTap', zoomTo);
        else
            $('.magazine-viewport').bind('https://flashpageflip.com/demos/html5-magazine/zoom.tap', zoomTo);


        // Using arrow keys to turn the page

        $(document).keydown(function(e){

            var previous = 37, next = 39, esc = 27;

            switch (e.keyCode) {
                case previous:

                    // left arrow
                    $('.magazine').turn('previous');
                    e.preventDefault();

                break;
                case next:

                    //right arrow
                    $('.magazine').turn('next');
                    e.preventDefault();

                break;
                case esc:

                    $('.magazine-viewport').zoom('zoomOut');
                    e.preventDefault();

                break;
            }
        });

        // URIs - Format #/page/1

        Hash.on('^page\/([0-9]*)$', {
            yep: function(path, parts) {
                var page = parts[1];

                if (page!==undefined) {
                    if ($('.magazine').turn('is'))
                        $('.magazine').turn('page', page);
                }

            },
            nop: function(path) {

                if ($('.magazine').turn('is'))
                    $('.magazine').turn('page', 1);
            }
        });


        $(window).resize(function() {
            resizeViewport();
        }).bind('orientationchange', function() {
            resizeViewport();
        });

        // Regions

        if ($.isTouch) {
            $('.magazine').bind('touchstart', regionClick);
        } else {
            $('.magazine').click(regionClick);
        }

        // Events for the next button

        $('.next-button').bind($.mouseEvents.over, function() {

            $(this).addClass('next-button-hover');

        }).bind($.mouseEvents.out, function() {

            $(this).removeClass('next-button-hover');

        }).bind($.mouseEvents.down, function() {

            $(this).addClass('next-button-down');

        }).bind($.mouseEvents.up, function() {

            $(this).removeClass('next-button-down');

        }).click(function() {

            $('.magazine').turn('next');

        });

        // Events for the previous button

        $('.previous-button').bind($.mouseEvents.over, function() {

            $(this).addClass('previous-button-hover');

        }).bind($.mouseEvents.out, function() {

            $(this).removeClass('previous-button-hover');

        }).bind($.mouseEvents.down, function() {

            $(this).addClass('previous-button-down');

        }).bind($.mouseEvents.up, function() {

            $(this).removeClass('previous-button-down');

        }).click(function() {

            $('.magazine').turn('previous');

        });


        // Slider

        $( "#slider" ).slider({
            min: 1,
            max: numberOfViews(flipbook),

            start: function(event, ui) {

                if (!window._thumbPreview) {
                    _thumbPreview = $('<div />', {'class': 'thumbnail'}).html('<div></div>');
                    setPreview(ui.value);
                    _thumbPreview.appendTo($(ui.handle));
                } else
                    setPreview(ui.value);

                moveBar(false);

            },

            slide: function(event, ui) {

                setPreview(ui.value);

            },

            stop: function() {

                if (window._thumbPreview)
                    _thumbPreview.removeClass('show');

                $('.magazine').turn('page', Math.max(1, $(this).slider('value')*2 - 2));

            }
        });

        resizeViewport();

        $('.magazine').addClass('animated');

    }

    // Zoom icon

     $('.zoom-icon').bind('mouseover', function() {

        if ($(this).hasClass('zoom-icon-in'))
            $(this).addClass('zoom-icon-in-hover');

        if ($(this).hasClass('zoom-icon-out'))
            $(this).addClass('zoom-icon-out-hover');

     }).bind('mouseout', function() {

         if ($(this).hasClass('zoom-icon-in'))
            $(this).removeClass('zoom-icon-in-hover');

        if ($(this).hasClass('zoom-icon-out'))
            $(this).removeClass('zoom-icon-out-hover');

     }).bind('click', function() {

        if ($(this).hasClass('zoom-icon-in'))
            $('.magazine-viewport').zoom('zoomIn');
        else if ($(this).hasClass('zoom-icon-out'))
            $('.magazine-viewport').zoom('zoomOut');

     });

     $('#canvas').hide();


    // Load the HTML4 version if there's not CSS transform

    yepnope({
        test : Modernizr.csstransforms,
        yep: ['./js/flip.min.js'/*tpa=https://flashpageflip.com/demos/js/flip.min.js*/],
        nope: ['./js/flip.html4.min.js'/*tpa=https://flashpageflip.com/demos/js/flip.html4.min.js*/, 'css/jquery.ui.html4.css'/*tpa=https://flashpageflip.com/demos/html5-magazine/css/jquery.ui.html4.css*/],
        both: ['./js/zoom.min.js'/*tpa=https://flashpageflip.com/demos/js/zoom.min.js*/, 'css/jquery.ui.css'/*tpa=https://flashpageflip.com/demos/html5-magazine/css/jquery.ui.css*/, 'js/magazine.js'/*tpa=https://flashpageflip.com/demos/html5-magazine/js/magazine.js*/, 'css/magazine.css'/*tpa=https://flashpageflip.com/demos/html5-magazine/css/magazine.css*/],
        complete: loadApp
    });

    function nextPage() {
        $(".magazine").turn("next");
    }

    function previousPage() {
        $(".magazine").turn("previous");
    }

    function frontCover() {
        $(".magazine").turn("page", 1);
    }

    function backCover() {
        $(".magazine").turn("page", $(".magazine").turn("pages"));
    }

    </script>

</body>
</html>