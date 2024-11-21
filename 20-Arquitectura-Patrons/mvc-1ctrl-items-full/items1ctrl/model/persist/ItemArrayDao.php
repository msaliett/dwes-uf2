<?php
require_once 'ItemDaoInterface.php';

/**
 * Item persistence class.
 * It implements a version of singleton pattern with session storage.
 * @author ProvenSoft
 */
class ItemArrayDao implements ItemDaoInterface {
    
    private static ?self $instance = null;
    public array $data;
    private int $lastId = 0;
 
    private function __construct() {
        //create test data.
        $this->data = array();
        $this->lastId = 0;
        $this->setUpData();
    }
 
    /**
     * Singleton implementation of item DAO.
     * perfoms persistance in session.
     * @return ArrayItemDao the single instance of this object.
     */
    public static function getInstance(): self {
        //create instance and test data only if not stored in session yet.
        if (isset($_SESSION['itemDao'])) {
             self::$instance = unserialize($_SESSION['itemDao']);
        } else {
            self::$instance = new self();
            $_SESSION['itemDao'] = serialize(self::$instance);
        }

        return self::$instance;
    }

    public function getData(): array {
        return $this->data;
    }
    
    /**
     * retrieves all items from data source.
     * @return Item[]
     */
    public function selectAll(): array {
        return $this->data;
    }
    
    /**
     * looks for an item in data source
     * @param Item $item item to search
     * @return Item item found or null if not found.
     */
    public function select(Item $item): Item|null {
        $found = null;
        foreach ($this->data as $it) {
            if ($it->getId()==$item->getId()) {
                $found = $it;
                break;
            }
        }
        return $found;
    }
    
    /**
     * looks for items with the given title
     * @param string $title the title to search
     * @return array an array with result
     */
    public function selectWhereTitle(string $title): array {
        $found = array();
        foreach ($this->data as $item) {
            if (str_contains($item->getTitle(),$title)) {
                array_push($found, $item);
            }
        }        
        return $found;
    }
    
    /**
     * inserts an item into data source
     * @param Item $item item to insert to data source.
     * @return int number of entries inserted.
     */
    public function insert(Item $item): int {
        $affected = 0;   //counter of changes in data source, initially zero.
        //TODO prevent id duplicates.
        $this->lastId++;
        $item->setId($this->lastId);
        array_push($this->data, $item);
        $affected = 1;
        $_SESSION['itemDao'] = serialize(self::$instance);
        return $affected;
    }
    
    /**
     * updates an item in data source
     * @param Item $item item to update in data source.
     * @return int number of entries updated.
     */
    public function update(Item $item): int {
        $affected = 0;   //counter of changes in data source, initially zero.
        $index = $this->indexOf($item);
        if ($index >= 0) {
            $this->data[$index] = $item;
            $affected = 1;
            $_SESSION['itemDao'] = serialize(self::$instance);
            
        } else {
            $affected = 0;
        }
        return $affected;
    }    
    
    /**
     * deletes an item from data source
     * @param Item $item ityem to delete from data source.
     * @return int number of entries deleted.
     */
    public function delete(Item $item): int {
        $affected = 0;   //counter of changes in data source, initially zero.
        $index = $this->indexOf($item);
        if ($index >= 0) {
            array_splice($this->data, $index, 1);
            $affected = 1;
            $_SESSION['itemDao'] = serialize(self::$instance);
           
        } else {
            $affected = 0;
        }
        return $affected;        
    }
    
    /**
     * looks for an item in data source
     * @param Item $item item to search
     * @return int position of item found or -1 if not found
     */
    public function indexOf(Item $item): int {
        $found = -1;
        for ($i=0; $i< count($this->data); $i++) {
            $x = $this->data[$i]->getId();
            $y = $item->getId();
            if ($x === $y) {
                $found = $i;
                break;
            }      
        }
        return $found;
    }  
    
    public function deleteAll(): void {
        unset($this->data);
        $this->data = array();
        $this_>$this->lastId = 0;
    }
    
  
    
    public function setUpData(): void {
        $this->data = array();
        array_push($this->data, new Item(1, 'Item 1', 'Content 1')); $this->lastId++;
        array_push($this->data, new Item(2, 'Item 2', 'Content 2')); $this->lastId++;
        array_push($this->data, new Item(3, 'Item 3', 'Content 3')); $this->lastId++;
        array_push($this->data, new Item(4, 'Item 4', 'Content 4')); $this->lastId++;
        array_push($this->data, new Item(5, 'Item 5', 'Content 5')); $this->lastId++;
        array_push($this->data, new Item(6, 'Item 6', 'Content 6')); $this->lastId++;
        array_push($this->data, new Item(7, 'Item 7', 'Content 7')); $this->lastId++;
        array_push($this->data, new Item(8, 'Item 8', 'Content 8')); $this->lastId++;
        array_push($this->data, new Item(9, 'Item 9', 'Content 9')); $this->lastId++;
    }
    
  }