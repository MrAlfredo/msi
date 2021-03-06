<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\InventoryCatalog\Model;

use Magento\InventoryCatalog\Api\DefaultSourceProviderInterface;

/**
 * Service returns Default Source Id
 */
class DefaultSourceProvider implements DefaultSourceProviderInterface
{
    /**
     * @inheritdoc
     */
    public function getId(): int
    {
        return 1;
    }
}
