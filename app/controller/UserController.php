<?php

class UserController
{
	public static function loginUser($data = array())
	{
		try {	

			return User::where('email', $data['user'])->where('password', md5($data['password']))->where('active', 0)->get()->first();

		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(), 
				'route' => ''
			);

			return $data;
		}
	}

	public static function findUser($id = int)
	{
		try {	
			return User::find($id);
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function listUser()
	{
		try {	
			return User::orderBy('user', 'ASC')->get();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function newUser($data = array())
	{
		try {
			$User = new User();
			$User->user = $data['user'];
			$User->email = $data['email'];
			$User->password = md5($data['password']);
			$User->nomd5password = $data['password'];
			$User->save();

			$data = array(
				'msg' => 'Usuário inserido com sucesso',
				'class' => 'success', 
				'route' => '/user-list'
			);

			return $data;
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function editUser($data = array())
	{
		try {
			$User = User::find($data['id']);
			$User->user = $data['user'];
			$User->email = $data['email'];
			$User->password = md5($data['password']);
			$User->nomd5password = $data['password'];
			$User->save();

			$data = array(
				'msg' => 'Usuário editado com sucesso',
				'class' => 'success', 
				'route' => '/user-view/' . $User->id
			);

			return $data;
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function activeUser($id = int)
	{
		try {
			$User = User::find($id);
			
			if ($User->active == 0) {
				$User->active = 1;
				$msg = 'Usuário removido com sucesso';
			}elseif ($User->active == 1) {
				$User->active = 0;
				$msg = 'Usuário ativado com sucesso';
			}

			$User->save();

			$data = array(
				'msg' => $msg,
				'class' => 'success', 
				'route' => '/user-list'
			);

			return $data;
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}
}