<?php 
include('class/School.php');
$school = new School();
$school->adminLoginStatus();
include('inc/header.php');
?>

<title>FTI</title>

<?php include('inc/include_files.php');?>
<?php include('inc/container.php');?>

<div class="container">	
	<?php include('a_side-menu.php');?>
	
	<div class="content">
		<div class="container-fluid">    			
			<div class="alert alert-danger fade in">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong><span class="ti ti-announcement fa-2x"></span> </strong> <strong>&nbsp;&nbsp;Mireseerdhet!</strong>
			</div>						
			<div class="row"><!--row begins-->
				<div class="col-lg-3 col-sm-6">
					<div class="card">
						<div class="content">
							<div class="row">
								<div class="col-xs-5">
									<div class="icon-big icon-danger text-center">
										<i class="ti-user"></i>
									</div>
								</div>
								<div class="col-xs-7">
									<div class="numbers">
										<p><strong>Studentet</strong></p>										
									</div>
								</div>
							</div>
							<a href="a_students.php">
								<div class="footer">
								<hr />
								<div class="stats">
									<i class="ti-arrow-right"></i>View
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
										<i class="ti-id-badge"></i>
									</div>
								</div>
								<div class="col-xs-7">
									<div class="numbers">
										<p><strong>Pedagoget</strong></p>									   
									</div>
								</div>
							</div>
							<a href="a_pedagog.php">
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
										<i class="ti-book"></i>
									</div>
								</div>
								<div class="col-xs-7">
									<div class="numbers">
										<p><strong>Lendet</strong></p>									   
									</div>
								</div>
							</div>
							<a href="a_lendet.php">
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
