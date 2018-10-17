<?php

class EXCELBuilder
{
    /**
     * @var string
     */
    private $ext = 'xlsx';

    /**
     * @var array $data
     */
    private $_data;

    /**
     * @var $_PHPExcel
     */
    private $_PHPExcel;

    /**
     * @var string $fileType
     */
    private $fileType;

    public function getFileType()
    {
        if (!$this->fileType) {
            return $this->fileType = PHPExcel_IOFactory::identify($this->_pathToFile);
        }

        return $this->fileType;
    }

    /**
     * @var string
     */
    private $_pathToFile = 'templates/xls/default.xlsx';


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
     * Create new XML file
     */
    public function createFile()
    {
        $this->openFile();
        $this->updateFile();
        $this->stream();
    }

    /**
     * Open XML template file
     *
     * @return PHPExcel
     * @throws PHPExcel_Reader_Exception
     */
    private function openFile()
    {
        $objReader = PHPExcel_IOFactory::createReader($this->getFileType());
        $this->_PHPExcel = $objReader->load($this->_pathToFile);
    }

    /**
     * Update template file
     */
    private function updateFile()
    {
        $this->_PHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B1', 'Hello')
            ->setCellValue('B2', 'World!');
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
     * @throws PHPExcel_Reader_Exception
     * @throws PHPExcel_Writer_Exception
     */
    private function stream()
    {
        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');

        // It will be called file.xls
        header("Content-Disposition: attachment; filename=" . $this->generateStreamFileName());

        // Write file to the browser
        $objWriter = PHPExcel_IOFactory::createWriter($this->_PHPExcel, $this->getFileType());
        $objWriter->save('php://output');
        exit();
    }
}