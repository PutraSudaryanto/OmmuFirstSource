<?php
/**
 * OmmuTimezone
 * version: 1.3.0
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2012 Ommu Platform (opensource.ommu.co)
 * @link https://github.com/ommu/core
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
 * This is the model class for table "ommu_core_timezone".
 *
 * The followings are the available columns in table 'ommu_core_timezone':
 * @property integer $timezone_id
 * @property integer $default
 * @property string $timezone_name
 * @property string $title
 */
class OmmuTimezone extends CActiveRecord
{
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OmmuTimezone the static model class
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
		return 'ommu_core_timezone';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('timezone_name, title', 'required'),
			array('default', 'numerical', 'integerOnly'=>true),
			array('timezone_name, title', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('timezone_id, default, timezone_name, title', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'timezone_id' => Yii::t('attribute', 'Timezone'),
			'default' => Yii::t('attribute', 'Default'),
			'timezone_name' => Yii::t('attribute', 'Timezone'),
			'title' => Yii::t('attribute', 'Title'),
		);
	}
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('t.timezone_id',$this->timezone_id);
		$criteria->compare('t.default',$this->default);
		$criteria->compare('t.timezone_name',strtolower($this->timezone_name),true);
		$criteria->compare('t.title',strtolower($this->title),true);

		if(!isset($_GET['OmmuTimezone_sort']))
			$criteria->order = 't.timezone_id DESC';

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
		}else {
			//$this->defaultColumns[] = 'timezone_id';
			$this->defaultColumns[] = 'default';
			$this->defaultColumns[] = 'timezone_name';
			$this->defaultColumns[] = 'title';
		}

		return $this->defaultColumns;
	}

	/**
	 * Set default columns to display
	 */
	protected function afterConstruct() {
		if(count($this->defaultColumns) == 0) {
			$this->defaultColumns[] = 'timezone_id';
			$this->defaultColumns[] = 'default';
			$this->defaultColumns[] = 'timezone_name';
			$this->defaultColumns[] = 'title';
		}
		parent::afterConstruct();
	}

	/**
	 * Get Default
	 */
	public static function getDefault(){
		$model = self::model()->findByAttributes(array('default' => 1));
		return $model->timezone_id;
	}

	/**
	 * Get Locale
	 */
	public static function getTimezone() {
		$model = self::model()->findAll();
		$items = array();
		if($model != null) {
			foreach($model as $key => $val) {
				$items[$val->timezone_id] = $val->title;
			}
			return $items;
		}else {
			return false;
		}
	}
	
	/**
	 * before save attributes
	 */
	protected function beforeSave() {
		if(parent::beforeSave()) {
			if(!$this->isNewRecord) {
				if($this->default != 1) {
					self::model()->updateAll(array(
						'default' => 0,	
					));
					$this->default = 1;
				}
			}
		}
		return true;
	}

}