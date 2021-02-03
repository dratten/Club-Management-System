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

<style type="text/css">
    [class*="fa-calendar"] 
        {
            color: #9617DF;
        }

    .star
        {
            color:red; 
        }
    .messagebox
        {
           display: none;
        }
    
   html,body
   {
    background-color: white;
   }

    </style>

</head>

<body>
<br><br>
<div class="container">

        
        <div class="row user-infos ">
            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">User information</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2 col-lg-2 hidden-xs hidden-sm">
                                <img class="img-circle"
                                     src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100"
                                     alt="User Pic">
                            </div>
                            <div class="col-xs-3 col-sm-3 hidden-md hidden-lg">
                                <img class="img-circle"
                                     src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=50"
                                     alt="User Pic">
                            </div>

                            <div class=" col-md-10 col-lg-10 ">
                               <?php foreach ($viewmember as $record){ ?>

                                <strong><?php echo $record['firstName']." ".$record['lastName']; ?></strong><br>
                                <table class="table table-user-information table-striped ">
                                    <tbody>

                                    <tr>
                                        <td>Course </td>
                                        <td><strong><?php echo $record['courseName']; ?></strong></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Gender</td>
                                        <td><?php echo $record['gender']; ?></td>
                                        
                                    </tr>

                                    <tr>
                                        <td>SU ID</td>
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
                                    <tr>
                                        <td>Date Registered</td>
                                        <td><?php echo $record['dateRegistered']; ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Status</td>
                                        <td>
                                        <?php 
                                            if($record['status']==1)
                                                {
                                                    echo "Active";
                                                }else echo "Inactive"; }?></td>
                                        
                                    </tr>

                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                       <span data-placement="top" data-toggle="tooltip" title="Return to previous page"><a href="<?php echo base_url('ClubController/clubmember'); ?>" class="btn btn-xs" data-title="Refresh" ><span class="fa fa-arrow-circle-o-left"></span>&nbsp;Previous</a>
                        </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

     <?php $this->load->view('scriptlinks/scriptlinks.php'); ?>

</body>
</html>
