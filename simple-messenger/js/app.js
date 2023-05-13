
document.getElementById('inpnick').value = user;
var receiver = '';
var historyTest = 'no';
var tmptimer;

document.getElementById('logout').addEventListener('click',(e)=>{
    e.preventDefault();
    location.href='php/logout.php';
});
document.getElementById('settings').addEventListener('click',(e)=>{
    e.preventDefault();
    location.href='changepsw/index.php';
});

//ajaxowe wczytawanie czastu rekurencyjnie wywoływane co 2000ms
loadDoc(user, receiver, historyTest);
function loadDoc(user, receiver, historyTest) {
    user2 = user;
    receiver2 = receiver;

    let currentDate = new Date();
    let timestamp = currentDate.getTime();
    timestamp = Math.floor(timestamp / 1000)

    //console.log(user, receiver);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            msgarr = JSON.parse(this.responseText);
            showMsg(msgarr);
            //document.getElementById("screen").innerHTML = this.responseText;
            }
        };
    xhttp.open("POST", "php/ajax.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("user="+user+"&time="+timestamp+"&receiver="+receiver+"&historyTest="+historyTest+"&action=get"); 
    tmptimer = setTimeout(loadDoc, 2000, user2, receiver2, historyTest);
    }


//funkcja obrabiajace dane wiadomosci i wyswietlajaca
function showMsg(data){
    let tmpdate = new Date(0*1000);
    let screen = document.getElementById('screen');
    screen.innerHTML = '';
    linebreak = document.createElement("br");
    for(let i=0; i<data.length; i++){
        let msgtime = data[i]['czas'];
        msgtime = msgtime*1000;
        msgtime = new Date(parseInt(msgtime))
        if ((msgtime.getFullYear() != tmpdate.getFullYear()) || (msgtime.getMonth() != tmpdate.getMonth()) || (msgtime.getDate() != tmpdate.getDate())){
            msgdatestr = msgtime.getDate()+' / '+ (msgtime.getMonth() + 1)  +' / '+msgtime.getFullYear();
            let spandate = document.createElement('div');
            spandate.innerHTML = '-------'+msgdatestr+'-------<br>';
            spandate.style.textAlign = 'center';
            screen.append(spandate);
            tmpdate = msgtime;
        }
        msgtimestr = msgtime.getHours()+':'+msgtime.getMinutes()+":"+msgtime.getSeconds();
        let msgtresc  = document.createElement('span');
        msgtresc.innerHTML = `[${data[i]['nick']}][${msgtimestr}] : ${data[i]['tresc']}<br>`
        screen.append(msgtresc);
    }
}
//obsługa przycisku logout
const element = document.getElementById('getmsg');
element.addEventListener('submit', event => {
    let textbox = document.getElementById('msgtext').value;
    event.preventDefault();
    if(receiver!='' && textbox!=''){
        sendDoc(user, receiver);
    }
    textbox = '';
});


//funkcja ajaxowa wysyłająca wiadomosc
function sendDoc(user, receiver) {

    let tresc = document.getElementById('msgtext').value;
    let currentDate = new Date();
    let timestamp = currentDate.getTime();
    timestamp = Math.floor(timestamp / 1000)
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            }
        };
    xhttp.open("POST", "php/ajax.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("user="+user+"&receiver="+receiver+"&tresc="+tresc+"&time="+timestamp+"&action=post"); 
    clearTimeout(tmptimer);
    //historyTest = 'no'; 
    loadDoc(user, receiver, historyTest);
}

getuserlist(user)
//funkcja ajaxowa pobierajaca kontakty
function getuserlist(user) {

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
                conlist = JSON.parse(this.responseText);
                //console.log(this.responseText)
                printUserList(conlist);
                testSelected()
                checkNewMsg(user)
            }
        };
    xhttp.open("POST", "php/getuser.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("user="+user); 
    setTimeout(getuserlist, 2000, user);
}

function printUserList(conlist){
    let contscr = document.getElementById('contactlist');
    let curentimestamp = Date.now();
    curentimestamp = Math.round(curentimestamp/1000);
    let deltatimestamp = curentimestamp - 61;
    
    contscr.innerHTML = 'lista kontaktów<hr>'
    list = document.createElement('ul')
    list.id = "contlist";
    for(let i=0; i<conlist.length; i++){
        //console.log(conlist[i].nick)
        if(!conlist[i].active){
            list.innerHTML+="<li class='contactUser' id='"+conlist[i].nick+"'>"+conlist[i].nick+" <button class='historyBTN'>H</button><button class='delcont'>&#215;</button></li><hr>"        
        }else if(conlist[i].active < deltatimestamp){
            list.innerHTML+="<li class='contactUser' id='"+conlist[i].nick+"'>"+conlist[i].nick+"<button class='historyBTN'>H</button><button class='delcont'>&#215;</button></li><hr>"        
        } else {
            list.innerHTML+="<li class='contactUser contactUserActive' id='"+conlist[i].nick+"'>"+conlist[i].nick+" <button class='historyBTN'>H</button><button class='delcont'>&#215;</button></li><hr>"        
        }
    }
    contscr.appendChild(list)
    let contactUsers = document.getElementsByClassName('contactUser');
    for(let i=0; i<contactUsers.length; i++){
        let conus = contactUsers[i];
        conus.addEventListener('click', ()=>{
            receiver = conus.id
            testSelected()
            clearTimeout(tmptimer);
            historyTest = 'no';
            loadDoc(user, receiver, historyTest);
        })
    }
    
}
//zaznaczanie kontaktu wybranego
function testSelected(){
    let contactUsers = document.getElementsByClassName('contactUser');

    for(let j=0; j<contactUsers.length; j++){
        contactUsers[j].classList.remove('contactUserSelected')
    }
    for(let i=0; i<contactUsers.length; i++){
        if(contactUsers[i].id == receiver){
            contactUsers[i].classList.add('contactUserSelected');
        }
    }
    deltest()
    historyacces();
}
//obsługa przycisku Historia 
function historyacces(){
    let historyBTNs = document.getElementsByClassName('historyBTN');
    let contacllist = document.getElementsByClassName('contactUser');
    for(let i=0; i<historyBTNs.length; i++){
        historyBTNs[i].addEventListener('click', (e)=>{
            e.stopPropagation();
            testSelected()            
            clearTimeout(tmptimer);
            historyTest = 'yes';
            loadDoc(user, receiver, historyTest);
        })
    }

}




//obsługa przycisku usun kontakt
function deltest(){
let delcontBtns = document.getElementsByClassName('delcont');
let contacllist = document.getElementsByClassName('contactUser');
for(let i=0; i<delcontBtns.length; i++){
    delcontBtns[i].addEventListener("click", ()=>{
        contacllist[i].style.display='none';
        ajaxDelContact(user, contacllist[i].id)
    })
}}
function ajaxDelContact(user, contToDel){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
                conlist = this.responseText;
            }
        };
    xhttp.open("POST", "php/delcontact.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("user="+user+"&receiver="+contToDel); 
}


//dodawanie kontaktu
let addConBtn = document.getElementById('addConBtn');
addConBtn.addEventListener("click", ()=>{
    let addName = document.getElementById('addName').value;
    if(addName!=''){

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                    addconlist = this.responseText;
                    document.getElementById('addInfo').innerHTML=addconlist;
                    setTimeout(clearMsg, 1000);
                }
            };
        xhttp.open("POST", "php/addcontact.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("user="+user+"&receiver="+addName); 
    }
    document.getElementById('addName').value ='';
})
function clearMsg(){
    document.getElementById('addInfo').innerHTML='';
}


//sprawdzanie nowych wiadomosci
function checkNewMsg(user){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
                newmsgtest = this.responseText;
                newmsgtest = JSON.parse(newmsgtest)
                showNewMsg(newmsgtest)
            }
        };
    xhttp.open("POST", "php/chcecknewmsg.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("user="+user); 
}
function showNewMsg(newmsglist){
    let testnewlist=[];
    let testnewlistnewcont=[];

    for(let a=0; a<newmsglist.length; a++){
        if(newmsglist[a].split(':')[1] == 1){
            testnewlist.push(newmsglist[a].split(':')[0])
        } else {
            if(!testnewlistnewcont.includes(newmsglist[a].split(':')[0]))
            testnewlistnewcont.push(newmsglist[a].split(':')[0])
        }
    }

    let contactUsers = document.getElementsByClassName('contactUser');
    let newbox = document.getElementById('newusermsg'),
    contacttmplist=[];
    for(let i=0; i<contactUsers.length; i++){
        let inuser = contactUsers[i].id;
        contacttmplist.push(inuser)


        if(testnewlist.includes(inuser)){
            contactUsers[i].classList.add('newMsg')
        } else {
            contactUsers[i].classList.remove('newMsg')
        }
    }
    let nowi = document.getElementsByClassName('stranger')
    
    for(let j=0;j<testnewlist.length;j++){
        let dodac = true;
        let testuser = testnewlist[j];
        if(!contacttmplist.includes(testuser)){
            for(let k=0; k<nowi.length; k++){
                testowy = nowi[k];
                if(testowy.id == testuser){
                    dodac=false
                }
            }
            if(dodac){
                let newcon=document.createElement('span');
                newcon.className = 'stranger';
                newcon.id=testuser;
                newcon.innerHTML = testuser
                newbox.appendChild(newcon)
            }
        }
    }
    for(l=0; l<nowi.length; l++){
        nowi[l].addEventListener('click', (e)=>{
            receiver = e.target.id;
            document.getElementById('addName').value = receiver;
            testSelected()            
            clearTimeout(tmptimer);
            historyTest = 'no';
            loadDoc(user, receiver, historyTest);
        }
        )
    }
}