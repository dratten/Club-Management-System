
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

        <?php  $this->load->view('admin/adminnav'); ?>
        <div id="page-wrapper" >
    
            <div class="row" >
                <div class="col-lg-12">
                    <h4 class="page-header" style="margin-top:10px;color:blue"><?php  echo " Club Patrons/Matrons";?></span></h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

     <?php $this->load->view('scriptlinks/scriptlinks.php'); ?>


<script>

//to refresh the page
$( "#refresh").click( function(event)
        {
            window.setTimeout(function(){location.reload()},1)

        });

</script>


</body>
</html>
