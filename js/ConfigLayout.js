/*
 * File Config Report Layout Subport Mobile&Desktop 
 */

$(document).ready(function() {
    var fileexport = $("#fileexport").val();
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
        heightPersen = Math.ceil((screenheight * 40) / 100);//หา % ของความสูง
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
            leftColumns: "0"
        });
    } else {
        //Config For Desktop : By Kimniyom
        heightPersen = Math.ceil((screenheight * 50) / 100);// 20 % ของความสูง
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
            //scrollCollapse: X,
            sort: false,
            bFilter: false,
            paging: false,
            sDom: 'T<"clear">lfrtip',
            "oTableTools": {
                "sSwfPath": fileexport,
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
                leftColumns: "1"
            });
        }

    }
    //alert(heightVal);

});


