<?php

function array_clean(array $haystack, array $values)
{
    foreach ($haystack as $key => $value) {
        if (is_array($value)) {
            $haystack[$key] = array_clean($haystack[$key], $values);
        }
        if (in_array($haystack[$key], $values, true)) {
            unset($haystack[$key]);
        }
    }
    return $haystack;
}
