<?php 
include('class/School.php');
$school = new School();
$school->pedagogLoginStatus();
include('inc/header.php');
?>
<title>FTI</title>
<?php include('inc/include_files.php');?>
<?php include('inc/container.php');?>
<div class="container">	
	<?php include('p_side-menu.php');	?>
	<div class="content">
		<div class="container-fluid">    			
			<div class="alert alert-danger fade in">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong><span class="ti ti-announcement fa-2x"></span> </strong> <strong>&nbsp;&nbsp;Mireseerdhet ne faqen Pedagog!</strong>
			</div>						
			<div class="row"><!--row begins-->
				<div class="col-lg-3 col-sm-6">
					<div class="card">
						<div class="content">
							<div class="row">
								<div class="col-xs-5">
									<div class="icon-big icon-danger text-center">
										<i class="ti-folder"></i>
									</div>
								</div>
								<div class="col-xs-7">
									<div class="numbers">
										<p><strong>Leksion</strong></p>										
									</div>
								</div>
							</div>
							<a href="p_leksion.php">
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
										<i class="ti-bar-chart-alt"></i>
									</div>
								</div>
								<div class="col-xs-7">
									<div class="numbers">
										<p><strong>Seminar</strong></p>										
									</div>
								</div>
							</div>
							<a href="p_seminar.php">
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
										<i class="ti-vector"></i>
									</div>
								</div>
								<div class="col-xs-7">
									<div class="numbers">
										<p><strong>Lab</strong></p>										
									</div>
								</div>
							</div>
							<a href="p_lab.php">
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
										<i class="ti-write"></i>
									</div>
								</div>
								<div class="col-xs-7">
									<div class="numbers">
										<p><strong>Detyra</strong></p>										
									</div>
								</div>
							</div>
							<a href="p_detyra.php">
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
										<i class="ti-files"></i>
									</div>
								</div>
								<div class="col-xs-7">
									<div class="numbers">
										<p><strong>Provim</strong></p>										
									</div>
								</div>
							</div>
							<a href="p_provim.php">
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

				<div class="col-lg-4 col-sm-6">
					<div class="card">
						<div class="content">
							<div class="row">
								<div class="col-xs-5">
									<div class="icon-big icon-danger text-center">
										<i class="ti-stats-up"></i>
									</div>
								</div>
								<div class="col-xs-7">
									<div class="numbers">
										<p><strong>Vleresim Perfundimtar</strong></p>										
									</div>
								</div>
							</div>
							<a href="p_vleresim_perfundimtar.php">
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
