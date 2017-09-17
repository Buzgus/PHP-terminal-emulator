<html>
<body onload="document.getElementById('Command-input').focus()">
<iframe style="" id="Output_Iframe" src="" target="_parent" width="90%" height="80%" class="fop"></iframe>
<button type="button" style="width:10%;height:10%;position:absolute;bottom:90%;left:90%;font-size:110%;" onclick="SendCommands('clear');">Clear outputs</button>
<button type="button" style="width:10%;height:10%;position:absolute;bottom:80%;left:90%;font-size:110%;" onclick="Copy();">Copy outputs</button>
<button type="button" style="width:10%;height:10%;position:absolute;bottom:70%;left:90%;font-size:110%;" onclick="LocalDownload('result.txt',UpdatedResult);" type="submit">Downlaod outputs</button><a href="https://ss64.com/bash/" target="_blank"><button type="button" style="width:10%;height:10%;position:absolute;bottom:60%;left:90%;font-size:110%;">Linux commands</button></a><button type="button" style="width:10%;height:10%;position:absolute;bottom:40%;left:90%;font-size:110%;" onclick="Help();">Help</button><a href="https://github.com/Buzgus/PHP-terminal-emulator" target="_blank"><button type="button" style="width:10%;height:10%;position:absolute;bottom:50%;left:90%;font-size:110%;" onclick="">GitHub Page</button></a>
<hr>
<input type="text" id="Command-input" value='Write your commands here.Combine multiple commands in one line by using ";"...' onclick='if(firstTime==1){this.value="";firstTime=0;}' onmouseover='if(firstTime==1){this.value="";firstTime=0;}' style="width:70%;height:10%;background-color:Black; color:Lime;font-size:130%;"onkeypress="OnKeyPress(event.keyCode);"/>
<button type="button" style="width:10%;height:10%;font-size:130%;" onclick="CheckInputAndSend();">Execute</button>
<button type="button" style="width:15%;height:10%;font-size:130%;" onclick="SendCommands('term');">Stop Command</button>
 <textarea id="copy" style="width:1%;height:1%;position:absolute;bottom:0%;left:0%;font-size:10%;">
 </textarea> 
<script>
var CommandHistory = [];
var CurrentHistory=0;
var UpdatedResult="";
var firstTime=1;
randomMin=0
randomMax=9999999;

function Help(){
var help='PHP-terminal-emulator\n[Developed by Buzgus]\n1-To run commands:\nPress <Execute> Button or ENTER Key\n2-To cancel current command:\nPress <Stop Command> Button\n3-To clear commands output:\nPress <Clear outputs> Button\n4-To copy results:\nPress <Copy outputs> Button\n5-To download results as TXT file:\nPress <Download outputs> Button\n6-To find some of Linux commands:\nPress <Linux commands> Button.\n7-To Combine multiple linux commands in one line:\nSeparate commands by using ";"\nExample:\ncd /home/;ls\n8-To search commands history:\nPress Up Key or Down Key on your Keyboard.\n9-To visit this project page on GitHub:\nPress <GitHub Page> Button\n\n\n\n\n\n\n\n';
alert(help);

}
window.setInterval("Update();", 700);
function Update()
{
var xhr = new XMLHttpRequest();
xhr.timeout = 4000;
xhr.ontimeout = function () {}
xhr.onreadystatechange = function() {
if (xhr.readyState == 4 && xhr.status == 200) {
if(xhr.responseText!=UpdatedResult){
UpdatedResult=xhr.responseText;
var doc = document.getElementById('Output_Iframe').contentWindow.document;
doc.open();
doc.write(UpdatedResult);
doc.close();
document.getElementById('Output_Iframe').contentWindow.scrollTo( 0, 999999 );
}
}
}
xhr.open('GET', 'res.html?rand='+Math.floor(Math.random() * (randomMax - randomMin + 1)) + randomMin, true);
xhr.send(null);

}





function LocalDownload(filename, data) {
data=UpdatedResult.replace('<html><head><style>body {font-size: 130%}</style></head><body bgcolor="black" text="white"><pre>', '');
data=convertHTMLEntity(data);
    var blob = new Blob([data], {type: 'text/plain'});
    if(window.navigator.msSaveOrOpenBlob) {
        window.navigator.msSaveBlob(blob, filename);
    }
    else{
        var elem = window.document.createElement('a');
        elem.href = window.URL.createObjectURL(blob);
        elem.download = filename;        
        document.body.appendChild(elem);
        elem.click();        
        document.body.removeChild(elem);
    }
}
function CheckInputAndSend(){
if(document.getElementById('Command-input').value!=''){

CommandHistory.push(document.getElementById('Command-input').value);
SendCommands(document.getElementById('Command-input').value);
document.getElementById('Command-input').value="";
CurrentHistory=0;
}

}

function OnKeyPress(KeyNum){
if(KeyNum==13){CheckInputAndSend();//Enter
}else if(KeyNum==38){//Up Key
if(CommandHistory.length>0){
if(CurrentHistory<=CommandHistory.length-1){
document.getElementById('Command-input').value=CommandHistory[CommandHistory.length-1-CurrentHistory];
CurrentHistory=CurrentHistory+1;
}
} 
}else if(KeyNum==40){//Down Key
if(CommandHistory.length>0){
if(CurrentHistory>0){
document.getElementById('Command-input').value=CommandHistory[CommandHistory.length-CurrentHistory];
CurrentHistory=CurrentHistory-1;

}

}



}
}
function convertHTMLEntity(text){
    const span = document.createElement('span');

    return text
    .replace(/&[#A-Za-z0-9]+;/gi, (entity,position,text)=> {
        span.innerHTML = entity;
        return span.innerText;
    });
}
function Copy(){

var ValToCopyasPlainText=UpdatedResult.replace('<html><head><style>body {font-size: 130%}</style></head><body bgcolor="black" text="white"><pre>', '');
ValToCopyasPlainText=convertHTMLEntity(ValToCopyasPlainText);
document.getElementById('copy').value=ValToCopyasPlainText;
document.getElementById('copy').select();
document.execCommand('Copy');
}
function SendCommands(Commands){
var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}

var EncodedStringOfCommands = Base64.encode(Commands);
var http = new XMLHttpRequest();
http.timeout = 4000;
http.ontimeout = function () {}
var url = "#";
var params = "c="+EncodedStringOfCommands;
http.open("POST", url, true);
http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
http.onreadystatechange = function() {
    if(http.readyState == 4 && http.status == 200) {//Command was done.It's time to get result

    }
}
http.send(params);
}

</script>
</body>

</html>
<?php
$ResultHeader='<html><head><style>body {font-size: 130%}</style></head><body bgcolor="black" text="white"><pre>';
$respath=realpath(dirname(__FILE__))."/res.html";
$MyMessage="PHP-terminal-emulator
[Developed by Buzgus]\nIf you like this project,Please donate me.\nMy bitcoin address:1BKCXh9YFST7wjbFN5fwPtpsFZCVyMwCCb\nGithub Page:https://github.com/Buzgus/PHP-terminal-emulator";
if(!isset($_POST['c'])){
if (!file_exists($respath)) {
file_put_contents($respath, $ResultHeader.$MyMessage);
}
die();
}
$cmd=base64_decode($_POST['c']);
if($cmd=="term"){
AppendTXT("",realpath(dirname(__FILE__))."/term.txt");
AppendTXT("
Termination command was sent for current process.",$respath);
die();
}
if($cmd=="clear"){
file_put_contents($respath, $ResultHeader.$MyMessage);
die();
}
function AppendTXT($txt,$path){
 $myfile = file_put_contents($path, htmlentities($txt).PHP_EOL , FILE_APPEND | LOCK_EX);
}

function CheckTerminate($proc){

if (file_exists(realpath(dirname(__FILE__))."/term.txt")) {//Terminate Process
unlink(realpath(dirname(__FILE__))."/term.txt");

$procInformatinArray=proc_get_status($proc);
proc_terminate ($proc,15);
$s = proc_get_status($proc);
posix_kill($s['pid'], 9);
proc_close($proc);
}
}







if (file_exists(realpath(dirname(__FILE__))."/term.txt")) {unlink(realpath(dirname(__FILE__))."/term.txt");}

$descriptorspec = array(
   0 => array("pipe", "r"),
   1 => array("pipe", "w"),
   2 => array("pipe", "w")
);
flush();

$process = proc_open($cmd, $descriptorspec, $pipes, realpath('./'), array());
AppendTXT("
Commmand: ".$cmd." is running now...",$respath);
if (is_resource($process)) {
    while ($s = fgets($pipes[1])) {
        CheckTerminate($process);
        AppendTXT($s,$respath);
        flush();
    }
}

?>

