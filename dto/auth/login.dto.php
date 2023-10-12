<?php

class AuthDto {
    /**
     * Summary of email
     * @var string
     */
    private string $email;
    /**
     * Summary of password
     * @var string
     */
    private string $password;

    /**
     * Summary of __construct
     * @param string $lastName
     * @param string $password
     */
    public function __construct(string $email, string $password) {
        $this->email = $email;
        $this->password = $password;
    }

	/**
	 * @return string
	 */
	public function getEmail(): string {
		return $this->email;
	}

	/**
	 * Summary of password
	 * @return string
	 */
	public function getPassword(): string {
		return $this->password;
	}
	
}

?>