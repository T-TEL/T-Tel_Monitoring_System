<?php include_once('../secure/talk2db.php');include_once('../secure/functions.php');

global $couchUrl;
$members = new couchClient($couchUrl, "systems");
// Get members
/*
for($cnt=0;$cnt<sizeof($config->levels);$cnt++){
		$start_key = array($facilityId,$config->levels[$cnt],"A");
		$end_key = array($facilityId,$config->levels[$cnt],"Z");
		$viewResults = $members->include_docs(TRUE)->startkey($start_key)->endkey($end_key)->getView('api', 'facilityLevelActive_allStudent_sorted');
		$docCounter=1;
		echo '<a name="'.$config->levels[$cnt].'"></a>
			<b>'.$config->levels[$cnt].'</b>
			<table class="data">
				<tr class="data">
						<th class="data" width="29">No</th>
						<th width="201" class="data">Name</th>
						<th width="50" class="data">Code</th>
						<th width="65" class="data">Gender</th>
						<th class="data" width="89">Class / Level</th>
			  </tr>';
		foreach($viewResults->rows as $row) {
			 if($docCounter%2==0)
			 {
					echo '<tr class="data">
					<td class="data" width="29">'.$docCounter.'</td>
					<td class="data">'.$row->doc->lastName.' '.$row->doc->middleNames.' '.$row->doc->firstName.'</td>
					<td class="data">'.$row->doc->pass.'</td>
					<td class="data">'.$row->doc->gender.'</td>
					<td class="data" width="89"><center>'.$config->levels[$cnt].'</center></td>
				</tr>';
			 } else {
					echo '<tr class="data" bgcolor="#EEEEEE">
					<td class="data" width="29">'.$docCounter.'</td>
					<td class="data">'.$row->doc->lastName.' '.$row->doc->middleNames.' '.$row->doc->firstName.'</td>
					<td class="data">'.$row->doc->pass.'</td>
					<td class="data">'.$row->doc->gender.'</td>
					<td class="data" width="89"><center>'.$config->levels[$cnt].'</center></td>
				</tr>';
			 }
			 $docCounter++;
		}
		echo '';
}
*/

?>