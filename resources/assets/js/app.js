
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 *
 *  Enable/Disable
 *
 */

$('.bt-switch-simple').bootstrapSwitch({
    size: 'small',
    onText: '<i class="fa  fa-check"></i>',
    offText: '<i class="fa  fa-close"></i>',
    handleWidth: 12
}).on('switchChange.bootstrapSwitch', function(event, state) {
    if (state) {
        $(this).val(1);
    } else {
        $(this).val(0);
    }
});

/**
 *
 *  Enable/Disable
 *
 */

$('.bt-switch').bootstrapSwitch({
    size: 'small',
    onText: '<i class="fa  fa-check"></i>',
    offText: '<i class="fa  fa-close"></i>',
    handleWidth: 12
}).on('switchChange.bootstrapSwitch', function(event, state) {

    let url = (state) ? $(this).data('url-enable') : $(this).data('url-disable');
    let value = $(this).data('value');
    let refresh = $(this).data('refresh');
    let data = undefined;

    if (value !== undefined) {
        data = value;
        console.log(data);
    }

    $.ajax({
        type:'PATCH',
        url:url,
        data:data,
        contentType : 'application/json',
        success:function(data){
            console.log(data.success);
            if (refresh) {
                location.reload();
            }
        }
    });

    console.log(url);

    // $(this).bootstrapSwitch('state', false, true);
});

/**
 *
 *  Enable/Disable FORM
 *
 */

$('.bt-switch-form').bootstrapSwitch({
    size: 'small',
    onText: '<i class="fa  fa-check"></i>',
    offText: '<i class="fa  fa-close"></i>',
    handleWidth: 12
}).on('switchChange.bootstrapSwitch', function(event, state) {

    let formHide = $('form.bt-hide');
    let hideItems = formHide.find('.bt-hide');
    let inverse = false;

    if ($(this).data('inverse') !== undefined && $(this).data('inverse') ) {
        inverse = true;
    }

    if (state) {
        hideItems.each(function(){
            if (inverse) {
                $(this).removeClass('hide');
            } else {
                $(this).addClass('hide');
            }
        });
    } else {
        hideItems.each(function(){
            if (inverse) {
                $(this).addClass('hide');
            } else {
                $(this).removeClass('hide');
            }
        });
    }

    if (inverse) {
        state = false;
    }

});

/**
 *
 *  Filter: Alphabet
 *
 */


let formFilter = $('.filter-words');

if (formFilter.length !== 0) {

    let formFilterWords = Object.values(formFilter.data('words'));

    formFilter.on('click', 'a', function(e){
        e.preventDefault();

        console.log(formFilterWords);

        let letter = $(this).data('char');
        console.log(letter);

        let result = formFilterWords.filter(function(item){
            return item.toLowerCase().indexOf(letter.toLowerCase()) === 0;
        });

        console.log(result);
    });

    formFilter.on('submit', function(e){
        e.preventDefault();
        console.log(this);
    });

}

/*
const countries = ['Norway', 'Sweden', 'Denmark', 'New Zealand'];

let letter = 'n';

let startsWithN = countries.filter(function (item) {
  return item.toLowerCase().indexOf(letter.toLowerCase()) === 0;
});

console.log(startsWithN)
 */


/**
 *
 *  Multiselect Two-Sides
 *
 */



/**
 *
 *  Delete ALL rows
 *
 */

$('.select-table-all').click(function(e){
    let table= $(e.target).closest('table');
    $('td input:checkbox',table).prop('checked',this.checked);
});

$('.button-table-all').click(function(e){

    e.preventDefault();

    let url = $(this).attr('href');
    let token = $("meta[name=csrf-token]").attr('content');
    let table = $('#' + $(this).data('table').toString());
    let ids = [];

    $('td input:checkbox',table).each(function(index, item){
        let it = $(item);
        let id = it.data('id');

        if (it.is(':checked')) {
            ids.push(id);
        }
    });

    if (ids !== undefined && ids.length !== 0) {

        let msg = $(this).data('delete-msg');

        if (!confirm(msg)){
            return false;
        }

        $.ajax({
            type:'DELETE',
            url: url,
            data: JSON.stringify({ids: ids}),
            contentType : 'application/json',
            success: function(data){
                // console.log(data.success);
                location.reload();
            }
        });

    }

});

/**
 *
 *   Confirmation
 *
 */

$(".confirm").click(function(){
    let msg = $(this).data('delete-msg');
    if (!confirm(msg)){
        return false;
    }
});

/**
 *
 *
 */
