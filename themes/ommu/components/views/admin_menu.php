<?php
	$menuRender = 0;
	if(($module == null && in_array($controller, array('admin'))) || ($module != null && (in_array($module, array('report')) || ($module == 'support' && (!in_array($currentAction, array('mail/setting')) && !in_array($controller, array('contact','contactcategory'))))))) {
		$menuRender = 1;
		$title = 'Submenu';
		
	} elseif($module == null && in_array($controller, array('page','contentmenu','pluginmenu','module','globaltag','anotherdetail','author','authorcontact','translate'))) {
		$menuRender = 2;
		$title = 'Submenu';
		
	} elseif($module != null && $module == 'users') {
		$menuRender = 3;
		$title = 'Submenu';
		
	} elseif($module == null && in_array($controller, array('settings','language','phrase','theme','locale','pluginphrase','meta','template')) || ($module != null && ($module == 'support' && (in_array($currentAction, array('mail/setting')) || in_array($controller, array('contact','contactcategory')))))) {
		$menuRender = 4;
		$title = 'Submenu';
	}
?>

<?php //begin.Main Menu ?>
<div class="mainmenu">
	<ul class="clearfix">
		<li <?php echo $menuRender == 1 ? 'class="active"' : ''; ?>><a class="dashboard" href="<?php echo Yii::app()->createUrl('admin/index');?>" title="<?php echo Phrase::trans(132,0);?>"><?php echo Phrase::trans(132,0);?></a></li>
		<li <?php echo $menuRender == 2 ? 'class="active"' : ''; ?>><a class="content" href="<?php echo Yii::app()->createUrl('page/manage');?>" title="<?php echo Phrase::trans(136,0);?>"><?php echo Phrase::trans(136,0);?></a></li>
		<?php 
			$plugin = OmmuPlugins::getPlugin(1);
			if($plugin != null) {
				foreach($plugin as $key => $val) {
					$menu = OmmuPluginMenu::model()->findAll(array(
						//'select' => 'name, module, url, dialog',
						'condition' => 'module = :module AND enabled = :enabled AND FIND_IN_SET(:userlevel,userlevel_access)',
						'params' => array(
							':module' => $val->folder,
							':enabled' => 1,
							':userlevel' => Yii::app()->user->level,
						),
						'order'=> 'orders ASC',
					));
					if($menu != null) {
						//attr url					
						$arrAttrParams = array();
						if($menu[0]->attr != '-') {
							$arrAttr = explode(',', $menu[0]->attr);
							if(count($arrAttr) > 0) {
								foreach($arrAttr as $row) {
									$part = explode('=', $row);
									if(strpos($part[1], '$_GET') !== false) {								
										$list = explode('*', $part[1]);
										if(count($list) == 2)
											$arrAttrParams[$part[0]] = $_GET[$list[1]];
										elseif(count($list) == 3)
											$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]];
										elseif(count($list) == 4)
											$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]][$list[3]];
										elseif(count($list) == 5)
											$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]][$list[3]][$list[4]];
										
									} else {
										$arrAttrParams[$part[0]] = $part[1];
									}
								}
							}
						}

						$url = Yii::app()->createUrl($menu[0]->module.'/'.$menu[0]->url, $arrAttrParams);
						//$titleApps = $val->name;
						$titleApps = Phrase::trans($val->code, 1);
						if($val->folder == $module) {
							$class = 'class="active"';
							$title = $val->name;
						} else {
							$class = '';
						}

						$item = '<li '.$class.'>';
						$item .= '<a href="'.$url.'" title="'.$titleApps.'">'.$titleApps.'</a>';
						$item .= '</li>';
						echo $item;
					}
				}
			}
		?>
		<li <?php echo $menuRender == 3 ? 'class="active"' : ''; ?>><a class="member" href="<?php echo ($setting->site_type == 1 && Yii::app()->user->level != 1) ? Yii::app()->createUrl('users/member/manage') : Yii::app()->createUrl('users/admin/manage') ?>" title="<?php echo Phrase::trans(16002,1);?>"><?php echo Phrase::trans(16002,1);?></a></li>
		<li <?php echo $menuRender == 4 ? 'class="active"' : ''; ?>><a class="setting" href="<?php echo Yii::app()->user->level == 1 ? Yii::app()->createUrl('settings/general') : Yii::app()->createUrl('support/contact/manage');?>" title="<?php echo Phrase::trans(133,0);?>"><?php echo Phrase::trans(133,0);?></a></li>
	</ul>
</div>
<?php //end.Main Menu ?>

<?php //begin.Submenu ?>
<div class="submenu">
	<h3><?php echo $title;?></h3>
	<ul>
	<?php if($menuRender == 1) { //Begin.Dashboard ?>
		<li <?php echo $currentAction == 'admin/dashboard' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('admin/dashboard');?>" title="<?php echo Phrase::trans(330,0);?>"><?php echo Phrase::trans(330,0);?></a></li>
		<?php if(Yii::app()->user->level == 1) {
			$core = OmmuPlugins::getPlugin(2);
			if($core != null) {
				foreach($core as $key => $val) {
					$menu = OmmuPluginMenu::model()->findAll(array(
						//'select' => 'name, module, url, dialog',
						'condition' => 'module = :module AND enabled = :enabled AND FIND_IN_SET(:userlevel,userlevel_access)',
						'params' => array(
							':module' => $val->folder,
							':enabled' => 1,
							':userlevel' => Yii::app()->user->level,
						),
						'order'=> 'orders ASC',
					));
					if($menu != null) {
						if(count($menu) == 1) {
							$url = Yii::app()->createUrl($menu[0]->module.'/'.$menu[0]->url);
							$titleApps = $val->name;
							$urlArray = explode('/', $menu[0]->url);
							if($controller == $urlArray[0])
								$class = 'class="selected"';
						} else {
							if($val->folder == $module) {
								$class = 'class="submenu-show"';
								$url = 'javascript:void(0);';
							} else {
								$class = '';
								$url = Yii::app()->createUrl($menu[0]->module.'/'.$menu[0]->url);
							}
							$titleApps = $val->name;
						}

						$item = '<li '.$class.'>';
						$item .= '<a href="'.$url.'" title="'.$titleApps.'">'.$titleApps.'</a>';
						if(count($menu) > 1) {
							$item .= '<ul>';
							foreach($menu as $key => $data) {
								$urlArray = explode('/', $data->url);
								$liClass = $controller == $urlArray[0] ? 'class="selected"' : '';
								$aClass = $data->dialog == 1 ? 'id="default"' : '';
								$icons = $data->icon != '-' ? $data->icon : 'C';

								$item .= '<li '.$liClass.'><a '.$aClass.' href="'.Yii::app()->createUrl($data->module.'/'.$data->url).'" title="'.Phrase::trans($data->name, 2).'"><span class="icons">'.$icons.'</span>'.Phrase::trans($data->name, 2).'</a></li>';
							}	
							$item .= '</ul>';
						}
						$item .= '</li>';
						echo $item;
					}
				}
			}
			
		}?>
		<li><a href="<?php echo Yii::app()->createUrl('users/admin/edit')?>" title="<?php echo Phrase::trans(16222,1).': '.Yii::app()->user->displayname;?>"><?php echo Phrase::trans(16222,1);?></a></li>
		<li><a href="<?php echo Yii::app()->createUrl('users/admin/password')?>" title="<?php echo Phrase::trans(16122,1).': '.Yii::app()->user->displayname;?>"><?php echo Phrase::trans(16122,1);?></a></li>

	<?php } elseif($menuRender == 2) { //Begin.Content ?>
		<li <?php echo $controller == 'page' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('page/manage');?>" title="<?php echo Phrase::trans(134,0);?>"><?php echo Phrase::trans(134,0);?></a></li>
		<?php if(Yii::app()->user->level == 1 && $setting->site_admin == 1) {?>
			<li <?php echo $controller == 'contentmenu' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('contentmenu/manage');?>" title="<?php echo Phrase::trans(205,0);?>"><?php echo Phrase::trans(205,0);?></a></li>
			<li <?php echo $controller == 'pluginmenu' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('pluginmenu/manage');?>" title="<?php echo Phrase::trans(272,0);?>"><?php echo Phrase::trans(272,0);?></a></li>
			<li <?php echo $controller == 'module' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('module/manage');?>" title="<?php echo Phrase::trans(135,0);?>"><?php echo Phrase::trans(135,0);?></a></li>
		<?php }?>
		<li <?php echo $controller == 'globaltag' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('globaltag/manage');?>" title="<?php echo Phrase::trans(494,0);?>"><?php echo Phrase::trans(494,0);?></a></li>		
		<?php if($setting->site_type == 1) {?>
			<li <?php echo $controller == 'anotherdetail' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('anotherdetail/manage');?>" title="<?php echo Phrase::trans(360,0);?>"><?php echo Phrase::trans(360,0);?></a></li>
			<li <?php echo ($module == null && in_array($controller, array('author','authorcontact'))) ? 'class="submenu-show"' : '';?>>
				<a href="<?php echo ($module == null && in_array($controller, array('author','authorcontact'))) ? 'javascript:void(0);' : Yii::app()->createUrl('author/manage');?>" title="<?php echo Phrase::trans(385,0);?>"><?php echo Phrase::trans(385,0);?></a>
				<?php if($module == null && in_array($controller, array('author','authorcontact'))) {?>
				<ul>
					<li <?php echo $controller == 'author' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('author/manage');?>" title="Author"><span class="icons">C</span>Author</a></li>
					<li <?php echo $controller == 'authorcontact' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('authorcontact/manage');?>" title="Author Contact"><span class="icons">C</span>Author Contact</a></li>
				</ul>
				<?php }?>
			</li>
		<?php }?>
		<li <?php echo $controller == 'translate' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('translate/manage');?>" title="<?php echo Phrase::trans(351,0);?>"><?php echo Phrase::trans(351,0);?></a></li>

	<?php } elseif($module != null && !in_array($module, array('users','report','support'))) {?>
		<?php 
		$menu = OmmuPluginMenu::model()->findAll(array(
			//'select' => 'name, module, url, dialog',
			'condition' => 'module = :module AND parent = :parent AND enabled = :enabled',
			'params' => array(
				':module' => $module,
				':parent' => 0,
				':enabled' => 1,
			),
			'order'=> 'orders ASC',
		));
		if($menu != null) {
			if(count($menu) > 1) {
				foreach($menu as $key => $val) {
					$urlArray = explode('/', $val->url);
					//$aClass = $val->dialog == 1 ? 'id="default"' : '';
					if(count($urlArray) == 3)
						$aClass = $controller == $urlArray[0].'/'.$urlArray[1] ? 'class="active"' : '';
					else
						$aClass = $controller == $urlArray[0] ? 'class="active"' : '';
						
					$icons = $val->icon != '-' ? $val->icon : 'C';

					//attr url					
					$arrAttrParams = array();
					if($val->attr != '-') {
						$arrAttr = explode(',', $val->attr);
						if(count($arrAttr) > 0) {
							foreach($arrAttr as $row) {
								$part = explode('=', $row);
								if(strpos($part[1], '$_GET') !== false) {								
									$list = explode('*', $part[1]);
									if(count($list) == 2)
										$arrAttrParams[$part[0]] = $_GET[$list[1]];
									elseif(count($list) == 3)
										$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]];
									elseif(count($list) == 4)
										$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]][$list[3]];
									elseif(count($list) == 5)
										$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]][$list[3]][$list[4]];
									
								} else {
									$arrAttrParams[$part[0]] = $part[1];
								}
							}
						}
					}
					$submenu = OmmuPluginMenu::model()->findAll(array(
						//'select' => 'name, module, url, dialog',
						'condition' => 'module = :module AND parent = :parent AND enabled = :enabled',
						'params' => array(
							':module' => $val->module,
							':parent' => $val->menu_id,
							':enabled' => 1,
						),
						'order'=> 'orders ASC',
					));
					$class = $submenu != null ? 'class="submenu-show"' : '';
					echo '<li '.$class.'>';
					echo '<a '.$aClass.' href="'.Yii::app()->createUrl($val->module.'/'.$val->url, $arrAttrParams).'" title="'.Phrase::trans($val->name, 2).'">'.Phrase::trans($val->name, 2).'</a>';
						if($submenu != null) {
							echo '<ul>';
							foreach($submenu as $key => $data) {
								$urlArray = explode('/', $data->url);
								if(count($urlArray) == 3)
									$subLiClass = $controller == $urlArray[0].'/'.$urlArray[1] ? 'class="selected"' : '';
								else
									$subLiClass = $controller == $urlArray[0] ? 'class="selected"' : '';
								$subClass = $data->dialog == 1 ? 'id="default"' : '';
								$subIcons = $data->icon != '-' ? $data->icon : 'C';

								//attr url					
								$arrAttrParams = array();
								if($data->attr != '-') {
									$arrAttr = explode(',', $data->attr);
									if(count($arrAttr) > 0) {
										foreach($arrAttr as $row) {
											$part = explode('=', $row);
											if(strpos($part[1], '$_GET') !== false) {								
												$list = explode('*', $part[1]);
												if(count($list) == 2)
													$arrAttrParams[$part[0]] = $_GET[$list[1]];
												elseif(count($list) == 3)
													$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]];
												elseif(count($list) == 4)
													$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]][$list[3]];
												elseif(count($list) == 5)
													$arrAttrParams[$part[0]] = $_GET[$list[1]][$list[2]][$list[3]][$list[4]];
												
											} else {
												$arrAttrParams[$part[0]] = $part[1];
											}
										}
									}
								}
								echo '<li '.$subLiClass.'><a '.$subClass.' href="'.Yii::app()->createUrl($data->module.'/'.$data->url, $arrAttrParams).'" title="'.Phrase::trans($data->name, 2).'"><span class="icons">'.$subIcons.'</span>'.Phrase::trans($data->name, 2).'</a></li>';								
							}
							echo '</ul>';
						}						
					echo '</li>';
				}
			}
		}
		?>

	<?php } elseif($menuRender == 3) { //Begin.Member ?>
		<?php if(Yii::app()->user->level == 1) {?>
			<li <?php echo $controller == 'admin' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('users/admin/manage');?>" title="<?php echo Phrase::trans(16003,1);?>"><?php echo Phrase::trans(16003,1);?></a></li>
		<?php }?>
		<li <?php echo $controller == 'member' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('users/member/manage');?>" title="<?php echo Phrase::trans(16001,1);?>"><?php echo Phrase::trans(16001,1);?></a>
		</li>
		<?php if(Yii::app()->user->level == 1) {?>
			<li <?php echo $controller == 'level' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->controller->createUrl('level/manage');?>" title="<?php echo Phrase::trans(16004,1);?>"><?php echo Phrase::trans(16004,1);?></a></li>
		<?php }?>
		<?php if($setting->site_type == 1) {?>
			<li <?php echo $controller == 'newsletter' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->controller->createUrl('newsletter/manage');?>" title="<?php echo Phrase::trans(16242,1);?>"><?php echo Phrase::trans(16242,1);?></a></li>
		<?php }
		if(Yii::app()->user->level == 1) {?>
			<li <?php echo ($controller == 'history' && in_array($action, array('login','username','email','password','forgot','subscribe'))) ? 'class="submenu-show"' : '';?>>
				<a href="<?php echo ($controller == 'history' && in_array($action, array('login','username','email','password','forgot','subscribe' 	))) ? 'javascript:void(0);' : Yii::app()->controller->createUrl('history/login');?>" title="<?php echo Phrase::trans(16236,1);?>"><?php echo Phrase::trans(16236,1);?></a>
				<?php if($controller == 'history' && in_array($action, array('login','username','email','password','forgot','subscribe'))) {?>
				<ul>
					<li <?php echo $action == 'login' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->controller->createUrl('history/login');?>" title="<?php echo Phrase::trans(16192,1);?>"><span class="icons">C</span><?php echo Phrase::trans(16192,1);?></a></li>
					<?php if($setting->site_type == 1) {?>
						<li <?php echo $action == 'username' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->controller->createUrl('history/username');?>" title="<?php echo Phrase::trans(16253,1);?>"><span class="icons">C</span><?php echo Phrase::trans(16253,1);?></a></li>
					<?php }?>
					<li <?php echo $action == 'email' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->controller->createUrl('history/email');?>" title="<?php echo Phrase::trans(16251,1);?>"><span class="icons">C</span><?php echo Phrase::trans(16251,1);?></a></li>
					<li <?php echo $action == 'password' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->controller->createUrl('history/password');?>" title="<?php echo Phrase::trans(16252,1);?>"><span class="icons">C</span><?php echo Phrase::trans(16252,1);?></a></li>
					<?php if($setting->site_type == 1) {?>			
						<li <?php echo $action == 'forgot' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->controller->createUrl('history/forgot');?>" title="<?php echo Phrase::trans(16246,1);?>"><span class="icons">C</span><?php echo Phrase::trans(16246,1);?></a></li>
						<li <?php echo $action == 'subscribe' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->controller->createUrl('history/subscribe');?>" title="<?php echo Phrase::trans(16242,1);?>"><span class="icons">C</span><?php echo Phrase::trans(16242,1);?></a></li>
					<?php }?>
				</ul>
				<?php }?>
			</li>
		<?php }
		if($setting->site_type == 1) {?>
			<li <?php echo $controller == 'statistic' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('users/statistic/manage');?>" title="<?php echo Phrase::trans(16241,1);?>"><?php echo Phrase::trans(16241,1);?></a></li>
		<?php }?>

	<?php } elseif($menuRender == 4) { //Begin.Setting ?>
		<?php if(Yii::app()->user->level == 1) {?>
			<li <?php echo $currentAction == 'settings/general' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('settings/general');?>" title="<?php echo Phrase::trans(94,0);?>"><?php echo Phrase::trans(94,0);?></a></li>
			<?php if($setting->site_type == 1) {?>
				<li <?php echo $currentAction == 'settings/banned' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('settings/banned');?>" title="<?php echo Phrase::trans(63,0);?>"><?php echo Phrase::trans(63,0);?></a></li>
				<li <?php echo $currentAction == 'settings/signup' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('settings/signup');?>" title="<?php echo Phrase::trans(5,0);?>"><?php echo Phrase::trans(5,0);?></a></li>
			<?php }?>
			<li <?php echo $controller == 'meta' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('meta/edit');?>" title="<?php echo Phrase::trans(551,0);?>"><?php echo Phrase::trans(551,0);?></a></li>
			<li <?php echo $controller == 'locale' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('locale/setting');?>" title="<?php echo Phrase::trans(241,0);?>"><?php echo Phrase::trans(241,0);?></a></li>
			<li <?php echo ($currentAction == 'mail/setting' || $controller == 'template') ? 'class="submenu-show"' : '' ?>>
				<a <?php echo $currentAction == 'mail/setting' ? 'class="active"' : '' ?> href="<?php echo Yii::app()->createUrl('support/mail/setting');?>" title="<?php echo Phrase::trans(23002,1);?>"><?php echo Phrase::trans(23002,1);?></a>
				<ul>
					<li <?php echo $controller == 'template' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('template/manage');?>" title="<?php echo Phrase::trans(602,0);?>"><span class="icons">C</span><?php echo Phrase::trans(602,0);?></a></li>
				</ul>
			</li>
			<li <?php echo in_array($controller, array('contact','contactcategory')) ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('support/contact/manage');?>" title="<?php echo Phrase::trans(23061,1);?>"><?php echo Phrase::trans(23061,1);?></a></li>
			<li <?php echo in_array($controller, array('language','phrase','pluginphrase')) ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('language/manage');?>" title="<?php echo Phrase::trans(137,0);?>"><?php echo Phrase::trans(137,0);?></a></li>
			<li <?php echo $controller == 'theme' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('theme/manage');?>" title="<?php echo Phrase::trans(240,0);?>"><?php echo Phrase::trans(240,0);?></a></li>
			<li <?php echo $currentAction == 'settings/analytic' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('settings/analytic');?>" title="<?php echo Phrase::trans(58,0);?>"><?php echo Phrase::trans(58,0);?></a></li>		
		<?php } else {?>
			<li <?php echo in_array($controller, array('contact','contactcategory')) ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('support/contact/manage');?>" title="<?php echo Phrase::trans(23061,1);?>"><?php echo Phrase::trans(23061,1);?></a></li>
			<li <?php echo $controller == 'template' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('template/manage');?>" title="<?php echo Phrase::trans(602,0);?>"><?php echo Phrase::trans(602,0);?></a></li>
		<?php }?> 
	<?php }?>
	</ul>
</div>
<?php //end.Submenu ?>