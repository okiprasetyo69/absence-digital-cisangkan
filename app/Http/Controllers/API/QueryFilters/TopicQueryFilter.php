<?php

namespace App\Http\Controllers\Api\QueryFilters;
use App\Http\Controllers\Api\QueryFilters\BaseQueryFilter;

class TopicQueryFilter extends BaseQueryFilter
{
    private $id;
    private $topic_name;
    private $location;
    private $event_date;

    function __construct($request)
    {
        parent::__construct($request);
        $this->id = isset($request['id']) ? $request['id'] : 0;
        $this->topic_name = isset($request['topic_name']) ? $request['topic_name'] : null;
        $this->location = isset($request['location']) ? $request['location'] : null;
        $this->event_date = isset($request['event_date']) ? $request['event_date'] : null;
    }

    public function get_absence_id()
    {
        return $this->id;
    }

    public function get_topic_name()
    {
        return $this->topic_name;
    }

    public function get_event_location()
    {
        return $this->location;
    }

    public function get_event_date()
    {
        return $this->event_date;
    }
}
