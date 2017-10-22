<?php

class MoneyFlowController
{
	public static function findMoneyFlow($id = int)
	{
		try {	
			return MoneyFlow::find($id);
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function listMoneyFlow($id)
	{
		try {	
			return MoneyFlow::join('client as c', 'c.id', '=', 'money_flow.client_id')->join('bank', 'bank.id', '=', 'money_flow.bank_id')->where('money_flow.client_id', $id)->selectRaw('money_flow.*, bank.bank as bank_id, c.client as client_id')->get();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function newMoneyFlow($data = array())
	{
		try {
			$MoneyFlow = new MoneyFlow();
			$MoneyFlow->insert($data);

			$data = array(
				'msg' => 'Movimentação de R$ inserida com sucesso',
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

	public static function editMoneyFlow($data = array())
	{
		try {
			$MoneyFlow = MoneyFlow::update($data);

			$data = array(
				'msg' => 'Movimentação de R$ editada com sucesso',
				'class' => 'success', 
				'route' => '/agreed-view/' . $MoneyFlow->id
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