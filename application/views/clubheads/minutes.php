
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
      #meeting option
        {
          font-weight: bold;
          color:orange;
        }
    </style>
       
</head>

<body>

<div id="wrapper">

        <?php  $this->load->view('clubheads/clubnavigation'); ?>
        <div id="page-wrapper" >
    
            <div class="row" >
                <div class="col-lg-12">
                    <h4 class="page-header" style="margin-top:10px;color:blue"><span> <?php echo $this->session->userdata('clubName');?></span><span > Minutes</span></h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        
             <div class="form-group col-lg-6">
                <!-- <label for="">Select Meeting</label> -->
                <span data-placement="top" data-toggle="tooltip" title="Refresh to update number of entries">
                <button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh</button></span>
                <br>
              </div>

              <div class="form-group col-lg-12">

            <?php $msg = $this->session->flashdata('msg');

            $successful= $msg['success']; $failed=  $msg['error']; if ($successful=="" && $failed!=""){ echo '
                <div class="messagebox alert alert-danger" style="display: block">
                        <button type="button" class="close" data-dismiss="alert">*</button>
                        <div class="cs-text">
                            <i class="fa fa-close"></i>
                            <strong><span>';echo $msg['error']; echo '</span></strong>
                        </div> 
                </div>';}else if($successful=="" && $failed==""){echo '<div></div>';} else if ($successful!="" && $failed==""){ echo '
                <div class="messagebox alert alert-success" style="display: block">
                        <button type="button" class="close" data-dismiss="alert">*</button>
                        <div class="cs-text">
                            <i class="fa fa-check-circle-o"></i>
                            <strong><span>';echo $msg['success'];echo '</span></strong>
                        </div> 
                </div>';}?>
                            
                    

              <?php $attributes = array('id' => 'uploadminutes'); echo form_open_multipart('index.php/ClubController/upload_minutes', $attributes);?>
              
                <div class="form-group col-lg-12">
                    <label>Select Meeting</label> <span class="star">*</span>
                     <select id="meeting" name="meeting" class="form-control" parsley-trigger="change" required autocomplete="off">
                          <option value="">--Select Meeting---</option>
                      </select>
                </div>
                <div class="form-group col-lg-6">
                    <label>File Upload</label> <span class="star">*</span>
                    <input class="form-control" name="minutes" id="minutes" type="file" parsley-trigger="change" required autocomplete="off" size="20">
                </div>
                <div class="form-group col-lg-6">
                    <label></label> <br>
                    <input type="submit" class="btn btn-warning"  value="Upload Minutes" name="btnsubmit" id="btnsubmit">
                    <input type="reset" class="btn"  value="Reset">
                </div>  

                
          </form>
          </div>


          <div class="row">
                <div class="col-md-12">
                   <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%"  id="minuteslist">
                        <thead>
                            <tr>
                                <th class="text-left">Minutes Particulars</th>
                                <th class="text-center" style="width:10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                        <?php  foreach($files as $file){ 

                          $file_ext=$file->file_ext;
                                if($file_ext==".doc"||$file_ext==".docx")
                                  {
                                    $i='<span><i class="fa fa-file-word-o fa-lg" style="color:blue"></i></span>';
                                  }else  if($file_ext==".pdf"||$file_ext==".PDF"){
                                    $i='<span><i class="fa fa-file-pdf-o fa-lg" style="color:red"></i></span>';
                                  }else  if($file_ext==".xls"||$file_ext==".xlsx"){
                                    $i='<span><i class="fa fa-file-excel-o fa-lg" style="color:#33bbff"></i></span>';
                                  }


                                $start=$file->startTime;
                                $starttime=date("g:i A", strtotime($start));
                                $meetingdate=$file->meetingDate;
                                $formattedDate = date("d/m/Y", strtotime($meetingdate));
                              ?>
                        
                            <td>  
                               
                                <?php echo $i; echo "&nbsp;&nbsp;"; echo "Minutes of the meeting held on "; echo $formattedDate; echo " at "; echo $file->meetingVenue; echo " from "; echo $starttime;?>
                          </td>
                       
                            <td class="text-center">

                                <span data-placement="top" data-toggle="tooltip" title="Download Minutes">
                                    <a href="<?php echo base_url('index.php/ClubController/download_minutes/');?><?php echo $file->file_name;?>"style="text-decoration: none"><span><i class="fa fa-download fa-lg"></i></span></a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                                </span>

                                <span data-placement="top" data-toggle="tooltip" title="Delete Minutes">
                                    <a  href="<?php echo base_url('index.php/ClubController/delete_club_minutes');?><?php echo "?meetingID="; echo  $file->meetingID;?>"  style="text-decoration: none"><span><i class="fa fa-trash fa-lg" style="color:red"></i></span></a>
                                </span>
                            </td>
                        </tr>
                        <?php }?>

                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
            </div>

        </div>
        <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

     <?php $this->load->view('scriptlinks/scriptlinks.php'); ?>

 <script>


        $(document).ready(function() 
        {
            
              $('#uploadminutes').parsley();

               $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url('index.php/ClubController/meetingswithoutminutesdropdown');?>",
                    dataType:'json',

                    success:function(data)
                    {

                         $.each(data,function(meetingID,description)
                            {
                                var opt = $('<option />'); 

                                opt.val(meetingID);
                                opt.text(description);
                                $('#meeting').append(opt);


                            });

                             //sort the events dropdown list 
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
                                var table=$('#minuteslist').DataTable({responsive:true,"iDisplayLength": 10,"lengthMenu": [[10, 
                            25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],columnDefs: [ { orderable: false, targets: [1] }]
                            });
                    }


                });


    });


    $('#uploadminutes #btnsubmit').click( function(e) { 
        e.preventDefault(e);
        $('#uploadminutes').parsley().validate();
        if ( $('#uploadminutes').parsley().isValid() ) {
                document.getElementById("uploadminutes").submit();
        }
    });



    //to refresh the page
    $( "#refresh").click( function(event)
        {
            window.setTimeout(function(){location.reload()},1)

        });
   </script>

</body>
</html>
