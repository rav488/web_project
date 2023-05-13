let chBtn = document.getElementsByClassName('changeBtn');
let box = document.getElementsByClassName('box');
for(let i=0; i<chBtn.length; i++){
    chBtn[i].addEventListener('click', ()=>{
        box[i].classList.add('hidde')
        for(let j=0; j<box.length; j++){
            if(j!=i){
                box[j].classList.remove('hidde')
            }
        }
    })
}


let regbtn = document.getElementById('submitRegBtn');

regbtn.addEventListener('click', (e)=>{
    let pswone = document.getElementById('pswdregone');
    let pswotwo = document.getElementById('pswdregtwo');
    let logreg = document.getElementById('loginreg');
    e.preventDefault();
    if ((logreg.value =='') || (pswone.value =='') ||(pswotwo.value =='')){
        document.getElementById('info').innerHTML = '';
        document.getElementById('info').innerHTML = 'Wszystkie pola wymagane';
    } else if(pswone.value != pswotwo.value){
        document.getElementById('info').innerHTML = '';
        document.getElementById('info').innerHTML = 'BŁĘDNE HASŁA';
    } else {
        document.getElementById('info').innerHTML = '';
        document.forms['regis'].submit();
    }
})