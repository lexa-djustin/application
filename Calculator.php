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
        $result = [];

        $this->columnsToFloat(['d12']);
        $result['e12'] = $this->data['e12'] = $this->data['d12'] *= 1.02;
        $result['f12'] = $this->data['f12'] = $this->sumByHorizontal(12, 'd', 'e');

        $this->columnsToFloat(['d13']);
        $result['e13'] = $this->data['e13'] = $this->data['d13'] *= 1.02;
        $result['f13'] = $this->data['f13'] = $this->sumByHorizontal(13, 'd', 'e');

        $result['d14'] = $this->data['d14'] = $this->sumByVertical('d', 9, 12);
        $result['e14'] = $this->data['e14'] = $this->sumByVertical('e', 9, 12);
        $result['f14'] = $this->data['f14'] = $this->sumByVertical('f', 9, 12);

        $result['d29'] = $this->data['d29'] = $this->sumByColumns(['d16', 'd20', 'd24']);
        $result['e29'] = $this->data['e29'] = $this->sumByColumns(['e16', 'e20', 'e24']);
        $result['f29'] = $this->data['f29'] = $this->sumByColumns(['f16', 'f20', 'f24']);

        $this->columnsToFloat(['d33', 'e33', 'd34', 'e34']);
        $result['f33'] = $this->data['f33'] = $this->sumByHorizontal(33, 'd', 'e');
        $result['f34'] = $this->data['f34'] = $this->sumByHorizontal(34, 'd', 'e');

        $this->columnsToFloat(['d38', 'e38', 'd39', 'e39', 'd40', 'e40']);
        $result['f38'] = $this->data['f38'] = $this->sumByHorizontal(38, 'd', 'e');
        $result['f39'] = $this->data['f39'] = $this->sumByHorizontal(39, 'd', 'e');
        $result['f40'] = $this->data['f40'] = $this->sumByHorizontal(40, 'd', 'e');

        $result['d36'] = $this->data['d36'] = $this->sumByVertical('d', 31, 34);
        $result['e36'] = $this->data['e36'] = $this->sumByVertical('e', 31, 34);
        $result['f36'] = $this->data['f36'] = $this->sumByVertical('f', 31, 34);

        $d = $this->sumByVertical('d', 38, 41);
        $e = $this->sumByVertical('e', 38, 41);
        $f = $this->sumByVertical('f', 38, 41);
        $d += $this->sumByVertical('d', 46, 47);
        $e += $this->sumByVertical('e', 46, 47);
        $f += $this->sumByVertical('f', 46, 47);
        $result['d49'] = $this->data['d49'] = $d;
        $result['e49'] = $this->data['e49'] = $e;
        $result['f49'] = $this->data['f49'] = $f;

        $result['d59'] = $this->data['d59'] = $this->sumByVertical('d', 51, 57);
        $result['e59'] = $this->data['e59'] = $this->sumByVertical('e', 51, 57);
        $result['f59'] = $this->data['f59'] = $this->sumByVertical('f', 51, 51);

        $result['d59'] = $this->data['d59'] = $this->sumByVertical('d', 51, 57);
        $result['e59'] = $this->data['e59'] = $this->sumByVertical('e', 51, 57);
        $result['f59'] = $this->data['f59'] = $this->sumByVertical('f', 51, 51);

        $from = 61;
        $to = 65;

        for ($i = $from; $i <= $to; $i++) {
            $this->columnsToFloat(["d{$i}", "e{$i}"]);
            $this->data["f{$i}"] = $result["f{$i}"] = $this->sumByHorizontal($i, 'd', 'e');
        }

        $result['d67'] = $this->data['d67'] = $this->sumByVertical('d', 61, 65);
        $result['e67'] = $this->data['e67'] = $this->sumByVertical('e', 61, 65);
        $result['f67'] = $this->data['f67'] = $this->sumByVertical('f', 61, 65);

        $result['d68'] = $this->data['d68'] = $this->sumByColumns(['d67','d59', 'd49', 'd36', 'd29', 'd14']);
        $result['e68'] = $this->data['e68'] = $this->sumByColumns(['e67', 'e59', 'e49', 'e36', 'e29', 'e14']);
        $result['f68'] = $this->data['f68'] = $this->sumByColumns(['d68', 'e68']);

        $result['d70'] = $this->data['d70'] = $result['d68'];
        $result['e70'] = $this->data['e70'] = $result['e68'];
        $result['f70'] = $this->data['f70'] = $result['f68'];

        return $result;
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

            $value = (float) $this->data[$key];
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
            $key =  $letter . $rowNumber;

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

            $value = (float) $this->data[$column];
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

            $this->data[$column] = (float) $this->data[$column];
        }
    }
}