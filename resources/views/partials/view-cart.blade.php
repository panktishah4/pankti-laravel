<!-- Offcanvas fixed to right side, always visible -->
<div class="offcanvas offcanvas-end show" id="offcanvasCart"
     style="visibility: visible; position: fixed; top: 0; bottom: 0; right: 0; width: 350px; z-index: 1045; background: white; box-shadow: -2px 0 10px rgba(0,0,0,0.1);">

  <div class="offcanvas-header border-bottom m-3">
    <h5 class="offcanvas-title" id="offcanvasCartLabel">Cart Items</h5>
    <!-- Optional close button -->
    <!-- <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button> -->
  </div>

  <div class="offcanvas-body d-flex flex-column justify-content-between">

   <ul class="cd-cart-items list-unstyled">
    @forelse (session('cart',[]) as $key => $cart)
        <li class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
        <div>
            <strong class="cd-qty">1x</strong> {{ $cart['name'] }}
            <div class="cd-price text-muted">${{ number_format($cart['price'], 2) }}</div>
        </div>
        <button type="button" class="btn btn-sm btn-outline-danger cd-item-remove" data-id="{{ $key }}" title="Remove">
            <i class="bi bi-x-lg"></i> {{-- Bootstrap Icons --}}
        </button>
        </li>
    @empty
        <div>No items have been added to cart.</div>
    @endforelse
    </ul>


    <div class="mt-auto">
      <div class="cd-cart-total border-top pt-3 mb-3">
        <p class="mb-1 fw-bold">Total: <span><!-- total price here --></span></p>
      </div>

      <!-- <a href="javascript:void(0)" class="btn btn-primary w-100 mb-2 checkout-btn">Checkout</a> -->
     
     <button type="button" class="btn btn-primary checkout-btn w-100 mb-2" data-toggle="modal" data-target="#checkoutModal">
            Checkout
    </button>

<!-- Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="" id="checkoutForm">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Checkout Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" placeholder="Please enter name" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" placeholder="Please enter email" required>
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" name="phone" class="form-control" placeholder="Please enter phone number" required>
          </div>
          <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" name="city" class="form-control" placeholder="Please enter city" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Place Order</button>
        </div>
      </div>
    </form>
  </div>
</div>
</div>

