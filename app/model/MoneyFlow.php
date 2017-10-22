<?php

class MoneyFlow extends ModelAbstract
{	
    protected $table = "money_flow";
    protected $fillable = ['date', 'client_id', 'bank_id', 'total', 'total_converted', 'operation', 'status'];
}