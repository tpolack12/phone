<?php 
require('common/servers.php');
require('common/functions.php');
require('common/config.php');
require('common/cdn.php');
?>

<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PHONE</title>

    <!-- Bootstrap Core CSS -->
    <link href="./scripts/bootstrap.min.css" rel="stylesheet">

    <?php echo $jquery; ?>
    <script type="text/javascript" src="./scripts/jquery.js"></script>
    <script type="text/javascript" src="./widgets.js"></script>
    <script type="text/javascript" src="./menu.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script> 
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>

    <!-- Custom CSS -->
    <link href="./scripts/logo-nav.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	<script>
		$(document).ready(function(){
		//Default Loads	
		$(".display").html(dirSearch);			

                  $(".navbar-nav li a").on("click", function(){
                  	if($(this).text() == "Home") {
				$(".display").html(dirSearch);
				$(".menu").html("");
  			}
			else if($(this).text() == "Stations") {
				dispChart(display)
				$(".menu").html(stations);
			}
			else
			{
				$(".display").html("<marquee>"+$(this).text()+"</marquee>");
				$(".menu").html("");
			}     
                  	});
		
		  $('.nav a').on('click', function(){
    			$('.navbar-toggle').click() //bootstrap 3.x by Richard
		  });
		
		  $('[data-toggle=offcanvas]').click(function() {
                        $('.row-offcanvas').toggleClass('active');
                  });
		});
	</script>
</head>

<body>
<div class="page-container">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="http://www.qologydirect.com">
                    <img src="http://www.qologydirect.com/site/themes/SCRN/images/main-logo.png" alt="">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1" aria-expanded="false" style="height: 10px;">
                <ul class="nav navbar-nav">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Stations</a></li>
                    <li><a href="#">Administration</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav>

<div class="container content">
  <div class="row row-offcanvas row-offcanvas-left">
    <div class="col-md-3 menu col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
	
    </div>

    <div id="display" class="col-md-8 display">
    </div>

</div> <!---container --->
</div> <!----page---->
    <!-- jQuery -->
    <script src="./scripts/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="./scripts/bootstrap.min.js"></script>

</body></html>
