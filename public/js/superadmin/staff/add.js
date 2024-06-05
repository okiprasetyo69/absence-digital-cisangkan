
$(document).ready(function () {
    //alert('test');

});

function previewImage() {
    document.getElementById("image-preview").style.display = "block";
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("photo").files[0]);
    oFReader.onload = function(oFREvent) {
        document.getElementById("image-preview").src = oFREvent.target.result;
    };
}
