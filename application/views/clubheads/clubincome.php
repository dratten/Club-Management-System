
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
    #clubincomelist th
        {
            border-bottom:2px solid;
            border-color: grey;
        }
    #clubincomelist
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
                <div class="col-lg-12">
                    <h4 class="page-header" style="margin-top:10px;color:blue"><?php  echo $this->session->userdata('clubName'); echo " Income";?></span><span style="color:red">: Feature Coming Soon...</span></h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <span data-placement="top" data-toggle="tooltip" title="Add Income">
                    <button class="btn btn-primary btn-xs" data-title="Add Income" data-toggle="modal" data-target="#addincome" ><span class="fa fa-plus-circle"></span>&nbsp;Add Income</button></span>
            <span data-placement="top" data-toggle="tooltip" title="Refresh ">
                <button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh</button>
            </span>

             <span data-placement="top" data-toggle="tooltip" title="Print All">
                    <a class="btn btn-xs" data-title="Print All" type="button" href="#"><span class="fa fa-print"></span>&nbsp;Print All</a>
            </span>


            <br><br>
            <div class="row">
                <div class="col-md-12">
                   <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%"  id="clubincomelist">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Date Received</th>
                                <th class="text-center">Amount Received</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Action</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
            </div>

             <div class="modal fade" id="addincome" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Add Income </h4>
                        </div>

                        <div class="modal-body">
                            <form role="form" method="POST" action="" id="clubincome">
                                       <div class="form-group col-lg-6">
                                            <label>Date Received</label>
                                            <input class="form-control" placeholder="Date Received" name="datereceived" id="datereceived" type="date">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Amount Received</label>
                                            <input class="form-control" placeholder="Amount Received" name="amountreceived" id="amountreceived" type="number">
                                        </div>
                                        
                                        
                                        <div class="form-group col-lg-12">
                                            <label>Income Description</label>
                                            <textarea class="form-control" placeholder="Income Description" name="incomedesc" id="incomedesc"></textarea>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Invoice Upload</label> 
                                            <input class="form-control" placeholder="Upload Invoice" name="invoiceupload" id="invoiceupload" type="file">
                                        </div>
                                         <div class="form-group col-lg-6">
                                            <label></label> <br>

                                            <button class="btn  " id="upload" >Attach File </button>
                                           
                                        </div>  
                                                                          

                                        <button type="submit" class="btn btn-success" id="submit" >Submit </button>
                                        <button type="reset" class="btn btn-default " id="reset">Reset </button>
                                        <button type="button" class="btn " data-dismiss="modal" aria-hidden="true">EXIT</button>


                                            <div class="messagebox alert alert-success"  id="success">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-check-circle-o"></i>
                                                    <strong><span> Success!</span></strong>
                                                    <p>New Expense successfully added!<br /></p>
                                                </div>
                                            </div>


                                            <div class="messagebox alert alert-danger"  id="fail">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-times"></i>
                                                    <strong> Failed!</strong>
                                                    <p>Failed to record expense!<br /></p>
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
