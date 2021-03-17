<?php 
ini_set('session.cookie_samesite', 'None');
session_start();
header('Set-Cookie: fileDownload=true; path=/');
header('Cache-Control: max-age=60, must-revalidate');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  <script src="./jquery.fileDownload.js"></script>
  <style>
    .wpcf7-list-item {
        display: block;
    }
  </style>
</head>
<body id="wpcf7-f89-p90-o1">
    <form action="/request/#wpcf7-f89-p90-o1" method="post" class="wpcf7-form" novalidate="novalidate" wpcf7c="89" step="1">
        <td><span class="wpcf7-form-control-wrap checkbox-125"><span class="wpcf7-form-control wpcf7-checkbox wpcf7-validates-as-required"><span class="wpcf7-list-item first"><input type="checkbox" name="checkbox-125[]" value="オンラインレッスン資料"><span class="wpcf7-list-item-label">オンラインレッスン資料</span></span><span class="wpcf7-list-item"><input type="checkbox" name="checkbox-125[]" value="学生様向けオンラインレッスン資料"><span class="wpcf7-list-item-label">学生様向けオンラインレッスン資料</span></span><span class="wpcf7-list-item last"><input type="checkbox" name="checkbox-125[]" value="法人様向けオンラインレッスン資料"><span class="wpcf7-list-item-label">法人様向けオンラインレッスン資料</span></span></span></span></td>
    </div>
    <button class="wpcf7-submit">download</button>
</form>

    <script>
        var sendbtn = document.querySelector('#wpcf7-f89-p90-o1 .wpcf7-submit');
        var requestform = document.querySelector('#wpcf7-f89-p90-o1 .wpcf7-form');
        var proxyUrl = 'https://gss-sakuratrade-cors.herokuapp.com/';
        var array = []
        $( document ).ready(function() {
            async function download_file(url, filename) {
                await fetch(proxyUrl + url, {
                method: 'post',
                mode: 'cors',
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Content-Type': 'application/pdf',
                }
                }).then(function(t) {
                    return t.blob().then((b)=>{
                        var a = document.createElement("a");
                        var url = window.URL.createObjectURL(b);
                        // a.href = URL.createObjectURL(b);
                        a.style.display = "none";
                        a.href = url;
                        // a.setAttribute("download", filename);
                        a.download = filename;
                        document.body.appendChild(a);
                        a.click();
                        window.URL.revokeObjectURL(url);
                        console.log("your file has downloaded!");
                    }
                    );
                });
            }
            if(sendbtn != null) {
                sendbtn.addEventListener('click', function(e) {
                e.preventDefault(e);
                // GET CHECKED VALUE AND PUSH TO ARRAY VARIABLE
                var checkboxes = document.querySelectorAll('.checkbox-125 input[type=checkbox]:checked')
                for (var i = 0; i < checkboxes.length; i++) {
                    array.push(checkboxes[i].value)
                }
                var promises = array.map(async function(value) {
                    if(value === "オンラインレッスン資料") {
                    await download_file('https://stepforward-learning.com/wp/wp-content/uploads/2020/12/%E3%80%90%E6%B3%95%E4%BA%BA%E5%90%91%E3%81%91%E3%80%91StepForward_%E3%82%AA%E3%83%B3%E3%83%A9%E3%82%A4%E3%83%B3%E7%A0%94%E4%BF%AE%E3%83%91%E3%83%B3%E3%83%95%E3%83%AC%E3%83%83%E3%83%88.pdf', '【一般向け】StepForward_Online Program');
                    } else if(value === "学生様向けオンラインレッスン資料"){
                    await download_file('https://stepforward-learning.com/wp/wp-content/uploads/2020/12/%E3%80%90%E5%AD%A6%E7%94%9F%E5%90%91%E3%81%91%E3%80%91StepForward_Online-Program.pdf', '【学生向け】StepForward_Online Program');
                    } else if(value === "法人様向けオンラインレッスン資料"){
                    await download_file('https://stepforward-learning.com/wp/wp-content/uploads/2020/12/%E3%80%90%E4%B8%80%E8%88%AC%E5%90%91%E3%81%91%E3%80%91StepForward_Online-Program.pdf', '【法人向け】StepForward_オンライン研修パンフレット');
                    }
                });
                Promise.all(promises).then(function() {
                    // requestform.submit();
                    // window.location.replace("https://stepforward-learning.com/thank-you-request/");
                });
                }, false);
            }
        });
    </script>
</body>
</html>