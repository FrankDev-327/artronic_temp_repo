    <?php
    include "./check.session.php";
    if($_SESSION['user_role'] !== 'ADMIN') {
        http_response_code(400);
        echo json_encode([
            "message" => "You do not have permission to make this action."
        ]);
        die();
    }

    ?>