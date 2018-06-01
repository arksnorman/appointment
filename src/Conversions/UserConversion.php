<?php
/**
 * Created by PhpStorm.
 * User: arksnorman
 * Date: 6/1/18
 * Time: 4:36 AM
 */

namespace App\Conversions;


class UserConversion implements IConversion
{
    public function getTableName(): string
    {
        return 'user';
    }

    public function getIdField(): string
    {
        return 'id';
    }

    public function getApiColumns(): array
    {
        return [
            ['db' => 'id', 'dt' => 0],
            ['db' => 'username', 'dt' => 1],
            ['db' => 'email', 'dt' => 2],
            ['db' => 'first_name', 'dt' => 3],
            ['db' => 'last_name', 'dt' => 4],
            ['db' => 'phone_number', 'dt' => 5],
            ['db' => 'roles', 'dt' => 6],
            ['db' => 'last_login', 'dt' => 7,
                'formatter' => function($d) { return date('jS M y', strtotime($d)); }
            ],
            ['db' => 'id', 'dt' => 8,
                'formatter' => function($id)
                {
                    return "
                        <a class='btn btn-primary' href='/user/$id/'><i class='fa fa-eye-slash'></i> Show</a>
                        <a class='btn btn-warning' href='/user/$id/edit/'><i class='fa fa-edit'></i> Edit</a>
                    ";
                }
            ]
        ];
    }
}