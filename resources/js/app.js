import './bootstrap';

"use strict";

$("#navbarBtn").on("click", function(){
    $(".toggle").toggleClass("hidden");
});

$("#btnInfo").on("click", function(e){
    e.preventDefault();
    $("html,body").animate({
        scrollTop: $("#infoWeb").offset().top
    },'slow');
});
