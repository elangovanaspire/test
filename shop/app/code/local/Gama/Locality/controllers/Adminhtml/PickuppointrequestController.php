<?php

class Gama_Locality_Adminhtml_PickuppointrequestController extends Mage_Adminhtml_Controller_Action
{

    public function _initAction ()
    {
        $this->loadLayout()->_setActiveMenu('locality/pickuppointrequest');
        return $this;
    }

    public function indexAction ()
    {
        $this->_title($this->__('Pickup Point Request'))
            ->_title($this->__('Manage Pickup Point'));
       
        $this->_initAction();        
        $this->renderLayout();
    }

    public function newAction ()
    {
        $this->_forward('edit');
    }

    public function editAction ()
    {
        $this->_title($this->__('Pickup Point Request'))
            ->_title($this->__('Manage Pickup Point Request'));

        $pickuppointrequestModel = Mage::getModel('gama_locality/pickuppointrequest');
        $pickuppointrequestId = $this->getRequest()->getParam('id');
        if($pickuppointrequestId) {
            $pickuppointrequestModel->load($pickuppointrequestId);
           
            if(!$pickuppointrequestModel->getPickuppointRequestId()) {
                $this->_getSession()->addError( Mage::helper('gama_locality')->__('Pickup Point Does not exist'));
                return $this->_redirect('*/*/');
            }
            $this->_title($pickuppointrequestModel->getName());
            $breadCrumb = Mage::helper('gama_locality')->__('Edit Pickup Point Request');
            
        } else {
            $this->_title(Mage::helper('gama_locality')->__('New Pickup Point Request'));
            $breadCrumb = Mage::helper('gama_locality')->__('New Pickup Point Request');
        }

        $this->_initAction()->_addBreadcrumb($breadCrumb, $breadCrumb);
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (! empty($data)) {
            $pickuppointrequestModel->addData($data);
        }
        // 4. Register model to use later in blocks
        Mage::register('pickuppointrequest_item', $pickuppointrequestModel);
        
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
            $pickuppointrequestModel = Mage::getModel('gama_locality/pickuppointrequest');
            $pickuppointrequestModel->setData($data);
            try {
                $hasError = false;
                $pickuppointrequestModel->save();
                $this->_getSession()->addSuccess(
                        Mage::helper('gama_locality')->__(
                                'Pickup Point Request has been saved.'));
            } catch (Mage_Core_Exception $e) {
                $hasError = true;
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $hasError = true;
                $this->_getSession()->addException($e, 
                        Mage::helper('gama_locality')->__(
                                'An error occurred while saving the Pickup Point Request'));
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
    
    public function deleteAction() {
            if( $this->getRequest()->getParam('id') > 0 ) {
                    try {
                        
                            $model = Mage::getModel('gama_locality/pickuppointrequest');

                            $model->setId($this->getRequest()->getParam('id'))
                                    ->delete();

                            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                            $this->_redirect('*/*/');

                    } catch (Exception $e) {
                            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                            $this->_redirect('*/*/edit', array('type'=>$this->getRequest()->getParam('type'),'id' => $this->getRequest()->getParam('id')));
                    }
            }
            $this->_redirect('*/*/');
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