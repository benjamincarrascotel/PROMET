(()=>{function e(t){return(e="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(t)}!function(t){"use strict";t(window).on("load",(function(e){t("#global-loader").fadeOut("slow")})),t(".cover-image").each((function(){var a=t(this).attr("data-image-src");"undefined"!==e(a)&&!1!==a&&t(this).css("background","url("+a+") center center")})),t(".table-subheader").click((function(){t(this).nextUntil("tr.table-subheader").slideToggle(100)})),t(document).ready((function(){t("a[data-theme]").click((function(){t("head link#theme").attr("href",t(this).data("theme")),t(this).toggleClass("active").siblings().removeClass("active")})),t("a[data-effect]").click((function(){t("head link#effect").attr("href",t(this).data("effect")),t(this).toggleClass("active").siblings().removeClass("active")}))})),t("#fullscreen-button").on("click",(function(){void 0!==document.fullScreenElement&&null===document.fullScreenElement||void 0!==document.msFullscreenElement&&null===document.msFullscreenElement||void 0!==document.mozFullScreen&&!document.mozFullScreen||void 0!==document.webkitIsFullScreen&&!document.webkitIsFullScreen?document.documentElement.requestFullScreen?document.documentElement.requestFullScreen():document.documentElement.mozRequestFullScreen?document.documentElement.mozRequestFullScreen():document.documentElement.webkitRequestFullScreen?document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT):document.documentElement.msRequestFullscreen&&document.documentElement.msRequestFullscreen():document.cancelFullScreen?document.cancelFullScreen():document.mozCancelFullScreen?document.mozCancelFullScreen():document.webkitCancelFullScreen?document.webkitCancelFullScreen():document.msExitFullscreen&&document.msExitFullscreen()})),t(document).ready((function(){t(".horizontalMenu-list li a").each((function(){var e=window.location.href.split(/[?#]/)[0];this.href==e&&(t(this).addClass("active"),t(this).parent().addClass("active"),t(this).parent().parent().prev().addClass("active"),t(this).parent().parent().prev().click())})),t(".horizontal-megamenu li a").each((function(){var e=window.location.href.split(/[?#]/)[0];this.href==e&&(t(this).addClass("active"),t(this).parent().addClass("active"),t(this).parent().parent().parent().parent().parent().parent().parent().prev().addClass("active"),t(this).parent().parent().prev().click())})),t(".horizontalMenu-list .sub-menu .sub-menu li a").each((function(){var e=window.location.href.split(/[?#]/)[0];this.href==e&&(t(this).addClass("active"),t(this).parent().addClass("active"),t(this).parent().parent().parent().parent().prev().addClass("active"),t(this).parent().parent().prev().click())}))})),t((function(){t(".add").on("click",(function(){var e=t(this).closest("div").find(".qty"),a=parseInt(e.val());isNaN(a)||e.val(a+1)})),t(".minus").on("click",(function(){var e=t(this).closest("div").find(".qty"),a=parseInt(e.val());!isNaN(a)&&a>0&&e.val(a-1)}))})),t(".modal-effect").on("click",(function(e){e.preventDefault();var a=t(this).attr("data-bs-effect");t("#modaldemo8").addClass(a)})),t("#modaldemo8").on("hidden.bs.modal",(function(e){t(this).removeClass((function(e,t){return(t.match(/(^|\s)effect-\S+/g)||[]).join(" ")}))})),t(window).on("scroll",(function(e){t(this).scrollTop()>0?t("#back-to-top").fadeIn("slow"):t("#back-to-top").fadeOut("slow")})),t("#back-to-top").on("click",(function(e){return t("html, body").animate({scrollTop:0},0),!1}));t(".rating-stars").ratingStars({selectors:{starsSelector:".rating-stars",starSelector:".rating-star",starActiveClass:"is--active",starHoverClass:"is--hover",starNoHoverClass:"is--no-hover",targetFormElementSelector:".rating-value"}}),t(".chart-circle").length&&t(".chart-circle").each((function(){var e=t(this);e.circleProgress({fill:{color:e.attr("data-color")},size:e.height(),startAngle:-Math.PI/4*2,emptyFill:"#e2e2e9",lineCap:"round"})})),t(".chart-circle-transparent").length&&t(".chart-circle-transparent").each((function(){var e=t(this);e.circleProgress({fill:{color:e.attr("data-color")},size:e.height(),startAngle:-Math.PI/4*2,emptyFill:"rgba(0, 0, 0, 0.1)",lineCap:"round"})})),t(".chart-circle-primary").length&&t(".chart-circle-primary").each((function(){var e=t(this);e.circleProgress({fill:{color:e.attr("data-color")},size:e.height(),startAngle:-Math.PI/4*2,emptyFill:"rgba(112, 94, 200, 0.4)",lineCap:"round"})})),t(".chart-circle-secondary").length&&t(".chart-circle-secondary").each((function(){var e=t(this);e.circleProgress({fill:{color:e.attr("data-color")},size:e.height(),startAngle:-Math.PI/4*2,emptyFill:"rgba(251, 28, 82, 0.4)",lineCap:"round"})})),t(".chart-circle-success").length&&t(".chart-circle-success").each((function(){var e=t(this);e.circleProgress({fill:{color:e.attr("data-color")},size:e.height(),startAngle:-Math.PI/4*2,emptyFill:"rgba(66, 196, 138, 0.5)",lineCap:"round"})})),t(".chart-circle-warning").length&&t(".chart-circle-warning").each((function(){var e=t(this);e.circleProgress({fill:{color:e.attr("data-color")},size:e.height(),startAngle:-Math.PI/4*2,emptyFill:"rgba(255, 171, 0, 0.5)",lineCap:"round"})})),t(document).on("click","[data-bs-toggle='search']",(function(e){var a=t("body");a.hasClass("search-gone")?(a.addClass("search-gone"),a.removeClass("search-show")):(a.removeClass("search-gone"),a.addClass("search-show"))}));var a=function(){t(window).outerWidth()<=1024?(t("body").addClass("sidebar-gone"),t(document).off("click","body").on("click","body",(function(e){(t(e.target).hasClass("sidebar-show")||t(e.target).hasClass("search-show"))&&(t("body").removeClass("sidebar-show"),t("body").addClass("sidebar-gone"),t("body").removeClass("search-show"))}))):t("body").removeClass("sidebar-gone")};a(),t(window).resize(a),t(document).on("click",".close-btn",(function(){t("body").removeClass("search-show")}));var n="div.card";t(document).on("click",'[data-toggle="remove"]',(function(e){return t(this).closest(".attach-supportfiles").remove(),e.preventDefault(),!1}));[].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')).map((function(e){return new bootstrap.Tooltip(e)})),[].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]')).map((function(e){return new bootstrap.Popover(e)}));t(document).on("click",'[data-bs-toggle="card-close"]',(function(e){return t(this).closest(n).remove(),e.preventDefault(),!1})),t(document).on("click",'[data-bs-toggle="card-remove"]',(function(e){return t(this).closest(n).remove(),e.preventDefault(),!1})),t(document).on("click",'[data-bs-toggle="card-collapse"]',(function(e){return t(this).closest(n).toggleClass("card-collapsed"),e.preventDefault(),!1})),t(document).on("click",'[data-bs-toggle="card-fullscreen"]',(function(e){return t(this).closest(n).toggleClass("card-fullscreen").removeClass("card-collapsed"),e.preventDefault(),!1})),t(".sparkline_bar").sparkline([2,4,3,4,5,4,5,4,3,4],{height:20,type:"bar",colorMap:{7:"#a1a1a1"},barColor:"#ff5b51"}),t(".sparkline_bar1").sparkline([3,4,3,4,5,4,5,6,4,6],{height:20,type:"bar",colorMap:{7:"#c34444"},barColor:"#44c386"}),t(".sparkline_bar2").sparkline([3,4,3,4,5,4,5,6,4,6],{height:20,type:"bar",colorMap:{7:"#a1a1a1"},barColor:"#fa057a"}),t(".layout-setting").on("click",(function(e){document?t("body").toggleClass("dark-mode"):t("body").removeClass("dark-mode")}))}(jQuery)})();