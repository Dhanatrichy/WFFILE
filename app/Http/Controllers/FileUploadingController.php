<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use Illuminate\Http\Request;

class FileUploadingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $files = FileUpload::all();
        return view('file.list', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('file.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('file');
        $path = $file->store('uploads'); // Store the file in the "uploads" directory

        $model =   FileUpload::create([
            'page_name' => $request->input('page_name'),
            'page_size' => $request->input('page_size'),
            'page_orientation' => $request->input('page_orientation'),
            'file_path' => $path,
            'file_name' => $file->getClientOriginalName(),
            'upload_date' => $request->input('upload_date'),
            'uploader_name' => $request->input('uploader_name'),
        ]);

        return redirect()->route('fileUploads.index')->with('success', 'File uploaded successfully.');
    }
    public function fileDownload($id)
    {
       dd("Do File Conversion Here");
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
