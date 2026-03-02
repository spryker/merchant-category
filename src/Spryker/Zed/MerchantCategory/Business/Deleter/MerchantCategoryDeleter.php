<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantCategory\Business\Deleter;

use Generated\Shared\Transfer\MerchantCategoryCriteriaTransfer;
use Spryker\Zed\MerchantCategory\Persistence\MerchantCategoryEntityManagerInterface;

class MerchantCategoryDeleter implements MerchantCategoryDeleterInterface
{
    /**
     * @var \Spryker\Zed\MerchantCategory\Persistence\MerchantCategoryEntityManagerInterface
     */
    protected $entityManager;

    public function __construct(
        MerchantCategoryEntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function delete(MerchantCategoryCriteriaTransfer $merchantCategoryCriteriaTransfer): void
    {
        $merchantCategoryCriteriaTransfer->requireCategoryIds();

        $this->entityManager->delete($merchantCategoryCriteriaTransfer);
    }
}
