<?php $value = $_GET['value'];
 ?> 


<?php
include('header.php');
?>
<style>
	#loader {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  background: rgba(0,0,0,0.75) url(Loading_icon.gif) no-repeat center center;
  z-index: 10000;
	}
	textarea,input[type="email"],input[type="password"],select, .tg-select select, .form-control, input[type="text"] {
    outline: none;
    color: #666;
    height: 50px;
    background: #fff;
    font-size: 14px;
    line-height: 20px;
    padding: 15px 15px !important;
    display: inline-block;
    vertical-align: middle;
    border-radius: 3px;
    box-shadow: none;
    border: 1px solid #e1e1e1;
    text-transform: capitalize;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
	</style>
    <div id="tg-innerbanner" class="tg-innerbanner tg-haslayout">
			<div class="tg-parallaximg" data-appear-top-offset="600" data-parallax="scroll" data-image-src="images/parallax/bgparallax-02.jpg"></div>
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="tg-innerbannercontent">
							<div class="tg-pagetitle">
								<h1>Registration</h1>
							</div>
							<ol class="tg-breadcrumb">
								<li><a href="#"><i class="fa fa-home"></i></a></li>
								<li class="tg-active">Registration</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
		<main id="tg-main" class="tg-main tg-haslayout">
			<!--************************************
					Get In Touch Start
			*************************************-->
			<section class="tg-main-section tg-haslayout">
				<div class="container">
					<div class="row">
						<div class="col-lg-offset-2 col-lg-8 col-md-offset-1 col-md-10 col-sm-offset-0 col-sm-12 col-xs-12">
							<div class="tg-sectionhead">
								<div class="tg-sectiontitle">
									<h2>DON’T BE A STRANGER </h2>
									<h3>Feel Free To Get In Touch With Experts</h3>
								</div>
								<div class="tg-description">
							<p>We have assisted many top business organizations in transforming their past operations into technology-driven systems. Now it is your turn to make the move and let us handle your business operations in the best manner. 

Get your estimate today. </p>
								</div>
							</div>
						</div>
						<form class="tg-themeform" id="registration-form"  method="post">	
						<input type="hidden" name="role_id" value="<?php echo  $value ?>">
							<fieldset>
								<div class="col-sm-6">
                                  <label for="first_name">First Name</label>
									<div class="form-group">
										<input type="text" class="form-control" name="first_name" placeholder="First Name">
									</div>
								</div>
								<div class="col-sm-6">
                                <label for="firstname">Last Name</label>
									<div class="form-group">
										<input type="text" class="form-control" name="last_name" placeholder="Last Name">
									</div>
								</div>
								<div class="col-sm-6">
                                <label for="email">Email</label>
									<div class="form-group">
										<input type="email" class="form-control" name="email" placeholder="Email">
									</div>
								</div>
								<div class="col-sm-6">
                                <label for="password">Password</label>
									<div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="Password">
									</div>
								</div>

                                <div class="col-sm-6">
                                <label for="Company Name">Company Name</label>
									<div class="form-group">
                                    <input type="text" class="form-control" name="company_name" placeholder="Company Name">
									</div>
								</div>
                                    <div class="col-sm-12 col-xs-12">
									<button type="submit" style="float:right" id="submit-btn" class="tg-btn"><span>submit</span></button>
                                   
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</section>
			<!--************************************
					Get In Touch End
			*************************************-->
<?php
include('footer.php');
?>

<div id="loader"></div>	


<script>
	
	var spinner = $('#loader');
    $(document).ready(function() {
  $('#registration-form').submit(function(e) {
    e.preventDefault(); 
	spinner.show();
    var formData = $(this).serialize();
     // send AJAX request
    $.ajax({
      url: 'process.php', 
      method: 'POST',
      data: formData,
      dataType: 'json',
      success: function(response) {
        // handle success response
		spinner.hide();
		window.location.href = 'thankyou.php';
		
		
      },
      error: function(jqXHR, textStatus, errorThrown) {
        // handle error response
        console.log(errorThrown);
      }
    });
  });
});
    </script>
