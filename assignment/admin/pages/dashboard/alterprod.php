<?php
include ('../../connection2.php');
include ('imageupload.php');

if(isset($_GET['id']))
{
	$eid = $_GET['id'];
	$detail = "SELECT * FROM product WHERE product_id = $eid";
	$detailqry = oci_parse($connection, $detail);
	oci_execute($detailqry);
	while($row = oci_fetch_assoc($detailqry)){
                        $name = $row['PRODUCT_NAME'];
						$desc = $row['PRODUCT_DESCRIPTION'];
						$sku = $row['PRODUCT_SKU'];
						$quantity = $row['PRODUCT_QUANTITY'];
						$allergy = $row['PRODUCT_ALLEGERY_INFO'];
						$price = $row['PRODUCT_PRICE'];
						$special_price = $row['PRODUCT_SPECIAL_PRICE'];
						$special_from = $row['PRODUCT_SPECIAL_FROM'];
						$special_to = $row['PRODUCT_SPECIAL_TO'];
						$status = $row['PRODUCT_STATUS'];
						$featured = $row['PRODUCT_FEATURED'];
	}
}

if (isset($_POST['updateprod'])) 
{
	$name=$_POST['name'];
	$desc=$_POST['desc'];
	$sku =$_POST['sku'];
	$quantity =$_POST['quantity'];
	$allergy =$_POST['allergy'];
	$price =$_POST['price'];
	$special_price =$_POST['special_price'];
	$special_from =$_POST['from'];
	$special_to =$_POST['to'];
	$status =$_POST['status'];
	$featured =$_POST['featured'];
	
	$img_src = '';
	
	if(!empty($_FILES['image']['name'])){
	
	//call thumbnail creation function and store thumbnail name
	$upload_img = imageUpload('image','../../../assets/images/','');
	$img_src = 'assets/images/'.$upload_img;
		
	//set success and error messages
	$message = $upload_img?"<span style='color:#008000;'>Image thumbnail have been created successfully.</span>":"<span style='color:#F00000;'>Some error 				occurred, please try again.</span>";
	
	}else{
	
	//if form is not submitted, below variable should be blank
	$message = '';
}
	
	//ensure that form filled are filled properly

	if (empty($name)) {
		array_push($errors, "Name required!");
	}
	if(empty($desc)){
		array_push($errors, "Description required!");	
	}
	if (empty($sku)) {
		array_push($errors, "SKU required!");
	}
	//if there are no errors save it to database
	if (count($errors) == 0){
		$sql = "UPDATE PRODUCT SET PRODUCT_NAME = '$name', PRODUCT_DESCRIPTION='$desc', PRODUCT_SKU = '$sku', PRODUCT_QUANTITY=$quantity, PRODUCT_ALLEGERY_INFO = '$allergy', PRODUCT_PRICE = $price, PRODUCT_SPECIAL_PRICE=$special_price, PRODUCT_SPECIAL_FROM = '$special_from', PRODUCT_SPECIAL_TO = '$special_to', PRODUCT_STATUS = '$status', PRODUCT_FEATURED = '$featured', PRODUCT_IMAGE_PATH = '$img_src' WHERE PRODUCT_ID = $eid";
		
		$result = oci_parse($connection,$sql);
		
		oci_execute($result);	
		

	header('location:data.php');//redirect to homepage
} 
}


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ENBackEnd | Update Product</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../../bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../../bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../../index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>EN</b>B</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>EN</b>BackEnd</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
          <li><a href="../../pages/dashboard/data.php"><i class="fa fa-table"></i> Data tables</a></li>
          <li><a href="../../pages/dashboard/addprod.php"><i class="fa fa-edit"></i> Add product</a></li>
          		
<li><a href="../../pages/dashboard/updateprod.php"><i class="fa fa-edit"></i> Update/Delete product</a></li>	

        </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       	Update Product
      </h1>
      <ol class="breadcrumb">
        <li><a href="../../../index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Update Product</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Enter details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="" enctype="multipart/form-data">
              <div class="box-body">
			 <div class="form-group">
                  <label for="exampleInputName">Name</label>
                  <input type="text" class="form-control" id="exampleInputName" value="<?php echo $name?>" name="name" >
                </div>
                <div class="form-group">
                  <label for="exampleInputDescription">Description</label>
                  <input type="text" class="form-control" id="exampleInputDescription" value="<?php echo $desc?>" name="desc">
                </div>
               	 <div class="form-group">
                  <label for="exampleInputSKU">SKU</label>
                  <input type="text" class="form-control" id="exampleInputSKU" value="<?php echo $sku?>" name="sku">
                </div>
               	 <div class="form-group">
                  <label for="exampleInputQuantity">Quantity</label>
                  <input type="number" class="form-control" id="exampleInputQuantity" value="<?php echo $quantity?>" name="quantity">
                </div>
               	 <div class="form-group">
                  <label for="exampleInputAllergy">Allergy Info</label>
                  <input type="text" class="form-control" id="exampleInputAllergy" value="<?php echo $allergy?>" name="allergy">
                </div>
               <div class="form-group">
                  <label for="exampleInputPrice">Price</label>
                  <input type="number" class="form-control" id="exampleInputPrice" value="<?php echo $price?>" name="price">
                </div>
				<div class="form-group">
                  <label for="exampleInputSpecialPrice">Special Price</label>
                  <input type="number" class="form-control" id="exampleInputSpecialPrice" value ="<?php echo $special_price?>" name="special_price">
                </div>
				<div class="form-group">
                  <label for="exampleInputFrom">Special Price From</label>
                  <input type="text" class="form-control" id="exampleInputForm" value="<?php echo $special_from?>" name="from">
                </div>
				<div class="form-group">
                  <label for="exampleInputTo">Special Price To</label>
                  <input type="text" class="form-control" id="exampleInputTo" value="<?php echo $special_to?>" name="to">
                </div>
				<div class="form-group">
                  <label for="exampleInputStatus">Status</label>
                   <select class="form-control" id="exampleInputStatus" name="status" value="<?php echo $status?> ">
                  	<option>On</option>
                    <option>Off</option>
                    </select>
                
                </div>
                <div class="form-group">
                  <label for="exampleInputFeatured">Featured</label>
                   <select class="form-control" id="exampleInputFeatured" name="featured" value="<?php echo $featured?>">
                  	<option>Yes</option>
                    <option>No</option>
                    </select>
                
                </div>
				
												                                 


                <div class="form-group">
                  <label for="exampleInputFile">Choose thumbnail</label>
                  <input type="file" id="exampleInputFile" name="image">

                  <p class="help-block">Upload an appropriate image for the event.</p>
                </div>
               </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="updateprod" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
      </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2018 <a href="">Bronte Shops</a>.</strong> All rights
    reserved.
  </footer>

<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="../../bower_components/raphael/raphael.min.js"></script>
<script src="../../bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="../../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../bower_components/moment/min/moment.min.js"></script>
<script src="../../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
</body>
</html>
