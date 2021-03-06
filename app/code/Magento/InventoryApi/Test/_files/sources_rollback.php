<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
use Magento\Framework\App\ResourceConnection;
use Magento\InventoryApi\Api\Data\SourceInterface;
use Magento\TestFramework\Helper\Bootstrap;

/** @var ResourceConnection $connection */
$connection = Bootstrap::getObjectManager()->get(ResourceConnection::class);
$connection->getConnection()->delete(
    $connection->getTableName('inventory_source'),
    [
        SourceInterface::SOURCE_ID . ' IN (?)' => [10, 20, 30, 40, 50],
    ]
);
