<?php

class Login{

    private $db_connection = null;

    public $errors = array();

    public $messages = array();

    public $temp = 0;

    public function __construct(){
        session_start();
        if (isset($_GET["logout"])) {
            $this->doLogout();
        }
    }

    public function dologinWithPostData($login_input_email, $login_input_password){
		$pattern = '/select|union|insert|delete/i';
        if (empty($login_input_email)) {
            $this->errors[] = "Username field was empty.";
        } elseif (empty($login_input_password)) {
            $this->errors[] = "Password field was empty.";
        } elseif(preg_match($pattern, $login_input_email, $matches, PREG_OFFSET_CAPTURE) ||
			preg_match($pattern, $login_input_password, $matches, PREG_OFFSET_CAPTURE) ){
			$this->errors[] = "TRY HARDER!!!!";
        } else {
			$this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            if (!$this->db_connection->connect_errno) {
                $login_input_email = $this->db_connection->real_escape_string($login_input_email);

                $sql = "SELECT id_user, name, sirname, email, votes, password
                        FROM users
                        WHERE email = '" . $login_input_email . "';";
                $result_of_login_check = $this->db_connection->query($sql);

                // users
                if ($result_of_login_check->num_rows == 1) {
					$result_row = $result_of_login_check->fetch_object();
                    if (password_verify($login_input_password, $result_row->password)) {
                        $_SESSION['name'] = $result_row->name;
                        $_SESSION['sirname'] = $result_row->sirname;
                        $_SESSION['email'] = $result_row->email;
                        $_SESSION['votes'] = $result_row->votes;
                        $_SESSION['id_user'] = $result_row->id_user;
                        $_SESSION['user_login_status'] = 1;

                        $this->temp = 1;

                        $this->errors[] = "Correct password.";
                    } else {
                        $this->errors[] = "Wrong password. Try again.";
                    }
                } else {
                    $this->errors[] = "This user does not exist.";
                }
            } else {
                $this->errors[] = "Database connection problem.";
            }
        }
    }

    public function doLogout(){
        $this->messages[] = "You have been logged out.";
        $_SESSION = array();
        session_destroy();
    }

    public function isUserLoggedIn(){
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            return true;
        }
        return false;
    }
}
