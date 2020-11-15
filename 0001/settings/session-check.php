<?php
if ($_SESSION["login"] == false) {
  header("Location: ".$this->view->yolHtml."login/");
  die();
}
?>
