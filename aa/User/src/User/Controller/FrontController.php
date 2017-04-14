<?php

namespace User\Controller;

use User\Service\PostServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class FrontController extends AbstractActionController
{
	protected $postService;

	public function __construct(PostServiceInterface $postService =null) {
		$this->postService = $postService;
	}
	public function indexAction() {
		return new ViewModel(array(
			'posts' => $this->postService->findAllPosts(),
		));
	}
}