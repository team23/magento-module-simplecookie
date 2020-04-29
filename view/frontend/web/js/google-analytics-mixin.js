define([
    'jquery',
    'mage/utils/wrapper',
    'Team23_SimpleCookie/js/simple-cookie'
], function ($, wrapper, simpleCookie) {
    'use strict';

    return function (analytics, config) {
        let isAcceptedMarketing = simpleCookie.simpleCookieHelper().getIsAccepted('marketing');

        if (isAcceptedMarketing) {
            return wrapper.wrap(analytics, function (analytics, config) {
                // Also disable cookieRestrictionMode
                config.isCookieRestrictionModeEnabled = 0;
                analytics(config);
            });
        }
    };
});
