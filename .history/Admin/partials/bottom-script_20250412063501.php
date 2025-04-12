<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>

<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>

<!-- Moment.js -->
<script src="../../plugins/moment/moment.min.js"></script>

<!-- Daterangepicker -->
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>

<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>

<!-- Bootstrap4 Duallistbox -->
<script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>

<!-- InputMask -->
<script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>

<!-- Bootstrap Color Picker -->
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>

<!-- Bootstrap Switch -->
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

<!-- BS-Stepper -->
<script src="plugins/bs-stepper/js/bs-stepper.min.js"></script>

<!-- DropzoneJS -->
<script src="plugins/dropzone/min/dropzone.min.js"></script>

<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<!-- AdminLTE Demo Scripts -->
<script src="dist/js/demo.js"></script>
<script src="dist/js/pages/dashboard.js"></script>






<script>
    document.getElementById('imageInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const logoImg = document.getElementById('logo-img');

    if (file) {
        // Optional: set the selected image as the logo source
        logoImg.src = URL.createObjectURL(file);
        logoImg.style.display = 'block';
    } else {
        logoImg.style.display = 'none';
    }
});

   
</script>


<script>
    document.getElementById('signatureInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const SignatureImg = document.getElementById('signature-img');

    if (file) {
        // Optional: set the selected image as the logo source
        SignatureImg.src = URL.createObjectURL(file);
        SignatureImg.style.display = 'block';
    } else {
      SignatureImg.style.display = 'none';
    }
});

   
</script>

<?php if(!empty($_SESSION['success'])) {  ?>
<div class="popup popup--icon -success js_success-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      <strong>Success</strong> 
    </h1>
    <p><?php echo $_SESSION['success']; ?></p>
    <p>
      <button class="button button--success" data-for="js_success-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($_SESSION["success"]);  
} ?>
<?php if(!empty($_SESSION['error'])) {  ?>
<div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      <strong>Error</strong> 
    </h1>
    <p><?php echo $_SESSION['error']; ?></p>
    <p>
      <button class="button button--error" data-for="js_error-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($_SESSION["error"]);  } ?>
    <script>
      var addButtonTrigger = function addButtonTrigger(el) {
  el.addEventListener('click', function () {
    var popupEl = document.querySelector('.' + el.dataset.for);
    popupEl.classList.toggle('popup--visible');
  });
};

Array.from(document.querySelectorAll('button[data-for]')).
forEach(addButtonTrigger);
    </script>

<script>
    // Object with regions and their districts
    const regionDistricts = {
      "Greater Accra": ["Accra Metropolitan", "Tema Metropolitan", "Ga West", "Ga East", "La Nkwantanang-Madina"],
      "Ashanti": ["Kumasi Metropolitan", "Asokwa", "Obuasi", "Ejisu", "Kwadaso"],
      "Central": ["Cape Coast", "Mfantsiman", "Assin South", "Agona West", "Gomoa East"],
      "Eastern": ["Koforidua", "Akuapim North", "New Juaben South", "Suhum", "Nsawam-Adoagyiri"],
      "Northern": ["Tamale Metropolitan", "Sagnarigu", "Yendi", "Saboba", "Tolon"],
      "Volta": ["Ho", "Keta", "Hohoe", "Kpando", "North Dayi"],
      "Western": ["Sekondi-Takoradi", "Tarkwa-Nsuaem", "Mpohor", "Wassa Amenfi East", "Ahanta West"],
      "Upper East": ["Bolgatanga", "Bawku", "Navrongo", "Bongo", "Zebilla"],
      "Upper West": ["Wa", "Nadowli", "Jirapa", "Lambussie", "Tumu"],
      "Bono": ["Sunyani", "Berekum", "Dormaa", "Wenchi", "Tain"],
      "Bono East": ["Techiman", "Atebubu-Amantin", "Kintampo North", "Nkoranza South"],
      "Ahafo": ["Goaso", "Asunafo South", "Tano North"],
      "Oti": ["Dambai", "Krachi East", "Jasikan"],
      "North East": ["Nalerigu", "Bunkpurugu", "Chereponi"],
      "Savannah": ["Damongo", "Bole", "Salaga North", "Sawla-Tuna-Kalba", "Central Gonja", "West Gonja"],
      "Western North": ["Sefwi Wiawso", "Bibiani-Anhwiaso-Bekwai", "Bodi"]
    };

    // Populate regions on load
    window.onload = function() {
      const regionSelect = document.getElementById("region");
      for (let region in regionDistricts) {
        let option = document.createElement("option");
        option.value = region;
        option.textContent = region;
        regionSelect.appendChild(option);
      }
    };

    // Populate districts based on selected region
    function populateDistricts() {
      const region = document.getElementById("region").value;
      const districtSelect = document.getElementById("district");

      // Clear previous options
      districtSelect.innerHTML = '<option value="">-- Select District --</option>';

      if (region && regionDistricts[region]) {
        regionDistricts[region].forEach(district => {
          const option = document.createElement("option");
          option.value = district;
          option.textContent = district;
          districtSelect.appendChild(option);
        });
      }
    }
  </script>