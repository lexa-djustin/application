<?php

class HTMLElements
{
    /**
     * @param string $name
     * @param array $data
     * @param array $attributes
     *
     * @return string
     */
    public static function input($name = '', array $data, array $attributes = [])
    {
        $value = '';

        if (isset($data[$name])) {
            $value = $data[$name];
        }

        return
            '<div class="form-group">
                <input class="form-control" ' . self::prepareAttributes($attributes) . ' type="text" name="' . $name . '" value="' . $value . '">
            </div>';
    }

    /**
     * @param string $name
     *
     * @return int|float|null
     */
    public static function result($name, array $data = [])
    {
        if (isset($data[$name])) {
            return $data[$name];
        }

        return null;
    }

    /**
     * @param array $data
     *
     * @return string
     */
    public static function prepareAttributes(array $data)
    {
        $attributes = '';

        foreach ($data as $name => $value) {
            $attributes .= sprintf('%s="%s" ', $name, $value);
        }

        return trim($attributes);
    }
}