<div class="container py-5">
    <h3 class="mb-4">Your Cart Items</h3>
    <div class="row">
        <!-- Cart Items -->
        <div class="col-lg-8">
            <?php if (!empty($cart_items)) { ?>
                <?php 
                $subtotal = 0; 
                foreach ($cart_items as $index => $item) { 
                    $item_total = $item['price'] * $item['qty'];
                    $subtotal += $item_total;
                ?>
                    <div class="card mb-3 cart-item p-3">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-2 text-center">
                                <img src="<?= $item['image']; ?>" alt="<?= $item['name']; ?>" class="img-fluid rounded">
                            </div>
                            <div class="col-md-4">
                                <h6 class="mb-1"><?= $item['name']; ?></h6>
                                <p class="text-muted mb-0">Booking: <?= ucfirst($item['duration']); ?></p>
                                <small class="text-muted">Start: <?= $item['start_date']; ?></small>
                            </div>
                            <div class="col-md-2">
                                <span class="fw-bold">₹<?= $item['price']; ?>/<?= $item['duration']; ?></span>
                            </div>
                            <div class="col-md-2 d-flex align-items-center">
                                <input type="text" class="form-control mx-1 text-center" value="<?= $item['qty']; ?>" style="width:50px;" readonly>
                            </div>
                            <div class="col-md-2 text-end">
                                <a href="<?= site_url('cart/clear_cart/'.$index); ?>" class="btn btn-danger btn-sm">Remove</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p>No items in the cart.</p>
            <?php } ?>
        </div>

        <!-- Summary -->
        <div class="col-lg-4">
           <div class="cart-summary">
    <h5>Summary</h5>
    <?php 
    $subtotal = isset($subtotal) ? $subtotal : 0;
    $tax = $subtotal * 0.10; // 10% tax
    $total = $subtotal + $tax;
    ?>
    <div class="d-flex justify-content-between mb-2">
        <span>Subtotal</span>
        <span>₹<?= $subtotal; ?></span>
    </div>
    <div class="d-flex justify-content-between mb-2">
        <span>Tax</span>
        <span>₹<?= $tax; ?></span>
    </div>
    <hr>
    <div class="d-flex justify-content-between mb-3">
        <strong>Total</strong>
        <strong>₹<?= $total; ?></strong>
    </div>
    <button class="btn btn-primary w-100" <?= $subtotal == 0 ? 'disabled' : ''; ?>>Proceed to Checkout</button>
</div>

        </div>
    </div>
</div>
