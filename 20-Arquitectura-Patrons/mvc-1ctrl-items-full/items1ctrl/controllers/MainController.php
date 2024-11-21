<?php
require_once 'lib/ViewLoader.php';
require_once 'model/ItemModel.php';
require_once 'lib/ItemFormValidation.php';

/**
 * Main controller of item application.
 * @author ProvenSoft
 */
class MainController {
    /**
     * @var ViewLoader
     */
    private $view;
    /**
     * @var ItemModel 
     */
    private $model;
    /**
     * @var string  
     */
    private $action;
    
    public function __construct() {
        //instantiate the view loader.
        $this->view = new ViewLoader();
        //instantiate the model.
        $this->model = new ItemModel();
    }
    
    /**
     * process requests from client, regarding action command.
     */
    public function processRequest() {
        $this->action = "";
        //retrieve action command requested by client.
        if (filter_has_var(INPUT_GET, 'action')) {
            $this->action = filter_input(INPUT_GET, 'action'); 
        }
    
        //process action.
        switch ($this->action) {
            case 'home':
                $this->homePage();
                break;
            case 'listAll': //list all items.
                $this->listAll();
                break;
            case 'findItem':
                $this->findItem();
                break;
            case 'itemForm':
                $this->itemForm();
                break;
            case 'addItem':
                $this->addItem();
                break;
            case 'modifyItem':
                $this->modifyItem();
                break;
            case 'removeItem':
                $this->removeItem();
                break;
            case 'goToListByTitle':
                $this->goToListByTitle();
                break;
            case 'findByTitle':
                $this->findByTitle();
                break;
            default:  //processing default action.
                $this->homePage();
                break;
        }

    }
    
    /**
     * displays home page content.
     */
    public function homePage() {
        $this->view->show("home.php", null);
    }
    
    /**
     * lists all items.
     */
    public function listAll() {
        //get all items.
        $itemList = $this->model->searchAll();
        //pass data to template.
        $data['itemList'] = $itemList;
        //show the template with the given data.
        $this->view->show("list-items.php", $data);
    }    
    
    /**
     * shows a form for an item.
     */
    public function itemForm() {
        $item = ItemFormValidation::getData();
        //pass data to template.
        $data['item'] = $item;
        $data['action'] = $this->action;
        $this->view->show("item-form.php", $data);
    }
    
    /**
     * requests model to add item sent by form.
     */
    public function addItem() {
        $item = ItemFormValidation::getData();
        $result = null;
        if (is_null($item)) {
            $result = "Error reading item";
        } else {
            $numAffected = $this->model->addItem($item);
            if ($numAffected>0) {
                $result = "Item successfully added";
            } else {
                $result = "Error adding item";
            }            
        }
        //pass data to template.
        $data['result'] = $result;
        //show the template with the given data.
        $this->view->show("item-form.php", $data);
    }

    /**
     * requests model to modify item sent by form.
     */
    public function modifyItem() {
        $item = ItemFormValidation::getData();
        $result = null;
        if (is_null($item)) {
            $result = "Error reading item";
        } else {
            $numAffected = $this->model->modifyItem($item);
            if ($numAffected>0) {
                $result = "Item successfully modified";
            } else {
                $result = "Error modifying item";
            }            
        }
        //pass data to template.
        $data['result'] = $result;
        //show the template with the given data.
        $this->view->show("item-form.php", $data);        
    }

    /**
     * requests model to remove item sent by form.
     */
    public function removeItem() {
        $item = ItemFormValidation::getData();
        $result = null;
        if (is_null($item)) {
            $result = "Error reading item";
        } else {
            $numAffected = $this->model->removeItem($item);
            if ($numAffected>0) {
                $result = "Item successfully removed";
            } else {
                $result = "Error removing item";
            }
        }
        //pass data to template.
        $data['result'] = $result;
        //show the template with the given data.
        $this->view->show("item-form.php", $data);          
    }

    public function findItem() {
        $item = ItemFormValidation::getData();
        $result = null;
        if (is_null($item)) {
            $result = "Error reading item";
        } else {
            $itemFound = $this->model->searchItemById($item->getId());
            if (!is_null($itemFound)) {
                //pass data to template.
                $data['item'] = $itemFound;
                $data['action'] = "toChange";
            } else {
                $result = "Item not found";
            }            
        }
        //pass data to template.
        $data['result'] = $result;
        //show the template with the given data.
        $this->view->show("item-form.php", $data);         
    }
    public function goToListByTitle(){
        $this->view->show("search-form.php", null);   
    }
    
    public function findByTitle(){
        $item = ItemFormValidation::getData();
        $pattern = $item->getTitle();
        $itemList = $this->model->searchByTitle($pattern);
        $data['itemList'] = $itemList;
        $this->view->show("list-items.php", $data);   
    }
}
