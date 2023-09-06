<?php
/**
 * @category    Magento 2
 * @package     Hgati_NewsletterCoupon
 * @copyright   Copyright (c) 2020 Hgati (https://github.com/hgati)
 */

namespace Hgati\NewsletterCoupon\Model\Config\Backend;

/**
 * Class DateTimeFormat
 * @package Hgati\NewsletterCoupon\Model\Config\Backend
 */
class DateTimeFormat extends \Magento\Framework\App\Config\Value {

    /**
     * @return $this|\Magento\Framework\App\Config\Value
     */
    public function beforeSave()
    {
        $dataSaveAllowed = false;
        $value = $this->getValue();
        if (strtotime((string)$value) !== false) {
            $dataSaveAllowed = true;
        }
        if (!$dataSaveAllowed) {
            $value = (string)$this->getOldValue();
        }
        $this->setValue((string)$value);
        return parent::beforeSave();
    }
}
