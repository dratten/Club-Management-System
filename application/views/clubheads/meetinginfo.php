
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
    #meetingslist td:nth-child(1),td:nth-child(2),td:nth-child(3) ,td:nth-child(4) ,td:nth-child(5) ,td:nth-child(6),td:nth-child(7)  
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
                    <h4 class="page-header" style="margin-top:10px;color:blue"><span><?php  echo $this->session->userdata('clubName'); echo " Meetings";?></span></h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        
        <span data-placement="top" data-toggle="tooltip" title="Add Meeting Info">
                    <button class="btn btn-primary btn-xs" data-title="Add Meeting Info" data-toggle="modal" data-target="#addmeetinginfo" id="addmeetingbtn"><span class="fa fa-plus-circle"></span>&nbsp;Add Meeting Info</button></span>
            <span data-placement="top" data-toggle="tooltip" title="Refresh">
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
   
            <div class="modal fade" id="addmeetinginfo" tabindex="-1" role="dialog" aria-labelledby="add meeting" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Add Meeting Details </h4>
                        </div>

                        <div class="modal-body">
                            <form role="form" method="POST" action="" id="meetinginfo">
                                        <div class="form-group col-lg-12">
                                            <label>Meeting Date</label>
                                            <div class='input-group date' id='dateofmeeting'>
                                                <input type='text' class="form-control" placeholder="Date of Meeting:yyyy-mm-dd" id="meetingdate" name="meetingdate" data-parsley-trigger="change"
                                                       pattern="/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])$/"
                                                        required autocomplete="off" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label>Meeting Venue</label>
                                            <input class="form-control" placeholder="Meeting venue" name="meetingvenue" id="meetingvenue" type="text" data-parsley-trigger="change" required autocomplete="off" />
                                        </div>
                                        
                                        <div class="form-group col-lg-12">
                                            <label>Start Time</label>
                                            
                                            <div class='input-group time' id='startofmeeting'>
                                                <input class="form-control" placeholder="Start time: Example: 3:15 PM " name="starttime" id="starttime" data-parsley-trigger="change" required autocomplete="off" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-time"></span>
                                                </span>
                                            </div>
                                        </div>
                                                                         

                                        <div class="form-group col-lg-12">
                                            <label>End Time</label>
                                            <!-- <input class="form-control" placeholder="Adjournment time" name="endtime" id="endtime" type="time"> -->
                                             <div class='input-group time' id='endofmeeting'>
                                                <input class="form-control" placeholder="Adjournment time: Example: 3:15 PM" name="endtime" id="endtime" data-parsley-trigger="change" required autocomplete="off" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-time"></span>
                                                </span>
                                            </div>
                                        </div>

                                        

                                        <div class="form-group col-lg-12">
                                            <label for="">Taking Minutes</label>
                                                <select class="form-control" placeholder="Student ID e.g. 78581" name="studentid" id="studentid" data-parsley-trigger="change" required autocomplete="off" />
                                                    <option value="">--Select Official---</option>
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
                                                    <p>Meeting information successfully added!<br /></p>
                                                </div>
                                            </div>


                                            <div class="messagebox alert alert-info"  id="error">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-times"></i>
                                                    <strong> Failed!</strong>
                                                    <p>An error occurred!<br /></p>
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
                                            <div class="messagebox alert alert-info"  id="duplicate">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-info-circle"></i>
                                                    <strong></i> Duplicate Entries!</strong>
                                                    <p>The Meeting Info has already been added!<br /></p>
                                                </div>
                                            </div>
                                         
                            </form>

                        </div><!--modal-body-->
                    </div>
                    <!-- /.modal-content --> 
                </div>
                <!-- /.modal-dialog --> 
            </div>

            <div class="modal fade" id="editmeetinginfo" tabindex="-1" role="dialog" aria-labelledby="edit meeting" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Edit Meeting Details </h4>
                        </div>

                        <div class="modal-body">
                            <form role="form" method="POST" action="" id="updatemeetinginfo">
                                        <div class="form-group col-lg-12" style="display:none;position: absolute;">
                                            <label>ID</label>
                                            <input class="form-control" placeholder="PID" id="pid" name="pid">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label>Meeting Date</label>
                                            <div class='input-group date' id='dateofmeeting'>
                                                <input type='text' class="form-control" placeholder="Date of Meeting:yyyy-mm-dd" id="meetingdate" name="meetingdate" data-parsley-trigger="change"
                                                       pattern="/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])$/"
                                                        required autocomplete="off" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label>Meeting Venue</label>
                                            <input class="form-control" placeholder="Meeting venue" name="meetingvenue" id="meetingvenue" type="text" data-parsley-trigger="change" required autocomplete="off" />
                                        </div>
                                        
                                        <div class="form-group col-lg-12">
                                            <label>Start Time</label>
                                            
                                            <div class='input-group time' id='startofmeeting'>
                                                <input class="form-control" placeholder="Start time: Example: 3:15 PM " name="starttime" id="starttime" data-parsley-trigger="change" required autocomplete="off" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-time"></span>
                                                </span>
                                            </div>
                                        </div>
                                                                         

                                        <div class="form-group col-lg-12">
                                            <label>End Time</label>
                                            <!-- <input class="form-control" placeholder="Adjournment time" name="endtime" id="endtime" type="time"> -->
                                             <div class='input-group time' id='endofmeeting'>
                                                <input class="form-control" placeholder="Adjournment time: Example: 3:15 PM" name="endtime" id="endtime" data-parsley-trigger="change" required autocomplete="off" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-time"></span>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label for="">Taking Minutes</label>
                                                <select class="form-control" placeholder="Student ID e.g. 78581" name="studentid" id="studentid" data-parsley-trigger="change" required autocomplete="off" />
                                                    <option value="">--Select Official---</option>
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
                                                    <p>Meeting information successfully updated!<br /></p>
                                                </div>
                                            </div>


                                            <div class="messagebox alert alert-info"  id="nochange">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-info-circle"></i>
                                                    <strong> No change!</strong>
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


                    <div class="messagebox alert alert-success"  id="deletesuccess" style="display: none;position:relative;width:82%;top: 0%;left: 10%;">
                            <button type="button" class="close" data-dismiss="alert"></button>
                                    <div class="cs-text">
                                            <i class="fa fa-check-circle-o"></i>
                                                <strong><span> Success!</span></strong>
                                                 <p>Meeting was Successfully Deleted!<br /></p>
                                    </div>
                    </div>


                    <div class="messagebox alert alert-warning"  id="detetefail" style="display: none;position:relative;width:82%;top: 0%;left: 10%;">
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
        $('#meetinginfo').parsley();
        $('#updatemeetinginfo').parsley();
    
            $("#meetingslist").dataTable().fnDestroy();//destroy the table and recreate it for every refresh
            var table=$('#meetingslist').DataTable({responsive:true,"iDisplayLength": 10,"lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],

                    "ajax": {
                    "url":"<?php echo base_url('index.php/ClubController/meetingslist');?>",
                    "type":"GET",
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
                        return ' <span data-placement="top" data-toggle="tooltip" title="Delete Meeting"><button class="btn btn-danger btn-xs" data-title="Delete Meeting"  onclick="deletemeeting(this);" id="'+data+'_delete" value="'+data+'"><span class="glyphicon glyphicon-trash" ></span></button></span> &nbsp;                                                                                                                                                       <span data-placement="top" data-toggle="tooltip" title="Edit Meeting"><button class="btn btn-primary btn-xs" data-title="Edit Meeting" onclick="editmeeting(this);" value="'+data+'"><span class="fa fa-edit"></span></button></span>&nbsp'; 
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


//=======================club dropdown list on registration form toggle view=========================

$( "#addmeetingbtn").on('click', function(event)
        {
            event.preventDefault(event);//prevent auto submit data
         
             $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/Home/clubofficialsdropdownlist'); ?>",
                    dataType:'json',

                    success:function(data)
                    {
                         $.each(data,function(pID,fullName)
                            {
                               //assign values to dropdown list
                                var opt = $('<option />'); 

                                opt.val(pID);
                                opt.text(fullName);
                                $('#meetinginfo #studentid').append(opt);

                                    //sort the dropdown list 
                                    var options = $('#meetinginfo #studentid option');
                                    var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
                                    arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
                                    options.each(function(i, o) {
                                      o.value = arr[i].v;
                                      $(o).text(arr[i].t);
                                    });


                                    //this code removes duplicates from the list above
                                    var seen = {};
                                    jQuery('#meetinginfo #studentid').children().each(function() 
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

  //=======================================================================================


function submitData()
    {
            
            var table=$('#meetingslist').DataTable();
            //assign input values to variables for posting
           var meetingdate= $("#meetinginfo input[name=meetingdate]").val();
           var meetingvenue= $("#meetinginfo input[name=meetingvenue]").val();
           var starttime= $("#meetinginfo input[name=starttime]").val();
           var endtime= $("#meetinginfo input[name=endtime]").val();

      
           var studentpid= $("#meetinginfo #studentid").val();

            // alert(meetingdate);

            $.ajax(//ajax script to post the data without page refresh
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/ClubController/meetinginfosave');?>",
                    data:{ meetingdate:meetingdate,meetingvenue:meetingvenue,starttime:starttime,endtime:endtime,studentpid:studentpid},
                    dataType:'json',

                    success:function(data)
                    {
                        console.log(data);
                        //get json encoded feedback upon submission and respond appropriately
                       if (data.successful)
                        {
                            //if success is returned upon submission, show the success notification
                            $('#addmeetinginfo #success').show();
                            //fade away the notification after 2000 milliseconds
                            $("#addmeetinginfo #success").fadeTo(2000, 500).slideUp(500, function(){
                                $("#addmeetinginfo #success").slideUp(500);
                                });

                            table.ajax.reload( null, false ); // reload the datatable 

                        //the rest applies as above

                        }else if (data.error)
                        {
                            $('#addmeetinginfo #error').show();
                            $("#addmeetinginfo #error").fadeTo(2000, 500).slideUp(500, function(){
                                $("#addmeetinginfo #error").slideUp(500);
                                });
                            // $("#addmeetinginfo ").fadeTo(2000, 200).slideUp(500, function(){
                            //     $("#addmeetinginfo ").modal('toggle');
                            //     });
                        }else if (data.null)
                        {
                            $('#addmeetinginfo #null').show();
                            $("#addmeetinginfo #null").fadeTo(2000, 500).slideUp(500, function(){
                                $("#addmeetinginfo #null").slideUp(500);
                                });
                            // $("#addmeetinginfo ").fadeTo(2000, 200).slideUp(500, function(){
                            //     $("#addmeetinginfo ").modal('toggle');
                            //     });
                        } else if (data.duplicate){
                            $('#addmeetinginfo #duplicate').show();
                            $("#addmeetinginfo #duplicate").fadeTo(2000, 500).slideUp(500, function(){
                                $("#addmeetinginfo #duplicate").slideUp(500);
                                });
                            // $("#addmeetinginfo ").fadeTo(2000, 200).slideUp(500, function(){
                            //     $("#addmeetinginfo ").modal('toggle');
                            //     });
                        }

                        // $('#addmeetinginfo #meetinginfo')[0].reset();

                    }
                });
              
    }


function editmeeting(objButton)
{
    var pid=objButton.value;
    $("#updatemeetinginfo").parsley().reset();
    $("#updatemeetinginfo #studentid").parsley().reset();
     $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/ClubController/getmeetinginfo'); ?>",
                    data:{ pid:pid},
                    dataType:'json',

                    success:function(data)
                    {
                        $("#updatemeetinginfo input[name=meetingdate]").val(data.meetingDate);
                        $("#updatemeetinginfo input[name=meetingvenue]").val(data.meetingVenue);
                        $("#updatemeetinginfo input[name=starttime]").val(data.startTime);
                        $("#updatemeetinginfo input[name=endtime]").val(data.endTime);
                        $("#updatemeetinginfo #pid").val(data.pID);

                        $('#updatemeetinginfo #studentid').empty();
                        
                        var studentID=data.studentID;
                        var fullName=data.firstName+ " "+data.lastName;
                        var opt = $('<option />');
                            opt.val(studentID);
                            opt.text(fullName);

                        $('#updatemeetinginfo #studentid').append(opt);
                       
                        $('#editmeetinginfo').modal('toggle');

                        $('#updatemeetinginfo #studentid').click();

                    }
                });


}
$( "#updatemeetinginfo #studentid").on('click', function(event)
        {
            event.preventDefault(event);//prevent auto submit data

            $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/Home/clubofficialsdropdownlist'); ?>",
                    dataType:'json',

                    success:function(data)
                    {
                         $.each(data,function(pID,fullName)
                            {
                               //assign values to dropdown list
                                var opt = $('<option />'); 

                                opt.val(pID);
                                opt.text(fullName);
                                $('#updatemeetinginfo #studentid').append(opt);

                                    //this code removes duplicates from the list above
                                    var seen = {};
                                    jQuery('#updatemeetinginfo #studentid').children().each(function() 
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

function update()
    {
            var table=$('#meetingslist').DataTable();
            //assign input values to variables for posting
           var meetingdate= $("#updatemeetinginfo input[name=meetingdate]").val();
           var meetingvenue= $("#updatemeetinginfo input[name=meetingvenue]").val();
           var starttime= $("#updatemeetinginfo input[name=starttime]").val();
           var endtime= $("#updatemeetinginfo input[name=endtime]").val();
           var studentpid= $("#updatemeetinginfo #studentid").val();

           var pid= $("#updatemeetinginfo #pid").val();

            // alert(meetingdate);

            $.ajax(//ajax script to post the data without page refresh
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/ClubController/meetinginfoupdate');?>",
                    data:{ pid:pid,meetingdate:meetingdate,meetingvenue:meetingvenue,starttime:starttime,endtime:endtime,studentpid:studentpid},
                    dataType:'json',

                    success:function(data)
                    {
                        console.log(data);
                        //get json encoded feedback upon submission and respond appropriately
                       if (data.successful)
                        {
                            //if success is returned upon submission, show the success notification
                            $('#updatemeetinginfo #success').show();
                            //fade away the notification after 2000 milliseconds
                            $("#updatemeetinginfo #success").fadeTo(2000, 500).slideUp(500, function(){
                                $("#updatemeetinginfo #success").slideUp(500);
                                });

                            table.ajax.reload( null, false ); // reload the datatable 

                        //the rest applies as above

                        }else if (data.nochange)
                        {
                            $('#updatemeetinginfo #nochange').show();
                            $("#updatemeetinginfo #nochange").fadeTo(2000, 500).slideUp(500, function(){
                                $("#updatemeetinginfo #nochange").slideUp(500);
                                });
                            // $("#addmeetinginfo ").fadeTo(2000, 200).slideUp(500, function(){
                            //     $("#addmeetinginfo ").modal('toggle');
                            //     });
                        }else if (data.null)
                        {
                            $('#updatemeetinginfo #null').show();
                            $("#updatemeetinginfo #null").fadeTo(2000, 500).slideUp(500, function(){
                                $("#updatemeetinginfo #null").slideUp(500);
                                });
                            // $("#addmeetinginfo ").fadeTo(2000, 200).slideUp(500, function(){
                            //     $("#addmeetinginfo ").modal('toggle');
                            //     });
                        }

                        // $('#addmeetinginfo #meetinginfo')[0].reset();

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
                    url: "<?php echo base_url('index.php/ClubController/deletemeeting'); ?>",
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


$(function () 
    {
        $('#meetinginfo #meetingdate').datepicker({  format:'yyyy-mm-dd'   });
        $('#updatemeetinginfo #meetingdate').datepicker({  format:'yyyy-mm-dd'   });
    });

// $(function () 
//     {
//         $('#clubofficialreg .input-daterange').datepicker({  format:'yyyy-mm-dd'   });
//     });


var resizefunc = [];

    $('#meetinginfo').submit( function(e) 
        { 
            e.preventDefault(e);
            if ( $(this).parsley().isValid() ) 
                {
                    submitData();       
                }
        });

    $('#updatemeetinginfo').submit( function(e) 
        { 
            e.preventDefault(e);
            if ( $(this).parsley().isValid() ) 
                {
                    update();       
                }
        });

    $(function () 
        {
                $('#updatemeetinginfo #meetingdate').datepicker({
                format: "yyyy-mm-dd",
                todayHighlight: true,
                autoclose: true,
                calendarWeeks: false
                });

                $('#meetinginfo #meetingdate').datepicker({
                format: "yyyy-mm-dd",
                todayHighlight: true,
                autoclose: true,
                calendarWeeks: false
                });

                 $('#updatemeetinginfo #startofmeeting').datetimepicker({
                    format: 'LT'
                });
                 $('#meetinginfo #startofmeeting').datetimepicker({
                    format: 'LT'
                });

                $('#updatemeetinginfo #endofmeeting').datetimepicker({
                    format: 'LT'
                });
                $('#meetinginfo #endofmeeting').datetimepicker({
                    format: 'LT'
                });
            });
        
       
</script>

</body>
</html>

