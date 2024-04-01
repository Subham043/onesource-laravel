<?php

namespace App\Modules\Report\Export\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromView;

class QuickbookExport implements FromView
{
    protected $report;

    public function __construct(Collection $report)
    {
        $this->report = $report;
    }

    public function view(): View
    {
        return view('reports.quickbook_excel', [
            'data' => $this->report
        ]);
    }
}