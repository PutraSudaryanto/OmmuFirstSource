<?php
/**
 * OFunction class file
 * version: 1.2.0
 *
 * Reference start
 *
 * TOC :
 *	getDataProviderPager
 *	urlParse
 *	twitterParse
 *	OParse
 *	validHostURL
 *	validFeedbackData
 *	setUrlManagerRules
 *	getRulePos
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @create date April 15, 2014 10:29 WIB
 * @copyright Copyright (c) 2014 Ommu Platform (opensource.ommu.co)
 * @link https://github.com/ommu/Core
 * @contact (+62)856-299-4114
 *
 * Contains many function that most used
 *
 */

class OFunction
{
	/**
	 * get data provider pager
	 */
	public static function getDataProviderPager($dataProvider, $attr=true)
	{
		if($attr == true)
			$data = $dataProvider->getPagination();
		else
			$data = $dataProvider;
		
		$pageCount = $data->itemCount >= $data->pageSize ? ($data->itemCount % $data->pageSize === 0 ? (int)($data->itemCount/$data->pageSize) : (int)($data->itemCount/$data->pageSize)+1) : 1;
		$currentPage = $data->itemCount != 0 ? $data->currentPage+1 : 1;
		$nextPage = (($pageCount != $currentPage) && ($pageCount > $currentPage)) ? $currentPage+1 : 0;
		$return = array(
			'pageVar'=>$data->pageVar,
			'itemCount'=>$data->itemCount,
			'pageSize'=>$data->pageSize,
			'pageCount'=>$pageCount,
			'currentPage'=>$currentPage,
			'nextPage'=>$nextPage,
		);
		
		return $return;
	}
	
	/**
	 * PHP Regex to Make Twitter Links Clickable
	 */
	public static function urlParse($data)
	{
		$return = preg_replace('@((https?|ftp)://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a off_address="" href="$1" rel="nofollow"target="_blank">$1</a>', $data);		
		return $return;
	}
	
	/**
	 * PHP Regex to Make Twitter Links Clickable
	 */
	public static function twitterParse($data)
	{
		$return = OFunction::urlParse($data);
		$return = preg_replace('#@([\\d\\w]+)#', '<a off_address="" href="https://twitter.com/$1" rel="nofollow" target="_blank">$0</a>', $return);
		$return = preg_replace('/#([\\d\\w]+)/', '<a off_address="" href="https://twitter.com/hashtag/$1?src=hash" rel="nofollow" target="_blank">$0</a>', $return);
		
		return $return;
	}
	
	/**
	 * PHP Regex to Make Twitter Links Clickable
	 */
	public static function OParse($data)
	{
		$return = OFunction::twitterParse($data);
		return $return;
	}

	/**
	 * Valid target api url, if application ecc3 datacenter is accessed from other place
	 * Defined host url + target url
	 */
	public static function validHostURL($targetUrl) 
	{
		$req = Yii::app()->request;
		$url = ($req->port == 80? 'http://': 'https://') . $req->serverName;
		
		if(substr($targetUrl, 0, 1) != '/')
			$targetUrl = '/'.$targetUrl;
				
		return $url = $url.$targetUrl;
	}

	/**
	 * Valid target api url, if application ecc3 datacenter is accessed from other place
	 * Defined host url + target url
	 */
	public static function validFeedbackData($data) 
	{
		return $data != null ? $data : '-';
	}

	/**
	 * Valid target api url, if application ecc3 datacenter is accessed from other place
	 * Defined host url + target url
	 */
	public static function setUrlManagerRules($public=false) 
	{
		/**
		 * set url manager
		 */
		$rules = array(
			//a standard rule mapping '/' to 'site/index' action
			'' 																	=> 'site/index',
			
			//a standard rule mapping '/login' to 'site/login', and so on
			'<action:(login|logout)>' 											=> 'site/<action>',
			'<slug:[\w\-]+>-<id:\d+>'											=> 'page/view',
			'<slug:[\w\-]+>'													=> 'page/view',
			// module condition
			'<module:\w+>/<controller:\w+>/<action:\w+>'									=> '<module>/<controller>/<action>',
			//controller condition
			'<controller:\w+>/<action:\w+>'								=> '<controller>/<action>',
		);

		/**
		 * Set default controller for homepage, it can be controller, action or module
		 * example:
		 * controller: 'site'
		 * controller from module: 'pose/site/index'.
		 */
		$default = OmmuPlugins::model()->findByAttributes(array('defaults' => 1), array(
			'select' => 'folder',
		));
		if($default == null || ($default != null && ($default->folder == '-' || $default->actived == '2'))) {
			$rules[''] = 'site/index';

		} else {
			$folder = $default->folder != '-' ? $default->folder : 'site/index';
			Yii::app()->defaultController = trim($folder);
			$rules[''] =  trim($folder);
		}

		/**
		 * Split rules into 2 part and then insert url from tabel between them.
		 * and then merge all array back to $rules.
		 */
		$module = OmmuPlugins::model()->findAll(array(
			'select'    => 'actived, folder, search',
			'condition' => 'actived = :actived',
			'params' => array(
				':actived' => '1',
			),
		));		

		$moduleRules  = array();
		$sliceRules   = self::getRulePos($rules);
		if($module !== null && $public == true) {
			foreach($module as $key => $val) {
				if($val->search == '1') {
$moduleRules[$val->folder.'/<slug:[\w\-]+>'] 											= $val->folder.'/site/index';
$moduleRules[$val->folder] 																= $val->folder.'/site/index';
$moduleRules[$val->folder.'/<slug:[\w\-]+>-<id:\d+>'] 									= $val->folder.'/site/view';								// slug-id
//$moduleRules[$val->folder.'/<slug:[\w\-]+>'] 											= $val->folder.'/site/view';								// slug
$moduleRules[$val->folder.'/<controller:[a-zA-Z\/]+>/<slug:[\w\-]+>-<id:\d+>'] 			= $val->folder.'/<controller>/view';						// slug-id
//$moduleRules[$val->folder.'/<controller:[a-zA-Z\/]+>/<slug:[\w\-]+>'] 					= $val->folder.'/<controller>/view';						// slug
$moduleRules[$val->folder.'/<controller:[a-zA-Z\/]+>/<category:\d+>/<slug:[\w\-]+>'] 	= $val->folder.'/<controller>/index';						// category/slug
//$moduleRules[$val->folder.'/<controller:[a-zA-Z\/]+>/<slug:[\w\-]+>'] 					= $val->folder.'/<controller>/index';						// slug
$moduleRules[$val->folder.'/<controller:[a-zA-Z\/]+>/<action:\w+>/<slug:[\w\-]+>-<id:\d+>'] 		= $val->folder.'/<controller>/<action>';		// slug-id
$moduleRules[$val->folder.'/<controller:[a-zA-Z\/]+>/<action:\w+>/<category:\d+>/<slug:[\w\-]+>'] 	= $val->folder.'/<controller>/<action>';		// category/slug
//$moduleRules[$val->folder.'/<controller:[a-zA-Z\/]+>/<action:\w+>/<slug:[\w\-]+>'] 					= $val->folder.'/<controller>/<action>';		// slug
				}
			}
		}
		$rules = array_merge($sliceRules['before'], $moduleRules, $sliceRules['after']);

		Yii::app()->setComponents(array(
			'urlManager' => array(
				'urlFormat' => 'path',
				'showScriptName' => false,
				'rules' => $rules,
			),
		));
	}

	/**
	 * Split rules into two part
	 *
	 * @param array $rules
	 * @return array
	 */
	public static function getRulePos($rules) {
		$result = 1;
		$before = array();
		$after  = array();

		foreach($rules as $key => $val) {
			if($key == '<module:\w+>/<controller:\w+>/<action:\w+>')
				break;
			$result++;
		}

		$i = 1;
		foreach($rules as $key => $val) {
			if($i < $result)
				$before[$key] = $val;
			elseif($i >= $pos)
				$after[$key]  = $val;
			$i++;
		}

		return array('after' => $after, 'before' => $before);
	}
	
}
