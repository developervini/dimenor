<?php

class ClientController
{
	public static function findClient($id = int)
	{
		try {	
			return Client::find($id);
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function listClient()
	{
		try {	
			return Client::orderBy('client', 'ASC')->get();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function newClient($data = array())
	{
		try {
			$Client = new Client();
			$Client->client = $data['client'];
			$Client->phone = $data['phone'];
			$Client->facebook = $data['facebook'];
			$Client->observation = $data['observation'];
			$Client->save();

			$data = array(
				'msg' => 'Cliente inserido com sucesso',
				'class' => 'success', 
				'route' => '/client-list'
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

	public static function editClient($data = array())
	{
		try {
			$Client = Client::find($data['id']);
			$Client->client = $data['client'];
			$Client->phone = $data['phone'];
			$Client->facebook = $data['facebook'];
			$Client->observation = $data['observation'];
			$Client->save();

			$data = array(
				'msg' => 'Cliente editado com sucesso',
				'class' => 'success', 
				'route' => '/client-view/' . $Client->id
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

	public static function activeClient($id = int)
	{
		try {
			$Client = Client::find($id);
			
			if ($Client->active == 0) {
				$Client->active = 1;
				$msg = 'Cliente removido com sucesso';
			}elseif ($Client->active == 1) {
				$Client->active = 0;
				$msg = 'Cliente ativado com sucesso';
			}

			$Client->save();

			$data = array(
				'msg' => $msg,
				'class' => 'success', 
				'route' => '/client-list'
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