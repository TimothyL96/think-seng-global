<?php
	session_start();
	require("header.php");
	if (isset($_POST['sbtndel']) && !empty($_POST['select']) || isset($_POST['btndel']))
	{
		if (isset($_POST['sbtndel']) && !empty($_POST['select']))
			$_SESSION['select'] = mysqli_real_escape_string($conn, $_POST['select']);
		if (isset($_POST['btndel']))
		{
			if (!empty($_POST['sidf']))
				$_SESSION['eid'] = mysqli_real_escape_string($conn, $_POST['sidf']);
			if (!empty($_POST['cidf']))
				$_SESSION['eid'] = mysqli_real_escape_string($conn, $_POST['cidf']);
			if (!empty($_POST['pidf']))
				$_SESSION['eid'] = mysqli_real_escape_string($conn, $_POST['pidf']);
			if (empty($_POST['sidf']) && empty($_POST['cidf']) && empty($_POST['pidf']))
				unset($_SESSION['eid']);
		}
		updatedata();
	}
	if (isset($_POST['ubtndel']) && (!empty($_POST['sidf']) || !empty($_POST['pidf']) || !empty($_POST['cidf']) || !empty($_SESSION['eid'])))
	{
		$query = '';
		if ($_SESSION['select'] == "student")
		{
			$eid = explode('-', $_SESSION['eid']);
			$query = 'DELETE FROM ' . $_SESSION['select'] . ' WHERE STU_ID = "' . $eid[0] . '"';
		}
		if ($_SESSION['select'] == "club")
		{
			$eid = explode('-', $_SESSION['eid']);
			$query = 'UPDATE ' . $_SESSION['select'] . ' SET CLUB_ID = "' . $cid . '", CLUB_Name = "' . $query = 'DELETE FROM ' . $_SESSION['select'] . ' WHERE CLUB_ID = "' . $eid[0] . '"';
		}
		if ($_SESSION['select'] == "participate")
		{
			$eid = explode('-', $_SESSION['eid']);
			$query = 'DELETE FROM ' . $_SESSION['select'] . ' WHERE STU_ID = "' . $eid[0] . '" && CLUB_ID = "' . $eid[3] . '"';
		}
		$connquery = mysqli_query($conn, $query);
		if(!$connquery)
			die("Query failed : " . htmlspecialchars(mysqli_error($conn)));
		else
			$_SESSION['delsuccess'] = 'success';
		updatedata();
	}
?>
	<h1 id="list">Choose a list to delete</h1>
	<form action="" method="post">
		<select name="select"/>
			<option selected="selected"></option>
			<option value="student">Student</option>
			<option value="club">Club</option>
			<option value="participate">Participate</option>
		</select>
		<input type="submit" id="submitbtn" value="Press Me!" name="sbtndel">
		<input type="submit" value="Go back" name="back"/>
		<?php
			if (isset($_POST['back']))
			{
				header('Location: ../index.php');
				exit;
			}
			echo (empty($_POST['select']) && isset($_POST['sbtndel']))?'<p id="error"</br>Please choose from the drop down menu!</p>':'';	
		?>
	</form>
	
	<?php
		if ((isset($_POST['sbtndel']) && !empty($_POST['select'])) || isset($_POST['btndel']) || isset($_POST['ubtndel']))
		{
	?>
			<form action="" method="post">
			</br>
			<?php
				if ($_POST['select'] == "student" || $_SESSION['select'] == "student")
				{
			?>
					<label for="sid">Student ID: </label>
						<select name="sidf">
							<option selected="selected"></option>
							<?php
								foreach($_SESSION['datas'] as $data)
								{
									echo '<option value="' . $data['STU_ID'] . '-' . $data['STU_FName'] . '-' . $data['STU_LName'] . '">' . $data['STU_ID'] . ' - ' . $data['STU_FName'] . ' ' .$data['STU_LName'] . '</option>';
								}
							?>
						</select>
				<?php
					}else if ($_POST['select'] == "club" || $_SESSION['select'] == "club")
					{
				?>
					<label for="cid">Club ID: </label>
						<select name="cidf">
							<option selected="selected"></option>
							<?php
								foreach($_SESSION['datac'] as $data)
								{
									echo '<option value="' . $data['CLUB_ID'] . '-' . $data['CLUB_Name'] . '">' . $data['CLUB_ID'] . ' - ' . $data['CLUB_Name'] . '</option>';
								}
							?>
						</select>
				<?php
					}else if ($_POST['select'] == "participate" || $_SESSION['select'] == "participate")
					{
				?>		
					<label for="pid">Participation ID:</br>(Student ID - Club ID) </label></br></br>
						<select name="pidf">
							<option selected="selected"></option>
							<?php
								foreach($_SESSION['datap'] as $data)
								{
									echo '<option value="' . $data['STU_ID'] . '-' . $data['STU_FName'] . '-' . $data['STU_LName'] . '-' . $data['CLUB_ID'] . '-' . $data['CLUB_Name'] . '">Student ID: ' . $data['STU_ID'] . ' - Student Name: ' . $data['STU_FName'] . ' ' .$data['STU_LName'] . ' - Club ID: ' .$data['CLUB_ID'] . ' - Club Name: ' . $data['CLUB_Name'] . '</option>';
								}
							?>
						</select>
				<?php
					}
		}
		if ((isset($_POST['sbtndel']) && !empty($_POST['select'])) || isset($_POST['btndel']) || isset($_POST['ubtndel']))
		{
			?>
			</br>
		<?php
			if (isset($_POST['btndel']) && empty($_POST['sidf']) && empty($_POST['pidf']) && empty($_POST['cidf']))
			{
				echo '</br>Please select an ID!</br>';
			}
		?>
			</br>
			<input type="submit" class="submitbtn" value="Remove" name="btndel"/>
	<?php
		}
	?>
			</form>
			
		<?php
			if ((isset($_POST['btndel']) || isset($_POST['ubtndel'])) && (!empty($_POST['sidf']) || !empty($_POST['cidf']) || !empty($_POST['pidf']) || !empty($_SESSION['eid'])))
			{
		?>
				<form action="" method="post">
					</br>
					<?php
						if ($_SESSION['delsuccess'] == "success")
						{
							echo '<b>Success!</b></br>';
							$_SESSION['delsuccess'] = "fail";
						}
						if ($_SESSION['select'] == "participate" && !isset($_POST['ubtndel']))
						{
							$eid = explode('-', $_SESSION['eid']);
							echo 'Are you sure you want to remove :</br></br>Student ID: ' . $eid[0] . ' - Name: ' . $eid[1] . ' ' . $eid[2] . ' </br>Club ID: ' . $eid[3] . ' - Name: ' . $eid[4] . '?</br>';
						}
						if ($_SESSION['select'] == "student" && !isset($_POST['ubtndel']))
						{
							$eid = explode('-', $_SESSION['eid']);
							echo 'Are you sure you want to remove :</br></br>Student ID: ' . $eid[0] . ' - Name: ' . $eid[1] . ' ' . $eid[2] . '?</br>';
						}
						if ($_SESSION['select'] == "club" && !isset($_POST['ubtndel']))
						{
							$eid = explode('-', $_SESSION['eid']);
							echo 'Are you sure you want to remove :</br></br>Club ID: ' . $eid[0] . ' - Name: ' . $eid[1] . '?</br>';
						}
					?>
					</br>
					<input type="submit" class="submitbtn" value="Comfirm" name="ubtndel"/>
				</form>
		<?php
			}
		?>
<?php			
	function updatedata()
	{
		if ($_SESSION['select'] == "student")
		{
			$query = 'SELECT STU_ID, STU_FName, STU_LName FROM student';
			$connquery = mysqli_query($GLOBALS['conn'], $query);

			if(!$connquery)
				die("Query failed : " . htmlspecialchars(mysqli_error($GLOBALS['conn'])));
				
			while ($data = mysqli_fetch_assoc($connquery))
			{
				$datas[] = $data;
			}
			$_SESSION['datas'] = $datas;
		}
		if ($_SESSION['select'] == "club")
		{
			$query = 'SELECT CLUB_ID, CLUB_Name FROM club';
			$connquery = mysqli_query($GLOBALS['conn'], $query);

			if(!$connquery)
				die("Query failed : " . htmlspecialchars(mysqli_error($GLOBALS['conn'])));
				
			while ($data = mysqli_fetch_assoc($connquery))
			{
				$datac[] = $data;
			}
			$_SESSION['datac'] = $datac;
		}
		if ($_SESSION['select'] == "participate")
		{
			$query = 'SELECT participate.STU_ID, student.STU_FName, student.STU_LName, club.CLUB_ID,  club.CLUB_Name FROM participate JOIN student ON participate.STU_ID = student.STU_ID JOIN club ON participate.CLUB_ID = club.CLUB_ID';
			$connquery = mysqli_query($GLOBALS['conn'], $query);
			if(!$connquery)
				die("Query failed : " . htmlspecialchars(mysqli_error($GLOBALS['conn'])));
				
			while ($data = mysqli_fetch_assoc($connquery))
			{
				$datap[] = $data;
			}
			$_SESSION['datap'] = $datap;
			echo '<pre>';
		//	print_r($datap);
			echo '</pre>';
			
		}
	}
	require("footer.php");
?>