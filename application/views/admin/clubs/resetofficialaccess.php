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

     
}
    </style>
    
   

</head>

<body>

<div id="wrapper">

    <?php $this->load->view('admin/adminnav.php'); ?><!--navigation -->


    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header" style="margin-top:10px;color:blue;">Reset Club Official's Password</h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <span data-placement="top" data-toggle="tooltip" title="Refresh ">
                <button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh</button>
            </span>

             <span data-placement="top" data-toggle="tooltip" title="Print All">
                    <a class="btn btn-xs" data-title="Print All" type="button" href="<?php echo base_url('Home/clubofficialspdf');?>"><span class="fa fa-print"></span>&nbsp;Print All</a>
            </span>


            <br><br>
            <div class="row">
                <div class="col-md-12">
                    <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%" id="clubofficialslist"  >
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">SU ID</th>
                                <th class="text-center">Full name</th>
                                <th class="text-center">Club</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody >
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
            </div>

      <!-- Modal -->
      <div class="modal fade" id="viewclubofficial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                            <p class="text-center"><strong><span id="rolename"></span></strong>&nbsp;of &nbsp;<span id="clubname"></span>&nbsp;since &nbsp;<span id="startdate"></span></p>
                        </tr>
                        <tr>
                            <p class="text-center"><strong> Email: </strong><span id="suemail">
                        </tr>
                        <tr>
                            <p class="text-center"><strong> Phone: </strong><span id="phone">
                        </tr>
                        
                        <hr width="50%">
                        
                        <tr>
                            <p class="text-center"><strong> Student No: </strong><span id="suid">
                        </tr>
                         <tr>
                            <p class="text-center"><strong> Course: </strong><span id="coursename">
                        </tr>
                        <tr>
                            <p class="text-center"><strong> Gender: </strong><span id="gender">
                        </tr>

                        <hr width="50%">
                        
                        <tr>
                            <p class="text-center"><strong> Username: </strong><span id="username">
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



        <!-- Modal -->
        <div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                
                <div class="alert alert-success">
                      <p class="text-center"><strong >Success:</strong> Password reset successfully</p>
                  
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="fail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                
                <div class="alert alert-danger">
                      <p class="text-center"><strong >Fail:</strong> Password has not been changed since last reset!</p>
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
    
            $("#clubofficialslist").dataTable().fnDestroy();//destroy the table and recreate it for every refresh
                    var table=$('#clubofficialslist').DataTable({responsive:true,"iDisplayLength": 5,"lengthMenu": [[5, 25, 50, 100, 200, -1], [5, 25, 50, 100, 200, "All"]],

                    //ajax script to retrieve data club officials from db
                    "ajax": {
                    "url":"<?php echo base_url('Home/clubofficialslist'); ?>",
                    "type":"POST",
                    "dataType":"json"},
                    "columns": [
                    { "data": "count",responsivePriority: 1 },//define column widths
                    { "data": "suID" ,responsivePriority: 4},
                    { "data": "fullName",responsivePriority: 2 },
                    { "data": "clubName" },
                    { "data": "roleName" ,responsivePriority: 3},
                    { "data": "action" }],

                    //aoColumnDefs This array allows you to target a specific column, multiple columns, or all columns, using the aTargets property of each object in the array
                    "aoColumnDefs": [
                    {"bSortable":false, "aTargets": [0], "orderable": false},
                      {"aTargets": [5],//the target column ie 7th column
                      "orderable": false,
                      "mData": "action",

                      "mRender": function ( data, type, full ) 
                      {
                        return '<span data-placement="top" data-toggle="tooltip" title="View Profile"><button class="btn btn-xs" data-title="View Profile" onclick="c_o_view(this);" id="view" value="'+data+'"><span class="glyphicon glyphicon-eye-open"></span></button></span>&nbsp; <span data-placement="top" data-toggle="tooltip" title="Reset Password"><button class="btn btn-primary btn-xs" data-title="Reset Password" onclick="pwdreset(this);" id="'+data+'_pwdreset" value="'+data+'"><span class="fa fa-unlock"></span></button></span>&nbsp;';

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
              
                table.ajax.reload( null, false ); // reload the datatable 

                //tool tip whenever username field is focused
       


    });



function pwdreset(objButton)
{
    var id=objButton.value;
        $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url(); ?>LoginCtrl/clubofficialpwdreset",
                    data:{ id:id },
                    dataType:'json',

                    success:function(data)
                    {
                        // console.log(data);
                        if(data.successful)
                            {
                              $("#success ").fadeTo(2000, 200).slideUp(500, function(){});

                            }else if(data.fail) 
                                    {
                                        $("#fail").fadeTo(2000, 200).slideUp(500, function(){});                                    }
                        
                    }
                });

}


function c_o_view(objButton)
{
    var id=objButton.value;
 
     $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url(); ?>Home/viewclubofficial",
                    data:{ id:id},
                    dataType:'json',

                    success:function(data)
                    {
                        // console.log(data);
                        $('#viewclubofficial #fullname').text(data.firstName+' '+data.lastName);
                        $('#viewclubofficial #suid').text(data.suID);
                        $('#viewclubofficial #phone').text(data.telNo);
                        $('#viewclubofficial #clubname').text(data.clubName);
                        $('#viewclubofficial #rolename').text(data.roleName);
                        $('#viewclubofficial #coursename').text(data.courseName);
                        $('#viewclubofficial #gender').text(data.gender);
                        $('#viewclubofficial #suemail').text(data.suEmail);

                        $('#viewclubofficial #username').text(data.userName);

                        if(data.startDate=="")
                        {
                            $('#viewclubofficial #startdate').text(data.startDate+'____')
                        }else
                        {
                            $('#viewclubofficial #startdate').text(data.startDate)
                        }

                        $('#viewclubofficial').modal('toggle');

                        
                    }
                });


}

//to refresh the page
$( "#refresh").click( function(event)
        {
            window.setTimeout(function(){location.reload()},1)

        });

    </script>




</body>
</html>
