const expenses_account = document.getElementById("update_exp_account");
const expenses_concept = document.getElementById("update_exp_concept");
const expenses_price = document.getElementById("update_exp_price");
const expenses_cc = document.getElementById("update_exp_cc");
var account_number = 0;
var concept_number = 0;
var price_number = 0;
var center_number = 0;
const account_array = [];
const concept_array = [];
const price_array = [];
const center_array = [];
var j = 0;
var i = 1;
var sum = 0;
const partial_input = document.getElementById('partial_input');

if (expenses_account) {
    var up_account_array = expenses_account.value.split(',');
    var up_concept_array = expenses_concept.value.split(',');
    var up_price_array = expenses_price.value.split(',');
    var up_cc_array = expenses_cc.value.split(',');
    up_account_array.forEach(upAccount);
    up_concept_array.forEach(upConcept);
    up_price_array.forEach(upPrice);
    up_cc_array.forEach(upCenter);
    function upAccount(item) {
        account_array[account_number] = item;
        account_number++;
        j++;
        i++;
    }
    function upConcept(item) {
        concept_array[concept_number] = item;
        concept_number++;
    }
    function upPrice(item) {
        price_array[price_number] = item;
        price_number++;
        sum += parseFloat(item);
    }
    function upCenter(item) {
        center_array[center_number] = item;
        center_number++;
    }
    sum_format = sum.toFixed(2);
    partial_input.value = sum_format.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

const ut_concept = document.getElementById("update_tax_concept");
const ut_base = document.getElementById("update_tax_base");
const ut_value = document.getElementById("update_tax_value");
const ut_account = document.getElementById("update_tax_account");
const ut_third = document.getElementById("update_tax_third");
const ut_center = document.getElementById("update_tax_center");
const ut_date = document.getElementById("update_tax_date");
const ut_observation = document.getElementById("update_tax_observation");
const ut_sign = document.getElementById("update_tax_sign");
var ut_concept_number = 0;
var ut_base_number = 0;
var ut_value_number = 0;
var ut_account_number = 0;
var ut_third_number = 0;
var ut_center_number = 0;
var ut_date_number = 0;
var ut_observation_number = 0;
var ut_sign_number = 0;
const tax_concept_array = [];
const base_value_array = [];
const tax_price_array = [];
const account_affects_array = [];
const thirds_array = [];
const cc_array = [];
const date_array = [];
const observation_array = [];
const sign_array = [];
var k = 1;
var l = 0;
var total = 0;
const total_aux = document.getElementById('total_aux');
const total_input = document.getElementById('invoices-total_price');
const subtract_input = document.getElementById('subtraction');
const cash_input = document.getElementById('invoices-cash');
const cash_bank_input = document.getElementById('invoices-cash_payment_bank');
const cash_bill_input = document.getElementById('invoices-bill_to_pay');
const submit_button = document.getElementById('button_submit');
if (ut_concept) {
    total = sum;
    var ut_concept_array = ut_concept.value.split(',');
    var ut_base_array = ut_base.value.split(',');
    var ut_value_array = ut_value.value.split(',');
    var ut_account_array = ut_account.value.split(',');
    var ut_third_array = ut_third.value.split(',');
    var ut_center_array = ut_center.value.split(',');
    var ut_date_array = ut_date.value.split(',');
    var ut_observation_array = ut_observation.value.split(',');
    var ut_sign_array = ut_sign.value.split(',');
    ut_concept_array.forEach(utConcept);
    ut_base_array.forEach(utBase);
    ut_value_array.forEach(utValue);
    ut_account_array.forEach(utAccount);
    ut_third_array.forEach(utThird);
    ut_center_array.forEach(utCenter);
    ut_date_array.forEach(utDate);
    ut_observation_array.forEach(utObservation);
    ut_sign_array.forEach(utSign);
    function utConcept(item) {
        tax_concept_array[ut_concept_number] = item;
        ut_concept_number++;
        k++;
        l++;
    }
    function utBase(item) {
        base_value_array[ut_base_number] = item;
        ut_base_number++;
    }
    function utValue(item) {
        tax_price_array[ut_value_number] = item;
        ut_value_number++;
    }
    function utAccount(item) {
        account_affects_array[ut_account_number] = item;
        ut_account_number++;
    }
    function utThird(item) {
        thirds_array[ut_third_number] = item;
        ut_third_number++;
    }
    function utCenter(item) {
        cc_array[ut_center_number] = item;
        ut_center_number++;
    }
    function utDate(item) {
        date_array[ut_date_number] = item;
        ut_date_number++;
    }
    function utObservation(item) {
        observation_array[ut_observation_number] = item;
        ut_observation_number++;
    }
    function utSign(item) {
        sign_array[ut_sign_number] = item;
        if (sign_array[ut_sign_number] == '+') {
            total += parseFloat(tax_price_array[ut_sign_number]);
        } else if (sign_array[ut_sign_number] == '-') {
            total -= parseFloat(tax_price_array[ut_sign_number]);
        }
        ut_sign_number++;
    }
    total_format = total.toFixed(2);
    total_input.value = total_format;
    total_aux.value = total_format.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    var subtraction = total;
    if (cash_input.value !== '') {
        subtraction -= parseFloat(cash_input.value);
    }
    if (cash_bank_input.value !== '') {
        subtraction -= parseFloat(cash_bank_input.value);
    }
    if (cash_bill_input.value !== '') {
        subtraction -= parseFloat(cash_bill_input.value);
    }
    subtraction_format = subtraction.toFixed(2);
    subtract_input.value = subtraction_format.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    if (subtract_input.value == '0.00') {
        submit_button.disabled = false;
    } else {
        submit_button.disabled = true;
    }
}

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode != 46 && charCode > 31
            && (charCode < 48 || charCode > 57))
        return false;
    return true;
}


function invoicesDoc(id) {
    $.ajax({
        type: "GET",
        url: "typedocument",
        data: {id: id},
        dataType: "json",
        success: function (data) {
            var mask = data[0];
            var max = data[1];
            var numbers = parseInt(max.replace(/\D/g, "")) + 1;
            var letters = mask.replace(/[^a-zA-Z]+/g, '');
            var doc_number = `${letters}-${numbers}`;
            const doc_input = document.getElementById('invoices-doc_number');
            doc_input.value = doc_number;
        }
    })
}

function deptsFunction(dept) {
    $.ajax({
        type: "GET",
        url: "municipality",
        data: {id: dept},
        dataType: "json",
        success: function (data) {
            var muni = document.getElementById('invoices-fk_municipality');
            $("#invoices-fk_municipality").empty();
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

const partial_div = document.getElementById('partial_div');
const table_div_exp = document.getElementById('div_table_exp');
const liquidation_main_div = document.getElementById('liquidation_concepts');

function addExpense() {
    const account_input = document.getElementById('w1');
    const concept_input = document.getElementById('expenses_concept');
    const price_input = document.getElementById('expenses_price');
    const center_input = document.getElementById('w2');
    var account_text = account_input.options[account_input.selectedIndex].text;
    var center_text = center_input.options[center_input.selectedIndex].text;
    const table_exp_body = document.getElementById('table_exp_body');
    var price_format = parseFloat(price_input.value).toFixed(2);

    if (account_input.value !== '' && center_input.value !== '' && price_input.value !== '' && concept_input.value !== '') {
        account_array[j] = account_input.value;
        concept_array[j] = concept_input.value;
        price_array[j] = price_input.value;
        center_array[j] = center_input.value;

        var content = `<tr id='expense${j}'>
      <th scope="row" class="row_num">${i}</th>
      <td>${account_text}</td>
      <td>${concept_input.value}</td>
      <td>${price_format.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</td>
      <td>${center_text}<button class="btn btn-link float_right btn_concepts" title='Eliminar' aria-label='Eliminar'data-pjax='0' onclick="deleteExpense(${j})"><i class='fas fa-trash-alt'></i></button></td>
    </tr>`;
        table_exp_body.insertAdjacentHTML('beforeend', content);

        if (price_input.value !== '') {
            sum += parseFloat(price_input.value);
            sum_format = sum.toFixed(2);
            partial_input.value = sum_format.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            partial_div.classList.remove('d-none');
            table_div_exp.classList.remove('d-none');
            liquidation_main_div.classList.remove('d-none');
            total = sum;
        }

        concept_input.value = '';
        price_input.value = '';
        i++;
        j++;
        if (subtract_input.value == '0.00') {
            submit_button.disabled = false;
        } else {
            submit_button.disabled = true;
        }

    } else {
        alert('Faltan campos por llenar');
    }

}

function deleteExpense(id) {
    document.getElementById(`expense${id}`).remove();
    sum = sum - parseFloat(price_array[id]);
    sum_format = sum.toFixed(2);
    partial_input.value = sum_format.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    total = sum;

    delete account_array[id];
    delete concept_array[id];
    delete price_array[id];
    delete center_array[id];

    if (sum == 0) {
        partial_div.classList.add('d-none');
        table_div_exp.classList.add('d-none');
        liquidation_main_div.classList.add('d-none');
    }

    var th_array = document.getElementsByClassName('row_num');
    for (var n = 0; n < th_array.length; n++) {
        th_array[n].innerHTML = n + 1;
    }
    i--;
    if (subtract_input.value == '0.00') {
        submit_button.disabled = false;
    } else {
        submit_button.disabled = true;
    }
}

const concept_input = document.getElementById('w3');
const base_value_input = document.getElementById('base_value');
const percentage_input = document.getElementById('percentage');
const sign_input = document.getElementById('sign');
const tax_value_input = document.getElementById('tax_value');
const account_select_input = document.getElementById('w4');
const third_input = document.getElementById('w5');
const min_base_input = document.getElementById('min_base_value');
const mov_type_input = document.getElementById('movement_type');
const observation_input = document.getElementById('observation');
const payment_main_div = document.getElementById('payment_main_div');

function conceptTaxes(id_concept) {
    base_value_input.value = sum;
    $.ajax({
        type: "GET",
        url: "taxconcept",
        data: {id: id_concept.value},
        dataType: "json",
        success: function (data) {
            percentage_input.value = data.percentage;
            sign_input.value = data.sign;
            var tax_value = (parseFloat(data.percentage) / 100) * base_value_input.value;
            var tax_format = tax_value.toFixed(2);
            tax_value_input.value = tax_format.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            account_select_input.value = data.account;
            var min_base_format = parseFloat(data.min_value).toFixed(2);
            min_base_input.value = min_base_format.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            mov_type_input.value = data.movement_type;
            third_input.value = 3;

            const account_select = document.getElementById("select2-w4-container");
            var account_select_text = account_select_input.options[account_select_input.selectedIndex].text;
            account_select.innerHTML = account_select_text;
            const third_select = document.getElementById("select2-w5-container");
            var third_select_text = third_input.options[third_input.selectedIndex].text;
            third_select.innerHTML = third_select_text;

            if (data.movement_type == 'Débito') {
                $("#w5").prop('disabled', true);
                $("#cc_active").prop('readonly', false);
                $("#w6").prop('disabled', true);
            } else if (data.movement_type == 'Crédito') {
                $("#w5").prop('disabled', false);
                $("#cc_active").prop('readonly', true);
                $("#w6").prop('disabled', false);
            }
        }
    })
}

function autoCalc() {
    const auto = document.getElementById('auto_calc');
    if (auto.value == '0') {
        $("#tax_value").prop('readonly', false);
    } else {
        $("#tax_value").prop('readonly', true);
        var tax_value = (percentage_input.value / 100) * base_value_input.value;
        var tax_format = tax_value.toFixed(2);
        tax_value_input.value = tax_format.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
}

function addConcept() {
    const table_div = document.getElementById('div_table_concepts');
    var concept_text = concept_input.options[concept_input.selectedIndex].text;
    var account_text = account_select_input.options[account_select_input.selectedIndex].text;
    var third_text = third_input.options[third_input.selectedIndex].text;
    const cc_input = document.getElementById('cc_active');
    const date_input = document.getElementById('w6');
    const table_concepts_body = document.getElementById('table_concepts_body');
    var base_value_format = parseFloat(base_value_input.value).toFixed(2);
    var min_base_format = parseFloat(min_base_input.value.replace(/,/g, '')).toFixed(2);
    var sign = '';

    if (concept_input.value !== '' && base_value_input.value !== '' && percentage_input.value !== '' && tax_value_input.value !== '' && account_select_input.value !== '' && third_input.value !== '' && mov_type_input.value !== '') {
        table_div.classList.remove('d-none');
        if (sign_input.value == '-') {
            sign = '-';
        } else if (sign_input.value == '+') {
            sign = '+';
        }

        var content = `<tr id='concept${l}'>
      <th scope="row" class="row_concepts">${k}</th>
      <td>${concept_text}</td>
      <td>${base_value_format.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</td>
      <td>${percentage_input.value}%</td>
      <td>${sign}${tax_value_input.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</td>
      <td>${account_text}</td>
      <td>${third_text}</td>
      <td>${cc_input.value}</td>
      <td>${date_input.value}</td>
      <td>${mov_type_input.value}</td>
      <td>${min_base_format.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</td>
      <td class='table_invoices_description'>${observation_input.value}<button class="btn btn-link float_right btn_concepts" title='Eliminar' aria-label='Eliminar'data-pjax='0' onclick="deleteConcept(${l})"><i class='fas fa-trash-alt'></i></button></td>      
    </tr>`;

        if (sign_input.value == '-') {
            total -= parseFloat(tax_value_input.value.replace(/,/g, ''));
        } else if (sign_input.value == '+') {
            total += parseFloat(tax_value_input.value.replace(/,/g, ''));
        }
        var total_format = total.toFixed(2);
        total_input.value = total_format;
        total_aux.value = total_format.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        subtraction = total;
        if (cash_input.value !== '') {
            subtraction -= parseFloat(cash_input.value);
        }
        if (cash_bank_input.value !== '') {
            subtraction -= parseFloat(cash_bank_input.value);
        }
        if (cash_bill_input.value !== '') {
            subtraction -= parseFloat(cash_bill_input.value);
        }
        subtraction_format = subtraction.toFixed(2);
        subtract_input.value = subtraction_format.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        tax_concept_array[l] = concept_input.value;
        base_value_array[l] = base_value_input.value;
        tax_price_array[l] = tax_value_input.value.replace(/,/g, '');
        account_affects_array[l] = account_select_input.value;
        thirds_array[l] = third_input.value;
        cc_array[l] = cc_input.value;
        date_array[l] = date_input.value;
        observation_array[l] = observation_input.value;
        sign_array[l] = sign_input.value;

        payment_main_div.classList.remove('d-none');

        k++;
        l++;

        table_concepts_body.insertAdjacentHTML('beforeend', content);
        cc_input.value = '';
        date_input.value = '';
        observation_input.value = '';
        if (subtract_input.value == '0.00') {
            submit_button.disabled = false;
        } else {
            submit_button.disabled = true;
        }
    } else {
        alert('Faltan campos por llenar');
    }
}

function deleteConcept(id) {
    document.getElementById(`concept${id}`).remove();

    if (sign_array[id] == '-') {
        total += parseFloat(tax_price_array[id].replace(/,/g, ''));
    } else if (sign_array[id] == '+') {
        total -= parseFloat(tax_price_array[id].replace(/,/g, ''));
    }
    var total_format = total.toFixed(2);
    total_input.value = total_format;
    total_aux.value = total_format.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    subtraction = total;
    if (cash_input.value !== '') {
        subtraction -= parseFloat(cash_input.value);
    }
    if (cash_bank_input.value !== '') {
        subtraction -= parseFloat(cash_bank_input.value);
    }
    if (cash_bill_input.value !== '') {
        subtraction -= parseFloat(cash_bill_input.value);
    }
    subtraction_format = subtraction.toFixed(2);
    subtract_input.value = subtraction_format.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");


    delete tax_concept_array[id];
    delete base_value_array[id];
    delete tax_price_array[id];
    delete account_affects_array[id];
    delete thirds_array[id];
    delete cc_array[id];
    delete date_array[id];
    delete observation_array[id];
    delete sign_array[id];

    var th_array = document.getElementsByClassName('row_concepts');
    if (th_array.length == 0) {
        payment_main_div.classList.add('d-none');
    }
    for (var m = 0; m < th_array.length; m++) {
        th_array[m].innerHTML = m + 1;
    }
    k--;
    if (subtract_input.value == '0.00') {
        submit_button.disabled = false;
    } else {
        submit_button.disabled = true;
    }
}

function cashPayment() {
    const cashpay_div = document.getElementById('cashpay');
    var total_payment = total - cash_input.value - cash_bank_input.value - cash_bill_input.value;
    var total_payment_format = total_payment.toFixed(2);
    subtract_input.value = total_payment_format.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    if (cash_input.value !== '0' && cash_input.value !== '') {
        cashpay_div.classList.remove('d-none');
    } else {
        cashpay_div.classList.add('d-none');
    }
    if (subtract_input.value == '0.00') {
        $("#button_submit").prop('disabled', false);
    } else {
        $("#button_submit").prop('disabled', true);
    }
}

function bankPayment() {
    const cashbank_div = document.getElementById('cashbank');
    var total_payment = total - cash_input.value - cash_bank_input.value - cash_bill_input.value;
    var total_payment_format = total_payment.toFixed(2);
    subtract_input.value = total_payment_format.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    if (cash_bank_input.value !== '0' && cash_bank_input.value !== '') {
        cashbank_div.classList.remove('d-none');
    } else {
        cashbank_div.classList.add('d-none');
    }
    if (subtract_input.value == '0.00') {
        $("#button_submit").prop('disabled', false);
    } else {
        $("#button_submit").prop('disabled', true);
    }
}

function billPayment() {
    const cashbill_div = document.getElementById('cashbill');
    var total_payment = total - cash_input.value - cash_bank_input.value - cash_bill_input.value;
    var total_payment_format = total_payment.toFixed(2);
    subtract_input.value = total_payment_format.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    if (cash_bill_input.value !== '0' && cash_bill_input.value !== '') {
        cashbill_div.classList.remove('d-none');
    } else {
        cashbill_div.classList.add('d-none');
    }
    if (subtract_input.value == '0.00') {
        $("#button_submit").prop('disabled', false);
    } else {
        $("#button_submit").prop('disabled', true);
    }
}

function submitForm() {
    var final_account_array = account_array.flat();
    var final_concept_array = concept_array.flat();
    var final_price_array = price_array.flat();
    var final_center_array = center_array.flat();
    $('#accounts_hidden').val(JSON.stringify(final_account_array));
    $('#concepts_hidden').val(JSON.stringify(final_concept_array));
    $('#prices_hidden').val(JSON.stringify(final_price_array));
    $('#centers_hidden').val(JSON.stringify(final_center_array));

    var final_tax_concept_array = tax_concept_array.flat();
    var final_base_value_array = base_value_array.flat();
    var final_tax_price_array = tax_price_array.flat();
    var final_account_affects_array = account_affects_array.flat();
    var final_thirds_array = thirds_array.flat();
    var final_cc_array = cc_array.flat();
    var final_date_array = date_array.flat();
    var final_observation_array = observation_array.flat();
    $('#tax_concept_hidden').val(JSON.stringify(final_tax_concept_array));
    $('#base_value_hidden').val(JSON.stringify(final_base_value_array));
    $('#tax_price_hidden').val(JSON.stringify(final_tax_price_array));
    $('#account_affects_hidden').val(JSON.stringify(final_account_affects_array));
    $('#thirds_hidden').val(JSON.stringify(final_thirds_array));
    $('#cc_hidden').val(JSON.stringify(final_cc_array));
    $('#date_hidden').val(JSON.stringify(final_date_array));
    $('#observation_hidden').val(JSON.stringify(final_observation_array));

    $("#w0").yiiActiveForm("validate", true);
    setTimeout(finalSubmit, 500);

}

function finalSubmit() {
    var inputs_error = document.getElementsByClassName('form-control is-invalid');
    if (inputs_error.length == 0) {
        document.getElementById("w0").submit();
    }
}
