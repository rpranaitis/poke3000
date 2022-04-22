<?php

namespace App\Controllers;

use App\Exceptions\ServiceException;
use App\Helper;
use App\Services\DataImportService;

class ServiceController
{
    /**
     * @var DataImportService
     */
    protected DataImportService $dataImportService;

    public function __construct()
    {
        $this->dataImportService = new DataImportService();
    }

    /**
     * @return string
     * @throws ServiceException
     */
    public function importUsersFromCsv(): string
    {
        $failedImports = $this->dataImportService->importUsersFromCsv();

        $data = [
            'failed_imports' => $failedImports
        ];

        return Helper::response('Importavimas baigtas.', $data);
    }

    /**
     * @return string
     * @throws ServiceException
     */
    public function importPokesFromJson(): string
    {
        $failedImports = $this->dataImportService->importPokesFromJson();

        $data = [
            'failed_imports' => $failedImports
        ];

        return Helper::response('Importavimas baigtas.', $data);
    }
}