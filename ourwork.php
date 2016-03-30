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
          <h2>Our Courses</h2>
			<p>Basic share trading</br>
			Day 1 - Fundamental analysis and Economics</br>
			Day 2 - Technical analysis and Stock Pick method</br></br>
			Advance share trading</br>
Short Term trading and portfolio management</br></br>Fees: RM 2800</br></br>Pay Now! :
			</p>
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="RPQ5ZVUFXGN32">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynow_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
        </form>


		    <div class="content_container">
		      <p>text</p>
		    	<div class="button_small">
		        <a href="#">Read more</a>
		      </div><!--close button_small-->
		    </div><!--close content_container-->
            <div class="content_container">
		      <p>text</p>
		    	<div class="button_small">
		        <a href="#">Read more</a>
		        </div><!--close button_small-->		  
		    </div><!--close content_container-->
		    <div class="content_container">
		      <p>text3</p>
		    	<div class="button_small">
		        <a href="#">Read more</a>
		      </div><!--close button_small-->
		    </div><!--close content_container-->
            <div class="content_container">
		      <p>text4</p>
		    	<div class="button_small">
		        <a href="#">Read more</a>
		        </div><!--close button_small-->		  
		    </div><!--close content_container-->			
		</div><!--close content_item-->
      </div><!--close content-->   
	</div><!--close site_content-->  	
<?php
	include("footer.html");
?>
