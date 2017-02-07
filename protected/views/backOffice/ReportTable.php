<form id="formOrderNumber" onsubmit="return false;">
    <table id="showItemGroups" class="striped responsive-table" style="background:#FFF; width: 100%;">
        <thead>
            <tr>
                <td style=" width: 5%">ลำดับ</td>
                <td style="text-align: center;">จัดการ</td>
                <td>ชื่อรายงาน</td>
                <!--
                <td>ReportName</td>
                -->
                <td>URLController</td>
                <td>ที่มา</td>
                <td>ReportStyle</td>
                <td>Storeproces_name</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($listreport as $rs):
                ?>
                <tr>
                    <td class="index" style=" text-align: center;"><?php echo $rs['order_number']; ?></td>
                    <td>
                        <?php if ($rs['record_flag'] == 'Y') { ?>
                            <a  href="javascript:Clickrow('<?php echo $rs['id']; ?>',
                                '<?php echo $rs['subtitle']; ?>',
                                '<?php echo $rs['source']; ?>',
                                '<?php echo $rs['controller']; ?>',
                                '<?php echo $rs['template']; ?>',
                                '<?php echo $rs['col_group_id']; ?>',
                                '<?php echo $rs['row_group_id']; ?>',
                                '<?php echo $rs['period_id']; ?>',
                                '<?php echo $rs['order_number']; ?>',
                                '<?php echo $rs['record_flag']; ?>',
                                '<?php echo $rs['showall']; ?>',
                                '<?php echo $rs['showtype']; ?>',
                                '<?php echo $rs['showsum']; ?>',
                                '<?php echo $rs['checkinput']; ?>',
                                '<?php echo $rs['kpistatus']?>');"
                                id="opener" 
                                data-toggle="modal" 
                                data-target="#myModal" 
                                data-toggle="tooltip" 
                                data-placement="top" 
                                title="คลิกเลือกเพื่อแก้ไขหรือลบข้อมูล">
                                <i class="mdi-action-settings" style=" color: #999999;"></i> จัดการรายงาน</a>
                        <?php } else { ?>
                            <div style=" text-align: center;">
                                <a href="javascript:Editreportsql('<?php echo $rs['id'] ?>')"><i class="mdi-editor-mode-edit" style=" color: #ff9900;"></i> แก้ไข</a>
                                <a href="javascript:DeleteReportSql('<?php echo $rs['id'] ?>')"><i class="mdi-action-delete" style=" color: #ff0000;"></i> ลบ</a>
                            </div>
                        <?php } ?>
                    </td>
                    <td>
                        <?php echo $rs['name']; ?>   
                        <input type='hidden' id='item_id' name='item_id[]' value='<?php echo $rs['id']; ?>'>
                    </td>
                    <!--
                    <td><?//php echo $rs['name_en']; ?></td>
                    -->
                    <td><?php echo $rs['controller']; ?></td>
                    <td>
                        <?php
                        if ($rs['record_flag'] == "Y") {
                            echo "จากการคีย์";
                        } else {
                            echo "จากชุดคำสั่ง sql ";
                        }
                        ?>
                    </td>
                    <td>
                        <a href="javascript:ReportStyle('<?php echo $rs['id'] ?>')"><button type="button" class="btn green">รูปแบบรายงาน</button></a>
                    </td>
                    <td><?php echo $rs['storeproces_name'] ?></td>
                </tr>
                <?php
                $i++;
            endforeach;
            ?>
        </tbody>
    </table>
</form>

<script type="text/javascript">
    $(document).ready(function () {
        $("#showItemGroups").DataTable({
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false,
            "scrollX": true
        }); // id ของ ตาราง
        //
        //เลือกแถวแล้วแสดงแถบสีในแถวที่เลือก

        /*
         $('#showItemGroups tbody').on('click', 'tr', function() {
         if ($(this).hasClass('selected')) {
         $(this).removeClass('selected');
         } else {
         table.$('tr.selected').removeClass('selected');
         $(this).addClass('selected');
         }
         });
         */

    });

    var fixHelperModified = function (e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();

        $helper.children().each(function (index) {
            $(this).width($originals.eq(index).width())
        });
        return $helper;
    },
            updateIndex = function (e, ui) {
                $('td.index', ui.item.parent()).each(function (i) {
                    // alert($(this).html(i + 1));
                    $(this).html(i + 1);
                });

                updateOrderNumber();
            };

    $("#showItemGroups tbody").sortable({
        helper: fixHelperModified,
        stop: updateIndex
    }).disableSelection();


    function updateOrderNumber() {
        $.ajax({
            url: '<?php echo Yii::app()->createUrl("/Backoffice/ReportOrderSave") ?>',
            data: $("#formOrderNumber").serialize(),
            type: 'POST'
        });
    }

</script>
