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
   
    <!-- Custom Fonts -->
    <link href="../css/dateCal.css" rel="stylesheet" type="text/css">

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
    <?php
	$message ="";
	if(isset($_POST['INST_ID'])){
		if($_POST['password']=="datamaster"){
		mysql_query("INSERT INTO `institution_info` (`COL_NUM`, `INST_ID`, `INST_NAME`, `INST_REGION`, `INST_DISTRICT`, `INST_PHYS_ADDRESS`, `INST_POST_ADDRESS`, `INST_DATE_EXTABLISHED`, `INST_PHONE_NO`, `INST_LONGITUDE`, `INST_LATITUDE`, `INST_TUNNEL`, `LAST_UPDATE`) VALUES (NULL, '".$_POST['INST_ID']."', 
		'".$_POST['INST_NAME']."', '".$_POST['INST_REGION']."', '".$_POST['INST_REGION']."', '".$_POST['INST_PHYS_ADDRESS']."', '".$_POST['INST_POST_ADDRESS']."', '".$_POST['INST_DATE_EXTABLISHED']."', '".$_POST['INST_PHONE_NO']."' , '".$_POST['INST_LONGITUDE']."', '".$_POST['INST_LATITUDE']."', '".$_POST['INST_TUNNEL']."', CURRENT_TIMESTAMP)") or die(mysql_error());
		$message ='<br><br><div class="alert alert-success">
	  <strong>Success!</strong>Added - '.$_POST['INST_PHONE_NO'].$_POST['INST_NAME'].' ('.$_POST['INST_ID'].')'.'['.$_POST['INST_TUNNEL'].'] </div>';
		}else{
			$message ='<br><br><div class="alert alert-danger">
	  <strong>Sorry!</strong> - Password Invalid, Check and try again </div>';
		}
	}else{
		
	}
    ?>

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
                <?php echo $message;?>
                    <h1 class="page-header">New Institution</h1>
                </div>
                
            </div>
            <!-- /.row -->
            
            <!-- /.row --><!-- /.row --><!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                  <div class="panel panel-default">
                      <div class="panel-heading"> Enter Information Below </div>
                      <!-- /.panel-heading -->
                      <div class="panel-body">
                  <form method="post" enctype="multipart/form-data" role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Name of Institution" name="INST_NAME" type="text">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Region" name="INST_REGION" type="text" >
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="District" name="INST_DISTRICT" type="text" >
                                </div>
                                
                                <div class="form-group">
                                    <input class="form-control" placeholder="Address - Location" name="INST_PHYS_ADDRESS" type="text" >
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Postal Address" name="INST_POST_ADDRESS" type="text" >
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Phone Number" name="INST_PHONE_NO" type="text">
                                </div>
                                
                                <div class="form-group" id="sandbox-container">
                                  <input class="form-control" placeholder="Date of Extablishment" name="INST_DATE_EXTABLISHED" id="datepicker" type="text" >
                                </div>
                                <div class="form-group" id="sandbox-container">
                                    <div class="input-group">
                                    <span class="input-group-addon">LONGITUDE</span>
                                    <input class="input-sm form-control" name="INST_LONGITUDE" type="text">
                                    <span class="input-group-addon">LATITUDE</span>
                                    <input class="input-sm form-control" name="INST_LATITUDE" type="text">
                                    </div>
                                  
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Institution System ID" name="INST_ID" type="text" >
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Tunnel Port Number" name="INST_TUNNEL" type="text" >
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Master Admin Password" name="password" type="password" value="">
                                </div>
                                  <div class="form-group" style="text-align:right;">
                                    <input name="" type="submit" class="btn btn-danger">
                                </div>
                            </fieldset>
                        </form>
                <!-- /.col-lg-12 -->
                       </div>
                      <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
              <!-- /.col-lg-12 -->
            </div>
            <div class="row">
            <div class="col-lg-6">
                  <div class="panel panel-default">
                      <div class="panel-heading"> Enter Information Below </div>
                      <!-- /.panel-heading -->
                      <div class="panel-body">
                      
                       </div>
                      <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
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



   <script src="../js/bootstrap-datetimepicker.js"></script>
   
    <script src="../js/bootstrap-dialog.min.js"></script>
    <!-- M
    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

   <script src="../js/bootstrap-datetimepicker.js"></script>
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
	
	?> 
	 });
 </script>
  
</body>

</html>
