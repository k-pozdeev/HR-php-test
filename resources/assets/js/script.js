$(document).ready(function () {
    function removeError($inputElement) {
        $inputElement.parent('.form-group').removeClass('has-error').find('.help-block').remove();
    }

    function showError($inputElem, errorText) {
        let hint = $('<span class="help-block">' + errorText + '</span>');
        $inputElem.parents('.form-group').addClass('has-error').append(hint);
    }

    $('.product-price').each(function () {
        let $inputElem = $(this);
        let id = $inputElem.data('id');
        let $buttonElem = $inputElem.parents('tr').find('.product-price-save');

        $inputElem.on('input change', function () {
            removeError($(this));
            $buttonElem.prop('disabled', false);
        });

        $buttonElem.on('click', function () {
            let price = $inputElem.val();
            axios.post('/products/edit/' + id, { price: price })
                .then(function (response) {
                    alert("Сохранена новая цена: " + response.data.price);
                    $buttonElem.prop('disabled', true);
                    removeError($inputElem);
                })
                .catch(function (err) {
                    if (typeof err.response.data.errors.price != 'undefined') {
                        let errorText = err.response.data.errors.price[0];
                        showError($inputElem, errorText);
                        $buttonElem.prop('disabled', true);
                    } else {
                        alert("Ошибка запроса");
                    }
                })
        });
    });
});