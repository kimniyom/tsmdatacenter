<script type="text/javascript">
    $(document).ready(function() {
        var table = $("#poppulation").DataTable({
            bFilter: false,
            bInfo: false,
            sort: true,
            scrollX: '100%',
            scrollY: '320',
            paging: false,
            responsive: false
        });
        /*
        new $.fn.dataTable.FixedColumns(table, {
            leftColumns: 5
        });
        */

    });
</script>
<table cellspacing="0" class="display row-border cell-border" id="poppulation" width="100%" style=" font-size: 12px;">
    <thead>
        <tr>
            <th rowspan="2" id="head_table">ลำดับ</th>
            <th rowspan="2" id="head_table">อำเภอ</th>
            <th rowspan="2" id="head_table">รวม<br />(ชาย)</th>
            <th rowspan="2" id="head_table">รวม<br />(หญิง)</th>
            <th rowspan="2" id="head_table">รวม<br />(ทั้งหมด)</th>
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

            <?php }  ?>
        </tr>

        <tr>
            <?php for ($i = 1; $i <= $allcolumn; $i++) { ?>
                <th id="head_table">ชาย</th>
                <th id="head_table">หญิง</th>
                <th id="head_table">ทั้งหมด</th>	
            <? } ?>
        </tr>

    </thead>

    <tbody>
        <?php
        $j = 0;
        foreach ($amphurs as $amphur):$j++;
            ?>
            <tr>
                <td id="setText-Center" class="cell_total"><?= $j ?></td>
                <td style="white-space:nowrap;" class="cell_total">
                    <b><?= $amphur['ampurname'] ?></b>
                </td>
                <td id="setText-Right" class="cell_total">
                    <?php
                    if (isset($graphdataarray[$amphur['amphur']]['countman'])) {
                        echo number_format($graphdataarray[$amphur['amphur']]['countman']);
                    } else {
                        echo 0;
                    }
                    ?>
                </td>
                <td id="setText-Right" class="cell_total">
                    <?php
                    if (isset($graphdataarray[$amphur['amphur']]['countwoman'])) {
                        echo number_format($graphdataarray[$amphur['amphur']]['countwoman']);
                    } else {
                        echo 0;
                    }
                    ?>
                </td>
                <td id="setText-Right" class="cell_total" style=" border-right: #000 solid 1px;"> 
                    <?php
                    if (isset($graphdataarray[$amphur['amphur']]['countall'])) {
                        echo $graphdataarray[$amphur['amphur']]['countall'];
                    } else {
                        echo 0;
                    }
                    ?>
                </td>
                <?php for ($i = 1; $i <= $allcolumn; $i++) { ?>

                    <td id="setText-Right">
                        <?php
                        if (isset($dataarray[$amphur['amphur']][$i]['countman'])) {
                            echo $dataarray[$amphur['amphur']][$i]['countman'];
                        } else {
                            echo 0;
                        }
                        ?>
                    </td>
                    <td id="setText-Right">
                        <?php
                        if (isset($dataarray[$amphur['amphur']][$i]['countwoman'])) {
                            echo $dataarray[$amphur['amphur']][$i]['countwoman'];
                        } else {
                            echo 0;
                        }
                        ?>
                    </td>
                    <td id="setText-Right">
                        <?php
                        if (isset($dataarray[$amphur['amphur']][$i]['countall'])) {
                            echo $dataarray[$amphur['amphur']][$i]['countall'];
                        } else {
                            echo 0;
                        }
                        ?>
                    </td>   

                <?php }   ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot style=" background: #f1faff;">
        <tr style="font-weight:bold;">
            <td id="setText-Center"></td>
            <td id="setText-Center">รวม</td>
            <td id="setText-Right"><?= $countallman ?></td>
            <td id="setText-Right"><?= $countallwoman ?></td>
            <td id="setText-Right"><?= $countalldata ?></td>
            <? for ($i = 1; $i <= $allcolumn; $i++) { ?>
                <td id="setText-Right">
                    <?
                    if (isset($alldataarray[$i]['countman'])) {
                        echo $alldataarray[$i]['countman'];
                    } else {
                        echo 0;
                    }
                    ?>
                </td>
                <td id="setText-Right">
                    <?
                    if (isset($alldataarray[$i]['countwoman'])) {
                        echo $alldataarray[$i]['countwoman'];
                    } else {
                        echo 0;
                    }
                    ?>
                </td>
                <td id="setText-Right">
                    <?php
                    if (isset($alldataarray[$i]['countall'])) {
                        echo $alldataarray[$i]['countall'];
                    } else {
                        echo 0;
                    }
                    ?>
                </td>

            <?php } ?>
        </tr>
    </tfoot>
</table>