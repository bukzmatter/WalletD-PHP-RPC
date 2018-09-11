<?php
class WalletD {

	//Server Details
	private $rpcHost = "http://127.0.0.1";
	private $rpcPort = "1987";

	//RPC Credentials
	private $rpcUser = "rpcUser";
	private $rpcPassword = "rpcPassword";


public function __construct(/*$rpcHost, $rpcPort, $rpcUser="", $rpcPassword=""*/) {
		/*$this->rpcHost = $rpcHost;
		$this->rpcPort = $rpcPort;
		$this->rpcUser = $rpcUser;
		$this->rpcPassword = $rpcPassword;*/
	}

	public function call($query) {
		$jsonData = json_encode($query);
		$curlHandle = curl_init($this->rpcHost.":".$this->rpcPort."/json_rpc");
		curl_setopt($curlHandle, CURLOPT_USERPWD, $this->rpcUser.":".$this->rpcPassword);
		curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $jsonData);
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: '.strlen($jsonData))
		);
		$response = json_decode(curl_exec($curlHandle));
		return $response;
		curl_close($curlHandle);
	}

	/********************************************************************
	public function createAddress();
	@RETURNS:
	stdClass Object
	(
    [jsonrpc] => 2.0
    [result] => stdClass Object
        (
            [address] => bukzW7b1dss9NMpkdvFR3kRR4CVSBpnVp1vZHmBSSZF...
        )

	)*********************************************************************/
	public function createAddress() {
		$query = array("method" => "createAddress");
		return $this->call($request);
	}

/*************************************************************************
public function getBalance($address='')
stdClass Object
(
    [jsonrpc] => 2.0
    [result] => stdClass Object
        (
            [availableBalance] => 0
            [lockedAmount] => 0
        )

)
**************************************************************************/
	public function getBalance($address="") {
		$query = array(
			"method" => "getBalance",
				"params" => array("address"=> $address));
			return $this->call($query);
	}

/***************************************************************************
public function getAddresses()
stdClass Object
(
    [jsonrpc] => 2.0
    [result] => stdClass Object
        (
            [addresses] => Array
                (
                    [0] => bukzkHduvD15cu26KjE41zC181CNvCJmuDcY...
                    [1] => bukzZUC8Qmb33xcj4yq81XfZ5Pfmc9a9bWNe...
                )

        )

)
******************************************************************************/
	public function getAddresses() {
		$query = array("method" => "getAddresses");
		return $this->call($query);
	}




}

$w = new WalletD();
print_r($w->getAddresses());
?>
