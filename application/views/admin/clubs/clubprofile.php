
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

    <?php $this->load->view('admin/adminnav.php'); ?><!--navigation -->


    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header" style="margin-top:10px;color:blue">Add/Edit Club Profiles</h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
         

             <span data-placement="top" data-toggle="tooltip" title="Refresh to update number of entries"><button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh</button>
            </span>

            <br><br>
            <div class="row">
                <div class="col-md-12">
                    <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%" id="clubslist"  >
                        <thead>
                            <tr>
                                        
                                <th class="text-center">#</th>
                                <th class="text-center">Club Name</th>
                                <th class="text-center">Club Description</th>
                                <th class="text-center">Action</th>
                             </tr>
                        </thead>
                        <tbody >
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
            </div>


            <!--Edit Club-->
            <div class="modal fade" id="editclubprofile" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Edit Club Profile</h4>
                        </div>

                        <div class="modal-body">
                            <form role="form" method="POST" action="" id="editprofile">
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
                                <div class="form-group col-lg-12" style="display: none" >
                                    <label>Club Email<span class="star">*</span></label>
                                    <input id="clubid" class="form-control" placeholder="Club Email" name="clubid" type="email" parsley-type="email" required autocomplete="off" />
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>About Club [410 - 500 Characters]</label>
                                    <textarea class="form-control" placeholder="Club Description (410-500 characters)" name="description" id="description" data-parsley-trigger="keyup" data-parsley-minlength="410" data-parsley-maxlength="500" data-parsley-minlength-message="Please enter at least 410 characters " data-parsley-validation-threshold="10" required autocomplete="off" style="min-height: 150px"></textarea>
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

    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

     <?php $this->load->view('scriptlinks/scriptlinks.php'); ?>
    
<script >
        
$(document).ready(function () 
   {
    
            $("#clubslist").dataTable().fnDestroy();//destroy the table and recreate it for every refresh

                     var table=$('#clubslist').DataTable({responsive:true,"iDisplayLength": 10,"lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],

                    "ajax": {
                    "url":"<?php echo base_url('index.php/Home/clublist'); ?>",
                    "type":"GET",
                    "dataType":"json"},
                    "columns": [
                    { "data": "count",responsivePriority: 1 },
                    { "data": "clubName",responsivePriority: 2 },
                    { "data": "clubProfile",responsivePriority: 4 },
                    { "data": "action" }],


                   //aoColumnDefs This array allows you to target a specific column, multiple columns, or all columns, using the aTargets property of each object in the array
                    "aoColumnDefs": [
                    {"bSortable":false, "aTargets": [0], "orderable": false,"sWidth":"1%"},
                      {"aTargets": [3],//the target column ie 7th column
                      "orderable": false,"sWidth":"2%",
                      "mData": "action",

                      "mRender": function ( data, type, full ) 
                      {
                        return '<span data-placement="top" data-toggle="tooltip" title="Edit Club Profile"><button class="btn btn-primary btn-xs" data-title="Edit" onclick="editclubprofile(this);" id="'+data+'_edit" value="'+data+'"><span class="glyphicon glyphicon-pencil"></span></button></span>&nbsp;';
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


function updateProfile()
    {
        
            var table=$('#clubslist').DataTable();//define the datatable for refresh 
            var clubid= $("#editprofile input[name=clubid]").val();
           
            //assign our rest of variables

            $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/Home/updateclub'); ?>",//URL changed 
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



function editclubprofile(objButton)
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
                        $('#editprofile input[name=clubid]').val(data.clubID);
                        $("#editprofile textarea[name=description]").val(data.clubProfile);
                        $('#editclubprofile').modal('toggle');
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
