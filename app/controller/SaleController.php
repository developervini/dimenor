<?php

class SaleController
{
	public static function findSale($id = int)
	{
		try {	
			return Sale::find($id);
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function listSale()
	{
		try {	
			return Sale::join('client_site_user as csu', 'csu.id', '=', 'client_site_user_id')->join('client_site as cs', 'cs.id', '=', 'csu.client_site_id')->join('client as c', 'c.id', '=', 'cs.client_id')->select('sale.*', 'c.client')->orderBy('date', 'DESC')->get();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function listSaleChartLine()
	{
		try {	
			return Sale::selectRaw('DAY(date) as label, SUM(total) as data, status')->whereMonth('date', '=',date('m'))->whereYear('date', '=',date('Y'))->groupBy('date')->orderBy('date', 'ASC')->get()->toJson();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function newSale($data = array())
	{
		try {
			$Sale = new Sale();
			$Sale->client_site_user_id = $data['client_site_user_id'];
			$Sale->agreed_id = $data['agreed_id'];
			$Sale->poker_chip = $data['poker_chip'];
			$Sale->poker_chip_value = $data['poker_chip_value'];
			$Sale->poker_chip_total = $data['poker_chip_total'];
			$Sale->pay = $data['pay'];
			$Sale->date = $data['date'];
			$Sale->total = $data['total'];
			$Sale->bank_id = $data['bank_id'];
			$Sale->status = $data['status'];
			$Sale->save();

			$data = array(
				'msg' => 'Venda inserida com sucesso',
				'class' => 'success', 
				'route' => '/sale-list'
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

	public static function editSale($data = array())
	{
		try {
			$Sale = Sale::find($data['id']);
			$Sale->client_site_user_id = $data['client_site_user_id'];
			$Sale->agreed_id = $data['agreed_id'];
			$Sale->poker_chip = $data['poker_chip'];
			$Sale->poker_chip_value = $data['poker_chip_value'];
			$Sale->poker_chip_total = $data['poker_chip_total'];
			$Sale->pay = $data['pay'];
			$Sale->date = $data['date'];
			$Sale->total = $data['total'];
			$Sale->bank_id = $data['bank_id'];
			$Sale->status = $data['status'];
			$Sale->save();

			$data = array(
				'msg' => 'Venda editada com sucesso',
				'class' => 'success', 
				'route' => '/sale-view/' . $Sale->id
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

	public static function activeSale($id = int)
	{
		try {
			$Sale = Sale::find($id);
			
			if ($Sale->active == 0) {
				$Sale->active = 1;
				$msg = 'Venda removida com sucesso';
			}elseif ($Sale->active == 1) {
				$Sale->active = 0;
				$msg = 'Venda ativada com sucesso';
			}

			$Sale->save();

			$data = array(
				'msg' => $msg,
				'class' => 'success', 
				'route' => '/sale-list'
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