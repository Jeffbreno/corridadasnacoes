<?php

namespace App\Controller\Pages;

use App\Http\Request;
use App\Model\Entity\Categoria as EntityCategoria;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class SendMailController
{

    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);

        //Server settings
        $this->mail->CharSet = "UTF-8";
        $this->mail->isSMTP(); //Send using SMTP
        $this->mail->Host = 'smtp.uni5.net'; //Set the SMTP server to send through
        $this->mail->SMTPAuth = true; //Enable SMTP authentication
        $this->mail->Username = 'nao-responder@corridadasnacoes.com.br'; //SMTP username
        $this->mail->Password = 'Criativa#123ds'; //SMTP password
        $this->mail->Port = 587;

        $this->mail->setFrom('nao-responder@corridadasnacoes.com.br', 'Corrida das Nações');
        $this->mail->isHTML(true);
    }


    public function sendMail($destinatario, $ticket)
    {

        $nome = $destinatario['nome'];
        $nome_responsavel = $destinatario['nome_responsavel'];
        $email = $destinatario['email'];
        $cpf = $destinatario['cpf'];

        $obCategoria = EntityCategoria::find($destinatario['categoria']);
        $categoria = $obCategoria->titulo;

        if ($destinatario['genero'] === 'M') {
            $genero = 'Masculino';
        } elseif ($destinatario['genero'] === 'F') {
            $genero = 'Feminino';
        } else {
            $genero = 'Não informar';
        }

        $dt_nascimento = $destinatario['dt_nascimento'];
        $celular = $destinatario['celular'];
        $logradouro = $destinatario['logradouro'];
        $numero = $destinatario['numero'];
        $complemento = $destinatario['complemento'];
        $bairro = $destinatario['bairro'];
        $cidade = $destinatario['cidade'];
        $uf = $destinatario['uf'];
        $distancia = $destinatario['distancia'];
        $camisa = $destinatario['camisa'];
        $equipe = $destinatario['equipe'];

        try {
            // Configura o destinatário
            $this->mail->addAddress($email);
            $this->mail->addBCC('corridadasnacoes.rn@gmail.com');

            // Configura o assunto e o corpo da mensagem
            $this->mail->Subject = ('Corrida das Nações "Cadastro Realizado com Sucesso!" - Nº ticket: ' . $ticket);
            // $msg = "Parabéns " . $nome . "!";

            $link =  "<a href=\"" . InscricoesController::getBotao($destinatario['categoria']) . "\" target=\"_blank\" title=\"Pagar com PagSeguro\"><img src=\"https://assets.pagseguro.com.br/ps-integration-assets/botoes/pagamentos/205x30-pagar.gif\" alt=\"Pague com PagSeguro - é rápido, grátis e seguro!\" /></a>";

            $msg = "A primeira etapa de sua inscrição na CORRIDA DAS NAÇÕES 2023 foi concluída com sucesso!!!<br />";
            $msg .= "Estamos validando o seu seu cadastro e em breve nossa equipe entrará em contato para informar o pagamento<br /><br />";

            $msg .= "Obrigado(a), Atleta!<br />";
            $msg .= "Acompanhe todas as notícias sobre o evento através do nosso Instagram @corridadasnacoes<br />";
            $msg .= "confira abaixo seus dados enviados, caso tenha alguma incongruência entre em contato conosco no whatsapp.<br /><br />";

            $msg .= '<br />Link para pagamento: <br />' . $link;
            $msg .= "<br /><br />Nome e Sobrenome: " . $nome;
            if ($destinatario['categoria'] == 3) {
                $msg .= "<br />Nome e Responsável: " . $nome_responsavel;
            }
            $msg .= "<br />E-mail: " . $email;
            $msg .= "<br />Sexo: $genero";
            $msg .= "<br />CPF: " . $cpf;
            $msg .= "<br />Categoria: $categoria";
            $msg .= "<br />Data de nascimento: " . $dt_nascimento;
            $msg .= "<br />Celular: " . $celular;
            $msg .= "<br />Logradouro: " . $logradouro;
            $msg .= "<br />Número: " . $numero;
            $msg .= "<br />Complemento: " . $complemento;
            $msg .= "<br />Bairro: " . $bairro;
            $msg .= "<br />Cidade: " . $cidade;
            $msg .= "<br />UF: " . $uf;
            $msg .= "<br />Distância: " . $distancia;
            if ($destinatario['categoria'] == 3) {
                $msg .= "<br />Camisa unissex tamanho: " . $camisa . " Infantil";
            } else {
                $msg .= "<br />Camisa unissex tamanho: " . $camisa;
            }
            $msg .= "<br />Equipe: " . $equipe;

            $this->mail->msgHTML($msg);

            $this->mail->Send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
