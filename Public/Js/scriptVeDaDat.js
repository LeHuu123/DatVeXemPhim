console.log("sadsadsadasd");
var traVe_main = document.querySelector(".traVe_main");
var huy = document.querySelector(".traVe_huy");
var traVe = document.querySelector(".traVe");
var callTraVe = document.querySelector(".callTraVe");
var idVe = document.querySelector("#idVe");
var tenPhim = document.querySelector("#tenPhim");
var suatChieu = document.querySelector("#suatChieu");
var soGhe = document.querySelector("#soGhe");
var comBo = document.querySelector("#comBo");
var tongTien = document.querySelector("#tongTien");


huy.addEventListener("click" , () => {
    traVe.classList.add("disbleNone_traVe");


})

callTraVe.addEventListener("click" , () => {
    traVe.classList.remove("disbleNone_traVe");

})

var callTraVeList = document.querySelectorAll(".callTraVe");

callTraVeList.forEach(element => {
    console.log(element);
    element.addEventListener("click" , (e) => {

        traVe.classList.remove("disbleNone_traVe");
        traVe.classList.add("disble_traVe");

        var parentElement = e.target.parentElement.parentElement.parentElement;
        idVe.value = parentElement.getAttribute("idVe");
        tenPhim.value = parentElement.getAttribute("tenPhim");
        suatChieu.value = parentElement.getAttribute("suatChieu");
        soGhe.value = parentElement.getAttribute("soGhe");
        comBo.value = parentElement.getAttribute("comBo");
        tongTien.value = parentElement.getAttribute("tongTien");
    })
});

