/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */
let menu=document.querySelector(#menu-btn);
let navbar=document.querySelector('.header .navbar');
menu.onclick=()=>{
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
};
window.onscroll=() =>{
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
};
document.querySelector('.close').onclick=()=>{
document.querySelector('.edit-form-container').style.display='none';
window.location.href='admin.php';
};
