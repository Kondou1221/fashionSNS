{
    const doc = document;

    const User_Id = doc.querySelector("#User_Id");

    const Main_NickName_textarea = doc.querySelector("#Main_NickName_textarea");

    const Main_NickName_Error_Message_text = doc.querySelector("#Main_NickName_Error_Message_text");

    const Password_Before_text = doc.querySelector("#Password_Before_text");

    const Password_Before_Error_Message_text = doc.querySelector("#Password_Before_Error_Message_text");

    const UserPassword_After_text = doc.querySelector("#Password_After_text");

    const Password_After_Error_Message_text = doc.querySelector("#Password_After_Error_Message_text");

    const Password_Verification_text = doc.querySelector("#Password_Verification_text");

    const Main_NickName_Button = doc.querySelector("#Main_NickName_Button");

    const Mypage_Password_Button = doc.querySelector("#Mypage_Password_Button");

    const Mypage_NickName = doc.querySelector("#Mypage_NickName");

    const Mypage_Password = doc.querySelector("#Mypage_Password");

    const Motal_window_Success = doc.querySelector("#Motal_window_Success");

    const Motal_window_Failure = doc.querySelector("#Motal_window_Failure");

    const User_Name = doc.querySelector("#User_Name");

    Main_NickName_Button.addEventListener("click", (e) => {

        Main_NickName_Error_Message_text.innerText = "";

        let NickName_After = Main_NickName_textarea.value;
        NickName_After = NickName_After.trim();

        if(NickName_After){

            Mypage_NickName.style.display = "none";
            fetch(`https://click.ecc.ac.jp/ecc/sys2_iesk2bc_a/test_html/WebAPI/Update_Nickname.php?upnick=${NickName_After}`, {
                method: "GET",
            })
            .then((response)=>{
                return response.json();
            })
            .then((data)=>{
                if(data["status"]){
                    User_Name.innerHTML = "ニックネーム : " + data["data"]["NICKNAME"];
                    Motal_window_Success.style.display = "block";
                }else{
                    Motal_window_Failure.style.display = "block";
                }

            });
    
        }else{
            Main_NickName_Error_Message_text.innerText = "ニックネームを入力してください";
        }

        Main_NickName_textarea.value = "";

    });

    Mypage_Password_Button.addEventListener("click", (e) => {

        Password_Before_Error_Message_text.innerText = "";
        Password_After_Error_Message_text.innerText = "";

        let Password_Before = Password_Before_text.value;
        let Password_After = UserPassword_After_text.value;
        let Password_After_Verification = Password_Verification_text.value;

        Password_Before = Password_Before.trim();
        Password_After = Password_After.trim();
        Password_After_Verification = Password_After_Verification.trim();

        if(Password_Before){
            if(Password_After){
                if(Password_After === Password_After_Verification ){

                    fetch(`https://click.ecc.ac.jp/ecc/sys2_iesk2bc_a/test_html/WebAPI/Update_Password.php?uppass_wd=${Password_After}&Before_pass=${Password_Before}`, {
                        method: "GET",
                    })
                    .then((response)=>{
                        return response.json();
                    })
                    .then((data)=>{

                        if(data["status_m"]){
                            Password_Before_Error_Message_text.innerText = data["message"];
                        }else if(data["status"]){
                            Mypage_Password.style.display = "none";
                            Motal_window_Success.style.display = "block";
                        }else{
                            Mypage_Password.style.display = "none";
                            Motal_window_Failure.style.display = "block";
                        }
                    });
            
                }else{
                    Password_After_Error_Message_text.innerText = "確認用のパスワードと一致しません";
                }
            }else{
                Password_After_Error_Message_text.innerText = "パスワードを入力してください";
            }
        }else{
            Password_Before_Error_Message_text.innerText = "パスワードを入力してください";
        }

        Password_Before_text.value = "";
        UserPassword_After_text.value = "";
        Password_Verification_text.value = "";
    });

}