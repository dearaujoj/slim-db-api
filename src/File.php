<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 30/07/2017
 * Time: 20:35
 */

namespace Core\Invoice;


class File
{
    /**
     * @var resource $fileMimeInfo
     */
    protected $fileMimeInfo;

    /**
     * @var filename $file
     */
    protected $file;

    /**
     * File constructor.
     * @param $fileInfo
     */
    public function __construct($file)
    {
        $this->file = $file;
        $this->initMimeFileInfo();
    }


    public function isPdfFile()
    {
        return finfo_file($this->fileMimeInfo, $this->file) === 'application/pdf' ? 'pdf' : false;
    }

    public function isZipFile()
    {
        return finfo_file($this->fileMimeInfo, $this->file) === 'application/zip'||
        finfo_file($this->fileMimeInfo, $this->file) === 'application/octet-stream'||
        finfo_file($this->fileMimeInfo, $this->file) === 'application/x-zip' ? 'zip' : false;
    }

    public function isValid()
    {
        return $this->isPdfFile() . $this->isZipFile();
    }

    public function initMimeFileInfo()
    {
        $this->fileMimeInfo = finfo_open(FILEINFO_MIME_TYPE);
    }

}