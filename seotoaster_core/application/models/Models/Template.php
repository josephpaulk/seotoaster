<?php

class Application_Model_Models_Template extends Application_Model_Models_Abstract {

	const ID_DEFAULT  = 'default';

	const ID_INDEX    = 'index';

	const ID_CATEGORY = 'category';

	const ID_NEWS     = 'news';

	const ID_PRODUCT  = 'product';

	private $_name         = '';

	private $_content      = '';

	private $_previewImage = '';

	public function getPreviewImage() {
		return $this->_previewImage;
	}

	public function setPreviewImage($previewImage) {
		$this->_previewImage = $previewImage;
		return $this;
	}

	public function getName() {
		return $this->_name;
	}

	public function setName($name) {
		$this->_name = $name;
		return $this;
	}

	public function getContent() {
		return $this->_content;
	}

	public function setContent($content) {
		$this->_content = $content;
		return $this;
	}

}
