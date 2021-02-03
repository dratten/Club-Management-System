
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
       
        /* Centering td values in datatable*/
        #expenditureslist td:nth-child(1),td:nth-child(2),td:nth-child(3) ,td:nth-child(4) ,td:nth-child(5) ,td:nth-child(6),td:nth-child(7)  
                    {

                     text-align:center !important;
                    }
        
        </style>
           
    </head>

    <body>

    <div id="wrapper">

            <?php  $this->load->view('clubheads/clubnavigation'); ?>
            <div id="page-wrapper" >
        
                <div class="row" >
                    <div class="col-lg-12">
                        <h4 class="page-header" style="margin-top:10px;color:blue"><span><?php  echo $this->session->userdata('clubName'); echo " Expenditures not working";?></span></h4>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
            
            <span data-placement="top" data-toggle="tooltip" title="Add Expenditure">
                        <button class="btn btn-primary btn-xs" data-title="Add Expenditure" data-toggle="modal" data-target="#addexpenditure" id="addexpenditurebtn"><span class="fa fa-plus-circle"></span>&nbsp;Add Expenditure</button></span>
                <span data-placement="top" data-toggle="tooltip" title="Refresh ">
                    <button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh</button>
                </span>

                 <span data-placement="top" data-toggle="tooltip" title="Print All">
                        <a class="btn btn-xs" data-title="Print All" type="button" href="#"><span class="fa fa-print"></span>&nbsp;Print All</a>
                </span>

               
                <br><br>
                <div class="row">
                    <div class="col-md-12">
                      <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%"  id="expenditureslist">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Date Spent</th>
                                    <th class="text-center">Unit Name</th>
                                    <th class="text-center">Cost Each</th>
                                    <th class="text-center">Count</th>
                                    <th class="text-center">Total </th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Recording</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <!-- /.table-responsive -->
                    </div>
                </div>
       
                <div class="modal fade" id="addexpenditure" tabindex="-1" role="dialog" aria-labelledby="add expenditure" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title custom_align" id="Heading">Add Expenditure </h4>
                            </div>

                            <div class="modal-body">
                                <form role="form" method="POST" action="" id="expenditures">
                                    <div class="form-group col-lg-12">
                                        <label>Date Spent</label>
                                        <div class='input-group date' id='expendituredate'>
                                            <input type='text' class="form-control" placeholder="example: 2017-01-29" id="datespent" name="datespent" data-parsley-trigger="change"
                                            pattern="/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])$/"
                                            required autocomplete="off" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label>Unit Name</label>
                                        <input class="form-control" placeholder="example: Airtime" name="unitname" id="unitname" type="text" data-parsley-trigger="change" required autocomplete="off" />
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label>Amount Per Unit</label>
                                        <input class="form-control" placeholder="example: 500" name="amounteach" id="amounteach" type="text" data-parsley-trigger="change" required autocomplete="off" />
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label>No. of Units</label>
                                        <input class="form-control" placeholder="example: 1" name="unitscount" id="unitscount" type="text" data-parsley-trigger="change" required autocomplete="off" />
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label>Expenditure Description</label>
                                        <textarea class="form-control" placeholder="example: Organizing team building" name="description" id="description"></textarea>
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label for="">Person Recording</label>
                                        <select class="form-control" placeholder="example: 78581" name="studentid" id="studentid" data-parsley-trigger="change" required autocomplete="off" />
                                        <option value="">--Select Official---</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-success" id="submit" >Submit </button>
                                <button type="reset" class="btn btn-default " id="reset">Reset </button>
                                <button type="button" class="btn " data-dismiss="modal" aria-hidden="true">EXIT</button>


                                <div class="messagebox alert alert-success"  id="success">
                                    <button type="button" class="close" data-dismiss="alert"></button>
                                    <div class="cs-text">
                                        <i class="fa fa-check-circle-o"></i>
                                        <strong><span> Success!</span></strong>
                                        <p>Expense successfully recorded!<br /></p>
                                    </div>
                                </div>


                                <div class="messagebox alert alert-info"  id="error">
                                    <button type="button" class="close" data-dismiss="alert"></button>
                                    <div class="cs-text">
                                        <i class="fa fa-times"></i>
                                        <strong> Failed!</strong>
                                        <p>An error occurred!<br /></p>
                                    </div>
                                </div>


                                <div class="messagebox alert alert-warning"  id="null">
                                    <button type="button" class="close" data-dismiss="alert"></button>
                                    <div class="cs-text">
                                        <i class="fa fa-times"></i>
                                        <strong></i> Invalid input!</strong>
                                        <p>A required field is empty!<br /></p>
                                    </div>
                                </div>
                                <div class="messagebox alert alert-info"  id="duplicate">
                                    <button type="button" class="close" data-dismiss="alert"></button>
                                    <div class="cs-text">
                                        <i class="fa fa-info-circle"></i>
                                        <strong></i> Duplicate Entries!</strong>
                                        <p>The expense has already been added!<br /></p>
                                    </div>
                                </div>

                            </form>

                            </div><!--modal-body-->
                        </div>
                        <!-- /.modal-content --> 
                    </div>
                    <!-- /.modal-dialog --> 
                </div>

                <div class="modal fade" id="editexpenditure" tabindex="-1" role="dialog" aria-labelledby="edit expenditure" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title custom_align" id="Heading">Edit Expenditure </h4>
                            </div>

                            <div class="modal-body">
                                <form role="form" method="POST" action="" id="updateexpenditure">
                                     <div class="form-group col-lg-12">
                                     <div class="form-group col-lg-12" style="display:none;position: absolute;">
                                            <label>Expenditure ID</label>
                                            <input class="form-control" placeholder="PID" id="pid" name="pid">
                                        </div>
                                        <label>Date Spent</label>
                                        <div class='input-group date' id='expendituredate'>
                                            <input type='text' class="form-control" placeholder="example: 2017-01-29" id="datespent" name="datespent" data-parsley-trigger="change"
                                            pattern="/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])$/"
                                            required autocomplete="off" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label>Unit Name</label>
                                        <input class="form-control" placeholder="example: Airtime" name="unitname" id="unitname" type="text" data-parsley-trigger="change" required autocomplete="off" />
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label>Amount Per Unit</label>
                                        <input class="form-control" placeholder="example: 500" name="amounteach" id="amounteach" type="text" data-parsley-trigger="change" required autocomplete="off" />
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label>No. of Units</label>
                                        <input class="form-control" placeholder="example: 1" name="unitscount" id="unitscount" type="text" data-parsley-trigger="change" required autocomplete="off" />
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label>Expenditure Description</label>
                                        <textarea class="form-control" placeholder="example: Organizing team building" name="description" id="description"></textarea>
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label for="">Person Recording</label>
                                        <select class="form-control" placeholder="example: 78581" name="studentid" id="studentid" data-parsley-trigger="change" required autocomplete="off" />
                                        <option value="">--Select Official---</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-success" id="submit" >Submit </button>
                                <button type="reset" class="btn btn-default " id="reset">Reset </button>
                                <button type="button" class="btn " data-dismiss="modal" aria-hidden="true">EXIT</button>


                                <div class="messagebox alert alert-success"  id="success">
                                    <button type="button" class="close" data-dismiss="alert"></button>
                                    <div class="cs-text">
                                        <i class="fa fa-check-circle-o"></i>
                                        <strong><span> Success!</span></strong>
                                        <p>Expense successfully updated!<br /></p>
                                    </div>
                                </div>


                                <div class="messagebox alert alert-info"  id="error">
                                    <button type="button" class="close" data-dismiss="alert"></button>
                                    <div class="cs-text">
                                        <i class="fa fa-times"></i>
                                        <strong> Failed!</strong>
                                        <p>An error occurred!<br /></p>
                                    </div>
                                </div>


                                <div class="messagebox alert alert-warning"  id="null">
                                    <button type="button" class="close" data-dismiss="alert"></button>
                                    <div class="cs-text">
                                        <i class="fa fa-times"></i>
                                        <strong></i> Invalid input!</strong>
                                        <p>A required field is empty!<br /></p>
                                    </div>
                                </div>

                            </form>

                            </div><!--modal-body-->
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
            $('#expenditures').parsley();
            $('#updateexpenditure').parsley();
        
                $("#expenditureslist").dataTable().fnDestroy();//destroy the table and recreate it for every refresh
                var table=$('#expenditureslist').DataTable({responsive:true,"iDisplayLength": 10,"lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],

                        "ajax": {
                        "url":"<?php echo base_url('index.php/ClubController/expenditureslist');?>",
                        "type":"GET",
                        "dataType":"json"},
                        "columns": [
                        { "data": "count",responsivePriority: 1 },//define column widths
                        { "data": "dateSpent" ,responsivePriority: 2},
                        { "data": "unitName" ,responsivePriority: 3},
                        { "data": "unitsCount" },
                        { "data": "amountEach" },
                        { "data": "totalCost",responsivePriority: 4 },
                        { "data": "description" },
                        { "data": "fullName"},
                        { "data": "action" }],


                        //aoColumnDefs This array allows you to target a specific column, multiple columns, or all columns, using the aTargets property of each object in the array
                        "aoColumnDefs": [
                        {"bSortable":false, "aTargets": [0], "orderable": false},
                          {"aTargets": [8],//the target column ie 5th column
                          "orderable": false,
                          "mData": "action",

                          "mRender": function ( data, type, full ) 
                          {
                            return ' <span data-placement="top" data-toggle="tooltip" title="Delete Meeting"><button class="btn btn-danger btn-xs" data-title="Delete Meeting"  onclick="deleteexpenditure(this);" id="'+data+'_delete" value="'+data+'"><span class="glyphicon glyphicon-trash" ></span></button></span> &nbsp;                                                                                                                                                       <span data-placement="top" data-toggle="tooltip" title="Edit Meeting"><button class="btn btn-primary btn-xs" data-title="Edit Meeting" onclick="editexpenditure(this);" value="'+data+'"><span class="fa fa-edit"></span></button></span>&nbsp'; 
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


    //=======================club dropdown list on registration form toggle view=========================

    $( "#addexpenditurebtn").on('click', function(event)
            {
                event.preventDefault(event);//prevent auto submit data
             
         
         $.ajax(
                    {
                        type:"post",
                        url: "<?php echo base_url('index.php/Home/clubofficialsdropdownlist'); ?>",
                        dataType:'json',

                        success:function(data)
                        {
                        // console.log(data);
                             $.each(data,function(pID,fullName)
                                {
                                   //assign values to dropdown list
                                    var opt = $('<option />'); 

                                    opt.val(pID);
                                    opt.text(fullName);
                                    $('#expenditures #studentid').append(opt);

                                        //sort the dropdown list 
                                        var options = $('#expenditures #studentid option');
                                        var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
                                        arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
                                        options.each(function(i, o) {
                                          o.value = arr[i].v;
                                          $(o).text(arr[i].t);
                                        });


                                        //this code removes duplicates from the list above
                                        var seen = {};
                                        jQuery('#expenditures #studentid').children().each(function() 
                                        {
                                            var txt = jQuery(this).clone().wrap('<select>').parent().html();
                                            if (seen[txt]) {
                                                jQuery(this).remove();
                                            } else {
                                                seen[txt] = true;
                                            }

                                        }); 
                                });

                        }
                    });


    });

      //=======================================================================================


    function submitData()
        {
                
            var table=$('#expenditureslist').DataTable();
            //assign input values to variables for posting
            var datespent= $("#expenditures input[name=datespent]").val();
            var unitname = $("#expenditures input[name=unitname]").val();
            var amounteach= $("#expenditures input[name=amounteach]").val();
            var unitscount= $("#expenditures input[name=unitscount]").val();
            var description= $("#expenditures textarea").val();
            var studentpid= $("#expenditures #studentid").val();

                $.ajax(//ajax script to post the data without page refresh
                    {
                        type:"post",
                        url: "<?php echo base_url('index.php/ClubController/addclubexpenditure');?>",
                        data:{datespent:datespent,unitname:unitname,amounteach:amounteach,unitscount:unitscount,description:description,studentpid:studentpid},
                        dataType:'json',

                        success:function(data)
                        {
                            console.log(data);
                            //get json encoded feedback upon submission and respond appropriately
                           if (data.successful)
                            {
                                //if success is returned upon submission, show the success notification
                                $('#expenditures #success').show();
                                //fade away the notification after 2000 milliseconds
                                $("#expenditures #success").fadeTo(2000, 500).slideUp(500, function(){
                                    $("#expenditures #success").slideUp(500);
                                    });

                                table.ajax.reload( null, false ); // reload the datatable 

                            //the rest applies as above

                            }else if (data.error)
                            {
                                $('#expenditures #error').show();
                                $("#expenditures #error").fadeTo(2000, 500).slideUp(500, function(){
                                    $("#expenditures #error").slideUp(500);
                                    });
                                
                            }else if (data.null)
                            {
                                $('#expenditures #null').show();
                                $("#expenditures #null").fadeTo(2000, 500).slideUp(500, function(){
                                    $("#expenditures #null").slideUp(500);
                                    });
                                
                            } else if (data.duplicate){
                                $('#expenditures #duplicate').show();
                                $("#expenditures #duplicate").fadeTo(2000, 500).slideUp(500, function(){
                                    $("#expenditures #duplicate").slideUp(500);
                                    });
                            }

                        }
                    });
                  
        }


    function editexpenditure(objButton)
    {
        var pid=objButton.value;
        $("#updateexpenditure").parsley().reset();
        $("#updateexpenditure #studentid").parsley().reset();
         $.ajax(
                    {
                        type:"post",
                        url: "<?php echo base_url('index.php/ClubController/getexpenditure'); ?>",
                        data:{ pid:pid},
                        dataType:'json',

                        success:function(data)
                        {
                            console.log(data);
                            $("#updateexpenditure input[name=datespent]").val(data.dateSpent);
                            $("#updateexpenditure input[name=unitname]").val(data.unitName);
                            $("#updateexpenditure input[name=amounteach]").val(data.amountEach);
                            $("#updateexpenditure input[name=unitscount]").val(data.unitsCount);
                            $("#updateexpenditure textarea").val(data.description);
                            $("#updateexpenditure #pid").val(data.pID);

                            $('#updateexpenditure #studentid').empty();
                            
                            var studentID=data.studentPID;
                            var fullName=data.firstName+ " "+data.lastName;
                            var opt = $('<option />');
                                opt.val(studentID);
                                opt.text(fullName);

                            $('#updateexpenditure #studentid').append(opt);
                           
                            $('#editexpenditure').modal('toggle');

                            $('#updateexpenditure #studentid').click();

                        }
                    });


    }


    $( "#updateexpenditure #studentid").on('click', function(event)
            {
                event.preventDefault(event);//prevent auto submit data

                $.ajax(
                    {
                        type:"post",
                        url: "<?php echo base_url('index.php/Home/clubofficialsdropdownlist'); ?>",
                        dataType:'json',

                        success:function(data)
                        {
                             $.each(data,function(pID,fullName)
                                {
                                   //assign values to dropdown list
                                    var opt = $('<option />'); 

                                    opt.val(pID);
                                    opt.text(fullName);
                                    $('#updateexpenditure #studentid').append(opt);

                                        //this code removes duplicates from the list above
                                        var seen = {};
                                        jQuery('#updateexpenditure #studentid').children().each(function() 
                                        {
                                            var txt = jQuery(this).clone().wrap('<select>').parent().html();
                                            if (seen[txt]) {
                                                jQuery(this).remove();
                                            } else {
                                                seen[txt] = true;
                                            }

                                        }); 
                                });

                        }
                    });


    });

function update()
    {
            var datespent= $("#expenditures input[name=datespent]").val();
            var unitname = $("#expenditures input[name=unitname]").val();
            var amounteach= $("#expenditures input[name=amounteach]").val();
            var unitscount= $("#expenditures input[name=unitscount]").val();
            var description= $("#expenditures textarea").val();
            var studentpid= $("#expenditures #studentid").val();

            var pid= $("#expenditures #pid").val();

                        
            $.ajax(//ajax script to post the data without page refresh
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/ClubController/clubexpenditureupdate');?>",
                    data:{pid:pid,datespent:datespent,unitname:unitname,amounteach:amounteach,unitscount:unitscount,description:description,studentpid:studentpid},
                    dataType:'json',

                    success:function(data)
                    {
                        console.log(data);
                        //get json encoded feedback upon submission and respond appropriately
                       if (data.successful)
                        {
                            //if success is returned upon submission, show the success notification
                            $('#updateexpenditure #success').show();
                            //fade away the notification after 2000 milliseconds
                            $("#updateexpenditure #success").fadeTo(2000, 500).slideUp(500, function(){
                                $("#updateexpenditure #success").slideUp(500);
                                });

                            table.ajax.reload( null, false ); // reload the datatable 
                        //the rest applies as above
                        }else if (data.nochange)
                        {
                            $('#updateexpenditure #nochange').show();
                            $("#updateexpenditure #nochange").fadeTo(2000, 500).slideUp(500, function(){
                                $("#updateexpenditure #nochange").slideUp(500);
                                });
                        }else if (data.null)
                        {
                            $('#updateexpenditure #null').show();
                            $("#updateexpenditure #null").fadeTo(2000, 500).slideUp(500, function(){
                                $("#updateexpenditure #null").slideUp(500);
                                });
                        }

                    }
                });
    }




    function deleteexpenditure(objButton)
    {
        
        $('#deleteexpenditure').modal('toggle');


        $( "#deleteexpenditureconfirm").one('click', function(event)
            {
                var table=$('#expenditureslist').DataTable();

                var id=objButton.value;

                $.ajax(
                    {
                        type:"post",
                        url: "<?php echo base_url('index.php/ClubController/deleteexpenditure'); ?>",
                        data:{ id:id},
                        dataType:'json',

                        success:function(data)
                        {

                            if (data.successful)
                            {
                                $('#deleteexpenditure #deletesuccess ').show();
                                $("#deleteexpenditure #deletesuccess").fadeTo(2000, 500).slideUp(500, function(){
                                    $("#deleteexpenditure #deletesuccess").slideUp(500);
                                    });

                                 $("#deleteexpenditure ").fadeTo(1000, 200).slideUp(500, function(){
                                    $("#deleteexpenditure ").modal('toggle');
                                    });
                                table.ajax.reload( null, false ); // reload the datatable 


                            }else if (data.fail)
                            {
                                $('#deleteexpenditure #deletefail').show();
                                $("#deleteexpenditure #deletefail").fadeTo(2000, 500).slideUp(500, function(){
                                    $("#deleteexpenditure #deletefail").slideUp(500);
                                    });
                            }
                            
                        }
                    });



            });
        

    }


    //to refresh the page
    $( "#refresh").click( function()
        {
            window.setTimeout(function(){location.reload()},1)

        });


    $(function () 
        {
            $('#expenditures #datespent').datepicker({  format:'yyyy-mm-dd'   });
            $('#updateexpenditure #datespent').datepicker({  format:'yyyy-mm-dd'   });
        });

    // $(function () 
    //     {
    //         $('#clubofficialreg .input-daterange').datepicker({  format:'yyyy-mm-dd'   });
    //     });


    var resizefunc = [];

        $('#expenditures').submit( function(e) 
            { 
                e.preventDefault(e);
                if ( $(this).parsley().isValid() ) 
                    {
                        submitData();       
                    }
            });

        $('#updateexpenditure').submit( function(e) 
            { 
                e.preventDefault(e);
                if ( $(this).parsley().isValid() ) 
                    {
                        update();       
                    }
            });

        $(function () 
            {
                    $('#updateexpenditure #datespent').datepicker({
                    format: "yyyy-mm-dd",
                    todayHighlight: true,
                    autoclose: true,
                    calendarWeeks: false
                    });

                    $('#expenditures #datespent').datepicker({
                    format: "yyyy-mm-dd",
                    todayHighlight: true,
                    autoclose: true,
                    calendarWeeks: false
                    });
                });
            
           
    </script>

    </body>
    </html>

