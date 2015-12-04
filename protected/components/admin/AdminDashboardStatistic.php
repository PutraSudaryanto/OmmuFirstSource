<?php
/**
 * AdminDashboardStatistic
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2012 Ommu Platform (ommu.co)
 * @link https://github.com/oMMu/Ommu-Core
 * @contect (+62)856-299-4114
 *
 */

class AdminDashboardStatistic extends CWidget
{

	public function init() {
	}

	public function run() {
		$this->renderContent();
	}

	protected function renderContent() {
		$model = OmmuSettings::model()->findByPk(1,array(
			'select' => 'site_type, license_key, site_creation, ommu_version'
		));

		$this->render('admin_dashboard_statistic', array(
			'model'=>$model,	
		));	
	}
}
