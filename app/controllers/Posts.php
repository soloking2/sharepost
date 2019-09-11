<?php
/**
 * posts controller extending the Core Controller for views 
 */
class Posts extends Controller
{
	
	public function __construct()
	{
		if(!isLoggedIn()){
			redirect('users/login');
		}

		$this->postModel = $this->model('Post');
		$this->userModel = $this->model('User');
	}

	public function index(){
		$posts = $this->postModel->getPosts();
		$data = [
			'posts' => $posts
		];

		$this->view('posts/index', $data);
	}

	public function add(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			//sanitize the post inputs

			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
			'title' => trim($_POST['title']),
			'body' => trim($_POST['body']),
			'user_id' => $_SESSION['user_id'],
			'title_error' => '',
			'body_error' => ''
		];

		//validate the title
		if(empty($data['title'])){
			$data['title_error'] = 'Please enter title';
		}

		//validate body
		if(empty($data['body'])){
			$data['body_error'] = 'Please enter your texts';
		}

		if(empty($data['title_error']) && empty($data['body_error'])){
			if($this->postModel->addPost($data)){
				flash('post_message', 'Post Added');
				redirect('posts');
			} else {
				die('Something went wrong');
			}

		} else {
			//Load view with errors
			$this->view('posts/add', $data);
		}

		} else {

			$data = [
			'title' => '',
			'body' => ''
		];

		$this->view('posts/add', $data);
		}
		
	}

	public function show($id){
		$post = $this->postModel->getPostById($id);
		$user = $this->userModel->getUserById($post->user_id);

		$data = [
			'post' => $post,
			'user' => $user
		];
		$this->view('posts/show', $data);
	}

	//Edit controller
	public function edit($id){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			//sanitize the post inputs

			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
			'id' => $id,
			'title' => trim($_POST['title']),
			'body' => trim($_POST['body']),
			'user_id' => $_SESSION['user_id'],
			'title_error' => '',
			'body_error' => ''
		];

		//validate the title
		if(empty($data['title'])){
			$data['title_error'] = 'Please enter title';
		}

		//validate body
		if(empty($data['body'])){
			$data['body_error'] = 'Please enter your texts';
		}

		if(empty($data['title_error']) && empty($data['body_error'])){
			if($this->postModel->updatePost($data)){
				flash('post_message', 'Post Updated');
				redirect('posts');
			} else { 
				die('Something went wrong');
			}

		} else {
			//Load view with errors
			$this->view('posts/edit', $data);
		}

		} else {
			//Get data from existing model
			$posts = $this->postModel->getPostById($id);

			//Check if the owner
			if($posts->user_id != $_SESSION['user_id']){
				redirect('posts');
			}

			$data = [
			'id' => $posts->id,
			'title' => $posts->title,
			'body' => $posts->body
		];

		$this->view('posts/edit', $data);
		}
		
	}

	public function delete($id){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){

		//Get data from existing model
		$posts = $this->postModel->getPostById($id);

		//Check if the owner
		if($posts->user_id != $_SESSION['user_id']){
			redirect('posts');
		}

		if($this->postModel->deletePost($id)){
			flash('post_message', 'Post Removed');
			redirect('posts');
		} else {
			die('Something went wrong');
		}

		} else{
			redirect('posts');
		}
	}
}


?>