function deptsFunction(dept) {
    $.ajax({
        type: "GET",
        url: "municipality",
        data: {id: dept},
        dataType: "json",
        success: function (data) {
            var muni = document.getElementById('company-fk_municipality');            
            $("#company-fk_municipality").empty();
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