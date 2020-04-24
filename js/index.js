
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

const viewer = new Viewer(document.getElementById('images'),{

})


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
        
        alert('enviando ... só que não!');
    }



}