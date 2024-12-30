import header from "./base.js";
header("booking__numberOne", "booking__beforeOne", "booking__numberTwo");
header("booking__numberTwo", "booking__beforeTwo", "booking__numberThree");

// import { a } from "./scriptSuatChieu.js";
// var demSoGheDaDat = 0;
// console.log(a);
// export var demSoGheDaDat = 0 ;

var price = document.querySelector("#ThongTin__price");


// định dạng tiền 
function formatPrice ( pri){
    return pri.replace(/\B(?=(\d{3})+(?!\d))/g, ',') + "đ";
}



//  Chọn ghế 
var ghe = document.querySelectorAll(`.ghe__item`);
var soGheMain = document.querySelector('#soGhe');
var soGheValue = soGheMain.value;
var count = 0;
var priceNew = 0;
var soGhe = "";


var soGhe_arr = "";
if (soGheMain.value != "Trống") {
     soGhe_arr =  soGheMain.value.split(" - ");
}


var j = 0;
// count = parseInt(price.value.split("Đ"));
count = "";

var priceTmp1 = price.value.split(',');
let d1 = 0;
priceTmp1.forEach((element) => {
    if(d1 == priceTmp1.length - 1){
        count += (element.split('đ'))[0];
    }
    else {
        count += element;
    }
    d1++;
    
});

count = parseInt(count);


ghe.forEach(element => {

    if(element.getAttribute("daDat") == 1){
        element.setAttribute("style", "background-color:red;");
        // demSoGheDaDat++;
    }
    else{
    
    if(soGhe_arr != ""){
        soGhe_arr.forEach((e) => {
            if (e.trim() == element.getAttribute("soGhe")) {
                element.setAttribute("style", "background-color:#6495ED;");
                element.setAttribute("check", "0");
    
                // count += parseInt(element.getAttribute("price"));
                if (j == 0) {
                    soGhe += e;
                }
                else {
                    soGhe += " - " + e;
                }
                j++;
            }
        })
    }


    element.addEventListener("click", () => {
        
        if (element.firstElementChild.className != "ghe__kyTu") {
            if (element.getAttribute("check") == "1") {
                element.setAttribute("style", "background-color:#6495ED;");
                count += parseInt(element.getAttribute("price"));
                element.setAttribute("check", "0");
                priceNew = count;
                price.value = priceNew + " Đ";

                price.value = price.value = formatPrice((priceNew+""));




                if (soGheValue.trim() == "Trống") {
                    soGhe += element.getAttribute("char") + element.getAttribute("number");
                    soGheValue = "";
                }
                else {
                    // soGheValue = soGheValue +  ;
                    soGhe += " - " + element.getAttribute("char") + element.getAttribute("number");
                }
                if (soGhe.trim() == "") soGhe = "Trống";
                // if(soGheMain.value == "Trống"){
                //     soGheMain.value = "";
                // }
                soGhe = soGhe.split("Trống - ").join("");
                soGheMain.value = soGhe.trim("");
            }
            else {
                element.setAttribute("style", "background-color:white;");
                count -= parseInt(element.getAttribute("price"));
                element.setAttribute("check", "1");
                priceNew = count;
                price.value = priceNew + " Đ";

                price.value = price.value = formatPrice((priceNew+""));
           

                let a = " - " + element.getAttribute("char") + element.getAttribute("number");
                soGhe = ((soGhe.split(a))).join("");
                soGhe = ((soGhe.split(element.getAttribute("char") + element.getAttribute("number") + " - "))).join("");
                soGhe = ((soGhe.split(element.getAttribute("char") + element.getAttribute("number")))).join("");
                if (soGhe.trim() == "") soGhe = "Trống";

                soGheMain.value = soGhe.trim();
            }
        }

    

 
    })
}
});

// end chọn ghế 

// chọn combo 


var soLuong = document.querySelectorAll(".soLuong");
var comBoItem = document.querySelectorAll(".ComBo__item");
// var tongMain = parseInt(price.value.split("Đ"));
var tongMain = "";


// chuyển định dạng tiền từ strng thành int 
var priceTmp = price.value.split(',');
let d = 0;
priceTmp.forEach((element) => {
    if(d == priceTmp.length - 1){
        tongMain += (element.split('đ'))[0];
        console.log(d +": " + (element.split('đ'))[0] ) ;
    }
    else {
        tongMain += element;
    }
    d++;
    
});

tongMain = parseInt(tongMain);
console.log("asdasd: " + tongMain);


var chonComBo = document.querySelector("#comBo");

// console.log(chonComBo.value);   
var comBotmp = "";
if (chonComBo.value.trim() != "không có") {
    comBotmp = chonComBo.value.split(", ");
    // console.log(comBotmp);
}



 

let s = Array(soLuong.length).fill('');

soLuong.forEach((e, index) => {
    var k = 0;
    var par = e.parentElement.parentElement;
    let tongTmp = 0;
    var arrComBo = [];
    let comBo = "";
    if (comBotmp != []) {
        console.log("dffd" +  comBotmp);
        comBotmp.forEach((item) => {
            var item_Arr = item.split(" - ");
            

            if (item_Arr[0] == par.getAttribute("combo")) {
                e.value = item_Arr[1];

                s[index] = item;
                let gia = par.getAttribute("donGia") * e.value;
                par.children[3].innerHTML = (gia) + "đ";
                k = e.value;
            }
        })
    }
    e.addEventListener("change", () => {

       

        let tong = par.getAttribute("tong");
        let donGia = par.getAttribute("donGia");
        comBo = par.getAttribute("combo");
      
        var chil = par.children;
        if (e.value > k) {
            tongMain += parseInt(donGia);
            // tongTmp += parseInt(donGia);
            tongTmp = parseInt(donGia) * e.value;
            k = e.value;
          
            comBo += " - " + k;
        }
        else {
            tongMain -= parseInt(donGia);
            // tongTmp -= parseInt(donGia);
            tongTmp = parseInt(donGia) * e.value;
            k = e.value;
            comBo += " - " + k;
          
        }
        chil[3].innerHTML = (tongTmp) + "đ";
        price.value = tongMain +" Đ";

        price.value = formatPrice(tongMain+"");
        s[index] = comBo;

        let res = "";
        for (let i = 0; i < s.length; i++) {
            if (s[i]) {
                if (i != s.length - 1) {
                    res += s[i] + ", ";
                }
                else res += s[i];
            }
        }
        chonComBo.value = res;
    })
})

// check chon ghe 

var checkGhe = document.querySelector('#submit_ChonGhe');
console.log(soGheMain.value);
if(checkGhe != null){
    checkGhe.addEventListener("click" , () => {
        if(soGheMain.value.trim("") == "Trống"){
            confirm("Vui lòng bạn chọn ít nhất một ghế!");
        }
    })
}






