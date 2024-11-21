<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
include_once 'Item.php';
include_once 'persist/ItemDaoInterface.php';
include_once 'persist/ItemFileDao.php';


final class ItemFileDaoTest extends TestCase
{
    public function testSelectAllFileExist(): void
    {
        $expectedData[] = new Item(1,"title1","content of item 1");
        $expectedData[] = new Item(2,"title2","content of item 2");
        
        $source = new ItemFileDao("/home/roser/public_html/UF2/mvc-1ctrl-items/items1ctrl/data/items.txt");

        $items = $source->selectAll();

        $this->assertEquals($expectedData, $items);
       
    }

    
}



