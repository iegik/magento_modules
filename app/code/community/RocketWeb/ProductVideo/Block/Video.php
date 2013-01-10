<?php

/**
 * RocketWeb
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   RocketWeb
 * @package    RocketWeb_ProductVideo
 * @copyright  Copyright (c) 2011 RocketWeb (http://rocketweb.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author     RocketWeb
 */

/**
 * Simple product video view
 *
 */
class RocketWeb_ProductVideo_Block_Video extends Mage_Catalog_Block_Product_View_Abstract
{
	
	public function getThumbWidth()
	{
		$_product = $this->getProduct();
		if ($_product->getData('rw_video_thumb_width'))
		{
			$width = $_product->getData('rw_video_thumb_width');
		}
		else
		{
			$width = $this->helper('productvideo/data')->getDefaultThumbWidth();
		}
		return $width;
	}
	
	public function getThumbHeight()
	{
		$_product = $this->getProduct();
		if ($_product->getData('rw_video_thumb_height'))
		{
			$height = $_product->getData('rw_video_thumb_height');
		}
		else
		{
			$height = $this->helper('productvideo/data')->getDefaultThumbHeight();
		}
		return $height;
	}
	
	public function getWidth()
	{
		$_product = $this->getProduct();
		if ($_product->getData('rw_video_width'))
		{
			$width = $_product->getData('rw_video_width');
		}
		else
		{
			$width = $this->helper('productvideo/data')->getDefaultWidth();
		}
		return $width;
	}
	
	public function getHeight()
	{
		$_product = $this->getProduct();
		if ($_product->getData('rw_video_height'))
		{
			$height = $_product->getData('rw_video_height');
		}
		else
		{
			$height = $this->helper('productvideo/data')->getDefaultHeight();
		}
		return $height;
	}
}