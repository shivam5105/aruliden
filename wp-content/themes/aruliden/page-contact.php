<?php
/*
Template Name: Contact
*/
?>

<?php get_header(); ?>
			
	<!--div class="container-full">
		<div class="row">
			<div class="col-sm-12 page-title">
				<h1 class="title"><?php echo get_the_title(); ?></h1>
			</div>
		</div>
	</div-->

	<?php

	$addresses = get_field("address");
	$emails = get_field("email");
	$emails = get_field("email");
	$inquries = get_field("general_inquiries");
	$careers = get_field("careers");

	?>

	<div class="container-full mt95">
		<div class="row">
		<?php 
			foreach ($addresses as $address) {
				?>

			<div class="col-sm-6 seq-heading">
				<?php echo $address['contact_details']; ?>
			</div>

		<?php
			}
		?>

			<!--div class="col-sm-6">
				<h2 class="title">New York City</h2>
				<p>30 West 24th St., 9th Floor<br/>New York, NY 10010</p>
				<p class="mt50"><a href="callto:+12124630286">+1(212)463 0286</a></p>
			</div>
			<div class="col-sm-6">
				<h2 class="title">San Francico</h2>
				<p>140 Geary Street, 10FL<br/>San Francisco CA 94108</p>
				<p class="mt50"><a href="callto:+14156969531">(415)696 9531</a></p>
			</div-->
		</div>
		<div class="row contact-row-mt seq-heading">
		<?php 
			foreach ($emails as $email) {
				?>
			<div class="col-sm-3">
				<h2><?php echo $email['title']; ?></h2>
				<p class="mt50"><a href="mailto:<?php echo $email['email']; ?>"><?php echo $email['email']; ?></a></p>
			</div>	
		<?php		
			}
		 ?>
			<!--div class="col-sm-3">
				<h2>New Business</h2>
				<p class="mt50"><a href="mailto:marc@aruliden.com">marc@aruliden.com</a></p>
			</div>
			<div class="col-sm-3">
				<h2>Press</h2>
				<p class="mt50"><a href="mailto:press@aruliden.com">press@aruliden.com</a></p>
			</div-->
			<div class="col-sm-6">
				<h2>Newsletter</h2>
				<div class="subscribe mt50">
					<form>
						<input type="text" placeholder="Enter your email">
						<input type="submit" value="Subscribe">
					</form>
				</div>

			</div>
		</div>
		<div class="row contact-row2-mt seq-heading">
			<div class="col-sm-6">
				<h2>General Inquiries</h2>
				<?php echo get_field("general_inquiries"); ?>
			</div>
			<div class="col-sm-6">
				<h2 class="title">Careers</h2>
				<?php echo get_field("career_text"); ?>
				<div class="info-accordion">

				<?php 
				$counter = 1;
					foreach ($careers as $career) {
						?>


					<div class="acc active">
						<h4 class="head"><i class="col-sm-6 no-pd"><?php echo $career['title']; ?></i> <i class="col-sm-6 no-pd"><?php echo $career['title1']; ?></i> <span class="<?php if($counter == 1){echo "ion-android-close";} else{echo "ion-plus";} ?>"></span></h4>
						<div class="info">
							<div class="row">
								<div class="col-sm-6 seq-text">
									<?php echo $career['description_left']; ?>
								</div>
								<div class="col-sm-6 no-pd seq-text">
									<?php echo $career['description_right']; ?>
								</div>
							</div>
						</div>
					</div>


				<?php
				$counter++;
					}
				 ?>



					<!--div class="acc active">
						<h4 class="head"><i class="col-sm-6 no-pd">Strategy + Innovation</i> <i class="col-sm-6 no-pd">NYC</i> <span class="ion-android-close"></span></h4>
						<div class="info">
							<div class="row">
								<div class="col-sm-6">
									<h5>Info</h5>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua.</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. eiusmod
									tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
								<div class="col-sm-6 no-pd">
									<h5>Specific Skills</h5>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua.</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. eiusmod
									tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
						</div>
					</div>

					<div class="acc active">
						<h4 class="head"><i class="col-sm-6 no-pd">Strategy + Innovation</i> <i class="col-sm-6 no-pd">NYC</i> <span class="ion-plus"></span></h4>
						<div class="info">
							<div class="row">
								<div class="col-sm-6">
									<h5>Info</h5>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua.</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. eiusmod
									tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
								<div class="col-sm-6 no-pd">
									<h5>Specific Skills</h5>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua.</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. eiusmod
									tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
						</div>
						<div class="info">
							<div class="row">
								<div class="col-sm-6">
									<h5>Info</h5>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua.</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. eiusmod
									tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
								<div class="col-sm-6 no-pd">
									<h5>Specific Skills</h5>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua.</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. eiusmod
									tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
						</div>
					</div>

					<div class="acc active">
						<h4 class="head"><i class="col-sm-6 no-pd">Strategy + Innovation</i> <i class="col-sm-6 no-pd">NYC</i> <span class="ion-plus"></span></h4>
						<div class="info">
							<div class="row">
								<div class="col-sm-8">
									<h5>Info</h5>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua.</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. eiusmod
									tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
								<div class="col-sm-6 no-pd">
									<h5>Specific Skills</h5>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua.</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. eiusmod
									tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
						</div>
						<div class="info">
							<div class="row">
								<div class="col-sm-6">
									<h5>Info</h5>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua.</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. eiusmod
									tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
								<div class="col-sm-6 no-pd">
									<h5>Specific Skills</h5>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua.</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. eiusmod
									tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
						</div>
					</div>

					<div class="acc active">
						<h4 class="head"><i class="col-sm-6 no-pd">Strategy + Innovation</i> <i class="col-sm-6 no-pd">NYC</i> <span class="ion-plus"></span></h4>
						<div class="info">
							<div class="row">
								<div class="col-sm-6">
									<h5>Info</h5>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua.</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. eiusmod
									tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
								<div class="col-sm-6 no-pd">
									<h5>Specific Skills</h5>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua.</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. eiusmod
									tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
						</div>
						<div class="info">
							<div class="row">
								<div class="col-sm-6">
									<h5>Info</h5>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua.</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. eiusmod
									tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
								<div class="col-sm-6 no-pd">
									<h5>Specific Skills</h5>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua.</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. eiusmod
									tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
						</div>
					</div-->

				</div>

			</div>
		</div>
	</div>


<?php get_footer(); ?>