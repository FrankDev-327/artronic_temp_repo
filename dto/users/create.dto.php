<?php

class CreateDto {
    /**
     * Summary of name
     * @var string
     */
    private string $name;

    /**
     * Summary of password
     * @var string
     */
    private string $password;
    /**
     * Summary of lastName
     * @var string
     */
    private string $lastName;
    /**
     * Summary of email
     * @var string
     */
    private string $email;
    /**
     * Summary of role
     * @var string
     */
    private string $role;
    /**
     * Summary of active
     * @var bool
     */
    private bool $active;

    public function __construct
        (
            string $name, 
            string $password,
            string $lastName, 
            string $email, 
            string $role, 
            bool $active
        ) {
        $this->name = $name;
        $this->password = $password;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->role = $role;
        $this->active = $active;
    }

	/**
	 * @return string
	 */
	public function getName(): string {
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getLastName(): string {
		return $this->lastName;
	}

	/**
	 * Summary of email
	 * @return string
	 */
	public function getEmail(): string {
		return $this->email;
	}
	
	/**
	 * Summary of role
	 * @return string
	 */
	public function getRole(): string {
		return $this->role;
	}
	
	/**
	 * Summary of active
	 * @return bool
	 */
	public function getActive(): bool {
		return $this->active;
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