<?php

namespace _PhpScoper6af4d594edb1\Safe;

use _PhpScoper6af4d594edb1\Safe\Exceptions\CalendarException;
/**
 * Return the Julian Day for a Unix timestamp
 * (seconds since 1.1.1970), or for the current day if no
 * timestamp is given. Either way, the time is regarded
 * as local time (not UTC).
 *
 * @param int $timestamp A unix timestamp to convert.
 * @return int A julian day number as integer.
 * @throws CalendarException
 *
 */
function unixtojd(int $timestamp = null) : int
{
    \error_clear_last();
    if ($timestamp !== null) {
        $safeResult = \unixtojd($timestamp);
    } else {
        $safeResult = \unixtojd();
    }
    if ($safeResult === \false) {
        throw CalendarException::createFromPhpError();
    }
    return $safeResult;
}
