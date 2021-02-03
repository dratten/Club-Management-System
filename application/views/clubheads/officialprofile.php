
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

        <?php  $this->load->view('clubheads/clubnavigation'); ?>
   
    <div id="page-wrapper">
           
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4 hidden-xs hidden-sm">
                               <img class="img-circle" src="<?php echo base_url(); ?>assets/img/person.png" name="aboutme" width="140" height="140" border="0" class="img-circle"><br>

                               <?php foreach ($viewprofile as $record){ ?>

                               <span style="color:purple;"> <strong><?php echo $record['firstName']." ".$record['lastName'];?></strong>, <?php echo $this->session->userdata('roleName'); ?></span> 
                            </div>

                            <div class="col-md-4 col-md-offset-6 col-lg-4 col-lg-offset-6 hidden-md hidden-lg">
                                <img class="img-circle" src="<?php echo base_url(); ?>assets/img/person.png" name="aboutme" width="100" height="100" border="0" class="img-circle" >
                            </div>

                            </div><br>

                            <div class=" col-md-12 col-lg-12 col-md-offset-0 col-lg-offset-0 " >
                                <table class="table table-striped  table-hover display responsive nowrap ">
                                    <tbody >

                                    <tr>
                                        <td>Course </td>
                                        <td ><strong><?php echo $record['courseName']; ?></strong></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Gender</td>
                                        <td ><?php echo $record['gender']; ?></td>
                                        
                                    </tr>

                                    <tr>
                                        <td>Student No.</td>
                                        <td><?php echo $record['suID']; ?></td>
                                        
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?php echo $record['suEmail']; ?></td>
                                        
                                    </tr>
                                    <tr>
                                        <td>Cell phone</td>
                                        <td><?php echo $record['telNo']; ?></td>
                                        
                                    </tr>
                                    
                                    <tr style="color:green;font-weight: bolder;">
                                        <td >Status</td>
                                        <td >
                                        <?php 
                                            if($record['status']==1)
                                                {
                                                    echo "Enabled";
                                                }else echo "Disabled"; }?></td>
                                        
                                    </tr>

                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="panel-footer">
                       <span data-placement="top" data-toggle="tooltip" title="Return to previous page"><a href="<?php echo base_url('ClubController/clubmember'); ?>" class="btn btn-xs" data-title="Refresh" ><span class="fa fa-arrow-circle-o-left"></span>&nbsp;Previous</a>
                        </span>
                        </span>
                    </div> -->
                </div>
           
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

     <?php $this->load->view('scriptlinks/scriptlinks.php'); ?>
     

</body>
</html>
