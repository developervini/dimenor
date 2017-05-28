<?php

class CoinController
{
	public static function findCoin($id = int)
	{
		try {	
			return Coin::find($id);
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function listCoin()
	{
		try {	
			return Coin::orderBy('coin', 'ASC')->get();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function newCoin($data = array())
	{
		try {
			$Coin = new Coin();
			$Coin->coin = $data['coin'];
			$Coin->percentage = $data['percentage'];
			$Coin->save();

			$data = array(
				'msg' => 'Moeda inserida com sucesso',
				'class' => 'success', 
				'route' => '/coin-list'
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

	public static function editCoin($data = array())
	{
		try {
			$Coin = Coin::find($data['id']);
			$Coin->coin = $data['coin'];
			$Coin->percentage = $data['percentage'];
			$Coin->save();

			$data = array(
				'msg' => 'Moeda editada com sucesso',
				'class' => 'success', 
				'route' => '/coin-view/' . $Coin->id
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

	public static function activeCoin($id = int)
	{
		try {
			$Coin = Coin::find($id);
			
			if ($Coin->active == 0) {
				$Coin->active = 1;
				$msg = 'Moeda removida com sucesso';
			}elseif ($Coin->active == 1) {
				$Coin->active = 0;
				$msg = 'Moeda ativada com sucesso';
			}

			$Coin->save();

			$data = array(
				'msg' => $msg,
				'class' => 'success', 
				'route' => '/coin-list'
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