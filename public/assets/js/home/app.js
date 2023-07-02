$(document).ready(function () {
    $(window).scroll(function () {
        /* check if user scroll to the top or not */
        if ($(window).scrollTop()) {
            $("#side-nav").css("top", "110px").delay(1000);
        } else {
            $("#side-nav").css("top", "0").delay(1000);
        }
    });

    /* check if the width of the page is on mobile */
    if ($(window).width() < 768) {
        $("#academics").click(function () {
            if ($("#academicsdd").hasClass("show")) {
                $("#academicsdd").fadeOut("1500").removeClass("show");
            } else {
                $("#academicsdd").fadeIn("1500").addClass("show");
            }
        });
    } else {
        $("#academics").hover(function () {
            if ($("#academicsdd").hasClass("show")) {
                $("#academicsdd").fadeOut("1500").removeClass("show");
            } else {
                $("#academicsdd").fadeIn("1500").addClass("show");
            }
        });
    }
    if ($(window).width() < 768) {
        $("#servicesbtn").click(function () {
            if ($("#servicesdd").hasClass("show")) {
                $("#servicesdd").fadeOut("1500").removeClass("show");
            } else {
                $("#servicesdd").fadeIn("1500").addClass("show");
            }
        });
    } else {
        $("#services").hover(function () {
            if ($("#servicesdd").hasClass("show")) {
                $("#servicesdd").fadeOut("1500").removeClass("show");
            } else {
                $("#servicesdd").fadeIn("1500").addClass("show");
            }
        });
    }
    if ($(window).width() < 768) {
        $("#aboutbtn").click(function () {
            if ($("#aboutdd").hasClass("show")) {
                $("#aboutdd").fadeOut("1500").removeClass("show");
            } else {
                $("#aboutdd").fadeIn("1500").addClass("show");
            }
        });
    } else {
        $("#about").hover(function () {
            if ($("#aboutdd").hasClass("show")) {
                $("#aboutdd").fadeOut("1500").removeClass("show");
            } else {
                $("#aboutdd").fadeIn("1500").addClass("show");
            }
        });
    }
});
