<?php
include('class/School.php');
$school = new School();

if(!empty($_POST['action']) && $_POST['action'] == 'listStudent') {
	$school->listStudent();
}
if(!empty($_POST['action']) && $_POST['action'] == 'addStudent') {
	$school->addStudent();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getStudentDetails') {
	$school->getStudentDetails();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateStudent') {
	$school->updateStudent();
}
if(!empty($_POST['action']) && $_POST['action'] == 'deleteStudent') {
	$school->deleteStudent();
}


if(!empty($_POST['action']) && $_POST['action'] == 'listTeacher') {
	$school->listTeacher();
}
if(!empty($_POST['action']) && $_POST['action'] == 'addTeacher') {
	$school->addTeacher();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getTeacher') {
	$school->getTeacher();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateTeacher') {
	$school->updateTeacher();
}
if(!empty($_POST['action']) && $_POST['action'] == 'deleteTeacher') {
	$school->deleteTeacher();
}


if(!empty($_POST['action']) && $_POST['action'] == 'listSubject') {
	$school->listSubject();
}
if(!empty($_POST['action']) && $_POST['action'] == 'addSubject') {
	$school->addSubject();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getSubject') {
	$school->getSubject();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateSubject') {
	$school->updateSubject();
}
if(!empty($_POST['action']) && $_POST['action'] == 'deleteSubject') {
	$school->deleteSubject();
}


if(!empty($_POST['action']) && $_POST['action'] == 'getStudents') {
	$school->getStudents();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getStudentsLeksion') {
	$school->getStudentsLeksion();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getStudentsLab') {
	$school->getStudentsLab();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getStudentsDetyra') {
	$school->getStudentsDetyra();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getStudentsProvim') {
	$school->getStudentsProvim();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getStudentsPerfundimtare') {
	$school->getStudentsPerfundimtare();
}

if(!empty($_POST['action']) && $_POST['action'] == 'updateAttendance') {
	$school->updateAttendance();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateAttendanceLeksion') {
	$school->updateAttendanceLeksion();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateVleresim') {
	$school->updateVleresim();
}

if(!empty($_POST['action']) && $_POST['action'] == 'attendanceStatusLeksion') {
	$school->attendanceStatusLeksion();
}
if(!empty($_POST['action']) && $_POST['action'] == 'attendanceStatusSeminar') {
	$school->attendanceStatusSeminar();
}

?>