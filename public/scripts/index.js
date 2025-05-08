$(document).ready(function(){
            
    updateCartTotal();

    $('.add_to_cart').on('change', function () {
        var productId = $(this).data('id');
        var isChecked = $(this).is(':checked');

        if (isChecked) {
            $.ajax({
                url: cart_add,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    product_id: productId
                },
                success: function (response) {
                    alert('Product added to cart!');
                },
                error: function (xhr) {
                    alert('Something went wrong!');
                }
            });
        }
    });

    $('.cd-item-remove').on('click', function(e) {
        e.preventDefault();
        const productId = $(this).data('id'); 
        $.ajax({
            url: cart_remove,
            type: 'POST',
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
            data: {
                product_id: productId
            },
            success: function(response) {
                alert('Product removed from cart!');
                // location.reload(); 
                updateCartTotal();
            }
        });
    });


    var $L = 1200,
    $menu_navigation = $('#main-nav'),
    $cart_trigger = $('#cart_view'),
    $hamburger_icon = $('#cd-hamburger-menu'),
    $lateral_cart = $('#cd-cart'),
    $shadow_layer = $('#cd-shadow-layer');

    //open lateral menu on mobile
    $hamburger_icon.on('click', function(event){
        event.preventDefault();
        //close cart panel (if it's open)
        $lateral_cart.removeClass('speed-in');
        toggle_panel_visibility($menu_navigation, $shadow_layer, $('body'));
    });

    //open cart
    $cart_trigger.on('click', function(event){
        event.preventDefault();
        //close lateral menu (if it's open)
        $menu_navigation.removeClass('speed-in');
        toggle_panel_visibility($lateral_cart, $shadow_layer, $('body'));
    });

    //close lateral cart or lateral menu
    $shadow_layer.on('click', function(){
        $lateral_cart.removeClass('speed-in');
        $menu_navigation.removeClass('speed-in');
        $shadow_layer.removeClass('is-visible');
        $('body').removeClass('overflow-hidden');
    });

    //move #main-navigation inside header on laptop
    //insert #main-navigation after header on mobile
    move_navigation( $menu_navigation, $L);
    $(window).on('resize', function(){
move_navigation( $menu_navigation, $L);

if( $(window).width() >= $L && $menu_navigation.hasClass('speed-in')) {
    $menu_navigation.removeClass('speed-in');
    $shadow_layer.removeClass('is-visible');
    $('body').removeClass('overflow-hidden');
}


});
});

function updateCartTotal() {
    let total = 0;
    $('.cd-cart-items li').each(function() {
        let priceText = $(this).find('.cd-price').text();
        let price = parseFloat(priceText.replace(/[^0-9.-]+/g, "")) || 0;
        total += price;
    });
    $('.cd-cart-total span').text(total.toFixed(2));
}

function toggle_panel_visibility ($lateral_panel, $background_layer, $body) {
if( $lateral_panel.hasClass('speed-in') ) {
    $lateral_panel.removeClass('speed-in');
    $background_layer.removeClass('is-visible');
    $body.removeClass('overflow-hidden');
} else {
    $lateral_panel.addClass('speed-in');
    $background_layer.addClass('is-visible');
    $body.addClass('overflow-hidden');
}
}

function move_navigation( $navigation, $MQ) {
if ( $(window).width() >= $MQ ) {
    $navigation.detach();
    $navigation.appendTo('header');
} else {
    $navigation.detach();
    $navigation.insertAfter('header');
}
}