<?php 
    session_start();
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    header("Content-Type: application/json; charset=UTF-8");

    include "../../middleware/check.authorizare.token.php";
    include "../../middleware/check.role.user.php";
    include "../../services/books/book.service.php";

    $bookService = new BookService();
    $books = $bookService->getListRegisters();

    if(count($books) <= 0) {
        http_response_code(404);
        echo json_encode([
            "message" => "No record found."
        ]);
        die();
    } 

    http_response_code(200);
    echo json_encode($books);
?>