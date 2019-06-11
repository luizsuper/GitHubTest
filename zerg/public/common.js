let  uname;
let psw;
let from1 = 0;
let to =89;
let arr;
// let arr1 = [2017024151,2017024152,2017024153,2017024154,2017024155];
function liuFeng($url) {
    //setTimeout( liuFeng, 1000 * 70);

    for(let a = 0 ;a<arr.length;a++){
        uname =arr[a];
        psw = arr[a];
        $.ajax({
                "dataType":"json",
                "type": "get",
                "url": "/"+$url,
                "data" : { "username" : uname,"psw":psw,"flag":from1},
                "success": function (data) {
                    alert('aaa');
                },
                "fail":function (data) {
                    alert('fail')
                }
            }
        );
        if( a== arr.length)
        {
            end();
        }
    }
}


function runEvery10Sec() {
    // 1000 * 10 = 10 秒钟
    // alert(inputValue);

    setTimeout( runEvery10Sec, 1000 * 70);
    if(from1 <= to) {
        for (let a = 0; a<arr.length; a++){
            uname =arr[a];
            psw = arr[a];
            $.ajax({

                    "type": "get",
                    "url": "/hello",
                    "data": {"id": uname, "psw": psw, "flag": from1},
                    "success": function (data) {
                        if (from1 == to) {
                            end();
                        }
                    },
                    "fail": function (data) {

                        alert(data);
                    }

                }
            );
        }
    }
    from1++;
}
function end() {
    document.getElementById("1").innerHTML="刷课完成";

}
function printInputValue()
{
    // str="jpg|bmp|gif|ico|png";
    uname = document.getElementById("uname").value+document.getElementById('uname1').value;
    psw =  document.getElementById("uname").value;
    arr = uname.split(' ');
    let b ='';

    //alert(b);
    for( let a = 0; a < arr.length ; a++)
    {
        b+=  "<div class='uid'>"+arr[a]+"</div>"
            +"<div>"
            +" <input type=\"text\"id=\""+arr[a]    +"\"style=\"border: 1px solid #fff;\" />"
        ;
        document.getElementById("2").innerHTML=b ;
        // alert(1);
    }
    /*  ;*/
}
