document.addEventListener("DOMContentLoaded", function () {
  const locationInput = document.getElementById("locationInput");

  if (!locationInput.value) { // If no session value, detect location
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
    } else {
      locationInput.placeholder = "Location not supported";
    }
  }

  function successCallback(position) {
    const lat = position.coords.latitude;
    const lon = position.coords.longitude;

    fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json`)
      .then(response => response.json())
      .then(data => {
        // Try different fallbacks if city is missing
        const city =
          data.address.city ||
          data.address.town ||
          data.address.village ||
          data.address.county ||
          data.address.state_district ||
          data.address.suburb ||
          data.address.hamlet ||
          '';
        const state = data.address.state || '';
        const country = data.address.country || '';
        const location = `${city}, ${state}, ${country}`;
        locationInput.value = location;

        // Save location to session via AJAX
        fetch(site_url + "home/save_location", {
          method: "POST",
          headers: { "Content-Type": "application/x-www-form-urlencoded" },
          body: "location=" + encodeURIComponent(location)
        });
      })
      .catch(() => {
        locationInput.placeholder = "Unable to fetch location";
      });
  }

  function errorCallback() {
    locationInput.placeholder = "Permission denied or unavailable";
  }
});


document.addEventListener("DOMContentLoaded", function () {
    // Keep the selected tab active after reload
    var activeTab = window.location.hash;
    if (activeTab) {
        var tabElement = document.querySelector('button[data-bs-target="' + activeTab + '"]');
        if (tabElement) {
            new bootstrap.Tab(tabElement).show();
        }
    }

    // Update hash when tab is clicked
    var tabButtons = document.querySelectorAll('#providerTabs button[data-bs-toggle="pill"]');
    tabButtons.forEach(function (btn) {
        btn.addEventListener('shown.bs.tab', function () {
            window.location.hash = btn.getAttribute('data-bs-target');
        });
    });
});
function openAboutTab() {
    var aboutTab = document.getElementById('about-tab');
    if (aboutTab) {
        aboutTab.click();
        window.scrollTo({ top: document.getElementById('about').offsetTop - 100, behavior: 'smooth' });
    }
}
document.querySelectorAll('input[name="priceOption"]').forEach((radio) => {
    radio.addEventListener('change', function () {
        const label = this.getAttribute('data-label');
        document.getElementById('selectedOption').textContent = `Book for ${label}`;
    });
});
function checkLogin(userId) {
    // console.log("site_url:", site_url, "userId:", userId);

    if (parseInt(userId) === 0) {
        window.location.assign(site_url + "login");
    } else {
        window.location.assign(site_url + "cart");
    }
  }
  function validateAndBook(userId) {
        const startDateInput = document.getElementById('startDate');
        const dateError = document.getElementById('dateError');
        const selectedDate = new Date(startDateInput.value);
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        // Validate date field
        if (!startDateInput.value) {
            dateError.textContent = "Please select a start date.";
            dateError.classList.remove('d-none');
            return;
        }
        if (selectedDate < today) {
            dateError.textContent = "Start date cannot be earlier than today.";
            dateError.classList.remove('d-none');
            return;
        }
        dateError.classList.add('d-none');

        // If user not logged in, redirect to login
        if (parseInt(userId) === 0) {
            window.location.assign('<?= site_url(); ?>login');
        } else {
            // Logged in: submit the form
            document.getElementById('cartForm').submit();
        }
    }
document.querySelectorAll("input[name='priceOption']").forEach(radio => {
    radio.addEventListener("change", function () {
        document.getElementById("priceInput").value = this.dataset.price;
        document.getElementById("durationInput").value = this.dataset.label.toLowerCase();
        document.getElementById("selectedOption").textContent = "Book for " + this.dataset.label;
    });
});
$(document).ready(function () {
    let providerId = $('#provider_id').val();
    // alert(providerId);
    let duration = "day"; // You can make this dynamic if needed
    let price = 100; // Update dynamically if needed

    // Increase Quantity
    $('#increaseQty').click(function () {
        let qty = parseInt($('#quantityInput').val());
        qty++;
        $('#quantityInput').val(qty);
        updateCart(qty, 'increased');
    });

    // Decrease Quantity
    $('#decreaseQty').click(function () {
        let qty = parseInt($('#quantityInput').val());
        if (qty > 1) {
            qty--;
            $('#quantityInput').val(qty);
            updateCart(qty, 'decreased');
        }
    });

    function updateCart(qty, action) {
        $.ajax({
            url: site_url+"cart/update_cart",
            type: "POST",
            data: {
                provider_id: providerId,
                duration: duration,
                quantity: qty,
                provider_name: "<?= $provider->gym_name; ?>",
                provider_image: "<?= base_url($provider->profile_image); ?>",
                price: price
            },
            success: function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Cart Updated',
                    text: `Your "Day" booking was ${action} successfully!`,
                    timer: 1500,
                    showConfirmButton: false
                });
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong. Please try again.',
                });
            }
        });
    }
});
// document.addEventListener("DOMContentLoaded", function () {
//   const form = document.getElementById("registrationForm");

//   form.addEventListener("submit", function (e) {
//     e.preventDefault();
//     form.classList.add("was-validated");

//     if (!form.checkValidity()) {
//       return;
//     }

//     const formData = new FormData(form);

//     fetch(site_url + 'login/register_user', {
//       method: 'POST',
//       body: formData,
//     })
//     .then(res => res.json())
//     .then(response => {
//       if (response.status === 'success') {
//         Swal.fire({
//           icon: 'success',
//           title: 'Registered!',
//           text: 'You have successfully registered.',
//           confirmButtonColor: '#3085d6'
//         }).then(() => {
//           window.location.href = site_url + 'provider/dashboard'; // Redirect if needed
//         });
//       } else {
//         Swal.fire({
//           icon: 'error',
//           title: 'Error',
//           text: response.message || 'Registration failed!',
//         });
//       }
//     })
//     .catch(error => {
//       Swal.fire({
//         icon: 'error',
//         title: 'Oops...',
//         text: 'Something went wrong!',
//       });
//       console.error(error);
//     });
//   });
// });
