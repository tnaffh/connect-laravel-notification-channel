<?php

namespace Tnaffh\ConnectLaravelNotificationChannel\Exceptions;

use Tnaffh\ConnectLaravelNotificationChannel\ConnectMessage;

class CouldNotSendNotification extends \Exception
{
    public static function invalidMessageObject($message): self
    {
        $className = is_object($message) ? get_class($message) : 'Unknown';

        return new static(
            "Notification was not sent. Message object class `{$className}` is invalid. It must
            be `".ConnectMessage::class.'`');
    }

    public static function missingFrom(): self
    {
        return new static('Notification was not sent. Missing `from` number.');
    }

    public static function invalidText(): self
    {
        return new static('Notification was not sent. Invalid `text`. Messagge must be a string.');
    }

    public static function invalidReceiver(): self
    {
        return new static(
            'The notifiable did not have a receiving phone number. Add a routeNotificationForConnectSms
            method or a phone_number attribute to your notifiable.'
        );
    }
}
