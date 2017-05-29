<?php

class ClientSiteUserController
{
	public static function findClientSiteUser($id = int)
	{
		try {	
			return ClientSiteUser::find($id);
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function listClientSiteUser($id)
	{
		try {	
			return ClientSiteUser::join('client_site', 'client_site.id', '=', 'client_site_id')->where('client_site.client_id', $id)->select('client_site_user.*', 'client_site.site_id as site')->get();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function listClientSiteUserJson($id, $site)
	{
		try {	
			return ClientSiteUser::join('client_site', 'client_site.id', '=', 'client_site_id')->where('client_site.client_id', $id)->where('client_site.site_id', $site)->select('client_site_user.*', 'client_site.site_id as site')->get();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function newClientSiteUser($data = array())
	{
		try {
			$ClientSiteUser = new ClientSiteUser();
			$ClientSiteUser->client_site_id = $data['client_site_id'];
			$ClientSiteUser->username = $data['username'];
			$ClientSiteUser->save();

			$data = array(
				'msg' => 'Usuário ' . $ClientSiteUser->username . ' vínculado ao site ' . $data['site'] . ' do cliente ' . $data['client'] . ' com sucesso',
				'class' => 'success', 
				'route' => '/client-view/' . $data['client_id']
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

	public static function editClientSiteUser($data = array())
	{
		try {
			$ClientSiteUser = ClientSiteUser::find($data['id']);
			$ClientSiteUser->client_id = $data['client_id'];
			$ClientSiteUser->site_id = $data['site_id'];
			$ClientSiteUser->save();

			$Site = Site::find($ClientSiteUser->site_id);
			$Client = Client::find($ClientSiteUser->client_id);

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

	public static function activeClientSiteUser($id = int)
	{
		try {
			$ClientSiteUser = ClientSiteUser::find($id);
			
			if ($ClientSiteUser->active == 0) {
				$ClientSiteUser->active = 1;
				$msg = 'Vínculo de site removido com sucesso';
			}elseif ($ClientSiteUser->active == 1) {
				$ClientSiteUser->active = 0;
				$msg = 'Vínculo de site ativado com sucesso';
			}

			$ClientSiteUser->save();

			$data = array(
				'msg' => $msg,
				'class' => 'success', 
				'route' => '/clientSiteUser-list'
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