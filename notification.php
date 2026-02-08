<?php
declare(strict_types=1);

// Реализовываем нотификации

interface Notification
{
    public function send(string $message): bool;

    public function getType(): string;
}

class EmailNotification implements Notification
{
    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function send(string $message): bool
    {
        return $this->sendEmail($this->email, $message);
    }

    private function sendEmail(string $email, string $message): bool
    {
        return mail($email, "notification", $message);
    }

    public function getType(): string
    {
        return "email";
    }
}

class SMSNotification implements Notification
{
    private string $phone_number;

    public function __construct(string $phone_number)
    {
        $this->phone_number = $phone_number;
    }

    public function send(string $message): bool
    {
        return $this->sendSMS($this->phone_number, $message);
    }

    private function sendSMS(string $phone_number, string $message): bool
    {
        //SMS code send realization
        return true;
    }

    public function getType(): string
    {
        return "sms";
    }

}

class TelegramNotification implements Notification
{
    private string $username_id;

    public function __construct(string $username_id)
    {
        $this->username_id = $username_id;
    }

    public function send(string $message): bool
    {
        return $this->sendToTelegram($this->username_id, $message);
    }

    private function sendToTelegram(string $username_id, string $message): bool
    {
        //telegram message code realization
        return true;
    }

    public function getType(): string
    {
        return "telegram";
    }
}


// Единая функция отправки
function notifyUser(Notification $notification, string $message): string
{
    echo "Sending through " . $notification->getType() . "...";
    if ($notification->send($message)) {
        return "Success!\nNotification has been sent: '{$message}'\n\n";
    }
    return "Failure!\n\n";
}

$notificationEmail = new EmailNotification("example@mail.com");
$notificationSMS = new SMSNotification("+79995554422");
$notificationTelegram = new TelegramNotification("user_1999235");

echo notifyUser($notificationEmail, "Buy GOLD~!NOW!");
echo notifyUser($notificationSMS, "Verification Code: 4444");
echo notifyUser($notificationTelegram, "New message from 'Angela'");