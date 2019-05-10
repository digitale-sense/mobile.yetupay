<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../asset/css/font.css">
    <link rel="stylesheet" href="../asset/css/materialise.css">
    <script src="../asset/js/materialize.js"></script>
    <title>Transferer</title>
</head>
<body>
    <header>
        <nav class="z-depth-0 white">
            <div class="nav-wrapper">
                <div class="row">
                    <div class="col s12">
                        <h5 class="black-text">
                            Transferer
                        </h5>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div class="row">
        <div class="col s12">
            <div class="card">
                <form action="#" class="col s12" id="inscriptForm">
                    <div class="input-field col s12">
                        <input id="number" name="number" type="text" required>
                        <label for="number">Numéro du déstinaire</label>
                    </div>
                    <div class="input-field col s8">
                        <input id="anount" type="text" required>
                        <label for="anount">Somme</label>
                    </div>
                    <div class="input-field col s4">
                        <select>
                            <option value="1">CDF</option>
                            <option value="2">USD</option>
                        </select>
                        <label>Devise</label>
                    </div>
                    <div class="col s12">
                        <button class="btn right tuma" id="Flogin" type="submit" name="action">
                            TRANSFERER
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);
        });
    </script>
</body>
</html>