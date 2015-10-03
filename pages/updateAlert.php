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
	$alrt_instName = $alrt_instRegion = $alrt_instPhone ="";
	if(isset($_GET['instID'])){
		$getSQLdata =  mysql_query("SELECT * FROM `institution_info` where INST_ID = '".$_GET['instID']."' ") or die(mysql_error());
		while($rowData = mysql_fetch_array($getSQLdata)){
			$alrt_instName = $rowData['INST_NAME'];
			$alrt_instRegion = $rowData['INST_REGION'];
			$alrt_instPhone = $rowData['INST_PHONE_NO'];
		}
		$date = new DateTime();
		$date->modify("-60 minutes");
		$dt = $date->format('Y-m-d H:i:s');
		$getSQLdata =  mysql_query("SELECT * FROM `red_alert` where COL_NUM = '".$_GET['redAlertID']."'") or die(mysql_error());
		 while($rowData = mysql_fetch_array($getSQLdata)){
			$date = new DateTime($rowData['LAST_UPDATED']);							  
			$dt = $date->format('Y-m-d H:i:s');
			$alrt_COL_NUM = $rowData['COL_NUM'];
			$alrt_INST_ID = $rowData['INST_ID'];
			$alrt_ALERT_TYPE = $rowData['ALERT_TYPE'];
			$alrt_COMMENT = $rowData['COMMENT'];
			$alrt_SOLUTION = $rowData['SOLUTION'];
			$alrt_DATE_OF_ALERT = $rowData['DATE_OF_ALERT'];
			$alrt_CURRENT_STATUS = $rowData['CURRENT_STATUS'];	
			$alrt_LAST_UPDATED  = $rowData['LAST_UPDATED'];
			
		  }
	}
	
    ?>

</head>

<body>

    <div id="wrapper" >

        <!-- Navigation -->

        <div id="">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Fill The Form To Update Alert</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row" >
                <div class="col-lg-12" >
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Details
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form">
                                        <div class="form-group">
                                            <label>Institution</label>
                                            <input class="form-control" value="<?php echo $alrt_instName;?>" readonly="readonly">
                                            <p class="help-block"><?php echo $alrt_instRegion.' - Phone : '.$alrt_instPhone ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Type</label>
                                            <input class="form-control" value="<?php echo $alrt_ALERT_TYPE;?>" readonly="readonly">
                                            <p class="help-block"><?php echo $alrt_DATE_OF_ALERT;?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>INFO.</label>
                                            <textarea class="form-control" rows="3"><?php echo $alrt_COMMENT;?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Solution</label>
                                            <textarea class="form-control" rows="3"><?php echo $alrt_SOLUTION;?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="new" checked>New Alert
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="resolving">Resolving Alert
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios3" value="resolved">Resolved Alert
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios4" value="replace">Replacement Needed 
                                                </label>
                                            </div>

                                        </div>
                                      <!--  <div class="form-group">
                                            <label>Selects</label>
                                            <select class="form-control">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>-->
                                         <div class="form-group" style="text-align:right">
                                        <button type="submit" class="btn btn-danger">Submit </button>
                                        <button type="reset" class="btn btn-default">Reset </button>
                                        
                                        </div>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
