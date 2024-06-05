<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseApiController extends Controller
{
    protected $response = array(
        'status' => 200,
        'message' => '',
        'data' => null
    );

    protected $jquery_datatable_response = array(
        'status' => 200,
        'draw' => 1,
        'recordsTotal' => 0,
        'recordsFiltered' => 0,
        'data' => []
    );

    public function set_datatable_response($draw, $record_total, $data)
    {
        $this->jquery_datatable_response['draw'] = $draw;
        $this->jquery_datatable_response['recordsTotal'] = $record_total;
        $this->jquery_datatable_response['recordsFiltered'] = $record_total;
        $this->jquery_datatable_response['data'] = $data;
        return $this->jquery_datatable_response;
    }

    public function success_response_datatable()
    {
        return response()->json($this->jquery_datatable_response, 200);
    }

    public function success_response($data = "")
    {
        $this->response['data'] = $data;
        $this->response['status'] = 200;
        return $this->show_response();
    }

    public function error_response($message = "")
    {
        $this->response['message'] = $message;
        $this->response['status'] = 500;
        return $this->show_response();
    }

    private function show_response()
    {
        return response()->json($this->response, $this->response['status']);
    }
}
