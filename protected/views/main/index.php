<style type="text/css">
    #cnews{
        padding: 0px;
        margin-bottom: 5px;
    }
    #cnews #linknews{
        color: #666666;
        padding: 0px;
        font-size: 14px;
    }

    #cnews #linknews:hover{
        color: #ff0000;
    }
    #cnews > #span{
        font-size:1em;
        line-height:1em;
        /*height:1em;*/
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

</style>

<?php
$Language = new Language();
//$NewsModel = new News();
//$TypeNews = new Typenews();
$lg = $Language->SetLanguage();
$WebModel = SysWebsite::model()->find("id = '1'");
$Chart = new Chart();
$Dashboard = new Dashboard();
?>


<div class="row">
    <?php
    $Groupmodel = new SysReportgroup();
    $groupreport = $Groupmodel->findgroupkpi();
    $i = 0;
    foreach ($groupreport as $rs):
        $i++;
        if (Language::getLangValue() == 'EN') {
            $groupnameReport = $rs['name_en'];
        } else {
            $groupnameReport = $rs['name'];
        }
        $kpi = $Dashboard->getkpi($rs['id']);
        $kpiavg = (($kpi['TOTAL'] * $kpi['KPI']) / 100);
        ?>
        <div class="col s12 m6 l6">
            <div class="card" style=" text-align: center; width: 100%;">
                <div class=" card-content">
                    <?php
                    $name = $groupnameReport . "(ตัวชี้วัด)";
                    echo $Chart->gaugekpi("chart" . $i, $kpiavg, $name)
                    ?>
                    <div id="chart<?php echo $i ?>"></div>
                </div>
                <div class="card-footer" style=" padding: 10px; border-top: #cccccc solid 1px;  background: <?php echo $WebModel['headcolor'] ?>;color: <?php echo $WebModel['textheadcolor'] ?>">
                    <span style=" font-size: 24px;">ทั้งหมด <?php echo $kpi['TOTAL'] ?> | ผ่าน <?php echo $kpi['KPI'] ?> | คิดเป็น <?php echo $kpiavg ?></span>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>





