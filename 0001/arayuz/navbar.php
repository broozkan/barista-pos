<nav class="navbar p-l-5 p-r-5">
  <ul class="nav navbar-nav navbar-left">
    <li>
      <div class="navbar-header">
        <a href="javascript:void(0);" class="bars"></a>
        <a class="navbar-brand ls-toggle-btn" href="javascript:void(0);"><img src="<?php echo $this->yolHtml; ?>assets/images/logo.png" width="30" alt="Barista Pos"><span class="m-l-10">BARISTA POS</span></a>
      </div>
    </li>
    <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="zmdi zmdi-notifications"></i>
      <div class="notify">
        <span class="heartbit"></span>
        <span class="point"><span class="badge badge-warning spanAzalanStoklarBildirim"></span> </span>
      </div>
    </a>
    <ul class="dropdown-menu pullDown">
      <li class="header">Azalan Stoklar</li>
      <li class="body">
        <ul class="menu tasks list-unstyled ulAzalanStoklar">

        </ul>
      </li>
    </ul>
  </li>
  <li class="dropdown">
    <a href="javascript:void(0);" data-toggle="modal" class="btnModalDovizCevirici" data-target="#modalDovizCevirici"><i class="zmdi zmdi-money"></i>
  </a>
</li>

  <li class="hidden-sm-down masaAra d-none">
    <div class="input-group">
      <input type="text" class="form-control" id="txtMasaAra" placeholder="Masa adı giriniz...">
      <span class="input-group-addon">
        <i class="zmdi zmdi-search"></i>
      </span>
    </div>
  </li>
  <li class="float-right">
    <a href="" class=" btnLock js-right-sidebar mr-3"><i class="zmdi zmdi-lock"></i></a>
    <a href="<?php echo $this->yolHtml; ?>login/" class="mega-menu" data-close="true"><i class="zmdi zmdi-power"></i></a>
  </li>
</ul>
</nav>
