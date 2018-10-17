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
        $this->data['d14'] = $this->sumByCoordinates('d9', 'd12');

        return $this->data;
    }

    /**
     * @param string $from
     * @param string $to
     * @return int|mixed
     *
     * @throws Exception
     */
    private function sumByCoordinates($from, $to)
    {
        $min = preg_replace('/\D/', '', $from);
        $max = preg_replace('/\D/', '', $to);
        $letter = $from[0];
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
}