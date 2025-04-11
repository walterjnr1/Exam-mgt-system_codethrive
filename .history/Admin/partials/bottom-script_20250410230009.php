<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
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
    const ghanaData = {
      "Ahafo": ["Asunafo North", "Asunafo South", "Asutifi North", "Asutifi South", "Tano North", "Tano South"],
      "Ashanti": ["Adansi North", "Adansi South", "Afigya Kwabre North", "Afigya Kwabre South", "Ahafo Ano North", "Ahafo Ano South East", "Ahafo Ano South West", "Amansie Central", "Amansie South", "Amansie West", "Asante Akim Central", "Asante Akim North", "Asante Akim South", "Asokore Mampong", "Atwima Kwanwoma", "Atwima Mponua", "Atwima Nwabiagya North", "Atwima Nwabiagya South", "Bantama", "Bekwai", "Bosome Freho", "Bosomtwe", "Ejisu", "Ejura Sekyedumase", "Juaben", "Kumasi Metro", "Kwadaso", "Mampong", "Obuasi East", "Obuasi Municipal", "Offinso North", "Offinso South", "Oforikrom", "Old Tafo", "Sekyere Afram Plains", "Sekyere Central", "Sekyere East", "Sekyere Kumawu", "Sekyere South", "Suame"],
      "Bono": ["Berekum East", "Berekum West", "Dormaa Central", "Dormaa East", "Dormaa West", "Jaman North", "Jaman South", "Sunyani Municipal", "Sunyani West", "Wenchi"],
      "Bono East": ["Atebubu-Amantin", "Kintampo North", "Kintampo South", "Nkoranza North", "Nkoranza South", "Pru East", "Pru West", "Sene East", "Sene West", "Techiman Municipal", "Techiman North"],
      "Central": ["Abura/Asebu/Kwamankese", "Agona East", "Agona West", "Ajumako/Enyan/Essiam", "Asikuma/Odoben/Brakwa", "Assin Central", "Assin North", "Assin South", "Awutu Senya", "Awutu Senya East", "Cape Coast Metro", "Effutu", "Ekumfi", "Gomoa Central", "Gomoa East", "Gomoa West", "Komenda/Edina/Eguafo/Abirem", "Mfantsiman", "Twifo Atti-Morkwa", "Twifo/Heman/Lower Denkyira", "Upper Denkyira East", "Upper Denkyira West"],
      "Eastern": ["Abuakwa North", "Abuakwa South", "Achiase", "Akuapim North", "Akuapim South", "Akyemansa", "Asene Manso Akroso", "Asuogyaman", "Atiwa East", "Atiwa West", "Ayensuano", "Birim Central", "Birim North", "Birim South", "Denkyembour", "Fanteakwa North", "Fanteakwa South", "Kwaebibirem", "Kwahu Afram Plains North", "Kwahu Afram Plains South", "Kwahu East", "Kwahu South", "Kwahu West", "Lower Manya Krobo", "New Juaben North", "New Juaben South", "Nsawam Adoagyiri", "Okere", "Suhum", "Upper Manya Krobo", "Upper West Akim", "West Akim", "Yilo Krobo"],
      "Greater Accra": ["Ablekuma Central", "Ablekuma North", "Ablekuma West", "Accra Metro", "Ada East", "Ada West", "Adenta", "Ashaiman", "Ayawaso Central", "Ayawaso East", "Ayawaso North", "Ayawaso West", "Ga Central", "Ga East", "Ga North", "Ga South", "Ga West", "Kpone Katamanso", "Korle Klottey", "Krowor", "La Dade Kotopon", "La Nkwantanang Madina", "Ledzokuku", "Ningo Prampram", "Okaikwei North", "Shai Osudoku", "Tema Metro", "Tema West", "Weija Gbawe"],
      "North East": ["Bunkpurugu-Nakpanduri", "Chereponi", "East Mamprusi", "Mamprugu Moagduri", "West Mamprusi", "Yunyoo-Nasuan"],
      "Northern": ["Gushegu", "Karaga", "Kpandai", "Kumbungu", "Mion", "Nanton", "Nanumba North", "Nanumba South", "Saboba", "Sagnarigu", "Savelugu", "Tamale Metro", "Tatale Sanguli", "Tolon", "Yendi", "Zabzugu"],
      "Oti": ["Biakoye", "Guan", "Jasikan", "Kadjebi", "Krachi East", "Krachi Nchumuru", "Krachi West", "Nkwanta North", "Nkwanta South"],
      "Savannah": ["Bole", "Central Gonja", "East Gonja", "North East Gonja", "North Gonja", "Sawla-Tuna-Kalba", "West Gonja"],
      "Upper East": ["Bawku Municipal", "Bawku West", "Binduri", "Bolgatanga East", "Bolgatanga Municipal", "Bongo", "Builsa North", "Builsa South", "Garu", "Kassena Nankana East", "Kassena Nankana West", "Nabdam", "Pusiga", "Talensi", "Tempane"],
      "Upper West": ["Daffiama-Bussie-Issa", "Jirapa", "Lambussie", "Lawra", "Nadowli Kaleo", "Nandom", "Sissala East", "Sissala West", "Wa East", "Wa Municipal", "Wa West"],
      "Volta": ["Adaklu", "Afadzato South", "Agotime Ziope", "Akatsi North", "Akatsi South", "Anloga", "Central Tongu", "Ho Municipal", "Ho West", "Hohoe Municipal", "Keta Municipal", "Ketu North", "Ketu South", "Kpando Municipal", "North Dayi", "North Tongu", "South Dayi", "South Tongu"],
      "Western": ["Ahanta West", "Effia-Kwesimintsim", "Ellembelle", "Jomoro", "Mpohor", "Nzema East", "Prestea-Huni Valley", "Sekondi Takoradi Metro", "Shama", "Tarkwa-Nsuaem", "Wassa Amenfi Central", "Wassa Amenfi East", "Wassa Amenfi West", "Wassa East"],
      "Western North": ["Aowin", "Bia East", "Bia West", "Bibiani Anhwiaso Bekwai", "Bodi", "Juaboso", "Sefwi Akontombra", "Sefwi Wiawso", "Suaman"]
    };

    const regionSelect = document.getElementById("region");
    const districtSelect = document.getElementById("district");

    // Populate regions
    for (let region in ghanaData) {
      let option = document.createElement("option");
      option.value = region;
      option.textContent = region;
      regionSelect.appendChild(option);
    }

    // Update districts based on selected region
    function updateDistricts() {
      const selectedRegion = regionSelect.value;
      districtSelect.innerHTML = '<option value="">--Select District--</option>';

      if (ghanaData[selectedRegion]) {
        ghanaData[selectedRegion].forEach(district => {
          const option = document.createElement("option");
          option.value = district;
          option.textContent = district;
          districtSelect.appendChild(option);
        });
      }
    }
  </script>