//**********************************GLOBAL VARIABLES AND ARRAYS*****************************************//
//Expenses List
//general
var i = 1;
var j = 0;
var sum = 0; //partial price with expenses
const partial_input = document.getElementById('partial_input'); //input that displays the partial price
const partial_div = document.getElementById('partial_div');
const table_div_exp = document.getElementById('div_table_exp');
const table_exp_body = document.getElementById('table_exp_body');
//arrays to stock the expenses list data
const account_array = [];
const concept_array = [];
const price_array = [];
const center_array = [];
//form inputs
const account_input = document.getElementById('w1');
const concept_input = document.getElementById('expenses_concept');
const price_input = document.getElementById('expenses_price');
const center_input = document.getElementById('w2');
//inputs with the db data and variables to count and fill main data array (for update)
const expenses_account = document.getElementById("update_exp_account");
const expenses_concept = document.getElementById("update_exp_concept");
const expenses_price = document.getElementById("update_exp_price");
const expenses_cc = document.getElementById("update_exp_cc");
var account_number = 0;
var concept_number = 0;
var price_number = 0;
var center_number = 0;

//Taxes List
//general
var k = 1;
var l = 0;
var total_taxes = 0;
var total = 0; //expenses + taxes
const total_aux = document.getElementById('total_aux'); //input that shows the total with expenses + taxes
const total_input = document.getElementById('invoices-total_price'); //input to stock the total price data to be sent
const liquidation_main_div = document.getElementById('liquidation_concepts');
const table_div = document.getElementById('div_table_concepts');
const table_concepts_body = document.getElementById('table_concepts_body');
const th_array_taxes = document.getElementsByClassName('row_concepts');
//arrays to stock the taxes list data
const tax_concept_array = [];
const base_value_array = [];
const tax_price_array = [];
const account_affects_array = [];
const thirds_array = [];
const cc_array = [];
const date_array = [];
const observation_array = [];
const sign_array = [];
//form inputs
const tax_concept_input = document.getElementById('w3');
const base_value_input = document.getElementById('base_value');
const percentage_input = document.getElementById('percentage');
const sign_input = document.getElementById('sign');
const tax_value_input = document.getElementById('tax_value');
const account_select_input = document.getElementById('w4');
const third_input = document.getElementById('w5');
const min_base_input = document.getElementById('min_base_value');
const mov_type_input = document.getElementById('movement_type');
const observation_input = document.getElementById('observation');
const auto = document.getElementById('auto_calc');
const cc_input = document.getElementById('cc_active');
const date_input = document.getElementById('w6');
//inputs with the db data and variables to count and fill main data array (for update)
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

//Payment
var subtraction = 1;
const payment_main_div = document.getElementById('payment_main_div');
const subtract_input = document.getElementById('subtraction'); //Input that shows the remaining price to pay
const cashpay_div = document.getElementById('cashpay');
const cashbank_div = document.getElementById('cashbank');
const cashbill_div = document.getElementById('cashbill');
//form inputs
const cash_input = document.getElementById('invoices-cash');
const cash_bank_input = document.getElementById('invoices-cash_payment_bank');
const cash_bill_input = document.getElementById('invoices-bill_to_pay');

//Submit
const submit_button = document.getElementById('button_submit');
//***********************************************************************************//


//*********************************FUNCTIONS*****************************************//
//General
//allow only numerical values in input
function isNumberKey(evt) {
    const charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode != 46 && charCode > 31
            && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

//Form General
//generate unique doc number
function invoicesDoc(id) {
    $.ajax({
        type: "GET",
        url: "typedocument",
        data: {id: id},
        dataType: "json",
        success: function (data) {
            const mask = data[0];
            const max = data[1];
            const numbers = parseInt(max.replace(/\D/g, "")) + 1;
            const letters = mask.replace(/[^a-zA-Z]+/g, '');
            const doc_number = `${letters}-${numbers}`;
            const doc_input = document.getElementById('invoices-doc_number');
            doc_input.value = doc_number;
        }
    })
}
//generate municipality list
function deptsFunction(dept) {
    $.ajax({
        type: "GET",
        url: "municipality",
        data: {id: dept},
        dataType: "json",
        success: function (data) {
            const muni = document.getElementById('invoices-fk_municipality');
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

//Expenses List
//add expense to list
function addExpense() {
    //formatting the data from form inputs
    const account_text = account_input.options[account_input.selectedIndex].text;
    const center_text = center_input.options[center_input.selectedIndex].text;
    const price_format = parseFloat(price_input.value).toFixed(2);
    //add expense
    if (account_input.value !== '' && center_input.value !== '' && price_input.value !== '' && concept_input.value !== '') {
        account_array[j] = account_input.value;
        concept_array[j] = concept_input.value;
        price_array[j] = price_input.value;
        center_array[j] = center_input.value;
        const content = `<tr id='expense${j}'>
      <th scope="row" class="row_num">${i}</th>
      <td>${account_text}</td>
      <td>${concept_input.value}</td>
      <td>${price_format.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</td>
      <td>${center_text}<button class="btn btn-link float_right btn_concepts" title='Eliminar' aria-label='Eliminar'data-pjax='0' onclick="deleteExpense(${j})"><i class='fas fa-trash-alt'></i></button></td>
    </tr>`;
        table_exp_body.insertAdjacentHTML('beforeend', content);
        //actions after adding expense element in arrays and webpage table
        const price = parseFloat(price_input.value);
        calculatePartial('add', price);
        concept_input.value = '';
        price_input.value = '';
        i++;
        j++;
    } else {
        alert('Faltan campos por llenar');
    }
}
//delete expense from list
function deleteExpense(id) {
    //recalculate partial value
    const price = parseFloat(price_array[id]);
    calculatePartial('sub', price);
    //removing element from table list and from array
    document.getElementById(`expense${id}`).remove();
    delete account_array[id];
    delete concept_array[id];
    delete price_array[id];
    delete center_array[id];
    i--;
    //reorganize the number of the rows of the expenses list
    const th_array = document.getElementsByClassName('row_num');
    for (var n = 0; n < th_array.length; n++) {
        th_array[n].innerHTML = n + 1;
    }
}
//recalculate partial price
function calculatePartial(operation, price) {
    if (operation === 'add') {
        sum += price;
    } else if (operation === 'sub') {
        sum -= price;
    }
    const sum_format = sum.toFixed(2);
    partial_input.value = sum_format.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    expensesTable();
    calculateTotal('', '');
}
//show-hide expenses table and taxes form
function expensesTable() {
    if (sum == 0) {
        partial_div.classList.add('d-none');
        table_div_exp.classList.add('d-none');
        liquidation_main_div.classList.add('d-none');
        return false;
    } else {
        partial_div.classList.remove('d-none');
        table_div_exp.classList.remove('d-none');
        liquidation_main_div.classList.remove('d-none');
        return true;
    }
}

//Taxes List
//fill and setup the form inputs with the data from the db of selected concept
function conceptTaxes(id_concept) {
    $.ajax({
        type: "GET",
        url: "taxconcept",
        data: {id: id_concept.value},
        dataType: "json",
        success: function (data) {
            base_value_input.value = sum;
            sign_input.value = data.sign;
            percentage_input.value = data.percentage;
            const tax_value = (parseFloat(data.percentage) / 100) * base_value_input.value;
            const tax_format = tax_value.toFixed(2);
            tax_value_input.value = tax_format.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            account_select_input.value = data.account;
            const account_select_text = account_select_input.options[account_select_input.selectedIndex].text;
            const account_select = document.getElementById("select2-w4-container");
            account_select.innerHTML = account_select_text;
            third_input.value = 3;
            const third_select_text = third_input.options[third_input.selectedIndex].text;
            const third_select = document.getElementById("select2-w5-container");
            third_select.innerHTML = third_select_text;
            const min_base_format = parseFloat(data.min_value).toFixed(2);
            min_base_input.value = min_base_format.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            mov_type_input.value = data.movement_type;
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
//manual-auto calculate the tax value
function autoCalc() {
    if (auto.value == '0') {
        $("#tax_value").prop('readonly', false);
    } else {
        $("#tax_value").prop('readonly', true);
        const tax_value = (percentage_input.value / 100) * base_value_input.value;
        const tax_format = tax_value.toFixed(2);
        tax_value_input.value = tax_format.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
}
//add concept to list and concept arrays
function addConcept() {
    //formatting the data from form inputs
    const concept_text = tax_concept_input.options[tax_concept_input.selectedIndex].text;
    const account_text = account_select_input.options[account_select_input.selectedIndex].text;
    const third_text = third_input.options[third_input.selectedIndex].text;
    const base_value_format = parseFloat(base_value_input.value).toFixed(2);
    const min_base_format = parseFloat(min_base_input.value.replace(/,/g, '')).toFixed(2);
    //add tax to list
    if (tax_concept_input.value !== '' && base_value_input.value !== '' && percentage_input.value !== '' && tax_value_input.value !== '' && account_select_input.value !== '' && third_input.value !== '' && mov_type_input.value !== '') {
        tax_concept_array[l] = tax_concept_input.value;
        base_value_array[l] = base_value_input.value;
        tax_price_array[l] = tax_value_input.value.replace(/,/g, '');
        account_affects_array[l] = account_select_input.value;
        thirds_array[l] = third_input.value;
        cc_array[l] = cc_input.value;
        date_array[l] = date_input.value;
        observation_array[l] = observation_input.value;
        sign_array[l] = sign_input.value;
        const base_value_formatted = base_value_format;
        const content = `<tr id='concept${l}'>
            <th scope="row" class="row_concepts">${k}</th>
            <td>${concept_text}</td>
            <td><input type='text' value='${base_value_formatted}' class='form-control' style='width: 130px; height: 25px;' onchange="calculateTaxValue(this.value, '${l}', '${percentage_input.value}', '${sign_input.value}')"></td>
            <td>${percentage_input.value}%</td>
            <td id='tax_value${l}'>${sign_input.value}${tax_value_input.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</td>
            <td>${account_text}</td>
            <td>${third_text}</td>
            <td>${cc_input.value}</td>
            <td>${date_input.value}</td>
            <td>${mov_type_input.value}</td>
            <td>${min_base_format.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</td>
            <td class='table_invoices_description'>${observation_input.value}<button class="btn btn-link float_right btn_concepts" title='Eliminar' aria-label='Eliminar'data-pjax='0' onclick="deleteConcept(${l})"><i class='fas fa-trash-alt'></i></button></td>      
          </tr>`;
        table_concepts_body.insertAdjacentHTML('beforeend', content);
        //actions after adding element
        const tax_price = parseFloat(tax_value_input.value.replace(/,/g, ''));
        calculateTotal(sign_input.value, tax_price);
        cc_input.value = '';
        date_input.value = '';
        observation_input.value = '';
        k++;
        l++;
    } else {
        alert('Faltan campos por llenar');
    }
}
//delete concept from list and arrays
function deleteConcept(id) {
    //recalculate total
    const tax_price = parseFloat(tax_price_array[id].replace(/,/g, ''));
    var delete_sign = '';
    if (sign_array[id] == '-') {
        delete_sign = '+';
    } else if (sign_array[id] == '+') {
        delete_sign = '-';
    }
    calculateTotal(delete_sign, tax_price);
    //delete element
    document.getElementById(`concept${id}`).remove();
    delete tax_concept_array[id];
    delete base_value_array[id];
    delete tax_price_array[id];
    delete account_affects_array[id];
    delete thirds_array[id];
    delete cc_array[id];
    delete date_array[id];
    delete observation_array[id];
    delete sign_array[id];
    k--;
    taxesTable();
    //reorganize row numbers from the table list    
    for (var m = 0; m < th_array_taxes.length; m++) {
        th_array_taxes[m].innerHTML = m + 1;
    }
}
//recalculate total price
function calculateTotal(sign, price) {    
    if (sign == '-') {
        total_taxes -= parseFloat(price);
    } else if (sign == '+') {
        total_taxes += parseFloat(price);
    }    
    total = sum + total_taxes;    
    const total_format = total.toFixed(2);
    total_input.value = total_format;
    total_aux.value = total_format.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    taxesTable();
    calculateSubtraction();
}
//show-hide taxes table and payment form
function taxesTable() {
    if (th_array_taxes.length == 0) {
        payment_main_div.classList.add('d-none');
        table_div.classList.add('d-none');
        return false;
    } else {
        table_div.classList.remove('d-none');
        payment_main_div.classList.remove('d-none');
        return true;
    }
}
function calculateTaxValue(base_value, number_element, percentage, sign) {
    //recalculate subtracting previous value
    var delete_sign = '';
    if (sign == '-') {
        delete_sign = '+';
    } else if (sign == '+') {
        delete_sign = '-';
    }
    calculateTotal(delete_sign, parseFloat(tax_price_array[number_element]));
    //calculate new value
    const tax_price = parseFloat(base_value.replace(/,/g, '')) * (parseFloat(percentage) / 100);
    const tax_price_format = tax_price.toFixed(2);
    //save new values in main arrays
    base_value_array[number_element] = base_value;
    tax_price_array[number_element] = tax_price_format;
    //display new value
    const tax_value_id = `tax_value${number_element}`;
    const td_value = document.getElementById(tax_value_id);
    td_value.innerHTML = sign + tax_price_format.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    //recalculate total with new values
    calculateTotal(sign, tax_price_format);
}

//Payment
function cashPayment() {
    if (cash_input.value !== '0' && cash_input.value !== '') {
        cashpay_div.classList.remove('d-none');
    } else {
        cashpay_div.classList.add('d-none');
    }
    calculateSubtraction();
}
function bankPayment() {
    if (cash_bank_input.value !== '0' && cash_bank_input.value !== '') {
        cashbank_div.classList.remove('d-none');
    } else {
        cashbank_div.classList.add('d-none');
    }
    calculateSubtraction();
}
function billPayment() {
    if (cash_bill_input.value !== '0' && cash_bill_input.value !== '') {
        cashbill_div.classList.remove('d-none');
    } else {
        cashbill_div.classList.add('d-none');
    }
    calculateSubtraction();
}
//recalculate subtraction
function calculateSubtraction() {
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
    const subtraction_format = subtraction.toFixed(2);
    subtract_input.value = subtraction_format.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    checkSubtraction();
}
//check subtraction to enable submit button
function checkSubtraction() {
    const min_expenses = expensesTable();
    const min_taxes = taxesTable();
    if (subtract_input.value == '0.00' && min_expenses && min_taxes) {
        submit_button.disabled = false;
    } else {
        submit_button.disabled = true;
    }
}

//Submit
function submitForm() {
    //format expenses list data and put in the inputs to be sent
    const final_account_array = account_array.flat();
    const final_concept_array = concept_array.flat();
    const final_price_array = price_array.flat();
    const final_center_array = center_array.flat();
    $('#accounts_hidden').val(JSON.stringify(final_account_array));
    $('#concepts_hidden').val(JSON.stringify(final_concept_array));
    $('#prices_hidden').val(JSON.stringify(final_price_array));
    $('#centers_hidden').val(JSON.stringify(final_center_array));
    //format taxes list data and put in the inputs to be sent
    const final_tax_concept_array = tax_concept_array.flat();
    const final_base_value_array = base_value_array.flat();
    const final_tax_price_array = tax_price_array.flat();
    const final_account_affects_array = account_affects_array.flat();
    const final_thirds_array = thirds_array.flat();
    const final_cc_array = cc_array.flat();
    const final_date_array = date_array.flat();
    const final_observation_array = observation_array.flat();
    $('#tax_concept_hidden').val(JSON.stringify(final_tax_concept_array));
    $('#base_value_hidden').val(JSON.stringify(final_base_value_array));
    $('#tax_price_hidden').val(JSON.stringify(final_tax_price_array));
    $('#account_affects_hidden').val(JSON.stringify(final_account_affects_array));
    $('#thirds_hidden').val(JSON.stringify(final_thirds_array));
    $('#cc_hidden').val(JSON.stringify(final_cc_array));
    $('#date_hidden').val(JSON.stringify(final_date_array));
    $('#observation_hidden').val(JSON.stringify(final_observation_array));
    //invoke submit function after validate form
    $("#w0").yiiActiveForm("validate", true);
    setTimeout(finalSubmit, 500);
}
function finalSubmit() {
    const inputs_error = document.getElementsByClassName('form-control is-invalid');
    if (inputs_error.length == 0) {
        document.getElementById("w0").submit();
    }
}
//*******************************************************************************************//


//*************************************UPDATE DATA******************************************//
//Expenses
if (expenses_account) {
    //take the data from the inputs with the db data
    const up_account_array = expenses_account.value.split(',');
    const up_concept_array = expenses_concept.value.split(',');
    const up_price_array = expenses_price.value.split(',');
    const up_cc_array = expenses_cc.value.split(',');
    //put the data in main arrays for data management
    up_account_array.forEach(upAccount);
    up_concept_array.forEach(upConcept);
    up_price_array.forEach(upPrice);
    up_cc_array.forEach(upCenter);
    function upAccount(item) {
        account_array[account_number] = item;
        account_number++;
        i++;
        j++;
    }
    function upConcept(item) {
        concept_array[concept_number] = item;
        concept_number++;
    }
    function upPrice(item) {
        price_array[price_number] = item;
        price_number++;
        //calculate partial price
        const item_format = parseFloat(item);
        calculatePartial('add', item_format);
    }
    function upCenter(item) {
        center_array[center_number] = item;
        center_number++;
    }
}
//Taxes
if (ut_concept) {
    //take the data from the inputs with the db data
    const ut_concept_array = ut_concept.value.split(',');
    const ut_base_array = ut_base.value.split(',');
    const ut_value_array = ut_value.value.split(',');
    const ut_account_array = ut_account.value.split(',');
    const ut_third_array = ut_third.value.split(',');
    const ut_center_array = ut_center.value.split(',');
    const ut_date_array = ut_date.value.split(',');
    const ut_observation_array = ut_observation.value.split(',');
    const ut_sign_array = ut_sign.value.split(',');
    //put the data in main arrays for data management
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
        //calculate total price
        const price = parseFloat(tax_price_array[ut_sign_number]);
        calculateTotal(item, price);
        ut_sign_number++;
    }
}