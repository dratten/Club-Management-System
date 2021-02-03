
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
            <div class="row" >
                <div class="col-lg-12">
                    <h4 class="page-header" style="margin-top:10px;color:blue">Active <span id="clubname_" ></span><span> Members</span> </h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
          <span data-placement="top" data-toggle="tooltip" title="Refresh ">
                <button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh</button>
            </span>
              <span data-placement="top" data-toggle="tooltip" title="Print All">
                    <a id="print" class="btn btn-xs" data-title="Print All" type="button" href=""><span class="fa fa-print"></span>&nbsp;Print All</a>
            </span>

            <br><br>

            <div class="form-group col-lg-6" >
                    <label for="">Select a Club</label>
                        <select id="clubid" name="clubid" class="form-control">
                                <option value="All">All Clubs</option>
                        </select>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-12">
                  <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%" id="clubmemberslist">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">SU ID</th>
                                <th class="text-center">Full name</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Course</th>
                                <th class="text-center"><span id="stateclub"></span></th>
                                <th class="text-center">Profiles</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
            </div>


            <!-- Modal -->
          <div class="modal fade" id="viewclubmember" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                          <h4 class="modal-title" "> <b> <span id="fullname"></span></b></h4>
                          </div>
                      <div class="modal-body">
                          <center>
                          <img src="<?php echo base_url(); ?>assets/img/person.png" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
                          <h3 class="media-heading"><span id="fullname"></span> </h3>
                          <span><strong>Skills: </strong></span>
                              <span class="label label-warning">1</span>
                              <span class="label label-info">2</span>
                              <span class="label label-info">3</span>
                              <span class="label label-success">4</span>
                          </center>
                          <hr width="50%">
                          <center>
                          <table width="100%" class="table  table-hover">
                              <tr>
                                  <p class="text-center"><strong>A member of </strong><span id="clubname"></span>&nbsp;</p>
                              </tr>
                              <tr>
                                  <p class="text-center"><strong> Email: </strong><span id="suemail">
                              </tr>
                              <tr>
                                  <p class="text-center"><strong> Phone: </strong><span id="phone">
                              </tr>
                              
                              <hr width="50%">
                              
                              <tr>
                                  <p class="text-center"><strong> Admission No: </strong><span id="suid">
                              </tr>
                               <tr>
                                  <p class="text-center"><strong> Course: </strong><span id="coursename">
                              </tr>
                              
                              <tr>
                                  <p class="text-center"><strong> Gender: </strong><span id="gender">
                              </tr>
                              
                          </table>

                          </center>
                      </div>
                      <div class="modal-footer">
                          <center>
                          <button type="button" class="btn btn-success" data-dismiss="modal">Dismiss &nbsp;<span id="fullname"></span>'s Profile?</button>
                          </center>
                      </div>
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
                           
                           var clubName='Clubs (All Clubs) ';

                           document.getElementById('clubname_').innerHTML=clubName;
                           document.getElementById('stateclub').innerHTML="Club";

                            $("#clubmemberslist").dataTable().fnDestroy();//destroy the table and recreate it for every refresh


                                    var table=$('#clubmemberslist').DataTable({responsive:true,"iDisplayLength": 10,"lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],

                                    "ajax": {
                                    "url":'<?php echo base_url('index.php/ClubController/viewclubmemberslist')?>'+"?clubID="+clubID,
                                    "type":"GET",
                                    "dataType":"json"},
                                    "columns": [
                                    { "data": "count",responsivePriority: 1 },//define column widths
                                    { "data": "suID" },
                                    { "data": "fullName" ,responsivePriority: 2},
                                    { "data": "telNo" },
                                    { "data": "courseName" },
                                    { "data": "status" ,responsivePriority: 3}],


                                    //aoColumnDefs This array allows you to target a specific column, multiple columns, or all columns, using the aTargets property of each object in the array
                                    "aoColumnDefs": [
                                    {"bSortable":false, "aTargets": [0], "orderable": false},
                                    { "sWidth": "25%", "aTargets": [ 5 ] },
                                      {"aTargets": [6],//the target column ie 7th column
                                      "orderable": false,
                                      "mData": "action",

                                      "mRender": function ( data, type, full ) 
                                      {
                                        return '<span data-placement="top" data-toggle="tooltip" title="View record?"><button class="btn btn-primary btn-xs" data-title="View" onclick="viewmember(this);" id="view" value="'+data+'"><span class="glyphicon glyphicon-eye-open"></span></button></span>&nbsp'; 
                                      }

                                        
                                    },
                                       
                                    ],
                                    order:[[ 5, 'asc' ]]//order first column:ascending

                                });

                                
                              //prevent first column (counter) from being re-ordered when other fields are sorted
                              table.on( 'order.dt search.dt', function () 
                                 {
                                    table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) 
                                    {
                                        cell.innerHTML = i+1;
                                    } );
                                } ).draw();

                                table.ajax.reload( null, false ); 

                                // window.onresize = function() {  table.columns.adjust().responsive.recalc(); }


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
           if(clubID!=="All")
           {
              document.getElementById('stateclub').innerHTML="Status";
            }else
              {
                  document.getElementById('stateclub').innerHTML="Club";

              }


           document.getElementById('clubname_').innerHTML=clubName;
    
            $("#clubmemberslist").dataTable().fnDestroy();//destroy the table and recreate it for every refresh


                    var table=$('#clubmemberslist').DataTable({"iDisplayLength": 5,"lengthMenu": [[5, 25, 50, 100, 200, -1], [5, 25, 50, 100, 200, "All"]],

                    "ajax": {
                    "url":'<?php echo base_url('index.php/ClubController/viewclubmemberslist')?>'+"?clubID="+clubID,
                    "type":"POST",
                    "dataType":"json"},
                    "columns": [
                    { "data": "count",responsivePriority: 1 },//define column widths
                    { "data": "suID" },
                    { "data": "fullName" ,responsivePriority: 2},
                    { "data": "telNo" },
                    { "data": "courseName" },
                    { "data": "status" ,responsivePriority: 3}],


                    //aoColumnDefs This array allows you to target a specific column, multiple columns, or all columns, using the aTargets property of each object in the array
                    "aoColumnDefs": [
                    {"bSortable":false, "aTargets": [0], "orderable": false},
                      { "sWidth": "15%", "aTargets": [ 5 ] },
                      {"aTargets": [6],//the target column ie 5th column
                      "orderable": false,
                      "mData": "action",

                      "mRender": function ( data, type, full ) 
                      {
                        return '<span data-placement="top" data-toggle="tooltip" title="View record?"><button class="btn btn-primary btn-xs" data-title="View" onclick="viewmember(this);" id="view" value="'+data+'"><span class="glyphicon glyphicon-eye-open"></span></button></span>&nbsp'; 
                      }

                        
                    },
                       
                    ],
                    order:[[ 3, 'asc' ]]//order first column:ascending

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

                            location.href="<?php echo base_url('index.php/ClubController/perclubmemberspdf'); ?>"+'?clubID='+feedback;
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
