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
<script src="js/subjects.js"></script>
<?php include('inc/container.php');?>

<div class="container">	
	<?php include('a_side-menu.php');	?>
	<div class="content">
		<div class="container-fluid">
			<div>   
				<a href="#"><strong>Lendet</strong></a>
				<hr>		
				<div class="panel-heading">
					<div class="row">
						<div class="col-md-10">
							<h3 class="panel-title"></h3>
						</div>
						<div class="col-md-2" align="right">
							<button type="button" name="add" id="addSubject" class="btn btn-success btn-xs">Shto Lende</button>
						</div>
					</div>
				</div>
				<table id="subjectList" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Lenda</th>
							<th>Pedagogu</th>	
							<th>Niveli</th>
							<th>Dega</th>
							<th>Viti</th>
							<th>Grupi</th>
							<th>Leksion/Seminar</th>								
							<th></th>
							<th></th>							
						</tr>
					</thead>
				</table>
				
			</div>			
		</div>		
	</div>	
</div>	
<div id="subjectModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="subjectForm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><i class="fa fa-plus"></i> Modifiko Lenden</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="subject" class="control-label">Emri i Lendes*</label>
						<input type="text" class="form-control" id="subject" name="subject" placeholder="Emri i Lendes" required>					
					</div>
					<div class="form-group">
						<label for="pedagogu" class="control-label">Pedagogu*</label>
						<select id="pedagogu" name="pedagogu" class="form-control" required>
												<option value="">Zgjidh</option>
												<?php echo $school->getPedagoguList(); ?>												
											</select>					
					</div>
					<div class="form-group">
						<label for="niveli" class="control-label">Niveli i Studimeve*</label>
						<select id="niveli" name="niveli" class="form-control" required>
												<option value="">Zgjidh Nivelin e Studimeve</option>
												<?php echo $school->getNiveliList(); ?>												
											</select>					
					</div>
					<div class="form-group">
						<label for="dega" class="control-label">Dega*</label>
						<select id="dega" name="dega" class="form-control" required>
												<option value="">Zgjidh Degen</option>
												<?php echo $school->getDegaList(); ?>												
											</select>					
					</div>
					<div class="form-group">
						<label for="viti" class="control-label">Viti*</label>
						<select id="viti" name="viti" class="form-control" required>
												<option value="">Zgjidh Vitin</option>
												<?php echo $school->classList(); ?>												
											</select>					
					</div>
					<div class="form-group">
						<label for="grupi" class="control-label">Grupi</label>
						<input type="text" class="form-control" id="grupi" name="grupi" placeholder="Vendosni grupin/grupet" required>					
					</div>					
					<div class="form-group">
						<label for="s_type" class="control-label">Lloji</label><br>							
						<label class="radio-inline">
							<input type="radio" name="s_type" id="leksion" value="Leksion" required>Leksion
						</label>
						<label class="radio-inline">
							<input type="radio" name="s_type" id="seminar" value="Seminar" required>Seminar
						</label>							
					</div>	
				</div>
				<div class="modal-footer">
					<input type="hidden" name="subjectid" id="subjectid" />
					<input type="hidden" name="action" id="action" value="updateSubject" />
					<input type="submit" name="save" id="save" class="btn btn-info" value="Ruaj" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Mbyll</button>
				</div>
			</div>
		</form>
	</div>
</div>