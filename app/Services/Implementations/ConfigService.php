<?php

namespace App\Services\Implementations;

use App\Services\Contracts\ConfigServiceInterface;
use App\Repository\Contracts\ConfigRepositoryInterface;

class ConfigService implements ConfigServiceInterface
{
    protected $configRepository;

    public function __construct(ConfigRepositoryInterface $configRepository)
    {
        $this->configRepository = $configRepository;
    }

    public function getConfig()
    {
        return $this->configRepository->getConfig();
    }
}
