<?php

class Includes
{

    public static function custom_include($filepath, $variable = array(), $print = true)
    {
        $output = null;
        if (file_exists($filepath)) {
            extract($variable);

            ob_start();

            include $filepath;

            $output = ob_get_clean();
        }

        if ($print) {
            print $output;
        }
        return $output;
    }
}
