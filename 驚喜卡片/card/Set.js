function start()
{
	document.getElementById('letter').addEventListener("click", open, false);
}
function open()
{
	var content = document.getElementById("content");
	var l = document.getElementById('letter');
	l.setAttribute( "src", "letop.jpg" ); 
	content.innerHTML = "";
	content.innerHTML += '<p>Dear 親愛的使用者:</br></br>'+'已經有多久沒寫信問候親朋好友了呢？</br></br>'+'是時候該動動滑鼠，</br></br>'+'寫信給親愛的朋友了吧！</p></br>';
	document.getElementById('letter').addEventListener("click", close, false);
}
function close()
{
	var content = document.getElementById("content");
	var l = document.getElementById('letter');
	l.setAttribute( "src", "ll.png" ); 
	content.innerHTML = "";
	document.getElementById('letter').addEventListener("click", open, false);
}
window.addEventListener( "load", start, false);