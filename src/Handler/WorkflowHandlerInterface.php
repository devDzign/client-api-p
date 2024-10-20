<?php

declare(strict_types=1);

namespace InterInvest\ClientApiPer\Handler;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag]
interface WorkflowHandlerInterface
{
    public function handle(EventMessageInterface $eventMessage): void;

    public function supports(EventMessageInterface $eventMessage): bool;
}
