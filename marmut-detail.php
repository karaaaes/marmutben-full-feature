<?php
   include('templates/header.php');
   include('core/core_functions.php');

   $dataDetailMarmut = getDetailMarmut($_GET['id'], $_GET['categories']);
   if (empty($dataDetailMarmut)) {
      echo '<script>alert("Data Marmut Tidak Ada"); 
      window.location.href = "index.php";</script>';
      exit; 
   }
   $finalPrice = number_format($dataDetailMarmut[0]['harga'], 0, '.', '.');
   $finalName = str_replace(" ", "%20", $dataDetailMarmut[0]['jenis_marmut']);

   $sql = "
      SELECT value FROM t_marmutben_config WHERE id = 1
   ";
   $executeQuery = mysqli_query($conn, $sql);
   $dataConfig = mysqli_fetch_array($executeQuery);
?>
<link rel="stylesheet" href="css/marmut-detail-style.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function () {
      // Mendapatkan ID dan kategori dari URL
      var urlParams = new URLSearchParams(window.location.search);
      var id = urlParams.get('id');
      var categories = urlParams.get('categories');

      // Mengeksekusi AJAX saat halaman dimuat
      $.ajax({
         type: "POST",
         url: "hit.php?id=" + "id&categories=" + categories, // Ganti dengan URL Anda
         data: {
            id: id,
            categories: categories
         },
         success: function (response) {
            $("#marmutDetails").html(response);
         }
      });
   });
</script>
<section class="marmut-detail">
   <div id="project" class="project project-detail">
      <!-- Detail Beli Section -->
      <div class="container" id="anakanSection">
         <div class="row">
            <div class="col-md-12" style="padding : 0px 0px !important;">
               <div class="titlepage">
                  <h3>Detail Produk</h3>
               </div>
            </div>

            <div class="row marmut_detail">
               <!-- Image Selling Section -->
               <div class="product_main col-md-3 mb-3">
                  <figure class="zoom-effect">
                     <img class="marmut-detail-image" src="<?php echo $dataDetailMarmut[0]['image_marmut']; ?>">
                  </figure>
               </div>
               <!-- End Image Selling Section -->

               <!-- Description Content Section -->
               <div class="col-md-5 content-detailing">
                  <div class="news_text news_text_marmut_detail mb-3">
                     <h1 style="color:black !important; font-size: 1.28571rem; font-weight: 600;">
                        <?php echo $dataDetailMarmut[0]['jenis_marmut']; ?></h1>
                     <span><?php echo "Marmut " . $dataDetailMarmut[0]['categories']; ?></span>
                     <h1 style="margin-top: 0px !important; color: black !important; font-weight: 700;">
                        <div class="originalPrice" id="originalPrice">
                           <?php
                        $originalPrice = number_format($dataDetailMarmut[0]['harga'], 0, '.', '.');
                        echo "Rp $originalPrice";
                     ?>
                        </div>
                        <ins id="discountedPrice" style="display: none;"></ins>
                     </h1>
                     <p><?php echo $dataDetailMarmut[0]['description']; ?></p>

                     <!-- Promo Section -->
                     <div class="titlepage" style="padding-right:20px;">
                        <h3>Masukkan Kode Promo</h3>
                     </div>
                     <div class="row mt-3">
                        <div class="col-9 col-md-9">
                           <div class="form-group">
                              <input type="text" class="form-control form-control-sm" id="exampleInputEmail1"
                                 aria-describedby="emailHelp" placeholder="Kode Promo" style="border-radius: 0px;">
                              <small id="notification" class="form-text text-muted">Masukkan Kode Promo Yang
                                 Valid</small>
                              <small id="notificationSuccess" class="form-text text-success"
                                 style="display: none;"></small>
                              <small id="notificationFailed" class="form-text text-danger" style="display: none;">Kode
                                 Promo Tidak Valid</small>
                           </div>
                        </div>
                        <div class="col-3 col-md-3" style="padding-left:0px;">
                           <button class="btn btn-primary"
                              style="background-color: #435334; border-color: #435334; border-radius: 0px;"
                              onclick="checkPromo();">Check</button>
                        </div>
                     </div>
                     <!-- End Promo Section -->
                  </div>
               </div>
               <!-- End Description Content Section -->

               <div class="col-12 col-md-3" style="padding-left:15px; padding-right:30px;">
                  <div class="card card-buyer-information">
                     <img src="images/banner-try-1.jpg" class="card-img-top" alt="...">
                     <div class="card-body">
                        <h4 class="card-title">Masukkan informasimu</h4>
                        <div class="marmut-type mb-2">
                           <?php echo "Produk : " . $dataDetailMarmut[0]['jenis_marmut']; ?>
                        </div>
                        <form action="core/core_functions.php" method="post" enctype="multipart/form-data">
                           <input type="text" value="<?= $dataConfig[0]; ?>" name="email_notifications" hidden>
                           <label class="label-form form-label" for="receiver_name"
                              style="margin-bottom:0px !important;">
                              Nama Pembeli
                           </label>
                           <input type="text" class="form-control form-control-sm" name="receiver_name"
                              placeholder="Nama Pembeli">
                           <label class="label-form form-label mt-2" for="receiver_phone"
                              style="margin-bottom:0px !important;">
                              Nomor Whatsapp
                           </label>
                           <input type="text" class="form-control form-control-sm" name="receiver_phone"
                              placeholder="Nomor Whatsapp">
                           <label class="label-form form-label mt-2" for="receiver_location"
                              style="margin-bottom:0px !important;">
                              Lokasi Pembeli
                           </label>
                           <input type="text" class="form-control form-control-sm" name="receiver_location"
                              placeholder="Lokasi Pembeli">
                           <div class="stock-selector mt-3 mb-2 justify-content-center">
                              <btn class="stock-button minus-button mr-3">-</btn>
                              <input type="text" name="nama_marmut"
                                 value="<?php echo $dataDetailMarmut[0]['jenis_marmut']; ?>" hidden>
                              <input type="text" name="kategori_marmut"
                                 value="<?php echo $dataDetailMarmut[0]['categories']; ?>" hidden>
                              <input type="text" name="harga_marmut" value="<?php echo $originalPrice; ?>" hidden>
                              <input class="stock-input" name="jumlah" type="number" value="1" min="1">
                              <btn class="stock-button plus-button ml-3">+</btn>
                              <div class="description-stock">Masukkan Jumlah</div>
                           </div>
                           <button type="submit" name="submitBuy" class="btn btn-primary btn-buy w-100"
                              style="background-color: #435334;border-color: #435334; border-radius: 0px;">Beli</button>
                           <small id="warning" class="form-text text-muted">*Note : Harga belum termasuk ongkir</small>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <hr class="mt-5" />
      </div>
      <!-- End Detail Beli Section -->
   </div>
</section>

<!-- news section -->
<?php 
   include('templates/promo.php');
   ?>
<!-- end news section -->
<script>
   document.querySelector('a[href="#myDiv"]').addEventListener('click', function (e) {
      e.preventDefault();
      document.querySelector(this.getAttribute('href')).scrollIntoView({
         behavior: 'smooth'
      });
   });
</script>
<script>
   const minusButton = document.querySelector('.minus-button');
   const plusButton = document.querySelector('.plus-button');
   const stockInput = document.querySelector('.stock-input');

   minusButton.addEventListener('click', () => {
      const currentValue = parseInt(stockInput.value);
      if (currentValue > 1) {
         stockInput.value = currentValue - 1;
      }
   });

   plusButton.addEventListener('click', () => {
      const currentValue = parseInt(stockInput.value);
      stockInput.value = currentValue + 1;
   });
</script>
<script>
   var originalHargaMarmut = <?php echo $dataDetailMarmut[0]['harga']; ?>;

   function checkPromo() {
      var promoInput = document.getElementById("exampleInputEmail1").value;
      var notificationNotValid = document.getElementById("notification");
      var notificationSuccess = document.getElementById("notificationSuccess");
      var notificationFailed = document.getElementById("notificationFailed");
      var originalPrice = document.getElementById("originalPrice");
      var discountedPrice = document.getElementById("discountedPrice");
      var hargaMarmutInput = document.querySelector("input[name='harga_marmut']");

      if (promoInput.trim() === "") {
         // Input promo kosong, tampilkan notifikasi
         notificationNotValid.style.display = "block";
         notificationSuccess.style.display = "none";
         notificationFailed.style.display = "none";
      } else {
         fetch("cek_promo.php", {
               method: "POST",
               headers: {
                  "Content-Type": "application/x-www-form-urlencoded"
               },
               body: "promo=" + promoInput
            })
            .then(response => response.json())
            .then(data => {
               notificationSuccess.style.display = data.status === "valid" ? "block" : "none";
               notificationFailed.style.display = data.status === "valid" ? "none" : "block";
               originalPrice.style.display = data.status === "valid" ? "none" : "block";
               discountedPrice.style.display = data.status === "valid" ? "block" : "none";

               if (data.status === "valid") {
                  var formattedJumlahPromo = parseFloat(data.jumlahPromo).toLocaleString('id-ID', {
                     style: 'currency',
                     currency: 'IDR'
                  });

                  notificationSuccess.innerHTML =
                     `Kode Promo Berhasil Digunakan. Kamu mendapatkan promo sebesar ${formattedJumlahPromo}!`;

                  var hargaMarmut = originalHargaMarmut - parseFloat(data.jumlahPromo);
                  hargaMarmutInput.value = hargaMarmut;

                  discountedPrice.innerHTML =
                     `Harga Baru: ${hargaMarmut.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' })}`;
               } else {
                  hargaMarmutInput.value = originalHargaMarmut;
               }
            })
            .catch(error => {
               console.error("Terjadi kesalahan saat mengambil data:", error);
            });
      }


   }
</script>
<?php 
include('templates/footer.php');
?>