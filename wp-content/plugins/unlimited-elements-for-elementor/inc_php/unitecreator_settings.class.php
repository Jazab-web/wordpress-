<?php
/**
 * @package Unlimited Elements
 * @author UniteCMS.net
 * @copyright (C) 2017 Unite CMS, All Rights Reserved. 
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * */
defined('UNLIMITED_ELEMENTS_INC') or die('Restricted access');

class UniteCreatorSettingsWork extends UniteSettingsAdvancedUC{
	
	const TYPE_FONT_PANEL = "fonts_panel";
	const TYPE_ITEMS = "items";
	const INSTAGRAM_DEFAULT_VALUE = "@gianlucavacchi";
	
	
	//additional attributes that allowed to add to regular settings from params
	
	protected $arrAddAttributes = array(		
		"simple_mode",
		"all_cats_mode",
		"add_current_posts"
	);
	
	private $currentAddon;

	
	private function a___________GETTERS_________(){}
	
		
	/**
	 * get settings in creator format
	 * the type should be given as "origtype" attribute
	 */
	public function getSettingsCreatorFormat(){
		
		$arrParams = array();
		foreach($this->arrSettings as $setting){
			
			$settingName = UniteFunctionsUC::getVal($setting, "name");
			
			$param = array();
			$origType = UniteFunctionsUC::getVal($setting, "origtype");
			UniteFunctionsUC::validateNotEmpty($origType, "settings original type for: $settingName");
			
			$param["type"] = $origType;
			$param["title"] = UniteFunctionsUC::getVal($setting, "text");
			$param["name"] = UniteFunctionsUC::getVal($setting, "name");
			$param["description"] = UniteFunctionsUC::getVal($setting, "description");
			$param["default_value"] = UniteFunctionsUC::getVal($setting, "default_value");
			$param["placeholder"] = UniteFunctionsUC::getVal($setting, "placeholder");
			
			
			$classAdd = UniteFunctionsUC::getVal($setting, UniteSettingsUC::PARAM_CLASSADD);
			if(!empty($classAdd))
				$param[UniteSettingsUC::PARAM_CLASSADD] = $classAdd;
			
			$addParams = UniteFunctionsUC::getVal($setting, UniteSettingsUC::PARAM_ADDPARAMS);
			if(!empty($addParams))
				$param[UniteSettingsUC::PARAM_ADDPARAMS] = $addParams;
			
			$isMultiple = UniteFunctionsUC::getVal($setting, "is_multiple");	//for dropdown
			if(!empty($isMultiple))
				$param["is_multiple"] = true;

			$elementorCondition = UniteFunctionsUC::getVal($setting, "elementor_condition");	//for dropdown
			if(!empty($elementorCondition))
				$param["elementor_condition"] = $elementorCondition;
			
			$disabled = UniteFunctionsUC::getVal($setting, "disabled");
			if(!empty($disabled))
				$param["disabled"] = $disabled;
			
			$items = UniteFunctionsUC::getVal($setting, "items");
			if(!empty($items))
				$param["options"] = $items;
			
			$arrParams[] = $param;
		}
		
		return($arrParams);
	}
	
	/**
	 * get setting as creator params, for mapping, used in visual composer
	 * not metter the type
	 */
	public function getSettingsAsCreatorParams(){
		
		$arrParams = array();
		
		foreach($this->arrSettings as $setting){
			
			$param = array();
			
			$param["type"] = "uc_textfield";	//no metter what type, will be parsed anyway
			$param["name"] = UniteFunctionsUC::getVal($setting, "name");
			$param["title"] = UniteFunctionsUC::getVal($setting, "text");
			$param["description"] = UniteFunctionsUC::getVal($setting, "description");
			
			$param["uc_setting"] = $setting;
			
			$arrParams[] = $param;
		}
		
		
		return($arrParams);
	}
	
	/**
	* get multiple params creator format from one param
	 */
	public function getMultipleCreatorParams($param){
		
		if(!empty($this->arrSettings))
			UniteFunctionsUC::throwError("the settings should be empty for this operation");
		
		$this->addByCreatorParam($param);
    	    	
		$arrParams = $this->getSettingsCreatorFormat();
		
		return($arrParams);
	}
	
	
	/**
	 * get settings types array
	 */
	public function getArrUCSettingTypes(){
		
		$arrTypes = array(
			"uc_textfield",
			UniteCreatorDialogParam::PARAM_NUMBER,
			"uc_textarea",
			"uc_editor",
			"uc_radioboolean",
			"uc_checkbox",
			"uc_dropdown",
			"uc_colorpicker",
			"uc_image",
			"uc_mp3",
			"uc_icon",
			UniteCreatorDialogParam::PARAM_ICON_LIBRARY,
			UniteCreatorDialogParam::PARAM_SHAPE,
			"uc_hr",
			"uc_font_override",
			UniteCreatorDialogParam::PARAM_POST,
			UniteCreatorDialogParam::PARAM_POSTS_LIST,
			"uc_statictext",
			UniteCreatorDialogParam::PARAM_MENU,
			UniteCreatorDialogParam::PARAM_FORM
		);
		
		return($arrTypes);
	}
		
	
	
	private function a________SETTINGS_TYPES_________(){}
	
	/**
	 * add base url for image settings if needed
	 */
	public function addImage($name,$defaultValue = "",$text = "",$arrParams = array()){
						
		parent::addImage($name, $defaultValue, $text, $arrParams);
		
		//check the source param
		$lastIndex = count($this->arrSettings)-1;
		$this->arrSettings[$lastIndex] = $this->checkParamsSource($this->arrSettings[$lastIndex]);
				
	}
	
	
	/**
	 * add base url for image settings if needed
	 */
	public function addMp3($name,$defaultValue = "",$text = "",$arrParams = array()){
		
		parent::addMp3($name, $defaultValue, $text, $arrParams);
		
		//check the source param
		$lastIndex = count($this->arrSettings)-1;
		$this->arrSettings[$lastIndex] = $this->checkParamsSource($this->arrSettings[$lastIndex]);
		
	}
	
	/**
	 * add settings provider types
	 */
	protected function addSettingsProvider($type, $name,$value,$title,$extra ){
		
		dmp("function for override: addSettingsProvider ");
		exit();

	}
	
	/**
	 * add post terms settings
	 */
	protected function addPostTermsPicker($name,$value,$title,$extra){
		
		dmp("addPostsListPicker - function for override");
		exit();
	}

	
	/**
	 * add post terms settings
	 */
	protected function addWooCatsPicker($name,$value,$title,$extra){
		
		dmp("addWooCatsPicker - function for override");
		exit();
	}
	
	
	/**
	 * add users picker
	 */
	protected function addUsersPicker($name,$value,$title,$extra){
		
		dmp("addUsersPicker - function for override");
		exit();
	}
	
	/**
	 * add post list picker
	 */
	protected function addPostsListPicker($name,$value,$title,$extra){
		dmp("addPostsListPicker - function for override");
		exit();
	}
	
	
	/**
	 * add background settings
	 */
	protected function addBackgroundSettings($name,$value,$title,$param){
		
		
		
		dmp("addBackgroundSettings - function for override");
		exit();
	}
	
	
	/**
	 * add menu picker
	 */
	protected function addMenuPicker($name,$value,$title,$extra){
		
		dmp("addMenuPicker - function for override");
		exit();
	}
	
	
	/**
	 * add form settings
	 */
	protected function addFormSettings($name, $value, $title, $extra){
		
		$objForm = new UniteCreatorForm();
		$objForm->addFormSettings($this, $name,$value, $title, $extra);
		
	}
	
	
	/**
	 * add instagram selector
	 */
	protected function addInstagramSelector($name,$value,$title,$extra){
		
		$objServies = new UniteServicesUC();
		$objServies->includeInstagramAPI();
		
		$accessData = HelperInstaUC::getInstagramSavedAccessData();
		$accessToken = UniteFunctionsUC::getVal($accessData, "access_token");
		$username = UniteFunctionsUC::getVal($accessData, "username");
		
		if(!empty($accessToken)){
			
			$params = array();
			$params["origtype"] = UniteCreatorDialogParam::PARAM_STATIC_TEXT;
			
			$text = __("Get data from instagram user: ", "unlimited_elements");
			
			$this->addStaticText($text. $username, $name, $params);
			
		}else{

			$params = array();
			$params["origtype"] = UniteCreatorDialogParam::PARAM_STATIC_TEXT;
			
			$linkSettings = HelperUC::getViewUrl(GlobalsUnlimitedElements::VIEW_SETTINGS_ELEMENTOR);
			$htmlLink = HelperHtmlUC::getHtmlLink($linkSettings, __("General Settings","unlimited_elements"),"","",true);
			
			/*
			$text = __("Please connect to your instagram account from ", "unlimited_elements");
			$text .= $htmlLink;
			
			$this->addStaticText($text, $name, $params);
			*/
			
			$description = esc_html__("Type instagram user (@username). This method is deprecated. Please connect with your instagram user from general settings", "unlimited_elements");
			$params = array("description"=>$description);
			
			if(empty($value))
				$value = self::INSTAGRAM_DEFAULT_VALUE;
			
			$params["origtype"] = UniteCreatorDialogParam::PARAM_TEXTFIELD;
			
			$this->addTextBox($name, $value ,esc_html__("Instagram User", "unlimited_elements"), $params);
			
		}
					
	}
	
	
	/**
	 * add font panel setting
	 */
	public function addFontPanel($arrParamNames, $arrFontsData, $name = null, $options = array()){
		
		$value = "";
		$arrParams = array();
		$arrParams["font_param_names"] = $arrParamNames;
		if(!empty($options))
			$arrParams = array_merge($arrParams, $options);
		
		if(empty($name))
			$name = "uc_fonts_panel";
		
			
		$this->add($name, $arrFontsData, self::PARAM_NOTEXT, self::TYPE_FONT_PANEL, $arrParams);
	}
	
	
	/**
	 * add repeater items panel
	 */
	public function addItemsPanelRepeater($addon, $source){
		
		$itemsType = $addon->getItemsType();
		
		if($itemsType == UniteCreatorAddon::ITEMS_TYPE_IMAGE){
			$this->addItemsPanel($addon, $source);
			return(false);
		}
		
		$arrDefaults = $addon->getArrItemsForConfig();
		
		$objSettings = $addon->getSettingsItemsObject();
		
		$text = self::PARAM_NOTEXT;
		
		$this->addRepeater("uc_items_editor", $objSettings, $arrDefaults, $text);
		
	}
	
	
	/**
	 * add items setting
	 */
	public function addItemsPanel($addon, $source = null){
		
		$value = "";
		$arrParams = array();
		
		if(!empty($source))
			$arrParams["source"] = $source;
		
		$objManager = new UniteCreatorManagerInline();
		$objManager->setStartAddon($addon);
		
		$arrParams["items_manager"] = $objManager;
		$this->add("uc_items_editor", "", self::PARAM_NOTEXT, self::TYPE_ITEMS, $arrParams);
	}
	
	/**
	 * add typography setting
	 */
	public function addTypographySetting($name, $value, $title, $extra){
		
		$this->add($name,$value,$title,self::TYPE_TYPOGRAPHY,$extra);
		
	}
	
	
	/**
	 * add dimentions setting
	 */
	public function addDimentionsSetting($name, $value, $title, $extra){
		
		$this->add($name,$value,$title,self::TYPE_DIMENTIONS,$extra);
		
	}
	
	
	private function a__________SETTERS_________(){}
	
	/**
	 * set current addon
	 */
	public function setCurrentAddon(UniteCreatorAddon $addon){
		
		$this->currentAddon = $addon;
		
	}
	
	/**
	 * if the source == "addon" add url base
	 */
	private function checkParamsSource($arrParams){
		
		$source = UniteFunctionsUC::getVal($arrParams, "source");
		
		if($source == "addon"){
			
			if(empty($this->currentAddon))
				UniteFunctionsUC::throwError("You must set current addon before init settings for addon related image select option");
			
			$urlAssets = $this->currentAddon->getUrlAssets();
			
			$arrParams["url_base"] = $urlAssets;
		}
		
		return($arrParams);
	}
	
	
	
	/**
	 * if in this type exists multiple settings
	 */
	public static function isMultipleUCSettingType($type){
		
		switch($type){
			case UniteCreatorDialogParam::PARAM_POSTS_LIST:
			case UniteCreatorDialogParam::PARAM_CONTENT:
			case UniteCreatorDialogParam::PARAM_INSTAGRAM:
			case UniteCreatorDialogParam::PARAM_POST_TERMS:
			case UniteCreatorDialogParam::PARAM_WOO_CATS:
			case UniteCreatorDialogParam::PARAM_USERS:
				
				return(true);
			break;
		}
		
		return(false);
	}
	
	
	/**
	 * add image base settings
	 */
	public function addImageBaseSettings(){
		
		$extra = array("origtype"=>"uc_image");
		$this->addImage("image","","Image",$extra);
		
		$extra = array("origtype"=>"uc_textarea");
		$this->addTextArea("description", "", esc_html__("Description", "unlimited_elements"),$extra);
		
		/*
		$extra = array("origtype"=>"uc_radioboolean");
		$this->addRadioBoolean("enable_link", esc_html__("Enable Link", "unlimited_elements"),false, "Yes","No",$extra);
			
		$extra = array("class"=>"unite-input-link", "origtype"=>"uc_textfield");
		$this->addTextBox("link", "", esc_html__("Link", "unlimited_elements"),$extra);
		*/
		
	}

	/**
	 * add text that the setting will be visible in elementor
	 */
	private function addVisibleInElementorOnlySetting($settingName){
		
		$this->addStaticText("$settingName setting will be visible in elementor");
		
	}
	
	/**
	 * add setting by creator param
	 */
	public function addByCreatorParam($param, $inputValue = null){
		
		
		//add ready setting if exists
		$arrReadySetting = UniteFunctionsUC::getVal($param, "uc_setting"); 
		if(!empty($arrReadySetting)){
			
			$classAdd = UniteFunctionsUC::getVal($arrReadySetting, UniteSettingsUC::PARAM_CLASSADD);
			
			$arrReadySetting[UniteSettingsUC::PARAM_CLASSADD] = $classAdd;
			
			// if($inputValue !== null) - vc hack - fields should not be empty
			
			if(!empty($inputValue))	
				$arrReadySetting["value"] = $inputValue;
			
			$this->addSettingByArray($arrReadySetting);
			
			return(false);
		}
		
		$type = UniteFunctionsUC::getVal($param, "type");
		$title = UniteFunctionsUC::getVal($param, "title");
		$name = UniteFunctionsUC::getVal($param, "name");
		$description = UniteFunctionsUC::getVal($param, "description");
		
		$defaultValue = UniteFunctionsUC::getVal($param, "default_value");
		$value = UniteFunctionsUC::getVal($param, "value", $defaultValue);
		
		$unit = UniteFunctionsUC::getVal($param, "unit");
		if($unit == "other")
			$unit = UniteFunctionsUC::getVal($param, "unit_custom");
		
		$extra = array();
		if(!empty($description))
			$extra["description"] = $description;
		
		if(!empty($unit))
			$extra["unit"] = $unit;
		
		$extra["origtype"] = $type;
		
		foreach($this->arrAddAttributes as $attributeName){
			
			$attributeValue = UniteFunctionsUC::getVal($param, $attributeName);
			if(!empty($attributeValue))
				$extra[$attributeName] = $attributeValue;
		}
				
		
		$isUpdateValue = true;
		
		$isMultipleSettingType = self::isMultipleUCSettingType($type);
		if($isMultipleSettingType && !empty($inputValue)){
			$value = $inputValue;
			$isUpdateValue = false;
		}
		
		
		switch ($type){
			case "uc_editor":
				$this->addEditor($name, $value, $title, $extra);
			break;
			case "uc_textfield":
				$this->addTextBox($name, $value, $title, $extra);
			break;
			case UniteCreatorDialogParam::PARAM_LINK:
				
				$this->addTextBox($name, $value, $title, $extra);
			break;
			case UniteCreatorDialogParam::PARAM_NUMBER:
				
				$extra["class"] = UniteCreatorSettingsOutput::INPUT_CLASS_NUMBER;
				$this->addTextBox($name, $value, $title, $extra);
				
				$isResponsive = UniteFunctionsUC::getVal($param, "is_responsive");
				$isResponsive = UniteFunctionsUC::strToBool($isResponsive);
				
				if($isResponsive == true){
					
					$valueTablet = UniteFunctionsUC::getVal($param, "default_value_tablet");
					$valueMobile = UniteFunctionsUC::getVal($param, "default_value_mobile");
					
					$this->addTextBox($name."_tablet", $valueTablet, $title." - Tablet", $extra);
					$this->addTextBox($name."_mobile", $valueMobile, $title." - Mobile", $extra);
					
				}
				
			break;
			case "uc_radioboolean":
				$arrItems = array();
				$arrItems[$param["true_name"]] = $param["true_value"];
				$arrItems[$param["false_name"]] = $param["false_value"];
				$extra["special_design"] = true;
				
				$this->addRadio($name, $arrItems, $title, $value, $extra);
			break;
			case "uc_textarea":
				$this->addTextArea($name, $value, $title, $extra);
			break;
			case "uc_checkbox":
				$textNear = UniteFunctionsUC::getVal($param, "text_near");
				$isChecked = UniteFunctionsUC::getVal($param, "is_checked");
				$isChecked = UniteFunctionsUC::strToBool($isChecked);
		
				$this->addCheckbox($name, $isChecked, $title, $textNear, $extra);
			break;
			case "uc_dropdown":
				$options = UniteFunctionsUC::getVal($param, "options");
				
				$this->addSelect($name, $options, $title, $value, $extra);
			break;
			case "uc_colorpicker":
				$this->addColorPicker($name, $value, $title, $extra);
			break;
			case UniteCreatorDialogParam::PARAM_ADDONPICKER:
								
				$extra["addontype"] = UniteFunctionsUC::getVal($param, "addon_type");
				
				$this->addAddonPicker($name, $value, $title, $extra);
			break;
			case "uc_image":
				$this->addImage($name,$value,$title,$extra);
			break;
			case "uc_mp3":
				$this->addMp3($name,$value,$title,$extra);
			break;
			case "uc_imagebase":
				$this->addImageBaseSettings();
			break;
			case "uc_statictext":
				$this->addStaticText($title, $name, $extra);
				$isUpdateValue = false;
			break;
			case UniteCreatorDialogParam::PARAM_ICON:
				$this->addIconPicker($name,$value,$title,$extra);
			break;
			case UniteCreatorDialogParam::PARAM_ICON_LIBRARY:
				$this->addIconPicker($name,$value,$title,$extra);
			break;
			case UniteCreatorDialogParam::PARAM_SHAPE:
				$this->addShapePicker($name,$value,$title,$extra);
			break;
			case UniteCreatorDialogParam::PARAM_MAP:
				$this->addGoogleMap($name,$value,$title,$extra);
			break;
			case "uc_hr":
				$this->addHr($name);
				$isUpdateValue = false;
			break;
			case "uc_font_override":
				//don't draw anything
			break;
			case UniteCreatorDialogParam::PARAM_INSTAGRAM:
				$this->addInstagramSelector($name, $value, $title, $extra);
			break;
			case UniteCreatorDialogParam::PARAM_POST:
				$this->addPostPicker($name,$value,$title,$extra);
			break;
			case UniteCreatorDialogParam::PARAM_POSTS_LIST:
				$this->addPostsListPicker($name,$value,$title,$extra);
			break;
			case UniteCreatorDialogParam::PARAM_POST_TERMS:
				$this->addPostTermsPicker($name,$value,$title,$extra);
			break;
			case UniteCreatorDialogParam::PARAM_WOO_CATS:
				$this->addWooCatsPicker($name,$value,$title,$extra);
			break;			
			case UniteCreatorDialogParam::PARAM_USERS:
				$this->addUsersPicker($name,$value,$title,$extra);
			break;
			case UniteCreatorDialogParam::PARAM_DATASET:
				
				//don't add any settings
			break;
			case UniteCreatorDialogParam::PARAM_CONTENT;
				$this->addContentSelector($name,$value,$title,$extra);
			break;
			case UniteCreatorDialogParam::PARAM_MENU:
				$this->addMenuPicker($name,$value,$title,$extra);
			break;
			case UniteCreatorDialogParam::PARAM_FORM:
				$this->addFormSettings($name,$value,$title,$extra);
			break;
			case UniteCreatorDialogParam::PARAM_TYPOGRAPHY:
				$this->addTypographySetting($name, $value, $title, $extra);
			break;
			case UniteCreatorDialogParam::PARAM_PADDING:
			case UniteCreatorDialogParam::PARAM_MARGINS:
				
				$prefix = "desktop_";
				
				$addValue = array();
				$addValue["top"] = UniteFunctionsUC::getVal($param, "{$prefix}top");
				$addValue["bottom"] = UniteFunctionsUC::getVal($param, "{$prefix}bottom");
				$addValue["left"] = UniteFunctionsUC::getVal($param, "{$prefix}left");
				$addValue["right"] = UniteFunctionsUC::getVal($param, "{$prefix}right");
				$addValue["units"] = UniteFunctionsUC::getVal($param, "units");
				
				$isResponsive = UniteFunctionsUC::getVal($param, "is_responsive");
				$isResponsive = UniteFunctionsUC::strToBool($isResponsive);
				
				if($isResponsive == true){
					
					$addValue["is_responsive"] = true;
					
					$prefix = "tablet_";
					
					$addValue[$prefix."top"] = UniteFunctionsUC::getVal($param, "{$prefix}top");
					$addValue[$prefix."bottom"] = UniteFunctionsUC::getVal($param, "{$prefix}bottom");
					$addValue[$prefix."left"] = UniteFunctionsUC::getVal($param, "{$prefix}left");
					$addValue[$prefix."right"] = UniteFunctionsUC::getVal($param, "{$prefix}right");
					$addValue[$prefix."units"] = UniteFunctionsUC::getVal($param, "units");
					
					$prefix = "mobile_";
					$addValue[$prefix."top"] = UniteFunctionsUC::getVal($param, "{$prefix}top");
					$addValue[$prefix."bottom"] = UniteFunctionsUC::getVal($param, "{$prefix}bottom");
					$addValue[$prefix."left"] = UniteFunctionsUC::getVal($param, "{$prefix}left");
					$addValue[$prefix."right"] = UniteFunctionsUC::getVal($param, "{$prefix}right");
					$addValue[$prefix."units"] = UniteFunctionsUC::getVal($param, "units");
				}
				
				$this->addDimentionsSetting($name, $addValue, $title, $extra);
				
			break;
			case UniteCreatorDialogParam::PARAM_SLIDER:
				
				$extra["min"] = UniteFunctionsUC::getVal($param, "min");
				$extra["max"] = UniteFunctionsUC::getVal($param, "max");
				$extra["step"] = UniteFunctionsUC::getVal($param, "step");
				$extra["unit"] = UniteFunctionsUC::getVal($param, "units");
				
				$this->addRangeSlider($name, $value, $title, $extra);

				$isResponsive = UniteFunctionsUC::getVal($param, "is_responsive");
				$isResponsive = UniteFunctionsUC::strToBool($isResponsive);
				if($isResponsive == true){
					
					$valueTablet = UniteFunctionsUC::getVal($param, "default_value_tablet");
					$valueMobile = UniteFunctionsUC::getVal($param, "default_value_mobile");
										
					$this->addRangeSlider($name."_tablet", $valueTablet, $title." - Tablet", $extra);
					$this->addRangeSlider($name."_mobile", $valueMobile, $title." - Mobile", $extra);
				}
				
			break;
			case UniteCreatorDialogParam::PARAM_BACKGROUND:
				
				$this->addBackgroundSettings($name,$value,$title,$param);
				
			break;
			case UniteCreatorDialogParam::PARAM_BORDER:
				
				$this->addVisibleInElementorOnlySetting("Border");
				
			break;
			case UniteCreatorDialogParam::PARAM_TEXTSHADOW:
				
				$this->addVisibleInElementorOnlySetting("Text Shadow");
				
			break;
			case UniteCreatorDialogParam::PARAM_BOXSHADOW:
				
				$this->addVisibleInElementorOnlySetting("Box Shadow");
				
			break;
			case UniteCreatorDialogParam::PARAM_DATETIME:
				
				$extra["placeholder"] = "YYYY-mm-dd HH:ii";
				
				$this->addTextBox($name, $value, $title, $extra);
								
			break;
			default:
				
				$isAdded = $this->addSettingsProvider($type,$name,$value,$title,$extra);
				if($isAdded == false)
					UniteFunctionsUC::throwError("initByCreatorParams error: Wrong setting type: $type");
				
			break;
		}

		
		//set setting value
		if($inputValue !== null && $isUpdateValue == true){
			
			$this->updateSettingValue($name, $inputValue);
		}
		
	}
	
	/**
	 * modify external loaded settings
	 */
	public function modifyLoadedSettings($loadParam){
				
		if($loadParam != "layout_row"){
			parent::modifyLoadedSettings($loadParam);
			return(false);
		}
		
		$arrChange = array(
			"padding_top"=>"row_padding_top",
			"padding_bottom"=>"row_padding_bottom",
			"padding_left"=>"row_padding_left",
			"padding_right"=>"row_padding_right",
			
			"margin_top"=>"row_margin_top",
			"margin_bottom"=>"row_margin_bottom",
			"margin_left"=>"row_margin_left",
			"margin_right"=>"row_margin_right"
		);
		
		
		foreach($arrChange as $oldName=>$newName)
			$this->changeSettingName($oldName, $newName);
		
	}
	
	/**
	 * modify by categories of the addons or layouts
	 */
	protected function modifyBeforeAdd_categories($setting, $addonType, $addNew = false){
		
		$objCategories = new UniteCreatorCategories();
		$arrCats = $objCategories->getCatsShort("", $addonType);
		
		if($addNew == true)
			$arrCats["new"] = "[". esc_html__("New Category", "unlimited_elements")."]";
		
		$fistValue = UniteFunctionsUC::getFirstNotEmptyKey($arrCats);
		
		$arrCats = array_flip($arrCats);
		
		$setting["items"] = $arrCats;
		
		$setting["value"] = $fistValue;
		$setting["default_value"] = $fistValue;
		
		return($setting);
	}
	
	
	/**
	 * modify setting before add (any setting)
	 */
	protected function modifyBeforeAdd($setting, $modifyType){
		
		switch($modifyType){
			case "choose_background":

				if($this->settingsType != "row_bg")
					unset($setting["items"]["More"]);
				
			break;
			case "library_sections_categories":
				
				$setting = $this->modifyBeforeAdd_categories($setting, GlobalsUC::ADDON_TYPE_LAYOUT_SECTION, true);
				
			break;
		}
				
		return($setting);
	}
	
	
	
	
	/**
	 * add settings by creator params
	 */
	public function initByCreatorParams($arrParams){
		
		foreach($arrParams as $param){
			$this->addByCreatorParam($param);
		}
		
	}
	
	
}