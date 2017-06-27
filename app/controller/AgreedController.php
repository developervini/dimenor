<?php

class AgreedController
{
	public static function findAgreed($id = int)
	{
		try {	
			return Agreed::find($id);
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function listAgreed()
	{
		try {	
			return Agreed::orderBy('agreed', 'ASC')->get();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function newAgreed($data = array())
	{
		try {
			$Agreed = new Agreed();
			$Agreed->agreed = $data['agreed'];
			$Agreed->balance = $data['balance'];
			$Agreed->phone = $data['phone'];
			$Agreed->facebook = $data['facebook'];
			$Agreed->coin_id = 1;
			$Agreed->observation = $data['observation'];
			$Agreed->save();

			$data = array(
				'msg' => 'Conveniado inserido com sucesso',
				'class' => 'success', 
				'route' => '/agreed-list'
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

	public static function editAgreed($data = array())
	{
		try {
			$Agreed = Agreed::find($data['id']);
			$Agreed->agreed = $data['agreed'];
			//$Agreed->balance = $data['balance'];
			$Agreed->phone = $data['phone'];
			$Agreed->facebook = $data['facebook'];
			//$Agreed->coin_id = $data['coin_id'];
			$Agreed->observation = $data['observation'];
			$Agreed->save();

			$data = array(
				'msg' => 'Conveniado editado com sucesso',
				'class' => 'success', 
				'route' => '/agreed-view/' . $Agreed->id
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

	public static function activeAgreed($id = int)
	{
		try {
			$Agreed = Agreed::find($id);
			
			if ($Agreed->active == 0) {
				$Agreed->active = 1;
				$msg = 'Conveniado removido com sucesso';
			}elseif ($Agreed->active == 1) {
				$Agreed->active = 0;
				$msg = 'Conveniado ativado com sucesso';
			}

			$Agreed->save();

			$data = array(
				'msg' => $msg,
				'class' => 'success', 
				'route' => '/agreed-list'
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