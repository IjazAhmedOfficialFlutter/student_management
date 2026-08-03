function previewImage(inputId, imageId) {

    const input = document.getElementById(inputId);

    if (!input) return;

    input.addEventListener('change', function () {

        if (!this.files.length) return;

        const reader = new FileReader();

        reader.onload = function (e) {

            document.getElementById(imageId).src = e.target.result;

        };

        reader.readAsDataURL(this.files[0]);

    });

}