<?php

	/**
	 * 
	 */
	class Pages extends Controller
	{
		
		public function __construct()
		{
		}
		public function index(){

			if(isLoggedIn()){
				redirect('posts');
			}
			$data = [
				'title' => 'Welcome to SharePosts',
				'description' => 'Simple social network built on SoloTech MVC Framework'
			];
			$this->view('pages/index', $data);	
		}
		public function about(){
			$data = [
				'title' => 'Welcome to About Us Page',
				'description' => 'The app is used to display posts and chats from users'
			];
			$this->view('pages/about', $data);
		}
	}
?>