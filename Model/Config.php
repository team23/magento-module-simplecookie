<?php

namespace Team23\SimpleCookie\Model;

/**
 * Class Config
 *
 * @package Team23\SimpleCookie\Model
 */
class Config
{
    /**
     * SimpleCookie setting path
     */
    const SIMPLE_COOKIE_SETTINGS = 'simple_cookie_general/simple_cookie_settings/';

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;
    /**
     * @var string
     */
    protected $storeScope;

    /**
     * Config constructor.
     *
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
    }

    /**
     * Get setting in the SimpleCookie context or empty string if not set
     *
     * @param string $setting
     * @return mixed|string
     */
    public function getSetting($setting = '')
    {
        return $this->scopeConfig->getValue(self::SIMPLE_COOKIE_SETTINGS . $setting, $this->storeScope) ?? '';
    }

    /**
     * Get module_state attribute
     *
     * @return bool
     */
    public function isModuleEnabled()
    {
        return (bool)$this->getSetting('module_state');
    }
}
