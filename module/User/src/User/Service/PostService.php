<?php

namespace User\Service;

use User\Model\Post;

class PostService implements PostServiceInterface
{
	protected $data = array(
		array(
			'id'         => 1,
			'roleType'   => 2,
			'name'       => '杨飞1',
		),
		array(
			'id'         => 2,
			'roleType'   => 0,
			'name'       => '杨飞2',
		),
		array(
			'id'         => 3,
			'roleType'   => 1,
			'name'       => '杨飞3',
		),
	);
	public function findAllPosts() {
		$allPosts = array();

		foreach ($this->data as $index => $post) {
			$allPosts[] = $this->findPost($index);
		}

		return $allPosts;
	}

	public function findPost($id) {
		$postData = $this->data[$id];

		$model = new Post();
		$model->setId($postData['id']);
		$model->setRoleType($postData['roleType']);
		$model->setName($postData['name']);

		return $model;
	}
}