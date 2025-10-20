<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro Realizado com Sucesso!</title>
  <style>
    body {
      font-family: 'Helvetica Neue', Arial, sans-serif;
      background-color: #f4f7fa;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 600px;
      background-color: #ffffff;
      margin: 40px auto;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }
    .header {
      background-color: #007bff;
      color: #ffffff;
      text-align: center;
      padding: 30px 20px;
    }
    .header h1 {
      margin: 0;
      font-size: 26px;
    }
    .content {
      padding: 30px 25px;
      color: #333333;
      line-height: 1.6;
    }
    .content h2 {
      color: #007bff;
      margin-bottom: 15px;
    }
    .button {
      display: inline-block;
      background-color: #007bff;
      color: #ffffff !important;
      text-decoration: none;
      padding: 12px 30px;
      border-radius: 6px;
      margin-top: 20px;
      font-weight: bold;
    }
    .footer {
      text-align: center;
      font-size: 13px;
      color: #888888;
      padding: 25px 20px;
      background-color: #f4f7fa;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>🎉 Cadastro realizado com sucesso!</h1>
    </div>
    <div class="content">
      <h2>Olá, {{ $name }}!</h2>
      <p>Estamos muito felizes em tê-lo(a) conosco. Seu cadastro foi concluído com sucesso e agora você já pode aproveitar todos os benefícios da nossa plataforma.</p>
      <p>Para começar, basta acessar sua conta clicando no botão abaixo:</p>

      <a href="{{ $link_login }}" class="button">Acessar minha conta</a>

      <p style="margin-top: 25px;">Se você não realizou este cadastro, por favor ignore este e-mail.</p>
      <p>Bem-vindo(a) à família <strong>{{ $nome_empresa }}</strong> 💙</p>
    </div>
    <div class="footer">
      <p>© {{ $ano }} {{ $nome_empresa }}. Todos os direitos reservados.</p>
      <p><a href="{{ $link_privacidade }}">Política de Privacidade</a> | <a href="{{ $link_suporte }}">Suporte</a></p>
    </div>
  </div>
</body>
</html>
