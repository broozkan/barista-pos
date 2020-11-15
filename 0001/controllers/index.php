<?php
/**
 *
 */
class Index extends Controller
{


  function __construct()
  {
    parent::__construct();
    $model = new Model(true);
  }
}
