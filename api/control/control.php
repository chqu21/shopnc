<?php

class APIcontrol{
	protected function callback($data){
		return encrypt($data,APP_KEY);
	}	
}

?>