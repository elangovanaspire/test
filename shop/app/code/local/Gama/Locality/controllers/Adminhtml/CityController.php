<?php

class Gama_Locality_Adminhtml_CityController extends Mage_Adminhtml_Controller_Action
{

    public function _initAction ()
    {
        $this->loadLayout()->_setActiveMenu('locality/city');
        return $this;
    }

    public function indexAction ()
    {
        $this->_title($this->__('City'))
            ->_title($this->__('Manage City'));
        
        $this->_initAction();
        $this->renderLayout();
    }

    public function newAction ()
    {
        $this->_forward('edit');
    }

    public function editAction ()
    {
        $this->_title($this->__('City'))
            ->_title($this->__('Manage City'));

        $cityModel = Mage::getModel('gama_locality/city');
        $cityId = $this->getRequest()->getParam('id');
        if($cityId) {
            $cityModel->load($cityId);
            if(!$cityModel->getCityId()) {
                $this->_getSession()->addError( Mage::helper('gama_locality')->__('City Does not exist'));
                return $this->_redirect('*/*/');
            }
            $this->_title($cityModel->getName());
            $breadCrumb = Mage::helper('gama_locality')->__('Edit City');
            
        } else {
            $this->_title(Mage::helper('gama_locality')->__('New City'));
            $breadCrumb = Mage::helper('gama_locality')->__('New City');
        }

        $this->_initAction()->_addBreadcrumb($breadCrumb, $breadCrumb);
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (! empty($data)) {
            $cityModel->addData($data);
        }
        // 4. Register model to use later in blocks
        Mage::register('city_item', $cityModel);
        // 5. render layout
        $this->renderLayout();
    }

    public function saveAction ()
    {
        $redirectPath = '*/*';
        $redirectParams = array();
        // check if data sent
        $data = $this->getRequest()->getPost();
        
        if ($data) {
            $cityModel = Mage::getModel('gama_locality/city');
            $cityModel->setData($data);
            try {
                $hasError = false;
                $cityModel->save();
                $this->_getSession()->addSuccess(
                        Mage::helper('gama_locality')->__(
                                'The City has been saved.'));
            } catch (Mage_Core_Exception $e) {
                $hasError = true;
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $hasError = true;
                $this->_getSession()->addException($e, 
                        Mage::helper('gama_locality')->__(
                                'An error occurred while saving the City'));
            }
            
            if ($hasError) {
                $this->_getSession()->setFormData($data);
                $redirectPath = '*/*/edit';
                $redirectParams = array(
                        'id' => $this->getRequest()->getParam('id')
                );
            }
        }
        
        $this->_redirect($redirectPath, $redirectParams);
    }

    /**
     * Grid ajax action
     */
    public function gridAction ()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
}