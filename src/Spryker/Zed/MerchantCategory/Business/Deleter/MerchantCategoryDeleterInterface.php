<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantCategory\Business\Deleter;

use Generated\Shared\Transfer\MerchantCategoryCriteriaTransfer;

interface MerchantCategoryDeleterInterface
{
    public function delete(MerchantCategoryCriteriaTransfer $merchantCategoryCriteriaTransfer): void;
}
