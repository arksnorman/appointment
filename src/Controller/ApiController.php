<?php

namespace App\Controller;


use App\Conversions\AppointmentConversion;
use App\Conversions\UserConversion;
use App\DataTable\DataTableInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiController
{
    public function appointments(DataTableInterface $dataTable) :Response
    {
        $conversion = new AppointmentConversion;
        $dataTable->setTable($conversion->getTableName());
        $dataTable->setColumns($conversion->getApiColumns());
        $dataTable->setPrimaryKey($conversion->getIdField());
        return new JsonResponse($dataTable->getData());
    }

    public function users(DataTableInterface $dataTable) :Response
    {
        $conversion = new UserConversion;
        $dataTable->setTable($conversion->getTableName());
        $dataTable->setColumns($conversion->getApiColumns());
        $dataTable->setPrimaryKey($conversion->getIdField());
        return new JsonResponse($dataTable->getData());
    }
}
