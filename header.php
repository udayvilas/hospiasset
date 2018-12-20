<div class="showcase sweet"></div>
<style>
.bs-example
{
    z-index: 999;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 75px;
    background: #614da4;
}
.bname
{
	margin-top:14px;
	font-size:11px;
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>

 <?php
 include_once('header-files.php');
error_reporting(0);
 include('config.php');
 if(!isset($_SESSION['pw_empid']))
 {
	header('Location: index.php');	
 }
  $unit_id = $_SESSION['unitid']; 
  $uname =  $_SESSION['uname'];

?>
</head> 
<body>
<div class="bs-example">
	<div class="container">
    <nav role="navigation" class="navbar navbar-default" style="box-shadow:none">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">	
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>          
			<img src="images/pathway_logo_final.png" alt="logo" style="margin-top: 3px;">         
        </div>
	
        <!-- Collection of nav links, forms, and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse text-center">
            <ul class="nav navbar-nav navbar-right">
               <li>
					<label class="bname">Welcome <label style="font-size:14px;"><?php echo $uname;?></label> <label style="font-size:12px;"><?php echo $_SESSION['UNITNAME'];?></label>	
					<p style="font-size:12px;margin-top:-4px"> <?php //echo $_SERVER['REMOTE_ADDR'];?> </p>	
				    </label>
				</li>
						
				<li>
					<a href="#"><img src="images/about_icons_color.png" style="padding:4px" class="img responsive img-circle center-block mega-link" title="About" onmouseover="this.src ='images/about_icons_white.png'" onmouseout="this.src ='images/about_icons_color.png'"></a>
					<div class="site_name">About</div>
				</li>
				<li>
					<a href="#"><img src="images/help_icon_color.png" style="padding:4px" class="img responsive img-circle center-block mega-link" title="Help" onmouseover="this.src ='images/help_icon_white.png'" onmouseout="this.src ='images/help_icon_color.png'"></a>
					<div class="site_name">Help</div>
				</li>
				
				<li class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#"><img src="images/reports_icon_color.png" style="padding:2px" class="img responsive img-circle center-block mega-link" title="Reports" onmouseover="this.src ='images/reports_icon_white.png'" onmouseout="this.src ='images/reports_icon_color.png'"></a>
						<div class="dropbtn site_name">Reports</div>
						<ul role="menu" class="dropdown-menu">
							 <li><a href="Registrations.php"><img src="images/reports_icon_white.png" title="Registrations" alt="scanner"> Registrations</a></li>
							 <li><a href="#"><img src="images/reports_icon_white.png" title="Visits" alt="scanner"> Visits</a></li>
							<li><a><img src="images/reports_icon_white.png" title="Reports3" alt="scanner">Reports3</a></li>
						</ul>
				</li>
				<li class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#"><img src="images/setup_icon_color.png" style="padding:2px" class="img responsive img-circle center-block mega-link" title="Setup" onmouseover="this.src ='images/setup_icon_white.png'" onmouseout="this.src ='images/setup_icon_color.png'"></a>
					<div class="dropbtn site_name">Setup</div>
						<ul role="menu" class="dropdown-menu">
								<li><a href="manage_users.php" title="Users"><img src="images/user_icon_1.png" alt="Users"> Users</a></li>
								<li><a href="changepwd.php" title="Change Password"><img src="images/changepassword_icons.png" alt="Change Password"> Change Password </a></li>
								<li><a href="manage_pathway.php" title="Pathways"><img src="images/pathway_icon.png" alt="Users"> Pathways </a></li>
								<li><a href="#" title="Pathways"><img src="images/pathway_icon.png" alt="Users"> Pathways Compliance Target </a></li>
								<li><a href="#" title="Parameters"><img src="images/parameter_icon2.png" alt="Users"> Parameters </a></li>
						</ul>
				</li>
				
				<li>
					<a href="javascript:void(0)" onclick="logout()"><img src="images/logout_icon_color.png" style="padding:4px" class="img responsive img-circle center-block mega-link" title="Logout" onmouseover="this.src ='images/logout_icon_white.png'" onmouseout="this.src ='images/logout_icon_color.png'"></a>
					<div class="site_name">Logout</div>
				</li>
					<li>
					<a href="home.php"><img src="images/home_icon.png" style="padding:2px" class="img responsive img-circle center-block mega-link" title="Home" onmouseover="this.src ='images/home_icon_white.png'" onmouseout="this.src ='images/home_icon.png'" data-toggle="tooltip" data-placement="bottom" data-original-title="Home" data-action="nav-left-medium"></a>
					<div class="site_name">Home</div>
				</li>	
			
	
				
            </ul>
        </div>
    </nav>
	</div>
</div>
</body>
</html>                                		