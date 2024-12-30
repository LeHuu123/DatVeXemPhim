

var header = (nu , be , nu1) =>{
    var number = document.querySelector(`.${nu}`);
    var before = document.querySelector(`.${be}`);
    
    number.innerHTML = `<i class="fa-solid fa-check"></i>`;
    number.setAttribute("style", " background-color:  rgba(0, 255, 255, 0.192);");
    before.setAttribute("style", " background-color: aqua;");
    
    var number1 = document.querySelector(`.${nu1}`);
    number1.setAttribute("style", " background-color: aqua;");
}

var number = (nu) => {
    var number = document.querySelector(`.${nu}`);
    number.setAttribute("style", " background-color: aqua;");
}


export default  header ; number ;

