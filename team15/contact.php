<?php

include "src/email.php";
include "header.php";
//if form has been submitted 
if ($_POST) {
    $return = email($_POST);
}
?>

  <!-- contact section -->
  <section class="contact_section layout_padding">
    <div class="container">
      <div class="row">

        <div class="col-md-5">
          <div class="info-box">
            <h2>
              Contact Information
            </h2>
            <span>
              <i class="fa fa-map-marker" aria-hidden="true"></i>
                  Location
            </span>
            <span>
              <i class="fa fa-phone" aria-hidden="true"></i>
                  Call +01 1234567890
            </span>
            <span>
              <i class="fa fa-envelope" aria-hidden="true"></i>
                  demo@gmail.com
            </span>
          </div>
        </div>
          <div class="col-md-7">
              <div class="form_container">
                      <div class="heading_container">
                          <h2 style="text-align: center">
                              Got a Question?
                          </h2>
                          <h3>
                              We look forward to hear you and help to answer
                              any question you have
                          </h3>
                      </div>
                  <?php
                  if ($_POST) {
                      echo <<<EOT
<div class="alert">
<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
$return
</div>
EOT;
                  }
                  ?>
                  <form action="contact.php" method="post">
                      <div>
                          <input type="text" placeholder="Full Name" name="fullname" />
                      </div>
                      <div>
                          <input type="email" placeholder="Email" name="email"/>
                      </div>
                      <div>
                          <input type="text" placeholder="Subject" name="subject"/>
                      </div>
                      <div>
                 <textarea type="text" class="message-box" name="message" placeholder="Enter your query here..">
                </textarea>
                      </div>
                      <div class="d-flex" style="margin-left: 0px">
                          <button type="submit" value="send">
                              SEND
                          </button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
    </div>
  </section>

  <!-- end contact section -->

<?php 
include "footer.php";
?>