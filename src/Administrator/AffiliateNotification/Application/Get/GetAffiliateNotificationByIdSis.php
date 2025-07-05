<?php

namespace Src\Administrator\AffiliateNotification\Application\Get;

use Src\Administrator\AffiliateNotification\Domain\Contracts\AffiliateNotificationRepositoryContract;
use Src\Administrator\AffiliateNotification\Domain\ValueObjects\AffiliateNotificationIdSis;

final class GetAffiliateNotificationByIdSis
{
    private $repository;

    public function __construct(AffiliateNotificationRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        int $idSis,
    ): ?int {
        $idSis = new AffiliateNotificationIdSis($idSis);
        return $this->repository->findByIdSis($idSis);
    }
}
