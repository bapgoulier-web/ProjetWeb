<?php


namespace Helpers;

class Message
{
    public const COLOR_SUCCESS = 'green lighten-2';
    public const COLOR_ERROR = 'red lighten-2';
    public const COLOR_INFO = 'light-blue lighten-1';

    private string $message;
    private string $color;
    private string $title;

    public function __construct(
        string $message,
        string $color = self::COLOR_INFO,
        string $title = "Message"
    )
    {
        $this->message = $message;
        $this->color = $color;
        $this->title = $title;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
