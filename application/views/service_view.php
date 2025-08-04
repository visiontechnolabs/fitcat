<div class="breadcrumb-container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 ms-5">
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item">
                <a href="#">Services</a>
            </li>
        </ol>
    </nav>

</div>
<div class="container mt-4">
    <div class="row">
        <?php if (!empty($services)) { ?>
            <?php foreach ($services as $srv) { ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
    <div class="card h-100 shadow border-0">
        <img src="<?= base_url($srv->image); ?>" 
             class="card-img-top rounded-top" 
             alt="<?= $srv->name; ?>" 
             style="height: 200px; object-fit: cover;">
        <div class="card-body d-flex flex-column">
            <h5 class="card-title fw-bold"><?= $srv->name; ?></h5>
            <p class="card-text text-muted small mb-2">
                <?= $srv->description; ?>
            </p>
            <div class="text-muted small mb-3">
                <i class="fa fa-dumbbell me-2"></i><strong><?= $srv->gym_name; ?></strong>
            </div>
            
            <!-- Badges for cities -->
           <div class="mb-3">
    <div class="text-muted small mb-1 fw-bold">
        <i class="fa fa-map-marker-alt me-2"></i> 
        Services available in:
    </div>
    <div class="d-flex flex-wrap gap-1 ms-3">
        <?php foreach (explode(',', $srv->city) as $city) { ?>
            <span class="badge bg-light text-dark border"><?= trim($city); ?></span>
        <?php } ?>
    </div>
</div>

            
<button 
    class="btn btn-primary w-100 mt-auto fw-bold" 
    onclick="window.location.href='<?= base_url('provider_details/' . $srv->provider_id); ?>'">
    Book Now
</button>        </div>
    </div>
</div>

            <?php } ?>
        <?php } else { ?>
            <p class="text-center text-muted">No services available.</p>
        <?php } ?>
    </div>

</div>