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


        public function Footer() {
        $imageY = $this->getPageHeight() - 45;
       $this->SetY(-40);
       $this->SetLineStyle(array('width' => 0.5, 'color' => array(0, 0, 0)));

        // Add a border to the footer
       $this->Rect(10,$this->getPageHeight() - 50,$this->GetPageWidth() - 20, 40);

        // Set the footer font and content
       $this->SetFont('times', 'I', 16);
       $this->SetXY(10,$this->getPageHeight() - 50); // Adjust the X and Y coordinates
        $imagePath = public_path('logo.png');
        //$this->SetFooterMargin(100);
       $this->Image(public_path('sign/1.png'), 15, $imageY, 30, 0, 'PNG');
       $this->Rect(15, $imageY, 30, 0, 'D'); // Border for the first image
       $this->Image(public_path('sign/2.png'), 50, $imageY, 30, 0, 'PNG');
       $this->Rect(50, $imageY, 30, 0, 'D'); // Border for the second image
       $this->Image(public_path('sign/4.png'), 90, $imageY, 30, 0, 'PNG');
       $this->Rect(90, $imageY, 30, 0, 'D'); // Border for the third image

       $this->Rect(15, $imageY, 30, 30, 'D'); // Border for the first image
       $this->Rect(50, $imageY, 30, 30, 'D'); // Border for the second image
       $this->Rect(90, $imageY, 30, 30, 'D'); // Border for the third image
    }
    

    // Page footer

}

?>