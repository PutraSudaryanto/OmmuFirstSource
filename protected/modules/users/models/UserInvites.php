<?php
/**
 * UserInvites
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2012 Ommu Platform (opensource.ommu.co)
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
 * This is the model class for table "ommu_user_invites".
 *
 * The followings are the available columns in table 'ommu_user_invites':
 * @property string $invite_id
 * @property integer $publish
 * @property string $newsletter_id
 * @property string $user_id
 * @property string $code
 * @property integer $invites
 * @property string $invite_date
 * @property string $invite_ip
 * @property string $modified_date
 * @property string $modified_id
 * @property string $updated_date
 *
 * The followings are the available model relations:
 * @property UserNewsletter $newsletter
 */
class UserInvites extends CActiveRecord
{
	public $defaultColumns = array();	
	public $email_i;
	public $multiple_email_i;
	
	// Variable Search
	public $newsletter_user_search;
	public $newsletter_email_search;
	public $register_search;
	public $userlevel_search;
	public $user_search;
	public $modified_search;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserInvites the static model class
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
		return 'ommu_user_invites';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, code', 'required'),
			array('
				email_i', 'required', 'on'=>'singleEmailForm'),
			array('newsletter_id, user_id, invites, modified_id,
				multiple_email_i', 'numerical', 'integerOnly'=>true),
			array('newsletter_id, user_id, invites, modified_id', 'length', 'max'=>11),
			array('code', 'length', 'max'=>16),
			array('invite_ip', 'length', 'max'=>20),
			array('', 'length', 'max'=>64),
			array('
				email_i', 'email', 'on'=>'singleEmailForm'),
			array('
				email_i, multiple_email_i', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('invite_id, newsletter_id, user_id, code, invites, invite_date, invite_ip, modified_date, modified_id, updated_date,
				email_i, newsletter_user_search, newsletter_email_search, register_search, userlevel_search, user_search, modified_search', 'safe', 'on'=>'search'),
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
			'newsletter' => array(self::BELONGS_TO, 'UserNewsletter', 'newsletter_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'modified' => array(self::BELONGS_TO, 'Users', 'modified_id'),
			'histories' => array(self::HAS_MANY, 'UserInviteHistory', 'invite_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'invite_id' => Yii::t('attribute', 'Invite'),
			'publish' => Yii::t('attribute', 'Publish'),
			'newsletter_id' => Yii::t('attribute', 'Newsletter'),
			'user_id' => Yii::t('attribute', 'Inviter'),
			'code' => Yii::t('attribute', 'Invite Code'),
			'invites' => Yii::t('attribute', 'Invites'),
			'invite_date' => Yii::t('attribute', 'Invite Date'),
			'invite_ip' => Yii::t('attribute', 'Invite Ip'),
			'modified_date' => Yii::t('attribute', 'Modified Date'),
			'modified_id' => Yii::t('attribute', 'Modified'),
			'updated_date' => Yii::t('attribute', 'Updated Date'),
			'email_i' => Yii::t('attribute', 'Email'),
			'multiple_email_i' => Yii::t('attribute', 'Multiple Email'),
			'newsletter_user_search' => Yii::t('attribute', 'Displayname'),
			'newsletter_email_search' => Yii::t('attribute', 'Email'),
			'register_search' => Yii::t('attribute', 'Register'),
			'userlevel_search' => Yii::t('attribute', 'Level Inviter'),
			'user_search' => Yii::t('attribute', 'Inviter'),
			'modified_search' => Yii::t('attribute', 'Modified'),
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
		
		// Custom Search
		$criteria->with = array(
			'newsletter' => array(
				'alias'=>'newsletter',
				'select'=>'newsletter_id, user_id, email'
			),
			'newsletter.view' => array(
				'alias'=>'newsletter_view',
				'select'=>'user_id, register'
			),
			'newsletter.view.user' => array(
				'alias'=>'newsletter_view_user',
				'select'=>'displayname'
			),
			'newsletter.user' => array(
				'alias'=>'newsletter_user',
				'select'=>'displayname'
			),
			'user' => array(
				'alias'=>'user',
				'select'=>'level_id, displayname'
			),
			'modified' => array(
				'alias'=>'modified',
				'select'=>'displayname'
			),
		);

		$criteria->compare('t.invite_id',$this->invite_id);
		if(isset($_GET['newsletter']))
			$criteria->compare('t.newsletter_id',$_GET['newsletter']);
		else
			$criteria->compare('t.newsletter_id',$this->newsletter_id);
		if(isset($_GET['user']))
			$criteria->compare('t.user_id',$_GET['user']);
		else
			$criteria->compare('t.user_id',$this->user_id);
		$criteria->compare('t.code',strtolower($this->code),true);
		$criteria->compare('t.invites',$this->invites);
		if($this->invite_date != null && !in_array($this->invite_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.invite_date)',date('Y-m-d', strtotime($this->invite_date)));
		$criteria->compare('t.invite_ip',strtolower($this->invite_ip),true);
		if($this->modified_date != null && !in_array($this->modified_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.modified_date)',date('Y-m-d', strtotime($this->modified_date)));
		if(isset($_GET['modified']))
			$criteria->compare('t.modified_id',$_GET['modified']);
		else
			$criteria->compare('t.modified_id',$this->modified_id);
		if($this->updated_date != null && !in_array($this->updated_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.updated_date)',date('Y-m-d', strtotime($this->updated_date)));
		
		if($this->newsletter->view->user_id)
			$criteria->compare('newsletter_view_user.displayname',strtolower($this->newsletter_user_search),true);
		else
			$criteria->compare('newsletter_user.displayname',strtolower($this->newsletter_user_search),true);
		$criteria->compare('newsletter.email',strtolower($this->newsletter_email_search),true);
		$criteria->compare('newsletter_view.register',$this->register_search);
		$criteria->compare('user.level_id',$this->userlevel_search);
		$criteria->compare('user.displayname',strtolower($this->user_search),true);
		$criteria->compare('modified.displayname',strtolower($this->modified_search),true);

		if(!isset($_GET['UserInvites_sort']))
			$criteria->order = 't.invite_id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
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
			//$this->defaultColumns[] = 'invite_id';
			$this->defaultColumns[] = 'publish';
			$this->defaultColumns[] = 'newsletter_id';
			$this->defaultColumns[] = 'user_id';
			$this->defaultColumns[] = 'code';
			$this->defaultColumns[] = 'invites';
			$this->defaultColumns[] = 'invite_date';
			$this->defaultColumns[] = 'invite_ip';
			$this->defaultColumns[] = 'modified_date';
			$this->defaultColumns[] = 'modified_id';
			$this->defaultColumns[] = 'updated_date';
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
			if(!isset($_GET['newsletter'])) {
				$this->defaultColumns[] = array(
					'name' => 'newsletter_email_search',
					'value' => '$data->newsletter->email',
				);
				$this->defaultColumns[] = array(
					'name' => 'newsletter_user_search',
					'value' => '$data->newsletter->view->user_id ? $data->newsletter->view->user->displayname : ($data->newsletter->user_id ? $data->newsletter->user->displayname : \'-\')',
				);
			}
			if(!isset($_GET['user'])) {
				$this->defaultColumns[] = array(
					'name' => 'user_search',
					'value' => '$data->user_id ? $data->user->displayname : \'-\'',
				);
				$this->defaultColumns[] = array(
					'name' => 'userlevel_search',
					'value' => '$data->user_id ? Phrase::trans($data->user->level->name) : \'-\'',
					'filter'=>UserLevel::getUserLevel(),
					'type' => 'raw',
				);
			}
			$this->defaultColumns[] = array(
				'name' => 'invite_date',
				'value' => 'Utility::dateFormat($data->invite_date)',
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
				'name' => 'invites',
				'value' => 'CHtml::link($data->invites ? $data->invites : 0, Yii::app()->controller->createUrl("o/invitehistory/manage",array("invite"=>$data->invite_id)))',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'type' => 'raw',
			);
			$this->defaultColumns[] = array(
				'name' => 'register_search',
				'value' => '$data->newsletter->view->register == 1 ? Chtml::image(Yii::app()->theme->baseUrl.\'/images/icons/publish.png\') : Chtml::image(Yii::app()->theme->baseUrl.\'/images/icons/unpublish.png\')',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter'=>array(
					1=>Yii::t('phrase', 'Yes'),
					0=>Yii::t('phrase', 'No'),
				),
				'type' => 'raw',
			);
			if(!isset($_GET['type'])) {
				$this->defaultColumns[] = array(
					'name' => 'publish',
					'value' => 'Utility::getPublish(Yii::app()->controller->createUrl(\'publish\',array(\'id\'=>$data->invite_id)), $data->publish)',
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
	 * generate invite code
	 */
	public static function getUniqueCode() {
		$chars = "abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		srand((double)microtime()*time());
		$i = 0;
		$salt = '' ;

		while ($i <= 7) {
			$num = rand() % 33;
			$tmp = substr($chars, $num, 2);
			$salt = $salt . $tmp; 
			$i++;
		}

		return $salt;
	}

	// Get plugin list
	public static function getInvite($email) 
	{
		$criteria=new CDbCriteria;
		$criteria->with = array(
			'newsletter' => array(
				'alias'=>'newsletter',
				'select'=>'newsletter_id, email',
			),
		);
		$criteria->compare('t.publish',1);
		$criteria->compare('t.user_id','<>0');
		$criteria->compare('newsletter.email',strtolower($email));
		$criteria->order ='t.invite_id DESC';
		$model = self::model()->find($criteria);
		
		return $model;
	}

	// Get plugin list
	public static function getInviteWithCode($email, $code)
	{
		$criteria=new CDbCriteria;
		$criteria->with = array(
			'newsletter' => array(
				'alias'=>'newsletter',
				'select'=>'newsletter_id, status, email'
			),
			'newsletter.view' => array(
				'alias'=>'newsletter_view',
				'select'=>'user_id'
			),
			'histories' => array(
				'alias'=>'histories',
				'together'=>true,
			),
		);
		$criteria->compare('t.publish',1);
		$criteria->compare('newsletter.status',1);
		$criteria->compare('newsletter.email',strtolower($email));
		$criteria->compare('histories.code',$code);
		$criteria->compare('histories.expired_date','>='.date('Y-m-d H:i:s'));
		$criteria->order = 't.invite_id DESC';
		$model = self::model()->find($criteria);
		
		return $model;
	}

	/**
	 * User get information
	 * condition
	 ** 0 = newsletter not null
	 ** 1 = newsletter save
	 ** 2 = newsletter not save
	 */
	public static function insertInvite($email, $user_id)
	{
		$criteria=new CDbCriteria;
		$criteria->compare('email',strtolower($email));
		$newsletterFind = UserNewsletter::model()->find($criteria);

		if($newsletterFind == null) {
			$newsletter = new UserNewsletter;
			$newsletter->email = $email;
			if($newsletter->save())
				$newsletter_id = $newsletter->newsletter_id;
		} else
			$newsletter_id = $newsletterFind->newsletter_id;
		
		$condition = 0;
		if($newsletter->view->user_id == 0) {
			$criteriaInvite=new CDbCriteria;
			$criteriaInvite->compare('publish',1);
			$criteriaInvite->compare('newsletter_id',$newsletter_id);
			$criteriaInvite->compare('user_id',$user_id);
			$model = self::model()->find($criteriaInvite);
			
			if($model == null) {
				$model = new UserInvites;
				$model->newsletter_id = $newsletter_id;
				$model->user_id = $user_id;
				if($model->save())
					$condition = 1;
				else
					$condition = 2;

			} else {
				$model->invites = $model->invites+1;
				if($model->save())
					$condition = 1;
			}
		}
		
		return $condition;
	}
 
	/**
	 * before validate attributes
	 */
	protected function beforeValidate() 
	{
		$module = strtolower(Yii::app()->controller->module->id);
		$controller = strtolower(Yii::app()->controller->id);
		
		if(parent::beforeValidate()) {
			if($this->isNewRecord) {
				if($this->multiple_email_i == 1) {
					if($this->email_i == '')
						$this->addError('email_i', Yii::t('phrase', 'Email cannot be blank.'));
					
				} else {
					if($controller == 'o/invite' && $this->email_i != '') {
						$newsletterFind = UserNewsletter::model()->findByAttributes(array('email'=>strtolower($this->email_i)), array(
							'select' => 'newsletter_id',
						));
						if($newsletterFind == null) {
							$newsletter = new UserNewsletter;
							$newsletter->email = $this->email_i;
							if($newsletter->save())
								$this->newsletter_id = $newsletter->newsletter_id;
						} else
							$this->newsletter_id = $newsletterFind->newsletter_id;

						if($newsletterFind->view->user_id != 0 || $newsletter->view->user_id != 0)
							$this->addError('email_i', Yii::t('phrase', 'Email sudah terdaftar sebagai user'));
					}
				}
				if($this->user_id == 0)
					$this->user_id = !Yii::app()->user->isGuest ? Yii::app()->user->id : 0;

			} else {
				if($controller == 'o/invite')
					$this->modified_id = Yii::app()->user->id;
			}
			
			$this->code = self::getUniqueCode();
			$this->invite_ip = $_SERVER['REMOTE_ADDR'];
		}
		
		return true;
	}
	
	/**
	 * After save attributes
	 */
	protected function afterSave() {
		parent::afterSave();
		if($this->isNewRecord && $this->newsletter->view->user_id == 0) {
			$setting = OmmuSettings::model()->findByPk(1, array(
				'select' => 'signup_checkemail',
			));
			if($setting->signup_checkemail == 1)
				SupportMailSetting::sendEmail($this->newsletter->email, $this->newsletter->email, 'User Invite', 'Silahkan bergabung dan masukkan code invite');
			
			else
				SupportMailSetting::sendEmail($this->newsletter->email, $this->newsletter->email, 'User Invite', 'Silahkan bergabung');
		}
	}

}