document.addEventListener('DOMContentLoaded', function () {
    var elems = document.querySelectorAll('.tooltipped');
    var instances = M.Tooltip.init(elems, {
        position: 'top'
    });
    passicons = document.querySelectorAll('.pass');
    passicons.forEach(passicon => {
        passicon.addEventListener('click', function (e) {
            passID = e.target.id.substring(0, e.target.id.length - 1);
            if (e.target.innerText == 'visibility') {
                e.target.innerText = 'visibility_off';
                e.target.title = "Cacher le mot de passe";
                document.querySelector('#' + passID).type = 'text';
            } else {
                e.target.innerText = 'visibility';
                e.target.title = "Afficher le mot de passe";
                document.querySelector('#' + passID).type = 'password';
            }
        });
    });
});