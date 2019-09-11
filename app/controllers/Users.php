<?php
/**
 * 
 */
class Users extends Controller
{
	
	function __construct()
	{
		$this->userModel = $this->model('User');
	}

	public function register(){
		//check for post
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			//Process the form

			//sanitize the POST data sent
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			//Check Errors
			$data = [
				'name' => trim($_POST['name']),
				'email' => trim($_POST['email']),
				'password' => trim($_POST['password']),
				'confirm_password' => trim($_POST['confirm_password']),
				'name_error' => '',
				'email_error' => '',
				'password_error' => '',
				'confirm_password_error' => ''
			];

			//Validate Email
			if(empty($data['email'])){
				$data['email_error'] = 'Please enter an email';
			} else {
				//check email
				if($this->userModel->findUserByEmail($data['email'])){
					$data['email_error'] = 'Email is already taken';
				}
			}

			//Validate Name
			if(empty($data['name'])){
				$data['name_error'] = 'Please enter a name';
			}

			//Validate password
			if(empty($data['password'])){
				$data['password_error'] = 'Please enter a password';
			} elseif (strlen($data['password']) < 6) {
				$data['password_error'] = 'Password must be more than six characters';
			}
			//Validate confirm password
			if(empty($data['confirm_password'])){
				$data['confirm_password_error'] = 'Please enter confirm your password';
			} else {
				if($data['password'] != $data['confirm_password']){
				$data['confirm_password_error'] = 'Passwords do not match';
			}
			}

			//Make sure errors are empty

			if(empty($data['email_error']) && empty($data['name_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])){
				

				//Hash password
				$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

				//Register the user
				if($this->userModel->register($data)){
					flash('register_success', 'You are registered and can log in');
					redirect('users/login');
				} else{
					die('Something went wrong');
				}
			} else{
				//Load the view with errors
				$this->view('users/register', $data);
			}
			

		}else {
			//Init data
			$data = [
				'name' => '',
				'email' => '',
				'password' => '',
				'confirm_password' => '',
				'name_error' => '',
				'email_error' => '',
				'password_error' => '',
				'confirm_password_error' => ''
			];

			$this->view('users/register', $data);
		}
	}

	public function login(){
		//check for post
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			//Process the form

			//Sanitize the post data
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				'email' => trim($_POST['email']),
				'password' => trim($_POST['password']),
				'email_error' => '',
				'password_error' => ''
			];

			//Validate email
			if(empty($data['email'])){
				$data['email_error'] = 'Please enter an email';
			}

			//validate password
			if(empty($data['password'])){
				$data['password_error'] = 'Please enter your password';
			}

			//check for user/email
			if($this->userModel->findUserByEmail($data['email'])){
				//User found
			} else {
				//User not found
				$data['email_error'] = 'No user found';
			}

			if(empty($data['email_error']) && empty($data['password_error'])){
				//checl and set Logged in user
				$loggedin = $this->userModel->login($data['email'], $data['password']);
				if($loggedin){
					//Create Session
					$this->createUserSession($loggedin);

				} else {
					$data['password_error'] = 'Password Incorrect';

					$this->view('users/login', $data);
				}

			} else {
				//Load the view with errors
				$this->view('users/login', $data);
			}


		}else {
			//Init data
			$data = [
				'email' => '',
				'password' => '',
				'email_error' => '',
				'password_error' => ''
			];

			$this->view('users/login', $data);
		}
	}

	public function createUserSession($user){
		$_SESSION['user_id'] = $user->id;
		$_SESSION['user_email'] = $user->email;
		$_SESSION['user_name'] = $user->name;
		redirect('posts');
	}

	public function logout(){
		unset($_SESSION['user_id']);
		unset($_SESSION['user_email']);
		unset($_SESSION['user_name']);
		session_destroy();
		redirect('users/login');
	}
}

?>