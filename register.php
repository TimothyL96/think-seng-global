<?php include("header.html"); ?>
        <script>
            window.onload = function()
            {
                var a = document.getElementById("register");
                a.classList.add("current");
            }
        </script>
<?php include("sidebar.html"); ?>

	  <div id="content">
        <div class="content_item">
          <h2>Register</h2>
		    <p>REGISTER NOW! </p>
			<p>E-mail : enquire@thinksengglobal.com</p>
			<p>form:</p>
            <form action="" method="post">
                First Name: <input type="text" name="name" placeholder="First Name" required="required"/></br>
                Second Name: <input type="text" name="name" placeholder="Second Name" required="required"/>
                <input type="submit" name="submit" value="Register"/>
            </form>
	    </div><!--close content_item-->
      </div><!--close content-->
	</div><!--close site_content-->


<?php
	include("footer.html");
?>
