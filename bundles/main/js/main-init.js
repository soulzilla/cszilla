'use strict';
/******/
(function (modules) { // webpackBootstrap
    /******/ 	// The module cache
    /******/
    var installedModules = {};
    /******/
    /******/ 	// The require function
    /******/
    function __webpack_require__(moduleId) {
        /******/
        /******/ 		// Check if module is in cache
        /******/
        if (installedModules[moduleId]) {
            /******/
            return installedModules[moduleId].exports;
            /******/
        }
        /******/ 		// Create a new module (and put it into the cache)
        /******/
        var module = installedModules[moduleId] = {
            /******/            i: moduleId,
            /******/            l: false,
            /******/            exports: {}
            /******/
        };
        /******/
        /******/ 		// Execute the module function
        /******/
        modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
        /******/
        /******/ 		// Flag the module as loaded
        /******/
        module.l = true;
        /******/
        /******/ 		// Return the exports of the module
        /******/
        return module.exports;
        /******/
    }

    /******/
    /******/
    /******/ 	// expose the modules object (__webpack_modules__)
    /******/
    __webpack_require__.m = modules;
    /******/
    /******/ 	// expose the module cache
    /******/
    __webpack_require__.c = installedModules;
    /******/
    /******/ 	// define getter function for harmony exports
    /******/
    __webpack_require__.d = function (exports, name, getter) {
        /******/
        if (!__webpack_require__.o(exports, name)) {
            /******/
            Object.defineProperty(exports, name, {
                /******/                configurable: false,
                /******/                enumerable: true,
                /******/                get: getter
                /******/
            });
            /******/
        }
        /******/
    };
    /******/
    /******/ 	// getDefaultExport function for compatibility with non-harmony modules
    /******/
    __webpack_require__.n = function (module) {
        /******/
        var getter = module && module.__esModule ?
            /******/            function getDefault() {
                return module['default'];
            } :
            /******/            function getModuleExports() {
                return module;
            };
        /******/
        __webpack_require__.d(getter, 'a', getter);
        /******/
        return getter;
        /******/
    };
    /******/
    /******/ 	// Object.prototype.hasOwnProperty.call
    /******/
    __webpack_require__.o = function (object, property) {
        return Object.prototype.hasOwnProperty.call(object, property);
    };
    /******/
    /******/ 	// __webpack_public_path__
    /******/
    __webpack_require__.p = "";
    /******/
    /******/ 	// Load entry module and return exports
    /******/
    return __webpack_require__(__webpack_require__.s = 2);
    /******/
})
    /************************************************************************/
    /******/ ([
    /* 0 */,
    /* 1 */
    /***/ (function (module, exports, __webpack_require__) {

        "use strict";


        Object.defineProperty(exports, "__esModule", {
            value: true
        });
        /*------------------------------------------------------------------

          Theme Options

        -------------------------------------------------------------------*/
        var options = {
            scrollToAnchorSpeed: 700,

            templates: {
                secondaryNavbarBackItem: 'Назад',

                plainVideoIcon: '<span class="nk-video-icon"><span class="fa fa-play pl-5"></span></span>',
                plainVideoLoadIcon: '<span class="nk-video-icon"><span class="nk-loading-icon"></span></span>',

                audioPlainButton: '<div class="nk-audio-plain-play-pause">\n                <span class="nk-audio-plain-play">\n                    <span class="ion-play ml-3"></span>\n                </span>\n                <span class="nk-audio-plain-pause">\n                    <span class="ion-pause"></span>\n                </span>\n            </div>',

                instagram: '<div class="col-4">\n                <a href="{{link}}" target="_blank">\n                    <img src="{{image}}" alt="{{caption}}" class="nk-img-stretch">\n                </a>\n            </div>',
                instagramLoadingText: 'Loading...',
                instagramFailText: 'Failed to fetch data',
                instagramApiPath: 'php/instagram/instagram.php',

                twitter: '<div class="nk-twitter">\n                <span class="nk-twitter-icon fab fa-twitter"></span>\n                <div class="nk-twitter-name">\n                      <a href="https://twitter.com/{{screen_name}}" target="_blank">@{{screen_name}}</a>\n                </div>\n                <div class="nk-twitter-date">\n                    <span>{{date}}</span>\n                </div>\n                <div class="nk-twitter-text">\n                   {{tweet}}\n                </div>\n            </div>',
                twitterLoadingText: 'Loading...',
                twitterFailText: 'Failed to fetch data',
                twitterApiPath: 'php/twitter/tweet.php',

                countdown: '<div class="nk-hexagon">\n                <div class="nk-hexagon-inner"></div>\n                <span>%D</span>\n                <small>Дней</small>\n            </div>\n            <div class="nk-hexagon">\n                <div class="nk-hexagon-inner"></div>\n                <span>%H</span>\n                <small>Часов</small>\n            </div>\n            <div class="nk-hexagon">\n                <div class="nk-hexagon-inner"></div>\n                <span>%M</span>\n                <small>Минут</small>\n            </div>\n            <div class="nk-hexagon">\n                <div class="nk-hexagon-inner"></div>\n                <span>%S</span>\n                <small>Секунд</small>\n            </div>'
            }
        };

        exports.options = options;

        /***/
    }),
    /* 2 */
    /***/ (function (module, exports, __webpack_require__) {

        module.exports = __webpack_require__(3);


        /***/
    }),
    /* 3 */
    /***/ (function (module, exports, __webpack_require__) {

        "use strict";


        var _options = __webpack_require__(1);

        if (typeof window.GoodGames !== 'undefined') {
            window.GoodGames.setOptions(_options.options);
            window.GoodGames.init();
        }

        /***/
    })
    /******/]);

function loadStream() {
    let streamContainer = $('#stream');
    if (streamContainer.length && streamContainer.hasClass('initialized') === false) {
        $.ajax({
            url: '/main/videos/stream',
            success: function (response) {
                streamContainer.html(response.html);
                streamContainer.addClass('initialized');
            }
        })
    }
}

function rateIt() {
    $('.rate-it').click(function () {
        var entity_id = $(this).attr('data-id'),
            entity_table = $(this).attr('data-table'),
            rate = $(this).val(),
            url = '/main/rating/create',
            data = {
                entity_id: entity_id,
                entity_table: entity_table,
                rate: rate
            };

        $.post({
            url: url,
            data: data,
            success: function (response) {
                let ratingArea = '.rating-area-' + entity_table + '-' + entity_id,
                    averageArea = '.average-rate-' + entity_table + '-' + entity_id,
                    totalArea = '.total-rates-' + entity_table + '-' + entity_id;
                $(ratingArea).html(response.html);
                $(averageArea).html(response.average);
                $(totalArea).html(response.count);
                initialization();
            }
        })
    });
}

function acceptSettings() {
    $('.settings-select').click(function () {
        let id = $(this).attr('data-id'),
            type = $(this).attr('data-type'),
            checked = this.checked,
            url = '/main/default/settings?type='+type+'&id='+id+'&state='+checked;
        $.ajax({
            url: url
        })
    });
}

function deleteComment(){
    $('.delete-comment').click(function () {
        var id = $(this).attr('data-id'),
            selector = '#comment-' + id,
            url = '/main/comments/delete?id=' + id;

        $.ajax({
            url: url,
            success: function (response) {
                $(selector).remove();
                $('.comments-count').html(response.count);
                initialization();
            }
        });
    });
}

function sendComment(){
    $('.send-comment').click(function () {
        let that = $(this),
            comment = $('#comment-body-form textarea'),
            text = comment.val(),
            id = that.attr('data-id'),
            table = that.attr('data-table');

        if ((text.length > 1) && (comment.hasClass('is-invalid') === false)) {
            let url = '/main/comments/create',
                data = {
                    entity_id: id,
                    entity_table: table,
                    content: text
                };

            $.post({
                url: url,
                data: data,
                success: function (response) {
                    $('.comments-list').append(response.html);
                    $('.comments-count').html(response.count);
                    comment.val('');
                    comment.removeClass('is-valid');
                    initialization();
                }
            })
        } else {
            comment.addClass('is-invalid');
        }
    })
}

function deleteComplaint(){
    $('.delete-complaint').click(function () {
        var id = $(this).attr('data-id'),
            selector = '#complaint-' + id,
            url = '/main/complaints/delete?id=' + id;

        $.ajax({
            url: url,
            success: function () {
                $(selector).remove();
                initialization();
            }
        });
    });
}

function deleteOverview(){
    $('.delete-overview').click(function () {
        var id = $(this).attr('data-id'),
            selector = '#overview-' + id,
            url = '/main/overviews/delete?id=' + id;

        $.ajax({
            url: url,
            success: function () {
                $(selector).remove();
                initialization();
            }
        });
    });
}

function likeIt(){
    $('.like-it').click(function () {
        var that = $(this),
            entity_id = that.attr('data-id'),
            entity_table = that.attr('data-table'),
            url = '/main/like/create?id=' + entity_id + '&table=' + entity_table;

        $.ajax({
            url: url,
            success: function (response) {
                let state = '#like-state-' + entity_table + '-' + entity_id,
                    count = '#likes-count-' + entity_table + '-' + entity_id;

                $(count).html(response.count);
                if (response.event === 1) {
                    that.removeClass('nk-btn-color-dark-3');
                    that.addClass('nk-btn-color-main-1');
                    $(state).attr('data-prefix', 'fa');
                } else {
                    that.removeClass('nk-btn-color-main-1');
                    that.addClass('nk-btn-color-dark-3');
                    $(state).attr('data-prefix', 'far');
                }
            }
        })
    });
}

function moreComments() {
    $('.more-comments').click(function () {
        let that = $(this),
            entity_id = that.attr('data-id'),
            entity_table = that.attr('data-table'),
            page = that.attr('data-next-page'),
            max_pages = that.attr('data-max-pages'),
            url = '/main/comments/index?entity_id=' + entity_id + '&entity_table=' + entity_table + '&page=' + page;

        $.ajax({
            url: url,
            success: function (response) {
                $('.comments-list').append(response.html);
                let next_page = response.nextPage;
                if (parseInt(next_page) > parseInt(max_pages)) {
                    that.remove();
                } else {
                    that.attr('data-next-page', next_page)
                }
                initialization();
            }
        })

    });
}

function confirmTask() {
    $('.confirm-task').click(function () {
        let id = $(this).attr('data-id'),
            url = '/main/wallet/task?id=' + id;
        setTimeout(function () {
            $.ajax({
                url: url,
                success: function (response) {
                    let taskContainer = '#task-' + id,
                        costContainer = '#task-cost-' + id;

                    $(taskContainer).removeClass('pulse');
                    $(costContainer).removeClass('bg-success').addClass('bg-secondary');
                    $('.balance').html(response.coins)
                }
            })
        }, 5000)
    })
}

function predictMatch() {
    $('.predict').click(function () {
        let match_id = $(this).attr('data-id'),
            team_id = $(this).attr('data-team-id'),
            url = '/main/wallet/predict';
        $.ajax({
            url: url,
            type: 'post',
            data: {
                match_id: match_id,
                team_id: team_id
            },
            success: function (response) {
                let teamContainer = '#match-' + match_id + '-team-' + team_id;

                $(teamContainer).addClass('text-warning');
                $('.balance').html(response.coins)
            }
        })
    })
}

function initialization() {
    loadStream();
    rateIt();
    acceptSettings();
    sendComment();
    deleteComment();
    deleteComplaint();
    deleteOverview();
    likeIt();
    moreComments();
    confirmTask();
    predictMatch();
}

$(document).ready(function () {
    initialization();
})
