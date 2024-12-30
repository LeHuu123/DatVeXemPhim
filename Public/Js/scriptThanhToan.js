import header from './base.js';

header("booking__numberOne", "booking__beforeOne", "booking__numberTwo");
header("booking__numberTwo", "booking__beforeTwo", "booking__numberThree");
header("booking__numberThree", "booking__beforeThree", "booking__numberFour");


var khachHang = document.querySelector('.khachHang');
var sdt = document.querySelector('#sdt');
var ten = document.querySelector('.name');
khachHang.addEventListener('change', (e) => {
  if (e.target.value.trim("") == 'Khách vãng lai') {
    sdt.disabled = true;
    ten.disabled = true;
  }
  else if (e.target.value.trim("") == 'Khách bình thường') {
    sdt.disabled = false;
    ten.disabled = false;
  }
})

// var sdt = document.querySelector('#sdt');
// var ten = document.querySelector('#name').value;
// var submit = document.querySelector('.submit');
// var par1 = document.querySelector('.parent_mess1');
// var par2 = document.querySelector('.parent_mess2');
// var phone = "asskkljhkl";
// var reg1 = /^[0]\d{9}$/;
// var reg2 = /^[a-zA-Z]{1,}$/;
// console.log(phone.search(reg2));
// submit.addEventListener("click" , (e) => {
//   if(sdt.value.search(reg1) == -1){
//     par1.setAttribute("style" , "visibility: visible;");
//     e.preventDefault();
//   }
// });


// var a = document.querySelector("Body");
// var cnt = 0;
// a.addEventListener('click', () => {
//   console.log("dasdsa");
//     if (cnt == 0) {
//       let par1 = document.querySelector('.parent_mess1');
//         par1.setAttribute("style" , "visibility: hidden;");
//         cnt++;
//     }

// });



