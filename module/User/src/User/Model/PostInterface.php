<?php

namespace User\Model;

interface PostInterface
{
	/**
	 * 返回管理员ID
	 * @return int 
	 */
	public function getId();

	/**
	 * 管理员角色类型
	 * @return int
	 */
	public function getRoleType();

	/**
	 * 管理员名称
	 * @return string
	 */
	public function getName();
}