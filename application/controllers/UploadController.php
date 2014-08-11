<?php

class UploadController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }

    public function comFormularioAction() {
        $form = new Zend_Form();
        $form->setAttrib('enctype', 'multipart/form-data');
        
        $destDir = APPLICATION_PATH . '/../data/tmp';
        
        $element = new Zend_Form_Element_File('file');
        $element->setLabel('Upload de imagem:')
            ->setDestination($destDir);
        
        // somente um arquivo
        $element->addValidator('Count', false, 1);
        // limit to 1Mb
        $element->addValidator('Size', false, 1024000);
        // only JPEG, PNG, and GIFs
        $element->addValidator('Extension', false, 'jpg,png,gif');
        
        $submit = new Zend_Form_Element_Submit('enviar');        
        
        $form->addElement($element);
        $form->addElement($submit);
        
        $this->view->form = $form;
        
        if ($this->_request->isPost()) {
            $data = $this->_request->getPost();
            
            if($form->isValid($data)) {
                if(!$form->file->receive()) {
                    throw new Exception("Falha ao realizar o upload");
                }
                
                $this->view->filename = $form->file->getFileName();
            }
        }
    }

    public function semFormularioAction() {
        $html = '';
        
        if ($this->_request->isPost()) {
            $destDir = APPLICATION_PATH . '/../data/tmp';

            /* Uploading Document File on Server */
            $upload = new Zend_File_Transfer_Adapter_Http();
            $upload->setDestination($destDir)
                    ->addValidator('Count', false, 1)
                    ->addValidator('Size', false, 102400)
                    ->addValidator('Extension', false, 'jpg,png,gif,pdf');

            try {
                $files = $upload->getFileInfo();

                foreach ($files as $file => $info) {
                    // file uploaded ?
                    if (!$upload->isUploaded($file)) {
                        throw new Exception("Why havn't you uploaded the file ?");
                    }

                    // validators are ok ?
                    if (!$upload->isValid($file)) {
                        throw new Exception("Sorry but $file is not what we wanted");
                    }
                }

                // upload received file(s)
                $upload->receive();

                foreach ($files as $file => $info) {
                    $mimeType = $upload->getMimeType($file);
                    $fname = $upload->getFileName($file);
                    $size = $upload->getFileSize($file);

                    $fext_tmp = explode('.', $fname);
                    $fext_tmp[(count($fext_tmp) - 1)];

                    $fileExt = $fext_tmp[(count($fext_tmp) - 1)];
                    $newFile = $destDir . DIRECTORY_SEPARATOR . md5(time()) . '.' . $fileExt;

                    $filterFileRename = new Zend_Filter_File_Rename(
                            array('target' => $newFile, 'overwrite' => true
                    ));

                    $filterFileRename->filter($fname);

                    if (file_exists($newFile)) {
                        $html = 'Orig Filename: ' . $fname . '<br />';
                        $html .= 'New Filename: ' . $newFile . '<br />';
                        $html .= 'File Size: ' . $size . '<br />';
                        $html .= 'Mime Type: ' . $mimeType . '<br />';
                    } else {
                        $html = 'Não foi possível fazer o upload do arquivo!';
                    }
                }
            } catch (Zend_File_Transfer_Exception $e) {
                echo $e->getMessage();
                exit;
            }

            $this->view->assign('uploadResult', $html);
        }
    }

}
