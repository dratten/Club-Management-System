
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
    table td:nth-child(1),td:nth-child(2),td:nth-child(3) ,td:nth-child(4) ,td:nth-child(5) ,td:nth-child(6),td:nth-child(7)  
                {

                 text-align:center !important;
                }
    html,body
        {
            background-color: white;
        }
    #clubmemberslist th
        {
            border-bottom:2px solid;
            border-color: grey;
        }
    #clubmemberslist 
        {
            border-bottom:none;
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
            @media screen and (max-width: 767px) 
            {
                .dataTables_length 
                    {
                        float:left !important;
                        margin-right:10px;
                    }
            }
            @media screen and (max-width: 767px) 
            {
                .dataTables_wrapper .dataTables_filter
                    {
                        float:left !important;
                        max-width: 150px;
                    }
            }

    </style>
       
</head>

<body>

<div id="wrapper">


        <?php  $this->load->view('admin/adminnav'); ?>
        <div id="page-wrapper" >

    
            <div class="row" >
                <div class="col-lg-12">
                    <h4 class="page-header" style="margin-top:10px;color:blue"><span>Add First Club Member</span></h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" method="POST" action="" id="clubmemberreg" autocomplete="off">
                                <div class="form-group col-lg-12">
                                    <label for="">Select Club</label><span class="star">*</span>
                                    <select id="club" name="club" class="form-control" required autocomplete="off">
                                        <option value="">--Select Club---</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>Student ID<span class="star">*</span></label> <!-- <span id="num" class="fa fa-asterisk" style="color:#FF0004;font-size: 10px" > --><!-- </span>  -->
                                    <input class="form-control" id="suid" name="suid" data-parsley-type="digits" required data-parsley-length="[2,6]" placeholder="Example: 78581" autocomplete="off">
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>Surname<span class="star">*</span></label>
                                    <input class="form-control" placeholder="Example: Mokoro" name="lastname" id="lastname" parsley-trigger="change" required >
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>First Name<span class="star">*</span></label>
                                    <input class="form-control" placeholder="Example: Stephen" name="firstname" id="firstname" parsley-trigger="change" required autocomplete="off">
                                </div>

                                <div class="form-group col-lg-12">
                                    <label class="">Gender<span class="star">*</span></label><br>
                                    <label class="radio-inline ">
                                        <input type="radio" name="gender" id="gender" value="Male" parsley-trigger="change" required autocomplete="off">Male
                                    </label>
                                    <label class="radio-inline ">
                                        <input type="radio" name="gender" id="gender" value="Female" parsley-trigger="change" required autocomplete="off">Female
                                    </label><br><br>
                                   
                                </div>

                                <div class="form-group col-lg-12">
                                    <label>SU Email<span class="star">*</span></label>
                                    <input type="email" class="form-control" placeholder="Example: stephen.mokoro@strathmore.edu" name="suemail" id="suemail" parsley-type="email" required autocomplete="off">
                                </div>

                                <div class="form-group col-lg-12">
                                    <label>Cell Phone<span class="star">*</span></label>
                                    <input class="form-control" placeholder="Example: +254 (0) 719508386" name="phone" id="phone" parsley-trigger="change" required pattern="^[\d\+\(\)\/\s]*$" autocomplete="off">
                                </div>

                                <div class="form-group col-lg-12">
                                    <label for="">Select Course<span class="star">*</span></label>
                                        <select id="course" name="course" class="form-control"  required>
                                        </select>
                                </div> 

                                <button type="submit" class="btn btn-success" id="submit" >Submit </button>
                                <button type="reset" class="btn btn-default " id="reset">Reset </button>

                                <div class="messagebox alert alert-success"  id="success">
                                    <button type="button" class="close" data-dismiss="alert"></button>
                                    <div class="cs-text">
                                        <i class="fa fa-check-circle-o"></i>
                                        <strong><span> Success!</span></strong>
                                        <p>New Club Member Successfully Registered!<br /></p>
                                    </div>
                                </div>

                                <div class="messagebox alert alert-danger"  id="fail">
                                    <button type="button" class="close" data-dismiss="alert"></button>
                                    <div class="cs-text">
                                        <i class="fa fa-times"></i>
                                        <strong> Registration Failed!</strong>
                                        <p>The member is already registered and active!<br /></p>
                                    </div>
                                </div>

                                 <div class="messagebox alert alert-info"  id="inactive">
                                    <button type="button" class="close" data-dismiss="alert"></button>
                                    <div class="cs-text">
                                        <i class="fa fa-times"></i>
                                        <strong> Registration Failed!</strong>
                                        <p>The member is already registered and but inactive. Please consider activating him/her<br /></p>
                                    </div>
                                </div>

                                 <div class="messagebox alert alert-warning"  id="error">
                                    <button type="button" class="close" data-dismiss="alert"></button>
                                    <div class="cs-text">
                                        <i class="fa fa-times"></i>
                                        <strong></i> Invalid Input!</strong>
                                        <p>A required field is empty!<br /></p>
                                    </div>
                                </div>
                            </form>
                        </div><!--col-lg-12-->
                    </div><!--row-->

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


function submitData()
        {
            var table=$('#clubmemberslist').DataTable();
            
            //assign input values to variables for posting
           var suid= $("#clubmemberreg input[name=suid]").val();
           var lastname= $("#clubmemberreg input[name=lastname]").val();
           var firstname= $("#clubmemberreg input[name=firstname]").val();
           var gender= $("#clubmemberreg input[name=gender]:checked").val();
           var phone= $("#clubmemberreg input[name=phone]").val();
           var suemail= $("#clubmemberreg input[name=suemail]").val();
           var course= $("#clubmemberreg #course").val();
           var clubid= $("#clubmemberreg #club").val();

            $.ajax(//ajax script to post the data without page refresh
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/Home/addseedmember');?>",
                    data:{ suid:suid,lastname:lastname,firstname:firstname,gender:gender,phone:phone,suemail:suemail,course:course,clubid:clubid},
                    dataType:'json',
                    success:function(data)
                    {
                        console.log(data);
                        //get json encoded feedback upon submission and respond appropriately
                       if (data.successful)
                        {
                            //if success is returned upon submission, show the success notification
                            $('#clubmemberreg #success').show();
                            //fade away the notification after 2000 microseconds
                            $("#clubmemberreg #success").fadeTo(2000, 500).slideUp(500, function(){
                                $("#clubmemberreg #success").slideUp(500);
                                });
                        }else if (data.fail)
                        {
                            $('#clubmemberreg #fail').show();
                            $("#clubmemberreg #fail").fadeTo(2000, 500).slideUp(500, function(){
                                $("#clubmemberreg #fail").slideUp(500);
                                });
                            
                        }else if (data.error)
                        {
                            $('#clubmemberreg #error').show();
                            $("#clubmemberreg #error").fadeTo(2000, 500).slideUp(500, function(){
                                $("#clubmemberreg #error").slideUp(500);
                                });
                           
                        }else if (data.exists_but_inactive)
                        {
                            $('#clubmemberreg #inactive').show();
                            $("#clubmemberreg #inactive").fadeTo(2000, 500).slideUp(500, function(){
                                $("#clubmemberreg #inactive").slideUp(500);
                                });
                            
                        }

                    }
                });
              
        

    }

//=======================Course dropdown list on registration form toggle view=========================

$(document).ready(function() 
    {
        $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/ClubController/coursedropdownlist')?>",
                    dataType:'json',
                    success:function(data)
                    {
                         $.each(data,function(courseID)
                            {
                               //assign values to dropdown list
                                // var opt = $('<option selected="selected"/>'); 
                                var opt = $('<option />'); 
                                opt.val(courseID);
                                opt.text(courseID);
                                $('#clubmemberreg #course').append(opt);
                                    //sort the dropdown list 
                                    var options = $('#clubmemberreg #course option');
                                    var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
                                    arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
                                    options.each(function(i, o) {
                                      o.value = arr[i].v;
                                      $(o).text(arr[i].t);
                                    });
                                    //this code removes duplicates from the list above
                                    var seen = {};
                                    jQuery('#clubmemberreg #course').children().each(function() 
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

         
            $.ajax(//ajax for clubs dropdown
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

                                $('#clubmemberreg #club').append(opt);

                            });

                        //this code removes duplicates from the list above
                        
                        var seen = {};
                        jQuery('#clubmemberreg #club').children().each(function() 
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



//to refresh the page
$( "#refresh").click( function(event)
        {
            window.setTimeout(function(){location.reload()},1)

        });
            var resizefunc = [];
    $(document).ready(function() {
        $('#clubmemberreg').parsley();
            });
    
    $('#clubmemberreg').submit( function(e) { 
        e.preventDefault(e);
        if ( $(this).parsley().isValid() ) {
            submitData();       
        }
    });

</script>

</body>
</html>
