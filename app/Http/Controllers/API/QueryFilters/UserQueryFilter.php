<?php

namespace App\Http\Controllers\Api\QueryFilters;

use App\Http\Controllers\Api\QueryFilters\BaseQueryFilter;

class UserQueryFilter extends BaseQueryFilter
{
    private $id;
    private $name;
    private $email;


    function __construct($request)
    {
        parent::__construct($request);
        $this->id = isset($request['id']) ? $request['id'] : 0;
        $this->name = isset($request['name']) ? $request['name'] : 0;
        $this->email = isset($request['email']) ? $request['email'] : null;
    }

    public function get_user_id()
    {
        return $this->id;
    }

    public function get_user_name()
    {
        return $this->name;
    }

    public function get_email_user()
    {
        return $this->email;
    }
}
