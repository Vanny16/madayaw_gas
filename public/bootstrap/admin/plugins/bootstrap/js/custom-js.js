function displayImage(img_src){
    document.getElementById("modal-img-item").src=img_src;
}

(function() {
    const form = document.querySelector('.required-checkbox');
    const checkboxes = form.querySelectorAll('input[type=checkbox]');
    const checkboxLength = checkboxes.length;
    const firstCheckbox = checkboxLength > 0 ? checkboxes[0] : null;

    function init() {
        if (firstCheckbox) {
            for (let i = 0; i < checkboxLength; i++) {
                checkboxes[i].addEventListener('change', checkValidity);
            }

            checkValidity();
        }
    }

    function isChecked() {
        for (let i = 0; i < checkboxLength; i++) {
            if (checkboxes[i].checked) return true;
        }

        return false;
    }

    function checkValidity() {
        const errorMessage = !isChecked() ? 'Select at least one checkbox.' : '';
        firstCheckbox.setCustomValidity(errorMessage);
    }

    init();
})();

function setCategory(amenity_category){
    document.getElementById("amenity_category").value = amenity_category;
}
