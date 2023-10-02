<?php
include('../database/conn.php');

// --Marmut Tab Management--
if(isset($_POST['deleteMarmut'])){
    $idMarmut = $_POST['id_marmut'];
    $jenisMarmut = checkMarmut($idMarmut);
    $deleteAction = deleteMarmut($idMarmut);
    if($deleteAction == 'success'){
        echo '<script>alert("Marmut berhasil dihapus");</script>';

        // log write
        $logText = "Marmut ".$jenisMarmut[0]['jenis_marmut']." has been deleted from list.";
        $writeLog = logRecord("DELETE", "MARMUT", $idMarmut, $logText);

        // Menghasilkan URL dengan protokol HTTP atau HTTPS secara dinamis
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        if($protocol == 'http://'){
            $url = $protocol . $_SERVER['HTTP_HOST'] . '/marmutben/admin/marmut-list.php';
        }else{
            $url = $protocol . $_SERVER['HTTP_HOST'] . '/admin/marmut-list.php';
        }

        echo '<script>window.location.href = "' . $url . '";</script>';
        exit;
    }
}
if(isset($_POST['editMarmut'])){
    $idMarmut = $_POST['id_marmut'];
    $jenisMarmut = $_POST['jenis_marmut'];
    $hargaMarmut = $_POST['harga_marmut'];
    $categoriesMarmut = $_POST['categories_marmut'];
    $description = $_POST['description'];
    
    // Mengatur direktori tempat menyimpan gambar
    $targetDirectory = "../../images/";
    $newImageName = "";
    $sqlTambahan = ""; 

    // Check if exist
    $sql = "
        SELECT id 
        FROM t_marmutben_products 
        WHERE jenis_marmut = '$jenisMarmut' 
        AND categories_marmut = '$categoriesMarmut' 
        AND id != '$idMarmut'
    ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // log write
        $logText = "Marmut $jenisMarmut is duplicate.";
        $writeLog = logRecord("UPDATE", "MARMUT", $idMarmut, $logText);
        echo '<script>alert("Data duplikat!");</script>';
        echo '<script>window.location.href = "../marmut-edit.php";</script>';
        exit;
    }
    // End

    // Memeriksa apakah file gambar baru diunggah
    if(isset($_FILES['image_marmut']) && $_FILES['image_marmut']['error'] === UPLOAD_ERR_OK){
        $imageInfo = pathinfo($_FILES['image_marmut']['name']);
        $imageExtension = $imageInfo['extension'];

        // Ambil jalur gambar lama dari database
        $sqlGetOldImage = "SELECT image_marmut FROM t_marmutben_products WHERE id = '$idMarmut'";
        $resultGetOldImage = $conn->query($sqlGetOldImage);

        if ($resultGetOldImage->num_rows > 0) {
            $row = $resultGetOldImage->fetch_assoc();
            $oldImageFilePath = "../../" . $row['image_marmut'];

            // Hapus gambar lama jika ada
            if (file_exists($oldImageFilePath)) {
                unlink($oldImageFilePath);
            }
        }

        // Membuat nama file gambar baru dengan format yang unik
        $newImageName = uniqid('marmut_') . '.' . $imageExtension;
        $targetFilePath = $targetDirectory . $newImageName;
        move_uploaded_file($_FILES['image_marmut']['tmp_name'], $targetFilePath);

        $filePath = "images/$newImageName";

        $sqlTambahan = ", image_marmut = '$filePath'";
    }

    // Old Data
    $sqlOldData = "SELECT a.id, a.jenis_marmut as `Jenis Marmut`, a.image_marmut as `Image Marmut`, b.categories `Kategori Marmut`, a.description as `Description`, a.harga as `Harga` 
    FROM t_marmutben_products as a 
    LEFT JOIN t_marmutben_categories as b on a.categories_marmut = b.id  
    WHERE a.id = $idMarmut";
    $resultOldData = mysqli_query($conn, $sqlOldData);
    $rowOldData = mysqli_fetch_assoc($resultOldData);

    $sqlUpdate = "
        UPDATE t_marmutben_products SET `jenis_marmut`='$jenisMarmut', `categories_marmut` = '$categoriesMarmut', 
        `description` = '$description', `harga` = '$hargaMarmut' $sqlTambahan 
        WHERE id = '$idMarmut'
    ";
    $result = $conn->query($sqlUpdate);

    // New Data After Update
    $sqlNewData = "SELECT a.id, a.jenis_marmut as `Jenis Marmut`, a.image_marmut as `Image Marmut`, b.categories `Kategori Marmut`, a.description as `Description`, a.harga as `Harga` 
    FROM t_marmutben_products as a 
    LEFT JOIN t_marmutben_categories as b on a.categories_marmut = b.id  
    WHERE a.id = $idMarmut";
    $resultNewData = mysqli_query($conn, $sqlNewData);
    $rowNewData = mysqli_fetch_assoc($resultNewData);

    // Bandingkan nilai-nilai field satu per satu
    $changedFields = array();
    foreach ($rowOldData as $field => $valueOldData) {
        $valueUpdated = $rowNewData[$field];
        if ($valueOldData != $valueUpdated) {
            $changedFields[$field] = $valueUpdated;
        }
    }

    // Log jika ada field yang diupdate
    if (!empty($changedFields)) {
        foreach ($changedFields as $field => $valueUpdated) {
            $valueOldData = $rowOldData[$field];
            $logText = "Updated field: $field from <strong>$valueOldData</strong> to <strong>$valueUpdated</strong> ";
            // Log write
            $writeLog = logRecord("UPDATE", "MARMUT", $idMarmut, $logText);
        }
    }


    echo '<script>alert("Data berhasil di Update !");</script>';
    // Redirect to the page after update
    echo '<script>window.location.href = "../marmut-list.php";</script>';
    exit;
}
if(isset($_POST['addMarmut'])){
    $jenisMarmut = $_POST['jenis_marmut'];
    $hargaMarmut = $_POST['harga_marmut'];
    $categoriesMarmut = $_POST['categories_marmut'];
    $description = $_POST['description'];
    $dateCreated = date("Y-m-d H:i:s");
    
    // Mengatur direktori tempat menyimpan gambar
    $targetDirectory = "../../images/";
    $newImageName = "";
    $sqlTambahan = ""; 
    $imageInfo = pathinfo($_FILES['image_marmut']['name']);
    $imageExtension = $imageInfo['extension'];

    // Membuat nama file gambar baru dengan format yang unik
    $newImageName = uniqid('marmut_') . '.' . $imageExtension;
    $targetFilePath = $targetDirectory . $newImageName;
    move_uploaded_file($_FILES['image_marmut']['tmp_name'], $targetFilePath);
    $filePath = "images/$newImageName";
    
    // Check if exist
    $sql = "
        SELECT id 
        FROM t_marmutben_products 
        WHERE jenis_marmut = '$jenisMarmut' 
        AND categories_marmut = '$categoriesMarmut'
    ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $logText = "Marmut <b>".$jenisMarmut."</b> is duplicate!.";
        $writeLog = logRecord("INSERT", "MARMUT", $jenisMarmut, $logText);
        echo '<script>alert("Data duplikat!");</script>';
        echo '<script>window.location.href = "../marmut-list.php";</script>';
        exit;
    }
    // End

    $sqlInsert = "
        INSERT INTO t_marmutben_products (jenis_marmut, image_marmut, categories_marmut, description, harga, date_created) 
        VALUES ('$jenisMarmut','$filePath','$categoriesMarmut','$description','$hargaMarmut','$dateCreated')
    ";
    $resultInsert = $conn->query($sqlInsert);
    if ($resultInsert === TRUE) {
        $insertedId = $conn->insert_id; // Mengambil ID hasil query INSERT
        $logText = "$jenisMarmut has been added to list.";
        $writeLog = logRecord("INSERT", "MARMUT", $insertedId, $logText);
        echo '<script>alert("Data berhasil di Insert !");</script>';
        echo '<script>window.location.href = "../marmut-list.php";</script>';
        exit;
    }

    echo '<script>alert("Data gagal di Insert !");</script>';
    echo '<script>window.location.href = "../marmut-list.php";</script>';
    exit;
}
// End Marmut Tab Management


// --Settings Tab Management--
if(isset($_POST['add_config'])){
    $emailNotifications = $_POST['email_notifications'];

    $checkConfig = getListConfig();
    if (!empty($checkConfig)) {
        $sql = "
            UPDATE `t_marmutben_config` SET `value` = '$emailNotifications' 
            WHERE id = 1
        ";
        $result = $conn->query($sql);
        $isSucces = 1; 

        // Menghasilkan URL dengan protokol HTTP atau HTTPS secara dinamis
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        if($protocol == 'http://'){
            $url = $protocol . $_SERVER['HTTP_HOST'] . '/marmutben/admin/settings.php';
        }else{
            $url = $protocol . $_SERVER['HTTP_HOST'] . '/admin/settings.php';
        }

        if($isSucces == 1){
            $logText = "Email Notifications is now set to $emailNotifications";
            $writeLog = logRecord("UPDATE", "SETTINGS", $emailNotifications, $logText);
            echo '<script>alert("Data berhasil di Update");</script>';
            echo '<script>window.location.href = "' . $url . '";</script>';
            exit;
        }
    }
    

    $sql = "INSERT INTO `t_marmutben_config` (`type`, `value`) 
    VALUE ('Email Notifications', '$emailNotifications')";
    $result = $conn->query($sql);
    $isSucces = 1; 

    // Menghasilkan URL dengan protokol HTTP atau HTTPS secara dinamis
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
    if($protocol == 'http://'){
      $url = $protocol . $_SERVER['HTTP_HOST'] . '/marmutben/admin/settings.php';
    }else{
      $url = $protocol . $_SERVER['HTTP_HOST'] . '/admin/settings.php';
    }

    if($isSucces == 1){
        $logText = "Email Notifications is set to $emailNotifications";
        $writeLog = logRecord("INSERT", "SETTINGS", $emailNotifications, $logText);

        echo '<script>alert("Data berhasil di Input");</script>';
        echo '<script>window.location.href = "' . $url . '";</script>';
      exit;
    }
}
// End Settings Tab Management

// Log
if(isset($_POST['submitFilter'])){
    $firstDate = $_POST['first_date']." 00:00:00";
    $lastDate = $_POST['last_date']." 23:59:59";

    // Menghasilkan URL dengan protokol HTTP atau HTTPS secara dinamis
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
    if($protocol == 'http://'){
        if($firstDate == " 00:00:00" || $lastDate == " 23:59:59"){
            $url = $protocol . $_SERVER['HTTP_HOST'] . '/marmutben/admin/log.php';
        }else{
            $url = $protocol . $_SERVER['HTTP_HOST'] . '/marmutben/admin/log.php?first='.$firstDate.'&last='.$lastDate;
        }    
    }else{
        if($firstDate == " 00:00:00" || $lastDate == " 23:59:59"){
            $url = $protocol . $_SERVER['HTTP_HOST'] . '/admin/log.php';
        }else{
            $url = $protocol . $_SERVER['HTTP_HOST'] . '/admin/log.php?first='.$firstDate.'%00:00:00&last='.$lastDate.'%23:59:59';
        } 
    }

    echo '<script>window.location.href = "' . $url . '";</script>';
}

// --Best Sellers Tab Management--
if(isset($_POST['submitBestSeller'])){
    $widgetId = $_POST['widget_id'];
    $idMarmut = $_POST['jenis_marmut'];
    $jumlahTerjual = $_POST['jumlah_terjual'];

    $deleteAction = updateBestSeller($widgetId, $idMarmut, $jumlahTerjual);
    if($deleteAction == 'success'){
        $logText = "Best Seller is set to $idMarmut with $jumlahTerjual sales";
        $writeLog = logRecord("UPDATE", "BEST SELLER", $idMarmut, $logText);
        echo '<script>alert("Widget Berhasil di Update");</script>';
  
        // Menghasilkan URL dengan protokol HTTP atau HTTPS secara dinamis
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        if($protocol == 'http://'){
            $url = $protocol . $_SERVER['HTTP_HOST'] . '/marmutben/admin/bestseller.php';
        }else{
            $url = $protocol . $_SERVER['HTTP_HOST'] . '/admin/bestseller.php';
        }
  
        echo '<script>window.location.href = "' . $url . '";</script>';
        exit;
    }
}
// End Best Sellers Tab Management


// --Promo Tab Management--
if(isset($_POST['deletePromo'])){
    $idPromo = $_POST['id_promo'];
    $namePromo = checkPromo($idPromo);
    $deleteAction = deletePromo($idPromo);
    if($deleteAction == 'success'){
        $logText = "Promo <b>".$namePromo[0]['nama_promo']."</b> has been deleted";
        $writeLog = logRecord("DELETE", "PROMO", $idPromo, $logText);

        echo '<script>alert("Promo berhasil dihapus");</script>';
  
        // Menghasilkan URL dengan protokol HTTP atau HTTPS secara dinamis
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        if($protocol == 'http://'){
            $url = $protocol . $_SERVER['HTTP_HOST'] . '/marmutben/admin/promo.php';
        }else{
            $url = $protocol . $_SERVER['HTTP_HOST'] . '/admin/promo.php';
        }
  
        echo '<script>window.location.href = "' . $url . '";</script>';
        exit;
    }
}
if(isset($_POST['addPromo'])){
    $namaPromo = $_POST['nama_promo'];
    $kodePromo = $_POST['kode_promo'];
    $jumlahPromo = $_POST['jumlah_promo'];
    $description = $_POST['description'];
    $startAt = date('Y-m-d H:i:s');
    $createdAt = date('Y-m-d H:i:s');
    $expiredAt = $_POST['expired_at'] . " 23:55:00";
    $status = '1';
    
    // Mengatur direktori tempat menyimpan gambar
    $targetDirectory = "../../images/";
    $newImageName = "";
    $sqlTambahan = ""; 
    $imageInfo = pathinfo($_FILES['image_promo']['name']);
    $imageExtension = $imageInfo['extension'];

    // Membuat nama file gambar baru dengan format yang unik
    $newImageName = uniqid('promo_') . '.' . $imageExtension;
    $targetFilePath = $targetDirectory . $newImageName;
    move_uploaded_file($_FILES['image_promo']['tmp_name'], $targetFilePath);
    $filePath = "images/$newImageName";
    
    // Check if exist
    $sql = "
        SELECT id 
        FROM t_marmutben_promo 
        WHERE nama_promo = '$namaPromo' 
    ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $logText = "Promo <b>".$namaPromo."</b> is duplicate!.";
        $writeLog = logRecord("INSERT", "PROMO", $namaPromo, $logText);
        echo '<script>alert("Data duplikat!");</script>';
        echo '<script>window.location.href = "../promo-add.php";</script>';
        exit;
    }
    // End

    $sqlUpdate = "
        INSERT INTO t_marmutben_promo (`nama_promo`, `image_promo`, `kode_promo`, `jumlah_promo`, `caption_promo`, 
        `start_at`, `expired_at`, `status`, `created_at`) 
        VALUES ('$namaPromo','$filePath','$kodePromo','$jumlahPromo','$description','$startAt', '$expiredAt','$status','$createdAt')
    ";
    $result = $conn->query($sqlUpdate);

    $insertedId = $conn->insert_id;
    $logText = "Promo <b>".$namaPromo."</b> has been added.";
    $writeLog = logRecord("INSERT", "PROMO", $insertedId, $logText);

    echo '<script>alert("Data berhasil di Insert !");</script>';
    echo '<script>window.location.href = "../promo.php";</script>';
    exit;
}
if(isset($_POST['editPromo'])){
    $idPromo = $_POST['id_promo'];
    $namaPromo = $_POST['nama_promo'];
    $kodePromo = $_POST['kode_promo'];
    $jumlahPromo = $_POST['jumlah_promo'];
    $description = $_POST['description'];
    $expiredAt = $_POST['expired_at'] . " 23:55:00";
    
    // Mengatur direktori tempat menyimpan gambar
    $targetDirectory = "../../images/";
    $newImageName = "";
    $sqlTambahan = ""; 

    // Check if exist
    $sql = "
        SELECT id 
        FROM t_marmutben_promo 
        WHERE nama_promo = '$namaPromo' 
        AND id != '$idPromo'
    ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $logText = "Promo <b>".$namaPromo."</b> is duplicate !";
        $writeLog = logRecord("INSERT", "PROMO", $idPromo, $logText);
        echo '<script>alert("Data duplikat!");</script>';
        echo '<script>window.location.href = "../marmut-edit.php";</script>';
        exit;
    }
    // End

    // Memeriksa apakah file gambar baru diunggah
    if(isset($_FILES['image_promo']) && $_FILES['image_promo']['error'] === UPLOAD_ERR_OK){
        $imageInfo = pathinfo($_FILES['image_promo']['name']);
        $imageExtension = $imageInfo['extension'];

        // Ambil jalur gambar lama dari database
        $sqlGetOldImage = "SELECT image_promo FROM t_marmutben_promo WHERE id = '$idPromo'";
        $resultGetOldImage = $conn->query($sqlGetOldImage);

        if ($resultGetOldImage->num_rows > 0) {
            $row = $resultGetOldImage->fetch_assoc();
            $oldImageFilePath = "../../" . $row['image_promo'];

            // Hapus gambar lama jika ada
            if (file_exists($oldImageFilePath)) {
                unlink($oldImageFilePath);
            }
        }

        // Membuat nama file gambar baru dengan format yang unik
        $newImageName = uniqid('promo_') . '.' . $imageExtension;
        $targetFilePath = $targetDirectory . $newImageName;
        move_uploaded_file($_FILES['image_promo']['tmp_name'], $targetFilePath);

        $filePath = "images/$newImageName";

        $sqlTambahan = ", image_promo = '$filePath'";
    }
    
        // Old Data
        $sqlOldData = "
            SELECT id, nama_promo as `Nama Promo`, image_promo as `Image Promo`, kode_promo `Kode Promo`, 
            jumlah_promo as `Jumlah Promo`, caption_promo as `Caption Promo`, expired_at as `Expired At` 
            FROM t_marmutben_promo 
            WHERE id = $idPromo
        ";
        $resultOldData = mysqli_query($conn, $sqlOldData);
        $rowOldData = mysqli_fetch_assoc($resultOldData);
    
        $sqlUpdate = "
            UPDATE t_marmutben_promo SET `nama_promo`='$namaPromo', `kode_promo` = '$kodePromo', 
            `jumlah_promo` = '$jumlahPromo', `caption_promo` = '$description', `expired_at` = '$expiredAt' $sqlTambahan 
            WHERE id = '$idPromo'
        ";
        $result = $conn->query($sqlUpdate);
    
        // New Data After Update
        $sqlNewData = "
            SELECT id, nama_promo as `Nama Promo`, image_promo as `Image Promo`, kode_promo `Kode Promo`, 
            jumlah_promo as `Jumlah Promo`, caption_promo as `Caption Promo`, expired_at as `Expired At` 
            FROM t_marmutben_promo 
            WHERE id = $idPromo
        ";
        $resultNewData = mysqli_query($conn, $sqlNewData);
        $rowNewData = mysqli_fetch_assoc($resultNewData);
    
        // Bandingkan nilai-nilai field satu per satu
        $changedFields = array();
        foreach ($rowOldData as $field => $valueOldData) {
            $valueUpdated = $rowNewData[$field];
            if ($valueOldData != $valueUpdated) {
                $changedFields[$field] = $valueUpdated;
            }
        }
    
        // Log jika ada field yang diupdate
        if (!empty($changedFields)) {
            foreach ($changedFields as $field => $valueUpdated) {
                $valueOldData = $rowOldData[$field];
                $logText = "Updated field: $field from <strong>$valueOldData</strong> to <strong>$valueUpdated</strong> ";
                // Log write
                $writeLog = logRecord("UPDATE", "PROMO", $idPromo, $logText);
            }
        }

    echo '<script>alert("Data berhasil di Update !");</script>';
    echo '<script>window.location.href = "../promo.php";</script>';
    exit;
}
// End Promo Tab Management


// --Paket Tab Management--
if(isset($_POST['deletePaket'])){
    $idPaket = $_POST['id_paket'];
    $jenisPaket = checkPaket($idPaket);
    $deleteAction = deletePaket($idPaket);
    if($deleteAction == 'success'){
        $logText = "Paket <b>".$jenisPaket[0]['jenis']."</b> has been deleted.";
        $writeLog = logRecord("INSERT", "PROMO", $idPaket, $logText);
        echo '<script>alert("Paket berhasil dihapus");</script>';
  
      // Menghasilkan URL dengan protokol HTTP atau HTTPS secara dinamis
      $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
      if($protocol == 'http://'){
        $url = $protocol . $_SERVER['HTTP_HOST'] . '/marmutben/admin/paket.php';
      }else{
        $url = $protocol . $_SERVER['HTTP_HOST'] . '/admin/paket.php';
      }
  
      echo '<script>window.location.href = "' . $url . '";</script>';
      exit;
    }
}
if(isset($_POST['deleteAllPaket'])){
    $sqlUpdate = "
        DELETE FROM t_marmutben_paket 
    ";
    $result = $conn->query($sqlUpdate);

    $logText = "All paket has been deleted.";
    $writeLog = logRecord("DELETE", "PAKET", "Delete All", $logText);


    echo '<script>alert("Data berhasil di Delete !");</script>';
    echo '<script>window.location.href = "../paket.php";</script>';
    exit;
}
// Menggunakan function importCSVDataToDatabase:
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['importPaket'])) {
    global $conn;
    if (isset($_FILES['importFilePaket'])) {
        $fileInputName = 'importFilePaket';

        $tableName = 't_marmutben_paket';

        if (importCSVPaketDataToDatabase($fileInputName, $conn, $tableName)) {
            $logText = "Import data paket success.";
            $writeLog = logRecord("INSERT", "PAKET", "Import All", $logText);
            echo '<script>alert("Data berhasil diimpor ke dalam database.");</script>';
            echo '<script>window.location.href = "../paket.php";</script>';
        } else {
            echo '<script>alert("Gagal mengimpor data ke dalam database.");</script>';
            echo '<script>window.location.href = "../paket.php";</script>';
        }

        // Tutup koneksi database
        mysqli_close($conn);
    } else {
        echo "File CSV tidak ditemukan.";
    }
}
function importCSVPaketDataToDatabase($fileInputName, $databaseConnection, $tableName) {
    if ($_FILES[$fileInputName]['error'] == UPLOAD_ERR_OK) {
        // Baca file CSV langsung dari temp file
        $tempFileName = $_FILES[$fileInputName]['tmp_name'];

        // Buka file CSV
        if (($handle = fopen($tempFileName, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                // Lengkapi ini sesuai dengan struktur tabel Anda
                $jenis = mysqli_real_escape_string($databaseConnection, $data[0]);
                $anakan = mysqli_real_escape_string($databaseConnection, $data[1]);
                $remaja = mysqli_real_escape_string($databaseConnection, $data[2]);
                $induk_jantan = mysqli_real_escape_string($databaseConnection, $data[3]);
                $induk_buntingan = mysqli_real_escape_string($databaseConnection, $data[4]);
                $grosir = mysqli_real_escape_string($databaseConnection, $data[5]);

                // Buat query SQL untuk memasukkan data
                $sql = "INSERT INTO $tableName (jenis, anakan, remaja, induk_jantan, induk_buntingan, grosir) 
                VALUES ('$jenis', '$anakan', '$remaja', '$induk_jantan', '$induk_buntingan', '$grosir')";
                mysqli_query($databaseConnection, $sql);
            }
            fclose($handle);
        }
        return true; // Import berhasil
    } else {
        return false; // Error saat mengunggah file
    }
}
// End Paket Tab Management


// --Ongkir Tab Management--
if(isset($_POST['deleteAllOngkir'])){
    $sqlUpdate = "
        DELETE FROM t_marmutben_ongkir
    ";
    $result = $conn->query($sqlUpdate);
    $logText = "All ongkir has been deleted.";
    $writeLog = logRecord("INSERT", "ONGKIR", "Delete All", $logText);
    echo '<script>alert("Data berhasil di Delete !");</script>';
    echo '<script>window.location.href = "../ongkir.php";</script>';
    exit;
}
// Menggunakan function importCSVDataToDatabase:
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['importOngkir'])) {
    global $conn;
    if (isset($_FILES['importFileOngkir'])) {
        $fileInputName = 'importFileOngkir';

        $tableName = 't_marmutben_ongkir';

        if (importCSVDataToDatabase($fileInputName, $conn, $tableName)) {
            $logText = "Import data ongkir success.";
            $writeLog = logRecord("INSERT", "ONGKIR", "Import All", $logText);
            echo '<script>alert("Data berhasil diimpor ke dalam database.");</script>';
            echo '<script>window.location.href = "../ongkir.php";</script>';
        } else {
            echo '<script>alert("Gagal mengimpor data ke dalam database.");</script>';
            echo '<script>window.location.href = "../ongkir.php";</script>';
        }

        // Tutup koneksi database
        mysqli_close($conn);
    } else {
        echo "File CSV tidak ditemukan.";
    }
}
function importCSVDataToDatabase($fileInputName, $databaseConnection, $tableName) {
    if ($_FILES[$fileInputName]['error'] == UPLOAD_ERR_OK) {
        // Baca file CSV langsung dari temp file
        $tempFileName = $_FILES[$fileInputName]['tmp_name'];

        // Buka file CSV
        if (($handle = fopen($tempFileName, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                // Lengkapi ini sesuai dengan struktur tabel Anda
                $wilayah = mysqli_real_escape_string($databaseConnection, $data[0]);
                $wilayahKecil = mysqli_real_escape_string($databaseConnection, $data[1]);
                $ongkirCod = mysqli_real_escape_string($databaseConnection, $data[2]);
                $ongkirOjol = mysqli_real_escape_string($databaseConnection, $data[3]);
                $ongkirKaLogistik = mysqli_real_escape_string($databaseConnection, $data[4]);

                // Buat query SQL untuk memasukkan data
                $sql = "INSERT INTO $tableName (wilayah, wilayah_kecil, ongkir_cod, ongkir_ojol, ongkir_ka_logistik) 
                VALUES ('$wilayah', '$wilayahKecil', '$ongkirCod', '$ongkirOjol', '$ongkirKaLogistik')";
                mysqli_query($databaseConnection, $sql);
            }
            fclose($handle);
        }

        return true; // Import berhasil
    } else {
        return false; // Error saat mengunggah file
    }
}
// End Ongkir Tab Management


// --General Function--
function getListMarmut(){
    global $conn;
    $sql = "
        SELECT a.*, b.categories FROM t_marmutben_products as a
        LEFT JOIN t_marmutben_categories as b on a.categories_marmut = b.id
        WHERE b.status != 0
        ORDER BY id DESC";
    $result = $conn->query($sql);
    $marmutArray = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $marmutArray[] = $row;
        }
    }
    return $marmutArray;
}

function getListConfig(){
    global $conn;
    $sql = "
        SELECT * FROM t_marmutben_config
    ";
    $result = $conn->query($sql);
    $marmutArray = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $marmutArray[] = $row;
        }
    }
    return $marmutArray;
}

function updateBestSeller($widgetId, $marmut_id, $jumlah_terjual){
    global $conn;
      $sql = "
          UPDATE t_marmutben_best_sellers 
          SET `marmut_id` = '$marmut_id', `jumlah_terjual` = '$jumlah_terjual' 
          WHERE id = '$widgetId'
      ";
      $conn->query($sql);
      return "success";
  }

function deleteMarmut($idMarmut){
  global $conn;
    $sql = "
        DELETE FROM t_marmutben_products
        WHERE id = '$idMarmut'
    ";
    $conn->query($sql);
    return "success";
}

function deletePromo($id_promo){
    global $conn;
      $sql = "
          DELETE FROM t_marmutben_promo
          WHERE id = '$id_promo'
      ";
      $conn->query($sql);
      return "success";
  }

function deletePaket($idPaket){
    global $conn;
      $sql = "
          DELETE FROM t_marmutben_paket 
          WHERE id = '$idPaket'
      ";
      $conn->query($sql);
      return "success";
}

function checkMarmut($idMarmut){
  global $conn;
  $sql = "
        SELECT a.*, b.categories FROM t_marmutben_products as a 
        LEFT JOIN t_marmutben_categories as b on a.categories_marmut = b.id 
        WHERE a.id = '$idMarmut'";
    $result = $conn->query($sql);
    $marmutArray = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $marmutArray[] = $row;
        }
    }
    return $marmutArray;
}

function checkPromo($idPromo){
    global $conn;
    $sql = "
          SELECT * FROM t_marmutben_promo  
          WHERE id = '$idPromo'
    ";
    $result = $conn->query($sql);
    $marmutArray = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $marmutArray[] = $row;
        }
    }
    return $marmutArray;
}

function checkPaket($idPaket){
    global $conn;
    $sql = "
          SELECT * FROM t_marmutben_paket  
          WHERE id = '$idPaket'
    ";
    $result = $conn->query($sql);
    $marmutArray = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $marmutArray[] = $row;
        }
    }
    return $marmutArray;
}

function getCategories($idCategories){
  global $conn;
  $sql = "
        SELECT * FROM t_marmutben_categories 
        WHERE id != '$idCategories' 
        ORDER BY id ASC";
    $result = $conn->query($sql);
    $marmutArray = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $marmutArray[] = $row;
        }
    }
    return $marmutArray;
}

function getPromo($id_promo){
    global $conn;
    $sql = "
          SELECT * FROM t_marmutben_promo  
          WHERE id = '$id_promo'";
      $result = $conn->query($sql);
      $marmutArray = array();
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $marmutArray[] = $row;
          }
      }
      return $marmutArray;
}

function getAllCategories(){
    global $conn;
    $sql = "
          SELECT * FROM t_marmutben_categories 
          ORDER BY id ASC";
      $result = $conn->query($sql);
      $marmutArray = array();
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $marmutArray[] = $row;
          }
      }
      return $marmutArray;
}

function getListOngkir(){
    global $conn;
    $sql = "
        SELECT * FROM t_marmutben_ongkir 
        ORDER BY wilayah ASC, wilayah_kecil ASC
    ";
    $result = $conn->query($sql);
    $marmutArray = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $marmutArray[] = $row;
        }
    }
    return $marmutArray;
}

function getListPromo(){
    global $conn;
    $sql = "
        SELECT * FROM t_marmutben_paket 
        ORDER BY jenis ASC
    ";
    $result = $conn->query($sql);
    $marmutArray = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $marmutArray[] = $row;
        }
    }
    return $marmutArray;
}

function getBestSeller(){
    global $conn;
    $sql = "
        SELECT a.*, b.jenis_marmut, b.image_marmut, b.categories_marmut, b.harga, c.categories FROM t_marmutben_best_sellers as a 
        LEFT JOIN t_marmutben_products as b on a.marmut_id = b.id 
        LEFT JOIN t_marmutben_categories as c on b.categories_marmut = c.id 
        ORDER BY a.id ASC 
        LIMIT 3
    ";
    $result = $conn->query($sql);
    $marmutArray = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $marmutArray[] = $row;
        }
    }
    return $marmutArray;
}

function getListMarmutBestSeller($id_marmut){
    global $conn;
    $sql = "
        SELECT a.*, b.categories FROM t_marmutben_products as a
        LEFT JOIN t_marmutben_categories as b on a.categories_marmut = b.id
        WHERE b.status != 0 
        AND a.id != '$id_marmut'
        ORDER BY id DESC";
    $result = $conn->query($sql);
    $marmutArray = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $marmutArray[] = $row;
        }
    }
    return $marmutArray;
}

function getDataWidget($id_widget){
    global $conn;
    $sql = "
        SELECT * FROM t_marmutben_best_sellers 
        WHERE id = '$id_widget'
    ";
    $result = $conn->query($sql);
    $marmutArray = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $marmutArray[] = $row;
        }
    }
    return $marmutArray;
}

function getListPromoSection(){
    global $conn;
    $sql = "
        SELECT * FROM t_marmutben_promo 
        ORDER BY id DESC
    ";
    $result = $conn->query($sql);
    $marmutArray = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $marmutArray[] = $row;
        }
    }
    return $marmutArray;
}

function getAllLog(){
    global $conn;
    $sql = "
        SELECT * FROM t_marmutben_log 
        ORDER BY timestamp DESC 
        LIMIT 4
    ";
    $result = $conn->query($sql);
    $marmutArray = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $marmutArray[] = $row;
        }
    }
    return $marmutArray;
}

function logRecord($type, $menu, $item, $log){
    global $conn;
    $sql = "
        INSERT INTO `t_marmutben_log` (type, menu, item, log)
        VALUES ('$type', '$menu', '$item', '$log')
    ";
    $conn->query($sql);
    return "success";
}

function countMarmutCategories(){
    global $conn;
    $sql = "
        SELECT categories_marmut, COUNT(*) as jumlah_data 
        FROM t_marmutben_products 
        WHERE categories_marmut IN (1, 2, 3, 4, 5, 6) 
        GROUP BY categories_marmut 
        ORDER BY categories_marmut
    ";
    $result = $conn->query($sql);
    $marmutArray = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $marmutArray[] = $row;
        }
    }
    return $marmutArray;
}

function getDataHit(){
    global $conn;
    $sql = "
        SELECT * FROM t_marmutben_hit 
        ORDER BY id
    ";
    $result = $conn->query($sql);
    $marmutArray = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $marmutArray[] = $row;
        }
    }
    return $marmutArray;
}

function getLog($firstDate = "", $lastDate = ""){
    global $conn;

    if($firstDate != "" && $lastDate != ""){
        $sql = "
            SELECT * FROM t_marmutben_log 
            WHERE timestamp BETWEEN '$firstDate' AND '$lastDate'
            ORDER BY id DESC
        ";
    }else{
        $sql = "
            SELECT * FROM t_marmutben_log 
            ORDER BY id DESC
        ";
    }
    
    $result = $conn->query($sql);
    $marmutArray = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $marmutArray[] = $row;
        }
    }
    return $marmutArray;
}
// End General Function

// Fungsi untuk menutup koneksi
function closeConnection($conn) {
    $conn->close();
}
?>