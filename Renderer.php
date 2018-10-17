<?php

class Renderer
{
    /**
     * @var array
     */
    private $params;

    /**
     * @var string
     */
    private $script;

    /**
     * Renderer constructor.
     * @param string $script
     * @param array $params
     */
    public function __construct($script, $params = [])
    {
        $this->script = $script;
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function render()
    {
        ob_start();
        require($this->script);

        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    /**
     * @param $script
     * @param array $params
     *
     * @return string
     */
    public static function partial($script, $params = [])
    {
        return (new self($script, $params))->render();
    }
}