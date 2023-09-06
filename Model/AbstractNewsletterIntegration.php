<?php
/**
 * @category    Magento 2
 * @package     Hgati_NewsletterCoupon
 * @copyright   Copyright (c) 2020 Hgati (https://github.com/hgati)
 */
namespace Hgati\NewsletterCoupon\Model;

use Hgati\NewsletterCoupon\Api\Data\SubscriberInformationInterface;

/**
 * Class AbstractNewsletterCouponIntegration
 * @package Hgati\NewsletterCoupon\Model
 */
class AbstractNewsletterCouponIntegration
{
    /**
     * @param $email
     * @return bool
     */
    public function subscriberExists($email) {
        return false;
    }

    /**
     * @param SubscriberInformationInterface $subscriptionInformation
     * @param \Magento\Customer\Api\Data\CustomerInterface  $customer
     */
    protected function updateSubscriberInformations($subscriptionInformation, $customer) {}

    /**
     * @param SubscriberInformationInterface $subscriptionInformation
     * @param \Magento\Customer\Api\Data\CustomerInterface  $customer
     */
    protected function createSubscriber($subscriptionInformation, $customer) {}

    /**
     * @param SubscriberInformationInterface $subscriptionInformation
     * @param \Magento\Customer\Api\Data\CustomerInterface  $customer
     */
    public function updateSubscriber($subscriptionInformation, $customer) {
        $subscriberEmail = $subscriptionInformation->getSubscriberEmail();
        if ($this->subscriberExists($subscriberEmail)) {
            $this->updateSubscriberInformations($subscriptionInformation, $customer);
        } else {
            $this->createSubscriber($subscriptionInformation, $customer);
        }
    }

    /**
     * @param SubscriberInformationInterface $subscriptionInformation
     */
    public function deleteSubscription($subscriptionInformation) {}
}
