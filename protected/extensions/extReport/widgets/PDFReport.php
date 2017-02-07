<?php

class PDFReport extends CWidget{
    public $object;
    private $options = array();
    private $pageSize = 'A4'; //ขนาดกระดาษ
    private $fontName = 'freeserif';
    private $fontSize = '10';
    public $header = array();
    public $items = array();
    
    private function importPDF(){
        //Path Widget : extReport Extension
        $path = YII::app()->basePath.'/extensions/extReport/widgets';
        //ฟังก์ชั่น จัดการเอกสาร PDF
        // Import TCPDF
        require_once ($path.'PDFSetting.php');
        return $this;
    }
    
    //Create Report.(PDF)
    private function create($options){
        $this->options = $options['setting']; //Set Option
        $this->header = $options['header']; //Set Header
        $pdf = new MYPDF($this->options['orientation'],PDF_UNIT,  $this->pageSize,TRUE,'UTF-8',FALSE);
        $pdf->setting();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor($this->header['author']);
        $pdf->SetTitle($this->header['title']);
        $pdf->SetFont($this->fontName,'',  $this->fontSize);
        
        //สร้าง Header Report
        if(!empty($this->header['show'])){
            $pdf->SetHeaderData(FALSE,0,  $this->header['subtitle'],'Create : '.data('d-m-Y H:i:s'),
                    array(0,64,255),array(0,64,128));
        }else $pdf->setPrintHeader(FALSE);
        
        //สร้าง Footer Report
        $pdf->setPrintFooter(FALSE);
        $pdf->AddPage();
        $pdf->SetFont($this->fontName,'',22);
        $pdf->Write(0,  $this->header['title'],'',0,'C',TRUE,0,FALSE, FALSE,0);
        $pdf->Ln();
        $this->object = $pdf; //เก็บค่าลง Object
        return $pdf;
    }
    
    //ฟังก์ชั่น สร้างตารางรายการ
    private function createTable($list){
        $pdf =  $this->object;
        //Color , line
        $pdf->SetFillColor(255,0,0);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(128,0,0);
        $pdf->SetLineWidth(0.3);
        $pdf->SetFont($this->fontName, 'B',  $this->fontSize);
        
        //สร้างตัวแปร
        $header = array();
        $type = array();
        $width = array();
        $align = array();
        $sub = array();
        //เก็บค่าลงตัวแปร
        foreach ($list['header'] as $value){
            $header[] = $value[0];
            $type[] = $value[1];
            $width[] = $value[2];
            $align[] = $value[3];
            $sub[] = $value[4];
        }
        //Header
        $num_header = count($header);
        for($i=0;$i<$num_header;++$i){
            $pdf->Cell($width[$i],7,$header[$i],1,0,'C',1);
        }
        $pdf->Ln();
        //Color and font
        $pdf->SetFillColor(224,235,255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        //Data
        $fill = 0;
        foreach ($list['items'] as $rows){
            foreach ($rows as $key => $rows){
                if($type[$key]=== 'text'){
                    $pdf->Cell($width[$key],6,$rows[$key].$sub[$key],'LR',0,$align[$key],$fill);
                }
                if($type[$key]==='number'){
                    $pdf->Cell($width[$key],6,number_format($rows[$key].$sub[$key]),'LR',0,$align[$key],$fill);
                }
            }
            $pdf->Ln();
            $fill = !$fill;
        }
    }
}
?>
