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

     
}
    </style>
    
   

</head>

<body>

<div id="wrapper">

    <?php $this->load->view('clubsrep/clubsrepnav.php'); ?><!--navigation -->


    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header" style="margin-top:10px;color:blue">Current Clubs Officials</h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>


              <span data-placement="top" data-toggle="tooltip" title="Add Official">
                    <button class="btn btn-primary btn-xs" data-title="Add Official" data-toggle="modal" data-target="#addclubofficial" id="regmodal"><span class="fa fa-plus-circle"></span>&nbsp;Add Official</button></span>
            <span data-placement="top" data-toggle="tooltip" title="Refresh ">
                <button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh</button>
            </span>

             <span data-placement="top" data-toggle="tooltip" title="Print All">
                    <a class="btn btn-xs" data-title="Print All" type="button" href="<?php echo base_url('Home/clubofficialspdf');?>"><span class="fa fa-print"></span>&nbsp;Print All</a>
            </span>


            <br><br>
            <div class="row">
                <div class="col-md-12">
                    <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%" id="clubofficialslist"  >
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">SU ID</th>
                                <th class="text-center">Full name</th>
                                <th class="text-center">Club</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody >
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
            </div>

             <!--Add Club Official-->
            <div class="modal fade" id="addclubofficial" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Add Official </h4>
                        </div>

                        <div class="modal-body">
                            <form role="form" method="POST" action="" id="clubofficialreg">
                                        

                                        <div class="form-group col-lg-12">
                                            <label for="">Select Club</label><span class="star">*</span>
                                                <select id="club" name="club" class="form-control" required autocomplete="off">
                                                    <option value="">--Select Club---</option>
                                                </select>
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label for="">Select Nominee</label><span class="star">*</span>
                                                <select id="officialid" class="form-control" name="officialid" required autocomplete="off">
                                                <option value="" >--Select Nominee---</option>

                                                </select>

                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label>Service From</label>
                                            <div class='input-group date' >
                                                <input type='text' class="form-control" placeholder="<?php echo date('d/m/Y',strtotime('now'));?> Or less" id="startdate" name="startdate" data-parsley-trigger="change"
                                                       pattern="/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])$/"
                                                        required autocomplete="off" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group col-lg-12">
                                            <label>Service To</label>
                                            <div class='input-group date' id='dateofmeeting'>
                                                <input  class="input-sm form-control" name="enddate" id="enddate" type="text" placeholder="Greater than <?php echo date('d/m/Y',strtotime('now'));?> "
                                                      data-parsley-trigger="change"
                                                       pattern="/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])$/"
                                                        autocomplete="off" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                       
                                         <div class="form-group col-lg-12">
                                            <label for="">Club Role</label><span class="star">*</span>
                                                <select id="role" class="form-control" name="role" required autocomplete="off">
                                                    <option value="">--Select Role--</option>
                                                </select>
                                        </div>

                                        <button type="submit" class="btn btn-success" id="submit">Submit </button>
                                        <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">EXIT</button>



                                            <div class="messagebox alert alert-success"  id="success">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-check-circle-o"></i>
                                                    <strong><span> Success!</span></strong>
                                                    <p>New Club Official Successfully Registered!<br /></p>
                                                </div>
                                            </div>


                                            <div class="messagebox alert alert-danger"  id="fail">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-times"></i>
                                                    <strong> Registration Failed!</strong>
                                                    <p>User cannot have two active roles in one club!<br /></p>
                                                </div>
                                            </div>

                                             <div class="messagebox alert alert-warning"  id="null">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-times"></i>
                                                    <strong></i> Invalid Input!</strong>
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
            <!--Add club official-->



           <!--Edit Club Official-->
            <div class="modal fade" id="editclubofficial" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Edit Official </h4>
                        </div>

                        <div class="modal-body">
                            <form role="form" method="POST" action="" id="editclubofficialreg">
                                        

                                        <div class="form-group col-lg-12">
                                            <label for="">Select Club</label><span class="star">*</span>
                                                <select id="club" name="club" class="form-control" required autocomplete="off">
                                                    <option value="">--Select Club---</option>
                                                </select>
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label for="">Select Nominee</label><span class="star">*</span>
                                                <select id="officialid" class="form-control" name="officialid" required autocomplete="off">
                                                <option value="" >--Select Nominee---</option>

                                                </select>

                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label>Service From</label>
                                            <div class='input-group date' >
                                                <input type='text' class="form-control" placeholder="<?php echo date('d/m/Y',strtotime('now'));?> Or less" id="startdate" name="startdate" data-parsley-trigger="change"
                                                       pattern="/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])$/"
                                                        required autocomplete="off" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group col-lg-12">
                                            <label>Service To</label>
                                            <div class='input-group date' id='dateofmeeting'>
                                                <input  class="input-sm form-control" name="enddate" id="enddate" type="text" placeholder="Greater than <?php echo date('d/m/Y',strtotime('now'));?> "
                                                      data-parsley-trigger="change"
                                                       pattern="/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])$/"
                                                        autocomplete="off" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>

                                         <div class="form-group col-lg-12">
                                            <label for="">Club Role</label><span class="star">*</span>
                                                <select id="role" class="form-control" name="role" required autocomplete="off">
                                                    <option value="">--Select Role--</option>
                                                </select>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-success" id="submit" >Submit </button>
                                        <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">EXIT</button>

                                        <!-- <button type="reset" class="btn btn-default " id="reset">Reset </button> -->


                                            <div class="messagebox alert alert-success"  id="success">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-check-circle-o"></i>
                                                    <strong><span> Success!</span></strong>
                                                    <p>Club Official Successfully Updated!<br /></p>
                                                </div>
                                            </div>


                                            <div class="messagebox alert alert-danger"  id="fail">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-times"></i>
                                                    <strong> Updating Failed!</strong>
                                                    <p>User cannot have two active roles in one club!<br /></p>
                                                </div>
                                            </div>

                                            <div class="messagebox alert alert-warning"  id="nochange">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-times"></i>
                                                    <strong> No changes!</strong>
                                                    <p>You did not make any changes!<br /></p>
                                                </div>
                                            </div>

                                             <div class="messagebox alert alert-warning"  id="null">
                                                <button type="button" class="close" data-dismiss="alert"></button>
                                                <div class="cs-text">
                                                    <i class="fa fa-times"></i>
                                                    <strong></i> Invalid Input!</strong>
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
            <!--Edit club official-->


    <!-- Modal -->
    <div class="modal fade" id="viewclubofficial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                            <p class="text-center"><strong><span id="rolename"></span></strong>&nbsp;of &nbsp;<span id="clubname"></span>&nbsp;since &nbsp;<span id="startdate"></span></p>
                        </tr>
                        <tr>
                            <p class="text-center"><strong> Email: </strong><span id="suemail">
                        </tr>
                        <tr>
                            <p class="text-center"><strong> Phone: </strong><span id="phone">
                        </tr>
                        
                        <hr width="50%">
                        
                        <tr>
                            <p class="text-center"><strong> Student No: </strong><span id="suid">
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
    
            $("#clubofficialslist").dataTable().fnDestroy();//destroy the table and recreate it for every refresh


                    var table=$('#clubofficialslist').DataTable({responsive:true,"iDisplayLength": 10,"lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],

                    //ajax script to retrieve data club officials from db
                    "ajax": {
                    "url":"<?php echo base_url('index.php/Home/clubofficialslist'); ?>",
                    "type":"GET",
                    "dataType":"json"},
                    "columns": [
                    { "data": "count",responsivePriority: 1 },//define column widths
                    { "data": "suID" ,responsivePriority: 4},
                    { "data": "fullName",responsivePriority: 2 },
                    { "data": "clubName" },
                    { "data": "roleName" ,responsivePriority: 3},
                    { "data": "action" }],


                    //aoColumnDefs This array allows you to target a specific column, multiple columns, or all columns, using the aTargets property of each object in the array
                    "aoColumnDefs": [
                    {"bSortable":false, "aTargets": [0], "orderable": false},
                      {"aTargets": [5],//the target column ie 7th column
                      "orderable": false,
                      "mData": "action",

                      "mRender": function ( data, type, full ) 
                      {
                        
                        return ' <span data-placement="top" data-toggle="tooltip" title="Edit Official"><button class="btn btn-primary btn-xs" data-title="Edit" onclick="editcofficial(this);" id="edit" value="'+data+'"><span class="glyphicon glyphicon-pencil"></span></button></span>&nbsp;                                                                                                                                                                                                                        <span data-placement="top" data-toggle="tooltip" title="View Profile"><button class="btn btn-xs" data-title="View Profile" onclick="c_o_view(this);" id="view" value="'+data+'"><span class="glyphicon glyphicon-eye-open"></span></button></span>&nbsp; ';

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

function submitData()
    {
           var table=$('#clubofficialslist').DataTable();//define the datatble for refreshing
            
            //assign input values to variables for posting
           var club= $("#clubofficialreg #club").val();
           var officialid= $("#clubofficialreg #officialid").val();
           var role= $("#clubofficialreg #role").val();
           var startdate= $("#clubofficialreg input[name=startdate]").val();
           var enddate= $("#clubofficialreg input[name=enddate]").val();

       
            var table=$('#clubofficialslist').DataTable();//define the datatable for refresh on registering


            $.ajax(//ajax script to post the data without page refresh
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/Home/clubofficialregistration')?>",
                    data:{ officialid:officialid,club:club,role:role,startdate:startdate,enddate:enddate},
                    dataType:'json',

                    success:function(data)
                    {
                        console.log(data);
                        //get json encoded feedback upon submission and respond appropriately
                       if (data.successful)
                        {
                            //if success is returned upon submission, show the success notification
                            $('#addclubofficial #success').show();
                            //fade away the notification after 2000 milliseconds
                            $("#addclubofficial #success").fadeTo(2000, 500).slideUp(500, function(){
                                $("#addclubofficial #success").slideUp(500);
                                });

                                table.ajax.reload( null, false ); // reload the datatable on registration

                            $('#addclubofficial #clubofficialreg')[0].reset();

                        }else if (data.fail)
                        {
                            $('#addclubofficial #fail').show();
                            $("#addclubofficial #fail").fadeTo(2000, 500).slideUp(500, function(){
                                $("#addclubofficial #fail").slideUp(500);
                                });
                            
                        }else if (data.null)
                        {
                            $('#addclubofficial #null').show();
                            $("#addclubofficial #null").fadeTo(2000, 500).slideUp(500, function(){
                                $("#addclubofficial #null").slideUp(500);
                                });
                        }

                        
                        table.ajax.reload( null, false ); // reload the datatable on registration


                    }
                });
             
 }


function update()
{
            //assign input values to variables for posting
           var club= $("#editclubofficialreg #club").val();
           var officialid= $("#editclubofficialreg #officialid").val();
           var role= $("#editclubofficialreg #role").val();
           var startdate= $("#editclubofficialreg input[name=startdate]").val();
           var enddate= $("#editclubofficialreg input[name=enddate]").val();

            var table=$('#clubofficialslist').DataTable();//define the datatable for refreshing

            $.ajax(//ajax script to post the data without page refresh
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/Home/clubofficialupdating')?>",
                    data:{ officialid:officialid,club:club,role:role,startdate:startdate,enddate:enddate},
                   
                    dataType:'json',

                    success:function(data)
                    {
                        
                        //get json encoded feedback upon submission and respond appropriately
                       if (data.successful)
                        {
                            //if success is returned upon submission, show the success notification
                            $('#editclubofficial #success').show();
                            //fade away the notification after 2000 milliseconds
                            $("#editclubofficial #success").fadeTo(2000, 500).slideUp(500, function(){
                                $("#editclubofficial #success").slideUp(500);
                                });
                            
                             table.ajax.reload( null, false ); // reload the datatable on registration

                        //the rest applies as above

                        }else if (data.nochange)
                        {
                            $('#editclubofficial #nochange').show();
                            $("#editclubofficial #nochange").fadeTo(2000, 500).slideUp(500, function(){
                                $("#editclubofficial #nochange").slideUp(500);
                                });
                            
                        }else if (data.null)
                        {
                            $('#editclubofficial #null').show();
                            $("#editclubofficial #null").fadeTo(2000, 500).slideUp(500, function(){
                                $("#editclubofficial #null").slideUp(500);
                                });
                           
                        }  

                    }
                });
              
}


function editcofficial(objButton)
{
    var id=objButton.value;
    $('#editclubofficialreg')[0].reset();

     $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/Home/getclubofficial'); ?>",
                    data:{ id:id},
                    dataType:'json',

                    success:function(data)
                    {
                        
                        $('#editclubofficialreg input[name=startdate]').val(data.startDate);
                        $('#editclubofficialreg input[name=enddate]').val(data.endDate);


                        $('#editclubofficialreg #club').empty();
                        
                        var clubID=data.clubID;
                        var clubName=data.clubName;
                        var opt = $('<option />');
                            opt.val(clubID);
                            opt.text(clubName);

                        $('#editclubofficialreg #club').append(opt);

                        $('#editclubofficialreg #officialid').empty();
                        
                        var pID=data.pID;
                        var fullName=data.fullName;
                        var opt = $('<option />');
                            opt.val(pID);
                            opt.text(fullName);

                        $('#editclubofficial #editclubofficialreg #officialid').append(opt);

                        $('#editclubofficial #editclubofficialreg #role').empty();
                        
                        var roleID=data.roleID;
                        var roleName=data.roleName;
                        var opt = $('<option />');
                            opt.val(roleID);
                            opt.text(roleName);

                        $('#editclubofficial #editclubofficialreg #role').append(opt);

                        $('#editclubofficial').modal('toggle');

                        //automatically click on the inputs for smooth dropdown lists
                        $(' #editclubofficialreg #club').click();
                        $(' #editclubofficialreg #officialid').click();
                        $(' #editclubofficialreg #role').click();
                    }
                });


}




$( "#editclubofficialreg #club").on('click',function(event)
        {

         
     $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/Home/clubdropdownlist'); ?>",
                    dataType:'json',

                    success:function(data)
                    {

                         //populate the clubs dropdown list on edit
                         $.each(data,function(clubID,clubName)
                            {

                                var opt = $('<option />').empty(); 

                                opt.val(clubID);
                                opt.text(clubName);

                                $('#editclubofficialreg #club').append(opt);

                            });

                        //this code removes duplicates from the list above
                        
                        var seen = {};
                        jQuery('#editclubofficialreg #club').children().each(function() 
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



$( "#editclubofficial #editclubofficialreg #role").on('click', function(event)
        {

         
     $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/Home/c_rolesdropdown'); ?>",
                    dataType:'json',

                    success:function(data)
                    {
                       //populate the clubs dropdown list on edit
                         $.each(data,function(roleID,roleName)
                            {


                                var opt = $('<option />').empty(); 

                                opt.val(roleID);
                                opt.text(roleName);

                                $('#editclubofficialreg #role').append(opt);  

                            });
                                    

                        //this code removes duplicates from the list above
                        var seen = {};
                        jQuery('#editclubofficialreg #role').children().each(function() 
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


//=======================club dropdown list on registration form toggle view=========================

$( "#regmodal").on('click', function(event)
        {
            event.preventDefault(event);//prevent auto submit data
         
     
            $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/Home/clubdropdownlist'); ?>",
                    dataType:'json',

                    success:function(data)
                    {

                         $.each(data,function(clubID,clubName)
                            {
                               //assign values to dropdown list
                                var opt = $('<option />'); 

                                opt.val(clubID);
                                opt.text(clubName);
                                $('#clubofficialreg #club').append(opt);

                                    //sort the dropdown list 
                                    var options = $('#clubofficialreg #club option');
                                    var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
                                    arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
                                    options.each(function(i, o) {
                                      o.value = arr[i].v;
                                      $(o).text(arr[i].t);
                                    });


                                    //this code removes duplicates from the list above
                                    var seen = {};
                                    jQuery('#clubofficialreg #club').children().each(function() 
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
            

            $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/Home/c_rolesdropdown'); ?>",
                    dataType:'json',

                    success:function(data)
                    {

                         $.each(data,function(roleID,roleName)
                            {
                                //assign role values to dropdown list 
                                var opt = $('<option />'); 

                                opt.val(roleID);
                                opt.text(roleName);
                                $('#clubofficialreg #role').append(opt);


                                //sort the roles dropdown list 
                                var options = $('#clubofficialreg #role option');
                                    var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
                                    arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
                                    options.each(function(i, o) {
                                      o.value = arr[i].v;
                                      $(o).text(arr[i].t);
                                    });

                               //this code removes duplicates from the list above
                                var seen = {};
                                jQuery('#clubofficialreg #role').children().each(function() 
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


function c_o_view(objButton)
{
    var id=objButton.value;
     $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/Home/viewclubofficial'); ?>",
                    data:{ id:id},
                    dataType:'json',

                    success:function(data)
                    {
                        console.log(data);
                        $('#viewclubofficial #fullname').text(data.firstName+' '+data.lastName);
                        $('#viewclubofficial #suid').text(data.suID);
                        $('#viewclubofficial #phone').text(data.telNo);
                        $('#viewclubofficial #clubname').text(data.clubName);
                        $('#viewclubofficial #rolename').text(data.roleName);
                        $('#viewclubofficial #coursename').text(data.courseName);
                        $('#viewclubofficial #gender').text(data.gender);
                        $('#viewclubofficial #suemail').text(data.suEmail);

                        if(data.startDate=="")
                        {
                            $('#viewclubofficial #startdate').text(data.startDate+'____')
                        }else
                        {
                            $('#viewclubofficial #startdate').text(data.startDate)
                        }

                        $('#viewclubofficial').modal('toggle');

                        
                    }
                });


}


$( "#clubofficialreg #club").on('change', function(event)
        {
            event.preventDefault(event);

            var clubid=$( "#clubofficialreg #club").val();

             $('#clubofficialreg #officialid').empty();
             $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/Home/officialsnominees'); ?>",
                    data:{ clubid:clubid},
                    dataType:'json',

                    success:function(data)
                    { 

                         $.each(data,function(pID,fullName)
                            {
                                //assign role values to dropdown list 
                                var opt = $('<option />'); 

                                opt.val(pID);
                                opt.text(fullName);
                                $('#clubofficialreg #officialid').append(opt);


                                //sort the roles dropdown list 
                                var options = $('#clubofficialreg #officialid option');
                                    var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
                                    arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
                                    options.each(function(i, o) {
                                      o.value = arr[i].v;
                                      $(o).text(arr[i].t);
                                    });

                               //this code removes duplicates from the list above
                                var seen = {};
                                jQuery('#clubofficialreg #role').children().each(function() 
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


$( "#editclubofficialreg #club").on('change', function(event)
        {
            event.preventDefault(event);
            var clubid=$( "#editclubofficialreg #club").val();
        
             $('#editclubofficialreg #officialid').empty();
             $('#editclubofficialreg #startdate').empty();
             $('#editclubofficialreg #enddate').empty();
             $('#editclubofficialreg #role').empty();

             $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/Home/officialsnominees'); ?>",
                    data:{ clubid:clubid},
                    dataType:'json',

                    success:function(data)
                    { 

                         $.each(data,function(pID,fullName)
                            {
                                //assign role values to dropdown list 
                                var opt = $('<option />'); 

                                opt.val(pID);
                                opt.text(fullName);
                                $('#editclubofficialreg #officialid').append(opt);


                                //sort the roles dropdown list 
                                var options = $('#editclubofficialreg #officialid option');
                                    var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
                                    arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
                                    options.each(function(i, o) {
                                      o.value = arr[i].v;
                                      $(o).text(arr[i].t);
                                    });

                               //this code removes duplicates from the list above
                                var seen = {};
                                jQuery('#editclubofficialreg #officialid').children().each(function() 
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

//to refresh the page
$( "#refresh").click( function(event)
        {
            window.setTimeout(function(){location.reload()},1)

        });

$(function () 
    {
        $('#clubofficialreg #startdate').datepicker({  format:'yyyy-mm-dd'   });
        $('#editclubofficialreg #startdate').datepicker({  format:'yyyy-mm-dd'   });
        $('#clubofficialreg #enddate').datepicker({  format:'yyyy-mm-dd'   });
        $('#editclubofficialreg #enddate').datepicker({  format:'yyyy-mm-dd'   });
    });


$(function () 
        {
                
                $('#clubofficialreg #startdate').datepicker({
                format: "yyyy-mm-dd",
                todayHighlight: true,
                autoclose: true,
                calendarWeeks: false
                });

                $('#editclubofficial #startdate').datepicker({
                format: "yyyy-mm-dd",
                todayHighlight: true,
                autoclose: true,
                calendarWeeks: false
                });

                $('#clubofficialreg #enddate').datepicker({
                format: "yyyy-mm-dd",
                todayHighlight: true,
                autoclose: true,
                calendarWeeks: false
                });

                $('#editclubofficial #enddate').datepicker({
                format: "yyyy-mm-dd",
                todayHighlight: true,
                autoclose: true,
                calendarWeeks: false
                });

});

</script>
<script>
            var resizefunc = [];
        </script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#clubofficialreg').parsley();
        $('#editclubofficialreg').parsley();
    });
    

    $('#clubofficialreg').submit( function(e) 
    { 
        e.preventDefault(e);
      
        if ( $(this).parsley().isValid()) {
            submitData();       
        }
    });

    $('#editclubofficialreg').submit( function(e) { 
        e.preventDefault(e);
        if ($(this).parsley().isValid() ) {
            update();       
        }
    });


</script>


</body>
</html>
