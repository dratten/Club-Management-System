
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Strathmore Clubs Management System</title>

    <link href="<?php echo base_url();?>assets/general-css/login.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/general-css/pages.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/general-css/customcss.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/icon" href="<?php echo base_url();?>assets/img/sulogoicon.png"/>

    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <?php 
      $counter = 1;
      $left = 0;
      $route = "/assets/img/";
      echo '<style>';
    foreach ($events as $value) 
      {
        echo '.slide:nth-child('; echo $counter; echo') .slide__bg
        {
          left:'; echo $left; echo'%;
          background-image: url('; echo base_url($route.$value->file_name); echo');
        }';
        $left = $left-50;
        $counter++;
      }
      echo '</style>';
      ?><!--
    <style>
      .slide:nth-child(1) .slide__bg
        {
          left: 0;
          background-image: url('<?php echo base_url('/assets/img/club_olympics.jpg');?>');
        }

        .slide:nth-child(2) .slide__bg
        {
          left: -50%;
          background-image: url('<?php echo base_url();?>assets/img/clubawards.jpg');
        }
        .slide:nth-child(3) .slide__bg
        {
          left: -100%;
          background-image: url('<?php echo base_url();?>assets/img/studentcouncil.jpg');
        }
        .slide:nth-child(4) .slide__bg
        {
          left: -150%;
          background-image: url('<?php echo base_url();?>assets/img/clubawards.jpg');
        }
    </style>-->
</head>

<body>
  <div class="overlay"> <?php if(isset($_SESSION['msg']))
    {
      $msg = $_SESSION['msg'];
      $successful= $msg['success']; $failed=  $msg['error'];
      if ($successful=="" && $failed!=""){ echo '
      <div class="messagebox alert alert-danger" style="display: block">
        <button type="button" class="close" data-dismiss="alert">*</button>
        <div class="cs-text">
            <i class="fa fa-close"></i>
            <strong><span>';echo $msg['error']; echo '</span></strong>
        </div>
      </div>';}else if($successful=="" && $failed==""){echo '<div></div>';} else if ($successful!="" && $failed==""){ echo '
      <div class="messagebox alert alert-success" style="display: block">
        <button type="button" class="close" data-dismiss="alert">*</button>
        <div class="cs-text">
            <i class="fa fa-check-circle-o"></i>
            <strong><span>';echo $msg['success'];echo '</span></strong>
        </div>
        </div>';} $_SESSION['msg'] =array('error'=>'','success'=>'');}else{ echo '<div></div>';}?></div>

<nav class="navbar navbar-findcond navbar-fixed-top" style="background-color: black; height: 60px; padding-top: 10px">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#" style="color: white"><img id="logoimage" class="img-responsive" src=" <?php echo base_url();?>assets/img/sulogowhite.png" style="max-width: 160px;min-height:  120px ;margin-top: -55px; margin-left: -100px"</a>
            <a class="navbar-brand" href="#" style="color: white; margin-top:-10px; " id="brand-name">Clubs Management System</a>
        </div>

        <div class="collapse navbar-collapse " id="navbar" style="margin-right: -95px">
            <ul class="nav navbar-nav navbar-right" >
                <li class="dropdown">
                    <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Login </a>-->
                    <a href="#" class="dropdown-toggle " data-toggle="dropdown"  style="color: white;background-color: black ;" ><b>Login</b> <span class="caret"></span></a>
            <ul id="login-dp" class="dropdown-menu">
                <li>
                     <div class="row">
                            <div class="col-md-12">
                                <?php echo form_open('index.php/LoginCtrl/login'); ?>
                                <form class="form" role="form" method="post" accept-charset="UTF-8" id="login-nav">
                                <!-- <div class="messagebox alert alert-danger"  id="fail" style="display: none">
                                    <button type="button" class="close" data-dismiss="alert"></button>
                                        <div class="cs-text">
                                            <i class="fa fa-times-circle"></i>
                                            <strong>Invalid credentials</strong>
                                        </div>
                                </div>-->
                                        <div class="form-group">
                                             <label class="sr-only" for="username">Email address</label>
                                             <input class="form-control" name="username" id="username" placeholder="Username" required autocomplete="off" >
                                        </div>
                                        <div class="form-group">
                                             <label class="sr-only" for="password">Password</label>
                                             <input type="password" name="password" class="form-control" id="password" placeholder="Password" required autocomplete="off" >
                                        </div>
                                        <div class="form-group">
                                             <button type="submit" id="submit" name="submit" class="btn btn-primary btn-block">Login</button>
                                        </div>
                                </form>
                                <?php echo form_close(); ?>
                            </div>

                     </div>
        </div>
        <!--
        <div class="collapse navbar-collapse " id="navbar" style="margin-right: -95px">

              <ul class="nav navbar-nav navbar-right ml-auto mr-3">
                <li class="dropdown">

                     <a  href ="<?php echo base_url();?>LoginCtrl/login" class="dropdown-toggle" target="_blank" style="color: white;background-color: black ;" ><b>Login</b> </a>
                   </li>
                  </ul>

        </div> -->
    </div>
</nav>

<!--
<div class="slider-container" style="margin-top: 2%">
  <div class="slider-control left inactive"></div>
  <div class="slider-control right"></div>
  <ul class="slider-pagi"></ul>
  <div class="slider">
    <div class="slide slide-0 active">
      <div class="slide__bg"></div>
      <div class="slide__content">
        <svg class="slide__overlay" viewBox="0 0 720 405" preserveAspectRatio="xMaxYMax slice">
          <path class="slide__overlay-path" d="M0,0 150,0 500,405 0,405" />
        </svg>
        <div class="slide__text">
          <h2 class="slide__text-heading" style="font-weight: bolder"><span style="color: red">Upcoming:</span> Club Olympics<span style="color:darkred"> : </span><span style="color: black">Friday 9<sup>th</sup> June, 2017</span></h2>
          <p class="slide__text-desc">Join a team of smart and outgoing students from various clubs in this year's club olympics. Play, win and have fun</p>
          <!-- <a href="http://hkmbhutto.wix.com/abdulrasheed"
          class="slide__text-link">Project link</a> 
        </div>
      </div>
    </div>
    <div class="slide slide-1 ">
      <div class="slide__bg"></div>
      <div class="slide__content">
        <svg class="slide__overlay" viewBox="0 0 720 405" preserveAspectRatio="xMaxYMax slice">
          <path class="slide__overlay-path" d="M0,0 150,0 500,405 0,405" />
        </svg>
        <div class="slide__text">
          <h2 class="slide__text-heading" style="font-weight: bolder;"> <span style="color: red">Annual</span> Club Awards </h2>
          <p class="slide__text-desc" style="color: black">Each year, the Dean of Students Awards the Most Outstanding Clubs in various areas e.g. Best Club Report, Most Rewarding Club, Best Organized Club Event etc </p>
         <!--  <a href="http://hkmbhutto.wix.com/abdulrasheed"
          class="slide__text-link">Project link</a>
        </div>
      </div>
    </div>
    <div class="slide slide-2">
      <div class="slide__bg"></div>
      <div class="slide__content">
        <svg class="slide__overlay" viewBox="0 0 720 405" preserveAspectRatio="xMaxYMax slice">
          <path class="slide__overlay-path" d="M0,0 150,0 500,405 0,405" />
        </svg>
       <div class="slide__text">
          <h2 class="slide__text-heading" style="font-weight: bolder;color: darkred">Student of the Month Launched</h2>
          <p class="slide__text-desc" style="color: black">The student council last week launched a monthly award program to recognize the most outstanding student overall in such areas as innovation, entrepreneurship, community service etc.</p>
          <!-- <a href="http://hkmbhutto.wix.com/abdulrasheed"
          class="slide__text-link">Project link</a> 
        </div>
      </div>
    </div>
    <div class="slide slide-3">
      <div class="slide__bg"></div>
      <div class="slide__content">
        <svg class="slide__overlay" viewBox="0 0 720 405" preserveAspectRatio="xMaxYMax slice">
          <path class="slide__overlay-path" d="M0,0 150,0 500,405 0,405" />
        </svg>
        <div class="slide__text">
          <h2 class="slide__text-heading" style="font-weight: bolder;"> Club Awards for the year 2016</h2>
          <p class="slide__text-desc" style="color: black">Each year, the Dean of Students Awards the Most Outstanding Clubs in various areas e.g. Best Club Report, Most Rewarding Club, Best Organized Club Event etc </p>
          <!-- <a href="http://hkmbhutto.wix.com/abdulrasheed"
          class="slide__text-link">Project link</a>
        </div>

      </div>
    </div>
      </div>
</div>-->
<div class="slider-container" style="margin-top: 2%">
  <div class="slider-control left inactive"></div>
  <div class="slider-control right"></div>
  <ul class="slider-pagi"></ul>
  <div class="slider">
    <?php
    $counter = 0;
    $left = 0;
    foreach ($events as $value) 
      {
        echo '<div class="slide slide-'; echo $counter; echo' active">
      <div class="slide__bg"></div>
      <div class="slide__content">
        <svg class="slide__overlay" viewBox="0 0 720 405" preserveAspectRatio="xMaxYMax slice">
          <path class="slide__overlay-path" d="M0,0 150,0 500,405 0,405" />
        </svg>
        <div class="slide__text">
          <h2 class="slide__text-heading" style="font-weight: bolder"><span style="color: black">';echo $value->description;echo ' on </span> <span style="color: black">';echo $value->eventDate; echo'</span></h2>
          <p class="slide__text-desc">';echo $value->eventVenue; echo' at '.$value->startTime; echo'</p>
        </div>
      </div>
    </div>';
        /*echo'
    <div class="slide slide-'; echo $counter; echo '">
    <div class="slide__bg"></div>
      <div class="slide__content">
        <svg class="slide__overlay" viewBox="0 0 720 405" preserveAspectRatio="xMaxYMax slice">
          <path class="slide__overlay-path" d="M0,0 150,0 500,405 0,405" />
        </svg>
        <div class="slide__text">
          <h2 class="slide__text-heading" style="font-weight: bolder"><span style="color: black">';echo $value->description;echo '</span><span style="color: black">';echo $value->eventDate; echo'</span></h2>
          <p class="slide__text-desc">';echo $value->eventVenue; echo'</p>
        </div>
      </div>
    </div>';*/
    $left = $left-50;
    $counter++;}?>
    </div>
</div>

<section id="services" style="background-color: white; margin-bottom: 2%">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Strathmore University Clubs</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <a href="" style="text-decoration: none;">
                      <div class="service-box">
                          <i class="fa fa-4x fa-newspaper-o text-primary sr-icons"></i>
                          <h3 style="color: red">Latest News</h3>
                          <p class="text-muted">Stay updated with the latest news on club events</p>
                      </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <a href="#" style="text-decoration: none;">
                      <div class="service-box">
                          <i class="fa fa-4x fa-calendar text-primary sr-icons"></i>
                          <h3>Upcoming Events</h3>
                          <p class="text-muted">Participate in exciting club events. Get to learn, have fun and interact with the most creative minds in Strathmore!</p>
                      </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 text-center">
                    <a href="#" style="text-decoration: none;">
                      <div class="service-box">
                          <i class="fa fa-4x fa-gift text-primary sr-icons"></i>
                          <h3>Club Awards</h3>
                          <p class="text-muted">Clubs are awarded annually for their efforts in engaging students. Explore to find out more</p>
                      </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <a href="#" style="text-decoration: none;">
                      <div class="service-box">
                          <i class="fa fa-4x fa-users text-primary sr-icons"></i>
                          <h3>Club Leaders</h3>
                          <p class="text-muted">Get to know the brains behind the vibrant Strathmore University Clubs</p>
                      </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- Clubs Information here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row" >

                <?php foreach($profile as $info){
                     $email= $info->clubID;
                  $clubname = substr($email, 0, strpos($email, '@'));

                    echo '<div class="col-lg-6">
                        <div class="card-box card-tabs">
                            <ul class="nav nav-pills pull-right">

                                <li class="active">
                                    <a id="'; echo $clubname; echo '" '; echo ' href="#joinus_'; echo $clubname; echo '" '; echo ' aria-expanded="false" data-toggle="modal" data-target="#joinus_'; echo $clubname; echo '" '; echo '   >Join Us</a>
                                </li>
                                <li class="">
                                    <a href="mailto:'; echo $email; echo '" '; echo ' >Contact Us</a>
                                </li>
                            </ul>
                             <p class="header-title m-b-30">Status: '; if($info->status==TRUE){echo '<strong><span style="color:green">Active</span></strong>';}else{ echo '<strong><span style="color:red">Inactive</span></strong>';} echo '</p>

                            <div class="tab-content">
                                <div id="aboutus_'; echo $clubname; echo '" '; echo ' class="tab-pane fade in active">
                                    <div class="row">
                                    <div class="col-md-12">
                                            <p style="color:purple; padding-top:10px;"><strong>'; echo $info->clubName;

                                            echo '</strong></p>
                                        </div><!--
                                        <div class="col-md-12">
                                            <p>'; echo $info->clubProfile;

                                            echo '</p>
                                        </div>-->
                                    </div>
                                </div>

                                <div class="modal fade" id="joinus_'; echo $clubname; echo '" '; echo ' tabindex="-1" role="dialog" aria-labelledby="Join " aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                              <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                              <h4 class="modal-title custom_align" id="Heading">Join <span style="text-transform: uppercase;"> ';echo $clubname; echo ' </span></h4>
                                          </div>
                                          <form role="form" method="POST" action="" id="register_'; echo $clubname; echo '"'; echo ' name="register_'; echo $clubname; echo '" autocomplete="off">
                                          <div class="first">
                                            <div class="form-group col-lg-12" style="display: none;">
                                                  <label>Club Email<span class="star">*</span></label>
                                                  <input type="email" class="form-control" placeholder="Example: clubemail@gmail.com" name="clubemail" id="clubemail" parsley-type="email"  autocomplete="off" value="'; echo $info->clubID; echo '" required data-parsley-group="first">'; echo '
                                            </div>
                                            <div class="form-group col-lg-12">
                                              <label>Student ID<span class="star">*</span></label> <!-- <span id="num" class="fa fa-asterisk" style="color:#FF0004;font-size: 10px" > --><!-- </span>  -->
                                              <input class="form-control" id="suid" name="suid" data-parsley-type="digits" required data-parsley-length="[2,6]" placeholder="Example: 78581" autocomplete="off" required data-parsley-group="first">
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label>Surname<span class="star">*</span></label>
                                                <input class="form-control" placeholder="Example: Mokoro" name="lastname" id="lastname" parsley-trigger="change" required  data-parsley-group="first">
                                            </div>
                                            <div class="form-group col-lg-12" >
                                                <label>First Name<span class="star">*</span></label>
                                                <input class="form-control" placeholder="Example: Stephen" name="firstname" id="firstname" parsley-trigger="change" required autocomplete="off" data-parsley-group="first">
                                            </div>

                                            <div class="form-group col-lg-12">
                                                <label class="">Gender<span class="star">*</span></label><br>
                                                <label class="radio-inline ">
                                                    <input type="radio" name="gender" id="gender" value="Male" parsley-trigger="change" required autocomplete="off" data-parsley-group="first">Male
                                                </label>
                                                <label class="radio-inline ">
                                                    <input type="radio" name="gender" id="gender" value="Female" parsley-trigger="change" required autocomplete="off" data-parsley-group="first">Female
                                                </label><br><br>

                                            </div>

                                            <div class="form-group col-lg-12">
                                                <label>SU Email<span class="star">*</span></label>
                                                <input type="email" class="form-control" placeholder="Example: stephen.mokoro@strathmore.edu" name="suemail" id="suemail" parsley-type="email" required autocomplete="off" data-parsley-group="first">
                                            </div>

                                            <div class="form-group col-lg-12">
                                                <label>Cell Phone<span class="star">*</span></label>
                                                <input class="form-control" placeholder="Example: +254 (0) 719508386" name="phone" id="phone" parsley-trigger="change" required pattern="^[\d\+\(\)\/\s]*$" autocomplete="off" data-parsley-group="first">
                                            </div>


                                              <div class="form-group col-lg-12">
                                                  <label for="">Select Course<span class="star">*</span></label>
                                                      <select id="course" name="course" class="form-control"  required data-parsley-group="first">
                                                          <option value="ACCA">ACCA</option>
                                                          <option value="ASc">Actuarial Sc</option>
                                                          <option value="BA-Comm">BA-Comm</option>
                                                          <option value="BA-Dev.S&P">BA-Dev.S&P</option>
                                                          <option value="BA-Int.St">BA-Int.St</option>
                                                          <option value="BBIT">BBIT</option>
                                                          <option value="BBS-FE">BBS-FE</option>
                                                          <option value="BBS-FIN">BBS-FIN</option>
                                                          <option value="BCOM">BCOM</option>
                                                          <option value="BHM">BHM</option>
                                                          <option value="BIF">BIF</option>
                                                          <option value="BTC">BTC</option>
                                                          <option value="CIM">CIM</option>
                                                          <option value="CPA">CPA</option>
                                                          <option value="DBIT">DBIT</option>
                                                          <option value="DBM">DBM</option>
                                                          <option value="ICS">ICS</option>
                                                          <option value="LLB">LLB</option>
                                                          <option value="MSc.IT">MSc.IT</option>
                                                      </select>
                                              </div>
                                            </div>

                                              <button type="button" class="btn btn-success" id="regsubmit_'; echo $clubname; echo '"style="margin-left:15px;margin-bottom:15px;" onClick=submitData(this);>Submit </button>
                                              <button type="reset" class="btn btn-default " id="regreset_'; echo $clubname; echo '" style="margin-bottom:15px">Reset </button>

                                                  <div class="messagebox alert alert-success"  id="success">
                                                      <button type="button" class="close" data-dismiss="alert"></button>
                                                      <div class="cs-text">
                                                          <i class="fa fa-check-circle-o"></i>
                                                          <strong><span> Success!</span></strong>
                                                          <p>Request Successfully Sent!<br /></p>
                                                      </div>
                                                  </div>


                                                  <div class="messagebox alert alert-danger"  id="activemember">
                                                      <button type="button" class="close" data-dismiss="alert"></button>
                                                      <div class="cs-text">
                                                          <i class="fa fa-times-circle"></i>
                                                          <strong> Registered and active!</strong>
                                                          <p>You are already registered and active in this club!<br /></p>
                                                      </div>
                                                  </div>

                                                  <div class="messagebox alert alert-danger"  id="inactivemember">
                                                      <button type="button" class="close" data-dismiss="alert"></button>
                                                      <div class="cs-text">
                                                          <i class="fa fa-times-circle"></i>
                                                          <strong> Registered but Inactive!</strong>
                                                          <p>Please contact club leadership!<br /></p>
                                                      </div>
                                                  </div>
                                                   <div class="messagebox alert alert-danger"  id="requested">
                                                      <button type="button" class="close" data-dismiss="alert"></button>
                                                      <div class="cs-text">
                                                          <i class="fa fa-times-circle"></i>
                                                          <strong> Request already sent!</strong>
                                                          <p>You already requested to join this club!<br /></p>
                                                      </div>
                                                  </div>


                                                   <div class="messagebox alert alert-info"  id="inactive">
                                                      <button type="button" class="close" data-dismiss="alert"></button>
                                                      <div class="cs-text">
                                                          <i class="fa fa-times"></i>
                                                          <strong> Request failed!</strong>
                                                          <p>You are already registered but inactive. Please contact club head<br /></p>
                                                      </div>
                                                  </div>

                                                   <div class="messagebox alert alert-warning"  id="joinerror">
                                                      <button type="button" class="close" data-dismiss="alert"></button>
                                                      <div class="cs-text">
                                                          <i class="fa fa-times"></i>
                                                          <strong></i> Error!</strong>
                                                          <p>An error occurred!<br /></p>
                                                      </div>
                                                  </div>
                                              </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="contactus_'; echo $clubname; echo '" '; echo ' tabindex="-1" role="dialog" aria-labelledby="Contact" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title custom_align" id="Heading">Contact <span style="text-transform: uppercase;"> ';echo $clubname; echo ' </span></h4>
                                            </div>
                                           <form role="form" method="POST" action="" id="contact_'; echo $clubname; echo '"'; echo 'name="contact_'; echo $clubname; echo '" autocomplete="off">
                                              <div class="form-group col-lg-12" style="display: none;">
                                                  <label>Club Email<span class="star">*</span></label>
                                                  <input type="email" class="form-control" placeholder="Example: clubemail@gmail.com" name="clubemail" id="clubemail" parsley-type="email" required autocomplete="off" value="'; echo $info->clubID; echo '">'; echo '
                                              </div>
                                              <div class="form-group col-lg-12">
                                                  <label>Email Address<span class="star">*</span></label>
                                                  <input type="email" class="form-control" placeholder="Example: myemail@gmail.com" name="suemail" id="suemail" parsley-type="email" required autocomplete="off" required>
                                              </div>

                                              <div class="form-group col-lg-12">
                                                  <label>Cell Phone<span class="star">*</span></label>
                                                  <input class="form-control" placeholder="Example: +254 (0) 719508386" name="phone" id="phone" parsley-trigger="change" required pattern="^[\d\+\(\)\/\s]*$" autocomplete="off">
                                              </div>
                                              <div class="form-group col-lg-12">
                                                <label for="">Topic</label>
                                                <select id="role" name="role" class="form-control">
                                                    <option value="">--Select Topic---</option>
                                                    <option value="Joining the Club">Joining the Club</option>
                                                    <option value="Partner with the Club">Partnering with the Club</option>
                                                    <option value="General Inquiry">General Inquiry</option>
                                                </select>
                                              </div>

                                              <div class="form-group col-lg-12">
                                                <label>Message</label>
                                                <textarea class="form-control" placeholder="Please type your message here..." name="description" id="description"></textarea>
                                              </div>

                                              <button type="button" class="btn btn-success" id="contactsubmit_'; echo $clubname; echo '"';echo 'name="contactsubmit_'; echo $clubname; echo '" style="margin-left:15px;margin-bottom:15px;" onClick=submitData(this);>Submit </button>
                                              <button type="reset" class="btn btn-default" id="contactreset_'; echo $clubname; echo '"';echo 'name="contactreset_'; echo $clubname; echo '" style="margin-bottom:15px;">Reset </button>

                                                  <div class="messagebox alert alert-success"  id="success">
                                                      <button type="button" class="close" data-dismiss="alert"></button>
                                                      <div class="cs-text">
                                                          <i class="fa fa-check-circle-o"></i>
                                                          <strong><span> Success!</span></strong>
                                                          <p>Message sent!<br /></p>
                                                      </div>
                                                  </div>


                                                  <div class="messagebox alert alert-danger"  id="fail">
                                                      <button type="button" class="close" data-dismiss="alert"></button>
                                                      <div class="cs-text">
                                                          <i class="fa fa-times"></i>
                                                          <strong> Registration Failed!</strong>
                                                          <p>Sorry, message not sent!<br /></p>
                                                      </div>
                                                  </div>

                                                   <div class="messagebox alert alert-info"  id="inactive">
                                                      <button type="button" class="close" data-dismiss="alert"></button>
                                                      <div class="cs-text">
                                                          <i class="fa fa-times"></i>
                                                          <strong> Registration Failed!</strong>
                                                          <p>Sorry, message not sent<br /></p>
                                                      </div>
                                                  </div>

                                                   <div class="messagebox alert alert-warning"  id="error">
                                                      <button type="button" class="close" data-dismiss="alert"></button>
                                                      <div class="cs-text">
                                                          <i class="fa fa-times"></i>
                                                          <strong></i> Invalid Input!</strong>
                                                          <p>A required field is empty!<br /></p>
                                                      </div>
                                                  </div>
                                              </form>
                                          </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';}?>
                    <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- container -->

            <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>




    <div class="footer" style="background-color: black; color:white;border: none;">
        <div class="container">
            <div class="row">
                <div class="col-md-3 widget">
                    <h2>Student Affairs</h2>
                    <article class="widget_content">
                        <ul style="list-style: none;text-decoration: none;">
                           <li > <a href="#" style="text-decoration: none;color: white"><span class="fa fa-hand-o-right"> Student of the month</span></a></li>
                     </ul>
                     </article>
                </div>
                <div class="col-md-3 widget">
                    <h2>Clubs & Club Events</h2>
                    <article class="widget_content">
                        <ul style="list-style: none;text-decoration: none;">
                               <li > <a href="https://www.strathmore.edu/latest-news/" style="text-decoration: none;color: white"><span class="fa fa-hand-o-right"> Latest News</span></a></li>
                               <li > <a href="https://www.strathmore.edu/events/list" style="text-decoration: none;color: white"><span class="fa fa-hand-o-right"> Upcoming Events</span></a></li>
                               <li > <a href="#" style="text-decoration: none;color: white"><span class="fa fa-hand-o-right"> Club Awards</span></a></li>
                               <li > <a href="#" style="text-decoration: none;color: white"><span class="fa fa-hand-o-right"> Club Leaders</span></a></li>
                         </ul>
                     </article>
                </div>
                <div class="col-md-3 widget">
                    <h2>Other Links</h2>
                    <article class="widget_content">
                        <ul style="list-style: none;text-decoration: none;">
                           <li > <a href="mailto:studentcouncil@strathmore.edu" style="text-decoration: none;color: white"><span class="fa fa-hand-o-right"> Student Council Office</span></a></li>
                     </ul>
                     </article>
                </div>
                <div class="col-md-3 widget">
                  <h2>Contact Dean of Students Office</h2>
                  <article class="widget_content">
                      <p> Email:<a href='mailto:deanofstudents@strathmore.edu'> deanofstudents@strathmore.edu</a> </p>
                  </article>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12 widget">© 2019 | Clubs and Societies - Office of The Dean of Students
                </div>
            </div>
        </div>
    </div>

     <!-- jQuery -->
   <script src="<?php echo base_url();?>assets/datepicker/daterangepicker/moment.js"></script>

    <script src="<?php echo base_url();?>assets/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>

    <!-- the -->
    <script src="<?php echo base_url();?>assets/jquery/jquery-ui.min.js" ></script><!-- this script must come before the datepicker scripts else the datepickers will fail -->

    <script src="<?php echo base_url('assets/plugins/parsleyjs/parsley.min.js');?>"></script>

     <script src="<?php echo base_url();?>assets/general-js/jquery-easing.min.js"></script>
   <script src="<?php echo base_url();?>assets/general-js/scrollreveal.min.js"></script>
      <script src="<?php echo base_url();?>assets/general-js/jquery.magnific-popup.min.js"></script>
      <script src="<?php echo base_url();?>assets/general-js/creative.min.js"></script>
    <script src="<?php echo base_url('assets/plugins/parsleyjs/parsley.min.js');?>"></script>


<script>
var  submitbtn="";
// function getForm(objButton)
//   {
//     var clubid=objButton;
//     var submitbtn="regsubmit_"+clubid;
//      // alert(submitbtn);
//   }

//  $("#"submitbtn).on('click', function(){alert();});

function submitData(objButton)
    {
          var clubemail= $(objButton).parent().find("input[name='clubemail']").val();
          var suid= $(objButton).parent().find("input[name='suid']").val();
          var lastname= $(objButton).parent().find("input[name='lastname']").val();
          var firstname= $(objButton).parent().find("input[name='firstname']").val();
          var gender= $(objButton).parent().find("input[name='gender']:checked").val();
          var phone= $(objButton).parent().find("input[name='phone']").val();
          var suemail= $(objButton).parent().find("input[name='suemail']").val();
          var course =$(objButton).parent().find("#course").val();

        $(objButton).parent().parsley().validate("first");

        if ($(objButton).parent().parsley().isValid("first")) {

            $(objButton).parent().parsley().destroy();
             // console.log('valid');
             //$('#form').submit();
              // $(objButton).parent().submit();
               $.ajax(//ajax script to post the data without page refresh
                  {
                      type:"post",
                      url: "<?php echo base_url('index.php/ClubController/joinClub');?>",
                      data:{ suid:suid,lastname:lastname,firstname:firstname,gender:gender,phone:phone,suemail:suemail,course:course,clubemail:clubemail},
                      dataType:'json',

                      success:function(data)
                      {if (data.successful)
                              {
                                $(objButton).parent().find("#success").show();
                                  //fade away the notification after 2000 microseconds
                                   $(objButton).parent().find("#success").fadeTo(2000, 500).slideUp(500, function(){
                                     $(objButton).parent().find("#success").slideUp(500);
                                    });

                              }else if (data.activemember)
                                  {
                                    $(objButton).parent().find("#activemember").show();
                                      //fade away the notification after 2000 microseconds
                                       $(objButton).parent().find("#activemember").fadeTo(2000, 500).slideUp(500, function(){
                                         $(objButton).parent().find("#activemember").slideUp(500);
                                        });

                                  }else if (data.inactive)
                                      {
                                        $(objButton).parent().find("#inactivemember").show();
                                          //fade away the notification after 2000 microseconds
                                           $(objButton).parent().find("#inactivemember").fadeTo(2000, 500).slideUp(500, function(){
                                             $(objButton).parent().find("#inactivemember").slideUp(500);
                                            });
                                      }else if (data.requested)
                                          {
                                            $(objButton).parent().find("#requested").show();
                                              //fade away the notification after 2000 microseconds
                                               $(objButton).parent().find("#requested").fadeTo(2000, 500).slideUp(500, function(){
                                                 $(objButton).parent().find("#requested").slideUp(500);
                                                });
                                          }
                      }
                  });
        } else {
            console.log('not valid');
        }
    }



    // window.onbeforeunload = function() {
    //     return "Dude, are you sure you want to leave? Think of the kittens!";
    // }
// Footer JS
$(document).ready(function() {
    $( ".widget h2" ).click(
        function() {
            $(this).parent().toggleClass('active');
        }
    );
});


// Scroll top script
$(document).ready(function(){
     $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip().hide();
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });

        // $('#back-to-top').tooltip().show();

});
// end of scroll top script
$(document).ready(function()
{

  var $slider = $(".slider"),
      $slideBGs = $(".slide__bg"),
      diff = 0,
      curSlide = 0,
      numOfSlides = $(".slide").length-1,
      animating = false,
      animTime = 500,
      autoSlideTimeout,
      autoSlideDelay = 12000,
      $pagination = $(".slider-pagi");

  function createBullets()
    {
      for (var i = 0; i < numOfSlides+1; i++)
        {
          var $li = $("<li class='slider-pagi__elem'></li>");
          $li.addClass("slider-pagi__elem-"+i).data("page", i);
          if (!i) $li.addClass("active");
          $pagination.append($li);
        }
    };

  createBullets();

  function manageControls()
    {
      $(".slider-control").removeClass("inactive");
      if (!curSlide) $(".slider-control.left").addClass("inactive");
      if (curSlide === numOfSlides) $(".slider-control.right").addClass("inactive");
    };

  function autoSlide()
    {
      autoSlideTimeout = setTimeout(function()
        {
          curSlide++;
          if (curSlide > numOfSlides) curSlide = 0;
          changeSlides();
        }, autoSlideDelay);
    };

  autoSlide();

  function changeSlides(instant)
  {
    if (!instant)
      {
        animating = true;
        manageControls();
        $slider.addClass("animating");
        $slider.css("top");
        $(".slide").removeClass("active");
        $(".slide-"+curSlide).addClass("active");
        setTimeout(function()
          {
            $slider.removeClass("animating");
            animating = false;
          }, animTime);
      }
    window.clearTimeout(autoSlideTimeout);
    $(".slider-pagi__elem").removeClass("active");
    $(".slider-pagi__elem-"+curSlide).addClass("active");
    $slider.css("transform", "translate3d("+ -curSlide*100 +"%,0,0)");
    $slideBGs.css("transform", "translate3d("+ curSlide*50 +"%,0,0)");
    diff = 0;
    autoSlide();
  }

  function navigateLeft()
    {
      if (animating) return;
      if (curSlide > 0) curSlide--;
      changeSlides();
    }

  function navigateRight()
    {
      if (animating) return;
      if (curSlide < numOfSlides) curSlide++;
      changeSlides();
    }

  $(document).on("mousedown touchstart", ".slider", function(e)
    {
      if (animating) return;
      window.clearTimeout(autoSlideTimeout);
      var startX = e.pageX || e.originalEvent.touches[0].pageX,
          winW = $(window).width();
      diff = 0;

      $(document).on("mousemove touchmove", function(e)
        {
          var x = e.pageX || e.originalEvent.touches[0].pageX;
          diff = (startX - x) / winW * 70;
          if ((!curSlide && diff < 0) || (curSlide === numOfSlides && diff > 0)) diff /= 2;
          $slider.css("transform", "translate3d("+ (-curSlide*100 - diff) +"%,0,0)");
          $slideBGs.css("transform", "translate3d("+ (curSlide*50 + diff/2) +"%,0,0)");
        });
    });

  $(document).on("mouseup touchend", function(e)
    {
      $(document).off("mousemove touchmove");
      if (animating) return;
      if (!diff)
        {
          changeSlides(true);
          return;
        }
      if (diff > -8 && diff < 8)
        {
          changeSlides();
          return;
        }
      if (diff <= -8)
        {
          navigateLeft();
        }
      if (diff >= 8)
        {
          navigateRight();
        }
    });

  $(document).on("click", ".slider-control", function()
    {
      if ($(this).hasClass("left"))
        {
          navigateLeft();
        } else
            {
              navigateRight();
            }
    });

  $(document).on("click", ".slider-pagi__elem", function()
    {
      curSlide = $(this).data("page");
      changeSlides();
    });

});
    function login()    {

            var username= $("#username").val();
            var password= $("#password").val();
            $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('LoginCtrl/login'); ?>",//URL changed
                    data:{ username:username, password:password},
                    dataType:'json',

                    success:function(data)
                    {
                        if (data.successful)
                          {
                              location.href="<?php echo base_url(); ?>"+data.successful;

                          }else if(data.fail)
                              {
                                  $('#fail').show();
                                  $("#fail").fadeTo(2000, 500).slideUp(500, function(){
                                      $("#fail").slideUp(500);
                                      });

                              }

                        // $('#addclub #clubreg')[0].reset();
                    }
                });
        }

    $(document).ready(function() {
        $('#login-nav').parsley();
            });

    $('#login-nav').submit( function(e) {
      e.preventDefault(e);
        if ( $(this).parsley().isValid() ) {
            login();
        }
    });

</script>

</body>

</html>
