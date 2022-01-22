<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileManagementController extends Controller
{
    public function index(){

        $files = Storage::allfiles('files/1');

//        dd($files);

        return view('FileManagement.index',compact('files'));
    }
}
