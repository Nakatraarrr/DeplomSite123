<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Check that data was sent
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Set a 400 (bad request) response code and exit.
        http_response_code(400);
        echo "Пожалуйста, заполните все поля формы и попробуйте снова.";
        exit;
    }

    // Set the recipient email address.
    $recipient = "mishazavrazhin1998@gmail.com"; // Замените на ваш email

    // Set the email subject.
    $subject = "Новое сообщение с сайта от $name";

    // Build the email content.
    $email_content = "Имя: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Сообщение:\n$message\n";

    // Build the email headers.
    $email_headers = "From: $name <$email>";

    // Send the email.
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // Set a 200 (okay) response code.
        http_response_code(200);
        echo "Спасибо! Ваше сообщение было отправлено.";
    } else {
        // Set a 500 (internal server error) response code.
        http_response_code(500);
        echo "Упс! Что-то пошло не так, и мы не смогли отправить ваше сообщение.";
    }

} else {
    // Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    echo "Возникла проблема с отправкой вашей формы. Попробуйте снова.";
}
?>