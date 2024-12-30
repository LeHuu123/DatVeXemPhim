var demSoGheDaDat = 0;
var ghe = document.querySelectorAll(`.ghe__item`);
ghe.forEach(element => {

    if(element.getAttribute("daDat") == 1){
        element.setAttribute("style", "background-color:red;");
        demSoGheDaDat++;
    }
})

export var demSoGheDaDat;