<style>
    @media (max-width: 767.98px) {
    .cart-item {
        padding: 1rem 0.5rem !important;
        font-size: 0.97rem;
    }
    .cart-summary {
        font-size: 1rem;
    }
    .cart-summary .mb-2, .cart-summary .mb-3 {
        font-size: 1rem;
    }
}

</style>
<div class="container py-5">
    <h3 class="mb-4">Your Cart Items</h3>
    <div class="row">
        <!-- Cart Items List -->
        <div class="col-12 col-lg-8">
            <?php if (!empty($cart_items)) { ?>
                <?php 
                $subtotal = 0;
                $duration_items = [];
                foreach ($cart_items as $index => $item) {
                    $item_total = $item['price'] * $item['qty'];
                    $subtotal += $item_total;
                    // Group by duration & allow multiple same-duration entries
                    $d = $item['duration'];
                    if (!isset($duration_items[$d])) $duration_items[$d] = [];
                    $duration_items[$d][] = [
                        'name' => $item['name'],
                        'qty' => $item['qty'],
                        'price' => $item['price'],
                        'item_total' => $item_total
                    ];
                }
                $total = $subtotal;
                ?>
                <?php foreach ($cart_items as $index => $item) { ?>
                <div class="card mb-3 cart-item p-3">
                  <div class="row g-0 align-items-center">
                    <div class="col-12 col-md-2 text-center d-flex flex-column align-items-center justify-content-center mb-2 mb-md-0">
                        <small class="text-muted mb-1">Provider name</small>
                        <div class="ratio ratio-1x1 mb-2" style="width:60px;">
                            <img src="<?= $item['image']; ?>" alt="<?= $item['name']; ?>" class="img-fluid rounded-circle object-fit-cover">
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-2 mb-md-0">
                        <div class="fw-bold mb-1" style="font-size:1.1rem"><?= $item['name']; ?></div>
                        <div><small class="text-muted">Start Date:</small>
                            <span class="fw-semibold"><?= $item['start_date']; ?></span>
                        </div>
                    </div>
                    <div class="col-6 col-md-2 text-md-center mb-2 mb-md-0">
                        <small class="text-muted d-block mb-1">Price / Duration</small>
                        <span class="fw-bold text-dark" style="font-size:1rem;">₹<?= $item['price']; ?>/<?= $item['duration']; ?></span>
                    </div>
                    <div class="col-6 col-md-2 d-flex flex-column align-items-md-center align-items-start mb-2 mb-md-0">
                        <small class="text-muted mb-1">Quantity</small>
                        <input type="text" class="form-control text-center" value="<?= $item['qty']; ?>" style="width:60px;" readonly>
                    </div>
                    <div class="col-12 col-md-2 text-end">
                        <a href="<?= site_url('cart/clear_cart/'.$index); ?>" class="btn btn-danger btn-sm mt-2 mt-md-0">Remove</a>
                    </div>
                  </div>
                </div>
                <?php } ?>
            <?php } else { ?>
                <p>No items in the cart.</p>
            <?php } ?>
        </div>

        <!-- Cart Summary -->
        <div class="col-12 col-lg-4 mt-4 mt-lg-0">
            <div class="cart-summary">
                <h5>Summary</h5>
                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal</span>
                    <span>₹<?= $subtotal ?? 0; ?></span>
                </div>
                <!-- Duration-wise with per-item breakdown -->
                <?php if (!empty($duration_items)) { ?>
                    <div class="mb-2">
                        <?php foreach ($duration_items as $dur => $items): ?>
                            <div><strong><?= ucfirst($dur) ?></strong></div>
                            <?php foreach ($items as $item): ?>
                                <div class="d-flex justify-content-between ms-3">
                                    <span><?= $item['name'] ?> x<?= $item['qty'] ?></span>
                                    <span>₹<?= $item['item_total'] ?></span>
                                </div>
                            <?php endforeach; ?>
                            <hr class="my-2"/>
                        <?php endforeach; ?>
                    </div>
                <?php } ?>
                <div class="d-flex justify-content-between mb-3">
                    <strong>Total</strong>
                    <strong>₹<?= $total ?? 0; ?></strong>
                </div>
                <button class="btn btn-primary w-100"
                    <?= ($subtotal ?? 0) == 0 ? 'disabled' : 'type="button"'; ?>
                    onclick="window.location.href='<?= site_url('cart/pay'); ?>'">
                    Pay Now
                </button>
            </div>
        </div>
    </div>
</div>
