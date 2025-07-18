$(document).ready(function () {
	const defaultImage = site_url + "assets/images/no-image.png";

	// Show preview on image upload
	$("#categoryImage").on("change", function (event) {
		const file = event.target.files[0];
		const preview = document.getElementById("previewImage");

		if (file) {
			const reader = new FileReader();
			reader.onload = function (e) {
				preview.src = e.target.result;
			};
			reader.readAsDataURL(file);
		} else {
			preview.src = defaultImage;
		}
	});

	// Bootstrap validation + AJAX Submit with SweetAlert
	$("#CategoryForm").on("submit", function (e) {
		e.preventDefault();

		const form = this;
		if (!form.checkValidity()) {
			form.classList.add("was-validated");
			return;
		}

		const formData = new FormData(this);

		$.ajax({
			url: site_url + "admin/category/save",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			dataType: "json", // Make sure the server returns JSON
			success: function (response) {
				if (response.status === "success") {
					Swal.fire({
						icon: "success",
						title: "Success",
						text: response.message || "Category saved successfully!",
						confirmButtonColor: "#3085d6",
						confirmButtonText: "OK",
					});

					form.reset();
					$("#previewImage").attr("src", defaultImage);
					form.classList.remove("was-validated");
				} else {
					Swal.fire({
						icon: "warning",
						title: "Notice",
						text: response.message || "Category already exists.",
						confirmButtonColor: "#d33",
						confirmButtonText: "OK",
					});
				}
			},
			error: function (xhr) {
				Swal.fire({
					icon: "error",
					title: "Oops...",
					text: "Something went wrong while saving the category.",
				});
			},
		});
	});
});
$(document).ready(function () {
	$("#SubcategoryForm").on("submit", function (e) {
		e.preventDefault();

		const form = this;
		if (!form.checkValidity()) {
			form.classList.add("was-validated");
			return;
		}

		const subcategoryTitle = $("#subcategoryTitle").val();
		const mainCategoryId = $("#mainCategory").val();

		$.ajax({
			url: site_url + "admin/category/save_sub_category",
			type: "POST",
			dataType: "json",
			data: {
				subcategory_title: subcategoryTitle,
				main_category_id: mainCategoryId,
			},
			success: function (response) {
				if (response.success === "exist") {
					Swal.fire({
						icon: "warning",
						title: "Duplicate Entry",
						text: "This subcategory already exists under the selected category.",
					});
				} else if (response.success === true) {
					Swal.fire({
						icon: "success",
						title: "Success",
						text: "Subcategory saved successfully!",
					});

					form.reset();
					form.classList.remove("was-validated");
				} else {
					Swal.fire({
						icon: "error",
						title: "Error",
						text: "Failed to save subcategory.",
					});
				}
			},
			error: function () {
				Swal.fire({
					icon: "error",
					title: "Server Error",
					text: "Something went wrong while saving the subcategory.",
				});
			},
		});
	});
});

$(document).ready(function () {
	const per_group = 3;
	let searchText = "";
	let currentPage = 1;

	function loadPage(page = 1) {
		$.ajax({
			url: site_url + "admin/category/ajax_list",
			type: "POST",
			dataType: "json",
			data: { page, search: searchText },
			success: function (res) {
				currentPage = res.current_page;
				renderTable(res.data);
				renderPagination(res.current_page, res.total_pages);
			},
		});
	}

	function renderTable(data) {
		let rows = "";
		data.forEach((row, i) => {
			rows += `
      <tr>
        <td>${(currentPage - 1) * 10 + i + 1}</td>
        <td><img src="${site_url + row.image}" style="max-width:50px"/></td>
        <td>${row.name}</td>
        <td>
      ${
				row.isActive == 1
					? `<div class="d-flex align-items-center text-success">
          <i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
          <span>Published</span>
          </div>`
					: `<div class="d-flex align-items-center text-danger">
          <i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
          <span>Unpublished</span>
          </div>`
			}
        </td>
        <td>
          <div class="d-flex order-actions align-items-center">
           		<a href="${site_url}edit_main/${row.id}" class="me-2"><i class="bx bxs-edit"></i></a>

            ${
							row.isActive == 1
								? `<button class="btn btn-sm btn-danger toggle-status-btn" data-id="${row.id}" data-status="0">
                     <i class="bx bx-x-circle me-1"></i> Unpublish
                   </button>`
								: `<button class="btn btn-sm btn-success toggle-status-btn" data-id="${row.id}" data-status="1">
                     <i class="bx bx-check-circle me-1"></i> Publish
                   </button>`
						}
          </div>
        </td>
      </tr>`;
		});

		// Define table IDs you want to update
		const tableIds = ["#categoryTableBody"];

		tableIds.forEach((id) => {
			$(id).html(
				rows ||
					`<tr><td colspan="5" class="text-center">No records found</td></tr>`
			);
		});
	}

	function renderPagination(curr, total) {
		let html = "";
		const half = Math.floor(per_group / 2);
		let start = Math.max(1, curr - half);
		let end = Math.min(total, start + per_group - 1);
		if (end - start + 1 < per_group) {
			start = Math.max(1, end - per_group + 1);
		}

		html += `<li class="page-item ${curr === 1 ? "disabled" : ""}">
               <a class="page-link" href="javascript:;" data-page="${
									curr - 1
								}">Previous</a></li>`;

		for (let p = start; p <= end; p++) {
			html += `<li class="page-item ${curr === p ? "active" : ""}">
                 <a class="page-link" href="javascript:;" data-page="${p}">${p}</a></li>`;
		}

		html += `<li class="page-item ${curr === total ? "disabled" : ""}">
               <a class="page-link" href="javascript:;" data-page="${
									curr + 1
								}">Next</a></li>`;

		$(".pagination").html(html);
	}

	// Pagination click
	$(document).on("click", ".pagination .page-link", function () {
		const page = $(this).data("page");
		if (page >= 1) loadPage(page);
	});

	// Search input
	$('.form-control[placeholder*="Search"]').on("keyup", function (e) {
		searchText = $(this).val();
		loadPage(1);
	});

	// Initialize
	loadPage();
});
$(document).on("click", ".toggle-status-btn", function () {
	const button = $(this);
	const postId = button.data("id");
	const newStatus = button.data("status");

	$.ajax({
		url: site_url + "admin/category/toggle_status",
		type: "POST",
		data: { id: postId, status: newStatus },
		dataType: "json",
		success: function (res) {
			if (res.success) {
				Swal.fire({
					icon: "success",
					title: res.message,
					timer: 2000,
					showConfirmButton: false,
				});
				setTimeout(function () {
					location.reload();
				}, 2000);
			} else {
				Swal.fire("Error", res.message, "error");
			}
		},
		error: function () {
			Swal.fire("Error", "Something went wrong!", "error");
		},
	});
});
// subcategory
$(document).ready(function () {
	const perPage = 3;
	let currentPage = 1;
	let searchText = "";

	function loadSubcategories(page = 1) {
		$.ajax({
			url: site_url + "admin/category/sub_ajax_list",
			type: "POST",
			dataType: "json",
			data: {
				page: page,
				search: searchText,
			},
			success: function (res) {
				renderTable(res.data, res.start_index);
				renderPagination(res.current_page, res.total_pages);
			},
		});
	}

	function renderTable(data, startIndex) {
		let rows = "";

		if (data.length === 0) {
			rows = `<tr><td colspan="5" class="text-center">No records found</td></tr>`;
		} else {
			data.forEach((row, i) => {
				rows += `
				<tr>
					<td>${startIndex + i}</td>
					<td>${row.category_name}</td>
					<td>${row.subcategory_name}</td>
					<td>
					
      ${
				row.isActive == 1
					? `<div class="d-flex align-items-center text-success">
					
          <i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
          <span>Published</span>
          </div>`
					: `<div class="d-flex align-items-center text-danger">
          <i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
          <span>Unpublished</span>
          </div>`
			}
        </td>
					<td>
	<div class="d-flex order-actions align-items-center">
		<!-- Edit Button with Icon -->
		<a href="${site_url}edit/${row.id}" class="me-2"><i class="bx bxs-edit"></i></a>

		<!-- Publish / Unpublish Button with Icon -->
		<button class="btn btn-sm btn-${row.isActive == 1 ? "danger" : "success"} toggle-status-btn"
			data-id="${row.id}" data-status="${row.isActive == 1 ? 0 : 1}" title="${row.isActive == 1 ? "Unpublish" : "Publish"}">
			<i class="bx ${row.isActive == 1 ? "bx-x-circle" : "bx-check-circle"} me-1"></i>
			${row.isActive == 1 ? "Unpublish" : "Publish"}
		</button>
	</div>
</td>	
				</tr>`;
			});
		}

		$("#SubcategoryTableBody").html(rows);
	}

	function renderPagination(current, total) {
		let html = "";
		const maxPagesToShow = 3;
		let start = Math.max(1, current - 1);
		let end = Math.min(total, start + maxPagesToShow - 1);

		if (end - start + 1 < maxPagesToShow) {
			start = Math.max(1, end - maxPagesToShow + 1);
		}

		html += `<li class="page-item ${current === 1 ? "disabled" : ""}">
			<a class="page-link" href="javascript:;" data-page="${current - 1}">Previous</a>
		</li>`;

		for (let i = start; i <= end; i++) {
			html += `<li class="page-item ${i === current ? "active" : ""}">
				<a class="page-link" href="javascript:;" data-page="${i}">${i}</a>
			</li>`;
		}

		html += `<li class="page-item ${current === total ? "disabled" : ""}">
			<a class="page-link" href="javascript:;" data-page="${current + 1}">Next</a>
		</li>`;

		$(".pagination").html(html);
	}

	$(document).on("click", ".pagination .page-link", function () {
		const page = $(this).data("page");
		if (page) {
			currentPage = page;
			loadSubcategories(currentPage);
		}
	});

	$(".form-control[placeholder*='Search']").on("keyup", function () {
		searchText = $(this).val();
		currentPage = 1;
		loadSubcategories(currentPage);
	});

	$(document).on("click", ".toggle-status-btn-2", function () {
		const id = $(this).data("id");
		const status = $(this).data("status");

		$.ajax({
			url: site_url + "admin/category/toggle_status_sub_2",
			type: "POST",
			data: { id, status },
			dataType: "json",
			success: function (res) {
				if (res.success) {
					Swal.fire({
						icon: "success",
						title: res.message,
						timer: 2000,
						showConfirmButton: false,
					});
					setTimeout(() => loadSubcategories(currentPage), 2000);
				} else {
					Swal.fire("Error", res.message, "error");
				}
			},
		});
	});

	// Initial load
	loadSubcategories(currentPage);
});

$('#EditSubcategoryForm').on('submit', function (e) {
        e.preventDefault(); // Prevent form from submitting normally

        let form = $(this)[0];
        let formData = new FormData(form);

        $.ajax({
            url: site_url + "admin/category/edit_subcategory",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            beforeSend: function () {
                // Optional: Show loading spinner
            },
           success: function (response) {
    if (response.status) {
        Swal.fire({
            icon: 'success',
            title: 'Updated',
            text: response.message,
            timer: 2000,
            showConfirmButton: false
        }).then(() => {
                        window.location.href = site_url + 'sub_category';

        });
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: response.message
        });
    }
},
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'AJAX Error',
                    text: 'Something went wrong with the request.'
                });
            }
        });
    });
$('#editCategoryForm').on('submit', function (e) {
    e.preventDefault();
// alert('hh');
// return;
    var formData = new FormData(this);

    $.ajax({
        url: site_url + "admin/category/update_main_cat",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
            if (response.status) {
                Swal.fire({
                    icon: 'success',
                    title: 'Updated',
                    text: response.message,
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = site_url + 'category';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message
                });
            }
        },
        error: function () {
            Swal.fire("Error", "Something went wrong!", "error");
        }
    });
});

$(document).ready(function () {
    $('#SliderForm').on('submit', function (e) {
        e.preventDefault();
// alert('h');
// return;
        // Clear validation styles
        $('#SliderForm').find('.is-invalid').removeClass('is-invalid');

        let isValid = true;

        // Validate title
        if ($('#sliderTitle').val().trim() === '') {
            $('#sliderTitle').addClass('is-invalid');
            isValid = false;
        }

        // Validate image (only if creating new; skip if editing and image already exists)
        const imageFile = $('#slider_image')[0].files[0];
        if (!imageFile) {
            // $('#slider_image').addClass('is-invalid');
            isValid = false;
        }

        // Validate display order
        if ($('#displayOrder').val() === '') {
            $('#displayOrder').addClass('is-invalid');
            isValid = false;
        }

        if (!isValid) return;

        // Prepare FormData
        var formData = new FormData(this);

        $.ajax({
            url: site_url + 'admin/category/create', 
            type: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('.btn-success').prop('disabled', true).text('Submitting...');
            },
            success: function (response) {
                $('.btn-success').prop('disabled', false).text('Submit');

                if (response.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = site_url + 'slider';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    });
                }
            },
            error: function () {
                $('.btn-success').prop('disabled', false).text('Submit');
                Swal.fire('Error', 'Something went wrong while submitting the form.', 'error');
            }
        });
    });
    });
let currentPage = 1;
let searchKeyword = '';

function fetchSliders(page = 1, keyword = '') {
    $.ajax({
        url: site_url + "admin/category/ajax_list_slider",
        type: "POST",
        data: {
            page: page,
            keyword: keyword
        },
        dataType: "json",
        success: function (res) {
            if (res.status) {
                $('#sliderTableBody').html(res.html);
                $('.pagination').html(res.pagination);
                currentPage = page;
            } else {
                $('#sliderTableBody').html('<tr><td colspan="7" class="text-center">No records found</td></tr>');
                $('.pagination').html('');
            }
        }
    });
}

// Pagination click
$(document).on('click', '.page-link', function () {
    let page = $(this).data('page');
    if (page) {
        fetchSliders(page, searchKeyword);
    }
});

// Search input
$('input[type="text"]').on('keyup', function () {
    searchKeyword = $(this).val();
    fetchSliders(1, searchKeyword); // reset to first page on search
});

// Initial load
fetchSliders();

$(document).on("click", ".toggle-status-btn_slider", function () {
	const button = $(this);
	const postId = button.data("id");
	const newStatus = button.data("status");

	$.ajax({
		url: site_url + "admin/category/toggle_status_slider",
		type: "POST",
		data: { id: postId, status: newStatus },
		dataType: "json",
		success: function (res) {
			if (res.success) {
				Swal.fire({
					icon: "success",
					title: res.message,
					timer: 2000,
					showConfirmButton: false,
				});
				setTimeout(function () {
					location.reload();
				}, 2000);
			} else {
				Swal.fire("Error", res.message, "error");
			}
		},
		error: function () {
			Swal.fire("Error", "Something went wrong!", "error");
		},
	});
});
document.getElementById('slider_image').addEventListener('change', function (e) {
    const reader = new FileReader();
    reader.onload = function (event) {
        document.getElementById('previewImage').src = event.target.result;
    };
    if (e.target.files[0]) {
        reader.readAsDataURL(e.target.files[0]);
    }
});