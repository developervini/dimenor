<?php

class SaleController
{
	public static function findSale($id = int)
	{
		try {
			return Sale::where('sale.id', $id)->leftJoin('agreed as a', 'a.id', '=', 'returned_agreed_id')->join('client_site_user as csu', 'csu.id', '=', 'client_site_user_id')->join('client_site as cs', 'cs.id', '=', 'csu.client_site_id')->join('client as c', 'c.id', '=', 'cs.client_id')->join('site as s', 's.id', '=', 'cs.site_id')->select('sale.*', 'c.client', 's.site', 'csu.username', 'a.agreed')->first();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error',
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function listSale($active = int)
	{
		try {
			return Sale::join('client_site_user as csu', 'csu.id', '=', 'client_site_user_id')->join('client_site as cs', 'cs.id', '=', 'csu.client_site_id')->join('client as c', 'c.id', '=', 'cs.client_id')->select('sale.*', 'c.client')->where('sale.status', $active)->orderBy('date', 'DESC')->get();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error',
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function listSaleClient($client = int)
	{
		try {
			return Sale::join('client_site_user as csu', 'csu.id', '=', 'client_site_user_id')->join('client_site as cs', 'cs.id', '=', 'csu.client_site_id')->join('client as c', 'c.id', '=', 'cs.client_id')->select('sale.*', 'c.client')->where('c.id', $client)->orderBy('date', 'DESC')->get();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error',
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function getTotalSale()
	{
		try {
			return Sale::selectRaw('SUM(total) as total, bank_id as bank_id')->where('status', 1)->groupBy('bank_id')->get();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error',
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function getTotalSaleBank($bank_id = int)
	{
		try {
			return Sale::selectRaw('SUM(total) as total')->where('bank_id', $bank_id)->where('status', 1)->first();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error',
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function getTotalSaleAgreed($agreed_id = int)
	{
		try {
			return Sale::selectRaw('SUM(poker_chip) as total')->where('agreed_id', $agreed_id)->first();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error',
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function listSaleAgreed($agreed_id = int)
	{
		try {
			return Sale::join('client_site_user as csu', 'csu.id', '=', 'client_site_user_id')->join('client_site as cs', 'cs.id', '=', 'csu.client_site_id')->join('client as c', 'c.id', '=', 'cs.client_id')->select('sale.*', 'c.client')->where('sale.agreed_id', $agreed_id)->orWhere('sale.returned_agreed_id', $agreed_id)->orderBy('date', 'DESC')->get();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error',
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function listSaleBank($bank_id = int)
	{
		try {
			return Sale::join('client_site_user as csu', 'csu.id', '=', 'client_site_user_id')->join('client_site as cs', 'cs.id', '=', 'csu.client_site_id')->join('client as c', 'c.id', '=', 'cs.client_id')->select('sale.*', 'c.client')->where('sale.bank_id', $bank_id)->where('status', 1)->orderBy('date', 'DESC')->get();
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
			return Sale::selectRaw('DAY(date) as label, SUM(total) as data, status')->whereMonth('date', '=',date('m'))->whereYear('date', '=',date('Y'))->groupBy('date', 'status')->orderBy('date', 'ASC')->get();
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
			if($Sale->pay == 0){
				$Sale->status = 1;
			}else{
				$Sale->status = 0;
			}
			$Sale->save();

			if($Sale->pay == 0){
				$PortionSale = new PortionSale();
				$PortionSale->date = $data['date'];
				$PortionSale->portion = $data['total'];
				$PortionSale->bank_id = $data['bank_id'];
				$PortionSale->sale_id = $Sale->id;
				$PortionSale->save();

				$PortionSaleTotal = PortionSaleController::getTotalPortionSale($Sale->id);

				if($PortionSaleTotal->total >= $Sale->poker_chip_total){
					$Sale->date = $data['date'];
					$Sale->total = $PortionSaleTotal->total;
					$Sale->save();

					$data = array(
						'msg' => 'Venda inserida e faturada com sucesso',
						'class' => 'success',
						'route' => '/sale-list/' . $Sale->status
					);
				}

			}else {
				$data = array(
					'msg' => 'Venda inserida com sucesso',
					'class' => 'success',
					'route' => '/sale-list/' . $Sale->status
				);
			}

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
			$PortionSale = new PortionSale();
			$PortionSale->date = $data['date'];
			$PortionSale->portion = $data['total'];
			$PortionSale->bank_id = $data['bank_id'];
			$PortionSale->sale_id = $data['id'];
			$PortionSale->save();
			$PortionSaleTotal = PortionSaleController::getTotalPortionSale($Sale->id);

			if($PortionSaleTotal->total >= $Sale->poker_chip_total){
				$Sale->date = $data['date'];
				$Sale->total = $PortionSaleTotal->total;
				$Sale->status = 1;
				$Sale->save();

				$data = array(
					'msg' => 'Venda finalizada e faturada com sucesso',
					'class' => 'success',
					'route' => '/sale-list/' . $Sale->status
				);
			}else {
				$data = array(
					'msg' => 'Parcela inserida com sucesso',
					'class' => 'success',
					'route' => '/sale-list/' . $Sale->status
				);
			}

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

	public static function devolveSale($data = array())
	{
		try {
			$Sale = Sale::find($data['id']);
			$Sale->returned_agreed_id = $data['returned_agreed_id'];
			$Sale->returned_poker_chip = $data['returned_poker_chip'];
			$Sale->returned_date = $data['returned_date'];
			$Sale->status = 2;
			$Sale->save();

			$data = array(
				'msg' => 'Venda devolvida com sucesso',
				'class' => 'success',
				'route' => '/sale-list/' . $Sale->status
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

	public static function statusSale($id = int)
	{
		try {
			$Sale = Sale::find($id);

			if ($Sale->status == 0) {
				$Sale->status = 1;
				$msg = 'Venda faturada com sucesso';
			}elseif ($Sale->status == 1) {
				$PortionSale = PortionSaleController::deletePortionSale($Sale->id);
				$Sale->status = 0;
				$msg = 'Cancelado faturamento de venda com sucesso';
			}

			$Sale->save();

			$data = array(
				'msg' => $msg,
				'class' => 'success',
				'route' => '/sale-list/' . $Sale->status
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
