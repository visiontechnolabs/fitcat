<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FITCKET your onestop destintion to serch & book trainer</title>
  <link rel="icon" href="<?= base_url('assets/images/dumbbell_8729453.png') ?>" type="image/png">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <style>
    .top-bar {
      background-color: #007bff;
      color: #fff;
      font-size: 14px;
      padding: 13px 80px;
    }

    .top-bar a {
      color: #fff;
      text-decoration: underline;
      margin-right: 15px;
    }

    .logo {
      font-weight: bold;
      font-size: 22px;
      color: #0d47a1;
    }

    .nav-link.active {
      color: #007bff !important;
      border-bottom: 2px solid #007bff;
    }

    .cart-icon {
      position: relative;
      font-size: 20px;
    }

    .cart-badge {
      position: absolute;
      top: -8px;
      right: -10px;
      background: red;
      color: #fff;
      font-size: 12px;
      padding: 2px 5px;
      border-radius: 50%;
    }

    .account-btn {
      background: #eaf2ff;
      color: #007bff;
      border: none;
      padding: 6px 12px;
      border-radius: 5px;
    }

    .carousel-item {
      height: 85vh;
      background-size: cover;
      background-position: center;
      position: relative;
    }

    .carousel-caption {
      position: absolute;
      top: 30%;
      left: 10%;
      text-align: left;
    }

    .carousel-caption h1 {
      font-size: 48px;
      font-weight: bold;
      color: #fff;
    }

    .carousel-caption p {
      font-size: 18px;
      color: #fff;
      margin-bottom: 20px;
    }

    .carousel-caption .btn {
      padding: 10px 25px;
      font-weight: bold;
    }

    .search-bar-container {
      position: absolute;
      bottom: -30px;
      left: 50%;
      transform: translateX(-50%);
      width: 80%;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
      padding: 15px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .search-bar-container input {
      border: none;
      box-shadow: none;
    }

    .search-bar-container button {
      padding: 10px 30px;
    }

    @media (max-width: 768px) {
      .carousel-caption h1 {
        font-size: 30px;
      }

      .search-bar-container {
        flex-direction: column;
      }
    }

    /* service section */
    .services-section {
      background-color: #f0f8ff;
      padding: 60px 0;
    }

    .service-card {
      background: #fff;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s ease;
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .service-card:hover {
      transform: translateY(-5px);
    }

    .service-icon {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
      color: #fff;
    }

    .service-title {
      font-weight: 600;
      font-size: 18px;
      margin-bottom: 4px;
    }

    .service-subtitle {
      font-size: 14px;
      color: #555;
    }

    /* service end */
    /* near by section */
    .experts-section {
      padding: 60px 0;
    }

    .expert-card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.05);
      padding: 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      border: 1px solid #eee;
      transition: transform 0.3s ease;
    }

    .expert-card:hover {
      transform: translateY(-5px);
    }

    .expert-left {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .expert-logo {
      width: 60px;
      height: 60px;
      border-radius: 8px;
      background-color: #f1f1f1;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .expert-title {
      font-weight: 600;
      font-size: 18px;
      margin-bottom: 4px;
    }

    .expert-services {
      font-size: 14px;
      color: #007bff;
    }

    .expert-footer {
      margin-top: 10px;
      font-size: 14px;
      display: flex;
      justify-content: space-between;
      color: #555;
      border-top: 1px solid #eee;
      padding-top: 10px;
    }

    .expert-footer i {
      color: #fbbf24;
    }

    .arrow-icon {
      color: #888;
      font-size: 18px;
    }

    /* near by end */
    /* edemand banner */
    .edemand-banner {
      background: linear-gradient(90deg, #0052cc, #007bff);
      color: white;
      border-radius: 12px;
      padding: 40px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .banner-text h2 {
      font-size: 2rem;
      font-weight: bold;
    }

    .banner-text p {
      font-size: 1.1rem;
      margin: 15px 0;
    }

    .buy-btn {
      background: yellow;
      color: black;
      font-weight: 600;
      padding: 10px 20px;
      border-radius: 50px;
      border: none;
    }

    .banner-images img {
      max-height: 300px;
      margin: 0 10px;
    }

    @media (max-width: 768px) {

      .banner-text,
      .banner-images {
        text-align: center;
        width: 100%;
      }

      .banner-images img {
        max-height: 200px;
      }
    }

    /* banner end */
    .breadcrumb-container {
      background: #f0f6ff;
      padding: 15px 30px;
      font-size: 1rem;
    }

    .breadcrumb-item+.breadcrumb-item::before {
      content: ">";
      color: #000;
      padding: 0 8px;
    }

    .breadcrumb-item a {
      text-decoration: none;
      color: #007bff;
    }

    .breadcrumb-item.active {
      color: #000;
      font-weight: 600;
    }

    .service-link {
      text-decoration: none;
    }

    .service-link:hover {
      text-decoration: underline;
    }

    .view-more-btn {
      position: relative;
      cursor: pointer;
    }

    .view-more-text {
      display: none;
      /* color: #0e17c8a0; same as text-warning */
      text-decoration: underline;
      transition: opacity 0.3s ease;
    }

    .view-more-btn:hover .view-more-text {
      display: inline;
      opacity: 1;
    }

    /* provider end */
    /* login page */
    .login-box {
      max-width: 400px;
      margin: 100px auto;
      padding: 30px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .login-logo img {
      width: 100px;
      margin-bottom: 10px;
    }

    .form-control:focus {
      box-shadow: none;
    }

    .btn-primary {
      width: 100%;
    }

    .signup-link {
      margin-top: 15px;
      font-size: 0.9rem;
    }

    /* login end */

    /* register page */
    .register-box {
      max-width: 500px;
      margin: 80px auto;
      padding: 30px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .register-logo img {
      height: 50px;
    }

    .form-control:focus {
      box-shadow: none;
    }

    .btn-primary {
      width: 100%;
    }

    .bottom-text {
      font-size: 0.9rem;
      margin-top: 15px;
    }

    .cart-item img {
      width: 100px;
      height: 100px;
      object-fit: cover;
    }

    .cart-summary {
      background: #f8f9fa;
      padding: 20px;
      border-radius: 10px;
    }

    .btn-qty {
      width: 35px;
      height: 35px;
      padding: 0;
      text-align: center;
    }
  </style>
</head>

<body>
  <!-- Top Bar -->
  <div class="top-bar d-flex justify-content-between align-items-center">
    <a href="<?= base_url('provider/sing_up'); ?>" style="font-size: 1rem;
    line-height: 1.5rem;"><i class="fa fa-user-gear me-1"></i> Become Provider</a>
    <div class="d-flex align-items-center">
      <select class="form-select form-select-sm me-2" style="width: auto;">
        <option>English</option>
        <option>Hindi</option>
      </select>
      <i class="fa fa-sun me-2"></i>
      <div class="form-check form-switch m-0">
        <input class="form-check-input" type="checkbox">
      </div>
    </div>
  </div>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container">
      <!-- Logo -->
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="<?= base_url('assets/images/logo_ficat.png'); ?>" alt="logo" style="width:100px;height:50px"
          class="me-2">
        <!-- <span class="logo">eDemand <small class="text-muted d-block" style="font-size:12px;">Home service</small></span> -->
      </a>

      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Menu -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <?php
        $segment = $this->uri->segment(1);
        ?>
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link <?= ($segment == '' ? 'active' : '') ?>" href="<?= base_url(); ?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= ($segment == 'services' ? 'active' : '') ?>"
              href="<?= base_url('services'); ?>">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= ($segment == 'providers' ? 'active' : '') ?>"
              href="<?= base_url('providers'); ?>">Providers</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= ($segment == 'about-us' ? 'active' : '') ?>"
              href="<?= base_url('about-us'); ?>">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= ($segment == 'contact-us' ? 'active' : '') ?>"
              href="<?= base_url('contact-us'); ?>">Contact Us</a>
          </li>
        </ul>


        <!-- Cart and Account -->
        <div class="d-flex align-items-center">
          <div class="cart-icon me-3">
            <i class="fa fa-shopping-cart text-primary"></i>
            <span class="cart-badge">1</span>
          </div>
          <?php
          $is_logged_in = isset($this->user);
          ?>
          <div class="dropdown">
            <?php if ($is_logged_in): ?>
              <!-- Show dropdown if user is logged in -->
              <button class="account-btn dropdown-toggle btn btn-outline-secondary" data-bs-toggle="dropdown">
                <i class="fa fa-user me-1"></i> Account
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">My Bookings</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
              </ul>
            <?php else: ?>
              <!-- Show login button if not logged in -->
              <a href="<?= base_url('login'); ?>" class="btn btn-outline-primary">
                <i class="fa fa-user me-1"></i> Login
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </nav>