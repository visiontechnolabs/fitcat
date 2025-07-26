<!--start overlay-->

<div class="overlay mobile-toggle-icon"></div>

<!--end overlay-->

<!--Start Back To Top Button-->

<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>

<!--End Back To Top Button-->

<footer class="page-footer">

  <p class="mb-0">Copyright © 2024. All right reserved.</p>

</footer>

</div>

<!--end wrapper-->

<!--start switcher-->

<!-- <button class="btn btn-primary position-fixed bottom-0 end-0 m-3 d-flex align-items-center gap-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop">

    <i class='bx bx-cog bx-spin'></i>Customize

  </button> -->



<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="staticBackdrop">

  <div class="offcanvas-header border-bottom h-60">

    <div class="">

      <h5 class="mb-0 text-uppercase">Theme Customizer</h5>

    </div>

    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>

  </div>

  <div class="offcanvas-body">

    <div>

      <p>Theme variation</p>



      <div class="row g-3">

        <div class="col-12 col-xl-6">

          <input type="radio" class="btn-check" name="theme-options" id="LightTheme" checked>

          <label
            class="btn btn-outline-secondary d-flex flex-column gap-2 align-items-center justify-content-center p-3"
            for="LightTheme">

            <span><i class='bx bx-sun fs-2'></i></span>

            <span>Light</span>

          </label>

        </div>

        <div class="col-12 col-xl-6">

          <input type="radio" class="btn-check" name="theme-options" id="DarkTheme">

          <label
            class="btn btn-outline-secondary d-flex flex-column gap-2 align-items-center justify-content-center p-3"
            for="DarkTheme">

            <span><i class='bx bx-moon fs-2'></i></span>

            <span>Dark</span>

          </label>

        </div>

        <div class="col-12 col-xl-6">

          <input type="radio" class="btn-check" name="theme-options" id="SemiDarkTheme">

          <label
            class="btn btn-outline-secondary d-flex flex-column gap-2 align-items-center justify-content-center p-3"
            for="SemiDarkTheme">

            <span><i class='bx bx-brightness-half fs-2'></i></span>

            <span>Semi Dark</span>

          </label>

        </div>

        <div class="col-12 col-xl-6">

          <input type="radio" class="btn-check" name="theme-options" id="BoderedTheme">

          <label
            class="btn btn-outline-secondary d-flex flex-column gap-2 align-items-center justify-content-center p-3"
            for="BoderedTheme">

            <span><i class='bx bx-border-all fs-2'></i></span>

            <span>Bordered</span>

          </label>

        </div>

      </div><!--end row-->



    </div>

  </div>

</div>

<!--start switcher-->

<!-- Bootstrap JS -->

<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

<!--plugins-->

<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="<?= base_url('assets/plugins/simplebar/js/simplebar.min.js') ?>"></script>

<script src="<?= base_url('assets/plugins/metismenu/js/metisMenu.min.js') ?>"></script>

<script src="<?= base_url('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput.min.js"></script>
<script>
const site_url = "<?= base_url(); ?>";
</script>
<script src="<?= base_url('assets/js/custom.js') ?>?v=<?= time() ?>"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js"></script>
<script src="https://unpkg.com/libphonenumber-js@1.10.14/bundle/libphonenumber-js.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js" integrity="sha512-b+nQTCdtTBIRIbraqNEwsjB6UvL3UEMkXnhzd8awtCYh0Kcsjl9uEgwVFVbhoj3uu1DO1ZMacNvLoyJJiNfcvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>


<!--app JS-->

<script src="<?= base_url('assets/js/app.js') ?>"></script>

<script src="<?= base_url('assets/js/index.js') ?>"></script>

<script src="<?= base_url('assets/plugins/peity/jquery.peity.min.js') ?>"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
		<script src="https://www.gstatic.com/charts/loader.js"></script>
<!-- <script>eruda.init();</script></script> -->
<script>
  


  $(".data-attributes span").peity("donut")



  document.addEventListener("DOMContentLoaded", function () {

    // Find all alerts (success, danger, warning etc.)

    var alerts = document.querySelectorAll('.alert-success, .alert-danger');



    alerts.forEach(function (alert) {



      setTimeout(function () {



        alert.style.transition = "opacity 0.5s ease";

        alert.style.opacity = 0;





        setTimeout(function () {

          alert.remove();

        }, 500);

      }, 3000);

    });

  });

  $(document).ready(function () {
    const $html = $('html');
    const $icon = $('.dark-mode-icon i');


    $('.dark-mode-icon').click(function () {
      // alert('h');
      // return;
      const currentTheme = $html.attr('data-bs-theme');
      const newTheme = currentTheme === 'light' ? 'dark' : 'light';

      localStorage.setItem('theme', newTheme);
      applyTheme(newTheme);
      location.reload();
    });

    function applyTheme(theme) {
      $html.attr('data-bs-theme', theme);
      void document.body.offsetWidth;
      if (theme === 'dark') {
        $icon.removeClass('bx-moon').addClass('bx-sun');
      } else {
        $icon.removeClass('bx-sun').addClass('bx-moon');
      }
    }
    $('input[type="checkbox"][data-toggle="toggle"]').bootstrapToggle();
$("#show_hide_password a").on('click', function (event) {

                event.preventDefault();

                if ($('#show_hide_password input').attr("type") == "text") {

                    $('#show_hide_password input').attr('type', 'password');

                    $('#show_hide_password i').addClass("bx-hide");

                    $('#show_hide_password i').removeClass("bx-show");

                } else if ($('#show_hide_password input').attr("type") == "password") {

                    $('#show_hide_password input').attr('type', 'text');

                    $('#show_hide_password i').removeClass("bx-hide");

                    $('#show_hide_password i').addClass("bx-show");

                }

            });
  });

  // notification serviceWorker





const STORE_ID = <?= isset($user_data->id) ? (int) $user_data->id : 0 ?>;


  if (!firebase.apps.length) {
    // alert('enter in first condtion');
    firebase.initializeApp(firebaseConfig);
  }

  if (!window.messaging) {
     window.messaging = firebase.messaging();
  }

  if ('serviceWorker' in navigator) {
    window.addEventListener('load', function () {
      navigator.serviceWorker.register('/firebase-messaging-sw.js')
        .then(function (registration) {
          console.log('ServiceWorker registered with scope:', registration.scope);

        }, function (err) {
          console.log('ServiceWorker registration failed:', err);
        });
    });

  }
 google.charts.load('current', { packages: ['corechart'] });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    const data = google.visualization.arrayToDataTable([
      ['Month', 'Orders'],
      <?php
        $months = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
        foreach ($months as $index => $month) {
          $orderCount = isset($monthly_orders[$index]) ? $monthly_orders[$index] : 0;
          echo "['$month', $orderCount],";
        }
      ?>
    ]);

    const options = {
      legend: 'none',
      curveType: 'function',
      colors: ['#007bff'],
      areaOpacity: 0.25,
      pointSize: 6,
      lineWidth: 3,
      animation: {
        startup: true,
        duration: 1000,
        easing: 'out'
      },
      hAxis: {
        textStyle: { fontSize: 10, color: '#888' },
        slantedText: true,
        slantedTextAngle: 45
      },
      vAxis: {
        textStyle: { fontSize: 10, color: '#888' },
        gridlines: { color: '#e5e5e5' },
        minValue: 0
      },
      chartArea: {
        left: 30,
        top: 10,
        width: '90%',
        height: '75%'
      }
    };

    const chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }

  window.addEventListener('resize', drawChart);
</script>

</body>



</html>