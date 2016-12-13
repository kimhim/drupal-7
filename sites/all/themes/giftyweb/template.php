<?php
global $base_path;
global $base_url;

function giftyweb_preprocess_page(&$variables)
{
    if (!empty($variables['node']) && !empty($variables['node']->type)) {
   	 	$variables['theme_hook_suggestions'][] = 'page__node__' . $variables['node']->type;
  	}
}

function giftyweb_preprocess_html(&$variables) {
  //drupal_add_js(drupal_get_path('theme', 'giftyweb') . '/js/custom.js');
}

/*
 * Custom login form
 */
function giftyweb_theme() {
	$items = array();
	$items['user_login'] = array(
			'render element' => 'form',
			'path' => drupal_get_path('theme', 'giftyweb') . '/templates',
			'template' => 'user-login',
			'preprocess functions' => array(
					'giftyweb_preprocess_user_login'
			),
	);
	$items['user_register_form'] = array(
			'render element' => 'form',
			'path' => drupal_get_path('theme', 'giftyweb') . '/templates',
			'template' => 'user-register-form',
			'preprocess functions' => array(
					'giftyweb_preprocess_user_register_form'
			),
	);
	$items['user_pass'] = array(
			'render element' => 'form',
			'path' => drupal_get_path('theme', 'giftyweb') . '/templates',
			'template' => 'user-pass',
			'prgiftywebnctions' => array(
					'giftyweb_preprocess_user_pass'
			),
	);
	return $items;
}

function giftyweb_preprocess_user_login(&$vars) {
  $vars['intro_text'] = t('REGISTERED CUSTOMERS');
}

function giftyweb_preprocess_user_register_form(&$vars) {
  $vars['intro_text'] = t('User Registration');
}

function giftyweb_preprocess_user_pass(&$vars) {
  $vars['intro_text'] = t('Please enter your username or email address to be sent your new password.');
  $args = func_get_args();
  array_shift($args);
  $form_state['build_info']['args'] = $args;
  $vars['form'] = drupal_build_form('user_register_form', $form_state['build_info']['args']);
}


function giftyweb_preprocess_search_result(&$vars) {
	$node = $vars['result']['node'];
	if ($node->nid) { // if the result is a node we can load the teaser
		$vars['teaser'] = node_view($node, 'teaser');
	}
}

function giftyweb_page_alter(&$page)
{
	if (arg(0) == 'search')
	{
		if (!empty($page['content']['system_main']['search_form']))
		{
			hide($page['content']['system_main']['search_form']);
		}
	}
}

function lang() {
	global $language;
	return $language->name;

}


/**
 *getMenuForOHCHR: is a function is used to get top main menu to front end for ohchr website.
 *@autor: kimhim
 *#return: string menu format
 */
function getLang(){
	$language = (lang()=='Cambodian')?'km':'en';
	$query = db_select('languages', 'l');
	$query->fields('l', array('language','name','native','prefix'));
	$query ->condition('l.enabled',1, '=');
	$query ->orderby('l.weight','asc');
	$result = $query->execute();
	echo '<select tabindex="4" class="dropdown">';
		foreach ($result as $record) {?>
			<option value="<?php echo $record->language;?>" id="<?php echo $record->name;?>_lang"><?php echo $record->name; ?> </option>
			<?php
		}
	echo '</select>';
}

function getMainMenu(){
	$language = (lang()=='Cambodian')?'km':'en';
	$query = db_select('menu_links', 'm');
	$query->fields('m', array('menu_name','mlid','plid','router_path','link_path','link_title','hidden','language','external'));
	$query->condition('m.menu_name','main-menu', '=');
	//$query->condition('m.plid',0,'=');
	$query ->condition('m.language',$language,'=');
	$query ->orderby('m.weight','asc');
	$result = $query->execute();
	//var_dump($result);
	$i=1;
	foreach ($result as $record) {
		//var_dump($record);
		$active='';

		$link = rawurldecode(url($record->link_path));
		//$link =$record->link_path;
		//echo request_path().'=';
		//echo $record->link_path.'<br />';
		if($record->link_path=='<front>'){
			$active = 'active grid';
		}else if($record->link_path == request_path()){
			$active = 'active';
		}
		echo '<li class="'.$active.'">';
			echo '<a class="color'.$i.'" href="'.$GLOBALS['base_url'].$link.'"  target="_self">'.$record->link_title.'</a>';
		echo '</li>';
		$i++;
	}
}
function giftyweb_links__system_main_menu($variables) {
	$site_frontpage = variable_get('site_frontpage', 'node');
	$i=1;
	foreach ($variables['links'] as $link) {
		$active = '';
		if($link['href'] == '<front>') {
			$active = 'active grid';
		}
		echo '<li class="'.$active.'">';
			echo '<a class="color'.$i.'" href="'.url($link['href']).'"  target="_self">'.$link['title'].'</a>';
		echo '</li>';
		$i++;
	}
	return $html;
}

function giftyweb_form_alter(&$form, &$form_state, $form_id) {
	$language = (lang()=='Cambodian')?'km':'en';
	$placeholder = 'Search keyword';
	if($language=='km'){
		$placeholder = '​វាយ​ពាក្យ​គន្លឹះ​ស្វែង​រកទី​នេះ​!';
	}
	if ($form_id == 'search_form' && arg(0) == 'search') {
		$form['advanced']['#access'] = FALSE;
	}
  if ($form_id == 'search_block_form') {
    $form['search_block_form']['#title'] = t('Search'); // Change the text on the label element
    $form['search_block_form']['#title_display'] = 'invisible'; // Toggle label visibilty
    //$form['search_block_form']['#size'] = 40;  // define size of the textfield
    $form['search_block_form']['#default_value'] = t(''); // Set a default value for the textfield
    $form['search_block_form']['#attributes']['placeholder'] = t($placeholder);
    $url  = $_SERVER['REQUEST_URI'];
    $keyword = end((explode('/', $url)));
    if($keyword){
    	$form['search_block_form']['#attributes']['value'] = t($keyword);
    }
    $form['actions']['submit']['#value'] = t('GO!'); // Change the text on the submit button
    $form['actions']['submit'] = array('#type' => 'submit');
    // Add extra attributes to the text box
    $form['search_block_form']['#attributes']['onblur'] = "if (this.value == '') {this.value = $placeholder;}";
    //$form['search_block_form']['#attributes']['onfocus'] = "if (this.value == 'Cerca') {this.value = '';}";
  }
}
function countSubMenuNumber($parentID){
	$language = (lang()=='Cambodian')?'km':'en';
	$query = db_select('menu_links', 'm');
	$query->fields('m', array('menu_name','mlid','plid','link_path','link_title'));
	$query ->condition('m.menu_name','main-menu', '=');
	$query ->condition('m.plid',$parentID,'=');
	$query ->condition('m.language',"$language",'=');
	$result = $query->execute()->rowCount();
	return $result;
}

?>

