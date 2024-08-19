$(function() {
    // Animsition ---
    $('.animsition').animsition().one('animsition.inStart', function() {
        $('html').addClass('loaded');
    });

    // Menu toggle ---
    $(document).on('click', '.menuToggle', function () {
        $('body').toggleClass('_menu-opened');
    });

    // Menu item click ---
    $('.Header').on('click', '.menu li a', function () {
        $('body').removeClass('_menu-opened');
    });

    // Scroll ---
    $(window).on('scroll', function() {
        $(this).scrollTop() > 20
            ? $('.Header').addClass('_mini')
            : $('.Header').removeClass('_mini');
    });

    $('.scroll').on('click', function(event) {
        let  data   = $(this).data('target');
        let  href   = $(this).attr('href');
        let  target = (data !== undefined) ? data : href;

        if (href == '#home') {
            $(target).animatescroll({
                scrollSpeed: 800,
                easing: 'easeOutExpo',
                padding: 0
            });

        } else {
            $(target).animatescroll({
                scrollSpeed: 800,
                easing: 'easeOutExpo',
                padding: 84,
            });
        }
    });

    // Cookies ---
    if (localStorage.hasOwnProperty('verify_cookies')) {
        $('.Cookies').addClass('_hide');
    }

    $('.Cookies .Button').on('click', function(event) {
        event.preventDefault();
        localStorage.setItem('verify_cookies', true);
        $('.Cookies').addClass('_hide');
    });

    // Wow ---
    new WOW({
        offset: 200,
    }).init();

    // Slides Home ---
    $('.Banner').each(function(index, el) {
        tns({
            container: '.itens',
            controls: false,
            nav: false,
            autoplay: true,
            autoplayTimeout: 7000,
            autoplayButtonOutput: false,
            mode: 'gallery',
            speed: 2000,
            mouseDrag: true,
            items: 1,
            loop: true,
        });
    });

    $('.Sliders .itens').each(function(index, el) {
        var slider = tns({
            container: el,
            controls: true,
            controlsText: ["<i class='ri-arrow-left-line'></i>", "<i class='ri-arrow-right-line'></i>"],
            nav: false,
            navPosition: 'bottom',
            autoplay: false,
            autoplayTimeout: 7000,
            autoplayButtonOutput: false,
            mouseDrag: true,
            items: 1,
            loop: false,
            onInit: function(info) {
                updateSliderInfo(info);
            },
        });

        var navItems = document.querySelectorAll('.Sliders .tns-nav button');

        slider.events.on('indexChanged', function(info) {
            updateSliderInfo(info);
        });

        navItems.forEach(function(item, index) {
            item.addEventListener('click', function() {
              slider.goTo(index);
            });
        });

        function updateSliderInfo(info) {
            $('.Sliders .current-slide').html(info.displayIndex);
            $('.Sliders .total-slides').html(info.slideCount);
        }
    });

    // videos home
    $('.Videos .destaque .item').click(function() {
        var videoId = $(this).data('video');
        var corte = videoId.split('v=');
        var iframe = '<iframe src="https://www.youtube.com/embed/' + corte[corte.length - 1] + '?autoplay=1" frameborder="0" allowfullscreen></iframe>';
        $('#video-container').html(iframe);
        $('#video-container').show();
        $(this).hide();
    });

    $('.Videos .itens').each(function(index, el) {
        tns({
            container: el,
            controls: false,
            nav: true,
            navPosition: 'bottom',
            autoplay: false,
            mouseDrag: true,
            items: 3,
            loop: false,
            gutter: 20,
        });
    });

    $('.Videos .itens .item').each(function(index, el) {
        $('.Videos .itens .item').click(function(event) {
            $('.Videos .destaque .item').hide();
            $('.Videos .destaque .video').hide();
            $($(this).data('target')).show();
        });
    });

    // Cardapio
    $('.Cardapio').each(function(index, el) {
        $('.categorias .categoria').click(function(event) {
            $(this).toggleClass('_active');
        });
    });

    $('.Cardapio .fotos').each(function(index, el) {
            $(el).magnificPopup({
                delegate: 'a',
                type: 'image',
                gallery: {
                  enabled:true
                }
            });
        });

});
