function choose(x){
    var cardimg=document.getElementById("cardimg");
    if(x <= 3){
        cardimg.innerHTML="<img src='pic"+x+".jpg'>"
    }
    if(x == 4){
        cardimg.innerHTML="<img src='pic4.webp'>"
    }
    if(x == 5 || x == 6){
        cardimg.innerHTML="<img src='pic"+x+".gif'>"
    }
    if(x == 7){
        var url=document.getElementById("url");
        cardimg.innerHTML="<img src='"+url.value+"'>"
    }
}
function borderchoose(x){
    var border=document.getElementById("border");
    border.style.borderWidth='8px';
    border.style.borderStyle=x;
    
}
function bordercolor(){
    var color=document.getElementById("colorb");
    var border=document.getElementById("border");
    border.style.borderColor=color.value;
}

function datecolor(){
    var color=document.getElementById("colord");
    var date=document.getElementById("date");
    date.style.color=color.value;
}
function titlecolor(){
    var color=document.getElementById("colort");
    var title= document.getElementById("title");
    title.style.color=color.value;
}
function articlecolor(){
    var color=document.getElementById("colora");
    var article=document.getElementById("article");
    article.style.color=color.value;
}



function word(x){
    //var word=document.getElementById("word");
    var date=document.getElementById("date");
    date.style.fontFamily=x;

    var title= document.getElementById("title");
    title.style.fontFamily=x;

    var article=document.getElementById("article");
    article.style.fontFamily=x;
}

function screenshot(){
    html2canvas(document.getElementById("container")).then(function(canvas) {
        document.body.appendChild(canvas);
    });
    var a = document.createElement('a');
        a.href = canvas.toDataURL("image/jpeg").replace("image/jpeg", "image/octet-stream");
        a.download = 'image.jpg';
        a.click();
}

/*function word(){
    var word=document.getElementById("word");
    var date=document.getElementById("date");
    date.style.fontFamily=word.value;

    var title= document.getElementById("title");
    title.style.fontFamily=word.value;

    var article=document.getElementById("article");
    article.style.fontFamily=word.value;
}

function size(){
    var size=document.getElementById("size");
    var date=document.getElementById("date");
    date.style.fontSize=size.value;

    var title= document.getElementById("title");
    title.style.fontSize=size.value;

    var article=document.getElementById("article");
    article.style.fontSize=size.value;
}
*/