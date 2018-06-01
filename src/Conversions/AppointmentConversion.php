<?php

namespace App\Conversions;


class AppointmentConversion implements IConversion
{
    public function getTableName(): string
    {
        return 'appointment';
    }

    public function getIdField(): string
    {
        return 'id';
    }

    public function getApiColumns(): array
    {
        return [
            ['db' => 'id', 'dt' => 0],
            ['db' => 'disease', 'dt' => 1],
            ['db' => 'status', 'dt' => 2],
            ['db' => 'date_created', 'dt' => 3,
                'formatter' => function($d) { return date('jS M y', strtotime($d)); }
            ],
            ['db' => 'schedule_date', 'dt' => 4,
                'formatter' => function($d) { return $d ? date('jS M y', strtotime($d)) : ''; }
            ],
            ['db' => 'id', 'dt' => 5,
                'formatter' => function($id)
                {
                    return "
                        <a class='btn btn-primary' href='/appointment/$id'><i class='fa fa-eye-slash'></i> Show</a>
                        <a class='btn btn-warning' href='/appointment/$id/edit/'><i class='fa fa-edit'></i> Schedule</a>
                    ";
                }
            ]
        ];
    }
}