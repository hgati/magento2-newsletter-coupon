<?php
/**
 * @category    Magento 2
 * @package     Hgati_NewsletterCoupon
 * @copyright   Copyright (c) 2020 Hgati (https://github.com/hgati)
 */

namespace Hgati\NewsletterCoupon\Model\ResourceModel;

use Hgati\NewsletterCoupon\Api\SubscriberInformationResourceInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class SubscriberInformation
 * @package Hgati\NewsletterCoupon\Model\ResourceModel
 */
class SubscriberInformation extends AbstractDb implements SubscriberInformationResourceInterface
{

    protected function _construct()
    {
        $this->_init('newsletter_subscriber_coupon', 'entity_id');
    }
}
