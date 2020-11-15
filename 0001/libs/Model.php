<?php
  /**
   *
   */
  class Model extends Controller
  {
    public $address;
    public $dbname;
    public $username;
    public $password;
    public $rootDir;
    public $version;
    public $dbh;

    function __construct($kurulumSorgu = false)
    {
      parent::__construct();
      if ($kurulumSorgu == false) {
        try {
          $programBilgileri = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/Kurulum.json");
          $programBilgileri = json_decode($programBilgileri,true);
          $this->address = $programBilgileri["txtVeritabaniYolu"];
          $this->dbname = $programBilgileri["txtVeritabaniAdi"];
          $this->username = $programBilgileri["txtVeritabaniKullaniciAdi"];
          $this->password = $programBilgileri["txtVeritabaniParola"];
          $this->rootDir = $programBilgileri["txtKokDizin"];
          $this->dbh = new PDO('mysql:host='.$this->address.';dbname='.$this->dbname.';charset=utf8', $this->username, $this->password);
        } catch (PDOException $e) {
          echo "Hata! :".$e->getMessage()."";
          die();
        }
      }else {
        try {
          $programBilgileri = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/Kurulum.json");
          $programBilgileri = json_decode($programBilgileri,true);
          $this->address = $programBilgileri["txtVeritabaniYolu"];
          $this->dbname = $programBilgileri["txtVeritabaniAdi"];
          $this->username = $programBilgileri["txtVeritabaniKullaniciAdi"];
          $this->password = $programBilgileri["txtVeritabaniParola"];
          $this->rootDir = $programBilgileri["txtKokDizin"];
          $this->dbh = new PDO('mysql:host='.$this->address.';dbname='.$this->dbname.';charset=utf8', $this->username, $this->password);
          header("Location:".$this->yolHtml."yonetim");
        } catch (PDOException $e) {
          if ($e->getCode() == 1049 || $e->getCode() == 1045) {
            $this->view->render("kurulum");
            die();
          }else {
            echo "Hata! :".$e->getMessage()."";
          }
          die();
        }
      }

    }

    public function insertQuery($tablo,$kolonArray,$veriArray)
    {
      for ($i=0; $i < count($kolonArray); $i++) {
        $kolonArray[$i] = $kolonArray[$i]."=?";
      }
      $kolonArray = implode(",",$kolonArray);



      $query = $this->dbh->prepare("INSERT INTO ".$tablo." SET ".$kolonArray."");
      $insert = $query->execute($veriArray);
      if ( $insert ){
        $last_id = $this->dbh->lastInsertId();
        return array(
          "yanit"=>true,
          "lastId"=>$last_id
        );
      }else {
        // print_r($this->dbh->errorInfo());
      }
    }
    public function selectQuery($tablo,$kolonArray)
    {
      for ($i=0; $i < count($kolonArray); $i++) {
        $kolonArray[$i] = $kolonArray[$i];
      }
      $kolonArray = implode(",",$kolonArray);
      $query = $this->dbh->query("SELECT $kolonArray FROM $tablo", PDO::FETCH_ASSOC);
      if ( $query ){
           $result = $query->fetchAll();
           return $result;
      }else {
        return "Kayıt Bulunamadı";
      }
    }
    public function selectFilterQuery($tablo,$kolonArray,$veriKolonArray)
    {
      $veriKolonAdi = key($veriKolonArray);
      $veriKolonDegeri = current($veriKolonArray);

      for ($i=0; $i < count($kolonArray); $i++) {
        $kolonArray[$i] = $kolonArray[$i];
      }

      $kolonArray = implode(",",$kolonArray);
      $veriKolonArray = implode(",",$veriKolonArray);
      $stmt = $this->dbh->prepare("SELECT $kolonArray FROM $tablo WHERE $veriKolonAdi=:$veriKolonAdi");
      $stmt->execute([$veriKolonAdi => $veriKolonDegeri]);
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      if ($result) {
        return $result;
      }
    }

    public function selectLimitQuery($tablo,$kolonArray,$veriKolonArray,$keys = false,$parameters = false)
    {

      $conditions = array();
      if ($keys)
      {
        for ($i=0; $i < count($keys); $i++) {
          $conditions[] = $keys[$i]."=:".$keys[$i];
        }
      }


      $limitDegeri = $veriKolonArray["limit"];
      $offsetDegeri = $veriKolonArray["offset"];


      for ($i=0; $i < count($kolonArray); $i++) {
        $kolonArray[$i] = $kolonArray[$i];
      }
      $kolonArray = implode(",",$kolonArray);

      if ($conditions)
      {
        $sorgu = "WHERE ".implode(" AND ", $conditions);
      }else {
        $sorgu = "";
      }


      $sql = "SELECT $kolonArray FROM $tablo $sorgu LIMIT :limit OFFSET :offset";

      $stmt = $this->dbh->prepare($sql);
      $stmt->bindParam("limit",$limitDegeri, PDO::PARAM_INT);
      $stmt->bindParam("offset",$offsetDegeri, PDO::PARAM_INT);
      if ($sorgu) {
        for ($i=0; $i < count($keys); $i++) {
          $stmt->bindParam($keys[$i],$parameters[$i], PDO::PARAM_INT);
        }
      }
      $stmt->execute();
      $result = $stmt->fetchAll();
      if ($result) {
        return $result;
      }

    }
    public function selectLikeQuery($tablo,$kolonArray,$veriKolonArray)
    {
      $veriKolonAdi = key($veriKolonArray);
      $veriKolonDegeri = current($veriKolonArray);


      for ($i=0; $i < count($kolonArray); $i++) {
        $kolonArray[$i] = $kolonArray[$i];
      }
      $kolonArray = implode(",",$kolonArray);
      $veriKolonArray = implode(",",$veriKolonArray);
      $stmt = $this->dbh->prepare("SELECT DISTINCT $kolonArray FROM $tablo WHERE $veriKolonAdi LIKE :$veriKolonAdi");
      $stmt->execute([$veriKolonAdi => "%".$veriKolonDegeri."%"]);
      $result = $stmt->fetchAll();
      if ($result) {
        return $result;
      }

    }
    public function updateQuery($tablo,$veriKolonArray)
    {

      $veriArray = array();
      for ($i=0; $i <count($veriKolonArray) ; $i++) {
        array_push($veriArray,array_keys($veriKolonArray)[$i]);
      }
      for ($i=0; $i < count($veriKolonArray); $i++) {
        $sqlString[] = $veriArray[$i]."=:".$veriArray[$i];
      }

      $setString = implode(",",$sqlString);
      $whereString = $sqlString[count($sqlString)-1];
      $query = $this->dbh->prepare("UPDATE $tablo SET $setString WHERE $whereString");
      $result = $query->execute($veriKolonArray);
      if ( $result == 1 ){
        return true;
      }else {
        return "Güncelleme yapılamadı";
      }
    }

    public function deleteQuery($tablo,$veriKolonArray)
    {
      $veriArray = array();
      for ($i=0; $i <count($veriKolonArray) ; $i++) {
        array_push($veriArray,array_keys($veriKolonArray)[$i]);
      }
      for ($i=0; $i < count($veriKolonArray); $i++) {
        $sqlString[] = $veriArray[$i]."=:".$veriArray[$i];
      }
      $whereString = implode(",",$sqlString);
      $query = $this->dbh->prepare("DELETE FROM $tablo WHERE $whereString");
      $delete = $query->execute($veriKolonArray);
      if ( $delete == 1 ) {
        return true;
      }else {
        return "Silme işlemi gerçekleştirilemedi";
      }
    }
  }

?>
