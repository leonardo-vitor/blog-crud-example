$(function () {
    let ajaxResponseBaseTime = 4;

    $("form.send-ajax").submit(function (e) {
        e.preventDefault();

        let form = $(this);
        let action = form.attr("action");

        form.ajaxSubmit({
            url: action,
            type: "POST",
            dataType: "json",
            beforeSend: function () {
                $(".message").remove();
                ajax_load("open");
            },
            success: function (response) {
                ajaxResponseManipulate(response);
            },
            complete: function () {
                ajax_load("close");
                resetRecaptcha();
            },
            error: function (error) {
                let messageError = $("<div>").addClass("message").html(error.responseText);
                $(".form_callback").append(messageError);
            }
        });
    });

    $("[data-post]").click(function (e) {
        e.preventDefault();

        let clicked = $(this);
        let data = clicked.data();
        let action = data.post;

        if (data.confirm) {
            let deleteConfirm = confirm(data.confirm);
            if (!deleteConfirm) {
                return;
            }
        }

        $.ajax({
            url: action,
            data: data,
            type: "post",
            dataType: "json",
            beforeSend: function (load) {
                $(".message").remove();
                ajax_load("open");
            },
            success: function (response) {
                ajaxResponseManipulate(response);
            }
        });
    });

    $(".ajax_response .message").each(function (e, m) {
        ajax_notify(m, ajaxResponseBaseTime += 1)
    });

    $(".ajax_response").on("click", ".message", function (e, m) {
        $(this).fadeOut(200);
    });

    $(".document").mask("000.000.000-00");
    $(".zipcode").mask("00000-000");
    $(".date-time").mask("00/00/0000 00:00");
    $(".cellphone").mask("(00) 00000-0000");

    var SPMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    }, spOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(SPMaskBehavior.apply({}, arguments), options);
        }
    };

    $('.phone').mask(SPMaskBehavior, spOptions);
});

function resetRecaptcha() {
    if (typeof grecaptcha !== "undefined"){
        grecaptcha.reset();
    }
}

function ajaxResponseManipulate(response) {
    if (response.redirect) {
        window.location.href = response.redirect;
        return;
    }

    if (response.reload) {
        window.location.reload();
        return;
    }

    ajax_load("close");

    if (response.message) {
        $(".form_callback").html(response.message);
        return;
    }

    if (response.notify) {
        ajax_notify(response.notify.message, 5)
    }

    if (response.mce_image) {
        $('#mce_upload').modal('hide');
        tinyMCE.activeEditor.insertContent(response.mce_image);
    }
}

function notify_icon(type) {
    if (type === "success") {
        return "<i class='mr-2 fas fa-check'></i>";
    }

    if (type === "warning") {
        return "<i class='mr-2 fas fa-exclamation-triangle'></i>";
    }

    if (type === "info") {
        return "<i class='mr-2 fas fa-info-circle'></i>";
    }

    if (type === "error") {
        icon = "<i class='mr-2 fas fa-times-circle'></i>";
    }

    return "";
}

function notify_alert(message, type, time = 5) {
    let notify, notifyBox = $(".ajax_response"), icon = notify_icon(type);

    notify = "<div class='message " + type + "'>" + icon + " " + message + "<div class='message_time'></div></div>";

    if (!notifyBox.length) {
        $("body").prepend("<div class='ajax_response'></div>")
    }

    notifyBox.prepend(notify);
    $(".message").stop().animate({'left': '0', 'opacity': 1}, 200, function () {
        $(this).find(".message_time").animate({"width": "100%"}, time * 1000, "linear", function () {
            $(this).parent(".message").animate({'left': '100%', 'opacity': 0}, function () {
                $(this).remove();
            });
        });
    });

    $("body").on("click", ".message", function () {
        $(this).animate({'left': '100%', 'opacity': 0}, function () {
            $(this).remove();
        });
    });
}

function ajax_notify(message, time) {
    let ajaxMessage = $(message);

    ajaxMessage.append("<div class='message_time'></div>");
    ajaxMessage.find(".message_time").animate({"width": "100%"}, time * 1000, function () {
        $(this).parents(".message").fadeOut(200);
    });

    $(".ajax_response").append(ajaxMessage);
    ajaxMessage.fadeIn("fast");
}

function ajax_load(action) {
    ajax_load_div = $(".ajax_load");

    if (action === "open") {
        ajax_load_div.fadeIn(200).css("display", "flex");
    }

    if (action === "close") {
        ajax_load_div.fadeOut(200);
    }
}