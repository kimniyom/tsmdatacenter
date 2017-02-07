<script src="<?php echo Yii::app()->baseUrl; ?>/js/ConfigLayout.js" type="text/javascript"></script>

<?php
$pathSWF = Yii::app()->baseUrl . "/assets/Datatable/extensions/TableTools/swf/copy_csv_xls_pdf.swf";
?>

<input type="hidden" id="fileexport" value="<?php echo $pathSWF; ?>"/>
<div class="ContentReport">
    <table id="ReportTable" class="row-border cell-border hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th rowspan="2"><?php echo $location; ?></th>
                <th rowspan="2">รวม<br/>(ชาย)</th>
                <th rowspan="2">รวม<br/>(หญิง)</th>
                <th rowspan="2">รวม<br/>(ทั้งหมด)</th>
                <?php
                for ($i = 1; $i <= $allcolumn; $i++) {
                    if ($i == $allcolumn) {
                        $endageqry = $endage;
                        $startageqry = ($agecolumn * ($i - 1)) + $startage;
                    } else {
                        $endageqry = (($agecolumn * $i) - 1) + $startage;
                        $startageqry = $endageqry - ($agecolumn - 1 );
                    }
                    ?>  
                    <th colspan="3" id="head_table">
                        ช่วงอายุ <?= $startageqry ?> - <?= $endageqry ?> ปี
                    </th>

                <?php }//end for  ?>
            </tr>

            <tr>

                <?php for ($i = 1; $i <= $allcolumn; $i++) { ?>
                    <th>ชาย</th>
                    <th>หญิง</th>
                    <th>ทั้งหมด</th>	
                <?php } ?>
            </tr>

        </thead>

        <tbody>
            <?php
            $sumAll = array(0, 0, 0);
            $j = 0;
            foreach ($amphurs as $amphur):$j++;
                if ($amphur['amphur'] == '6399' || $amphur['amphur'] == '00000') {
                    $bg = "style='background:#ffcc00;box-shadow: none; color:#000;' ";
                } else {
                    $bg = "";
                }
                ?>
                <tr <?php echo $bg; ?>>
                    <th style=" border-right: #000000 solid 1px; border-left: 0px;">
                        <b><?= $amphur['amphur'] . '-' . $amphur['ampurname' . Language::GetLanguageDefault()] ?></b>
                    </th>
                    <td id="setText-Right-bold" <?php echo $bg; ?>>
                        <?php
                        if (isset($graphdataarray[$amphur['amphur']]['countman'])) {
                            echo number_format($graphdataarray[$amphur['amphur']]['countman']);
                        } else {
                            echo 0;
                        }
                        ?>
                    </td>
                    <td id="setText-Right-bold" <?php echo $bg; ?>>
                        <?php
                        if (isset($graphdataarray[$amphur['amphur']]['countwoman'])) {
                            echo number_format($graphdataarray[$amphur['amphur']]['countwoman']);
                        } else {
                            echo 0;
                        }
                        ?>
                    </td>
                    <td id="setText-Right-bold" <?php echo $bg; ?>> 
                        <?php
                        if (isset($graphdataarray[$amphur['amphur']]['countall'])) {
                            echo ($graphdataarray[$amphur['amphur']]['countall']);
                        } else {
                            echo 0;
                        }
                        ?>
                    </td>
                    <?php for ($i = 1; $i <= $allcolumn; $i++) { ?>

                        <td >
                            <?php
                            if (isset($dataarray[$amphur['amphur']][$i]['countman'])) {
                                echo $dataarray[$amphur['amphur']][$i]['countman'];
                            } else {
                                echo 0;
                            }
                            ?>
                        </td>
                        <td >
                            <?php
                            if (isset($dataarray[$amphur['amphur']][$i]['countwoman'])) {
                                echo $dataarray[$amphur['amphur']][$i]['countwoman'];
                            } else {
                                echo 0;
                            }
                            ?>
                        </td>
                        <td >
                            <?php
                            if (isset($dataarray[$amphur['amphur']][$i]['countall'])) {
                                echo $dataarray[$amphur['amphur']][$i]['countall'];
                            } else {
                                echo 0;
                            }
                            ?>
                        </td>   

                    <?php }//end for     ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th id="setText-Center-fix">รวม</th>
                <td><?= $countallman ?></td>
                <td><?= $countallwoman ?></td>
                <td><?= $countalldata ?></td>
                <?php for ($i = 1; $i <= $allcolumn; $i++) { ?>
                    <td>
                        <?php
                        if (isset($alldataarray[$i]['countman'])) {
                            echo $alldataarray[$i]['countman'];
                        } else {
                            echo 0;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if (isset($alldataarray[$i]['countwoman'])) {
                            echo $alldataarray[$i]['countwoman'];
                        } else {
                            echo 0;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if (isset($alldataarray[$i]['countall'])) {
                            echo $alldataarray[$i]['countall'];
                        } else {
                            echo 0;
                        }
                        ?>
                    </td>

                <?php }//end for    ?>
            </tr>
        </tfoot>
    </table>
    ประมวลผลวันที่ : <?php echo $DateUpdate; ?>
</div>