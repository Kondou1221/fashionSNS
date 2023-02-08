{
    const doc = document;
    const delete_check = doc.querySelectorAll(".delete_check");
    const delete_button = doc.querySelector("#delete_button");
    const modal = doc.querySelector("#modal");
    const modal_text = querySelector("modal_text");
    const close_btn = doc.querySelector("#close_btn");
    const overlay = doc.querySelector("#overlay");

    console.log(delete_check);
    console.log(delete_button);

    let PRO_NO_box = new Array();

    delete_button.addEventListener("click", (e) => {
        
        for(let i = 0 ; i < delete_check.length ; i++){
            if( delete_check[i].checked ){
                PRO_NO_box.push(delete_check[i].name);
            }
        }

        console.log(PRO_NO_box);

        modal.style.opacity = 1;
        modal.style.visibility = "visible";
        overlay.style.opacity = 0.4;
        overlay.style.visibility = "visible";
        close_btn.style.visibility = "hidden";

        fetch(`https://click.ecc.ac.jp/ecc/sys2_iesk2bc_a/test_html/WebAPI`, {
            method: "POST",
            body: new URLSearchParams({
                item_cate : JSON.stringify(PRO_NO_box)
            })
        })
        .then((response)=>{
            return response.json();
        })
        .then((data)=>{
            if(true){
                modal_text.innerHTML = "変更完了";
            }else{
                modal_text.innerHTML = "変更失敗";
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
    });


}