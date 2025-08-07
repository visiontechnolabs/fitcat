<style>
    .profile-card {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
    }
    .profile-img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        background: #f5f5f5;
        margin-bottom: 15px;
    }
    .profile-sidebar {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
    }
    .nav-link.active {
        background-color: #007bff;
        color: #fff !important;
        border-radius: 8px;
    }
    @media (max-width: 768px) {
        .desktop-view { display: none; }
    }
    @media (min-width: 769px) {
        .mobile-view { display: none; }
    }
</style>
<div class="container mt-4">

  <!-- ✅ Mobile View -->
  <div class="mobile-view">
    <div class="profile-card">
      <img src="https://via.placeholder.com/100" class="profile-img" alt="Profile">
      <h5 class="mb-1">Rvi Mawar</h5>
      <p class="text-muted small mb-1">rvimawar99@gmail.com</p>
      <p class="text-muted small">8160348895</p>
      <a href="#" class="btn btn-outline-primary btn-sm mt-2">Edit Profile</a>
    </div>

    <div class="mt-3">
      <button class="btn btn-light w-100 mb-2">💬 Chat with Providers</button>
      <button class="btn btn-outline-primary w-100 mb-2">📅 My Bookings</button>
      <button class="btn btn-light w-100">🔖 Bookmarks</button>
    </div>
  </div>

  <!-- ✅ Desktop View -->
  <div class="desktop-view row">
    <div class="col-md-3">
      <div class="profile-sidebar">
        <img src="https://via.placeholder.com/100" class="profile-img" alt="Profile">
        <h5 class="mb-1">Rvi Mawar</h5>
        <p class="text-muted small mb-1">rvimawar99@gmail.com</p>
        <p class="text-muted small">8160348895</p>
        <a href="#" class="btn btn-outline-primary btn-sm mt-2 w-100">Edit Profile</a>

        <hr>
        <!-- <button class="btn btn-light w-100 mb-2">💬 Chat with Providers</button> -->
        <button class="btn btn-outline-primary w-100 mb-2">📅 My Bookings</button>
        <!-- <button class="btn btn-light w-100">🔖 Bookmarks</button> -->
      </div>
    </div>

    <div class="col-md-9">
      <div class="card p-4">
        <h4>Bookings</h4>
        
        <div class="text-center mt-4">
          <img src="https://cdn-icons-png.flaticon.com/512/4076/4076503.png" width="120" alt="No bookings">
          <p class="mt-3">No bookings found.</p>
        </div>
      </div>
    </div>
  </div>

</div>