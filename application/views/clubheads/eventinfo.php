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
    #eventslist td:nth-child(1),td:nth-child(2),td:nth-child(3) ,td:nth-child(4) ,td:nth-child(5) ,td:nth-child(6),td:nth-child(7)  
                {

                 text-align:center !important;
                }
    
    </style>
       
</head>

<body>

<div id="wrapper">

        <?php  $this->load->view('clubheads/clubnavigation'); ?>
        <div id="page-wrapper" >
    
            <div class="row" >
                <div class="col-lg-12">
                    <h4 class="page-header" style="margin-top:10px;color:blue"><span><?php  echo $this->session->userdata('clubName'); echo " Events";?></span></h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        
            <span data-placement="top" data-toggle="tooltip" title="Add Event Info">
                    <button class="btn btn-primary btn-xs" data-title="Add Event Info" data-toggle="modal" data-target="#addeventinfo" ><span class="fa fa-plus-circle"></span>&nbsp;Add Event Info</button></span>
            <span data-placement="top" data-toggle="tooltip" title="Refresh to update number of entries">
                <button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh</button>
            </span>

             <span data-placement="top" data-toggle="tooltip" title="Print All">
                    <a class="btn btn-xs" data-title="Print All" type="button" href="<?php echo base_url('addclubminutesminutestroller/clubmemberspdf')?>"><span class="fa fa-print"></span>&nbsp;Print All</a>
            </span>
           <div class="row">
                <!--<div class="form-group col-lg-12">
                    <?php $msg = $this->session->flashdata('msg');
                        $successful= $msg['success']; $failed=  $msg['error']; 
                        if ($successful=="" && $failed!=""){echo '
                        <div class="messagebox alert alert-danger" style="display: block">
                        <button type="button" class="close" data-dismiss="alert">*</button>
                        <div class="cs-text">
                            <i class="fa fa-close"></i>
                            <strong><span>';echo $msg['error']; echo '</span></strong>
                        </div> 
                        </div>';}
                        else if($successful=="" && $failed==""){echo '<div></div>';} 
                        else if ($successful!="" && $failed==""){echo '
                        <div class="messagebox alert alert-success" style="display: block">
                        <button type="button" class="close" data-dismiss="alert">*</button>
                        <div class="cs-text">
                            <i class="fa fa-check-circle-o"></i>
                            <strong><span>';echo $msg['success'];echo '</span></strong>
                        </div> 
                        </div>';}?>
                    </div>-->
                <div class="col-md-12">
                  <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%"  id="eventslist">
                        <thead>
                            <tr>
                                 <th class="text-center">#</th>
                                <th class="text-center">Event Date</th>
                                <th class="text-center">Venue</th>
                                <th class="text-center">Start Time</th>
                                <th class="text-center">End Time</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
            </div>
           
            <div class="modal fade" id="addeventinfo" tabindex="-1" role="dialog" aria-labelledby="Add Event" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Add Event Details </h4>
                        </div>

                        <div class="modal-body">
                        <form role="form" method="POST" action="" id="eventinfo">

                                        <div class="form-group col-lg-12">
                                            <label>Event Date</label>
                                            <div class='input-group date' id='dateofevent'>
                                                <input type='text' class="form-control" placeholder="Date of Event:yyyy-mm-dd" id="eventdate" name="eventdate" data-parsley-trigger="change"
                                                       pattern="/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])$/"
                                                        required autocomplete="off" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                        
                                         <div class="form-group col-lg-12">
                                            <label>Event Venue</label>
                                            <input type="text" class="form-control" placeholder="Event venue" name="eventvenue" id="eventvenue"  data-parsley-trigger="change" required autocomplete="off" />
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label>Start Time</label>
                                            
                                            <div class='input-group time' id='startofevent'>
                                                <input class="form-control" placeholder="Start time: Example: 3:15 PM " name="starttime" id="starttime" data-parsley-trigger="change" required autocomplete="off" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-time"></span>
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group col-lg-12">
                                            <label>End Time (Expected)</label>
                                             <div class='input-group time' id='endofevent'>
                                                <input class="form-control" placeholder="Terminal time: Example: 3:15 PM" name="endtime" id="endtime" data-parsley-trigger="change" required autocomplete="off" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-time"></span>
                                                </span>
                                            </div>
                                        </div>


                                        <div class="form-group col-lg-12">
                                            <label>Brief Event Description</label>
                                            <textarea class="form-control" placeholder="Event Description (100 characters)" name="description" id="description" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Please enter at least 20 characters " data-parsley-validation-threshold="10" required autocomplete="off" ></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-success" id="submit" >Submit </button>
                                        <button type="reset" class="btn btn-default " id="reset">Reset </button>
                                        <button type="button" class="btn " data-dismiss="modal" aria-hidden="true">EXIT</button>

                                        <div class="messagebox alert alert-success"  id="success">
                                            <button type="button" class="close" data-dismiss="alert"></button>
                                            <div class="cs-text">
                                                <i class="fa fa-check-circle-o"></i>
                                                <strong><span> Success!</span></strong>
                                                <p>New event successfully added!</p>
                                            </div>
                                        </div>


                                            <div class="messagebox alert alert-danger"  id="fail">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-times"></i>
                                                    <strong> Failed!</strong>
                                                    <p>Failed to save the event!</p>
                                                </div>
                                            </div>


                                            <div class="messagebox alert alert-info"  id="duplicate">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-info-circle"></i>
                                                    <strong></i> Duplicates!</strong>
                                                    <p>The Event already exists!</p>
                                                </div>
                                            </div>
                                         
                            </form>

                        </div><!--modal-body-->
                    </div>
                    <!-- /.modal-content --> 
                </div>
                <!-- /.modal-dialog --> 
            </div>

            <div class="modal fade" id="editeventinfo" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Edit Event Details </h4>
                        </div>

                        <div class="modal-body">
                            <form role="form" method="POST" action="" id="updateeventinfo">

                                        <div class="form-group col-lg-12" style="display:none;position: absolute;">
                                            <label>ID</label>
                                            <input class="form-control" placeholder="PID" id="pid" name="pid">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label>Event Date</label>
                                            <div class='input-group date' id='dateofevent'>
                                                <input type='text' class="form-control" placeholder="Date of Event:yyyy-mm-dd" id="eventdate" name="eventdate" data-parsley-trigger="change"
                                                       pattern="/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])$/"
                                                        required autocomplete="off" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                        
                                         <div class="form-group col-lg-12">
                                            <label>Event Venue</label>
                                            <input type="text" class="form-control" placeholder="Event venue" name="eventvenue" id="eventvenue"  data-parsley-trigger="change" required autocomplete="off" />
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label>Start Time</label>
                                            
                                            <div class='input-group time' id='startofevent'>
                                                <input class="form-control" placeholder="Start time: Example: 3:15 PM " name="starttime" id="starttime" data-parsley-trigger="change" required autocomplete="off" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-time"></span>
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group col-lg-12">
                                            <label>End Time (Expected)</label>
                                             <div class='input-group time' id='endofevent'>
                                                <input class="form-control" placeholder="Terminal time: Example: 3:15 PM" name="endtime" id="endtime" data-parsley-trigger="change" required autocomplete="off" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-time"></span>
                                                </span>
                                            </div>
                                        </div>


                                        <div class="form-group col-lg-12">
                                            <label>Brief Event Description</label>
                                            <textarea class="form-control" placeholder="Event Description (100 characters)" name="description" id="description" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Please enter at least 20 characters " data-parsley-validation-threshold="10" required autocomplete="off" ></textarea>
                                        </div>


                                        <button type="submit" class="btn btn-success" id="submit" >Submit </button>
                                        <button type="reset" class="btn btn-default " id="reset">Reset </button>
                                        <button type="button" class="btn " data-dismiss="modal" aria-hidden="true">EXIT</button>


                                        <div class="messagebox alert alert-success"  id="success">
                                            <button type="button" class="close" data-dismiss="alert"></button>
                                            <div class="cs-text">
                                                <i class="fa fa-check-circle-o"></i>
                                                <strong><span> Success!</span></strong>
                                                <p>Event updated successfully!<br /></p>
                                            </div>
                                        </div>


                                            <div class="messagebox alert alert-info"  id="nochange">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-info-circle"></i>
                                                    <strong> No changes!</strong>
                                                    <p>You did not make any changes!<br /></p>
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




            <div class="modal fade" id="deleteevent" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title custom_align" id="Heading">Delete this Event</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign">     </span> Are you sure you want to delete this event?
                        </div>
                    </div>

                    <div class="modal-footer ">
                        <button type="submit" class="btn btn-success" id="deleteeventconfirm"><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                    </div>


                    <div class="messagebox alert alert-success"  id="deletesuccess" style="display: none;position:relative;width:82%;top: 0%;left: 10%;">
                            <button type="button" class="close" data-dismiss="alert"></button>
                                    <div class="cs-text">
                                        <i class="fa fa-check-circle-o"></i>
                                        <strong><span> Success!</span></strong>
                                        <p>Event was Successfully Deleted!<br /></p>
                                    </div>
                    </div>


                    <div class="messagebox alert alert-warning"  id="detetefail" style="display: none;position:relative;width:82%;top: 0%;left: 10%;">
                            <button type="button" class="close" data-dismiss="alert"></button>
                                    <div class="cs-text">
                                            <i class="fa fa-info-circle"></i>
                                            <strong></i> Fail!</strong>
                                    <p>Unable to delete event !<br /></p>
                                                </div>
                    </div>

                </div>
                <!-- /.modal-content --> 
            </div>
            <!-- /.modal-dialog --> 
        </div>

           <div class="modal fade" id="eventimage" tabindex="-1" role="dialog" aria-labelledby="Event Image" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                            <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Add Event Image </h4>
                    </div>
                    <div class="modal-body" style="height: 150px;">
                        <?php echo form_open_multipart('index.php/ClubController/upload_eventimage');?>
                        <form role="form" method="POST" action="" id="eventimage">
                        <div class="form-group col-lg-12" style="display:none;position: absolute;">
                            <label>ID</label>
                            <input class="form-control" placeholder="PID" id="pid" name="pid">
                        </div>
                        <div class="form-group col-lg-12">
                        <label>Event Image</label> <span class="star">*</span>
                        <input class="form-control" name="eventimage" id="eventimage" type="file" parsley-trigger="change" required autocomplete="off" size="20">
                        </div>
                        <div class="form-group col-lg-12">
                        <button type="submit" class="btn btn-success" id="submit">Submit </button>
                        <button type="button" class="btn " data-dismiss="modal" aria-hidden="true">EXIT</button>
                    </div>
                    </form>
                    </div>
                    </div>
                </div>
                    <div class="messagebox alert alert-success"  id="success">
                                            <button type="button" class="close" data-dismiss="alert"></button>
                                            <div class="cs-text">
                                                <i class="fa fa-check-circle-o"></i>
                                                <strong><span> Success!</span></strong>
                                                <p>Event Image Uploaded successfully!<br /></p>
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
    
            $("#eventslist").dataTable().fnDestroy();//destroy the table and recreate it for every refresh


                    var table=$('#eventslist').DataTable({responsive:true,"iDisplayLength": 10,"lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],

                    "ajax": {
                    "url":"<?php echo base_url('index.php/ClubController/eventslist')?>",
                    "type":"GET",
                    "dataType":"json"},
                    "columns": [
                    { "data": "count",responsivePriority: 1 },//define column widths
                    { "data": "eventDate" },
                    { "data": "eventVenue" ,responsivePriority: 2},
                    { "data": "startTime" },
                    { "data": "endTime" },
                    { "data": "action" }],


                    //aoColumnDefs This array allows you to target a specific column, multiple columns, or all columns, using the aTargets property of each object in the array
                    "aoColumnDefs": [
                    {"bSortable":false, "aTargets": [0], "orderable": false},
                      {"aTargets": [5],//the target column ie 5th column
                      "orderable": false,
                      "mData": "action",

                      "mRender": function ( data, type, full ) 
                      {
                        return '<span data-placement="top" data-toggle="tooltip" title="Delete Event"><button class="btn btn-danger btn-xs" data-title="Delete Event"  onclick="deleteevent(this);" id="'+data+'_delete" value="'+data+'"><span class="glyphicon glyphicon-trash" ></span></button></span> &nbsp;                                                                                                                                                       <span data-placement="top" data-toggle="tooltip" title="Edit Event"><button class="btn btn-primary btn-xs" data-title="Edit Event" onclick="editevent(this);" value="'+data+'"><span class="fa fa-edit"></span></button></span>&nbsp                                                                                                        <span data-placement="top" data-toggle="tooltip" title="Add Image"><button class="btn btn-primary btn-xs" data-title="Add Image" onclick="eventimage(this);" value="'+data+'"><span class="fa fa-image"></span></button></span>&nbsp';
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
            var table=$('#eventslist').DataTable();
            //assign input values to variables for posting
           var eventdate= $("#addeventinfo #eventinfo input[name=eventdate]").val();
           var eventvenue= $("#addeventinfo #eventinfo input[name=eventvenue]").val();
           var starttime= $("#addeventinfo #eventinfo input[name=starttime]").val();
           var endtime= $("#addeventinfo #eventinfo input[name=endtime]").val();
           var description= $("#addeventinfo #eventinfo textarea").val();

           // alert(eventdate);
            $.ajax(//ajax script to post the data without page refresh
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/ClubController/eventinfosave')?>",
                    data:{ eventdate:eventdate,eventvenue:eventvenue,starttime:starttime,endtime:endtime,description:description},
                    dataType:'json',
                    success:function(data)
                    {
                        // console.log(data);
                        //get json encoded feedback upon submission and respond appropriately
                       if (data.successful)
                        {
                            //if success is returned upon submission, show the success notification
                            $('#addeventinfo #success').show();
                            //fade away the notification after 2000 milliseconds
                            $("#addeventinfo #success").fadeTo(2000, 500).slideUp(500, function(){
                                $("#addeventinfo #success").slideUp(500);
                                });
                        table.ajax.reload( null, false ); // reload the datatable on 

                        //the rest applies as above

                        }else if (data.fail)
                        {
                            $('#addeventinfo #fail').show();
                            $("#addeventinfo #fail").fadeTo(2000, 500).slideUp(500, function(){
                                $("#addeventinfo #fail").slideUp(500);
                                });
                            
                        }else if (data.duplicate)
                        {
                            $('#addeventinfo #duplicate').show();
                            $("#addeventinfo #duplicate").fadeTo(2000, 500).slideUp(500, function(){
                                $("#addeventinfo #duplicate").slideUp(500);
                                });
                            
                        }

                        // $('#addeventinfo #eventinfo')[0].reset();

                    }
                });
              
};
function eventimage(objButton)
{
    var pid=objButton.value;
    $("#eventimage").parsley().reset();
     $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/ClubController/geteventinfo'); ?>",
                    data:{ pid:pid},
                    dataType:'json',

                    success:function(data)
                    {
                        $("#eventimage #pid").val(data.pID);
                        $('#eventimage').modal('toggle');
                        console.log(data);
                        
                    }
                });
}
$("#eventimage #submit").click(function()
                        {
                            $('#eventimage #success').show();
                            $("#eventimage #success").fadeTo(2000, 500).slideUp(500, function(){
                                $("#eventimage #success").slideUp(500);
                                });

                            table.ajax.reload( null, false );
                        });

function editevent(objButton)
{
    var pid=objButton.value;
    $("#updateeventinfo").parsley().reset();
     $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/ClubController/geteventinfo'); ?>",
                    data:{ pid:pid},
                    dataType:'json',

                    success:function(data)
                    {
                        // console.log(data);
                        $("#updateeventinfo input[name=eventdate]").val(data.eventDate);
                        $("#updateeventinfo input[name=eventvenue]").val(data.eventVenue);
                        $("#updateeventinfo input[name=starttime]").val(data.startTime);
                        $("#updateeventinfo input[name=endtime]").val(data.endTime);
                        $("#updateeventinfo textarea[name=description]").val(data.description);
                        $("#updateeventinfo #pid").val(data.pID);

                       
                        $('#editeventinfo').modal('toggle');


                    }
                });


}
function update()
    {
            var table=$('#eventslist').DataTable();
            //assign input values to variables for posting
           var eventdate=$("#updateeventinfo input[name=eventdate]").val();
            var eventvenue=$("#updateeventinfo input[name=eventvenue]").val();
            var starttime=$("#updateeventinfo input[name=starttime]").val();
            var endtime=$("#updateeventinfo input[name=endtime]").val();
            var description=$("#updateeventinfo textarea[name=description]").val();
            var pid=$("#updateeventinfo #pid").val();

            // alert(eventdate);

            $.ajax(//ajax script to post the data without page refresh
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/ClubController/eventinfoupdate');?>",
                    data:{ pid:pid,eventdate:eventdate,eventvenue:eventvenue,starttime:starttime,endtime:endtime,description:description},
                    dataType:'json',

                    success:function(data)
                    {
                        console.log(data);
                        //get json encoded feedback upon submission and respond appropriately
                       if (data.successful)
                        {
                            //if success is returned upon submission, show the success notification
                            $('#updateeventinfo #success').show();
                            //fade away the notification after 2000 milliseconds
                            $("#updateeventinfo #success").fadeTo(2000, 500).slideUp(500, function(){
                                $("#updateeventinfo #success").slideUp(500);
                                });

                            table.ajax.reload( null, false ); // reload the datatable 

                        //the rest applies as above

                        }else if (data.nochange)
                        {
                            $('#updateeventinfo #nochange').show();
                            $("#updateeventinfo #nochange").fadeTo(2000, 500).slideUp(500, function(){
                                $("#updateeventinfo #nochange").slideUp(500);
                                });
                            // $("#addeventinfo ").fadeTo(2000, 200).slideUp(500, function(){
                            //     $("#addeventinfo ").modal('toggle');
                            //     });
                        }else if (data.null)
                        {
                            $('#updateeventinfo #null').show();
                            $("#updateeventinfo #null").fadeTo(2000, 500).slideUp(500, function(){
                                $("#updateeventinfo #null").slideUp(500);
                                });
                            // $("#addeventinfo ").fadeTo(2000, 200).slideUp(500, function(){
                            //     $("#addeventinfo ").modal('toggle');
                            //     });
                        }

                        // $('#addeventinfo #eventinfo')[0].reset();

                    }
                });
    }



function deleteevent(objButton)
{
    
    $('#deleteevent').modal('toggle');


    $( "#deleteeventconfirm").one('click', function(event)
        {
            var table=$('#eventslist').DataTable();

            var id=objButton.value;

            $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/ClubController/deleteevent'); ?>",
                    data:{ id:id},
                    dataType:'json',

                    success:function(data)
                    {

                        if (data.successful)
                        {
                            $('#deleteevent #deletesuccess ').show();
                            $("#deleteevent #deletesuccess").fadeTo(2000, 500).slideUp(500, function(){
                                $("#deleteevent #deletesuccess").slideUp(500);
                                });

                             $("#deleteevent ").fadeTo(1000, 200).slideUp(500, function(){
                                $("#deleteevent ").modal('toggle');
                                });
                            table.ajax.reload( null, false ); // reload the datatable 


                        }else if (data.fail)
                        {
                            $('#deleteevent #deletefail').show();
                            $("#deleteevent #deletefail").fadeTo(2000, 500).slideUp(500, function(){
                                $("#deleteevent #deletefail").slideUp(500);
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




$(function () 
    {
        $('#eventinfo #eventdate').datepicker({  format:'yyyy-mm-dd'   });
        $('#updateeventinfo #eventdate').datepicker({  format:'yyyy-mm-dd'   });
    });

// $(function () 
//     {
//         $('#clubofficialreg .input-daterange').datepicker({  format:'yyyy-mm-dd'   });
//     });

</script>
 <script>
            var resizefunc = [];
</script>

    
<script type="text/javascript">
    
    $(document).ready(function() {
            
        $('#eventinfo').parsley();
        $('#updateeventinfo').parsley();

            });

    $('#eventinfo').submit( function(e) 
        { 
            e.preventDefault(e);
            if ( $(this).parsley().isValid() ) 
                {
                    submitData();       
                }
        });

    $('#updateeventinfo').submit( function(e) 
        { 
            e.preventDefault(e);
            if ( $(this).parsley().isValid() ) 
                {
                    update();       
                }
        });

    $(function () 
        {
                $('#updateeventinfo #eventdate').datepicker({
                format: "yyyy-mm-dd",
                todayHighlight: true,
                autoclose: true,
                calendarWeeks: false
                });

                $('#eventinfo #eventdate').datepicker({
                format: "yyyy-mm-dd",
                todayHighlight: true,
                autoclose: true,
                calendarWeeks: false
                });

                 $('#updateeventinfo #startofevent').datetimepicker({
                    format: 'LT'
                });
                 $('#eventinfo #startofevent').datetimepicker({
                    format: 'LT'
                });

                $('#updateeventinfo #endofevent').datetimepicker({
                    format: 'LT'
                });
                $('#eventinfo #endofevent').datetimepicker({
                    format: 'LT'
                });
            });


</script>

</body>
</html>
