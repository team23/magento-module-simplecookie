# TEAM23 SimpleCookie
SimpleCookie extension for Magento 2 by Team23

This module shows a modal window in which the visitor has to choose between the cookie purposes 
that will be set when using the shop. 
In order to access the website, the customer must at least accept the "essential" cookies.
The visitors choice itself will be saved in a cookie, which has a default lifetime of 30 days, but can be set in the
settings.

## Configuration & use
### Visitors options:
- 'Essential': all Magento 2 essential cookies
- 'Marketing': Google Analytics code (Magento_GoogleAnalytics) -> the code will be unset analogously to Magento2
 CookieRestrictionMode (see [Magento 2 Cookie Restriction Mode](https://docs.magento.com/m2/ce/user_guide/stores/compliance-cookie-restriction-mode.html))

### Cookie configuration options:
- Information messages: for each purpose the message can be set or removed
- Cookie Lifetime: the default lifetime the settings will be saved

### Magento 2 Widgets
There are two Magento 2 widgets:
- `cookie-opt-out` - allows opt-out entirely, this will remove the settings cookie and therefore 
the autoopening modal will shows again
- `cookie-configuration` - allows changing the configuration options

## Important Notes
This is a very simple implementation and is probably not enough to fulfill every GDPR/EU-ePrivacy rule entirely.<br>
Only the default Magento 2 Google Analytics module is currently supported

## Developing custom add-ons
It is possible to reuse the Cookie that stores the visitors settings. <br>
Therefore one can use the `simpleCookieHelper` jquery widget and its public methods defined 
in `Team23_SimpleCookie/js/simple-cookie`.

## Installation via Composer
- Add satis.team23.de composer repository in your composer.json

```bash
composer config repositories.team23 composer https://satis.team23.de/
```

- Require team23/module-simplecookie

```bash
composer require team23/module-simplecookie ^dev-master
```

## Troubleshooting:
- >The analytics-js source is still not visible/visible in inspector after acceptance changes<br>

  The modal settings will be saved immediately. However, the insertion or removal of the corresponding script tag 
within the DOM will only take effect after one refresh or site change.
- >The analytics-js source is not visible at all, independently of the changes in the modal settings.<br>

  Make sure you have enabled Google Analytics in the Magento 2 settings: 
Stores -> Configuration -> Sales -> Google API -> Google Analytics<br>
Also make sure you have cleared the caches.
