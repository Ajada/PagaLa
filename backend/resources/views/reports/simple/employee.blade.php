<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatório - {{ $employeeData['name'] }}</title>
    <style>
      * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-weight: normal;
        font-size: inherit;
      }
      body { font-family: Arial, sans-serif; padding: 1%; }

      /* DEFAULT */
      .text-padding {
        padding: 3px;
      }
      .rigth-border {
        border-right: 1px solid #4f4f4f;
      }
      .new-block {
        margin-top: 5px !important;
      }
      .container {
        border: 1px solid #4f4f4f;
        width: 100%;
        padding: 1px;
      }
      .align-container {
        margin-top: -1px;
      }
      .align-content-center {
        text-align: center;
      }
      .title {
        font-weight: bold !important;
      }
      .padding-left {
        padding-left: 3px;
      }
      .paragraph-font-size {
        font-size: 12px !important;
      }
      .subtitle-font-size {
        font-size: 14px !important;
      }
      .upper {
        text-transform: uppercase
      }
      .w-50 {
        width: 50%;
      }

      /* TOPO */
      .head-title {
        width: 100%;
        border-collapse: collapse;
      }
      .head-title td {
        border: 1px solid #4f4f4f;
        padding: 10px;
        text-align: center;
      }
      .head-title .left-image {
        width: 10%;
      }
      .head-title .center-title {
        width: 40%;
        font-size: 25px;
      }
      .head-title .right-image {
        width: 10%;
      }
      .head-title img {
        max-width: 100%;
        height: auto;
      }

      /* CORPO */
      .employee-content .first-field-data-employee {
        width: 10% !important;
      }

      .employee-content .second-field-data-employee {
        width: 20% !important;
        padding-left: 3px;
      }

      .employee-content-second .field {
        width: 25%;
        text-align: left;
      }

      .signature {
        margin-left: 20%;
      }

      .term-signature {
        padding-top: 5px;
      }

      .signature-line {
        margin-top: 20px;
      }

      /* TABELA DE EPI'S */
      .too-small {
        width: 7% !important;
      }

      .small {
        width: 10% !important;
      }

      .medium {
        width: 40% !important;
      }

      .medium-small {
        width: 70% !important;
      }

      .medium-big {
        width: 80%;
      }

      .full {
        width: 100%;
      }
    </style>
</head>
<body>
  <header>
    <table class="head-title">
      <tr>
        <td class="left-image">
          <img src="{{ $employeeData['company']['logo'] }}"> <!-- LOGO EMPRESA -->
        </td>
        <td class="center-title">
          <h1 class="title">
            FICHA DO FUNCIONÁRIO E ENTREGA DE EQUIPAMENTOS DE PROTEÇÃO INDIVIDUAL - EPI
          </h1>
        </td>
        <td class="right-image">
          <img src="https://protege.wolftechti.com.br/img/protege.73495e67.png"> <!-- LOGO PROTEGE -->
        </td>
      </tr>
    </table>
  </header>

  <main>
    <div> {{-- EMPLOYEE --}}
      <table class="container align-container new-block">
        <tr>
          <td class="text-padding rigth-border first-field-data-employee medium-small">
            <h1 class="title">
              FUNCIONÁRIO: <span class="upper"> {{ $employeeData['name'] }} </span>
            </h1>
          </td>
          <td class="text-padding second-field-data-employee">
            <h1 class="title">
              REGISTRO:
            </h1>
          </td>
        </tr>
      </table>
      <table class="container align-container">
        <tr>
          <td class="first-field-data-employee text-padding rigth-border">
            <h1 class="title">
              FUNÇÃO: <span class="upper"> {{ $employeeData['role'] }} </span>
            </h1>
          </td>
          <td class="second-field-data-employee text-padding rigth-border">
            <h1 class="title">
              ADMISSÃO: <span class="upper"> {{ $employeeData['date'] }} </span>
            </h1>
          </td>
          <td class="third-field-data-employee text-padding">
            <h1 class="title">
              DEMISSÃO: 
            </h1>
          </td>
        </tr>
      </table>
    </div>
    
    <div> {{-- epi info --}}
      <table class="container align-container epi-info">
        <td>
          <p class="paragraph-font-size">
            6.1. Para os fins de aplicação desta Norma Regulamentadora - NR, considera-se Equipamento de Proteção Individual - EPI, todo dispositivo ou produto, de uso individual utilizado pelo trabalhador, destinado à proteção de riscos suscetíveis de ameaçar a segurança e a saúde no trabalho.
          </p>
        </td>
      </table>
    </div>

    <div> {{-- employer and employee responsabilities --}}
      <table class="container align-container">
        <td class="align-content-center rigth-border w-50">
          <h1 class="title">
            RESPONSABILIDADES DO EMPREGADOR
          </h1>
        </td>
        <td class="align-content-center w-50">
          <h1 class="title">
            RESPONSABILIDADES DO EMPREGADO
          </h1>
        </td>
      </table>
      <table class="container align-container">
        <td class="rigth-border padding-left w-50">
          <p class="paragraph-font-size">
            - Adquirir o EPI adequado ao risco de cada atividade; <br>
            - Tornar seu uso obrigatório; <br>
            - Fornecer somente equipamentos aprovados pelo Mtbe e/ou Inmetro; <br>
            - orientar e treinar o trabalhador sobre o uso adequado, guarda e conservação; <br>
            - substituir imediatamente, quando danificado ou extraviado. <br>
          </p>
        </td>
        <td class="content-info padding-left w-50">
          <p class="paragraph-font-size">
            - Usar, utilizando-o apenas para a finalidade a que se destina; <br>
            - Responsabilizar-se pela guarda e conservação; <br>
            - Comunicar ao empregador qualquer alteração que o torne impróprio para uso; <br>
            - Cumprir as determinações do empregador sobre o uso adequado. <br>
          </p>
        </td>
      </table>
    </div>

    <div> {{-- term of responsabilities --}}
      <table class="container align-container">
        <td class="align-content-center">
          <h1 class="title">
            TERMO DE RESPONSABILIDADE
          </h1>
        </td>
      </table>

      <table class="container align-container">
        <td>
          <p class="paragraph-font-size">
            Declaro para os devidos fins de cumprimento da NR 06, que recebi da empresa <span class="title">{{ $employeeData['company']['name'] }}</span>, os EPI’s adequados abaixo, os me comprometo a fazer uso no desempenho de minhas atividades, zelando pela sua perfeita higienização, guarda e conservação e funcionamento de acordo com as instruções recebidas em integração de segurança e treinamentos. Assumo o compromisso de devolvê-lo quando solicitado ou em caso de rescisão de contrato de trabalho. Declaro ainda que estou ciente e de pleno acordo que o não cumprimento das condições anteriormente estabelecidas, acarretará na aplicação de sanções administrativas relacionadas a política de consequência inclusive na rescisão do contrato de trabalho, outras sanções previstas em lei em especial as constantes na NR 06 da portaria 3.214 de 08 de junho de 1978. No caso de perda, dano ou extravio por negligência, autorizo o respectivo valor do EPI ser debitado de minha remuneração.
          </p>
        </td>
      </table>

      <table class="container align-container">
        <td class="align-content-center">
          <h1 class="title">
            ATO FALTOSO
          </h1>
        </td>
      </table>

      <table class="container align-container">
        <td>
          <p class="paragraph-font-size">
            “Constitui-se ato faltoso do colaborador, a recusa injustificada do uso e/ou conservação dos equipamentos de proteção individual fornecidos pela empresa”. (art. 158 0 alínea “b”  da CLT)
          </p>
        </td>
      </table>

      <table class="container align-container">
        <td class="title subtitle-font-size term-signature">
          Por ser expressão da verdade, assino a presente para produção dos efeitos legais:
        </td>
        <td>
          <td>
            <span class="signature-line">_______________________________</span> <br>
            <span class="signature paragraph-font-size">
              Assinatura do profissional
            </span>
          </td>
        </td>
      </table>
    </div>
  </main>

  <footer>
    <div> {{-- epi's requested --}}
      <table class="container new-block">
        <td class="align-content-center">
          <h1 class="title">
            CONTROLE DE ENTREGA E DEVOLUÇÃO DE EPIs
          </h1>
        </td>
      </table>
      <table class="container align-container">
        <thead>
          <tr>
            <td class="rigth-border subtitle-font-size title align-content-center small">
              DATA
            </td>
            <td class="rigth-border subtitle-font-size title align-content-center small">
              QUANT.
            </td>
            <td class="rigth-border subtitle-font-size title align-content-center medium">
              TIPO DE EQUIPAMENTO
            </td>
            <td class="rigth-border subtitle-font-size title align-content-center small">
              C.A
            </td>
            <td class="rigth-border subtitle-font-size title align-content-center small">
              ASS
            </td>
            <td class="subtitle-font-size title align-content-center small">
              DEVOLUÇÃO
            </td>
          </tr>
        </thead>
      </table>
      @foreach ($employeeDataItens as $key => $value)
        <table class="container align-container">
          <tbody>
            <tr>
              <td class="rigth-border align-content-center small">
                {{ $value['date'] }}
              </td>
              <td class="rigth-border align-content-center small">
                {{ $value['amount'] }}
              </td>
              <td class="rigth-border align-content-center medium">
                {{ $value['iten'] }}
              </td>
              <td class="rigth-border align-content-center small">
                {{ $value['CA'] }}
              </td>
              <td class="rigth-border align-content-center small">

              </td>
              <td class="align-content-center small">
                ____/____/____
              </td>
            </tr>
          </tbody>
        </table>
      @endforeach
    </div>
  </footer>
</body>
</html>