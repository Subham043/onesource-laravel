<?php

namespace App\Modules\Report\Export\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Event\Services\EventService;
use App\Modules\Report\Export\Exports\ExcelExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportExcelController extends Controller
{
    private $eventService;

    public function __construct(EventService $eventService)
    {
        $this->middleware('permission:view exports', ['only' => ['get','post']]);
        $this->eventService = $eventService;
    }
    public function get(Request $request){
        $data = $this->eventService->excelReport();
        return Excel::download(new ExcelExport($data), '1capapp.csv', \Maatwebsite\Excel\Excel::CSV, [
                'Content-Type' => 'text/csv',
        ]);
    }
}
