// ==ClosureCompiler==
// @output_file_name default.js
// @compilation_level SIMPLE_OPTIMIZATIONS
// ==/ClosureCompiler==

jQuery( document ).ready( function( $ ) {

    //share
    $(document).on('click', '.yit_share', function(e){
        e.preventDefault();

        var share = $(this).parents('.product-actions-loop').find('.product-share');
        var template = '<div class="popupOverlay share"></div>' +
            '<div id="popupWrap" class="popupWrap share">' +
            '<div class="popup">' +
            '<div class="border-1 border">' +
            '<div class="border-2 border">' +
            '<div class="product-share">' +
            share.html() +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="close-popup"></div>' +
            '</div>' +
            '</div>';

        $('body').append(template);

        $('.popupWrap').center();
        $('.popupOverlay').css( { display: 'block', opacity:0 } ).animate( { opacity:0.7 }, 500 );
        $('.popupWrap').css( { display: 'block', opacity:0 } ).animate( { opacity:1 }, 500 );

        /** Close popup function **/
        var close_popup = function() {
            $('.popupOverlay').animate( {opacity:0}, 200);
            $('.popupOverlay').remove();
            $('.popupWrap').animate( {opacity:0}, 200);
            $('.popupWrap').remove();
        }

        /**
         *	Close popup on:
         *	- 'X button' click
         *   - wrapper click
         *   - esc key pressed
         **/
        $('.close-popup, .popupOverlay').click(function(){
            close_popup();
        });

        $(document).bind('keydown', function(e) {
            if (e.which == 27) {
                if($('.popupOverlay')) {
                    close_popup();
                }
            }
        });


        /** Center popup on windows resize **/
        $(window).resize(function(){
            $('#popupWrap').center();
        });
    });


    var add_hover = function(){
        if ( $(window).width() < 768 ) {
            $('ul.products li.product.open-on-mobile:not(.force-open)').removeClass('add-hover');
        } else {
            $('ul.products li.product.open-on-mobile:not(.force-open):not(.add-hover)').addClass('add-hover');
        }
    };
    add_hover();
    $(window).resize(add_hover);


    // add to cart
    var product;
    $('ul.products').on( 'click', 'li.product .add_to_cart_button', function(){
        product = $(this).parents('li.product');
        product.find('.product-wrapper').block({message: null, overlayCSS: {background: '#fff url(' + woocommerce_params.plugin_url + '/assets/images/ajax-loader.gif) no-repeat center', opacity: 0.3, cursor:'none'}});
        $('.widget.woocommerce.widget_shopping_cart a.cart_control').show();
        $('.widget.woocommerce.widget_shopping_cart a.cart_control.cart_control_empty').remove();
    });
    $('body').on( 'added_to_cart', function(){
        if ( product.find('.product-wrapper > .added').length == 0 ) {
            product.find('.product-wrapper').append('<span class="added">added</span>');
            product.find('.added').fadeIn(500);
            // product.find('.product-wrapper .grid-add-to-cart .add_to_cart_button').addClass('added');
        }
        product.find('.product-wrapper').unblock();
    });

    // variations select
    if( $.fn.selectbox !== undefined ) {
        var form = $('form.variations_form');
        var select = form.find('select');

        if( form.data('wccl') ) {
            select = select.filter(function(){ return $(this).data('type') == 'select' });
        }

        select.selectbox({
            effect: 'fade',
            onOpen: function() {       //console.log('open');
                //$('.variations select').trigger('focusin');
            }
        });

        var update_select = function(event){  // console.log(event);
            select.selectbox("detach");
            select.selectbox("attach");
        };

        // fix variations select
        form.on( 'woocommerce_update_variation_values', update_select);
        form.find('.reset_variations').on('click.yit', update_select);
    }

    // wishlist tooltip
    var apply_tiptip = function() {
        if ( $(this).parent().find('.feedback').length != 0 ) {
            $(this).tipTip({
                defaultPosition: "top",
                maxWidth: 'auto',
                edgeOffset: 30,
                content: $(this).parent().find('.feedback').text()
            });
        };
    }

    //product slider

    var carouFredSelOptions_defaults = {
        responsive: false,
        auto: true,
        items: 4,
        circular: true,
        infinite: true,
        debug: false,
        prev: '.es-nav .es-nav-prev',
        next: '.es-nav .es-nav-next',
        swipe: {
            onTouch: true
        },
        scroll : {
            items     : 1,
            pauseOnHover: true
        }
    };
    if( $.fn.carouFredSel ) {
        $('.products-slider-wrapper').each(function(){
            $(this).imagesLoaded(function(){
                var t = $(this);
                var items = carouFredSelOptions_defaults.items;

                if( $(this).parents('.border-box').length == 0) {
                    var carouFredSel;

                    var prev = $(this).find('.es-nav-prev').show();
                    var next = $(this).find('.es-nav-next').show();

                    carouFredSelOptions_defaults.prev = prev;
                    carouFredSelOptions_defaults.next = next;


                    if( $('body').outerWidth() <= 767 ) {
                        t.find('li').each(function(){
                            $(this).width( t.width() );
                        });

                        carouFredSelOptions_defaults.items = 1;
                    } else {
                        t.find('li').each(function(){
                            $(this).attr('style', '');
                        });

                        carouFredSelOptions_defaults.items = items;
                    }

                    carouFredSel = $(this).find('.products').carouFredSel( carouFredSelOptions_defaults );

                    $(window).resize(function(){
                        carouFredSel.trigger('destroy', false).attr('style','');

                        if( $('body').outerWidth() <= 767 ) {
                            t.find('li').each(function(){
                                $(this).width( t.width() );
                            });

                            carouFredSelOptions_defaults.items = 1;
                        } else {
                            t.find('li').each(function(){
                                $(this).attr('style', '');
                            });

                            carouFredSelOptions_defaults.items = items;
                        }

                        carouFredSel.carouFredSel(carouFredSelOptions_defaults);
                    });
                }
            });
        });
        $('.es-nav-prev, .es-nav-next').removeClass('hidden').show();
    }

    // force classic sytle in the products list
    $('ul.products li.product.grid.force-classic-on-mobile').on('force_classic', function(){
        if ( $(window).width() < 768 ) {
            $(this).addClass('classic').removeClass('with-hover');
        } else {
            $(this).addClass('with-hover').removeClass('classic');
        }
    }).trigger('force_classic');

    $(window).resize(function(){
        $('ul.products li.product.grid.force-classic-on-mobile').trigger('force_classic');
    });


    //shop sidebar
    $('#sidebar-shop-sidebar .widget h3').prepend('<div class="minus">-</div>');
    $('#sidebar-shop-sidebar .widget').on('click', 'h3', function(){
        $(this).parent().find('> *:not(h3)').slideToggle();

        if( $(this).find('div').hasClass('minus') ) {
            $(this).find('div').removeClass('minus').addClass('plus').text('+');
        } else {
            $(this).find('div').removeClass('plus').addClass('minus').text('-');
        }
    });


    //cart dropdown
    $('.shop_table_shipping th, .shop_table_coupon th').on('click', function(e){
        e.preventDefault();

        if($(this).find('a.button-dropdown').hasClass('active')) {
            $(this).find('a.button-dropdown').removeClass('active');
        }else {
            $(this).find('a.button-dropdown').addClass('active');
        }

        $('.shipping-calculator-form').show();

        tbody = $(this).parents('table').find('tbody td');
        tbody.slideToggle();
    });


    //IE8 double border
    var selectors = $('table.shop_table.cart', '#ie8,#ie9');
    if( selectors.length > 0 ) {
        selectors.each(function(){
            $(this).wrap('<div class="ie_border"></div>');
        });
    }

    var calculateSize;
    (calculateSize = function(){
        var box = $('.header-content-right').outerWidth();
        var mLeft = parseInt( $('.header-content-right').css('margin-left') );
        var container = $('#header-content').width();
        var width = container - box - ( mLeft + 1 );

        /* IE Browser Fix*/
        if( YIT_Browser.isIE() ) {
            width--;
        }

        $('.header-content-left').css('float', 'left').width( width );
    })();

    $(window).on('resize', calculateSize);
    $('body').on( 'wc_fragments_refreshed wc_fragments_loaded added_to_cart', calculateSize );
});