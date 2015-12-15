<?php
/**
 * OmmuLanguages
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2012 Ommu Platform (ommu.co)
 * @link https://github.com/oMMu/Ommu-Core
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
 * This is the model class for table "ommu_core_languages".
 *
 * The followings are the available columns in table 'ommu_core_languages':
 * @property integer $language_id
 * @property integer $actived
 * @property integer $defaults
 * @property string $code
 * @property integer $orders
 * @property string $name
 * @property string $creation_date
 * @property string $creation_id
 * @property string $modified_date
 * @property string $modified_id
 */
class OmmuLanguages extends CActiveRecord
{
	public $defaultColumns = array();
	
	// Variable Search
	public $creation_search;
	public $modified_search;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OmmuLanguages the static model class
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
		return 'ommu_core_languages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, name', 'required'),
			array('actived, defaults, orders', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>8),
			array('name', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('language_id, actived, defaults, code, orders, name, creation_date, creation_id, modified_date, modified_id,
				creation_search, modified_search', 'safe', 'on'=>'search'),
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
			'creation_relation' => array(self::BELONGS_TO, 'Users', 'creation_id'),
			'modified_relation' => array(self::BELONGS_TO, 'Users', 'modified_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'language_id' => Phrase::trans(495,0),
			'actived' => Phrase::trans(231,0),
			'defaults' => Phrase::trans(156,0),
			'code' => Phrase::trans(155,0),
			'orders' => Phrase::trans(202,0),
			'name' => Phrase::trans(154,0),
			'creation_date' => 'Creation Date',
			'creation_id' => 'Creation',
			'modified_date' => 'Modified Date',
			'modified_id' => 'Modified',
			'creation_search' => 'Creation',
			'modified_search' => 'Modified',
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

		$criteria->compare('language_id',$this->language_id);
		$criteria->compare('actived',$this->actived);
		$criteria->compare('defaults',$this->defaults);
		$criteria->compare('code',strtolower($this->code),true);
		$criteria->compare('orders',$this->orders);
		$criteria->compare('name',strtolower($this->name),true);
		if($this->creation_date != null && !in_array($this->creation_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.creation_date)',date('Y-m-d', strtotime($this->creation_date)));
		$criteria->compare('t.creation_id',$this->creation_id);
		if($this->modified_date != null && !in_array($this->modified_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.modified_date)',date('Y-m-d', strtotime($this->modified_date)));
		$criteria->compare('t.modified_id',$this->modified_id);
		
		// Custom Search
		$criteria->with = array(
			'creation_relation' => array(
				'alias'=>'creation_relation',
				'select'=>'displayname'
			),
			'modified_relation' => array(
				'alias'=>'modified_relation',
				'select'=>'displayname'
			),
		);
		$criteria->compare('creation_relation.displayname',strtolower($this->creation_search), true);
		$criteria->compare('modified_relation.displayname',strtolower($this->modified_search), true);
		
		if(isset($_GET['OmmuLanguages_sort']))
			$criteria->order = 'language_id DESC';

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
			//$this->defaultColumns[] = 'language_id';
			$this->defaultColumns[] = 'actived';
			$this->defaultColumns[] = 'defaults';
			$this->defaultColumns[] = 'code';
			$this->defaultColumns[] = 'orders';
			$this->defaultColumns[] = 'name';
			$this->defaultColumns[] = 'creation_date';
			$this->defaultColumns[] = 'creation_id';
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
			$this->defaultColumns[] = 'name';
			$this->defaultColumns[] = 'code';
			$this->defaultColumns[] = array(
				'name' => 'creation_search',
				'value' => '$data->creation_relation->displayname',
			);
			$this->defaultColumns[] = array(
				'name'  => 'defaults',
				'value' => '$data->defaults == 0 ? Chtml::image(Yii::app()->theme->baseUrl.\'/images/icons/unpublish.png\') : Chtml::image(Yii::app()->theme->baseUrl.\'/images/icons/publish.png\')',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter'=>array(
					1=>Phrase::trans(588,0),
					0=>Phrase::trans(589,0),
				),
				'type' => 'raw',
			);
			$this->defaultColumns[] = array(
				'name' => 'actived',
				'value' => 'Utility::getPublish(Yii::app()->controller->createUrl("actived",array("id"=>$data->language_id)), $data->actived, 2)',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter'=>array(
					1=>Phrase::trans(588,0),
					0=>Phrase::trans(589,0),
				),
				'type' => 'raw',
			);
		}
		parent::afterConstruct();
	}

	/**
	 * Get Language
	 */
	public static function getLanguage() {
		$model = self::model()->findAll(array('orders' => 'language_id ASC'));
		$items = array();
		if($model != null) {
			foreach($model as $key => $val) {
				$items[$val->language_id] = $val->name;
			}
			return $items;
		}else {
			return false;
		}
	}

	// Get language if condition active
	public static function getLanguageActive() {
		$model = self::model()->findAll(array(
			'select' => 'name',
			'condition' => 'actived = :actived',
			'params' => array(
				':actived' => 1,
			),
			'order'=> 'orders ASC',
		));

		return $model;
	}

	/**
	 * Get Default
	 */
	public static function getDefault(){
		$model = self::model()->findByAttributes(array('defaults' => 1));
		return $model->language_id;
	}

	/**
	 * before validate attributes
	 */
	protected function beforeValidate() {
		if(parent::beforeValidate()) {		
			if($this->isNewRecord) {
				if ($this->defaults == 1) {
					$this->actived = 1;
				}
				$this->orders = 1;
				$this->creation_id = Yii::app()->user->id;	
			} else
				$this->modified_id = Yii::app()->user->id;	
		}
		return true;
	}
	
	/**
	 * before save attributes
	 */
	protected function beforeSave() {
		if(parent::beforeSave()) {
			// Language set to default
			if ($this->defaults == 1) {
				self::model()->updateAll(array(
					'defaults' => 0,	
				));
				$this->defaults = 1;
			}
		}
		return true;
	}
	
	/**
	 * After save attributes
	 */
	protected function afterSave() {
		parent::afterSave();
		if($this->isNewRecord) {
			// Add column in mysql
			$conn = Yii::app()->db;
			$sql = "ALTER TABLE ommu_core_language_phrase ADD COLUMN `$this->code` text NOT NULL default '';";
			$sql .= "ALTER TABLE ommu_core_plugin_phrase ADD COLUMN `$this->code` text NOT NULL default '';";
			$sql .= "ALTER TABLE ommu_core_system_phrase ADD COLUMN `$this->code` text NOT NULL default ''";
			$conn->createCommand($sql)->execute();
		}
	}

	protected function afterDelete() {
		parent::afterDelete();

		// Delete column in mysql
		$conn = Yii::app()->db;
		$sql = "ALTER TABLE ommu_core_language_phrase DROP COLUMN `$this->code`;";
		$sql .= "ALTER TABLE ommu_core_plugin_phrase DROP COLUMN `$this->code`;";
		$sql .= "ALTER TABLE ommu_core_system_phrase DROP COLUMN `$this->code`";
		$conn->createCommand($sql)->execute();

	}

}