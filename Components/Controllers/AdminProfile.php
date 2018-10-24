<?php

namespace Components\Controllers;

use Components\CalculatorDao;
use Components\EXCELBuilder;

class AdminProfile extends ControllerAbstract
{
    /**
     * @var array
     */
    protected $roles = ['admin'];

    /**
     * @var string
     */
    protected $layoutScript = 'templates/admin-layout';

    /**
     * @return string
     *
     * @throws \Exception
     */
    public function execute()
    {
        $dao = new CalculatorDao();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $files = [];

            if (!empty($_POST['ids'])) {
                $ids = array_map(function ($id) {
                    return (int) $id;
                }, $_POST['ids']);

                $forms = $dao->fetchByIds($ids);

                $zip = new \ZipArchive();
                $files[] = $zipFile = BASE_PATH . 'data' . DIRECTORY_SEPARATOR . time() . '.zip';

                if ($zip->open($zipFile, \ZipArchive::CREATE) !== true) {
                    exit("Cannot open <$zipFile>\n");
                }

                foreach ($forms as $form) {
                    $xmlBuilder = new EXCELBuilder(json_decode($form['data'], true));
                    $date = $form['date_edited'] ? $form['date_edited'] : $form['date_added'];
                    $date = date('Y-m-d_H-i-s', strtotime($date));
                    $fileName = sprintf('%s_%s', $date, $form['id']);
                    $files[] = $fileName = $xmlBuilder->toFile($fileName);
                    $parts = explode(DIRECTORY_SEPARATOR, $fileName);

                    $zip->addFile($fileName, $parts[count($parts) - 1]);
                }

                register_shutdown_function(function () use ($files) {
                    foreach ($files as $file) {
                        if (file_exists($file)) {
                            unlink($file);
                        }
                    }
                });

                $zip->close();

                header('Content-Type: application/zip');
                header('Content-Length: ' . filesize($zipFile));
                $name = time();
                header('Content-Disposition: attachment; filename="' . $name . '.zip"');
                echo file_get_contents($zipFile);
                exit();
            }
        }

        $forms = $dao->fetchAllSubmittedForms();

        $render = new \Renderer('templates/admin-profile', null, ['forms' => $forms]);
        return $this->layout($render->render());
    }
}