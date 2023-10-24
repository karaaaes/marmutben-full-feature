<?php
   include('templates/header.php');
   include('core/core_functions.php');

   $checkCategories = checkCategories($_GET['categories']);
   if(empty($checkCategories)){
      echo '<script>alert("Data Kategori Tidak Ada"); 
      window.location.href = "kategori.php";</script>';
      exit; 
   }

   $categoriesId = $_GET['categories'];
   $dataCategories = checkCategories($categoriesId);
   $categoriesName = $dataCategories[0]['categories'];
   $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
   $itemsPerPage = 12; // Jumlah item per halaman

   // Fungsi untuk mengambil total jumlah item
   $totalItems = getTotalItems($categoriesId);

   // Menghitung total halaman yang diperlukan
   $totalPages = ceil($totalItems / $itemsPerPage);

   // Menghitung offset
   $offset = ($currentPage - 1) * $itemsPerPage;

?>
<style>
</style>
<section class="kategori_detail">
   <div id="project" class="project">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h3>Kategori</h3>
               </div>
            </div>
         </div>
         <div class="menu">
            <div class="kategori-item">
               <a href="kategori-detail.php?categories=1">
                  <div class="news_item">
                     <div class="news_img_kategori">
                        <figure><img src="images/icon-little-marmut-new.png"
                              alt="display marmut murah meriah 2023. marmutben, tempat jual beli marmut termurah !">
                        </figure>
                     </div>
                     <div class="news_text mb-3">
                        <div class="title-kategori">Anakan</div>
                     </div>
                  </div>
               </a>
            </div>
            <div class="kategori-item">
               <a href="kategori-detail.php?categories=2">
                  <div class="news_item">
                     <div class="news_img_kategori">
                        <figure><img src="images/icon-little-marmut3.png"
                              alt="display marmut murah meriah 2023. marmutben, tempat jual beli marmut termurah !">
                        </figure>
                     </div>
                     <div class="news_text mb-3">
                        <div class="title-kategori">Remaja</div>
                     </div>
                  </div>
               </a>
            </div>
            <div class="kategori-item">
               <a href="kategori-detail.php?categories=3">
                  <div class="news_item">
                     <div class="news_img_kategori">
                        <figure><img src="images/icon-little-marmut-new1.png"
                              alt="display marmut murah meriah 2023. marmutben, tempat jual beli marmut termurah !">
                        </figure>
                     </div>
                     <div class="news_text mb-3">
                        <div class="title-kategori">Indukan</div>
                     </div>
                  </div>
               </a>
            </div>
            <div class="kategori-item">
               <a href="kategori-detail.php?categories=4">
                  <div class="news_item">
                     <div class="news_img_kategori">
                        <figure><img src="images/icon-little-marmut4.png"
                              alt="display marmut murah meriah 2023. marmutben, tempat jual beli marmut termurah !">
                        </figure>
                     </div>
                     <div class="news_text mb-3">
                        <div class="title-kategori">Bunting</div>
                     </div>
                  </div>
               </a>
            </div>
            <div class="kategori-item">
               <a href="kategori-detail.php?categories=5">
                  <div class="news_item">
                     <div class="news_img_kategori">
                        <figure><img src="images/icon-little-marmut5.png"
                              alt="display marmut murah meriah 2023. marmutben, tempat jual beli marmut termurah !">
                        </figure>
                     </div>
                     <div class="news_text mb-3">
                        <div class="title-kategori">Indukan Hias</div>
                     </div>
                  </div>
               </a>
            </div>
            <div class="kategori-item">
               <a href="kategori-detail.php?categories=6">
                  <div class="news_item">
                     <div class="news_img_kategori">
                        <figure><img src="images/icon-little-marmut6.png"
                              alt="display marmut murah meriah 2023. marmutben, tempat jual beli marmut termurah !">
                        </figure>
                     </div>
                     <div class="news_text mb-3">
                        <div class="title-kategori">Bunting Hias</div>
                     </div>
                  </div>
               </a>
            </div>
         </div>
      </div>
      <!-- Anakan section -->
      <div class="container" id="anakanSection">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h3>Marmut <?= $categoriesName; ?></h3>
               </div>
            </div>
         </div>

         <div class="row mt-3" style="padding-left:15px; padding-right:15px;">
            <?php 
               // Mengambil data produk untuk halaman saat ini
               $dataMarmutanakan = getKategoriMarmutDetail($categoriesId, $itemsPerPage, $offset);
               if (!empty($dataMarmutanakan)) {
                  foreach ($dataMarmutanakan as $marmutAnakan) {
                     $finalPrice = number_format($marmutAnakan['harga'], 0, '.', '.');
            ?>
            <div class="col-6 col-md-2 mb-3" style="padding-right: 0px; padding-left: 0px;">
               <div class="menu-item menu-item-detail">
                  <a
                     href="marmut-detail.php?id=<?php echo $marmutAnakan['id']?>&categories=<?php echo $marmutAnakan['categories_marmut']?>">
                     <div class="news_item">
                        <div class="news_img_best news_img_best_category">
                           <figure><img src="<?php echo $marmutAnakan['image_marmut'] ?>"></figure>
                        </div>

                        <div class="news_text mb-2">
                           <div class="title-marmut"><?php echo $marmutAnakan['jenis_marmut'] ?></div>
                           <div class="price">Rp. <?php echo $finalPrice; ?></div>
                           <div class="categories"><img src="images/guinea-pig.png" alt="Marmut Lucu"
                                 style="margin-right:6px;"><?php echo $marmutAnakan['categories'] ?></div>
                        </div>
                        <div class="col-md-12 text-center mb-2">
                           <btn class="btn btn-primary w-100 buy-btn" style="padding:0.375rem 0.7rem !important;">
                              Beli
                           </btn>
                        </div>
                     </div>
                  </a>
               </div>
            </div>
            <?php 
               }
            ?>
            <div class="col-md-12">
               <!-- Pagination -->
               <div class="pagination">
                  <?php for ($page = 1; $page <= $totalPages; $page++) : ?>
                  <a href="kategori-detail.php?categories=<?php echo $categoriesId; ?>&page=<?php echo $page; ?>"
                     class="<?php echo ($currentPage == $page) ? 'active' : ''; ?>">
                     <?php echo $page; ?>
                  </a>
                  <?php endfor; ?>
               </div>
               <!-- end six_box section -->
               <a href="https://api.whatsapp.com/send?phone=6287780605997"><img src="images/whatsapp.webp" id="whatsapp"
                     class="whatsapp" alt=""></a>
               <!-- End Pagination -->
            </div>
            <?php 
            }else{
            ?>
            <div class="col-12 col-md-12" style="padding-right: 0px; padding-left: 0px; display:flex; text-align: center; justify-content: center;">
               Data tidak Ditemukan
            </div>
            <?php
            }
            ?>
         </div>
      </div>
   </div>
   <!-- End Anakan Section -->

   <!-- fashion section -->
   <div class="fashion mt-3 mb-3">
      <img src="images/big-banner.jpg" alt="#" />
   </div>
   <!-- end fashion section -->
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

   document.querySelector('a[href="#myDiv"]').addEventListener('click', function (e) {
      e.preventDefault();
      document.querySelector(this.getAttribute('href')).scrollIntoView({
         behavior: 'smooth'
      });
   });
</script>
<?php 
include('templates/footer.php');
?>