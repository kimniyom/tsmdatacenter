/* 
 * Function Resize Page 
 * Create By Kimniyom
 * Date 2014/12/2014 Time 22:10
 */

$(document).ready(function() {

    var pathWidth = $(this);
    var windowpage = pathWidth.width();
    if (windowpage >= 751) {
        $('#page-content-wrapper').css('margin-left', '250px');
    } else {
        $('#page-content-wrapper').css('margin-left', '0px');
    }
    $(window).resize(function() {
        var path = $(this);
        var contW = path.width();
        if (contW >= 751) {
            document.getElementsByClassName("sidebar-toggle")[0].style.left = "200px";
            $('#page-content-wrapper').css('margin-left', '250px');
            //$('#sidebar-wrapper').css('background','#333333');
        } else {
            document.getElementsByClassName("sidebar-toggle")[0].style.left = "-200px";
            $('#page-content-wrapper').css('margin-left', '0px');
        }
    });

        //Droup Down Menu Effect
        $('.dropdown').on('show.bs.dropdown', function(e) {
            $(this).find('.dropdown-menu').first().stop(true, true).slideDown(500);
        });
        $('.dropdown').on('hide.bs.dropdown', function(e) {
            $(this).find('.dropdown-menu').first().stop(true, true).slideUp(500);
        });
        
        //SideBar On Click
        $("#menu-toggle").click(function() {
            //e.preventDefault();
            var elem = document.getElementById("sidebar-wrapper");
            left = window.getComputedStyle(elem, null).getPropertyValue("left");
            if (left == "200px") {
                document.getElementsByClassName("sidebar-toggle")[0].style.left = "-200px";
            }
            else if (left == "-200px") {
                document.getElementsByClassName("sidebar-toggle")[0].style.left = "200px";
            }
        });
        

    $("#username").focus();

});

