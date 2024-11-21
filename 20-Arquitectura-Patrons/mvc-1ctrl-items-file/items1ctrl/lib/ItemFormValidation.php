<?php
require_once 'model/Item.php';

/**
 * Description of ItemFormValidation
 * Provides validation to get data from item form.
 * @author ProvenSoft
 */
class ItemFormValidation {
    
    /**
     * validates and gets data from item form.
     * @return Item the item with the given data or null if data is not present and valid.
     */
    public static function getData() {
        $itemObj = null;
        $id = 0;
        //retrieve id sent by client.
        if (filter_has_var(INPUT_GET, 'id')) {
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); 
        }
        $title = "";
        //retrieve item sent by client.
        if (filter_has_var(INPUT_GET, 'title')) {
            $title = filter_input(INPUT_GET, 'title'); 
        }
        $content = "";
        //retrieve item sent by client.
        if (filter_has_var(INPUT_GET, 'content')) {
            $content = filter_input(INPUT_GET, 'content'); 
        }
        //if (!empty($id) && !empty($title) && !empty($content)) { 
            //they exists and they are not empty
            $itemObj = new Item($id, $title, $content);
        //}
        return $itemObj;
    }
    
}
