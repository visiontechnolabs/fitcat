<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<!-- <div class="breadcrumb-title pe-3">Category</div> -->
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard');?>"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Partners</li>
							</ol>
						</nav>
					</div>
					
				</div>
				<!--end breadcrumb-->
			  
				<div class="card">
					<div class="card-body">
						<div class="d-lg-flex align-items-center mb-4 gap-3">
							<div class="position-relative">
								<input type="text" class="form-control ps-5 radius-30" placeholder="Search Order"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table mb-0">
								<thead class="table-light">
									<tr>
										<th>Index</th>
										<th>Name</th>
									    <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Actions</th>
									</tr>
								</thead>
								<tbody id="customerTableBody">
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
<nav aria-label="Page navigation example">
							<ul class="pagination round-pagination justify-content-center">
								<li class="page-item"><a class="page-link" href="javascript:;">Previous</a>
								</li>
								<li class="page-item"><a class="page-link" href="javascript:;javascript:;">1</a>
								</li>
								<li class="page-item active"><a class="page-link" href="javascript:;">2</a>
								</li>
								<li class="page-item"><a class="page-link" href="javascript:;">3</a>
								</li>
								<li class="page-item"><a class="page-link" href="javascript:;">Next</a>
								</li>
							</ul>
						</nav>

			</div>
		</div>
		<script>
document.addEventListener("DOMContentLoaded", function() {
    loadCustomers(1);

    document.querySelector('.radius-30').addEventListener('input', function() {
        loadCustomers(1); // reload first page on search
    });
});

function loadCustomers(page) {
    const search = document.querySelector('.radius-30').value;

    fetch("<?= base_url('admin/customers/fetch_customers?page='); ?>" + page + "&search=" + encodeURIComponent(search))
        .then(response => response.json())
        .then(data => {
            renderCustomers(data.customers, data.page, data.limit);
            renderPagination(data.total, data.limit, data.page);
        });
}

function renderCustomers(customers, page, limit) {
    let html = '';
    if (customers.length === 0) {
        html = `<tr><td colspan="5" class="text-center text-muted">No customers found.</td></tr>`;
    } else {
        customers.forEach((cust, index) => {
            html += `
                <tr>
                    <td>${(page-1)*limit + index + 1}</td>
                    <td>${cust.name}</td>
                    <td>${cust.mobile}</td>
                    <td>${cust.email}</td>
 <td>
        <div class="d-flex order-actions align-items-center">
            <a href="${site_url}loginAsPartner/${cust.id}" 
               class="ms-2" title="Show all Booking">
                <i class="bx bx-log-in"></i>
            </a>
            <a href="javascript:void(0);" 
               class="btn-toggle-status ms-2"
               data-id="${cust.id}"
               data-status="${cust.isActive}"
               title="${cust.isActive == 1 ? 'Deactivate' : 'Activate'}">
                <i class="bx ${cust.isActive == 1 ? 'bx-user-x' : 'bx-user-check'}"></i>
            </a>
        </div>
    </td>             
							 </tr>
            `;
        });
    }
    document.getElementById('customerTableBody').innerHTML = html;
}

function renderPagination(total, limit, current) {
    const pages = Math.ceil(total / limit);
    let html = '';
    if (pages <= 1) {
        document.querySelector('.pagination').innerHTML = '';
        return;
    }

    html += `<li class="page-item ${current==1?'disabled':''}">
                <a class="page-link" href="#" onclick="${current==1?'return false;':'loadCustomers('+(current-1)+');return false;'}">Previous</a>
             </li>`;

    let start = Math.max(1, current-1);
    let end = Math.min(pages, current+1);
    if (current==1) end = Math.min(pages,3);
    if (current==pages) start = Math.max(1,pages-2);

    for (let i=start; i<=end; i++) {
        html += `<li class="page-item ${current==i?'active':''}">
                    <a class="page-link" href="#" onclick="loadCustomers(${i});return false;">${i}</a>
                 </li>`;
    }

    html += `<li class="page-item ${current==pages?'disabled':''}">
                <a class="page-link" href="#" onclick="${current==pages?'return false;':'loadCustomers('+(current+1)+');return false;'}">Next</a>
             </li>`;

    document.querySelector('.pagination').innerHTML = html;
}
$(document).on("click", ".btn-toggle-status", function () {
		let partnerId = $(this).data("id");
		let currentStatus = $(this).data("status");
		let newStatus = currentStatus == 1 ? 0 : 1;

		let actionText = newStatus == 0 ? "deactivate" : "activate";

		Swal.fire({
			title: `Are you sure you want to ${actionText} this user?`,
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: `Yes, ${actionText}!`,
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: site_url + "admin/customer/togglePartnerStatus",
					type: "POST",
					data: { partner_id: partnerId, status: newStatus },
					dataType: "json",
					success: function (response) {
						if (response.status === "success") {
							Swal.fire({
								icon: "success",
								title: `Partner ${actionText}d successfully.`,
								timer: 1500,
								showConfirmButton: false,
							});
							loadPartners(offset, $(".radius-30").val());
						} else {
							Swal.fire({
								icon: "error",
								title: "Failed!",
								text: response.message,
							});
						}
					},
					error: function () {
						Swal.fire({
							icon: "error",
							title: "Error",
							text: "Something went wrong!",
						});
					},
				});
			}
		});
	});
</script>

