<?php

namespace Team23\SimpleCookie\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;


/**
 * Class CookieOptOut
 *
 * @package Team23\SimpleCookie\Block\Widget
 */
class CookieOptOut extends Template implements BlockInterface
{
    protected $_template = "widget/cookie-opt-out.phtml";

    /**
     * Get the widgets link title
     *
     * @return string
     */
    public function getLinkTitle()
    {
        return $this->escapeHtml($this->getData('link_title'));
    }
}

