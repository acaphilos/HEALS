<!-- Page preloader -->
<div id="preloader">
  <div class="loader"> </div>
</div>

<!-- Hero Section -->
<section class="hero-section set-bg" data-setbg="<?=base_url()?>public/img/bg.svg">
  <div class="container h-100">
    <div class="hero-content text-white">
      <div class="row">
        <div class="container">
          <div class="section-title">
            <p> Welcome, <?php echo $adminName ?>!</p>
            <h2>Admin Settings</h2>
          </div>

          <div class="row">
            
            <div class="col-lg-4 col-md-6 feature-item">
              <div class="fa-icon">
                <a href="<?=base_url()?>AdminCourse"><i class="fa fa-table"></i></a>
              </div>
              <h4> Edit Courses </h4>
              <p> Modify the course. </p>
            </div>
            
            
            <div class="col-lg-4 col-md-6 feature-item">
              <div class="fa-icon">
                <a href="<?=base_url()?>ViewComplain"><i class="fa fa-inbox"></i></a>
              </div>
              <h4> View Complains </h4>
              <p> View the complains that were submitted from students. </p>
            </div>
            
            <div class="col-lg-4 col-md-6 feature-item">
              <div class="fa-icon">
                <a href="<?=base_url()?>AdminSignup"><i class="fa fa-id-badge"></i></a>
              </div>
              <h4> Register Admin </h4>
              <p> Register for a new admin. </p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<hr>

<style>

.fa-icon{
  display:inline-flex;
  display:-webkit-inline-box;
  display:-ms-inline-flex;
  display:-ms-inline-box;
  width:87px;
  height:87px;
  border-radius:50%;
  background-color:#fca311;
  font-size:43px;
  color:#fff;
  align-items:center;
  -webkit-box-align:center;
  -webkit-box-pack:center;
  -ms-flex-align:center;
  -ms-flex-pack:center;
  justify-content:center;
  margin-bottom:40px;
}

.feature-item {
  text-align:center;
  margin-bottom:55px;
}

.feature-item h4 {
  margin-bottom:28px;
}

.feature-item .fa-icon {
  transform-origin: bottom-center;
  -webkit-transform-origin: bottom-center;
  -ms-transform-origin: bottom-center;
}

.feature-item .fa-icon:hover {
  transform-origin: bottom-center;
  -webkit-transform-origin: bottom-center;
  -ms-transform-origin: bottom-center;
  transform:scale(1.5);
  -webkit-transform:scale(1.5);
  -ms-transform:scale(1.5);
}


  </style>