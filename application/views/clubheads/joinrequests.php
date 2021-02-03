
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
         .messagebox
            {
               display: none;
               position:absolute;
               width:60%;
               top: 45%;
               left: 20%;
               z-index: 1000;
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
    #joinrequestslist th
        {
            border-bottom:2px solid;
            border-color: grey;
        }
    #joinrequestslist 
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
            @media screen and (max-width: 767px) 
            {
                .dataTables_length 
                    {
                        float:left !important;
                        margin-right:10px;
                    }
            }
            @media screen and (max-width: 767px) 
            {
                .dataTables_wrapper .dataTables_filter
                    {
                        float:left !important;
                        max-width: 150px;
                    }
            }

    </style>
       
</head>

<body>

<div id="wrapper">


        <?php  $this->load->view('clubheads/clubnavigation'); ?>
        <div id="page-wrapper" >

    
            <div class="row" >
                <div class="col-lg-12">
                    <h4 class="page-header" style="margin-top:10px;color:blue"><span><?php echo "Pending "; echo $this->session->userdata('clubName'); echo " Join Requests";?></span></h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        
        <div class="row">
            <span data-placement="top" data-toggle="tooltip" title="Refresh">
                <button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh</button>
            </span>
            <br><br>
            <div class="row">
                <div class="col-md-12">
                   <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%"  id="joinrequestslist">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Student ID</th>
                                <th class="text-center">Full name</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Course</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
            </div>
        </div>

    
        <div class="modal fade" id="approverequest" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title custom_align" id="Heading">Approve this Request</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign">     </span> Are you sure you want to approve this request?
                        </div>
                    </div>

                    <div class="modal-footer ">
                        <button type="submit" class="btn btn-success" id="approveconfirm"><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                    </div>


                    <div class="messagebox alert alert-success"  id="approvesuccess" style="display: none;position:relative;width:82%;top: 0%;left:10%;">
                            <button type="button" class="close" data-dismiss="alert"></button>
                                    <div class="cs-text">
                                            <i class="fa fa-check-circle-o"></i>
                                                <strong><span> Success!</span></strong>
                                                 <p>Request Approved<br /></p>
                                    </div>
                    </div>


                    <div class="messagebox alert alert-warning"  id="approvefail" style="display: none;position:relative;width:82%;top: 0%;left: 10%;">
                            <button type="button" class="close" data-dismiss="alert"></button>
                                    <div class="cs-text">
                                            <i class="fa fa-times-circle"></i>
                                            <strong></i> Fail!</strong>
                                        <p>Unable to approve this request!<br /></p>
                                    </div>
                    </div>

                </div>
                <!-- /.modal-content --> 
            </div>
            <!-- /.modal-dialog --> 
        </div>


        <!-- Modal -->
        <div class="modal fade" id="viewclubmember" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title" "> <b> <span id="fullname"></span></b></h4>
                        </div>
                    <div class="modal-body">
                        <center>
                        <img src="<?php echo base_url(); ?>assets/img/person.png" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
                        <h3 class="media-heading"><span id="fullname"></span> </h3>
                        <span><strong>Skills: </strong></span>
                            <span class="label label-warning">1</span>
                            <span class="label label-info">2</span>
                            <span class="label label-info">3</span>
                            <span class="label label-success">4</span>
                        </center>
                        <hr width="50%">
                        <center>
                        <table width="100%" class="table  table-hover">
                            <tr>
                                <p class="text-center"><strong>A member of </strong><span id="clubname"></span>&nbsp;</p>
                            </tr>
                            <tr>
                                <p class="text-center"><strong> Email: </strong><span id="suemail">
                            </tr>
                            <tr>
                                <p class="text-center"><strong> Phone: </strong><span id="phone">
                            </tr>
                            
                            <hr width="50%">
                            
                            <tr>
                                <p class="text-center"><strong> Admission No: </strong><span id="suid">
                            </tr>
                            <tr>
                                <p class="text-center"><strong> Course: </strong><span id="coursename">
                            </tr>
                            
                            <tr>
                                <p class="text-center"><strong> Gender: </strong><span id="gender">
                            </tr>
                            
                        </table>

                        </center>
                    </div>
                    <div class="modal-footer">
                        <center>
                        <button type="button" class="btn btn-success" data-dismiss="modal">Dismiss &nbsp;<span id="fullname"></span>'s Profile?</button>
                        </center>
                    </div>
                </div>
            </div>
        </div>


           
        </div>
        <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

     <?php $this->load->view('scriptlinks/scriptlinks.php'); ?>

<script>


   $(document).ready(function () 

   {       
            var table=$('#joinrequestslist').DataTable();
    
            $("#joinrequestslist").dataTable().fnDestroy();//destroy the table and recreate it for every refresh


                    var table=$('#joinrequestslist').DataTable({responsive:true,"iDisplayLength": 10,"lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],

                    "ajax": {
                    "url":"<?php echo base_url('index.php/ClubController/joinrequestslist')?>",
                    "type":"GET",
                    "dataType":"json"},
                    "columns": [
                    { "data": "count",responsivePriority: 1 },//define column widths
                    { "data": "suID" },
                    { "data": "fullName" ,responsivePriority: 2},
                    { "data": "telNo" },
                    { "data": "courseName" },
                    { "data": "action" }],


                    //aoColumnDefs This array allows you to target a specific column, multiple columns, or all columns, using the aTargets property of each object in the array
                    "aoColumnDefs": [
                    {"bSortable":false, "aTargets": [0], "orderable": false},
                      {"aTargets": [5],//the target column ie 5th column
                      "orderable": false,
                      "mData": "action",

                      "mRender": function ( data, type, full ) 
                      {
                        return ' <span data-placement="top" data-toggle="tooltip" title="Approve"><button class="btn btn-success btn-xs" data-title="Approve"   id="approve" onclick="approverequest(this);" value="'+data+'"><span class="fa fa-check-circle-o" ></span></button></span> &nbsp;                                                                                           <span data-placement="top" data-toggle="tooltip" title="View "><button class="btn btn-primary btn-xs" data-title="View" onclick="viewmember(this);" id="view" value="'+data+'"><span class="glyphicon glyphicon-eye-open"></span></button></span>&nbsp'; 
                      }

                        
                    },
                       
                    ],
                    order:[[ 1, 'asc' ]]//order first column:ascending

                });


              //prevent first column (counter) from being re-ordered when other fields are sorted
              table.on( 'order.dt search.dt', function () 
                 {
                    table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) 
                    {
                        cell.innerHTML = i+1;
                    } );
                } ).draw();

                table.ajax.reload( null, false ); // reload the datatable on 

    });


          

function viewmember(objButton)
{
    var pid=objButton.value;
     $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/ClubController/viewclubmember'); ?>",
                    data:{ pid:pid},
                    dataType:'json',

                    success:function(data)
                    {
                        

                        $('#viewclubmember #fullname').text(data.fullName);
                        $('#viewclubmember #suid').text(data.suID);
                        $('#viewclubmember #phone').text(data.telNo);
                        $('#viewclubmember #clubname').text(data.clubName);
                        $('#viewclubmember #coursename').text(data.courseID);
                        $('#viewclubmember #gender').text(data.gender);
                        $('#viewclubmember #suemail').text(data.suEmail);
                        
                        $('#viewclubmember').modal('toggle');

                        
                    }
                });


}
function approverequest(objButton)
{
          var table=$('#joinrequestslist').DataTable();

            $('#approverequest').modal('toggle');

        $( "#approveconfirm").on('click', function(event)
            {
            var pid=objButton.value;
            
            $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/ClubController/approverequest');?>",
                    data:{ pid:pid},
                    dataType:'json',

                    success:function(data)
                    {

                        if (data.successful)
                        {
                            $('#approvesuccess ').show();
                            $("#approvesuccess").fadeTo(2000, 500).slideUp(500, function(){
                                $("#approvesuccess").slideUp(500);
                                });

                             $("#approverequest ").fadeTo(1000, 200).slideUp(500, function(){
                                $("#approverequest ").modal('toggle');
                                });
                        
                        table.ajax.reload( null, false ); // reload the datatable on 


                        }else if (data.fail)
                        {
                            $('#approvefail').show();
                            $("#approvefail").fadeTo(2000, 500).slideUp(500, function(){
                                $("#approvefail").slideUp(500);
                                });

                                $("#approverequest ").fadeTo(1000, 200).slideUp(500, function(){
                                $("#approverequest ").modal('toggle');
                                });
                        }
                        
                    }
                });



        });
    

}
     
//to refresh the page
$( "#refresh").click( function(event)
        {
            window.setTimeout(function(){location.reload()},1)

        });

            var resizefunc = [];
 
    $(document).ready(function() {
        $('#clubmemberreg').parsley();
            });
    

    $('#clubmemberreg').submit( function(e) { 
        e.preventDefault(e);
        if ( $(this).parsley().isValid() ) {
            submitData();       
        }
    });

</script>

</body>
</html>
