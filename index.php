<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Librería Android // Terminal</title>
<link rel="stylesheet" href="style.css">
<style>
.hero{
  margin-top:40px;
  padding:30px;
  border:1px solid #003322;
  background:#001a11;
}

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
  min-height:180px;
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

  <h1>LIBRERÍA ANDROID // ACCESS NODE</h1>

  <div class="hero">
    Centro de recursos sobre Android: librerías, personalización avanzada,
    buenas prácticas de seguridad y herramientas para desarrollo.
  </div>

  <div class="grid">

    <div class="box">
      <h3>📚 Librerías Android</h3>
      <p>
        Retrofit, Room, Glide, Firebase, Coroutines y más.
        Componentes clave para crear apps modernas, rápidas y estables.
      </p>
    </div>

    <div class="box">
      <h3>🔓 Root & Permisos</h3>
      <p>
        Qué es el root, cómo funcionan los permisos del sistema,
        ventajas, riesgos y cómo mantener tu dispositivo seguro.
      </p>
    </div>

    <div class="box">
      <h3>✨ “App Magic” (Automatización)</h3>
      <p>
        Automatización con Tasker, accesibilidad, intents y personalización
        avanzada del comportamiento del dispositivo.
      </p>
    </div>

    <div class="box">
      <h3>🛡️ Seguridad y Malware (RAT)</h3>
      <p>
        Cómo identificar apps maliciosas, permisos sospechosos,
        protección contra RAT y buenas prácticas de ciberseguridad móvil.
      </p>
    </div>

  </div>

  <div class="notice">
    ⚠️ Este sitio promueve el uso responsable de Android, el aprendizaje técnico
    y la protección del usuario frente a vulnerabilidades y software malicioso.
  </div>

</div>

</body>
</html>