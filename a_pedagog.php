<?php 
include('class/School.php');
$school = new School();
$school->adminLoginStatus();
include('inc/header.php');
?>

<title>FTI</title>

<?php include('inc/include_files.php');?>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/teacher.js"></script>
<?php include('inc/container.php');?>

<div class="container">	
	<?php include('a_side-menu.php');	?>
	<div class="content">
		<div class="container-fluid">
			<div>   
				<a href="#"><strong>Pedagoget</strong></a>
				<hr>		
				<div class="panel-heading">
					<div class="row">
						<div class="col-md-10">
							<h3 class="panel-title"></h3>
						</div>
						<div class="col-md-2" align="right">
							<button type="button" name="add" id="addTeacher" class="btn btn-success btn-xs">Shto Pedagog</button>
						</div>
					</div>
				</div>
				<table id="teacherList" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Emri</th>	
							<th>Mbiemri</th>	
							<th>Titulli</th>	
							<th>Email</th>								
							<th></th>
							<th></th>							
						</tr>
					</thead>
				</table>
				
			</div>			
		</div>		
	</div>	
</div>	
<div id="teacherModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="teacherForm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><i class="fa fa-plus"></i> Edit Teacher</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="teacher" class="control-label">Emri*</label>
						<input type="text" class="form-control" id="teacher_name" name="teacher_name" placeholder="Emri i Pedagogut" required>					
					</div>
					<div class="form-group">
						<label for="mbiemri" class="control-label">Mbiemri*</label>
						<input type="text" class="form-control" id="mbiemri" name="mbiemri" placeholder="Mbiemri i Pedagogut" required>					
					</div>
					<div class="form-group">
						<label for="titulli" class="control-label">Titulli*</label>
						<input type="text" class="form-control" id="titulli" name="titulli" placeholder="Titulli" required>					
					</div>
					<div class="form-group">
						<label for="email" class="control-label">Email*</label>
						<input type="text" class="form-control" id="email" name="email" placeholder="Emaili i Pedagogut" required>					
					</div>	
					<div class="form-group">
						<label for="password" class="control-label">Password*</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Passwordi i Pedagogut">					
					</div>										
				</div>
				<div class="modal-footer">
					<input type="hidden" name="teacherid" id="teacherid" />
					<input type="hidden" name="action" id="action" value="updateTeacher" />
					<input type="submit" name="save" id="save" class="btn btn-info" value="Ruaj" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Mbyll</button>
				</div>
			</div>
		</form>
	</div>
</div>