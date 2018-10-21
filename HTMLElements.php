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

        if (\Components\Registry::getInstance()->onlyRead === true) {
            $attributes['readonly'] = 'readonly';
        }

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
     * @param array $data
     * @param array $attributes
     *
     * @return string
     */
    public static function textarea($name = '', array $data, array $attributes = [])
    {
        $value = '';

        if (\Components\Registry::getInstance()->onlyRead === true) {
            $attributes['readonly'] = 'readonly';
        }

        if (isset($data[$name])) {
            $value = $data[$name];
        }

        return
            '<div class="form-group">
                <textarea class="form-control" ' . self::prepareAttributes($attributes) . ' type="text" name="' . $name . '">' . $value . '</textarea>
            </div>';
    }

    /**
     * @param string $name
     * @param array $data
     *
     * @return int|float|null
     */
    public static function result($name, array $data = [])
    {
        $result = '<span class="result" id="' . $name . '">';

        if (array_key_exists($name, $data)) {
            $result .= '<b>' . $data[$name] . '</b>';
        }

        $result .= '</span>';

        return $result;
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

    /**
     * @param string $name
     * @param array $labels
     *
     * @return string
     */
    public static function label($name, array $labels)
    {
        if (array_key_exists($name, $labels)) {
            return $labels[$name];
        }

        return $name;
    }
}