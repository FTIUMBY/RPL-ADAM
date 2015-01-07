<?php
	if($model->photo == 0) {
		$images = Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/users/default.png', 82, 82, 1);
	} else {
		$images = Utility::getTimThumb(Yii::app()->request->baseUrl.'/public/users/'.Yii::app()->user->id.'/'.$model->photo, 82, 82, 1);
	}
?>

<?php //begin.Information ?>
<div class="account">
	<?php //begin.Photo ?>
	<a off_address="" id="uplaod-image" class="photo" href="<?php echo Yii::app()->createUrl('users/photo/ajaxadd', array('type'=>'admin'));?>" title="Change Photo: <?php echo Yii::app()->user->displayname;?>"><img src="<?php echo $images;?>" alt="<?php echo $model->photo != 0 ? Yii::app()->user->displayname : 'Ommu Platform';?>"/></a>
	<div class="info">
		Welcome, <a href="<?php echo Yii::app()->createUrl('users/admin/edit')?>" title="<?php echo 'Edit Account: '.Yii::app()->user->displayname;?>"><?php echo Yii::app()->user->displayname;?></a>
		<span>Last sign in : <?php echo date('d-m-Y', strtotime($model->lastlogin_date));?></span>
		<a class="signout" href="<?php echo Yii::app()->createUrl('site/logout');?>" title="<?php echo 'Logout: '.Yii::app()->user->displayname;?>">Logout</a>
	</div>
</div>
<?php //end.Information ?>



