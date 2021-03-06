<?php

class Widgets_Content_Content extends Widgets_AbstractContent {

    const POPUP_WIDTH  = 964;

    const POPUP_HEIGHT = 594;

    protected function  _init() {
        $this->_type = (isset($this->_options[1]) && $this->_options[1] == 'static') ? Application_Model_Models_Container::TYPE_STATICCONTENT : Application_Model_Models_Container::TYPE_REGULARCONTENT;
        parent::_init();
    }

    protected function _load() {
        $this->_container = $this->_find();
        if(end($this->_options) == 'ajax') {
            $this->_view             = new Zend_View(array('scriptPath' => dirname(__FILE__) . '/views'));
            $this->_view->websiteUrl = Zend_Controller_Action_HelperBroker::getStaticHelper('website')->getUrl();
            $this->_view->type       = $this->_type;
            $this->_view->name       = $this->_name;
            if($this->_pageId == null) {
                $page = Application_Model_Mappers_PageMapper::getInstance()->findByUrl($this->_toasterOptions['url']);
                $this->_pageId = $page->getId();
            }
            $this->_view->pageId     = $this->_pageId;
            $this->_view->controls   = Tools_Security_Acl::isAllowed($this) ? $this->_generateAdminControl(self::POPUP_WIDTH, self::POPUP_HEIGHT): '';
            $params                  = Zend_Json::encode(Zend_Controller_Front::getInstance()->getRequest()->getParams());
            $this->_view->params     = $params;
            $this->_cacheId          = $this->_name .'_'. $this->_type .'_pid_'. $this->_pageId .'_'. Zend_Controller_Action_HelperBroker::getStaticHelper('Session')->getCurrentUser()->getRoleId() . substr(md5($params), 0, 27);
            return $this->_view->render('ajax.phtml');
        }

        //$this->_container = $this->_find();
        $content          = ($this->_container === null) ? '' : $this->_container->getContent();

        if(Tools_Security_Acl::isAllowed($this)) {
            $content .= $this->_generateAdminControl(self::POPUP_WIDTH, self::POPUP_HEIGHT);
            if ((bool)Zend_Controller_Action_HelperBroker::getStaticHelper('config')->getConfig('inlineEditor')){
                $content = '<div class="container-wrapper '. ($this->_checkPublished() ? '' : 'unpublished') .'">' . $content . '</div>';
            } elseif(!$this->_checkPublished()) {
                $content = '<div class="unpublished">' . $content . '</div>';
            }
        }

        return $content;
    }

    /**
     * Checks if content published
     *
     * @return bool true if published
     */
    private function _checkPublished() {
        if($this->_container === null) {
            return true;
        }

        if(!$this->_container->getPublished()) {
            if($this->_container->getPublishingDate()) {

                $zDate  = new Zend_Date();
                $result = $zDate->compare(strtotime($this->_container->getPublishingDate()));

                if($result == 0 || $result == 1) {
                    $this->_container->setPublishingDate('')
                        ->setPublished(true);
                    Application_Model_Mappers_ContainerMapper::getInstance()->save($this->_container);
                }
            }
        }

        return $this->_container->getPublished();
    }
    
	/**
	 * Overrides abstract class method
	 * For Header and Content widgets we have a different resource id
	 *
	 * @return string ACL Resource id
	 */
	public function  getResourceId() {
		return Tools_Security_Acl::RESOURCE_CONTENT;
	}
}

