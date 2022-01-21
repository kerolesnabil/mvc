<?php
namespace PHPMVC\Controllers;

use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\lib\Messenger;
use PHPMVC\Models\ClientModel;

class ClientsController extends AbstractController
{

    use InputFilter;
    use Helper;

    private $_createActionRoles =
    [
        'cat_name'              => 'req|alpha|between(2,40)',
        'cat_email'             => 'req|email',
        'cat_phoneNumber'       => 'alphanum|max(15)',
        'cat_address'               => 'req|alphanum|max(50)'
    ];

    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('clients.default');

        $this->_data['clients'] = ClientModel::getAll();

        $this->_view();
    }

    public function createAction()
    {

        $this->language->load('template.common');
        $this->language->load('clients.create');
        $this->language->load('clients.labels');
        $this->language->load('clients.messages');
        $this->language->load('validation.errors');

        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)) {

            $client = new ClientModel();

            $client->cat_name = $this->filterString($_POST['cat_name']);
            $client->cat_email = $this->filterString($_POST['cat_email']);
            $client->cat_phoneNumber = $this->filterString($_POST['cat_phoneNumber']);
            $client->cat_address = $this->filterString($_POST['cat_address']);

            if($client->save()) {
                $this->messenger->add($this->language->get('message_create_success'));
            } else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/clients');
        }

        $this->_view();
    }

    public function editAction()
    {

        $id = $this->filterInt($this->_params[0]);
        $client = ClientModel::getByPK($id);

        if($client === false) {
            $this->redirect('/clients');
        }

        $this->_data['clients'] = $client;

        $this->language->load('template.common');
        $this->language->load('clients.edit');
        $this->language->load('clients.labels');
        $this->language->load('clients.messages');
        $this->language->load('validation.errors');

        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)) {

            $client->cat_name = $this->filterString($_POST['cat_name']);
            $client->cat_email = $this->filterString($_POST['cat_email']);
            $client->cat_phoneNumber = $this->filterString($_POST['cat_phoneNumber']);
            $client->cat_address = $this->filterString($_POST['cat_address']);

            if($client->save()) {
                $this->messenger->add($this->language->get('message_create_success'));
            } else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/clients');
        }

        $this->_view();
    }

    public function deleteAction()
    {

        $id = $this->filterInt($this->_params[0]);
        $client = ClientModel::getByPK($id);

        if($client === false) {
            $this->redirect('/clients');
        }

        $this->language->load('clients.messages');

        if($client->delete()) {
            $this->messenger->add($this->language->get('message_delete_success'));
        } else {
            $this->messenger->add($this->language->get('message_delete_failed'), Messenger::APP_MESSAGE_ERROR);
        }
        $this->redirect('/clients');
    }
}