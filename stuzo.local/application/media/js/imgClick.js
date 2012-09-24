function changePicture() {
    var firstImg = document.getElementById("imgBlock").children[0];
    (firstImg.style.display == "none") ? firstImg.style.display = "block"
                                       : firstImg.style.display = "none";
}
