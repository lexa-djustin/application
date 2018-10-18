<?php

class Calculator
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var array
     */
    private $result = [];

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
        $this->result = [];

        $this->totalForRows(9, 12);
        $this->totalForColumns(14, 9, 12);

        $this->totalForRows(17, 19);
        $this->totalForColumns(14, 9, 12);

        $this->result['d20'] = $this->data['d20'] = $this->sumByVertical('d', 17, 19);
        $this->result['e20'] = $this->data['e20'] = $this->sumByVertical('e', 17, 19);
        $this->result['f20'] = $this->data['f20'] = $this->sumByHorizontal(20, 'd', 'e');

        $this->totalForRows(22, 24);
        $this->result['d25'] = $this->data['d25'] = $this->sumByVertical('d', 22, 24);
        $this->result['e25'] = $this->data['e25'] = $this->sumByVertical('e', 22, 24);
        $this->result['f25'] = $this->data['f25'] = $this->sumByHorizontal(25, 'd', 'e');

        $this->totalForRows(27, 29);
        $this->result['d30'] = $this->data['d30'] = $this->sumByVertical('d', 27, 29);
        $this->result['e30'] = $this->data['e30'] = $this->sumByVertical('e', 27, 29);
        $this->result['f30'] = $this->data['f30'] = $this->sumByHorizontal(30, 'd', 'e');

        $this->result['d32'] = $this->data['d32'] = $this->sumByColumns(['d20', 'd25', 'd30']);
        $this->result['e32'] = $this->data['e32'] = $this->sumByColumns(['e20', 'e25', 'e30']);
        $this->result['f32'] = $this->data['f32'] = $this->sumByColumns(['f20', 'f25', 'f30']);

        $this->totalForRows(34, 37);
        $this->totalForColumns(39, 34, 37);

        $this->totalForRows(41, 43);
        $this->totalForRows(45, 50);
        $d = $this->sumByVertical('d', 41, 43);
        $e = $this->sumByVertical('e', 41, 43);
        $f = $this->sumByVertical('f', 41, 43);
        $this->result['d52'] = $this->data['d52'] = $d + $this->sumByVertical('d', 45, 50);
        $this->result['e52'] = $this->data['e52'] = $e + $this->sumByVertical('e', 45, 50);
        $this->result['f52'] = $this->data['f52'] = $f + $this->sumByVertical('f', 45, 50);

        $this->totalForRows(54, 60);
        $this->totalForColumns(62, 54, 60);

        $this->totalForRows(64, 68);
        $this->totalForColumns(70, 64, 68);

        $this->result['d72'] = $this->data['d72'] = $this->sumByColumns(['d70', 'd62', 'd52', 'd39', 'd39', 'd14']);
        $this->result['e72'] = $this->data['e72'] = $this->sumByColumns(['e70', 'e62', 'e52', 'e39', 'e39', 'e14']);
        $this->result['f72'] = $this->data['f72'] = $this->result['d72'] + $this->result['e72'];

        return $this->result;
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

            $value = (float)$this->data[$key];
            $sum += $value;
        }

        return $sum;
    }

    /**
     * @param int $rowNumber
     * @param string $minLetter
     * @param string $maxLetter
     *
     * @return int|float
     *
     * @throws Exception
     */
    private function sumByHorizontal($rowNumber, $minLetter, $maxLetter)
    {
        $sum = 0;

        for ($letter = $minLetter; $letter <= $maxLetter; $letter++) {
            $key = $letter . $rowNumber;

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
    private function sumByColumns(array $columns)
    {
        $sum = 0;

        foreach ($columns as $column) {
            if (!array_key_exists($column, $this->data)) {
                throw new Exception(sprintf('Key with name "%s" was not found', $column));
            }

            $value = (float)$this->data[$column];
            $sum += $value;
        }

        return $sum;
    }

    /**
     * @param array $columns
     *
     * @throws Exception
     */
    private function columnsToFloat($columns)
    {
        foreach ($columns as $column) {
            if (!array_key_exists($column, $this->data)) {
                throw new Exception(sprintf('Key with name "%s" was not found', $column));
            }

            $this->data[$column] = (float)$this->data[$column];
        }
    }

    /**
     * @param int $rowMin
     * @param int $rowMax
     *
     * @throws Exception
     */
    private function totalForRows($rowMin, $rowMax)
    {
        $current = $rowMin;

        while ($current <= $rowMax) {
            $d = "d{$current}";
            $e = "e{$current}";
            $resultCeil = "f{$current}";

            $this->columnsToFloat([$d, $e]);
            $this->result[$resultCeil] = $this->data[$resultCeil] =
                $this->sumByHorizontal($current, 'd', 'e');
            $current++;
        }
    }

    /**
     * @param int $resultRowNum
     * @param int $rowMin
     * @param int $rowMax
     *
     * @throws Exception
     */
    private function totalForColumns($resultRowNum, $rowMin, $rowMax)
    {
        $d = "d{$resultRowNum}";
        $e = "e{$resultRowNum}";
        $f = "f{$resultRowNum}";

        $this->result[$d] = $this->data[$d] = $this->sumByVertical('d', $rowMin, $rowMax);
        $this->result[$e] = $this->data[$e] = $this->sumByVertical('e', $rowMin, $rowMax);
        $this->result[$f] = $this->data[$f] = $this->sumByVertical('f', $rowMin, $rowMax);
    }

}