<?php
   include('templates/header.php');
   include('core/core_functions.php');
?>

<section class="paket">
   <div id="project" class="project">
      <!-- Detail Beli Section -->
      <div class="container" id="anakanSection">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h3>Cek Paket Marmut Cepat</h3>
               </div>
            </div>
            <div class="row form-ongkir mt-3">
               <div class="col-md-12">
                  <div class="form-group">
                     <label class="label-ongkir" for="jenisSelect">Jenis Marmut</label>
                     <select class="form-control form-control-sm" id="jenisSelect" name="jenis">
                        <option selected disabled>--Pilih Jenis Marmut--</option>
                        <?php 
                     $dataWilayah = getPaketMarmut();
                     foreach($dataWilayah as $data){
                  ?>
                        <option value="<?php echo $data['id']; ?>"><?php echo $data['jenis']; ?></option>
                        <?php   
                     }
                  ?>
                     </select>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="label-ongkir" for="anakan">Anakan</label>
                     <input type="text" class="form-control form-control-sm" id="anakan" name="anakan" aria-describedby="emailHelp"
                        readonly />
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="label-ongkir" for="remaja">Remaja</label>
                     <input type="text" class="form-control form-control-sm" id="remaja" name="remaja" aria-describedby="emailHelp"
                        readonly />
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="label-ongkir" for="indukJantan">Induk Jantan</label>
                     <input type="text" class="form-control form-control-sm" id="indukJantan" name="indukJantan"
                        aria-describedby="emailHelp" readonly />
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="label-ongkir" for="indukBuntingan">Induk Buntingan</label>
                     <input type="text" class="form-control form-control-sm" id="indukBuntingan" name="indukBuntingan"
                        aria-describedby="emailHelp" readonly />
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <label class="label-ongkir" for="hargaGrosir">Harga Grosir (Minimal 10 Ekor)</label>
                     <input type="text" class="form-control form-control-sm" id="hargaGrosir" name="hargaGrosir"
                        aria-describedby="emailHelp" readonly />
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <div class="exception">Ingin informasi lebih lanjut ?<br />
                        Hubungi Admin <a
                           href="https://api.whatsapp.com/send?phone=6287780605997&text=Halo%20Admin%20saya%20ingin%20bertanya%paket"
                           target="_blank" style="color:blue !important;">DISINI</a></div>
                  </div>
               </div>
            </div>
         </div>
         <hr class="mt-3" />
         <!-- end six_box section -->
         <a href="https://api.whatsapp.com/send?phone=6287780605997"><img src="images/whatsapp.webp" id="whatsapp"
               class="whatsapp" alt=""></a>
      </div>
      <!-- End Detail Beli Section -->
      <!-- news section -->
      <?php
   include('templates/promo.php');
   ?>
      <!-- end news section -->
</section>


<script>
   const whatsapp = document.getElementById("whatsapp");
   // Tampilkan atau sembunyikan tombol berdasarkan posisi scroll
   whatsapp.style.display = "block";

   var jenisSelect = document.getElementById("jenisSelect");
   var anakanInput = document.getElementById("anakan");
   var remajaInput = document.getElementById("remaja");
   var indukanJantanInput = document.getElementById("indukJantan");
   var indukanBuntinganInput = document.getElementById("indukBuntingan");
   var hargaGrosirInput = document.getElementById("hargaGrosir");

   function formatNumberWithThousands(number) {
      var parts = number.toString().split(".");
      parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      return parts.join(".");
   }

   function fillOngkirInfo(selectedJenis) {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
         if (this.readyState === 4 && this.status === 200) {
            var dataJenis = JSON.parse(this.responseText);

            if (dataJenis.length > 0) {
               var infoJenis = dataJenis[0];
               anakanInput.value = "Rp. " + formatNumberWithThousands(infoJenis.anakan);
               remajaInput.value = "Rp. " + formatNumberWithThousands(infoJenis.remaja);
               indukanJantanInput.value = "Rp. " + formatNumberWithThousands(infoJenis.induk_jantan);
               indukanBuntinganInput.value = "Rp. " + formatNumberWithThousands(infoJenis.induk_buntingan);
               hargaGrosirInput.value = "Rp. " + formatNumberWithThousands(infoJenis.grosir);

            } else {
               anakanInput.value = "Tidak Ditemukan";
               remajaInput.value = "Tidak Ditemukan";
               indukanJantanInput.value = "Tidak Ditemukan";
               indukanBuntinganInput.value = "Tidak Ditemukan";
               hargaGrosirInput.value = "Tidak Ditemukan";
            }
         }
      };
      xhttp.open("GET", "get_paket.php?id=" + selectedJenis,
         true);
      xhttp.send();
   }

   function resetOngkirFields() {
      anakanInput.value = "";
      remajaInput.value = "";
      indukanJantanInput.value = "";
      indukanBuntinganInput.value = "";
      hargaGrosirInput.value = "";
   }

   jenisSelect.addEventListener("change", function () {
      var selectedJenis = jenisSelect.value;
      fillOngkirInfo(selectedJenis);
   });
</script>

<?php 
   include('templates/footer.php');
   ?>