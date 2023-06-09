<?php

namespace _PhpScoper6af4d594edb1\Safe;

use _PhpScoper6af4d594edb1\Safe\Exceptions\SolrException;
/**
 * This function returns the current version of the extension as a string.
 *
 * @return string It returns a string on success.
 * @throws SolrException
 *
 */
function solr_get_version() : string
{
    \error_clear_last();
    $safeResult = \solr_get_version();
    if ($safeResult === \false) {
        throw SolrException::createFromPhpError();
    }
    return $safeResult;
}
