<?php

class UpdateDto {
    /**
     * Summary of name
     * @var string
     */
    private string $name;

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
    private ?string $role;
    /**
     * Summary of active
     * @var bool
     */
    private bool $active;

    /**
     * Summary of bookId
     * @var string
     */
    private ?string $bookId; // The ? indicates that it can be null

    public function __construct
        (
            string $name, 
            string $lastName, 
            string $email, 
            string $role, 
            bool $active,
            string $bookId
        ) {
        $this->name = $name;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->role = $role;
        $this->active = $active;
        $this->bookId = $bookId;
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
	 * Summary of bookId
	 * @return string
	 */
	public function getBookId(): string {
		return $this->bookId;
	}
}

?>