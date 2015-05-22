<?php

class Registration{

    public $db_connection = null;
    public $errors = array();
    public $messages = array();
    public $temp = 0;

    public function __construct(){
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if (!$this->db_connection->set_charset("utf8")) {
            $this->errors[] = $this->db_connection->error;
        }
        if (isset($_POST["register"])) {
            $this->registerNewUser();
        }
    }

    public function registerNewUser($name, $sirname, $email, $password, $re_password){
		$pattern = '/select|union|insert|delete/i';
        if (empty($name)) {
            $this->errors[] = "Empty name";
        } elseif (empty($sirname)) {
            $this->errors[] = "Empty sirname";
        } elseif (empty($email)) {
            $this->errors[] = "Empty e-mail";
        } elseif (empty($password) || empty($re_password)) {
            $this->errors[] = "Empty passwords";
        } elseif (strcmp($password, $re_password) !== 0) {
            $this->errors[] = "Passwords are not the same";
        } elseif (strlen($password) < 4) {
            $this->errors[] = "Password has a minimum length of 4 characters";
        } elseif( preg_match($pattern, $name, $matches, PREG_OFFSET_CAPTURE) ||
                preg_match($pattern, $sirname, $matches, PREG_OFFSET_CAPTURE) ||
                preg_match($pattern, $email, $matches, PREG_OFFSET_CAPTURE) ||
                preg_match($pattern, $password, $matches, PREG_OFFSET_CAPTURE) ){
			$this->errors[] = "TRY HARDER!!!!";
        } else {

            if (!$this->db_connection->connect_errno) {
                $name = $this->db_connection->real_escape_string(strip_tags($name, ENT_QUOTES));
                $sirname = $this->db_connection->real_escape_string(strip_tags($sirname, ENT_QUOTES));
                $email = $this->db_connection->real_escape_string(strip_tags($email, ENT_QUOTES));

                $user_password = $password;

                $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);

                $sql = "SELECT * FROM users WHERE email = '" . $email ."';";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) {
                    $this->errors[] = "Sorry, that username or e-mail is already taken.";
                } else {
                    $sql = "INSERT INTO users (name, sirname, email, password, votes)
                            VALUES('".$name."', '".$sirname."','".$email."','".$user_password_hash."', '0');";
                    $query_new_user_insert = $this->db_connection->query($sql);
                    if ($query_new_user_insert) {
                        $this->messages[] = "Your account has been created successfully.<br>Now, you can wait for the acceptance from the administrator.";
                        $this->temp = 1;
                    } else {
                        $this->errors[] = "Sorry, your registration failed. Please try again.";
                    }
                }
            } else {
                $this->errors[] = "Sorry, no database connection.";
            }
        }
    }
}
