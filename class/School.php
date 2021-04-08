<?php
session_start();
require('config.php');
class School extends Dbconfig {	
    protected $hostName;
    protected $userName;
    protected $password;
	protected $dbName;
	private $resultTable = 'sms_rezultat';
	private $userTable = 'sms_user';
	private $studentTable = 'sms_students';
	private $classesTable = 'sms_vitet'; 
	private $sectionsTable = 'sms_grupet';
	private $teacherTable = 'sms_pedagog';
	private $subjectsTable = 'sms_lendet';
	private $attendanceTable = 'sms_pjesemarrja';
	private $niveliTable='sms_niveli';
	private $degaTable='sms_dega';
	public $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 		
			$database = new dbConfig();            
            $this -> hostName = $database -> serverName;
            $this -> userName = $database -> userName;
            $this -> password = $database ->password;
			$this -> dbName = $database -> dbName;			
            $conn = new mysqli($this->hostName, $this->userName, $this->password, $this->dbName);
            if($conn->connect_error){
                die("Gabim ne lidhjen me databazen:  " . $conn->connect_error);
            } else{
                $this->dbConnect = $conn;
            }
        }
	}
	
	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}

	private function getNumRows($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}	


	//////////////////////////// *** FUNKSIONET E LOGIMIT *** /////////////////////////////////////
	public function adminLoginStatus (){
		if(empty($_SESSION["adminUserid"])) {
			header("Location: a_index.php");
		}
	}

	public function adminLogin(){		
		$errorMessage = '';
		if(!empty($_POST["login"]) && $_POST["email"]!=''&& $_POST["password"]!='') {	
			$email = $_POST['email'];
			$password = $_POST['password'];
			$sqlQuery = "SELECT * FROM ".$this->userTable." 
				WHERE email='".$email."' AND password='".md5($password)."' AND status = 'active' AND type = 'administrator'";
			$resultSet = mysqli_query($this->dbConnect, $sqlQuery) or die("error".mysql_error());
			$isValidLogin = mysqli_num_rows($resultSet);	
			if($isValidLogin){
				$userDetails = mysqli_fetch_assoc($resultSet);
				$_SESSION["adminUserid"] = $userDetails['id'];
				$_SESSION["admin"] = $userDetails['first_name']." ".$userDetails['last_name'];
				header("location: a_dashboard.php"); 		
			} else {		
				$errorMessage = "Ju lutem vendosni te dhena te sakta!";		 
			}
		} else if(!empty($_POST["login"])){
			$errorMessage = "Ju lutem vendosni emailin dhe passwordin!";	
		}
		return $errorMessage; 		
	}
	

	/////////// STUDENT /////////
	public function studentLoginStatus (){
		if(empty($_SESSION["studentUserid"])) {
			header("Location: s_index.php");
		}
	}

	public function studentLogin(){		
		$errorMessage = '';
		if(!empty($_POST["login"]) && $_POST["email"]!=''&& $_POST["password"]!='') {	
			$email = $_POST['email'];
			$password = $_POST['password'];
			$sqlQuery = "SELECT * FROM ".$this->studentTable." 
				WHERE email='".$email."' AND password='".md5($password)."' AND status = 'active'";
			$resultSet = mysqli_query($this->dbConnect, $sqlQuery) or die("error".mysql_error());
			$isValidLogin = mysqli_num_rows($resultSet);	
			if($isValidLogin){
				$userDetails = mysqli_fetch_assoc($resultSet);
				$_SESSION["studentUserid"] = $userDetails['id'];
				$_SESSION["student"] = $userDetails['name']." ".$userDetails['mbiemri'];
				header("location: s_dashboard.php"); 		
			} else {		
				$errorMessage = "Ju lutem vendosni te dhena te sakta!";		 
			}
		} else if(!empty($_POST["login"])){
			$errorMessage = "Ju lutem vendosni emailin dhe passwordin!";	
		}
		return $errorMessage; 		
	}	


	/////////////////////////////// PEDAGOG ///////////////////
	public function pedagogLoginStatus (){
		if(empty($_SESSION["pedagogUserid"])) {
			header("Location: p_index.php");
		}
	}

	public function pedagogLogin(){		
		$errorMessage = '';
		if(!empty($_POST["login"]) && $_POST["email"]!=''&& $_POST["password"]!='') {	
			$email = $_POST['email'];
			$password = $_POST['password'];
			$sqlQuery = "SELECT * FROM ".$this->teacherTable." 
				WHERE email='".$email."' AND password='".md5($password)."' AND status = 'active'";
			$resultSet = mysqli_query($this->dbConnect, $sqlQuery) or die("error".mysql_error());
			$isValidLogin = mysqli_num_rows($resultSet);	
			if($isValidLogin){
				$userDetails = mysqli_fetch_assoc($resultSet);
				$_SESSION["pedagogUserid"] = $userDetails['teacher_id'];
				$_SESSION["pedagog"] = $userDetails['teacher']." ".$userDetails['mbiemri'];
				header("location: p_dashboard.php"); 		
			} else {		
				$errorMessage = "Ju lutem vendosni te dhena te sakta!";		 
			}
		} else if(!empty($_POST["login"])){
			$errorMessage = "Ju lutem vendosni emailin dhe passwordin!";	
		}
		return $errorMessage; 		
	}
	

	/////////////////////////////////////*** VITET  ***////////////////////////////////////////
	
	public function classList(){		
		$sqlQuery = "SELECT * FROM ".$this->classesTable;	
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$classHTML = '';
		while( $class = mysqli_fetch_assoc($result)) {
			$classHTML .= '<option value="'.$class["id"].'">'.$class["name"].'</option>';	
		}
		return $classHTML;
	}


	////////////////////////////***STUDENTI ***//////////////////////////////
	public function listStudent(){		
		$sqlQuery = "SELECT s.id, s.name, s.mbiemri, n.niveli, d.dega, c.name as class, p.section 
		FROM ".$this->studentTable." as s
		JOIN ".$this->sectionsTable." as p ON s.section = p.section_id
		JOIN ".$this->niveliTable." as n ON s.niveli = n.niveli_id
		JOIN ".$this->degaTable." as d ON s.dega = d.id_dega
		JOIN ".$this->classesTable." as c ON s.class = c.id";
	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$studentData = array();	
		while( $student = mysqli_fetch_assoc($result) ) {		
			$studentRows = array();			
			$studentRows[] = $student['id'];
			$studentRows[] = $student['name'];
			$studentRows[] = $student['mbiemri'];
			$studentRows[] = $student['niveli'];	
			$studentRows[] = $student['dega'];
			$studentRows[] = $student['class'];
			$studentRows[] = $student['section'];		
			$studentRows[] = '<button type="button" name="update" id="'.$student["id"].'" class="btn btn-info btn-xs update">Modifiko</button>';
			$studentRows[] = '<button type="button" name="delete" id="'.$student["id"].'" class="btn btn-danger btn-xs delete" >Fshi</button>';
			$studentData[] = $studentRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$studentData
		);
		echo json_encode($output);
	}

	public function addStudent () {
		if($_POST["sname"]) {								
			$insertQuery = "INSERT INTO ".$this->studentTable."(name, mbiemri, email, father_name,  class, section,  admission_date, dob,  password, status, niveli, dega) 
				VALUES ('".$_POST["sname"]."', '".$_POST["mbiemri"]."', '".$_POST["email"]."',  '".$_POST["fname"]."', '".$_POST["classid"]."', '".$_POST["sectionid"]."', '".$_POST["admission_date"]."', '".$_POST["dob"]."', '".md5($_POST["password"])."', 'active', '".$_POST["niveliid"]."', '".$_POST["degaid"]."')";
			$userSaved = mysqli_query($this->dbConnect, $insertQuery);
		}
	}

	public function getStudentDetails(){
		$sqlQuery = "SELECT id, name, mbiemri, email, father_name,  class, section,  admission_date, dob, niveli, dega
			FROM ".$this->studentTable."
			WHERE id = '".$_POST["studentid"]."'";		
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		echo json_encode($row);
	}

	public function updateStudent() {
		if($_POST['studentid']) {	

			$updateQuery = "UPDATE ".$this->studentTable." 
			SET name = '".$_POST["sname"]."', mbiemri = '".$_POST["mbiemri"]."', email = '".$_POST["email"]."', father_name = '".$_POST["fname"]."', class = '".$_POST["classid"]."', section = '".$_POST["sectionid"]."', admission_date = '".$_POST["admission_date"]."', dob = '".$_POST["dob"]."', niveli = '".$_POST["niveliid"]."', dega = '".$_POST["degaid"]."'
			WHERE id ='".$_POST["studentid"]."'";
			echo $updateQuery;
			$isUpdated = mysqli_query($this->dbConnect, $updateQuery);		
		}	
	}

	public function deleteStudent(){
		if($_POST["studentid"]) {
			$sqlUpdate = "
				DELETE FROM ".$this->studentTable."
				WHERE id = '".$_POST["studentid"]."'";		
			mysqli_query($this->dbConnect, $sqlUpdate);		
		}
	}


	//////////////////////////***GRUPET ***//////////////////////////////
	public function getSectionList(){		
		$sqlQuery = "SELECT * FROM ".$this->sectionsTable;	
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$sectionHTML = '';
		while( $section = mysqli_fetch_assoc($result)) {
			$sectionHTML .= '<option value="'.$section["section_id"].'">'.$section["section"].'</option>';	
		}
		return $sectionHTML;
	}


	/////////////////////////***PEDAGOGU ***////////////////////////////////////////////
	public function listTeacher(){		
		$sqlQuery = "SELECT teacher_id, teacher, mbiemri, titulli, email			
			FROM ".$this->teacherTable." ";
		
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$teacherData = array();	
		while( $teacher = mysqli_fetch_assoc($result) ) {		
			$teacherRows = array();			
			$teacherRows[] = $teacher['teacher_id'];
			$teacherRows[] = $teacher['teacher'];
			$teacherRows[] = $teacher['mbiemri'];
			$teacherRows[] = $teacher['titulli'];	
			$teacherRows[] = $teacher['email'];				
			$teacherRows[] = '<button type="button" name="update" id="'.$teacher["teacher_id"].'" class="btn btn-info btn-xs update">Modifiko</button>';
			$teacherRows[] = '<button type="button" name="delete" id="'.$teacher["teacher_id"].'" class="btn btn-danger btn-xs delete" >Fshi</button>';
			$teacherData[] = $teacherRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$teacherData
		);
		echo json_encode($output);
	}

	public function addTeacher () {
		if($_POST["teacher_name"]) {
			$insertQuery = "INSERT INTO ".$this->teacherTable."(teacher, mbiemri, email, password, status, titulli) 
				VALUES ('".$_POST["teacher_name"]."', '".$_POST["mbiemri"]."', '".$_POST['email']."', '".md5($_POST["password"])."', 'active', '".$_POST['titulli']."')";
			$userSaved = mysqli_query($this->dbConnect, $insertQuery);
		}
	}

	public function getTeacher(){
		$sqlQuery = "
			SELECT * FROM ".$this->teacherTable." 
			WHERE teacher_id = '".$_POST["teacherid"]."'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		echo json_encode($row);
	}

	public function updateTeacher() {
		if($_POST['teacherid']) {	
			$updateQuery = "UPDATE ".$this->teacherTable." 
			SET teacher = '".$_POST["teacher_name"]."', mbiemri = '".$_POST["mbiemri"]."', email = '".$_POST['email']."', titulli = '".$_POST['titulli']."'
			WHERE teacher_id ='".$_POST["teacherid"]."'";
			$isUpdated = mysqli_query($this->dbConnect, $updateQuery);		
		}	
	}	

	public function deleteTeacher(){
		if($_POST["teacherid"]) {
			$sqlUpdate = "
				DELETE FROM ".$this->teacherTable."
				WHERE teacher_id = '".$_POST["teacherid"]."'";		
			mysqli_query($this->dbConnect, $sqlUpdate);		
		}
	}


	//////////////////////////////***LENDET ***//////////////////////////////////////
	public function listSubject(){		
		$sqlQuery = "SELECT s.subject_id, s.subject, s.type, s.grupi_id, n.niveli, d.dega, p.teacher, c.name as class
		FROM ".$this->subjectsTable." as s
		JOIN ".$this->teacherTable." as p ON s.teacher_id = p.teacher_id
		JOIN ".$this->niveliTable." as n ON s.niveli_id = n.niveli_id
		JOIN ".$this->degaTable." as d ON s.dega_id = d.id_dega
		JOIN ".$this->classesTable." as c ON s.class_id = c.id";

		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		$subjectData = array();	
		while( $subject = mysqli_fetch_assoc($result) ) {		
			$subjectRows = array();			
			$subjectRows[] = $subject['subject_id'];
			$subjectRows[] = $subject['subject'];	
			$subjectRows[] = $subject['teacher'];
			$subjectRows[] = $subject['niveli'];	
			$subjectRows[] = $subject['dega'];
			$subjectRows[] = $subject['class'];
			$subjectRows[] = $subject['grupi_id'];
			$subjectRows[] = $subject['type'];				
			$subjectRows[] = '<button type="button" name="update" id="'.$subject["subject_id"].'" class="btn btn-info btn-xs update">Modifiko</button>';
			$subjectRows[] = '<button type="button" name="delete" id="'.$subject["subject_id"].'" class="btn btn-danger btn-xs delete" >Fshi</button>';
			$subjectData[] = $subjectRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$subjectData
		);
		echo json_encode($output);
	}

	public function addSubject () {
		if($_POST["subject"]) {
			$insertQuery = "INSERT INTO ".$this->subjectsTable."(subject, type, teacher_id, niveli_id, dega_id, class_id, grupi_id) 
				VALUES ('".$_POST["subject"]."', '".$_POST["s_type"]."', '".$_POST["pedagogu"]."' , '".$_POST["niveli"]."' , '".$_POST["dega"]."', '".$_POST["viti"]."', '".$_POST["grupi"]."')";
			
				$userSaved = mysqli_query($this->dbConnect, $insertQuery);
		}
	}

	public function getSubject(){
		$sqlQuery = "SELECT * FROM ".$this->subjectsTable." 
			WHERE subject_id = '".$_POST["subjectid"]."'";

		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

		echo json_encode($row);
	}

	public function updateSubject() {
		if($_POST['subjectid']) {	
			$updateQuery = "UPDATE ".$this->subjectsTable." 
			SET subject = '".$_POST["subject"]."', type = '".$_POST["s_type"]."', teacher_id = '".$_POST["pedagogu"]."' , niveli_id = '".$_POST["niveli"]."' , dega_id = '".$_POST["dega"]."', viti_id = '".$_POST["viti"]."', grupi_id = '".$_POST["grupi"]."'
			WHERE subject_id ='".$_POST["subjectid"]."'";

			$isUpdated = mysqli_query($this->dbConnect, $updateQuery);		
		}	
	}

	public function deleteSubject(){
		if($_POST["subjectid"]) {
			$sqlUpdate = "
				DELETE FROM ".$this->subjectsTable."
				WHERE subject_id = '".$_POST["subjectid"]."'";

			mysqli_query($this->dbConnect, $sqlUpdate);		
		}
	}

	public function getTeacherList(){		
		$sqlQuery = "SELECT * FROM ".$this->teacherTable;	
		$result = mysqli_query($this->dbConnect, $sqlQuery);

		$teacherHTML = '';
		while( $teacher = mysqli_fetch_assoc($result)) {
			$teacherHTML .= '<option value="'.$teacher["teacher_id"].'">'.$teacher["teacher"].'</option>';	
		}
		return $teacherHTML;
	}


	///////////////////////////////***VLERESIET ***/////////////////////////////////////
	public function getStudents(){		
			$sqlQuery = "SELECT id, name, mbiemri, class, section FROM ".$this->studentTable." 
				WHERE class = '".$_POST["classid"]."' AND section='".$_POST["sectionid"]."'";

			$result = mysqli_query($this->dbConnect, $sqlQuery);
			$numRows = mysqli_num_rows($result);
			
			$studentData = array();	
			
			while($student = mysqli_fetch_assoc($result) ) {	
						
				$studentRows = array();			
				$studentRows[] = $student['name'];
				$studentRows[] = $student['mbiemri'];	
				$studentRows[] = '
				<input type="radio" id="attendencetype1_'.$student['id'].'" value="1" name="attendencetype_'.$student['id'].'" autocomplete="off">
				<label for="attendencetype_'.$student['id'].'">Prezent</label>
				<input type="radio" id="attendencetype3_'.$student['id'].'" value="3" name="attendencetype_'.$student['id'].'" autocomplete="off">
				<label for="attendencetype3_'.$student['id'].'">Mungese</label>';					
				$studentRows[] = '<input type="text" id="seminarKoment'.$student['id'].'" value="Komenti Juaj"  name="seminarKoment'.$student['id'].'" autocomplete="off">';                     
				$studentData[] = $studentRows;
			}
			
			$output = array(
				"draw"				=>	intval($_POST["draw"]),
				"recordsTotal"  	=>  $numRows,
				"recordsFiltered" 	=> 	$numRows,
				"data"    			=> 	$studentData
			);
			echo json_encode($output);

	}

	public function getStudentsLeksion(){		
			$sqlQuery = "SELECT id, name, mbiemri, niveli, dega, class	FROM ".$this->studentTable." 
			WHERE  class='".$_POST["classid"]."' AND dega='".$_POST["degaid"]."' AND niveli='".$_POST["niveliid"]."'";	

			$result = mysqli_query($this->dbConnect, $sqlQuery);
			$numRows = mysqli_num_rows($result);
			
			$studentData = array();	
			
			while($student = mysqli_fetch_assoc($result) ) {	
				$studentRows = array();			
				$studentRows[] = $student['name'];
				$studentRows[] = $student['mbiemri'];				
				$studentRows[] = '<input type="text" id="leksionKoment'.$student['id'].'" value="Komenti juaj"  name="leksionKoment'.$student['id'].'" autocomplete="off">';                     
				$studentData[] = $studentRows;
			}
			
			$output = array(
				"draw"				=>	intval($_POST["draw"]),
				"recordsTotal"  	=>  $numRows,
				"recordsFiltered" 	=> 	$numRows,
				"data"    			=> 	$studentData
			);
			echo json_encode($output);
	}
	
	public function getStudentsLab(){		
			$sqlQuery = "SELECT s.id, s.name, s.mbiemri, s.niveli, s.dega, s.class, s.section, a.lab_points, a.lenda_id 
			FROM ".$this->studentTable." as s
			JOIN ".$this->resultTable." as a ON s.id = a.student_id
			WHERE s.section='".$_POST["sectionid"]."' AND s.class='".$_POST["classid"]."' AND s.dega='".$_POST["degaid"]."' AND s.niveli='".$_POST["niveliid"]."' AND a.lenda_id='".$_POST["lendaid"]."'";
		
			$result = mysqli_query($this->dbConnect, $sqlQuery);
			$numRows = mysqli_num_rows($result);
			
			$studentData = array();	
			
			while($student = mysqli_fetch_assoc($result) ) {	
			
				$studentRows = array();			
				$studentRows[] = $student['name'];
				$studentRows[] = $student['mbiemri'];
				$studentRows[] = $student['lab_points'];		
				$studentRows[] = '<input type="number" id="piketLab'.$student['id'].'" value="test"  name="piketLab'.$student['id'].'" autocomplete="off">';                     				
				$studentRows[] = '<input type="text" id="labKoment'.$student['id'].'" value="Komenti Juaj"  name="labKoment'.$student['id'].'" autocomplete="off">';                     
				$studentData[] = $studentRows;
			}
			
			$output = array(
				"draw"				=>	intval($_POST["draw"]),
				"recordsTotal"  	=>  $numRows,
				"recordsFiltered" 	=> 	$numRows,
				"data"    			=> 	$studentData
			);
			echo json_encode($output);
	}

	public function getStudentsDetyra(){		
			$sqlQuery = "SELECT s.id, s.name, s.mbiemri, s.niveli, s.dega, s.class, s.section, a.detyra_points, a.lenda_id 
			FROM ".$this->studentTable." as s
			JOIN ".$this->resultTable." as a ON s.id = a.student_id
			WHERE s.class = '".$_POST["classid"]."' AND s.section='".$_POST["sectionid"]."' AND s.dega='".$_POST["degaid"]."' AND s.niveli='".$_POST["niveliid"]."' AND a.lenda_id='".$_POST["lendaid"]."'";

			$result = mysqli_query($this->dbConnect, $sqlQuery);
			$numRows = mysqli_num_rows($result);
			
			$studentData = array();	
			
			while($student = mysqli_fetch_assoc($result) ) {	
			
				$studentRows = array();			
				$studentRows[] = $student['name'];
				$studentRows[] = $student['mbiemri'];
				$studentRows[] = $student['detyra_points'];		
				$studentRows[] = '<input type="number" id="piketDetyra'.$student['id'].'" value="test"  name="piketDetyra'.$student['id'].'" autocomplete="off">';                     				
				$studentRows[] = '<input type="text" id="detyraKoment'.$student['id'].'" value="Komenti juaj"  name="detyraKoment'.$student['id'].'" autocomplete="off">';                     
				$studentData[] = $studentRows;
			}
			
			$output = array(
				"draw"				=>	intval($_POST["draw"]),
				"recordsTotal"  	=>  $numRows,
				"recordsFiltered" 	=> 	$numRows,
				"data"    			=> 	$studentData
			);
			echo json_encode($output);
	}

	public function getStudentsProvim(){		
			$sqlQuery = "SELECT s.id, s.name, s.mbiemri, s.niveli, s.dega, s.class, s.section, a.lab_points, a.detyra_points, a.provim_points, a.lenda_id
				FROM ".$this->studentTable." as s
				JOIN ".$this->resultTable." as a ON s.id = a.student_id
				WHERE s.class = '".$_POST["classid"]."' AND s.dega='".$_POST["degaid"]."' AND s.niveli='".$_POST["niveliid"]."' AND a.lab_points!=0 AND a.detyra_points!=0 AND a.lenda_id='".$_POST["lendaid"]."'";

			$result = mysqli_query($this->dbConnect, $sqlQuery);
			$numRows = mysqli_num_rows($result);
			
			$studentData = array();	
			
			while($student = mysqli_fetch_assoc($result) ) {		
				$studentRows = array();			
				$studentRows[] = $student['name'];
				$studentRows[] = $student['mbiemri'];
				$studentRows[] = $student['provim_points'];
				$studentRows[] = '<input type="number" id="piketProvim'.$student['id'].'" value="test"  name="piketProvim'.$student['id'].'" autocomplete="off">';                     								
				$studentRows[] = '<input type="text" id="provimKoment'.$student['id'].'" value="Komenti juaj"  name="provimKoment'.$student['id'].'" autocomplete="off">';                     
				$studentData[] = $studentRows;
			}
			
			$output = array(
				"draw"				=>	intval($_POST["draw"]),
				"recordsTotal"  	=>  $numRows,
				"recordsFiltered" 	=> 	$numRows,
				"data"    			=> 	$studentData
			);
			echo json_encode($output);		
	}

	public function getStudentsPerfundimtare(){		
		$sqlQuery = "SELECT s.id, s.name, s.mbiemri, s.niveli, s.dega, s.class, s.section, a.lab_points, a.detyra_points, a.provim_points, a.lenda_id
			FROM ".$this->studentTable." as s
			JOIN ".$this->resultTable." as a ON s.id = a.student_id
			WHERE a.lenda_id = '".$_POST["lendaid"]."' AND s.class = '".$_POST["classid"]."' AND s.section='".$_POST["sectionid"]."' AND s.dega='".$_POST["degaid"]."' AND s.niveli='".$_POST["niveliid"]."'";

		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$numRows = mysqli_num_rows($result);
		
		$studentData = array();	
		
		while($student = mysqli_fetch_assoc($result) ) {		
			$studentRows = array();			
			$studentRows[] = $student['name'];
			$studentRows[] = $student['mbiemri'];
			$studentRows[] = $student['lab_points'];
			$studentRows[] = $student['detyra_points'];
			$studentRows[] = $student['provim_points'];
			$studentRows[] = '<input type="number" id="nota'.$student['id'].'" value="test"  name="nota'.$student['id'].'" autocomplete="off">';                     								
			$studentData[] = $studentRows;
		}
		
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$studentData
		);
		echo json_encode($output);		
}


	public function updateAttendance(){	
		$attendanceYear = date('Y'); 
		$attendanceMonth = date('m'); 
		$attendanceDay = date('d'); 
		$attendanceDate = $attendanceYear."/".$attendanceMonth."/".$attendanceDay;

		$sqlQuery = "SELECT * FROM ".$this->attendanceTable." 
			WHERE class_id = '".$_POST["att_classid"]."'  AND niveli_id = '".$_POST["att_niveliid"]."' AND dega_id = '".$_POST["att_degaid"]."' AND lenda_id = '".$_POST["att_lendaid"]."' AND attendance_date = '".$attendanceDate."'";	

			$updateMessage='';
			$insertMessage='';

			foreach($_POST as $key => $value) {				
				if (strpos($key, "attendencetype_") !== false) {
					$student_id = str_replace("attendencetype_","", $key);
					$attendanceStatus = $value;					
					if($student_id) {
						$sqlQuery .= " AND student_id = '".$student_id."'";
						$result = mysqli_query($this->dbConnect, $sqlQuery);	
						$resultDone = mysqli_num_rows($result);

						if($resultDone){
						$updateQuery = "UPDATE ".$this->attendanceTable." SET attendance_status = '".$attendanceStatus."'
						WHERE student_id = '".$student_id."' AND class_id = '".$_POST["att_classid"]."' AND section_id = '".$_POST["att_sectionid"]."' AND niveli_id = '".$_POST["att_niveliid"]."' AND dega_id = '".$_POST["att_degaid"]."' AND lenda_id = '".$_POST["att_lendaid"]."' AND attendance_date = '".$attendanceDate."'";	
						mysqli_query($this->dbConnect, $updateQuery);
						$updateMessage='Raporti u perditsua me sukses!';
						}
						else{
							$insertQuery = "INSERT INTO ".$this->attendanceTable."(student_id, class_id, section_id, niveli_id, dega_id, lenda_id,attendance_status, attendance_date) 
							VALUES ('".$student_id."', '".$_POST["att_classid"]."', '".$_POST["att_sectionid"]."', '".$_POST["att_niveliid"]."', '".$_POST["att_degaid"]."', '".$_POST["att_lendaid"]."', '".$attendanceStatus."', '".$attendanceDate."')";
							mysqli_query($this->dbConnect, $insertQuery);
							$insertMessage='Raporti u plotesua me sukses!';	
						}
					}
				}	
				 if (strpos($key, "seminarKoment") !== false) {
					$student_id = str_replace("seminarKoment","", $key);
					$attendancekoment = $value;					
					if($student_id) {
						$sqlQuery .= " AND student_id = '".$student_id."'";
						$result = mysqli_query($this->dbConnect, $sqlQuery);	
						$resultDone = mysqli_num_rows($result);

						if($resultDone){
						$updateQuery = "UPDATE ".$this->attendanceTable." SET seminar_comment = '".$attendancekoment."'
						WHERE student_id = '".$student_id."' AND class_id = '".$_POST["att_classid"]."' AND section_id = '".$_POST["att_sectionid"]."' AND niveli_id = '".$_POST["att_niveliid"]."' AND dega_id = '".$_POST["att_degaid"]."' AND lenda_id = '".$_POST["att_lendaid"]."' AND attendance_date = '".$attendanceDate."'";	
						mysqli_query($this->dbConnect, $updateQuery);
						$updateMessage='Raporti u perditsua me sukses!';
						}
						else{
							$insertQuery = "INSERT INTO ".$this->attendanceTable."(student_id, class_id, section_id, niveli_id, dega_id, lenda_id, seminar_comment, attendance_date) 
							VALUES ('".$student_id."', '".$_POST["att_classid"]."', '".$_POST["att_sectionid"]."',  '".$_POST["att_niveliid"]."', '".$_POST["att_degaid"]."', '".$_POST["att_lendaid"]."', '".$attendancekoment."', '".$attendanceDate."')";
							mysqli_query($this->dbConnect, $insertQuery);
							$insertMessage='Raporti u plotesua me sukses!';		
						}
					}
				}								
			}
			if($updateMessage){
				echo $updateMessage;
			}
			else if($insertMessage){
				echo $insertMessage;
			}			 
	}

	public function updateAttendanceLeksion(){	
		$attendanceYear = date('Y'); 
		$attendanceMonth = date('m'); 
		$attendanceDay = date('d'); 
		$attendanceDate = $attendanceYear."/".$attendanceMonth."/".$attendanceDay;

		$sqlQuery = "SELECT * FROM ".$this->attendanceTable." 
			WHERE class_id = '".$_POST["att_classid"]."'  AND niveli_id = '".$_POST["att_niveliid"]."' AND dega_id = '".$_POST["att_degaid"]."' AND lenda_id = '".$_POST["att_lendaid"]."' AND attendance_date = '".$attendanceDate."'";	

			$updateMessage='';
			$insertMessage='';

			foreach($_POST as $key => $value) {					
				 if (strpos($key, "leksionKoment") !== false) {
					$student_id = str_replace("leksionKoment","", $key);
					$attendancekoment = $value;
	
					if($student_id) {
						$sqlQuery .= " AND student_id = '".$student_id."'";
						$result = mysqli_query($this->dbConnect, $sqlQuery);	
						$resultDone = mysqli_num_rows($result);

						if($resultDone){
						$updateQuery = "UPDATE ".$this->attendanceTable." SET leksion_comment = '".$attendancekoment."'
						WHERE student_id = '".$student_id."' AND class_id = '".$_POST["att_classid"]."' AND section_id = '".$_POST["att_sectionid"]."' AND niveli_id = '".$_POST["att_niveliid"]."' AND dega_id = '".$_POST["att_degaid"]."' AND lenda_id = '".$_POST["att_lendaid"]."' AND attendance_date = '".$attendanceDate."'";	
						mysqli_query($this->dbConnect, $updateQuery);
						$updateMessage='Raporti u perditsua me sukses!';
						}
						else{
						$insertQuery = "INSERT INTO ".$this->attendanceTable."(student_id, class_id, section_id, niveli_id, dega_id, lenda_id, leksion_comment, attendance_date) 
						VALUES ('".$student_id."', '".$_POST["att_classid"]."', '".$_POST["att_sectionid"]."',  '".$_POST["att_niveliid"]."', '".$_POST["att_degaid"]."', '".$_POST["att_lendaid"]."', '".$attendancekoment."', '".$attendanceDate."')";
						mysqli_query($this->dbConnect, $insertQuery);
						$insertMessage='Raporti u plotesua me sukses!';	
						}
					}
				}								
			}
			if($updateMessage){
				echo $updateMessage;
			}
			else if($insertMessage){
				echo $insertMessage;
			}		
	}

	public function attendanceStatusLeksion(){	
		$attendanceYear = date('Y'); 
		$attendanceMonth = date('m'); 
		$attendanceDay = date('d'); 
		$attendanceDate = $attendanceYear."/".$attendanceMonth."/".$attendanceDay;	

		$sqlQuery = "SELECT * FROM ".$this->attendanceTable." 
			WHERE attendance_date = '".$attendanceDate."' AND class_id = '".$_POST["classid"]."'  AND niveli_id = '".$_POST["niveliid"]."' AND dega_id = '".$_POST["degaid"]."' AND lenda_id = '".$_POST["lendaid"]."'";	
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$attendanceDone = mysqli_num_rows($result);
		if($attendanceDone) {
			echo "Kujdes! Ju e keni plotesuar raportin per sot!";
		} 
	}

	public function attendanceStatusSeminar(){	
		$attendanceYear = date('Y'); 
		$attendanceMonth = date('m'); 
		$attendanceDay = date('d'); 
		$attendanceDate = $attendanceYear."/".$attendanceMonth."/".$attendanceDay;	

		if($attendanceDate){
		$sqlQuery = "SELECT * FROM ".$this->attendanceTable." 
			WHERE attendance_date = '".$attendanceDate."' AND section_id='".$_POST["sectionid"]."' AND class_id = '".$_POST["classid"]."'  AND niveli_id = '".$_POST["niveliid"]."' AND dega_id = '".$_POST["degaid"]."' AND lenda_id = '".$_POST["lendaid"]."'";	
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$attendanceDone = mysqli_num_rows($result);
		if($attendanceDone) {
			echo "Kujdes! Ju e keni plotesuar raportin per sot!";
		}
	} 
	}


	public function updateVleresim(){	
		$sqlQuery = "SELECT * FROM ".$this->resultTable." WHERE  lenda_id = '".$_POST["att_lendaid"]."'";
		
		$updateMessage='';
		$insertMessage='';
	
			foreach($_POST as $key => $value) {				
				 if (strpos($key, "piketLab") !== false) {
					$student_id = str_replace("piketLab","", $key);
					$attendancepiket = $value;					
					if($student_id) {
						$sqlQuery .= " AND student_id = '".$student_id."'";
						$result = mysqli_query($this->dbConnect, $sqlQuery);	
						$resultDone = mysqli_num_rows($result);

							if($resultDone){
							$updateQuery = "UPDATE ".$this->resultTable." SET lab_points = lab_points + '".$attendancepiket."'
							WHERE student_id = '".$student_id."'";
							mysqli_query($this->dbConnect, $updateQuery);
							$updateMessage='Raporti u perditsua me sukses!';
							}
							else{
								$insertQuery = "INSERT INTO ".$this->resultTable."(student_id, lenda_id, lab_points) 
								VALUES ('".$student_id."', '".$_POST["att_lendaid"]."', '".$attendancepiket."')";
								mysqli_query($this->dbConnect, $insertQuery);
								$insertMessage='Raporti u plotesua me sukses!';		
							}
					}
				}
				if (strpos($key, "labKoment") !== false) {
					$student_id = str_replace("labKoment","", $key);
					$attendancepiket = $value;					
					if($student_id) {
						$sqlQuery .= " AND student_id = '".$student_id."'";
						$result = mysqli_query($this->dbConnect, $sqlQuery);	
						$resultDone = mysqli_num_rows($result);

							if($resultDone){
							$updateQuery = "UPDATE ".$this->resultTable." SET lab_comment ='".$attendancepiket."'
							WHERE student_id = '".$student_id."'";
							mysqli_query($this->dbConnect, $updateQuery);
							$updateMessage='Raporti u perditsua me sukses!';
							}
							else{
								$insertQuery = "INSERT INTO ".$this->resultTable."(student_id, lenda_id, lab_comment) 
								VALUES ('".$student_id."', '".$_POST["att_lendaid"]."', '".$attendancepiket."')";
								mysqli_query($this->dbConnect, $insertQuery);
								$insertMessage='Raporti u plotesua me sukses!';		
							}
					}
				}
				if (strpos($key, "piketDetyra") !== false) {
					$student_id = str_replace("piketDetyra","", $key);
					$piketDetyra = $value;					
					if($student_id) {
						$sqlQuery .= " AND student_id = '".$student_id."'";
						$result = mysqli_query($this->dbConnect, $sqlQuery);	
						$resultDone = mysqli_num_rows($result);

							if($resultDone){
							$updateQuery = "UPDATE ".$this->resultTable." SET detyra_points = detyra_points + '".$piketDetyra."'
							WHERE student_id = '".$student_id."'  AND lenda_id = '".$_POST["att_lendaid"]."'";
							mysqli_query($this->dbConnect, $updateQuery);
							$updateMessage='Raporti u perditsua me sukses!';
							}
							else{
							$insertQuery = "INSERT INTO ".$this->resultTable."(student_id, lenda_id, detyra_points) 
							VALUES ('".$student_id."', '".$_POST["att_lendaid"]."','".$piketDetyra."')";
							mysqli_query($this->dbConnect, $insertQuery);
							$insertMessage='Raporti u plotesua me sukses!';			
							}
					}
				}
				if (strpos($key, "detyraKoment") !== false) {
					$student_id = str_replace("detyraKoment","", $key);
					$attendancepiket = $value;					
					if($student_id) {
						$sqlQuery .= " AND student_id = '".$student_id."'";
						$result = mysqli_query($this->dbConnect, $sqlQuery);	
						$resultDone = mysqli_num_rows($result);

							if($resultDone){
							$updateQuery = "UPDATE ".$this->resultTable." SET detyra_comment ='".$attendancepiket."'
							WHERE student_id = '".$student_id."'";
							mysqli_query($this->dbConnect, $updateQuery);
							$updateMessage='Raporti u perditsua me sukses!';
							}
							else{
								$insertQuery = "INSERT INTO ".$this->resultTable."(student_id, lenda_id, detyra_comment) 
								VALUES ('".$student_id."', '".$_POST["att_lendaid"]."', '".$attendancepiket."')";
								mysqli_query($this->dbConnect, $insertQuery);
								$insertMessage='Raporti u plotesua me sukses!';		
							}
					}
				}
				if (strpos($key, "piketProvim") !== false) {
					$student_id = str_replace("piketProvim","", $key);
					$piketProvim = $value;					
					if($student_id) {

						$sqlQuery .= " AND student_id = '".$student_id."'";
						$result = mysqli_query($this->dbConnect, $sqlQuery);	
						$resultDone = mysqli_num_rows($result);

							if($resultDone){
							$updateQuery = "UPDATE ".$this->resultTable." SET provim_points = provim_points + '".$piketProvim."'
							WHERE student_id = '".$student_id."'";
							mysqli_query($this->dbConnect, $updateQuery);
							$updateMessage='Raporti u perditsua me sukses!';
							}
							else{
							$insertQuery = "INSERT INTO ".$this->resultTable."(student_id, lenda_id, provim_points) 
							VALUES ('".$student_id."', '".$_POST["att_lendaid"]."','".$piketProvim."')";
							mysqli_query($this->dbConnect, $insertQuery);
							$insertMessage='Raporti u plotesua me sukses!';	
							}
					}
				}
				if (strpos($key, "provimKoment") !== false) {
					$student_id = str_replace("provimKoment","", $key);
					$attendancepiket = $value;					
					if($student_id) {
						$sqlQuery .= " AND student_id = '".$student_id."'";
						$result = mysqli_query($this->dbConnect, $sqlQuery);	
						$resultDone = mysqli_num_rows($result);

							if($resultDone){
							$updateQuery = "UPDATE ".$this->resultTable." SET provim_comment ='".$attendancepiket."'
							WHERE student_id = '".$student_id."'";
							mysqli_query($this->dbConnect, $updateQuery);
							$updateMessage='Raporti u perditsua me sukses!';
							}
							else{
								$insertQuery = "INSERT INTO ".$this->resultTable."(student_id, lenda_id, provim_comment) 
								VALUES ('".$student_id."', '".$_POST["att_lendaid"]."', '".$attendancepiket."')";
								mysqli_query($this->dbConnect, $insertQuery);
								$insertMessage='Raporti u plotesua me sukses!';		
							}
					}
				}
				if (strpos($key, "nota") !== false) {
					$student_id = str_replace("nota","", $key);
					$nota = $value;					
					if($student_id) {
						$sqlQuery .= " AND student_id = '".$student_id."' AND lenda_id = '".$_POST["att_lendaid"]."'";
						$result = mysqli_query($this->dbConnect, $sqlQuery);	
						$resultDone = mysqli_num_rows($result);

							if($resultDone){
						$updateQuery = "UPDATE ".$this->resultTable." SET nota = '".$nota."'
						WHERE student_id = '".$student_id."' AND lenda_id = '".$_POST["att_lendaid"]."'";
						mysqli_query($this->dbConnect, $updateQuery);
						$updateMessage='Raporti u perditsua me sukses!';
							}
							else{
								$insertQuery = "INSERT INTO ".$this->resultTable."(student_id, lenda_id, nota) 
								VALUES ('".$student_id."', '".$_POST["att_lendaid"]."','".$nota."')";
								mysqli_query($this->dbConnect, $insertQuery);
								$insertMessage='Raporti u plotesua me sukses!';			
							}
					}
				}								
			}	
			if($updateMessage){
				echo $updateMessage;
			}
			else if($insertMessage){
				echo $insertMessage;
			}			
	}

	public function getDegaList(){
		$sqlQuery = "SELECT * FROM ".$this->degaTable;	
		$result = mysqli_query($this->dbConnect, $sqlQuery);

		$degaHTML = '';
		while( $dega = mysqli_fetch_assoc($result)) { 
			$degaHTML .= '<option value="'.$dega["id_dega"].'">'.$dega["dega"].'</option>';	
		}
		return $degaHTML;
	}

	public function getNiveliList(){
		$sqlQuery = "SELECT * FROM ".$this->niveliTable;	
		$result = mysqli_query($this->dbConnect, $sqlQuery);

		$niveliHTML = '';
		while( $niveli = mysqli_fetch_assoc($result)) {
			$niveliHTML .= '<option value="'.$niveli["niveli_id"].'">'.$niveli["niveli"].'</option>';	
		}
		return $niveliHTML;
	}

	public function getPedagoguList(){
		$sqlQuery = "SELECT * FROM ".$this->teacherTable;	
		$result = mysqli_query($this->dbConnect, $sqlQuery);

		$pedagoguHTML = '';
		while( $pedagogu = mysqli_fetch_assoc($result)) {
			$pedagoguHTML .= '<option value="'.$pedagogu["teacher_id"].'">'.$pedagogu["teacher"].'</option>';	
		}
		return $pedagoguHTML;
	}

	public function getLendaList(){
		$sqlQuery = "SELECT * FROM sms_lendet WHERE teacher_id='".$_SESSION["pedagogUserid"]."'" ;	
		$result = mysqli_query($this->dbConnect, $sqlQuery);

		$niveliHTML = '';
		while( $lenda = mysqli_fetch_assoc($result)) {
			$lendaHTML .= '<option value="'.$lenda["subject_id"].'">'.$lenda["subject"].'</option>';	
		}
		return $lendaHTML;
	}


	/////////////////////////***VLERESIMET RAPORT ***//////////////////////////////////////
	public function editAccountAdmin () {
		$message = '';
		$updatePassword = '';
		if(!empty($_POST["passwd"]) && $_POST["passwd"] != '' && $_POST["passwd"] != $_POST["cpasswd"]) {
			$message = "Password-et nuk jane te njejte!";
		} else if(!empty($_POST["passwd"]) && $_POST["passwd"] != '' && $_POST["passwd"] == $_POST["cpasswd"]) {
			$updatePassword = " password='".md5($_POST["passwd"])."' ";
		}		
		$updateQuery = "UPDATE ".$this->userTable." 
		SET $updatePassword WHERE id ='".$_SESSION["adminUserid"]."'";

		$isUpdated = mysqli_query($this->dbConnect, $updateQuery);	

		if($isUpdated) {
			$message = "Te dhenat u ruajten me sukses!";
		}
		return $message;
	}

	public function userDetailsAdmin () {
		$sqlQuery = "SELECT * FROM ".$this->userTable." 
			WHERE id ='".$_SESSION["adminUserid"]."'";

		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$userDetails = mysqli_fetch_assoc($result);
		return $userDetails;
	}
	

	/////////////////////////////////***FUNKSIONET PER USERIN ***///////////////////////////////
	public function editAccountStudent () {
		$message = '';
		$updatePassword = '';
		if(!empty($_POST["passwd"]) && $_POST["passwd"] != '' && $_POST["passwd"] != $_POST["cpasswd"]) {
			$message = "Password-et nuk jane te njejte!";
		} else if(!empty($_POST["passwd"]) && $_POST["passwd"] != '' && $_POST["passwd"] == $_POST["cpasswd"]) {
			$updatePassword = " password='".md5($_POST["passwd"])."' ";
		}		
		$updateQuery = "UPDATE ".$this->studentTable." 
		SET $updatePassword WHERE id ='".$_SESSION["studentUserid"]."'";

		$isUpdated = mysqli_query($this->dbConnect, $updateQuery);	

		if($isUpdated) {
			$message = "Te dhenat u ruajten me sukses!";
		}
		return $message;
	}

	public function userDetailsStudent () {
		$sqlQuery = "SELECT * FROM ".$this->studentTable." 
			WHERE id ='".$_SESSION["studentUserid"]."'";

		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$userDetails = mysqli_fetch_assoc($result);
		return $userDetails;
	}
	
	public function editAccountPedagog () {
		$message = '';
		$updatePassword = '';
		if(!empty($_POST["passwd"]) && $_POST["passwd"] != '' && $_POST["passwd"] != $_POST["cpasswd"]) {
			$message = "Password-et nuk jane te njejte!";
		} else if(!empty($_POST["passwd"]) && $_POST["passwd"] != '' && $_POST["passwd"] == $_POST["cpasswd"]) {
			$updatePassword = " password='".md5($_POST["passwd"])."' ";
		}		
		$updateQuery = "UPDATE ".$this->teacherTable." 
		SET $updatePassword WHERE teacher_id ='".$_SESSION["pedagogUserid"]."'";

		$isUpdated = mysqli_query($this->dbConnect, $updateQuery);	

		if($isUpdated) {
			$message = "Te dhenat u ruajten me sukses!";
		}
		return $message;
	}

	public function userDetailsPedagog () {
		$sqlQuery = "SELECT * FROM ".$this->teacherTable." 
			WHERE teacher_id ='".$_SESSION["pedagogUserid"]."'";

		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$userDetails = mysqli_fetch_assoc($result);
		return $userDetails;
	}	


	public function addUserStudent($sname, $mbiemri, $email, $password) {
		if($_POST["email"]) {
			$insertQuery = "INSERT INTO ".$this->userTable."(first_name, last_name, email, password, type, status) 
				VALUES ('".$_POST["sname"]."', '".$_POST["mbiemri"]."', '".$_POST["email"]."', '".md5($_POST["password"])."', 'student', 'active')";
			
				$userSaved = mysqli_query($this->dbConnect, $insertQuery);
		}
	}

	public function addUserPedagog($teacher_name, $mbiemri, $email, $password) {
		if($_POST["email"]) {
			$insertQuery = "INSERT INTO ".$this->userTable."(first_name, last_name, email, password, type, status) 
				VALUES ('".$_POST["teacher_name"]."', '".$_POST["mbiemri"]."', '".$_POST["email"]."', '".md5($_POST["password"])."', 'pedagog', 'active')";
			
				$userSaved = mysqli_query($this->dbConnect, $insertQuery);
		}
	}
}
?>