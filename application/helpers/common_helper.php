<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function active($name, $number)
{
	$ci = get_instance();

	if($name == 'home' && $ci->uri->segment(2) == "" && $number == 1)
	{
		return "class='active'";
	}
	elseif($name=="about" && $ci->uri->segment(2) == "about" && $number == 2)
	{
		return "class='active'";
	}
	elseif($name=="story" && $number == 3)
	{
		return "class='active'";
	}
}
