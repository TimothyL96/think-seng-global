<!--
	********************
	DATABASE NAME : TEST
	********************
-->
<?php
	require("header.php");
	if (isset($_POST['fsubmit']) && !empty($_POST['optbox']))
	{
		if ($_POST['optbox'] == "view")
		{
			header('Location: ./view.php');
			exit;
		}
		if ($_POST['optbox'] == "add")
		{
			header('Location: ./add.php');
			exit;
		}
		if ($_POST['optbox'] == "edit")
		{
			header('Location: ./edit.php');
			exit;
		}
		if ($_POST['optbox'] == "del")
		{
			header('Location: ./delete.php');
			exit;
		}
	}
?>
	<h1 id="main">Welcome to School Club Registration System</h1>
	<form action="" method="post">
		<input id="viewl" type="radio" name="optbox" value="view"/>
		<label for="viewl">View</label>
		<input id="addl" type="radio" name="optbox" value="add"/>
		<label for="addl">Add</label>
		<input id="editl" type="radio" name="optbox" value="edit"/>
		<label for="editl">Edit</label>
		<input id="dell" type="radio" name="optbox" value="del"/>
		<label for="dell">Delete </label>
		</br>
		<?= (empty($_POST['optbox']) && !isset($_POST['fsubmit']))?"":'<p id="error"</br>Please choose one of the option!</p>'; ?>
		</br>
		<input type="submit" id="fsubmit" name="fsubmit" value="Go"/>
	</form>
<?php
	require("footer.php");
?>