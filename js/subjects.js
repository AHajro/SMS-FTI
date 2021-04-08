$(document).ready(function(){
	var subjectData = $('#subjectList').DataTable({
		"lengthChange": false,
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"action.php",
			type:"POST",
			data:{action:'listSubject'},
			dataType:"json"
		},
		"columnDefs":[
			{
				"targets":[0, 4, 5],
				"orderable":false,
			},
		],
		"pageLength": 10
	});	

	$('#addSubject').click(function(){
		$('#subjectModal').modal('show');
		$('#subjectForm')[0].reset();		
		$('.modal-title').html("<i class='fa fa-plus'></i>Shto Lende");
		$('#action').val('addSubject');
		$('#save').val('Save');
	});	
	
	$(document).on('submit','#subjectForm', function(event){
		event.preventDefault();
		$('#save').attr('disabled','disabled');
		var formData = $(this).serialize();
		$.ajax({
			url:"action.php",
			method:"POST",
			data:formData,
			success:function(data){				
				$('#subjectForm')[0].reset();
				$('#subjectModal').modal('hide');				
				$('#save').attr('disabled', false);
				subjectData.ajax.reload();
			}
		})
	});	
	
	$(document).on('click', '.update', function(){
		var subjectid = $(this).attr("id");
		var action = 'getSubject';
		$.ajax({
			url:'action.php',
			method:"POST",
			data:{subjectid:subjectid, action:action},
			dataType:"json",
			success:function(data){
				$('#subjectModal').modal('show');
				$('#subjectid').val(data.subject_id);
				$('#subject').val(data.subject);	
				if(data.type == 'Leksion') {
					$('#leksion').prop("checked", true);
				} else if(data.type == 'Seminar') {
					$('#seminar').prop("checked", true);
				}
				$('#niveli').val(data.niveli_id);
				$('#dega').val(data.dega_id);
				$('#viti').val(data.viti_id);
				$('#grupi').val(data.grupi_id);
				$('#pedagogu').val(data.teacher_id);				
				$('.modal-title').html("<i class='fa fa-plus'></i>Modifikoni Lenden");
				$('#action').val('updateSubject');
				$('#save').val('Save');
			}
		})
	});	
	
	$(document).on('click', '.delete', function(){
		var subjectid = $(this).attr("id");		
		var action = "deleteSubject";
		if(confirm("Jeni te sigurt qe deshironi ta fshihni kete lende?")) {
			$.ajax({
				url:"action.php",
				method:"POST",
				data:{subjectid:subjectid, action:action},
				success:function(data) {					
					subjectData.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});	
	
	
	
});