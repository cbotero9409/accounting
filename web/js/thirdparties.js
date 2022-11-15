function deptsFunction(dept) {
    $.ajax({
        type: "GET",
        url: "municipality",
        data: {id: dept},
        dataType: "json",
        success: function (data) {
            var muni = document.getElementById('thirdparties-fk_municipality');
            $("#thirdparties-fk_municipality").empty();
            let option = document.createElement('option');
            option.text = "Seleccionar Municipio";
            muni.add(option);
            Object.keys(data).forEach(function (key) {
                let option = document.createElement('option');
                option.text = data[key];
                option.value = key;
                muni.add(option);
            })
        }
    })
}

var i = 0;
const update_lines = document.getElementById('update_lines');
if (update_lines) {
    i = parseInt(update_lines.value);
}
function addLine() {
    const main_input = document.getElementById('product_lines_main');
    const main_input_value = main_input.value;
    var line = `<div class='row' id='line${i}'>
                    <div class="col-11">
                        <input type='text' class='form-control' name='product_lines[]' aria-invalid='false' value='${main_input_value}'>
                    </div>
                    <div class='col-1'>
                        <button type='button' class="btn btn-link" title='Eliminar' aria-label='Eliminar'data-pjax='0' onclick="deleteLine('line${i}')">
                            <i class='fas fa-trash-alt'></i>
                        </button>
                    </div>
                </div>`;
    const lines_div = document.getElementById('lines_list');
    if (main_input.value !== '') {
        lines_div.insertAdjacentHTML('beforeend', line);
        main_input.value = '';
        i++;
        main_input.focus();
    }
}

function deleteLine(id) {
    document.getElementById(id).remove();
}

var j = 0;
const update_items = document.getElementById('update_items');
if (update_items) {
    j = parseInt(update_items.value);
}
function addItem() {
    const element_input = document.getElementById('item_element_main');
    const element_text = $("#item_element_main option:selected").text();
    const unit_input = document.getElementById('item_unit_main');
    const code_input = document.getElementById('item_code_main');
    const price_input = document.getElementById('item_price_main');
    const date_input = document.getElementById('item_date_main');
    const last_price_input = document.getElementById('item_lastprice_main');
    const last_date_input = document.getElementById('item_lastdate_main');

    const new_element_text = `<td><input type="text" class="form-control" name="item_element_text" aria-invalid="false" value='${element_text}' readonly></td>`;
    const new_element_value = `<input type="hidden" name="item_element[]" value='${element_input.value}'>`;
    const new_unit = `<td><input type="number" class="form-control" name="item_unit[]" aria-invalid="false" value='${unit_input.value}' onkeypress="return onlyNumbers(event)"></td>`;
    const new_code = `<td><input type="text" class="form-control" name="item_code[]" aria-invalid="false" value='${code_input.value}'></td>`;
    const new_price = `<td><input type="text" class="form-control" name="item_price[]" aria-invalid="false" value='${price_input.value}' onkeypress="return onlyNumbers(event)"></td>`;
    const new_date = `<td><input type="date" class="form-control" name="item_date[]" aria-invalid="false" value='${date_input.value}'></td>`;
    const new_price_last = `<td><input type="text" class="form-control" name="item_price_last[]" aria-invalid="false" value='${last_price_input.value}' onkeypress="return onlyNumbers(event)"></td>`;
    const new_date_last = `<td><input type="date" class="form-control" name="item_date_last[]" aria-invalid="false" value='${last_date_input.value}'></td>`;
    const delete_button = `<td><button class="btn btn-link" title='Eliminar' aria-label='Eliminar'data-pjax='0' onclick="deleteLine('item${j}')"><i class='fas fa-trash-alt'></i></button></td>`;
    const row_item = `<tr id='item${j}'>` + new_element_text + new_element_value + new_unit + new_code + new_price + new_date + new_price_last + new_date_last + delete_button + '</tr>';

    const tbody = document.getElementById('table_item_body');
    if (element_input.value !== '') {
        tbody.insertAdjacentHTML('beforeend', row_item);
        unit_input.value = '';
        code_input.value = '';
        price_input.value = '';
        date_input.value = '';
        last_price_input.value = '';
        last_date_input.value = '';
        j++;
    } else {
        alert('Debe seleccionar un elemento');
    }
}

var k = 0;
const update_purchased = document.getElementById('update_purchased');
if (update_purchased) {
    k = parseInt(update_purchased.value);
}
function addPurchasedItem() {
    const purch_code_input = document.getElementById('purchased_code_main');
    const purch_product_input = document.getElementById('purchased_product_main');
    const purch_unit_input = document.getElementById('purchased_unit_main');
    const purch_date_input = document.getElementById('purchased_date_main');
    const purch_docnumber_input = document.getElementById('purchased_docnum_main');
    const purch_price_input = document.getElementById('purchased_price_main');
    const purch_movetype_input = document.getElementById('purchased_movetype_main');

    const new_purch_code = `<td><input type="text" class="form-control" name="purch_code[]" aria-invalid="false" value='${purch_code_input.value}'></td>`;
    const new_purch_product = `<td><input type="text" class="form-control" name="purch_product[]" aria-invalid="false" value='${purch_product_input.value}'></td>`;
    const new_purch_unit = `<td><input type="number" class="form-control" name="purch_unit[]" aria-invalid="false" value='${purch_unit_input.value}' onkeypress="return onlyNumbers(event)"></td>`;
    const new_purch_date = `<td><input type="date" class="form-control" name="purch_date[]" aria-invalid="false" value='${purch_date_input.value}'></td>`;
    const new_purch_docnumber = `<td><input type="text" class="form-control" name="purch_docnumber[]" aria-invalid="false" value='${purch_docnumber_input.value}' onkeypress="return onlyNumbers(event)"></td>`;
    const new_purch_price = `<td><input type="text" class="form-control" name="purch_price[]" aria-invalid="false" value='${purch_price_input.value}' onkeypress="return onlyNumbers(event)"></td>`;
    const new_purch_movetype = `<td><input type="text" class="form-control" name="purch_movetype[]" aria-invalid="false" value='${purch_movetype_input.value}'></td>`;
    const delete_button = `<td><button type="button" class="btn btn-link" title='Eliminar' aria-label='Eliminar'data-pjax='0' onclick="deleteLine('purch${k}')"><i class='fas fa-trash-alt'></i></button></td>`;
    const row_item = `<tr id='purch${k}'>` + new_purch_code + new_purch_product + new_purch_unit + new_purch_date + new_purch_docnumber + new_purch_price + new_purch_movetype + delete_button + '</tr>';

    const tbody = document.getElementById('table_purch_body');
    tbody.insertAdjacentHTML('beforeend', row_item);
    purch_code_input.value = '';
    purch_product_input.value = '';
    purch_unit_input.value = '';
    purch_date_input.value = '';
    purch_docnumber_input.value = '';
    purch_price_input.value = '';
    purch_movetype_input.value = '';
    k++;
}

function onlyNumbers(evt) {
    const charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode != 46 && charCode > 31
            && (charCode < 48 || charCode > 57))
        return false;
    return true;
}