


var func = (item1, item2, icon1, icon2) => {
    var title = document.querySelector(`#${item1}`);
    var sidebar = document.querySelector(`#${item2}`);
    var icon1 = document.querySelector(`.${icon1}`);
    var icon2 = document.querySelector(`.${icon2}`);

    var handler_01 = (vis_01 , vis_02 , size) =>{
        icon2.style.visibility = `${vis_01}`;
        icon1.style.visibility = `${vis_02}`;
        sidebar.style.height = `${size}`;
    }
    icon1.addEventListener("click", () => {
        handler_01('visible' , 'hidden' , '100%');
    })
    icon2.addEventListener("click", () => {
       
        handler_01('hidden' , 'visible' , '50px');


    })
    let i = 0;
    if (i % 2 === 0) {
        title.addEventListener("click", () => {
            i++;
            if (i % 2 != 0) {
                handler_01('visible' , 'hidden' , '100%');
            }
            else {
                handler_01('hidden' , 'visible' , '50px');
            }
        })
    }
}

func('titleDatVe', 'item_datVe', 'icon-01-ve', 'icon-02-ve');
func('titlePhim', 'item_phim', 'icon-01-phim', 'icon-02-phim');
func('titleSp', 'item_sanPham', 'icon-01-sp', 'icon-02-sp');
func('titleKm', 'item_KhuyenMai', 'icon-01-km', 'icon-02-km');
func('titleTk', 'item_taiKhoan', 'icon-01-tk', 'icon-02-tk');

var con = () =>{
    console.log("dat ve");
}

export default con;




