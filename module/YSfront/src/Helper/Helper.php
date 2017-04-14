<?php


namespace YSfront\Helper;
use Zend\Session\Container;
use Zend\View\Helper\AbstractHelper;

class Helper extends AbstractHelper
{
	private $userSession;

	public function __contruct() {
		if(empty($this->userSession)) {
			$this->userSession = new Container('user_info');
		}
	}

	/**
	 * 获取当前域名
	 */
	public function YSHttpHost() {
		$httpHost = $_SERVER['HTTP_HOST'];
		return $httpHost;
	}

	/*-------------------会员登录-------------------*/

	/**
	 * 设置会员登录session
	 * @param $array
	 */
	public function setUserSession($userInfo) {
		if(is_array($userInfo) && !empty($userInfo)) {
			foreach ($userInfo as $key => $val) {
				$this->userSession->$key = $val;
			}
		}
	}

	public function getUserSession($key) {
		return (isset($this->userSession->$key) ? $this->userSession->$key : '');
	}
	/*-----------------会员登录end---------------------*/
}