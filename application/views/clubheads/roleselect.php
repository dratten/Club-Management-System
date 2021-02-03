
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CMS</title>


    <?php $this->load->view('headerlinks/headerlinks.php'); ?>

     <link href="<?php echo base_url();?>assets/general-css/customcss.css" rel="stylesheet" type="text/css">

</head>

<body>

<div id="wrapper">

                <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                     <?php echo $this->session->userdata('officialName');//session to show who is logged in?>
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url('index.php/LoginCtrl/logoutclub'); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                         <li class="text-center">
                            <a href="#" style="background-color: maroon;font-weight: bold;color:white"><span><i class="fa fa-copyright fa-fw"></i>2019 Clubs and Societies:</span><br><span ><i class="fa fa-flag fa-fw"></i> Office of The Dean of Students</span><i class="fa fa-flag fa-fw"></i></a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
        <div>
            <div class="row" >
                <div class="col-lg-12">
                    <h4 class="page-header" style="margin-top:10px;color:maroon;font-weight: bolder">Select Role to Proceed</span></h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row" >
                <div class="col-lg-12">

                    <form action="<?php echo base_url('index.php/LoginCtrl/usertype'); ?>" method="POST">
                            <div class="form-group col-lg-8" >
                                <label for="" style="color:blue"></label>
                                    <select id="clubid" name="clubid" class="form-control" parsley-trigger="change" required>
                                        <option value="">---Select Club Role---</option>
                                    </select>
                            </div>
                            <div class="form-group col-lg-8" >
                                <label for="" style="color:blue"></label>
                                <button type="submit" class="btn btn-warning" id="submit" >Proceed <i class="fa fa-arrow-circle-o-right fa-lg" style="color:maroon"></i></button>
                                <button type="reset" class="btn btn-default " id="reset">Reset </button>
                            </div>

                    </form>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>

            <div class="row" style="top:0%">
                <div class="col-lg-12">
                    <div class="form-group col-lg-12" >
                            <img class="img-responsive" src=" <?php echo base_url();?>assets/img/strathlogo.png" style="background-size: cover">

                    </div>

                </div>
                <!-- /.col-lg-12 -->
            </div>

        </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

     <?php $this->load->view('scriptlinks/scriptlinks.php'); ?>

<script>

//=======================officials roles dropdown list=========================
 $(document).ready(function ()

   {

     $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/Home/officialroles'); ?>",
                    dataType:'json',

                    success:function(data)
                    {

                         $.each(data,function(clubid,description)
                            {
                                var opt = $('<option />');

                                opt.val(clubid);
                                opt.text(description);
                                $('#clubid').append(opt);


                            });

                             //sort the officials roles dropdown list
                                var options = $('#clubid option');
                                    var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
                                    arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
                                    options.each(function(i, o) {
                                      o.value = arr[i].v;
                                      $(o).text(arr[i].t);
                                    });

                               //this code removes duplicates from the list above
                                var seen = {};
                                jQuery('#clubid').children().each(function()
                                {
                                    var txt = jQuery(this).clone().wrap('<select>').parent().html();
                                    if (seen[txt]) {
                                        jQuery(this).remove();
                                    } else {
                                        seen[txt] = true;
                                    }

                                });
                    }


                });


});
</script>
</body>
</html>
