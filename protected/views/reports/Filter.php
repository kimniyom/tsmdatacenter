<?php     
     echo "<form name=sel>\n";
     echo "อำเภอ : <font id=amphur><select>\n";
     echo "<option value='0'>--------------------</option> \n" ;
     echo "</select></font>\n";
     
     echo "ตำบล : <font id=tumbon><select>\n";
     echo "<option value='0'>--------------------</option> \n" ;
     echo "</select></font>\n";
     
     echo "หมู่บ้าน : <font id=ban><select>\n";
     echo "<option value='0'>--------------------</option> \n" ;
     echo "</select></font>\n";
     
     echo "<font id=result></font>\n";
     echo "</form>\n";
?>

<script language=Javascript>
function Inint_AJAX() {
   try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
   try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
   try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
   alert("XMLHttpRequest not supported");
   return null;
};

function dochange(src, val) {
     var req = Inint_AJAX();
     req.onreadystatechange = function () { 
          if (req.readyState==4) {
               if (req.status==200) {
                    document.getElementById(src).innerHTML=req.responseText; //รับค่ากลับมา
               } 
          }
     };
     req.open("GET", "<?php echo Yii::app()->baseUrl; ?>" + "/index.php?r=report/Filter/FilterFlowOne&data=" + src + "&val=" + val); //สร้าง connection
     req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf8"); // set Header
     req.send(null); //ส่งค่า
}

function banchange() {
     document.getElementById('result').innerHTML=sel.amphur.value+', '+sel.tumbon.value+', '+sel.ban.value;
}

window.onLoad=dochange('amphur', -1);
</script>
