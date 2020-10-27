<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantCategory\Persistence;

use Generated\Shared\Transfer\CategoryTransfer;
use Generated\Shared\Transfer\MerchantCategoryCriteriaTransfer;
use Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Spryker\Zed\MerchantCategory\Persistence\MerchantCategoryPersistenceFactory getFactory()
 */
class MerchantCategoryRepository extends AbstractRepository implements MerchantCategoryRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\MerchantCategoryCriteriaTransfer $merchantCategoryCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\CategoryTransfer[]
     */
    public function getCategories(MerchantCategoryCriteriaTransfer $merchantCategoryCriteriaTransfer): array
    {
        /**
         * @var \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery $merchantCategoryQuery
         */
        $merchantCategoryQuery = $this->getFactory()
            ->getMerchantCategoryPropelQuery()
            ->joinWithSpyCategory()
            ->useSpyCategoryQuery()
                ->leftJoinWithAttribute()
                ->useAttributeQuery()
                    ->leftJoinWithLocale()
                ->endUse()
            ->endUse();

        $merchantCategoryQuery = $this->applyFilters($merchantCategoryQuery, $merchantCategoryCriteriaTransfer);
        $merchantCategoryEntities = $merchantCategoryQuery->find();

        $categoryTransfers = [];

        foreach ($merchantCategoryEntities as $merchantCategoryEntity) {
            $categoryTransfers[] = $this->getFactory()
                ->createMerchantCategoryMapper()
                ->mapMerchantCategoryEntityToCategoryTransfer($merchantCategoryEntity, new CategoryTransfer());
        }

        return $categoryTransfers;
    }

    /**
     * @param \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery $merchantCategoryQuery
     * @param \Generated\Shared\Transfer\MerchantCategoryCriteriaTransfer $merchantCategoryCriteriaTransfer
     *
     * @return \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery
     */
    protected function applyFilters(
        SpyMerchantCategoryQuery $merchantCategoryQuery,
        MerchantCategoryCriteriaTransfer $merchantCategoryCriteriaTransfer
    ): SpyMerchantCategoryQuery {
        if ($merchantCategoryCriteriaTransfer->getIdMerchant()) {
            $merchantCategoryQuery->filterByFkMerchant($merchantCategoryCriteriaTransfer->getIdMerchant());
        }

        return $merchantCategoryQuery;
    }
}