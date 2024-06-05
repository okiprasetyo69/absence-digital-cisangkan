<?php

namespace App\Exports;

use App\Absence;
use App\Topic;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AbsenceExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    protected $absence_date;
    function __construct($absence_date)
    {
        $this->absence_date = $absence_date;
    }

    public function view(): View
    {
        return view('superadmin.modal.export_excel', [
            'data' => Absence::where('absence_date', $this->absence_date)
        ]);
    }
    /*
    public function collection()
    {
        $absences =  Absence::with(['topic'])->where('absence_date', $this->absence_date)->orderBy('absence_date', 'DESC');
        $absences = $absences->select('name', 'position', 'email', 'signature')->get();
        foreach($absences as $key => $value){
            if (!file_exists(public_path('upload/' . $value->signature))) {
                $value->signature_url = url('img/room-icon.png');
            } else {
                $value->signature_url = url('upload/'. $value->signature);
            }
        }
        return $absences;
    }

    public function startCell(): string
    {
        return 'B5';
    }
    public function registerEvents(): array
    {
        $topics = Topic::where('event_date', $this->absence_date)->first();
        $summary = (object)[
            'topic_name' => $topics->topic_name,
            'event_date' => $this->absence_date
        ];
        return [
            BeforeExport::class => function (BeforeExport $event) use ($summary) {
                $event->sheet->mergeCells('B1:E1');
                $event->sheet->mergeCells('B2:E2');
                $event->sheet->mergeCells('B3:E3');
                $event->sheet->appendRows([
                    ['LIST ABSENCE'],
                    ['Topic : ' . $summary->topic_name ],
                    ['Date : ' . $summary->event_date]
                ], $event);
                $event->sheet->getDelegate()->getHeaderFooter()->setOddHeader('My Header');
                $event->sheet->getDelegate()->getStyle('B1:E1')->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle('B2:E2')->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle('B3:E3')->getFont()->setSize(11);
                $event->sheet->getStyle('B1:BE')->getAlignment()->applyFromArray(
                    array('horizontal' => 'center', 'vertical' => 'center')
                );
                $event->sheet->getStyle('B1:E2')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ]
                ]);
            },

            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->mergeCells('B1:E5');
                $event->sheet->setCellValue('B1','Top Triggers Report');
                //$event->sheet->getDelegate()->mergeCells('B1:E1');
                $cellRange = 'B5:E5'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setName('Calibri');
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $event->sheet->getStyle($cellRange)->getAlignment()->applyFromArray(
                    array('horizontal' => 'center', 'vertical' => 'center')
                );
            },
        ];
    }


    public function title(): string
    {
        return 'Absence';
    }

    public function headings(): array
    {
        return [
            'Name',
            'Position',
            'Email',
            'Signature File',
            'Signature',
        ];
    }
    public function headingRow(): int
    {
        return 2;
    }
    */
}
