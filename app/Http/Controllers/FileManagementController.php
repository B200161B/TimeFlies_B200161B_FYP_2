<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileManagementController extends Controller
{
    public function index()
    {


        $fileLocation = 'files/1';

        $files = File::files($fileLocation);



//        dd($files);

        return view('FileManagement.index', compact('files'));
    }
}
