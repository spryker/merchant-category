<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantCategory\Business\Reader;

use ArrayObject;
use Generated\Shared\Transfer\MerchantCategoryCriteriaTransfer;
use Generated\Shared\Transfer\MerchantCategoryResponseTransfer;
use Spryker\Zed\MerchantCategory\Persistence\MerchantCategoryRepositoryInterface;

class MerchantCategoryReader implements MerchantCategoryReaderInterface
{
    /**
     * @var \Spryker\Zed\MerchantCategory\Persistence\MerchantCategoryRepositoryInterface
     */
    protected $merchantCategoryRepository;

    public function __construct(MerchantCategoryRepositoryInterface $merchantCategoryRepository)
    {
        $this->merchantCategoryRepository = $merchantCategoryRepository;
    }

    public function get(MerchantCategoryCriteriaTransfer $merchantCategoryCriteriaTransfer): MerchantCategoryResponseTransfer
    {
        $merchantCategoryTransfers = $this->merchantCategoryRepository->get($merchantCategoryCriteriaTransfer);

        return (new MerchantCategoryResponseTransfer())
            ->setMerchantCategories(new ArrayObject($merchantCategoryTransfers))
            ->setIsSuccessful(true);
    }
}
