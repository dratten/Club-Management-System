<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CMS</title>

     <?php $this->load->view('admin/headerlinks/headerlinks.php'); ?><!--navigation -->


</head>

<body>
<br><br>
<div class="container">

        
        <div class="row user-infos ">
            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Club information</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            

                            <div class=" col-md-10 col-lg-10 ">
                               <?php foreach ($clubview as $record){ ?>

                                <strong><?php echo $record['clubName']; ?></strong><br>
                                <table class="table table-user-information table-striped ">
                                    <tbody>

                                    <tr>
                                        <td>Club Email</td>
                                        <td><strong><?php echo $record['clubID']; ?></strong></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Date Registered</td>
                                        <td><?php echo $record['dateRegistered']; ?></td>
                                    </tr>


                                    <tr>
                                        <td>Year Launched</td>
                                        <td><?php echo $record['yearStarted']; ?></td>
                                        
                                    </tr>

                                    <tr>
                                        <td>Year Rebranded</td>
                                        <td><?php echo $record['yearRebranded'];?></td>
                                        
                                    </tr>

                                    <tr>
                                        <td>Registration Fee</td>
                                        <td><?php echo $record['registrationFee']."/= Kshs. ".$record['registrationBasis']; }?></td>
                                        
                                    </tr>
                                    
                                    

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                       <span data-placement="top" data-toggle="tooltip" title="Return to previous page"><a href="<?php echo base_url('home/clubs'); ?>" class="btn btn-xs" data-title="Refresh" ><span class="fa fa-arrow-circle-o-left"></span>&nbsp;Previous</a>
                        </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

     <?php $this->load->view('admin/footerlinks/footerlinks.php'); ?><!--navigation -->




</body>
</html>
