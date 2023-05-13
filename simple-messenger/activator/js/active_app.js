
let logoutbtn = document.getElementById('logout');

logoutbtn.addEventListener('click', ()=>{
    location.href = 'php/logout.php';
})


getuser()

function getuser() {
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        let restext = this.responseText;
        restext = JSON.parse(restext);
        createTableUser(restext);
    }
};
xhttp.open("POST", "php/takeuser.php", true);
xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhttp.send(); 
}

function createTableUser(userlist){
let tbody = document.getElementById('userList');
tbody.innerHTML =''

for(let i=0; i<userlist.length; i++){
    let active = '';
    if (userlist[i]['acces'] == 1){
        active = 'AKTYWNE';
    } else {
        active = 'ZABLOKOWANE';
    }
    tbody.innerHTML += `<tr>
        <td class='nick' id='${userlist[i]['nick']}'>${userlist[i]['nick']}</td>
        <td>${active}</td>
        <td><button class='activeUser'>aktywuj</button></td>
        <td><button class='blockUser'>zablokuj</button></td>
        <td><button class='deleteUser'>usun</button></td>
        <td><input type='text' class='newpas'></td>
        <td><button class='changePswd'>Zmień</button></td>
        <td class='infoBox'></td>
    </tr>`
}
activeAllBtn();
}

function activeAllBtn(){
let nicklist = document.getElementsByClassName('nick');
let actBtn = document.getElementsByClassName('activeUser');
let blockBtn = document.getElementsByClassName('blockUser');
let deleteBtn = document.getElementsByClassName('deleteUser');
let newpass = document.getElementsByClassName('newpas');
let chPswBtn = document.getElementsByClassName('changePswd');


for(let i=0; i<actBtn.length; i++){
    actBtn[i].addEventListener('click', ()=>{
        activeAcount(nicklist[i].id, 'active', '',i);
        setTimeout(getuser, 3000);
    })
}
for(let i=0; i<blockBtn.length; i++){
    blockBtn[i].addEventListener('click', ()=>{
        activeAcount(nicklist[i].id, 'block', '', i);
        setTimeout(getuser, 3000);
    })
}
for(let i=0; i<deleteBtn.length; i++){
    deleteBtn[i].addEventListener('click', ()=>{
        activeAcount(nicklist[i].id, 'delete', '', i);
        setTimeout(getuser, 3000);
    })
}
for(let i=0; i<chPswBtn.length; i++){
    chPswBtn[i].addEventListener('click', ()=>{
        if(newpass[i].value !=''){
            activeAcount(nicklist[i].id, 'chpass', newpass[i].value, i);
            setTimeout(getuser, 3000);
        }
    })
}


};

function activeAcount(name, action, newpass, index) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
                let infoBox = document.getElementsByClassName('infoBox');
                let restext = this.responseText;
                infoBox[index].innerHTML = restext;
            }
        };
    xhttp.open("POST", "php/actionuser.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("user="+name+"&action="+action+"&newpass="+newpass); 
    }