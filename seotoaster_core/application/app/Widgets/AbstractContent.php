<?php
abstract class Widgets_AbstractContent extends Widgets_Abstract {

	protected function _addAdminLink($containerType, $containerId = null, $title = '', $width = 0, $height = 0) {
		$adminIconName = '';
		switch ($containerType) {
			case Application_Model_Models_Container::TYPE_REGULARCONTENT:
				$adminIconName = 'editadd.png';
			break;
			case Application_Model_Models_Container::TYPE_STATICCONTENT:
				$adminIconName = 'editadd-static-content.png';
			break;
			case Application_Model_Models_Container::TYPE_REGULARHEADER:
				$adminIconName = 'editadd-header.png';
			break;
			case Application_Model_Models_Container::TYPE_STATICHEADER:
				$adminIconName = 'editadd-static-header.png';
			break;
			case Application_Model_Models_Container::TYPE_CODE:
				$adminIconName = 'editadd-code.png';
			break;
		}
		if(null == $containerId) {
			return '<a class="tpopup" title="' . $title . '" href="javascript:;" data-url="' . $this->_toasterOptions['websiteUrl'] . 'backend/backend_content/add/containerType/' . $containerType . '/containerName/' . $this->_options[0] . '/pageId/' . $this->_toasterOptions['id'] . '" class="generator-links"><img width="26" height="26" src="' . $this->_toasterOptions['websiteUrl'] . 'system/images/' . $adminIconName . '" alt="edit container" /></a>';
		}

		return '<a class="tpopup" title="' . $title . '" href="javascript:;" data-url="'. $this->_toasterOptions['websiteUrl'] . 'backend/backend_content/edit/id/' . $containerId . '/containerType/' . $containerType . '"  class="generator-links"><img width="26" height="26" src="' . $this->_toasterOptions['websiteUrl'] . 'system/images/' . $adminIconName .'" alt="edit header" /></a>';

		//return '<a title="' . $title . '" href="javascript:;" onclick="showToasterPopup(\''. $this->_toasterOptions['websiteUrl'] . 'backend/backend_content/edit/id/' . $containerId . '/containerType/' . $containerType . '/\')" class="generator-links"><img width="26" height="26" src="' . $this->_toasterOptions['websiteUrl'] . 'system/images/' . $adminIconName .'" alt="edit header" /></a>';
	}
}

