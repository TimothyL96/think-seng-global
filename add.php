<?php
	session_start();
	require("header.php");
	if (isset($_POST['sbtnadd']) && !empty($_POST['select']) || isset($_POST['btnadd']))
	{
		if (isset($_POST['sbtnadd']) && !empty($_POST['select']))
			$_SESSION['select'] = mysqli_real_escape_string($conn, $_POST['select']);
		if ($_SESSION['select'] == "participate" || $_SESSION['select'] == "student")
		{
			$query = 'SELECT STU_ID FROM student';
			$connquery = mysqli_query($conn, $query);

			if(!$connquery)
				die("Query failed : " . htmlspecialchars(mysqli_error($conn)));
				
			while ($data = mysqli_fetch_assoc($connquery))
			{
				$datas[] = $data;
			}
		}
		if ($_SESSION['select'] == "participate" || $_SESSION['select'] == "club")
		{
			$query = 'SELECT CLUB_ID FROM club';
			$connquery = mysqli_query($conn, $query);

			if(!$connquery)
				die("Query failed : " . htmlspecialchars(mysqli_error($conn)));
				
			while ($data = mysqli_fetch_assoc($connquery))
			{
				$datac[] = $data;
			}
		}
		if ($_SESSION['select'] == "participate")
		{
			$query = 'SELECT STU_ID, CLUB_ID FROM participate';
			$connquery = mysqli_query($conn, $query);

			if(!$connquery)
				die("Query failed : " . htmlspecialchars(mysqli_error($conn)));
				
			while ($data = mysqli_fetch_assoc($connquery))
			{
				$datap[] = $data;
			}
		}
	}
	if (isset($_POST['btnadd']) && (checks() || checkc() || checkp()))
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
				$query = 'INSERT INTO ' . $_SESSION['select'] . ' VALUES (\'' . $sid . '\', \'' . $sfname . '\', \'' . $slname . '\', \'' . $sgen . '\', \'' . $smail . '\', \'' . $scont . '\')';
			}
			if ($_SESSION['select'] == "club")
			{
				$cid = $_POST['cid'];
				$cname = $_POST['cname'];
				$ctype = $_POST['ctype'];
				$cmember = $_POST['cmember'];
				$query = 'INSERT INTO ' . $_SESSION['select'] . ' VALUES (\'' . $cid . '\', \'' . $cname . '\', \'' . $ctype . '\', \'' . $cmember . '\')';
			}
			if ($_SESSION['select'] == "participate")
			{
				$spid = $_POST['spid'];
				$cpid = $_POST['cpid'];
				$partdate = $_POST['partdate'];
				$query = 'INSERT INTO ' . $_SESSION['select'] . ' VALUES (\'' . $spid . '\', \'' . $cpid . '\', \'' . $partdate . '\')';
			}
			$connquery = mysqli_query($conn, $query);
			if(!$connquery)
				die("Query failed : " . htmlspecialchars(mysqli_error($conn)));
			else
			{
				$_SESSION['addsuccess'] = "success";
			}
		}
	}
?>
	<h1 id="list">Choose a list to add</h1>
	<form action="" method="post">
		<select name="select"/>
			<option selected="selected"></option>
			<option value="student">Student</option>
			<option value="club">Club</option>
			<option value="participate">Participate</option>
		</select>
		<input type="submit" class="submitbtn" value="Press Me!" name="sbtnadd">
		<input type="submit" class="submitbtn" value="Go back" name="back"/>
	<?php
		if (isset($_POST['back']))
		{
			header('Location: ../index.php');
			exit;
		}
		echo (empty($_POST['select']) && isset($_POST['sbtnadd']))?'<p id="error"</br>Please choose from the drop down menu!</p>':'';
	?>
	</form>
	<?php
		if ((isset($_POST['sbtnadd']) && !empty($_POST['select'])) || isset($_POST['btnadd']))
		{
	?>
			<form action="" method="post">
			</br>
			<?php
				if ($_POST['select'] == "student" || $_SESSION['select'] == "student")
				{
			?>
					<fieldset>
						<legend>Add to Student</legend>
						<label for="sid">Student ID: </label>
						<input type="text" id="sid" name="sid" placeholder="1177700888"/>
						<label for="sfname">Student First Name: </label>
						<input type="text" id="sfname" name="sfname" placeholder="David"/>
						<label for="slname">Student Last Name: </label>
						<input type="text" id="slname" name="slname" placeholder="Smith"/></br>
						<label for="sgen">Student Gender: </label>
						<input type="text" id="sgen" name="sgen" placeholder="Female"/>
						<label for="smail">Student Email: </label>
						<input type="text" id="smail" name="smail" placeholder="exampleexample.com"/>
						<label for="scont">Student Contact: </label>
						<input type="text" id="scont" name="scont" placeholder="010-123 4567"/>
					</fieldset>
				<?php
					}else if ($_POST['select'] == "club" || $_SESSION['select'] == "club")
					{
				?>
						<fieldset>
							<legend>Add to Club</legend>
							<label for="cid">Club ID: </label>
							<input type="text" id="cid" name="cid" placeholder="53421"/>
							<label for="cname">Club Name: </label>
							<input type="text" id="cname" name="cname" placeholder="Swimming Club"/></br>
							<label for="ctype">Club Type: </label>
							<input type="text" id="ctype" name="ctype" placeholder="Sports"/>
							<label for="cmember">Club Member: </label>
							<input type="text" id="cmember" name="cmember" placeholder="234"/>
						</fieldset>
				<?php
					}else if ($_POST['select'] == "participate" || $_SESSION['select'] == "participate")
					{
				?>		
						<fieldset>
							<legend>Add to Participate</legend>
							 <select name="spid"/>
								<option selected="selected"></option>
								<?php
									foreach($datas as $data)
									{
										echo '<option value="'.$data['STU_ID'].'">'.$data['STU_ID'].'</option>';
									}
								?>
							</select>
							<select name="cpid"/>
								<option selected="selected"></option>
								<?php
									foreach($datac as $data)
									{
										echo '<option value="'.$data['CLUB_ID'].'">'.$data['CLUB_ID'].'</option>';
									}
								?>
							</select>
							<input type="date" name="partdate" />
						</fieldset>
<?php
					}
		}
			if ((isset($_POST['sbtnadd']) && !empty($_POST['select'])) || isset($_POST['btnadd']))
			{
?>
				</br>
			<?php
				if (isset($_POST['btnadd']) && !checks() && !checkc() && !checkp() )
				{
					echo 'Please enter all fields!';
				}
				if ($_SESSION['addsuccess'] == "success")
				{
					echo '<b>Success!</b>';
					$_SESSION['addsuccess'] = "fail";
				}
				if (isset($_POST['btnadd']) && (checks() || checkc() || checkp()) && checkprim() == 0)
				{
					echo '</br>Duplicated ID. Please enter other valid ID';
				}
			?>
				</br></br>
				<input type="submit" class="submitbtn" value="Add" name="btnadd"/>
		<?php
			}
		?>
			</form>
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
			foreach($GLOBALS['datas'] as $data)
			{
				if ($_POST['sid'] == $data['STU_ID'])
					return false;
			}
		}
		if($_SESSION['select'] == "club")
		{
			foreach($GLOBALS['datac'] as $data)
			{
				if ($_POST['cid'] == $data['CLUB_ID'])
					return false;
			}
		}
		if($_SESSION['select'] == "participate")
		{
			foreach($GLOBALS['datap'] as $data)
			{
				if ($_POST['spid'] == $data['STU_ID'])
				{
					if ($_POST['cpid'] == $data['CLUB_ID'])
						return false;
				}
			}
		}
		return true;
	}
	require("footer.php");
?>
