/**
 * @since: 1.0.0
 * @author: Wider-Themes
 */
(function ($) {
    function download(filename, text) {
        var element = document.createElement('a');
        element.setAttribute('href', text);
        element.setAttribute('download', filename);
        element.style.display = 'none';
        document.body.appendChild(element);
        element.click();
        document.body.removeChild(element);
    }
    $(document).on('click', '.button-primary.create-demo', function (e) {
        e.preventDefault();
        if ($('#evolt-ie-id').val() === '') {
            $('#evolt-ie-id').focus();
        } else {
            $('.evolt-export-contents').submit();
        }
    });
    $(document).on('click', '.evolt-import-btn.evolt-import-submit', function (e) {
        e.preventDefault();
        var _form = $(this).parents('form.evolt-ie-demo-item');
        if (confirm('Are you sure you want to install this demo data?')) {
            _form.find(".evolt-loading").css('display', 'block');
            _form.submit();
        } else {
            return;
        }
    });
    $(document).on('click', '.evolt-delete-demo', function (e) {
        e.preventDefault();
        var _this = $(this);
        var _validate = prompt("Type \"reset\" in the confirmation field to confirm the reset and then click the OK button");
        if (_validate === "reset") {
            if (confirm('Are you sure you want to reset site?')) {
                _this.parents('form.evolt-ie-demo-item').find('input[name="action"]').val('evolt-reset');
                _this.parents('form.evolt-ie-demo-item').submit();
            } else {
                return;
            }
        } else {
            if (_validate !== null) {
                alert('Invalid confirmation. Please type \'reset\' in the confirmation field.');
            } else {
                return;
            }
        }
    });
    $(document).on('click', 'li.evolt-advance-reset', function (e) {
        e.preventDefault();
        var _form = $(document).find('form.evolt-reset-form-advance');
        var _validate = prompt("Type \"reset\" in the confirmation field to confirm the reset and then click the OK button");
        if (_validate === "reset") {
            if (confirm('Are you sure you want to reset site?')) {
                _form.submit();
            } else {
                return false;
            }
        } else {
            if (_validate !== null) {
                alert('Invalid confirmation. Please type \'reset\' in the confirmation field.');
            } else {
                return false;
            }
        }
    });
    $(document).on('click', 'li.evolt-show-regenerate-thumbnail', function (e) {
        e.preventDefault();
        var _form = $(document).find('form.evolt-regenerate-thumbnail-sm');
        if (confirm('Are you sure you want to Regenerate Thumbnail?')) {
            _form.submit();
        } else {
            return false;
        }
    });
    $(document).on('click', '.evolt-show-manual-import', function (e) {
        e.preventDefault();
        $(document).find(".evolt-manual-import-layout").css('display','block');
        setTimeout(function () {
            $(document).find(".tabs-contents.evolt-mi-demo-list").addClass("active");
            $(document).find(".evolt-manual-import-layout").removeClass("evolt-m-hidden");
        },10);
    });
    $(document).on('click', '.evolt-contain .dashicons.dashicons-dismiss', function (e) {
        e.preventDefault();
        $(document).find(".evolt-manual-import-layout").addClass("evolt-m-hidden");
        setTimeout(function () {
            $(document).find(".evolt-manual-import-layout").css('display','none');
        },600);
    });

    $(document).on('click', '.evolt-mi-select', function (e) {
        e.preventDefault();
        $(document).find(".evolt-mi-image.evolt-selected").removeClass("evolt-selected");
        $(document).find(".tabs-contents.active").removeClass("active");
        $(document).find("#attachments").addClass("active");
        $(document).find(".tabs-demos[data-id=select-demo]").addClass("evolt-mi-done");
        $(document).find(".tabs-demos[data-id=select-demo]").removeClass("evolt-mi-active");
        $(document).find(".tabs-demos[data-id=attachments]").addClass("evolt-mi-active");
        var _this = $(this),
            _img = _this.parents(".evolt-mi-image");
        _img.addClass("evolt-selected");
        $(".evolt-mi-image-selected img").attr("src",_img.find("img").attr("src"));
        $("#evolt-download-attachment-btn").attr("data-attachment",_this.attr("data-attachment"));
        $(".evolt-mi-demo-title-selected").html(_img.find(".evolt-mi-demo-title").html());
        $("input[name=evolt-ie-id]").val(_this.attr("data-demo"));
        setTimeout(function () {
            $(document).find("#select-demo").css('display','none');
        },300);
    });
    $(document).on('click', '.tabs-demos.evolt-mi-done', function (e) {
        e.preventDefault();
        var _this = $(this);
        $(document).find(".tabs-demos").removeClass("evolt-mi-done");
        $(document).find(".tabs-demos").removeClass("evolt-mi-active");
        var _data_id = _this.attr("data-id");
        switch (_data_id) {
            case "attachments":
                $(document).find(".tabs-demos").removeClass("evolt-mi-done");
                $(document).find(".tabs-demos").removeClass("evolt-mi-active");
                $(document).find(".tabs-contents.active").removeClass("active");
                $(document).find("#attachments").addClass("active");
                $(document).find(".tabs-demos[data-id=select-demo]").addClass("evolt-mi-done");
                $(document).find(".tabs-demos[data-id=select-demo]").removeClass("evolt-mi-active");
                $(document).find(".tabs-demos[data-id=attachments]").addClass("evolt-mi-active");
                break;
            case "select-demo":
                $(document).find("#select-demo").css('display','block');
                $(document).find(".tabs-demos").removeClass("evolt-mi-done");
                $(document).find(".tabs-demos").removeClass("evolt-mi-active");
                setTimeout(function () {
                    $(document).find(".tabs-contents.active").removeClass("active");
                    $(document).find("#select-demo").addClass("active");
                    $(document).find(".tabs-demos[data-id=attachments]").removeClass("evolt-mi-active");
                    $(document).find(".tabs-demos[data-id=select-demo]").addClass("evolt-mi-active");
                },10);
                break;
            default:
                break;
        }
    });
    $(document).on('click','#evolt-download-attachment-btn',function (e) {
        e.preventDefault();
        var _this = $(this);
        download("evolt-attachments.zip",_this.attr("data-attachment"));
    });
    $(document).on('change','#evolt-accept-unzip-done',function (e) {
        e.preventDefault();
        var _checked = $("input#evolt-accept-unzip-done:checked").length;
        if(_checked === 1){
            $(document).find(".evolt-mi-dl-step.step-4 button").addClass("active");
        }else{
            $(document).find(".evolt-mi-dl-step.step-4 button").removeClass("active");
        }
    });
    $(document).on('click','.evolt-mi-dl-step.step-4 button.active',function (e) {
        e.preventDefault();
        var _this = $(this);
        var _checked = $("input#evolt-accept-unzip-done:checked").length;
        if(_checked === 1){
            if (confirm('Are you sure you want to install this demo data?')) {
                _this.next().submit();
            } else {
                return false;
            }
        }else{
            alert("Please accept \"I uploaded and unzipped file\"");
        }
    });
})(jQuery);
