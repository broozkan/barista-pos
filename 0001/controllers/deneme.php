<?php
  /**
   *
   */
  class Deneme extends Controller
  {

    function __construct()
    {
      parent::__construct();
      if (strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
        //DO NOTHING
      }else {
        $this->view->render("login");
      }
      
    }

  }

?>
