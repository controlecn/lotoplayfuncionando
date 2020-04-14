<?

$html_title = "account";
$openTab = "account";

include("include_header.php");
include('clickandbuy_lib/nusoap.php');

if ($logged==1) {

	$pedido = $_GET['externalBDRID'];
	$success = $_GET['result'];
	
	if ($success!="success") {
		echo "ERRO!";
	} else {
	
		// Configurable merchant variables
		$sellerID 	= 00000000;	// Your merchant sellerID		
		$tmPassword 	='SENHA';	// Your Transaction Manager Password	
							
		// Create a SOAP client for ClickandBuy
		// NOTE: ensure system-id [.eu.] in the wsdl matches the 2 letter code in your ClickandBuy Transaction URL
		$client = new nusoapclient('http://wsdl.eu.clickandbuy.com/TMI/1.4/TransactionManagerbinding.wsdl',true); 
							
		// isExternalBDRIDCommitted data to array
		$secondconfirmation = array(
			'sellerID' => $sellerID,
			'tmPassword' => $tmPassword,
			'slaveMerchantID' => '0',
			'externalBDRID' => $pedido
		);
					
		// isExternalBDRIDCommitted SOAP request
		$result = $client->call('isExternalBDRIDCommitted',$secondconfirmation,'https://clickandbuy.com/TransactionManager/','https://clickandbuy.com/TransactionManager/');
				
		// Output the result array to the browser
		if ($client->fault) {
			$status = 'investigate';
		} else {
			$err = $client->getError();
			if ($err) {
				$status = 'fault';
			} else {
				$status = 'created';
			}
			
		}

		if ($status=="created") {
			echo "Seu pagamento foi successo. Creditos liberados.";
		} else {
			echo "ERRO!";
		}
		
	}
	
	

}

include("include_bottom.php");

?>