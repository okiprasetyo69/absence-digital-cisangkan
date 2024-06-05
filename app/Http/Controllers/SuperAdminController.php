<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Absence;
use App\Exports\AbsenceExport;
use App\Topic;
use Barryvdh\DomPDF\Facade as PDF;
use Mpdf\Mpdf;
use App\Http\Controllers\View;
use Illuminate\Support\Facades\Validator;

class SuperAdminController extends Controller
{
    public function index()
    {
        return view('superadmin.index');
    }

    public function userSettings(){
        return view('users.index');
    }

    public function absence(){
        return view('absence.index');
    }

    public function topics(){
        return view('topic.index');
    }

    public function getAbsenceReport($event_date, Request $request){
        $topic = Topic::where('event_date', $event_date)->first();
        $data = Absence::where('absence_date', $event_date)->get();
        //dd($topic);die;
        //$data = Absence::all();
        //return  View("superadmin/modal/export_excel")->with("datas", $data);
        //return $data;
    }
    public function exportAbsences($absence_date_val, Request $request){
        return Excel::download(new AbsenceExport($absence_date_val), 'Absence.xlsx');
    }

    public function exportAbsencesToExcel(Request $request){
        return Excel::download(new AbsenceExport($request->absence_date), 'Absence.xlsx');
    }

    public function exportPDFAbsence($absence_date, Request $request){
        /*
        $data = ['title' => 'Report Absence'];
        $pdf = PDF::loadView('superadmin.modal.export_excel', $data);
        return $pdf->download('Report-Absence.pdf');
        */

        $topic = Topic::where('event_date', $absence_date)->first();
        $query = Absence::where('absence_date', $absence_date)->get();

        if(!$topic){
            return "<table style='margin-left: auto;  margin-right: auto; width: 100%;'><thead>
            <tr>
                <th colspan='4'> Don't have Report List Absence. Please back !</th>
            </tr> 
            </thead>
            <tbody>
            </tbody>
            </table>";
        }
        
        $table = "";
        $no = 1;
        $event_date = "";
        $topic_name = "";
        $location = "";
        if($topic->event_date != null){
            $event_date = date('d-m-Y', strtotime($topic->event_date));
        } else {
            $event_date = "-";
        }

        if($topic->topic_name){
            $topic_name = $topic->topic_name;
        } else {
            $topic_name = "-";
        }

        if($topic->location){
            $location = $topic->location ;
        } else {
            $location = "";
        }

        foreach($query as $row){
            $image = "";
            if(!file_exists(public_path('upload/' . $row->signature))){
                $image = "<img src='".public_path().'/images/signture_default.png'."' style='height:100px; width:100px;' />";
            } else {
                $image = "<img src='".public_path().'/upload/'.$row->signature.'" '. "' style='height:100px; width:100px;'/>";
            }
           
            $table .= "<tr style='border: 1px solid black;'><td style='border: 1px solid black; margin-left: auto;  margin-right: auto;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row->name."</td><td style='border: 1px solid black; margin-left: auto;  margin-right: auto;'>".$row->email."</td><td style='border: 1px solid black; margin-left: auto;  margin-right: auto;'>".$row->position."</td><td style='border: 1px solid black; margin-left: auto;  margin-right: auto;'>".$image."</td></tr>";
        }
        $mpdf = new Mpdf();
        $mpdf->showImageErrors = true;
        $mpdf->SetTitle('Report Absence');
        $mpdf->WriteHTML("<div class='container'> 
                            <div class='row'>
                                <div class='col'> 
                                    <table style='margin-left: auto;  margin-right: auto; width: 100%;'> 
                                        <thead>
                                            <tr>
                                                <th colspan='4'> Report List Absence</th>
                                            </tr> 
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                                <hr>
                                <div class='col'> 
                                    <table class='table table-border'> 
                                        <thead>
                                            <tr> 
                                                <th> Event Date &nbsp; : </th>
                                                <th> " . $event_date ." </th>
                                            </tr>
                                            <tr> 
                                                <th> Topic Name : </th>
                                                <th> ". $topic_name ." </th>
                                            </tr>
                                            <tr> 
                                                <th>Location &nbsp;&nbsp; &nbsp; &nbsp;: </th>
                                                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ". $location ." </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                               
                                <div class='col'> 
                                    <table style='border: 1px solid black;
                                    border-collapse: collapse; width: 100%; margin-top:5mm;'> 
                                        <thead>
                                            <tr style='margin-right: auto; '>
                                                <th style='border: 1px solid black;'>Name</th>
                                                <th style='border: 1px solid black;'>Email</th>
                                                <th style='border: 1px solid black;'>Position</th>
                                                <th style='border: 1px solid black;'>Signature</th>
                                            </tr>
                                        </thead>
                                        <tbody>".$table."</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>");
        
        $mpdf->debug = true; 
        $mpdf->Output('Report-Absence.pdf','I');
        exit;
    }

    public function listStaff()
    {
        return view('superadmin.staff_employee');
    }

    public function addStaff()
    {
        return view('superadmin.add_staff');
    }

    public function detailStaff()
    {
        return view('superadmin.detail_staff');
    }
}
