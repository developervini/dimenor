<?php

class BankController
{
	public static function findBank($id = int)
	{
		try {
			return Bank::find($id);
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error',
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function listBank()
	{
		try {
			return Bank::all();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error',
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function newBank($data = array())
	{
		try {
			$Bank = new Bank();
			$Bank->bank = $data['bank'];
			$Bank->account = $data['account'];
			$Bank->balance = $data['balance'];
			$Bank->save();

			$data = array(
				'msg' => 'Conta inserida com sucesso',
				'class' => 'success',
				'route' => '/bank-list'
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

	public static function editBank($data = array())
	{
		try {
			$Bank = Bank::find($data['id']);
			$Bank->bank = $data['bank'];
			$Bank->account = $data['account'];

			$Bank->save();

			$data = array(
				'msg' => 'Conta editada com sucesso',
				'class' => 'success',
				'route' => '/bank-view/' . $Bank->id
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

	public static function activeBank($id = int)
	{
		try {
			$Bank = Bank::find($id);

			if ($Bank->active == 0) {
				$Bank->active = 1;
				$msg = 'Conta removida com sucesso';
			}elseif ($Bank->active == 1) {
				$Bank->active = 0;
				$msg = 'Conta ativada com sucesso';
			}

			$Bank->save();

			$data = array(
				'msg' => $msg,
				'class' => 'success',
				'route' => '/bank-list'
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
