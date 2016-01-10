<?php
	session_start();
	require("header.php");
	if (isset($_POST['sbtnedit']) && !empty($_POST['select']) || isset($_POST['btnedit']))
	{
		if (isset($_POST['sbtnedit']) && !empty($_POST['select']))
			$_SESSION['select'] = mysqli_real_escape_string($conn, $_POST['select']);
		if (isset($_POST['btnedit']))
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
	if (isset($_POST['ubtnedit']) && (!empty($_POST['sidf']) || !empty($_POST['pidf']) || !empty($_POST['cidf']) || !empty($_SESSION['eid'])) && (checks() || checkc() || checkp()))
	{
		if (checkprim())
		{
			$query = '';
			if ($_SESSION['select'] == "student")
			{
				$sid = $_POST['sid'];
				$sfname = $_POST['sfname'];
				$slname = $_POST['slname'];
				$sgen = $_POST['sgen'];
				$smail = $_POST['smail'];
				$scont = $_POST['scont'];
				$query = 'UPDATE ' . $_SESSION['select'] . ' SET STU_ID = "' . $sid . '", STU_FName = "' . $sfname . '", STU_LName = "' . $slname . '", STU_Gender = "' . $sgen . '", STU_Email = "' . $smail . '", STU_Contact = "' . $scont . '" WHERE STU_ID = "' . $_SESSION['eid'] . '"';
			}
			if ($_SESSION['select'] == "club")
			{
				$cid = $_POST['cid'];
				$cname = $_POST['cname'];
				$ctype = $_POST['ctype'];
				$cmember = $_POST['cmember'];
				$query = 'UPDATE ' . $_SESSION['select'] . ' SET CLUB_ID = "' . $cid . '", CLUB_Name = "' . $cname . '", CLUB_Type = "' . $ctype . '", CLUB_Member = "' . $cmember . '" WHERE CLUB_ID = "' . $_SESSION['eid'] . '"';
			}
			if ($_SESSION['select'] == "participate")
			{
				$spid = $_POST['spid'];
				$cpid = $_POST['cpid'];
				$partdate = $_POST['partdate'];
				$eid = explode('-', $_SESSION['eid']);
				$query = 'UPDATE ' . $_SESSION['select'] . ' SET STU_ID = "' . $spid . '", CLUB_ID = "' . $cpid . '", PAR_DATE = "' . $partdate . '" WHERE STU_ID = "' . $eid[0] . '" && CLUB_ID ="' . $eid[1] . '"';
			}
			echo $query;
			$connquery = mysqli_query($conn, $query);
			if(!$connquery)
				die("Query failed : " . htmlspecialchars(mysqli_error($conn)));
			else
				$_SESSION['editsuccess'] = 'success';
		}
		updatedata();
	}
?>
	<h1 id="list">Choose a list to edit</h1>
	<form action="" method="post">
		<select name="select"/>
			<option selected="selected"></option>
			<option value="student">Student</option>
			<option value="club">Club</option>
			<option value="participate">Participate</option>
		</select>
		<input type="submit" id="submitbtn" value="Press Me!" name="sbtnedit">
		<input type="submit" value="Go back" name="back"/>
			<?php
				if (isset($_POST['back']))
				{
					header('Location: ../index.php');
					exit;
				}
				echo (empty($_POST['select']) && isset($_POST['sbtnedit']))?'<p id="error"</br>Please choose from the drop down menu!</p>':'';
			?>
	</form>
	
	<?php
		if ((isset($_POST['sbtnedit']) && !empty($_POST['select'])) || isset($_POST['btnedit']) || isset($_POST['ubtnedit']))
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
									echo '<option value="' . $data['STU_ID'] . '">' . $data['STU_ID'] . '</option>';
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
									echo '<option value="' . $data['CLUB_ID'] . '">' . $data['CLUB_ID'] . '</option>';
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
									echo '<option value="' . $data['STU_ID'] . '-' . $data['CLUB_ID'] . '">' . $data['STU_ID'] . ' - ' . $data['CLUB_ID'] . '</option>';
								}
							?>
						</select>
<?php
					}
		}
		
			if ((isset($_POST['sbtnedit']) && !empty($_POST['select'])) || isset($_POST['btnedit']) || isset($_POST['ubtnedit']))
			{
?>
				</br>
			<?php
				if (isset($_POST['btnedit']) && empty($_POST['sidf']) && empty($_POST['pidf']) && empty($_POST['cidf']))
				{
					echo '</br>Please select an ID!</br>';
				}
			?>
				</br>
				<input type="submit" class="submitbtn" value="Edit" name="btnedit"/>
		<?php
			}
		?>
			</form>
			
		<?php
			if ((isset($_POST['btnedit']) || isset($_POST['ubtnedit'])) && (!empty($_POST['sidf']) || !empty($_POST['cidf']) || !empty($_POST['pidf']) || !empty($_SESSION['eid'])))
			{
		?>
				<form action="" method="post">
					</br>
					<?php
						if ($_POST['select'] == "student" || $_SESSION['select'] == "student")
						{
					?>
							<fieldset>
								<legend>Edit Student</legend>
								<?php										
									foreach($_SESSION['datas'] as $data)
									{
										if ($data['STU_ID'] == $_POST['sidf'] || $data['STU_ID'] == $_SESSION['eid'])
										{
											echo '<label for="sid">Student ID: </label>
											<input type="text" id="sid" name="sid" value="' . $data['STU_ID'] . '"/>
											<label for="sfname">Student First Name: </label>
											<input type="text" id="sfname" name="sfname" value="' . $data['STU_FName'] . '"/>
											<label for="slname">Student Last Name: </label>
											<input type="text" id="slname" name="slname"  value="' . $data['STU_LName'] . '"/></br>
											<label for="sgen">Student Gender: </label>
											<input type="text" id="sgen" name="sgen" value="' . $data['STU_Gender'] . '"/>
											<label for="smail">Student Email: </label>
											<input type="text" id="smail" name="smail" value="' . $data['STU_Email'] . '"/>
											<label for="scont">Student Contact: </label>
											<input type="text" id="scont" name="scont"  value="' . $data['STU_Contact'] . '"/>';
										}
									}
								?>							
							</fieldset>
					<?php
						}else if ($_POST['select'] == "club" || $_SESSION['select'] == "club")
						{
					?>
							<fieldset>
								<legend>Edit Club</legend>
								<?php
									foreach($_SESSION['datac'] as $data)
									{
										if ($data['CLUB_ID'] == $_POST['cidf'] || $data['CLUB_ID'] == $_SESSION['eid'])
										{
											echo '<label for="cid">Club ID: </label>
											<input type="text" id="cid" name="cid" value="' . $data['CLUB_ID'] . '"/>
											<label for="cname">Club Name: </label>
											<input type="text" id="cname" name="cname" value="' . $data['CLUB_Name'] . '"/></br>
											<label for="ctype">Club Type: </label>
											<input type="text" id="ctype" name="ctype" value="' . $data['CLUB_Type'] . '"/>
											<label for="cmember">Club Member: </label>
											<input type="text" id="cmember" name="cmember"											<input type="text" id="ctype" name="ctype" value="' . $data['CLUB_Member'] . '"/>';
										}
									}
								?>
							</fieldset>
					<?php
						}else if ($_POST['select'] == "participate" || $_SESSION['select'] == "participate")
						{
					?>		
							<fieldset>
								<legend>Edit Participate</legend>
								<?php
									foreach($_SESSION['datap'] as $data)
									{
										if ($data['STU_ID'].'-'.$data['CLUB_ID'] == $_POST['pidf'] || $data['STU_ID'].'-'.$data['CLUB_ID'] == $_SESSION['eid'])
										{
											echo '<label for="spid">Student ID: </label>
											<input type="text" id="spid" name="spid" value="' . $data['STU_ID'] . '"/>
											<label for="cpid">Club ID: </label>
											<input type="text" id="cpid" name="cpid" value="' . $data['CLUB_ID'] . '"/></br>
											<label for="partdate">Join Date: </label>
											<input type="date" id="partdate" name="partdate" value="' . $data['PAR_DATE'] . '"/>';
										}
									}
								?>
							</fieldset>
					<?php
						}
						if ($_SESSION['editsuccess'] == "success")
						{
							echo '</br><b>Success!</b></br>';
							$_SESSION['editsuccess'] = "fail";
						}
						if (isset($_POST['ubtnedit']) && !(checks() || checkc() || checkp()))
						{
							echo '</br>Please enter all fields!</br>';
						}
						if (isset($_POST['ubtnedit']) && (checks() || checkc() || checkp()) && !checkprim())
						{
							echo '</br>Duplicated ID. Please enter other valid ID</br>';									
						}
					?>
					</br>
					<input type="submit" class="submitbtn" value="Update" name="ubtnedit"/>
				</form>
		<?php
			}
		?>
<?php			
	function checks()
	{
		if (!empty($_POST['sid']) && !empty($_POST['sfname']) && !empty($_POST['slname']) && !empty($_POST['sgen']) && !empty($_POST['smail']) && !empty($_POST['scont']))
			return true;
		else
			return false;
	}
	function checkc()
	{
		if (!empty($_POST['cid']) && !empty($_POST['cname']) && !empty($_POST['ctype']) && !empty($_POST['cmember']))
			return true;
		else
			return false;		
	}
	function checkp()
	{
		if (!empty($_POST['spid']) && !empty($_POST['cpid']) && !empty($_POST['partdate']))
			return true;
		else
			return false;			
	}
	function checkprim()
	{
		if($_SESSION['select'] == "student")
		{
			foreach($_SESSION['datas'] as $data)
			{
				if ($_POST['sid'] == $data['STU_ID'] && $_SESSION['eid'] != $_POST['sid'])
					return false;
			}
		}
		if($_SESSION['select'] == "club")
		{
			foreach($_SESSION['datac'] as $data)
			{
				if ($_POST['cid'] == $data['CLUB_ID'] && $_SESSION['eid'] != $_POST['cid'])
					return false;
			}
		}
		if($_SESSION['select'] == "participate")
		{
			foreach($_SESSION['datap'] as $data)
			{
				if ($_POST['spid'] == $data['STU_ID'])
				{
					if ($_POST['cpid'] == $data['CLUB_ID'] && $_SESSION['eid'] != $_POST['pid'])
						return false;
				}
			}
		}
		return true;
	}
	function updatedata()
	{
		if ($_SESSION['select'] == "participate" || $_SESSION['select'] == "student")
		{
			$query = 'SELECT * FROM student';
			$connquery = mysqli_query($GLOBALS['conn'], $query);

			if(!$connquery)
				die("Query failed : " . htmlspecialchars(mysqli_error($conn)));
				
			while ($data = mysqli_fetch_assoc($connquery))
			{
				$datas[] = $data;
			}
			$_SESSION['datas'] = $datas;
		}
		if ($_SESSION['select'] == "participate" || $_SESSION['select'] == "club")
		{
			$query = 'SELECT * FROM club';
			$connquery = mysqli_query($GLOBALS['conn'], $query);

			if(!$connquery)
				die("Query failed : " . htmlspecialchars(mysqli_error($conn)));
				
			while ($data = mysqli_fetch_assoc($connquery))
			{
				$datac[] = $data;
			}
			$_SESSION['datac'] = $datac;
		}
		if ($_SESSION['select'] == "participate")
		{
			$query = 'SELECT * FROM participate';
			$connquery = mysqli_query($GLOBALS['conn'], $query);

			if(!$connquery)
				die("Query failed : " . htmlspecialchars(mysqli_error($conn)));
				
			while ($data = mysqli_fetch_assoc($connquery))
			{
				$datap[] = $data;
			}
			$_SESSION['datap'] = $datap;
		}
	}
	require("footer.php");
?>