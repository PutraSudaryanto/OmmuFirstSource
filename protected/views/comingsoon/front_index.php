<?php
/**
 * Ommu Settings (ommu-settings)
 * @var $this ComingsoonController
 * @var $model OmmuSettings
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2012 Ommu Platform (www.ommu.co)
 * @link https://github.com/ommu/ommu
 *
 */
 
	$this->breadcrumbs=array(
		'Coming Soon',
	);
	
	$date = date('Y/m/d', strtotime($setting->construction_date));

	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/plugin/jquery.countdown.js', CClientScript::POS_END);
	//$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/plugin/dt-timecircles.js', CClientScript::POS_END);
$js=<<<EOP
	var startDate = '$date';
EOP;
	$cs->registerScript('countdown', $js, CClientScript::POS_END);
?>

<div class="countdown hide">
	<ul class="clearfix">
		<li>
			<span id="days">0</span>
			<?php echo Yii::t('phrase', 'Days');?>
		</li>
		<li>
			<span id="hours">0</span>
			<?php echo Yii::t('phrase', 'Hours');?>
		</li>
		<li>
			<span id="minutes">0</span>
			<?php echo Yii::t('phrase', 'Minutes');?>
		</li>
		<li>
			<span id="seconds">0</span>
			<?php echo Yii::t('phrase', 'Seconds');?>
		</li>
	</ul>
</div>

<p class="hide"><?php echo $setting->construction_text;?></p>

<?php /*
<div class="dt-countdowntimer" data-date="<?php echo $setting->construction_date;?>" style="height: 250px;"></div>
*/?>
