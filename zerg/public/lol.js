

function showQues()
{
    let json;

    //let exam_context = document.getElementById("exam_context").value
    $.ajax({
            "dataType":"json",
            "type": "get",
            "url": "/asw" ,
            "data" : {},
            "success": function (data) {
                json = data;
                for(var i in data)
                {
                   printInputValue(json);
                }

            },
            "fail":function (data) {
                alert('fail')
            }
        }
    );

}
function example() {
    var jsonStr = [["1888027", "肯定"], ["1888028", "需要"], ["1888029", "知识"], ["1888030", "实践"]];
    for(var i=0,l=jsonStr.length;i<l;i++){

        for(var key in jsonStr[i]){
            alert(key+':'+jsonStr[i][key]);
        }
    }
}
function printInputValue(testjson)
{
    var b ='';
    /*var testjson   = [{"que_no":"2633_267854","asw":null,"type1":"3","detail1":"创业的直接动机就是（  ）","choice":"[[\"1888027\", \"肯定\"], [\"1888028\", \"需要\"], [\"1888029\", \"知识\"], [\"1888030\", \"实践\"]]"},
        {"que_no":"2633_267876","asw":null,"type1":"4","detail1":"创业团队是由(   )的创业者组成的特殊群体，该群体在一个共同认同的、能使彼此担负责任的程序规范下，为达成高品质的创业结果而共同努力，相互协作、依赖，共同担当。","choice":"[[\"1888115\", \"性格互补\"], [\"1888116\", \"能力互补\"], [\"1888117\", \"技能互补\"], [\"1888118\", \"贡献互补\"]]"}]*/
    for(var i in testjson)
    {
        var choice_num=[];
        var choice1=[];
        var k = 0;
        var choice = testjson[i].choice;
        var kk = jQuery.parseJSON(choice);
        var num = testjson[i].que_no;
        var type = testjson[i].type1;
        var  detaill = testjson[i].detail1;
        for(var i=0,l=kk.length;i<l;i++)
        {

            //var s = 0;
           // alert(s);
            for(var key in  kk[i])
            {
                if(key === '0')
                {
                    choice_num[i] = kk[i][key];
                   // alert('num'+choice_num[i]);
                }
                else{
                    choice1[i] = kk[i][key];
                  //  alert('chice'+ choice1[i]);
                }
            }
            k++;

        }
        if(type === '3')
        {
            if(choice_num.length === 4)
            {
                /*b += detaill+"<br>"+choice_num[0]+choice1[0]+
                    "<br>"+choice_num[1]+choice1[1]
                    +"<br>"+choice_num[2]+choice1[2]
                    +"<br>"+choice_num[3]+choice1[3]+"<br>单选题"+"<br>"+num+"<br>"*/
                b+= "<div>"+ detaill+ "<br>"+"<input type=\"radio\" name=\""+num+"\""+"value=\""+choice_num[0]+"\" />"+choice1[0]
                +" <br>"+"<input type=\"radio\" name=\""+num+"\""+"value=\""+choice_num[1]+"\" />"+choice1[1]+
                    "<br>"+"<input type=\"radio\" name=\""+num+"\""+"value=\""+choice_num[2]+"\" />"+choice1[2]+
                    "<br>"+"<input type=\"radio\" name=\""+num+"\""+"value=\""+choice_num[3]+"\" />"+choice1[3]+"</div>"
            }
           else {
                b+= "<div>"+ detaill+ "<br>"+"<input type=\"radio\" name=\""+num+"\""+"value=\""+choice_num[0]+"\" />"+choice1[0]
                    +" <br>"+"<input type=\"radio\" name=\""+num+"\""+"value=\""+choice_num[1]+"\" />"+choice1[1]+"</div>"
            }

        }else
            {
                if(choice_num.length === 4)
                {
                    /*b += detaill+"<br>"+choice_num[0]+choice1[0]+
                    "<br>"+choice_num[1]+choice1[1]
                    +"<br>"+choice_num[2]+choice1[2]
                    +"<br>"+choice_num[3]+choice1[3]+"<br>多选题"+"<br>"+num+"<br>";*/
                    b+= "<div>"+ detaill+ "<br>"+"<input type=\"checkbox\" name=\""+num+"[]\""+"value=\""+choice_num[0]+"\" />"+choice1[0]
                        +" <br>"+"<input type=\"checkbox\" name=\""+num+"[]\""+"value=\""+choice_num[1]+"\" />"+choice1[1]+
                        "<br>"+"<input type=\"checkbox\" name=\""+num+"[]\""+"value=\""+choice_num[2]+"\" />"+choice1[2]+
                        "<br>"+"<input type=\"checkbox\" name=\""+num+"[]\""+"value=\""+choice_num[3]+"\" />"+choice1[3]+"</div>"
                }

            }
    }
    b+= "<input type=submit>";
    document.getElementById("2").innerHTML=b ;
}

