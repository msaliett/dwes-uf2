<?php
require_once 'Item.php';
require_once 'persist/ItemArrayDao.php';
//require_once 'persist/ItemPdoDbDao.php';

/**
 * Service class to provide data.
 * @author ProvenSoft
 */
class ItemModel {
    
    /**
     * ADO class to get access to data souce.
     * @var ItemDaoInterface 
     */
    private  $dataSource;
 
    public function __construct() {
        $this->dataSource = ItemArrayDao::getInstance();
        //$this->dataSource = ItemPdoDbDao::getInstance(); 
    }

    /**
     * finds all items.
     * @return array list of items or empty array if none found.
     */
    public function searchAll() {
        $items = $this->dataSource->selectAll();
        return $items;
    }

    /**
     * find an item by id.
     * @param int $id id of item to find.
     * @return Item the found or null if not found.
     */
    public function searchItemById(int $id): ?Item {  //nullable return.
        $item = $this->dataSource->select(new Item($id, null, null));
        return $item;
    }
    
    /**
     * Adds a new item to datasource.
     * @param $item : the item to add to the datasource.
     * @return numAffected number of item added.
     */
    public function addItem(Item $item): int {
        $numAffected = 0;
        if ($item !== null) {
            $numAffected = $this->dataSource->insert($item);            
        }
        return $numAffected;
    }
    
    /**
     * Modifies an item in datasource.
     * @param Item $item : the item to modify in datasource.
     * @return numAffected number of item modified.
     */
    public function modifyItem(Item $item): int {
        $numAffected = 0;
        if ($item != null) {
            $numAffected = $this->dataSource->update($item);
        }
        return $numAffected;
    }

    /**
     * Removes an item in datasource.
     * @param Item $item : the item to remove in datasource.
     * @return numAffected number of item deleted.
     */
    public function removeItem(Item $item): int {
        $numAffected = 0;
        if ($item != null) {
            $numAffected = $this->dataSource->delete($item);
        }
        return $numAffected;
    }    
    
}
