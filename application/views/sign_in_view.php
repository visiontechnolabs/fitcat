<div class="container">
    
    <div class="register-box text-center">
        <?php if ($this->session->flashdata('error')): ?>
                                    <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="font-35 text-white"><i class="bx bxs-error"></i></div>
                                            <div class="ms-3">
                                                <!-- <h6 class="mb-0 text-white">Error Alert</h6> -->
                                                <div class="text-white">
                                                    <?= $this->session->flashdata('error'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>
      <!-- Logo -->
      <div class="register-logo mb-3">
        <img src="http://localhost/fitcat/assets/images/logo_ficat.png" alt="Fitcket Logo">
      </div>

      <!-- Heading -->
      <h5 class="fw-bold">User Registration</h5>

      <!-- Form -->
      <form id="registrationForm" method="post" action="<?= base_url('login/register_user');?> " novalidate class="needs-validation mt-4">
  <div class="row g-2 mb-3">
    <div class="col-md-6">
      <input type="text" class="form-control" placeholder="First Name" name="first_name" required>
    </div>
    <div class="col-md-6">
      <input type="text" class="form-control" placeholder="Last Name" name="last_name" required>
    </div>
  </div>
  <div class="mb-3">
    <input type="tel" class="form-control" placeholder="Mobile" name="mobile" required>
  </div>
  <div class="mb-3">
    <input type="email" class="form-control" placeholder="example@user.com" name="email" required>
  </div>
  <button type="submit" class="btn btn-primary">Sign up</button>
</form>
    

      <!-- Footer text -->
      <div class="bottom-text">
        Already have an account? <a href="<?= base_url('login');?>">Sign in here</a>
      </div>
    </div>
  </div>