
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Strathmore CMS Login</title>

    <link href="<?php echo base_url();?>assets/general-css/login.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/general-css/pages.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/general-css/customcss.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link rel="icon" type="image/icon" href="<?php echo base_url();?>assets/img/sulogoicon.png"/>

    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>
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
    </div>
</nav>


<section id="login" style="background-color: white; margin-bottom: 2%">
<div class="container" style = "margin-top: 8%">
  <div class= "row">
    <div class="col-lg-12 text-center">
        <h2 class="section-heading">LOGIN</h2>
        <hr class="primary">
    </div>
  </div>

  <?php echo form_open('index.php/LoginCtrl/login'); ?>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="form-group">
				<input type="text" name="username" class="form-control" placeholder="Enter Username" required autofocus>
			</div>
			<div class="form-group">
				<input type="password" name="password" class="form-control" placeholder="Enter Password" required autofocus>
			</div>
			<button type="submit" class="btn btn-primary btn-block">Login</button>
		</div>
	</div>
<?php echo form_close(); ?>

</div>

</section>






<section id="services" style="background-color: white; margin-bottom: 2%">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">

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
                               <li > <a href="#" style="text-decoration: none;color: white"><span class="fa fa-hand-o-right"> Latest News</span></a></li>
                               <li > <a href="#" style="text-decoration: none;color: white"><span class="fa fa-hand-o-right"> Upcoming Events</span></a></li>
                               <li > <a href="#" style="text-decoration: none;color: white"><span class="fa fa-hand-o-right"> Club Awards</span></a></li>
                               <li > <a href="#" style="text-decoration: none;color: white"><span class="fa fa-hand-o-right"> Club Leaders</span></a></li>
                         </ul>
                     </article>
                </div>
                <div class="col-md-3 widget">
                    <h2>Other Links</h2>
                    <article class="widget_content">
                        <ul style="list-style: none;text-decoration: none;">
                           <li > <a href="#" style="text-decoration: none;color: white"><span class="fa fa-hand-o-right"> Student Council Office</span></a></li>
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
  </div>



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




</body>

</html>
