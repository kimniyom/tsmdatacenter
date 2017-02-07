<?php
/**
 * Description of TakisTables
 *
 * @author  : Sittipong Promhan
 * @company : Tak Provincial Health Office
 * @create  : 20 ก.ค. 2555 9:27:20
 * 
 */
class TakisTables {
    
    private $tHead = array();               # thead tag
    private $tSpanHead = array();           # colspan
    private $tBody = array();               # tbody tag
    private $rows = array();
    private $tFoot = array();               # tfoot tag
    private $class = "";              # default pretty
    private $id = "ReportTable";
    private $border = '0';
    private $cellpadding = '0';
    private $cellspacing = '0';
    private $showColumnIndex = true;           # แสดงลำดับแถว
    private $startColumnIndexNumber = 1;
    private  $option = "";


    public function TakisTables()
    {
        
    }
    
    public function option($option = ''){
        $this->option = $option;
    }
    
    public function addHeader($value,$option='')
    {
        array_push($this->tHead,array('value' => $value,'option' => $option));
    }
    
    public function addSpanHeader($value,$option='')
    {
        array_push($this->tSpanHead,array('value' => $value,'option' => $option));
    }
    
    private function addBody($rows)
    {
        array_push($this->tBody,$rows);
    }
    
    public function addCell($value,$option='',$link='')
    {
        array_push($this->rows,array('value' => $value,'option' => $option,'link' => $link));
    }
    
    public function addRows($resultset)
    {
        $numField = $resultset->num_fields();
        foreach ($resultset->result() as $rs):
            for($i = 0; $i < $numField; $i++){
                $this->addCell($rs($i));
            }
        endforeach;
    }

    
    public function startRow()
    {
        $this->rows = array();
    }
    
    public function endRow()
    {
        $this->addBody($this->rows);
    }
    
    public function addFooter($value,$option='')
    {
        array_push($this->tFoot,array('value' => $value,'option' => $option));
    }
    
    public function setClass($class)
    {
        $this->class = $class;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function setBorder($border)
    {
        $this->border = $border;
    }
    
    public function setPadding($cellpadding)
    {
        $this->cellpadding = $cellpadding;
    }
    
    public function setSpacing($cellspacing)
    {
        $this->cellspacing = $cellspacing;
    }
    
    /**
     *
     * @param boolean $flag default true
     * @param int   $start ลำดับที่เริ่มต้น (default = 1)
     * @deprecated แสดงลำดับแถว 
     */
    public function showColumnIndex($flag,$start=1)
    {
        $this->showColumnIndex = $flag;
        $this->startColumnIndexNumber = $start;
    }
    /*
    public function getHeader()
    {
        return $this->tHead;
    }
    
    public function getBody()
    {
        return $this->tBody;
    }
    
    public function getFooter()
    {
        return $this->tFoot;
    }
    */
    
    public function render()
    {
        $tableOpenTag = "<table id='".$this->id."' border='".$this->border."' cellpadding='".$this->cellpadding."' cellspacing='".$this->cellspacing."' class='".$this->class."'".$this->option.">";
        $headTag = "";
        $bodyTag = "";
        $footTag = "";
        $tableCloseTag = "</table>";
        $colspan = 0;
        $seted = false;
        
        if(count($this->tHead) > 0)
        {
            $headTag = "<thead>";
            $headTag .= "<tr>";

            foreach ($this->tHead as $head):
                if($this->showColumnIndex && !$seted){
                    $headTag .= "<th ".$head['option']." >";
                    $headTag .= "ลำดับที่";
                    $headTag .= "</th>";
                    $seted = true;
                } 
                    
                $headTag .= "<th ".$head['option']." >";
                $headTag .= $head['value'];
                $headTag .= "</th>";
            endforeach;
            $headTag .= "</tr>";
            
            if(count($this->tSpanHead) > 0)
            {
                $headTag .= "<tr>";
                foreach ($this->tSpanHead as $span):
                    $headTag .= "<th ".$span['option']." >";
                    $headTag .= $span['value'];
                    $headTag .= "</th>";
                endforeach;
                $headTag .= "</tr>";
            }
            $headTag .= "</thead>";
        }
        
        if(count($this->tBody) > 0)
        {
            $bodyTag = "<tbody>";
            //$seted = false;
            for($i = 0; $i < count($this->tBody); $i++){
                $bodyData = $this->tBody[$i];
                $bodyTag .= "<tr>";
                if($this->showColumnIndex ){
                    $bodyTag .= "<td align='center'>".($this->startColumnIndexNumber + $i)."</td>";
                }
                foreach ($bodyData as $body):                    
                    $bodyTag .= "<td ".$body['option']." >";
                    if(strlen($body['link']) > 0){
                        $bodyTag .= "<a href='".$body['link']."'>".$body['value']."</a>";
                    }else{
                        $bodyTag .= $body['value'];
                    }
                    $bodyTag .= "</td>";
                endforeach;
                $bodyTag .= "</tr>";
            }
            $bodyTag .= "</tbody>";
        }
        
        if(count($this->tFoot) > 0)
        {
            $footTag = "<tfoot>";
            $footTag .= "<tr>";
            foreach ($this->tFoot as $foot):
                $footTag .= "<th ".$foot['option']." >";
                $footTag .= $foot['value'];
                $footTag .= "</th>";
            endforeach;
            $footTag .= "</tr>";
            $footTag .= "</tfoot>";
        }
        
        return $tableOpenTag.$headTag.$bodyTag.$footTag.$tableCloseTag;
    }
}

?>

