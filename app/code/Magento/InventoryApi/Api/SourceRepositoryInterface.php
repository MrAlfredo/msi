<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\InventoryApi\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\InventoryApi\Api\Data\SourceInterface;
use Magento\InventoryApi\Api\Data\SourceSearchResultsInterface;

/**
 * In Magento 2 Repository considered as an implementation of Facade pattern which provides a simplified interface
 * to a larger body of code responsible for Domain Entity management
 *
 * The main intention is to make API more readable and reduce dependencies of business logic code on the inner workings
 * of a module, since most code uses the facade, thus allowing more flexibility in developing the system
 *
 * Along with this such approach helps to segregate two responsibilities:
 * 1. Repository now could be considered as an API - Interface for usage (calling) in the business logic
 * 2. Separate class-commands to which Repository proxies initial call (like, Get Save GetList Delete) could be
 *    considered as SPI - Interfaces that you should extend and implement to customize current behaviour
 *
 * There is no delete method. It is related to that Source can't be deleted due to we don't want miss data
 * related to Sources (like as order information). But Source can be disabled
 *
 * Used fully qualified namespaces in annotations for proper work of WebApi request parser
 *
 * @api
 */
interface SourceRepositoryInterface
{
    /**
     * Save Source data
     *
     * @param \Magento\InventoryApi\Api\Data\SourceInterface $source
     * @return int
     * @throws \Magento\Framework\Validation\ValidationException
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(SourceInterface $source): int;

    /**
     * Get Source data by given sourceId. If you want to create plugin on get method, also you need to create separate
     * plugin on getList method, because entity loading way is different for these methods
     *
     * @param int $sourceId
     * @return \Magento\InventoryApi\Api\Data\SourceInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get(int $sourceId): SourceInterface;

    /**
     * Find Sources by SearchCriteria
     * SearchCriteria is not required because load all stocks is useful case
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface|null $searchCriteria
     * @return \Magento\InventoryApi\Api\Data\SourceSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria = null): SourceSearchResultsInterface;
}
