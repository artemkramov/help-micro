var Product = (function () {

    /**
     * Button video play on the sidebar
     * @type {string}
     */
    var btnVideoPlay = '.js-play-video';

    /**
     * Big button video play
     * @type {string}
     */
    var btnVideoPlayBig = '.vjs-big-play-button';

    /**
     * Close video button
     * @type {string}
     */
    var btnVideoClose = '.btn-video-close';

    /**
     * Video button for mobile phones
     * @type {string}
     */
    var btnVideoMobile = '.btn-video-mobile';

    /**
     * Video container
     * @type {string}
     */
    var blockVideoContainer = '#video-container';

    /**
     * Tab button
     * @type {string}
     */
    var btnTabClick = '.widget-show-hide, .show-hide-title';

    /**
     * Link to the size table of the product
     * @type {string}
     */
    var btnSizeLink = '.view-measurements';

    /**
     * Button to continue the shopping
     * @type {string}
     */
    var btnModalContinueShopping = '.modal-content .btn-continue-shopping';

    /**
     * Button to zoom in the picture
     * @type {string}
     */
    var btnZoom = '.btn-product-image-zoom';

    /**
     * Button for the pre-order
     * @type {string}
     */
    var btnPreOrder = '.btn-pre-order';

    /**
     * Template with the pre-order form
     * @type {string}
     */
    var templatePreOrder = '#template-pre-order';

    return {
        /**
         * Init events
         */
        init: function () {
            this.event();
        },
        /**
         * Register events
         */
        event: function () {
            var self = this;

            $(document).ready(function () {

                var galleryCount = self.getGalleryCount();

                var galleryTop = new Swiper('.main-image-carousel', {
                    // Navigation arrows
                    nextButton: '.swiper-next-button-main',
                    prevButton: '.swiper-prev-button-main',
                    loop: true,
                    loopedSlides: self.getGalleryCount(),
                    onSlideChangeEnd: function (swiper) {
                        if ($('.thumbnail-wrapper').is(':visible')) {
                            $('.zoomContainer').remove();
                            setTimeout(function () {
                                // $('.swiper-slide-active .zoom').elevateZoom();
                            }, 0);
                        }

                    }
                });

                var galleryThumbs = new Swiper('.thumbnail-carousel', {
                    spaceBetween: 10,
                    slideToClickedSlide: true,
                    slidesPerView: galleryCount > 5 ? 5 : galleryCount,
                    touchRatio: 0.2,
                    loop: true,
                    //preventClicksPropagation: false,
                    //preventClicks: false,
                    direction: 'vertical',
                    loopedSlides: self.getGalleryCount(),
                    // Navigation arrows
                    nextButton: '.thumbnail-next-button',
                    prevButton: '.thumbnail-prev-button',
                });

                galleryTop.params.control = galleryThumbs;
                galleryThumbs.params.control = galleryTop;

                $(btnVideoPlay).click(function () {
                    $(blockVideoContainer).addClass('active');
                    $(blockVideoContainer).show();
                    $(btnVideoPlayBig).trigger('click');
                });

                $(btnVideoClose).click(function () {
                    $(blockVideoContainer).removeClass('active');
                    $(blockVideoContainer).hide();
                });

                self.initSliders();

                $(btnVideoMobile).click(function () {
                    var vidOpener = $(this).siblings('.video-tag').first();
                    if ($(vidOpener).is(":visible")) {
                        $(this).find('.icon-direction').removeClass('icon-arrow_up');
                        $(this).find('.icon-direction').addClass('icon-arrow_down');
                        $(vidOpener).slideUp();
                    }
                    else {
                        $(this).find('.icon-direction').removeClass('icon-arrow_down');
                        $(this).find('.icon-direction').addClass('icon-arrow_up');
                        $(vidOpener).find(btnVideoPlayBig).trigger('click');
                        $(vidOpener).slideDown();
                    }

                });

                $(btnTabClick).click(function () {
                    console.log(document.body.scrollWidth);
                    if ($(window).outerWidth() < 480) return;
                    var parent = $(this).parent();
                    if ($(parent).hasClass('active')) {
                        $(parent).siblings().first().find('.show-hide-title').trigger('click');
                        return;
                    }
                    $(parent).siblings().each(function () {
                        var icon = $(this).find('.icon')
                        $(icon).removeClass('icon-minus');
                        $(icon).addClass('icon-plus');
                        $(this).find('.show-hide-content').slideUp();
                        $(this).removeClass('active');
                    });
                    var icon = $(parent).find('.icon');
                    $(icon).removeClass('icon-plus');
                    $(icon).addClass('icon-minus');
                    $(parent).find('.show-hide-content').slideDown();
                    $(parent).addClass('active');
                });

                $(btnSizeLink).click(function () {
                    var link = $(this).attr('href');
                    var scale = 0.8;
                    var width = ($(window).width() * scale).toString();
                    var height = ($(window).height() * scale).toString();
                    window.open(link, '_blank', 'width=' + width + ', height=' + height + ', scrollbars=yes');
                    return false;
                });

                $(document).on('click', btnModalContinueShopping, function () {
                    App.hideModal();
                    return false;
                });

                $(document).on('click', btnPreOrder, function () {
                    var formHTML = $(templatePreOrder).clone(true, true);
                    $(formHTML).removeClass('hidden').removeAttr('id');
                    App.alert(formHTML, App.getTranslation('Pre-order'));
                });

                $(document).on('beforeSubmit', '#form-pre-order', function () {
                    var form = $(this);
                    // return false if form still have some validation errors
                    if (form.find('.has-error').length) {
                        return false;
                    }
                    $(form).find('.product-details-button-wrap').addClass('active');
                    var data = App.serializeObject($(this));
                    App.sendAjax({
                        url: siteUrl + '/product/action/pre-order',
                        data: data,
                        type: 'post',
                        success: function (response) {
                            if (response.success) {
                                $(form).find('.product-details-button-wrap').removeClass('active');
                                $(form).parent().html(response.message);
                            }
                        }
                    });
                    return false;
                });

                $(document).on('click', btnZoom, function () {
                    var image = $(".swiper-slide-active .zoom");
                    $.colorbox({
                        href: $(image).data('zoom-image'),
                        maxHeight: '100%',
                        maxWidth: '100%',
                        onComplete: function () {
                            // $('.cboxPhoto').elevateZoom({
                            //     zoomType: "inner",
                            //     // cursor: "crosshair"
                            // });
                        }
                    })
                });

                $("a.gallery").colorbox({
                    maxHeight: '100%',
                    maxWidth: '100%'
                });

            });

        },
        getGalleryCount: function () {
            var thumbNailList = $('ul.swiper-wrapper.thumbnails');
            if ($(thumbNailList).length) {
                return $(thumbNailList).children().length;
            }
            return 1;
        },
        initSliders: function () {
            var slidesPerView = 'auto';
            self.galleryHowToWear = new Swiper('.how-to-wear-image-carousel', {
                // Navigation arrows
                nextButton: '.swiper-next-button-wear',
                prevButton: '.swiper-prev-button-wear',
                slidesPerView: slidesPerView,
            });

            self.galleryYouMayAlsoLike = new Swiper('.you-may-also-like-image-carousel', {
                // Navigation arrows
                nextButton: '.swiper-next-button-like',
                prevButton: '.swiper-prev-button-like',
                slidesPerView: slidesPerView,
            });

            self.galleryDevelopmentModels = new Swiper('.page-development-image-carousel', {
                // Navigation arrows
                nextButton: '.swiper-next-button-like',
                prevButton: '.swiper-prev-button-like',
                slidesPerView: slidesPerView
            });

            App.reinitTabs(function () {
                self.galleryHowToWear.forEach(function (item) {
                    item.onResize();
                })
            });
        },
        galleryHowToWear: {},
        galleryYouMayAlsoLike: {},
    };

})();
Product.init();