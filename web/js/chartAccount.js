const concept_array = [];
var concepts = document.getElementById("update_concepts");
if (concepts) {
    var concept_string = concepts.value;
    var array = concept_string.split(',');
    array.forEach(arrayConfig);
    function arrayConfig(item) {
        concept_array[item] = item;
    }
}
const account_select = document.getElementById('chartaccounts-fk_account');

function selectAccount(account) {
    const text = account.options[account.selectedIndex].text;
    var text_format = text.substring(0, text.indexOf(" "));
    const account_value = account.value;
    $.ajax({
        type: "GET",
        url: "account",
        data: {id: account.value},
        dataType: "json",
        success: function (data) {
            $("#chartaccounts-fk_account").empty();
            if (text !== 'Volver') {
                let option1 = document.createElement('option');
                option1.text = text;
                option1.value = account_value;
                account_select.add(option1);
                Object.keys(data).forEach(function (key) {
                    let option = document.createElement('option');
                    option.text = data[key];
                    option.value = key;
                    account_select.add(option);
                })
                let option = document.createElement('option');
                option.text = "Volver";
                option.value = '0';
                account_select.add(option);
            } else {
                let option = document.createElement('option');
                option.text = "Seleccionar Cuenta";
                account_select.add(option);
                Object.keys(data).forEach(function (key) {
                    let option = document.createElement('option');
                    option.text = data[key];
                    option.value = key;
                    account_select.add(option);
                })
                let option1 = document.createElement('option');
                option1.text = "Mostrar Todas";
                option1.value = "all";
                account_select.add(option1);
            }
        }
    })
    accountName(account.value);
}

function addAccount(account_id) {
    const main_div = document.getElementById('main_div');
    main_div.classList.remove('d-none');
    const button_submit = document.getElementById('button_submit');
    button_submit.disabled = false;
    accountName(account_id);
}

function accountName(id) {
    $.ajax({
        type: "GET",
        url: "addaccount",
        data: {id: id},
        dataType: "json",
        success: function (data) {
            let max = parseInt(data.max_code);
            if (data.max_code == null) {
                data.acc_code += '05';
                max = data.acc_code;
            } else {
                if (max > 1000) {
                    max += 5;
                } else {
                    max += 1;
                }
            }
            const code_input = document.getElementById('chartaccounts-code');
            code_input.value = max;
        }
    })
}

function selectClass(account_class) {
    var account_class_1 = document.getElementById('account_class_1');
    var account_class_3 = document.getElementById('account_class_3');
    var account_class_5 = document.getElementById('account_class_5');
    if (account_class == 1) {
        account_class_1.classList.remove('d-none');
    } else {
        account_class_1.classList.add('d-none');
    }
    if (account_class == 3) {
        account_class_3.classList.remove('d-none');
        document.getElementById('chartaccounts-fk_tax').required = true;
    } else {
        account_class_3.classList.add('d-none');
        document.getElementById('chartaccounts-fk_tax').required = false;
    }
    if (account_class == 5) {
        account_class_5.classList.remove('d-none');
    } else {
        account_class_5.classList.add('d-none');
    }
}

function addConcept(concept) {
    var concept_text = concept.options[concept.selectedIndex].text;
    var concept_value = concept.value;
    var concept_list = document.getElementById('concepts_list');
    if (concept_text !== 'Agregar Concepto' && !(concept_array.includes(concept_value))) {
        concept_array[concept_value] = concept_value;
        var element = `<div class="row py-2 bg-light border rounded" id="concept${concept_value}">
                <div class="col-12">
                    ${concept_text}
                    <button class="btn btn-link float_right btn_concepts" title='Eliminar' aria-label='Eliminar'data-pjax='0' onclick="deleteConcept(${concept_value})"><i class='fas fa-trash-alt'></i></button>
                </div>
            </div>`
        concept_list.insertAdjacentHTML('beforeend', element);
    }
}

function deleteConcept(id_concept) {
    document.getElementById(`concept${id_concept}`).remove();
    delete concept_array[id_concept];
}

function inputConcepts() {
    var final_array = concept_array.flat();
    $('#concepts_input').val(JSON.stringify(final_array));
}


function selectTax(tax)
{
    setTimeout(function () {
        if (tax.value !== '')
        {
            document.getElementById('taxfeed').innerHTML = '';
        } else
        {
            document.getElementById('chartaccounts-fk_tax').required = 'required';
            document.getElementById('chartaccounts-fk_tax').className = 'form-control pgtion is-invalid';
            tax.className = "form-control pgtion is-invalid";
            document.getElementById('taxfeed').className = 'invalid-feedback d-block texInval';
            document.getElementById('taxfeed').innerHTML = 'Valor de Impuesto Requerido';
            tax.focus();
        }
    }, 500);
}