<?php

namespace Team23\SimpleCookie\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

/**
 * Class CookieConfiguration
 *
 * @package Team23\SimpleCookie\Block\Widget
 */
class CookieConfiguration extends Template implements BlockInterface
{
    /**
     * Cookie notice widget template
     */
    protected $_template = "widget/cookie-configuration.phtml";

    /**
     * @var \Team23\SimpleCookie\Model\Config
     */
    protected $config;
    /**
     * @var string
     */
    protected $widgetId;
    /**
     * @var \Magento\Framework\Serialize\SerializerInterface
     */
    protected $serializer;

    /**
     * CookieConfiguration constructor.
     *
     * @param Template\Context $context
     * @param array $data
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Team23\SimpleCookie\Model\Config $config
     * @param \Magento\Framework\Serialize\SerializerInterface $serializer
     */
    public function __construct(
        Template\Context $context,
        array $data = [],
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Team23\SimpleCookie\Model\Config $config,
        \Magento\Framework\Serialize\SerializerInterface $serializer
    ) {
        parent::__construct($context, $data);
        $this->config = $config;
        $this->scopeConfig = $scopeConfig;
        $this->storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $this->serializer = $serializer;
    }

    /**
     * Get SimpleCookie Setting "title" or the custom widget title attribute if custom_title is enabled
     *
     * @return string
     */
    public function getTitle()
    {
        if ((bool)($this->getData('custom_title'))) {
            return $this->escapeHtml($this->getData('title'));
        }

        return $this->config->getSetting('title');
    }

    /**
     * Get SimpleCookie Setting "message" or the custom widget message attribute if custom_message is enabled
     *
     * @return string
     */
    public function getMessage()
    {
        if ((bool)($this->getData('custom_message'))) {
            return $this->escapeHtml($this->getData('message'));
        }

        return $this->config->getSetting('message');
    }

    /**
     * Get SimpleCookie Setting "information_essential"
     *
     * @return string
     */
    public function getInformationEssential()
    {
        return $this->config->getSetting('information_essential');
    }

    /**
     * Get SimpleCookie Setting "information_marketing"
     *
     * @return string
     */
    public function getInformationMarketing()
    {
        return $this->config->getSetting('information_marketing');
    }

    /**
     * Get SimpleCookie Setting "lifetime" (in days)
     *
     * @return int
     */
    public function getCookieLifetime()
    {
        return (int)$this->config->getSetting('lifetime') ?: 30;
    }

    /**
     * Get auto_open widget attribute value
     *
     * @return bool
     */
    public function isAutoOpen()
    {
        return (bool)($this->getData('auto_open'));
    }

    /**
     * Get clickabl ewidget attribute value
     *
     * @return bool
     */
    public function isClickable()
    {
        return (bool)($this->getData('clickable'));

    }

    /**
     * Get show_link widget attribute value
     *
     * @return bool
     */
    public function isShowLink()
    {
        return (bool)($this->getData('show_link'));
    }

    /**
     * Get the widgets link title
     *
     * @return string
     */
    public function getLinkTitle()
    {
        return $this->escapeHtml($this->getData('link_title'));
    }

    /**
     * Get js settings as json string
     *
     * @return false|string
     */
    public function getSettingsJson()
    {
        $settings = [
            'title' => $this->getTitle(),
            'lifetime' => $this->getCookieLifetime(),
        ];
        if ($isAutoOpen = $this->isAutoOpen()) {
            $settings['autoOpen'] = $isAutoOpen;
        }
        if ($isClickable = $this->isClickable()) {
            $settings['clickable'] = $isClickable;
        }

        $settings['id'] = $this->getWidgetId();

        return $this->serializer->serialize($settings);
    }

    /**
     * Returns a unique (widget) id for each instance of the block class.
     *
     * This must be done in order to allow outputting the widgets html and modal multiple times
     * in one single page. If we didn't do this, multiple modals would be interfering & dom id's weren't unique.
     *
     * @return string
     */
    public function getWidgetId()
    {
        if ($this->widgetId === null) {
            $this->widgetId = uniqid('', true);
        }

        return $this->widgetId;
    }
}
