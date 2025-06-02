<?php

namespace App\Services\Implementations;

use App\Repository\Contracts\CityRepositoryInterface;
use App\Services\Contracts\ConfigServiceInterface;
use App\Repository\Contracts\ConfigRepositoryInterface;

class ConfigService implements ConfigServiceInterface
{
    protected $configRepository;
    protected $cityRepo;

    public function __construct(
        ConfigRepositoryInterface $configRepository,
        CityRepositoryInterface $cityRepo
    ) {
        $this->configRepository = $configRepository;
        $this->cityRepo = $cityRepo;
    }

    public function getConfig()
    {
        $cities = $this->cityRepo->getAllCities();
        $config = $this->configRepository->getConfig();
        return [
            'config' => $config,
            'cities' => $cities,
        ];
    }
}
