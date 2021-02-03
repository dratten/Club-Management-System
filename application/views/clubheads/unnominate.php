
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

       
    .star
        {
            color:red; 
        }
    .messagebox
        {
           display: none;
        }
      table td:nth-child(3), #pid
         {
          display:none;
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
    #nominatedofficialslist th
        {
            border-bottom:2px solid;
            border-color: grey;
        }
    #nominatedofficialslist
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
                    <h4 class="page-header" style="margin-top:10px;color:blue"><span><?php  echo $this->session->userdata('clubName'); echo " Officials Nomination";?></span></h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        
          <div class="form-group col-lg-6">
                <!-- <label for="">Select Meeting</label> -->
                <span data-placement="top" data-toggle="tooltip" title="Refresh ">
                <button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh</button></span>
          </div>

      
         <div class="row">
                <div class="col-md-12">
                   <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%"  id="nominatedofficialslist">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Student ID</th>
                                <th class="text-center" id="pid">pID</th>
                                <th class="text-center">Full name</th>
                                <th class="text-center">Course</th>
                                <th class="text-center">Unnomination</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                  
                    <!-- /.table-responsive -->
                </div>
            </div>
        </div>


            <!-- Modal -->
            <div class="modal fade" id="successmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Success</h4>
                  </div>
                  <div class="modal-body">
                        
                             
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
              </div>
            </div>


        <!-- Modal -->
            <div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                
                  <div class="alert alert-info">
                      <p class="text-center"><strong >Success:</strong> Unnomination Successful.</p>
                  
                </div>
              </div>
            </div>

          <!-- Modal -->
            <div class="modal fade" id="fail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                
                  <div class="alert alert-danger">
                      <p class="text-center"><strong >Fail:</strong>Unnomination Failed!</p>
                  
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
    
            $("#nominatedofficialslist").dataTable().fnDestroy();//destroy the table and recreate it for every refresh



                    var table=$('#nominatedofficialslist').DataTable({paging:false,responsive:true,"iDisplayLength": 5,"lengthMenu": [[5, 25, 50, 100, 200, -1], [5, 25, 50, 100, 200, "All"]],
                    // var table=$('#eventattendancelist').DataTable({"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

                    "ajax": {
                    "url":"<?php echo base_url('index.php/ClubController/nominated')?>",
                    "type":"GET",
                    "dataType":"json"},
                    "columns": [
                    { "data": "count" ,responsivePriority: 1},//define column widths
                    { "data": "suID" },
                    { "data": "action" },
                    { "data": "fullName" ,responsivePriority: 2},
                    { "data": "courseName" ,responsivePriority: 4},
                    { "data": "action",responsivePriority: 3 }],


                    //aoColumnDefs This array allows you to target a specific column, multiple columns, or all columns, using the aTargets property of each object in the array
                    "aoColumnDefs": [
                    {"bSortable":false, "aTargets": [0], "orderable": false},
                      
                       {"aTargets": [5],//the target column ie 5th column
                      "orderable": false,
                      "mData": "action",

                      "mRender": function ( data, type, full ) 
                        { 
                          return '<input type="radio" name="unominate" value="'+data+'" id="unominate" onclick="unnominate(this)">&nbsp;&nbsp;Unnominate'; 
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


function unnominate(objButton)
    {
      var table=$('#nominatedofficialslist').DataTable();
      var studentPID=objButton.value;
      // alert(studentPID);


            $.ajax(//ajax script to post the data without page refresh
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/ClubController/officialunnomination')?>",
                    data:{studentPID:studentPID },
                    dataType:'json',

                    success:function(data)
                      {
                         //get json encoded feedback upon submission and respond appropriately
                       if (data.successful)
                        {
                            //if success is returned upon submission, show the success notification
                            $('#success').show();
                            //fade away the notification after 2000 milliseconds
                            $("#success").fadeTo(2000, 500).slideUp(500, function(){
                                $(" #success").slideUp(500);
                                });
                        
                        table.ajax.reload( null, false ); // reload the datatable on 

                            
                        //the rest applies as above

                        }else if (data.fail)
                        {
                            $('#fail').show();
                            $(" #fail").fadeTo(2000, 500).slideUp(500, function(){
                                $(" #fail").slideUp(500);
                                });
                            // $("#addmeetinginfo ").fadeTo(2000, 200).slideUp(500, function(){
                            //     $("#addmeetinginfo ").modal('toggle');
                            //     });
                        }
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
