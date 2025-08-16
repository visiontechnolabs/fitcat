<div class="breadcrumb-container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 ms-5">
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item">
                <a href="#">Services</a>
            </li>
        </ol>
    </nav>

</div>
<div class="container mt-4">
    <div class="row" id="service-container">
      
</div>

    </div>
<nav>
  <ul class="pagination justify-content-center mt-3" id="pagination-container"></ul>
</nav>

<!-- </div> -->
<script>
let totalPages = 1; // track total pages globally

document.addEventListener("DOMContentLoaded", function() {
    loadServices(1);
});

function loadServices(page) {
    // Prevent invalid page numbers
    if (page < 1) page = 1;
    if (page > totalPages) page = totalPages;

    fetch(`<?= base_url('services/fetch_services?page='); ?>` + page)
        .then(response => response.json())
        .then(data => {
            totalPages = Math.ceil(data.total / data.limit); // update global page count
            renderServices(data.services);
            renderPagination(data.total, data.limit, data.page);
        });
}

function renderServices(services) {
    let html = '';
    if (services.length === 0) {
        html = `<p class="text-center text-muted">No services available.</p>`;
    } else {
        services.forEach(srv => {
            html += `
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100 shadow border-0">
                    <img src="<?= base_url(); ?>${srv.image}" 
                         class="card-img-top rounded-top" 
                         style="height:200px;object-fit:cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">${srv.name}</h5>
                        <p class="card-text text-muted small mb-2">${srv.description}</p>
                        <div class="text-muted small mb-3">
                            <i class="fa fa-dumbbell me-2"></i><strong>${srv.gym_name}</strong>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small mb-1 fw-bold">
                                <i class="fa fa-map-marker-alt me-2"></i>Services available in:
                            </div>
                            <div class="d-flex flex-wrap gap-1 ms-3">
                                ${srv.city.split(',').map(c => 
                                    `<span class="badge bg-light text-dark border">${c.trim()}</span>`
                                ).join('')}
                            </div>
                        </div>
                        <button class="btn btn-primary w-100 mt-auto fw-bold" 
                            onclick="window.location.href='<?= base_url('provider_details/'); ?>${srv.provider_id}'">
                            Book Now
                        </button>
                    </div>
                </div>
            </div>`;
        });
    }
    document.getElementById('service-container').innerHTML = html;
}

function renderPagination(total, limit, current) {
    const pages = Math.ceil(total / limit);
    totalPages = pages; // sync with global pages count
    let html = '';
    if (pages <= 1) {
        document.getElementById('pagination-container').innerHTML = '';
        return;
    }

    // Previous button
    html += `<li class="page-item ${current==1?'disabled':''}">
                <a class="page-link" href="#"
                   onclick="${current==1?'return false;':'loadServices('+(current-1)+');return false;'}">
                   Previous
                </a>
             </li>`;
    
    // Page numbers (only 3 visible)
    let start = Math.max(1, current - 1);
    let end = Math.min(pages, current + 1);
    if (current === 1) end = Math.min(pages, 3);
    if (current === pages) start = Math.max(1, pages - 2);

    for (let i = start; i <= end; i++) {
        html += `<li class="page-item ${current==i?'active':''}">
                    <a class="page-link" href="#" onclick="loadServices(${i});return false;">${i}</a>
                 </li>`;
    }

    // Next button
    html += `<li class="page-item ${current==pages?'disabled':''}">
                <a class="page-link" href="#"
                   onclick="${current==pages?'return false;':'loadServices('+(current+1)+');return false;'}">
                   Next
                </a>
             </li>`;

    document.getElementById('pagination-container').innerHTML = html;
}
</script>
