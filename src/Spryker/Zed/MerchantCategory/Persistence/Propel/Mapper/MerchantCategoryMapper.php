<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantCategory\Persistence\Propel\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\CategoryLocalizedAttributesTransfer;
use Generated\Shared\Transfer\CategoryTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategory;

class MerchantCategoryMapper
{
    /**
     * @param \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategory $merchantCategoryEntity
     * @param \Generated\Shared\Transfer\CategoryTransfer $categoryTransfer
     *
     * @return \Generated\Shared\Transfer\CategoryTransfer
     */
    public function mapMerchantCategoryEntityToCategoryTransfer(
        SpyMerchantCategory $merchantCategoryEntity,
        CategoryTransfer $categoryTransfer
    ): CategoryTransfer {
        $categoryEntity = $merchantCategoryEntity->getSpyCategory();

        $categoryTransfer->fromArray($categoryEntity->toArray(), true);

        $categoryLocalizedAttributesTransfers = [];

        foreach ($categoryEntity->getAttributes() as $categoryAttributeEntity) {
            $categoryLocalizedAttributesTransfers[] = (new CategoryLocalizedAttributesTransfer())
                ->fromArray($categoryAttributeEntity->toArray(), true)
                ->setLocale(
                    (new LocaleTransfer())->fromArray($categoryAttributeEntity->getLocale()->toArray(), true)
                );
        }

        return $categoryTransfer->setLocalizedAttributes(new ArrayObject($categoryLocalizedAttributesTransfers));
    }
}
