<html>
	<body>
		<form action="add.php" method="post">
			First Name : <input type="text" name="firstname" size="40" length="40" value=""><br>
			Last Name : <input type="text" name="lastname" size="40" length="40" value=""><br>
			<input type="submit" name="submit" value="Confirm">
			<input type="reset" name="reset" value="Clear">
		</form>

		<br><hr><br>

		<form method="post" action="add.php">
			<select name="userid">
				<?php
				$connectionstring = "host=localhost dbname=test user=postgres password=testing";
				$dbconnection = pg_connect($connectionstring);

				$query = "SELECT * FROM users";
				$results = pg_query($query);
				if (!$results) {
					echo "Error: Problem with query " . $query . "<br/>";
					echo pg_last_error();
					exit();
				}

				while($myrow = pg_fetch_assoc($results)) {
					printf("<option value='%s'>%s %s</option>", htmlspecialchars($myrow['id']), htmlspecialchars($myrow['firstname']), htmlspecialchars($myrow['lastname']));
				}
				?>
				<input type="submit" name="submit" value="Confirm">
			</select>
		</form>
	</body>
</html>