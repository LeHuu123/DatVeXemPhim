import { demSoGheDaDat } from "./demSoGheDaDat.js";

import header from "./base.js";
// import  demSoGheDaDat  from "./scriptChonGheMain.js";
// console.log("dsadsa: " + demSoGheDaDat);
// var ngayDuocChon ;
// Chon ngay 
var chonNgay = document.querySelectorAll('.booking__box');
const time = new Date();
let y = time.getFullYear();
let mounth = time.getMonth() + 1;
let day = time.getDate();
if (day < 10) {
    day = "0" + day;
}
if (mounth < 10) {
    mounth = "0" + mounth;
}
var ngayHt = y + "-" + mounth + "-" + day;
var ngayHienTai = ngayHt;
// console.log(ngayHt + " fddffff");
var checkNgay = false;
let demGhe = 0;

const d = new Date();
let h = d.getHours();
let m = d.getMinutes();
let s = d.getSeconds();
if (parseInt(m) < 10) {
    m = "0" + m;
}
let timeNow = h + "" + m;


var hour = document.querySelectorAll('.gio');

function kiemTraNgayClick() {
    for (const el of hour) {
        let time = el.innerText;
        time = time.split(":");
        time = time[0] + time[1];

        if (parseInt(timeNow) <= parseInt(time) || ngayHienTai > ngayHt) {
            // el.classList.add("");

            el.classList.remove('color-three');
            el.classList.remove('color_main');
            el.classList.add('color-two');

        }
        else {
            el.classList.remove('color-two');
            el.classList.remove('color-three');
            el.classList.add('color_main');

        }
    }
}
kiemTraNgayClick();
chonNgay.forEach((e) => {
    // console.log(ngayHt);
    if (e.getAttribute('ngay').trim() == ngayHt.trim("")) {
        e.childNodes[1].setAttribute("style", "background-color: aqua;");
        e.setAttribute("check", "0");
        checkNgay = true;
    }

    e.addEventListener("click", (item) => {
        let chill = e.querySelector('.booking__day');
        if (e.getAttribute("check") == '1') {
            ngayHienTai = e.getAttribute("ngay");
            chonNgay.forEach((element) => {
                let chill_day = element.querySelector('.booking__day');
                chill_day.setAttribute("style", "background-color: gray;");
                element.setAttribute("check", "1");
            })
            chill.setAttribute("style", "background-color: aqua;");
            e.setAttribute("check", "0");
            checkNgay = true;

            kiemTraNgayClick();

        }
        else {
            chill.setAttribute("style", "background-color: gray;");
            e.setAttribute("check", "1");
            checkNgay = false;
            console.log(checkNgay);
        }


        for (const date_chill of date.children) {

            let gio = date_chill.innerText;
            let e1 = date_chill.querySelector(".gio");
            // console.log(e1);

            if (date.className != date_chill.className && checkNgay == true) {
                let arr_checkSoLuong = e1.getAttribute("checkSoLuongGhe").split("!");
                arr_checkSoLuong.forEach(e => {
                    let ngay = e.split(",")[0];

                    if (ngay.trim() != "") {

                        let thoiGian = (e.split(",")[1]).split("-")[0];
                        thoiGian = thoiGian.split(":")[0] + ":" + thoiGian.split(":")[1];


                        if (ngay.trim() == ngayHienTai && gio.trim() == thoiGian.trim()) {
                            let soGhe = e.split(",")[2];
                            soGhe = soGhe.split("-")
                            soGhe.forEach(el => {
                                if (el.trim() != '') {
                                    demGhe += 1;
                                    console.log(el + " " + demGhe);
                                }
                            })
                        }
                    }
                })
                let time1 = gio.split(":");
                time1 = time1[0] + time1[1];
                console.log("dem ghe: " + demGhe);
                let clas = e1.classList;
                console.log(clas);
                if (demGhe == 72) {
                    if (parseInt(timeNow) < parseInt(time1) || ngayHienTai > ngayHt) {
                        console.log(e1);

                        e1.setAttribute("checkGhe", "0");
                        e1.classList.remove('color-two');
                        e1.classList.remove('color_main');
                        e1.classList.add("color-three");
                    }
                }
 
                else if (demGhe < 72) {
                    if (ngayHienTai == ngayHt) {
                        e1.setAttribute("checkGhe", "1");
                        e1.classList.remove('color-two');
                        e1.classList.remove('color-three');
                        // e1.classList.add("color_main");
                        e1.classList.add("color-two");
                    }
                }

                demGhe = 0;
            }
        }
    })
})





var date = document.querySelector(".booking__hourlist");
var getDate = (e) => {
    let time = e.target.innerText;
    time = time.split(":");
    time = time[0] + time[1];
    return time;
}

date.addEventListener("mouseover", (e) => {
    // console.log(demGhe + " dddd");
    if (e.target.className != date.className) {
        let time = getDate(e);
        let ck = e.target.getAttribute("checkGhe");
        if (parseInt(timeNow) > parseInt(time)) {
            e.target.setAttribute("style", "cursor: not-allowed");
            e.target.setAttribute("checkHover", "0");
        }
        else {
            e.target.setAttribute("style", "cursor: pointer");
            e.target.setAttribute("checkHover", "1");
        }

        if (ngayHienTai > ngayHt) {
            e.target.setAttribute("style", "cursor: pointer");
            e.target.setAttribute("checkHover", "1");
        }
        else if (parseInt(timeNow) < parseInt(time) && ngayHienTai == ngayHt) {
            e.target.setAttribute("style", "cursor: pointer");
            e.target.setAttribute("checkHover", "1");
        }
        else {
            e.target.setAttribute("style", "cursor: not-allowed");
            e.target.setAttribute("checkHover", "0");
        }

        if (ck == "0") {
            e.target.setAttribute("style", "cursor: not-allowed");
            e.target.setAttribute("checkHover", "0");
        }
    }
})

date.addEventListener("click", (e) => {

    if (date.className != e.target.className) {
        if (e.target.getAttribute("checkHover") == "1" && e.target.getAttribute("checkGhe") == "1") {
            // if (e.target.getAttribute("checkClick") == "1") {

            // e.target.setAttribute("class", "color");
            e.target.setAttribute("checkClick", "0");
            if (e.target.getAttribute("checkPhim") == '0') {
                let id = e.target.getAttribute('id');
                // if (!checkNgay) {
                //     confirm("Xin vui lòng chọn một ngày !");
                //     return;
                // }

                if (checkNgay == false) {
                    confirm("Xin vui lòng chọn một ngày !");
                    e.target.setAttribute("href", "#");
                }
                else {
                    e.target.setAttribute("href", "http://localhost/Bai_Tap_Lon_Web/home/index/?page=DatVe&pageDatVe=ChonGheMain&pageChonGhe=ChonGhe&idPhim=" + `${id}` + "&NgayHienTai=" + `${ngayHienTai}`);
                }
            }
            else {
                let id = e.target.getAttribute('id');
                let idSc = e.target.getAttribute('idSuatChieu');
                if (checkNgay == false) {
                    confirm("Xin vui lòng chọn một ngày !");
                    e.target.setAttribute("href", "#");
                }
                else {
                    e.target.setAttribute("href", "http://localhost/Bai_Tap_Lon_Web/home/index/?page=DatVe&pageDatVe=ChonGheMain&pageChonGhe=ChonGhe" + "&idPhim=" + `${id}` + "&idSuatChieu=" + `${idSc}` + "&NgayHienTai=" + `${ngayHienTai}`);
                }
            }
            // }
            // else {
            //     e.target.setAttribute("class", "color-two");
            //     e.target.setAttribute("checkClick", "1");
            // }
        }
    }
})


// var hour = document.querySelectorAll('.gio');
// for (const el of hour) {
//     let time = el.innerText;
//     time = time.split(":");
//     time = time[0] + time[1];

//     if (parseInt(timeNow) <= parseInt(time) || ngayHienTai > ngayHt ) {
//         el.setAttribute("class", "color-two");
//     }
// }

// kiểm tra số lượng ghế đã đặt 
// date.addEventListener("click", (e) => {
//     let gio = e.target.innerText;
//     if (date.className != e.target.className && checkNgay == true) {
//         console.log(e.target.getAttribute("checkSoLuongGhe"));
//         let arr_checkSoLuong = e.target.getAttribute("checkSoLuongGhe").split("!");
//         let demGhe = 0;
//         arr_checkSoLuong.forEach(e => {
//             let ngay = e.split(",")[0];

//             if (ngay.trim() != "") {

//                 let thoiGian = (e.split(",")[1]).split("-")[0];
//                 thoiGian = thoiGian.split(":")[0] +":" +  thoiGian.split(":")[1];
//                 // console.log(thoiGian);
//                 console.log("ngay: " + ngay + " thoi gian: "  + thoiGian);
//                 if (ngay.trim() == ngayHienTai && gio.trim() == thoiGian.trim()){
//                     let soGhe = e.split(",")[2];
//                     soGhe = soGhe.split("-")
//                     soGhe.forEach(el => {
//                         if(el.trim() != ''){
//                             demGhe += 1;
//                         }
//                     })

//                 }
//             }
//         })
//         let time1 = gio.split(":");
//         time1 = time1[0] + time1[1];
//         // console.log(demGhe + " ddeeeeeee");
//         // console.log(timeNow + " timeNow");
//         // console.log(time1 + " time1");
//         if(demGhe == 72){
//             if(parseInt(timeNow)  < parseInt(time1) || ngayHienTai > ngayHt)
//            {    
//                 alert("Không còn ghế nào trống!");
//                 e.target.setAttribute("href", "");
//                 e.target.setAttribute("style", "background-color: aqua;");
//             }

//         }
//     }

// })


// var hour = document.querySelectorAll('.booking__hour');



// console.log(date.children);
// chonNgay.forEach(cn => {
//     cn.addEventListener("click", (cn1) => {

//         // date.children.forEach(e => {
//         //     console.log(e);
//         // })

//         for (const date_chill of date.children) {
//             let gio = date_chill.innerText;
//             let e1 = date_chill.querySelector(".color-two");
//             // console.log(e1);
//                 if (date.className != date_chill.className && checkNgay == true) {
//                     let arr_checkSoLuong = e1.getAttribute("checkSoLuongGhe").split("!");
//                     let demGhe = 0;
//                     arr_checkSoLuong.forEach(e => {
//                         let ngay = e.split(",")[0];

//                         if (ngay.trim() != "") {

//                             let thoiGian = (e.split(",")[1]).split("-")[0];
//                             thoiGian = thoiGian.split(":")[0] + ":" + thoiGian.split(":")[1];

//                             if (ngay.trim() == ngayHienTai && gio.trim() == thoiGian.trim()) {
//                                 let soGhe = e.split(",")[2];
//                                 soGhe = soGhe.split("-")
//                                 soGhe.forEach(el => {
//                                     if (el.trim() != '') {
//                                         demGhe += 1;
//                                     }
//                                 })

//                             }
//                         }
//                     })
//                     let time1 = gio.split(":");
//                     time1 = time1[0] + time1[1];

//                     if (demGhe == 72) {
//                         if (parseInt(timeNow) < parseInt(time1) || ngayHienTai > ngayHt) {
//                             // alert("Không còn ghế nào trống!");
//                             // e.target.setAttribute("href", "");
//                             console.log(e);
//                             e.setAttribute("class", "booking__hour");
//                         }
//                     }
//                 }
//         }
// })
// })

// date.addEventListener("click", (e) => {
//     let gio = e.target.innerText;
//     if (date.className != e.target.className && checkNgay == true) {
//         let arr_checkSoLuong = e.target.getAttribute("checkSoLuongGhe").split("!");
//         let demGhe = 0;
//         arr_checkSoLuong.forEach(e => {
//             let ngay = e.split(",")[0];

//             if (ngay.trim() != "") {

//                 let thoiGian = (e.split(",")[1]).split("-")[0];
//                 thoiGian = thoiGian.split(":")[0] + ":" + thoiGian.split(":")[1];
//                 // console.log(thoiGian);
//                 // console.log("ngay: " + ngay + " thoi gian: " + thoiGian);
//                 if (ngay.trim() == ngayHienTai && gio.trim() == thoiGian.trim()) {
//                     let soGhe = e.split(",")[2];
//                     soGhe = soGhe.split("-")
//                     soGhe.forEach(el => {
//                         if (el.trim() != '') {
//                             demGhe += 1;
//                         }
//                     })

//                 }
//             }
//         })
//         let time1 = gio.split(":");
//         time1 = time1[0] + time1[1];
//         // console.log(demGhe + " ddeeeeeee");
//         // console.log(timeNow + " timeNow");
//         // console.log(time1 + " time1");
//         if (demGhe == 72) {
//             if (parseInt(timeNow) < parseInt(time1) || ngayHienTai > ngayHt) {
//                 // alert("Không còn ghế nào trống!");
//                 // e.target.setAttribute("href", "");
//                 // e.target.setAttribute("style", "background-color: aqua;");
//             }
//         }
//     }

// })

//header

header("booking__numberOne", "booking__beforeOne", "booking__numberTwo");

// end header 



