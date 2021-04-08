<?php 
include('class/School.php');
$school = new School();
$school->studentLoginStatus();
include('inc/header.php');
?>
<title>FTI</title>
<?php include('inc/include_files.php');?>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/vleresimi_report.js"></script>
<style>
.dataTables_filter {
display: none; 
}
</style>
<?php include('inc/container.php');?>
<div class="container">	
	<?php include('s_side-menu.php');	?>
	<div class="content">
	<center>
		<div class="container-fluid">
			<strong>Raporti i Vleresimeve</strong>
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<form id="form1" action="" method="post" accept-charset="utf-8">
							<div class="box-footer">
								<button type="button" id="search" name="search" value="search" style="margin-bottom:10px;" class="btn btn-danger btn-sm  checkbox-toggle"><i class="fa fa-search"></i> Shfaq</button> <br>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="row">					
				<form id="attendanceForm" method="post">					
					<table id="studentList" class="table table-bordered table-striped hidden">
						<thead>
							<tr>
								<th>Lenda</th>
								<th>Piket e Lab</th>
								<th>Piket e Provimit</th>
								<th>Piket e Detyres</th>
								<th>Nota</th>	
							</tr>
						</thead>
						<tbody>
						<?php 

						$sqlQuery = "SELECT  lab_points, detyra_points, lenda_id, provim_points, nota, l.subject 
                        From sms_rezultat main
                        join sms_students students on students.id = main.student_id
                        join sms_lendet l on l.subject_id = main.lenda_id
                        where main.student_id ='".$_SESSION["studentUserid"]."'";

						$result = mysqli_query($school->dbConnect, $sqlQuery);

                                        
                        while  ($row = mysqli_fetch_array($result)) {
						?>
							<tr>
							<td>
							<?php echo $row["subject"];?>
								</td>
								<td>
								<?php echo $row["lab_points"];?>
								</td>
								<td>
								<?php echo $row["provim_points"];?>
								</td>
								<td>
								<?php echo $row["detyra_points"];?>
								</td>
								<td>
								<?php echo $row["nota"];?>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>					
				</form>
			</div>					
	</div>	
	</center>                                
</div>	
<?php include('inc/footer.php');?>
