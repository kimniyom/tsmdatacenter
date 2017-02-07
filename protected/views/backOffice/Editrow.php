<html>
    <head>
        <meta charset="utf-8"/>
        <script>
            function editrow(id,a){
                var colid = (a.value || a.options[a.selectedIndex].value);  //crossbrowser solution =)
                var url = "<?php echo Yii::app()->createUrl("Backoffice/Editrow")?>";
                var data = {id:id,colid:colid};
                $.post(url,data,function(result){
                });
            }
            
            function delboxmenu(id){
                var url = "<?php echo Yii::app()->createUrl("Backoffice/Delboxmenu")?>";
                var data = {id: id};
                $.post(url,data,function(result){
                    window.location.reload();
                });
            }
        </script>
    </head>
    <body>

        <table width="100%" class="table table-striped">
            <thead>
                <tr>
                    <th>กลุ่มรายงาน</th>
                    <th>คอลัมน์</th>
                    <th style=" text-align: center;">ลบออกจากแถว</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($orderrow as $rs):?>
                <tr>
                    <td><?php echo $rs['name'];?></td>
                    <td>
                        <select id="colid" onchange="editrow('<?php echo $rs['id'];?>',this);" class="form-control input-sm" style="width: 80px;">
                            <?php for($i=1;$i<=$ColTotal;$i++):?>
                            <option value="<?php echo $i;?>" <?php if($rs['colid'] == $i){ echo "selected";}?> ><?php echo $i;?></option>
                            <?php endfor;?>
                        </select>
                        
                        <div id="lding"></div>
                    </td>
                    <td style=" text-align: center;">
                        <div class="btn btn-danger" 
                             style=" padding: 5px 10px;"
                             onclick="delboxmenu('<?php echo $rs['id'];?>');"><i class="fa fa-remove"></i></div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </body>
</html>
