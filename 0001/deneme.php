
<?php
require $_SERVER["DOCUMENT_ROOT"]."/0001/libs/Controller.php";
require $_SERVER["DOCUMENT_ROOT"]."/0001/libs/View.php";
require $_SERVER["DOCUMENT_ROOT"]."/0001/libs/Model.php";
require $_SERVER["DOCUMENT_ROOT"]."/0001/models/Sirket.php";
require $_SERVER["DOCUMENT_ROOT"]."/fpdf.php";
// require $_SERVER["DOCUMENT_ROOT"]."/models/Masalar.php";
// require $_SERVER["DOCUMENT_ROOT"]."/models/Adisyonlar.php";
// require $_SERVER["DOCUMENT_ROOT"]."/models/Menuler.php";
//

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->WriteHtml("<strong>Deneme</strong> yazisi ");
$pdf->Output();


// $filename='backup_'.date('Y-m-d').'.sql';
//
// $cmd = "mysql -u root -pbroozkan58. barista_pos_brosoft < ".$_SERVER["DOCUMENT_ROOT"]."/0001/documents/backups/".$filename."";
// exec($cmd);
//
// $result=exec('mysqldump barista_pos_brosoft --password=broozkahfdhdfn58. --user=root --single-transaction > /var/www/html/0001/documents/backups/deneme.sql');
//
// $dosya = $_SERVER["DOCUMENT_ROOT"]."/0001/documents/backups/deneme.sql";
// $dosyaBoyutu = filesize($dosya);
//
// echo "Dosya boyutu". $dosyaBoyutu;
// echo "<br>";
// if ($dosyaBoyutu > 10) {
//   echo "Dosya başarılı olarak oluşturuldu";
// }else {
//   echo "Dosya oluşturuldu fakat içi boş";
//   unlink($dosya);
//   echo "<br>";
//   echo "Dosya içi boş olduğu için silindi";
// }

//
// $guncellenecekVersiyonSurumu = "0002";
//
// $izin = false;
//
// // FTP server details
// $ftpHost   = 'ftp.brosoft.com.tr';
// $ftpUsername = 'barista_pos@brosoft.com.tr';
// $ftpPassword = 'sfrSFR135';
//
// // open an FTP connection
// $connId = ftp_connect($ftpHost) or die("Couldn't connect to $ftpHost");
//
// // login to FTP server
// $ftpLogin = ftp_login($connId, $ftpUsername, $ftpPassword);
//
// // local & server file path
// $localFilePath  = $_SERVER["DOCUMENT_ROOT"].'/'.$guncellenecekVersiyonSurumu.'.zip';
// $remoteFilePath = $guncellenecekVersiyonSurumu.'.zip';
//
// // try to download a file from server
// if(ftp_get($connId, $localFilePath, $remoteFilePath, FTP_BINARY)){
//   $izin = true;
//   echo "Dosya indirildi";
// }else{
//   $izin = false;
//   $yanit = "Güncelleme dosyası indirilirken bir sorun oluştu!";
// }
// ftp_close($connId);
// // close the connection
//
// $zip = new ZipArchive;
// if ($zip->open($_SERVER["DOCUMENT_ROOT"].'/'.$guncellenecekVersiyonSurumu.'.zip') === TRUE) {
//   $zip->extractTo($_SERVER["DOCUMENT_ROOT"]);
//   $zip->close();
//   echo 'ok';
// } else {
//   echo 'failed';
// }
//
//
/*
$dir    = $_SERVER["DOCUMENT_ROOT"].'/'.$guncellenecekVersiyonSurumu.'/';
$files1 = scandir($dir);
for ($i=0; $i < count($files1); $i++) {
  echo "<br>";
  $ext = pathinfo($files1[$i], PATHINFO_EXTENSION);

  if ($ext == "sql") {
    $sqlScript = file($_SERVER["DOCUMENT_ROOT"]."/".$guncellenecekVersiyonSurumu."/".$files1[$i]);

    foreach ($sqlScript as $line)	{
      $query= '';


      $startWith = substr(trim($line), 0 ,2);
      $endWith = substr(trim($line), -1 ,1);

      if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
        continue;
      }
      $query = $query . $line;
      if ($endWith == ';') {
        try {
          $model = new Model();
          $stmt = $model->dbh->prepare($query);
          $yanit = $stmt->execute();
          echo $query."--->".$yanit;
          var_dump($yanit);
          echo "<br>";
          $query= '';

        } catch (\Exception $e) {

          echo "Error:  " . $e;

        }



      }
    }



  }
}*/
