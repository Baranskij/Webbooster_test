<meta http-equiv='refresh' content='3; url=#'>
<style>
   * {
     margin: 0;
     padding: 0;
     box-sizing: border-box;
   }
  .feedback-wrapper {
    width: 100%;
    min-height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    overflow: hidden;
    position: fixed;
    top: 0px;
    z-index: 2;
  }
  .feedback {
    width: 670px;
    position: fixed;
    top: 15%;
    z-index: 5;
    left: 50%;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-left: -300px;
    background-color: #fff;
    border-radius: 10px;
    color: #000;
    font-size: 26px;
    line-height: 30px;

  }
.feedbacktext {
    padding:40px;
}
 </style>

<?php
// Файлы phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Переменные, которые отправляет пользователь
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$file = $_FILES['myfile'];
// Формирование самого письма
$title = "Заказ сайта";

// Создаем письмо
$mail = new PHPMailer();
$mail->isSMTP();                   // Отправка через SMTP
$mail->Host   = '';  // Адрес SMTP сервера
$mail->SMTPAuth   = true;          // Enable SMTP authentication
$mail->Username   = '';       // ваше имя пользователя (без домена и @)
$mail->Password   = '';    // ваш пароль
$mail->SMTPSecure = 'ssl';         // шифрование ssl
$mail->Port   = 465;               // порт подключения
$mail->CharSet = "utf-8";
$mail->setFrom('', '');    // от кого
$mail->addAddress(''); // кому

$mail->Subject = $title;
$mail->msgHTML("
                <html>
                    <body>
                        <h1>Сообщение с siwebsait.ru</h1>
                        <div style=\"max-width: 340px\">
                          <div style='margin-left:10px;margin-bottom:10px;border-bottom:1px solid #cecece;padding-bottom:10px;'>
                            <b style='font-size: 18px;padding-right:15px;'> Имя: </b>
                            <span>$name</span>
                          </div>
                          <div style='margin-left:10px;margin-bottom:10px;border-bottom:1px solid #cecece;padding-bottom:10px;'>
                            <b style='font-size: 18px;padding-right:15px;'> Телефон: </b>
                            <span>$phone</span>
                          </div>
                          <div style='margin-left:10px;margin-bottom:10px;border-bottom:1px solid #cecece;padding-bottom:10px;'>
                            <b style='font-size: 18px;padding-right:15px;'> Почта: </b>
                            <span>$email</span>
                          </div>  
                          <div style='margin-left:10px;margin-bottom:10px;border-bottom:1px solid #cecece;padding-bottom:10px;'>
                            <b style='font-size: 18px;padding-right:15px;'> Сообщение: </b>
                            <span>$message</span>
                          </div>
                        </div>
                    </body>
                </html>
                ");
// Отправляем
if ($mail->send()) {
    echo "<div class='feedback-wrapper'>";
    echo "<div class='feedback'>";
    echo "<p class='feedbacktext'>Спасибо! Ваша заявка успешно отправлена, в самое ближайшее время с Вами свяжется наш менеджер!</p>";
    echo "</div>";
    echo "</div>";
} else {
    echo 'Ошибка: ' . $mail->ErrorInfo;
}