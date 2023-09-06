<?php
/**
 * @category    Magento 2
 * @package     Hgati_NewsletterCoupon
 * @copyright   Copyright (c) 2020 Hgati (https://github.com/hgati)
 */

namespace Hgati\NewsletterCoupon\Api;

/**
 * Interface SubscriberCouponRepositoryInterface
 * @package Hgati\NewsletterCoupon\Api
 */
interface SubscriberInformationRepositoryInterface
{
    /**
     * @param \Hgati\NewsletterCoupon\Model\SubscriberInformation $subscriberInformation
     * @return mixed
     */
    public function save(\Hgati\NewsletterCoupon\Model\SubscriberInformation $subscriberInformation);

    /**
     * @param int $subscriberInformationId
     * @return \Hgati\NewsletterCoupon\Model\SubscriberInformation
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($subscriberInformationId);

    /**
     * @param $subscriberId
     * @return \Hgati\NewsletterCoupon\Model\SubscriberInformation|null
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getBySubscriberId($subscriberId);

    /**
     * @param $couponId
     * @return \Hgati\NewsletterCoupon\Model\SubscriberInformation|null
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getByCouponId($couponId);

    /**
     * @param \Hgati\NewsletterCoupon\Model\SubscriberInformation $subscriberInformation
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\Hgati\NewsletterCoupon\Model\SubscriberInformation $subscriberInformation);

    /**
     * @param int $orderItemInformationId
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($orderItemInformationId);
}
