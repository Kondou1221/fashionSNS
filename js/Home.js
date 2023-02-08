{
    const favorites = document.querySelectorAll(".fav");
    const uid = document.querySelector("#uid");
    const login_dialog = document.querySelector("#login_dialog");
    const dialog_close = document.querySelector("#close");

    console.log(favorites);

    for(let i = 0 ; i < favorites.length ; i++){
        favorites[i].addEventListener( "click", (e) => {
            console.log("PUSH");
            console.log(e);
            if(uid){
                let user_id = uid.value;
                console.log("USER_ID" + user_id);
                if(e.target == favorites[i].children[0]){
                    console.log("suc");
                    let pro_no = e.target.name;
                    console.log(e.target.nextElementSibling.value);
                    if( e.target.nextElementSibling.value == "0"){
                        console.log("0");
                        fetch(`https://click.ecc.ac.jp/ecc/sys2_iesk2bc_a/test_html/WebAPI/HomeAPI.php?pro_no=${pro_no}&uid=${user_id}&SQL=I`, {
                            method: "GET",
                        })
                        .then((response)=>{
                            return response.json();
                        })
                        .then((data)=>{
                            console.log(data);

                            if(data["status"]){
                                favorites[i].children[0].src = "RollImage/Favorite_Now.png";
                                e.target.nextElementSibling.value="1";
                            }
                        });
                    }else{
                        console.log("1");
                        fetch(`https://click.ecc.ac.jp/ecc/sys2_iesk2bc_a/test_html/WebAPI/HomeAPI.php?pro_no=${pro_no}&uid=${user_id}&SQL=D`, {
                            method: "GET",
                        })
                        .then((response)=>{
                            return response.json();
                        })
                        .then((data)=>{
                            console.log(data);
                            if(data["status"]){
                                favorites[i].children[0].src = "RollImage/Favorite.png";
                                e.target.nextElementSibling.value="0";
                            }
                        });
                    }
                }
            }else{
                login_dialog.show();
            }

        });
    }

    dialog_close.addEventListener("click", ()=>{
        login_dialog.close();
    });

}