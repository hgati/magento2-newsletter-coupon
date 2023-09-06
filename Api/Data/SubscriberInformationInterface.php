<?php
/**
 * @category    Magento 2
 * @package     Hgati_NewsletterCoupon
 * @copyright   Copyright (c) 2020 Hgati (https://github.com/hgati)
 */

namespace Hgati\NewsletterCoupon\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Interface SubscriberCouponInterface
 * @package Hgati\NewsletterCoupon\Api\Data
 */
interface SubscriberInformationInterface extends ExtensibleDataInterface
{
    /**
     * TABLE IDENTIFIER
     */
    const TABLE_IDENTIFIER = "newsletter_subscriber_coupon";

    /**
     * DTO DEFINITION
     */
    const ID = 'entity_id';
    const SUBSCRIBER_ID = 'subscriber_id';
    const SUBSCRIBER_EMAIL = 'subscriber_email';
    const COUPON_ID = 'coupon_id';
    const CREATED_AT = 'created_at';
    const IS_ENABLED = 'is_enabled';

    /**
     * @return int|null
     */
    public function getId();

    /**
     * @return int|null
     */
    public function getSubscriberId();

    /**
     * @param $subscriberId
     * @return \Hgati\NewsletterCoupon\Api\Data\SubscriberInformationInterface
     */
    public function setSubscriberId($subscriberId);

    /**
     * @return string|null
     */
    public function getSubscriberEmail();

    /**
     * @param string $email
     * @return \Hgati\NewsletterCoupon\Api\Data\SubscriberInformationInterface
     */
    public function setSubscriberEmail($email);

    /**
     * @return \Magento\Newsletter\Model\Subscriber|null
     */
    public function getSubscriber();

    /**
     * @return boolean|null
     */
    public function getIsEnabled();

    /**
     * @param boolean $isSubscriptionActive
     * @return \Hgati\NewsletterCoupon\Api\Data\SubscriberInformationInterface
     */
    public function setIsEnabled($isSubscriptionActive);

    /**
     * @return int|null
     */
    public function getCouponId();

    /**
     * @param $couponId
     * @return \Hgati\NewsletterCoupon\Api\Data\SubscriberInformationInterface
     */
    public function setCouponId($couponId);

    /**
     * @return \Magento\SalesRule\Model\Coupon|null
     */
    public function getCoupon();

    /**
     * @return string
     */
    public function getCreatedAt();

}
