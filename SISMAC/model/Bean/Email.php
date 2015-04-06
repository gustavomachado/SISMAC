<?php 

require_once ('Contato.php');

/**
* 
*/
class Email extends Contato{
	

	private $email;

	function __construct(){
		
	}

    /**
     * Gets the value of email.
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the value of email.
     *
     * @param mixed $email the email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
}

 ?>