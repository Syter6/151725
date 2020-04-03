function push_footer_down(){
    var scrollheight = document.documentElement.scrollHeight;
    var screenheight = window.innerHeight;

    var h;
    if(scrollheight <= screenheight){
        h = screenheight - 98;
        console.log("used screenheight")
    }else{

        h = scrollheight + 10;
        console.log("used scrollheight");
    }

    document.getElementById("mainFooter").style.marginTop = h + "px";

    return h;
}

$(document).ready(function(){
    $(".newButton").click(function(){
        location.replace("create.php");
    });
});
