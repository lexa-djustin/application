<?php

namespace Components;

class EXCELBuilder
{
    /**
     * @var string
     */
    private $ext = 'xlsx';

    /**
     * @var array $data
     */
    private $data;

    /**
     * @var string
     */
    private $dir = 'data';

    /**
     * @var $_PHPExcel
     */
    private $PHPExcel;

    /**
     * @var string $fileType
     */
    private $fileType;

    public function getFileType()
    {
        if (!$this->fileType) {
            return $this->fileType = \PHPExcel_IOFactory::identify($this->pathToFile);
        }

        return $this->fileType;
    }

    /**
     * @var string
     */
    private $pathToFile = 'templates/xls/default.xlsx';


    /**
     * XMLBuilder constructor
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->_data = $data;
    }

    /**
     * Write to output
     */
    public function toStream()
    {
        $this->openFile();
        $this->updateFile();
        $this->stream();
    }

    /**
     * @param string $name
     *
     * @return string
     * @throws \PHPExcel_Reader_Exception
     * @throws \PHPExcel_Writer_Exception
     */
    public function toFile($name)
    {
        $this->openFile();
        $this->updateFile();
        return $this->file($name);
    }

    /**
     * Open XML template file
     *
     * @throws \PHPExcel_Reader_Exception
     */
    private function openFile()
    {
        $objReader = \PHPExcel_IOFactory::createReader($this->getFileType());
        $this->PHPExcel = $objReader->load($this->pathToFile);
    }

    /**
     * Update template file
     */
    private function updateFile()
    {
        foreach ($this->_data as $name => $value) {
            $this->PHPExcel->setActiveSheetIndex(0)->setCellValue($name, $value);
        }
    }

    /**
     * Generate stream filename
     *
     * @return string
     */
    private function generateStreamFileName()
    {
        return uniqid() . '.' . $this->ext;
    }

    /**
     * Send update file to stream
     *
     * @throws \PHPExcel_Reader_Exception
     * @throws \PHPExcel_Writer_Exception
     */
    private function stream()
    {
        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');

        // It will be called file.xls
        header("Content-Disposition: attachment; filename=" . $this->generateStreamFileName());

        // Write file to the browser
        $objWriter = \PHPExcel_IOFactory::createWriter($this->PHPExcel, $this->getFileType());
        $objWriter->save('php://output');
        exit();
    }

    /**
     * Save to file
     *
     * @param string $name
     *
     * @return string
     * @throws \PHPExcel_Reader_Exception
     * @throws \PHPExcel_Writer_Exception
     */
    private function file($name)
    {
        $path = sprintf('%s.%s', BASE_PATH . $this->dir . DIRECTORY_SEPARATOR . $name, $this->ext);

        $objWriter = new \PHPExcel_Writer_Excel2007($this->PHPExcel);
        $objWriter->save($path);

        return $path;
    }
}