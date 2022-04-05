<?php
class mod_login extends CI_Model
{
    function __construct()
    {
        parent::__construct();
	}
	// Validate Login Credentials...
	public function validate_login_credentials($username = '', $password = '') {
		if (empty($username) || empty($password)) :
			return false;
		else :

			$return = $this->db->where(array('username' => $username))->where(array('password' => md5(trim($password))))->get('admins')->row_array();

			if ($return) :
				return $return;
			else :
				return false;
			endif;
		endif;
	}
	// END Validate Login Credentials...
}
?>
