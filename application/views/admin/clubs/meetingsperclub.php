
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

</head>

<body>

<div id="wrapper">

    <?php $this->load->view('admin/adminnav.php'); ?><!--navigation -->

    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header" style="margin-top:10px;color:blue"><span id="clubname_"></span><span> Meetings</span> </h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
         

             <div class="form-group col-lg-6" >
                    <label for="" style="color:blue">Select Club</label>
                        <select id="clubid" name="clubid" class="form-control">
                                <option value="All">All Clubs</option>
                        </select>
            </div>

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
                                <th class="text-center"><span id="stateclub"></span></th>
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


    </div> 
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
     <?php $this->load->view('scriptlinks/scriptlinks.php'); ?>

<script>


   $(document).ready(function () 

   {
            
           var clubID=$('#clubid').val();
           var clubName=$('#clubid option:selected').text();
           document.getElementById('clubname_').innerHTML=clubName;
    
            $("#meetingslist").dataTable().fnDestroy();//destroy the table and recreate it for every refresh


                  var table=$('#meetingslist').DataTable({responsive:true,"iDisplayLength": 10,"lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],

                    "ajax": {
                    "url":'<?php echo base_url('index.php/ClubController/meetingsperclub')?>'+"?clubID="+clubID,
                    "type":"GET",
                    "dataType":"json"},
                    "columns": [
                    { "data": "count",responsivePriority: 1 },//define column widths
                    { "data": "meetingDate" },
                    { "data": "meetingVenue" ,responsivePriority: 2},
                    { "data": "startTime" },
                    { "data": "endTime" },
                    { "data": "clubName" ,responsivePriority: 3},
                    { "data": "action" }],


                    //aoColumnDefs This array allows you to target a specific column, multiple columns, or all columns, using the aTargets property of each object in the array
                    "aoColumnDefs": [
                    {"bSortable":false, "aTargets": [0], "orderable": false, "sWidth": "5%"},
                    {"aTargets": [1], "sWidth": "15%"},
                    {"aTargets": [2], "sWidth": "20%"},
                    {"aTargets": [3], "sWidth": "15%"},
                    {"aTargets": [4], "sWidth": "15%"},
                    {"aTargets": [5], "sWidth": "25%"},
                      {"aTargets": [6], "sWidth": "5%",
                      "orderable": false,
                      "mData": "action",

                      "mRender": function ( data, type, full ) 
                      {
                        return '<span data-placement="top" data-toggle="tooltip" title="View Attendance"><button class="btn  btn-xs" data-title="View Attendance" onclick="viewattendance(this);" value="'+data+'"><span class="fa fa-group"></span></button></span>&nbsp'; 
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

                $.ajax(
                    {
                        type:"post",
                        url: "<?php echo base_url('index.php/Home/clubdropdownlist'); ?>",
                        dataType:'json',

                        success:function(data)
                        {

                             $.each(data,function(clubID,clubName)
                                {
                                    var opt = $('<option />'); 

                                    opt.val(clubID);
                                    opt.text(clubName);
                                    $('#clubid').append(opt);
                                });

                        }
                    });

    });
   
$('#clubid').on('change', function() 
{
   
           var clubID=$('#clubid').val();
           var clubName=$('#clubid option:selected').text();
           document.getElementById('clubname_').innerHTML=clubName;
           if(clubID!=="All")
             {
                document.getElementById('stateclub').innerHTML="Taking Minutes";
              }else
                {
                    document.getElementById('stateclub').innerHTML="Club";

                }
    
            $("#meetingslist").dataTable().fnDestroy();//destroy the table and recreate it for every refresh


                   $("#meetingslist").dataTable().fnDestroy();//destroy the table and recreate it for every refresh


                  var table=$('#meetingslist').DataTable({responsive:true,"iDisplayLength": 10,"lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],

                    "ajax": {
                    "url":'<?php echo base_url('index.php/ClubController/meetingsperclub')?>'+"?clubID="+clubID,
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
                    {"aTargets": [1], "sWidth": "15%"},
                    {"aTargets": [2], "sWidth": "20%"},
                    {"aTargets": [3], "sWidth": "15%"},
                    {"aTargets": [4], "sWidth": "15%"},
                    {"aTargets": [5], "sWidth": "25%"},
                      {"aTargets": [6], "sWidth": "5%",
                      "orderable": false,
                      "mData": "action",

                      "mRender": function ( data, type, full ) 
                      {
                        return '<span data-placement="top" data-toggle="tooltip" title="View Attendance"><button class="btn  btn-xs" data-title="View Attendance" onclick="viewattendance(this);" value="'+data+'"><span class="fa fa-group"></span></button></span>&nbsp'; 
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
                // window.onresize = function() {  table.columns.adjust().responsive.recalc(); }
                window.onresize = function() {  window.setTimeout(function(){location.reload()},1); }
                

    });


function viewattendance(objButton)
    {
      var meetingID=objButton.value;
        var clubName=$('#clubid option:selected').text();
      
      window.location.href = '<?php echo site_url('index.php/ClubController/viewmeetingattperclubid');?>?meetingID='+meetingID+'&clubName='+clubName;
    }

//to refresh the page
$( "#refresh").click( function(event)
        {
            window.setTimeout(function(){location.reload()},1)

        });



</script>

</body>
</html>
