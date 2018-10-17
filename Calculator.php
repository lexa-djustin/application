<?php

class Calculator
{
    /**
     * @var array
     */
    private $data;

    /**
     * Calculator constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function calculate()
    {
        return [];
    }
}