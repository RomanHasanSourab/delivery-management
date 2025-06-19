var prealoaderOption = $(window);
    prealoaderOption.on("load", function () {
        var preloader = jQuery('.preloader');
        var preloaderArea = jQuery('.preloader-area');
        preloader.fadeOut();
        preloaderArea.delay(500).fadeOut('slow');
});