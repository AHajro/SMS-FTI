$(document).ready(function(){
	var studentData = $('#studentList').DataTable({
		"lengthChange": false,
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"action.php",
			type:"POST",
			data:{action:'listStudent'},
			dataType:"json"
		},
		"columnDefs":[
			{
				"targets":[0, 7, 8],
				"orderable":false,
			},
		],
		"pageLength": 10
	});	

	$('#addStudent').click(function(){
		$('#studentModal').modal('show');
		$('#studentForm')[0].reset();		
		$('.modal-title').html("<i class='fa fa-plus'></i> Shtimi i Studenteve");
		$('#action').val('addStudent');
		$('#save').val('Save');
	});	
	
	$(document).on('submit','#studentForm', function(event){
		event.preventDefault();
		$('#save').attr('disabled','disabled');		
		$.ajax({
			url:"action.php",
			method:"POST",
			data: new FormData(this),
			processData: false,
			contentType: false,
			success:function(data){				
				$('#studentForm')[0].reset();
				$('#studentModal').modal('hide');				
				$('#save').attr('disabled', false);
				studentData.ajax.reload();
			}
		})
	});	
	
	$(document).on('click', '.update', function(){
		var studentid = $(this).attr("id");
		var action = 'getStudentDetails';
		$.ajax({
			url:'action.php',
			method:"POST",
			data:{studentid:studentid, action:action},
			dataType:"json",
			success:function(data){
				$('#studentModal').modal('show');
				$('#studentid').val(data.id);
				$('#sname').val(data.name);
				$('#dob').val(data.dob);
				$('#admission_date').val(data.admission_date);
				$('#classid').val(data.class);
				$('#sectionid').val(data.section);
				$('#email').val(data.email);
				$('#fname').val(data.father_name);
				$('#mbiemri').val(data.mbiemri);
				$('#niveliid').val(data.niveli);
				$('#degaid').val(data.dega);
				
				$('.modal-title').html("<i class='fa fa-plus'></i> Modifikimi i Studenteve");
				$('#action').val('updateStudent');
				$('#save').val('Save');
			}
		})
	});	
	
	$(document).on('click', '.delete', function(){
		var studentid = $(this).attr("id");		
		var action = "deleteStudent";
		if(confirm("Jeni te sigurt qe deshironi ta fshihni kete Student?")) {
			$.ajax({
				url:"action.php",
				method:"POST",
				data:{studentid:studentid, action:action},
				success:function(data) {					
					studentData.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});	
	
	
	
});