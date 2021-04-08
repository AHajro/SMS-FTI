<?php 
include('class/School.php');
$school = new School();
$school->pedagogLoginStatus();
include('inc/header.php');
?>
<title>FTI</title>
<?php include('inc/include_files.php');?>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/detyra.js"></script>
<style>
.dataTables_filter {
display: none; 
}
</style>
<?php include('inc/container.php');?>
<div class="container">	
	<?php include('p_side-menu.php');	?>
	<div class="content">
		<div class="container-fluid">
			<strong>Detyra</strong>
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<form id="form1" action="" method="post" accept-charset="utf-8">
							<div class="box-body">						
								<div class="row">
								<div class="col-md-2">
										<div class="form-group">
											<label for="exampleInputEmail1">Niveli i studimit</label><small class="req"> *</small>
												<select name="niveliid" id="niveliid" class="form-control" required>
													<option value="">Zgjidhni Nivelin e Studimit</option>
													<?php echo $school->getNiveliList(); ?> 
												</select>
											<span class="text-danger"></span>
										</div>
									</div> 	

									<div class="col-md-2">
										<div class="form-group">
											<label for="exampleInputEmail1">Dega</label><small class="req"> *</small>
												<select name="degaid" id="degaid" class="form-control" required>
													<option value="">Zgjidhni Degen</option>
													<?php echo $school->getDegaList(); ?> 
												</select>
											<span class="text-danger"></span>
										</div>
									</div> 	

									<div class="col-md-2">
										<div class="form-group">
											<label for="exampleInputEmail1">Viti</label><small class="req"> *</small>
											<select id="classid" name="classid" class="form-control" required>
												<option value="">Zgjidhni Vitin</option>
												<?php echo $school->classList(); ?>												
											</select>
											<span class="text-danger"></span>
										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group">
											<label for="exampleInputEmail1">Grupi</label><small class="req"> *</small>
												<select name="sectionid" id="sectionid" class="form-control" required>
													<option value="">Zgjidhni Grupin</option>
													<?php echo $school->getSectionList(); ?>
												</select>
											<span class="text-danger"></span>
										</div>
									</div> 
									<div class="col-md-2">
										<div class="form-group">
											<label for="exampleInputEmail1">Lenda</label><small class="req"> *</small>
											<select id="lendaid" name="lendaid" class="form-control" required>
												<option value="">Zgjidhni Lenden</option>
												<?php echo $school->getLendaList(); ?>												
											</select>
											<span class="text-danger"></span>
										</div>
									</div>
																	
							</div>
							<div class="box-footer">
								<button type="button" id="search" name="search" value="search" style="margin-bottom:10px;" class="btn btn-danger btn-sm  checkbox-toggle"><i class="fa fa-search"></i> Kerkoni</button> <br>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="row">					
				<form id="attendanceForm" method="post">					
					<div style="color:#FF0000;margin-top:20px;" class="hidden" id="message"></div>
					<button type="submit" id="saveAttendance" name="saveAttendance" value="Save Attendance" style="margin-bottom:10px;" class="btn btn-danger btn-sm  pull-right checkbox-toggle hidden"><i class="fa fa-save"></i>Ruaj</button> <table id="studentList" class="table table-bordered table-striped hidden">
						<thead>
							<tr>
								<th>Emri</th>
								<th>Mbiemri</th>
								<th>Piket Aktuale</th>	
								<th>Piket</th>	
								<th>Komente/Vleresime(+-)</th>												
							</tr>
						</thead>
					</table>
					<input type="hidden" name="action" id="action" value="updateVleresim" />
					<input type="hidden" name="att_classid" id="att_classid" value="" />
					<input type="hidden" name="att_piket" id="att_piket"  />
					<input type="hidden" name="att_koment" id="att_koment"  />
					
					<input type="hidden" name="att_sectionid" id="att_sectionid" value="" />
					<input type="hidden" name="att_lendaid" id="att_lendaid" value="" />
					<input type="hidden" name="att_niveliid" id="att_niveliid" value="" />
					<input type="hidden" name="att_degaid" id="att_degaid" value="" />
				</form>
			</div>					
	</div>	                                
</div>	
<?php include('inc/footer.php');?>