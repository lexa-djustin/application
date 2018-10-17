<?php

class HTMLElements
{
    public static function input($name = '', $value = '', array $attributes = [])
    {
        return
            '<div class="form-group">
                <input class="form-control" type="text" name="text">
            </div>';
    }
}