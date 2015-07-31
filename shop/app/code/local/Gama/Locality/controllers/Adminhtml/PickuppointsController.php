<?php

class Gama_Locality_Adminhtml_PickuppointsController extends Mage_Adminhtml_Controller_Action
{

    public function _initAction ()
    {
        $this->loadLayout()->_setActiveMenu('locality/pickuppoint');
        return $this;
    }

    public function indexAction ()
    {
        $this->_title($this->__('Pickup Point'))
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
        $this->_title($this->__('Pickup Point'))
            ->_title($this->__('Manage Pickup Point'));

        $pickuppointModel = Mage::getModel('gama_locality/pickuppoint');
        $pickuppointId = $this->getRequest()->getParam('id');
        if($pickuppointId) {
            $pickuppointModel->load($pickuppointId);
            if(!$pickuppointModel->getPickuppointId()) {
                $this->_getSession()->addError( Mage::helper('gama_locality')->__('Pickup Point Does not exist'));
                return $this->_redirect('*/*/');
            }
            $this->_title($pickuppointModel->getName());
            $breadCrumb = Mage::helper('gama_locality')->__('Edit Pickup Point');
            
        } else {
            $this->_title(Mage::helper('gama_locality')->__('New Pickup Point'));
            $breadCrumb = Mage::helper('gama_locality')->__('New Pickup Point');
        }

        $this->_initAction()->_addBreadcrumb($breadCrumb, $breadCrumb);
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (! empty($data)) {
            $pickuppointModel->addData($data);
        }
        // 4. Register model to use later in blocks
        Mage::register('pickuppoint_item', $pickuppointModel);
        
        // 5. render layout
        $this->renderLayout();
    }

    public function saveAction ()
    {
        $redirectPath = '*/*';
        $redirectParams = array();
        // check if data sent
        $data = $this->getRequest()->getPost();
        $categories = array("category1" => "bf_items",
													"category2" => "lunch_items",
													"category3" => "dinner_items",
													"category4" => "snacks_items"
										);
        foreach( $categories as $key => $value) {
					if( !isset( $data[$key] ) )  {
						$data[$key] = 0;
						$data[$value] = '';
					}
				}
				
        foreach ($data as $key => $value)
    		{
        	if (is_array($value))
        	{
            $data[$key] = implode(',',$this->getRequest()->getParam($key));
        	}
    		}
        
        if ($data) {

            $pickuppointModel = Mage::getModel('gama_locality/pickuppoint');

            $pickuppointModel->setData($data);

            try {
                $hasError = false;

                $pickuppointModel->save();

                $this->_getSession()->addSuccess(
                        Mage::helper('gama_locality')->__(
                                'Pickup Point has been saved.'));
            } catch (Mage_Core_Exception $e) {
                $hasError = true;
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $hasError = true;
                $this->_getSession()->addException($e, 
                        Mage::helper('gama_locality')->__(
                                'An error occurred while saving the Pickup Point'));
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
                        
                            $model = Mage::getModel('gama_locality/pickuppoint');

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
