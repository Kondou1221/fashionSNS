<?php

session_start();

require("process/User_info_get.php");

if(!$result["status"]){
    exit($result["message"]);
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>マイページ</title>
    <link rel="stylesheet" href="css/Mypage_Main.css">
    <link rel="stylesheet" href="css/Mypage_File.css">
    <link rel="stylesheet" href="css/Mypage_NickName.css">
    <link rel="stylesheet" href="css/Mypage_Password.css">
    <link rel="stylesheet" href="css/Mypage_Privcy.css">
    <link rel="stylesheet" href="css/Motal_window.css">
    <link rel="stylesheet" href="css/sidebar.css">
</head>
    <header><?php require("sidebar.php"); ?></header>
<body>
    <main>
        <div id="Mypage_Main">
            <div id="Mypage_info">
                <div id="User_info">
                    <div id="User_Id">
                        <p>ユーザーID : <?= $result["result"]["USER_ID"] ?></p>
                    </div>

                    <div id="User_Name">
                        <p>ニックネーム : <?= $result["result"]["NICKNAME"] ?></p>
                    </div>
                </div>

                <div id="User_Img">
                    <img id="User_Pro_Img" src="Uimage/<?= $result["result"]["PRO_IMG"] ?>" alt="imgなし">
                    <input id="User_Img_Change" type="button" value="画像を変更">
                </div>

            </div>

            <div class="Change_button" id="NickName_Change">
                <div><p>ニックネームを変更する</p></div>
                <div class="Change_button_Arrow">
                    <img class="Change_button_Arrow_img" src="RollImage/btn_slider_next.png">
                </div>
            </div>

            <div class="Change_button" id="PassWord_Change">
                <div><p>パスワードを変更する</p></div>
                <div class="Change_button_Arrow">
                    <img class="Change_button_Arrow_img" src="RollImage/btn_slider_next.png">
                </div>
            </div>

            <div class="Change_button" id="Privacy_Policy">
                <div><p>プライバシーポリシーを確認する</p></div>
                <div class="Change_button_Arrow">
                    <img class="Change_button_Arrow_img" src="RollImage/btn_slider_next.png">
                </div>
            </div>

        </div>

        <div id="Mypage_File">
            <form action="process/File_Upload.php" method="POST" id="Mypage_File_form" enctype="multipart/form-data">
                <input type="file" name="Prof_Img" accept="image/*" require>
                <input type="submit" value="変更">
            </form>

            <div id="Main_NickName_Retrun_Button_div">
                <button class="Mypage_Retrun" id="Main_NickName_Retrun_Button" type="button">
                    戻る
                </button>
            </div>

        </div>

        <div id="Mypage_NickName">
            <div id="Before_NickName">
                <p>元の名前</p>
            </div>
            <div id="Main_NickName_text">
                <p>15文字以下のニックネームの入力してください</p>
                <input type="text" id="Main_NickName_textarea" placeholder="ニックネームを入力してください" maxlength="15">
            </div>
            <div id="Main_NickName_Error_Message">
                <p id="Main_NickName_Error_Message_text"></p>
            </div>
            <div id="Main_NickName_Button_Flex">
                <div id="Main_NickName_Retrun_Button_div">
                    <button class="Mypage_Retrun" id="Main_NickName_Retrun_Button" type="button">
                        戻る
                    </button>
                </div>
                <div id="Main_NickName_Button_div">
                    <button id="Main_NickName_Button" type="button">
                        変更
                    </button>
                </div>
            </div>
        </div>

        <div id="Mypage_Password"> 
            <div id="Password_Before">
                <p>現在のパスワードを入力してください</p>
                <input type="text" id="Password_Before_text" placeholder="現在のパスワードを入力してください" maxlength="14">
            </div>
            <div id="Password_Before_Error_Message">
                <p id="Password_Before_Error_Message_text"></p>
            </div>

            <div id="Password_After">
                <p>14文字以内の変更したいパスワードを入力してください</p>
                <input type="text" id="Password_After_text" placeholder="変更後のパスワードを入力してください" maxlength="14">
            </div>
            <div id="Password_After_Error_Message">
                <p id="Password_After_Error_Message_text"></p>
            </div>

            <div id="Password_Verification">
                <p>確認のためもう一度パスワードの入力をお願いします</p>
                <input type="text" id="Password_Verification_text" placeholder="もう一度パスワードを入力してください" maxlength="14">
            </div>
            <div id="Mypage_Password_Button_Flex">
                <div id="Mypage_Password_Retrun_Button_div">
                    <button type="button" class="Mypage_Retrun" id="Mypage_Password_Retrun_Button">戻る</button>
                </div>
                <div id="Mypage_Password_Button_div">
                    <button type="button" id="Mypage_Password_Button">変更</button>
                </div>
            </div>

        </div>

        <div id="Mypage_Privcy">
            <div id="Mypage_Privcy_Title">
                <h1>プライバシーポリシー</h1>
            </div>

            <div id="Mypage_Privcy_Content">
                ＿＿＿＿＿＿＿＿（以下，「当社」といいます。）は，本ウェブサイト上で提供するサービス（以下,「本サービス」といいます。）における，ユーザーの個人情報の取扱いについて，以下のとおりプライバシーポリシー（以下，「本ポリシー」といいます。）を定めます。

                <h2>第1条（個人情報）</h2>
                「個人情報」とは，個人情報保護法にいう「個人情報」を指すものとし，生存する個人に関する情報であって，当該情報に含まれる氏名，生年月日，住所，電話番号，連絡先その他の記述等により特定の個人を識別できる情報及び容貌，指紋，声紋にかかるデータ，及び健康保険証の保険者番号などの当該情報単体から特定の個人を識別できる情報（個人識別情報）を指します。

                <h2>第2条（個人情報の収集方法）</h2>
                当社は，ユーザーが利用登録をする際に氏名，生年月日，住所，電話番号，メールアドレス，銀行口座番号，クレジットカード番号，運転免許証番号などの個人情報をお尋ねすることがあります。また，ユーザーと提携先などとの間でなされたユーザーの個人情報を含む取引記録や決済に関する情報を,当社の提携先（情報提供元，広告主，広告配信先などを含みます。以下，｢提携先｣といいます。）などから収集することがあります。

                <h2>第3条（個人情報を収集・利用する目的）</h2>
                当社が個人情報を収集・利用する目的は，以下のとおりです。

                <h2>当社サービスの提供・運営のため</h2>
                ユーザーからのお問い合わせに回答するため（本人確認を行うことを含む）
                ユーザーが利用中のサービスの新機能，更新情報，キャンペーン等及び当社が提供する他のサービスの案内のメールを送付するため
                メンテナンス，重要なお知らせなど必要に応じたご連絡のため
                利用規約に違反したユーザーや，不正・不当な目的でサービスを利用しようとするユーザーの特定をし，ご利用をお断りするため
                ユーザーにご自身の登録情報の閲覧や変更，削除，ご利用状況の閲覧を行っていただくため
                有料サービスにおいて，ユーザーに利用料金を請求するため
                上記の利用目的に付随する目的

                <h2>第4条（利用目的の変更）</h2>
                当社は，利用目的が変更前と関連性を有すると合理的に認められる場合に限り，個人情報の利用目的を変更するものとします。
                利用目的の変更を行った場合には，変更後の目的について，当社所定の方法により，ユーザーに通知し，または本ウェブサイト上に公表するものとします。

                <h2>第5条（個人情報の第三者提供）</h2>
                当社は，次に掲げる場合を除いて，あらかじめユーザーの同意を得ることなく，第三者に個人情報を提供することはありません。ただし，個人情報保護法その他の法令で認められる場合を除きます。
                人の生命，身体または財産の保護のために必要がある場合であって，本人の同意を得ることが困難であるとき
                公衆衛生の向上または児童の健全な育成の推進のために特に必要がある場合であって，本人の同意を得ることが困難であるとき
                国の機関もしくは地方公共団体またはその委託を受けた者が法令の定める事務を遂行することに対して協力する必要がある場合であって，本人の同意を得ることにより当該事務の遂行に支障を及ぼすおそれがあるとき
                予め次の事項を告知あるいは公表し，かつ当社が個人情報保護委員会に届出をしたとき
                利用目的に第三者への提供を含むこと
                第三者に提供されるデータの項目
                第三者への提供の手段または方法
                本人の求めに応じて個人情報の第三者への提供を停止すること
                本人の求めを受け付ける方法
                前項の定めにかかわらず，次に掲げる場合には，当該情報の提供先は第三者に該当しないものとします。
                当社が利用目的の達成に必要な範囲内において個人情報の取扱いの全部または一部を委託する場合
                合併その他の事由による事業の承継に伴って個人情報が提供される場合
                個人情報を特定の者との間で共同して利用する場合であって，その旨並びに共同して利用される個人情報の項目，共同して利用する者の範囲，利用する者の利用目的および当該個人情報の管理について責任を有する者の氏名または名称について，あらかじめ本人に通知し，または本人が容易に知り得る状態に置いた場合
                <h2>第6条（個人情報の開示）</h2>
                当社は，本人から個人情報の開示を求められたときは，本人に対し，遅滞なくこれを開示します。ただし，開示することにより次のいずれかに該当する場合は，その全部または一部を開示しないこともあり，開示しない決定をした場合には，その旨を遅滞なく通知します。なお，個人情報の開示に際しては，1件あたり1，000円の手数料を申し受けます。
                本人または第三者の生命，身体，財産その他の権利利益を害するおそれがある場合
                当社の業務の適正な実施に著しい支障を及ぼすおそれがある場合
                その他法令に違反することとなる場合
                前項の定めにかかわらず，履歴情報および特性情報などの個人情報以外の情報については，原則として開示いたしません。

                <h2>第7条（個人情報の訂正および削除）</h2>
                ユーザーは，当社の保有する自己の個人情報が誤った情報である場合には，当社が定める手続きにより，当社に対して個人情報の訂正，追加または削除（以下，「訂正等」といいます。）を請求することができます。
                当社は，ユーザーから前項の請求を受けてその請求に応じる必要があると判断した場合には，遅滞なく，当該個人情報の訂正等を行うものとします。
                当社は，前項の規定に基づき訂正等を行った場合，または訂正等を行わない旨の決定をしたときは遅滞なく，これをユーザーに通知します。

                <h2>第8条（個人情報の利用停止等）</h2>
                当社は，本人から，個人情報が，利用目的の範囲を超えて取り扱われているという理由，または不正の手段により取得されたものであるという理由により，その利用の停止または消去（以下，「利用停止等」といいます。）を求められた場合には，遅滞なく必要な調査を行います。
                前項の調査結果に基づき，その請求に応じる必要があると判断した場合には，遅滞なく，当該個人情報の利用停止等を行います。
                当社は，前項の規定に基づき利用停止等を行った場合，または利用停止等を行わない旨の決定をしたときは，遅滞なく，これをユーザーに通知します。
                前2項にかかわらず，利用停止等に多額の費用を有する場合その他利用停止等を行うことが困難な場合であって，ユーザーの権利利益を保護するために必要なこれに代わるべき措置をとれる場合は，この代替策を講じるものとします。

                <h2>第9条（プライバシーポリシーの変更）</h2>
                本ポリシーの内容は，法令その他本ポリシーに別段の定めのある事項を除いて，ユーザーに通知することなく，変更することができるものとします。
                当社が別途定める場合を除いて，変更後のプライバシーポリシーは，本ウェブサイトに掲載したときから効力を生じるものとします。

                <h2>第10条（お問い合わせ窓口）</h2>
                本ポリシーに関するお問い合わせは，下記の窓口までお願いいたします。

                住所：
                社名：
                代表取締役：
                担当部署：
                Eメールアドレス：

                以上
            </div>

            <div id="Mypage_Privcy_Retrun_Button_div">
                <button type="button" class="Mypage_Retrun" id="Mypage_Privcy_Retrun_Button">戻る</button>
            </div>

        </div>

        <!-- モータルを真ん中にする -->

        <div id="Motal_window_Success">
            <div class="Motal_window">
                <p><span>変更完了しました</span></p>
                <button class="Mypage_Retrun">マイページに戻る</button>
            </div>
        </div>

        <div id="Motal_window_Failure">
            <div class="Motal_window">
                <p><span>変更失敗しました</span></p>
                <button class="Mypage_Retrun">マイページに戻る</button>
            </div>
        </div>

    </main>
    <script src="js/Mypage.js"></script>
    <script src="js/Mypage_data.js"></script>
</body>
</html>