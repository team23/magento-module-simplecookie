var config = {
    map: {
        '*': {
            'simpleCookieModal': 'Team23_SimpleCookie/js/simple-cookie',
            'simpleCookieOptOut': 'Team23_SimpleCookie/js/simple-cookie',
            'simpleCookieHelper': 'Team23_SimpleCookie/js/simple-cookie'
        }
    },
    config: {
        mixins: {
            'Magento_GoogleAnalytics/js/google-analytics': {
                'Team23_SimpleCookie/js/google-analytics-mixin': true
            }
        }
    }
};
