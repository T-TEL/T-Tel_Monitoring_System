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

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Battery Levels</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    
                  <div class="row">
                    <div class="col-lg-2 col-md-3">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <div class="row">
                              <div class="col-xs-3"> <i class="fa fa-exclamation-triangle fa-5x"></i> </div>
                              <div class="col-xs-9 text-right">
                                <div class="huge">
                                   <?php
									$BatterySystems = 0;
									foreach($inst_id as $schoolID) {
										$getSQLdata =  mysql_query("SELECT * FROM `log_battery` where  INST_ID = '$schoolID' AND CAST(STATUS AS UNSIGNED) > 0 AND  CAST(STATUS AS UNSIGNED) < 11 AND REC_DATE = (Select MAX(REC_DATE) FROM log_battery where INST_ID = '$schoolID')");
										$row = mysql_fetch_assoc($getSQLdata);
										if(intval($row)>0){
										  $BatterySystems++;
										}
									}
									print($BatterySystems);
									?>
                                </div>
                                <div><br> <span style="font-weight: bold">B</span> <= 10</div>
                              </div>
                            </div>
                          </div>
                         </div>
                      </div>
                       <div class="col-lg-2 col-md-3">
                        <div class="panel panel-danger">
                          <div class="panel-heading">
                            <div class="row">
                              <div class="col-xs-3"> <i class="fa fa-database fa-5x"></i> </div>
                              <div class="col-xs-9 text-right">
                                <div class="huge">
                                  <?php
									$BatterySystems = 0;
									foreach($inst_id as $schoolID) {
										$getSQLdata =  mysql_query("SELECT * FROM `log_battery` where  INST_ID = '$schoolID' AND CAST(STATUS AS UNSIGNED) > 10 AND CAST(STATUS AS UNSIGNED) < 21 AND REC_DATE = (Select MAX(REC_DATE) FROM log_battery where INST_ID = '$schoolID')");
										$row = mysql_fetch_assoc($getSQLdata);
										if(intval($row)>0){
										  $BatterySystems++;
										}
									}
									print($BatterySystems);
									?>
                                </div>
                                <div><br> 10 > <span style="font-weight: bold">B</span> <= 25</div>
                              </div>
                            </div>
                          </div>
                          </div>
                      </div>
                   
                      <div class="col-lg-2 col-md-3">
                        <div class="panel panel-warning">
                          <div class="panel-heading">
                            <div class="row">
                              <div class="col-xs-3"> <i class="fa fa-database fa-5x"></i> </div>
                              <div class="col-xs-9 text-right">
                                <div class="huge">
                               <?php
									$BatterySystems = 0;
									foreach($inst_id as $schoolID) {
										$getSQLdata =  mysql_query("SELECT * FROM `log_battery` where  INST_ID = '".$schoolID."' AND CAST(STATUS AS UNSIGNED) > 25 AND CAST(STATUS AS UNSIGNED) < 56 AND REC_DATE = (Select MAX(REC_DATE) FROM log_battery where INST_ID = '".$schoolID."')") or die(mysql_error());
										$row = mysql_fetch_assoc($getSQLdata);
										if(intval($row)>0){
										  $BatterySystems++;
										}
									}
									print($BatterySystems);
									?>

                                </div>
                                <div><br> 25 > <span style="font-weight: bold">B</span> <= 55</div>
                              </div>
                            </div>
                          </div>
                          </div>
                    </div>
                      <div class="col-lg-2 col-md-3">
                        <div class="panel panel-info">
                          <div class="panel-heading">
                            <div class="row">
                              <div class="col-xs-3"> <i class="fa fa-database fa-5x"></i> </div>
                              <div class="col-xs-9 text-right">
                                <div class="huge">
                                <?php
									$BatterySystems = 0;
									foreach($inst_id as $schoolID) {
										$getSQLdata =  mysql_query("SELECT * FROM `log_battery` where  INST_ID = '$schoolID' AND CAST(STATUS AS UNSIGNED) > 55 AND CAST(STATUS AS UNSIGNED) < 71 AND REC_DATE = (Select MAX(REC_DATE) FROM log_battery where INST_ID = '$schoolID')");
										$row = mysql_fetch_assoc($getSQLdata);
										if(intval($row)>0){
										  $BatterySystems++;
										}
									}
									print($BatterySystems);
									?>

                                </div>
                                <div><br> 55 > <span style="font-weight: bold">B</span> <= 70</div>
                            
                              </div>
                            </div>
                          </div>
                         </div>
                    </div>
                    <div class="col-lg-2 col-md-3">
                        <div class="panel panel-success">
                          <div class="panel-heading">
                            <div class="row">
                              <div class="col-xs-3"> <i class="fa fa-database fa-5x"></i> </div>
                              <div class="col-xs-9 text-right">
                                <div class="huge">
                               <?php
									$BatterySystems = 0;
									foreach($inst_id as $schoolID) {
										$getSQLdata =  mysql_query("SELECT * FROM `log_battery` where  INST_ID = '$schoolID' AND CAST(STATUS AS UNSIGNED) > 70 AND CAST(STATUS AS UNSIGNED) < 101 AND REC_DATE = (Select MAX(REC_DATE) FROM log_battery where INST_ID = '$schoolID')");
										$row = mysql_fetch_assoc($getSQLdata);
										if(intval($row)>0){
										  $BatterySystems++;
										}
									}
									print($BatterySystems);
									?>
                                </div>
                                <div><br> 70 > <span style="font-weight: bold">B</span> <= 100</div>
                              </div>
                            </div>
                          </div>
                         </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="panel panel-default">
                        <div class="panel-heading"> Battery Level Log </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                              <thead>
                                <tr>
                                  <th>Institution</th>
                                  <th>Battery Level</th>
                                  <th>Record Date</th>
                                  <th>Record Time</th>
                                  <th> </th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
							  
							  
							$getSQLdata =  mysql_query("SELECT * FROM `log_battery` order by REC_DATE") or die(mysql_error());
							while($rowData = mysql_fetch_array($getSQLdata)){
								$InstInfoSQLdata =  mysql_query("SELECT * FROM `institution_info` where INST_ID= '".$rowData['INST_ID']."'") 
												or die(mysql_error());
								$row = mysql_fetch_assoc($InstInfoSQLdata);
								$date = new DateTime($rowData['REC_DATE']);							  
							  	$dt = $date->format('Y-m-d H:i:s');
								
								if(intval($rowData['STATUS'])>0 && intval($rowData['STATUS'])<=10){
									$peDisp = '<button type="button" class="btn btn-default btn-circle disabled"></i></button>';
									
								}else if(intval($rowData['STATUS'])>10 && intval($rowData['STATUS'])<=25){
									$peDisp = '<button type="button" class="btn btn-danger btn-circle disabled"></i></button>';
									
								}else if(intval($rowData['STATUS'])>25 && intval($rowData['STATUS'])<=55){
									$peDisp = '<button type="button" class="btn btn-warning btn-circle disabled"></i></button>';
									
								}else if(intval($rowData['STATUS'])>55 && intval($rowData['STATUS'])<=70){
									$peDisp = '<button type="button" class="btn btn-info btn-circle disabled"></i></button>';
									
								}else if(intval($rowData['STATUS'])>70 && intval($rowData['STATUS'])<=100){
									$peDisp = '<button type="button" class="btn btn-success btn-circle disabled"></i></button>';
									
								}
								echo ' 
								<tr class="odd gradeA">
                                  <td>'.$row['INST_NAME'].'</td>
                                  <td>'.$rowData['STATUS'].'</td>
                                  <td>'.$date->format('Y-m-d').'</td>
                                  <td>'.$date->format('H:i:s').'</td>
								  <td>'.$peDisp.'</td>
								  </tr>
                               ';
							}
							
                              ?>
                               
                              </tbody>
                            </table>
                          </div>
                        <!-- /.table-responsive --></div>
                        <!-- /.panel-body -->
                      </div>
                      <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                  </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
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

   
    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    
     <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>

</body>

</html>
