<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Inventory\Controller\Adminhtml\Stock;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Inventory\Ui\Component\MassAction\Filter;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\InventoryApi\Api\StockRepositoryInterface;

/**
 * MassDelete Controller
 */
class MassDelete extends Action
{
    /**
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Magento_Inventory::stock';

    /**
     * @var StockRepositoryInterface
     */
    private $stockRepository;

    /**
     * @var Filter
     */
    private $massActionFilter;

    /**
     * @param Context $context
     * @param StockRepositoryInterface $stockRepository
     * @param Filter $massActionFilter
     */
    public function __construct(
        Context $context,
        StockRepositoryInterface $stockRepository,
        Filter $massActionFilter
    ) {
        parent::__construct($context);
        $this->stockRepository = $stockRepository;
        $this->massActionFilter = $massActionFilter;
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        if ($this->getRequest()->isPost() !== true) {
            $this->messageManager->addErrorMessage(__('Wrong request.'));
            return $this->resultRedirectFactory->create()->setPath('*/*');
        }

        $deletedItemsCount = 0;
        foreach ($this->massActionFilter->getIds() as $id) {
            try {
                $this->stockRepository->deleteById($id);
                $deletedItemsCount++;
            } catch (CouldNotDeleteException $e) {
                $errorMessage = __('[ID: %1] ', $id) . $e->getMessage();
                $this->messageManager->addErrorMessage($errorMessage);
            }
        }
        $this->messageManager->addSuccessMessage(__('You deleted %1 Stock(s).', $deletedItemsCount));

        return $this->resultRedirectFactory->create()->setPath('*/*');
    }
}
