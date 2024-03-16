<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Declaração de recebimento de EPI - {{ $employee['name'] }} - </title>
    <style>
      * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-weight: normal;
        font-size: inherit;
      }
      body {
        font-family: Arial, sans-serif;
        padding: 1%;
      }

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

      .signature-img-margins {
        margin-top: 10px;
        margin-left: 25%;
      }

      .term-signature {
        padding-top: 5px;
      }

      .signature-line {
        margin-top: 5px;
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
          <img src="{{ $company['logo'] }}"> <!-- LOGO EMPRESA -->
        </td>
        <td class="center-title">
          <h1 class="title">
            DECLARAÇÃO DE RECEBIMENTO DE EPI's
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
              FUNCIONÁRIO: <span class="upper"> {{ $employee['name'] }} </span>
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
              FUNÇÃO: <span class="upper"> {{ $employee['role'] }} </span>
            </h1>
          </td>
          <td class="second-field-data-employee text-padding rigth-border">
            <h1 class="title">
              ADMISSÃO: <span class="upper"> {{ $employee['registered'] }} </span>
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

    <div> {{-- employer and employee responsabilities --}}
      <table class="container new-block align-container">
        <td class="rigth-border padding-left w-50">
          <p class="paragraph-font-size">
            Eu, <span class="title"> {{ $employee['name'] }} </span>, declaro para todos os efeitos previstos na legislacão, haver recebido gratuitamente, conforme descrito na CLT. nos artigos 166, 167 e demais artigos adstritos à matéria, na NR - 6 e nos itens 9.3.5.4 e 9.3.5.5 da NR - 9 do
            PROGRAMA DE PREVENCAO DE RISCOS AMBIENTAIS, após o treinamento e orientacão do uso adequado, aplicação, guarda, conservação, substituição e requisitos de higiene realizado por <span class="title">{{ $company['name'] }}</span>, 
            o(s) equipamento(s) de proteção individual abaixo descrito(s) e designado(s) como EPIs, os quais obrigo-me a usá-lo(s) sistematicamente em meu trabalho.
          </p>
        </td>
      </table>
    </div>

    <div> {{-- epi's requested --}}
      <table class="container new-block">
        <td class="align-content-center">
          <h1 class="title">
            EPI's RECEBIDOS
          </h1>
        </td>
      </table>
      <table class="container align-container">
        <thead>
          <tr>
            <td class="rigth-border title subtitle-font-size align-content-center medium">
              EQUIPAMENTO SOLICITADO
            </td>
            <td class="rigth-border title subtitle-font-size align-content-center medium">
              MOTIVO DA RETIRADA
            </td>
          </tr>
        </thead>
      </table>
      @foreach ($itens as $key => $value)
        <table class="container align-container">
          <tbody>
            <tr>
              <td class="rigth-border align-content-center subtitle-font-size medium">
                {{ $value['name'] }}
              </td>
              <td class="rigth-border align-content-center subtitle-font-size medium">
                {{ $value['reason'] }}
              </td>
            </tr>
          </tbody>
        </table>
      @endforeach
    </div>

  </main>

  <footer>
    <div>
      <table class="container new-block align-container">
        <td class="title subtitle-font-size term-signature">
          Por ser expressão da verdade, assino a presente para produção dos efeitos legais:
        </td>
        <td>
          <td>
            <div>
              <img
                class="signature-img-margins"
                width="100"
                height="100"
                src="{{ $employee['signature'] }}"
                alt="biometria.png"
              >
            </div>
            <span class="signature-line">_______________________________</span> <br>
            <span class="signature paragraph-font-size">
              Assinatura do profissional
            </span>
          </td>
        </td>
      </table>
    </div>
  </footer>
</body>
</html>