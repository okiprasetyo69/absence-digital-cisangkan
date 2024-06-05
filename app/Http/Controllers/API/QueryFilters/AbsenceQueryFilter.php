<?php

namespace App\Http\Controllers\Api\QueryFilters;
use App\Http\Controllers\Api\QueryFilters\BaseQueryFilter;

class AbsenceQueryFilter extends BaseQueryFilter
{
    private $id;
    private $name;
    private $email;


    function __construct($request)
    {
        parent::__construct($request);
        $this->id = isset($request['id']) ? $request['id'] : 0;
        $this->absence_date = isset($request['absence_date']) ? $request['absence_date'] : null;
        $this->name = isset($request['name']) ? $request['name'] : null;
        $this->position = isset($request['position']) ? $request['position'] : null;
    }

    public function get_absence_id()
    {
        return $this->id;
    }

    public function get_user_name()
    {
        return $this->name;
    }

    public function get_user_position()
    {
        return $this->position;
    }
}
