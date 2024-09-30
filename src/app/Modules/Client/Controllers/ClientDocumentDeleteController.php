<?php

namespace App\Modules\Client\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\FileService;
use App\Modules\Client\Models\ClientDocument;

class ClientDocumentDeleteController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:delete clients', ['only' => ['get']]);
    }

    public function get($id){
        $clientDocument = ClientDocument::findorFail($id);

        try {
            //code...
            if($clientDocument->document){
                $path = str_replace("storage","app/public",$clientDocument->document);
                (new FileService)->delete_file($path);
            }
            $clientDocument->delete();
            return redirect()->back()->with('success_status', 'Document deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
