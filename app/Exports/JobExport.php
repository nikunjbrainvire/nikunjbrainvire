<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class JobExport implements FromView,ShouldAutoSize
{
    use Exportable;

    private $errors  = [];

    public function __construct($error_list){
        $this->errors = $error_list;

    }

    public function view(): View
    {

        return view('excel', [
            'errors' => $this->errors,
        ]);
    }
}
