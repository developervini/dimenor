<?php

class PortionPurchaseController
{
  public static function listPortionPurchase($purchase)
  {
    try {
      return PortionPurchase::join('bank', 'bank.id', '=', 'bank_id')->select('portion_purchase.*', 'bank.bank as bank')->where('purchase_id', $purchase)->get();
    } catch (Exception $ex) {
      $data = array(
        'msg' => $ex->getMessage(),
        'class' => 'error',
        'route' => '/error-log'
      );
      return $data;
    }
  }

  public static function listPortionPurchaseBank($bank)
  {
    try {
      return PortionPurchase::where('bank_id', $bank)->get();
    } catch (Exception $ex) {
      $data = array(
        'msg' => $ex->getMessage(),
        'class' => 'error',
        'route' => '/error-log'
      );
      return $data;
    }
  }

  public static function getTotalPortionPurchase($purchase)
  {
    try {
      return PortionPurchase::selectRaw('SUM(portion) as total')->where('purchase_id', $purchase)->get()->first();
    } catch (Exception $ex) {
      $data = array(
        'msg' => $ex->getMessage(),
        'class' => 'error',
        'route' => '/error-log'
      );
      return $data;
    }
  }

  public static function getTotalPortionPurchaseBank($bank)
  {
    try {
      return PortionPurchase::selectRaw('SUM(portion) as total')->where('bank_id', $bank)->get()->first();
    } catch (Exception $ex) {
      $data = array(
        'msg' => $ex->getMessage(),
        'class' => 'error',
        'route' => '/error-log'
      );
      return $data;
    }
  }

  public static function getTotalPortionPurchaseTotal()
  {
    try {
      return PortionPurchase::selectRaw('SUM(portion) as total, bank_id')->groupBy('bank_id')->get();
    } catch (Exception $ex) {
      $data = array(
        'msg' => $ex->getMessage(),
        'class' => 'error',
        'route' => '/error-log'
      );
      return $data;
    }
  }

  public static function deletePortionPurchase($purchase)
  {
    try {
      return PortionPurchase::where('purchase_id', $purchase)->delete();
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
