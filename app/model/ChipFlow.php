<?php

class ChipFlow extends ModelAbstract
{	
    protected $table = "chip_flow";
    protected $fillable = ['date', 'client_site_user_id', 'agreed_id', 'total', 'operation'];
}