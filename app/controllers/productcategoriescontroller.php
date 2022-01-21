<?php
namespace PHPMVC\Controllers;
use PHPMVC\lib\FileUpload;
use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\lib\Messenger;
use PHPMVC\Lib\Validate;
use PHPMVC\Models\PrivilegeModel;
use PHPMVC\Models\ProductCategoryModel;
use PHPMVC\Models\UserGroupModel;
use PHPMVC\Models\UserGroupPrivilegeModel;

class ProductCategoriesController extends AbstractController
{

    use InputFilter;
    use Helper;
    use Validate;

    private $_createActionRoles =
    [
        'cat_name'          => 'req|alphanum|between(3,100)'
    ];

    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('productcategories.default');

        $this->_data['categories'] = ProductCategoryModel::getAll();

        $this->_view();
    }

    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('productcategories.create');
        $this->language->load('productcategories.labels');
        $this->language->load('productcategories.messages');
        $this->language->load('validation.errors');

        $uploadError = false;

        // TODO:: explain a better solution to check against file type
        // TODO:: explain a better solution to secure the upload folder
        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)) {
            $category = new ProductCategoryModel();
            $category->cat_name = $this->filterString($_POST['cat_name']);
            if(!empty($_FILES['cat_image']['name'])) {
                $uploader = new FileUpload($_FILES['cat_image']);
                $uploader->upload();
                $category->cat_image = $uploader->getFileName();
            }


            if($uploadError === false && $category->save())
            {
                $this->messenger->add($this->language->get('message_create_success'));
                $this->redirect('/productcategories');
            } else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }
        }

        $this->_view();
    }

    public function editAction()
    {

        $id = $this->filterInt($this->_params[0]);
        $category = ProductCategoryModel::getByPK($id);

        if($category === false) {
            $this->redirect('/productcategories');
        }

        $this->language->load('template.common');
        $this->language->load('productcategories.edit');
        $this->language->load('productcategories.labels');
        $this->language->load('productcategories.messages');
        $this->language->load('validation.errors');


        $this->_data['category'] = $category;
        $uploadError = false;



        if(isset($_POST['submit'])) {
            $category->cat_name = $this->filterString($_POST['cat_name']);
            if(!empty($_FILES['cat_image']['cat_name'])) {
                // Remove the old image
                if($category->cat_image !== '' && file_exists(IMAGES_UPLOAD_STORAGE.DS.$category->cat_image) &&
                    is_writable(IMAGES_UPLOAD_STORAGE)) {
                    unlink(IMAGES_UPLOAD_STORAGE.DS.$category->cat_image);
                }

                // Create a new image
                $uploader = new FileUpload($_FILES['cat_image']);
                try {
                    $uploader->upload();
                    $category->cat_image = $uploader->getFileName();
                } catch (\Exception $e) {
                    $this->messenger->add($e->getMessage(), Messenger::APP_MESSAGE_ERROR);
                    $uploadError = true;
                }
            }
            if($uploadError === false && $category->save())
            {
                $this->messenger->add($this->language->get('message_create_success'));
                $this->redirect('/productcategories');
            } else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }
        }

        $this->_view();
    }

    public function deleteAction()
    {

        $id = $this->filterInt($this->_params[0]);
        $category = ProductCategoryModel::getByPK($id);

        if($category === false) {
            $this->redirect('/productcategories');
        }

        $this->language->load('productcategories.messages');

        if($category->delete())
        {
            // Remove the old image
            if($category->cat_image !== '' && file_exists(IMAGES_UPLOAD_STORAGE.DS.$category->cat_image)) {
                unlink(IMAGES_UPLOAD_STORAGE.DS.$category->cat_image);
            }
            $this->messenger->add($this->language->get('message_delete_success'));
        } else {
            $this->messenger->add($this->language->get('message_delete_failed'));
        }
        $this->redirect('/productcategories');
    }
}