<?php 
include('class/School.php');

$school = new School();

$message = '';
if(!empty($_POST["update"]) && $_POST["update"]) {
	$message = $school->editAccountStudent();
}
$userDetail = $school->userDetailsStudent();
include('inc/header.php');
?>
<title>FTI</title>
<?php include('inc/include_files.php');?>
<?php include('inc/container.php');?>
<div class="container">	
	<?php include('s_side-menu.php');	?>			
	<div>
		<div class="panel">
			<div class="panel-heading">
				<div class="panel-title">Modifikoni te Dhenat</div>				
			</div>  
			<div class="panel-body col-md-7">
				<form class="form-horizontal" role="form" method="POST" action="">				
					<?php if($message != '') { ?>
						<div id="login-alert" class="alert alert-success col-sm-12"><?php echo $message; ?></div>                            
					<?php } ?>	
					<div class="form-group">
						<label for="firstname" class="col-md-3 control-label">Emri</label>
						<div class="col-md-9">
							<?php echo $userDetail['name'];?>
						</div>
					</div>
					<div class="form-group">
						<label for="lastname" class="col-md-3 control-label">Mbiemri</label>
						<div class="col-md-9">
							<?php echo $userDetail['mbiemri'];?>
						</div>
					</div>					
					<div class="form-group">
						<label for="email" class="col-md-3 control-label">Email</label>
						<div class="col-md-9">
							<?php echo $userDetail['email'];?>
						</div>
					</div>	

					<div class="form-group">
						<label for="password" class="col-md-3 control-label">Password</label>
						<div class="col-md-9">
							<input type="password" class="form-control" name="passwd" placeholder="Password" value="">
						</div>
					</div>	
					<div class="form-group">
						<label for="password" class="col-md-3 control-label">Konfirmoni Passwordin</label>
						<div class="col-md-9">
							<input type="password" class="form-control" name="cpasswd" placeholder="Konfirmo Password" value="">
						</div>
					</div>						
					<div class="form-group">						                                  
						<div class="col-md-offset-3 col-md-9">
							<button id="btn-signup" type="submit" name="update" value="update_account" class="btn btn-info"><i class="icon-hand-right"></i>Ruaj</button>			
						</div>
					</div>							
				</form>
			 </div>
		</div>
	</div>	
</div>	
<?php include('inc/footer.php');?>