<?php

namespace Src\Administrator\Notification\Domain\Contracts;

use Src\Administrator\Notification\Domain\Notification;

interface NotificationRepositoryContract
{
    public function save(Notification $notification): ?int;

}
