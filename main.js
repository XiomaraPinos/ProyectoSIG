/*/ sidebar toggle
const btnToggle = document.querySelector('.toggle-btn');
btnToggle.addEventListener('click', function () {
  console.log('clik')
  document.getElementById('sidebar').classList.toggle('active');
  console.log(document.getElementById('sidebar'))

});*/

//Registrar
let modal = document.getElementById('miModal');
let flex = document.getElementById('flex');
let abrir = document.getElementById('abrir');
let cerrar = document.getElementById('close');
abrir.addEventListener('click', function() {
    modal.style.display = 'block';
});
cerrar.addEventListener('click', function() {
    modal.style.display = 'none';
});
window.addEventListener('click', function(e) {
    console.log(e.target);
    if(e.target == flex) {
        modal.style.display = 'none';
    }
});


//editar 
/*
let modalm = document.getElementById('miModal1');

//let abrirm = document.getElementById('abrirAct');
let abrirm = document.getElementById('abrirAct');

let cerrarm = document.getElementById('closeEd');
let flexm = document.getElementById('flexEd');
abrirm.addEventListener('click', function() {
    modalm.style.display = 'block';
});
cerrarm.addEventListener('click', function() {
    modalm.style.display = 'none';
});
window.addEventListener('click', function(e) {
    console.log(e.target);
    if(e.target == flexm) {
        modalm.style.display = 'none';
    }
});*/