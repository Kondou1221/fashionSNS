{
    const doc = document;
    const delete_check = doc.querySelectorAll(".delete_check");
    const delete_button = doc.querySelector("#delete_button");
    const modal = doc.querySelector("#modal");
    const close_btn = doc.querySelector("close_btn");
    const overlay = doc.querySelector("#overlay");

    console.log(delete_check);
    console.log(delete_button);

    let PRO_NO_box = new Array();

    delete_button.addEventListener("click", (e) => {
        
        for(let i = 0 ; i < delete_check.length ; i++){
            PRO_NO_box.push(delete_check[i].name);
        }

        console.log(PRO_NO_box);

        modal.classList.add("active");
        overlay.classList.add("active");

    });

    overlay.addEventListener("click", (e) => {
        modal.classList.remove("active");
        overlay.classList.remove("active");
    });

    close_btn.addEventListener("click", (e) => {
        modal.classList.remove("active");
        overlay.classList.remove("active");
    });


}