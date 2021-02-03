
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
    </style>
       
</head>

<body>

<div id="wrapper">

        <?php  $this->load->view('clubheads/clubnavigation'); ?>
        <div id="page-wrapper" >
    
            <div class="row" >
                <div class="col-lg-12">
                    <h4 class="page-header" style="margin-top:10px;color:blue"><span><?php  echo $this->session->userdata('clubName'); echo " Meetings";?></span></h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        
        <span data-placement="top" data-toggle="tooltip" title="Add Meeting Info">
                    <button class="btn btn-primary btn-xs" data-title="Add Meeting Info" data-toggle="modal" data-target="#addmeetinginfo" -d="addmeetingbtn"><span class="fa fa-plus-circle"></span>&nbsp;Add Meeting Info</button></span>
            <span data-placement="top" data-toggle="tooltip" title="Refresh to update number of entries">
                <button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh</button>
            </span>

             <span data-placement="top" data-toggle="tooltip" title="Print All">
                    <a class="btn btn-xs" data-title="Print All" type="button" href="#"><span class="fa fa-print"></span>&nbsp;Print All</a>
            </span>

           
            <br><br>
            <div class="row">
                <div class="col-md-12">
                  <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%"  id="meetingslist">
                        <thead>
                            <tr>
                                 <th class="text-center">#</th>
                                <th class="text-center">Meeting Date</th>
                                <th class="text-center">Venue</th>
                                <th class="text-center">Start Time</th>
                                <th class="text-center">End Time</th>
                                <th class="text-center">Taking Minutes</th>
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
    <div class="modal fade" id="addmeetinginfo" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Add Meeting Details </h4>
                        </div>

                        <div class="modal-body">
                            <form role="form" method="POST" action="" id="meetinginfo">
                                        <div class="form-group col-lg-6">
                                            <label>Meeting Date</label>
                                            <input class="form-control" placeholder="Meeting date" id="meetingdate" name="meetingdate" type="date">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Meeting Venue</label>
                                            <input class="form-control" placeholder="Meeting venue" name="meetingvenue" id="meetingvenue" type="text">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Start Time</label>
                                            <input class="form-control" placeholder="Start time" name="starttime" id="starttime" type="time">
                                        </div>
                                                                         

                                        <div class="form-group col-lg-6">
                                            <label>End Time</label>
                                            <input class="form-control" placeholder="Adjournment time" name="endtime" id="endtime" type="time">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label>Person Taking Minutes</label>
                                            <input class="form-control" placeholder="Student ID e.g. 78581" name="studentid" id="studentid" type="number">
                                        </div>

                                                                          

                                        <button type="submit" class="btn btn-success " id="submit" style="width:100%">Submit </button>


                                            <div class="messagebox alert alert-success"  id="success">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-check-circle-o"></i>
                                                    <strong><span> Success!</span></strong>
                                                    <p>New club minutes successfully added!<br /></p>
                                                </div>
                                            </div>


                                            <div class="messagebox alert alert-danger"  id="fail">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-times"></i>
                                                    <strong> Failed!</strong>
                                                    <p>The minutes have already been added!<br /></p>
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
           



            <!-- Modal -->
            <div class="modal fade" id="minutesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Manage Meeting Minutes</h4>
                  </div>
                  
                  <div class="modal-footer">


                    <button type="button" class="btn btn-primary col-md-3" id="addminutesbtn" value="">Add Minutes</button>
                    <h4 class=" col-md-3"></h4>
                    <button type="button" class="btn col-md-3" id="editminutesbtn" value="">Edit Minutes</button>
                    
                    <h4 class=" col-md-1"></h4>
                    
                    <button type="button" class="btn btn-danger col-md-2" data-dismiss="modal" >Close</button>

                  </div>
                </div>
              </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="attendanceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Attendance</h4>
                  </div>
                  
                  <div class="modal-footer" class="col-md-12">


                    <button type="button" class="btn btn-primary col-md-3" id="memberattendancebtn" value="">Member Attendance</button>
                    <h4 class=" col-md-3"></h4>
                    <button type="button" class="btn col-md-3" id="inattendancebtn" value="">Inattendance</button>
                    
                    <h4 class=" col-md-1"></h4>
                    
                    <button type="button" class="btn btn-danger col-md-2" data-dismiss="modal" >Close</button>

                  </div>
                </div>
              </div>
            </div>



             <!-- Modal -->
            <div class="modal fade" id="attDuplicate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                
                  <div class="alert alert-danger">
                      <p class="text-center"><strong >Fail:</strong> Attendance for this meeting already exist!</p>
                  
                </div>
              </div>
            </div>




    
        <div class="modal fade" id="deletemeeting" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title custom_align" id="Heading">Delete this Meeting</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign">     </span> Are you sure you want to delete this meeting?
                        </div>
                    </div>

                    <div class="modal-footer ">
                        <button type="submit" class="btn btn-success" id="deletemeetingconfirm"><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                    </div>


                    <div class="messagebox alert alert-success"  id="deletesuccess">
                            <button type="button" class="close" data-dismiss="alert"></button>
                                    <div class="cs-text">
                                            <i class="fa fa-check-circle-o"></i>
                                                <strong><span> Success!</span></strong>
                                                 <p>Meeting was Successfully Deleted!<br /></p>
                                    </div>
                    </div>


                    <div class="messagebox alert alert-warning"  id="detetefail">
                            <button type="button" class="close" data-dismiss="alert"></button>
                                    <div class="cs-text">
                                            <i class="fa fa-info-circle"></i>
                                            <strong></i> Fail!</strong>
                                    <p>Unable to delete meeting !<br /></p>
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
    
            $("#meetingslist").dataTable().fnDestroy();//destroy the table and recreate it for every refresh


                    var table=$('#meetingslist').DataTable({responsive:true,"iDisplayLength": 10,"lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],

                    "ajax": {
                    "url":"<?php echo base_url('ClubController/meetingslist')?>",
                    "type":"POST",
                    "dataType":"json"},
                    "columns": [
                    { "data": "count",responsivePriority: 1 },//define column widths
                    { "data": "meetingDate" },
                    { "data": "meetingVenue" ,responsivePriority: 2},
                    { "data": "startTime" },
                    { "data": "endTime" },
                    { "data": "fullName" ,responsivePriority: 3},
                    { "data": "action" }],


                    //aoColumnDefs This array allows you to target a specific column, multiple columns, or all columns, using the aTargets property of each object in the array
                    "aoColumnDefs": [
                    {"bSortable":false, "aTargets": [0], "orderable": false},
                      {"aTargets": [6],//the target column ie 5th column
                      "orderable": false,
                      "mData": "action",

                      "mRender": function ( data, type, full ) 
                      {
                        return ' <span data-placement="top" data-toggle="tooltip" title="Delete Attendance for this Meeting"><button class="btn btn-danger btn-xs" data-title="Delete"   id="delete" onclick="del_meetingatt(this);" id="'+data+'_delete" value="'+data+'"><span class="glyphicon glyphicon-trash" ></span></button></span> &nbsp;                                                                                                                                                       <span data-placement="top" data-toggle="tooltip" title="Add Attendance for this Meeting"><button class="btn btn-primary btn-xs" data-title="Edit Meeting" onclick="newattendance(this);" value="'+data+'"><span class="fa fa-plus-circle"></span></button></span>&nbsp'; 
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




// function manageminutes(objButton)
//     {
      

//         var pid=objButton.value;

//         $('#addminutesbtn').val(pid);
//          $('#minutesModal').modal('toggle');

//     }


// function newattendance(objButton)
//     {
      

//         var pid=objButton.value;

//         $('#memberattendancebtn').val(pid);
//          $('#attendanceModal').modal('toggle');

//     }


// $(function()
// {
//     $( "#addminutesbtn").one('click', function()
//         {
//             var meetingid=$(this).val();

//             $.ajax(//ajax script to post the data without page refresh
//                 {
//                     type:"post",
//                     url: "<?php echo base_url('ClubController/minutes')?>",
//                     data:{ meetingid:meetingid},
//                     dataType:'json',

//                     success:function(data)
//                     {
//                         var feedback=data.meetingid;

//                             location.href="<?php echo base_url(); ?>ClubController/addminutes"+'?meetingid='+feedback;

//                     }
//                 });
//         });
// });





function newattendance(objButton)
    {
      

        var meetingid=objButton.value;



            // alert(meetingid);
            $.ajax(//ajax script to post the data without page refresh
                {
                    type:"post",
                    url: "<?php echo base_url('ClubController/meetingattendancerecordcheck')?>",
                    data:{ meetingid:meetingid},
                    dataType:'json',

                    success:function(data)
                    {
                        console.log(data);
                       if(data.exists) 
                                    {
                                    $('#attendanceModal').modal('toggle');

                                        $("#attDuplicate ").fadeTo(2000, 200).slideUp(500, function(){});

                                    }
                                        else if(data.proceed) 
                                            {
                                                var feedback=data.proceed;

                                                location.href="<?php echo base_url(); ?>ClubController/meetingattendance";
                                            }
                    }
                });
}
        




function deletemeeting(objButton)
{
    
    $('#deletemeeting').modal('toggle');


    $( "#deletemeetingconfirm").one('click', function(event)
        {
            var table=$('#meetingslist').DataTable();

            var id=objButton.value;

            $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url(); ?>Home/deletemeeting",
                    data:{ id:id},
                    dataType:'json',

                    success:function(data)
                    {

                        if (data.successful)
                        {
                            $('#deletemeeting #deletesuccess ').show();
                            $("#deletemeeting #deletesuccess").fadeTo(2000, 500).slideUp(500, function(){
                                $("#deletemeeting #deletesuccess").slideUp(500);
                                });

                             $("#deletemeeting ").fadeTo(1000, 200).slideUp(500, function(){
                                $("#deletemeeting ").modal('toggle');
                                });
                        table.ajax.reload( null, false ); // reload the datatable 


                        }else if (data.fail)
                        {
                            $('#deletemeeting #deletefail').show();
                            $("#deletemeeting #deletefail").fadeTo(2000, 500).slideUp(500, function(){
                                $("#deletemeeting #deletefail").slideUp(500);
                                });
                        }
                        
                    }
                });



        });
    

}


//to refresh the page
$( "#refresh").click( function()
        {
            window.setTimeout(function(){location.reload()},1)

        });




</script>

</body>
</html>

