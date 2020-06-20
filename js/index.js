// ary de fotos para simulação da galeria
let arrFotos = [];
// const arrFotosORIGINAL = [

//     "./images/trabalhos/thumbs/01.jpg",
//     "./images/trabalhos/thumbs/02.jpg",
//     "./images/trabalhos/thumbs/03.jpg",
//     "./images/trabalhos/thumbs/04.jpg",
//     "./images/trabalhos/thumbs/05.jpg",
//     "./images/trabalhos/thumbs/06.jpg"
// ];
let galeryInit = 0;
let galeryQtd = 3;
const fatorIncremento = 3;


$('.carousel').slick({
    dots: true,
    infinite: true,
    speed: 1000,
    fade:false,
    slidesToShow: 1,
    slidesToScroll: 1,
    responsive:[
    {
        breakpoint: 1024,
        settings:{
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            dots: true,
        }
    },
    {
        breakpoint: 600,
        settings:{
            slidesToShow: 1,
            slidesToScroll: 1,
        }
    },
    {
        breakpoint: 480,
        settings:{
            slidesToShow: 1,
            slidesToScroll: 1,
            fade:true,
        }
    },

]
});

// const viewer = new Viewer(document.getElementById('images'),{

// })


function fecharMenu() {
    // console.clear();
    document.getElementById('btn-menu').click();
    
}

function enviarOrcamento() {

    const nome = document.getElementById('nome').value.trim();
    const email = document.getElementById('email').value.trim();
    const telefone = document.getElementById('telefone').value.trim();
    const cidade = document.getElementById('cidade').value.trim();
    const mensagem = document.getElementById('mensagem').value.trim();

    if (
        nome.length === 0
        || email.length === 0
        || telefone.length === 0
        || cidade.length === 0
        || mensagem.length === 0
    ) {
        alert('preencha todos os campos corretamente')
    } else {

        // console.log(nome);
        // console.log(email);
        // console.log(telefone);
        // console.log(cidade);
        // console.log(mensagem);

        // const URL_TO_FETCH = 'http://paradoxografite.com.br/v2/email.php';
        // const dados = { nome, email, telefone, cidade, mensagem }
        // console.log(dados);
        

        // fetch(URL_TO_FETCH, {
        //     method: 'post',
        //     headers: {'Content-Type':'application/json'},
        //     body: JSON.stringify(dados) 
        // }).then(function (response) {
        //     console.log(response);
            
        //     return response.json();
        // }).then(function (data) {
        //     console.log(data);
            
        // }).catch(function (err) {
        //     console.log('deu ruim');
            
        // });

        alert('Enviando Orçamento...');

        document.frmorcamento.submit();
    }
}

function showModalORIGINAL(show = falseÍ, url = '') {
    gifLoading(true);

    // setTimeout(function () {
        let left;
        let opacity;
        const modal = document.querySelector('main article#modal');
        const img = document.querySelector('main article#modal figure img');

        if (show) {
            left = 0;
            opacity = 0.95;
            img.src = `./images/trabalhos/${url}.jpg`;
        } else {
            left = -100;
            opacity = 0;
        }
        // console.log(img);
        // console.log(url);

        // img.src = `./images/trabalhos/${url}.jpg`;
        modal.style.left = `${left}%`;
        modal.style.opacity = opacity;
        gifLoading(false);
    // }, 500)

}
function showModal(show = falseÍ, url = '') {
    gifLoading(true);

    // setTimeout(function () {
        let left;
        let opacity;
        const modal = document.querySelector('main article#modal');
        const img = document.querySelector('main article#modal figure img');

        if (show) {
            left = 0;
            opacity = 0.95;
            img.src = url;
        } else {
            left = -100;
            opacity = 0;
        }
        // console.log(img);
        // console.log(url);

        // img.src = `./images/trabalhos/${url}.jpg`;
        modal.style.left = `${left}%`;
        modal.style.opacity = opacity;
        gifLoading(false);
    // }, 500)

}


function thumbLoadSimulationORIGINAL(init = galeryInit, qtd = galeryQtd) {
    gifLoading(true);
    setTimeout(function () {
        let t = '';
        if (init < arrFotos.length) {
            for (let f = init; f < qtd; f++)
                t += `<li><img onclick="showModal(true, '${f + 1}g')" src="./images/trabalhos/thumbs/${f + 1}.jpg" alt=""></li>`;

            document.querySelector('#galeria-lista').innerHTML += t;
            galeryInit += fatorIncremento;
            galeryQtd += fatorIncremento;
        }
        gifLoading(false);
    }, 500)
    
}

function thumbLoadSimulation(init = galeryInit, qtd = galeryQtd) {
    gifLoading(true);
    setTimeout(function () {
        
        let t = '';
        if (init < arrFotos.length) {
            
            for (let f = init; f < qtd; f++){
                t += `<li><img onclick="showModal(true, '${arrFotos[f][1]}')" src='${arrFotos[f][0]}' alt=""></li>`;
                // console.log(t);
                
            }
            
            document.querySelector('#galeria-lista').innerHTML += t;
            galeryInit += fatorIncremento;
            galeryQtd += fatorIncremento;
        }
        gifLoading(false);
    }, 500)
}

function carregarFotos() {

    // const URL = 'http://localhost/paradoxo_api/trabalhos.php';
    // const URL = 'http://paradoxografite.com.br/v2/trabalhos.php';
    const URL = 'https://paradoxografite.com.br/trabalhos.php';
    fetch(URL)
        .then(response => {
            return response.json()
            
        }).then(data => {
            // console.clear();
            
            // console.log(data);
            
            arrFotos = data;//todas as fotos
            // console.log(arrFotos);
            thumbLoadSimulation();
        })
        .catch(e => {
            console.log(e);
            console.log('deu ruim');
            
        })
}


function gifLoading(show = false) {
    if (show)
        document.querySelector('#loading').style.display = 'block';
    else
        document.querySelector('#loading').style.display = 'none';
}