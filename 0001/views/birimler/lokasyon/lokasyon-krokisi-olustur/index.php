<!doctype html>
<html class="no-js " lang="tr">

<?php require $this->yolPhp."arayuz/head.php"; ?>


<body class="theme-blue">
  <!-- Page Loader -->
  <?php require $this->yolPhp."arayuz/loader.php"; ?>


  <!-- Overlay For Sidebars -->
  <div class="overlay"></div>

  <!-- Top Bar -->
  <?php require $this->yolPhp."arayuz/navbar.php"; ?>


  <!-- Left Sidebar -->
  <?php require $this->yolPhp."arayuz/aside.php"; ?>

  <!-- Chat-launcher -->
  <?php require $this->yolPhp."arayuz/chat.php"; ?>


  <section class="content">
    <div class="block-header">
      <div class="row">
        <div class="col-lg-7 col-md-6 col-sm-12">
          <h2 id="pageName" >Lokasyon Krokisi Oluştur</h2>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
          <ul class="breadcrumb float-md-right">
            <li class="breadcrumb-item"><a href="<?php echo $this->yolHtml; ?>"><i class="zmdi zmdi-home"></i> Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Lokasyonlar</a></li>
            <li class="breadcrumb-item active">Lokasyon Krokisi Oluştur</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <!-- Vertical Layout -->
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
            <div class="header">
              <h2><strong>Lokasyon</strong> Krokisi</h2>
            </div>
            <div class="body">
              <div id="wPaint" style="position:relative; width:100%; height:60vh; background-color:#7a7a7a; margin:70px auto 20px auto;"></div>

            </div>
          </div>
        </div>
      </div>
      <!-- #END# Vertical Layout -->
    </div>
  </section>
  <?php require $this->yolPhp."arayuz/lock.php"; ?>

  <!-- Jquery Core Js -->
  <?php require $this->yolPhp."arayuz/script.php"; ?>
  <script src="<?php echo $this->yolHtml ?>views/birimler/lokasyon/lokasyon-krokisi-olustur/lokasyon-krokisi-olustur.js"></script>
  <script type="text/javascript" src="<?php echo $this->yolHtml; ?>assets/js/draw/lib/jquery.ui.core.1.10.3.min.js"></script>
  <script type="text/javascript" src="<?php echo $this->yolHtml; ?>assets/js/draw/lib/jquery.ui.widget.1.10.3.min.js"></script>
  <script type="text/javascript" src="<?php echo $this->yolHtml; ?>assets/js/draw/lib/jquery.ui.mouse.1.10.3.min.js"></script>
  <script type="text/javascript" src="<?php echo $this->yolHtml; ?>assets/js/draw/lib/jquery.ui.draggable.1.10.3.min.js"></script>

  <!-- wColorPicker -->
  <link rel="Stylesheet" type="text/css" href="<?php echo $this->yolHtml; ?>assets/js/draw/lib/wColorPicker.min.css" />
  <script type="text/javascript" src="<?php echo $this->yolHtml; ?>assets/js/draw/lib/wColorPicker.min.js"></script>

  <!-- wPaint -->
  <link rel="Stylesheet" type="text/css" href="<?php echo $this->yolHtml; ?>assets/js/draw/wPaint.min.css" />
  <script type="text/javascript" src="<?php echo $this->yolHtml; ?>assets/js/draw/wPaint.min.js"></script>
  <script type="text/javascript" src="<?php echo $this->yolHtml; ?>assets/js/draw/plugins/main/wPaint.menu.main.min.js"></script>
  <script type="text/javascript" src="<?php echo $this->yolHtml; ?>assets/js/draw/plugins/text/wPaint.menu.text.min.js"></script>
  <script type="text/javascript" src="<?php echo $this->yolHtml; ?>assets/js/draw/plugins/shapes/wPaint.menu.main.shapes.min.js"></script>
  <script type="text/javascript" src="<?php echo $this->yolHtml; ?>assets/js/draw/plugins/file/wPaint.menu.main.file.min.js"></script>

  <script type="text/javascript">
        var images = [
          '/test/uploads/wPaint.png',
        ];

        function saveImg(image) {
          var _this = this;
          var a = $("<a>")
              .attr("href", image)
              .attr("download", "img.png")
              .appendTo("body");

          a[0].click();

          a.remove();
          // $.ajax({
          //   type: 'POST',
          //   url: '/test/upload.php',
          //   data: {image: image},
          //   success: function (resp) {
          //
          //     // internal function for displaying status messages in the canvas
          //     _this._displayStatus('Image saved successfully');
          //
          //     // doesn't have to be json, can be anything
          //     // returned from server after upload as long
          //     // as it contains the path to the image url
          //     // or a base64 encoded png, either will work
          //     resp = $.parseJSON(resp);
          //
          //     // update images array / object or whatever
          //     // is being used to keep track of the images
          //     // can store path or base64 here (but path is better since it's much smaller)
          //     images.push(resp.img);
          //
          //     // do something with the image
          //     $('#wPaint-img').attr('src', image);
          //   }
          // });
        }

        function loadImgBg () {

          // internal function for displaying background images modal
          // where images is an array of images (base64 or url path)
          // NOTE: that if you can't see the bg image changing it's probably
          // becasue the foregroud image is not transparent.
          this._showFileModal('bg', images);
        }

        function loadImgFg () {

          // internal function for displaying foreground images modal
          // where images is an array of images (base64 or url path)
          this._showFileModal('fg', images);
        }

        // init wPaint
        $('#wPaint').wPaint({
          menuOffsetLeft: -35,
          menuOffsetTop: -50,
          saveImg: saveImg,
          loadImgBg: loadImgBg,
          loadImgFg: loadImgFg
        });
      </script>
</body>

</html>
