<?php

class AddComment{

    public $db_connection = null;

    public $errors = array();

    public $messages = array();

    public $votes = null;

    public function __construct(){
    	session_start();
    }
		
    public function connect(){
		$this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if (!$this->db_connection->set_charset("utf8")) {
			$this->errors[] = $this->db_connection->error;
		}
	}

    public function addComment($id_pns, $new_comment){
    	$date = date('Y-m-d H:i:s', time());
		$this->connect();
		if (!$this->db_connection->connect_errno) {
			$ip = $this->get_ip_address();
			
			$sql = "INSERT INTO comments
						(id_comment, id_user, id_pns, `comment`, `ip`, `date`) VALUES
						(NULL, '".$_SESSION['id_user']."', '".$id_pns."','".$new_comment."','".$ip."','".$date."');";
			$this->db_connection->query($sql);
			$this->errors[] = $sql;

			$this->db_connection->close();
		} else {
        	$this->errors[] = "Database connection problem: ".$this->db_connection->connect_error;
        }
	}

	function get_ip_address() {
	    $ip_keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR');
	    foreach ($ip_keys as $key) {
	        if (array_key_exists($key, $_SERVER) === true) {
	            foreach (explode(',', $_SERVER[$key]) as $ip) {
	                // trim for safety measures
	                $ip = trim($ip);
	                // attempt to validate IP
	                if ($this->validate_ip($ip)) {
	                    return $ip;
	                }
	            }
	        }
	    }

	    return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : false;
	}


	/**
	 * Ensures an ip address is both a valid IP and does not fall within
	 * a private network range.
	 */
	function validate_ip($ip){
	    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
	        return false;
	    }
	    return true;
	}
}
