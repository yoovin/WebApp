<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Grade Store</title>
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2017/labs/labResources/gradestore.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		
		<?php
		# Ex 4 : 
		# Check the existance of each parameter using the PHP function 'isset'.
		# Check the blankness of an element in $_POST by comparing it to the empty string.
		# (can also use the element itself as a Boolean test!)
		# if (){
			function check_param_exist(){
				$param_exist = 
					isset($_POST["name"]) && isset($_POST["id"]) &&
					(isset($_POST["cse326"]) || isset($_POST["cse107"]) || isset($_POST["cse603"]) || isset($_POST["cin870"])) &&
					isset($_POST["grade"]) && isset($_POST["cc_num"]) && isset($_POST["cc_type"]);

				if($param_exist){
					if((
						strcmp("", $_POST["name"]) != 0 &&
						strcmp("", $_POST["id"]) != 0 &&
						strcmp("", processCheckbox(array("cse326", "cse107", "cse603", "cin870"))) != 0  &&
						isset($_POST["grade"]) &&
						strcmp("", $_POST["cc_num"]) != 0 &&
						isset($_POST["cc_type"])
					))return true;
				}
				return false;
			}
			
			if(!check_param_exist()){
		?>

		<!-- Ex 4 : 
			Display the below error message : 
			<h1>Sorry</h1>
			<p>You didn't fill out the form completely. Try again?</p>
		--> 
			
			<h1>Sorry</h1>
			<p>You didn't fill out the form completely. Try again?</p>

		<?php
		# Ex 5 : 
		# Check if the name is composed of alphabets, dash(-), ora single white space.
		# } elseif () { 
			} elseif (! preg_match("/^[a-zA-Z](\-?[a-zA-Z]+)*( [a-zA-Z](\-?[a-zA-Z]+)*)?$/", $_POST["name"])) { 
		?>

		<!-- Ex 5 : 
			Display the below error message : 
			<h1>Sorry</h1>
			<p>You didn't provide a valid name. Try again?</p>
		--> 
			<h1>Sorry</h1>
			<p>You didn't provide a valid name. Try again?</p>

		<?php
		# Ex 5 : 
		# Check if the credit card number is composed of exactly 16 digits.
		# Check if the Visa card starts with 4 and MasterCard starts with 5. 
		# } elseif () {
			} elseif (! preg_match( 
				(strcmp("visa" ,$_POST["cc_type"])) == 0 ? "/^4\d{15}$/" : "/^5\d{15}$/"
				, $_POST["cc_num"])) {
		?>

		<!-- Ex 5 : 
			Display the below error message : 
			<h1>Sorry</h1>
			<p>You didn't provide a valid credit card number. Try again?</p>
		--> 
			<h1>Sorry</h1>
			<p>You didn't provide a valid credit card number. Try again?</p>

		<?php
		# if all the validation and check are passed 
		# } else {
			} else {
		?>

		<h1>Thanks, looser!</h1>
		<p>Your information has been recorded.</p>
		
		<!-- Ex 2: display submitted data -->
		<ul> 
			<li>Name: <?= $_POST["name"] ?></li>
			<li>ID: <?= $_POST["id"] ?></li>
			<!-- use the 'processCheckbox' function to display selected courses -->
			<li>Course: <?= processCheckbox(array("cse326", "cse107", "cse603", "cin870")) ?></li>
			<li>Grade: <?= $_POST["grade"] ?></li>
			<li>Credit Card: <?= $_POST["cc_num"] ?> <?= "(".$_POST["cc_type"].")"?></li>
		</ul>
		
		<!-- Ex 3 : 
			<p>Here are all the loosers who have submitted here:</p> -->
		<?php
			$filename = "loosers.txt";
			/* Ex 3: 
			 * Save the submitted data to the file 'loosers.txt' in the format of : "name;id;cardnumber;cardtype".
			 * For example, "Scott Lee;20110115238;4300523877775238;visa"
			 */
			$new_line = 
				$_POST["name"].";".
				$_POST["id"].";".
				$_POST["cc_num"].";".
				$_POST["cc_type"].PHP_EOL;

			file_put_contents($filename, $new_line, FILE_APPEND);
		?>
		
		<!-- Ex 3: Show the complete contents of "loosers.txt".
			 Place the file contents into an HTML <pre> element to preserve whitespace -->
		<p>Here are all the loosers who have submitted here:</p>
		<pre><?= file_get_contents($filename); ?></pre>

		<?php } ?>
		<?php
			/* Ex 2: 
			 * Assume that the argument to this function is array of names for the checkboxes ("cse326", "cse107", "cse603", "cin870")
			 * 
			 * The function checks whether the checkbox is selected or not and 
			 * collects all the selected checkboxes into a single string with comma seperation.
			 * For example, "cse326, cse603, cin870"
			 */
			function processCheckbox($names){
				$selectedCheckbox = "";

				foreach($names as $name){
					if(isset($_POST[$name])){
						if(strlen($selectedCheckbox) != 0)
							$selectedCheckbox .= ", ";

						$selectedCheckbox .= strtoupper($name);
					}		
				}
				return $selectedCheckbox;
			}
		?>
		
	</body>
</html>
