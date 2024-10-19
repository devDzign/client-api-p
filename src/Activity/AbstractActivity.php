<?php

declare(strict_types=1);

namespace InterInvest\ClientApiPer\Activity;

abstract class AbstractActivity implements ActivityInterface
{
    public function run(mixed ...$arguments): mixed
    {
        if (!method_exists($this, 'execute')) {
            throw new \BadMethodCallException('Execute method not implemented.');
        }

        // Si la méthode existe, on l'exécute avec les paramètres passés
        return $this->execute(...$arguments);
    }

    public static function activityName(): string
    {
        return static::class;
    }
}
