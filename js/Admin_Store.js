{
    const doc = document;
    const delete_check = doc.querySelectorAll(".delete_check");
    const delete_button = doc.querySelector("#delete_button");
    const Insert_button = doc.querySelector("#Insert_button");
    const modal = doc.querySelector("#modal");
    const modal_text = doc.querySelector("#modal_text");
    const close_btn = doc.querySelector("#close_btn");
    const overlay = doc.querySelector("#overlay");

    console.log(delete_check);
    console.log(delete_button);

    let STORE_NO_box = new Array();

    delete_button.addEventListener("click", (e) => {
        
        for(let i = 0 ; i < delete_check.length ; i++){
            if( delete_check[i].checked ){
                STORE_NO_box.push(delete_check[i].name);
            }
        }

        console.log(STORE_NO_box);

        modal.style.opacity = 1;
        modal.style.visibility = "visible";
        overlay.style.opacity = 0.4;
        close_btn.style.visibility = "hidden";

        fetch(`https://click.ecc.ac.jp/ecc/sys2_iesk2bc_a/test_html/WebAPI/Admin_StoreAPI.php`, {
            method: "POST",
            body: new URLSearchParams({
                Store_No : JSON.stringify(STORE_NO_box)
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
        window.location.href = "Admin_NewInsert.php?TABLE=STORE";
    });

}