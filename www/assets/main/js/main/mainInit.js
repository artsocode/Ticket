$(document).ready(function(e) {
    "use strict";
    /*Head block*/
    $('.main-header-container').corner("bite tl tr 35px");
    $('.main-header-container').corner("bite bl br 15px");

    /*Body block*/
    $('.main-body-container').corner("bite 15px");

    /*Footer block*/
    $('.main-footer-container').corner("bite tl tr 15px");

    /*Placeholder plagin init*/
    $.placeholder.input;
    $.placeholder.textarea;
});
