<?php
/**
 * Description of TakisTables
 *
 * @author  : Sittipong Promhan
 * @company : Tak Provincial Health Office
 * @create  : 20 ก.ค. 2555 9:27:20
 * 
 */
class Tables {
    
    function StartTable($name='',$class='',$id=''){
        $str = "<table name = '$name' class = '$class' id = '$id'>";
        return $str;
    }
    
    function EndTable(){
        return "</table>";
    }
    
    function StartThead($option = ''){
        $str = "<thead $option>";
        return $str;
    }
    
    function EndThead(){
        return "</thead>";
    }
    
    function StartBody($option = ''){
        $str = "<tbody $option>";
        return $str;
    }
    
     function EndBody(){
        return "</tbody>";
    }
    
    function StartRow($option = ''){
        return "<tr $option>";
    }
    
    function EndRow(){
        return "</tr>";
    }
    
    function TH($val = '',$option = ''){
        return "<th $option>".$val."</th>";
    }
    
    
    function TD($val = '',$option = ''){
        return "<td $option>".$val."</td>";
    }
    
    
    function StartFooter($option = ''){
        return "<tfoot $option>";
    }
    
    function EndFooter(){
        return "</tfoot>";
    }
    
}

?>

