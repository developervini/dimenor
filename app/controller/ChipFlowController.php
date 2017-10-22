<?php

class ChipFlowController
{
	public static function findChipFlow($id = int)
	{
		try {	
			return ChipFlow::find($id);
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function listChipFlow($id)
	{
		try {	
			return ChipFlow::join('client_site_user as csu', 'csu.id', '=', 'client_site_user_id')->join('client_site as cs', 'cs.id', '=', 'csu.client_site_id')->join('site as s', 's.id', '=', 'cs.site_id')->join('client as c', 'c.id', '=', 'chip_flow.client_id')->join('agreed', 'agreed.id', '=', 'chip_flow.agreed_id')->where('chip_flow.client_id', $id)->selectRaw('chip_flow.*, agreed.agreed as agreed_id, CONCAT(csu.username, " - ", s.site) as client_id')->get();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function newChipFlow($data = array())
	{
		try {
			$ChipFlow = new ChipFlow();
			$ChipFlow->insert($data);

			$data = array(
				'msg' => 'Movimentação de Fichas inserida com sucesso',
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

	public static function editChipFlow($data = array())
	{
		try {
			$ChipFlow = ChipFlow::update($data);

			$data = array(
				'msg' => 'Movimentação de Fichas editada com sucesso',
				'class' => 'success', 
				'route' => '/agreed-view/' . $ChipFlow->id
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