<?php

namespace User\Model;

class Post implements PostInterface
{
	/**
	 * 管理员Id
	 * @var int
	 */
	protected $id;

	/**
	 * 管理员名称
	 * @var string
	 */
	protected $name;

	/**
	 * 管理员角色类型编号
	 * @var int
	 */
	protected $roleType;

	public function getId() {
		return $this->id;
	}
	/**
	 * 设置管理员属性
	 * @param int $id 管理员id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getRoleType() {
		return $this->roleType;
	}

	public function setRoleType($roleType) {
		$this->roleType = $roleType;
	}


}