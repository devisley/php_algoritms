<?php
/**
 * Created by PhpStorm.
 * User: Ruslan
 * Date: 10.11.2018
 * Time: 15:45
 */

class Explorer extends FilterIterator
{
    private $currentPath;
    protected $ext = ["php", "txt", "js", "css"];

    public function __construct($path = __DIR__)
    {
        $this->currentPath = isset($_REQUEST['path']) ? $_REQUEST['path'] : $path;
        parent::__construct(new DirectoryIterator($this->currentPath));
    }

    public function accept() {
        return in_array($this->getExtension(), $this->ext) || $this->isDir();
    }

    public function render() {
        echo "<h2>Current path: {$this->currentPath}</h2>";
        $this->rewind();
        while($this->valid()) {
            $file = $this->current();
            $this->renderFile($file);
            $this->next();
        }
    }

    private function getPath($levels) {
        return dirname($this->currentPath, $levels);
    }

    private function renderFile($file) {
        if ($file->isFile()) {
            echo "<a href='file:///{$this->currentPath}\\{$file->getFilename()}'><img src='img/doc.png'>{$file->getFilename()}</a>" . "<br>";
        } else if ($file->getFilename() == '..'){
            echo "<a href='index.php?path={$this->getPath(1)}'><img src='img/dir.png'>{$file->getFilename()}</a>" . "<br>";
        } else {
            if ($file->getFilename() !== '.') {
                echo "<a href='index.php?path={$this->currentPath}\\{$file->getFilename()}'><img src='img/dir.png'>{$file->getFilename()}</a>" . "<br>";
            }
        }
    }
}



