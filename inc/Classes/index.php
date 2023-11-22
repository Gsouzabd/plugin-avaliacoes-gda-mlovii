<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </head>
    <header>
        <a href="https://realortopediacto.com.br/"><img class="logo" src="https://realortopediacto.com.br/wp-content/uploads/2023/07/logo.png"></a>
        <div class="menu">
            <ul>
                <li>
                    <a href="https://realortopediacto.com.br/">
                        <span>Home</span>
                    </a>
                    <a href="https://realortopediacto.com.br/sobre/">
                        <span>CTO</span>
                    </a>
                    <a href="https://realortopediacto.com.br/sobre/time/">
                        <span>Equipe</span>
                    </a>
                    <a href="https://realortopediacto.com.br/sobre/services/">
                        <span>Especialidades</span>
                    </a>
                    <a href="https://realortopediacto.com.br/sobre/contato/">
                        <span>Contato</span>
                    </a>
                   
                </li>
            </ul>
        </div>
        <div class="socialicons">
            <ul>
                <li>
                    <a href="tel:+558121195454">
                     <i class="fa fa-phone"></i>
                    </a>
                    <a href="https://api.whatsapp.com/send?phone=5581995800007">
                    <i class="fa fa-whatsapp"></i>
                    </a>
                    <a href="https://www.instagram.com/ctorealortopedia/">
                    <i class="fa fa-instagram"></i>
                    </a>
                    <a href="https://goo.gl/maps/n6B5fRYqa4ESe1Ft7">
                    <i class="fa fa-map-pin"></i>
                     </a>
                    <a href="https://www.youtube.com/@CTORealOrtopedia">
                    <i class="fa fa-youtube"></i>
                    </a>
                    
                </li>
            <ul>
        </div>
    </header>
    <body>
        <section>
        <div class="container text-center">
            <div class="row">
              
                <div class="col">
                    <img src="https://realortopediacto.com.br/wp-content/uploads/2023/08/2-1-640x531.png" class="rounded float-start" alt="...">
                </div>
                <div class="col">
                    <h5>Arthur Lage - PÉ e TORNOZELO</h5>
                    <p>Ortopedista – Especialista em Pé e Tornozelo – foco em Cirurgia Minimamente Invasiva e procedimentos médios e complexos. </p>
                    <div class="input-group mb-3">
                        <label class="label_ratting">Fale um pouco sobre você</label>    
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nome" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" placeholder="Telefone" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                   
                    <div class="input-group mb-3 ratting">
                    <label class="label_ratting">Avaliação Geral: </label>    
                    <div class="rating">
                        <input type="radio" id="star5" name="rating" value="5">
                        <label for="star5"></label>
                        <input type="radio" id="star4" name="rating" value="4">
                        <label for="star4"></label>
                        <input type="radio" id="star3" name="rating" value="3">
                        <label for="star3"></label>
                        <input type="radio" id="star2" name="rating" value="2">
                        <label for="star2"></label>
                        <input type="radio" id="star1" name="rating" value="1">
                        <label for="star1"></label>
                    </div>
                       
                    </div>
                    <p>De 1 a 5 estrelas, como avalia a experiência?</p>
                    <div class="input-group">
                        <textarea class="form-control" aria-label="With textarea"></textarea>
                    </div>
                    <center><button type="button" class="btn btn-success">Enviar</button><center>

                </div>
            </div>
        </div>
        </section> 
        <footer>
        
            <div class="col">
                <img src="https://realortopediacto.com.br/wp-content/uploads/2021/10/logo_footer_02.png">
                <p>
                Somos o Real Ortopedia CTO.
                </p>
                <p>
                Centro de traumatologia e Ortopedia do Real Hospital Português
                </p>
                <p>
                ©2023 CTO Ortopedia. Todos os diretos reservados.
                </p>
            </div>
        
        </footer>
    </body>
</html>
<style>
.checked {
  color: orange;
}
.logo{
    height: 80px;
    width: auto;
    height: 70px;
    display: block;
}
header {
    padding: 30px;
    margin: 0px 0px 10px 0px;
    background-color: white;
    margin: 15px;
    border-radius: 10px;
    display:flex;
    justify-content: space-between;
}
body {
    background-image: url(https://realortopediacto.com.br/wp-content/uploads/2023/08/1920X1200-EQUIPE-2-DIREITA.png);
    background-size: cover;
    background-repeat: no-repeat;
    /* background-position: right; */
    min-height: 100vh;
}
span.fa.fa-star {
    font-size: 35px;
    margin: 0 15px;
}
.label_ratting{
    font-size: 24px;
    margin-right: 15px;
}
.row {
    text-align: left;
}
textarea.form-control {
    min-height: 100px;
}
a {
    text-decoration: none;
}

li {
    text-decoration: none;
    list-style: none;
    font-size: 15px;
}
ul {
    margin:0;
}
.menu, .socialicons {
    max-height: 25px;
    padding: 30px;
}
.menu a, .socialicons a {
    font-size: 18px;
    color: black;
    font-weight: 500;

}
.menu li a, .socialicons li a {
    margin: 0px 16px;
}
span.fa.fa-star:hover {
    color: gold;
    transition: all 500ms linear;
}
.input-group.mb-3.ratting {
    margin: 0!important;
}
        .rating {
            unicode-bidi: bidi-override;
            direction: rtl;
            text-align: left;
        }

        .rating input {
            display: none;
        }

        .rating label {
            display: inline-block;
            font-size: 25px;
            cursor: pointer;
        }

        .rating label::before {
            content: '\2605';
            color: #ccc;
        }

        .rating input:checked ~ label::before,
        .rating label:hover ~ label::before {
            color: #ffcc00;
        }
        button.btn.btn-success {
    width: 200px;
    margin: 15px 8px;
}
footer {
    position: fixed;
    bottom: 0;
    background-color: #f0fdfb;
    width: 100%;
    padding: 15px 40px;
}
footer .col {
    text-align: center;
}
@media only screen and (max-width:600px){
    .menu, .socialicons{
        display: none;
    }
    img.rounded.float-start {
    width: 100%;
    margin-bottom: 10px;
}
.row {
    display: block;
    text-align: center;
}
footer {
    position: relative;
}
}
    </style>

<script>
        const ratingInputs = document.querySelectorAll('.rating input');
        const ratingValue = document.getElementById('ratingValue');

        for (let i = 0; i < ratingInputs.length; i++) {
            ratingInputs[i].addEventListener('change', function () {
                ratingValue.textContent = this.value;
            });
        }
    </script>