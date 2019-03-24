<?php

class Ballal_Cms_Model_Observer
{
    public function cmsField($observer)
    {
        //get CMS model with data
        $model = Mage::registry('cms_page');
        //get form instance
        $form = $observer->getForm();
        $fieldset = $form->getElement('content_fieldset');
        //add new field
        $fieldset->addField('content_custom', 'image', array(
            'name'      => 'content_custom',
            'label'     => Mage::helper('cms')->__('Header Image'),
            'title'     => Mage::helper('cms')->__('Header Image'),
            'disabled'  => false,
            //set field value
            'value'     => $model->getContentCustom()
        ));

    }

    public function addFormEnctype(Varien_Event_Observer $observer)
    {
        try {
            $block = $observer->getEvent()->getBlock();

            if ($block instanceof Mage_Adminhtml_Block_Cms_Page_Edit_Form) {

                $form = $block->getForm();
                $form->setData('enctype', 'multipart/form-data');
                $form->setUseContainer(true);
            }
        } catch(Exception $e) {
            Mage::logException($e);
        }
    }

    public function beforeSave(Varien_Event_Observer $observer)
    {
        try {
            $model = $observer->getEvent()->getPage();

            $request = $observer->getEvent()->getRequest();
            $data    = $request->getPost();

            $path = Mage::getBaseDir('media') . '/wysiwyg/';  //. DS . self::MEDIA_DIR;
            if ( ! file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $imagesAttributesNames = array('content_custom');
            $images = array();
            foreach($imagesAttributesNames as $imageAttributeName) {

                $uploadedImage = $_FILES[$imageAttributeName];

                if ($uploadedImage['name'] > '1') {
                    Mage::log('uploading');
                    $uploader = new Varien_File_Uploader($imageAttributeName);
                    Mage::log('set');
                    $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png', 'svg'));
                    $uploader->setAllowRenameFiles(true);
                    $uploader->setFilesDispersion(false);
                    $uploader->save($path, $uploadedImage['name']);
                    Mage::log($uploader);
                    $model->setData($imageAttributeName, 'wysiwyg/' . $uploader->getUploadedFileName()); //$path.'/'.$uploader->getUploadedFileName());
                } else {
                    if(isset($data[$imageAttributeName]['delete']) && $data[$imageAttributeName]['delete'] == 1) {
                        $data[$imageAttributeName] = '';
                        $model->setData($imageAttributeName, $data[$imageAttributeName]);
                    } else {
                        unset($data[$imageAttributeName]);
                        $model->setData($imageAttributeName, implode($request->getPost($imageAttributeName)));
                    }
                }
            }

        } catch(Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
    }
}