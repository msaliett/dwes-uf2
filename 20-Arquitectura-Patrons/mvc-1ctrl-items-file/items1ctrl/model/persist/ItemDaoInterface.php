<?php
require_once 'model/Item.php';

/**
 * Item persistence class.
 * @author ProvenSoft
 */
interface ItemDaoInterface {
    
    /**
     * retrieves all items from data source.
     * @return Item[]
     */
    public function selectAll(): array;
    
    /**
     * looks for an item in data source
     * @param Item $item item to search
     * @return Item item found or null if not found.
     */
    public function select(Item $item): Item|null;
    
    /**
     * inserts an item into data source
     * @param Item $item item to insert to data source.
     * @return int number of entries inserted.
     */
    public function insert(Item $item): int;
    
    /**
     * updates an item in data source
     * @param Item $item item to update in data source.
     * @return int number of entries updated.
     */
    public function update(Item $item): int;    
    
    /**
     * deletes an item from data source
     * @param Item $item ityem to delete from data source.
     * @return int number of entries deleted.
     */
    public function delete(Item $item): int;
    
}