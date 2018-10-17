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
     * @throws Exception
     */
    public function calculate()
    {
        $this->data['d14'] = $this->sumByVertical('d', 9, 12);
        $this->data['e14'] = $this->sumByVertical('e', 9, 12);
        $this->data['f14'] = $this->sumByVertical('f', 9, 12);

        $this->data['d29'] = $this->sumByColumns(['d16', 'd20', 'd24']);
        $this->data['e29'] = $this->sumByColumns(['e16', 'e20', 'e24']);
        $this->data['f29'] = $this->sumByColumns(['f16', 'f20', 'f24']);

        $this->data['d36'] = $this->sumByVertical('d', 31, 34);
        $this->data['e36'] = $this->sumByVertical('e', 31, 34);
        $this->data['f36'] = $this->sumByVertical('f', 31, 34);

        return $this->data;
    }

    /**
     * @param string $letter
     * @param int $min
     * @param int $max
     *
     * @return int|mixed
     *
     * @throws Exception
     */
    private function sumByVertical($letter, $min, $max)
    {
        $sum = 0;

        for ($i = $min; $i <= $max; $i++) {
            $key = $letter . $i;

            if (!array_key_exists($key, $this->data)) {
                throw new Exception(sprintf('Key with name "%s" was not found', $key));
            }

            $sum += $this->data[$key];
        }

        return $sum;
    }

    /**
     * @param array $columns
     *
     * @return int|mixed
     * @throws Exception
     */
    private function sumByColumns($columns)
    {
        $sum = 0;

        foreach ($columns as $column) {
            if (!array_key_exists($column, $this->data)) {
                throw new Exception(sprintf('Key with name "%s" was not found', $column));
            }

            $sum += $this->data[$column];
        }

        return $sum;
    }
}