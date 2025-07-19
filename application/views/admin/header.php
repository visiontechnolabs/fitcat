<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
<link rel="icon" href="<?= base_url('assets/images/favicon-32x32.png') ?>" type="image/png">

<!--plugins-->
<link href="<?= base_url('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/plugins/simplebar/css/simplebar.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/plugins/metismenu/css/metisMenu.min.css') ?>" rel="stylesheet">

<!-- loader-->
<link href="<?= base_url('assets/css/pace.min.css') ?>" rel="stylesheet"/>
<script src="<?= base_url('assets/js/pace.min.js') ?>"></script>

<!-- Bootstrap CSS -->
<link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/css/bootstrap-extended.css') ?>" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />


<!-- Google Fonts (CDN) -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

<!-- App Styles -->
<link href="<?= base_url('assets/sass/app.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/css/icons.css') ?>" rel="stylesheet">
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

<!-- Theme Style CSS -->
<link rel="stylesheet" href="<?= base_url('assets/sass/dark-theme.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/sass/semi-dark.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/sass/bordered-theme.css') ?>">

	
	<title>FITCKET-ADMIN</title>
	<script>
		(function () {
			var savedTheme = localStorage.getItem('theme') || 'light';
			document.documentElement.setAttribute('data-bs-theme', savedTheme);
		})();
	</script>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<!-- <img src="<?= base_url('assets/images/logo-img.png');?>" class="logo-icon img-fluid" alt="logo icon" style="width:100%;"> -->
				</div>
				<div>
					<h4 class="logo-text">FITCKET | ADMIN</h4>
				</div>
				<div class="mobile-toggle-icon ms-auto"><i class='bx bx-x'></i>
				</div>
			 </div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="<?= base_url('admin/dashboard');?>" class="">
						<div class="parent-icon"><i class='bx bx-home-alt'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
					
				</li>
              <li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Category</div>
					</a>
					<ul>
						<li> <a href="<?= base_url('category');?>"><i class='bx bx-radio-circle'></i>All Category</a>
						</li>
						<li> <a href="<?= base_url('add_category');?>"><i class='bx bx-radio-circle'></i>Add new Category</a>
						</li>
						
					</ul>
			 </li>
              <li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-collection"></i>
						</div>
						<div class="menu-title">Sub Category</div>
					</a>
					<ul>
						<li> <a href="<?= base_url('sub_category');?>"><i class='bx bx-radio-circle'></i>All Sub Category</a>
						</li>
						<li> <a href="<?= base_url('add_sub_category');?>"><i class='bx bx-radio-circle'></i>Add Sub Category</a>
						</li>
						
					</ul>
			 </li>
			 <li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-image"></i>
						</div>
						<div class="menu-title">Home Slider</div>
					</a>
					<ul>
						<li> <a href="<?= base_url('slider');?>"><i class='bx bx-radio-circle'></i>All Slider</a>
						</li>
						<li> <a href="<?= base_url('add_slider');?>"><i class='bx bx-radio-circle'></i>Add Slider</a>
						</li>
						
					</ul>
			 </li>
			 <li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-user-circle"></i>
						</div>
						<div class="menu-title">Partner</div>
					</a>
					<ul>
						<li> <a href="<?= base_url('customer');?>"><i class='bx bx-radio-circle'></i>All Partner</a>
						</li>
						<li> <a href="<?= base_url('add_customer');?>"><i class='bx bx-radio-circle'></i>Add Partner</a>
						</li>
						
					</ul>
			 </li>
			 <li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-map"></i>
						</div>
						<div class="menu-title">City</div>
					</a>
					<ul>
						<li> <a href="<?= base_url('city');?>"><i class='bx bx-radio-circle'></i>All City</a>
						</li>
						<li> <a href="<?= base_url('add_city');?>"><i class='bx bx-radio-circle'></i>Add City</a>
						</li>
						
					</ul>
			 </li>
			<li class="">
							<a href="widgets.html" aria-expanded="false">
								<div class="parent-icon"><i class="bx bx-group"></i>
								</div>
								<div class="menu-title">Customers</div>
							</a>
						</li>
				<li class="">
							<a href="widgets.html" aria-expanded="false">
								<div class="parent-icon"><i class="bx bx-book-bookmark"></i>
								</div>
								<div class="menu-title">Booking</div>
							</a>
						</li>
				<li class="">
							<a href="widgets.html" aria-expanded="false">
								<div class="parent-icon"><i class="bx bx-rupee"></i>
								</div>
								<div class="menu-title">Payment</div>
							</a>
						</li>
				<li class="">
							<a href="widgets.html" aria-expanded="false">
								<div class="parent-icon"><i class="bx bx-comment-dots"></i>
								</div>
								<div class="menu-title">Client Review</div>
							</a>
						</li>
			 </ul>

			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
		<!--start header -->
		<header>
			<div class="topbar">

				<nav class="navbar navbar-expand gap-2 align-items-center">

					<div class="mobile-toggle-menu d-flex"><i class="bx bx-menu"></i>

					</div>



					<!-- <div class="search-bar d-lg-block d-none" data-bs-toggle="modal" data-bs-target="#SearchModal">

						 <a href="avascript:;" class="btn d-flex align-items-center"><i class="bx bx-search"></i>Search</a>

					  </div> -->



					<div class="top-menu ms-auto">

						<ul class="navbar-nav align-items-center gap-1">

							<li class="nav-item dark-mode d-lg-none d-sm-flex">
								<a class="nav-link dark-mode-icon" href="javascript:;"><i class="bx bx-moon"></i>
								</a>
							</li>

							<li class="nav-item dropdown dropdown-laungauge d-none d-sm-flex">



								<ul class="dropdown-menu dropdown-menu-end">

									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/01.png" width="20" alt=""><span class="ms-2">English</span></a>

									</li>

									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/02.png" width="20" alt=""><span class="ms-2">Catalan</span></a>

									</li>

									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/03.png" width="20" alt=""><span class="ms-2">French</span></a>

									</li>

									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/04.png" width="20" alt=""><span class="ms-2">Belize</span></a>

									</li>

									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/05.png" width="20" alt=""><span class="ms-2">Colombia</span></a>

									</li>

									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/06.png" width="20" alt=""><span class="ms-2">Spanish</span></a>

									</li>

									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/07.png" width="20" alt=""><span class="ms-2">Georgian</span></a>

									</li>

									<li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/08.png" width="20" alt=""><span class="ms-2">Hindi</span></a>

									</li>

								</ul>

							</li>

							<li class="nav-item dark-mode d-none d-sm-flex">

								<a class="nav-link dark-mode-icon" href="javascript:;"><i class="bx bx-moon"></i>

								</a>

							</li>



							<li class="nav-item dropdown dropdown-app">


								<div class="dropdown-menu dropdown-menu-end p-0">

									<div class="app-container p-2 my-2 ps">

										<div class="row gx-0 gy-2 row-cols-3 justify-content-center p-2">

											<div class="col">

												<a href="javascript:;">

													<div class="app-box text-center">

														<div class="app-icon">

															<img src="assets/images/app/slack.png" width="30" alt="">

														</div>

														<div class="app-name">

															<p class="mb-0 mt-1">Slack</p>

														</div>

													</div>

												</a>

											</div>

											<div class="col">

												<a href="javascript:;">

													<div class="app-box text-center">

														<div class="app-icon">

															<img src="assets/images/app/behance.png" width="30" alt="">

														</div>

														<div class="app-name">

															<p class="mb-0 mt-1">Behance</p>

														</div>

													</div>

												</a>

											</div>

											<div class="col">

												<a href="javascript:;">

													<div class="app-box text-center">

														<div class="app-icon">

															<img src="assets/images/app/google-drive.png" width="30" alt="">

														</div>

														<div class="app-name">

															<p class="mb-0 mt-1">Dribble</p>

														</div>

													</div>

												</a>

											</div>

											<div class="col">

												<a href="javascript:;">

													<div class="app-box text-center">

														<div class="app-icon">

															<img src="assets/images/app/outlook.png" width="30" alt="">

														</div>

														<div class="app-name">

															<p class="mb-0 mt-1">Outlook</p>

														</div>

													</div>

												</a>

											</div>

											<div class="col">

												<a href="javascript:;">

													<div class="app-box text-center">

														<div class="app-icon">

															<img src="assets/images/app/github.png" width="30" alt="">

														</div>

														<div class="app-name">

															<p class="mb-0 mt-1">GitHub</p>

														</div>

													</div>

												</a>

											</div>

											<div class="col">

												<a href="javascript:;">

													<div class="app-box text-center">

														<div class="app-icon">

															<img src="assets/images/app/stack-overflow.png" width="30" alt="">

														</div>

														<div class="app-name">

															<p class="mb-0 mt-1">Stack</p>

														</div>

													</div>

												</a>

											</div>

											<div class="col">

												<a href="javascript:;">

													<div class="app-box text-center">

														<div class="app-icon">

															<img src="assets/images/app/figma.png" width="30" alt="">

														</div>

														<div class="app-name">

															<p class="mb-0 mt-1">Stack</p>

														</div>

													</div>

												</a>

											</div>

											<div class="col">

												<a href="javascript:;">

													<div class="app-box text-center">

														<div class="app-icon">

															<img src="assets/images/app/twitter.png" width="30" alt="">

														</div>

														<div class="app-name">

															<p class="mb-0 mt-1">Twitter</p>

														</div>

													</div>

												</a>

											</div>

											<div class="col">

												<a href="javascript:;">

													<div class="app-box text-center">

														<div class="app-icon">

															<img src="assets/images/app/google-calendar.png" width="30" alt="">

														</div>

														<div class="app-name">

															<p class="mb-0 mt-1">Calendar</p>

														</div>

													</div>

												</a>

											</div>

											<div class="col">

												<a href="javascript:;">

													<div class="app-box text-center">

														<div class="app-icon">

															<img src="assets/images/app/spotify.png" width="30" alt="">

														</div>

														<div class="app-name">

															<p class="mb-0 mt-1">Spotify</p>

														</div>

													</div>

												</a>

											</div>

											<div class="col">

												<a href="javascript:;">

													<div class="app-box text-center">

														<div class="app-icon">

															<img src="assets/images/app/google-photos.png" width="30" alt="">

														</div>

														<div class="app-name">

															<p class="mb-0 mt-1">Photos</p>

														</div>

													</div>

												</a>

											</div>

											<div class="col">

												<a href="javascript:;">

													<div class="app-box text-center">

														<div class="app-icon">

															<img src="assets/images/app/pinterest.png" width="30" alt="">

														</div>

														<div class="app-name">

															<p class="mb-0 mt-1">Photos</p>

														</div>

													</div>

												</a>

											</div>

											<div class="col">

												<a href="javascript:;">

													<div class="app-box text-center">

														<div class="app-icon">

															<img src="assets/images/app/linkedin.png" width="30" alt="">

														</div>

														<div class="app-name">

															<p class="mb-0 mt-1">linkedin</p>

														</div>

													</div>

												</a>

											</div>

											<div class="col">

												<a href="javascript:;">

													<div class="app-box text-center">

														<div class="app-icon">

															<img src="assets/images/app/dribble.png" width="30" alt="">

														</div>

														<div class="app-name">

															<p class="mb-0 mt-1">Dribble</p>

														</div>

													</div>

												</a>

											</div>

											<div class="col">

												<a href="javascript:;">

													<div class="app-box text-center">

														<div class="app-icon">

															<img src="assets/images/app/youtube.png" width="30" alt="">

														</div>

														<div class="app-name">

															<p class="mb-0 mt-1">YouTube</p>

														</div>

													</div>

												</a>

											</div>

											<div class="col">

												<a href="javascript:;">

													<div class="app-box text-center">

														<div class="app-icon">

															<img src="assets/images/app/google.png" width="30" alt="">

														</div>

														<div class="app-name">

															<p class="mb-0 mt-1">News</p>

														</div>

													</div>

												</a>

											</div>

											<div class="col">

												<a href="javascript:;">

													<div class="app-box text-center">

														<div class="app-icon">

															<img src="assets/images/app/envato.png" width="30" alt="">

														</div>

														<div class="app-name">

															<p class="mb-0 mt-1">Envato</p>

														</div>

													</div>

												</a>

											</div>

											<div class="col">

												<a href="javascript:;">

													<div class="app-box text-center">

														<div class="app-icon">

															<img src="assets/images/app/safari.png" width="30" alt="">

														</div>

														<div class="app-name">

															<p class="mb-0 mt-1">Safari</p>

														</div>

													</div>

												</a>

											</div>



										</div><!--end row-->



									<div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>

								</div>

							</li>



							<li class="nav-item dropdown dropdown-large">



								<div class="dropdown-menu dropdown-menu-end">

									<a href="javascript:;">

										<div class="msg-header">

											<p class="msg-header-title">Notifications</p>

											<p class="msg-header-badge">8 New</p>

										</div>

									</a>

									<div class="header-notifications-list ps">

										<a class="dropdown-item" href="javascript:;">

											<div class="d-flex align-items-center">

												<div class="user-online">

													<img src="https://mydemo.visiontechnolabs.com/assets/images/avatars/avatar-2.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110" id="avatar-image" style="cursor:pointer;">

												</div>

												<div class="flex-grow-1">

													<h6 class="msg-name">Daisy Anderson<span class="msg-time float-end">5 sec

															ago</span></h6>

													<p class="msg-info">The standard chunk of lorem</p>

												</div>

											</div>

										</a>

										<a class="dropdown-item" href="javascript:;">

											<div class="d-flex align-items-center">

												<div class="notify bg-light-danger text-danger">dc

												</div>

												<div class="flex-grow-1">

													<h6 class="msg-name">New Orders <span class="msg-time float-end">2
															min

															ago</span></h6>

													<p class="msg-info">You have recived new orders</p>

												</div>

											</div>

										</a>

										<a class="dropdown-item" href="javascript:;">

											<div class="d-flex align-items-center">

												<div class="user-online">

													<img src="assets/images/avatars/avatar-2.png" class="msg-avatar" alt="user avatar">

												</div>

												<div class="flex-grow-1">

													<h6 class="msg-name">Althea Cabardo <span class="msg-time float-end">14

															sec ago</span></h6>

													<p class="msg-info">Many desktop publishing packages</p>

												</div>

											</div>

										</a>

										<a class="dropdown-item" href="javascript:;">

											<div class="d-flex align-items-center">

												<div class="notify bg-light-success text-success">

													<img src="assets/images/app/outlook.png" width="25" alt="user avatar">

												</div>

												<div class="flex-grow-1">

													<h6 class="msg-name">Account Created<span class="msg-time float-end">28 min

															ago</span></h6>

													<p class="msg-info">Successfully created new email</p>

												</div>

											</div>

										</a>

										<a class="dropdown-item" href="javascript:;">

											<div class="d-flex align-items-center">

												<div class="notify bg-light-info text-info">Ss

												</div>

												<div class="flex-grow-1">

													<h6 class="msg-name">New Product Approved <span class="msg-time float-end">2 hrs ago</span></h6>

													<p class="msg-info">Your new product has approved</p>

												</div>

											</div>

										</a>

										<a class="dropdown-item" href="javascript:;">

											<div class="d-flex align-items-center">

												<div class="user-online">

													<img src="assets/images/avatars/avatar-4.png" class="msg-avatar" alt="user avatar">

												</div>

												<div class="flex-grow-1">

													<h6 class="msg-name">Katherine Pechon <span class="msg-time float-end">15

															min ago</span></h6>

													<p class="msg-info">Making this the first true generator</p>

												</div>

											</div>

										</a>

										<a class="dropdown-item" href="javascript:;">

											<div class="d-flex align-items-center">

												<div class="notify bg-light-success text-success"><i class="bx bx-check-square"></i>

												</div>

												<div class="flex-grow-1">

													<h6 class="msg-name">Your item is shipped <span class="msg-time float-end">5 hrs

															ago</span></h6>

													<p class="msg-info">Successfully shipped your item</p>

												</div>

											</div>

										</a>

										<a class="dropdown-item" href="javascript:;">

											<div class="d-flex align-items-center">

												<div class="notify bg-light-primary">

													<img src="assets/images/app/github.png" width="25" alt="user avatar">

												</div>

												<div class="flex-grow-1">

													<h6 class="msg-name">New 24 authors<span class="msg-time float-end">1 day

															ago</span></h6>

													<p class="msg-info">24 new authors joined last week</p>

												</div>

											</div>

										</a>

										<a class="dropdown-item" href="javascript:;">

											<div class="d-flex align-items-center">

												<div class="user-online">

													<img src="assets/images/avatars/avatar-8.png" class="msg-avatar" alt="user avatar">

												</div>

												<div class="flex-grow-1">

													<h6 class="msg-name">Peter Costanzo <span class="msg-time float-end">6 hrs

															ago</span></h6>

													<p class="msg-info">It was popularised in the 1960s</p>

												</div>

											</div>

										</a>

									<div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>

									<a href="javascript:;">

										<div class="text-center msg-footer">

											<button class="btn btn-primary w-100">View All Notifications</button>

										</div>

									</a>

								</div>

							</li>

							<li class="nav-item dropdown dropdown-large">

								<!-- <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">8</span>

									<i class='bx bx-shopping-bag'></i>

								</a> -->

								<div class="dropdown-menu dropdown-menu-end">

									<a href="javascript:;">

										<div class="msg-header">

											<p class="msg-header-title">My Cart</p>

											<p class="msg-header-badge">10 Items</p>

										</div>

									</a>

									<div class="header-message-list ps">

										

								</div>

							</li>

						</ul>

					</div>

					<div class="user-box dropdown px-3">

						<a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">

							
							<!-- <img src="" class="user-img" alt="user avatar"> -->

							<div class="user-info">


								<p class="user-name mb-0">
									FITCAT							</p>
								<p class="designattion mb-0">
																	</p>


							</div>

						</a>

						<ul class="dropdown-menu dropdown-menu-end">

							

							<!-- <li><button onclick="initFirebaseMessagingRegistration()">Enable Notifications</button> -->


							

							<li>

								<div class="dropdown-divider mb-0"></div>

							</li>

							<li><a class="dropdown-item d-flex align-items-center" href="<?=base_url('logout');?>"><i class="bx bx-log-out-circle"></i><span>Logout</span></a>

							</li>

						</ul>

					</div>

				</nav>

			</div>

		</header>
		<!--end header -->
		<!--start page wrapper -->