<?php

if(!function_exists('currentUser'))
{
	function currentUser()
	{
		return auth()->user();
	}
}

if(!function_exists('status'))
{
	function status($status)
	{
		if($status == "pendding")
		{
			return "pendding";
		}elseif($status == "approved"){
			return "approved";
		}else{
			return "refused";
		}
	}
}

if(!function_exists('status_payment'))
{
	function status_payment($status)
	{
		if($status == "unpaid")
		{
			return "unpaid";
		}else{
			return "paid";
		}
	}
}


function thousandsCurrencyFormat($num) {

  if($num>1000) {

        $x = round($num);
        $x_number_format = number_format($x);
        $x_array = explode(',', $x_number_format);
        $x_parts = array('k', 'm', 'b', 't');
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];

        return $x_display;

  }

  return $num;
}