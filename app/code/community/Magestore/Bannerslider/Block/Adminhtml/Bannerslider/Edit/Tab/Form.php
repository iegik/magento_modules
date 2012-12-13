<?php

class Magestore_Bannerslider_Block_Adminhtml_Bannerslider_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig(array(
			'add_variables' => true, 
			'add_widgets' => true,
			'tab_id' => 'form_section',
    ));
    $adminhtml_url = Mage::getSingleton('adminhtml/url');
		$plugins = $wysiwygConfig->getData("plugins");
		$plugins[0]["options"]["url"] = $adminhtml_url->getUrl('adminhtml/system_variable/wysiwygPlugin');
		$plugins[0]["options"]["onclick"]["subject"] = "MagentovariablePlugin.loadChooser('".$adminhtml_url->getUrl('adminhtml/system_variable/wysiwygPlugin')."', '{{html_id}}');";

		$wysiwygConfig->setData("widget_window_url",					$adminhtml_url->getUrl('adminhtml/widget/index'));
		$wysiwygConfig->setData("directives_url",							$adminhtml_url->getUrl('adminhtml/cms_wysiwyg/directive'));
		$wysiwygConfig->setData("directives_url_quoted",			$adminhtml_url->getUrl('adminhtml/cms_wysiwyg/directive'));
		$wysiwygConfig->setData("files_browser_window_url",		$adminhtml_url->getUrl('adminhtml/cms_wysiwyg_images/index'));
		$wysiwygConfig->setData("files_browser_window_width",	(int) Mage::getConfig()->getNode('adminhtml/cms/browser/window_width'));
		$wysiwygConfig->setData("files_browser_window_height",(int) Mage::getConfig()->getNode('adminhtml/cms/browser/window_height'));
		$wysiwygConfig->setData("plugins",$plugins);
		$wysiwygConfig->setData('add_widgets', true);

    $fieldset = $form->addFieldset('bannerslider_form', array('legend'=>Mage::helper('bannerslider')->__('General information')));
   
    $fieldset->addField('title', 'text', array(
        'label'     => Mage::helper('bannerslider')->__('Title'),
        'class'     => 'required-entry',
        'required'  => true,
        'name'      => 'title',
    ));
		
		if (!Mage::app()->isSingleStoreMode()) {
			$fieldset->addField('store_id', 'multiselect', array(
						'name'      => 'stores[]',
						'label'     => Mage::helper('cms')->__('Store View'),
						'title'     => Mage::helper('cms')->__('Store View'),
						'required'  => true,
						'values'    => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
				));
		}
		else {
				$fieldset->addField('store_id', 'hidden', array(
						'name'      => 'stores[]',
						'value'     => Mage::app()->getStore(true)->getId()
				));
				$model->setStoreId(Mage::app()->getStore(true)->getId());
		}

    $fieldset->addField('filename', 'image', array(
        'label'     => Mage::helper('bannerslider')->__('Image File'),
        'required'  => false,
        'name'      => 'filename',
  	));
		
  	$fieldset->addField('is_home', 'select', array(
        'label'     => Mage::helper('bannerslider')->__('Show in'),
        'class'     => 'required-entry',
        'required'  => true,
        'name'      => 'is_home',
	  'values'	=> Mage::helper('bannerslider')->getDisplayOption(),
    ));
  
    $fieldset->addField('status', 'select', array(
        'label'     => Mage::helper('bannerslider')->__('Status'),
        'name'      => 'status',
        'values'    => array(
            array(
                'value'     => 1,
                'label'     => Mage::helper('bannerslider')->__('Enabled'),
            ),

            array(
                'value'     => 2,
                'label'     => Mage::helper('bannerslider')->__('Disabled'),
            ),
        ),
    ));
		
		$fieldset->addField('weblink', 'text', array(
        'label'     => Mage::helper('bannerslider')->__('Web Url'),
        'required'  => false,
        'name'      => 'weblink',
    ));

    $fieldset->addField('description', 'editor', array(
        'name'      => 'description',
        'label'     => Mage::helper('bannerslider')->__('Description'),
        'title'     => Mage::helper('bannerslider')->__('Description'),
        'style'     => 'height:26em;',
        'config'    => $wysiwygConfig,
        'wysiwyg'   => true,
        'required'  => false,
    ));
   
    if ( Mage::getSingleton('adminhtml/session')->getBannerSliderData() )
    {
        $data = Mage::getSingleton('adminhtml/session')->getBannerSliderData();
        Mage::getSingleton('adminhtml/session')->setBannerSliderData(null);
    } elseif ( Mage::registry('bannerslider_data') ) {
        $data = Mage::registry('bannerslider_data')->getData();
    }

    if(@$data['stores']){
	  	$data['store_id'] = explode(',',$data['stores']);
    }
  	$form->setValues($data);
	  
    return parent::_prepareForm();
  }
}
