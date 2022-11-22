define([
    'jquery',
    'js-cookie/cookie-wrapper',
    'underscore',
    'Magento_Ui/js/modal/modal',
    'mage/translate',
    'domReady!'
], function ($, cookie, _, modal, $t) {

    const cookieName = 'sc-cookie-notice';

    // Helper for external extensions
    $.widget('t23.simpleCookieHelper', {
        options: {
            cookieName: cookieName,
        },

        /**
         * Get information about the currently saved SimpleCookie cookie
         */
        getCookieInformation: function () {
            let cookie = JSON.parse($.cookie(this.options.cookieName));

            return cookie || {accepted: false, selection: []};
        },

        getIsAccepted: function (group) {
            let selection = this.getCookieInformation().selection;
            let groupSettings = selection.find(groupSetting => groupSetting.name === `group-${group}`);

            return groupSettings ? !!groupSettings.value : false;
        },

        /**
         * Unset the SimpleCookie cookie, i.e. opt-out
         */
        unsetNoticeCookie: function () {
            /* Version 1.1 (https://github.com/js-cookie/js-cookie/tree/v1.1) */
            $.cookie(this.options.cookieName, null, {path: '/'});
        },

    });

    $.widget('t23.simpleCookieOptOut', {
        options: {
            event: 'click',
            cookieName: cookieName
        },

        _create: function() {
            this._bind();
        },
        _bind: function() {
            this._on({
                'click': this.unsetNoticeCookie
            });
        },
        /**
         * Unset the SimpleCookie cookie, i.e. opt-out
         */
        unsetNoticeCookie: function () {
            /* Version 1.1 (https://github.com/js-cookie/js-cookie/tree/v1.1) */
            $.cookie(this.options.cookieName, null, {path: '/'});
            alert($t('Successfully done Cookie opt-out'));
        },
    });

    $.widget('t23.simpleCookieModal', {
        options: {
            lifetime: 30,
            title: null,
            cookieNoticeClass: 'sc-cookie-notice',
            autoOpen: false,
            clickable: false,
            cookieName: cookieName,
        },

        /**
         * @private
         */
        _init: function () {
            let modalSettings = this._getModalSettings();

            if (this.options.autoOpen) {
                if (!this._getCookieInformation().accepted) {
                    this.element.modal(modalSettings);
                }
            } else {
                let $widget = this;
                this.element.modal(modalSettings).on('modalopened', function () {
                    // always fetch again, so we don't miss any manipulation
                    let cookie = $widget._getCookieInformation();

                    if (cookie.accepted) {
                        $widget._setSelection(cookie.selection);
                    }
                })
            }
        },

        /**
         * @private
         */
        _setNoticeCookie: function (selection) {
            let now = new Date();
            let expiry = new Date(now.setDate(now.getDate() + this.options.lifetime));

            $.cookie(this.options.cookieName, JSON.stringify({accepted: true, selection: selection}), {
                expires: expiry,
                path: '/'
            });
        },

        /**
         * @private
         */
        _getCookieInformation: function () {
            let cookie = $.cookie(this.options.cookieName);

            if (typeof cookie === 'undefined') {
                return {accepted: false, selection: []};
            } else {
                return JSON.parse(cookie);
            }
        },
        /**
         * @private
         */
        _getModalSettings() {
            let $widget = this; // remember context for subfunctions

            return {
                autoOpen: $widget.options.autoOpen,
                clickableOverlay: $widget.options.clickable,
                title: $widget.options.title,
                trigger: '[data-trigger=\"' + $widget.options.id + '\"]',
                responsive: true,
                modalClass: this.options.cookieNoticeClass,
                buttons: [
                    {
                        text: $t('Accept selected'),
                        click: function () {
                            $widget._setNoticeCookie($widget._getSelection());
                            this.closeModal();
                        }
                    },
                    {
                        text: $t('Accept all'),
                        class: 'action primary',
                        click: function () {
                            $widget._setNoticeCookie($widget._getSelection(true));
                            this.closeModal();
                        }
                    }
                ]
            };
        },

        /**
         * @private
         */
        _getSelection: function (all = false) {
            let selection = [{
                "name": 'group-essential',
                "value": true
            }];

            this.element.find('.cn-switcher .cn-selectable').each(function () {
                selection.push({
                    "name": $(this).attr("name"),
                    "value": all ? true : $(this).prop('checked')
                });
            });

            return selection;
        },

        /**
         * @private
         */
        _setSelection: function (selection) {
            let $widget = this;

            selection.forEach(function (item) {
                $widget.element.find('[name="' + item.name + '"]').attr('checked', item.value);
            });
        }
    });

    return {
        simpleCookieOptOut: $.t23.simpleCookieOptOut,
        simpleCookieHelper: $.t23.simpleCookieHelper,
        simpleCookieModal: $.t23.simpleCookieModal
    };
});
