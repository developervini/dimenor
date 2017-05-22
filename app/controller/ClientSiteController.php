<?php

class ClientSiteController
{
	public static function findClientSite($id = int)
	{
		try {	
			return ClientSite::find($id);
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function listClientSite($id)
	{
		try {	
			return ClientSite::join('site', 'site.id', '=', 'site_id')->where('client_id', $id)->select('site.*')->get();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function newClientSite($data = array())
	{
		try {
			$ClientSite = new ClientSite();
			$ClientSite->client_id = $data['client_id'];
			$ClientSite->site_id = $data['site_id'];
			$ClientSite->save();

			$Site = Site::find($ClientSite->site_id);
			$Client = Client::find($ClientSite->client_id);

			foreach ($data['users'] as $value) {
				ClientSiteUserController::newClientSiteUser(array('client_site_id' => $ClientSite->id, 'username' => $value, 'site' => $Site->site, 'client' => $Client->client, 'client_id' => $Client->id));
			}


			$data = array(
				'msg' => 'Site ' . $Site->site . ' vínculado com sucesso ao cliente ' . $Client->client,
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

	public static function editClientSite($data = array())
	{
		try {
			$ClientSite = ClientSite::find($data['id']);
			$ClientSite->client_id = $data['client_id'];
			$ClientSite->site_id = $data['site_id'];
			$ClientSite->save();

			$Site = Site::find($ClientSite->site_id);
			$Client = Client::find($ClientSite->client_id);

			$data = array(
				'msg' => 'Vínculo do site ' . $Site->site . ' editado com sucesso para o cliente ' . $Client->client,
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

	public static function activeClientSite($id = int)
	{
		try {
			$ClientSite = ClientSite::find($id);
			
			if ($ClientSite->active == 0) {
				$ClientSite->active = 1;
				$msg = 'Vínculo de site removido com sucesso';
			}elseif ($ClientSite->active == 1) {
				$ClientSite->active = 0;
				$msg = 'Vínculo de site ativado com sucesso';
			}

			$ClientSite->save();

			$data = array(
				'msg' => $msg,
				'class' => 'success', 
				'route' => '/clientSite-list'
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