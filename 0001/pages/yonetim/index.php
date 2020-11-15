<?php require $_SERVER["DOCUMENT_ROOT"].'/settings/config.php'; ?>
<?php require $GLOBALS["yolPhp"]."settings/install-check.php"; ?>
<?php require $GLOBALS["yolPhp"]."settings/session-check.php"; ?>
<!doctype html>
<html class="no-js " lang="tr">

<?php require $GLOBALS["yolPhp"]. 'arayuz/head.php'; ?>
<body class="theme-blue">
  <!-- Page Loader -->
  <?php require $GLOBALS["yolPhp"]. 'arayuz/loader.php'; ?>

  <!-- Overlay For Sidebars -->
  <div class="overlay"></div>

  <!-- Top Bar -->
  <?php require $GLOBALS["yolPhp"]. 'arayuz/navbar.php'; ?>


<!-- Left Sidebar -->
<?php require $GLOBALS["yolPhp"]. 'arayuz/aside.php'; ?>



<!-- Chat-launcher -->
<div class="chat-launcher"></div>
<div class="chat-wrapper">
  <div class="card">
    <div class="header">
      <ul class="list-unstyled team-info margin-0">
        <li class="m-r-15"><h2>Design Team</h2></li>
        <li>
          <img src="<?php echo $this->yolHtml ?>assets/images/xs/avatar2.jpg" alt="Avatar">
        </li>
        <li>
          <img src="<?php echo $this->yolHtml ?>assets/images/xs/avatar3.jpg" alt="Avatar">
        </li>
        <li>
          <img src="<?php echo $this->yolHtml ?>assets/images/xs/avatar4.jpg" alt="Avatar">
        </li>
        <li>
          <img src="<?php echo $this->yolHtml ?>assets/images/xs/avatar6.jpg" alt="Avatar">
        </li>
        <li>
          <a href="javascript:void(0);" title="Add Member"><i class="zmdi zmdi-plus-circle"></i></a>
        </li>
      </ul>
    </div>
    <div class="body">
      <div class="chat-widget">
        <ul class="chat-scroll-list clearfix">
          <li class="left float-left">
            <img src="<?php echo $this->yolHtml ?>assets/images/xs/avatar3.jpg" class="rounded-circle" alt="">
            <div class="chat-info">
              <a class="name" href="javascript:void(0);">Alexander</a>
              <span class="datetime">6:12</span>
              <span class="message">Hello, John </span>
            </div>
          </li>
          <li class="right">
            <div class="chat-info"><span class="datetime">6:15</span> <span class="message">Hi, Alexander<br> How are you!</span> </div>
          </li>
          <li class="right">
            <div class="chat-info"><span class="datetime">6:16</span> <span class="message">There are many variations of passages of Lorem Ipsum available</span> </div>
          </li>
          <li class="left float-left"> <img src="<?php echo $this->yolHtml ?>assets/images/xs/avatar2.jpg" class="rounded-circle" alt="">
            <div class="chat-info"> <a class="name" href="javascript:void(0);">Elizabeth</a> <span class="datetime">6:25</span> <span class="message">Hi, Alexander,<br> John <br> What are you doing?</span> </div>
          </li>
          <li class="left float-left"> <img src="<?php echo $this->yolHtml ?>assets/images/xs/avatar1.jpg" class="rounded-circle" alt="">
            <div class="chat-info"> <a class="name" href="javascript:void(0);">Michael</a> <span class="datetime">6:28</span> <span class="message">I would love to join the team.</span> </div>
          </li>
          <li class="right">
            <div class="chat-info"><span class="datetime">7:02</span> <span class="message">Hello, <br>Michael</span> </div>
          </li>
        </ul>
      </div>
      <div class="input-group p-t-15">
        <input type="text" class="form-control" placeholder="Enter text here...">
        <span class="input-group-addon">
          <i class="zmdi zmdi-mail-send"></i>
        </span>
      </div>
    </div>
  </div>
</div>

<!-- Main Content -->
<section class="content home">
  <div class="block-header">
    <div class="row">
      <div class="col-lg-5 col-md-5 col-sm-12">
        <h2>Dashboard
          <small>Welcome to Oreo</small>
        </h2>
      </div>
      <div class="col-lg-7 col-md-7 col-sm-12 text-right">
        <div class="inlineblock text-center m-r-15 m-l-15 hidden-md-down">
          <div class="sparkline" data-type="bar" data-width="97%" data-height="25px" data-bar-Width="2" data-bar-Spacing="5" data-bar-Color="#fff">3,2,6,5,9,8,7,9,5,1,3,5,7,4,6</div>
          <small class="col-white">Visitors</small>
        </div>
        <div class="inlineblock text-center m-r-15 m-l-15 hidden-md-down">
          <div class="sparkline" data-type="bar" data-width="97%" data-height="25px" data-bar-Width="2" data-bar-Spacing="5" data-bar-Color="#fff">1,3,5,7,4,6,3,2,6,5,9,8,7,9,5</div>
          <small class="col-white">Bounce Rate</small>
        </div>
        <button class="btn btn-white btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
          <i class="zmdi zmdi-plus"></i>
        </button>
        <ul class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index-2.html"><i class="zmdi zmdi-home"></i> Oreo</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ul>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row clearfix">
      <div class="col-sm-12">
        <div class="card">
          <div class="body">
            <div class="row clearfix">
              <div class="col-lg-4 col-md-4 col-sm-12 text-center">
                <div class="body">
                  <h2 class="number count-to m-t-0 m-b-5" data-from="0" data-to="501" data-speed="1000" data-fresh-interval="700">501</h2>
                  <p class="text-muted">Orders Received</p>
                  <span id="linecustom1">1,4,2,6,5,2,3,8,5,2</span>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12 text-center">
                <div class="body">
                  <h2 class="number count-to m-t-0 m-b-5" data-from="0" data-to="2501" data-speed="2000" data-fresh-interval="700">2501</h2>
                  <p class="text-muted ">Total Sales</p>
                  <span id="linecustom2">2,9,5,5,8,5,4,2,6</span>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12 text-center">
                <div class="body">
                  <h2 class="number count-to m-t-0 m-b-5" data-from="0" data-to="6051" data-speed="2000" data-fresh-interval="700">6051</h2>
                  <p class="text-muted">Total Profit</p>
                  <span id="linecustom3">1,5,3,6,6,3,6,8,4,2</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row clearfix">
      <div class="col-lg-12">
        <div class="card">
          <div class="header">
            <h2><strong>Sales</strong> Report</h2>
            <ul class="header-dropdown">
              <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                <ul class="dropdown-menu slideUp float-right">
                  <li><a href="javascript:void(0);">Edit</a></li>
                  <li><a href="javascript:void(0);">Delete</a></li>
                  <li><a href="javascript:void(0);">Report</a></li>
                </ul>
              </li>
              <li class="remove">
                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
              </li>
            </ul>
          </div>
          <div class="body">
            <div class="row text-center">
              <div class="col-sm-3 col-6">
                <h4 class="margin-0">$ 106 <i class="zmdi zmdi-trending-up col-green"></i></h4>
                <p class="text-muted"> Today's Sales</p>
              </div>
              <div class="col-sm-3 col-6">
                <h4 class="margin-0">$ 907 <i class="zmdi zmdi-trending-down col-red"></i></h4>
                <p class="text-muted">This Week's Sales</p>
              </div>
              <div class="col-sm-3 col-6">
                <h4 class="margin-0">$ 4210 <i class="zmdi zmdi-trending-up col-green"></i></h4>
                <p class="text-muted">This Month's Sales</p>
              </div>
              <div class="col-sm-3 col-6">
                <h4 class="margin-0">$ 67,000 <i class="zmdi zmdi-trending-up col-green"></i></h4>
                <p class="text-muted">This Year's Sales</p>
              </div>
            </div>
            <div id="area_chart" class="graph"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="row clearfix">
      <div class="col-lg-8 col-md-12">
        <div class="row clearfix">
          <div class="col-lg-12">
            <div class="card">
              <ul class="row profile_state list-unstyled">
                <li class="col-lg-3 col-md-3 col-6">
                  <div class="body">
                    <i class="zmdi zmdi-eye col-amber"></i>
                    <h4>15,453</h4>
                    <span>Post View</span>
                  </div>
                </li>
                <li class="col-lg-3 col-md-3 col-6">
                  <div class="body">
                    <i class="zmdi zmdi-thumb-up col-blue"></i>
                    <h4>921</h4>
                    <span>Likes</span>
                  </div>
                </li>
                <li class="col-lg-3 col-md-3 col-6">
                  <div class="body">
                    <i class="zmdi zmdi-comment-text col-red"></i>
                    <h4>215</h4>
                    <span>Comments</span>
                  </div>
                </li>
                <li class="col-lg-3 col-md-3 col-6">
                  <div class="body">
                    <i class="zmdi zmdi-account text-success"></i>
                    <h4>22,055</h4>
                    <span>Profile Views</span>
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-7 col-md-6">
            <div class="card tasks_report">
              <div class="header">
                <h2><strong>Total</strong> Revenue</h2>
                <ul class="header-dropdown">
                  <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                    <ul class="dropdown-menu slideUp">
                      <li><a href="javascript:void(0);">2017 Year</a></li>
                      <li><a href="javascript:void(0);">2016 Year</a></li>
                      <li><a href="javascript:void(0);">2015 Year</a></li>
                    </ul>
                  </li>
                  <li class="remove">
                    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                  </li>
                </ul>
              </div>
              <div class="body text-center">
                <h4 class="margin-0">Total Sale</h4>
                <h6 class="m-b-20">2,45,124</h6>
                <input type="text" class="knob dial1" value="66" data-width="100" data-height="100" data-thickness="0.1" data-fgColor="#212121" readonly>
                <h6 class="m-t-20">Satisfaction Rate</h6>
                <small class="displayblock">47% Average <i class="zmdi zmdi-trending-up"></i></small>
                <div class="sparkline m-t-20" data-type="bar" data-width="97%" data-height="35px" data-bar-Width="2" data-bar-Spacing="8" data-bar-Color="#212121">3,2,6,5,9,8,7,8,4,5,1,2,9,5,1,3,5,7,4,6</div>
              </div>
            </div>
          </div>
          <div class="col-lg-5 col-md-6">
            <div class="card top-report">
              <div class="body">
                <h3 class="m-t-0">1,600 <i class="zmdi zmdi-trending-up float-right"></i></h3>
                <p class="text-muted">New Feedbacks</p>
                <div class="progress">
                  <div class="progress-bar l-blush" role="progressbar" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100" style="width: 68%;"></div>
                </div>
                <small>Change 15%</small>
              </div>
            </div>
            <div class="card top-report">
              <div class="body">
                <h3 class="m-t-0 m-b-25">50.5 Gb <i class="zmdi zmdi-trending-up float-right"></i></h3>
                <p class="text-muted">Traffic this month</p>
                <div class="progress">
                  <div class="progress-bar l-turquoise" role="progressbar" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100" style="width: 68%;"></div>
                </div>
                <small>Change 5%</small>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-12">
        <div class="card weather2">
          <div class="city-selected body l-khaki">
            <div class="row">
              <div class="col-12">
                <div class="city"><span>City:</span> New York</div>
                <div class="night">Day - 12:07 PM</div>
              </div>
              <div class="info col-7">
                <div class="temp"><h2>34°</h2></div>
              </div>
              <div class="icon col-5">
                <img src="https://thememakker.com/templates/oreo/html/assets/images/weather/summer.svg" alt="">
              </div>
            </div>
          </div>
          <table class="table table-striped m-b-0">
            <tbody>
              <tr>
                <td>Wind</td>
                <td class="font-medium">ESE 17 mph</td>
              </tr>
              <tr>
                <td>Humidity</td>
                <td class="font-medium">72%</td>
              </tr>
              <tr>
                <td>Pressure</td>
                <td class="font-medium">25.56 in</td>
              </tr>
              <tr>
                <td>Cloud Cover</td>
                <td class="font-medium">80%</td>
              </tr>
              <tr>
                <td>Ceiling</td>
                <td class="font-medium">25280 ft</td>
              </tr>
            </tbody>
          </table>
          <div class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item text-center active">
                <div class="col-12">
                  <ul class="row days-list list-unstyled">
                    <li class="day col-4">
                      <p>Monday</p>
                      <img src="https://thememakker.com/templates/oreo/html/assets/images/weather/rain.svg" alt="">
                    </li>
                    <li class="day col-4">
                      <p>Tuesday</p>
                      <img src="https://thememakker.com/templates/oreo/html/assets/images/weather/cloudy.svg" alt="">
                    </li>
                    <li class="day col-4">
                      <p>Wednesday</p>
                      <img src="https://thememakker.com/templates/oreo/html/assets/images/weather/wind.svg" alt="">
                    </li>
                  </ul>
                </div>
              </div>
              <div class="carousel-item text-center">
                <div class="col-12">
                  <ul class="row days-list list-unstyled">
                    <li class="day col-4">
                      <p>Thursday</p>
                      <img src="https://thememakker.com/templates/oreo/html/assets/images/weather/sky.svg" alt="">
                    </li>
                    <li class="day col-4">
                      <p>Friday</p>
                      <img src="https://thememakker.com/templates/oreo/html/assets/images/weather/cloudy.svg" alt="">
                    </li>
                    <li class="day col-4">
                      <p>Saturday</p>
                      <img src="https://thememakker.com/templates/oreo/html/assets/images/weather/summer.svg" alt="">
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row clearfix">
      <div class="col-lg-8 col-md-12">
        <div class="card visitors-map">
          <div class="header">
            <h2><strong>Visitors</strong> Statistics</h2>
            <ul class="header-dropdown">
              <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                <ul class="dropdown-menu slideUp">
                  <li><a href="javascript:void(0);">Action</a></li>
                  <li><a href="javascript:void(0);">Another action</a></li>
                  <li><a href="javascript:void(0);">Something else</a></li>
                </ul>
              </li>
              <li class="remove">
                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
              </li>
            </ul>
          </div>
          <div class="body">
            <div id="world-map-markers" style="height: 245px;" class="m-b-10"></div>
            <div class="row">
              <div class="col-lg-6 col-md-12">
                <div class="progress-container">
                  <span class="progress-badge">visitor from america</span>
                  <div class="progress">
                    <div class="progress-bar l-turquoise" role="progressbar" aria-valuenow="86" aria-valuemin="0" aria-valuemax="100" style="width: 86%;">
                      <span class="progress-value">86%</span>
                    </div>
                  </div>
                </div>
                <div class="progress-container m-t-20">
                  <span class="progress-badge">visitor from Canada</span>
                  <div class="progress">
                    <div class="progress-bar l-coral" role="progressbar" aria-valuenow="86" aria-valuemin="0" aria-valuemax="100" style="width: 86%;">
                      <span class="progress-value">86%</span>
                    </div>
                  </div>
                </div>
                <div class="progress-container m-t-20">
                  <span class="progress-badge">visitor from Germany</span>
                  <div class="progress">
                    <div class="progress-bar l-blue" role="progressbar" aria-valuenow="38" aria-valuemin="0" aria-valuemax="100" style="width: 38%;">
                      <span class="progress-value">86%</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-12">
                <div class="progress-container">
                  <span class="progress-badge">visitor from UK</span>
                  <div class="progress">
                    <div class="progress-bar l-salmon" role="progressbar" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100" style="width: 48%;">
                      <span class="progress-value">86%</span>
                    </div>
                  </div>
                </div>
                <div class="progress-container m-t-20">
                  <span class="progress-badge">visitor from India</span>
                  <div class="progress">
                    <div class="progress-bar l-parpl" role="progressbar" aria-valuenow="86" aria-valuemin="0" aria-valuemax="100" style="width: 86%;">
                      <span class="progress-value">86%</span>
                    </div>
                  </div>
                </div>
                <div class="progress-container m-t-20">
                  <span class="progress-badge">visitor from Australia</span>
                  <div class="progress">
                    <div class="progress-bar l-amber" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: 55%;">
                      <span class="progress-value">86%</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row clearfix social-widget">
          <div class="col-lg-4 col-md-4">
            <div class="card info-box-2 hover-zoom-effect instagram-widget">
              <div class="icon"><i class="zmdi zmdi-instagram"></i></div>
              <div class="content">
                <div class="text">Followers</div>
                <div class="number">231</div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4">
            <div class="card info-box-2 hover-zoom-effect linkedin-widget">
              <div class="icon"><i class="zmdi zmdi-linkedin"></i></div>
              <div class="content">
                <div class="text">Followers</div>
                <div class="number">2510</div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4">
            <div class="card info-box-2 hover-zoom-effect behance-widget">
              <div class="icon"><i class="zmdi zmdi-behance"></i></div>
              <div class="content">
                <div class="text">Project</div>
                <div class="number">121</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-12">
        <div class="card">
          <div class="header">
            <h2><strong>Browser</strong> Usage</h2>
            <ul class="header-dropdown">
              <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                <ul class="dropdown-menu">
                  <li><a href="javascript:void(0);">Action</a></li>
                  <li><a href="javascript:void(0);">Another action</a></li>
                  <li><a href="javascript:void(0);">Something else</a></li>
                </ul>
              </li>
              <li class="remove">
                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
              </li>
            </ul>
          </div>
          <div class="body">
            <div id="donut_chart" class="dashboard-donut-chart"></div>
            <table class="table m-t-25 m-b-0">
              <tbody>
                <tr>
                  <td>Chrome</td>
                  <td>6985</td>
                  <td><i class="zmdi zmdi-caret-up text-success"></i></td>
                </tr>
                <tr>
                  <td>Other</td>
                  <td>2697</td>
                  <td><i class="zmdi zmdi-caret-up text-success"></i></td>
                </tr>
                <tr>
                  <td>Safari</td>
                  <td>3597</td>
                  <td><i class="zmdi zmdi-caret-down text-danger"></i></td>
                </tr>
                <tr>
                  <td>Firefox</td>
                  <td>2145</td>
                  <td><i class="zmdi zmdi-caret-up text-success"></i></td>
                </tr>
                <tr>
                  <td>Opera</td>
                  <td>1854</td>
                  <td><i class="zmdi zmdi-caret-down text-danger"></i></td>
                </tr>
                <tr>
                  <td>IE</td>
                  <td>154</td>
                  <td><i class="zmdi zmdi-caret-down text-danger"></i></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row clearfix">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="header">
            <h2><strong>Members</strong> Profiles <small>Members Preformance / Monthly Status</small> </h2>
            <ul class="header-dropdown">
              <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                <ul class="dropdown-menu slideUp">
                  <li><a href="javascript:void(0);">Action</a></li>
                  <li><a href="javascript:void(0);">Another action</a></li>
                  <li><a href="javascript:void(0);">Something else</a></li>
                </ul>
              </li>
              <li class="remove">
                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
              </li>
            </ul>
          </div>
          <div class="body table-responsive members_profiles">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th style="width:60px;">Member</th>
                  <th>Name</th>
                  <th>Earnings</th>
                  <th>Sales</th>
                  <th>Reviews</th>
                  <th>Progress</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <img class="rounded-circle" src="<?php echo $this->yolHtml ?>assets/images/xs/avatar1.jpg" alt="user" width="40"> </td>
                    <td>
                      <a href="javascript:void(0);">Logan</a>
                    </td>
                    <td>$420</td>
                    <td>23</td>
                    <td>
                      <i class="zmdi zmdi-star"></i>
                      <i class="zmdi zmdi-star"></i>
                      <i class="zmdi zmdi-star"></i>
                      <i class="zmdi zmdi-star"></i>
                      <i class="zmdi zmdi-star-outline"></i>
                    </td>
                    <td>
                      <div class="progress">
                        <div class="progress-bar l-green" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width: 87%;"></div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <img class="rounded-circle" src="<?php echo $this->yolHtml ?>assets/images/xs/avatar2.jpg" alt="user" width="40"> </td>
                      <td>
                        <a href="javascript:void(0);">Isabella</a>
                      </td>
                      <td>$350</td>
                      <td>16</td>
                      <td>
                        <i class="zmdi zmdi-star"></i>
                        <i class="zmdi zmdi-star"></i>
                        <i class="zmdi zmdi-star"></i>
                        <i class="zmdi zmdi-star-outline"></i>
                        <i class="zmdi zmdi-star-outline"></i>
                      </td>
                      <td>
                        <div class="progress">
                          <div class="progress-bar l-amber" role="progressbar" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100" style="width: 68%;"></div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <img class="rounded-circle" src="<?php echo $this->yolHtml ?>assets/images/xs/avatar3.jpg" alt="user" width="40"> </td>
                        <td>
                          <a href="javascript:void(0);">Jackson</a>
                        </td>
                        <td>$201</td>
                        <td>11</td>
                        <td>
                          <i class="zmdi zmdi-star"></i>
                          <i class="zmdi zmdi-star"></i>
                          <i class="zmdi zmdi-star-outline"></i>
                          <i class="zmdi zmdi-star-outline"></i>
                          <i class="zmdi zmdi-star-outline"></i>
                        </td>
                        <td>
                          <div class="progress">
                            <div class="progress-bar l-parpl" role="progressbar" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100" style="width:32%;"></div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <img class="rounded-circle" src="<?php echo $this->yolHtml ?>assets/images/xs/avatar4.jpg" alt="user" width="40"> </td>
                          <td>
                            <a href="javascript:void(0);">Victoria</a>
                          </td>
                          <td>$651</td>
                          <td>28</td>
                          <td>
                            <i class="zmdi zmdi-star"></i>
                            <i class="zmdi zmdi-star"></i>
                            <i class="zmdi zmdi-star"></i>
                            <i class="zmdi zmdi-star"></i>
                            <i class="zmdi zmdi-star-half"></i>
                          </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar l-green" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <img class="rounded-circle" src="<?php echo $this->yolHtml ?>assets/images/xs/avatar5.jpg" alt="user" width="40"> </td>
                            <td>
                              <a href="javascript:void(0);">Lucas</a>
                            </td>
                            <td>$300</td>
                            <td>20</td>
                            <td>
                              <i class="zmdi zmdi-star"></i>
                              <i class="zmdi zmdi-star"></i>
                              <i class="zmdi zmdi-star"></i>
                              <i class="zmdi zmdi-star-half"></i>
                              <i class="zmdi zmdi-star-outline"></i>
                            </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar l-blue" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
                              </div>
                            </td>
                          </tr>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- Jquery Core Js -->
          <?php require $GLOBALS["yolPhp"].'arayuz/script.php'; ?>
        </body>

        </html>
