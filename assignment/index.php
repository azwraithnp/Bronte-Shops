<!doctype html>
<html><head>
<meta charset="utf-8">
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
include('admin/connection.php');
session_start();
		  if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) {
        $name = "ADMIN";
		$url = "admin/index.php";
      }else{
		  $_SESSION['id'] = 123;
        $name = "USER PANEL";
		$url = "admin/index2.php";
      }

if(isset($_GET['id'])){
    
      setcookie("ff".$_SESSION['id'], $_GET['id'], time() + (86400 * 30), "/");
    
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
                        <li class="active"><a href="index.php">Home</a></li>
                        <li><a href="#events">EVENTS</a></li>
                        <li><a href="fav.php">FAVOURITES</a></li>
                         <li class="login"><a href="<?php echo $url?>"><?php echo $name?></a></li>
						<li class="login"><a href="admin/pages/login/login.php">Sign In</a></li>
                    </ul>

                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        
                <header id="home" class="home">
            <div class="overlay-fluid-block">
                <div class="container text-center">
                    <div class="row">
                        <div class="home-wrapper">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="home-content">

                                    <h1>Become a part of the best eSports platform!</h1>
                                    <p class="description">eSports Now is an esports event management and engagement platform that helps you, fellow gaming enthusiasts with engaging in events and understand eSports better. Our goal is to be the ultimate, all in one destination for our users’ esports event needs.</p>

                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                                            <div class="home-contact">
                                                <form action="" method="get" autocomplete="on">
                                                <div class="input-group">
                                                    <input type="text" name="joinEmail" class="form-control" placeholder="Enter your email address">
                                                    <input type ="submit" name="joinSubmit" class="form-control" value="Join Now!">

                                                </div>
												</form>

                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>			
            </div>
        </header>
<div class="main">
		<a name="events"></a><div class="container">
			<div class="heading text-center" id="head">
				<img class="dividerline" src="assets/images/sep.png" alt="">
				<h2>Events Gallery</h2>
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
if(isset($_GET['sort']))
{
	
	if($_GET['sort'] == 'ascend'){
		$detail="SELECT * FROM event ORDER by title";
	}
	elseif($_GET['sort'] == 'descend'){
		$detail="SELECT * FROM event ORDER by title desc";
	}
	else
	{
		$a = $_GET['sort'];
		$detail ="SELECT * FROM event WHERE category = '$a'";
	}
}
	else
	{
		$detail="SELECT * FROM event";
	}
	$eventid = 0;

if(isset($_GET['searchText']))
{
	$a = $_GET['searchText'];
	$detail = "SELECT * FROM event WHERE title LIKE '%$a%' OR category LIKE '%$a%' OR description LIKE '%$a%'" ;
		
}


$detailqry = mysqli_query($conn, $detail);

                    	while($row = mysqli_fetch_array($detailqry)){
                        ?>
    	<div class="box h">
    <figure>
									<img src="<?php echo $row['image']; ?>" alt="">
									<figcaption><h3><?php echo $row['title']; ?></h3><p><?php echo $row['description'];?></p></figcaption>
                                    <?php echo "<a href='?id=".$row['eventid']."'"?>

                                     	<input type ="submit" name="favGo" class="form-control" value="Add to Favorites!">Add to Favorites!</a>
								</figure>
						
    </div>
    <?php } ?>
</div>
</div>
<div id="container">
				<div class="heading text-center" id="head">
				<img class="dividerline" src="assets/images/sep.png" alt="">
				<h2>Notable Players of 2017</h2>
				<img class="dividerline" src="assets/images/sep.png" alt="">
			</div>
 <div class="photobanner">
    <a href="http://wiki.teamliquid.net/dota2/SumaiL"><img class="first"height="250" width="250" class="circle" src="assets/images/sumail.jpg" alt="Natural" /></a>
    <a href="http://wiki.teamliquid.net/dota2/Arteezy"><img height="250" width="250" class="circle" src="assets/images/rtz.png" alt="Natural" /></a>
    <a href="http://wiki.teamliquid.net/dota2/JerAx"><img height="250" width="250" class="circle" src="assets/images/jerax.jpg" alt="Natural" /></a>
   	<a href="http://wiki.teamliquid.net/dota2/N0tail"><img height="250" width="250" class="circle" src="assets/images/notail.jpg" alt="Natural" /></a>
    <a href="http://wiki.teamliquid.net/dota2/BurNIng"><img height="250" width="250" class="circle" src="assets/images/burning.jpg" alt="Natural" /></a>
    <a href="http://wiki.teamliquid.net/dota2/KuroKy"><img height="250" width="250" class="circle" src="assets/images/kuro.jpg" alt="Natural" /></a>
    <a href="http://wiki.teamliquid.net/dota2/Miracle-"><img height="250" width="250" class="circle" src="assets/images/miracle.png" alt="Natural" /></a>
    <a href="http://wiki.teamliquid.net/dota2/GH"><img height="250" width="250" class="circle" src="assets/images/gh.jpg" alt="Natural" /></a>
    <a href="http://wiki.teamliquid.net/dota2/MATUMBAMAN"><img height="250" width="250" class="circle" src="assets/images/matumba.jpg" alt="Natural" /></a>
    <a href="http://wiki.teamliquid.net/dota2/Sccc"><img height="250" width="250" class="circle" src="assets/images/sccc.png" alt="Natural" /></a>
    <a href="http://wiki.teamliquid.net/dota2/Solo"><img height="250" width="250" class="circle" src="assets/images/solo.png" alt="Natural" /></a>
    <a href="http://wiki.teamliquid.net/dota2/MidOne"><img height="250" width="250" class="circle" src="assets/images/midone.jpg" alt="Natural" /></a>
    <a href="http://wiki.teamliquid.net/dota2/Puppey"><img height="250" width="250" class="circle" src="assets/images/puppey.jpg" alt="Natural" /></a>
    <a href="http://wiki.teamliquid.net/dota2/Resolu"><img height="250" width="250" class="circle" src="assets/images/reso.jpg" alt="Natural" /></a>
    
    </div>
    </div>
<div id="wrapper">
<a name="register"></a>
<div id="register" class="animate form">
			<form action="" autocomplete="on" method="post"> 
					<div class="heading text-center" id="head">
				<img class="dividerline" src="assets/images/sep.png" alt="">
				<h2>Sign Up</h2>
				<img class="dividerline" src="assets/images/sep.png" alt="">
				</div>
        		<p> 
					<label for="fname" data-icon="u">Your first name</label>
					<input id="fname" name="fname" pattern="[a-z][A-Z]" required="required" type="text" placeholder="mysuperfirstname" />
				</p>
				<p> 
					<label for="lname" data-icon="u" > Your last name</label>
					<input id="lname" name="lname" pattern="[a-z][A-Z]" required="required" type="text" placeholder="mysuperlastname"/> 
				</p>
				<p> 
				
					<label for="email" data-icon="e">Your email </label>
			<?php
				if(isset($_GET['joinEmail']))
				{
					$em = $_GET['joinEmail'];
					
					echo "
		            <script type=\"text/javascript\">
        			    window.location = 'index.php?joinEmail=$em#register';
            		</script>
        			";

					echo "<input id='email' name='email' required='required' value='$em' type='email' placeholder='eg. mysupermail@mail.com'/>";
						 
				}
				else
				{
					echo "<input id='email' name='email' required='required' type='email' placeholder='eg. mysupermail@mail.com'/>";
				}
				
				?>
				
				</p>
				<p> 
					<label for="age" data-icon="p">Age Range </label>
					<select name="age" placeholder="select">
						<option value="10-15">10-15</option>
  						<option value="15-20">15-20</option>
  						<option value="20-25">20-25</option>
  						<option value="25-30">25-30</option>
                        <option value="30-35">30-35</option>
                        <option value="35-40">35-40</option>
                        <option value="40+">40+</option>					
                        </select>
				</p>
            	<p> 
					<label for="pass" data-icon="p">Your password </label>
					<input id="pass" name="pass" required="required" type="password" placeholder="eg. X8df!90EO" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"/>
				</p>
				<p> 
					<label for="passcon" data-icon="p">Confirm your password </label>
					<input id="passcon" name="passcon" required="required" type="password" placeholder="eg. X8df!90EO" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"/>
				</p>
			

				
                <p class="signin button"> 
					<input type="submit" name="submit" value="Sign up"/> 
				</p>
                
			</form>
		</div>
</div>		    

</body>
</html>

