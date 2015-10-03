<?php include_once('../secure/talk2db.php');include_once('../secure/functions.php');?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>T-Tel</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

 <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">


    <!-- Dialogue Popup CSS -->
    <link href="../css/bootstrap-dialog.min.css" rel="stylesheet">
   
    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">T-Tel System</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                    <?php
						print(getBatteryLevels($inst_id))
                    ?>
                          <li>
                            <a class="text-center" href="#">
                                <strong>See All Battery Levels</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                     <?php
						print(getRedAlerts());
                    ?>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
			<?php include('navigation.php');?>
            
            <!-- /.navbar-static-side -->
        </nav>


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Live Monitoring System</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <!-- /.row --><!-- /.row --><!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                  <div class="panel panel-default">
                      <div class="panel-heading"> Basic Tabs </div>
                      <!-- /.panel-heading -->
                      <div class="panel-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#power" data-toggle="tab">Power</a>
                            </li>
                            <li><a href="#battery" data-toggle="tab">Battery</a>
                            </li>
                            <li><a href="#network" data-toggle="tab">Network</a>
                            </li>
                            <li><a href="#internet" data-toggle="tab">Internet</a>
                            </li>
                            <li><a href="#alerts" data-toggle="tab">Alerts</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                          <div class="tab-pane fade in active" id="power">
                            <h4>Power Tab</h4>
                            <p id="_powerData"></p>
                          </div>
                          <div class="tab-pane fade" id="battery">
                            <h4>Battery Tab</h4>
                            <p  id="_batteryData"></p>
                          </div>
                          <div class="tab-pane fade" id="network">
                            <h4>Network Tab</h4>
                            <p  id="_networkData"></p>
                          </div>
                          <div class="tab-pane fade" id="internet">
                            <h4>Internet Tab</h4>
                            <p id="_internetData"></p>
                          </div>
                          <div class="tab-pane fade" id="alerts">
                            <h4>Alerts Tab</h4>
                            <p  id="_alertData"></p>
                          </div>
                        </div>
                      </div>
                      <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
              <!-- /.col-lg-12 -->
            </div>
            <!-- /.row --><!-- /.row --><!-- /.row --><!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables JavaScript -->
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <script src="../js/bootstrap-dialog.min.js"></script>
    <!-- M
    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    
    <script>
	
	function getPower(){
		$('#_powerData').load("../secure/monitor_scripts.php?powerSource=true",function(){
			///alert('Loaded');
		});
		$('#_batteryData').load("../secure/monitor_scripts.php?batteryLevel=true",function(){
			///alert('Loaded');
		});
		
		$('#_networkData').load("../secure/monitor_scripts.php?network=true",function(){
			///alert('Loaded');
		});
		
		$('#_internetData').load("../secure/monitor_scripts.php?internet=true",function(){
			///alert('Loaded');
		});
		$('#_alertData').load("../secure/monitor_scripts.php?alerts=true",function(){
			///alert('Loaded');
		});
		
	}
	
	getPower();
	setInterval(getPower, 5000)
    </script>
    
    
 <script>
 function callPopup(instID,alertColNum){
	 var alertPageurl = "updateAlert.php?instID="+instID+"&redAlertID="+alertColNum;
	  BootstrapDialog.show({
		   title: 'Red Alert',
            message: $('<div></div>').load(alertPageurl)
       });
 }
    $(document).ready(function() {
        //getPower();
	<?php
	 /*
	 foreach($inst_id as $schoolID) {
		 
	  print("$('#power_".$schoolID."_dataTables').DataTable({
					responsive: true
	   });
	 ");
	 
	  print("$('#battery_".$schoolID."_dataTables').DataTable({
					responsive: true
	   });
	 ");
	 
	  print("$('#network_".$schoolID."_dataTables').DataTable({
					responsive: true
	   });
	 ");
	 
	 print("$('#int_".$schoolID."_dataTables').DataTable({
					responsive: true
	   });
	 ");
	 
	  print("$('#redAlert_".$schoolID."_dataTables').DataTable({
					responsive: true
	   });
	 ");
	 
	 print("$('#instInfo".$schoolID."_dataTables').DataTable({
					responsive: true
	   });
	 ");
	 
	 //
	 }*/
	?> 
	 });
 </script>
  
</body>

</html>
