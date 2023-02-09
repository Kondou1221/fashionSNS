{
    const doc = document;
    const table_kind = doc.querySelector("#table_kind");
    const modal = doc.querySelector("#modal");
    const modal_text = doc.querySelector("#modal_text");
    const close_btn = doc.querySelector("#close_btn");
    const agin_btn = doc.querySelector("#agin_btn");
    const Insert_button = doc.querySelector("#Insert_button");
    const overlay = doc.querySelector("#overlay");

    const INSE_STORE_div = doc.querySelector("#INSE_STORE_div");
    const INSE_SHOP_div = doc.querySelector("#INSE_SHOP_div");

    const INSE_SHOP = doc.querySelector("#INSE_SHOP");
    const INSE_STORE = doc.querySelector("#INSE_STORE");

    const CATE_GORY = doc.querySelector("#CATE_GORY");
    const CNAME = doc.querySelector("#CNAME");
    const PRO_NO = doc.querySelector("#PRO_NO");
    const PNAME = doc.querySelector("#PNAME");
    const PRO_IMG = doc.querySelector("#PRO_IMG");
    const PRO_IMG_PLASE = doc.querySelector("#PRO_IMG_PLASE");
    const PRICE = doc.querySelector("#PRICE");
    const SALE_NOW = doc.querySelector("#SALE_NOW");
    const PRO_URL = doc.querySelector("#PRO_URL");
    const STORE_NO = doc.querySelector("#STORE_NO");
    const STORE_NO_SHOP = doc.querySelector("#STORE_NO_SHOP");
    const STORENAME = doc.querySelector("#STORENAME");
    const STORE_NO_STORE = doc.querySelector("#STORE_NO_STORE");
    const SHOPNAME = doc.querySelector("#SHOPNAME");
    const USER_ID = doc.querySelector("#USER_ID");
    const PASS_WD = doc.querySelector("#PASS_WD");
    const UNAME = doc.querySelector("#UNAME");
    const ROLL = doc.querySelector("#ROLL");
    const UIMG_PLASE = doc.querySelector("#UIMG_PLASE");
    const UIMG = doc.querySelector("#UIMG");

    let INSERT_DATA = new Object();

    INSE_SHOP.addEventListener("click", (e) => {
        INSE_STORE_div.style.display = "none";
        INSE_SHOP_div.style.display = "block";
    });

    INSE_STORE.addEventListener("click", (e) => {
        INSE_STORE_div.style.display = "block";
        INSE_SHOP_div.style.display = "none";
    });

    overlay.addEventListener("click", (e) => {
        modal.style.opacity = 0;
        modal.style.visibility = "hidden";
        overlay.style.opacity = 0;
        overlay.style.visibility = "hidden";
    });

    close_btn.addEventListener("click", (e) => {
        modal.style.opacity = 0;
        modal.style.visibility = "hidden";
        overlay.style.opacity = 0;
        overlay.style.visibility = "hidden";
        window.location.reload();
    });

    Insert_button.addEventListener("click", (e) => {

        modal.style.opacity = 1;
        modal.style.visibility = "visible";
        overlay.style.opacity = 0.4;
        close_btn.style.visibility = "hidden";
        agin_btn.style.visibility = "hidden";

        if( table_kind.value == "CATEGORY" ){

            INSERT_DATA["CNAME"] = CNAME.value;

        }else if( table_kind.value == "PRODUCT_DETAIL" ){

            INSERT_DATA["PRO_NO"] = PRO_NO.value;
            INSERT_DATA["STORE_NO"] = STORE_NO.value;
            INSERT_DATA["PRICE"] = PRICE.value;
            INSERT_DATA["SALE_NOW"] = SALE_NOW.value;
            if( PRO_URL.value.trim() != "" ){
                INSERT_DATA["PRO_URL"] = PRO_URL.value;
            }

        }else if( table_kind.value == "PRODUCT" ){

            INSERT_DATA["PNAME"] = PNAME.value;
            INSERT_DATA["CATE_GORY"] = CATE_GORY.value;
            INSERT_DATA["STORE_NO"] = STORE_NO.value;
            INSERT_DATA["PRO_IMG"] = PRO_IMG.value;

        }else if( table_kind.value == "STORE" ){

            if(STORENAME = STORENAME.trim() != ""){
                INSERT_DATA["STORE_NO_SHOP"] = STORE_NO_SHOP.value;
                INSERT_DATA["STORENAME"] = STORENAME.value;    
            }else if(SHOPNAME = SHOPNAME.trim() != ""){
                INSERT_DATA["STORE_NO_STORE"] = STORE_NO_STORE.value;
                INSERT_DATA["SHOPNAME"] = SHOPNAME.value;    
            }

        }else if( table_kind.value == "USER" ){

            INSERT_DATA["USER_ID"] = USER_ID.value;
            INSERT_DATA["PASS_WD"] = PASS_WD.value;
            INSERT_DATA["UNAME"] = UNAME.value;
            if(ROLL.checked){
                INSERT_DATA["ROLL"] = 1;
            }
            INSERT_DATA["UIMG"] = UIMG.value;

        }

        fetch(`https://click.ecc.ac.jp/ecc/sys2_iesk2bc_a/test_html/WebAPI/Admin_NewinsertAPI.php`, {
            method: "POST",
            body: new URLSearchParams({
                INSERT_DATA : JSON.stringify(PRO_NO_box)
            })
        })
        .then((response)=>{
            return response.json();
        })
        .then((data)=>{

            console.log(data);

            if(data["status"]){
                modal_text.innerHTML = "登録完了";
                close_btn.style.visibility = "visible";
            }else{
                modal_text.innerHTML = "登録失敗".data["message"];
                close_btn.style.visibility = "visible";
            }
        });

    });

}