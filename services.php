<?php 


/* 
ASSIGNMENT:
Write a web application that randomly generates 3 set of 6 numbers where each number is a value from 1 to 49.   A button is clicked to request the 3 sets for display.  The user is allowed to select 1 set or regenerate 3 new sets.  Once the user selects a set of numbers, that set is stored in a table.
 
On each iteration of generating 3 sets, the application verifies that no set has more than 3 matching values of a previously selected set (not generated, only compared to sets selected and saved in the table).  If a generated set has matching values to a previous set, it is displayed on the screen for the user to see during the selection process.
 
Lastly, the bottom of the web application screen shows a dashboard summarizing information about generated and selected sets.
*/

$services = new Services;
$services->$_GET['f']();



Class Services{

		public function generate_sets(){

			//generate 3 sets of random numbers
			$sets=self::get_random_numbers(5);

			//these are the chosen sets, if any exist
			$sets_to_check = $_POST['check_sets'];

			$check_dupes=[];

			//if we have sets to check for dupes, do it
			if($sets_to_check){

				//convert string to Int array - these are the sets of chosen number tiles 
				foreach((array)$sets_to_check as $checks){
					$check_arr[]= (int)$checks;
				}

				//check set(s) of chosen tiles against array of newly generated sets.
				//this returns an object that we json_encode that contains the set of duplicate numbers
				foreach($sets as $set){
					$check_dupes+= array_intersect($set, $check_arr);
				}
				
			}

			//create object to return vals
			$returns = new stdClass;
			$returns->sets = $sets;
			$returns->check = $check_arr;
			$returns->dupes = $check_dupes;

			//set header and send it all back to the jquery
			header('Content-Type: application/json');
			echo json_encode($returns);
		}


		//generate 3 sets of (int)$qty random numbers and return them
		//@$qty = how many random numbers to return in array
		private function get_random_numbers($qty){

			$final_set_arr=[];

			//make a set of 6 random numbers
			//and do it 3 times
			for ($x = 0; $x <= 2; $x++) {

				for ($i = 0; $i <= $qty; $i++) {
					
				    $numbers_arr[] = mt_rand(1,49);
				}

				$final_set_arr[] = $numbers_arr;
				
				unset($numbers_arr);
			}


				return $final_set_arr;
		}

}
?>