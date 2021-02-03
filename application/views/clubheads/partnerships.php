
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

<style type="text/css">

    .star
        {
            color:red; 
        }
    .messagebox
        {
           display: none;
        }
        
    /* Centering td values in datatable*/
    table td:nth-child(1),td:nth-child(2),td:nth-child(3) ,td:nth-child(4) ,td:nth-child(5) ,td:nth-child(6),td:nth-child(7)  
                {

                 text-align:center !important;
                }
    html,body
        {
            background-color: white;
        }
    #clubpartnerships th
        {
            border-bottom:2px solid;
            border-color: grey;
        }
    #clubpartnerships
        {
            border-bottom:none;
        }
            
        html,body
            {
                background-color: white;
            }
      
        .dataTables_wrapper .dataTables_filter
            {
                float:right;text-align:left;
            }
        .dataTables_wrapper .dataTables_filter input
            {
                margin-left:0.5em
            }
    </style>
       
</head>

<body>

<div id="wrapper">

        <?php  $this->load->view('clubheads/clubnavigation'); ?>
        <div id="page-wrapper" >
    
           <div class="row" >
                <div class="col-lg-12" style="margin-top:10px;color:blue">
                    <h4 class="page-header"><?php  echo $this->session->userdata('clubName'); echo " Partnerships";?></span></h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <span data-placement="top" data-toggle="tooltip" title="Add Partnership">
                    <button class="btn btn-primary btn-xs" data-title="Add Partnership" data-toggle="modal" data-target="#addpartnership" ><span class="fa fa-plus-circle"></span>&nbsp;Add Partnership</button></span>
            <span data-placement="top" data-toggle="tooltip" title="Refresh">
                <button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh</button>

             <span data-placement="top" data-toggle="tooltip" title="Print All">
                    <a class="btn btn-xs" data-title="Print All" type="button" href="#"><span class="fa fa-print"></span>&nbsp;Print All</a>
            </span>


            <br><br>
            <div class="row">
                <div class="col-md-12">
                  <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%"  id="clubpartnerships">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Date Entered</th>
                                <th class="text-center">Partnership Type</th>
                                <th class="text-center">Partner Name</th>
                                <th class="text-center">Action</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
            </div>

             <div class="modal fade" id="addpartnership" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Add Partnership Details </h4>
                        </div>

                        <div class="modal-body">
                            <form role="form" method="POST" action="" id="partnershipreg">

                                        <div class="form-group col-lg-6">
                                            <label>Partner/Company Full Name</label>
                                            <input class="form-control" placeholder="Partner's Full Name" name="starttime" id="starttime">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Partnership Type</label>
                                            <input class="form-control" placeholder="Partnership Type" name="meetingvenue" id="meetingvenue">
                                        </div>
                                        
                                         <div class="form-group col-lg-6">
                                            <label>Partner's Email</label>
                                            <input class="form-control" placeholder="Partner's Email" name="starttime" id="starttime">
                                        </div>
                                         <div class="form-group col-lg-6">
                                            <label>Partner's Phone 1</label>
                                            <input class="form-control" placeholder="Partner's Phone 1" name="starttime" id="starttime">
                                        </div>
                                         <div class="form-group col-lg-6">
                                            <label>Partner's Phone 2</label>
                                            <input class="form-control" placeholder="Partner's Phone 2" name="starttime" id="starttime">
                                        </div>
                                         <div class="form-group col-lg-6">
                                            <label>Partner's Postal Address</label>
                                            <input class="form-control" placeholder="Partner's Postal Address" name="starttime" id="starttime">
                                        </div>

                                        
                                        <div class="form-group col-lg-12">
                                            <label>Partnership Description</label>
                                            <textarea class="form-control" placeholder="Partnership Description" name="phone" id="phone"></textarea>
                                        </div>
                                         <div class="form-group col-lg-6">
                                            <label>Date Entered</label>
                                            <input class="form-control" placeholder="Date Entered" id="meetingdate" name="meetingdate">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Expiry Date</label>
                                            <input class="form-control" placeholder="Expiry Date" id="meetingdate" name="meetingdate">
                                        </div>
                                         

                                        <div class="form-group col-lg-12">
                                            <label style="color:red">Signatories</label>
                                            
                                        </div>
                                         <div class="form-group col-lg-6">
                                            <label>Partner Representative</label>
                                            <input class="form-control" placeholder="Representative Full Name" name="starttime" id="starttime">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Representative's Designation</label>
                                            <input class="form-control" placeholder="Representative Designation" name="starttime" id="starttime">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Representative Phone</label>
                                            <input class="form-control" placeholder="Representative Phone" name="starttime" id="starttime">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Representative's Email</label>
                                            <input class="form-control" placeholder="Representative Email" name="starttime" id="starttime">
                                        </div>

                                                                          

                                        <button type="submit" class="btn btn-success " id="submit" style="width:100%">Submit </button>


                                            <div class="messagebox alert alert-success"  id="success">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-check-circle-o"></i>
                                                    <strong><span> Success!</span></strong>
                                                    <p>New Partnership successfully added!<br /></p>
                                                </div>
                                            </div>


                                            <div class="messagebox alert alert-danger"  id="fail">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-times"></i>
                                                    <strong> Failed!</strong>
                                                    <p>The Partnership has already been added!<br /></p>
                                                </div>
                                            </div>


                                            <div class="messagebox alert alert-warning"  id="null">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-times"></i>
                                                    <strong></i> Invalid input!</strong>
                                                    <p>A required field is empty!<br /></p>
                                                </div>
                                            </div>


                                         
                            </form>

                        </div><!--modal-body-->
                    </div>
                    <!-- /.modal-content --> 
                </div>
                <!-- /.modal-dialog --> 
            </div>           
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

     <?php $this->load->view('scriptlinks/scriptlinks.php'); ?>


<script>

        

//to refresh the page
$( "#refresh").click( function(event)
        {
            window.setTimeout(function(){location.reload()},1)

        });

</script>

</body>
</html>
