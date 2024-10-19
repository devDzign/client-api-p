<?php

declare(strict_types=1);

namespace InterInvest\ClientApiPer\Activity;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag]
interface ActivityInterface
{
    public function run(): mixed;

    public static function activityName(): string;
}
