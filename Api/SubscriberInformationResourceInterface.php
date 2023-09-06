<?php
/**
 * @category    Magento 2
 * @package     Hgati_NewsletterCoupon
 * @copyright   Copyright (c) 2020 Hgati (https://github.com/hgati)
 */

namespace Hgati\NewsletterCoupon\Api;

use Magento\Framework\DataObject;
use Magento\Framework\Model\AbstractModel;

/**
 * Interface SubscriberInformationResourceInterface
 * @package Hgati\NewsletterCoupon\Api
 */
interface SubscriberInformationResourceInterface
{
    /**
     * @param AbstractModel $object
     * @return mixed
     */
    public function save(AbstractModel $object);

    /**
     * @param AbstractModel $object
     * @param $value
     * @param null $field
     * @return mixed
     */
    public function load(AbstractModel $object, $value, $field = null);

    /**
     * @param AbstractModel $object
     * @return mixed
     */
    public function delete(AbstractModel $object);
}
