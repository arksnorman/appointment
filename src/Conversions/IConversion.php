<?php

namespace App\Conversions;


interface IConversion
{
    public function getTableName() :string;
    public function getIdField() :string;
    public function getApiColumns() :array;
}
