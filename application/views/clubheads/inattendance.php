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
        
    /* Centering td values in datatable*/
    table td:nth-child(1),td:nth-child(2),td:nth-child(6) ,td:nth-child(7) 
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

    </style>

</head>

<body>
<div class="container" style="background-color: white">
    <div class="row">
<!-- <span><?php// echo $this->session->userdata('clubName'); echo " ";?>&copy;<?php //echo " ".date("Y"); ?> -->
        <span><h4 class="text-center col-md-12" style="margin-top:10px;color:blue"> <button class="btn btn-success btn-rounded-20 btn-ef btn-ef-5 btn-ef-5a mb-10"><i class="fa fa-list"></i> <span><?php  echo $this->session->userdata('clubName'); echo " Meetings (Inattendance)";?></span></button>
        </h4>
    </div>
            <span data-placement="top" data-toggle="tooltip" title="Add Participant">
                    <button class="btn btn-primary btn-xs" data-title="Add Participant" data-toggle="modal" data-target="#addparticipant" id="regmodal"><span class="fa fa-plus-circle"></span>&nbsp;Add Inattendance</button></span>
            <span data-placement="top" data-toggle="tooltip" title="Refresh to update number of entries">
                <button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh</button>
            </span>

             <span data-placement="top" data-toggle="tooltip" title="Print All">
                    <a class="btn btn-xs" data-title="Print All" type="button" href="#"><span class="fa fa-print"></span>&nbsp;Print All</a>
            </span>

            <span data-placement="top" data-toggle="tooltip" title="Return to previous page"><a href="<?php echo base_url('ClubController/clubpage')?>" class="btn btn-xs" data-title="Refresh" >
                    <span class="fa fa-arrow-circle-o-left"></span>&nbsp;Back</a> </span>
            </span>


            <br><br>
            <div class="row">
                <div class="col-md-12">
                   <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%"  id="clubmemberslist">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Identification</th>
                                <th class="text-center">Full name</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Particulars</th>
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
    <div class="modal fade" id="addparticipant" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Add Participant </h4>
                        </div>

                        <div class="modal-body">
                            <form role="form" method="POST" action="" id="meetingparticipantreg">
                                        <div class="form-group col-lg-6">
                                            <label for="">Select Meeting</label>
                                                <select id="meeting" name="meeting" class="form-control">
                                                    <option value="">--Select Meeting---</option>
                                                </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Identification</label>
                                            <input class="form-control" placeholder="Identification No." id="id" name="id">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Surname</label>
                                            <input class="form-control" placeholder="Surname" name="lastname" id="lastname">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>First Name</label>
                                            <input class="form-control" placeholder="First Name" name="firstname" id="firstname">
                                        </div>

                                        

                                        <div class="form-group col-lg-6">
                                            <label>Email Address</label>
                                            <input class="form-control" placeholder="Email Address" name="emailadd" id="emailadd">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label class="">Gender</label><br>
                                            <label class="radio-inline ">
                                                <input type="radio" name="gender" id="gender" value="Male">Male
                                            </label>
                                            <label class="radio-inline ">
                                                <input type="radio" name="gender" id="gender" value="Female">Female
                                            </label><br><br>
                                           
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label>Cell Phone</label>
                                            <input class="form-control" placeholder="Cell Phone" name="phone" id="phone">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="">Select Category</label>
                                                <select id="category" name="category" class="form-control">
                                                    <option value="Student">Student</option>
                                                    <option value="Staff">Staff</option>
                                                    <option value="Guest">Guest</option>
                                                </select>
                                        </div>  
                                        <div class="form-group col-lg-12">
                                            <label>Particulars</label>
                                            <textarea class="form-control" placeholder="Particulars e.g. Dean of Students" name="profile" id="profile"></textarea>
                                        </div>                       

                                        <button type="submit" class="btn btn-success " id="submit" style="width:100%">Submit </button>


                                            <div class="messagebox alert alert-success"  id="success">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-check-circle-o"></i>
                                                    <strong><span> Success!</span></strong>
                                                    <p>New participant successfully added!<br /></p>
                                                </div>
                                            </div>


                                            <div class="messagebox alert alert-danger"  id="fail">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-times"></i>
                                                    <strong> Registration Failed!</strong>
                                                    <p>The participant has already been added!<br /></p>
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
                            <form role="form" method="POST" action="" id="editclubmemberreg">
                                        <div class="form-group col-lg-6" style="display:none;position: absolute;">
                                            <label>ID</label>
                                            <input class="form-control" placeholder="PID" id="pid" name="pid">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label>SU ID</label>
                                            <input class="form-control" placeholder="SU ID" id="suid" name="suid">
                                        </div>
                                        
                                        <div class="form-group col-lg-6">
                                            <label>Surname</label>
                                            <input class="form-control" placeholder="Surname" name="lastname" id="lastname">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>First Name</label>
                                            <input class="form-control" placeholder="First Name" name="firstname" id="firstname">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label class="">Gender</label><br>
                                            <label class="radio-inline ">
                                                <input type="radio" name="gender" id="gender" value="Male">Male
                                            </label>
                                            <label class="radio-inline ">
                                                <input type="radio" name="gender" id="gender" value="Female">Female
                                            </label><br><br>
                                           
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label>SU Email</label>
                                            <input class="form-control" placeholder="SU Email" name="suemail" id="suemail">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label>Cell Phone</label>
                                            <input class="form-control" placeholder="Cell Phone" name="phone" id="phone">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="">Select Meeting</label>
                                                <select id="course" name="course" class="form-control">
                                                    <option value="">--Select Meeting---</option>
                                                </select>
                                        </div>                                   

                                        <button type="submit" class="btn btn-success " id="update" style="width:100%">Submit </button>


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
            
    

    
        <div class="modal fade" id="deleteclubmember" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
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


                    <div class="messagebox alert alert-success"  id="deletesuccess">
                            <button type="button" class="close" data-dismiss="alert"></button>
                                    <div class="cs-text">
                                            <i class="fa fa-check-circle-o"></i>
                                                <strong><span> Success!</span></strong>
                                                 <p>Club member was successfully deleted!<br /></p>
                                    </div>
                    </div>


                    <div class="messagebox alert alert-warning"  id="detetefail">
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
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

     <?php $this->load->view('scriptlinks/scriptlinks.php'); ?>

<script>


   $(document).ready(function () 

   {
    
            $("#clubmemberslist").dataTable().fnDestroy();//destroy the table and recreate it for every refresh


                    var table=$('#clubmemberslit').DataTable({responsive:true,"iDisplayLength": 10,"lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],

                    "ajax": {
                    "url":"<?php echo base_url('ClubController/clubmemberslist')?>",
                    "type":"POST",
                    "dataType":"json"},
                    "columns": [
                    { "data": "count",responsivePriority: 1 },//define column widths
                    { "data": "suID" },
                    { "data": "fullName" ,responsivePriority: 2},
                    { "data": "telNo" },
                    { "data": "courseName" },
                    { "data": "status" ,responsivePriority: 3},
                    { "data": "action" }],


                    //aoColumnDefs This array allows you to target a specific column, multiple columns, or all columns, using the aTargets property of each object in the array
                    "aoColumnDefs": [
                    {"bSortable":false, "aTargets": [0], "orderable": false},
                      {"aTargets": [6],//the target column ie 5th column
                      "orderable": false,
                      "mData": "action",

                      "mRender": function ( data, type, full ) 
                      {
                        return ' <span data-placement="top" data-toggle="tooltip" title="Delete record?"><button class="btn btn-danger btn-xs" data-title="Delete"   id="delete" onclick="deleteclubmember(this);" value="'+data+'"><span class="glyphicon glyphicon-trash" ></span></button></span> &nbsp;                                                                                                                                                                <span data-placement="top" data-toggle="tooltip" title="Edit record?"><button class="btn btn-primary btn-xs" data-title="Edit" onclick="editclubmember (this);" id="edit" value="'+data+'"><span class="glyphicon glyphicon-pencil"></span></button></span>&nbsp;                                                                                                                                                                                            <span data-placement="top" data-toggle="tooltip" title="View record?"><button class="btn btn-primary btn-xs" data-title="View" onclick="viewmember(this);" id="view" value="'+data+'"><span class="glyphicon glyphicon-eye-open"></span></button></span>&nbsp'; 
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


//=======================meeting dropdown list=========================
 $(document).ready(function () 

   {
         
     $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url(); ?>ClubController/meetingsdropdown",
                    dataType:'json',

                    success:function(data)
                    {

                         $.each(data,function(countyID,countyName)
                            {
                                var opt = $('<option />'); 

                                opt.val(countyID);
                                opt.text(countyName);
                                $('#meeting').append(opt);


                            });

                             //sort the meetings dropdown list 
                                var options = $('#meeting option');
                                    var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
                                    arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
                                    options.each(function(i, o) {
                                      o.value = arr[i].v;
                                      $(o).text(arr[i].t);
                                    });

                               //this code removes duplicates from the list above
                                var seen = {};
                                jQuery('#meeting').children().each(function() 
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


 //=======================================================================================


$(function(){
    $( "#submit").click( function(event)
        {
        
            event.preventDefault(event);//prevent auto submit data

            //assign input values to variables for posting
           var meeting= $("#addparticipant #meetingparticipantreg input[name=meeting]").val();
           var participantid= $("#addparticipant #meetingparticipantreg input[name=id]").val();
           var firstname= $("#addparticipant #meetingparticipantreg input[name=firstname]").val();
           var lastname= $("#addparticipant #meetingparticipantreg input[name=lastname]").val();
           var emailadd= $("#addparticipant #meetingparticipantreg input[name=emailadd]").val();
           var phone= $("#addparticipant #meetingparticipantreg input[name=phone]").val();
           var gender= $("#addparticipant #meetingparticipantreg input[name=gender]:checked").val();
           var category= $("#addparticipant #meetingparticipantreg input[name=category]").val();
           var profile= $("#addparticipant #meetingparticipantreg input[name=profile]").val();

            $.ajax(//ajax script to post the data without page refresh
                {
                    type:"post",
                    url: "<?php echo base_url('ClubController/newinattendance')?>",
                    data:{ meeting:meeting,participantid:participantid,firstname:firstname, lastname:lastname,emailadd:emailadd,phone:phone,gender:gender,profile:profile,category:category},
                    dataType:'json',

                    success:function(data)
                    {
                        //get json encoded feedback upon submission and respond appropriately
                       if (data.successful)
                        {
                            //if success is returned upon submission, show the success notification
                            $('#addparticipant #success').show();
                            //fade away the notification after 2000 milliseconds
                            $("#addparticipant #success").fadeTo(2000, 500).slideUp(500, function(){
                                $("#addparticipant #success").slideUp(500);
                                });
                            

                        }else if (data.fail)
                        {
                            $('#addparticipant #fail').show();
                            $("#addparticipant #fail").fadeTo(2000, 500).slideUp(500, function(){
                                $("#addparticipant #fail").slideUp(500);
                                });
                            $("#addparticipant ").fadeTo(2000, 200).slideUp(500, function(){
                                $("#addparticipant ").modal('toggle');
                                });
                        }else if (data.null)
                        {
                            $('#addparticipant #null').show();
                            $("#addparticipant #null").fadeTo(2000, 500).slideUp(500, function(){
                                $("#addparticipant #null").slideUp(500);
                                });
                            $("#addparticipant ").fadeTo(2000, 200).slideUp(500, function(){
                                $("#addparticipant ").modal('toggle');
                                });
                        }else if (data.duplicate)
                        {
                            $('#addparticipant #duplicate').show();
                            $("#addparticipant #duplicate").fadeTo(2000, 500).slideUp(500, function(){
                                $("#addparticipant #duplicate").slideUp(500);
                                });
                            $("#addparticipant ").fadeTo(2000, 500).slideUp(1000, function(){
                                $("#addparticipant ").modal('toggle');
                                });
                        }

                        $('#addparticipant #meetingparticipantreg')[0].reset();

                    }
                });
              
        });

    });



//to refresh the page
$( "#refresh").click( function(event)
        {
            window.setTimeout(function(){location.reload()},1)

        });




</script>

</body>
</html>
