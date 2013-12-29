<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\GalleryBundle\Behat\Context;

use Behat\Behat\Context\BehatContext;

class FeatureContext extends BehatContext
{
    public function __construct(array $parameters)
    {
        $this->useContext('data', new DataContext());
        $this->useContext('web-user', new WebUserContext());
    }
}