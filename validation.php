<?php
require('config/config.php');
require('model/functions.fn.php');
session_start();

if(	isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && 
	!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	if(isEmailAvailable($db, $email)){
		if(isUsernameAvailable($db, $username)){
			userRegistration($db, $username, $email, $password);
			header('Location: login.php');
		}else{
			$_SESSION['message'] = 'Le nom d\'utilisateur est déjà utilisé.';
			header('Location: register.php');
		}
	}else{
		$_SESSION['message'] = 'L\'email est déjà associé à un compte.';
		header('Location: register.php');
	}
}else{ 
	$_SESSION['message'] = 'Erreur : Formulaire incomplet';
	header('Location: register.php');
}