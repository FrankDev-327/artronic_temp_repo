<?php
session_start();
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include "../../middleware/check.authorizare.token.php";
include "../../middleware/check.role.user.php";
include_once "../../dto/books/create.dto.php";
include_once "../../services/books/book.service.php";

$data = json_decode(file_get_contents("php://input"));
$bookDto = new CreateBookDto(
    $data->userId,
    $data->title,
    $data->description,
    $data->publisher
);

$bookService = new BookService();
$bookCreated = $bookService->createNewRegister($bookDto);

if ($bookCreated) {
    http_response_code(200);
    echo json_encode([
        "message" => "Book created successfully."
    ]);
} else{
    http_response_code(401);
    echo json_encode([
        "message" => "Book could not be created."
    ]);
}

?>