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
										<th>Image</th>
										<th>Partner Name</th>
										<th>Business Name</th>
                                        <th>Mobile</th>
                                        <th>Address</th>
                                        <th>Actions</th>
									</tr>
								</thead>
								<tbody id="partnerTableBody">
									
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
</div>
		