<?php
/**
 *
 */
class View extends Controller
{
  public $izin = true;

  function __construct()
  {

  }

  public function render($name)
  {
    if ($this->izin != false) {
      require 'views/'.$name.'/index.php';
    }
  }
}
