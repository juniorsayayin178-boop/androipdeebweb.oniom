<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Herramientas Android // Security Lab</title>
<link rel="stylesheet" href="style.css">

<style>
.grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
  gap:20px;
  margin-top:30px;
}

.box{
  border:1px solid #003322;
  background:#001a11;
  padding:20px;
  min-height:200px;
}

.box h3{
  margin-top:0;
  color:#00ffaa;
}
.notice{
  margin-top:40px;
  padding:20px;
  border:1px dashed #00ff88;
  background:#000d09;
}
</style>

</head>
<body>

<?php include 'menu.php'; ?>

<div class="container">

  <h1>HERRAMIENTAS // ANDROID SECURITY LAB</h1>

  <div class="grid">

    <div class="box">
      <h3>🛰️ Burp Suite (Pruebas Web/App)</h3>
      <p>
        Uso de Burp Suite para analizar el tráfico HTTP/HTTPS de tus propias
        aplicaciones, detectar fallos de seguridad, validar APIs y mejorar
        la protección de datos en tus proyectos.
      </p>
    </div>

    <div class="box">
      <h3>🧩 Análisis de Librerías (Aprendizaje)</h3>
      <p>
        Comprender cómo funcionan las librerías Android mediante análisis
        estático, lectura de código abierto y estudio de arquitectura
        para aprender buenas prácticas de desarrollo.
      </p>
    </div>

    <div class="box">
      <h3>🐉 Kali Linux como Laboratorio</h3>
      <p>
        Uso de Kali Linux en máquinas virtuales para aprender sobre
        ciberseguridad, redes, pruebas de penetración éticas y protección
        de aplicaciones móviles.
      </p>
    </div>

    <div class="box">
      <h3>📢 Métodos de Ads en Android</h3>
      <p>
        Implementación correcta de anuncios con buenas prácticas:
        AdMob, banners, interstitials y rewarded ads sin afectar
        la experiencia del usuario.
      </p>
    </div>

  </div>

  <div class="notice">
    ⚠️ Esta sección está orientada al aprendizaje de seguridad, auditoría ética
    y desarrollo responsable de aplicaciones Android.
  </div>

</div>

</body>
</html>