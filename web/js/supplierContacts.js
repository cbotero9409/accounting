
function modalContacts(action_controller) {
    $('#contactsModal').modal('show')
            .find('#contacts_modal_content')
            .load(action_controller);
}
;

function createContact() {
    var name = document.getElementById('contacts-name').value;
    var person_type = document.getElementById('contacts-person_type').value;
    var cellphone = document.getElementById('contacts-cell_phone').value;
    var phone = document.getElementById('contacts-phone').value;
    var email = document.getElementById('contacts-email').value;
    var address = document.getElementById('contacts-address').value;
    var supplier_id = document.getElementById('supplier_id').value;
    $.ajax({
        type: "POST",
        url: "createcontact",
        data: {name: name, person_type: person_type, cellphone: cellphone, phone: phone, email: email, address: address, supplier_id: supplier_id},
        dataType: "json",
        success: function (id) {
            if (isNaN(id) === false) {
                var db_contacts = document.getElementById('db_contacts');
                var new_contact = "<tr id='contact" + id + "'><td>" + name + "</td><td>" + person_type + "</td><td>" + cellphone + "</td><td>" + phone + "</td><td>" + email + "</td><td>" + address + "</td><td><button class='btn btn-link' value='viewcontact?id_contact=" + id + "' title='Modificar' aria-label='Modificar'data-pjax='0' onclick='modalContacts(this.value)'><i class='fas fa-pencil-alt'></i></button><button class='btn btn-link' title='Eliminar' aria-label='Eliminar'data-pjax='0' onclick='deleteContact(" + id + ")'><i class='fas fa-trash-alt'></i></button></td></tr>";
                db_contacts.insertAdjacentHTML('beforeend', new_contact);
                $('#contactsModal').modal('hide')
            }
        },
        error: function (errors) {
            alert(errors);
        }
    })
}

function updateContact(id) {
    var name = document.getElementById('contacts-name').value;
    var person_type = document.getElementById('contacts-person_type').value;
    var cellphone = document.getElementById('contacts-cell_phone').value;
    var phone = document.getElementById('contacts-phone').value;
    var email = document.getElementById('contacts-email').value;
    var address = document.getElementById('contacts-address').value;
    $.ajax({
        type: "POST",
        url: "updatecontact",
        data: {name: name, person_type: person_type, cellphone: cellphone, phone: phone, email: email, address: address, id: id},
        dataType: "json",
        success: function (data) {
            if (data == true) {
                var updated_contact = "<tr id='contact" + id + "'><td>" + name + "</td><td>" + person_type + "</td><td>" + cellphone + "</td><td>" + phone + "</td><td>" + email + "</td><td>" + address + "</td><td><button class='btn btn-link' value='viewcontact?id_contact=" + id + "' title='Modificar' aria-label='Modificar'data-pjax='0' onclick='modalContacts(this.value)'><i class='fas fa-pencil-alt'></i></button><button class='btn btn-link' title='Eliminar' aria-label='Eliminar'data-pjax='0' onclick='deleteContact(" + id + ")'><i class='fas fa-trash-alt'></i></button></td></tr>";
                var contact_id = "contact" + id;
                document.getElementById(contact_id).innerHTML = updated_contact;
                $('#contactsModal').modal('hide');
            }
        },
        error: function (errors) {
            alert(errors);
        }
    })
}

function deleteContact(id) {
    var confirmation = confirm("Está seguro de que desea eliminar este contacto?");
    if (confirmation === true) {
        $.ajax({
            type: "GET",
            url: "deletecontacts",
            data: {id: id},
            dataType: "json",
            success: function () {
                var contact = "contact" + id;
                document.getElementById(contact).remove();
            }
        })
    }
}