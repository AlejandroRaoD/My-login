event.preventDefault();

document.getElementById('registration-form').addEventListener('submit', function(e) {
    
    e.preventDefault();

    let registro = new FormData(document.getElementById('registration-form'));
    

    fetch('registrar.php', {
        method: 'POST',
        body: registro
    })
    .then(res => res.json())
    .then(data => {
        if(data == 'true') {
            document.getElementById('username').value = '';
            document.getElementById('email').value = '';
            document.getElementById('password').value = '';
            alert('El usuario se registro correctamente.');
        } else {
            console.log(data);
        }
    });



});