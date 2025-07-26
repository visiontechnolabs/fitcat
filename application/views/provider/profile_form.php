<!--start page wrapper -->
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
<div class="page-wrapper">
    <div class="page-content">

        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="<?= base_url('provider/dashboard'); ?>"><i
                                    class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Card -->
        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title mb-4">Profile</h5>
               <form id="ProfileForm" method="post" enctype="multipart/form-data" novalidate>
    <div class="row g-3">
        <!-- Profile Photo -->
        <div class="col-md-6">
            <label class="form-label">Profile Photo</label>
            <input type="file" class="form-control" name="profile_image" id="profileImageInput"
                accept="image/*">
            <div class="mt-2">
                <img id="previewImage"
                    src="<?= !empty($profile->profile_image) ? base_url($profile->profile_image) : '' ?>"
                    alt="Profile Preview"
                    style="max-width: 150px; height: auto; <?= empty($profile->profile_image) ? 'display: none;' : '' ?>">
            </div>
        </div>

        <!-- First Name -->
        <div class="col-md-6">
            <label class="form-label">Partner First Name</label>
            <input type="text" class="form-control" name="first_name"
                value="<?= isset($provider->name) ? explode(' ', $provider->name)[0] : '' ?>"
                placeholder="Enter First Name" required>
            <input type="hidden" name="id" value="<?= isset($provider->id) ? $provider->id : '' ?>">
        </div>

        <!-- Last Name -->
        <div class="col-md-6">
            <label class="form-label">Partner Last Name</label>
            <input type="text" class="form-control" name="last_name"
                value="<?= isset($provider->name) && isset(explode(' ', $provider->name)[1]) ? explode(' ', $provider->name)[1] : '' ?>"
                placeholder="Enter Last Name" required>
        </div>

        <!-- Business Name -->
        <div class="col-md-6">
            <label class="form-label">Business Name</label>
            <input type="text" class="form-control" name="gym_name"
                value="<?= $provider->gym_name ?? '' ?>" placeholder="Enter Business Name" required>
        </div>

        <!-- Email -->
        <div class="col-md-6">
            <label class="form-label">Partner Email</label>
            <input type="email" class="form-control" name="email" value="<?= $provider->email ?? '' ?>"
                placeholder="Enter Email" required>
        </div>

        <!-- Mobile -->
        <div class="col-md-6">
            <label class="form-label">Partner Mobile</label>
            <input type="text" class="form-control" name="mobile" value="<?= $provider->mobile ?? '' ?>"
                placeholder="Enter Mobile Number" required>
        </div>

        <!-- Category -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Select Category</label>
            <select name="category" id="categorySelect" class="form-select" required>
                <option value="">-- Select Category --</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat->id ?>" <?= isset($profile->category) && $profile->category == $cat->id ? 'selected' : '' ?>>
                        <?= $cat->name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Subcategory (populated dynamically) -->
        <div class="col-md-6 mb-3" id="subcategoryWrapper" style="display: none;">
            <label class="form-label">Select Sub Category</label>
            <select name="subcategory" id="subcategorySelect" class="form-select" required>
                <option value="">-- Select Subcategory --</option>
            </select>
        </div>
        <script>
        // After subcategories are loaded via AJAX based on category, set selected value if present in PHP
        $(function() {
            <?php if(!empty($profile->sub_category)): ?>
                // Wait for AJAX to populate subcategory select, then set the value
                setTimeout(function() {
                    $('#subcategorySelect').val('<?= $profile->sub_category ?>');
                }, 500); // adjust timing as per your AJAX implementation
            <?php endif; ?>
        });
        </script>

        <!-- Description -->
        <div class="col-md-6">
            <label class="form-label">Business Description</label>
            <textarea class="form-control" name="description" rows="3" placeholder="Enter Description" required><?= $profile->description ?? '' ?></textarea>
        </div>

        <!-- Expertise Tags -->
        <div class="col-md-6">
            <label class="form-label">Expertise Tags</label>
            <?php
            $tags = '';
            if (!empty($expertis)) {
                $tags = implode(',', array_map(function($row){ return $row->tag; }, $expertis));
            }
            ?>
            <input type="text" id="expertiseTags" class="form-control" name="expertise_tags"
                value="<?= htmlspecialchars($tags) ?>" placeholder="Enter tags" required>
        </div>

        <!-- City Availability (multi-select) -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Availability in City</label>
            <?php
            $selected_cities = isset($profile->city) ? explode(',', $profile->city) : [];
            ?>
            <select name="availability[]" id="citySelect" class="form-select" multiple required>
                <?php foreach ($city as $c): ?>
                    <option value="<?= $c->city ?>" <?= in_array($c->city, $selected_cities) ? 'selected' : '' ?>>
                        <?= $c->city ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Pricing Fields -->
        <div class="col-md-3">
            <label class="form-label">1 Day Price</label>
            <input type="number" class="form-control" name="price_day" value="<?= $profile->day_price ?? '' ?>" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">1 Week Price</label>
            <input type="number" class="form-control" name="price_week" value="<?= $profile->week_price ?? '' ?>" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">1 Month Price</label>
            <input type="number" class="form-control" name="price_month" value="<?= $profile->month_price ?? '' ?>" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">1 Year Price</label>
            <input type="number" class="form-control" name="price_year" value="<?= $profile->year_price ?? '' ?>" required>
        </div>

        <!-- Submit Buttons -->
        <div class="col-12 d-flex justify-content-end gap-2 mt-4">
            <button type="submit" class="btn btn-success">✅ Update</button>
            <a href="<?= base_url('provider/dashboard'); ?>" class="btn btn-danger">❌ Cancel</a>
        </div>
    </div>
</form>

            </div>
        </div>

    </div>
</div>
<!--end page wrapper -->