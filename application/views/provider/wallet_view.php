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
								<li class="breadcrumb-item active" aria-current="page">Wallet</li>
							</ol>
						</nav>
					</div>
					
				</div>
				<!--end breadcrumb-->
                <div class="card">
    <div class="card-body">
      <h4 class="card-title mb-3">My Wallet</h4>
     <button type="button" class="btn btn-success">Wallet Balance: <span class="badge">0.00</span></button>
      <p>You should have minimum ₹0.00 in your wallet to keep your wallet active.</p>
      <div class="mb-3">
        <label for="withdrawAmount" class="form-label">Eligible Withdraw Amount *</label>
        <input type="number" class="form-control" id="withdrawAmount" value="0">
      </div>
      <button class="btn btn-primary w-100 mb-4">Withdraw Now</button>

      <h5 class="mb-3">My Wallet Transaction History</h5>
      <div class="row g-3">
        <!-- Transaction Card -->
        <div class="col-md-6 col-lg-4">
          <div class="card border shadow-sm">
            <div class="card-body">
              <p class="mb-1"><strong>Amount:</strong> ₹1000.00</p>
              <p class="mb-1 transaction-type debit">Transaction Type: Debit</p>
              <p class="mb-1"><strong>Date:</strong> 15 Apr 2023, 10:02 AM</p>
              <p class="card-title-sm">Payout ID: pout_Ldw7m0CaE3TIi4</p>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="card border shadow-sm">
            <div class="card-body">
              <p class="mb-1"><strong>Amount:</strong> ₹1000.00</p>
              <p class="mb-1 transaction-type credit">Transaction Type: Credit</p>
              <p class="mb-1"><strong>Date:</strong> 21 Feb 2023, 12:05 PM</p>
              <p class="card-title-sm">Booking ID: FT1676961285R4WTK</p>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="card border shadow-sm">
            <div class="card-body">
              <p class="mb-1"><strong>Amount:</strong> ₹490.00</p>
              <p class="mb-1 transaction-type debit">Transaction Type: Debit</p>
              <p class="mb-1"><strong>Date:</strong> 27 Dec 2022, 01:10 PM</p>
              <p class="card-title-sm">Payout ID: pout_xxxxxx</p>
            </div>
          </div>
        </div>

        <!-- Add more dummy transactions below as needed -->
      </div>
    </div>
  </div>
                </div>
                </div>