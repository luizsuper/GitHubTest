let que_ = new Array();
let asw_ = new Array();
let type_s = new Array();
function liuFeng() {
    //setTimeout( liuFeng, 1000 * 70);
    let a;
    let UserVisitKey ='';
    let  UserVisitPostUrl ='';
    let __VIEWSTATE ='';
    let hidExamID = '';
    let hidWebID ='';
    let hLoginDataTime ='';
    let moon = '';
    let DoHomework1$hidExamID ='';
    let DoHomework1$hidSource = '';
    let DoHomework1$hidStudentID ='';
    let DoHomework1$hidWebID ='';
    let hidUserID ='';
    let btnSubmit ='Button';
    let types ='';
    for(let a = 0 ;a<arr.length;a++){
        uname =arr[a];
        psw = arr[a];
        $.ajax({
                "dataType":"json",
                "type": "get",
                "url": "/ckx",
                "data" : { "username" : uname,"psw":psw},
                "success": function (data) {
                    /*for(var i in data)
                    {
                        if(i === "moon")
                        {
                             moon = data[i]
                        }
                        if(i === "UserVisitKey")
                        {
                            UserVisitKey = data[i]
                        }
                        if(i === "UserVisitPostUrl")
                        {
                            UserVisitPostUrl = data[i]
                        }
                        if(i === "__VIEWSTATE")
                        {
                            __VIEWSTATE = data[i]
                        }
                        if(i === "hLoginDataTime")
                        {
                            hLoginDataTime = data[i]
                        }
                        if(i === "hidWebID")
                        {
                            hidWebID = data[i]
                        }
                        if(i === "hidExamID")
                        {
                            DoHomework1$hidExamID = data[i];
                        }
                        if(i === "hidSource")
                        {
                            DoHomework1$hidSource = data[i];
                        }
                        if(i === "hidUserID")
                        {
                            hidUserID = data[i];
                        }
                        if(i === "hidWebID")
                        {
                            hidWebID= data[i];
                        }
                        if(i === "home_hidExamID")
                        {
                            DoHomework1$hidExamID = data[i];
                        }
                        if(i === "home_hidStudentID")
                        {
                            DoHomework1$hidStudentID = data[i];
                        }
                        if(i === "home_hidWebID")
                        {
                            DoHomework1$hidWebID = data[i];
                        }
                        if(i === "hidExamID")
                        {
                            hidExamID = data[i];
                        }
                        if(i === "Types")
                        {
                            types = data[i];
                        }
                    }
            //alert(types);
                    getS(moon);
                    make_que();
                    make_asw(types);
                    $("#DoHomework1_hidStudentAnswer").attr("value",moon);
                    $("#UserVisitKey").attr("value",UserVisitKey);
                    $("#UserVisitPostUrl").attr("value",UserVisitPostUrl);
                    $("#__VIEWSTATE").attr("value",__VIEWSTATE);
                    $("#hidExamID").attr("value",hidExamID);
                    $("#hidWebID").attr("value",hidWebID);
                    $("#hLoginDataTime").attr("value",hLoginDataTime);
                    $("#DoHomework1_hidExamID").attr("value",DoHomework1$hidExamID);
                    $("#DoHomework1_hidSource").attr("value",DoHomework1$hidSource);
                    $("#DoHomework1_hidStudentID").attr("value",DoHomework1$hidStudentID);
                    $("#DoHomework1_hidWebID").attr("value",DoHomework1$hidWebID);
                    $("#hidUserID").attr("value",hidUserID);*/

                },
                "fail":function (data) {
                    // alert('fail')
                }
            }
        );
        if( a== arr.length)
        {
            end();
        }
    }
}
function make_que()
{
/*<input type="hidden"  value="2634_268116" name="hidQuestionIndex" />*/
    let b =''
    for(var i = 0; i < asw_.length ; i++)
    {
        b += "<input value=\""+"2634_"+asw_[i]+"\" name=\"hidQuestionIndex\" />";
        document.getElementById("asw").innerHTML=b ;
    }
}
function make_asw(types)
{
    let b ='';
    for(var p in types){//遍历json对象的每个key/value对,p为key
       type_s.push(types[p])
    }
    for(var i = 0; i < type_s.length ; i++)
    {

        b += "<input value=\""+type_s[i]+"\" name=\"hidQuestionType\" ><br>";

           var a = que_[i].split(',');
           for (var is = 0; is < a.length; is++)
           {
               b+= "<input  value=\""+a[is]+"\" name=chkChoiceItem_"+asw_[i]+"><br>";
           }

    }
    document.getElementById("que").innerHTML=b ;
}
function getS(moon1)
{

    var c = moon1.replace(/♂\$♀AA@&☆/g,".");
    var d = c.replace(/♂\$♀QQ@&☆/g,".");
    var e = d.split('.');
    for(var i = 0; i < e.length; i++)
    {
        if((i%2)===0)
        {
            asw_.push(e[i]);
        }
        else
            {
                que_.push(e[i]);
            }
    }

}