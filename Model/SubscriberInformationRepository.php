<?php
/**
 * @category    Magento 2
 * @package     Hgati_NewsletterCoupon
 * @copyright   Copyright (c) 2020 Hgati (https://github.com/hgati)
 */

namespace Hgati\NewsletterCoupon\Model;

use Hgati\NewsletterCoupon\Api\Data\SubscriberInformationInterfaceFactory;
use Hgati\NewsletterCoupon\Model\ResourceModel\SubscriberInformation\CollectionFactory as SubscriberInformationCollectionFactory;
use Hgati\NewsletterCoupon\Api\SubscriberInformationResourceInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Hgati\NewsletterCoupon\Api\SubscriberInformationRepositoryInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;

/**
 * Class SubscriberInformationRepository
 * @package Hgati\CartInformation\Model
 */
class SubscriberInformationRepository implements SubscriberInformationRepositoryInterface
{

    /**
     * @var SubscriberInformationInterfaceFactory
     */
    protected $subscriberInformationFactory;

    /**
     * @var SubscriberInformationCollectionFactory
     */
    protected $subscriberInformationCollectionFactory;

    /**
     * @var SubscriberInformationResourceInterface
     */
    protected $subscriberInformationResource;

    /**
     * @var array
     */
    protected $marketingEmailIntegrations;

    /**
     * @var CustomerRepositoryInterface
     */
    protected $customerRepository;

    /**
     * SubscriberInformationRepository constructor.
     * @param SubscriberInformationInterfaceFactory $subscriberInformationFactory
     * @param SubscriberInformationCollectionFactory $subscriberInformationCollectionFactory
     * @param SubscriberInformationResourceInterface $subscriberInformationResource
     * @param CustomerRepositoryInterface $customerRepository
     * @param array $marketingEmailIntegrations
     */
    public function __construct(
        SubscriberInformationInterfaceFactory $subscriberInformationFactory,
        SubscriberInformationCollectionFactory $subscriberInformationCollectionFactory,
        SubscriberInformationResourceInterface $subscriberInformationResource,
        CustomerRepositoryInterface $customerRepository,
        array $marketingEmailIntegrations = []
    )
    {
        $this->subscriberInformationFactory = $subscriberInformationFactory;
        $this->subscriberInformationCollectionFactory = $subscriberInformationCollectionFactory;
        $this->subscriberInformationResource = $subscriberInformationResource;
        $this->marketingEmailIntegrations = $marketingEmailIntegrations;
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param int $subscriberInformationId
     * @return SubscriberInformation
     * @throws NoSuchEntityException
     */
    public function getById($subscriberInformationId)
    {
        /**
         * @var SubscriberInformation $subscriberInformation
         */
        $subscriberInformation = $this->subscriberInformationFactory->create();
        $subscriberInformation->load($subscriberInformationId);
        if (!$subscriberInformation->getId()) {
            throw new NoSuchEntityException(
                __("The subscriber information that was requested doesn't exist. Verify the id and try again.")
            );
        }
        return $subscriberInformation;
    }

    /**
     * @param $subscriberId
     * @return SubscriberInformation|null
     */
    public function getBySubscriberId($subscriberId)
    {
        /**
         * @var \Hgati\NewsletterCoupon\Model\ResourceModel\SubscriberInformation\Collection $subscriberInformationCollection
         */
        $subscriberInformationCollection = $this->subscriberInformationCollectionFactory->create();
        return $subscriberInformationCollection
            ->addFieldToFilter('subscriber_id', $subscriberId)
            ->getFirstItem();
    }

    /**
     * @param $subscriberEmail
     * @return SubscriberInformation|null
     */
    public function getBySubscriberEmail($subscriberEmail)
    {
        /**
         * @var \Hgati\NewsletterCoupon\Model\ResourceModel\SubscriberInformation\Collection $subscriberInformationCollection
         */
        $subscriberInformationCollection = $this->subscriberInformationCollectionFactory->create();
        return $subscriberInformationCollection
            ->addFieldToFilter('subscriber_email', $subscriberEmail)
            ->getFirstItem();
    }


    /**
     * @param $couponId
     * @return SubscriberInformation|null
     */
    public function getByCouponId($couponId)
    {
        /**
         * @var \Hgati\NewsletterCoupon\Model\ResourceModel\SubscriberInformation\Collection $subscriberInformationCollection
         */
        $subscriberInformationCollection = $this->subscriberInformationCollectionFactory->create();
        return $subscriberInformationCollection
            ->addFieldToFilter('coupon_id', $couponId)
            ->getFirstItem();
    }

    /**
     * @param \Hgati\NewsletterCoupon\Model\SubscriberInformation $subscriberInformation
     * @return \Hgati\NewsletterCoupon\Model\SubscriberInformation|mixed
     * @throws CouldNotSaveException
     */
    public function save(\Hgati\NewsletterCoupon\Model\SubscriberInformation $subscriberInformation)
    {
        try {
            $this->subscriberInformationResource->save($subscriberInformation);
            foreach ($this->marketingEmailIntegrations as $integration) {
                if ($integration instanceof \Hgati\NewsletterCoupon\Model\AbstractNewsletterCouponIntegration) {
                    if ($subscriberInformation->getIsEnabled()) {
                        try {
                            /**
                             * @var \Magento\Customer\Api\Data\CustomerInterface $customer
                             */
                            $customer = $this->customerRepository->get($subscriberInformation->getSubscriberEmail());
                        } catch (\Exception $e) {
                            $customer = null;
                        }
                        $integration->updateSubscriber($subscriberInformation, $customer);
                    } else {
                        $integration->deleteSubscriber($subscriberInformation);
                    }
                }
            }
        } catch (\Exception $e) {
            throw new CouldNotSaveException(
                __($e->getMessage()),
                $e
            );
        }
        return $subscriberInformation;
    }

    /**
     * @param \Hgati\NewsletterCoupon\Model\SubscriberInformation $subscriberInformation
     * @return bool
     * @throws \Magento\Framework\Exception\StateException
     */
    public function delete(\Hgati\NewsletterCoupon\Model\SubscriberInformation $subscriberInformation)
    {
        try {
            $this->subscriberInformationResource->delete($subscriberInformation);
            foreach ($this->marketingEmailIntegrations as $integration) {
                if ($integration instanceof \Hgati\NewsletterCoupon\Model\AbstractNewsletterCouponIntegration) {
                    $integration->deleteSubscriber($subscriberInformation);
                }
            }
            return true;
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\StateException(
                __('The "%1" subscriber information couldn\'t be removed.', $subscriberInformation->getId()),
                $e
            );
        }
    }

    /**
     * @param int $subscriberInformationId
     * @return bool
     * @throws NoSuchEntityException
     * @throws \Magento\Framework\Exception\StateException
     */
    public function deleteById($subscriberInformationId)
    {
        $subscriberInformation = $this->getById($subscriberInformationId);
        return $this->delete($subscriberInformation);
    }
}
