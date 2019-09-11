<?php
//Simple Page redirect

function redirect($page){
	header('Location: '. URLROOT . '/' . $page);
}


?>