<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */
declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\Respect\Validation\Rules;

use _PhpScoper6af4d594edb1\Respect\Validation\Helpers\DomainInfo;
use function array_pop;
use function explode;
final class PublicDomainSuffix extends AbstractSearcher
{
    /**
     * @var string[]
     */
    private $domainInfo;
    /**
     * {@inheritDoc}
     */
    protected function getDataSource($input = null) : array
    {
        $parts = explode('.', $input);
        $tld = array_pop($parts);
        $domainInfo = new DomainInfo($tld);
        $this->domainInfo = $domainInfo->getPublicSuffixes();
        return $this->domainInfo;
    }
}
