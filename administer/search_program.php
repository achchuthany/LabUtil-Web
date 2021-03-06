<?php
include("config.php");

$html = '';
$html .= '<li class="list-group-item">';
$html .= '<a href="urlString">';
$html .= 'nameString';

$html .= '</a>';
$html .= '</li>';

// Get Search
$search_string = preg_replace("/[^A-Za-z0-9]/", " ", $_POST['query']);
$search_string = mysqli_real_escape_string($con,$search_string);

// Check Length More Than One Character
if (strlen($search_string) >= 1 && $search_string !== ' ') {
	// Build Query
	$query = 'SELECT DISTINCT software,version,date,mac FROM `softwaredata` WHERE `software` LIKE "%'.$search_string.'%"';

	// Do Search
	$result = mysqli_query($con,$query);
	//exit;
	while($results = mysqli_fetch_array($result)) {
		$result_array[] = $results;
	}
//exit;
	// Check If We Have Results
	if (isset($result_array)) {
		foreach ($result_array as $result) {

			// Format Output Strings And Hightlight Matches
			//
			$display_name = preg_replace("/".$search_string."/i", "<b class='highlight'>".$search_string."</b>", $result['software']);
			$display_url = '?soft='.urlencode($result['software']);

			// Insert Name
			$output = str_replace('nameString', $display_name, $html);

			// Insert URL
			$output = str_replace('urlString', $display_url, $output);

			// Output
			echo($output);
		}
	}else{

		// Format No Results Output
		$output = str_replace('urlString', 'javascript:void(0);', $html);
		$output = str_replace('nameString', '<b>No Results Found.</b>', $output);
		$output = str_replace('funcStr', 'Sorry :(', $output);

		// Output
		echo($output);
	}
}

?>