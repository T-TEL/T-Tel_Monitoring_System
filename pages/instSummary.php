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
                    <h1 class="page-header">Institution System Summary</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <!-- /.row --><!-- /.row --><!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Collapsible Institutional List
                        </div>
                        <!-- .panel-heading -->
                        <div class="panel-body">
                            <div class="panel-group" id="accordion">
                            <?php
							$counter=1;
							$getInstSQLdata =  mysql_query("SELECT * FROM `institution_info` order by INST_NAME") or die(mysql_error());
							while($instRowData = mysql_fetch_array($getInstSQLdata)){
								//$instRowData['INST_ID']
								//$instRowData['INST_NAME']
								
								echo '<div class="col-lg-6">
								<div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#'.$instRowData['INST_ID'].'"> '.$counter.')  '.$instRowData['INST_NAME'].'</a>
                                        </h4>
                                    </div>
                                    <div id="'.$instRowData['INST_ID'].'" class="panel-collapse collapse">
                                        <div class="panel-body">
										   <div class="panel panel-default">
											 <div class="panel-body">
											<!-- Nav tabs -->
											<ul class="nav nav-tabs">
												<li class="active"><a href="#home_'.$instRowData['INST_ID'].'" data-toggle="tab">Info</a>
												</li>
												<li><a href="#power_'.$instRowData['INST_ID'].'" data-toggle="tab">Power</a>
												</li>
												<li><a href="#battery_'.$instRowData['INST_ID'].'" data-toggle="tab">Battery</a>
												</li>
												<li><a href="#network_'.$instRowData['INST_ID'].'" data-toggle="tab">Network</a>
												</li>
												<li><a href="#internet_'.$instRowData['INST_ID'].'" data-toggle="tab">Internet</a>
												</li>
												<li><a href="#alerts_'.$instRowData['INST_ID'].'" data-toggle="tab">Alerts</a>
												</li>
											</ul>
				
											<!-- Tab panes -->
											<div class="tab-content">
												<div class="tab-pane fade in active" id="home_'.$instRowData['INST_ID'].'">';
												print(table_InstitutionInfo($instRowData['INST_ID']));
												echo '</div>
												<div class="tab-pane fade" id="power_'.$instRowData['INST_ID'].'">';
												  print(table_powerSource($instRowData['INST_ID']));
												echo'</div>
												<div class="tab-pane fade" id="battery_'.$instRowData['INST_ID'].'">';
												  print(table_batteryLevel($instRowData['INST_ID']));
												echo '</div>
												<div class="tab-pane fade" id="network_'.$instRowData['INST_ID'].'">';
												  print(table_network($instRowData['INST_ID']));
												echo '</div>
												<div class="tab-pane fade" id="internet_'.$instRowData['INST_ID'].'">';
												  print(table_internetSource($instRowData['INST_ID']));
												echo '</div>
												<div class="tab-pane fade" id="alerts_'.$instRowData['INST_ID'].'">';
												    print(table_RedAlerts($instRowData['INST_ID']));
												echo '</div>
										  </div>
										  <!-- END Tab panes -->
										</div>
										<!-- /.panel-body -->
									</div>
                                        </div>
                                    </div>
                                </div>
								</div>';
								
								$counter++;
							}
							
                            ?>
                            
                            </div>
                        </div>
                        <!-- .panel-body -->
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

   
    <!-- M
    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
 <script>
    $(document).ready(function() {
        
	<?php
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
	 }
	?> 
	 });
 </script>
  
</body>

</html>
