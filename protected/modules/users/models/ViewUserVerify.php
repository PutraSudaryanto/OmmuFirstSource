<?php
/**
 * ViewUserVerify
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 3 August 2017, 14:22 WIB
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
 * This is the model class for table "_view_user_verify".
 *
 * The followings are the available columns in table '_view_user_verify':
 * @property string $verify_id
 * @property integer $publish
 * @property string $verify_day_left
 * @property string $verify_hour_left
 */
class ViewUserVerify extends CActiveRecord
{
	public $defaultColumns = array();

	// Variable Search	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ViewUserVerify the static model class
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
		return $matches[1].'._view_user_verify';
	}

	/**
	 * @return string the primarykey column
	 */
	public function primaryKey()
	{
		return 'verify_id';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('publish', 'numerical', 'integerOnly'=>true),
			array('verify_id', 'length', 'max'=>11),
			array('verify_day_left, verify_hour_left', 'length', 'max'=>21),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('verify_id, publish, verify_day_left, verify_hour_left', 'safe', 'on'=>'search'),
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
			'verify_id' => Yii::t('attribute', 'Verify'),
			'publish' => Yii::t('attribute', 'Publish'),
			'verify_day_left' => Yii::t('attribute', 'Day Left'),
			'verify_hour_left' => Yii::t('attribute', 'Hour Left'),
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

		$criteria->compare('t.verify_id',$this->verify_id);
		$criteria->compare('t.publish',$this->publish);
		$criteria->compare('t.verify_day_left',$this->verify_day_left);
		$criteria->compare('t.verify_hour_left',$this->verify_hour_left);

		if(!isset($_GET['ViewUserVerify_sort']))
			$criteria->order = 't.verify_id DESC';

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
			$this->defaultColumns[] = 'verify_id';
			$this->defaultColumns[] = 'publish';
			$this->defaultColumns[] = 'verify_day_left';
			$this->defaultColumns[] = 'verify_hour_left';
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
				'name' => 'verify_id',
				'value' => '$data->verify_id',
			);
			$this->defaultColumns[] = array(
				'name' => 'verify_day_left',
				'value' => '$data->verify_day_left',
			);
			$this->defaultColumns[] = array(
				'name' => 'verify_hour_left',
				'value' => '$data->verify_hour_left',
			);
			$this->defaultColumns[] = array(
				'name' => 'publish',
				'value' => '$data->publish == 1 ? Chtml::image(Yii::app()->theme->baseUrl.\'/images/icons/publish.png\') : Chtml::image(Yii::app()->theme->baseUrl.\'/images/icons/unpublish.png\')',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter'=>array(
					1=>Yii::t('phrase', 'Yes'),
					0=>Yii::t('phrase', 'No'),
				),
				'type' => 'raw',
			);
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