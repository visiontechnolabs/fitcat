<div class="container">
    <div class="login-box">
      <div class="login-logo mb-3">
        <img src="http://localhost/fitcat/assets/images/logo_ficat.png" alt="Logo" />
      </div>
      <!-- <h5 class="mb-1 fw-bold">Admin</h5> -->
      <p class="text-muted mb-3 fw-bold">Please log in to your account</p>
      <form action="<?= base_url('login/send_otp') ?>" method="post">
        <div class="mb-3 text-start">
          <label for="mobile" class="form-label">Mobile</label>
          <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter your mobile" required>
        </div>
        <button type="submit" class="btn btn-primary">Send OTP</button>
      </form>
      <div class="signup-link">
        Don't have an account yet? <a href="<?= base_url('sign_in');?>">Sign up here</a>
      </div>
    </div>
  </div>