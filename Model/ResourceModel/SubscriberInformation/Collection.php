<?php
/**
 * @category    Magento 2
 * @package     Hgati_NewsletterCoupon
 * @copyright   Copyright (c) 2020 Hgati (https://github.com/hgati)
 */

namespace Hgati\NewsletterCoupon\Model\ResourceModel\SubscriberInformation;

use Hgati\NewsletterCoupon\Model\ResourceModel\SubscriberInformation as SubscriberInformationResource;
use Hgati\NewsletterCoupon\Model\SubscriberInformation;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Hgati\NewsletterCoupon\Model\ResourceModel\SubscriberInformation
 */
class Collection extends AbstractCollection
{

    protected function _construct()
    {
        $this->_init(
            SubscriberInformation::class,
            SubscriberInformationResource::class
        );
    }
}
