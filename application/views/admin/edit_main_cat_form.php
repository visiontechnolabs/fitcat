<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard'); ?>"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit Category</h5>
                <hr>
                <div class="form-body mt-4">
                    <div class="row">
                        <div class="col">
                            <form id="editCategoryForm" method="post" enctype="multipart/form-data" novalidate>
                                <input type="hidden" name="id" value="<?= $category->id; ?>">

                                <!-- Category Title -->
                                <div class="mb-3">
                                    <label for="categoryTitle" class="form-label">Category Title</label>
                                    <input type="text" name="category_title" class="form-control" id="categoryTitle"
                                        value="<?= $category->name ?>" placeholder="Enter category title" required>
                                    <div class="invalid-feedback">Please enter the category title.</div>
                                </div>

                                <!-- Category Image -->
                                <div class="mb-3">
                                    <label for="categoryImage" class="form-label">Category Image</label>
                                    <input type="file" name="image" class="form-control" id="categoryImage" accept="image/*">
                                    <div class="form-text text-danger">
                                        Please upload image in size <strong>1920px * 955px</strong> for best view.
                                    </div>
                                    <div class="invalid-feedback">Please upload a valid image.</div>
                                </div>

                                <!-- Image Preview -->
                                <div class="mb-3">
                                    <label class="form-label">Image Preview</label><br>
                                    <img id="previewImage" src="<?= base_url($category->image) ?>"
                                        alt="Preview" style="max-width: 90px; border: 1px solid #ccc; padding: 5px;" />
                                </div>

                                <!-- Submit Button -->
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success w-100">Update Category</button>
                                </div>
                            </form>
                        </div>
                    </div><!--end row-->
                </div>
            </div>
        </div>
    </div>
</div>
