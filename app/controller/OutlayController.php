<?php

class OutlayController
{
	public static function findOutlay($id = int)
	{
		try {	
			return Outlay::find($id);
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function listOutlay()
	{
		try {	
			return Outlay::orderBy('date', 'ASC')->get();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function newOutlay($data = array())
	{
		try {
			$Outlay = new Outlay();
			$Outlay->date = $data['date'];
			$Outlay->date_extract = $data['date_extract'];
			$Outlay->outlay = $data['outlay'];
			$Outlay->plan_id = $data['plan_id'];
			$Outlay->total = $data['total'];
			$Outlay->bank_id = $data['bank_id'];
			$Outlay->save();

			$data = array(
				'msg' => 'Fluxo inserido com sucesso',
				'class' => 'success', 
				'route' => '/outlay-list'
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

	public static function editOutlay($data = array())
	{
		try {
			$Outlay = Outlay::find($data['id']);
			$Outlay->date = $data['date'];
			$Outlay->date_extract = $data['date_extract'];
			$Outlay->outlay = $data['outlay'];
			$Outlay->plan_id = $data['plan_id'];
			$Outlay->total = $data['total'];
			$Outlay->bank_id = $data['bank_id'];

			$Outlay->save();

			$data = array(
				'msg' => 'Fluxo editado com sucesso',
				'class' => 'success', 
				'route' => '/outlay-view/' . $Outlay->id
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

	public static function activeOutlay($id = int)
	{
		try {
			$Outlay = Outlay::find($id);
			
			if ($Outlay->active == 0) {
				$Outlay->active = 1;
				$msg = 'Fluxo removido com sucesso';
			}elseif ($Outlay->active == 1) {
				$Outlay->active = 0;
				$msg = 'Fluxo ativado com sucesso';
			}

			$Outlay->save();

			$data = array(
				'msg' => $msg,
				'class' => 'success', 
				'route' => '/outlay-list'
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