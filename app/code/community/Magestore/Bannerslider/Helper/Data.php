<?php

class Magestore_Bannerslider_Helper_Data extends Mage_Core_Helper_Abstract
{
	const DISP_ANYWHERE = '0';
	const DISP_HOME_PAGE = '1';
	const DISP_CATEGORY = '2';
	const DISP_PRODUCT_PAGE = '3';
	
	public function getDisplayOption(){
		return array(
			array('value'=>self::DISP_ANYWHERE, 'label'=>$this->__('Anywhere')),
			array('value'=>self::DISP_HOME_PAGE, 'label'=>$this->__('Home page')),
			array('value'=>self::DISP_CATEGORY, 'label'=>$this->__('Category')),
			array('value'=>self::DISP_PRODUCT_PAGE, 'label'=>$this->__('Product Page')),
		);
	}
}
