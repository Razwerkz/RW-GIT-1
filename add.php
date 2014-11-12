<html>
	<body>
		<?php
		//var_dump($_POST);
		//die();
		
		$connectionstring = "host=localhost dbname=test user=postgres password=testing";
		$dbconnection = pg_connect($connectionstring);
		
		if (!$dbconnection){
			die("Oh teh noes!  We couldn't connect to the database D:");
		}
		
		if(isset($_POST['firstname']) && isset($_POST['lastname'])) {
			$firstname = pg_escape_string($_POST['firstname']);
			$lastname = pg_escape_string($_POST['lastname']);
			$query = "INSERT INTO users(firstname, lastname) VALUES('" . $firstname . "', '" . $lastname . "')";
			$results = pg_query($query);
		}
		
		elseif(!empty($_POST['userid'])) {
			$query = "SELECT firstname, lastname FROM users WHERE id={$_POST['userid']}";
			$results = pg_query($query);
			$firstrow = pg_fetch_assoc($results);
			$firstname = $firstrow['firstname'];
			$lastname = $firstrow['lastname'];
		}

		else {
			die("Gadzooks!  It seems you forgot to enter or select a name.  Click BACK on your browser and try again.");
		}
		
		if (!$results) {
			$errormessage = pg_last_error();
			echo "Oh teh noes!  You should show this to your network administrator. - " . $errormessage;
			exit();
		}


		printf ("Hello, %s %s!", $firstname, $lastname);
		pg_close();
		
		?>
	</body>
</html>
