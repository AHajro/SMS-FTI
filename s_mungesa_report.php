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
<script type="text/javascript" src="js/attendance_report.js"></script>
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
			<strong>Raporti i Mungesave</strong>
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<form id="form1" action="" method="post" accept-charset="utf-8">
							<div class="box-footer">
								<button type="button" id="search" name="search" value="search" style="margin-bottom:10px;" class="btn btn-danger btn-sm  checkbox-toggle"><i class="fa fa-search"></i>Shfaq</button> <br>
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
								<th>Pjesemarrja</th>
								<th>Data</th>													
							</tr>
						</thead>
						<tbody>
						<?php 

						$sqlQuery = "SELECT attendance_status, attendance_date, lenda_id, l.subject
                        From sms_pjesemarrja main
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
								<?php
								$attendance = '';
								if($row['attendance_status'] == '1') {
									$attendance = '<small class="label label-success">Prezent</small>';
								} else if($row['attendance_status'] == '3') {
									$attendance = '<small class="label label-danger">Mungese</small>';
								} 
								echo $attendance;?>
								</td>
								<td>
								<?php echo $row["attendance_date"];?>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>					
				</form>
			</div>	
			</div>					
	</div>
</center>	                                
</div>	
<?php include('inc/footer.php');?>
