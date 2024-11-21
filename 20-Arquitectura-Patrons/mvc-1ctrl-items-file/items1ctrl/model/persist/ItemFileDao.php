<?php

class ItemFileDao implements ItemDaoInterface {

    private string $filePath;

    public function __construct(string $filePath) {
        $this->filePath = $filePath;
    }

    #[\Override]
    public function selectAll(): array {
        $items = [];
        if (!file_exists($this->filePath)) {
           return $items;
        }

        $lines = file($this->filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $items[] = $this->fromLineToItem($line);
        }

        return $items;
    }

    #[\Override]
    public function select(Item $item): Item|null {
        if (!file_exists($this->filePath)) {
            return null;
        }

        $handle = fopen($this->filePath, "r"); // Obrim el fitxer en mode lectura
        if ($handle === false) {
            throw new RuntimeException("Cannot open file: {$this->filePath}");
        }

        while (($line = fgets($handle)) !== false) { // Llegim línia per línia
       
            $currentItem = $this->fromLineToItem($line); // Convertim la línia en un ítem
            if ($currentItem->getId() === $item->getId()) { // Comprovem si l'id coincideix
                fclose($handle); // Tanquem el fitxer
                return $currentItem; // Retornem l'ítem trobat
            }
        }

        fclose($handle); // Tanquem el fitxer si no es troba res
        return null; // Retornem null si l'ítem no es troba
    }

    #[\Override]
    public function insert(Item $item): int {
       
        return 0; // Retornem 0 per indicar que s'ha inserit un registre
    }

    #[\Override]
    public function update(Item $item): int {
       

        return 0; // Retornem 1 si s'ha actualitzat, 0 si no s'ha trobat l'ítem
    }

    #[\Override]
    public function delete(Item $item): int {
     
        return 0;
    }

    /**
     * Converts a line of text into an Item object.
     * This function takes a CSV-formatted line of text (comma-separated),
     * parses it, and creates an `Item` object with the corresponding values.
     *
     * Expected line format:
     *   ID,Name,Description
     *
     * @param string $line The CSV-formatted line representing an item.
     * @return Item Returns an `Item` object with the parsed data.
     * @throws InvalidArgumentException If the line does not match the expected format.
     */
    private function fromLineToItem(string $line): Item {
        $data = str_getcsv($line); // Splits the line into fields separated by commas

        if (count($data) !== 3) {
            throw new InvalidArgumentException("The line does not match the expected format: $line");
        }

        return new Item((int) $data[0], $data[1], $data[2]);
    }

    /**
     * Converts an Item object to a CSV-formatted line.
     *
     * This function takes an `Item` object and creates a string representation
     * in the CSV format: "ID,Name,Description".
     *
     * @param Item $item The `Item` object to convert.
     * @return string The CSV-formatted line representing the item.
     */
    private function fromItemToLine(Item $item): string {
        return "{$item->getId()},{$item->getTitle()},{$item->getContent()}" . PHP_EOL;
    }
}
