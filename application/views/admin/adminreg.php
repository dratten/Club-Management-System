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
    </style>
    


</head>

<body>

<div id="wrapper">

    <?php $this->load->view('admin/adminnav.php'); ?><!--navigation -->


    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header" style="margin-top:10px;color:blue">Active Administrators</h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>


            <span data-placement="top" data-toggle="tooltip" title="Add Admin">
                    <button class="btn btn-primary btn-xs" data-title="Add Admin" data-toggle="modal" data-target="#addadmin" id="regmodal"><span class="fa fa-plus-circle"></span>&nbsp;Add Admin</button></span>
            <span data-placement="top" data-toggle="tooltip" title="Refresh">
                <button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh</button>
            </span>

             <span data-placement="top" data-toggle="tooltip" title="Print All">
                    <a class="btn btn-xs" data-title="Print All" type="button" href="#"><span class="fa fa-print"></span>&nbsp;Print All</a>
            </span>

            <br><br>
            <div class="row">
                <div class="col-md-12">
                   <table  class="table table-striped table-bordered table-hover display  responsive nowrap" cellspacing="0" width="100%"  id="adminlist">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Staff ID</th>
                                <th class="text-center">Full name</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
            </div>


                <div class="modal fade" id="addadmin" tabindex="-1" role="dialog" aria-labelledby="Add" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Add Admin </h4>
                        </div>

                        <div class="modal-body">
                            <form role="form" method="POST" action="" id="adminreg">
                                       <div class="messagebox alert alert-info" style="display:block;position:relative;width:100%;left:0%;top:0%">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <!--<div class="cs-text">
                                                    <span style="font-size: 12px;color: red;font-weight: bold">Username must be unique to see submit button</span><br />
                                                </div>-->
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label>Staff ID</label><span class="star">*</span>
                                            <input class="form-control" placeholder="Staff ID" id="staffid" name="staffid" data-parsley-type="digits" required data-parsley-length="[2,6]" placeholder="Example: 95978" autocomplete="off">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label>Surname</label><span class="star">*</span>
                                            <input class="form-control" placeholder="Example: Ngugi" name="lastname" id="lastname" parsley-trigger="change" required autocomplete="off">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label>First Name</label><span class="star">*</span>
                                            <input class="form-control" placeholder="Example: John" name="firstname" id="firstname" parsley-trigger="change" required autocomplete="off">
                                        </div>
                                          <div class="form-group col-lg-12">
                                            <label>Unique User Name</label><span class="star">*</span><span id="taken" style="display:none;color:red">Name already taken</span>
                                            <input id="username" class="form-control" placeholder="Username" name="username" type="text" required data-toggle="tooltip" title="Usernames Must be Unique">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label class="">Gender</label><span class="star">*</span><br>
                                            <label class="radio-inline ">
                                                <input type="radio" name="gender" id="gender" value="Male"  parsley-trigger="change" required autocomplete="off">Male
                                            </label>
                                            <label class="radio-inline ">
                                                <input type="radio" name="gender" id="gender" value="Female"  parsley-trigger="change" required autocomplete="off">Female
                                            </label>
                                           
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label>Email Address</label><span class="star">*</span>
                                            <input class="form-control" placeholder="Example: john.ngugi@strathmore.edu" name="emailadd" id="emailadd" parsley-type="email" required autocomplete="off">
                                        </div>
                                         <div class="form-group col-lg-12">
                                            <label>Cell Phone<span class="star">*</span></label>
                                            <input class="form-control" placeholder="Example: +254 (0) 719508386" name="phone" id="phone" parsley-trigger="change" required pattern="^[\d\+\(\)\/\s]*$" autocomplete="off" >
                                        </div>
                                         <div class="form-group col-lg-12">
                                            <label for="">Select Role</label><span class="star">*</span>
                                                <select id="role" name="role" class="form-control" parsley-trigger="change" required autocomplete="off">
                                                    <option value="">--Select Role---</option>
                                                </select>
                                        </div>
                                                                             
                                        <button type="submit" class="btn btn-success" id="submit" style="">Submit </button>
                                        <button type="reset" class="btn btn-default " id="reset">Reset </button>
                                        <button type="button" class="btn " data-dismiss="modal" aria-hidden="true">EXIT</button>
                                         

                                        <div class="messagebox alert alert-danger" id="activeofficial" >
                                            <span>
                                                    <strong>Role Conflict: </strong>An active club official cannot be a club representative
                                            </span>
                                        </div>

                                        <div class="messagebox alert alert-danger" id="duplicate" >
                                            <span>
                                                    <strong>Failed: </strong>The Admin Already Exists 
                                            </span>
                                        </div>

                                        <div class="messagebox alert alert-success" id="success" >
                                            
                                            <span>
                                                    <strong>Success: </strong>New Admin Created Successfully
                                            </span>
                                        </div>

                                         <div class="messagebox alert alert-danger" id="null" >
                                            
                                            <span>
                                                    <strong>Failed: </strong>A required field is missing
                                            </span>
                                        </div>

                            </form>

                        </div><!--modal-body-->
                    </div>
                    <!-- /.modal-content --> 
                </div>
                <!-- /.modal-dialog --> 
            </div>
           
            <div class="modal fade" id="editadmin" tabindex="-1" role="dialog" aria-labelledby="Edit" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Edit Admin </h4>
                        </div>

                        <div class="modal-body">
                            <form role="form" method="POST" action="" id="editadminreg">
                                         <div class="form-group col-lg-12" style="display: none">
                                            <label>Staff ID</label><span class="star">*</span>
                                            <input class="form-control" placeholder="Staff ID" id="staffid" name="staffid" data-parsley-type="digits" required data-parsley-length="[2,6]" placeholder="Example: 95978" autocomplete="off" readonly>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label>Surname</label><span class="star">*</span>
                                            <input class="form-control" placeholder="Example: Ngugi" name="lastname" id="lastname" parsley-trigger="change" required autocomplete="off">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label>First Name</label><span class="star">*</span>
                                            <input class="form-control" placeholder="Example: John" name="firstname" id="firstname" parsley-trigger="change" required autocomplete="off">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label class="">Gender</label><span class="star">*</span><br>
                                            <label class="radio-inline ">
                                                <input type="radio" name="gender" id="gender" value="Male"  parsley-trigger="change" required autocomplete="off">Male
                                            </label>
                                            <label class="radio-inline ">
                                                <input type="radio" name="gender" id="gender" value="Female"  parsley-trigger="change" required autocomplete="off">Female
                                            </label>
                                           
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label>Email Address</label><span class="star">*</span>
                                            <input class="form-control" placeholder="Example: john.ngugi@strathmore.edu" name="emailadd" id="emailadd" parsley-type="email" required autocomplete="off">
                                        </div>

                                         <div class="form-group col-lg-12">
                                            <label>Cell Phone<span class="star">*</span></label>
                                            <input class="form-control" placeholder="Example: +254 (0) 719508386" name="phone" id="phone" parsley-trigger="change" required pattern="^[\d\+\(\)\/\s]*$" autocomplete="off" >
                                        </div>

                                         <div class="form-group col-lg-12">
                                            <label for="">Select Role</label><span class="star">*</span>
                                                <select id="role" name="role" class="form-control" parsley-trigger="change" required autocomplete="off">
                                                    <option value="">--Select Role---</option>
                                                </select>
                                        </div>
                                       
                                        <button type="submit" class="btn btn-success" id="submit" >Submit </button>
                                        <button type="reset" class="btn btn-default " id="reset">Reset </button>
                                        <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">EXIT</button>



                                        <div class="messagebox alert alert-success" id="success" >
                                            
                                            <span>
                                                    <strong>Success: </strong>Admin info updated.
                                            </span>
                                        </div>

                                         <div class="messagebox alert alert-info" id="nochange" >
                                            
                                            <span>
                                                    <strong>No Changes Made: </strong> You did not make any changes.
                                            </span>
                                        </div>

                                         <div class="messagebox alert alert-danger" id="null" >
                                            
                                            <span>
                                                    <strong>Failed: </strong>A required field is missing
                                            </span>
                                        </div>

                            </form>

                        </div><!--modal-body-->
                    </div>
                    <!-- /.modal-content --> 
                </div>
                <!-- /.modal-dialog --> 
            </div>
           
             <div class="modal fade" id="deleteadmin" tabindex="-1" role="dialog" aria-labelledby="Delete Admin" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Delete this Administrator</h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign">     </span> Are you sure you want to delete this admin?
                            </div>
                        </div>
      
                        </style>

                        <div class="messagebox alert alert-danger" id="deletesuccess"  style="display: none;position:relative;width:82%;top: 0%;left: 0%;">
                            <span>
                                <strong>Deleted: </strong>Admin has been deleted.
                            </span>
                        </div>

                        <div class="messagebox alert alert-danger" id="deletefail"  style="display: none;position:relative;width:82%;top: 0%;left: 0%;">
                            <span>
                                <strong>Failed: </strong>Admin was not deleted
                            </span>
                        </div>

                        <div class="modal-footer ">
                            <button type="submit" class="btn btn-danger" id="deleteadminconfirm"><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                            <button type="button" class="btn " data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                        </div>

                        

                    </div>
                    <!-- /.modal-content --> 
                </div>
                <!-- /.modal-dialog --> 
            </div>


             <!-- Modal -->
        <div class="modal fade" id="viewadmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"> <b> <span id="fullname"></span></b></h4>
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
                            <p class="text-center"><strong><span id="rolename"></span></strong></p>
                        </tr>
                        <tr>
                            <p class="text-center"><strong> Email: </strong><span id="suemail">
                        </tr>
                        <tr>
                            <p class="text-center"><strong> Phone: </strong><span id="phone">
                        </tr>
                        
                        <hr width="50%">
                        
                        <tr>
                            <p class="text-center"><strong> Staff No: </strong><span id="suid">
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

            <div class="modal fade" id="disableadmin" tabindex="-1" role="dialog" aria-labelledby="Disable Admin" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Disable this Administrator</h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign">     </span> Are you sure you want to disable this admin?
                            </div>
                        </div>
      
                        </style>

                        <div class="messagebox alert alert-danger" id="disablesuccess"  style="display: none;position:relative;width:82%;top: 0%;left: 0%;">
                            <span>
                                <strong>Disabled: </strong>Admin has been disabled.
                            </span>
                        </div>

                        <div class="messagebox alert alert-danger" id="disablefail"  style="display: none;position:relative;width:82%;top: 0%;left: 0%;">
                            <span>
                                <strong>Failed: </strong>Admin was not disabled.
                            </span>
                        </div>

                        <div class="modal-footer ">
                            <button type="submit" class="btn btn-danger" id="disableadminconfirm"><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                            <button type="button" class="btn" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                        </div>

                        

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

$(document).ready(function () 

   {
    
            $("#adminlist").dataTable().fnDestroy();//destroy the table and recreate it for every refresh


                    var table=$('#adminlist').DataTable({responsive:true,"iDisplayLength": 10,"lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],

                    "ajax": {
                    "url":"<?php echo base_url('index.php/Home/adminlist');?>",
                    "type":"GET",
                    "dataType":"json"},
                    "columns": [
                    { "data": "count",responsivePriority: 1 },//define column widths
                    { "data": "staffID" },
                    { "data": "fullName" ,responsivePriority: 2},
                    { "data": "phone" },
                    { "data": "role" ,responsivePriority: 3},
                    { "data": "action" }],


                    //aoColumnDefs This array allows you to target a specific column, multiple columns, or all columns, using the aTargets property of each object in the array
                    "aoColumnDefs": [
                    {"bSortable":false, "aTargets": [0], "orderable": false},
                    {"aTargets": [4], "sWidth": "30%"},
                      {"aTargets": [5],//the target column ie 5th column
                      "orderable": false, "sWidth": "20%",
                      "mData": "action",

                      "mRender": function ( data, type, full ) 
                      {
                        return ' <span data-placement="top" data-toggle="tooltip" title="Delete Admin"><button class="btn btn-danger btn-xs" data-title="Delete Admin"   id="delete" onclick="deleteadmin(this);" value="'+data+'"><span class="glyphicon glyphicon-trash" ></span></button></span> &nbsp;                                                                                                                                                                <span data-placement="top" data-toggle="tooltip" title="Edit Admin"><button class="btn  btn-xs" data-title="Edit Admin" onclick="editadmin(this);" id="edit" value="'+data+'"><span class="glyphicon glyphicon-pencil"></span></button></span>&nbsp;                                                                                                                                                                                <span data-placement="top" data-toggle="tooltip" title="View Admin"><button class="btn  btn-xs" data-title="View" onclick="viewadmin(this);" id="view" value="'+data+'"><span class="glyphicon glyphicon-eye-open"></span></button></span>&nbsp                                                                                                                                           <span data-placement="top" data-toggle="tooltip" title="Disable Admin"><button class="btn  btn-xs" data-title="Deactivate Admin" onclick="disableadmin(this);" id="deactivate" value="'+data+'"><span class="fa fa-user-times"></span></button></span>&nbsp'; 
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

 //=======================================================================================


function submitData()
    {


           var table=$('#adminlist').DataTable();

            //assign input values to variables for posting
           var staffid= $("#adminreg input[name=staffid]").val();
           var role= $("#adminreg #role").val();
           var firstname= $("#adminreg input[name=firstname]").val();
           var lastname= $("#adminreg input[name=lastname]").val();
           var emailadd= $("#adminreg input[name=emailadd]").val();
           var phone= $("#adminreg input[name=phone]").val();
           var gender= $("#adminreg input[name=gender]:checked").val();
           var username= $("#adminreg input[name=username]").val();
           
            $.ajax(//ajax script to post the data without page refresh
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/Home/adminregistration')?>",
                    data:{ staffid:staffid,username:username,role:role,firstname:firstname, lastname:lastname,emailadd:emailadd,phone:phone,gender:gender},
                    dataType:'json',

                    success:function(data)
                    {
                       //get json encoded feedback upon submission and respond appropriately
                       if (data.successful)
                        {
                            //if success is returned upon submission, show the success notification
                            $('#adminreg #success').show();
                            //fade away the notification after 2000 milliseconds
                            $("#adminreg #success").fadeTo(2000, 500).slideUp(500, function(){
                                $("#adminreg #success").slideUp(500);
                                });
                            
                                table.ajax.reload( null, false ); // reload the datatable on 
                            

                        }else if (data.fail)
                        {
                            $('#adminreg #fail').show();
                            $("#adminreg #fail").fadeTo(2000, 500).slideUp(500, function(){
                                $("#adminreg #fail").slideUp(500);
                                });
                           
                        }else if (data.null)
                        {
                            $('#adminreg #null').show();
                            $("#adminreg #null").fadeTo(2000, 500).slideUp(500, function(){
                                $("#adminreg #null").slideUp(500);
                                });
                            
                        }else if (data.duplicate)
                        {
                            $('#adminreg #duplicate').show();
                            $("#adminreg #duplicate").fadeTo(2000, 500).slideUp(500, function(){
                                $("adminreg #duplicate").slideUp(500);
                                });
                        }else if (data.activeofficial)
                        {
                            $('#adminreg #activeofficial').show();
                            $("#adminreg #activeofficial").fadeTo(2000, 500).slideUp(500, function(){
                                $("adminreg #activeofficial").slideUp(500);
                                });
                        }

                    }
                });
              
    }



function update()
    {


            var table=$('#adminlist').DataTable();

            //assign input values to variables for posting
           var staffid= $("#editadminreg input[name=staffid]").val();
           var role= $("#editadminreg #role").val();
           var firstname= $("#editadminreg input[name=firstname]").val();
           var lastname= $("#editadminreg input[name=lastname]").val();
           var emailadd= $("#editadminreg input[name=emailadd]").val();
           var phone= $("#editadminreg input[name=phone]").val();
           var gender= $("#editadminreg input[name=gender]:checked").val();

            $.ajax(//ajax script to post the data without page refresh
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/Home/updateadmin')?>",
                    data:{ staffid:staffid,role:role,firstname:firstname, lastname:lastname,emailadd:emailadd,phone:phone,gender:gender},
                    dataType:'json',

                    success:function(data)
                    {
                       //get json encoded feedback upon submission and respond appropriately
                       if (data.successful)
                        {
                            //if success is returned upon submission, show the success notification
                            $('#editadminreg #success').show();
                            //fade away the notification after 2000 milliseconds
                            $("#editadminreg #success").fadeTo(2000, 500).slideUp(500, function(){
                                $("#editadminreg #success").slideUp(500);
                                });
                            
                                table.ajax.reload( null, false ); // reload the datatable on 
                            

                        }else if (data.nochange)
                        {
                            $('#editadminreg #nochange').show();
                            $("#editadminreg #nochange").fadeTo(2000, 500).slideUp(500, function(){
                                $("#editadminreg #nochange").slideUp(500);
                                });
                           
                        }else if (data.null)
                        {
                            $('#editadminreg #null').show();
                            $("#editadminreg #null").fadeTo(2000, 500).slideUp(500, function(){
                                $("#editadminreg #null").slideUp(500);
                                });
                            
                        }

                    }
                });
              
    }


function deleteadmin(objButton)
    {

        $('#deleteadmin').modal('toggle');

        $( "#deleteadminconfirm").one('click', function(event)
            {
                
                var table=$('#adminlist').DataTable();

                var userID=objButton.value;
            
                $.ajax(
                    {
                        type:"post",
                        url: "<?php echo base_url('index.php/Home/deleteadmin');?>",
                        data:{ userID:userID},
                        dataType:'json',

                        success:function(data)
                        {
                            // console.log(data);
                           if (data.successful)
                            {
                                $('#deleteadmin #deletesuccess').show();
                                $("#deleteadmin #deletesuccess").fadeTo(2000, 500).slideUp(500, function(){
                                    
                                        $("#deleteadmin #deletesuccess").slideUp(500);
                                    });

                                    $("#deleteadmin ").fadeTo(1000, 200).slideUp(500, function(){
                                        $("#deleteadmin ").modal('toggle');
                                    });

                                table.ajax.reload( null, false ); // reload the datatable on 

                                

                            }else if (data.fail)
                            {
                                $('#deleteadmin #deletefail ').show();
                                $("#deleteadmin #deletefail ").fadeTo(2000, 500).slideUp(500, function(){
                                    $("#deleteadmin #deletefail ").slideUp(500);
                                    });

                                $("#deleteadmin ").fadeTo(1000, 200).slideUp(500, function(){
                                        $("#deleteadmin ").modal('toggle');
                                    });
                               
                            }
                        }
                    });
            });
    }

function editadmin(objButton)
        {
            var id=objButton.value;

             $.ajax(
                    {
                    type:"post",
                    url: "<?php echo base_url('index.php/Home/getadmin'); ?>",
                    data:{ id:id},
                    dataType:'json',

                    success:function(data)
                    {
                        
                        $('#editadminreg #staffid').val(data.staffID);
                        $('#editadminreg #firstname').val(data.firstName);
                        $('#editadminreg #lastname').val(data.lastName);
                        $('#editadminreg #phone').val(data.telNo);
                        $('#editadminreg #emailadd').val(data.suEmail);

                        $('#editadminreg #role').empty();
                        
                        var roleID=data.roleID;
                        var roleName=data.roleName;
                        var opt = $('<option />');
                            opt.val(roleID);
                            opt.text(roleName);

                        $('#editadminreg #role').append(opt);

                        var gender=data.gender;
                                if (gender=="Male")
                                {
                                      $('#editadminreg input[name=gender]')[0].checked=true;
                                }else if (gender=="Female") {
                                      $('#editadminreg input[name=gender]')[1].checked=true;
                                }else 
                                {
                                      $('#editadminreg input[name=gender]')[0].checked=false;
                                      $('#editadminreg input[name=gender]')[1].checked=false;
                                }

                        $('#editadmin').modal('toggle');

                        //automatically click on the inputs for smooth dropdown lists
                        $('#editadminreg #role').click();
                        
                    }
                });
    }


$( "#editadminreg #role").on('click', function(event)
        {
         
            $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/Home/admrolesdropdown'); ?>",
                    dataType:'json',

                    success:function(data)
                    {
                       //populate the clubs dropdown list on edit
                         $.each(data,function(roleID,roleName)
                            {


                                var opt = $('<option />').empty(); 

                                opt.val(roleID);
                                opt.text(roleName);

                                $('#editadminreg #role').append(opt);  

                            });
                                    

                        //this code removes duplicates from the list above
                        var seen = {};
                        jQuery('editadminreg #role').children().each(function() 
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



$( "#regmodal").on('click', function(event)
        {
         
            $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/Home/admrolesdropdown'); ?>",
                    dataType:'json',

                    success:function(data)
                    {
                       //populate the clubs dropdown list on edit
                         $.each(data,function(roleID,roleName)
                            {


                                var opt = $('<option />').empty(); 

                                opt.val(roleID);
                                opt.text(roleName);

                                $('#adminreg #role').append(opt);  

                            });
                                    

                        //this code removes duplicates from the list above
                        var seen = {};
                        jQuery('adminreg #role').children().each(function() 
                        {
                            var txt = jQuery(this).clone().wrap('<select>').parent().html();
                            if (seen[txt]) {
                                jQuery(this).remove();
                            } else {
                                seen[txt] = true;
                            }

                        }); 

                            //sort the roles dropdown list 
                                var options = $('#adminreg #role option');
                                    var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
                                    arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
                                    options.each(function(i, o) {
                                      o.value = arr[i].v;
                                      $(o).text(arr[i].t);
                                    });

                               //this code removes duplicates from the list above
                                var seen = {};
                                jQuery('#adminreg #role').children().each(function() 
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

function viewadmin(objButton)
    {
        var id=objButton.value;
         $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/Home/getadmin'); ?>",
                    data:{ id:id},
                    dataType:'json',

                    success:function(data)
                    {
                        
                        $('#viewadmin #fullname').text(data.firstName +" "+ data.lastName);
                        $('#viewadmin #suid').text(data.staffID);
                        $('#viewadmin #phone').text(data.telNo);
                        $('#viewadmin #gender').text(data.gender);
                        $('#viewadmin #suemail').text(data.suEmail);
                        $('#viewadmin #rolename').text(data.roleName);
                        
                        $('#viewadmin').modal('toggle');
                        
                    }
                });


    }



function disableadmin(objButton)
{
    
    $('#disableadmin').modal('toggle');
        
        var table=$('#adminlist').DataTable();


    $( "#disableadminconfirm").one('click',function(event)
        {
            event.preventDefault(event);
            var id=objButton.value;

            $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url(); ?>Home/disableadmin",
                    data:{ id:id},
                    dataType:'json',

                    success:function(data)
                    {

                        if (data.successful)
                        {

                            $('#disableadmin #disablesuccess ').show();
                            $("#disableadmin #disablesuccess").fadeTo(2000, 500).slideUp(500, function(){
                                $("#disableadmin #disablesuccess").slideUp(500);
                                });

                                $("#disableadmin ").fadeTo(1000, 200).slideUp(500, function(){
                                        $("#disableadmin ").modal('toggle');
                                    });

                        table.ajax.reload( null, false ); // reload the datatable 
                             

                        }else if (data.fail)
                        {
                            $('#disableadmin #disablefail').show();
                            $("#disableadmin #disablefail").fadeTo(2000, 500).slideUp(500, function(){
                                $("#disableadmin #disablefail").slideUp(500);
                                });

                                $("#disableadmin ").fadeTo(1000, 200).slideUp(500, function(){
                                        $("#disableadmin ").modal('toggle');
                                    });
                        }
                        
                    }
                });



        });
    

}

        // }
//to refresh the page
$( "#refresh").click( function(event)
        {
            window.setTimeout(function(){location.reload()},1)

        });


    

    var resizefunc = [];

    $(document).ready(function() {
        $('#adminreg').parsley();
        $('#editadminreg').parsley();
            });
    

    $('#adminreg').submit( function(e) { 
        e.preventDefault(e);
        if ( $(this).parsley().isValid() ) {
            submitData();       
        }
    });


    $('#editadminreg').submit( function(e) { 
        e.preventDefault(e);
        if ( $(this).parsley().isValid() ) {
            update();       
        }
    });



$(function() {                     
    $( "#username" ).autocomplete({ //the recipient text field with id #username
        source: function( request, response ) {
            $.ajax({
                url: "<?php echo base_url(); ?>Home/checkusername",
                dataType: "json",
                data: request,
                success: function(data){
                    if(data.response == 'true') {
                       // response(data.message);
                       $('#taken').show();
                       $('#submit').hide();
                       
                    }else {$('#submit').show();$('#taken').hide();}
                }
            });
        },
        minLength: 1,
        select: function( event, ui ) {
            //Do something extra on select... Perhaps add user id to hidden input    
        },

    });
}); 

</script>

</body>
</html>
