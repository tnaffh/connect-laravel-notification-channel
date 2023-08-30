<?php

namespace Tnaffh\ConnectLaravelNotificationChannel;

use Exception;
use Illuminate\Notifications\Events\NotificationFailed;
use Illuminate\Notifications\Notification;
use Tnaffh\ConnectLaravelNotificationChannel\Exceptions\CouldNotSendNotification;
use Tnaffh\ConnectSms\ConnectSms;

class ConnectChannel
{
    protected ConnectSms $api;

    protected $events;

    public function __construct(ConnectSms $api)
    {
        $this->api = $api;
    }

    public function send($notifiable, Notification $notification)
    {

        try {
            $to = $this->getTo($notifiable, $notification);
            $message = $notification->toConnect($notifiable);

            if (is_string($message)) {
                $message = new ConnectMessage($message);
            }

            if (! $message instanceof ConnectMessage) {
                throw CouldNotSendNotification::invalidMessageObject($message);
            }

            return $this->api->send(to: $to, message: $message->text
            );

        } catch (Exception $exception) {
            $event = new NotificationFailed(
                $notifiable,
                $notification,
                'connect',
                ['message' => $exception->getMessage(), 'exception' => $exception]
            );

            $this->events->dispatch($event);

            throw $exception;
        }
    }

    public function getTo($notifiable, Notification $notification = null)
    {
        /*if ($notifiable->routeNotificationFor(self::class, $notification)) {
            return $notifiable->routeNotificationFor(self::class, $notification);
        }*/
        if ($notifiable->routeNotificationFor('connect')) {
            return $notifiable->routeNotificationFor('connect');
        }
        if (isset($notifiable->phone_number)) {
            return $notifiable->phone_number;
        }

        throw CouldNotSendNotification::invalidReceiver();
    }
}
