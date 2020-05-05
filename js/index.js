// ary de fotos para simulação da galeria
const arrFotos = [

    "./images/trabalhos/thumbs/01.jpg",
    "./images/trabalhos/thumbs/02.jpg",
    "./images/trabalhos/thumbs/03.jpg",
    "./images/trabalhos/thumbs/04.jpg",
    "./images/trabalhos/thumbs/05.jpg",
    "./images/trabalhos/thumbs/06.jpg"
];
let galeryInit = 0;
let galeryQtd = 3;
const fatorIncremento = 3;

// $('.carousel').slick({
//     dots: true,
//     infinite: true,
//     speed: 1000,
//     fade: false,
//     slidesToShow: 1,
//     slidesToScroll: 1,
//     responsive: [
//         {
//             breakpoint: 1024,
//             settings: {
//                 slidesToShow: 1,
//                 slidesToScroll: 1,
//                 infinite: true,
//                 dots: true,
//             }
//         },
//         {
//             breakpoint: 600,
//             settings: {
//                 slidesToShow: 1,
//                 slidesToScroll: 1,
//             }
//         },
//         {
//             breakpoint: 480,
//             settings: {
//                 slidesToShow: 1,
//                 slidesToScroll: 1,
//                 fade: true,
//             }
//         },

//     ]
// });

// const viewer = new Viewer(document.getElementById('images'), {

// })


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

        console.log(nome);
        console.log(email);
        console.log(telefone);
        console.log(cidade);
        console.log(mensagem);

        const URL_TO_FETCH = 'http://paradoxografite.com.br/v2/email.php';
        const dados = { nome, email, telefone, cidade, mensagem }
        const headers = { method: post }
        fetch(url, dados)

        fetch(URL_TO_POST, {
            method: 'post',
            body: JSON.parse(dados) 
        }).then(function (response) {
            return response.json();
        }).then(function (data) {
            console.log(data);
            
        });

        // fetch(URL)
        //     .then(resposta => resposta.json())
        //     .then(data => data)
        //     .catch(erro => console.error(erro));


        alert('enviando ... só que não!');
    }
}

function showModal(show = falseÍ, url = '') {
    gifLoading(true);

    setTimeout(function () {
        let left;
        let opacity;
        const modal = document.querySelector('main article#modal');
        const img = document.querySelector('main article#modal figure img');

        if (show) {
            left = 0;
            opacity = 0.95;
        } else {
            left = -100;
            opacity = 0;
        }
        console.log(img);
        console.log(url);

        // img.src = `./images/trabalhos/${url}.jpg`;
        modal.style.left = `${left}%`;
        modal.style.opacity = opacity;
        gifLoading(false);
    }, 500)

}


function thumbLoadSimulation(init = galeryInit, qtd = galeryQtd) {
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
    }, 1000)

}

function gifLoading(show = false) {
    if (show)
        document.querySelector('#loading').style.display = 'block';
    else
        document.querySelector('#loading').style.display = 'none';
}