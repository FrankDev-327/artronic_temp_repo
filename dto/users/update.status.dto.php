<?php 
/**
 * Summary of UpdateStatusDto
 */
class UpdateStatusDto {
    /**
     * Summary of active
     * @var bool
     */
    private bool $active;

    /**
     * Summary of __construct
     * @param bool $active
     */
    public function __construct(bool $active) {
        $this->active = $active;
    }

	/**
	 * Summary of status
	 * @return bool
	 */
	public function getStatus(): bool {
		return $this->active;
	}
}
?>