<?php
/**
 * UserInviteHistory
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 5 August 2017, 17:41 WIB
 * @link https://github.com/ommu/mod-users
 * @contact (+62)856-299-4114
 *
 * This is the template for generating the model class of a specified table.
 * - $this: the ModelCode object
 * - $tableName: the table name for this class (prefix is already removed if necessary)
 * - $modelClass: the model class name
 * - $columns: list of table columns (name=>CDbColumnSchema)
 * - $labels: list of attribute labels (name=>label)
 * - $rules: list of validation rules
 * - $relations: list of relations (name=>relation declaration)
 *
 * --------------------------------------------------------------------------------------
 *
 * This is the model class for table "ommu_user_invite_history".
 *
 * The followings are the available columns in table 'ommu_user_invite_history':
 * @property string $id
 * @property string $invite_id
 * @property string $code
 * @property string $invite_date
 * @property string $invite_ip
 * @property string $expired_date
 *
 * The followings are the available model relations:
 * @property UserInvites $invite
 */
class UserInviteHistory extends CActiveRecord
{
	public $defaultColumns = array();

	// Variable Search
	public $displayname_search;
	public $email_search;
	public $userlevel_search;
	public $user_search;
	public $expired_search;

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserInviteHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		preg_match("/dbname=([^;]+)/i", $this->dbConnection->connectionString, $matches);
		return $matches[1].'.ommu_user_invite_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('invite_id, code, invite_date, invite_ip', 'required'),
			array('invite_id', 'length', 'max'=>11),
			array('code', 'length', 'max'=>16),
			array('invite_ip', 'length', 'max'=>20),
			array('expired_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, invite_id, code, invite_date, invite_ip, expired_date, 
				displayname_search, email_search, userlevel_search, user_search, expired_search', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'view' => array(self::BELONGS_TO, 'ViewUserInviteHistory', 'id'),
			'invite' => array(self::BELONGS_TO, 'UserInvites', 'invite_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('attribute', 'trigger'),
			'invite_id' => Yii::t('attribute', 'Invite'),
			'code' => Yii::t('attribute', 'Code'),
			'invite_date' => Yii::t('attribute', 'Invite Date'),
			'invite_ip' => Yii::t('attribute', 'Invite Ip'),
			'expired_date' => Yii::t('attribute', 'Expired Date'),
			'displayname_search' => Yii::t('attribute', 'Displayname'),
			'email_search' => Yii::t('attribute', 'Email'),
			'userlevel_search' => Yii::t('attribute', 'Level Inviter'),
			'user_search' => Yii::t('attribute', 'Inviter'),
			'expired_search' => Yii::t('attribute', 'Expired'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		// Custom Search
		$criteria->with = array(
			'view' => array(
				'alias'=>'view',
			),
			'invite' => array(
				'alias'=>'invite',
				'select'=>'newsletter_id, user_id'
			),
			'invite.newsletter' => array(
				'alias'=>'invite_newsletter',
				'select'=>'newsletter_id, email'
			),
			'invite.newsletter.view' => array(
				'alias'=>'invite_newsletter_view',
				'select'=>'user_id'
			),
			'invite.newsletter.view.user' => array(
				'alias'=>'invite_newsletter_view_user',
				'select'=>'displayname'
			),
			'invite.user' => array(
				'alias'=>'invite_user',
				'select'=>'level_id, displayname'
			),
		);
		
		$criteria->compare('t.id',$this->id);
		if(isset($_GET['invite']))
			$criteria->compare('t.invite_id',$_GET['invite']);
		else
			$criteria->compare('t.invite_id',$this->invite_id);
		$criteria->compare('t.code',strtolower($this->code),true);
		if($this->invite_date != null && !in_array($this->invite_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.invite_date)',date('Y-m-d', strtotime($this->invite_date)));
		$criteria->compare('t.invite_ip',strtolower($this->invite_ip),true);
		if($this->expired_date != null && !in_array($this->expired_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.expired_date)',date('Y-m-d', strtotime($this->expired_date)));

		if($this->invite->newsletter->view->user_id)
			$criteria->compare('invite_newsletter_view_user.displayname',strtolower($this->displayname_search),true);
		$criteria->compare('invite_newsletter.email',strtolower($this->email_search),true);
		$criteria->compare('invite_user.level_id',$this->userlevel_search);
		$criteria->compare('invite_user.displayname',strtolower($this->user_search),true);
		$criteria->compare('view.publish',$this->expired_search);

		if(!isset($_GET['UserInviteHistory_sort']))
			$criteria->order = 't.id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>30,
			),
		));
	}


	/**
	 * Get column for CGrid View
	 */
	public function getGridColumn($columns=null) {
		if($columns !== null) {
			foreach($columns as $val) {
				/*
				if(trim($val) == 'enabled') {
					$this->defaultColumns[] = array(
						'name'  => 'enabled',
						'value' => '$data->enabled == 1? "Ya": "Tidak"',
					);
				}
				*/
				$this->defaultColumns[] = $val;
			}
		} else {
			//$this->defaultColumns[] = 'id';
			$this->defaultColumns[] = 'invite_id';
			$this->defaultColumns[] = 'code';
			$this->defaultColumns[] = 'invite_date';
			$this->defaultColumns[] = 'invite_ip';
			$this->defaultColumns[] = 'expired_date';
		}

		return $this->defaultColumns;
	}

	/**
	 * Set default columns to display
	 */
	protected function afterConstruct() {
		if(count($this->defaultColumns) == 0) {
			/*
			$this->defaultColumns[] = array(
				'class' => 'CCheckBoxColumn',
				'name' => 'id',
				'selectableRows' => 2,
				'checkBoxHtmlOptions' => array('name' => 'trash_id[]')
			);
			*/
			$this->defaultColumns[] = array(
				'header' => 'No',
				'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'
			);
			if(!isset($_GET['invite'])) {
				$this->defaultColumns[] = array(
					'name' => 'email_search',
					'value' => '$data->invite->newsletter->email',
				);
				$this->defaultColumns[] = array(
					'name' => 'user_search',
					'value' => '$data->invite->user_id ? $data->invite->user->displayname : \'-\'',
				);
				$this->defaultColumns[] = array(
					'name' => 'userlevel_search',
					'value' => '$data->invite->user_id ? Phrase::trans($data->invite->user->level->name) : \'-\'',
					'filter'=>UserLevel::getUserLevel(),
					'type' => 'raw',
				);
			}
			$this->defaultColumns[] = array(
				'name' => 'code',
				'value' => '$data->code',
			);
			$this->defaultColumns[] = array(
				'name' => 'invite_date',
				'value' => 'Utility::dateFormat($data->invite_date, true)',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter' => Yii::app()->controller->widget('application.components.system.CJuiDatePicker', array(
					'model'=>$this,
					'attribute'=>'invite_date',
					'language' => 'en',
					'i18nScriptFile' => 'jquery-ui-i18n.min.js',
					//'mode'=>'datetime',
					'htmlOptions' => array(
						'id' => 'invite_date_filter',
					),
					'options'=>array(
						'showOn' => 'focus',
						'dateFormat' => 'dd-mm-yy',
						'showOtherMonths' => true,
						'selectOtherMonths' => true,
						'changeMonth' => true,
						'changeYear' => true,
						'showButtonPanel' => true,
					),
				), true),
			);
			$this->defaultColumns[] = array(
				'name' => 'invite_ip',
				'value' => '$data->invite_ip',
				'htmlOptions' => array(
					'class' => 'center',
				),
			);
			$this->defaultColumns[] = array(
				'name' => 'expired_search',
				'value' => '$data->view->publish == 1 ? Chtml::image(Yii::app()->theme->baseUrl.\'/images/icons/publish.png\') : Chtml::image(Yii::app()->theme->baseUrl.\'/images/icons/unpublish.png\')',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter'=>array(
					1=>Yii::t('phrase', 'Yes'),
					0=>Yii::t('phrase', 'No'),
				),
				'type' => 'raw',
			);
			/*
			$this->defaultColumns[] = array(
				'name' => 'expired_date',
				'value' => 'Utility::dateFormat($data->expired_date)',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter' => Yii::app()->controller->widget('application.components.system.CJuiDatePicker', array(
					'model'=>$this,
					'attribute'=>'expired_date',
					'language' => 'en',
					'i18nScriptFile' => 'jquery-ui-i18n.min.js',
					//'mode'=>'datetime',
					'htmlOptions' => array(
						'id' => 'expired_date_filter',
					),
					'options'=>array(
						'showOn' => 'focus',
						'dateFormat' => 'dd-mm-yy',
						'showOtherMonths' => true,
						'selectOtherMonths' => true,
						'changeMonth' => true,
						'changeYear' => true,
						'showButtonPanel' => true,
					),
				), true),
			);
			*/
		}
		parent::afterConstruct();
	}

	/**
	 * User get information
	 */
	public static function getInfo($id, $column=null)
	{
		if($column != null) {
			$model = self::model()->findByPk($id,array(
				'select' => $column
			));
			return $model->$column;
			
		} else {
			$model = self::model()->findByPk($id);
			return $model;			
		}
	}

}