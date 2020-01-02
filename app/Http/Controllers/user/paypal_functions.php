<?php
	
	/********************************************
	Module contains calls to PayPal APIs 
	********************************************/
	
    
	require('paypal_config.php');

	// Use values from config.php
	$PROXY_HOST = PROXY_HOST;
	$PROXY_PORT = PROXY_PORT;
	$SandboxFlag = SANDBOX_FLAG;
        //dd($SandboxFlag);
	
	if($SandboxFlag)  //API Credentials and URLs for Sandbox
	{
		$API_UserName=PP_USER_SANDBOX;
		//dd($API_UserName);
		$API_Password=PP_PASSWORD_SANDBOX;
		$API_Signature=PP_SIGNATURE_SANDBOX;
		$API_Endpoint = PP_NVP_ENDPOINT_SANDBOX;
		//dd($API_Endpoint);
		$PAYPAL_URL = PP_CHECKOUT_URL_SANDBOX;
		//dd($PAYPAL_URL);
		
	}
	else  // API Credentials and URLs for Live
	{
		$API_UserName=PP_USER;
		$API_Password=PP_PASSWORD;
		$API_Signature=PP_SIGNATURE;
		$API_Endpoint = PP_NVP_ENDPOINT_LIVE;
		$PAYPAL_URL = PP_CHECKOUT_URL_LIVE;
	}

	// BN Code 	is only applicable for partners
	$sBNCode = SBN_CODE;
	
	$version=API_VERSION;


	/*   
	* Purpose: 	Prepares the parameters for the SetExpressCheckout API Call.
	* Inputs:  
	*		parameterArray:     the item details, prices and taxes
	*		returnURL:			the page where buyers return to after they are done with the payment review on PayPal
	*		cancelURL:			the page where buyers return to when they cancel the payment review on PayPal
	*/
	function CallShortcutExpressCheckout( $paramsArray, $returnURL, $cancelURL) 
	{
		//------------------------------------------------------------------------------------------------------------------------------------
		// Construct the parameter string that describes the SetExpressCheckout API call in the shortcut implementation
		// For more information on the customizing the parameters passed refer: https://developer.paypal.com/docs/classic/express-checkout/integration-guide/ECCustomizing/
		
		//Mandatory parameters for SetExpressCheckout API call

		// session_start();
		// $_SESSION['post']= $paramsArray;

            
		if(isset($paramsArray["PAYMENTREQUEST_0_AMT"]))
		{
			$nvpstr = "&PAYMENTREQUEST_0_AMT=". $paramsArray["PAYMENTREQUEST_0_AMT"];
			$_SESSION["Payment_Amount"]= $paramsArray["PAYMENTREQUEST_0_AMT"];
		}
		//dd($_SESSION);

		if(isset($paramsArray["paymentType"]))
		{
			$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_PAYMENTACTION=" .  $paramsArray["paymentType"];
			$_SESSION["PaymentType"] = $paramsArray["paymentType"];
		}

		if(isset($returnURL))
		$nvpstr = $nvpstr . "&RETURNURL=" . $returnURL;

		if(isset($cancelURL))
		$nvpstr = $nvpstr . "&CANCELURL=" . $cancelURL;

	    
		//Optional parameters for SetExpressCheckout API call
		if(isset($paramsArray["firstname"]))  
		{
			$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_FIRSTNAME=" . $paramsArray["firstname"];
			$_SESSION["firstname"] = $paramsArray["firstname"];	
		} 

		if(isset($paramsArray["PAYMENTREQUEST_0_ITEMAMT"]))
		{
			$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_ITEMAMT=" . $paramsArray["PAYMENTREQUEST_0_ITEMAMT"];
			$_SESSION['itemAmt']= $paramsArray["PAYMENTREQUEST_0_ITEMAMT"];
		}

		if(isset($paramsArray["PAYMENTREQUEST_0_TAXAMT"]))
		{
			$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_TAXAMT=" . $paramsArray["PAYMENTREQUEST_0_TAXAMT"];
			$_SESSION['taxAmt']= $paramsArray["PAYMENTREQUEST_0_TAXAMT"];
		}

		if(isset($paramsArray["PAYMENTREQUEST_0_SHIPPINGAMT"]))
		{
			$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_SHIPPINGAMT=" . $paramsArray["PAYMENTREQUEST_0_SHIPPINGAMT"];
			$_SESSION['shippingAmt'] = $paramsArray["PAYMENTREQUEST_0_SHIPPINGAMT"];
		}

		if(isset($paramsArray["PAYMENTREQUEST_0_HANDLINGAMT"]))
		{
			$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_HANDLINGAMT=" . $paramsArray["PAYMENTREQUEST_0_HANDLINGAMT"];
			$_SESSION['handlingAmt'] = $paramsArray["PAYMENTREQUEST_0_HANDLINGAMT"];
		}

		if(isset($paramsArray["PAYMENTREQUEST_0_SHIPDISCAMT"]))
		{
			$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_SHIPDISCAMT=" . $paramsArray["PAYMENTREQUEST_0_SHIPDISCAMT"];
			$_SESSION['shippingDiscAmt'] = $paramsArray["PAYMENTREQUEST_0_SHIPDISCAMT"];
		}

		if(isset($paramsArray["PAYMENTREQUEST_0_INSURANCEAMT"]))
		{
			$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_INSURANCEAMT=" . $paramsArray["PAYMENTREQUEST_0_INSURANCEAMT"];
			$_SESSION['insuranceAmt'] = $paramsArray["PAYMENTREQUEST_0_INSURANCEAMT"];
		}

		if(isset($paramsArray["firstname"]))
		$nvpstr = $nvpstr . "&L_PAYMENTREQUEST_0_NAME0=" . $paramsArray["firstname"];

        
	    if(isset($paramsArray["lastname"]))
		$nvpstr = $nvpstr . "&lastname=" . $paramsArray["lastname"];

		if(isset($paramsArray["L_PAYMENTREQUEST_0_AMT0"]))
		$nvpstr = $nvpstr . "&L_PAYMENTREQUEST_0_AMT0=" . $paramsArray["L_PAYMENTREQUEST_0_AMT0"];

	    if(isset($paramsArray["passport"]))
		$nvpstr = $nvpstr . "&L_PAYMENTREQUEST_0_PASSPORT0=" . $paramsArray["passport"];

	     if(isset($paramsArray["sponsor"]))
		$nvpstr = $nvpstr . "&sponsor=" . $paramsArray["sponsor"];
       
        if(isset($paramsArray["placement_user"]))
        {
		$nvpstr = $nvpstr . "&placement_user=" . $paramsArray["placement_user"];
	     }
	     else
	     {
               $nvpstr = $nvpstr . "&placement_user=" . 0;
	     } 

	     if(isset($paramsArray["leg"]))
		$nvpstr = $nvpstr . "&leg=" . $paramsArray["leg"];

	    if(isset($paramsArray["country"]))
		$nvpstr = $nvpstr . "&country=" . $paramsArray["country"];

	     if(isset($paramsArray["state"]))
		$nvpstr = $nvpstr . "&state=" . $paramsArray["state"];

	     if(isset($paramsArray["address"]))
		$nvpstr = $nvpstr . "&address=" . $paramsArray["address"];

	     if(isset($paramsArray["zip"]))
		$nvpstr = $nvpstr . "&zip=" . $paramsArray["zip"];

	     if(isset($paramsArray["city"]))
		$nvpstr = $nvpstr . "&city=" . $paramsArray["city"];

	     if(isset($paramsArray["gender"]))
		$nvpstr = $nvpstr . "&gender=" . $paramsArray["gender"];

	    if(isset($paramsArray["phone"]))
		$nvpstr = $nvpstr . "&phone=" . $paramsArray["phone"];

	     if(isset($paramsArray["email"]))
		$nvpstr = $nvpstr . "&email=" . $paramsArray["email"];

	     if(isset($paramsArray["wechat"]))
		$nvpstr = $nvpstr . "&wechat=" . $paramsArray["wechat"];

	     if(isset($paramsArray["username"]))
		$nvpstr = $nvpstr . "&username=" . $paramsArray["username"];

	     if(isset($paramsArray["password"]))
		$nvpstr = $nvpstr . "&password=" . $paramsArray["password"];

	   

		if(isset($paramsArray["L_PAYMENTREQUEST_0_QTY0"]))
		$nvpstr = $nvpstr . "&L_PAYMENTREQUEST_0_QTY0=" . $paramsArray["L_PAYMENTREQUEST_0_QTY0"];
        
        
      
       
        

		if(isset($paramsArray["LOGOIMG"]))
		$nvpstr = $nvpstr . "&LOGOIMG=". $paramsArray["LOGOIMG"];
		

		/*
		* Make the API call to PayPal
		* If the API call succeded, then redirect the buyer to PayPal to begin to authorize payment.  
		* If an error occured, show the resulting errors
		*/
		//dd($nvpstr);
	    $resArray=hash_call("SetExpressCheckout", $nvpstr);	
		$ack = strtoupper($resArray["ACK"]);
		if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING")
		{
			$token = urldecode($resArray["TOKEN"]);
			$_SESSION['TOKEN']=$token;
		}
	    return $resArray;
	}
	
	/*   
	'-------------------------------------------------------------------------------------------------------------------------------------------
	' Purpose: 	Prepares the parameters for the SetExpressCheckout API Call.
	' Inputs:  
	'		paymentAmount:  	Total value of the shopping cart
	'		currencyCodeType: 	Currency code value the PayPal API
	'		paymentType: 		paymentType has to be one of the following values: Sale or Order or Authorization
	'		returnURL:			the page where buyers return to after they are done with the payment review on PayPal
	'		cancelURL:			the page where buyers return to when they cancel the payment review on PayPal
	'		shipToName:		the Ship to name entered on the merchant's site
	'		shipToStreet:		the Ship to Street entered on the merchant's site
	'		shipToCity:			the Ship to City entered on the merchant's site
	'		shipToState:		the Ship to State entered on the merchant's site
	'		shipToCountryCode:	the Code for Ship to Country entered on the merchant's site
	'		shipToZip:			the Ship to ZipCode entered on the merchant's site
	'		shipToStreet2:		the Ship to Street2 entered on the merchant's site
	'		phoneNum:			the phoneNum  entered on the merchant's site
	'--------------------------------------------------------------------------------------------------------------------------------------------	
	*/
	function CallMarkExpressCheckout( $paymentAmount, $shippingDetail, $paramsArray ) 
	{
		//------------------------------------------------------------------------------------------------------------------------------------
		// Construct the parameter string that describes the SetExpressCheckout API call in the shortcut implementation
		
		//Mandatory parameters for SetExpressCheckout API call
		if(isset($paramsArray["PAYMENTREQUEST_0_AMT"]))
		{
			$nvpstr = "&PAYMENTREQUEST_0_AMT=". $paramsArray["PAYMENTREQUEST_0_AMT"];
			$_SESSION["Payment_Amount"]= $paramsArray["PAYMENTREQUEST_0_AMT"];
		}

		// if(isset($paramsArray["paymentType"]))
		// {
		// 	$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_PAYMENTACTION=" .  $paramsArray["paymentType"];
		// 	$_SESSION["PaymentType"] = $paramsArray["paymentType"];
		// }

		if(isset($paramsArray["RETURN_URL"]))
			$nvpstr = $nvpstr . "&RETURNURL=" . $paramsArray["RETURN_URL"];

		if(isset($paramsArray["CANCEL_URL"]))
			$nvpstr = $nvpstr . "&CANCELURL=" . $paramsArray["CANCEL_URL"];

		// //Optional parameters for SetExpressCheckout API call
		// if(isset($paramsArray["currencyCodeType"]))  
		// {
		// 	$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_CURRENCYCODE=" . $paramsArray["currencyCodeType"];
		// 	$_SESSION["currencyCodeType"] = $paramsArray["currencyCodeType"];	
		// } 

		// if(isset($paramsArray["PAYMENTREQUEST_0_ITEMAMT"]))
		// {
		// 	$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_ITEMAMT=" . $paramsArray["PAYMENTREQUEST_0_ITEMAMT"];
		// 	$_SESSION['itemAmt']= $paramsArray["PAYMENTREQUEST_0_ITEMAMT"];
		// }

		// if(isset($paramsArray["PAYMENTREQUEST_0_TAXAMT"]))
		// {
		// 	$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_TAXAMT=" . $paramsArray["PAYMENTREQUEST_0_TAXAMT"];
		// 	$_SESSION['taxAmt']= $paramsArray["PAYMENTREQUEST_0_TAXAMT"];
		// }

		// if(isset($paramsArray["PAYMENTREQUEST_0_SHIPPINGAMT"]))
		// {
		// 	$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_SHIPPINGAMT=" . $paramsArray["PAYMENTREQUEST_0_SHIPPINGAMT"];
		// 	$_SESSION['shippingAmt'] = $paramsArray["PAYMENTREQUEST_0_SHIPPINGAMT"];
		// }

		// if(isset($paramsArray["PAYMENTREQUEST_0_HANDLINGAMT"]))
		// {
		// 	$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_HANDLINGAMT=" . $paramsArray["PAYMENTREQUEST_0_HANDLINGAMT"];
		// 	$_SESSION['handlingAmt'] = $paramsArray["PAYMENTREQUEST_0_HANDLINGAMT"];
		// }

		// if(isset($paramsArray["PAYMENTREQUEST_0_SHIPDISCAMT"]))
		// {
		// 	$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_SHIPDISCAMT=" . $paramsArray["PAYMENTREQUEST_0_SHIPDISCAMT"];
		// 	$_SESSION['shippingDiscAmt'] = $paramsArray["PAYMENTREQUEST_0_SHIPDISCAMT"];
		// }

		// if(isset($paramsArray["PAYMENTREQUEST_0_INSURANCEAMT"]))
		// {
		// 	$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_INSURANCEAMT=" . $paramsArray["PAYMENTREQUEST_0_INSURANCEAMT"];
		// 	$_SESSION['insuranceAmt'] = $paramsArray["PAYMENTREQUEST_0_INSURANCEAMT"];
		// }

		// if(isset($paramsArray["L_PAYMENTREQUEST_0_NAME0"]))
		// $nvpstr = $nvpstr . "&L_PAYMENTREQUEST_0_NAME0=" . $paramsArray["L_PAYMENTREQUEST_0_NAME0"];

		// if(isset($paramsArray["L_PAYMENTREQUEST_0_NUMBER0"]))
		// $nvpstr = $nvpstr . "&L_PAYMENTREQUEST_0_NUMBER0=" . $paramsArray["L_PAYMENTREQUEST_0_NUMBER0"];

		// if(isset($paramsArray["L_PAYMENTREQUEST_0_DESC0"]))
		// $nvpstr = $nvpstr . "&L_PAYMENTREQUEST_0_DESC0=" . $paramsArray["L_PAYMENTREQUEST_0_DESC0"];

		// if(isset($paramsArray["L_PAYMENTREQUEST_0_AMT0"]))
		// $nvpstr = $nvpstr . "&L_PAYMENTREQUEST_0_AMT0=" . $paramsArray["L_PAYMENTREQUEST_0_AMT0"];

		// if(isset($paramsArray["L_PAYMENTREQUEST_0_QTY0"]))
		// $nvpstr = $nvpstr . "&L_PAYMENTREQUEST_0_QTY0=" . $paramsArray["L_PAYMENTREQUEST_0_QTY0"];

		// if(isset($paramsArray["LOGOIMG"]))
		// $nvpstr = $nvpstr . "&LOGOIMG=". $paramsArray["LOGOIMG"];
		
		if(ADDRESS_OVERRIDE)
		$nvpstr = $nvpstr . "&ADDROVERRIDE=1";
		
		// Shipping parameters for API call
		
		// if(isset($shippingDetail["L_PAYMENTREQUEST_FIRSTNAME"]))  
		// {
		// 	$fullname = $shippingDetail["L_PAYMENTREQUEST_FIRSTNAME"];
		// 	if(isset($shippingDetail["L_PAYMENTREQUEST_LASTNAME"]))
		// 	$fullname = $fullname ." ". $shippingDetail["L_PAYMENTREQUEST_LASTNAME"];
			
		// 	$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_SHIPTONAME=" . $fullname;
		// 	$_SESSION["shipToName"] = $fullname;	
		// } 
		
		// if(isset($shippingDetail["PAYMENTREQUEST_0_SHIPTOSTREET"]))
		// {
		// 	$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_SHIPTOSTREET=" . $shippingDetail["PAYMENTREQUEST_0_SHIPTOSTREET"];
		// 	$_SESSION['shipToAddress'] = $shippingDetail["PAYMENTREQUEST_0_SHIPTOSTREET"];
		// }
		
		// if(isset($shippingDetail["PAYMENTREQUEST_0_SHIPTOSTREET2"]))
		// {
		// 	$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_SHIPTOSTREET2=" . $shippingDetail["PAYMENTREQUEST_0_SHIPTOSTREET2"];
		// 	$_SESSION['shipToAddress2'] = $shippingDetail["PAYMENTREQUEST_0_SHIPTOSTREET2"];
		// }
		
		// if(isset($shippingDetail["PAYMENTREQUEST_0_SHIPTOCITY"]))
		// {
		// 	$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_SHIPTOCITY=" . $shippingDetail["PAYMENTREQUEST_0_SHIPTOCITY"];
		// 	$_SESSION['shipToCity'] = $shippingDetail["PAYMENTREQUEST_0_SHIPTOCITY"];
		// }
		
		// if(isset($shippingDetail["PAYMENTREQUEST_0_SHIPTOSTATE"]))
		// {
		// 	$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_SHIPTOSTATE=" . $shippingDetail["PAYMENTREQUEST_0_SHIPTOSTATE"];
		// 	$_SESSION['shipToState'] = $shippingDetail["PAYMENTREQUEST_0_SHIPTOSTATE"];
		// }
		// if(isset($shippingDetail["PAYMENTREQUEST_0_SHIPTOZIP"]))
		// {
		// 	$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_SHIPTOZIP=" . $shippingDetail["PAYMENTREQUEST_0_SHIPTOZIP"];
		// 	$_SESSION['shipToZip'] = $shippingDetail["PAYMENTREQUEST_0_SHIPTOZIP"];
		// }
		// if(isset($shippingDetail["PAYMENTREQUEST_0_SHIPTOCOUNTRY"]))
		// {
		// 	$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_SHIPTOCOUNTRY=" . $shippingDetail["PAYMENTREQUEST_0_SHIPTOCOUNTRY"];
		// 	$_SESSION['shipToCountry'] = $shippingDetail["PAYMENTREQUEST_0_SHIPTOCOUNTRY"];
		// }
		// if(isset($shippingDetail["PAYMENTREQUEST_0_SHIPTOPHONENUM"]))
		// {
		// 	$nvpstr = $nvpstr . "&PAYMENTREQUEST_0_SHIPTOPHONENUM=" . $shippingDetail["PAYMENTREQUEST_0_SHIPTOPHONENUM"];
		// 	$_SESSION['shipToPhone'] = $shippingDetail["PAYMENTREQUEST_0_SHIPTOPHONENUM"];
		// }
		/*
		* Make the API call to PayPal
		* If the API call succeded, then redirect the buyer to PayPal to begin to authorize payment.  
		* If an error occured, show the resulting errors
		*/
	    $resArray=hash_call("SetExpressCheckout", $nvpstr);	
		$ack = strtoupper($resArray["ACK"]);
		if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING")
		{
			$token = urldecode($resArray["TOKEN"]);
			$_SESSION['TOKEN']=$token;
		}
	    return $resArray;
	}

	
	/* Purpose: 	
	* Prepares the parameters for the GetExpressCheckoutDetails API Call.
	* Inputs:  None
	* Returns: The NVP Collection object of the GetExpressCheckoutDetails Call Response.
	*/
	function GetShippingDetails( $token )
	{
	    /*
		* Build a second API request to PayPal, using the token as the
		*  ID to get the details on the payment authorization
		*/
	    $nvpstr="&TOKEN=" . $token;

		/*
		* Make the API call and store the results in an array.  
		* If the call was a success, show the authorization details, and provide an action to complete the payment.  
		* If failed, show the error
		*/
	    $resArray=hash_call("GetExpressCheckoutDetails",$nvpstr);
	    $ack = strtoupper($resArray["ACK"]);
		if($ack == "SUCCESS" || $ack=="SUCCESSWITHWARNING")
		{	
			$_SESSION['payer_id'] =	$resArray['PAYERID'];
		} 
		return $resArray;
	}

	/*
	* Purpose: 	Prepares the parameters for the DoExpressCheckoutPayment API Call.
	* Inputs:   FinalPaymentAmount:	The total transaction amount.
	* Returns: 	The NVP Collection object of the DoExpressCheckoutPayment Call Response.
	*/
	function ConfirmPayment( $FinalPaymentAmt ,$myarray)
	{
       
		/* Gather the information to make the final call to finalize the PayPal payment.  The variable nvpstr
         * holds the name value pairs
		 */
		//dd($myarray);
		//mandatory parameters in DoExpressCheckoutPayment call
		// if(isset($_SESSION['TOKEN']))
		// $nvpstr = '&TOKEN=' . urlencode($_SESSION['TOKEN']);

		// if(isset($_SESSION['payer_id']))
		// $nvpstr .= '&PAYERID=' . urlencode($_SESSION['payer_id']);

		// if(isset($_SESSION['PaymentType']))
		// $nvpstr .= '&PAYMENTREQUEST_0_PAYMENTACTION=' . urlencode($_SESSION['PaymentType']); 
		
		// if(isset($_SERVER['SERVER_NAME']))
		// $nvpstr .= '&IPADDRESS=' . urlencode($_SERVER['SERVER_NAME']);
	
		// $nvpstr .= '&PAYMENTREQUEST_0_AMT=' . $FinalPaymentAmt;
		

		// //Check for additional parameters that can be passed in DoExpressCheckoutPayment API call
		// if(isset($_SESSION['currencyCodeType']))
		// $nvpstr .= '&PAYMENTREQUEST_0_CURRENCYCODE=' . urlencode($_SESSION['currencyCodeType']);
		
		// if(isset($_SESSION['itemAmt']))
		// $nvpstr = $nvpstr . '&PAYMENTREQUEST_0_ITEMAMT=' . urlencode($_SESSION['itemAmt']);

		// if(isset($_SESSION['taxAmt']))
		// $nvpstr = $nvpstr . '&PAYMENTREQUEST_0_TAXAMT=' . urlencode($_SESSION['taxAmt']);

		// if(isset($_SESSION['shippingAmt']))
		// $nvpstr = $nvpstr . '&PAYMENTREQUEST_0_SHIPPINGAMT=' . urlencode($_SESSION['shippingAmt']);

		// if(isset($_SESSION['handlingAmt']))
		// $nvpstr = $nvpstr . '&PAYMENTREQUEST_0_HANDLINGAMT=' . urlencode($_SESSION['handlingAmt']);

		// if(isset($_SESSION['shippingDiscAmt']))
		// $nvpstr = $nvpstr . '&PAYMENTREQUEST_0_SHIPDISCAMT=' . urlencode($_SESSION['shippingDiscAmt']);

		// if(isset($_SESSION['insuranceAmt']))
		// $nvpstr = $nvpstr . '&PAYMENTREQUEST_0_INSURANCEAMT=' . urlencode($_SESSION['insuranceAmt']);

        if(isset($myarray['TOKEN']))
		$nvpstr = '&TOKEN=' . urlencode($myarray['TOKEN']);

		if(isset($myarray['PAYERID']))
		$nvpstr .= '&PAYERID=' . urlencode($myarray['PAYERID']);
	  // dd($nvpstr);

		if(isset($myarray['PaymentType']))
		$nvpstr .= '&PAYMENTREQUEST_0_PAYMENTACTION=' . urlencode($myarray['PaymentType']); 
		
		if(isset($_SERVER['SERVER_NAME']))
		$nvpstr .= '&IPADDRESS=' . urlencode($_SERVER['SERVER_NAME']);
	
		$nvpstr .= '&PAYMENTREQUEST_0_AMT=' . $FinalPaymentAmt;
		

		//Check for additional parameters that can be passed in DoExpressCheckoutPayment API call
		if(isset($myarray['currencyCodeType']))
		$nvpstr .= '&PAYMENTREQUEST_0_CURRENCYCODE=' . urlencode($myarray['currencyCodeType']);
		
		if(isset($myarray['itemAmt']))
		$nvpstr = $nvpstr . '&PAYMENTREQUEST_0_ITEMAMT=' . urlencode($myarray['itemAmt']);

		if(isset($myarray['taxAmt']))
		$nvpstr = $nvpstr . '&PAYMENTREQUEST_0_TAXAMT=' . urlencode($myarray['taxAmt']);

		if(isset($myarray['shippingAmt']))
		$nvpstr = $nvpstr . '&PAYMENTREQUEST_0_SHIPPINGAMT=' . urlencode($myarray['shippingAmt']);

		if(isset($myarray['handlingAmt']))
		$nvpstr = $nvpstr . '&PAYMENTREQUEST_0_HANDLINGAMT=' . urlencode($myarray['handlingAmt']);

		if(isset($myarray['shippingDiscAmt']))
		$nvpstr = $nvpstr . '&PAYMENTREQUEST_0_SHIPDISCAMT=' . urlencode($myarray['shippingDiscAmt']);

		if(isset($myarray['insuranceAmt']))
		$nvpstr = $nvpstr . '&PAYMENTREQUEST_0_INSURANCEAMT=' . urlencode($myarray['insuranceAmt']);
		 /* Make the call to PayPal to finalize payment
          * If an error occured, show the resulting errors
		  */
		    

		$resArray=hash_call("DoExpressCheckoutPayment", $nvpstr);

		/* Display the API response back to the browser.
		 * If the response from PayPal was a success, display the response parameters'
		 * If the response was an error, display the errors received using APIError.php.
		 */
		$ack = strtoupper($resArray["ACK"]);

		return $resArray;
	}
	
	

	/*
	  * hash_call: Function to perform the API call to PayPal using API signature
	  * @methodName is name of API  method.
	  * @nvpStr is nvp string.
	  * returns an associtive array containing the response from the server.
	*/
	function hash_call($methodName,$nvpStr)
	{
		
		//declaring of global variables
		global $API_Endpoint, $version , $API_UserName, $API_Password, $API_Signature;
		global $USE_PROXY, $PROXY_HOST, $PROXY_PORT;
		global $gv_ApiErrorURL;
		global $sBNCode;
		
		//setting the curl parameters.
		//dd($nvpStr);
		
		$mypstr =  $nvpStr;
		//dd($mypstr);
		//$_SESSION['mypstr']=$mypstr;
		//dd($_SESSION['mypstr']);
		$ch = curl_init();
		//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

             
		curl_setopt($ch, CURLOPT_URL,'https://api-3t.sandbox.paypal.com/nvp');
		
		curl_setopt($ch, CURLOPT_VERBOSE, 1);

		//turning off the server and peer verification(TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
	 //      if(curl_exec($ch) === false)
  //              {
  //                 echo 'Curl error: ' . curl_error($ch);
  //              }
  //              else
  //              {
  //                   echo 'Operation completed without any errors';
  //              }
		// die();
		
	    //if USE_PROXY constant set to TRUE in Constants.php, then only proxy will be enabled.
	   //Set proxy name to PROXY_HOST and port number to PROXY_PORT in constants.php 
		if($USE_PROXY)
			curl_setopt ($ch, CURLOPT_PROXY, PROXY_HOST. ":" . PROXY_PORT); 

		//NVPRequest for submitting to server
		$nvpreq="METHOD=" . urlencode($methodName) . "&VERSION=" . urlencode(API_VERSION) . "&PWD=" . urlencode(PP_PASSWORD_SANDBOX) . "&USER=" . urlencode(PP_USER_SANDBOX) . "&SIGNATURE=" . urlencode(PP_SIGNATURE_SANDBOX) . $nvpStr . "&BUTTONSOURCE=" . urlencode(SBN_CODE);

		//setting the nvpreq as POST FIELD to curl
		curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

		//getting response from server
		$response = curl_exec($ch);
                //dd($response);
		//convrting NVPResponse to an Associative Array
		$nvpResArray=deformatNVP($response);
		$nvpReqArray=deformatNVP($nvpreq);
		$_SESSION['nvpReqArray']=$nvpReqArray;
		
		//dd($_SESSION['nvpReqArray']);
		

		if (curl_errno($ch)) 
		{
			// moving to display page to display curl errors
			  $_SESSION['curl_error_no']=curl_errno($ch) ;
			  $_SESSION['curl_error_msg']=curl_error($ch);

			  //Execute the Error handling module to display errors. 
		} 
		else 
		{
			 //closing the curl
		  	curl_close($ch);
		}
              //  dd($nvpResArray);
		//$_SESSION['mypstr']=$mypstr;
		//dd($_SESSION['mypstr']);
		return $nvpResArray;
		
	}

	/*
	* Purpose: Redirects to PayPal.com site.
	* Inputs:  NVP string.
	*  Returns: 
	*/
	function RedirectToPayPal ( $token )
	{
		session_start();
		global $PAYPAL_URL;
		
		// Redirect to paypal.com here
		// With useraction=commit user will see "Pay Now" on Paypal website and when user clicks "Pay Now" and returns to our website we can call DoExpressCheckoutPayment API without asking the user
		$payPalURL = PP_CHECKOUT_URL_SANDBOX. $token ;

		
			$payPalURL = $payPalURL. '&useraction=commit';	
		// }
		header("Location:".$payPalURL);
		exit;
	}

	
	/* 
	  * This function will take NVPString and convert it to an Associative Array and it will decode the response.
	  * It is usefull to search for a particular key and displaying arrays.
	  * @nvpstr is NVPString.
	  * @nvpArray is Associative Array.
	  */
	function deformatNVP($nvpstr)
	{
		$intial=0;
	 	$nvpArray = array();

		while(strlen($nvpstr))
		{
			//postion of Key
			$keypos= strpos($nvpstr,'=');
			//position of value
			$valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&'): strlen($nvpstr);

			/*getting the Key and Value values and storing in a Associative Array*/
			$keyval=substr($nvpstr,$intial,$keypos);
			$valval=substr($nvpstr,$keypos+1,$valuepos-$keypos-1);
			//decoding the respose
			$nvpArray[urldecode($keyval)] =urldecode( $valval);
			$nvpstr=substr($nvpstr,$valuepos+1,strlen($nvpstr));
	     }
		return $nvpArray;
	}

?>
