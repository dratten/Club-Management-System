
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
      /* Centering td values in datatable*/
    table td:nth-child(1),td:nth-child(3)
                {

                 text-align:center !important;
                }
    </style>
</head>

<body>

<div id="wrapper">

    <?php $this->load->view('admin/adminnav.php'); ?><!--navigation -->


    <div id="page-wrapper">
            <div class="row" >
                <div class="col-lg-12">
                    <h4 class="page-header" style="margin-top:10px;color:blue"><span id="clubname_" ></span><span> Event Reports</span> </h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
          <span data-placement="top" data-toggle="tooltip" title="Refresh ">
                <button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh</button>
            </span>
             

            <br><br>

            <div class="form-group col-lg-6" style="margin-left: -15px">
                    <label for="">Select a Club</label>
                        <select id="clubid" name="clubid" class="form-control">
                                <option value="">---Select Club---</option>
                        </select>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-12">
                  <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%" id="clubeventslist">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Report Particulars</th>
                                <th class="text-center">Download</th>
                            </tr>
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


    <!-- jQuery -->
   <script src="<?php echo base_url();?>assets/js/vendor/daterangepicker/moment.js"></script>

    <script src="<?php echo base_url();?>assets/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/vendor/metisMenu/metisMenu.min.js"></script>

     <?php $this->load->view('scriptlinks/scriptlinks.php'); ?>
  

<script>
$(document).ready(function () 

   {
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
    
            $("#clubeventslist").dataTable().fnDestroy();//destroy the table and recreate it for every refresh


                    var table=$('#clubeventslist').DataTable({"iDisplayLength": 10,"lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],

                    "ajax": {
                    "url":'<?php echo base_url('index.php/ClubController/perclubeventreports')?>'+"?clubID="+clubID,
                    "type":"GET",
                    "dataType":"json"},
                    "columns": [
                    { "data": "count",responsivePriority: 1 },//define column widths
                    { "data": "particulars" },
                    { "data": "action"}],


                    //aoColumnDefs This array allows you to target a specific column, multiple columns, or all columns, using the aTargets property of each object in the array
                    "aoColumnDefs": [
                    {"bSortable":false, "aTargets": [0],"sWidth": "5%", "orderable": false},
                      { "sWidth": "5%", "aTargets": [ 2 ] },
                      {"aTargets": [2],//the target column ie 5th column
                      "orderable": false,
                      "mData": "action",

                      "mRender": function ( data, type, full ) 
                      {
                        return '<span data-placement="top" data-toggle="tooltip" title="Download Constitution"><a class="btn btn-xs" data-title="View" id="view" href="<?php echo base_url();?>ClubController/download_event_report/'+data+'" ><span class="fa fa-download fa-lg"></span></a></span>&nbsp'; 
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



//to refresh the page
$( "#print").on('click', function()
        {
           var clubEmail=$('#clubid').val();
            
             $.ajax(
                    {
                         type:"post",
                        url: "<?php echo base_url('index.php/ClubController/perclubmembers')?>",
                        data:{ clubEmail:clubEmail},
                        dataType:'json',

                        success:function(data)
                        {
                            var feedback=data.clubID;

                            location.href="<?php echo base_url(); ?>ClubController/perclubmemberspdf"+'?clubID='+feedback;
                        }
                    });
        });

  //=======================================================================================

function viewmember(objButton)
{
    var pid=objButton.value;
 
     
     $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/ClubController/viewclubmember'); ?>",
                    data:{ pid:pid},
                    dataType:'json',

                    success:function(data)
                    {
                        

                        $('#viewclubmember #fullname').text(data.fullName);
                        $('#viewclubmember #suid').text(data.suID);
                        $('#viewclubmember #phone').text(data.telNo);
                        $('#viewclubmember #clubname').text(data.clubName);
                        $('#viewclubmember #coursename').text(data.courseID);
                        $('#viewclubmember #gender').text(data.gender);
                        $('#viewclubmember #suemail').text(data.suEmail);
                       
                        $('#viewclubmember').modal('toggle');

                        
                    }
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
