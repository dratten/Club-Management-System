
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
    #eventattendancelist th
        {
            border-bottom:2px solid;
            border-color: grey;
        }
    #eventattendancelist
        {
            border-bottom:none;
        }
</style>

</head>

<body>

<div id="wrapper">

    <?php $this->load->view('admin/adminnav.php'); ?><!--navigation -->


    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header" style="margin-top:10px;color:blue"><span><?php  echo $clubname; echo ": Attendance for the event held on ";echo $date. " at ". $venue ." from ". $from;?></span><span id="event_"></span> </h4>
                </div>
                <!-- /.col-lg-12 -->
            </div><span>
         
                        

             <span data-placement="top" data-toggle="tooltip" title="Refresh"><button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh</button>
            </span>

            <span data-placement="top" data-toggle="tooltip" title="Print All">
                    <a class="btn btn-xs" data-title="Print All" type="button" href="#"><span class="fa fa-print"></span>&nbsp;Print All</a>
            </span>
            <br><br>
            <div class="row">
                <div class="col-md-12">
                  <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%"  id="eventattendancelist">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Student ID</th>
                                <th class="text-center">Full name</th>
                                <th class="text-center">Status</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
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
            $("#eventattendancelist").dataTable().fnDestroy();//destroy the table and recreate it for every refresh
            
                var table=$('#eventattendancelist').DataTable({ paging:true,responsive:true,"iDisplayLength": 10,"lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],
                    
                // var table=$('#eventattendancelist').DataTable({"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

                    "ajax": {
                    "url":"<?php echo base_url('index.php/ClubController/vieweventattendancelist')?>",
                    "type":"GET",
                    "dataType":"json"},
                    "columns": [
                        { "data": "count" ,responsivePriority: 1},//define column widths
                        { "data": "suID" },
                        { "data": "fullName" ,responsivePriority: 2},
                        { "data": "status",responsivePriority: 3 }],
                    "aoColumnDefs": [
                         {"bSortable":false, "aTargets": [0], "orderable": false},
                      
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



//to refresh the page
$( "#refresh").click( function(event)
        {
            window.setTimeout(function(){location.reload()},1)

        });




</script>

</body>
</html>
