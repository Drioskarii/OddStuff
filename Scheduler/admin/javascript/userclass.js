$( document ).ready(function() {

    classArray=[];

    $.getJSON("https://scheduler.8thkg.team/api/userClass/classlist.php", function(result){
        $.each(result["records"], function(i, field){
            classobj = {};
            $.each(field, function (key, val) {
                classobj[key] = val;
            })
            classArray.push(classobj);
        })
        $.getJSON("https://scheduler.8thkg.team/api/login/userList", function(result){
            $.each(result["records"], function(i, field){
    
                classes = "";
                dropdownName = "";
                $.each(classArray, function(i, fieldClass){
                    if (field["userClass"] == fieldClass["classID"]) {
                       classes += "<a class='dropdown-item active' onclick='classChange(this)' userClass='"+ fieldClass["classID"] +"'>"+fieldClass["className"]+"</a>"
                       dropdownName = fieldClass["className"];
                    } else{
                        classes += "<a class='dropdown-item' onclick='classChange(this)' userClass='"+ fieldClass["classID"] +"'>"+fieldClass["className"]+"</a>"
                    }
                    
                })
    
                $("#tablebody").append("<tr> <td>"+ 
                    field["userID"] 
                +"</td> <td>"+ 
                    field["username"] 
                +"</td> <td>"+ 
                    "<div class='dropdown'>"+
                        "<button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown'>"+dropdownName+"</button>"+
                        "<div class='dropdown-menu'>"+
                         classes  
                        +"</div>"+
                    "</div>"
                +"</td><td>"+
                    field["groupName"] 
                +"</td></tr>")
            });
        });
    });

});

function classChange(classThis) {
    userClass = $(classThis).attr("userclass")
    userID = $(classThis).parents('td:first').siblings().first().html()
    console.log(userClass)
    console.log(userID)
    $.post('https://scheduler.8thkg.team/api/login/updateClass.php', {
        userID: userID,
        userClass: userClass
    }, function(data,status){
        $(classThis).addClass('active').siblings().removeClass('active');
        $(classThis).parent().siblings().first().html($(classThis).html())
    }) .fail(function() {
        alert("Unable to update class :(");
    })
}