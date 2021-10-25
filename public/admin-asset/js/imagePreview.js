const previewImg = () => {
    const image = document.querySelector(".img-input");
    const imgPreview = document.querySelector(".img-preview");
    const imgContainer = document.querySelector(".img-container");

    imgContainer.classList.remove("d-none");
    imgContainer.classList.add("d-flex");
    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;
    };
};
