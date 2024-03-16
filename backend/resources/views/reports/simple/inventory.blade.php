<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatório de inventário</title>
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

      .small-big {
        width: 25%;
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
          <img src="{{ $companyLogo }}"> <!-- LOGO EMPRESA -->
        </td>
        <td class="center-title">
          <h1 class="title">
            ESTOQUE DE EQUIPAMENTOS DE PROTEÇÃO INDIVIDUAL - EPI's
          </h1>
        </td>
        <td class="right-image">
          <img src="https://protege.wolftechti.com.br/img/protege.73495e67.png"> <!-- LOGO PROTEGE -->
        </td>
      </tr>
    </table>
  </header>

  <main>
    <div> {{-- employer and employee responsabilities --}}
      <table class="container new-block">
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
  </main>

  <footer>
    <div> {{-- epi's requested --}}
      <table class="container new-block">
        <td class="align-content-center">
          <h1 class="title">
            CONTROLE DE ESTOQUE DE EPIs
          </h1>
        </td>
      </table>
      <table class="container align-container">
        <thead>
          <tr>
            <td class="rigth-border title subtitle-font-size align-content-center small-big">
              NOME DO EQUIPAMENTO
            </td>
            <td class="rigth-border title subtitle-font-size align-content-center small">
              C.A
            </td>
            <td class="rigth-border title subtitle-font-size align-content-center small">
              VALIDADE
            </td>
            <td class="rigth-border title subtitle-font-size align-content-center small">
              QTD. ESTOQUE
            </td>
            <td class="rigth-border title subtitle-font-size align-content-center small">
              FABRICANTE
            </td>
            <td class="title subtitle-font-size align-content-center small">
              FORNECEDOR
            </td>
          </tr>
        </thead>
      </table>
      @foreach ($itensData as $key => $value)
        <table class="container align-container">
          <tbody>
            <tr>
              <td class="rigth-border align-content-center subtitle-font-size small-big">
                {{ $value['name'] }}
              </td>
              <td class="rigth-border align-content-center subtitle-font-size small">
                {{ $value['CA'] }}
              </td>
              <td class="rigth-border align-content-center subtitle-font-size small">
                {{ $value['validity'] }}
              </td>
              <td class="rigth-border align-content-center subtitle-font-size small">
                {{ $value['inventory'] }}
              </td>
              <td class="rigth-border align-content-center subtitle-font-size small">
                {{ $value['maker'] }}
              </td>
              <td class="align-content-center subtitle-font-size small">
                {{ $value['supplier'] }}
              </td>
            </tr>
          </tbody>
        </table>
      @endforeach
    </div>
  </footer>
</body>
</html>