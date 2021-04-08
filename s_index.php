<?php 
ob_start();
include('class/School.php');

$school = new School();
$errorMessage =  $school->studentLogin();
include('inc/header.php');
?>
<title>FTI</title>
<?php include('inc/include_files.php');?>
<?php include('inc/container.php');?>
<center>
<div class="container">		
	<div class="col-md-6">                    
		<div class="panel panel-info">
			<div class="panel-heading" style="background:#000;color:white;">
				<div class="panel-title">Student Login</div>                        
			</div> 
			<div style="padding-top:30px" class="panel-body" >
				<?php if ($errorMessage != '') { ?>
					<div id="login-alert" class="alert alert-danger col-sm-12"><?php echo $errorMessage; ?></div>                            
				<?php } ?>
				<form id="loginform" class="form-horizontal" role="form" method="POST" action="">                                    
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" class="form-control" id="email" name="email" placeholder="email" required>                                        
					</div>                                
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="password" class="form-control" id="password" name="password" placeholder="password" required>
					</div>
					<div style="margin-top:10px" class="form-group">                               
						<div class="col-sm-12 controls">
						  <input type="submit" name="login" value="Hyr" class="btn btn-success">
						  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
						  <a href="index.html"><input type="button" value="Shko Pas" class="btn btn-danger"></a>								  
						</div>						
					</div>					
					</div>	
				</form>   
			</div>                     
		</div>  
	</div>
</div>
				</center>	
<?php include('inc/footer.php');?>
