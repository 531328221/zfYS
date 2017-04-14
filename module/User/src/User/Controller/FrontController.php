<?php

namespace User\Controller;

use User\Service\PostServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class FrontController extends AbstractActionController
{
	protected $postService;

	public function __construct(PostServiceInterface $postService =null) {
		//验证登录
		//获取权限
		$this->postService = $postService;
	}
	public function indexAction() {
		
		return new ViewModel(array(
			'posts' => $this->postService->findAllPosts(),
		));

		//return $this->redirect()->toRoute('user/login');
	}

	public function loginsAction() {

	}

	/*登录界面*/
	public function loginAction() {
		if($this->getServiceLocator()->get('frontHelper')->getUserSession('user_id') != '') {
			return $this->redirect()->toRoute('mobile/userInfo');
		}

		$this->layout()->title_name = '会员登录';//$this->getYSlang()->translate('会员登录');

		$array = array();

		/*是否开启邮箱登录*/
		$userEmailLoginState = false;
		$array['user_email_state'] = $userEmailLoginState;

		/*是否开启手机号登录*/
		$userPhoneLoginSate = false;
		$array['user_phone_state'] = $userPhoneLoginSate;

		if($this->request->isPost()) {
			$userArray = $this->request->getPost()->toArray();
			$httpReferer = $userArray['http_referer'];
			unset($userArray['http_referer']);
			unset($userArray['captcha_code']);

			//服务器端数据校验
			$userValidate = new FormUserValidate('cn');//$this->getYSLang()
			$userValidate->checkUserForm($this->request->getPost(), 'login');
		} 
	}

	/*异步登录逻辑处理，返回*/
	public function loginAjaxAction() {

	}
}