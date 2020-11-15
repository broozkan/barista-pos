<div class="modal fade" data-keyboard="false" data-backdrop="static" id="modalLock" tabindex="-1" role="dialog" style="filter: blur(0px);">
  <div class="modal-dialog" role="document">
    <form id="frmLock" method="post" action="">
      <div class="modal-content">
        <div class="modal-header">
          <!-- <h4 class="title" id="largeModalLabel">KİLİTLİ</h4> -->
        </div>
        <div class="modal-body">
          <div class="content numpad">
            <div class="header text-center">
              <div class="logo-container">
                <!-- <img src="<?php echo $this->yolHtml; ?>assets/images/logo.png" alt=""> -->
              </div>
              <span class="zmdi zmdi-lock zmdi-hc-5x"></span>
              <div class="flexContainer">
                <input type="password" class="form-control show-tick ms txtPin" autofocus maxlength="4" size="4" required placeholder="****" name="txtPin" value="">
                <!-- <button type="button" class="btn bg-red btnDelete m-0" name="button"><span class="zmdi zmdi-close"></span> </button> -->
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4 col-sm-4 divNumpad">
                <button type="button" class="btn btn-default btnTusTakimiLock" name="button">1</button>
              </div>
              <div class="col-lg-4 col-sm-4 divNumpad">
                <button type="button" class="btn btn-default btnTusTakimiLock" name="button">2</button>
              </div>
              <div class="col-lg-4 col-sm-4 divNumpad">
                <button type="button" class="btn btn-default btnTusTakimiLock" name="button">3</button>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4 col-sm-4 divNumpad">
                <button type="button" class="btn btn-default btnTusTakimiLock" name="button">4</button>
              </div>
              <div class="col-lg-4 col-sm-4 divNumpad">
                <button type="button" class="btn btn-default btnTusTakimiLock" name="button">5</button>
              </div>
              <div class="col-lg-4 col-sm-4 divNumpad">
                <button type="button" class="btn btn-default btnTusTakimiLock" name="button">6</button>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4 col-sm-4 divNumpad">
                <button type="button" class="btn btn-default btnTusTakimiLock" name="button">7</button>
              </div>
              <div class="col-lg-4 col-sm-4 divNumpad">
                <button type="button" class="btn btn-default btnTusTakimiLock" name="button">8</button>
              </div>
              <div class="col-lg-4 col-sm-4 divNumpad">
                <button type="button" class="btn btn-default btnTusTakimiLock" name="button">9</button>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4 col-sm-4 divNumpad">
                <button type="button" class="btn btn-warning btnDelete" name="button"><span class="zmdi zmdi-arrow-left"></span> </button>

              </div>
              <div class="col-lg-4 col-sm-4 divNumpad">
                <button type="button" class="btn btn-default btnTusTakimiLock" name="button">0</button>
              </div>
              <div class="col-lg-4 col-sm-4 divNumpad">
                <button type="submit" class="btn g-bg-soundcloud" name="button"><span class="zmdi zmdi-check"></span> </button>

              </div>
            </div>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>


<!--
<div class="modal fade" id="modalLock" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form class="form" id="frmLock" method="post" action="">
      <div class="header">
        <div class="logo-container">
        </div>
        <span class="zmdi zmdi-lock zmdi-hc-5x"></span>
        <div class="flexContainer">
          <input type="password" class="form-control show-tick ms txtPin" autofocus maxlength="4" size="4" required placeholder="****" name="txtPin" value="">
          <button type="button" class="btn bg-red btnDelete m-0" name="button"><span class="zmdi zmdi-close"></span> </button>
        </div>
      </div>

      <div class="footer text-center">
        <button type="submit" class="btn g-bg-soundcloud btn-round btn-lg btn-block btnLoading">GİRİŞ YAP</button>
        <h5><a href="forgot-password.html" class="link">Parolanızı mı unuttunuz?</a></h5>
      </div>
    </form>
  </div>
</div> -->
