<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseApiController;
use App\Absence;
use App\Exports\AbsenceExport;
use App\Http\Controllers\Api\QueryFilters\AbsenceQueryFilter;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
class AbsenceApiController extends BaseApiController
{
    public function index()
    {
        return Absence::all();
    }

    public function getListDataAbsence(Request $request){
        $absenceQueryFilter = new AbsenceQueryFilter($request->all());
        $absenceQuery = Absence::with(['topic'])->orderBy('absence_date', 'DESC');
       
        if ($absenceQueryFilter->get_search_text() != null) {
            $absenceQuery = $absenceQuery->where("name", "like", "%" . $absenceQueryFilter->get_search_text() . "%");
        }

        if($request->absence_date != ""){
            $absenceQuery = $absenceQuery->where('absence_date', $request->absence_date);
        }
        
        $count = (clone $absenceQuery)->count();
        $result = $absenceQuery->limit($absenceQueryFilter->get_length())->offset($absenceQueryFilter->get_start());

        $data_get = $result->get();

        foreach ($data_get as $key => $value) {
            if (!file_exists(public_path('upload/' . $value->signature))) {
                $value->signature_url = url('img/room-icon.png');
            } else {
                $value->signature_url = url('upload/' . $value->signature);
            }
        }

        $data = $this->set_datatable_response($absenceQueryFilter->get_draw(), $count, $result->get());
        return $this->success_response_datatable();
    }

    public function save(Request $request)
    {
          
        $rule = [
            'absence_date' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'position'=> 'required',
            'topic_id'=> 'required',
            'signed' => 'required',
        ];
        $validator = Validator::make($request->all(), $rule);
        if($validator->fails()){
            return response($validator->messages()->toArray(), 400);
        }

        $curr_guest = Absence::where(['email'=>$request->email, 'absence_date'=>$request->absence_date])->first();
        
        if($curr_guest){
            return response()->json(['message'=>'You have done absent today !', 'status'=>400]);
        }
        else if($request->topic_id == 0){
            return response()->json(['message'=>'Dont have event name today !', 'status'=>401]);
        } 
        else {
            $folderPath = public_path('upload/');
            $image_parts = explode(";base64,", $request->signed);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;
            file_put_contents($file, $image_base64);

            $topic_id = $request->topic_id;
            $absence_date = $request->absence_date;
            $absence_name = $request->name; 
            $absence_email = $request->email;
            $absence_position = $request->position;
            $absence_signature = $signature;
           
            $data = [
                    'topic_id' => $topic_id,
                    'absence_date' => $absence_date,
                    'name' => $absence_name, 
                    'email' => $absence_email, 
                    'position' => $absence_position, 
                    'signature' => $absence_signature
                ];

            $create_absence = Absence::create($data);
            return response()->json(['success'=>'Form is successfully submitted!', 'data' => $data ]);
        }
    }

    public function exportExcelAbsence(Request $request){
        
        $rule = [
            'absence_date' => 'required'
        ];
        $validator = Validator::make($request->all(), $rule);
        if($validator->fails()){
            return response($validator->messages()->toArray(), 400);
        }
        
        return Excel::download(new AbsenceExport($request->absence_date), 'Absence.xlsx');
        //return response()->json('Success export', 200);
    }

    public function absencePerDate(Request $request){
        $rule = [
            'absence_date' => 'required'
        ];
        $validator = Validator::make($request->all(), $rule);
        if($validator->fails()){
            return response($validator->messages()->toArray(), 400);
        }

        $absenceQuery = Absence::where('absence_date', $request->absence_date)->get();
        return response()->json($absenceQuery, 200);
    }

    public function exportPDF(Request $request){
        $query = Absence::with(['topic'])->where('absence_date', $request->absence_date)->get();
        foreach ($query as $row) {
            /*
            if (!file_exists(public_path('upload/' . $value->signature))) {
                $value->signature_url = url('img/room-icon.png');
            } else {
                $value->signature_url = url('upload/' . $value->signature);
            }
            */
            //$table .='';
        }

    }
}
