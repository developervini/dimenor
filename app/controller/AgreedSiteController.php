<?php

class AgreedSiteController
{
	public static function findAgreedSite($id = int)
	{
		try {	
			return AgreedSite::find($id);
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function listAgreedSite($id)
	{
		try {	
			return AgreedSite::join('site', 'site.id', '=', 'site_id')->where('agreed_id', $id)->select('site.*')->get();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function newAgreedSite($data = array())
	{
		try {
			$AgreedSite = new AgreedSite();
			$AgreedSite->agreed_id = $data['agreed_id'];
			$AgreedSite->site_id = $data['site_id'];
			$AgreedSite->save();

			$Site = Site::find($AgreedSite->site_id);
			$Agreed = Agreed::find($AgreedSite->agreed_id);

			$data = array(
				'msg' => 'Site ' . $Site->site . ' vínculado com sucesso ao conveniado ' . $Agreed->agreed,
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

	public static function editAgreedSite($data = array())
	{
		try {
			$AgreedSite = AgreedSite::find($data['id']);
			$AgreedSite->agreed_id = $data['agreed_id'];
			$AgreedSite->site_id = $data['site_id'];
			$AgreedSite->save();

			$Site = Site::find($AgreedSite->site_id);
			$Agreed = Agreed::find($AgreedSite->Agreed_id);

			$data = array(
				'msg' => 'Vínculo do site ' . $Site->site . ' editado com sucesso para o conveniado ' . $Agreed->Agreed,
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

	public static function activeAgreedSite($id = int)
	{
		try {
			$AgreedSite = AgreedSite::find($id);
			
			if ($AgreedSite->active == 0) {
				$AgreedSite->active = 1;
				$msg = 'Vínculo de site removido com sucesso';
			}elseif ($AgreedSite->active == 1) {
				$AgreedSite->active = 0;
				$msg = 'Vínculo de site ativado com sucesso';
			}

			$AgreedSite->save();

			$data = array(
				'msg' => $msg,
				'class' => 'success', 
				'route' => '/agreed-site-list'
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