<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function() {
        var count = $("#ReportTable thead tr th").length;
        var screenwidth = $(window).width();
        var screenheight = $(window).height();
        var heightPersen;// หาเปอร์เซ็นของหน้าจอ
        var heightVal;// ความสูงของหน้าจอ
        var fix;
        var X;

        //alert("width = " + width + "height = " + height);
        if (screenwidth < screenheight) {
            //Config For Mobile : By Kimniyom
            heightPersen = Math.ceil((screenheight * 35) / 100);//หา % ของความสูง
            heightVal = (screenheight - heightPersen);
            //alert(heightVal);
            var table = $('#ReportTable').DataTable({
                bInfo: false,
                //scrollY: heightVal,
                scrollX: true,
                bFilter: false,
                //scrollCollapse: true,
                sort: false,
                paging: false
            });
            new $.fn.dataTable.FixedColumns(table, {
                leftColumns: "<?php echo $colLock;?>"
            });
        } else {
            //Config For Desktop : By Kimniyom
            heightPersen = Math.ceil((screenheight * 45) / 100);// 20 % ของความสูง
            heightVal = (screenheight - heightPersen);
            if (count <= 20) {
                X = true;
            } else {
                X = true;
            }
            var table = $('#ReportTable').DataTable({
                bInfo: false,
                //scrollY: heightVal,
                scrollX: X,
                //scrollCollapse: true,
                sort: false,
                bFilter: false,
                paging: false,
                sDom: 'T<"clear">lfrtip',
                "oTableTools": {
                    "sSwfPath": "<?= Yii::app()->baseUrl ?>/assets/Datatable/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
                    "aButtons": [{"sExtends": "copy",
                            "bFooter": false,
                            "sButtonText": "Copy"},
                        {"sExtends": "xls", "bFooter": false}]
                }
            });

            if (count <= 20) {
                fix = "0";
            } else {
                new $.fn.dataTable.FixedColumns(table, {
                    leftColumns: <?php echo $colLock;?>
                });
            }

        }
        //alert(heightVal);

    });


</script>

<div class="ContentReport">
    <?php
        echo $table;
    ?>
</div>