<?php

namespace App\Http\Controllers\Api\QueryFilters;

class BaseQueryFilter
{
    private $draw = 1;
    private $length = 10;
    private $page = 0;
    private $search_text;
    private $id;

    function __construct($request)
    {
        $this->draw = isset($request['draw']) ? $request['draw'] : 1;
        $this->length = isset($request['length']) ? $request['length'] : 10;
        $this->page = isset($request['page']) ? $request['page'] : 0;
        $this->search_text = isset($request['search_text']) ? $request['search_text'] : null;
        $this->id = isset($request['id']) ? $request['id'] : null;
        $this->with_trash = isset($request['with_trash']) ? $request['with_trash'] : false;
    }
    public function get_draw()
    {
        return $this->draw;
    }

    public function get_length()
    {
        return $this->length;
    }

    public function get_page()
    {
        return $this->page;
    }

    public function get_search_text()
    {
        return $this->search_text;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_start()
    {
        if ($this->page > 0 && $this->length > 0) {
            return ($this->page - 1) * $this->length;
        }

        return 0;
    }

    public function get_start_with_length_custom($length)
    {
        if ($this->page > 0 && $length > 0) {
            return ($this->page - 1) * $length;
        }

        return 0;
    }
}
