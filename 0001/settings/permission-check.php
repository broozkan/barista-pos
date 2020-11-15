<?php
  $model = new Model();

  $stmt = $model->dbh->prepare(
    "SELECT tbl_statuler.statu_yetkileri AS statu_yetkileri
    FROM tbl_statuler
    INNER JOIN tbl_calisanlar ON tbl_calisanlar.calisan_statu_idsi=tbl_statuler.id
    WHERE tbl_calisanlar.id=:calisan_idsi"
  );
  $stmt->execute(['calisan_idsi'=>$_SESSION["uid"]]);
  $calisanYetkileri = $stmt->fetch()["statu_yetkileri"];
  $this->permissions = json_decode($calisanYetkileri,true);
  $this->view->permissions = $this->permissions;
  for ($i=0; $i < count($this->permissions); $i++) {
    $permissionName = key($this->permissions[$i]);
    if ($permissionName == $this->sayfaIzınAdi) {

      try {
        if ($this->permissions[$i]["".$permissionName.""] == "1") {
          if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
            // İZİN VAR
          }else {
            // İZİN VAR
          }
        }else {
          if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {

            throw new Exception("Bu işlem için yetkiniz yoktur!",0);

          }else {
            throw new Exception("Bu işlem için yetkiniz yoktur!",1);
          }
        }
      } catch (\Exception $e) {
        switch ($e->getCode()) {
          case '0':
          $this->view->izin = false;
          $_POST = array();
            break;
          case '1':
          header("location:javascript://history.go(-1)");


            break;

          default:
            // code...
            break;
        }
        echo json_encode(array(
          "yanit"=>$e->getMessage()
        ));

      }

    }
  }
  $model = null;

?>
