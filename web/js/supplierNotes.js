
function modalNotes(action_controller) {
    $('#notesModal').modal('show')
            .find('#notes_modal_content')
            .load(action_controller);
}
;

function createNote() {
    var note = document.getElementById('notes-note').value;
    var public = document.getElementById('notes-public').value;
    var supplier_id = document.getElementById('supplier_id').value;
    var public_print = '';
    if (public == 1) {
        public_print = ' (Pública)';
    }
    $.ajax({
        type: "POST",
        url: "createnote",
        data: {supplier_id: supplier_id, note: note, public: public},
        dataType: "json",
        success: function (id) {
            if (isNaN(id) === false) {
                var db_notes = document.getElementById('db_notes');
                var new_note = "<div class='row my-2 p-4 border rounded bg-light' id='note" + id + "'><div class='col-12'><div class='row'><div class='col-12'>Hace un momento<span class='text-warning notes_public'>&nbsp" + public_print + "</span><button class='btn btn-link float_right' title='Eliminar' aria-label='Eliminar'data-pjax='0' onclick='deleteNote(" + id + ")'><i class='fas fa-trash-alt'></i></button><button class='btn btn-link float_right' value='viewnote?id_note=" + id + "' title='Modificar' aria-label='Modificar'data-pjax='0' onclick='modalNotes(this.value)'><i class='fas fa-pencil-alt'></i></button></div></div><div class='row'><div class='col-12'>" + note + "</div></div></div></div>"
                db_notes.insertAdjacentHTML('afterbegin', new_note);
                $('#notesModal').modal('hide')
            }
        },
        error: function (errors) {
            alert(errors);
        }
    })
}

function updateNote(id, date) {
    var note = document.getElementById('notes-note').value;
    var public = document.getElementById('notes-public').value;
    var public_print = '';
    if (public == 1) {
        public_print = ' (Pública)';
    }
    $.ajax({
        type: "POST",
        url: "updatenote",
        data: {note: note, public: public, id: id},
        dataType: "json",
        success: function (data) {
            if (data == true) {
                var updated_note = "<div class='col-12'><div class='row'><div class='col-12'>" + date + "<span class='text-warning notes_public'>&nbsp" + public_print + "</span><button class='btn btn-link float_right' title='Eliminar' aria-label='Eliminar'data-pjax='0' onclick='deleteNote(" + id + ")'><i class='fas fa-trash-alt'></i></button><button class='btn btn-link float_right' title='Modificar' value='viewnote?id_note=" + id + "' aria-label='Modificar'data-pjax='0' onclick='modalNotes(this.value)'><i class='fas fa-pencil-alt'></i></button></div></div><div class='row'><div class='col-12'>" + note + "</div></div></div>";
                var note_id = "note" + id;
                document.getElementById(note_id).innerHTML = updated_note;
                $('#notesModal').modal('hide');
            }
        },
        error: function (errors) {
            alert(errors);
        }
    })
}

function deleteNote(id) {
    var confirmation = confirm("Está seguro de que desea eliminar esta nota?");
    if (confirmation === true) {
        $.ajax({
            type: "GET",
            url: "deletenotes",
            data: {id: id},
            dataType: "json",
            success: function () {
                var note = "note" + id;
                document.getElementById(note).remove();
            }
        })
    }
}