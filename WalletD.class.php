<?php
class walletD {
	private $username;
	private $password;
	private $server;
	private $port;
	
	public function __construct($username,$password,$server,$port){
		$this->username=$username;
		$this->password=$password;
		$this->server=$server;
		$this->port=$port;
	}
  
  public function call($query){
    $json = json_encode($query);
    $ch = curl_init($this->server.":".$this->port."/json_rpc");
    curl_setopt($ch,CURLOPT_USERPWD,$this->username.":".$this->password);
    curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch,CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch,CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Content-Length: '.strlen($json))
    );
    $result = curl_exec($ch);
    if (!$result) { return curl_errno($ch); }
    return json_decode($result);
  }
  
  
  public function getStatus() {
    $query = array("method" => "getStatus");
    return $this->call($query);
  }
  
  public function getViewKey() {
    $query = array("method" => "getViewKey");
    return $this->call($query);
  }
  
  public function getSpendKeys($address) {
    $query = array("method" => "getSpendKeys", "params" => array("address"=>$address));
    return $this->call($query);
  }
  
  public function getAddresses() {
    $query = array("method" => "getAddresses");
    return $this->call($query);
  }
  
  public function createAddress() {
    $query = array("method" => "createAddress");
    return $this->call($query);
  }
  
  public function deleteAddress($address) {
    $query = array("method" => "deleteAddress", "params" => array("address"=>$address));
    return $this->call($query);
  }
  
  public function getBalance($address) {
    $query = array("method"=>"getBalance", "params"=>array("address"=>$address));
    return $this->call($query);
  }
  
  public function getBlockHashes($firstBlockIndex, $blockCount) {
    $query = array("method"=>"getBlockHashes","params"=>array("firstBlockIndex"=>$firstBlockIndex,"blockCount"=>$blockCount));
    return $this->call($query);
  }
}
?>
