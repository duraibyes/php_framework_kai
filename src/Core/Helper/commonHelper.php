<?php

/**
 * Convenience function to stop execution and dump out variables.
 *
 * @param mixed ...$args One or more values to dump.
 *
 * @return never
 */
function ss(...$args)
{
    echo '<pre>';
    foreach ($args as $arg) {
        var_dump($arg);
        echo "\n";
    }
    echo '</pre>';
    exit;
}

/**
 * Convenience function to dump out variables with HTML formatting.
 *
 * @param mixed ...$args One or more values to dump.
 *
 * @return void
 */

function show(...$args)
{
    echo '<pre>';
    foreach ($args as $arg) {
        var_dump($arg);
        echo "\n";
    }
    echo '</pre>';
}

/**
 * Convenience function to dump out variables in a plain text format.
 *
 * @param mixed ...$args One or more values to dump.
 *
 * @return void
 */
function showPlain(...$args)
{
    echo '<pre>';
    foreach ($args as $arg) {
        print_r($arg);
        echo "\n";
    }
    echo '</pre>';
}
/**
 * Convenience alias for showPlain.
 *
 * @param mixed ...$args One or more values to show.
 *
 */

function sp(...$args)
{
    showPlain(...$args);
}
