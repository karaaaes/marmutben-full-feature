<style>
    .news_img img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        /* Mempertahankan aspek rasio dan mengisi bingkai jika memungkinkan */
    }

    .promo-list {
        margin-top: 40px;
    }
</style>
<!-- promo section -->
<div class="news mb-5">
    <div class="container">
        <div class="row mb-2">
            <div class="col-md-12">
                <div class="titlepage">
                    <h3>Promo Terbaru</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <?php 
               $dataPromo = getListPromo();
               foreach ($dataPromo as $promo) {
                $extractedCreatedAt = explode(" ", $promo['created_at']);
                $date = date_create($extractedCreatedAt[0]);
                $formattedDate = date_format($date, "M d, Y");
            ?>
            <div class="col-md-6 each-promo">
                <div class="row d_flex">
                    <div class="col-md-4 news_img_promo">
                        <figure><img src="<?php echo $promo['image_promo']; ?>"></figure>
                    </div>
                    <div class="col-md-8">
                        <div class="news_text_promo" style="">
                            <h4><?php echo $promo['nama_promo']; ?></h4>
                            <div class="created_date"><?php echo $formattedDate; ?></div>
                            <?php echo $promo['caption_promo']; ?>
                            <?php 
                                if($promo['kode_promo'] != '') {
                            ?>
                            <span class="kode_voucher">Kode voucher :
                                    <?php echo $promo['kode_promo']; ?></strong></span>
                            <?php 
                                }else{
                            ?>
                            <span class="kode_voucher">Kode voucher tidak tersedia
                                    <?php echo $promo['kode_promo']; ?></strong></span>
                            <?php 
                            
                                }?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
               }
            ?>
        </div>
    </div>
</div>
<!-- end promo section -->