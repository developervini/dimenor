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

	public static function listChipFlow()
	{
		try {	
			return ChipFlow::all();
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