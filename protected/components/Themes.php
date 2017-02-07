<?php

class Themes {

    public function Path() {
        $path = Yii::app()->baseUrl;
        return $path;
    }

    public function AssetsJs() {
        $s = '<script type="text/javascript" src="';
        $e = '"></script>';

        $path = $this->Path();
        $Js = $s . $path . '/themes/materialize/js/plugins/jquery-1.11.2.min.js' . $e;
        $Js .= $s . $path . '/themes/materialize/js/materialize.js' . $e;
        $Js .= $s . $path . '/themes/materialize/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js' . $e;

        //$Js .= $s . $path . '/themes/materialize/js/plugins/chartist-js/chartist.min.js' . $e;
        //$Js .= $s . $path . '/themes/materialize/js/plugins/chartjs/chart.min.js' . $e;
        //$Js .= $s . $path . '/themes/materialize/js/plugins/chartjs/chart-script.js' . $e;

        $Js .= $s . $path . '/themes/materialize/js/plugins/sparkline/jquery.sparkline.min.js' . $e;
        $Js .= $s . $path . '/themes/materialize/js/plugins/sparkline/sparkline-script.js' . $e;
        /*
          <!--jvectormap-->
          <script type="text/javascript" src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
          <script type="text/javascript" src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
          <script type="text/javascript" src="js/plugins/jvectormap/vectormap-script.js"></script>
         */
        $Js .= $s . $path . '/themes/materialize/js/plugins.js' . $e;
        $Js .= $s . $path . '/themes/materialize/js/custom-script.js' . $e;
        $Js .= $s . $path . '/themes/materialize/js/plugins/data-tables/js/jquery.dataTables.min.js' . $e;
        $Js .= $s . $path . '/themes/materialize/js/plugins/data-tables/data-tables-script.js' . $e;
        $Js .= $s . $path . '/assets/jstree/jstree.js' . $e;
        $Js .= $s . $path . '/assets/touch-screen/jquery-ui.js' . $e;
        $Js .= $s . $path . '/js/jscolor-2.0.4/jscolor.js' . $e;
        


        return $Js;
    }

    public function AssetsCss() {
        $Css = "";
        $s = '<link rel="stylesheet" href="';

        $path = $this->Path();
        $Css .= $s . $path . '/themes/materialize/css/materialize.css"/>';
        $Css .= $s . $path . '/themes/materialize/css/style.css"/>';
        $Css .= $s . $path . '/themes/materialize/css/custom/custom.css"/>';
        $Css .= $s . $path . '/themes/materialize/js/plugins/perfect-scrollbar/perfect-scrollbar.css"/>';
        $Css .= $s . $path . '/themes/materialize/js/plugins/jvectormap/jquery-jvectormap.css"/>';
        $Css .= $s . $path . '/themes/materialize/js/plugins/chartist-js/chartist.min.css"/>';
        $Css .= $s . $path . '/themes/materialize/js/plugins/data-tables/css/jquery.dataTables.min.css"/>';
        $Css .= $s . $path . '/themes/materialize/css/plugins/media-hover-effects.css"/>';
        $Css .= $s . $path . '/css/report/report-flat.css"/>';
        $Css .= $s . $path . '/assets/jstree/themes/default/style.css"/>';
        //'css/site.css',

        return $Css;
    }

    public function RegisterThemes() {
        $Assets = $this->AssetsCss();
        $Assets .= $this->AssetsJs();

        return $Assets;
    }

    public function setColorTables($colors = null, $textcolors = null, $borderColors = null) {
        if ($colors == '') {
            $color = "f8f8f8";
        } else {
            $color = $colors;
        }
        if ($textcolors == "") {
            $textcolor = "000000";
        } else {
            $textcolor = $textcolors;
        }

        if ($borderColors == "") {
            $borderColor = $textcolors;
        } else {
            $borderColor = $borderColors;
        }
        $str = "
            <style type='text/css'>
            .ContentReport table{ font-size: 16px; background:#99ccff;}
                /*table thead #head_table{ text-align:center; background:#99ccff; color:#000;}*/
                .ContentReport table{
                    border-top:solid 1px #" . $borderColor . ";
                }
                .ContentReport table thead tr th{ 
                    color: #" . $textcolor . ";
                    border-right: solid 1px #" . $borderColor . ";
                    background-color: #" . $color . ";
                    text-align: center;
                    border-radius:0px;
                }
                .ContentReport table tbody tr th{ 
                    color: #" . $textcolor . ";
                    background-color: #" . $color . ";
                    text-align: left;
                    border-radius:0px;
                }
                .ContentReport table tbody tr #setText-Right-bold{ 
                    text-align: right; font-weight: bold; 
                    border-right: solid 1px #" . $borderColor . ";
                    color: #" . $textcolor . ";
                    background-color: #" . $color . ";
                    border-radius:0px;
                }

                .ContentReport table tbody tr #setText-Right-bold{ 
                    text-align: right; font-weight: bold; 
                    border-right: solid 1px #" . $borderColor . ";
                    color: #" . $textcolor . ";
                    background-color: #" . $color . ";
                    border-radius:0px;
                }

                .ContentReport table tfoot tr th{ 
                    text-align: center; font-weight: bold; 
                    border-right: solid 1px #" . $borderColor . ";
                    color: #" . $textcolor . ";
                    background-color: #" . $color . ";
                    border-radius:0px;
                }

                .ContentReport table tfoot tr td{ 
                    text-align: right; font-weight: bold; 
                    border-right: solid 1px #" . $borderColor . ";
                    color: #" . $textcolor . ";
                    background-color: #" . $color . ";
                    border-radius:0px;
                }
                #setText-Center-fix{
                    text-align: center; font-weight: bold; 
                    color: #" . $textcolor . ";
                    background-color: #" . $color . ";
                    border-radius:0px;
                }
                #tfoot{ text-align: right; font-weight: bold; padding-right: 2px; border-right:#" . $borderColor . " solid 1px;}
               #setText-Left{ 
                text-align: left; 
                font-weight: bold; 
                background: #" . $color . "; 
                border-radius:0px; 
                border-left:none;
                border-right: solid 1px #" . $borderColor . ";
                color: #" . $textcolor . "
                }
    </style>    
            ";

        return $str;
    }

}
