<?php

class Magestore_Bannerslider_Block_Adminhtml_Bannerslider_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'bannerslider';
        $this->_controller = 'adminhtml_bannerslider';
        
        $this->_updateButton('save', 'label', Mage::helper('bannerslider')->__('Save Banner'));
        $this->_updateButton('delete', 'label', Mage::helper('bannerslider')->__('Delete Banner'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('bannerslider_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'bannerslider_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'bannerslider_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('bannerslider_data') && Mage::registry('bannerslider_data')->getId() ) {
            return Mage::helper('bannerslider')->__("Edit Banner '%s'", $this->htmlEscape(Mage::registry('bannerslider_data')->getTitle()));
        } else {
            return Mage::helper('bannerslider')->__('Add Banner');
        }
    }

	protected function _prepareLayout()
	{
		if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled() && ($block = $this->getLayout()->getBlock('head')))
		{
		    $block
				->setCanLoadTinyMce(true)
				->addJs('mage/adminhtml/wysiwyg/widget.js')
				->addJs('mage/adminhtml/variables.js')
				->addJs('mage/adminhtml/browser.js')
//				->addJs('lib/flex.js')
//				->addJs('mage/adminhtml/flexuploader.js')
				->addCss('lib/prototype/windows/themes/magento.css')
				->addCss('css/tinybox/style.css')
				->setCanLoadExtJs(true)
				/*
				->addItem('js','tiny_mce/tiny_mce.js')
				->addItem('js','mage/adminhtml/wysiwyg/tiny_mce/setup.js')
				->addItem('js_css','prototype/windows/themes/magento.css')
				->addItem('js_css','prototype/windows/themes/default.css')
				*/;
		}
		parent::_prepareLayout();
	}
}
