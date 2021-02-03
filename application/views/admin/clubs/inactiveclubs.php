
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
    
    <link href="<?php echo base_url('assets/general-css/customcss.css');?>" rel="stylesheet" type="text/css">


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
                    <h4 class="page-header" style="margin-top:10px;color:blue">Inactive Strathmore University Clubs</h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
         
                        

             <span data-placement="top" data-toggle="tooltip" title="Refresh"><button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh</button>
            </span>

            <span data-placement="top" data-toggle="tooltip" title="Print All">
                    <a class="btn btn-xs" data-title="Print All" type="button" href="<?php echo base_url('Home/inactiveclubspdf');?>"><span class="fa fa-print"></span>&nbsp;Print All</a>
            </span>
            <br><br>
            <div class="row">
                <div class="col-md-12">
                    <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%" id="inactiveclubs"  >
                        <thead>
                            <tr>
                                        
                                <th class="text-center">#</th>
                                <th class="text-center">Club Name</th>
                                <th class="text-center">Club Email</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Activate</th>
                             </tr>
                        </thead>
                        <tbody >
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
            </div>


            <div class="modal fade" id="activateclub" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Activate this club</h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger"><span class="glyphicon glyphicon-success-sign">     </span> Are you sure you want to activate this club?
                            </div>
                        </div>

                        <div class="modal-footer ">
                            <button type="submit" class="btn btn-danger" id="activateclubconfirm"><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                            <button type="button" class="btn " data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                        </div>


                        <div class="messagebox alert alert-success"  id="activatesuccess" style="display: none;position:relative;width:82%;top: 0%;left: 10%;">
                                <button type="button" class="close" data-dismiss="alert"></button>
                                        <div class="cs-text">
                                                <i class="fa fa-check-circle-o"></i>
                                                    <strong><span> Success!</span></strong>
                                                     <p>Club was Successfully activated!<br /></p>
                                        </div>
                        </div>


                        <div class="messagebox alert alert-warning"  id="activatefail" style="display: none;position:relative;width:82%;top: 0%;left: 10%;">
                                <button type="button" class="close" data-dismiss="alert"></button>
                                        <div class="cs-text">
                                                <i class="fa fa-info-circle"></i>
                                                <strong></i> Fail!</strong>
                                        <p>Unable to activate club !<br /></p>
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
                    { "data": "status",responsivePriority: 4 },
                    { "data": "action" }],




                    //aoColumnDefs This array allows you to target a specific column, multiple columns, or all columns, using the aTargets property of each object in the array
                    "aoColumnDefs": [
                    {"bSortable":false, "aTargets": [0], "orderable": false},
                      {"aTargets": [4],//the target column ie 7th column
                      "orderable": false,
                      "mData": "action",

                      "mRender": function ( data, type, full ) 
                      {
                        return '                                                                                                          <span data-placement="top" data-toggle="tooltip" title="Mark as Active"><button  class="btn  btn-xs" data-title="Mark as Inactive" data-toggle="modal" onclick="activateclub(this);" id='+data+'"_activate" value="'+data+'"><span class="fa fa-check-circle-o"></span></button></span>';
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

                table.ajax.reload( null, false ); // reload the datatable 

    });


//=======================================================================================


function activateclub(objButton)
{

    
    $('#activateclub').modal('toggle');
    
    var id=objButton.value;
    // alert(id);

    $( "#activateclubconfirm").one('click', function(event)
        {
           
            event.preventDefault(event);

            var table=$('#inactiveclubs').DataTable();
            
            $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/Home/activateclub'); ?>",
                    data:{ id:id},
                    dataType:'json',

                    success:function(data)
                                   
                    { 

                        console.log(data);
                      

                        if (data.successful)
                            {
                               

                                $('#activateclub #activatesuccess ').show();

                                $("#activateclub #activatesuccess").fadeTo(2000, 500).slideUp(500, function(){
                                    $("#activateclub #activatesuccess").slideUp(500);
                                    });

                                 $("#activateclub ").fadeTo(1000, 200).slideUp(500, function(){
                                        $("#activateclub ").modal('toggle');
                                    
                                    });
                                table.ajax.reload( null, false ); // reload the datatable 
                            



                        }else  if (data.fail) 
                            {
                                
                                $('#activateclub #activatefail').show();
                                $("#activateclub #activatefail").fadeTo(2000, 500).slideUp(500, function(){

                                    $("#activateclub #activatefail").slideUp(500);
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




</script>

</body>
</html>
