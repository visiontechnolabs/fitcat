<style>
    .provider-card {
        border-radius: 10px;
        border: 1px solid #eee;
        margin-top: 80px;
    }

    .provider-img {
        width: 60%;
        /* height: 140px; */
        object-fit: cover;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .star-rating {
        color: gold;
        font-size: 14px;
    }

    .icon-btn {
        border: 1px solid #ddd;
        background: white;
        border-radius: 5px;
        padding: 5px 8px;
    }

    /* .nav-tabs .nav-link.active {
      background-color: #f8f9fa;
      border-bottom: 3px solid #007bff;
      font-weight: 600;
    } */
    .service-box {
        border: 1px solid #eee;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .service-img {
        width: 100px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
    }

    .old-price {
        text-decoration: line-through;
        color: gray;
    }

    .add-cart-btn {
        border: 1px solid #ddd;
        background-color: white;
        padding: 5px 12px;
        border-radius: 5px;
    }

    .view-more {
        color: #007bff;
        cursor: pointer;
        font-weight: 500;
    }

    .custom-tabs .nav-link {
        background-color: white;
        border-radius: 10px;
        color: black;
        font-weight: 600;
        padding: 10px 0;
        transition: background 0.3s ease;
    }

    .custom-tabs .nav-link.active {
        background-color: #007bff;
        color: white !important;
        border-radius: 10px;
    }

    .custom-tabs {
        background-color: #f0f6ff;
        padding: 10px;
        border-radius: 12px;
    }
</style>
<div class="breadcrumb-container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 ms-5">
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item">
                <a href="<?= base_url('providers'); ?>">Providers</a>
            </li>
            <li class="breadcrumb-item">
                <a href="">Provider Details</a>
            </li>
        </ol>
    </nav>

</div>

<div class="container py-4">
    <div class="row g-3">
        <!-- Left Card -->
        <div class="col-lg-4 col-md-12">
            <div class="provider-card shadow-sm">
                <!-- Hidden Provider ID -->
                <input type="hidden" name="provider_id" value="<?= $provider->provider_id; ?>">

                <!-- Gym Image -->
                <img src="<?= base_url($provider->profile_image); ?>" class="provider-img mx-auto d-block"
                    alt="<?= $provider->gym_name; ?>">

                <div class="card shadow-sm border-0 p-3">
                    <!-- Header -->
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="fw-bold mb-0"><?= $provider->gym_name; ?></h5>
                        <a href="#" class="text-primary fw-bold small"><?= $provider->service_count; ?> Services</a>
                    </div>

                    <!-- Location -->
                    <div class="text-muted mb-3">
                        <i class="fa fa-location-dot me-2 text-primary"></i>
                        <?= $city; ?>, <?= $state; ?>
                    </div>

                    <!-- Description -->
                    <p class="text-muted small mb-2 text-truncate-3"
                        style="overflow: hidden; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                        <?= $provider->description; ?>
                    </p>
                    <a href="#about" class="text-primary fw-bold small d-inline-block" onclick="openAboutTab()">Read
                        More</a>

                    <!-- Expertise Tags -->
                    <?php $tags = explode(',', $provider->expertise_tags); ?>
                    <div class="mt-3">
                        <h6 class="fw-bold mb-2">Expertise</h6>
                        <div class="d-flex flex-wrap gap-2">
                            <?php foreach ($tags as $tag): ?>
                                <span
                                    class="badge rounded-pill bg-light text-primary border px-3 py-2"><?= trim($tag); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Section -->
        <div class="col-lg-8 col-md-12">
            <!-- Tabs -->
            <ul class="nav nav-pills custom-tabs mb-3 justify-content-between d-flex gap-4" id="providerTabs"
                role="tablist">
                <li class="nav-item flex-fill text-center">
                    <button class="nav-link w-100 active" id="pricing-tab" data-bs-toggle="pill"
                        data-bs-target="#pricing-section" type="button">Pricing</button>
                </li>
                <li class="nav-item flex-fill text-center">
                    <button class="nav-link w-100" id="services-tab" data-bs-toggle="pill" data-bs-target="#services"
                        type="button">Services</button>
                </li>
                <li class="nav-item flex-fill text-center">
                    <button class="nav-link w-100" id="about-tab" data-bs-toggle="pill" data-bs-target="#about"
                        type="button">About</button>
                </li>
                <li class="nav-item flex-fill text-center">
                    <button class="nav-link w-100" id="schedule-tab" data-bs-toggle="pill" data-bs-target="#schedule"
                        type="button">Schedule</button>
                </li>
                <li class="nav-item flex-fill text-center">
                    <button class="nav-link w-100" id="certificate-tab" data-bs-toggle="pill"
                        data-bs-target="#certificate" type="button">Certificate</button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="tabContentArea">
                <!-- Pricing Section -->
                <div class="tab-pane fade show active" id="pricing-section" role="tabpanel"
                    aria-labelledby="pricing-tab">
                    <div class="card shadow-sm p-4 mt-3">
                        <h6 class="fw-bold mb-2 text-uppercase text-secondary">Available in Cities</h6>
                        <div class="d-flex flex-wrap gap-2">
                            <?php
                            if (!empty($provider->city)) {
                                $cities = explode(',', $provider->city); // Split cities by comma
                                foreach ($cities as $city) { ?>
                                    <span class="badge rounded-pill bg-info px-3 py-2">
                                        <?= htmlspecialchars(trim($city)); ?>
                                    </span>
                                <?php }
                            } else { ?>
                                <span class="badge bg-light text-dark border px-3 py-2">City not available</span>
                            <?php } ?>
                        </div>


                      <div class="list-group mt-5">
    <?php if (!empty($provider)) : ?>
        <label class="list-group-item">
            <input class="form-check-input me-2" type="radio" name="priceOption"
                data-price="<?= $provider->day_price; ?>"
                data-label="Day" checked>
            ₹<?= number_format($provider->day_price, 2); ?> <small class="text-muted">/day</small>
        </label>

        <label class="list-group-item">
            <input class="form-check-input me-2" type="radio" name="priceOption"
                data-price="<?= $provider->week_price; ?>"
                data-label="Week">
            ₹<?= number_format($provider->week_price, 2); ?> <small class="text-muted">/week</small>
        </label>

        <label class="list-group-item">
            <input class="form-check-input me-2" type="radio" name="priceOption"
                data-price="<?= $provider->month_price; ?>"
                data-label="Month">
            ₹<?= number_format($provider->month_price, 2); ?> <small class="text-muted">/month</small>
        </label>

        <label class="list-group-item">
            <input class="form-check-input me-2" type="radio" name="priceOption"
                data-price="<?= $provider->year_price; ?>"
                data-label="Year">
            ₹<?= number_format($provider->year_price, 2); ?> <small class="text-muted">/year</small>
        </label>
    <?php endif; ?>
</div>


                        <form method="post" action="<?= site_url('cart/add_to_cart'); ?>" id="cartForm">
                            <input type="hidden" name="provider_id" id="provider_id" value="<?= $provider->provider_id; ?>">
                            <input type="hidden" name="provider_name" value="<?= $provider->gym_name; ?>">
                            <input type="hidden" name="provider_image"
                                value="<?= base_url($provider->profile_image); ?>">
                            <input type="hidden" name="price" id="priceInput" value="100">
                            <input type="hidden" name="duration" id="durationInput" value="day">

                            <h6 id="selectedOption" class="fw-bold mb-2 text-uppercase text-secondary mt-4">
                                Book for Day
                            </h6>
                            <div class="input-group mb-3" style="width: 140px;">
                                <button class="btn btn-outline-primary" type="button" id="decreaseQty">-</button>
                                <input type="text" id="quantityInput" name="quantity" class="form-control text-center"
                                    value="1" readonly>
                                <button class="btn btn-outline-primary" type="button" id="increaseQty">+</button>
                            </div>

                            <h6 class="fw-bold mb-2 text-uppercase text-secondary mt-4">Start From</h6>
                            <input type="text" class="form-control" id="startDate" placeholder="dd-mm-yyyy"
                                onfocus="(this.type='date')" name="start_date" onblur="(this.type='text')">
                            <small id="dateError" class="text-danger d-none"></small>


                            <button type="button" class="btn btn-primary w-100 py-2  mt-2 fw-bold"
                                onclick="validateAndBook(<?= isset($this->user['id']) ? $this->user['id'] : '0'; ?>)">
                                Book Now
                            </button>
                        </form>




                    </div>
                </div>

                <?php
                // Pagination setup
                $servicesPerPage = 4;
                $totalServices = count($service);
                $totalPages = ceil($totalServices / $servicesPerPage);

                // Get current page from URL or set default
                $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                $current_page = max(1, min($current_page, $totalPages)); // Ensure valid range
                
                // Calculate the slice of services to display
                $start = ($current_page - 1) * $servicesPerPage;
                $paginatedServices = array_slice($service, $start, $servicesPerPage);
                ?>

                <!-- Services -->
                <div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="services-tab">
                    <?php if (!empty($paginatedServices)) { ?>
                        <?php foreach ($paginatedServices as $srv) { ?>
                            <div class="service-box shadow-sm p-3 mb-3">
                                <div class="d-flex gap-3 align-items-start">
                                    <img src="<?= base_url($srv->image); ?>" class="service-img rounded"
                                        alt="<?= $srv->name; ?>" style="width: 100px; height: 100px; object-fit: cover;">
                                    <div>
                                        <h6 class="fw-bold"><?= $srv->name; ?></h6>
                                        <p class="text-muted small mb-0"><?= $srv->description; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <p class="text-muted text-center mt-5">No services available.</p>
                    <?php } ?>

                    <!-- Pagination -->
                    <?php if ($totalPages > 1) { ?>
                        <nav class="mt-3" aria-label="Page navigation example">
                            <ul class="pagination round-pagination justify-content-center">
                                <li class="page-item  <?= ($current_page == 1) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page=<?= $current_page - 1 ?>#services">Previous</a>
                                </li>

                                <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                                    <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
                                        <a class="page-link" href="?page=<?= $i ?>#services"><?= $i ?></a>
                                    </li>
                                <?php } ?>

                                <li class="page-item <?= ($current_page == $totalPages) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page=<?= $current_page + 1 ?>#services">Next</a>
                                </li>

                            </ul>
                        </nav>
                    <?php } ?>
                </div>




                <!-- About -->
                <div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about-tab">
                    <div class="container py-4">
                        <div class="row">
                            <!-- Profile Description -->
                            <div class="col-lg-8 col-md-7 mb-4">
                                <div class="card shadow-sm border-0 h-100">
                                    <div class="card-body">
                                        <h4 class="fw-bold mb-3">About the Provider</h4>
                                        <p class="text-muted mb-0">
                                            <?= !empty($provider->description) ? $provider->description : 'No description available.'; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- Contact Info -->
                            <div class="col-lg-4 col-md-5 mb-4">
                                <div class="card shadow-sm border-0 h-100">
                                    <div class="card-header bg-primary text-white fw-bold">
                                        <i class="fa fa-address-card me-2"></i> Contact Information
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3 d-flex align-items-center">
                                            <i class="fa fa-user text-primary fs-5 me-3"></i>
                                            <div>
                                                <strong>Owner:</strong> <span><?= $provider->name; ?></span>
                                            </div>
                                        </div>
                                        <div class="mb-3 d-flex align-items-center">
                                            <i class="fa fa-envelope text-warning fs-5 me-3"></i>
                                            <div>
                                                <strong>Email:</strong> <span><?= $provider->email; ?></span>
                                            </div>
                                        </div>
                                        <div class="mb-3 d-flex align-items-center">
                                            <i class="fa fa-phone text-success fs-5 me-3"></i>
                                            <div>
                                                <strong>Mobile:</strong> <span><?= $provider->mobile; ?></span>
                                            </div>
                                        </div>
                                        <div class="mb-3 d-flex align-items-center">
                                            <i class="fa fa-map-marker-alt text-danger fs-5 me-3"></i>
                                            <div>
                                                <strong>Address:</strong>
                                                <div><?= $provider->address; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer p-0">
                                        <!-- Google Static Map -->
                                        <img src="https://maps.googleapis.com/maps/api/staticmap?center=<?= urlencode($provider->address); ?>&zoom=15&size=400x200&markers=color:red%7C<?= urlencode($provider->address); ?>&key=AIzaSyAR5-9XtV0r0VyR7uu0ppEKhNHanKlGwWk"
                                            class="img-fluid w-100 rounded-bottom"
                                            alt="Map of <?= $provider->address; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <!-- Schedule -->
                <div class="tab-pane fade" id="schedule" role="tabpanel" aria-labelledby="schedule-tab">
                    <div class="container py-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold">Business Hours</h5>
                            <span class="text-muted">
                                Today: <span class="text-primary">9:00 AM - 5:00 PM</span>
                            </span>
                        </div>

                        <div class="row g-3 bg-light rounded p-3">
                            <?php
                            $schedule = [
                                "Sunday" => "9:00 AM - 5:00 PM",
                                "Monday" => "9:00 AM - 5:00 PM",
                                "Tuesday" => "9:00 AM - 5:00 PM",
                                "Wednesday" => "9:00 AM - 5:00 PM",
                                "Thursday" => "9:00 AM - 5:00 PM",
                                "Friday" => "9:00 AM - 5:00 PM",
                                "Saturday" => "9:00 AM - 5:00 PM",
                            ];
                            foreach ($schedule as $day => $time): ?>
                                <div class="col-md-6">
                                    <div class="border rounded p-3 bg-white shadow-sm h-100">
                                        <h6 class="fw-bold mb-1"><?= $day; ?></h6>
                                        <p class="mb-0 text-muted"><?= $time; ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>


                <!-- Certificate -->

                <div class="tab-pane fade" id="certificate" role="tabpanel" aria-labelledby="certificate-tab">
                    <div class="container py-3">
                        <h5 class="fw-bold mb-3">Certificates</h5>
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="card shadow-sm border-0 mb-3">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-md-3">
                                            <img src="https://via.placeholder.com/150" class="img-fluid rounded-start"
                                                alt="Fitness Trainer Certificate">
                                        </div>
                                        <div class="col-md-9">
                                            <div class="card-body">
                                                <h6 class="fw-bold">Fitness Trainer Certificate</h6>
                                                <p class="text-muted small">Certified fitness trainer with 5 years of
                                                    experience.</p>
                                                <a href="#" class="btn btn-sm btn-primary">View</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="card shadow-sm border-0 mb-3">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-md-3">
                                            <img src="https://via.placeholder.com/150" class="img-fluid rounded-start"
                                                alt="Nutrition Expert">
                                        </div>
                                        <div class="col-md-9">
                                            <div class="card-body">
                                                <h6 class="fw-bold">Nutrition Expert</h6>
                                                <p class="text-muted small">Certified in nutrition and diet planning for
                                                    weight management.</p>
                                                <a href="#" class="btn btn-sm btn-primary">View</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>
</div>