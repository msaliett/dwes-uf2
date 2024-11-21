<?php

declare(strict_types=1);

class FilePersist {

    private string $filename;
    private ?string $mode;
    private $handler;

    public function __construct(string $filename) {
        $this->filename = $filename;
        $this->handler = false;
        $this->mode = null;
    }

    public function getHandler() {
        return $this->handler;
    }

    public function getMode(): string|null {
        return $this->mode;
    }

    public function isOpen(): bool {
        return ($this->handler) ? true : false;
    }
    /**
     * opens the file in given mode.
     * @param string $mode the mode to open the file.
     * @return int 1 i surccessful, 0 if already open, -1 if not open.
     */
    public function open(string $mode): int {
        $result = -1; // fail code (default).
        if ($this->isOpen()) {  //already open.
            $result = 0; // already open code.
        }
        $this->mode = $mode;
        if (file_exists($this->filename) && is_file($this->filename)) {
            $this->handler = fopen($this->filename, $this->mode);
            $result = ($this->handler) ? 1 : -1;  //open or not.
        }
        return $result;
    }

    /**
     * closes the file.
     * @return bool true if successful, false otherwise.
     */
    public function close(): bool {
        $success = false;
        $success = fclose($this->handler);
        if ($success) {
            $this->handler = null;
            $this->mode = null;
        }
        return $success;
    }

    /**
     * writes to the file an array, one line per array element.
     * @param array $data the data to be written to file.
     * @return int number or lines actually written.
     */
    public function writeFromArrayOfLines(array $data): int {
        $result = 0; // number of lines written.
        if ($this->isOpen()) {  // fail if file is closed.
            foreach ($data as $line) {
                $bytesWritten = fwrite($this->getHandler(), $line);
                fwrite($this->getHandler(), "\n");
                ($bytesWritten == false) ? $result : $result++;
            }
        }
        return $result;
    }

    /**
     * reads file line by line and builds an array with an element for each line.
     * @param bool $trim flag to trim or not the lines.
     * @return array an array with en element for each line in file.
     * @throws Exception if file not open.
     */
    public function readToArrayOfLines(bool $trim): array {
        $result = array();
        if ($this->isOpen()) {  // fail if file is closed.
            do {
                $line = fgets($this->getHandler());
                if ($line != false) {
                    if ($trim) {
                        $line = trim($line);
                    }
                    echo $line;
                    array_push($result, $line);
                }
            } while (!feof($this->handler));
        } else {
            throw new Exception("File not open");
        }
        return $result;
    }

}