<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\InventoryCatalog\Api;

/**
 * Service returns Default Source Id
 *
 * @api
 */
interface DefaultSourceProviderInterface
{
    /**
     * Get Default Source id
     *
     * @return int
     */
    public function getId(): int;
}
