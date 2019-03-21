$(document).foundation();

var elem = new Foundation.AccordionMenu($('.accordion-menu'));

// Todo fix
/**
 * When the logout button is clicked, close
 * the app in x milliseconds which is defined in closingTimeInMillisec.
 * Shrink the app every x milliseconds which is defined in updateSizeInMillisec.
 *
 */
function shrinkApp(){
    $('.logout').on('click', function () {
        let appHeight = $('.app').height();
        let appWidth = $('.app').width();
        let appMarginLeft = parseInt($('.app').css('margin-left'));
        let appMarginTop = parseInt($('.app').css('margin-top'));
        let closingTimeInMillisec = 800;
        let updateSizeInMillisec = 10;
        $('.sidebar').css({'position': 'unset', 'width': '100%'});

        let appHeightShrink = appHeight / (closingTimeInMillisec / updateSizeInMillisec);
        let appWidthShrink = appWidth / (closingTimeInMillisec / updateSizeInMillisec);

        let t = setInterval(shrinkApp, updateSizeInMillisec);

        let runTime = 0;
        function shrinkApp(){
            runTime += updateSizeInMillisec;

            $('.app').height(appHeight - appHeightShrink);
            $('.app').width(appWidth - appWidthShrink);
            $('.app').css({'margin-left': appMarginLeft + (appWidthShrink / 2)});
            $('.app').css({'margin-top': appMarginTop + (appHeightShrink / 2)});

            appMarginLeft = parseInt($('.app').css('margin-left'));
            appMarginTop = parseInt($('.app').css('margin-top'));
            appHeight = $('.app').height();
            appWidth = $('.app').width();

            if(runTime === closingTimeInMillisec){
                clearInterval(t);
            }
        }
    });
}