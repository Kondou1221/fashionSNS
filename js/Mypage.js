{
    const doc = document;

    const Mypage_Main = doc.querySelector("#Mypage_Main");

    const Mypage_File = doc.querySelector("#Mypage_File");

    const Mypage_NickName = doc.querySelector("#Mypage_NickName");

    const Mypage_Password = doc.querySelector("#Mypage_Password");

    const Mypage_Privcy = doc.querySelector("#Mypage_Privcy");

    const NickName_Change = doc.querySelector("#NickName_Change");

    const PassWord_Change = doc.querySelector("#PassWord_Change");

    const Privacy_Policy = doc.querySelector("#Privacy_Policy");

    const Motal_window_Success = doc.querySelector("#Motal_window_Success");

    const Motal_window_Failure = doc.querySelector("#Motal_window_Failure");

    const User_Img_Change = doc.querySelector("#User_Img_Change");

    const Mypage_Retrun = doc.querySelectorAll(".Mypage_Retrun");

    const User_Name = doc.querySelector("#User_Name");

    const Before_NickName = doc.querySelector("#Before_NickName");

    NickName_Change.addEventListener("click", (e) => {
        Before_NickName.innerHTML = User_Name.innerText;
        Mypage_Main.style.display = "none";
        Mypage_File.style.display = "none";
        Mypage_Password.style.display = "none";
        Mypage_Privcy.style.display = "none";
        Motal_window_Success.style.display = "none";
        Motal_window_Failure.style.display = "none";
        Mypage_NickName.style.display = "block";
    } );

    PassWord_Change.addEventListener("click", (e) => {
        Mypage_Main.style.display = "none";
        Mypage_File.style.display = "none";
        Motal_window_Success.style.display = "none";
        Motal_window_Failure.style.display = "none";
        Mypage_Privcy.style.display = "none";
        Mypage_NickName.style.display = "none";
        Mypage_Password.style.display = "block";
    } );


    Privacy_Policy.addEventListener("click", (e) => {
        Mypage_Main.style.display = "none";
        Mypage_File.style.display = "none";
        Motal_window_Success.style.display = "none";
        Motal_window_Failure.style.display = "none";
        Mypage_Password.style.display = "none";
        Mypage_NickName.style.display = "none";
        Mypage_Privcy.style.display = "block";
    } );

    for(let i = 0 ; i < Mypage_Retrun.length ; i++){
        Mypage_Retrun[i].addEventListener("click", (e) => {
            Mypage_Password.style.display = "none";
            Mypage_File.style.display = "none";
            Motal_window_Success.style.display = "none";
            Motal_window_Failure.style.display = "none";
            Mypage_Privcy.style.display = "none";
            Mypage_NickName.style.display = "none";
            Mypage_Main.style.display = "block";
        } );
    }

    User_Img_Change.addEventListener("click", (e) => {
        Mypage_Main.style.display = "none";
        Mypage_Password.style.display = "none";
        Motal_window_Success.style.display = "none";
        Motal_window_Failure.style.display = "none";
        Mypage_Privcy.style.display = "none";
        Mypage_NickName.style.display = "none";
        Mypage_File.style.display = "block";
    });

}