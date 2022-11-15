
function mask(name_type) {
    var name = name_type.value;
    var matches = name.match(/\b(\w)/g);
    var letters = matches.join('');    
    const mask_input = document.getElementById('documenttype-mask');
    mask_input.value = letters.toUpperCase();
}