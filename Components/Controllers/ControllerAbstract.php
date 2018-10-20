<?php

namespace Components\Controllers;

abstract class ControllerAbstract
{
    /**
     * @var array
     */
    protected $roles = [];

    /**
     * @var string
     */
    protected $layoutScript = 'templates/layout';

    /**
     * Set layout script
     */
    public function setLayoutScript($layoutScript) {
        $this->layoutScript = $layoutScript;
    }

    /**
     * @return bool
     */
    public function hasPermission()
    {
        if (!empty($this->roles)) {
            if (empty($_SESSION['id'])) {
                return false;
            }

            return in_array( $_SESSION['role'], $this->roles);
        }

        return true;
    }

    /**
     * @param string $content
     * @param array $params
     *
     * @return string
     * @throws \Exception
     */
    protected function layout($content, array $params = [])
    {
        if (array_key_exists('content', $params)) {
            throw new \Exception('Key with name "content" reserved.');
        }

        return \Renderer::factory($this->layoutScript, null, array_merge(
            ['content' => $content], $params
        ))->render();
    }

    /**
     * @return string
     */
    public abstract function execute();
}