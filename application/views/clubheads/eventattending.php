
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
    #nonclubmemberslist th
        {
            border-bottom:2px solid;
            border-color: grey;
        }
    #nonclubmemberslist 
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
                    <h4 class="page-header" style="margin-top:10px;color:blue"><span><?php echo "Current "; echo $this->session->userdata('clubName'); echo " Event Attending Non-Members";?></span></h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        
        <div class="row">
            <span data-placement="top" data-toggle="tooltip" title="Add Non-Member">
                    <button class="btn btn-primary btn-xs" data-title="Add Club Member" data-toggle="modal" data-target="#addnonclubmember" id="regmodal"><span class="fa fa-plus-circle"></span>&nbsp;Add Non-Member</button></span>
            <span data-placement="top" data-toggle="tooltip" title="Refresh">
                <button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh</button>
            </span>

             <span data-placement="top" data-toggle="tooltip" title="Print All">
                    <a class="btn btn-xs" data-title="Print All" type="button" href="<?php echo base_url('ClubController/nonclubmemberspdf')?>"><span class="fa fa-print"></span>&nbsp;Print All</a>
            </span>

            <br><br>
            <div class="row">
                <div class="col-md-12">
                   <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%"  id="nonclubmemberslist">
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
    

        <div class="modal fade" id="addnonclubmember" tabindex="-1" role="dialog" aria-labelledby="Add" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">New Attending Member </h4>
                        </div>

                        <div class="modal-body">
                            <form role="form" method="POST" action="" id="nonclubmemberreg" autocomplete="off">
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
                                            <label>Cell Phone</label>
                                            <input class="form-control" placeholder="Example: +254 (0) 719508386" name="phone" id="phone" parsley-trigger="change" required pattern="^[\d\+\(\)\/\s]*$" autocomplete="off">
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label for="">Select Course<span class="star">*</span></label>
                                                <select id="course" name="course" class="form-control"  required>
                                                </select>
                                        </div> 

                                        <button type="submit" class="btn btn-success" id="submit" >Submit </button>
                                        <button type="reset" class="btn btn-default " id="reset">Reset </button>
                                        <button type="button" class="btn " data-dismiss="modal" aria-hidden="true">EXIT</button>



                                            <div class="messagebox alert alert-success"  id="success">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-check-circle-o"></i>
                                                    <strong><span> Success!</span></strong>
                                                    <p>New Attending Member Successfully Registered!<br /></p>
                                                </div>
                                            </div>


                                            <div class="messagebox alert alert-danger"  id="fail">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-times"></i>
                                                    <strong> Registration Failed!</strong>
                                                    <p>The Attending Member is already registered!<br /></p>
                                                </div>
                                            </div>
                                            <div class="messagebox alert alert-danger"  id="error">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-times"></i>
                                                    <strong> Registration Failed!</strong>
                                                    <p>An error occurred!<br /></p>
                                                </div>
                                            </div>
                                         
                            </form>

                        </div><!--modal-body-->
                    </div>
                    <!-- /.modal-content --> 
                </div>
                <!-- /.modal-dialog --> 
            </div>
           

            <div class="modal fade" id="editnonclubmember" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Edit Attending Member </h4>
                        </div>

                        <div class="modal-body">
                            <form role="form" method="POST" action="" id="editnonclubmemberreg" autocomplete="off">
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
                                         
                                        <button type="submit" class="btn btn-success" id="submit" >Submit </button>
                                        <button type="reset" class="btn btn-default " id="reset">Reset </button>
                                        <button type="button" class="btn " data-dismiss="modal" aria-hidden="true">EXIT</button>

                                        
                                         <div class="messagebox alert alert-success"  id="success">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-check-circle-o"></i>
                                                    <strong><span> Success!</span></strong>
                                                    <p>Attending member info successfully updated!<br /></p>
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



            
    

    
        <div class="modal fade" id="deletenonclubmember" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title custom_align" id="Heading">Delete this attending member?</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign">     </span> Are you sure you want to delete this member?
                        </div>
                    </div>

                    <div class="modal-footer ">
                        <button type="submit" class="btn btn-success" id="deletenonclubmemberconfirm"><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                    </div>


                    <div class="messagebox alert alert-success"  id="deletesuccess" style="display: none;position:relative;width:82%;top: 0%;left:10%;">
                            <button type="button" class="close" data-dismiss="alert"></button>
                                    <div class="cs-text">
                                            <i class="fa fa-check-circle-o"></i>
                                                <strong><span> Success!</span></strong>
                                                 <p>Attending member was successfully deleted!<br /></p>
                                    </div>
                    </div>


                    <div class="messagebox alert alert-warning"  id="detetefail" style="display: none;position:relative;width:82%;top: 0%;left: 10%;">
                            <button type="button" class="close" data-dismiss="alert"></button>
                                    <div class="cs-text">
                                            <i class="fa fa-info-circle"></i>
                                            <strong></i> Fail!</strong>
                                    <p>Unable to delete attending member!<br /></p>
                                                </div>
                    </div>

                </div>
                <!-- /.modal-content --> 
            </div>
            <!-- /.modal-dialog --> 
        </div>


        <!-- Modal -->
        <div class="modal fade" id="viewnonclubmember" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                <p class="text-center"><strong>Unconfirmed member of </strong><span id="clubname"></span>&nbsp;</p>
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
            $('#nonclubmemberreg').parsley();

            var table=$('#nonclubmemberslist').DataTable();
    
            $("#nonclubmemberslist").dataTable().fnDestroy();//destroy the table and recreate it for every refresh


                    var table=$('#nonclubmemberslist').DataTable({responsive:true,"iDisplayLength": 10,"lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],

                    "ajax": {
                    "url":"<?php echo base_url('index.php/ClubController/nonclubmemberslist')?>",
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
                        return ' <span data-placement="top" data-toggle="tooltip" title="Delete record?"><button class="btn btn-danger btn-xs" data-title="Delete"   id="delete" onclick="deleteclubmember(this);" value="'+data+'"><span class="glyphicon glyphicon-trash" ></span></button></span> &nbsp;                                                                                                                                                                <span data-placement="top" data-toggle="tooltip" title="Edit record?"><button class="btn btn-primary btn-xs" data-title="Edit" onclick="editnonclubmember(this);" id="edit" value="'+data+'"><span class="glyphicon glyphicon-pencil"></span></button></span>&nbsp;                                                                                                                                                                                            <span data-placement="top" data-toggle="tooltip" title="View record?"><button class="btn btn-primary btn-xs" data-title="View" onclick="viewmember(this);" id="view" value="'+data+'"><span class="glyphicon glyphicon-eye-open"></span></button></span>&nbsp'; 
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
            var table=$('#nonclubmemberslist').DataTable();
            
            //assign input values to variables for posting
           var suid= $("#nonclubmemberreg input[name=suid]").val();
           var lastname= $("#nonclubmemberreg input[name=lastname]").val();
           var firstname= $("#nonclubmemberreg input[name=firstname]").val();
           var gender= $("#nonclubmemberreg input[name=gender]:checked").val();
           var phone= $("#nonclubmemberreg input[name=phone]").val();
           var suemail= $("#nonclubmemberreg input[name=suemail]").val();
           var course= $("#nonclubmemberreg #course").val();



            $.ajax(//ajax script to post the data without page refresh
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/ClubController/nonclubmemberregistration')?>",
                    data:{ suid:suid,lastname:lastname,firstname:firstname,gender:gender,phone:phone,suemail:suemail,course:course},
                    dataType:'json',

                    success:function(data)
                    {
                        //get json encoded feedback upon submission and respond appropriately
                       if (data.successful)
                        {
                            //if success is returned upon submission, show the success notification
                            $('#addnonclubmember #success').show();
                            //fade away the notification after 2000 microseconds
                            $("#addnonclubmember #success").fadeTo(2000, 500).slideUp(500, function(){
                                $("#addnonclubmember #success").slideUp(500);
                                });
                        //the rest applies as above
                        table.ajax.reload( null, false ); // reload the datatable 

                        }else if (data.duplicate)
                        {
                            $('#addnonclubmember #fail').show();
                            $("#addnonclubmember #fail").fadeTo(2000, 500).slideUp(500, function(){
                                $("#addnonclubmember #fail").slideUp(500);
                                });
                            
                        }else if (data.error)
                        {
                            $('#addnonclubmember #error').show();
                            $("#addnonclubmember #error").fadeTo(2000, 500).slideUp(500, function(){
                                $("#addnonclubmember #error").slideUp(500);
                                });
                        }

                    }
                });
              
        

    }




//=======================Course dropdown list on registration form toggle view=========================

$( "#regmodal").click( function(event)
        {
            event.preventDefault(event);//prevent auto submit data
            $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/ClubController/coursedropdownlist')?>",
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

                                
                                $('#nonclubmemberreg #course').append(opt);
                               
                                    //sort the dropdown list 
                                    var options = $('#nonclubmemberreg #course option');
                                    var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
                                    arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
                                    options.each(function(i, o) {
                                      o.value = arr[i].v;
                                      $(o).text(arr[i].t);
                                    });


                                    //this code removes duplicates from the list above
                                    var seen = {};
                                    jQuery('#nonclubmemberreg #course').children().each(function() 
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



function editnonclubmember(objButton)
{
    
    $("#editnonclubmemberreg").parsley().reset();
    $("#editnonclubmemberreg #course").parsley().reset();


    var pid=objButton.value;
 
     // alert(pid);

     $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/ClubController/getclubmember')?>",
                    data:{ pid:pid},
                    dataType:'json',

                    success:function(data)
                    {
                        

                        $('#editnonclubmemberreg input[name=suid]').val(data.suID);
                        $('#editnonclubmemberreg input[name=firstname]').val(data.firstName);
                        $('#editnonclubmemberreg input[name=lastname]').val(data.lastName);
                        $('#editnonclubmemberreg input[name=suemail]').val(data.suEmail);
                        $('#editnonclubmemberreg input[name=phone]').val(data.telNo);
                        $('#editnonclubmemberreg input[name=pid]').val(data.pID);
                        
                        $('#editnonclubmemberreg #course').empty();
                        
                        var courseID=data.courseID;
                        var opt = $('<option />');
                            opt.val(courseID);
                            opt.text(courseID);

                        $('#editnonclubmemberreg #course').append(opt);


                        
                        var gender=data.gender;
                        if (gender=="Male")
                        {
                              $('#editnonclubmemberreg input[name=gender]')[0].checked=true;
                        }else if (gender=="Female") {
                              $('#editnonclubmemberreg input[name=gender]')[1].checked=true;
                        }else 
                        {
                              $('#editnonclubmemberreg input[name=gender]')[0].checked=false;
                              $('#editnonclubmemberreg input[name=gender]')[1].checked=false;
                        }

                        $('#editnonclubmember').modal('toggle');

                        //automatically click on the inputs for smooth dropdown lists
                        $('#editnonclubmemberreg #course').click();
                    }
                });


}




$( "#editnonclubmemberreg #course").click( function(event)
        {

         
     $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/ClubController/coursedropdownlist')?>",
                    dataType:'json',

                    success:function(data)
                    {


                        
                         //populate the course dropdown list on edit
                         $.each(data,function(courseID)
                            {

                                var opt = $('<option />').empty(); 

                                opt.val(courseID);
                                opt.text(courseID);

                                $('#editnonclubmemberreg #course').append(opt);

                            });

                        //this code removes duplicates from the list above
                        
                        var seen = {};
                        jQuery('#editnonclubmemberreg #course').children().each(function() 
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


function update()
{
          var table=$('#nonclubmemberslist').DataTable();

            //assign input values to variables for posting
           var suid= $("#editnonclubmemberreg input[name=suid]").val();
           var lastname= $("#editnonclubmemberreg input[name=lastname]").val();
           var firstname= $("#editnonclubmemberreg input[name=firstname]").val();
           var gender= $("#editnonclubmemberreg input[name=gender]:checked").val();
           var phone= $("#editnonclubmemberreg input[name=phone]").val();
           var suemail= $("#editnonclubmemberreg input[name=suemail]").val();
           var course= $("#editnonclubmemberreg #course").val();
           var pid= $("#editnonclubmemberreg #pid").val();



            $.ajax(//ajax script to post the data without page refresh
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/ClubController/nonclubmemberupdate')?>",
                    data:{ pid:pid,suid:suid,lastname:lastname,firstname:firstname,gender:gender,phone:phone,suemail:suemail,course:course},
                    dataType:'json',

                    success:function(data)
                    {
                        // console.log(data);
                        //get json encoded feedback upon submission and respond appropriately
                       if (data.successful)
                        {
                            //if success is returned upon submission, show the success notification
                            $('#editnonclubmember #success').show();
                            //fade away the notification after 2000 microseconds
                            $("#editnonclubmember #success").fadeTo(2000, 500).slideUp(500, function(){
                                $("#editnonclubmember #success").slideUp(500);
                                });

                        //the rest applies as above
                        table.ajax.reload( null, false ); // reload the datatable 


                        }else if (data.nochange)
                        {
                            $('#editnonclubmember #nochange').show();
                            $("#editnonclubmember #nochange").fadeTo(2000, 500).slideUp(500, function(){
                                $("#editnonclubmember #nochange").slideUp(500);
                                });
                            
                        }else if (data.null)
                        {
                            $('#editnonclubmember #null').show();
                            $("#editnonclubmember #null").fadeTo(2000, 500).slideUp(500, function(){
                                $("#editnonclubmember #null").slideUp(500);
                                });
                            
                        }

                    }
                });
              
 }



function viewmember(objButton)
{
    event.preventDefault();//prevent auto submit data

    var pid=objButton.value;
 
     
     $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/ClubController/viewclubmember'); ?>",
                    data:{ pid:pid},
                    dataType:'json',

                    success:function(data)
                    {
                        console.log(data);

                        $('#viewnonclubmember #fullname').text(data.fullName);
                        $('#viewnonclubmember #suid').text(data.suID);
                        $('#viewnonclubmember #phone').text(data.telNo);
                        $('#viewnonclubmember #clubname').text(data.clubName);
                        $('#viewnonclubmember #coursename').text(data.courseID);
                        $('#viewnonclubmember #gender').text(data.gender);
                        $('#viewnonclubmember #suemail').text(data.suEmail);
                        
                        $('#viewnonclubmember').modal('toggle');

                        
                    }
                });


}


function deleteclubmember(objButton)
{
          var table=$('#nonclubmemberslist').DataTable();

            $('#deletenonclubmember').modal('toggle');

        $( "#deletenonclubmemberconfirm").on('click', function(event)
            {
            var pid=objButton.value;
            
            $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/ClubController/deletenonclubmember');?>",
                    data:{ pid:pid},
                    dataType:'json',

                    success:function(data)
                    {

                        if (data.successful)
                        {
                            $('#deletenonclubmember #deletesuccess ').show();
                            $("#deletenonclubmember #deletesuccess").fadeTo(2000, 500).slideUp(500, function(){
                                $("#deletenonclubmember #deletesuccess").slideUp(500);
                                });

                             $("#deletenonclubmember ").fadeTo(1000, 200).slideUp(500, function(){
                                $("#deletenonclubmember ").modal('toggle');
                                });
                        
                        table.ajax.reload( null, false ); // reload the datatable on 


                        }else if (data.fail)
                        {
                            $('#deletenonclubmember #deletefail').show();
                            $("#deletenonclubmember #deletefail").fadeTo(2000, 500).slideUp(500, function(){
                                $("#deletenonclubmember #deletefail").slideUp(500);
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

$('#nonclubmemberreg').submit( function(e) { 
        e.preventDefault();
        if ( $(this).parsley().isValid() ) {
            submitData();       
        }
});

    $('#editnonclubmemberreg').submit( function(e) { 
        e.preventDefault();
        if ($(this).parsley().isValid() ) {
            update();       
        }
    });
</script>

</body>
</html>
