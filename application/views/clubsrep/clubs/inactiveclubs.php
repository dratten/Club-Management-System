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

    <?php $this->load->view('clubsrep/clubsrepnav.php'); ?><!--navigation -->


    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header" style="margin-top:10px;color:blue">Inactive Strathmore University Clubs</h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
         
                        

             <span data-placement="top" data-toggle="tooltip" title="Refresh"><button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh</button>
            </span>

            <span data-placement="top" data-toggle="tooltip" title="Print All">
                    <a class="btn btn-xs" data-title="Print All" type="button" href="<?php echo base_url('index.php/Home/inactiveclubspdf');?>"><span class="fa fa-print"></span>&nbsp;Print All</a>
            </span>
            <br><br>
            <div class="row">
                <div class="col-md-12">
                    <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%"" id="inactiveclubs"  >
                        <thead>
                            <tr>
                                        
                                <th class="text-center">#</th>
                                <th class="text-center">Club Name</th>
                                <th class="text-center">Club Email</th>
                                <th class="text-center">Status</th>
                             </tr>
                        </thead>
                        <tbody >
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
            </div>
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<!-- javascript -->
<?php $this->load->view('scriptlinks/scriptlinks.php'); ?>
<script>


   $(document).ready(function () 

   {
    
            $("#inactiveclubs").dataTable().fnDestroy();//destroy the table and recreate it for every refresh


                     var table=$('#inactiveclubs').DataTable({responsive:true,"iDisplayLength": 10,"lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],

                    "ajax": {
                    "url":"<?php echo base_url('index.php/Home/inactiveclubslist'); ?>",
                    "type":"GET",
                    "dataType":"json"},
                    "columns": [
                    { "data": "count",responsivePriority: 1 },
                    { "data": "clubName",responsivePriority: 2 },
                    { "data": "clubID" },
                    { "data": "status",responsivePriority: 4 }],




                    //aoColumnDefs This array allows you to target a specific column, multiple columns, or all columns, using the aTargets property of each object in the array
                    "aoColumnDefs": [
                    {"bSortable":false, "aTargets": [0], "orderable": false}],
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

    });



//to refresh the page
$( "#refresh").click( function(event)
        {
            window.setTimeout(function(){location.reload()},1)

        });




</script>

</body>
</html>
