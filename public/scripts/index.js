$('.add_to_cart').on('change', function () {
    var productId = $(this).data('id');
    var isChecked = $(this).is(':checked');

    if (isChecked) {
        $.ajax({
            url: cart_add,
            method: 'POST',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                product_id: productId
            },
            success: function (response) {
                alert('Product added to cart!');
                $('.cart-items-container').html(response.cart_html);
                updateCartTotal();
                let checkbox = $(`.add_to_cart[data-id="${productId}"]`);
                checkbox.prop('checked', true).prop('disabled', true);
                
            },
            error: function (xhr) {
                console.log(xhr);
                alert('Something went wrong!');
            }
        });
    }
});

$(document).on('click', '.cd-item-remove', function(e) {
    e.preventDefault();
    const productId = $(this).data('id');
    $.ajax({
        url: cart_remove,
        type: 'POST',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            product_id: productId
        },
        success: function (response) {
            alert('Product removed from cart!');
            $('.cart-items-container').html(response.cart_html);
            updateCartTotal();
            let checkbox = $(`.add_to_cart[data-id="${productId}"]`);
            checkbox.prop('checked', false).prop('disabled', false);
        }
    });
});
$(document).ready(function () {
    updateCartTotal();

  $('#checkoutForm').on('submit', function (e) {
    e.preventDefault();

    let form = $(this);
    let formData = form.serialize();

    $.ajax({
      type: 'POST',
      url: order_store, 
      data: formData,
      beforeSend: function () {
        form.find('button[type="submit"]').prop('disabled', true).text('Placing Order...');
      },
      success: function (response) {
        $('#checkoutModal').modal('hide');
        alert('Order placed successfully!');
        window.location.reload();
      },
      error: function (xhr) {
        form.find('button[type="submit"]').prop('disabled', false).text('Place Order');
        if (xhr.status === 422) {
          let errors = xhr.responseJSON.errors;
          let msg = '';
          $.each(errors, function (key, value) {
            msg += value + '\n';
          });
          alert(msg);
        } else {
          alert('Something went wrong. Please try again.');
        }
      }
    });
  });


});

function updateCartTotal() {
    let total = 0;
    $('.cd-cart-items li').each(function () {
        let priceText = $(this).find('.cd-price').text();
        let price = parseFloat(priceText.replace(/[^0-9.-]+/g, "")) || 0;
        total += price;
    });
    $('.cd-cart-total span').text(total.toFixed(2));
}


