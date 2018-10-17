<?php

class Renderer
{
    /**
     * @var array
     */
    private $__data;

    /**
     * @var string
     */
    private $script;

    /**
     * @var Renderer|null
     */
    protected $parent;

    /**
     * @var string
     */
    private $ext = 'phtml';

    /**
     * Renderer constructor.
     *
     * @param string $script
     * @param Renderer|null $parent
     * @param array $data
     */
    public function __construct($script, $parent = null, $data = [])
    {
        $this->script = $script;
        $this->parent = $parent;
        $this->__data = $data;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function render()
    {
        ob_start();
        $script = sprintf('%s.%s', $this->script, $this->ext);

        if (!file_exists($script)) {
            throw new Exception(sprintf(
                'File with name "%s" was not found'
            ));
        }

        require $script;

        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    /**
     * @param string $script
     * @param Renderer|null $parent
     * @param array $params
     *
     * @return Renderer
     * @throws Exception
     */
    public static function factory($script, $parent = null, $params = [])
    {
        return new self($script, $parent, $params);
    }

    /**
     * @param $name
     *
     * @return mixed|null
     */
    public function __get($name)
    {
        if (!array_key_exists($name, $this->__data)) {
            if ($this->parent) {
                return $this->parent->{$name};
            }

            return null;
        }

        return $this->__data[$name];
    }
}