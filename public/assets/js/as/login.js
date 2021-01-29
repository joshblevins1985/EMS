var valid = false;

$("#login-form").submit(function (e) {
    var $form = $(this);

    if (! $form.valid()) {
        return false;
    }

    as.btn.loading($("#btn-login"));

    return true;
});

var valid = false;

$("#qa-form").submit(function (e) {
    var $form = $(this);

    if (! $form.valid()) {
        return false;
    }

    as.btn.loading($("#qa-submit"));

    return true;
});

var valid = false;

$("#narc-form").submit(function (e) {
    var $form = $(this);

    if (! $form.valid()) {
        return false;
    }

    as.btn.loading($("#narc-submit"));

    return true;
});