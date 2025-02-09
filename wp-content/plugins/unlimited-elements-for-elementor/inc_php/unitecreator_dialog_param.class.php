<?php
/**
 * @package Unlimited Elements
 * @author UniteCMS.net
 * @copyright (C) 2017 Unite CMS, All Rights Reserved. 
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * */
defined('UNLIMITED_ELEMENTS_INC') or die('Restricted access');

class UniteCreatorDialogParamWork{
	
	const TYPE_MAIN = "main";
	const TYPE_ITEM_VARIABLE = "variable_item";
	const TYPE_MAIN_VARIABLE = "variable_main";
	const TYPE_FORM_ITEM = "form_item";
	
	const PARAM_EDITOR = "uc_editor";
	const PARAM_TEXTFIELD = "uc_textfield";
	const PARAM_TEXTAREA = "uc_textarea";
	const PARAM_NUMBER = "uc_number";
	const PARAM_RADIOBOOLEAN = "uc_radioboolean";
	const PARAM_DROPDOWN = "uc_dropdown";
	const PARAM_HR = "uc_hr";	
	const PARAM_CONTENT = "uc_content";	
	const PARAM_POST = "uc_post";
	const PARAM_DATASET = "uc_dataset";
	const PARAM_POSTS_LIST = "uc_posts_list";
	const PARAM_POST_TERMS = "uc_post_terms";
	const PARAM_WOO_CATS = "uc_woo_categories";
	
	const PARAM_USERS = "uc_users";
	const PARAM_INSTAGRAM = "uc_instagram";
	
	const PARAM_MENU = "uc_menu";
	const PARAM_COLORPICKER = "uc_colorpicker";
	const PARAM_LINK = "uc_link";
	const PARAM_CHECKBOX = "uc_checkbox";
	const PARAM_AUDIO = "uc_mp3";
	const PARAM_FONT_OVERRIDE = "uc_font_override";
	const PARAM_ICON = "uc_icon";
	const PARAM_ICON_LIBRARY = "uc_icon_library";
	const PARAM_SHAPE = "uc_shape";
	const PARAM_IMAGE = "uc_image";
	const PARAM_MAP = "uc_map";
	const PARAM_FORM = "uc_form";
	const PARAM_ADDONPICKER = "uc_addonpicker";
	const PARAM_TYPOGRAPHY = "uc_typography";
	const PARAM_HIDDEN = "hidden";
	const PARAM_STATIC_TEXT = "static_text";
	const PARAM_MARGINS = "uc_margins";
	const PARAM_PADDING = "uc_padding";	
	const PARAM_SLIDER = "uc_slider";
	
	const PARAM_BACKGROUND = "uc_background";
	const PARAM_BORDER = "uc_border";
	const PARAM_DATETIME = "uc_datetime";
	const PARAM_TEXTSHADOW = "uc_textshadow";
	const PARAM_BOXSHADOW = "uc_boxshadow";
	
	
	const PARAM_VAR_GET = "uc_var_get";
	
	
	protected $addon, $objSettings, $objDatasets, $addonType;
	private $type;
	private $arrContentIDs = array();
	private $arrParamsTypes = array();
	protected $arrParams = array();
	protected $arrParamsItems = array();
	protected $arrProParams = array();
	
	protected  $option_putTitle = true;
	protected  $option_putAdminLabel = true;
	protected  $option_arrTexts = array();
	protected  $option_putDecsription = true;
	protected  $option_allowFontEditCheckbox = true;
	
	
	/**
	 * get instance of this object by addon type
	 */
	public static function getInstance($addonType){
		
		switch($addonType){
			case GlobalsUC::ADDON_TYPE_BGADDON:
			case "elementor":
				$classExists = class_exists("UniteCreatorDialogParamElementor");
				if($classExists == false)
					UniteFunctionsUC::throwError("class: UniteCreatorDialogParamElementor not exists");
				
				$objDialog = new UniteCreatorDialogParamElementor();
			break;
			default:
				$objDialog = new UniteCreatorDialogParam();
			break;
		}
		
		
		return($objDialog);
	}
	
	
	/**
	 * init all params
	 */
	public function __construct(){
		
		$this->initParamTypes();
		$this->initProParams();	
	}
	
	/**
	 * modify param text, function for override
	 */
	protected function modifyParamText($paramType, $paramText){
		
		return($paramText);
	}
	
	
	/**
	 * add param to the list
	 */
	protected function addParam($paramType, $paramText){
		
		$paramText = $this->modifyParamText($paramType, $paramText);
		
		$this->arrParamsTypes[$paramType] = $paramText;
	}
	
	/**
	 * init pro params
	 */
	protected function initProParams(){
		
		$this->arrProParams = array();
		$this->arrProParams[self::PARAM_USERS] = true;
		$this->arrProParams[self::PARAM_MENU] = true;
		$this->arrProParams[self::PARAM_POST_TERMS] = true;
		$this->arrProParams[self::PARAM_WOO_CATS] = true;
		$this->arrProParams[self::PARAM_PADDING] = true;
		$this->arrProParams[self::PARAM_MARGINS] = true;
		$this->arrProParams[self::PARAM_INSTAGRAM] = true;
		$this->arrProParams[self::PARAM_POSTS_LIST] = true;
		$this->arrProParams[self::PARAM_BACKGROUND] = true;
		$this->arrProParams[self::PARAM_BORDER] = true;
		$this->arrProParams[self::PARAM_SLIDER] = true;
		
	}
	
	
	/**
	 * set the param types
	 */
	protected function initParamTypes(){
		
		$this->addParam("uc_textfield", esc_html__("Text Field", "unlimited_elements"));
		$this->addParam("uc_number", esc_html__("Number", "unlimited_elements"));
		$this->addParam("uc_radioboolean", esc_html__("Radio Boolean", "unlimited_elements"));
		$this->addParam("uc_textarea", esc_html__("Text Area", "unlimited_elements"));
		$this->addParam(self::PARAM_EDITOR, esc_html__("Editor", "unlimited_elements"));
		$this->addParam("uc_checkbox", esc_html__("Checkbox", "unlimited_elements"));
		$this->addParam("uc_dropdown", esc_html__("Dropdown", "unlimited_elements"));
		$this->addParam(self::PARAM_COLORPICKER, esc_html__("Color Picker", "unlimited_elements"));
		$this->addParam(self::PARAM_LINK, esc_html__("Link", "unlimited_elements"));
		$this->addParam(self::PARAM_IMAGE, esc_html__("Image", "unlimited_elements"));
		$this->addParam(self::PARAM_HR, esc_html__("HR Line", "unlimited_elements"));
		$this->addParam(self::PARAM_FONT_OVERRIDE, esc_html__("Font Override", "unlimited_elements"));
		$this->addParam(self::PARAM_ADDONPICKER, esc_html__("Addon Picker", "unlimited_elements"));
		
		$this->addParam(self::PARAM_AUDIO, esc_html__("Audio", "unlimited_elements"));
		$this->addParam(self::PARAM_ICON, esc_html__("Icon (deprecated)", "unlimited_elements"));
		$this->addParam(self::PARAM_ICON_LIBRARY, esc_html__("Icon Library", "unlimited_elements"));
		$this->addParam(self::PARAM_SHAPE, esc_html__("Shape", "unlimited_elements"));
		$this->addParam(self::PARAM_CONTENT, esc_html__("Content", "unlimited_elements"));
		$this->addParam(self::PARAM_POST, esc_html__("Post", "unlimited_elements"));
		$this->addParam(self::PARAM_POSTS_LIST, esc_html__("Posts List", "unlimited_elements"));
		$this->addParam(self::PARAM_POST_TERMS, esc_html__("Posts Terms", "unlimited_elements"));
		$this->addParam(self::PARAM_WOO_CATS, esc_html__("WooCommerce Categories", "unlimited_elements"));
		$this->addParam(self::PARAM_USERS, esc_html__("Users List", "unlimited_elements"));
		$this->addParam(self::PARAM_MENU, esc_html__("Menu", "unlimited_elements"));
		
		$this->addParam(self::PARAM_FORM, esc_html__("Form", "unlimited_elements"));
		$this->addParam(self::PARAM_INSTAGRAM, esc_html__("Instagram", "unlimited_elements"));
		$this->addParam(self::PARAM_MAP, esc_html__("Google Map", "unlimited_elements"));
		$this->addParam(self::PARAM_DATASET, esc_html__("Dataset", "unlimited_elements"));
		
		//variables
		$this->addParam("uc_varitem_simple", esc_html__("Simple Variable", "unlimited_elements"));
		$this->addParam("uc_var_paramrelated", esc_html__("Attribute Related", "unlimited_elements"));
		$this->addParam("uc_var_paramitemrelated", esc_html__("Item Attribute Related", "unlimited_elements"));
		$this->addParam(self::PARAM_VAR_GET, esc_html__("GET Param", "unlimited_elements"));
		$this->addParam(self::PARAM_TYPOGRAPHY, esc_html__("Typography", "unlimited_elements"));
		$this->addParam(self::PARAM_MARGINS, esc_html__("Margins", "unlimited_elements"));
		$this->addParam(self::PARAM_PADDING, esc_html__("Padding", "unlimited_elements"));
		
		$this->addParam(self::PARAM_BACKGROUND, esc_html__("Background", "unlimited_elements"));
		$this->addParam(self::PARAM_BORDER, esc_html__("Border", "unlimited_elements"));
		$this->addParam(self::PARAM_BOXSHADOW, esc_html__("Box Shadow", "unlimited_elements"));
		$this->addParam(self::PARAM_TEXTSHADOW, esc_html__("Text Shadow", "unlimited_elements"));
		$this->addParam(self::PARAM_SLIDER, esc_html__("Slider", "unlimited_elements"));
		$this->addParam(self::PARAM_DATETIME, esc_html__("Date Time", "unlimited_elements"));
		
	}
	
		
	/**
	 * validate that the dialog inited
	 */
	private function validateInited(){
		if(empty($this->type))
			UniteFunctionsUC::throwError("Empty params dialog");
	}

	/**
	 * return if some param is pro
	 */
	protected function isProParam($paramType){
		
		if(GlobalsUC::$isProVersion == true)
			return(false);
		
		if(isset($this->arrProParams[$paramType]) == true)
			return(true);
			
		return(false);
	}
	
	
	
	private function a________MAIN_PARAMS___________(){}
	
	
	/**
	 * put instagram param
	 */
	private function putInstagramParam(){
		?>
			<div class="unite-inputs-label">
				<?php esc_html_e("Max Items", "unlimited_elements")?>
			</div>
			
			<input type="text" name="max_items" class="unite-input-number" value="">
			
			<div class="unite-inputs-description">
				* <?php esc_html_e("Put number of items (1-12), or empty for all the items (12)", "unlimited_elements")?>
			</div>
			
			<br>
			
		<?php 
		
		$this->putStyleCheckbox();
	}
	
	
	/**
	 * put google map param
	 */
	private function putGoogleMapParam(){
		?>
			<div class="unite-inputs-label">
				<?php esc_html_e("Defaults for google map", "unlimited_elements")?>
			</div>
			
		<?php 
	}
	
	
	/**
	 * put form param
	 */
	private function putFormParam(){
		?>
			<div class="unite-inputs-label">
				<?php esc_html_e("Form Params Goes Here", "unlimited_elements")?>
			</div>
		<?php 
	}
	
	/**
	 * put no default value text
	 */
	protected function putNoDefaultValueText($text = "", $addStyleCheckbox = false){
		
		if(empty($text))
			esc_html_e("No default value for this attribute", "unlimited_elements");
		else
			echo esc_html($text);
			
		if($addStyleCheckbox == true)
			$this->putStyleCheckbox();
	}
	
	/**
	 * put checkbox input
	 */
	private function putCheckbox($name, $text){
		?>
			<label class="unite-inputs-label-inline-free">
					<?php echo esc_html($text)?>:
				 	<input type="checkbox" onfocus="this.blur()" name="<?php echo $name?>">
			</label>
		
		<?php 
	}
	
	/**
	 * put style checkbox
	 */
	private function putStyleCheckbox(){
		?>
				<div class='uc-dialog-param-style-checkbox-wrapper'>
					<div class="unite-inputs-sap"></div>
					<label class="unite-inputs-label-inline-free">
							<?php esc_html_e("Allow Font Edit", "unlimited_elements")?>:
						 	<input type="checkbox" onfocus="this.blur()" name="font_editable">
					</label>
					<div class="unite-dialog-description-left"><?php esc_html_e("Allow edit font for this field in font style tab. Must be put with the {{fieldname|raw}} in html", "unlimited_elements")?></div>
				</div>
		<?php 
	}
	
	/**
	 * put items available only for the form
	 */
	private function putFormItemInputs(){
		
		$id = "required_checkbox_".UniteFunctionsUC::getRandomString();
		
		?>
		
		<div class="vert_sap20"></div>
			
		<div class="unite-inputs-label">
			
			<label for="<?php echo esc_attr($id)?>">
			<?php esc_html_e("Field Required", "unlimited_elements") ?>:
			</label> 
			
			<input id="<?php echo esc_attr($id)?>" type="checkbox" name="is_required">
			
		</div>
		
		<?php 
		
	}
	
	
	/**
	 * put default value param in params dialog
	 */
	protected function putDefaultValueParam($isTextarea = false, $class="", $addStyleChekbox = false){
		
		//disable in form item mode
		$putTextareaText = true;
		
		if($this->option_allowFontEditCheckbox == false){
			$addStyleChekbox = false;
			$putTextareaText = false;
		}
				
		$strClass = "";
		if(!empty($class))
			$strClass = "class='{$class}'";
				
		?>
				<div class="unite-inputs-label">
					<?php esc_html_e("Default Value", "unlimited_elements")?>:
				</div>
				
				<?php if($isTextarea == false):?>
				
				<input type="text" name="default_value" <?php echo UniteProviderFunctionsUC::escAddParam($strClass)?> value="">
				
				<?php else: ?>
				
				<textarea name="default_value" <?php echo UniteProviderFunctionsUC::escAddParam($strClass)?>> </textarea>
				
					<?php if($putTextareaText == true):?>
					
						<br><br>
						
						* <?php esc_html_e("To allow html tags, use","unlimited_elements")?> <b>|raw</b> <?php esc_html_e("filter", "unlimited_elements") ?> <br><br>
						&nbsp;&nbsp;&nbsp; <?php esc_html_e("example","unlimited_elements")?> : {{myfield|raw}}
						
					<?php endif?>
				
				<?php endif?>
		
				<?php if($addStyleChekbox == true):
					
					$this->putStyleCheckbox();
				
				endif?>
				
				<?php 
				if($this->type == self::TYPE_FORM_ITEM)
					$this->putFormItemInputs();
				?>
		<?php 
	}
	
	
	
	/**
	 * put font override param
	 */
	private function putFontOverrideParam(){
		?>
				
				* <?php esc_html_e("Use this font override in css tab using special function","unlimited_elements")?> 
				
		<?php 
	}
	
	/**
	 * put color picker default value
	 */
	protected function putColorPickerDefault(){
		
		dmp("putColorPickerDefault: option for override");		
	}
	
	

	/**
	 * put number param field
	 */
	protected function putNumberParam(){
		
		dmp("putNumberParam: option for override");
		
	}
	
	/**
	 * put radio yes no option
	 */
	private function putRadioYesNo($name, $text = null, $defaultTrue = false, $yesText = "Yes", $noText="No", $isTextNear = false){
	
		if($defaultTrue == true){
			$trueChecked = " checked ";
			$falseChecked = "";
			$defaultValue = "true";
		}else{
			$defaultValue = "false";
			$trueChecked = "";
			$falseChecked = " checked ";
		}
		
		//make not repeated id's
		$idPrefix = "uc_param_radio_".$this->type."_".$name;
		
		$idYes = $idPrefix."_yes";
		$idNo = $idPrefix."_no";
		
		?>
			<div class='uc-radioset-wrapper' data-defaultchecked="<?php echo esc_attr($defaultValue)?>">
			
			<?php if(!empty($text)): ?>
				<span class="uc-radioset-title">
				<?php esc_html_e($text, "unlimited_elements")?>:
				</span>
			<?php endif?>
			
				<input id="<?php echo esc_attr($idYes)?>" type="radio" name="<?php echo esc_attr($name)?>" value="true" <?php echo esc_attr($trueChecked)?>>
				<label for="<?php echo esc_attr($idYes)?>"><?php _e($yesText, "unlimited_elements")?></label>
				
				<input id="<?php echo esc_attr($idNo)?>" type="radio" name="<?php echo esc_attr($name)?>" value="false" <?php echo esc_attr($falseChecked)?>>
				<label for="<?php echo esc_attr($idNo)?>"><?php _e($noText, "unlimited_elements")?></label>
				
				<?php if($isTextNear == true):?>
					<input type="text" name="text_near" class="unite-input-medium">
					<?php esc_html_e("(text near)", "unlimited_elements")?>
					
				<?php endif?>
			</div>
			
		
		<?php 
	}
	
	
	/**
	 * put radio boolean param
	 */
	private function putRadioBooleanParam(){
		?>
			<table data-inputtype="radio_boolean"  class='uc-table-dropdown-items uc-table-dropdown-full'>
				<thead>
					<tr>
						<th width="100px"><?php esc_html_e("Item Text", "unlimited_elements")?></th>
						<th width="100px"><?php esc_html_e("Item Value", "unlimited_elements")?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type="text" name="true_name" value="Yes" data-initval="Yes" class='uc-dropdown-item-name'></td>
						<td><input type="text" name="true_value" value="true" data-initval="true" class='uc-dropdown-item-value'></td>
						<td>
							<div class='uc-dropdown-icon uc-dropdown-item-default uc-selected' title="<?php esc_html_e("Default Item", "unlimited_elements")?>"></div>
						</td>
					</tr>
					<tr>
						<td><input type="text" name="false_name" value="No" data-initval="No" class='uc-dropdown-item-name'></td>
						<td><input type="text" name="false_value" value="false" data-initval="false" class='uc-dropdown-item-value'></td>
						<td>
							<div class='uc-dropdown-icon uc-dropdown-item-default' title="<?php esc_html_e("Default Item", "unlimited_elements")?>"></div>
						</td>
					</tr>
					
				</tbody>
			</table>
		<?php 
	}
	
	
	/**
	 * add checkbox section param to image param type
	 */
	private function putImageParam_addThumbSection($thumbName, $text, $addSuffix){
		$IDprefix = "uc_param_image_".$this->type."_";
		
		$checkID = $IDprefix.$thumbName;
		$inputID = $IDprefix.$thumbName."_input";
		
		?>
			<label for="<?php echo esc_attr($checkID)?>">
				<input id="<?php echo esc_attr($checkID)?>" type="checkbox" class="uc-param-image-checkbox uc-control" data-controlled-selector="#<?php echo esc_attr($inputID)?>" name="<?php echo esc_attr($thumbName)?>">
				<?php _e($text, "unlimited_elements")?>
			</label>
			<input id="<?php echo esc_attr($inputID)?>" type="text" data-addsuffix="<?php echo esc_attr($addSuffix)?>" style="display:none" disabled class="mleft_5 unite-input-alias uc-param-image-thumbname">
			
		<?php 
	}
	
	/**
	 * put image param settings
	 */
	private function putImageParam(){
		
		?>
			
			<div class="unite-inputs-sap"></div>
						
			<?php $this->putImageSelectInput("default_value",esc_html__("Default Image","unlimited_elements")); ?>
			
		<?php 
	}
	
	
	/**
	 * put single setting input
	 */
	private function putSingleSettingInput($name, $text, $type){
		
		?>			
			<div class="unite-inputs-label"><?php echo esc_html($text)?>:</div>
		<?php 
		
		$objSettings = new UniteCreatorSettings();
		$objSettings->setCurrentAddon($this->addon);
		
		switch($type){
			case "image":
				$objSettings->addImage($name, "", $text, array("source"=>"addon"));
			break;
			case "mp3":
				$objSettings->addMp3($name, "", $text, array("source"=>"addon"));
			break;
			default:
				UniteFunctionsUC::throwError("Wrong seting type: $type");
			break;
		}
		
		$objOutput = new UniteSettingsOutputWideUC();
		$objOutput->init($objSettings);
		$objOutput->drawSingleSetting($name);
		
	}
	
	
	/**
	 * put image select input
	 */
	private function putImageSelectInput($name, $text){
		
		$this->putSingleSettingInput($name, $text, "image");
	}
	
	
	/**
	 * put mp3 select input
	 */
	private function putMp3SelectInput($name, $text){
		
		$this->putSingleSettingInput($name, $text, "mp3");
		
	}

	
	/**
	 * put mp3 param
	 */
	private function putMp3Param(){
	
		$this->putMp3SelectInput("default_value",esc_html__("Default Audio File Url","unlimited_elements"));
	}
	
	/**
	 * put menu param
	 */
	protected function putMenuParam(){
		//function for override n
	}

	
	/**
	 * put menu param
	 */
	private function putDatasetParam(){
				
		$arrDatasetsNames = $this->objDatasets->getDatasetTypeNames();
		$settings = new UniteCreatorSettings();
		
		if(empty($arrDatasetsNames))
			$settings->addStaticText("No dataset types found");
		else{
			
			$firstType = UniteFunctionsUC::getFirstNotEmptyKey($arrDatasetsNames);
			$arrDatasetsNames = array_flip($arrDatasetsNames);
			
			$settings->addSelect("dataset_type", $arrDatasetsNames, esc_html__("Choose Dataset Type", "unlimited_elements"), $firstType ,array("description"=>"select the datase type"));
			
			//put queries
			$arrDatasetObjects = $this->objDatasets->getDatasetTypes();
			
			foreach($arrDatasetObjects as $type=>$dataset){
								
				$queries = UniteFunctionsUC::getVal($dataset, "queries");
				
				if(empty($queries))
					continue;
				
				$firstQuery = UniteFunctionsUC::getFirstNotEmptyKey($queries);
				$queries = array_flip($queries);
				
				$queries["---Not Selected---"] = "";
				
				$settingName = "dataset_{$type}_query";
				$settings->addSelect($settingName, $queries, esc_html__("Choose Query", "unlimited_elements"), $firstQuery ,array("description"=>"select the dataset query"));
				$settings->addControl("dataset_type", $settingName, "show", $type);
			}
			
		}
		
		
		$objOutput = new UniteSettingsOutputWideUC();
		$objOutput->init($settings);
		$objOutput->draw("dataset_param_settings", false);
	}
	
	
	/**
	 * put addonpicker addon
	 */
	private function putAddonPickerParam(){
		
		$arrTypes = UniteCreatorAddonType::getAddonTypesForAddonPicker();
		$firstType = UniteFunctionsUC::getFirstNotEmptyKey($arrTypes);
		$arrTypes = array_flip($arrTypes);
		
		$settings = new UniteCreatorSettings();

		$settings->addSelect("addon_type", $arrTypes, esc_html__("Choose Addon Type", "unlimited_elements"), $firstType ,array("description"=>"select the addon type"));
		
		$objOutput = new UniteSettingsOutputWideUC();
		$objOutput->init($settings);
		$objOutput->draw("addonpicker_param_settings", false);
				
	}
	
	
	/**
	 * put users param
	 */
	protected function putUsersParam(){
		dmp("function for override");
	}
	
	
	/**
	 * put post terms param
	 */
	private function putPostTermsParam(){
		
		esc_html_e("Post terms are post categories / tags and other custom types. Also called as taxonomies ", "unlimited_elements");
		
		?>
		<br>
		<br>
		
		<div class="vert_sap10"></div>
		
		<?php 
		$this->putCheckbox("use_custom_fields", __("Use Custom Fields", "unlimited_elements"));
		?>
		
		<br><br>
		<hr>
		
		<?php 
		
		$this->putStyleCheckbox();
	}
	
	/**
	 * put woo cats param
	 */
	private function putWooCatsParam(){
		
		$this->putPostTermsParam();
		
	}
	
	
	/**
	 * put post list param
	 */
	private function putPostListParam(){
				
		$settings = new UniteCreatorSettings();

		$params = array();
		$params["description"] = __("Choose some post for the custom fields to appear in attributes list in the right", "unlimited_elements");
		
		$settings->addPostPicker("post_example", "", __("Post Example For Custom Fields", "unlimited_elements") );
				
		$objOutput = new UniteSettingsOutputWideUC();
		$objOutput->init($settings);
		$objOutput->draw("postpicker_param_settings", false);
		
		$this->putCheckbox("use_custom_fields", __("Use Custom Fields", "unlimited_elements"));
		?>
		<div class="vert_sap10"></div>
		<?php 
		$this->putCheckbox("use_category", __("Use Post Category", "unlimited_elements"));
		
		?>
		<br><br>
		<hr>
		<?php 
		
		$this->putStyleCheckbox();
		
	}
	
	private function a___________FOR_OVERRIDE________(){}
	
	/**
	 * function for override
	 */
	protected function putDimentionsParam($type = ""){
		dmp("putDimentionsParam: function for override");
		exit();
	}
	
	/**
	 * function for override
	 */
	protected function putSliderParam(){
		dmp("putSliderParam: function for override");
		UniteFunctionsUC::showTrace();
		exit();
	}
	
	/**
	 * function for override
	 */
	protected function putBackgroundParam(){
		dmp("putBackgroundParam: function for override");
		exit();
	}
	
	/**
	 * function for override
	 */
	protected function putBorderParam(){
		dmp("putBorderParam: function for override");
		exit();
	}

	/**
	 * function for override
	 */
	protected function putDateTimeParam(){
		dmp("putDateTimeParam: function for override");
		exit();
	}
	
	/**
	 * function for override
	 */
	protected function putTextShadowParam(){
		dmp("putTextShadowParam: function for override");
		exit();
	}
	
	/**
	 * function for override
	 */
	protected function putBoxShadowParam(){
		dmp("putTextShadowParam: function for override");
		exit();
	}
	
	
	private function a___________DROPDOWN_PARAM________(){}
	
	
	/**
	 * put dropdown items table
	 */
	private function putDropdownItems(){
		?>
				<table data-inputtype="table_dropdown" class='uc-table-dropdown-items uc-table-dropdown-full'>
					<thead>
						<tr>
							<th></th>
							<th width="100px"><?php esc_html_e("Item Text", "unlimited_elements")?></th>
							<th width="100px"><?php esc_html_e("Item Value", "unlimited_elements")?></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><div class='uc-dropdown-item-handle'></div></td>
							<td><input type="text" value="" class='uc-dropdown-item-name'></td>
							<td><input type="text" value="" class='uc-dropdown-item-value'></td>
							<td>
								<div class='uc-dropdown-icon uc-dropdown-item-delete' title="<?php esc_html_e("Delete Item", "unlimited_elements")?>"></div>
								<div class='uc-dropdown-icon uc-dropdown-item-add' title="<?php esc_html_e("Add Item", "unlimited_elements")?>"></div>
								<div class='uc-dropdown-icon uc-dropdown-item-default uc-selected' title="<?php esc_html_e("Default Item", "unlimited_elements")?>"></div>
							</td>
						</tr>
					</tbody>
				</table>
		
		<?php 
	}
	
	
	/**
	 * put select related dropdown
	 */
	private function putDropdownSelectRelated($selectSelector, $valueText = null, $putText = null){
		
		$valueTextOutput = esc_html__("Attribute Value", "unlimited_elements");
		$putTextOutput = esc_html__("Html Output", "unlimited_elements");
		
		if(!empty($valueText))
			$valueTextOutput = $valueText;
		
		if(!empty($putText))
			$putTextOutput = $putText;
		
		?>
				<table data-inputtype="table_select_related" class='uc-table-dropdown-items uc-table-dropdown-simple uc-table-select-related' data-relateto="<?php echo esc_attr($selectSelector)?>">
					<thead>
						<tr>
							<th><?php echo esc_html($valueTextOutput)?></th>
							<th><?php echo esc_html($putTextOutput)?></th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
		<?php 
	}
	
	
	private function a___________VARIABLE_PARAMS_________(){}
	
	
	/**
	 * put item variable fields
	 */
	private function putVarItemSimpleFields(){
		
		$checkboxFirstID = "uc_check_first_varitem_".$this->type;
		$checkboxLastID = "uc_check_last_varitem_".$this->type;
		
		?>
			
			<div class="unite-inputs-label">
				<?php esc_html_e("Default Value", "unlimited_elements")?>:
			</div>
			
			<input type="text" name="default_value" value="" class="uc_default_value">
			
			<a class="uc-link-add" data-addto-selector=".uc_default_value" data-addtext="%numitem%" href="javascript:void(0)"><?php esc_html_e("Add Numitem", "unlimited_elements")?></a>
			
			<div class="unite-inputs-label mtop_5 mbottom_5">
				
				<input id="<?php echo esc_attr($checkboxFirstID)?>" type="checkbox" name="enable_first_item" class="uc-control" data-controlled-selector=".uc_section_first">
				
				<label for="<?php echo esc_attr($checkboxFirstID)?>">
				<?php esc_html_e("Value for First Item", "unlimited_elements")?>:
				</label>
			</div>
			
			<div class="uc_section_first" style="display:none">
				
				<input type="text" name="first_item_value" value="" class="uc_first_item_value">
				
				<a class="uc-link-add" data-addto-selector=".uc_first_item_value" data-addtext="%numitem%" href="javascript:void(0)"><?php esc_html_e("Add Numitem", "unlimited_elements")?></a>
				
			</div>
			
			<div class="unite-inputs-label mtop_5 mbottom_5">
				
				<input id="<?php echo esc_attr($checkboxLastID)?>" type="checkbox" name="enable_last_item" class="uc-control" data-controlled-selector=".uc_section_last">
				
				<label for="<?php echo esc_attr($checkboxLastID)?>">
				<?php esc_html_e("Value for Last Item", "unlimited_elements")?>:
				</label>
			</div>
			
			<div class="uc_section_last" style="display:none">
				
				<input type="text" name="last_item_value" value="" class="uc_last_item_value" >
				
				<a class="uc-link-add" data-addto-selector=".uc_last_item_value" data-addtext="%numitem%" href="javascript:void(0)"><?php esc_html_e("Add Numitem", "unlimited_elements")?></a>
							
			</div>
			
			<div class="unite-dialog-description-right">
				* <?php esc_html_e("The %numitem% is 1,2,3,4... numbers serials", "unlimited_elements")?>
			</div>
			
		<?php
	}
	
	
	/**
	 * put fields of item params related variable
	 * type: item / main
	 */
	private function putParamsRelatedFields($type = "main"){
		
		$title = esc_html__("Select Main Attribute", "unlimited_elements");
		$source = "main";
		
		if($type == "item"){
			$title = esc_html__("Select Item Attribute", "unlimited_elements");
			$source = "item";
		}
		
		?>
		
		<div class="unite-inputs-label-inline-free ptop_5" >
			<?php echo esc_html($title)?>:
		</div>
		
		<select class="uc-select-param uc_select_param_name" data-source="<?php echo esc_attr($source)?>" name="param_name"></select>
		
		<div class="unite-inputs-sap"></div>
		
		<div class="uc-dialog-param-min-height">
		
		<?php $this->putDropdownSelectRelated(".uc_select_param_name");?>
		
		</div>
		
		<?php HelperHtmlUC::putDialogControlFieldsNotice() ?>
		
		<?php
		
	}
	
	/**
	 * put GET query string params
	 */
	private function putGetParamFields(){
		
		$text = esc_html__("This parameter will go from GET query string", "unlimited_elements");
		
		?>			
			<div class="unite-inputs-label"><?php echo esc_html($text)?>:</div>
		<?php 
		
		$objSettings = new UniteCreatorSettings();
		
		$arrSanitize = UniteFunctionsUC::getArrSanitizeTypes();		
		$firstType = UniteFunctionsUC::getFirstNotEmptyKey($arrSanitize);
		$arrSanitize = array_flip($arrSanitize);
		
		$objSettings->addSelect("sanitize_type", $arrSanitize, esc_html__("Sanitize Type", "unlimited_elements"), $firstType);
		$objSettings->addTextBox("default_value", "", esc_html__("Default Value", "unlimited_elements"));
		
		$objOutput = new UniteSettingsOutputWideUC();
		$objOutput->init($objSettings);
		$objOutput->draw("get_param_settings", false);
		
	}
	
	
	private function a___________OUTPUT_________(){}
	
	
	/**
	 * put tab html
	 */
	private function putTab($paramType, $isSelected = false, $isSelect = false){
		
		$tabPrefix = "uc_tabparam_".$this->type."_";
		$contentID = $tabPrefix.$paramType;
		
		$isProParam = $this->isProParam($paramType);
				
		//check for duplicates
		if(isset($this->arrContentIDs[$paramType]))
			UniteFunctionsUC::throwError("dialog param error: duplicate tab type: $paramType");
		
		//save content id
		$this->arrContentIDs[$paramType] = $contentID;
		
		$title = UniteFunctionsUC::getVal($this->arrParamsTypes, $paramType);
		if(empty($title))
			UniteFunctionsUC::throwError("Attribute: {$paramType} is not found in param list.");
		
		$addHtml = "";
		if($isProParam == true){
			$title .= " (pro)";
			$addHtml .= " data-ispro='true'";
		}
		
		//put tab content
		$class = "uc-tab";
		$selectHtml = "";
		if($isSelected == true){
			$class = "uc-tab uc-tab-selected";
			$selectHtml .= " selected='selected' ";
		}
				
		if($this->type == self::TYPE_MAIN && isset($this->arrParamsItems[$paramType]) == false)
			$selectHtml .= " class='uc-hide-when-item'";
		
		if($isSelect == true):
		?>
			<option <?php echo UniteProviderFunctionsUC::escAddParam($selectHtml)?> data-type="<?php echo esc_attr($paramType)?>" value="<?php echo esc_attr($contentID)?>" <?php echo $addHtml?> >
				<?php _e($title, "unlimited_elements")?>
			</option>
		<?php
		else:
		?>
			<a href="javascript:void(0)" data-type="<?php echo esc_attr($paramType)?>" data-contentid="<?php echo esc_attr($contentID)?>" class="<?php echo esc_attr($class)?>" <?php echo $addHtml?>>
				<?php _e($title, "unlimited_elements")?>
			</a>
		<?php
		endif;
		
	}
	
	
	/**
	 * put param content
	 */
	protected function putParamFields($paramType){
		
		switch($paramType){
			case "uc_textfield":
				$this->putDefaultValueParam(false, "", true);
			break;
			case "uc_number":
				$this->putNumberParam();
			break;
			case "uc_radioboolean":
				$this->putRadioBooleanParam();
			break;
			case "uc_textarea":
				$this->putDefaultValueParam(true,"",true);
			break;
			case self::PARAM_EDITOR:
				$this->putDefaultValueParam(true);
			break;
			case "uc_checkbox":
				$this->putRadioYesNo("is_checked", esc_html__("Checked By Default", "unlimited_elements"), false, "Yes", "No", true);
			break;
			case "uc_dropdown":
				$this->putDropDownItems();
			break;
			case self::PARAM_LINK:
				$this->putDefaultValueParam(false, "", false);
			break;
			case self::PARAM_COLORPICKER:
				$this->putColorPickerDefault();
			break;
			case self::PARAM_IMAGE:
				$this->putImageParam();
			break;
			case "uc_mp3":
				$this->putMp3Param();
			break;
			case self::PARAM_ICON:
				$this->putDefaultValueParam();
			break;
			case self::PARAM_ICON_LIBRARY:
				$this->putIconLibraryParam();
			break;
			case self::PARAM_SHAPE:
				$this->putNoDefaultValueText();
			break;
			case self::PARAM_CONTENT:
				$this->putDefaultValueParam(true,"");
			break;
			case self::PARAM_POSTS_LIST:
				$this->putPostListParam();
			break;
			case self::PARAM_USERS:
				$this->putUsersParam();
			break;
			case self::PARAM_POST_TERMS:
				$this->putPostTermsParam();
			break;
			case self::PARAM_WOO_CATS:
				$this->putWooCatsParam();
			break;
			case self::PARAM_FORM:
				$this->putFormParam();
			break;
			case self::PARAM_INSTAGRAM:
				$this->putInstagramParam();
			break;
			case self::PARAM_MAP:
				$this->putGoogleMapParam();
			break;
			case self::PARAM_HR:
				$this->putNoDefaultValueText();
			break;
			case self::PARAM_FONT_OVERRIDE:
				$text = esc_html__("Use this font override in css tab using special function", "unlimited_elements");
				$this->putNoDefaultValueText($text);
			break;
			//variable params
			case "uc_varitem_simple":
				$this->putVarItemSimpleFields();
			break;
			case "uc_var_paramrelated":
				$this->putParamsRelatedFields("main");
			break;
			case "uc_var_paramitemrelated":
				$this->putParamsRelatedFields("item");
			break;
			case self::PARAM_MENU:
				$this->putMenuParam();
			break;
			case self::PARAM_DATASET:
				$this->putDatasetParam();
			break;
			case self::PARAM_ADDONPICKER:
				$this->putAddonPickerParam();
			break;
			case self::PARAM_MARGINS:
				$this->putDimentionsParam("margin");
			break;
			case self::PARAM_PADDING:
				$this->putDimentionsParam("padding");
			break;
			case self::PARAM_SLIDER:
				$this->putSliderParam();
			break;
			case self::PARAM_BACKGROUND:
				$this->putBackgroundParam();
			break;
			case self::PARAM_BORDER:
				$this->putBorderParam();
			break;
			case self::PARAM_DATETIME:
				$this->putDateTimeParam();
			break;
			case self::PARAM_TEXTSHADOW:
				$this->putTextShadowParam();
			break;
			case self::PARAM_BOXSHADOW:
				$this->putBoxShadowParam();
			break;
			case self::PARAM_VAR_GET:
				$this->putGetParamFields();
			break;
			default:
				UniteFunctionsUC::throwError("Wrong param type, fields not found: $paramType");
			break;
		}
		
	}
	
	
	/**
	 * get texts array
	 */
	private function getArrTexts(){
		
		$arrTexts = array();
		
		switch($this->type){
			case self::TYPE_FORM_ITEM:
				$arrTexts["add_title"] = esc_html__("Add Form Item","unlimited_elements");
				$arrTexts["add_button"] = esc_html__("Add Form Item","unlimited_elements");
				$arrTexts["edit_title"] = esc_html__("Edit Form Item","unlimited_elements");
				$arrTexts["update_button"] = esc_html__("Update Form Item","unlimited_elements");				
			break;
			default:
				$arrTexts["add_title"] = esc_html__("Add Attribute","unlimited_elements");
				$arrTexts["add_button"] = esc_html__("Add Attribute","unlimited_elements");
				$arrTexts["edit_title"] = esc_html__("Edit Attribute","unlimited_elements");
				$arrTexts["update_button"] = esc_html__("Update Attribute","unlimited_elements");				
			break;
		}
		
		$arrTexts = array_merge($arrTexts, $this->option_arrTexts);
		
		return($arrTexts);
	}
	
	
	/**
	 * put dialog tabs
	 */
	private function putTabs(){
		?>
		<div class="uc-tabs uc-tabs-paramdialog">
			<?php 
			
			$firstParam = true;
			foreach($this->arrParams as $paramType){
			
				$this->putTab($paramType, $firstParam);
				$firstParam = false;
			}
			
			?>			
		</div>
		
		<div class="unite-clear"></div>
		
		<?php 
	}
	
	/**
	 * put tabs as dropdown
	 */
	private function putTabsDropdown(){
		?>
		
		<?php esc_html_e("Attribute Type: " , "unlimited_elements")?>
		
		<select class="uc-paramdialog-select-type">
			
			<?php
				$firstParam = true;
				foreach($this->arrParams as $paramType){
					$this->putTab($paramType, $firstParam, true);
					$firstParam = false;
				}
			?>
		</select>
		<?php
		
	}
	
	
	/**
	 * output html
	 */
	public function outputHtml(){
		
		$this->validateInited();
		$type = $this->type;
		$dialogID = "uc_dialog_param_".$type;
		
		//fill texts
		$arrTexts = $this->getArrTexts();
		$dataTexts = UniteFunctionsUC::jsonEncodeForHtmlData($arrTexts);
		
		$linkDownloadPro = HelperHtmlUC::getHtmlLink(GlobalsUC::URL_DOWNLOAD_PRO, __("client panel","unlimited_elements"),"","",true);
		$linkBuyPro = HelperHtmlUC::getHtmlLink(GlobalsUC::URL_BUY, __("PRO version","unlimited_elements"),"","",true);
		
		//put items param types
		$addParams = "";
		
		?>
			
			<!-- Dialog Param: <?php echo esc_html($type)?> -->
			
			<div id="<?php echo esc_attr($dialogID)?>" class="uc-dialog-param uc-dialog-param-<?php echo esc_attr($type)?>" data-texts="<?php echo esc_attr($dataTexts)?>" <?php echo $addParams?> style="display:none">
				
				<div class="dialog-param-wrapper unite-inputs">
					
					<?php 
						$this->putTabsDropdown();
					?>
					
					<div class="uc-tabsparams-content-wrapper">
					
						<div class="dialog-param-left">
							
							<?php if($this->option_putTitle == true): ?>
							
								<div class="unite-inputs-label">
								<?php esc_html_e("Title")?>:
								</div>
								
								<input type="text" class="uc-param-title" name="title" value="">
								
								<div class="unite-inputs-sap"></div>
							
							<?php endif?>
							
							
							<div class="unite-inputs-label">
							<?php esc_html_e("Name", "unlimited_elements")?>:
							</div>
							<input type="text" class="uc-param-name" name="name" value="">
							
							<?php if($this->option_putDecsription == true):?>
							<div class="unite-inputs-sap"></div>
							
							<div class="unite-inputs-label">
							<?php esc_html_e("Description", "unlimited_elements")?>:
							</div>
							
							<textarea name="description"></textarea>
							
							<?php endif?>
							
							<?php if($this->option_putAdminLabel == true):?>
							<div class='uc-dialog-param-admin-label-wrapper'>
								<div class="unite-inputs-sap"></div>
								
								<div class="unite-inputs-label-inline-free">
										<?php esc_html_e("Admin Label", "unlimited_elements")?>:
								</div>
								<input type="checkbox" name="admin_label">
								<div class="unite-dialog-description-left"><?php esc_html_e("Show attribute content on admin side", "unlimited_elements")?></div>
							</div>
							<?php endif?>
							
							<?php if(GlobalsUC::$isProVersion == false):?>
							
							<div class='uc-dialog-param-pro-message'>
								<?php _e("This attribute is available only in the .","unlimited_elements"); 
								echo $linkBuyPro;
								?>
								<br>
								<?php _e("The PRO version (unlimited-elements-pro) is available for download in the ","unlimited_elements");?>
								<?php echo $linkDownloadPro?>
								<?php _e(" under \"downloads\" section.","unlimited_elements")?>
								 
							</div>
							<?php endif?>
							
						</div>
						
						
						<div class="dialog-param-right">
							
							<?php 
							
							$firstParam = true;
							foreach($this->arrParams as $paramType):
								
								$tabContentID = UniteFunctionsUC::getVal($this->arrContentIDs, $paramType);
								if(empty($tabContentID))
									UniteFunctionsUC::throwError("No content ID found for param: {$paramType} ");
								
								$addHTML = "";
								$addClass = "uc-content-selected";
								if($firstParam == false){
									$addHTML = " style='display:none'";
									$addClass = "";
								}
								
								$firstParam = false;
								
								//is pro param
								$isProParam = $this->isProParam($paramType);
													
								if($isProParam == true)
									$addClass .= " uc-pro-param";
								
								?>
								
								<!-- <?php echo esc_html($paramType)?> fields -->
								
								<div id="<?php echo esc_attr($tabContentID)?>" class="uc-tab-content <?php echo esc_attr($addClass)?>" <?php echo UniteProviderFunctionsUC::escAddParam($addHTML)?> >
									
									<?php 
									
										$this->putParamFields($paramType);
										
									?>
									
								</div>
								
								<?php 								
								
							endforeach;
							?>
							
							
						</div>
						
						<div class="unite-clear"></div>
					
					</div>	<!-- end uc-tabs-content-wrapper -->
					
					<div class="uc-dialog-param-error unite-color-red" style="display:none"></div>
					
				</div>
				
					
			</div>		
		
		
		<?php 
	}
	
	
	private function a______INIT______(){}
	
	
	/**
	 * init main dialog params
	 */
	public function initMainParams(){
		
		$this->arrParams = array(
			self::PARAM_TEXTFIELD,
			self::PARAM_NUMBER,
			self::PARAM_RADIOBOOLEAN,
			self::PARAM_TEXTAREA,
			self::PARAM_CHECKBOX,
			self::PARAM_DROPDOWN,
			self::PARAM_SLIDER,			
			self::PARAM_COLORPICKER,
			self::PARAM_LINK,
			self::PARAM_EDITOR,
			self::PARAM_HR,
			self::PARAM_IMAGE,
			self::PARAM_AUDIO,
			self::PARAM_ICON,
			self::PARAM_ICON_LIBRARY,
			//self::PARAM_SHAPE,
			//self::PARAM_FONT_OVERRIDE,
			self::PARAM_INSTAGRAM,
		);
		
		//add dataset
		$arrDatasets = $this->objDatasets->getDatasetTypeNames();
		if(!empty($arrDatasets))
			$this->arrParams[] = self::PARAM_DATASET;
		
	}
	
	/**
	 * init item params inside repeater
	 */
	public function initItemParams(){
		
		$this->arrParamsItems = array(
			self::PARAM_TEXTFIELD,
			self::PARAM_NUMBER,
			self::PARAM_RADIOBOOLEAN,
			self::PARAM_TEXTAREA,
			self::PARAM_CHECKBOX,
			self::PARAM_DROPDOWN,
			self::PARAM_COLORPICKER,
			self::PARAM_SLIDER,
			self::PARAM_LINK,
			self::PARAM_EDITOR,
			self::PARAM_HR,
			self::PARAM_IMAGE,
			self::PARAM_AUDIO,
			self::PARAM_ICON,
			self::PARAM_ICON_LIBRARY,
			self::PARAM_MARGINS,
			self::PARAM_PADDING
		);
		
		$this->arrParamsItems = UniteFunctionsUC::arrayToAssoc($this->arrParamsItems);
				
	}
	
	/**
	 * init common variable dialogs
	 */
	private function initVariableCommon(){
		
		$this->option_putAdminLabel = false;
		$this->option_putTitle = false;
		$this->option_arrTexts["add_title"] = esc_html__("Add Item Variable","unlimited_elements");
		$this->option_arrTexts["add_button"] = esc_html__("Add Variable","unlimited_elements");
		$this->option_arrTexts["update_button"] = esc_html__("Update Variable","unlimited_elements");
		$this->option_arrTexts["edit_title"] = esc_html__("Edit Variable","unlimited_elements");
		
	}
		
	
	/**
	 * init variable params
	 */
	private function initVariableMainParams(){
	
		$this->initVariableCommon();
		
		$this->arrParams = array(
				"uc_var_paramrelated",
				self::PARAM_VAR_GET
		);
	
	}
	
	
	/**
	 * init variable item params
	 */
	private function initVariableItemParams(){
	
		$this->initVariableCommon();
		
		$this->arrParams = array(
				"uc_varitem_simple",
				"uc_var_paramrelated",
				"uc_var_paramitemrelated"
		);
		
	}
	
	
	/**
	 * init form item params
	 */
	private function initFormItemParams(){
		
		$objForm = new UniteCreatorForm();
		$this->arrParams = $objForm->getDialogFormParams();
		
		$this->option_putDecsription = false;
		$this->option_allowFontEditCheckbox = false;
	}
	
	/**
	 * init by addon type
	 * function for override
	 */
	protected function initByAddonType($addonType){
	}
	
	
	/**
	 * init the params dialog
	 */
	public function init($type, $addon){
		
		$this->type = $type;
				
		if(empty($addon))
			UniteFunctionsUC::throwError("you must pass addon");
		
		$this->addon = $addon;
		$this->addonType = $addon->getType();
		
		$this->initByAddonType($this->addonType);
		
		$this->objSettings = new UniteCreatorSettings();
		$this->objDatasets = new UniteCreatorDataset();
		
		switch($this->type){
			case self::TYPE_MAIN:
				$this->initMainParams();
				$this->initItemParams(); 
			break;
			case self::TYPE_ITEM_VARIABLE:
				$this->initVariableItemParams();
			break;
			case self::TYPE_MAIN_VARIABLE:
				$this->initVariableMainParams();
			break;
			case self::TYPE_FORM_ITEM:
				$this->initFormItemParams();
			break;
			default:
				UniteFunctionsUC::throwError("Wrong param dialog type: $type");
			break;
		}
		
	}
	
	
	
}
