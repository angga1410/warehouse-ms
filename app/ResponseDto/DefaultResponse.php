<?php

namespace App\ResponseDto;

class DefaultResponse
{
	public function __construct($data)
    {
    	$this->data = $data;
    }
     public function getResponse()
    {
    	return ["aaData" => $this->data,"iTotalDisplayRecords" => count($this->data),"iTotalRecords" => count($this->data),"sColumns" => "","sEcho" => 0];
    }
}