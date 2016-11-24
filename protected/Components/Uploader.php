<?php

namespace App\Components;

class Uploader
{
    protected $fieldFormName = '';
    protected $pathUpload =  __DIR__ . '/../Layouts/assets';

    public function __construct(string $fieldFormName = 'file')
    {
        $this->fieldFormName = $fieldFormName;
    }

    public function isUploaded():bool
    {
        return isset($_FILES[$this->fieldFormName]) && 0 == $_FILES[$this->fieldFormName]['error'];
    }

    public function upload():bool
    {
        if ($this->isUploaded()) {
            move_uploaded_file($_FILES[$this->fieldFormName]['tmp_name'], $this->pathUpload . $_FILES[$this->fieldFormName]['name']);
            return true;
        }
        return false;
    }

    public function getFileName()
    {
        return $this->isUploaded() ? $_FILES[$this->fieldFormName]['name'] : '';
    }

    public function setPathUpload(string $path)
    {
        $this->pathUpload = $path;
        return $this;
    }
}