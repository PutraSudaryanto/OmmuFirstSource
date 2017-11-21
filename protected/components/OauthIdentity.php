<?php

/**
 * OauthIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 * version: 1.3.0
 * 
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2012 Ommu Platform (opensource.ommu.co)
 * @link https://github.com/ommu/core
 * @contact (+62)856-299-4114
 *
 */
class OauthIdentity extends OUserIdentity
{
	public $email;
	private $_id;

	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$server = $this->getConnected();
		$url = $server.preg_replace('('.Yii::app()->request->baseUrl.')', '', Yii::app()->createUrl('users/api/oauth/login'));
		
		$item = array(
			'username' => $this->username,
			'password' => $this->password,
			'access' => Yii::app()->params['product_access_system'],
			'ipaddress' => $_SERVER['REMOTE_ADDR'],
		);
		if($this->token != null)
			$item['token'] = $this->token;
		
		$items = http_build_query($item);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($ch,CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $items);
		$output=curl_exec($ch);
		
		if($output === false) {
			$this->errorCode = self::ERROR_USERNAME_INVALID;
			
		} else {
			$object = json_decode($output);
			if($object->success == 1) {
				$user = Users::model()->findByAttributes(array('email'=>$object->email));
				if($user != null)
					$this->setUserSession($user);
				
				else {
					$model=new Users;
					$model->email = $object->email;
					$model->username = $object->username;
					$model->first_name = $object->first_name;
					$model->last_name = $object->last_name;
					$model->displayname = $object->displayname;
					if($model->save()) {
						$user = Users::model()->findByAttributes(array('email'=>$object->email));
						$this->setUserSession($user);				
					}
				}
				$this->errorCode = self::ERROR_NONE;
				
			} else {
				if(preg_match('/@/',$this->username)) //$this->username can filled by username or email
					$record = Users::model()->findByAttributes(array('email' => $this->username));
				else 
					$record = Users::model()->findByAttributes(array('username' => $this->username));
			
				if($record === null)
					$this->errorCode = self::ERROR_USERNAME_INVALID;
				else if($record->password !== Users::hashPassword($record->salt,$this->password))
					$this->errorCode = self::ERROR_PASSWORD_INVALID;
				else {
					$this->setUserSession($record);
					$this->errorCode = self::ERROR_NONE;
				}
			}
		}
		return !$this->errorCode;
	}

	public function getId() {
		return $this->_id;
	}

	//returns true, if domain is availible, false if not
	public function setUserSession($user) 
	{
		$this->_id = $user->user_id;
		$this->setState('level', $user->level_id);
		$this->setState('language', $user->language_id);
		$this->email = $user->email;
		$this->setState('username', $user->username);
		$this->setState('displayname', $user->displayname);
		$this->setState('creation_date', $user->creation_date);
		$this->setState('lastlogin_date', date('Y-m-d H:i:s'));
		
		return true;
	}

	public function getConnected() 
	{
		$connected = strtolower(Yii::app()->request->serverName);
		
		$server = Yii::app()->params['server_options']['oauth'][$connected];
		if(in_array($connected, array('localhost', '127.0.0.1')) && Yii::app()->params['server_options']['status'] == false)
			$server = Yii::app()->params['server_options']['oauth']['default_host'];
		
		return $server;
	}

}