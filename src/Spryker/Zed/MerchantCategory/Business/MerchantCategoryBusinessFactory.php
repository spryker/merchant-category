<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantCategory\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\MerchantCategory\Business\Deleter\MerchantCategoryDeleter;
use Spryker\Zed\MerchantCategory\Business\Deleter\MerchantCategoryDeleterInterface;
use Spryker\Zed\MerchantCategory\Business\Expander\MerchantCategoryMerchantExpander;
use Spryker\Zed\MerchantCategory\Business\Expander\MerchantCategoryMerchantExpanderInterface;
use Spryker\Zed\MerchantCategory\Business\Publisher\MerchantCategoryPublisher;
use Spryker\Zed\MerchantCategory\Business\Publisher\MerchantCategoryPublisherInterface;
use Spryker\Zed\MerchantCategory\Business\Reader\MerchantCategoryReader;
use Spryker\Zed\MerchantCategory\Business\Reader\MerchantCategoryReaderInterface;
use Spryker\Zed\MerchantCategory\Dependency\Facade\MerchantCategoryToEventBehaviorFacadeInterface;
use Spryker\Zed\MerchantCategory\Dependency\Facade\MerchantCategoryToEventFacadeInterface;
use Spryker\Zed\MerchantCategory\MerchantCategoryDependencyProvider;

/**
 * @method \Spryker\Zed\MerchantCategory\Persistence\MerchantCategoryRepositoryInterface getRepository()
 * @method \Spryker\Zed\MerchantCategory\MerchantCategoryConfig getConfig()
 * @method \Spryker\Zed\MerchantCategory\Persistence\MerchantCategoryEntityManagerInterface getEntityManager()
 */
class MerchantCategoryBusinessFactory extends AbstractBusinessFactory
{
    public function createMerchantCategoryReader(): MerchantCategoryReaderInterface
    {
        return new MerchantCategoryReader(
            $this->getRepository(),
        );
    }

    public function createMerchantCategoryPublisher(): MerchantCategoryPublisherInterface
    {
        return new MerchantCategoryPublisher(
            $this->getFacadeEvent(),
            $this->getFacadeEventBehavior(),
            $this->getRepository(),
        );
    }

    public function createMerchantCategoryDeleter(): MerchantCategoryDeleterInterface
    {
        return new MerchantCategoryDeleter($this->getEntityManager());
    }

    public function createMerchantCategoryMerchantExpander(): MerchantCategoryMerchantExpanderInterface
    {
        return new MerchantCategoryMerchantExpander(
            $this->getRepository(),
        );
    }

    public function getFacadeEvent(): MerchantCategoryToEventFacadeInterface
    {
        return $this->getProvidedDependency(MerchantCategoryDependencyProvider::FACADE_EVENT);
    }

    public function getFacadeEventBehavior(): MerchantCategoryToEventBehaviorFacadeInterface
    {
        return $this->getProvidedDependency(MerchantCategoryDependencyProvider::FACADE_EVENT_BEHAVIOR);
    }
}
