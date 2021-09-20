<?php

namespace App\Exports;

use App\Models\User;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class FileExport implements WithColumnWidths, WithStyles, FromCollection, WithHeadings, WithEvents
{
    protected $number;

    function __construct($number)
    {
        $this->number = $number;
    }

    public function collection()
    {
        $reports = [];
        for ($i = 1; $i < $this->number + 1; $i++) {
            $reports[] = [
                'no' => $i,
            ];
        }
        return collect($reports);
    }

    public function registerEvents(): array
    {
        return [
            // handle by a closure.
            AfterSheet::class => function (AfterSheet $event) {
                // get layout counts (add 1 to rows for heading row)
                $row_count = 1;
                $column_count = 5;

                // set dropdown column
                $drop_column = 'J';

                // set dropdown options
                $options = ['JTU', 'OSM', 'PMU'];

                // set dropdown list for first data row
                $validation = $event->sheet->getCell("{$drop_column}2")->getDataValidation();
                $validation->setType(DataValidation::TYPE_LIST);
                $validation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                $validation->setAllowBlank(false);
                $validation->setShowInputMessage(true);
                $validation->setShowErrorMessage(true);
                $validation->setShowDropDown(true);
                $validation->setErrorTitle('Input error');
                $validation->setError('Value is not in list.');
                $validation->setPromptTitle('Pick from list of candidate');
                //$validation->setPrompt('Select Candidate');
                $validation->setFormula1(sprintf('"%s"', implode(',', $options)));
                $workSheet = $event->sheet->getDelegate();
                $workSheet->freezePane('A2'); // freezing here

                // clone validation to remaining rows
                for ($i = 1; $i <= $this->number + 1; $i++) {
                    $event->sheet->getCell("{$drop_column}{$i}")->setDataValidation(clone $validation);
                    $event->sheet->setCellValue('J' . $i . '', "Candidate");
                }

                // set columns to autosize
                // for ($i = 1; $i <= 5; $i++) {
                //     $column = Coordinate::stringFromColumnIndex($i);
                //     $event->sheet->getColumnDimension($column)->setAutoSize(true);
                // }
            },
        ];
    }

    public function headings(): array
    {
        return ["No.", "Voter's Name", "Voter's Address", "LEGEND", "Precinct", "Barangay", "City/Municipality ", "District", "Age", "Cadidates"];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 30,
            'C' => 40,
            'D' => 20,
            'E' => 20,
            'F' => 20,
            'G' => 20,
            'H' => 20,
            'I' => 5,
            'J' => 10,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            'A1' => ['font' => ['bold' => true, 'size' => 13]],
            'B1' => ['font' => ['bold' => true, 'size' => 13]],
            'C1' => ['font' => ['bold' => true, 'size' => 13]],
            'D1' => ['font' => ['bold' => true, 'size' => 13]],
            'E1' => ['font' => ['bold' => true, 'size' => 13]],
            'F1' => ['font' => ['bold' => true, 'size' => 13]],
            'G1' => ['font' => ['bold' => true, 'size' => 13]],
            'H1' => ['font' => ['bold' => true, 'size' => 13]],
            'I1' => ['font' => ['bold' => true, 'size' => 13]],
            'J1' => ['font' => ['bold' => true, 'size' => 13]],
        ];
    }
}
