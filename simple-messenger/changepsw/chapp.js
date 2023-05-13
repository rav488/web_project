let chpsw = document.getElementById('chpsw');
let old = document.getElementById('old');
let newone = document.getElementById('newone');
let newtwo = document.getElementById('newtwo');
let responsebox = document.getElementById('response');

//powrot
document.getElementById('back').addEventListener('click', (e)=>{
    e.preventDefault();
    location.href='../comunicator.php'
})

//zmiana hasła
chpsw.addEventListener('click', (e)=>{
    let errbox = document.getElementsByClassName('error');
        for(let i=0; i<errbox.length; i++){
            errbox[i].innerHTML = '';
        }
    e.preventDefault();
    if(newone.value == newtwo.value){
        //document.forms['changeform'].submit()
        changePsw(old.value, newone.value);
    } else {
        //let errbox = document.getElementsByClassName('error');
        for(let i=0; i<errbox.length; i++){
            errbox[i].innerHTML = 'Błędne hasła'
        }
    }
})  

function changePsw(oldp, newp){
    responsebox.innerHTML = '';
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            responsebox.innerHTML = this.responseText;
            }
        };
    xhttp.open("POST", "changetestpsw.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("old="+oldp+"&newone="+newp); 
    
    }

    //zmiana koloru
let colorchange = document.getElementById('colorchange');
let colortheme = document.getElementById('colortheme');

colortheme.addEventListener('input', ()=>{
    let selectedcolor = colortheme.value;
    if(selectedcolor!=''){
        changeColor(selectedcolor);
    }
})
function changeColor(newcolor){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            location.reload();
            }
        };
    xhttp.open("POST", "changecolor.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("color="+newcolor); 
}

