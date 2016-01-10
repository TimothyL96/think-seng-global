<?php
	include("header.html");
?>
            <li><a href="index.php">Home</a></li>
            <li class="current"><a href="ourwork.php">Courses</a></li>
            <li><a href="testimonials.php">Testimonials</a></li>
            <li><a href="projects.php">Projects</a></li>
            <li><a href="contact.php">Contact Us</a></li>
			<li><a href="aboutus.php">About Us</a></li>
          </ul>
        </div><!--close menubar-->	
      </nav>
    </header>
	
    <div id="slideshow_container">  
	  <div class="slideshow">
	    <ul class="slideshow">
          <li class="show"><img width="940" height="250" src="images/home_1.jpg" alt="&quot;Enter your caption here&quot;" /></li>
          <li><img width="940" height="250" src="images/home_2.jpg" alt="&quot;Enter your caption here&quot;" /></li>
        </ul> 
	  </div><!--close slideshow-->  	
	</div><!--close slideshow_container-->  	
    
	<?php
		include("sidebar.html");
	?>
	
	  <div id="content">
        <div class="content_item">
          <h2>Our Courses</h2>
			<p>Basic share trading</br>
			Day 1 - Fundamental analysis and Economics</br>
			Day 2 - Technical analysis and Stock Pick method</br></br>
			Advance share trading</br>
Short Term trading and portfolio management</br>Fees: RM 2800</br>Pay Now! :
			</p>
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="RPQ5ZVUFXGN32">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
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
