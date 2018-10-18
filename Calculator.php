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

        $this->columnsToFloat(["d9", "e9", "d10", "e10", "d11", "e11", "d12", "e12"]);
        $result['f9'] = $this->data['f9'] = $this->sumByHorizontal(9, 'd', 'e');
        $result['f10'] = $this->data['f10'] = $this->sumByHorizontal(10, 'd', 'e');
        $result['f11'] = $this->data['f11'] = $this->sumByHorizontal(11, 'd', 'e');
        $result['f12'] = $this->data['f12'] = $this->sumByHorizontal(12, 'd', 'e');

        $result['d14'] = $this->data['d14'] = $this->sumByVertical('d', 9, 12);
        $result['e14'] = $this->data['e14'] = $this->sumByVertical('e', 9, 12);
        $result['f14'] = $this->data['f14'] = $this->sumByVertical('f', 9, 12);

        $this->columnsToFloat(["d17", "e17", "d18", "e18", "d19", "e19"]);
        $result['f17'] = $this->data['f17'] = $this->sumByHorizontal(17, 'd', 'e');
        $result['f18'] = $this->data['f18'] = $this->sumByHorizontal(18, 'd', 'e');
        $result['f19'] = $this->data['f19'] = $this->sumByHorizontal(19, 'd', 'e');
        $result['d20'] = $this->data['d20'] = $this->sumByVertical('d', 17, 19);
        $result['e20'] = $this->data['e20'] = $this->sumByVertical('e', 17, 19);
        $result['f20'] = $this->data['f20'] = $this->sumByHorizontal(20, 'd', 'e');

        $this->columnsToFloat(["d22", "e22", "d23", "e23", "d24", "e24"]);
        $result['f22'] = $this->data['f22'] = $this->sumByHorizontal(22, 'd', 'e');
        $result['f23'] = $this->data['f23'] = $this->sumByHorizontal(23, 'd', 'e');
        $result['f24'] = $this->data['f24'] = $this->sumByHorizontal(24, 'd', 'e');
        $result['d25'] = $this->data['d25'] = $this->sumByVertical('d', 22, 24);
        $result['e25'] = $this->data['e25'] = $this->sumByVertical('e', 22, 24);
        $result['f25'] = $this->data['f25'] = $this->sumByHorizontal(25, 'd', 'e');

        $this->columnsToFloat(["d27", "e27", "d28", "e28", "d29", "e29"]);
        $result['f27'] = $this->data['f27'] = $this->sumByHorizontal(27, 'd', 'e');
        $result['f28'] = $this->data['f28'] = $this->sumByHorizontal(28, 'd', 'e');
        $result['f29'] = $this->data['f29'] = $this->sumByHorizontal(29, 'd', 'e');
        $result['d30'] = $this->data['d30'] = $this->sumByVertical('d', 27, 29);
        $result['e30'] = $this->data['e30'] = $this->sumByVertical('e', 27, 29);
        $result['f30'] = $this->data['f30'] = $this->sumByHorizontal(30, 'd', 'e');

        $result['d32'] = $this->data['d32'] = $this->sumByColumns(['d20', 'd25', 'd30']);
        $result['e32'] = $this->data['e32'] = $this->sumByColumns(['e20', 'e25', 'e30']);
        $result['f32'] = $this->data['f32'] = $this->sumByColumns(['f20', 'f25', 'f30']);

        $this->columnsToFloat(["d34", "e34", "d35", "e35", "d36", "e36", "d37", "e37"]);
        $result['f34'] = $this->data['f34'] = $this->sumByHorizontal(34, 'd', 'e');
        $result['f35'] = $this->data['f35'] = $this->sumByHorizontal(35, 'd', 'e');
        $result['f36'] = $this->data['f36'] = $this->sumByHorizontal(36, 'd', 'e');
        $result['f37'] = $this->data['f37'] = $this->sumByHorizontal(37, 'd', 'e');

        $result['d39'] = $this->data['d39'] = $this->sumByVertical('d', 34, 37);
        $result['e39'] = $this->data['e39'] = $this->sumByVertical('e', 34, 37);
        $result['f39'] = $this->data['f39'] = $this->sumByVertical('f', 34, 37);

        return $result;

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

        $result['d68'] = $this->data['d68'] = $this->sumByColumns(['d67', 'd59', 'd49', 'd36', 'd29', 'd14']);
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
     * @return array
     * @throws Exception
     */
    private function category0()
    {
        $result = [];
        $current = 9;
        $max = 12;

        while ($current <= $max) {
            $key = "f{$current}";
            $this->columnsToFloat(["d{$current}", "e{$current}"]);
            $result[$key] = $this->data[$key] = $this->sumByHorizontal($current, 'd', 'e');
            $current++;
        }

        $result['d14'] = $this->data['d14'] = $this->sumByVertical('d', 9, 12);
        $result['e14'] = $this->data['e14'] = $this->sumByVertical('e', 9, 12);
        $result['f14'] = $this->data['f14'] = $this->sumByVertical('f', 9, 12);

        return $result;
    }

    private function category1()
    {
        $result = [];

        $this->columnsToFloat(["f17", "f18", "f19"]);
        $result['f17'] = $this->data['f17'] = $this->sumByHorizontal(17, 'd', 'e');
        $result['f18'] = $this->data['f18'] = $this->sumByHorizontal(18, 'd', 'e');
        $result['f19'] = $this->data['f19'] = $this->sumByHorizontal(19, 'd', 'e');

        $this->columnsToFloat(["f22", "f23", "f24"]);
        $result['f22'] = $this->data['f22'] = $this->sumByHorizontal(22, 'd', 'e');
        $result['f23'] = $this->data['f23'] = $this->sumByHorizontal(23, 'd', 'e');
        $result['f24'] = $this->data['f24'] = $this->sumByHorizontal(24, 'd', 'e');

        $this->columnsToFloat(["f27", "f28", "f29"]);
        $result['f27'] = $this->data['f27'] = $this->sumByHorizontal(27, 'd', 'e');
        $result['f28'] = $this->data['f28'] = $this->sumByHorizontal(28, 'd', 'e');
        $result['f29'] = $this->data['f29'] = $this->sumByHorizontal(29, 'd', 'e');

        return $result;
    }
}