$(document).ready(function(){	
	$('#search').click(function(){
		$('#studentList').removeClass('hidden');
		$('#saveAttendance').removeClass('hidden');
		if ($.fn.DataTable.isDataTable("#studentList")) {
			$('#studentList').DataTable().clear().destroy();
		}
		var classid = $('#classid').val();
		var degaid = $('#degaid').val();
		var niveliid = $('#niveliid').val();
		var lendaid = $('#lendaid').val();
		
		if(classid) {
			$.ajax({
				url:"action.php",
				method:"POST",
				data:{classid:classid, degaid:degaid, niveliid:niveliid, lendaid:lendaid, action:"attendanceStatusLeksion"},
				success:function(data) {					
					$('#message').text(data).removeClass('hidden');	
				}
			})
			$('#studentList').DataTable({
				"lengthChange": false,
				"processing":true,
				"serverSide":true,
				"order":[],
				"ajax":{
					url:"action.php",
					type:"POST",				
					data:{classid:classid, degaid:degaid, niveliid:niveliid, action:'getStudentsLeksion'},
					dataType:"json"
				},
				"columnDefs":[
					{
						"targets":[0],
						"orderable":false,
					},
				],
				"pageLength": 10
			});				
		}
	});	
	$("#classid").change(function() {		
        $('#att_classid').val($(this).val());		
    });
	$("#lendaid").change(function() {
		$('#att_lendaid').val($(this).val());		
    });
	$("#niveliid").change(function() {
		$('#att_niveliid').val($(this).val());		
    });
	$("#degaid").change(function() {
		$('#att_degaid').val($(this).val());		
    });	
	$("#attendanceForm").submit(function(e) {		
		var formData = $(this).serialize();
		$.ajax({
			url:"action.php",
			method:"POST",
			data:formData,
			success:function(data){				
				$('#message').text(data).removeClass('hidden');				
			}
		});
		return false;
	});	
});