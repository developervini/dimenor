<?php

class PlanController
{
	public static function findPlan($id = int)
	{
		try {	
			return Plan::find($id);
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function listPlan()
	{
		try {	
			return Plan::orderBy('plan', 'ASC')->get();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(),
				'class' => 'error', 
				'route' => '/error-log'
			);
			return $data;
		}
	}

	public static function newPlan($data = array())
	{
		try {
			$Plan = new Plan();
			$Plan->plan = $data['plan'];
			$Plan->save();

			$data = array(
				'msg' => 'Plano de conta inserido com sucesso',
				'class' => 'success', 
				'route' => '/plan-list'
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

	public static function editPlan($data = array())
	{
		try {
			$Plan = Plan::find($data['id']);
			$Plan->plan = $data['plan'];
			$Plan->save();

			$data = array(
				'msg' => 'Plano de conta editado com sucesso',
				'class' => 'success', 
				'route' => '/plan-view/' . $Plan->id
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

	public static function activePlan($id = int)
	{
		try {
			$Plan = Plan::find($id);
			
			if ($Plan->active == 0) {
				$Plan->active = 1;
				$msg = 'Plano de conta removido com sucesso';
			}elseif ($Plan->active == 1) {
				$Plan->active = 0;
				$msg = 'Plano de conta ativado com sucesso';
			}

			$Plan->save();

			$data = array(
				'msg' => $msg,
				'class' => 'success', 
				'route' => '/plan-list'
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