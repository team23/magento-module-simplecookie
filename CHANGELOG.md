# Changelog
All notable changes to this extension will be documented in this file.

## [1.0.1] - 2022-11-10
### Changed
- Increased the extension compatibility from `PHP 7.2` to `PHP ~7.4|~8.1`
- Added type definitions for variables and functions


## [1.0.2] - 2022-11-22
### Changed
- Fixed the cookie module definition in `simple-cookie.js` from `jquery/jquery.cookie` to `js-cookie/cookie-wrapper` because this changed in the update of Magento to version 2.4.4.
- Because of this change, the requirements for this extension have been updated to `"magento/product-community-edition": ">=2.4.4"`.
- Since Magento 2.4.4 is the first Version that supports PHP 8.1 the requirements for this extension have also been updated to `"php": "~8.1"`.
