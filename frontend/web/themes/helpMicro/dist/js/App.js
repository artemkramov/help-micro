/**
 * Dictionary collection of available js translations
 * @type {{}}
 */
var dictionary = {};
/**
 * Commonly used object with the useful general methods
 * @type {{alert, hideModal, confirm, init, events, sleep, reinitWidgets, reinitDate, sendAjax, pushSelect, setTranslation, getTranslation, parseTranslation, convertToCamelCase}}
 */
var App = (function () {
    return {
        /**
         * Show alert message. Can manage with autoclose time and callback function
         * @param message
         * @param title
         * @param autoCloseTimeout
         * @param callback
         */
        alert: function (message, title, autoCloseTimeout, callback) {
            var $alert = $("#alert");

            if (title) {
                $alert.find(".modal-header :header").html(title);
            } else {
                $alert.find(".modal-header").hide();
            }
            $alert.find(".modal-body").html(message);
            console.log('test');
            $($alert).modal();
            $($alert).unbind("hide");
            if ($.isFunction(callback))
                $($alert).bind("hide", callback);

            if (autoCloseTimeout && typeof autoCloseTimeout == "number")
                setTimeout(function () {
                    $($alert).modal("hide");
                }, autoCloseTimeout);
        },
        /**
         * Hide all modal windows
         */
        hideModal: function () {
            $(".modal").hide();
        },
        /**
         * Shows confirm message with Yes/No.
         * @param message
         * @param title
         * @param callback - callback for the button click 'Yes'
         * @param callback_close - callback for the button click 'No' or closing the window
         */
        confirm: function (message, title, callback, callback_close) {
            var $confirm = $("#confirm");
            if (title) {
                $confirm.find(".modal-header :header").html(title);
            } else {
                $confirm.find(".modal-header").hide();
            }
            $confirm.find(".modal-body").html(message);
            $("#confirm").modal();
            $("#confirm button.confirm").unbind("click").click(callback);
            if (callback_close) {
                $("#confirm button.disclaim").unbind("click").click(callback_close);
            }
        },
        /**
         * Load all events of the current object
         */
        init: function () {
            $(document).ready(function () {
                App.parseTranslation();
                App.events();
            });
        },
        /**
         * Call all registrated events
         */
        events: function () {

            var self = this;

            //force reload page on back browser button
            window.onpopstate = function (event) {
                if (event && event.state) {
                    location.reload();
                }
            }

            $(document).ready(function () {
                //disable ajax cache it solves that the Ajax content doesn't load properly when back button is clicked
                $.ajaxSetup({cache: false});
            });

            self.reinitWidgets();

            self.reinitTabs();


            /**
             * Trigger form on click
             */
            $(document).on('click', '.input-country', function () {
                $(this).closest('form').submit();
            });

            /**
             * Trigger form on change language in footer
             */
            $('.footer-select-language').change(function () {
                var language = $(this).val();
                var form = $('#footer-select-language');
                var input = $("<input />").attr('type', 'hidden').attr('name', 'selLanguage').val(language.toString());
                form.append(input);
                $(form).trigger('submit');
            });

            /**
             * Trigger form on change country in footer
             */
            $('.footer-select-country').change(function () {
                $("#footer-select-country").submit();
            });

            $(document).click(function(event) {
                var target = $(event.target);
                var id = $(target).attr('id');
                if (id && id == 'alert') {
                    self.hideModal();
                }
            });

            /**
             * Hover on header icons
             */
            $('.shopping-basket-link, .wishlist-icon-link').hover(function () {
                var icon = $(this).data('icon').toString();
                $(this).removeClass(icon);
                $(this).addClass(icon + '-rollover');
            }, function () {
                var icon = $(this).data('icon').toString();
                $(this).removeClass(icon + '-rollover');
                $(this).addClass(icon);
            });

            /**
             * Print button click
             */
            $(document).on("click", ".btn-print-page", function () {
               window.print();
            });

            /**
             * Switch between List and Grid mode
             */
            $('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
            $('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});

            /**
             * Buy link
             */
            $(document).on('click', '.btn-buy-link', function () {
                var productID = $(this).data('item');
                App.sendAjax({
                    url: siteUrl + '/product/action/get-buy-links',
                    type: 'get',
                    dataType: 'json',
                    data: {
                        id: productID
                    },
                    success: function (response) {
                        var template = _.template($('#buy-links').html());
                        var listHTML = template({
                           links: response
                        });
                        self.alert(listHTML, App.getTranslation('Buy in our partners'));
                    }
                }, false);

                return false;
            });


        },
        /**
         * Init custom checkboxes
         */
        reinitCheckbox: function () {
            $('.icheckbox').iCheck({checkboxClass: 'icheckbox_square'});
        },
        /**
         * Manually set the delay
         * @param ms
         */
        sleep: function (ms) {
            ms += new Date().getTime();
            while (new Date() < ms) {
            }
        },
        /**
         * Reinit number inputs
         */
        reinitInputNumber: function () {
            $('.form-input-number').spinner({
                min: 1,
                max: 100,
            });
        },
        /**
         * Reinit all widgets like datepicker, select e.t.c
         */
        reinitWidgets: function () {
            var self = this;
            // self.reinitCheckbox();
            // self.reinitPhoneMask();
            // self.reinitInputNumber();
        },
        /**
         * Reinit datepicker by selector with custom params
         * @param selector
         * @param params
         */
        reinitDate: function (selector, params) {
            if (typeof selector == 'undefined') {
                selector = ".datepicker";
            }
            var defaultParams = {
                dateFormat: dateFormat
            };
            if (typeof params !== 'undefined') {
                for (var property in params) {
                    defaultParams[property] = params[property];
                }
            }
            $("body").on('focus', selector, function () {
                $(this).datepicker(defaultParams);
            });
        },
        /**
         * Init tabs
         */
        reinitTabs: function (callbackSwitch) {
            $('ul.tabs').each(function () {
                // For each set of tabs, we want to keep track of
                // which tab is active and its associated content
                var $active, $content, $links = $(this).find('a');

                // If the location.hash matches one of the links, use that as the active tab.
                // If no match is found, use the first link as the initial active tab.
                $active = $($links.filter('[href="' + location.hash + '"]')[0] || $links[0]);
                $active.addClass('active');

                $content = $($active[0].hash);

                // Hide the remaining content
                $links.not($active).each(function () {
                    $(this.hash).hide();
                });

                // Bind the click event handler
                $(this).on('click', 'a', function (e) {
                    // Make the old tab inactive.
                    $active.removeClass('active');
                    $content.hide();

                    // Update the variables with the new link and content
                    $active = $(this);
                    $content = $(this.hash);

                    // Make the tab active.
                    $active.addClass('active');
                    $content.show();

                    if (typeof callbackSwitch !== 'undefined') {
                        callbackSwitch();
                    }

                    // Prevent the anchor's default click action
                    e.preventDefault();
                });
            });
        },
        /**
         * Init phone masks
         */
        reinitPhoneMask: function () {
            $('[data-type=phone]').mask('(000) 000-00-00');
        },
        /**
         * Method for calling of ajax.
         * @param params - custom params for ajax
         * @param showLoadingPage - check if show the preloader or no
         */
        sendAjax: function (params, showLoadingPage) {
            var showLoading = true;
            if (typeof showLoadingPage != 'undefined') {
                showLoading = showLoadingPage;
            }
            var defaultParams = {
                beforeSend: function () {
                    if (showLoading) {
                        $("body").addClass("loading");
                    }
                },
                error: function () {
                    if (showLoading) {
                        $("body").removeClass("loading");
                    }
                }
            };
            for (var property in params) {
                defaultParams[property] = params[property];
            }
            $.ajax(defaultParams);
        },
        /**
         * Hide ajax preloader background
         */
        hideAjaxloader: function () {
            $("body").removeClass('loading');
        },
        /**
         * Push all items to select
         * @param select
         * @param array items
         */
        pushSelect: function (select, items) {
            for (var i = 0; i < items.length; i++) {
                $("<option />").val(items[i].id).html(items[i].name).appendTo(select);
            }
        },
        /**
         * Get the translation string by key
         * @param key
         * @returns string
         */
        getTranslation: function (key) {
            return dictionary[key];
        },
        /**
         * Load all translations from JSON to the dictionary
         */
        parseTranslation: function () {
            if (typeof javascriptJSONLabels != 'undefined') {
                dictionary = $.parseJSON(javascriptJSONLabels);
            }
        },
        /**
         * Get the converted to camelCase style string
         * Is used to transform variable like 'invoice-confirm' to 'invoiceConfirm'
         * @param value
         * @returns {*}
         */
        convertToCamelCase: function (value) {
            return value.replace(/-([a-z])/g, function (g) {
                return g[1].toUpperCase();
            });
        },
        /**
         * Serialize object to post data
         * @param object
         * @returns {{}}
         */
        serializeObject: function (object) {
            var o = {};
            var a = object.serializeArray();
            $.each(a, function () {
                if (o[this.name] !== undefined) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
        },
        /**
         * Push country list to the header
         */
        pushOverlayCountry: function () {
            App.sendAjax({
                url: siteUrl + '/website/default/get-countries',
                data: {},
                success: function (response) {
                    $('.site-preferences').append(response);
                    $('.site-preferences').children().last().hide().fadeIn();
                }
            });
        },
        pushOverlayLanguage: function () {
            console.log('push language');
            // App.sendAjax({
            //     url: siteUrl + '/website/default/get-languages',
            //     success: function (response) {
            //         var parent = $('[data-group=overlay-language]').parent();
            //         $(parent).append(response);
            //         $(parent).children().last().hide().fadeIn();
            //     }
            // })
        },
        /**
         *
         * @param string
         * @returns {string}
         */
        capitalize: function (string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    }
})();
App.init();
