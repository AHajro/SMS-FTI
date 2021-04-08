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
<script src="js/students.js"></script>
<?php include('inc/container.php');?>

<div class="container">	
	<?php include('a_side-menu.php');	?>
	<div class="content">
		<div class="container-fluid">
			<div>   
				<a href="#"><strong>Studentet</strong></a>
				<hr>		
				<div class="panel-heading">
					<div class="row">
						<div class="col-md-10">
							<h3 class="panel-title"></h3>
						</div>
						<div class="col-md-2" align="right">
							<button type="button" name="add" id="addStudent" class="btn btn-success btn-xs">Shto Student</button>
						</div>
					</div>
				</div>
				<table id="studentList" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Emer</th>
							<th>Mbiemer</th>	
							<th>Niveli</th>
							<th>Dega</th>	
							<th>Viti</th>
							<th>Grupi</th>				
							<th></th>
							<th></th>							
						</tr>
					</thead>
				</table>
				
			</div>			
		</div>		
	</div>	
</div>	
<div id="studentModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="studentForm" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><i class="fa fa-plus"></i> Edit Student</h4>
				</div>
				<div class="modal-body">
				<div class="form-group">
						<label for="firstname" class="control-label">Emri*</label>
						<input type="text" class="form-control" id="sname" name="sname" placeholder="Emri i Studentit" required>				
					</div>
					<div class="form-group">
						<label for="fname" class="control-label">Atesia*</label>							
						<input type="text" class="form-control" id="fname" name="fname" placeholder="Emri i Babait" required>							
					</div>	
					<div class="form-group">
						<label for="mbiemri" class="control-label">Mbiemri*</label>
						<input type="text" class="form-control" id="mbiemri" name="mbiemri" placeholder="Mbiemri i Studentit" required>				
					</div>
					<div class="form-group">
						<label for="niveliid" class="control-label">Niveli*</label>	
						<select name="niveliid" id="niveliid" class="form-control" required>
							<option value="">Zgjidh Nivelin e Studimit</option>
							<?php echo $school->getNiveliList(); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="degaid" class="control-label">Dega*</label>	
						<select name="degaid" id="degaid" class="form-control" required>
							<option value="">Zgjidh Degen</option>
							<?php echo $school->getDegaList(); ?>
						</select>
					</div>		
					<div class="form-group">
						<label for="classid" class="control-label">Viti*</label>	
						<select name="classid" id="classid" class="form-control" required>
							<option value="">Zgjidh Vitin</option>
							<?php echo $school->classList(); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="sectionid" class="control-label">Grupi*</label>	
						<select name="sectionid" id="sectionid" class="form-control" required>
							<option value="">Zgjidh Grupin</option>
							<?php echo $school->getSectionList(); ?>
						</select>
					</div>
					<div class="form-group">
						<label for="dob" class="control-label">Datelindja*</label>							
						<input type="text" class="form-control"  id="dob" name="dob" placeholder="dd/mm/yyyy" required> 							
					</div>
					<div class="form-group">
						<label for="email" class="control-label">Email*</label>							
						<input type="email" class="form-control"  id="email" name="email" placeholder="Emaili i Studentit" required>							
					</div>
					<div class="form-group">
						<label for="firstname" class="control-label">Password*</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Passwordi i Studentit">				
					</div>		

					<div class="form-group">
						<label for="admission_date" class="control-label">Data e Rregjistrimit*</label>							
						<input type="text" class="form-control"  id="admission_date" name="admission_date" placeholder="dd/mm/yyyy" required>							
					</div>	
								
				</div>
				<div class="modal-footer">
					<input type="hidden" name="studentid" id="studentid" />
					<input type="hidden" name="action" id="action" value="updateStudent" />
					<input type="submit" name="save" id="save" class="btn btn-info" value="Ruaj" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Mbyll</button>
				</div>
			</div>
		</form>
	</div>
</div>
<?php include('inc/footer.php');?>