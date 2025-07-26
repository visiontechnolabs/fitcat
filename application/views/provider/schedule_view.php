<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<!-- <div class="breadcrumb-title pe-3">Category</div> -->
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="<?= base_url('provider/dashboard');?>"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Schedule Info</li>
							</ol>
						</nav>
					</div>
					
				</div>
				<!--end breadcrumb-->

                 <div class="schedule-table">
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td>Sunday</td>
                        <td>
                            <select class="form-select w-auto">
                                <option value="holiday">Holiday</option>
                                <option value="open">Open</option>
                            </select>
                        </td>
                        <td><input type="time" class="form-control time-input" name="from-sunday" value="10:00"></td>
                        <td><input type="time" class="form-control time-input" name="to-sunday" value="18:00"></td>
                    </tr>
                    <tr>
                        <td>Monday</td>
                        <td>
                            <select class="form-select w-auto">
                                <option value="holiday">Holiday</option>
                                <option value="open" selected>Open</option>
                            </select>
                        </td>
                        <td><input type="time" class="form-control time-input" name="from-monday" value="10:00"></td>
                        <td><input type="time" class="form-control time-input" name="to-monday" value="18:00"></td>
                    </tr>
                    <tr>
                        <td>Tuesday</td>
                        <td>
                            <select class="form-select w-auto">
                                <option value="holiday" selected>Holiday</option>
                                <option value="open">Open</option>
                            </select>
                        </td>
                        <td><input type="time" class="form-control time-input" name="from-tuesday" value="00:00"></td>
                        <td><input type="time" class="form-control time-input" name="to-tuesday" value="23:45"></td>
                    </tr>
                    <tr>
                        <td>Wednesday</td>
                        <td>
                            <select class="form-select w-auto">
                                <option value="holiday">Holiday</option>
                                <option value="open" selected>Open</option>
                            </select>
                        </td>
                        <td><input type="time" class="form-control time-input" name="from-wednesday" value="00:00"></td>
                        <td><input type="time" class="form-control time-input" name="to-wednesday" value="23:45"></td>
                    </tr>
                    <tr>
                        <td>Thursday</td>
                        <td>
                            <select class="form-select w-auto">
                                <option value="holiday">Holiday</option>
                                <option value="open" selected>Open</option>
                            </select>
                        </td>
                        <td><input type="time" class="form-control time-input" name="from-thursday" value="00:00"></td>
                        <td><input type="time" class="form-control time-input" name="to-thursday" value="23:45"></td>
                    </tr>
                    <tr>
                        <td>Friday</td>
                        <td>
                            <select class="form-select w-auto">
                                <option value="holiday">Holiday</option>
                                <option value="open" selected>Open</option>
                            </select>
                        </td>
                        <td><input type="time" class="form-control time-input" name="from-friday" value="00:00"></td>
                        <td><input type="time" class="form-control time-input" name="to-friday" value="23:45"></td>
                    </tr>
                    <tr>
                        <td>Saturday</td>
                        <td>
                            <select class="form-select w-auto">
                                <option value="holiday">Holiday</option>
                                <option value="open" selected>Open</option>
                            </select>
                        </td>
                        <td><input type="time" class="form-control time-input" name="from-saturday" value="00:00"></td>
                        <td><input type="time" class="form-control time-input" name="to-saturday" value="23:45"></td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-3">
                <button class="btn btn-primary">Update</button>
                <button class="btn btn-secondary">Cancel</button>
            </div>
        </div>
    </div>
                </div>
                </div>