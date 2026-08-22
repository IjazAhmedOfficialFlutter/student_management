<?php

namespace Config;

use CodeIgniter\Config\BaseService;
use App\Services\ApiService;

class Services extends BaseService
{
    /**
     * ASP.NET API Service
     */
    public static function apiService(
        bool $getShared = true
    ) {
        if ($getShared) {

            return static::getSharedInstance(
                'apiService'
            );
        }

        return new ApiService();
    }
}