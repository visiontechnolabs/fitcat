<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <!-- Slide 1 -->
    <div class="carousel-item active" style="background-image: url('<?= base_url('uploads/slider/1752841265_new_one.jpg'); ?>
');">
      <div class="carousel-caption">
        <h1>Reliable & Affordable Plumbing Services!</h1>
        <p>Expert plumbing solutions for homes & businesses—fast, professional, and available 24/7!</p>
        <button class="btn btn-warning me-2">Book Now</button>
        <button class="btn btn-outline-light">Explore Services</button>
      </div>
    </div>
    <!-- Slide 2 -->
    <div class="carousel-item" style="background-image: url('<?= base_url('uploads/slider/1752841265_new_one.jpg'); ?>
');">
      <div class="carousel-caption">
        <h1>Quick & Reliable Services at Your Doorstep!</h1>
        <p>From home cleaning to car repairs, get expert professionals whenever you need them.</p>
        <button class="btn btn-warning me-2">Book Now</button>
        <button class="btn btn-outline-light">Explore Services</button>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>

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
    <h2 class="fw-bold"> Experts Nearby</h2>
    <p class="text-primary mb-4">Trusted Professionals Ready To Assist You Anytime, Anywhere!</p>

    <div class="row g-4">
      <!-- Expert 1 -->
      <div class="col-md-4">
        <div class="expert-card">
          <div class="w-100">
            <div class="expert-left">
              <div class="expert-logo bg-primary">
                <i class="fa fa-bolt text-white fs-4"></i>
              </div>
              <div>
                <div class="expert-title">Big Brand Electronic Service</div>
                <div class="expert-services">08 Services</div>
              </div>
            </div>
            <div class="expert-footer">
              <span><i class="fa fa-star"></i> 5.0</span>
              <span><i class="fa fa-map-marker-alt text-primary"></i> 300 Km</span>
              <span class="arrow-icon"><i class="fa fa-chevron-right"></i></span>
            </div>
          </div>
        </div>
      </div>

      <!-- Expert 2 -->
      <div class="col-md-4">
        <div class="expert-card">
          <div class="w-100">
            <div class="expert-left">
              <div class="expert-logo bg-dark">
                <i class="fa fa-cogs text-white fs-4"></i>
              </div>
              <div>
                <div class="expert-title">Piston Car Service</div>
                <div class="expert-services">13 Services</div>
              </div>
            </div>
            <div class="expert-footer">
              <span><i class="fa fa-star"></i> 5.0</span>
              <span><i class="fa fa-map-marker-alt text-primary"></i> 300 Km</span>
              <span class="arrow-icon"><i class="fa fa-chevron-right"></i></span>
            </div>
          </div>
        </div>
      </div>

      <!-- Expert 3 -->
      <div class="col-md-4">
        <div class="expert-card">
          <div class="w-100">
            <div class="expert-left">
              <div class="expert-logo bg-warning">
                <i class="fa fa-cut text-dark fs-4"></i>
              </div>
              <div>
                <div class="expert-title">QUB Saloon</div>
                <div class="expert-services">13 Services</div>
              </div>
            </div>
            <div class="expert-footer">
              <span><i class="fa fa-star"></i> 5.0</span>
              <span><i class="fa fa-map-marker-alt text-primary"></i> 300 Km</span>
              <span class="arrow-icon"><i class="fa fa-chevron-right"></i></span>
            </div>
          </div>
        </div>
      </div>
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
                <span class="mx-auto"><i class="fa fa-map-marker-alt text-primary"></i>
                  <?= $provider->distance ?? 'N/A'; ?> Km</span>
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
                <span class="mx-auto"><i class="fa fa-map-marker-alt text-primary"></i>
                  <?= $provider->distance ?? 'N/A'; ?> Km</span>
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