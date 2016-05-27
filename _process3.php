<?php
  function runMyFunction() {

		// check if file exists
		$filename = 'js/mpg.json';
		if ( !file_exists($filename) ) {
			echo 'ERROR:' . $filename . ' not found' . '<BR>';
		}
		else {
				echo '<BR>' . 'OK: ' . $filename . ' exists.' . '<BR>';
				echo '<BR>' . '<a href="_process.html">Back</a>' . '<BR>';
				echo '<BR>' . '##############################' . '<BR>';
				$str_data = file_get_contents("js/mpg.json"); // Get the JSON string
				$data = json_decode($str_data,true, JSON_UNESCAPED_SLASHES);// json_decode expects the JSON data, not a file name

				// Format the date input								
					$date = $_POST['mpg_date'];
					$date = str_replace('-', '/', $date);
					$my_date = date('m/d/Y', strtotime($date));
				// Then create a new data array from the $_POST data and add it to the 'records' key
				$new_data = array(
					"Date"=>	(string) $my_date,
					"Miles"=>	(float)  $_POST['mpg_miles'],
					"Gallons"=>	(float)  $_POST['mpg_gallons'],
					"Cost"=>	(float)  $_POST['mpg_cost'],
					"MPG"=>		(float)  $_POST['mpg_mpg'],
					"Street"=>	(string) $_POST['mpg_street'],
					"City"=>	(string) $_POST["mpg_city"],
					"State"=>	(string) $_POST['mpg_state'],
					"Zip"=>		(int)	 $_POST['mpg_zip'],
					"Time"=>	(string) $_POST['mpg_time']
				);
				$data[] = $new_data;

				// Then re-encode the JSON and write it to the file
				$formattedData = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); // format the data
				$handle = fopen($filename,'w+');// open or create the file: W+ will rewrite all data, more info: http://php.net/manual/en/function.fopen.php
				fwrite($handle,$formattedData);// write the data into the file
				fclose($handle);//close the file
				echo '<BR>' . '##############################' . '<BR>';
				// Display all the data
				echo "<pre>";
					print_r($data);
				echo "</pre>";
				echo '<BR>' . '##############################' . '<BR>';
				echo '<BR>' . '<a href="_process.html">Back</a>' . '<BR>';
		}
  }//end runMyFunction

  if (isset($_GET['hello'])) {
    runMyFunction();
  }

?>
