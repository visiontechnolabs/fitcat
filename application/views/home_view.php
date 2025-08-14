<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
  <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <?php $first = true; ?>
      <?php foreach ($sliders as $slide): ?>
        <div class="carousel-item <?= $first ? 'active' : '' ?>"
          style="background-image: url('<?= base_url('uploads/slider/' . $slide->slider_image); ?>');">
          <div class="carousel-caption">
            <h1><?= htmlspecialchars($slide->slider_title) ?></h1>
            <p><?= htmlspecialchars($slide->sub_title) ?></p>
            <a href="<?= base_url('providers'); ?>" class="btn btn-warning me-2">Book Now</a>
            <a href="<?= base_url('services'); ?>" class="btn btn-outline-light">Explore Services</a>

          </div>
        </div>
        <?php $first = false; ?>
      <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>


  <!-- Floating Search Bar -->
  <div class="search-bar-container">
    <div class="input-group flex-grow-1">
      <span class="input-group-text bg-white"><i class="fa fa-map-marker-alt"></i></span>
      <input type="text" id="locationInput" class="form-control" placeholder="Fetching location..."
        value="<?= !empty($user_location) ? $user_location : ''; ?>">
    </div>
    <div class="input-group flex-grow-1">
      <span class="input-group-text bg-white"><i class="fa fa-search"></i></span>
      <input type="text" class="form-control" placeholder="Search Service">
    </div>
    <button class="btn btn-primary">Search</button>
  </div>
</div>

<!-- service section -->
<section class="services-section">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h2 class="fw-bold">Choose Your Category</h2>
        <p class="text-primary">Discover tailored servicess for your needs</p>
      </div>
      <a href="#" class="text-dark fw-semibold">View All</a>
    </div>
    <div class="row g-4">
      <?php foreach ($category as $cat): ?>
        <div class="col-md-3 col-sm-6">
          <div class="service-card">
            <div class="service-icon p-0" style="background:none;">
              <img src="<?= base_url($cat->image); ?>" alt="<?= $cat->name; ?>"
                style="width:50px; height:50px; border-radius:50%; object-fit:cover;">
            </div>
            <div>
              <div class="service-title"><?= strtoupper($cat->name); ?></div>
              <div class="service-subtitle">2 Providers</div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>


  </div>

  </div>
</section>
<!-- end service section -->
<!-- near by section -->
<section class="experts-section">
  <div class="container">
    <h2 class="fw-bold">Nearest Providers</h2>
    <p class="text-primary mb-4">Providers closest to your location!</p>

    <div class="row g-4">
      <?php foreach ($nearest_providers as $np): ?>
        <div class="col-md-4">
          <div class="expert-card">
            <div class="w-100">
              <div class="expert-left">
                <div class="expert-logo bg-primary">
                  <img src="<?= base_url($np->profile_image) ?>" class="img-fluid"
                    style="width:50px;height:50px;border-radius:50%;">
                </div>
                <div>
                  <div class="expert-title"><?= $np->gym_name ?: $np->name ?></div>
                  <div class="expert-services"><?= $np->total_services ?> Services</div>
                </div>
              </div>
              <div class="expert-footer d-flex justify-content-center align-items-center position-relative">
                <span>
                  <i class="fa fa-map-marker-alt text-primary"></i>
                  <?= round($np->distance, 1) ?> Km
                </span>
                <div class="d-flex justify-content-between align-items-center text-muted small px-1">

                  <a href="<?= site_url('provider_details/' . $np->provider_id) ?>"
                    class="view-more-btn d-inline-flex align-items-center">
                    <span class="text-warning"><i class="fa fa-chevron-right"></i></span>
                    <span class="view-more-text ms-2 fw-bold text-primary">View More</span>
                  </a>

                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- near by end -->

<!-- edemand banner -->
<section class="container my-5">
  <div class="edemand-banner">
    <!-- Left Text Section -->
    <div class="banner-text">
      <h2>Want to Become a Service Provider?</h2>
      <p>Join our eDemand platform and grow your business by reaching thousands of customers effortlessly.
        Start offering your services online with ease and flexibility.</p>
      <button class="buy-btn">Become a Provider</button>
    </div>

    <!-- Right Images Section -->
    <!-- <div class="banner-images d-flex justify-content-center mt-4 mt-md-0">
      <img src="https://via.placeholder.com/150x300" class="img-fluid" alt="Mobile App Left">
      <img src="https://via.placeholder.com/300x250" class="img-fluid" alt="Desktop App">
      <img src="https://via.placeholder.com/150x300" class="img-fluid" alt="Mobile App Right">
    </div>
  </div> -->
</section>
<!-- banner end -->

<!-- gym section -->
<section class="experts-section">
  <div class="container">
    <h2 class="fw-bold">Popular Gym</h2>
    <p class="text-primary mb-4">Trusted Professionals Ready To Assist You Anytime, Anywhere!</p>

    <div class="row g-4">
      <?php foreach ($gym_providers as $provider): ?>
        <div class="col-md-4">
          <div class="expert-card">
            <div class="w-100">
              <div class="expert-left">
                <div class="expert-logo bg-primary">
                  <img
                    src="<?= !empty($provider->image) ? base_url($provider->image) : base_url('assets/images/3d-cartoon-fitness-man.jpg'); ?>"
                    alt="<?= $provider->name; ?>" class="img-fluid rounded-circle"
                    style="width:50px;height:50px;object-fit:cover;">
                </div>
                <div>
                  <div class="expert-title"><?= $provider->gym_name; ?></div>
                  <div class="expert-services"><?= $provider->total_services ?? '0'; ?> Services</div>
                </div>
              </div>
              <div class="expert-footer d-flex justify-content-center align-items-center position-relative">
                <span>
                  <i class="fa fa-map-marker-alt text-primary"></i>
                  <?= isset($provider->distance) ? round($provider->distance, 1) . ' Km' : 'N/A' ?>
                </span>

                <div class="d-flex justify-content-between align-items-center text-muted small px-1">

                  <a href="<?= site_url('provider_details/' . $provider->provider_id) ?>"
                    class="view-more-btn d-inline-flex align-items-center">
                    <span class="text-warning"><i class="fa fa-chevron-right"></i></span>
                    <span class="view-more-text ms-2 fw-bold text-primary">View More</span>
                  </a>

                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Trainer Section -->
<section class="experts-section">
  <div class="container">
    <h2 class="fw-bold">Popular Trainer</h2>
    <p class="text-primary mb-4">Trusted Professionals Ready To Assist You Anytime, Anywhere!</p>

    <div class="row g-4">
      <?php foreach ($trainer_providers as $provider): ?>
        <div class="col-md-4">
          <div class="expert-card">
            <div class="w-100">
              <div class="expert-left">
                <div class="expert-logo bg-dark">
                  <img
                    src="<?= !empty($provider->profile_image) ? base_url($provider->profile_image) : base_url('assets/images/3d-cartoon-fitness-man.jpg'); ?>"
                    alt="<?= $provider->name; ?>" class="img-fluid rounded-circle"
                    style="width:50px;height:50px;object-fit:cover;">
                </div>
                <div>
                  <div class="expert-title"><?= $provider->gym_name; ?></div>
                  <div class="expert-services"><?= $provider->total_services ?? '0'; ?> Services</div>
                </div>
              </div>
              <div class="expert-footer d-flex justify-content-center align-items-center position-relative">
                <span>
                  <i class="fa fa-map-marker-alt text-primary"></i>
                  <?= isset($provider->distance) ? round($provider->distance, 1) . ' Km' : 'N/A' ?>
                </span>

                <div class="d-flex justify-content-between align-items-center text-muted small px-1">

                  <a href="<?= site_url('provider_details/' . $provider->provider_id) ?>"
                    class="view-more-btn d-inline-flex align-items-center">
                    <span class="text-warning"><i class="fa fa-chevron-right"></i></span>
                    <span class="view-more-text ms-2 fw-bold text-primary">View More</span>
                  </a>

                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>