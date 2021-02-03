
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

</head>

<body>

<div id="wrapper">

        <?php  $this->load->view('clubsrep/clubsrepnav'); ?>
        <div id="page-wrapper" >
    
            <div class="row" >
                <div class="col-lg-12">
                    <h4 class="page-header" style="margin-top:10px;color:blue">Club Histories</span></h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="form-group col-lg-12">
                <div class="form-group col-lg-12">
                    <span data-placement="top" data-toggle="tooltip" title="Refresh">
                        <button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh</button>
                    </span>
                    <br>
                </div>
            </div>
            

            <div class="form-group col-lg-12">

             <?php $msg = $this->session->flashdata('msg');

            $successful= $msg['success']; if($successful==""){echo '<div></div>';} else if ($successful!=""){ echo '
                <div class="messagebox alert alert-success" style="display: block">
                        <button type="button" class="close" data-dismiss="alert">*</button>
                        <div class="cs-text">
                            <i class="fa fa-check-circle-o"></i>
                            <strong><span>';echo $msg['success'];echo '</span></strong>
                        </div> 
                </div>';}?>


                 <div class="row">
                <div class="col-md-12">
                   <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%"  id="historieslist">
                        <thead>
                            <tr>
                                <th class="text-left">Club Name</th>
                                <th class="text-left">History Particulars</th>
                                <th class="text-center" style="width:10%">Download</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                        <?php foreach($files as $file){ 

                           $file_ext=$file->file_ext;
                                if($file_ext==".doc"||$file_ext==".docx")
                                  {
                                    $i='<span><i class="fa fa-file-word-o fa-lg" style="color:blue"></i></span>';
                                  }else{
                                    $i='<span><i class="fa fa-file-pdf-o fa-lg" style="color:red"></i></span>';
                                  }

                                $dateUploaded=$file->dateUploaded;
                                $formattedDate = date("d/m/Y", strtotime($dateUploaded));
                              ?>
                            <td>  
                               
                                <?php echo $file->clubName; ?>
                            </td>
                            <td>  
                               
                                <?php echo $i; echo "&nbsp;&nbsp;"; echo "Club History Version "; echo "(".$file->versionNo.")";echo " uploaded on "; echo $formattedDate; ?>
                          </td>
                       
                            <td class="text-center">

                            <span data-placement="top" data-toggle="tooltip" title="Download History">
                                        <a href="<?php echo base_url('index.php/ClubController/download_clubhistory/');?><?php echo $file->file_name;?>"style="text-decoration: none"><span><i class="fa fa-download fa-lg"></i></span>
                                        </a></span>
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
$(document).ready(function () 

   {
    var table=$('#historieslist').DataTable({responsive:true,"iDisplayLength": 10,"lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],columnDefs: [ { orderable: false, targets: [1] }]
   });});

//to refresh the page
$( "#refresh").click( function(event)
        {
            window.setTimeout(function(){location.reload()},1)

        });

</script>

</body>
</html>
