<?php 

include "../../repository/book.repository.php";
include "../../dto/books/create.dto.php";

class BookService {

    /**
     * Summary of bookRepository
     * @var 
     */
    private $bookRepository;

    public function __construct() {
        $this->bookRepository = new BookRepository();
    }

    public function getListRegisters() {
        return $this->bookRepository->findAll();
    }

    public function createNewRegister(CreateBookDto $data): bool {
        return $this->bookRepository->save($data);
    }
}
?>