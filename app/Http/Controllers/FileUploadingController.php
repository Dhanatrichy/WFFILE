<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory as PhpWordIOFactory; // Alias for PhpWord's IOFactory
use PhpOffice\PhpSpreadsheet\IOFactory; // No alias needed for PhpSpreadsheet's IOFactory
use App\Trait\CustomTCPDF;
use PDF;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Exception;

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

        $filesData = FileUpload::where('id',$id)->first();

        $orientation = $filesData->page_orientation;
        if($orientation == 'portrait'){
            $page_orientation = 'P'; 
        } else{
            $page_orientation = 'L'; 
        }

        
        $page_size = $filesData->page_size;
        // $page_size = $filesData->page_size;

        $file = storage_path('app/'.$filesData->file_path);
       // echo $file; die;
       
        $pdf = new CustomTCPDF($page_size, $page_orientation);

        $extension = pathinfo($file, PATHINFO_EXTENSION);

        if($extension === 'doc' || $extension === 'docx'){
            try {
                $zip = new ZipArchive();
                if ($zip->open($file) === true) {
                    // Continue with your code to read the document
                    $zip->close();
                } else {
                    throw new Exception("Failed to open the ZIP file.");
                }
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        //echo $text;
        die();
        }elseif($extension === 'xlsx' || $extension === 'xls'){
           
            $spreadsheet = IOFactory::load($file);

            //echo "<pre>"; print_r($spreadsheet); die;
        
            foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
                $data = $this->extractXLSXData($worksheet);
                
                // Check if the worksheet has data
                if (!empty($data)) {
                    $pdf->AddPage($page_orientation, $page_size);
                    $pdf->SetFont('times', '', 12);
                    $contentHtml = view('pdf.template', compact('data'))->render();
                    $pdf->writeHTML($contentHtml);
                    $pdf->SetAutoPageBreak(true, 10);
                    $this->Footer($pdf);
                }
            }
    }

    $downloadFile = "app/public/".$filesData['file_name'].".pdf";
        
    $pdfFilePath = storage_path($downloadFile);
    $pdf->Output($pdfFilePath, 'F');
    // die("ssss");
   
    // Define the response headers for download
   // Define the response headers for download with a dynamic filename
   $responseHeaders = [
    'Content-Type' => 'application/pdf',
    //'Content-Disposition' => 'attachment; filename="' . $originalFilename . '.pdf"',
];

return response()->file($pdfFilePath, $responseHeaders);

    }



function extractXLSXData($worksheet){
     $extractedData = [];

     // Iterate through rows and extract non-empty rows and columns
     foreach ($worksheet->getRowIterator() as $row) {
         $rowData = [];
 
         // Flag to check if the row has any non-empty cells
         $nonEmptyRow = false;
         foreach ($row->getCellIterator() as $cell) {
             $value = $cell->getValue();
 
             if (!empty($value)) {
                 $rowData[] = $value;
                 $nonEmptyRow = true;
             }
         }
 
         if ($nonEmptyRow) {
             $extractedData[] = $rowData;
         }
     }
     return $extractedData;
}
    



    public function Footer($pdf) {
        $imageY = $pdf->getPageHeight() - 45;
       $pdf->SetY(-100);
       $pdf->SetLineStyle(array('width' => 0.5, 'color' => array(0, 0, 0)));

        // Add a border to the footer
       $pdf->Rect(10,$pdf->getPageHeight() - 50,$pdf->GetPageWidth() - 20, 40);

        // Set the footer font and content
       $pdf->SetFont('times', 'I', 16);
       $pdf->SetXY(10,$pdf->getPageHeight() - 50); // Adjust the X and Y coordinates
        $imagePath = public_path('logo.png');
        //$this->SetFooterMargin(100);
       $pdf->Image(public_path('sign/1.png'), 15, $imageY, 30, 0, 'PNG');
       $pdf->Rect(15, $imageY, 30, 0, 'D'); // Border for the first image
       $pdf->Image(public_path('sign/2.png'), 50, $imageY, 30, 0, 'PNG');
       $pdf->Rect(50, $imageY, 30, 0, 'D'); // Border for the second image
       $pdf->Image(public_path('sign/4.png'), 90, $imageY, 30, 0, 'PNG');
       $pdf->Rect(90, $imageY, 30, 0, 'D'); // Border for the third image

       $pdf->Rect(15, $imageY, 30, 30, 'D'); // Border for the first image
       $pdf->Rect(50, $imageY, 30, 30, 'D'); // Border for the second image
       $pdf->Rect(90, $imageY, 30, 30, 'D'); // Border for the third image
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
