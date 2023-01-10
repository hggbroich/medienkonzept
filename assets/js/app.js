require('../css/app.scss');

let bsn = require('bootstrap.native');
let bsCustomFileInput = require('bs-custom-file-input');
require('../../vendor/schulit/common-bundle/Resources/assets/js/polyfill');
require('../../vendor/schulit/common-bundle/Resources/assets/js/menu');
require('../../vendor/schulit/common-bundle/Resources/assets/js/dropdown-polyfill');

document.addEventListener('DOMContentLoaded', function() {
    bsCustomFileInput.init();

    document.querySelectorAll('[title]').forEach(function(el) {
        new bsn.Tooltip(el, {
            placement: 'bottom'
        });
    });

    document.querySelectorAll('[data-trigger="submit"]').forEach(function (el) {
        el.addEventListener('change', function (event) {
            let confirmModalSelector = el.getAttribute('data-confirm');
            let form = this.closest('form');

            if(confirmModalSelector === null || confirmModalSelector === '') {
                form.submit();
                return;
            }

            let modalEl = document.querySelector(confirmModalSelector);
            let modal = new bsn.Modal(modalEl);
            modal.show();

            let confirmBtn = modalEl.querySelector('.confirm');
            confirmBtn.addEventListener('click', function(event) {
                event.preventDefault();
                event.stopImmediatePropagation();

                console.log(form);

                form.submit();
            });
        });
    });

    let updateIcon = function(iconClass, target) {
        target.innerHTML = '<i class="' + iconClass + '"></i>';
    };

    document.querySelectorAll('[data-trigger=icon]').forEach(function(el) {
        let target = el.getAttribute('data-target');
        let targetEl = document.querySelector(target);
        updateIcon(el.value, targetEl);

        el.addEventListener('keyup', function(event) {
            updateIcon(el.value, targetEl);
        });
    });
});