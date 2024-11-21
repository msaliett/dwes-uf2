<?php   
/**
 * Item class definition.
 * @author ProvenSoft
 */
class Item {
    private ?int $id;
    private ?string $title;
    private ?string $content;
    
    public function __construct(int $id=null, string $title=null, string $content=null) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
    }
 
    public function getId(): ?int {
        return $this->id;
    }
    
    public function setId(?int $id) {
        $this->id = $id;
    }
    
    public function getTitle(): ?string {
        return $this->title;
    }    
    
    public function setTitle(?string $title) {
        $this->title = $title;
    }
    
    public function getContent(): ?string {
        return $this->content;
    }

    public function setContent(?string $content) {
        $this->content = $content;
    }

    public function __toString() {
        return "Item{[id=$this->id][title=$this->title][content=$this->content]}";
    }

      
}
