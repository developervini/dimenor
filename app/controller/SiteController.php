<?php

class SiteController
{
	public static function findSite($id = int)
	{
		try {	
			return Site::find($id);
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function listSite()
	{
		try {	
			return Site::orderBy('site', 'ASC')->get();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function newSite($data = array())
	{
		try {
			$Site = new Site();
			$Site->site = $data['site'];
			$Site->address = $data['address'];
			$Site->observation = $data['observation'];
			$Site->save();

			$data = array(
				'msg' => 'Site inserido com sucesso',
				'class' => 'success', 
				'route' => '/site-list'
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

	public static function editSite($data = array())
	{
		try {
			$Site = Site::find($data['id']);
			$Site->site = $data['site'];
			$Site->address = $data['address'];
			$Site->observation = $data['observation'];
			$Site->save();

			$data = array(
				'msg' => 'Site editado com sucesso',
				'class' => 'success', 
				'route' => '/site-view/' . $Site->id
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

	public static function activeSite($id = int)
	{
		try {
			$Site = Site::find($id);
			
			if ($Site->active == 0) {
				$Site->active = 1;
				$msg = 'Site removido com sucesso';
			}elseif ($Site->active == 1) {
				$Site->active = 0;
				$msg = 'Site ativado com sucesso';
			}

			$Site->save();

			$data = array(
				'msg' => $msg,
				'class' => 'success', 
				'route' => '/site-list'
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