
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
    #clubmemberslist th
        {
            border-bottom:2px solid;
            border-color: grey;
        }
    #clubmemberslist 
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
                    <h4 class="page-header" style="margin-top:10px;color:blue"><span><?php echo "Current "; echo $this->session->userdata('clubName'); echo " Members";?></span></h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        
        <div class="row">
            <span data-placement="top" data-toggle="tooltip" title="Add Club Member">
                    <button class="btn btn-primary btn-xs" data-title="Add Club Member" data-toggle="modal" data-target="#addclubmember" id="regmodal"><span class="fa fa-plus-circle"></span>&nbsp;Add Member</button></span>
            <span data-placement="top" data-toggle="tooltip" title="Refresh">
                <button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh</button>
            </span>

             <span data-placement="top" data-toggle="tooltip" title="Print All">
                    <a class="btn btn-xs" data-title="Print All" type="button" href="<?php echo base_url('index.php/ClubController/clubmemberspdf')?>"><span class="fa fa-print"></span>&nbsp;Print All</a>
            </span>
            <span data-placement="top" data-toggle="tooltip" title="Print Paid">
                    <a class="btn btn-xs" data-title="Print Paid" type="button" href="<?php echo base_url('index.php/ClubController/registeredclubmemberspdf')?>"><span class="fa fa-print"></span>&nbsp;Print Paid</a>
            </span>

            <br><br>
            <div class="row">
                <div class="col-md-12">
                   <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%"  id="clubmemberslist">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Student ID</th>
                                <th class="text-center">Full name</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Course</th>
                                <th class="text-center">Payment</th>
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
    

        <div class="modal fade" id="addclubmember" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Add Club Member </h4>
                        </div>

                        <div class="modal-body">
                            <form role="form" method="POST" action="" id="clubmemberreg" autocomplete="off">
                                        <div class="form-group col-lg-12">
                                            <label>Student ID<span class="star">*</span></label> <!-- <span id="num" class="fa fa-asterisk" style="color:#FF0004;font-size: 10px" > --><!-- </span>  -->
                                            <input class="form-control" id="suid" name="suid" data-parsley-type="digits" required data-parsley-length="[2,6]" placeholder="Example: 78581" autocomplete="off">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label>Surname<span class="star">*</span></label>
                                            <input class="form-control" placeholder="Example: Mokoro" name="lastname" id="lastname" parsley-trigger="change" required >
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label>First Name<span class="star">*</span></label>
                                            <input class="form-control" placeholder="Example: Stephen" name="firstname" id="firstname" parsley-trigger="change" required autocomplete="off">
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label class="">Gender<span class="star">*</span></label><br>
                                            <label class="radio-inline ">
                                                <input type="radio" name="gender" id="gender" value="Male" parsley-trigger="change" required autocomplete="off">Male
                                            </label>
                                            <label class="radio-inline ">
                                                <input type="radio" name="gender" id="gender" value="Female" parsley-trigger="change" required autocomplete="off">Female
                                            </label><br><br>
                                           
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label>SU Email<span class="star">*</span></label>
                                            <input type="email" class="form-control" placeholder="Example: stephen.mokoro@strathmore.edu" name="suemail" id="suemail" parsley-type="email" required autocomplete="off">
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label>Cell Phone<span class="star">*</span></label>
                                            <input class="form-control" placeholder="Example: +254 (0) 719508386" name="phone" id="phone" parsley-trigger="change" required pattern="^[\d\+\(\)\/\s]*$" autocomplete="off">
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label for="">Select Course<span class="star">*</span></label>
                                                <select id="course" name="course" class="form-control"  required>
                                                </select>
                                        </div> 
                                         <div class="form-group col-lg-12">
                                            <label class="">Payment<span class="star">*</span></label><br>
                                            <label class="radio-inline ">
                                                <input type="radio" name="payment" id="payment" value="1" parsley-trigger="change" required autocomplete="off">Paid
                                            </label>
                                            <label class="radio-inline ">
                                                <input type="radio" name="payment" id="payment" value="0" parsley-trigger="change" required autocomplete="off">Not Paid
                                            </label><br><br> 
                                          </div>                                
                                  

                                        <button type="submit" class="btn btn-success" id="submit" >Submit </button>
                                        <button type="reset" class="btn btn-default " id="reset">Reset </button>
                                        <button type="button" class="btn " data-dismiss="modal" aria-hidden="true">EXIT</button>



                                            <div class="messagebox alert alert-success"  id="success">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-check-circle-o"></i>
                                                    <strong><span> Success!</span></strong>
                                                    <p>New Club Member Successfully Registered!<br /></p>
                                                </div>
                                            </div>


                                            <div class="messagebox alert alert-danger"  id="fail">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-times"></i>
                                                    <strong> Registration Failed!</strong>
                                                    <p>The member is already registered and active!<br /></p>
                                                </div>
                                            </div>

                                             <div class="messagebox alert alert-info"  id="inactive">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-times"></i>
                                                    <strong> Registration Failed!</strong>
                                                    <p>The member is already registered and but inactive. Please consider activating him/her<br /></p>
                                                </div>
                                            </div>

                                             <div class="messagebox alert alert-warning"  id="error">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-times"></i>
                                                    <strong></i> Invalid Input!</strong>
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
           

            <div class="modal fade" id="editclubmember" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Edit Club Member </h4>
                        </div>

                        <div class="modal-body">
                            <form role="form" method="POST" action="" id="editclubmemberreg" autocomplete="off">
                                         <div class="form-group col-lg-6" style="display:none;position: absolute;">
                                            <label>ID</label>
                                            <input class="form-control" placeholder="PID" id="pid" name="pid">
                                        </div>
                                          <div class="form-group col-lg-12">
                                            <label>Student ID<span class="star">*</span></label> <!-- <span id="num" class="fa fa-asterisk" style="color:#FF0004;font-size: 10px" > --><!-- </span>  -->
                                            <input class="form-control" id="suid" name="suid" data-parsley-type="digits" required data-parsley-length="[2,6]" placeholder="Example: 78581" autocomplete="off">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label>Surname<span class="star">*</span></label>
                                            <input class="form-control" placeholder="Example: Mokoro" name="lastname" id="lastname" parsley-trigger="change" required >
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label>First Name<span class="star">*</span></label>
                                            <input class="form-control" placeholder="Example: Stephen" name="firstname" id="firstname" parsley-trigger="change" required autocomplete="off">
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label class="">Gender<span class="star">*</span></label><br>
                                            <label class="radio-inline ">
                                                <input type="radio" name="gender" id="gender" value="Male" parsley-trigger="change" required autocomplete="off">Male
                                            </label>
                                            <label class="radio-inline ">
                                                <input type="radio" name="gender" id="gender" value="Female" parsley-trigger="change" required autocomplete="off">Female
                                            </label><br><br>
                                           
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label>SU Email<span class="star">*</span></label>
                                            <input type="email" class="form-control" placeholder="Example: stephen.mokoro@strathmore.edu" name="suemail" id="suemail" parsley-type="email" required autocomplete="off">
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label>Cell Phone<span class="star">*</span></label>
                                            <input class="form-control" placeholder="Example: +254 (0) 719508386" name="phone" id="phone" parsley-trigger="change" required pattern="^[\d\+\(\)\/\s]*$" autocomplete="off" >
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label for="">Select Course<span class="star">*</span></label>
                                                <select id="course" name="course" class="form-control"  required ><span class="star">*</span>
                                                </select>
                                        </div> 
                                         <div class="form-group col-lg-12">
                                            <label class="">Payment<span class="star">*</span></label><br>
                                            <label class="radio-inline ">
                                                <input type="radio" name="payment" id="payment" value="1" parsley-trigger="change" required autocomplete="off" >Paid
                                            </label>
                                            <label class="radio-inline ">
                                                <input type="radio" name="payment" id="payment" value="0" parsley-trigger="change" required autocomplete="off">Not Paid<span class="star">*</span>
                                            </label><br><br> 
                                          </div>                   
                                    
                                        <button type="submit" class="btn btn-success" id="submit" >Submit </button>
                                        <button type="reset" class="btn btn-default " id="reset">Reset </button>
                                        <button type="button" class="btn " data-dismiss="modal" aria-hidden="true">EXIT</button>

                                        
                                         <div class="messagebox alert alert-success"  id="success">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-check-circle-o"></i>
                                                    <strong><span> Success!</span></strong>
                                                    <p>Club member info successfully updated!<br /></p>
                                                </div>
                                            </div>


                                             <div class="messagebox alert alert-warning"  id="null">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-times"></i>
                                                    <strong></i> Invalid Input!</strong>
                                                    <p>A required field is empty!<br /></p>
                                                </div>
                                            </div>
                                            <div class="messagebox alert alert-warning"  id="nochange">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-times"></i>
                                                    <strong></i> No change!</strong>
                                                    <p>No changes were made!<br /></p>
                                                </div>
                                            </div>

                                         
                            </form>

                        </div><!--modal-body-->
                    </div>
                    <!-- /.modal-content --> 
                </div>
                <!-- /.modal-dialog --> 
            </div>



            
    

    
        <div class="modal fade" id="deleteclubmember" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title custom_align" id="Heading">Delete this club member?</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign">     </span> Are you sure you want to delete this club member?
                        </div>
                    </div>

                    <div class="modal-footer ">
                        <button type="submit" class="btn btn-success" id="deleteclubmemberconfirm"><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                    </div>


                    <div class="messagebox alert alert-success"  id="deletesuccess" style="display: none;position:relative;width:82%;top: 0%;left:10%;">
                            <button type="button" class="close" data-dismiss="alert"></button>
                                    <div class="cs-text">
                                            <i class="fa fa-check-circle-o"></i>
                                                <strong><span> Success!</span></strong>
                                                 <p>Club member was successfully deleted!<br /></p>
                                    </div>
                    </div>


                    <div class="messagebox alert alert-warning"  id="detetefail" style="display: none;position:relative;width:82%;top: 0%;left: 10%;">
                            <button type="button" class="close" data-dismiss="alert"></button>
                                    <div class="cs-text">
                                            <i class="fa fa-info-circle"></i>
                                            <strong></i> Fail!</strong>
                                    <p>Unable to delete club member!<br /></p>
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
            var table=$('#clubmemberslist').DataTable();
    
            $("#clubmemberslist").dataTable().fnDestroy();//destroy the table and recreate it for every refresh


                    var table=$('#clubmemberslist').DataTable({responsive:true,"iDisplayLength": 10,"lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],

                    "ajax": {
                    "url":"<?php echo base_url('index.php/ClubController/clubmemberslist');?>",
                    "type":"GET",
                    "dataType":"json"},
                    "columns": [
                    { "data": "count",responsivePriority: 1 },//define column widths
                    { "data": "suID" },
                    { "data": "fullName" ,responsivePriority: 2},
                    { "data": "telNo" },
                    { "data": "courseName" },
                    { "data": "payment" ,responsivePriority: 3},
                    { "data": "action" }],


                    //aoColumnDefs This array allows you to target a specific column, multiple columns, or all columns, using the aTargets property of each object in the array
                    "aoColumnDefs": [
                    {"bSortable":false, "aTargets": [0], "orderable": false},
                      {"aTargets": [6],//the target column ie 5th column
                      "orderable": false,
                      "mData": "action",

                      "mRender": function ( data, type, full ) 
                      {
                        return ' <span data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete"   id="delete" onclick="deleteclubmember(this);" value="'+data+'"><span class="glyphicon glyphicon-trash" ></span></button></span> &nbsp;                                                                                                                                                                <span data-placement="top" data-toggle="tooltip" title="Edit "><button class="btn btn-primary btn-xs" data-title="Edit" onclick="editclubmember(this);" id="edit" value="'+data+'"><span class="glyphicon glyphicon-pencil"></span></button></span>&nbsp;                                                                                                                                                                                            <span data-placement="top" data-toggle="tooltip" title="View "><button class="btn btn-primary btn-xs" data-title="View" onclick="viewmember(this);" id="view" value="'+data+'"><span class="glyphicon glyphicon-eye-open"></span></button></span>&nbsp'; 
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
            var table=$('#clubmemberslist').DataTable();
            
            //assign input values to variables for posting
           var suid= $("#clubmemberreg input[name=suid]").val();
           var lastname= $("#clubmemberreg input[name=lastname]").val();
           var firstname= $("#clubmemberreg input[name=firstname]").val();
           var gender= $("#clubmemberreg input[name=gender]:checked").val();
           var payment= $("#clubmemberreg input[name=payment]:checked").val();
           var phone= $("#clubmemberreg input[name=phone]").val();
           var suemail= $("#clubmemberreg input[name=suemail]").val();
           var course= $("#clubmemberreg #course").val();



            $.ajax(//ajax script to post the data without page refresh
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/ClubController/clubmemberregistration');?>",
                    data:{ suid:suid,lastname:lastname,firstname:firstname,gender:gender,phone:phone,suemail:suemail,course:course,payment:payment},
                    dataType:'json',

                    success:function(data)
                    {
                        //get json encoded feedback upon submission and respond appropriately
                       if (data.successful)
                        {
                            //if success is returned upon submission, show the success notification
                            $('#addclubmember #success').show();
                            //fade away the notification after 2000 microseconds
                            $("#addclubmember #success").fadeTo(2000, 500).slideUp(500, function(){
                                $("#addclubmember #success").slideUp(500);
                                });
                            //then toggle the input modal form.
                             // $("#addclubmember ").fadeTo(2000, 500).slideUp(500, function(){
                             //    $("#addclubmember ").modal('toggle');
                             //    });

                        //the rest applies as above
                        table.ajax.reload( null, false ); // reload the datatable 

                        }else if (data.fail)
                        {
                            $('#addclubmember #fail').show();
                            $("#addclubmember #fail").fadeTo(2000, 500).slideUp(500, function(){
                                $("#addclubmember #fail").slideUp(500);
                                });
                            
                        }else if (data.error)
                        {
                            $('#addclubmember #error').show();
                            $("#addclubmember #error").fadeTo(2000, 500).slideUp(500, function(){
                                $("#addclubmember #error").slideUp(500);
                                });
                           
                        }else if (data.exists_but_inactive)
                        {
                            $('#addclubmember #inactive').show();
                            $("#addclubmember #inactive").fadeTo(2000, 500).slideUp(500, function(){
                                $("#addclubmember #inactive").slideUp(500);
                                });
                            
                        }

                    }
                });
              
        

    }


function update()
{
          var table=$('#clubmemberslist').DataTable();

            //assign input values to variables for posting
           var suid= $("#editclubmemberreg input[name=suid]").val();
           var lastname= $("#editclubmemberreg input[name=lastname]").val();
           var firstname= $("#editclubmemberreg input[name=firstname]").val();
           var gender= $("#editclubmemberreg input[name=gender]:checked").val();
           var payment= $("#editclubmemberreg input[name=payment]:checked").val();
           var phone= $("#editclubmemberreg input[name=phone]").val();
           var suemail= $("#editclubmemberreg input[name=suemail]").val();
           var course= $("#editclubmemberreg #course").val();
           var pid= $("#editclubmemberreg #pid").val();



            $.ajax(//ajax script to post the data without page refresh
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/ClubController/clubmemberupdate');?>",
                    data:{ pid:pid,suid:suid,lastname:lastname,firstname:firstname,gender:gender,phone:phone,suemail:suemail,course:course,payment:payment},
                    dataType:'json',

                    success:function(data)
                    {
                        //get json encoded feedback upon submission and respond appropriately
                       if (data.successful)
                        {
                            //if success is returned upon submission, show the success notification
                            $('#editclubmember #success').show();
                            //fade away the notification after 2000 microseconds
                            $("#editclubmember #success").fadeTo(2000, 500).slideUp(500, function(){
                                $("#editclubmember #success").slideUp(500);
                                });
                            //then toggle the input modal form.
                             $("#editclubmember ").fadeTo(1000, 200).slideUp(500, function(){
                                $("#editclubmember ").modal('toggle');
                                });

                        //the rest applies as above
                        table.ajax.reload( null, false ); // reload the datatable 


                        }else if (data.nochange)
                        {
                            $('#editclubmember #nochange').show();
                            $("#editclubmember #nochange").fadeTo(2000, 500).slideUp(500, function(){
                                $("#editclubmember #nochange").slideUp(500);
                                });
                            $("#editclubmember ").fadeTo(1000, 200).slideUp(500, function(){
                                $("#editclubmember ").modal('toggle');
                                });
                        }else if (data.null)
                        {
                            $('#editclubmember #null').show();
                            $("#editclubmember #null").fadeTo(2000, 500).slideUp(500, function(){
                                $("#editclubmember #null").slideUp(500);
                                });
                            $("#editclubmember ").fadeTo(1000, 200).slideUp(500, function(){
                                $("#editclubmember ").modal('toggle');
                                });
                        }

                    }
                });
              
        }



function editclubmember(objButton)
{
    
    $("#editclubmemberreg").parsley().reset();
    $("#editclubmemberreg #course").parsley().reset();


    var pid=objButton.value;
 
     // alert(pid);

     $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/ClubController/getclubmember');?>",
                    data:{ pid:pid},
                    dataType:'json',

                    success:function(data)
                    {
                        

                        $('#editclubmemberreg input[name=suid]').val(data.suID);
                        $('#editclubmemberreg input[name=firstname]').val(data.firstName);
                        $('#editclubmemberreg input[name=lastname]').val(data.lastName);
                        $('#editclubmemberreg input[name=suemail]').val(data.suEmail);
                        $('#editclubmemberreg input[name=phone]').val(data.telNo);
                        $('#editclubmemberreg input[name=pid]').val(data.pID);
                        
                        $('#editclubmemberreg #course').empty();
                        
                        var courseID=data.courseID;
                        var opt = $('<option />');
                            opt.val(courseID);
                            opt.text(courseID);

                        $('#editclubmemberreg #course').append(opt);


                        
                        var gender=data.gender;
                        if (gender=="Male")
                        {
                              $('#editclubmemberreg input[name=gender]')[0].checked=true;
                        }else if (gender=="Female") {
                              $('#editclubmemberreg input[name=gender]')[1].checked=true;
                        }else 
                        {
                              $('#editclubmemberreg input[name=gender]')[0].checked=false;
                              $('#editclubmemberreg input[name=gender]')[1].checked=false;
                        }

                        var payment=data.payment;
                        if (payment=="1")
                        {
                              $('#editclubmemberreg input[name=payment]')[0].checked=true;
                        }else if (payment=="0") {
                              $('#editclubmemberreg input[name=payment]')[1].checked=true;
                        }else 
                        {
                              $('#editclubmemberreg input[name=payment]')[0].checked=false;
                              $('#editclubmemberreg input[name=payment]')[1].checked=false;
                        }

                        $('#editclubmember').modal('toggle');

                        //automatically click on the inputs for smooth dropdown lists
                        $('#editclubmemberreg #course').click();
                    }
                });


}




$( "#editclubmemberreg #course").click( function(event)
        {

         
     $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('ClubController/coursedropdownlist');?>",
                    dataType:'json',

                    success:function(data)
                    {

                         //populate the course dropdown list on edit
                         $.each(data,function(courseID)
                            {
                                var opt = $('<option />').empty(); 

                                opt.val(courseID);
                                opt.text(courseID);

                                $('#editclubmemberreg #course').append(opt);

                            });

                        //this code removes duplicates from the list above
                        
                        var seen = {};
                        jQuery('#editclubmemberreg #course').children().each(function() 
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


//=======================Course dropdown list on registration form toggle view=========================

$( "#regmodal").click( function(event)
        {
            event.preventDefault(event);//prevent auto submit data
         
            $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/ClubController/coursedropdownlist');?>",
                    dataType:'json',

                    success:function(data)
                    {

                         $.each(data,function(courseID)
                            {
                               //assign values to dropdown list
                                // var opt = $('<option selected="selected"/>'); 
                                var opt = $('<option />'); 

                                opt.val(courseID);
                                opt.text(courseID);

                                
                                $('#clubmemberreg #course').append(opt);
                               
                                    //sort the dropdown list 
                                    var options = $('#clubmemberreg #course option');
                                    var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
                                    arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
                                    options.each(function(i, o) {
                                      o.value = arr[i].v;
                                      $(o).text(arr[i].t);
                                    });


                                    //this code removes duplicates from the list above
                                    var seen = {};
                                    jQuery('#clubmemberreg #course').children().each(function() 
                                    {
                                        var txt = jQuery(this).clone().wrap('<select>').parent().html();
                                        if (seen[txt]) {
                                            jQuery(this).remove();
                                        } else {
                                            seen[txt] = true;
                                        }

                                    }); 
                            });

                    }
                });

});





function deleteclubmember(objButton)
{
          var table=$('#clubmemberslist').DataTable();

            $('#deleteclubmember').modal('toggle');

        $( "#deleteclubmemberconfirm").on('click', function(event)
            {
            var pid=objButton.value;
            
            $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/ClubController/deleteclubmember');?>",
                    data:{ pid:pid},
                    dataType:'json',

                    success:function(data)
                    {
                        if (data.successful)
                        {
                            $('#deleteclubmember #deletesuccess ').show();
                            $("#deleteclubmember #deletesuccess").fadeTo(2000, 500).slideUp(500, function(){
                                $("#deleteclubmember #deletesuccess").slideUp(500);
                                });
                             $("#deleteclubmember ").fadeTo(1000, 200).slideUp(500, function(){
                                $("#deleteclubmember ").modal('toggle');
                                });
                        table.ajax.reload( null, false ); // reload the datatable on 

                        }else if (data.fail)
                        {
                            $('#deleteclubmember #deletefail').show();
                            $("#deleteclubmember #deletefail").fadeTo(2000, 500).slideUp(500, function(){
                                $("#deleteclubmember #deletefail").slideUp(500);
                                });
                        }
                    }
                });
        });
}
             

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
    $('#editclubmemberreg').submit( function(e) { 
        e.preventDefault(e);
        if ($(this).parsley().isValid() ) {
            update();       
        }
    });
</script>

</body>
</html>
