<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function showUploadForm()
    {
        return view('upload_excel');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        $data = Excel::toArray(new UsersExport, $file);
        
        dd($data);

        return view('display_excel', ['data' => $data]);
    }
}
