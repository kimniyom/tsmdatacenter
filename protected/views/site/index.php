<center>
    <br/><br/><br/>
    <h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
    <br/><br/>
    <img src="<?php echo Yii::app()->request->baseUrl;?>/images/logo-black-home.png"/><br/><br/><br/><br/><br/>
    <a href="<?php echo Yii::app()->createUrl('menager_groupcontrol_money/show_groupcontrol_money');?>" class="easyui-linkbutton" data-options="iconCls:'icon-right' "><h1>ทะเบียนคุมเงินประจำงวด</h1></a>
    <a href="<?php echo Yii::app()->createUrl('department/show_department');?>" class="easyui-linkbutton" data-options="iconCls:'icon-right' "><h1>ทะเบียนคุมแผนงาน / โครงการ</h1></a>
    <a href="<?php echo Yii::app()->createUrl('social_service/show_social_service');?>" class="easyui-linkbutton" data-options="iconCls:'icon-right' "><h1>ทะเบียนคุมเงิน หน่วยงานย่อย</h1></a>
</center>


