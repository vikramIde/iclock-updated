<?php
namespace App\Services;

use App\Exchange;
use View;

trait ExchangerateTrait {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
    public function getExchangex($amount,$cur,$date) {
		
		if($cur=='EURO'){
			$cur='EUR';
		}
		$dbcur = $cur."INR";
		
		//datex 
	    $datex = explode("-",$date);
		
		$datey[0]=$datex[0];
		
		$datey[1]=$datex[1];
		$datey[2]=$datex[2];
		
		$dbdate = implode("-",$datey);
		
		$exchange  = Exchange::where("date","=",$dbdate)->get();
		
		$amountx = $exchange[0]->$dbcur * $amount;
		
		return $amountx;
		//dd($exchange);
    }

}