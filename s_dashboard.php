<?php 
include('class/School.php');
$school = new School();
$school->studentLoginStatus();
include('inc/header.php');
?>
<title>FTI</title>
<?php include('inc/include_files.php');?>
<?php include('inc/container.php');?>
<div class="container">	
	<?php include('s_side-menu.php');	?>
	<div class="content">
		<div class="container-fluid">    			
			<div class="alert alert-danger fade in">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong><span class="ti ti-announcement fa-2x"></span> </strong> <strong>&nbsp;&nbsp;Mireseerdhet ne faqen Student!</strong>
			</div>						
			<!--row begins-->
				<div class="row">

				<div class="col-lg-3 col-sm-6">
					<div class="card">
						<div class="content">
							<div class="row">
								<div class="col-xs-5">
									<div class="icon-big icon-danger text-center">
										<i class="ti-bar-chart-alt"></i>
									</div>
								</div>
								<div class="col-xs-7">
									<div class="numbers">
										<p><strong>Mungesat</strong></p>							
									</div>
								</div>
							</div>
							<a href="s_mungesa_report.php">
								<div class="footer">
								<hr />
								<div class="stats">
									<i class="ti-arrow-right"></i>Shfaq
								</div>
							</div>
						</a>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-sm-6">
					<div class="card">
						<div class="content">
							<div class="row">
								<div class="col-xs-5">
									<div class="icon-big icon-danger text-center">
										<i class="ti-menu-alt"></i>
									</div>
								</div>
								<div class="col-xs-7">
									<div class="numbers">
										<p><strong>Vleresimi</strong></p>							
									</div>
								</div>
							</div>
							<a href="s_vleresimi_report.php">
								<div class="footer">
								<hr />
								<div class="stats">
									<i class="ti-arrow-right"></i>Shfaq
								</div>
							</div>
						</a>
						</div>
					</div>
				</div>				
			</div>		
		</div>	
	</div>
</div>	
<?php include('inc/footer.php');?>