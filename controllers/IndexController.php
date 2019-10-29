<?php

class IndexController 
{
	public function actionIndex() 
	{
		$posts = [];
		$posts = Post::getPosts();

		require_once(ROOT . '/views/site/index.php');

		return true;
	}
}