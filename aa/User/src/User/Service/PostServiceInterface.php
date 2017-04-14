<?php
namespace User\Service;

use User\Model\PostInterface;

interface PostServiceInterface
{
	public function findAllPosts();

	public function findPost($id);

	
}