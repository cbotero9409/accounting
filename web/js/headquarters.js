function deptsFunction(dept) {
    $.ajax({
        type: "GET",
        url: "municipality",
        data: {id: dept},
        dataType: "json",
        success: function (data) {
            var muni = document.getElementById('headquarters-fk_municipality');
            $("#headquarters-fk_municipality").empty();
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

const count_categories = document.getElementById('count_categories');
if (count_categories) {
    var i = parseInt(count_categories.value);
} else {
    var i = 0;
}
function addCategory() {
    const tbody = document.getElementById('table_cat_body');
    var row = `<tr id="category${i}">
                            <td><input type="text" name="categ_code[]" id="categ_code${i}" class="form-control"></td>
                            <td><input type="text" name="categ_name[]" id="categ_name${i}" class="form-control"></td>
                            <td><input type="text" name="categ_short[]" id="categ_short${i}" class="form-control"></td>
                            <td><input type="text" name="categ_type[]" id="categ_type${i}" class="form-control"></td>
                            <td><input type="text" name="categ_manager[]" id="categ_manager${i}" class="form-control"></td>
                            <td><input type="text" name="categ_img[]" id="categ_img${i}" class="form-control"></td>
                            <td><button class='btn btn-link' title='Eliminar' aria-label='Eliminar'data-pjax='0' onclick='deleteCategory(${i})'><i class='fas fa-trash-alt'></i></button></td>
                        </tr>`;
    tbody.insertAdjacentHTML('beforeend', row);
    i++;
}

function deleteCategory(row_id) {
    document.getElementById(`category${row_id}`).remove();
}