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
    .star
        {
            color:red; 
        }
    .messagebox
        {
           display: none;
        }
        
 /* Centering td values in datatable*/
    table td:nth-child(1),td:nth-child(2),td:nth-child(3),td:nth-child(4),td:nth-child(5),td:nth-child(6) 
                {

                 text-align:center !important;
                }
    html,body
        {
            background-color: white;
        }
    #meetingattendancelist th
        {
            border-bottom:2px solid;
            border-color: grey;
        }
    #meetingattendancelist
        {
            border-bottom:none;
        }
    #meeting option
      {
        font-weight: bold;
        color:orange;
      }


            
        html,body
            {
                background-color: white;
            }
      
        .dataTables_wrapper .dataTables_filter
            {
                float:right;text-align:left;
            }
        .dataTables_wrapper .dataTables_filter input
            {
                margin-left:0.5em
            }
    </style>
       
</head>

<body>

<div id="wrapper">

        <?php  $this->load->view('clubheads/clubnavigation'); ?>
        <div id="page-wrapper" >
    
            <div class="row" >
                <div class="col-lg-12">
                    <h4 class="page-header" style="margin-top:10px;color:blue"><span><?php  echo $this->session->userdata('clubName'); echo " Edit Meeting Attendance";?></span></h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        
          <div class="form-group col-lg-6">
                <!-- <label for="">Select Meeting</label> -->
                <span data-placement="top" data-toggle="tooltip" title="Refresh to update number of entries">
                <button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh</button></span>
                <br><br>

                      <select id="meeting" name="meeting" class="form-control" >
                          <option value="">--Select Meeting---</option>
                      </select>
          </div>

            <br>
         <div class="row">
                <div class="col-md-12">
                   <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%"  id="meetingattendancelist">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Student ID</th>
                                <th class="text-center">Full name</th>
                                <th class="text-center">Status</th>
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

//=======================meeting dropdown list=========================
 $(document).ready(function () 

   {
         
     $.ajax(
                {
                    type:"get",
                    url: "<?php echo base_url('index.php/ClubController/withattendancemeetingsdropdown'); ?>",
                    dataType:'json',

                    success:function(data)
                    {

                         $.each(data,function(meetingid,description)
                            {
                                var opt = $('<option />'); 

                                opt.val(meetingid);
                                opt.text(description);
                                $('#meeting').append(opt);


                            });

                             //sort the meetings dropdown list 
                                var options = $('#meeting option');
                                    var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
                                    arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
                                    options.each(function(i, o) {
                                      o.value = arr[i].v;
                                      $(o).text(arr[i].t);
                                    });

                               //this code removes duplicates from the list above
                                var seen = {};
                                jQuery('#meeting').children().each(function() 
                                {
                                    var txt = jQuery(this).clone().wrap('<select>').parent().html();
                                    if (seen[txt]) {
                                        jQuery(this).remove();
                                    } else {
                                        seen[txt] = true;
                                    }

                                }); 
                    }


                });


});


 
$('#meeting').on('change', function() 
  {
   
            $("#meetingattendancelist").dataTable().fnDestroy();//destroy the table and recreate it for every refresh

                  var meetingID=$('#meeting').val();

                    var table=$('#meetingattendancelist').DataTable({ paging:true,responsive:true,"iDisplayLength": 10,"lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],
                    // var table=$('#eventattendancelist').DataTable({"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

                    "ajax": {
                    "url":"<?php echo base_url('index.php/ClubController/meetingattlist')?>"+"?meetingID="+meetingID,
                    "type":"POST",
                    "dataType":"json"},
                    "columns": [
                    { "data": "count" ,responsivePriority: 1},//define column widths
                    { "data": "suID" },
                    { "data": "fullName" ,responsivePriority: 2},
                    { "data": "status",responsivePriority: 3 }],


                    //aoColumnDefs This array allows you to target a specific column, multiple columns, or all columns, using the aTargets property of each object in the array
                    "aoColumnDefs": [
                    {"bSortable":false, "aTargets": [0], "orderable": false},
                    {"aTargets": [3],//the target column ie 5th column
                      "orderable": false,
                      "mData": "action",

                      "mRender": function ( data, type, full ) 
                      { 
                        var state=""+data;
                        if(state=="Present")
                            {
                                return '<input type="checkbox" name="presentstate" value="Present" id="present" checked="checked" />&nbsp;&nbsp;Present &nbsp;&nbsp;<input type="checkbox" name="absentstate" value="Absent" id="absent">&nbsp;&nbsp;Absent&nbsp;&nbsp;';
                                  
                            } else if(state=="Absent"){
                                        
                                return '<input type="checkbox" name="presentstate" value="Present" id="present" />&nbsp;&nbsp;Present &nbsp;&nbsp;<input type="checkbox" name="absentstate" value="Absent" id="absent" checked="checked" />&nbsp;&nbsp;Absent&nbsp;&nbsp;';
                                    }
                        
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

 



// $(window).resize(function() {
//              var oTable=$('#eventattendancelist').DataTable();

//     oTable.fnDraw(false)        
// });


//to refresh the page
$( "#refresh").click( function(event)
        {
            window.setTimeout(function(){location.reload()},1)

        });




</script>

</body>
</html>
