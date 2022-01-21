<?php

namespace PHPMVC\Controllers;

use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\lib\Messenger;
use PHPMVC\Models\UserGroupModel;
use PHPMVC\Models\UserModel;
use PHPMVC\Models\UserProfileModel;

class UsersController extends AbstractController
{
    use InputFilter;
    use Helper;
    private $_createActionRoles =
    [
        'first_name'    => 'req|alpha|between(2,10)',
        'last_name'     => 'req|alpha|between(2,10)',
        'Username'      => 'req|alphanum|between(2,12)',
        'Password'      => 'req|min(6)|eq_field(CPassword)',
        'CPassword'     => 'req|min(6)',
        'Email'         => 'req|email',
        'CEmail'        => 'req|email',
        'PhoneNumber'   => 'alphanum|max(15)',
        'group_id'      => 'req|int'
    ];
    private $_editActionRoles =
        [

            'Email'         => 'req|email',
            'PhoneNumber'   => 'alphanum|max(15)',
            'group_id'      => 'req|int'
        ];

    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('users.default');
        $this->_data['users']=UserModel::getUsers($this->session->u);
        $this->_view();
    }
    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('users.create');
        $this->language->load('users.labels');
        $this->language->load('users.messages');
        $this->language->load('validation.errors');

        $this->_data['groups'] =UserGroupModel::getAll();


        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles,$_POST)){
            $user = new UserModel();
            $user->user_name = $this->filterString($_POST['Username']);
            $user->cryptPassword($_POST['Password']);
            $user->email =$this->filterString($_POST['Email']);
            $user->phone_number =$this->filterString($_POST['PhoneNumber']);
            $user->group_id = $this->filterString($_POST['group_id']);
            $user->subscription_date = date('y-m-d');
            $user->last_login=date('y-m-d H:i:s');
            $user->status =1;

            if(UserModel::userExists($user->user_name)){
                $this->messenger->add($this->language->get('message_user_exists'),Messenger::APP_MESSAGE_ERROR);
                $this->redirect('/us 20ers');
            }
            // TODO:: SEND THE USER WELCOME EMAIL
            if($user->save()){
                $userprofile = new UserProfileModel();
                $userprofile->user_id =$user->user_id;
                $userprofile->first_name = $this->filterString($_POST['first_name']);
                $userprofile->last_name = $this->filterString($_POST['last_name']);
                $userprofile->save(false);

                $this->messenger->add($this->language->get('message_create_success'));
            }else {
                $this->messenger->add($this->language->get('message_create_failed'),Messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/users');

        }

        $this->_view();
    }

    public function editAction()
    {
        $id =$this->filterInt($this->_params[0]);

        $user = UserModel::getByPK($id);
        if($user===false || $this->u->user_id==$id) {
            $this->redirect('/users');
        }
            $this->_data['user'] = $user;


        $this->language->load('template.common');
        $this->language->load('users.edit');
        $this->language->load('users.labels');
        $this->language->load('users.messages');
        $this->language->load('validation.errors');

        $this->_data['groups'] =UserGroupModel::getAll();


        if(isset($_POST['submit']) && $this->isValid($this->_editActionRoles,$_POST)){
            $user->email =$this->filterString($_POST['Email']);
            $user->phone_number =$this->filterString($_POST['PhoneNumber']);
            $user->group_id = $this->filterString($_POST['group_id']);


            if($user->save()){
                $this->messenger->add($this->language->get('message_create_success'));
            }else {
                $this->messenger->add($this->language->get('message_create_failed'),Messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/users');

        }

        $this->_view();
    }
    public function deleteAction()
    {

        $id =$this->filterInt($this->_params[0]);

        $user = UserModel::getByPK($id);
        if($user===false || $this->u->user_id==$id) {
            $this->redirect('/users');
        }
        
        $this->language->load('users.messages');

        if($user->delete()) {
            $this->messenger->add($this->language->get('message_delete_success'));
        } else {
            $this->messenger->add($this->language->get('message_delete_failed'), Messenger::APP_MESSAGE_ERROR);
        }
        $this->redirect('/users');
    }

    // TODO :: explain the different types of headers used in this course
    // TODO :: make sure this is a AJAX Request
    public function checkUserExistAjaxAction()
    {
        if (isset($_POST['Username'])){
            header('Content-type: text/plain');
            if(UserModel::userExists($this->filterString($_POST['Username'])) !==false) {
                echo 1;
            }else{
                echo 2;
            }
        }
    }

}