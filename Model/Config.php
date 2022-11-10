<?php

namespace Team23\SimpleCookie\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

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
     * @var ScopeConfigInterface
     */
    protected ScopeConfigInterface $scopeConfig;

    /**
     * @var string
     */
    protected string $storeScope;

    /**
     * Config constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
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
    public function getSetting(string $setting = ''): mixed
    {
        return $this->scopeConfig->getValue(self::SIMPLE_COOKIE_SETTINGS . $setting, $this->storeScope) ?? '';
    }

    /**
     * Get module_state attribute
     *
     * @return bool
     */
    public function isModuleEnabled(): bool
    {
        return (bool)$this->getSetting('module_state');
    }
}
