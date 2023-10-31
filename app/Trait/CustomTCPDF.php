<?php
 namespace App\Trait;
  use TCPDF; 

   class CustomTCPDF extends TCPDF {

    protected $pageSize;
    protected $pageOrientation;

      // Constructor to set page size and page orientation
      public function __construct($pageSize = 'A4', $pageOrientation = 'P') {
        parent::__construct($pageOrientation, 'mm', $pageSize);
        $this->pageSize = $pageSize;
        $this->pageOrientation = $pageOrientation;
    }
    // Page header
    public function Header() {
        $imageMarginLeft = $this->pageSize === 'A3' ? 30 : 15;
        $titleMarginLeft = $this->pageOrientation === 'L' ? 10 : -10;
        $titleFontSize = $this->pageOrientation === 'L' ? 26 : 20;

        $this->SetLineStyle(array('width' => 0.5, 'color' => array(0, 0, 0)));
        $this->Rect(10, 10, $this->GetPageWidth() - 20, 20);
        $imagePath = public_path('logo.png');
        $this->SetLineStyle(array('width' => 0.5, 'color' => array(255, 0, 0)));
        $this->Image($imagePath, $imageMarginLeft, 15, 35, 0, 'PNG');
        $this->SetFont('times', 'B', $titleFontSize);
        $this->SetMargins(30, 25, $titleMarginLeft);
        $this->Cell(0, 40, 'Online Approval Management', 0, 1, 'C');   
    }
    

    // Page footer

}

?>