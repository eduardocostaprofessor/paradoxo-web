<?php
header('Access-Control-Allow-Origin: *');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ( isset($_POST['enviar-orcamento']) ) {
    
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);
    $cidade = trim($_POST['cidade']);
    $mensagem = trim($_POST['mensagem']);

    if (strlen($nome) === 0 || strlen($telefone) === 0 || strlen($cidade) === 0 || strlen($mensagem) <= 3) {
        // echo json_encode('[{"mensagem" : "Preencha todos os dados"}]');
        echo "Preencha todos os dados";
        // echo json_encode($_POST['nome']);
    } else {
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

        // Inicia a classe PHPMailer 
        $mail = new PHPMailer();
        // Método de envio 
        $mail->IsSMTP();

        // Enviar por SMTP 
        $mail->Host = "mail.paradoxografite.com.br";

        // Você pode alterar este parametro para o endereço de SMTP do seu provedor 
        $mail->Port = 465;
        // $mail->Port = 587;

        // Usar autenticação SMTP (obrigatório) 
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';

        // Usuário do servidor SMTP (endereço de email) 
        // obs: Use a mesma senha da sua conta de email 
        $mail->Username = 'contato@paradoxografite.com.br';
        $mail->Password = '1000grau';

        // Configurações de compatibilidade para autenticação em TLS 
        $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));

        // Você pode habilitar esta opção caso tenha problemas. Assim pode identificar mensagens de erro. 
        // $mail->SMTPDebug = 2;

        // Define o remetente 
        // Seu e-mail 
        $mail->From = $email;
        // Seu nome 
        $mail->FromName = 'Paradoxo Grafite';

        // Define o(s) destinatário(s) 
        // $mail->AddAddress('contato@paradoxografite.com.br', 'Luciano');
        $mail->AddAddress('contato@paradoxografite.com.br', 'Luciano');

        // Definir se o e-mail é em formato HTML ou texto plano 
        // Formato HTML . Use "false" para enviar em formato texto simples ou "true" para HTML.
        $mail->IsHTML(false);

        // Charset (opcional) 
        $mail->CharSet = 'UTF-8';

        // Assunto da mensagem
        $mail->Subject = "Orçamento Grafite: $nome $email";

        // Corpo do email 
        $mensagem .= "\n\n\nDADOS RECEBIDOS:\n\tNome: $nome\n\ttelefone: $telefone\n\tEmail: $email\n\tCidade: $cidade";
        $mail->Body = $mensagem;


        if ($mail->Send()) {
            // echo json_encode('{"mensagem" : "Enviado com sucesso."}') ;
           $msgResult = "Orçamento enviado com sucesso." ;
           echo "<script>alert('$msgResult')</script>";
        } else {
            // echo "Não foi possível enviar o e-mail: " . $mail->ErrorInfo;
            // echo json_encode('{"mensagem" : "Problemas no envio de e-mail."}') ;
           $msgResult = "Não foi possível enviar o orçamento." ;
        }
    }
} 
// else { ?>   

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Paradoxo Grafite, o seu Grafiteiro com serviços de qualide!</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.7.1/slick-theme.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.7.1/slick.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/viewerjs@1.5.0/dist/viewer.css">
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.7.1/slick.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/viewerjs@1.5.0/dist/viewer.min.js"></script>

        <link rel="stylesheet" href="./css/styles.css">
    </head>

    <body onload="carregarFotos()">
        <img id="loading" src="./assets/icones/gif.svg" alt="">
        <div id="container">
            <header>
                <img src="./assets/icones/logo-paradoxo-grafite.png" alt="Paradoxo Grafite">
            </header>

            <!-- MENU -->
            <label id="btn-menu" for="abrir-menu">
                <i class="fas fa-bars"></i>
                <span>menu</span>
            </label>
            <input type="checkbox" id="abrir-menu">
            <div id="layer-menu"></div>
            <nav>
                <label for="abrir-menu">
                    X
                </label>
                <div id="links">
                    <a href="#galeria" id="link-galeria" onclick="fecharMenu()">Trabalhos</a>
                    <a href="#sobre" id="link-sobre" onclick="fecharMenu()">Sobre</a>
                    <a href="#orcamento"  id="link-orcamento" onclick="fecharMenu()">Contato</a>
                    <a href="https://pintei.com.br/"  onclick="fecharMenu()" target="_blank">Blog</a>
                </div>

                <div id="menu-social">
                    <a href="https://www.instagram.com/paradoxografite/" target="_blank"><i
                            class="fab fa-instagram"></i></a>
                    <a href="https://www.youtube.com/channel/UCYr3D9OacRvQkvsDiy3Db6g" target="_blank"><i
                            class="fab fa-youtube"></i></a>
                    <a href="https://www.facebook.com/paradoxografite" target="_blank"><i
                            class="fab fa-facebook-square"></i></a>
                    <a href="https://pintei.com.br/" target="_blank"><i class="fab fa-wordpress"></i></a>
                </div>
            </nav>

            <main>
                <section id="banner">
                    <img src="./assets/icones/paradoxo grafite.svg" alt="">

                    <a href="#galeria" id="btn-galeria" class="btn-link">Galeria de fotos</a>
                </section>

                <section id="grafiteiro" class="btn-link">
                    <h1>GRAFITEIRO</h1>
                    <p>O grafite arte pode ser utilizado como um recurso para divulgar seu negócio e renovar um espaço é
                        também a melhor opção para evitar pichações. <span>É por isso que está na moda e é super
                            descolado.</span></p>

                    <article id="grafiteirofaz">
                        <h2>O QUE O GRAFITEIRO <span>FAZ?</span></h2>
                        <p>O grafiteiro prepara o local da pintura, desenvolve a arte e executa grafites personalizados que
                            buscam valorizar espaços, produtos e empresas.</p>

                    </article>

                    <a href="#orcamento-form" id="grafiteorcamento" class="btn-link">Contratar Grafiteiro</a>
                </section>

                <article id="artegrafite">
                    <img src="./assets/imagens-corpo-do-site/grafiteiros.svg" alt="Arte Grafite">
                </article>

                <section id="galeria">
                    <h3>Veja Nossos <span>Grafites</span></h3>

                    <ul id="galeria-lista">
                        <!-- <li><img onclick="showModal(true, '01g')" src="./images/trabalhos/thumbs/01.jpg" alt=""></li>
                        <li><img onclick="showModal(true, '02g')" src="./images/trabalhos/thumbs/02.jpg" alt=""></li>
                        <li><img onclick="showModal(true, '03g')" src="./images/trabalhos/thumbs/03.jpg" alt=""></li>
                        <li><img onclick="showModal(true, '04g')" src="./images/trabalhos/thumbs/04.jpg" alt=""></li>
                        <li><img onclick="showModal(true, '05g')" src="./images/trabalhos/thumbs/05.jpg" alt=""></li>
                        <li><img onclick="showModal(true, '06g')" src="./images/trabalhos/thumbs/06.jpg" alt=""></li> -->
                    </ul>

                    <a href="javascritp:void" class="btn-link" onclick="thumbLoadSimulation()">Ver Mais</a>
                </section>
                <article id="modal">
                    <span onclick="showModal(false)">X</span>
                    <figure>
                        <img src="" alt="">
                    </figure>
                </article>





                <!--**************** Slide Show Depoimentos ****************-->

                <section id="depoimentos">
                    <h3>Olha o que estão falando sobre o <span>nosso grafite</span></h3>
                    <div class="carousel">

                        <div>
                            <p>Só tenho a elogiar o grafiteiro Luciano que desde o primeiro contato foi super atencioso,
                                sempre em prontidão a ajudar para conseguir realizar a minha arte. Após fecharmos, foi super
                                rápido e me entregou a arte em dois dias que ficou sensacional, lindo... amei o trabalho
                                dele e super recomendo.</p>
                            <p>Priscila Porto</p>
                            <!-- <figure> <img src="./assets/depoimentos/priscila-porto.png" title="Avaliação de Priscila Porto"
                                    alt="foto do Avaliador"> </figure> -->
                        </div>
                        <div>
                            <p>Só tenho a agradecer, estou falando do melhor profissional que já encontrei na minha vida.
                                Seu trabalho é excepcional, superou as minhas expectativas, mas antes de mais nada quero
                                destacar que além de um magnífico profissional, sua humildade seu caráter sua honestidade me
                                deixaram seu fã.. eu só tenho a agradecer por tudo. Saiba que aprendi muito com você..
                                continue assim sempre que Deus te ilumine muito... e lembre se vc ganhou um fã......muito
                                mais muito obrigado por tudo.</p>
                            <p>Rafael Gonçale</p>
                            <!-- <figure> <img src="./assets/depoimentos/rafael-goncale.png" title="Avaliação de Rafael Gonçale"
                                    alt="foto do Avaliador"> </figure> -->
                        </div>
                        <div>
                            <p>Luciano e Leila são ótimos profissionais em todos os aspectos, integridade, pontualidade,
                                cordialidade e parte artística. Com seus desenhos artísticos eles alegraram e complementaram
                                a decoração da minha escola de educação infantil e ficou lindo!</p>
                            <p>Ivani Zorzetto</p>
                            <!-- <figure> <img src="./assets/depoimentos/ivani-zorzetto.png" title="Avaliação de Ivani Zorzetto"
                                    alt="foto do Avaliador"> </figure> -->
                        </div>
                        <div>
                            <p>Simplesmente muito toppp! Adorei, e agora vamos fazer em outras salas também. E vamos indicar. Muito obrigada</p>
                            <p>Dorminhocão Hotel</p>
                            <!-- <figure> <img src="./assets/depoimentos/ivani-zorzetto.png" title="Avaliação de Ivani Zorzetto"
                                    alt="foto do Avaliador"> </figure> -->
                        </div>
                        <div>
                            <p>Trabalho perfeito, profissional atencioso faz tudo dentro do prazo combinado utiliza material de primeira linha, fomos surpreendidos com a qualidade do trabalho, elaborou um projeto que nos trouxe grandes resultados. Se pensar em grafite, nao exitem em contratar esse profissional.
                            </p>
                            <p>Everton Santos Silva</p>
                            <!-- <figure> <img src="./assets/depoimentos/ivani-zorzetto.png" title="Avaliação de Ivani Zorzetto"
                                    alt="foto do Avaliador"> </figure> -->
                        </div>

                    </div>

                    <figure id="ilustracao-tinta-grafiteiro">
                        <img src="./assets/depoimentos/tinta-para-grafiteiro.svg" alt="tinta para grafiteiro">
                    </figure>

                </section>

                <section id="transforme" class="informativo">
                    <h2>TRANSFORME O SEU ESPAÇO COM <span>UM GRAFITE</span></h2>

                    <p>O grafite modifica o ambiente e entrega um capricho que não passa batido. E isso percebi desde o meu
                        primeiro trabalho em 2010. </p>

                    <p>O grafiteiro que é profissional, deve atender as exigências do cliente com maestria.</p>

                    <p>E no nosso caso, entendemos as necessidades dos nossos consumidores, fazemos algumas pesquisas, e
                        ofertemos soluções inovadoras.</p>

                    <h3>Vejam quais são os benefícios do grafite:</h3>

                    <ul>
                        <li>Afasta os pichadores.</li>
                        <li>Protege contra ferrugem e umidade</li>
                        <li>Destaca-se da concorrência</li>
                        <li>Valoriza o seu espaço</li>
                        <li>Alegra o ambiente</li>
                    </ul>

                </section>

                <section id="sobre" class="informativo">
                    <h2>sobre <span>Nós</span></h2>

                    <p>Olá, me chamo Luciano, sou o fundador da PARADOXO Grafite.</p>

                    <p>Nossa empresa tem 10 anos de experiência no mercado. No decorrer desses anos, tivemos o privilégio de
                        participar de vários projetos e conhecer diversos clientes, sem contar-nos que se tornaram brothers.
                    </p>

                    <p>Nosso job é entender a sua necessidade, e dar total atenção para o seu projeto.</p>

                    <p>Quer saber como? É simples, mergulhamos de cabeça em seu seguimento, para compreender o seu público,
                        e então elaboramos um layout, feito isso, executamos um grafite da hora.</p>

                    <p>Ah, se precisar, fazemos logotipos e, inserimos no design A vantagem é que o logo pode ser usado
                        futuramente em panfletos, banners, cartões de visitas, sites, redes sociais e etc.­­­</p>
                </section>

                <!-- *************************ORÇAMENTO************************* -->
                <section id="orcamento">
                    <h2>Ainda com dúvidas?</h2>

                    <p>Então você pode chamar no Whats</p>
                    <a href="https://api.whatsapp.com/send?1=pt_BR&phone=5511983504952" target="_blank">
                        <img src="./assets/icones/whatsapp-logo.png" alt="contato-whatsapp"
                            title="Tire suas dúvidas pelo whatsapp">
                    </a>

                    <p>Se preferir ligue:
                        <!--<a href="tel:+55-11-98350-4952" id="link-ligue" target="_blank">11 98350-4952</a>-->
                    </p>
                    <figure>
                        <a href="tel:+55-11-98350-4952" target="_blank">
                            <i class="fas fa-phone"></i>
                        </a>
                    </figure>

                    <p>Ou deixe seu contato que nós retornaremos</p>
                    <form action="" method="POST" id="frm-orcamento" name="frmorcamento">
                        
                        <h2 id="orcamento-form">ORÇAMENTO</h2>
                        <input type="text" id="nome" name="nome" placeholder="Nome" required>
                        <input type="email" id="email" name="email" placeholder="Email" required>
                        <input type="number" id="telefone" name="telefone" placeholder="Telefone" required>
                        <input type="text" id="cidade" name="cidade" placeholder="Localização" required>
                        <textarea name="mensagem" id="mensagem" cols="30" rows="10" placeholder="Mensagem"></textarea>
                        <input type="hidden" name="enviar-orcamento">
                        <button class="animacao-botao" type="button" id="btn-orcamento" name="btn-orcamento" onclick="enviarOrcamento()"
                            name="btn-orcamento">Enviar
                            Orçamento</button>
                    </form>
                </section>


                <!--**************** Botões de contato ****************-->
                <article id="duvidas">
                    <a href="https://api.whatsapp.com/send?1=pt_BR&phone=5511983504952" target="_blank">
                        <img src="./assets/icones/whatsapp-logo.png" alt="contato-whatsapp"
                            title="Tire suas dúvidas pelo whatsapp">
                    </a>
                    <figure>
                        <a href="tel:+55-11-98350-4952" target="_blank">
                            <i class="fas fa-phone"></i>
                        </a>
                    </figure>
                </article>
            </main>

            <footer>
                <p>(11) 98350-4952</p>
                <p>contato@paradoxografite.com.br</p>

                <p id="redes-sociais">
                    <a href="https://www.instagram.com/paradoxografite/" target="_blank"><i
                            class="fab fa-instagram"></i></a>
                    <a href="https://www.youtube.com/channel/UCYr3D9OacRvQkvsDiy3Db6g" target="_blank"><i
                            class="fab fa-youtube"></i></a>
                    <a href="https://www.facebook.com/paradoxografite" target="_blank"><i
                            class="fab fa-facebook-square"></i></a>
                    <a href="https://pintei.com.br/" target="_blank"><i class="fab fa-wordpress"></i></a>
                </p>

                <p><em>PARADOXO <span>Grafite &copy;</span></em></p>
            </footer>
        </div>

        <script type="text/javascript" src="./js/index.js"></script>
        <script type="text/javascript" src="./js/menu-smooth.js"></script>
    </body>

    </html>
<?php //} ?>