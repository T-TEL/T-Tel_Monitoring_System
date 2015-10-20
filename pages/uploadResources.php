<?php include_once('../secure/talk2db.php');include_once('../secure/functions.php');?>
<!DOCTYPE html>
<html lang="en" xmlns:ice="http://ns.adobe.com/incontextediting">

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
    <link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
 <?php
/*$getSQLdata =  mysql_query("SELECT STATUS FROM `log_internet_source` GROUP BY STATUS") or die(mysql_error());
$array_internet = array();
while($rowData = mysql_fetch_array($getSQLdata)){
	array_push($array_internet,$rowData['STATUS']);
}
*/


if(isset($_POST['title']))
{
	global $couchUrl;
	global $facilityId;
	$ttel_resources = new couchClient($couchUrl, "ttel_resources");
	$doc = new stdClass();
	$docType = end(explode(".", $_FILES['uploadedfile']['name']));
	$doc->legacy = array(
	"id"=>"",
	"type"=> strtolower($docType)
	);
	$doc->type=$_POST['resType'];
	$doc->kind='Resource';
	$doc->language=$_POST['Language'];
	$doc->description=$_POST['discription'];
	$doc->title=$_POST['title'];
	$doc->author=$_POST['author'];
	$doc->created=date('Y-m-d');
	$responce = $ttel_resources->storeDoc($doc);
	print_r($responce);
	try {
		// add attached to document with specified id from response
		$fileName = $responce->id.'.'.end(explode(".", $_FILES['uploadedfile']['name']));
		$ttel_resources->storeAttachment($ttel_resources->getDoc($responce->id),$_FILES['uploadedfile']['tmp_name'], custom_mime_content_type($_FILES['uploadedfile']['tmp_name']),$fileName);
			
		///$resources->storeAttachment($resources->getDoc($responce->id),$_FILES['uploadedfile']['tmp_name'], mime_content_type($_FILES['uploadedfile']['tmp_name']));
		
	} catch ( Exception $e ) {
		print ("No Resource to uploaded<br>");
	}
	$resDoc = $ttel_resources->getDoc($responce->id);
	$resDoc->legacy->id = $responce->id;
	$ttel_resources->storeDoc($resDoc);
	
///   recordAction($_SESSION['name'],"Uploaded resources... res title : ".$_POST['RTitle']);
	echo '<script type="text/javascript">alert("Successfully Uploaded '.$_POST['title'].'");</script>';
  die("<br><br><br><br>Successfully saved - ".$_POST['title']."");
  
}
?>

<script src="../includes/ice/ice.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
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
                        <h1 class="page-header">Upload Resources</h1>
                    </div>
                  
                  <div class="row">
                    <div class="col-lg-12">
                      <form action="" method="post" enctype="multipart/form-data" name="form1">
                      		<div class="form-group">
                                  <label>Resource Title</label>
                                  <input class="form-control" name="title">
                            </div>
                            <div class="form-group">
                              <label>Resource Type</label>
                              <select class="form-control" name="resType">
                                  <option value="audio lesson">Audio</option>
                                  <option value="video lesson">Video</option>
                                  <option value="readable" selected>Readable</option>
                              </select>
                          </div>
                           <div class="form-group">
                              <label>Language</label>
                             <select class="form-control" name="Language" id="Language">
                              <option value='aa'>Afar</option>
                              <option value='ab'>Abkhazian</option>
                              <option value='af'>Afrikaans</option>
                              <option value='ak'>Akan</option>
                              <option value='sq'>Albanian</option>
                              <option value='am'>Amharic</option>
                              <option value='ar'>Arabic</option>
                              <option value='an'>Aragonese</option>
                              <option value='hy'>Armenian</option>
                              <option value='as'>Assamese</option>
                              <option value='av'>Avaric</option>
                              <option value='ae'>Avestan</option>
                              <option value='ay'>Aymara</option>
                              <option value='az'>Azerbaijani</option>
                              <option value='ba'>Bashkir</option>
                              <option value='bm'>Bambara</option>
                              <option value='eu'>Basque</option>
                              <option value='be'>Belarusian</option>
                              <option value='bn'>Bengali</option>
                              <option value='bh'>Bihari</option>
                              <option value='bi'>Bislama</option>
                              <option value='bo'>Tibetan</option>
                              <option value='bs'>Bosnian</option>
                              <option value='br'>Breton</option>
                              <option value='bg'>Bulgarian</option>
                              <option value='my'>Burmese</option>
                              <option value='ca'>Catalan</option>
                              <option value='ca'>Valencian</option>
                              <option value='cs'>Czech</option>
                              <option value='ch'>Chamorro</option>
                              <option value='ce'>Chechen</option>
                              <option value='zh'>Chinese</option>
                              <option value='cu'>Church Slavic</option>
                              <option value='cu'>Old Slavonic</option>
                              <option value='cu'>Church Slavonic</option>
                              <option value='cu'>Old Bulgarian;</option>
                              <option value='cu'>Old Church Slavonic</option>
                              <option value='cv'>Chuvash</option>
                              <option value='kw'>Cornish</option>
                              <option value='co'>Corsican</option>
                              <option value='cr'>Cree</option>
                              <option value='cy'>Welsh</option>
                              <option value='da'>Danish</option>
                              <option value='de'>German</option>
                              <option value='dv'>Divehi</option>
                              <option value='dv'>Dhivehi</option>
                              <option value='dv'>Maldivian</option>
                              <option value='nl'>Dutch; Flemish</option>
                              <option value='dz'>Dzongkha</option>
                              <option value='en' selected>English</option>
                              <option value='eo'>Esperanto</option>
                              <option value='et'>Estonian</option>
                              <option value='ee'>Ewe</option>
                              <option value='fo'>Faroese</option>
                              <option value='fa'>Persian</option>
                              <option value='fj'>Fijian</option>
                              <option value='fi'>Finnish</option>
                              <option value='fr'>French</option>
                              <option value='fy'>Western Frisian</option>
                              <option value='ff'>Fulah</option>
                              <option value='ka'>Georgian</option>
                              <option value='gd'>Gaelic</option>
                              <option value='gd'>Scottish Gaelic</option>
                              <option value='ga'>Irish</option>
                              <option value='gl'>Galician</option>
                              <option value='gv'>Manx</option>
                              <option value='el'>Greek</option>
                              <option value='gn'>Guarani</option>
                              <option value='gu'>Gujarati</option>
                              <option value='ht'>Haitian</option>
                              <option value='ht'>Haitian Creole</option>
                              <option value='ha'>Hausa</option>
                              <option value='he'>Hebrew</option>
                              <option value='hz'>Herero</option>
                              <option value='hi'>Hindi</option>
                              <option value='ho'>Hiri Motu</option>
                              <option value='hr'>Croatian</option>
                              <option value='hu'>Hungarian</option>
                              <option value='ig'>Igbo</option>
                              <option value='is'>Icelandic</option>
                              <option value='io'>Ido</option>
                              <option value='ii'>Sichuan Yi</option>
                              <option value='iu'>Inuktitut</option>
                              <option value='ie'>Interlingue</option>
                              <option value='ia'>Interlingua</option>
                              <option value='id'>Indonesian</option>
                              <option value='ik'>Inupiaq</option>
                              <option value='it'>Italian</option>
                              <option value='jv'>Javanese</option>
                              <option value='ja'>Japanese</option>
                              <option value='kl'>Kalaallisut</option>
                              <option value='kl'>Greenlandic</option>
                              <option value='kn'>Kannada</option>
                              <option value='ks'>Kashmiri</option>
                              <option value='kr'>Kanuri</option>
                              <option value='kk'>Kazakh</option>
                              <option value='km'>Central Khmer</option>
                              <option value='ki'>Kikuyu</option>
                              <option value='ki'>Gikuyu</option>
                              <option value='rw'>Kinyarwanda</option>
                              <option value='ky'>Kirghiz</option>
                              <option value='ky'>Kyrgyz</option>
                              <option value='kv'>Komi</option>
                              <option value='kg'>Kongo</option>
                              <option value='ko'>Korean</option>
                              <option value='kj'>Kuanyama</option>
                              <option value='kj'>Kwanyama</option>
                              <option value='ku'>Kurdish</option>
                              <option value='lo'>Lao</option>
                              <option value='la'>Latin</option>
                              <option value='lv'>Latvian</option>
                              <option value='li'>Limburgan</option>
                              <option value='li'>Limburger</option>
                              <option value='li'>Limburgish</option>
                              <option value='ln'>Lingala</option>
                              <option value='lt'>Lithuanian</option>
                              <option value='lb'>Luxembourgish</option>
                              <option value='lb'>Letzeburgesch</option>
                              <option value='lu'>Luba-Katanga</option>
                              <option value='lg'>Ganda</option>
                              <option value='mk'>Macedonian</option>
                              <option value='mh'>Marshallese</option>
                              <option value='ml'>Malayalam</option>
                              <option value='mi'>Maori</option>
                              <option value='mr'>Marathi</option>
                              <option value='ms'>Malay</option>
                              <option value='mg'>Malagasy</option>
                              <option value='mt'>Maltese</option>
                              <option value='mo'>Moldavian</option>
                              <option value='mn'>Mongolian</option>
                              <option value='na'>Nauru</option>
                              <option value='nv'>Navajo</option>
                              <option value='nv'>Navaho</option>
                              <option value='nr'>Ndebele South</option>
                              <option value='nr'>South Ndebele</option>
                              <option value='nr'>Ndebele North</option>
                              <option value='nd'>North Ndebele</option>
                              <option value='ng'>Ndonga</option>
                              <option value='ne'>Nepali</option>
                              <option value='nl'>Dutch</option>
                              <option value='nn'>Norwegian Nynorsk</option>
                              <option value='nn'>Nynorsk Norwegian</option>
                              <option value='nb'>Bokmål Norwegian</option>
                              <option value='nb'>Norwegian Bokmål</option>
                              <option value='no'>Norwegian</option>
                              <option value='ny'>Chichewa</option>
                              <option value='ny'>Nyanja</option>
                              <option value='oc'>Occitan </option>
                              <option value='oc'>Provençal</option>
                              <option value='oj'>Ojibwa</option>
                              <option value='or'>Oriya</option>
                              <option value='om'>Oromo</option>
                              <option value='os'>Ossetian</option>
                              <option value='os'>Ossetic</option>
                              <option value='pa'>Panjabi</option>
                              <option value='pa'>Punjabi</option>
                              <option value='pi'>Pali</option>
                              <option value='pl'>Polish</option>
                              <option value='pt'>Portuguese</option>
                              <option value='ps'>Pushto</option>
                              <option value='qu'>Quechua</option>
                              <option value='rm'>Romansh</option>
                              <option value='ro'>Romanian</option>
                              <option value='rn'>Rundi</option>
                              <option value='ru'>Russian</option>
                              <option value='sg'>Sango</option>
                              <option value='sa'>Sanskrit</option>
                              <option value='sr'>Serbian</option>
                              <option value='si'>Sinhala</option>
                              <option value='si'>Sinhalese</option>
                              <option value='sk'>Slovak</option>
                              <option value='sl'>Slovenian</option>
                              <option value='se'>Northern Sami</option>
                              <option value='sm'>Samoan</option>
                              <option value='sn'>Shona</option>
                              <option value='sd'>Sindhi</option>
                              <option value='so'>Somali</option>
                              <option value='st'>Sotho Southern</option>
                              <option value='es'>Spanish</option>
                              <option value='es'>Castilian</option>
                              <option value='sc'>Sardinian</option>
                              <option value='ss'>Swati</option>
                              <option value='su'>Sundanese</option>
                              <option value='sw'>Swahili</option>
                              <option value='sv'>Swedish</option>
                              <option value='ty'>Tahitian</option>
                              <option value='ta'>Tamil</option>
                              <option value='tt'>Tatar</option>
                              <option value='te'>Telugu</option>
                              <option value='tg'>Tajik</option>
                              <option value='tl'>Tagalog</option>
                              <option value='th'>Thai</option>
                              <option value='ti'>Tigrinya</option>
                              <option value='to'>Tonga </option>
                              <option value='to'>Tonga Islands</option>
                              <option value='tn'>Tswana</option>
                              <option value='ts'>Tsonga</option>
                              <option value='tk'>Turkmen</option>
                              <option value='tr'>Turkish</option>
                              <option value='tw'>Twi</option>
                              <option value='ug'>Uighur</option>
                              <option value='ug'>Uyghur</option>
                              <option value='uk'>Ukrainian</option>
                              <option value='ur'>Urdu</option>
                              <option value='uz'>Uzbek</option>
                              <option value='ve'>Venda</option>
                              <option value='vi'>Vietnamese</option>
                              <option value='vo'>Volapük</option>
                              <option value='wa'>Walloon</option>
                              <option value='wo'>Wolof</option>
                              <option value='xh'>Xhosa</option>
                              <option value='yi'>Yiddish</option>
                              <option value='yo'>Yoruba</option>
                              <option value='za'>Zhuang Chuang</option>
                              <option value='zu'>Zulu</option>
                              <option value='AsT'>Asante Twi</option>
                              <option value='AkT'>Akuapem Twi</option>
                              <option value='Ew'>Ewe</option>
                              <option value='Ga'>Ga</option>
                              <option value='Mfts'>Mfantse</option>
                            </select>
                          </div>
                           <div class="form-group">
                                  <label>Author</label>
                                  <input  name="author" class="form-control">
                            </div>
                      		 <div class="form-group">
                                  <label>Description</label>
                                  <textarea class="form-control" rows="3"  name="discription" ></textarea>
                              </div>
                             <div class="form-group">
                                <label>File input</label>
                                <input type="file"  name="uploadedfile">
                            </div>
                            <div class="form-group">
                            <button type="submit" class="btn btn-default">Submit Button</button>
                            <button type="reset" class="btn btn-default">Reset Button</button>
                            <br><br><br>
                            </div>
                      </form>
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
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
     </script>

</body>

</html>
