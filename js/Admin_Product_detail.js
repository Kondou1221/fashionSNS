{
    const doc = document;
    const delete_check = doc.querySelectorAll(".delete_check");
    const delete_st_no = doc.querySelectorAll(".delete_st_no");
    const delete_button = doc.querySelector("#delete_button");
    const modal = doc.querySelector("#modal");
    const modal_text = doc.querySelector("#modal_text");
    const close_btn = doc.querySelector("#close_btn");
    const Insert_button = doc.querySelector("#Insert_button");
    const overlay = doc.querySelector("#overlay");

    console.log(delete_check);
    console.log(delete_button);

    let PRO_NO_box = new Array();
    let ST_NO_box = new Array();

    delete_button.addEventListener("click", (e) => {
        
        for(let i = 0 ; i < delete_check.length ; i++){
            if( delete_check[i].checked ){
                PRO_NO_box.push(delete_check[i].name);
                ST_NO_box.push(delete_st_no[i].value);
            }
        }

        console.log(PRO_NO_box);
        console.log(ST_NO_box);

        modal.style.opacity = 1;
        modal.style.visibility = "visible";
        overlay.style.opacity = 0.4;
        close_btn.style.visibility = "hidden";

        fetch(`https://click.ecc.ac.jp/ecc/sys2_iesk2bc_a/test_html/WebAPI/Admin_Product_detailAPI.php`, {
            method: "POST",
            body: new URLSearchParams({
                Product_No : JSON.stringify(PRO_NO_box),
                Store_No : JSON.stringify(ST_NO_box)
            })
        })
        .then((response)=>{
            return response.json();
        })
        .then((data)=>{

            console.log(data);

            if(data["status"]){
                modal_text.innerHTML = "変更完了";
                close_btn.style.visibility = "visible";
            }else{
                modal_text.innerHTML = "変更失敗".data["message"];
                close_btn.style.visibility = "visible";
            }
        });

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
        window.location,href = "パス名";
    });

}