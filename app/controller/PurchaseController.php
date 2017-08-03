<?php

class PurchaseController
{
	public static function findPurchase($id = int)
	{
		try {
			return Purchase::where('purchase.id', $id)->join('client_site_user as csu', 'csu.id', '=', 'client_site_user_id')->join('client_site as cs', 'cs.id', '=', 'csu.client_site_id')->join('client as c', 'c.id', '=', 'cs.client_id')->select('purchase.*', 'c.client')->first();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error',
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function listPurchase($active = int)
	{
		try {
			return Purchase::join('client_site_user as csu', 'csu.id', '=', 'client_site_user_id')->join('client_site as cs', 'cs.id', '=', 'csu.client_site_id')->join('client as c', 'c.id', '=', 'cs.client_id')->select('purchase.*', 'c.client')->where('purchase.status', $active)->orderBy('date', 'DESC')->get();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error',
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function listPurchaseClient($client = int)
	{
		try {
			return Purchase::join('client_site_user as csu', 'csu.id', '=', 'client_site_user_id')->join('client_site as cs', 'cs.id', '=', 'csu.client_site_id')->join('client as c', 'c.id', '=', 'cs.client_id')->select('purchase.*', 'c.client')->where('c.id', $client)->orderBy('date', 'DESC')->get();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error',
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function getTotalPurchase()
	{
		try {
			return Purchase::selectRaw('SUM(total) as total, bank_id as bank_id')->where('status', 1)->groupBy('bank_id')->get();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error',
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function getTotalPurchaseBank($bank_id = int)
	{
		try {
			return Purchase::selectRaw('SUM(total) as total')->where('bank_id', $bank_id)->where('status', 1)->first();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error',
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function getTotalPurchaseAgreed($agreed_id = int)
	{
		try {
			return Purchase::selectRaw('SUM(poker_chip) as total')->where('agreed_id', $agreed_id)->first();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error',
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function listPurchaseAgreed($agreed_id = int)
	{
		try {
			return Purchase::join('client_site_user as csu', 'csu.id', '=', 'client_site_user_id')->join('client_site as cs', 'cs.id', '=', 'csu.client_site_id')->join('client as c', 'c.id', '=', 'cs.client_id')->select('purchase.*', 'c.client')->where('purchase.agreed_id', $agreed_id)->orderBy('date', 'DESC')->get();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error',
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function listPurchaseBank($bank_id = int)
	{
		try {
			return Purchase::join('client_site_user as csu', 'csu.id', '=', 'client_site_user_id')->join('client_site as cs', 'cs.id', '=', 'csu.client_site_id')->join('client as c', 'c.id', '=', 'cs.client_id')->select('purchase.*', 'c.client')->where('purchase.bank_id', $bank_id)->where('status', 1)->orderBy('date', 'DESC')->get();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error',
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function listPurchaseChartLine()
	{
		try {
			return Purchase::selectRaw('DAY(date) as label, SUM(total) as data, status')->whereMonth('date', '=',date('m'))->whereYear('date', '=',date('Y'))->groupBy('date', 'status')->orderBy('date', 'ASC')->get();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error',
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function newPurchase($data = array())
	{
		try {
			$Purchase = new Purchase();
			$Purchase->client_site_user_id = $data['client_site_user_id'];
			$Purchase->agreed_id = $data['agreed_id'];
			$Purchase->poker_chip = $data['poker_chip'];
			$Purchase->poker_chip_value = $data['poker_chip_value'];
			$Purchase->poker_chip_total = $data['poker_chip_total'];
			$Purchase->pay = $data['pay'];
			$Purchase->date = $data['date'];
			$Purchase->total = $data['total'];
			$Purchase->bank_id = $data['bank_id'];
			if($Purchase->pay == 0){
				$Purchase->status = 1;
			}else{
				$Purchase->status = 0;
			}
			$Purchase->save();

			$data = array(
				'msg' => 'Compra inserida com sucesso',
				'class' => 'success',
				'route' => '/purchase-list/' . $Purchase->status
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

	public static function editPurchase($data = array())
	{
		try {
			$Purchase = Purchase::find($data['id']);
			$Purchase->date = $data['date'];
			$Purchase->total = $data['total'];
			$Purchase->bank_id = $data['bank_id'];
			$Purchase->status = 1;
			$Purchase->save();

			$data = array(
				'msg' => 'Compra finalizada e faturada com sucesso',
				'class' => 'success',
				'route' => '/purchase-list/' . $Purchase->pay
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

	public static function activePurchase($id = int)
	{
		try {
			$Purchase = Purchase::find($id);

			if ($Purchase->active == 0) {
				$Purchase->active = 1;
				$msg = 'Compra removida com sucesso';
			}elseif ($Purchase->active == 1) {
				$Purchase->active = 0;
				$msg = 'Compra ativada com sucesso';
			}

			$Purchase->save();

			$data = array(
				'msg' => $msg,
				'class' => 'success',
				'route' => '/purchase-list'
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

	public static function statusPurchase($id = int)
	{
		try {
			$Purchase = Purchase::find($id);

			if ($Purchase->status == 0) {
				$Purchase->status = 1;
				$msg = 'Compra faturada com sucesso';
			}elseif ($Purchase->status == 1) {
				$Purchase->status = 0;
				$msg = 'Cancelado faturamento de Compra com sucesso';
			}

			$Purchase->save();

			$data = array(
				'msg' => $msg,
				'class' => 'success',
				'route' => '/purchase-list/' . $Purchase->status
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
