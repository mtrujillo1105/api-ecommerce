<?php

namespace Src\Administrator\AffiliateNotification\Domain\Contracts;

use Src\Administrator\AffiliateNotification\Domain\AffiliateNotification;
use Src\Administrator\AffiliateNotification\Domain\ValueObjects\AffiliateNotificationIdSis;

interface AffiliateNotificationRepositoryContract
{
    public function save(AffiliateNotification $affiliateNotification): ?int;
    public function update(AffiliateNotificationIdSis $idSis, AffiliateNotification $affiliateNotification): ?int;
    public function findByIdSis(AffiliateNotificationIdSis $idSis): ?int;
}
