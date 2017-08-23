<?php
/**
 * UserSetting
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 4 August 2017, 17:33 WIB
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
 * This is the model class for table "ommu_user_setting".
 *
 * The followings are the available columns in table 'ommu_user_setting':
 * @property integer $id
 * @property string $license
 * @property integer $permission
 * @property string $meta_keyword
 * @property string $meta_description
 * @property string $forgot_diff_type
 * @property integer $forgot_difference
 * @property string $verify_diff_type
 * @property integer $verify_difference
 * @property string $invite_diff_type
 * @property integer $invite_difference
 * @property string $invite_order
 * @property string $modified_date
 * @property string $modified_id
 */
class UserSetting extends CActiveRecord
{
	public $defaultColumns = array();

	// Variable Search	
	public $modified_search;

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserSetting the static model class
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
		return $matches[1].'.ommu_user_setting';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('license, permission, meta_keyword, meta_description, forgot_difference, verify_difference, invite_difference, invite_order', 'required'),
			array('permission, forgot_difference, verify_difference', 'numerical', 'integerOnly'=>true),
			array('license', 'length', 'max'=>32),
			array('forgot_diff_type, verify_diff_type, invite_diff_type', 'length', 'max'=>1),
			array('modified_id', 'length', 'max'=>11),
			array('invite_order', 'length', 'max'=>4),
			array('forgot_diff_type, verify_diff_type, invite_diff_type', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, license, permission, meta_keyword, meta_description, forgot_diff_type, forgot_difference, verify_diff_type, verify_difference, invite_diff_type, invite_difference, invite_order, modified_date, modified_id, 
				modified_search', 'safe', 'on'=>'search'),
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
			'modified' => array(self::BELONGS_TO, 'Users', 'modified_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('attribute', 'ID'),
			'license' => Yii::t('attribute', 'License'),
			'permission' => Yii::t('attribute', 'Permission'),
			'meta_keyword' => Yii::t('attribute', 'Meta Keyword'),
			'meta_description' => Yii::t('attribute', 'Meta Description'),
			'forgot_diff_type' => Yii::t('attribute', '0=day,1=hour'),
			'forgot_difference' => Yii::t('attribute', 'Forgot Difference'),
			'verify_diff_type' => Yii::t('attribute', '0=day,1=hour'),
			'verify_difference' => Yii::t('attribute', 'Verify Difference'),
			'invite_diff_type' => Yii::t('attribute', '0=day,1=hour'),
			'invite_difference' => Yii::t('attribute', 'Invite Difference'),
			'invite_order' => Yii::t('attribute', 'Invite Order'),
			'modified_date' => Yii::t('attribute', 'trigger'),
			'modified_id' => Yii::t('attribute', 'Modified'),
			'modified_search' => Yii::t('attribute', 'Modified'),
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
			'modified' => array(
				'alias'=>'modified',
				'select'=>'displayname'
			),
		);
		
		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.license',strtolower($this->license),true);
		$criteria->compare('t.permission',$this->permission);
		$criteria->compare('t.meta_keyword',strtolower($this->meta_keyword),true);
		$criteria->compare('t.meta_description',strtolower($this->meta_description),true);
		$criteria->compare('t.forgot_diff_type',$this->forgot_diff_type);
		$criteria->compare('t.forgot_difference',$this->forgot_difference);
		$criteria->compare('t.verify_diff_type',$this->verify_diff_type);
		$criteria->compare('t.verify_difference',$this->verify_difference);
		$criteria->compare('t.invite_diff_type',$this->invite_diff_type);
		$criteria->compare('t.invite_difference',$this->invite_difference);
		$criteria->compare('t.invite_order',strtolower($this->invite_order),true);
		if($this->modified_date != null && !in_array($this->modified_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.modified_date)',date('Y-m-d', strtotime($this->modified_date)));
		if(isset($_GET['modified']))
			$criteria->compare('t.modified_id',$_GET['modified']);
		else
			$criteria->compare('t.modified_id',$this->modified_id);

		$criteria->compare('modified.displayname',strtolower($this->modified_search),true);

		if(!isset($_GET['UserSetting_sort']))
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
			$this->defaultColumns[] = 'license';
			$this->defaultColumns[] = 'permission';
			$this->defaultColumns[] = 'meta_keyword';
			$this->defaultColumns[] = 'meta_description';
			$this->defaultColumns[] = 'forgot_diff_type';
			$this->defaultColumns[] = 'forgot_difference';
			$this->defaultColumns[] = 'verify_diff_type';
			$this->defaultColumns[] = 'verify_difference';
			$this->defaultColumns[] = 'invite_diff_type';
			$this->defaultColumns[] = 'invite_difference';
			$this->defaultColumns[] = 'invite_order';
			$this->defaultColumns[] = 'modified_date';
			$this->defaultColumns[] = 'modified_id';
		}

		return $this->defaultColumns;
	}

	/**
	 * Set default columns to display
	 */
	protected function afterConstruct() {
		if(count($this->defaultColumns) == 0) {
			$this->defaultColumns[] = array(
				'header' => 'No',
				'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'
			);
			$this->defaultColumns[] = array(
				'name' => 'license',
				'value' => '$data->license',
			);
			$this->defaultColumns[] = array(
				'name' => 'permission',
				'value' => 'Utility::getPublish(Yii::app()->controller->createUrl(\'permission\',array(\'id\'=>$data->id)), $data->permission)',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter'=>array(
					1=>Yii::t('phrase', 'Yes'),
					0=>Yii::t('phrase', 'No'),
				),
				'type' => 'raw',
			);
			$this->defaultColumns[] = array(
				'name' => 'meta_keyword',
				'value' => '$data->meta_keyword',
			);
			$this->defaultColumns[] = array(
				'name' => 'meta_description',
				'value' => '$data->meta_description',
			);
			$this->defaultColumns[] = array(
				'name' => 'forgot_diff_type',
				'value' => '$data->forgot_diff_type',
			);
			$this->defaultColumns[] = array(
				'name' => 'forgot_difference',
				'value' => '$data->forgot_difference',
			);
			$this->defaultColumns[] = array(
				'name' => 'verify_diff_type',
				'value' => '$data->verify_diff_type',
			);
			$this->defaultColumns[] = array(
				'name' => 'verify_difference',
				'value' => '$data->verify_difference',
			);
			$this->defaultColumns[] = array(
				'name' => 'invite_diff_type',
				'value' => '$data->invite_diff_type',
			);
			$this->defaultColumns[] = array(
				'name' => 'invite_difference',
				'value' => '$data->invite_difference',
			);
			$this->defaultColumns[] = array(
				'name' => 'invite_order',
				'value' => '$data->invite_order',
			);
			$this->defaultColumns[] = array(
				'name' => 'modified_date',
				'value' => 'Utility::dateFormat($data->modified_date)',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter' => Yii::app()->controller->widget('application.components.system.CJuiDatePicker', array(
					'model'=>$this,
					'attribute'=>'modified_date',
					'language' => 'en',
					'i18nScriptFile' => 'jquery-ui-i18n.min.js',
					//'mode'=>'datetime',
					'htmlOptions' => array(
						'id' => 'modified_date_filter',
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
			if(!isset($_GET['modified'])) {
				$this->defaultColumns[] = array(
					'name' => 'modified_search',
					'value' => '$data->modified->displayname',
				);
			}
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

	/**
	 * get Module License
	 */
	public static function getLicense($source='1234567890', $length=16, $char=4)
	{
		$mod = $length%$char;
		if($mod == 0)
			$sep = ($length/$char);
		else
			$sep = (int)($length/$char)+1;
		
		$sourceLength = strlen($source);
		$random = '';
		for ($i = 0; $i < $length; $i++)
			$random .= $source[rand(0, $sourceLength - 1)];
		
		$license = '';
		for ($i = 0; $i < $sep; $i++) {
			if($i != $sep-1)
				$license .= substr($random,($i*$char),$char).'-';
			else
				$license .= substr($random,($i*$char),$char);
		}

		return $license;
	}

	/**
	 * before validate attributes
	 */
	protected function beforeValidate() 
	{
		if(parent::beforeValidate()) {
			if(!$this->isNewRecord)
				$this->modified_id = Yii::app()->user->id;
		}
		return true;
	}

}