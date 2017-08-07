<?php

class PortionSaleController
{
  public static function listPortionSale($sale)
  {
    try {
      return PortionSale::join('bank', 'bank.id', '=', 'bank_id')->select('portion_sale.*', 'bank.bank as bank')->where('sale_id', $sale)->get();
    } catch (Exception $ex) {
      $data = array(
        'msg' => $ex->getMessage(),
        'class' => 'error',
        'route' => '/error-log'
      );
      return $data;
    }
  }

  public static function listPortionSaleBank($bank)
  {
    try {
      return PortionSale::where('bank_id', $bank)->get();
    } catch (Exception $ex) {
      $data = array(
        'msg' => $ex->getMessage(),
        'class' => 'error',
        'route' => '/error-log'
      );
      return $data;
    }
  }

  public static function getTotalPortionSale($sale)
  {
    try {
      return PortionSale::selectRaw('SUM(portion) as total')->where('sale_id', $sale)->get()->first();
    } catch (Exception $ex) {
      $data = array(
        'msg' => $ex->getMessage(),
        'class' => 'error',
        'route' => '/error-log'
      );
      return $data;
    }
  }

  public static function getTotalPortionSaleBank($bank)
  {
    try {
      return PortionSale::selectRaw('SUM(portion) as total')->where('bank_id', $bank)->get()->first();
    } catch (Exception $ex) {
      $data = array(
        'msg' => $ex->getMessage(),
        'class' => 'error',
        'route' => '/error-log'
      );
      return $data;
    }
  }

  public static function getTotalPortionSaleTotal()
  {
    try {
      return PortionSale::selectRaw('SUM(portion) as total, bank_id')->groupBy('bank_id')->get();
    } catch (Exception $ex) {
      $data = array(
        'msg' => $ex->getMessage(),
        'class' => 'error',
        'route' => '/error-log'
      );
      return $data;
    }
  }

  public static function deletePortionSale($sale)
  {
    try {
      return PortionSale::where('sale_id', $sale)->delete();
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
