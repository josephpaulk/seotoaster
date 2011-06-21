<?php
/**
 * Description of Meta
 *
 * @author iamne
 */
class Widgets_Meta_Meta extends Widgets_Abstract {

	const TYPE_KEYWORDS    = 'keywords';

	const TYPE_DESCRIPTION = 'description';

	protected function  _load() {
		return $this->_getMetaContent();
	}

	private function _getMetaContent() {
		$metaType    = current($this->_options);
		$metaContent = '';
		switch ($metaType) {
			case self::TYPE_KEYWORDS:
				$metaContent = $this->_toasterOptions['metaKeywords'];
			break;
			case self::TYPE_DESCRIPTION:
				$metaContent = $this->_toasterOptions['metaDescription'];
			break;
		}
		return $metaContent;
	}

	public static function getAllowedOptions() {
		return array('meta:description', 'meta:keywords');
	}

}
