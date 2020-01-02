<?php
return array(
   'client_id' =>'AZrl0Cxc5rTFGYJ1ouftsgQ_l58RF9FqIe6XQTG6niWhKqG6fC7OSKKf-33aiKa3luucb2z1_131frSw',
'secret' => 'EADeOaW_aQGZ5h-auUYuTTwcFgX-KAwYzW84kuwfyMb2iVTRRu7d4G8So8qNbajsD7NtA5xR3IWsYyou',
/**
* SDK configuration 
*/
'settings' => array(
    /**
    * Available option 'sandbox' or 'live'
    */
    'mode' => 'sandbox',
    /**
    * Specify the max request time in seconds
    */
    'http.ConnectionTimeOut' => 1000,
    /**
    * Whether want to log to a file
    */
    'log.LogEnabled' => true,
    /**
    * Specify the file that want to write on
    */
    'log.FileName' => storage_path() . '/logs/paypal.log',
    /**
    * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
    *
    * Logging is most verbose in the 'FINE' level and decreases as you
    * proceed towards ERROR
    */
    'log.LogLevel' => 'FINE'
    ),
);


