<?php

namespace Tnaffh\ConnectLaravelNotificationChannel;

use DateTimeInterface;

class ConnectMessage
{
    /**
     * The message content.
     */
    public string $content = '';

    /**
     * Time of sending a message.
     */
    public DateTimeInterface $sendAt;

    final public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * Create a new message instance.
     *
     * @return static
     */
    public static function create(string $content = '')
    {
        return new static($content);
    }

    /**
     * Set the message content.
     *
     * @param  string  $content
     * @return $this
     */
    public function content($content): static
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Set the time the message should be sent.
     *
     *
     * @return $this
     */
    public function sendAt(DateTimeInterface $sendAt = null)
    {
        $this->sendAt = $sendAt;

        return $this;
    }
}
