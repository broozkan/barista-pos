<div class="modal fade" id="modalDovizCevirici" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <form id="frmModalDovizCevirici" method="post" action="">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title" id="largeModalLabel">Döviz Çevirici</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-6">
              <label for="">Giriş Miktarı</label>
              <div class="input-group demoMaskedInput">
                <span class="input-group-addon"><i class="zmdi zmdi-bookmark"></i></span>
                <input type="number" step=".01" id="txtGirisMiktari" autocomplete="off" name="txtGirisMiktari" class="form-control" required value="0.00">
              </div>
            </div>
            <div class="col-lg-6">
              <label for="">Giriş Kuru</label>
              <div class="input-group demoMaskedInput">
                <select class="form-control show-tick ms select2" name="txtGirisKuru" id="txtGirisKuru">
                  <option value="TRY" selected>TRY</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <th></th>
                    <th></th>
                    <th>ALIŞ</th>
                    <th>SATIŞ</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>USD</td>
                      <td>Amerikan Doları</td>
                      <td><input type="number" step=".01" class="form-control" id="txtDolarKarsilikAlis" value="0.00"> </td>
                      <td><input type="number" step=".01" class="form-control" id="txtDolarKarsilikSatis" value="0.00"> </td>
                    </tr>
                    <tr>
                      <td>EUR</td>
                      <td>Euro</td>
                      <td><input type="number" step=".01" class="form-control" id="txtEuroKarsilikAlis" value="0.00"> </td>
                      <td><input type="number" step=".01" class="form-control" id="txtEuroKarsilikSatis" value="0.00"> </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger waves-effect btnLoadingKur" data-dismiss="modal">İPTAL</button>
        </div>
      </div>
    </form>
  </div>
</div>
