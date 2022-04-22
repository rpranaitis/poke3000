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
        $imports = $this->dataImportService->importUsersFromCsv();

        return Helper::response('Importavimas baigtas.', $imports);
    }

    /**
     * @return string
     * @throws ServiceException
     */
    public function importPokesFromJson(): string
    {
        $imports = $this->dataImportService->importPokesFromJson();

        return Helper::response('Importavimas baigtas.', $imports);
    }
}