<div class="breadcrumb-container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 ms-5">
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item">
                <a href="#">Providers</a>
            </li>
        </ol>
    </nav>

</div>

<div class="container mt-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-3 px-2 px-md-0">
        <div>
            <h4 class="fw-bold mb-1">All Providers</h4>
            <p class="text-muted">9 of 10 Providers</p>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="row align-items-center gx-3 px-2 px-md-0">
        <div class="col-md-9 mb-2 mb-md-0">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0">
                    <i class="bi bi-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-start-0" placeholder="Search Here">
                <button class="btn btn-light border ms-2">Search</button>
            </div>
        </div>
        <div class="col-md-3 d-flex align-items-center">
            <label class="me-2 text-muted mb-0">Filter</label>
            <select class="form-select">
                <option selected>Popularity</option>
                <option value="1">Newest</option>
                <option value="2">Rating</option>
                <option value="3">Alphabetical</option>
            </select>
        </div>
    </div>
</div>

<div class="container mt-5" style="background-color:#0277fa12;">
    <div class="row g-4">
        <?php foreach ($provider as $row): ?>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-4 p-3 h-100">
                    <div class="d-flex align-items-center">
                        <a href="<?= site_url('provider_details/' . $row['provider_id']) ?>">
                            <img src="<?= base_url($row['profile_image']) ?>" alt="<?= $row['gym_name'] ?>"
                                class="rounded-3 me-3" style="width:60px; height:60px; object-fit: cover;">
                        </a>
                        <div class="flex-grow-1">
                            <h6 class="font-semibold text-xl line-clamp-1 fw-bold">
                                <a href="<?= site_url('provider_details/' . $row['provider_id']) ?>"
                                    class="text-dark text-decoration-none">
                                    <?= ucfirst($row['gym_name']) ?>
                                </a>
                            </h6>
                            <a href="#" class="primary_text_color service-link"><?= $row['service_count'] ?> Services</a>
                        </div>
                    </div>
                    <hr class="my-3" />
                    <div class="d-flex justify-content-between align-items-center text-muted small px-1">
                        <span><i class="fa fa-star text-warning me-1"></i>5.0</span>
                        <span><i class="fa fa-map-marker-alt text-primary me-1"></i>300 Km</span>
                        <a href="<?= site_url('provider_details/' . $row['provider_id']) ?>"
                            class="view-more-btn d-inline-flex align-items-center">
                            <span class="text-warning"><i class="fa fa-chevron-right"></i></span>
                            <span class="view-more-text ms-2 fw-bold text-primary">View More</span>
                        </a>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>



</div>

</div>