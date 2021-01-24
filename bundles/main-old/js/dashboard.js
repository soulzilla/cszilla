'use strict';

$(document).ready(function ($) {
    function init() {
        $('.roll').click(function () {
            var entity_id = $(this).attr('data-contest'),
                place = $(this).attr('data-place'),
                winner_container = '#winner-' + place,
                url = '/dashboard/contests/winner?id=' + entity_id + '&place=' + place;

            $.ajax({
                url: url,
                success: function (response) {
                    $(winner_container).html(response.name);
                }
            });
        })
    }

    init();

    $(document).on('ready pjax:end', function (event) {
        init();
    });

});