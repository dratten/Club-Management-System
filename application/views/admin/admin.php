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
    </style>

</head>

<body>

<div id="wrapper">

    <?php $this->load->view('admin/adminnav.php'); ?>


    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header" style="margin-top:10px;color:blue">Active Strathmore University Clubs</h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
         
            
                        <span data-placement="top" data-toggle="tooltip" title="Add Club">
                    <button class="btn btn-primary btn-xs" data-title="Add Club" data-toggle="modal" data-target="#addclub" ><span class="fa fa-plus-circle"></span>&nbsp;Add Club</button></span>

             <span data-placement="top" data-toggle="tooltip" title="Refresh to update number of entries"><button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh</button>
            </span>

            <span data-placement="top" data-toggle="tooltip" title="Print All">
                    <a class="btn btn-xs" data-title="Print All" type="button" href="<?php echo base_url('index.php/Home/clubspdf');?>"><span class="fa fa-print"></span>&nbsp;Print All</a>
            </span>
            <br><br>
            <div class="row">
                <div class="col-md-12">
                    <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%" id="clubslist"  >
                        <thead>
                            <tr>      
                                <th class="text-center">#</th>
                                <th class="text-center">Club Name</th>
                                <th class="text-center">Club Email</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                             </tr>
                        </thead>
                        <tbody >
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
            </div>

            <!--Add Club-->
            <div class="modal fade" id="addclub" tabindex="-1" role="dialog" aria-labelledby="Add" aria-hidden="true" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Add New Club</h4>
                        </div>

                        <div class="modal-body">
                            <form role="form" method="POST" action="" id="clubreg">

                                <div class="messagebox alert alert-success" id="success" style="display: none;position:relative;width:82%;top: 0%;left: 10%;">
                                    <span>
                                            <strong>Success: </strong>New Club Successfully Registered
                                    </span>
                                </div>

                                <div class="messagebox alert alert-danger" id="fail" style="display: none;position:relative;width:82%;top: 0%;left: 10%;">
                                    
                                    <span>
                                            <strong>Fail: </strong>Registration Failed. Duplicate Entries. 
                                    </span>
                                </div>

                                 <div class="messagebox alert alert-danger" id="null" style="display: none;position:relative;width:82%;top: 0%;left: 10%;">
                                    
                                    <span>
                                            <strong>Failed: </strong>A required field is missing
                                    </span>
                                </div>
                                <div class="messagebox alert alert-danger" id="exists" style="display: none;position:relative;width:82%;top: 0%;left: 10%;">
                                    
                                    <span>
                                            <strong>This Club Exists: </strong>Activate the Club
                                    </span>
                                </div>

                                            <div class="form-group col-lg-12">
                                            <label>Club Email<span class="star">*</span></label>
                                            <input id="clubid" class="form-control" placeholder="Club Email" name="clubid" type="email" parsley-type="email" required autocomplete="off" />
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label>Name of the Club<span class="star">*</span></label>
                                            <input id="clubname" class="form-control" placeholder="Club Name" name="clubname" type="text" parsley-trigger="change" required autocomplete="off" />
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label>Year Started</label>
                                            <input id="yearstarted" class="form-control" placeholder="Year started e.g. 2000" name="yearstarted" type="year" >
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label>Year Rebranded</label>
                                            <input id="yearrebranded" class="form-control" placeholder="Year rebranded e.g. 2014" name="yearrebranded" type="year" />
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label>Registration Fee<span class="star">*</span></label>
                                            <input id="registrationfee" class="form-control" placeholder="Registration Fee e.g. 100" name="registrationfee" type="number" parsley-trigger="change" required autocomplete="off" />
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label>Registration Basis<span class="star">*</span></label>
                                            <select id="regbasis" name="regbasis" class="form-control" type="text" parsley-trigger="change" required autocomplete="off" />
                                                    <option value="Per Year">Per Year</option>
                                                    <option value="Per Semester">Per Semester</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                        </div>

                                         <button type="submit" class="btn btn-success" id="submit" >Submit </button>
                                        <button type="reset" class="btn btn-default " id="reset">Reset </button>
                                        <button type="button" class="btn " data-dismiss="modal" aria-hidden="true">EXIT</button>


                            </form>
                        </div>
                        <!--modal-body-->
                    </div>
                    <!-- /.modal-content --> 
                </div>
                <!-- /.modal-dialog --> 
            </div>
            <!--Edit club-->


            


            <!--Edit Club-->
            <div class="modal fade" id="editclub" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Edit Club Details</h4>
                        </div>

                        <div class="modal-body">
                            <form role="form" method="POST" action="" id="editclubreg">
                                <div class="messagebox alert alert-danger" id="nochange" >
                                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> -->
                                    <span>
                                            <strong>No change: </strong>You did not make any changes 
                                    </span>
                                </div>

                                <div class="messagebox alert alert-success" id="success" >
                                    
                                    <span>
                                            <strong>Success: </strong>Your changes have been saved 
                                    </span>
                                </div>

                                 <div class="messagebox alert alert-danger" id="null" >
                                    
                                    <span>
                                            <strong>Failed: </strong>A required field is missing
                                    </span>
                                </div>


                                    <div class="form-group col-lg-12">
                                            <label>Club Email<span class="star">*</span></label>
                                            <input id="clubid" class="form-control" placeholder="Club Email" name="clubid" type="email" parsley-type="email" required autocomplete="off" />
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label>Name of the Club<span class="star">*</span></label>
                                            <input id="clubname" class="form-control" placeholder="Club Name" name="clubname" type="text" parsley-trigger="change" required autocomplete="off" />
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label>Year Started</label>
                                            <input id="yearstarted" class="form-control" placeholder="Year started e.g. 2000" name="yearstarted" type="year" >
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label>Year Rebranded</label>
                                            <input id="yearrebranded" class="form-control" placeholder="Year rebranded e.g. 2014" name="yearrebranded" type="year" />
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label>Registration Fee<span class="star">*</span></label>
                                            <input id="registrationfee" class="form-control" placeholder="Registration Fee e.g. 100" name="registrationfee" type="number" parsley-trigger="change" required autocomplete="off" />
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label>Registration Basis<span class="star">*</span></label>
                                            <select id="regbasis" name="regbasis" class="form-control" type="text" parsley-trigger="change" required autocomplete="off" />
                                                    <option value="Per Year">Per Year</option>
                                                    <option value="Per Semester">Per Semester</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                        </div>

                                         <button type="submit" class="btn btn-success" id="submit" >Submit </button>
                                        <button type="reset" class="btn btn-default " id="reset">Reset </button>
                                        <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">EXIT</button>


                            </form>

                        </div>
                        <!--modal-body-->
                    </div>
                    <!-- /.modal-content --> 
                </div>
                <!-- /.modal-dialog --> 
            </div>
            <!--Edit club-->


    
        <div class="modal fade" id="deleteclub" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title custom_align" id="Heading">Delete this club</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign">     </span> Are you sure you want to delete this club?
                        </div>
                    </div>

                    <div class="modal-footer ">
                        <button type="submit" class="btn btn-danger" id="deleteclubconfirm"><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                        <button type="button" class="btn" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                    </div>


                    <div class="messagebox alert alert-success"  id="deletesuccess" style="display: none;position:relative;width:82%;top: 0%;left: 10%;">
                            <button type="button" class="close" data-dismiss="alert"></button>
                                    <div class="cs-text">
                                            <i class="fa fa-check-circle-o"></i>
                                                <strong><span> Success!</span></strong>
                                                 <p>Club was Successfully Deleted!<br /></p>
                                    </div>
                    </div>


                    <div class="messagebox alert alert-warning"  id="detetefail" style="display: none;position:relative;width:82%;top: 0%;left: 10%;">
                            <button type="button" class="close" data-dismiss="alert"></button>
                                    <div class="cs-text">
                                            <i class="fa fa-info-circle"></i>
                                            <strong></i> Fail!</strong>
                                    <p>Unable to delete club !<br /></p>
                                                </div>
                    </div>

                </div>
                <!-- /.modal-content --> 
            </div>
            <!-- /.modal-dialog --> 
        </div>


        <div class="modal fade" id="deactivateclub" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title custom_align" id="Heading">Deactivate this club</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign">     </span> Are you sure you want to deactivate this club?
                        </div>
                    </div>

                    <div class="modal-footer ">
                        <button type="submit" class="btn btn-danger" id="deactivateclubconfirm"><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                        <button type="button" class="btn" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                    </div>


                    <div class="messagebox alert alert-success"  id="deactivatesuccess" style="display: none;position:relative;width:82%;top: 0%;left: 10%;">
                            <button type="button" class="close" data-dismiss="alert"></button>
                                    <div class="cs-text">
                                            <i class="fa fa-check-circle-o"></i>
                                                <strong><span> Success!</span></strong>
                                                 <p>Club was Successfully deactivated!<br /></p>
                                    </div>
                    </div>


                    <div class="messagebox alert alert-warning"  id="deactivatefail" style="display: none;position:relative;width:82%;top: 0%;left: 10%;">
                            <button type="button" class="close" data-dismiss="alert"></button>
                                    <div class="cs-text">
                                            <i class="fa fa-info-circle"></i>
                                            <strong></i> Fail!</strong>
                                    <p>Unable to deactivate club !<br /></p>
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

    
<script >
        
$(document).ready(function () 
   {
    
            $("#clubslist").dataTable().fnDestroy();//destroy the table and recreate it for every refresh


                     var table = $('#clubslist').DataTable({responsive:true,"iDisplayLength": 10,"lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],

                    "ajax": {
                    "url":"<?php echo base_url('index.php/Home/clublist'); ?>",
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
                        return ' <span data-placement="top" data-toggle="tooltip" title="Delete club?"><button class="btn btn-danger btn-xs" data-title="Delete"   id="delete" onclick="deleteclub(this);" value="'+data+'" id="'+data+'_delete"><span class="glyphicon glyphicon-trash" ></span></button></span> &nbsp;                                                                                                                                                                <span data-placement="top" data-toggle="tooltip" title="Edit club?"><button class="btn btn-primary btn-xs" data-title="Edit" onclick="editclub(this);" id="'+data+'_edit" value="'+data+'"><span class="glyphicon glyphicon-pencil"></span></button></span>&nbsp;                                                                                                                    <span data-placement="top" data-toggle="tooltip" title="Mark as Inactive"><button  class="btn  btn-xs" data-title="Mark as Inactive" data-toggle="modal" onclick="deactivateclub(this);" id="'+data+'_deactivate" value="'+data+'" ><span class="fa fa-close"></span></button></span>';
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



function submitData()
    {
        
            var table=$('#clubslist').DataTable();//define the datatable for refresh 

            var clubid= $("#clubid").val();
            var clubname= $("#clubname").val();
            var yearstarted= $("#yearstarted").val();
            var yearrebranded= $("#yearrebranded").val();
            var registrationfee= $("#registrationfee").val();
            var regbasis= $("#regbasis").val();
            //assign our rest of variables

            $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/Home/registerclub'); ?>",//URL changed 
                    data:{ clubid:clubid, clubname:clubname,yearstarted:yearstarted,yearrebranded:yearrebranded, registrationfee:registrationfee,regbasis:regbasis},
                    dataType:'json',

                    success:function(data)
                    {
                        if (data.successful)
                        {
                            $('#addclub #success').show();
                            $("#addclub #success").fadeTo(2000, 500).slideUp(500, function(){
                                $("#addclub #success").slideUp(500);
                                });
                            $('#addclub #clubreg')[0].reset();
                        
                            table.ajax.reload( null, false ); // reload the datatable 

                        }else if (data.fail)
                        {
                            $('#addclub #fail').show();
                            $("#addclub #fail").fadeTo(2000, 500).slideUp(500, function(){
                                $("#addclub #fail").slideUp(500);
                                });
                        }else if (data.null)
                        {
                            $('#addclub #null').show();
                            $("#addclub #null").fadeTo(2000, 500).slideUp(500, function(){
                                $("#addclub #null").slideUp(500);
                                });
                           
                        }else if (data.inactive)
                        {
                            $('#addclub #exists').show();
                            $("#addclub #exists").fadeTo(2000, 500).slideUp(1000, function(){
                                $("#addclub #exists").slideUp(500);
                                });
                           
                        }

                    }
                });
    }


function update()
    {
        
            var table=$('#clubslist').DataTable();//define the datatable for refresh 
            var clubid= $("#editclub #editclubreg input[name=clubid]").val();
            var clubname= $("#editclub #editclubreg input[name=clubname]").val();
            var yearstarted= $("#editclub #editclubreg input[name=yearstarted]").val();
            var yearrebranded= $("#editclub #editclubreg input[name=yearrebranded]").val();
            var registrationfee= $("#editclub #editclubreg input[name=registrationfee]").val();
            var regbasis= $("#editclub #editclubreg #regbasis option:selected").val();
           
            //assign our rest of variables

            $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url(); ?>Home/updateclub",//URL changed 
                    data:{ clubid:clubid, clubname:clubname,yearstarted:yearstarted,yearrebranded:yearrebranded, registrationfee:registrationfee,regbasis:regbasis},
                    dataType:'json',

                    success:function(data)
                    {
                        console.log(data);
                        // alert(data.success);
                        if (data.successful)
                        {
                            $('#editclub #success ').show();
                            $("#editclub #success").fadeTo(2000, 500).slideUp(500, function(){
                                $("#editclub #success").slideUp(500);
                                });

                            table.ajax.reload( null, false ); // reload the datatable 

                        }else if (data.nochange)
                        {
                            $('#editclub #nochange').show();
                            $("#editclub #nochange").fadeTo(2000, 500).slideUp(500, function(){
                                $("#editclub #nochange").slideUp(500);
                                });
                            
                        }
                        else if (data.null)
                        {
                            $('#editclub #null').show();
                            $("#editclub #null").fadeTo(2000, 500).slideUp(500, function(){
                                $("#editclub #null").slideUp(500);
                                });
                        }

                    }
                });
    }



function editclub(objButton)
{
    var id=objButton.value;
 
     
     $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/Home/getclub'); ?>",
                    data:{ id:id},
                    dataType:'json',

                    success:function(data)
                    {
                        $('#editclub #editclubreg input[name=clubid]').val(data.clubID);
                        $('#editclub #editclubreg #clubname').val(data.clubName);
                        $('#editclub #editclubreg #yearstarted').val(data.yearStarted);
                        $('#editclub #editclubreg #yearrebranded').val(data.yearRebranded);
                        $('#editclub #editclubreg #registrationfee').val(data.registrationFee);
                        $('#editclub #editclubreg #regbasis').val(data.registrationBasis);
                        $('#editclub').modal('toggle');
                    }
                });


}



function deleteclub(objButton)
{
    var table=$('#clubslist').DataTable();//define the datatable for refresh 
    $('#deleteclub').modal('toggle');

    $( "#deleteclubconfirm").one('click', function(event)
        {
            var id=objButton.value;
            
            $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/Home/deleteclub'); ?>",
                    data:{ id:id},
                    dataType:'json',

                    success:function(data)
                    {

                        if (data.successful)
                        {
                            $('#deleteclub #deletesuccess ').show();
                            $("#deleteclub #deletesuccess").fadeTo(2000, 500).slideUp(500, function(){
                                $("#deleteclub #deletesuccess").slideUp(500);
                                });

                             $("#deleteclub ").fadeTo(1000, 200).slideUp(500, function(){
                                $("#deleteclub ").modal('toggle');
                                });
                            
                            table.ajax.reload( null, false ); // reload the datatable on registration

                        }else if (data.fail)
                        {
                            $('#deleteclub #deletefail').show();
                            $("#deleteclub #deletefail").fadeTo(2000, 500).slideUp(500, function(){
                                $("#deleteclub #deletefail").slideUp(500);
                                });
                        }
                        
                    }
                });



        });
    

}


// $('#deactivate').on('click', login);
function deactivateclub(objButton)
{
    
    $('#deactivateclub').modal('toggle');
        
    var table=$('#clubslist').DataTable();


    $( "#deactivateclubconfirm").one('click',function(event)
        {
            event.preventDefault(event);
            var id=objButton.value;

            
            $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/Home/deactivateclub'); ?>",
                    data:{ id:id},
                    dataType:'json',

                    success:function(data)
                    {

                        if (data.successful)
                        {

                            $('#deactivateclub #deactivatesuccess ').show();
                            $("#deactivateclub #deactivatesuccess").fadeTo(2000, 500).slideUp(500, function(){
                                $("#deactivateclub #deactivatesuccess").slideUp(500);
                                });

                             $("#deactivateclub ").fadeTo(1000, 200).slideUp(500, function(){
                                $("#deactivateclub ").modal('toggle');
                                });
                            
                                table.ajax.reload( null, false ); // reload the datatable 
                             

                        }else if (data.fail)
                        {
                            $('#deactivateclub #deactivatefail').show();
                            $("#deactivateclub #deactivatefail").fadeTo(2000, 500).slideUp(500, function(){
                                $("#deactivateclub #deactivatefail").slideUp(500);
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


 <script>
            var resizefunc = [];
        </script>

        

<script type="text/javascript">
    $(document).ready(function() {
        $('#clubreg').parsley();
        $('#editclubreg').parsley();
    });
    

    $('#clubreg').submit( function(e) { 
        e.preventDefault(e);
        if ( $(this).parsley().isValid() ) {
            submitData(); 
            // alert ();     
        }
    });

    $('#editclubreg').submit( function(e) { 
        e.preventDefault(e);
        if ($(this).parsley().isValid() ) {
            update();       
        }
    });
</script>


</body>
</html>
