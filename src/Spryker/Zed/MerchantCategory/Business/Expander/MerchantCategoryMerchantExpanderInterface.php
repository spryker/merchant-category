<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantCategory\Business\Expander;

use Generated\Shared\Transfer\MerchantCollectionTransfer;

interface MerchantCategoryMerchantExpanderInterface
{
    public function expand(MerchantCollectionTransfer $merchantCollectionTransfer): MerchantCollectionTransfer;
}
