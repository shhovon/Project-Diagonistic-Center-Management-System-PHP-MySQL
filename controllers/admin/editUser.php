<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function hasEmptyStr($strings)
{
	$n = count($strings);
	for ($i = 0; $i < $n; ++$i) {
		if ($strings[$i] == "") {
			return true;
		}
	}
	return false;
}

if (isset($_POST['editUser'])) {
	$id = $_POST['id'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$name = $_POST['name'];
	$gender = $_POST['gender'];
	$dateOfBirth = $_POST['dateOfBirth'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];
	$role = $_POST['role'];

	if (hasEmptyStr([$username, $email, $gender])) {
		echo 'Invalid input';
		return;
	}

	require_once('../../repository/UserRepo.php');

	$status = saveUserEdits(array('id' => $id, 'username' => $username, 'email' => $email, 'name' => $name, 'role' => $role, 'gender' => $gender, 'dateOfBirth' => $dateOfBirth, 'address' => $address, 'phone' => $phone)); //usernameUnavailable=-1, //emailAlreadyExists=0, //infoNotChanged=-2 saveSuccessfully=1

	switch ($status) {
		case -2:
			header('location: ../../views/dashboard');
			return;
			break;
		case -1:
			echo 'Username already in use';
			return;
			break;
		case 0:
			echo 'Email already in use';
			return;
			break;
		case 1:
			header('location: ../../views/dashboard');
			return;
			break;
		default:
			break;
	}
	echo 'Adding user Error';
	return;
}

echo 'Submit error';
