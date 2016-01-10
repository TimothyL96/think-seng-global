<?php
	require("header.php");

	if (isset($_POST['sbtnview']) && !empty($_POST['select']))
	{
		if ($_POST['select'] == "student" || $_POST['select'] == "participate")
			$orderid = "STU_ID";
		else if ($_POST['select'] == "club")
			$orderid = "CLUB_ID";
		
		$select = mysqli_real_escape_string($conn, $_POST['select']);
		$orderid = mysqli_real_escape_string($conn, $orderid);
	
		if ($select != "participate")
			$query = 'SELECT * FROM ' . $select . ' ORDER BY ' . $orderid;
		else
			$query = 'SELECT participate.*, student.STU_FName, student.STU_LName, club.CLUB_Name FROM ' . $select . ' JOIN student ON participate.STU_ID = student.STU_ID JOIN club ON participate.CLUB_ID = club.CLUB_ID ORDER BY ' . $orderid;
		$connquery = mysqli_query($conn, $query);
	
		if(!$connquery)
			die("Query failed : " . htmlspecialchars(mysqli_error($conn)));
			
		if ($_POST['select'] == 'student')
			{
				echo "<table border=\"2\" id=\"t1\">
							<thead>
								<tr>
									<th>Student ID</th>
									<th>Student First name</th>
									<th>Student Last Name</th>
									<th>Student Gender</th>
									<th>Student Email</th>
									<th>Student Contact</th>
								</tr>
							</thead>
							<tbody>";
			}else if ($_POST['select'] == 'club')
			{
				echo "<table border=\"2\" id=\"t2\">
							<thead>
								<tr>
									<th>Club ID</th>
									<th>Club Name</th>
									<th>Club Type</th>
									<th>Club Member</th>
								</tr>
							</thead>
							<tbody>";
			}else if ($_POST['select'] == 'participate')
			{
				echo "<table border=\"2\" id=\"t3\">
							<thead>
								<tr>
									<th>Student ID</th>
									<th>Student Name</th>
									<th>Club ID</th>
									<th>Club Name</th>
									<th>Join date</th>
								</tr>
							</thead>
							<tbody>";
			}
					
		while($data = mysqli_fetch_assoc($connquery))
		{
			if ($_POST['select'] == 'student')
			{
				echo "	<tr>
							<td>".htmlspecialchars($data['STU_ID'])."</td>
							<td>".htmlspecialchars($data['STU_FName'])."</td>
							<td>".htmlspecialchars($data['STU_LName'])."</td>
							<td>".htmlspecialchars($data['STU_Gender'])."</td>
							<td>".htmlspecialchars($data['STU_Email'])."</td>
							<td>".htmlspecialchars($data['STU_Contact'])."</td>
						</tr>
					
				
				";
			}else if ($_POST['select'] == 'club')
			{
				echo "	<tr>
							<td>".htmlspecialchars($data['CLUB_ID'])."</td>
							<td>".htmlspecialchars($data['CLUB_Name'])."</td>
							<td>".htmlspecialchars($data['CLUB_Type'])."</td>
							<td>".htmlspecialchars($data['CLUB_Member'])."</td>
						</tr>
				";
			}else if ($_POST['select'] == 'participate')
			{
				echo "	<tr>
							<td>".htmlspecialchars($data['STU_ID'])."</td>
							<td>".htmlspecialchars($data['STU_FName']).' '.htmlspecialchars($data['STU_LName'])."</td>
							<td>".htmlspecialchars($data['CLUB_ID'])."</td>
							<td>".htmlspecialchars($data['CLUB_Name'])."</td>
							<td>".htmlspecialchars($data['PAR_DATE'])."</td>
						</tr>
				";
			}
		}
		echo "</tbody>
		</table>
		<form action=\"\" method=\"post\">
		<input type=\"submit\" class=\"submitbtn\" value=\"Go back\" name=\"backtable\"/>
		</form>
		";
	}
	
	if (!isset($_POST['sbtnview']) || empty($_POST['select']))
	{
?>
		<h1 id="list">Choose a list to view</h1>
		<form action="" method="post">
			<select name="select"/>
				<option selected="selected"></option>
				<option value="student">Student</option>
				<option value="club">Club</option>
				<option value="participate">Participate</option>
			</select>
			<input type="submit" class="submitbtn" value="Press Me!" name="sbtnview">
			<input type="submit" class="submitbtn" value="Go back" name="back"/>
			<?php
				if (isset($_POST['back']))
				{
					header('Location: ../index.php');
					exit;
				}
				echo (empty($_POST['select']) && isset($_POST['sbtnview']))?'<p id="error"</br>Please choose from the drop down menu!</p>':'';
			?>

		</form>
<?php					
	}
	if (isset($_POST['backtable']))
	{
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}	
	require("footer.php");
?>