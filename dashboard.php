<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['name'])){
	header('Location: index.php');
	exit();
}

$professor_id = $_SESSION['id'];

$reqq= "SELECT * FROM module WHERE professor_id = '$professor_id'" ;
$ress=mysqli_query($conn,$reqq);

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/css/bootstrap.min.css">
    
    <link rel="shortcut icon" type="image/png" href="CSS/images/icon/favicon.ico">
    <link rel="stylesheet" href="CSS/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/css/font-awesome.min.css">
    <link rel="stylesheet" href="CSS/css/themify-icons.css">
    <link rel="stylesheet" href="CSS/css/metisMenu.css">
    <link rel="stylesheet" href="CSS/css/owl.carousel.min.css">
    <link rel="stylesheet" href="CSS/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="CSS/css/typography.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/css/default-css.css">
    <link rel="stylesheet" href="CSS/css/styles.css">
    <link rel="stylesheet" href="CSS/css/responsive.css">
    <!-- modernizr css -->
	<style>
		.name{
			margin-left: 20px;
			font-size: 16px;
			color: white;
		}
        .module{
            font-weight: normal;
            font-size: 14px;
            color: white;
            width: fit-content;
            padding: 10px;
            background: #343a40;
            border-radius: 3px;
        }

        .module:hover{
            font-weight: normal;
            font-size: 14px;
            color: white;
            width: fit-content;
            padding: 10px;
            background: #000;
            border-radius: 3px;
        }
	</style>
    <script src="CSS/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <div class="page-container">
        <div class="sidebar-menu" >
            <div class="main-menu" >
                <div class="menu-inner" >
                    <nav>
					<p class="name"></i> Mr. <?php echo $_SESSION['name'] ?></p>
                        <ul class="metismenu" id="menu">
                            
                            <li><a href=""><i class="ti-book"></i> <span>Modules</span></a></li>
                            <li><a href=""><i class="ti-user"></i> <span>Profil</span></a></li>
                            <li><a href="logout.php"><i class="ti-new-window"></i> <span>Se déconnecter</span></a></li>
                           
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="main-content">
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="search-box pull-right">
                            <form action="#">
                                <input type="text" name="search" placeholder="Search..." required>
                                <i class="ti-search"></i>
                            </form>
                        </div>
                    </div>
                    
                   
                </div>
            </div>
            <div style="padding:2%">
                <a class="module" href="View/AddModule.php">Ajouter un Module</a>
                <!-- <img onclick="window.location.href='View/AddModule.php'" src="CSS/images/plus.svg" alt="" width="40" > -->
            </div>
            
 
 
<div class="row">

<?php
while ($ligne = mysqli_fetch_array($ress)) {
    echo' <div class="col-md-4" style="margin-bottom:1%;">';
    echo' <div class="card" >';
   
    echo' <div class="card-body">';
    echo '<a href="controllers/deleteModel.php?id='.$ligne[0].'"><i class="ti-trash"></i></a>';
    echo'<a href="View/modulesView.php?idModule='.$ligne[0].'"> <img src="CSS/images/img.png" alt=""  class="card-img-top"></a>';
       
            echo'<h4 class="card-title">'.$ligne[1] .'</h4>';
            echo'<h6 class="card-subtitle"></h6>';
            echo'<div>';
            echo'<a href="View/modulesView.php?idModule='.$ligne[0].'"><button type="button" class="btn btn-dark">Ouvrir</button></a>';
            echo'</div>';
            echo'</div>';
            echo'</div>';
            echo'</div>';
}
?>

</div>
      
        <footer>
            <div class="footer-area">
              
            </div>
        </footer>
        <!-- footer area end-->
    </div>


    <script src="CSS/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="CSS/js/popper.min.js"></script>
    <script src="CSS/js/bootstrap.min.js"></script>
    <script src="CSS/js/owl.carousel.min.js"></script>
    <script src="CSS/js/metisMenu.min.js"></script>
    <script src="CSS/js/jquery.slimscroll.min.js"></script>
    <script src="CSS/js/jquery.slicknav.min.js"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="CSS/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="CSS/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="CSS/js/plugins.js"></script>
    <script src="CSS/js/scripts.js"></script>
</body>

</html>