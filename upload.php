<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['panorama']) && $_FILES['panorama']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['panorama']['tmp_name'];
        $fileName = $_FILES['panorama']['name'];
        $fileSize = $_FILES['panorama']['size'];
        $fileType = $_FILES['panorama']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        
        // 檢查檔案擴展名
        $allowedExts = array('jpg', 'jpeg', 'png');
        if (in_array($fileExtension, $allowedExts)) {
            $uploadFileDir = './uploaded_files/';
            $dest_path = $uploadFileDir . $fileName;
            
            // 確保資料夾存在
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0755, true);
            }

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                echo '檔案上傳成功！';
                echo '<br>檔案儲存在：' . $dest_path;
                echo '<br><img src="' . $dest_path . '" style="width:100%;max-width:600px;">';
            } else {
                echo '檔案上傳失敗。檢查檔案路徑是否正確。';
                echo '<br>目的地路徑：' . $dest_path;
            }
        } else {
            echo '不支援的檔案格式。';
        }
    } else {
        echo '檔案上傳錯誤：' . $_FILES['panorama']['error'];
    }
}
?>
