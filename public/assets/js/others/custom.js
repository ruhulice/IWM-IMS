/*$(document).ready(function () {
    selectToMe('');//for select to me
    $('.chosen-select').chosen({width: "100%"}); //for multi select
    selectToMe(placeHolderText);
    integerInput();
    floatInput();
    tagInput();
    hideFilderBody();
});*/

function hideFilderBody() {
    /*
     *  This can hide Filter body. in filter body filter-body class must contain.
     */
    $('div.ibox-content.filter-body').slideUp();
    $('.ibox-tools a.collapse-link i').toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
}

/*
 * When delete Sweet Alert Confirm Start
 */

$('.delete_form_submit').on('click', function (e, data) {
    if (!data) {
        handleDelete(e, 1);
    } else {
        window.location = $(this).attr('href');
    }
});

function handleDelete(e, stop) {
    if (stop) {
        e.preventDefault();
        swal({
                title             : "Are you sure?",
                text              : "You will not be able to recover the Data again!",
                type              : "error",
                showCancelButton  : true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText : "Yes, delete!",
                closeOnConfirm    : false
            },
            function (isConfirm) {
                $('.delete_form_submit').parent().find("form").submit();
            });
    }
}

/*
 * When delete Sweet Alert Confirm Start
 */
$('#btn_from_update').on('click', function (e, data) {

    if (!data) {
        handleUpdate(e, 1);
    } else {
        window.location = $(this).attr('href');
    }
});

function handleUpdate(e, stop) {
    if (stop) {
        e.preventDefault();
        swal({
                title             : "Are you sure?",
                text              : "Data will be Updated. If updated, previous data will not be restored again.",
                type              : "warning",
                showCancelButton  : true,
                confirmButtonColor: "#f9b904",
                confirmButtonText : "Yes, Update!",
                closeOnConfirm    : true
            },
            function (isConfirm) {
                if (isConfirm) {
                    $('.custom_update_form').submit();
                }
            });
    }
}

/*
 * When delete Sweet Alert Confirm End
 */
$("body").on('click', '.delete_row', function () {
    $(this).parent().parent().remove();
    //$.refresh_table();

}); //for deleting a row from a table

/*
 * Find Table max row id
 */

function findTableMaxRowId(table_id) {
    var row = $(table_id + " tr").length;

    if (row != 0) {
        return $(table_id + " tr:last").attr("data-rowid");
    } else {
        return 0;
    }
}

/*
 * Find Table max row id
 */

function countTableRow(table_id) {
    return $(table_id + " tr").length;
}

/*
 * Make Custom Number Field Class
 */

function floatInput() {
    $('body').on('keypress', '.float-input', function (event) {
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57) && (event.which < 7 || event.which > 8)) {
            event.preventDefault();
        } else {
            var entered_value = $(this).val();
            var regexPattern = /^\d{0,8}(\.\d{1,2})?$/;
            regexPattern.test(entered_value)
        }
    });
}

function integerInput() {
    $('body').on('keypress', '.integer-input', function (event) {
        if ((event.which < 48 || event.which > 57) && (event.which < 7 || event.which > 8)) {
            event.preventDefault();
        }
    });
}

function clearSelected(optionId) {
    $(optionId).empty();
    $(optionId).select2('val', '');
}

function tagInput() {
    $('.tagsinput').tagsinput({
        tagClass: 'label label-primary'
    });
}

function laddaObject(){
    ladda = Ladda.create( document.querySelector( '.ladda-button' ) );
}
