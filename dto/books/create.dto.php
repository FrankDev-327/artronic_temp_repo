<?php 

class CreateBookDto {
    /**
     * Summary of userId
     * @var string
     */
    private string $userId;

    /**
     * Summary of title
     * @var string
     */
    private string $title;

    /**
     * Summary of description
     * @var string
     */
    private string $description;

    /**
     * Summary of publisher
     * @var string
     */
    private string $publisher;

    /**
     * Summary of __construct
     * @param string $userId
     * @param string $title
     * @param string $description
     * @param string $publisher
     */
    public function __construct(
        string $userId,
        string $title,
        string $description,
        string $publisher
    ) {
        $this->userId = $userId;
        $this->title = $title;
        $this->description = $description;
        $this->publisher = $publisher;
    }

	/**
	 * Summary of publisher
	 * @return string
	 */
	public function getPublisher(): string {
		return $this->publisher;
	}

	/**
	 * Summary of description
	 * @return string
	 */
	public function getDescription(): string {
		return $this->description;
	}

	/**
	 * Summary of title
	 * @return string
	 */
	public function getTitle(): string {
		return $this->title;
	}

	/**
	 * Summary of userId
	 * @return string
	 */
	public function getUserId(): string {
		return $this->userId;
	}
}

?>