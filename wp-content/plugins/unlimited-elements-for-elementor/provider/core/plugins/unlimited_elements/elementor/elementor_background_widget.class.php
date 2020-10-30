<?php

defined('UNLIMITED_ELEMENTS_INC') or die('Restricted access');

class UniteCreatorElementorBackgroundWidget extends UniteCreatorElementorWidget {
	
	
    /**
     * set the addon
     */
    public function __construct($data = array(), $args = null){
    	//skip constructor
    }
    
    /**
     * set the addon
     */
    public function initBGWidget($objAddon, $objControls){
    	
    	$this->isBGWidget = true;
    	
    	$this->objAddon = $objAddon;
    	$this->objControls = $objControls;
    }
    
    /**
     * modify background widget params
     */
    protected function modifyBGWidgetParams($params){
    	
    	$alias = $this->objAddon->getAlias();
    	
    	$condition = array(UniteCreatorElementorIntegrate::CONTROL_BACKGROUND_TYPE=>$alias);
    	
    	foreach($params as $key=>$param){
    		
    		$name = UniteFunctionsUC::getVal($param, "name");
    		if(empty($name))
    			continue;
    		    		
    		$param["name"] = $alias."_".$name;
    		$param["elementor_condition"] = $condition;
    		
    		$params[$key] = $param;
    	}

    	
    	return($params);
    }
    
    
    /**
     * register background controls
     */
    public function registerBGControls(){

    	 if(empty($this->objAddon))
    	 	return(false);
    	
    	 $isItemsEnabled = $this->objAddon->isHasItems();
    	 $itemsType = $this->objAddon->getItemsType();
    	     	 
         $params = $this->objAddon->getProcessedMainParams();
    	 
         if(empty($params))
         	return(false);
         
         $params = $this->modifyBGWidgetParams($params);
         
	     $params = $this->addDynamicAttributes($params);          	
         
         //if($isGeneralSection == true && $isItemsEnabled == true && $itemsType == "image")
          	//$this->addGalleryControlUC();
	     
          foreach($params as $param){
          		
          		$type = UniteFunctionsUC::getVal($param, "type");
          		
          		if($type == UniteCreatorDialogParam::PARAM_POSTS_LIST){
          			continue;
          		}
          		
          		$this->addElementorParamUC($param);
          }
          
    }
    
    
}