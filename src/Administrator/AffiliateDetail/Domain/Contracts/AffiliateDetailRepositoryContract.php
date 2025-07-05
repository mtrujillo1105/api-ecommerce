<?php

declare(strict_types=1);

namespace Src\Administrator\AffiliateDetail\Domain\Contracts;

use Src\Administrator\AffiliateDetail\Domain\AffiliateDetail;

interface AffiliateDetailRepositoryContract
{
    public function save(AffiliateDetail $afiliDetail): ?int;
}
