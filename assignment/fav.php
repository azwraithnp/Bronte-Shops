<!doctype html>
<html>
<head>

<meta charset="utf-8">
<title>Favorites</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
       
     <link rel="stylesheet" href="assets/css/plugins.css" />
        <link rel="stylesheet" href="assets/css/roboto-webfont.css" />

        <!--Theme custom css -->
           <link rel="stylesheet" href="assets/css/style.css">

        <!--Theme Responsive css-->
<link rel="stylesheet" href="assets/css/responsive.css" />

<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Playball' rel='stylesheet' type='text/css'>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
  <script src="assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

</head>

<body>
<?php
	session_start();
	ob_start();
		  if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) {
        $name = "ADMIN";
      }else{
        $name = "USER PANEL";
      }

	?>
        <nav class="navbar navbar-default">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img height=60 width=110 src="assets/images/logo.png" alt="Logo" /></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="index2.php">Home</a></li>
                        <li><a href="index.php#events">EVENTS</a></li>
                        <li><a href="fav.php">FAVOURITES</a></li>
                        <li class="login"><a href="admin/index.php"><?php echo $name?></a></li>
						<li class="login"><a href="admin/pages/login/login.php">Sign In</a></li>
                    </ul>

                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
<div class="main">
		<a name="events"></a><div class="container">
			<div class="heading text-center" id="head">
				<img class="dividerline" src="assets/images/sep.png" alt="">
				<h2>Favourite Events Gallery</h2>
				<img class="dividerline" src="assets/images/sep.png" alt="">
			</div>

        
        

  
</div>						            
    <div class="btn-group" align="right">
        <button type="button" id="sort" data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-lg">Sort<span class="caret"></span></button>
        <ul class="dropdown-menu">
            <li><a href="index.php?sort=ascend">Ascending</a></li>
            <li><a href="index.php?sort=descend">Descending</a></li>
            <li class="divider"></li>
            <li><a href="index.php?sort=Minor">Minor</a></li>
            <li><a href="index.php?sort=Major">Major</a></li>
            <li><a href="index.php?sort=Professional">Professional</a></li>
            <li><a href="index.php?sort=Premium">Premium</a></li>
            
        </ul>
    <div class="containersearch">

			<form action="" autocomplete="on" method="get"> 
			<div class="search">
        	<input type="text" style="width:300px;" name="searchText" class="form-control" name="search" placeholder="Search for..">
			</div>
   
<div class="searchbox">    
 	<input type ="submit" name="searchGo" class="form-control" value="Go!">
				
</div>
</form>
</div>
</div>
<div class="container">
<div class="grid">    
   <?php
include ('admin/connection.php');

if(isset($_GET['id'])){
    
      setcookie("ff".$_SESSION['id'], $_GET['id'], time() + (86400 * 30), "/");
	  header('location:fav.php');    
  }

if(isset($_COOKIE["ff".$_SESSION['id']]) )
{
	$id = $_COOKIE["ff".$_SESSION['id']];
}
if(isset($_GET['sort']))
{
	
	if($_GET['sort'] == 'ascend'){
		$detail="SELECT * FROM event ORDER by title WHERE eventid='$id'";
	}
	elseif($_GET['sort'] == 'descend'){
		$detail="SELECT * FROM event ORDER by title desc WHERE eventid='$id'";
	}
	else
	{
		$a = $_GET['sort'];
		$detail ="SELECT * FROM event WHERE category = '$a' AND eventid='$id'";
	}
}
	else
	{
		$detail="SELECT * FROM event WHERE eventid = '$id'";
	}
	$eventid = 0;

if(isset($_GET['searchText']))
{
	$a = $_GET['searchText'];
	$detail = "SELECT * FROM event WHERE eventid='$id' AND title LIKE '%$a%' OR category LIKE '%$a%' OR description LIKE '%$a%'" ;
		
}


$detailqry = mysqli_query($conn, $detail);

                    	while($row = mysqli_fetch_array($detailqry)){
                        ?>
    	<div class="box h">
    <figure>
									<img src="<?php echo $row['image']; ?>" alt="">
									<figcaption><h3><?php echo $row['title']; ?></h3><p><?php echo $row['description'];?></p>
                                    </figcaption>
								<?php echo "<a href='?id=122345'>";
								?>

                                     	<input type ="submit" name="favGo" class="form-control" value="Delete"></a>
                                </figure>
						
    </div>
    <?php } ?>
</div>
</div>

</body>
</html>