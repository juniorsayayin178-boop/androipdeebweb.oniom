<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>SHOP NPM Android</title>

<style>
body {
  font-family: monospace;
  background: black;
  color: #00ffcc;
  text-align: center;
  background-image: radial-gradient(#00ffcc22 1px, transparent 1px);
  background-size: 20px 20px;
  margin:0;
}

/* ===== MENÚ GLOBAL ===== */
.nav{
  position:fixed;
  top:0;
  left:0;
  width:100%;
  display:flex;
  gap:15px;
  padding:15px 20px;
  border-bottom:1px solid #003322;
  background:rgba(0,0,0,0.95);
  z-index:999;
}

.nav a{ text-decoration:none; }

.nav button{
  background:black;
  color:#00ff88;
  border:1px solid #00ff88;
  padding:10px 18px;
  cursor:pointer;
}

h1 {
  margin-top:120px;
  color: #00ffcc;
  text-shadow: 0 0 10px #00ffcc;
}

.card {
  background: rgba(0,0,0,0.8);
  border: 1px solid #00ffcc;
  padding: 20px;
  margin: 20px;
  border-radius: 10px;
  display: inline-block;
  width: 260px;
  box-shadow: 0 0 15px #00ffcc33;
}

button {
  padding: 10px;
  background: black;
  border: 1px solid #00ffcc;
  color: #00ffcc;
  cursor: pointer;
  transition: 0.3s;
}

button:hover {
  background: #00ffcc;
  color: black;
  box-shadow: 0 0 10px #00ffcc;
}

input {
  padding: 10px;
  background: black;
  border: 1px solid #00ffcc;
  color: #00ffcc;
}

small {
  color: #00ffaa;
}

#pago, #exito {
  display: none;
}
</style>

</head>

<body>

<!-- MENÚ -->
<div class="nav">
  <a href="index.php"><button>&gt; INICIO</button></a>
  <a href="tool.php"><button>&gt; TOOL</button></a>
  <a href="payment.php"><button>&gt; NPM</button></a>
  <a href="suport.php"><button>&gt; SUPORT</button></a>
</div>

<h1>⚡ SHOP ANDROID SYSTEM ⚡</h1>

<div id="productos">

  <div class="card">
    <h3>UI Pro</h3>
    <small>Android 12 - 14</small>
    <p>$10 USD</p>
    <button onclick="comprar('UI Pro', 10)">BUY</button>
  </div>

  <div class="card">
    <h3>Firebase</h3>
    <small>Android 12 - 14</small>
    <p>$15 USD</p>
    <button onclick="comprar('Firebase', 15)">BUY</button>
  </div>

  <div class="card">
    <h3>Motorola</h3>
    <small>Android 12 - 14</small>
    <p>$90 USD</p>
    <button onclick="comprar('Motorola', 90)">BUY</button>
  </div>

  <div class="card">
    <h3>Samsung</h3>
    <small>Android 12 - 14</small>
    <p>$93 USD</p>
    <button onclick="comprar('Samsung', 93)">BUY</button>
  </div>

  <div class="card">
    <h3>Xiaomi</h3>
    <small>Android 12 - 14</small>
    <p>$95 USD</p>
    <button onclick="comprar('Xiaomi', 95)">BUY</button>
  </div>

</div>

<div id="pago">
  <h2>💰 PAGO CRYPTO</h2>
  <p id="detalle"></p>

  <p>Wallet:</p>
  <code>0xABC123FAKEWALLETXYZ</code><br><br>

  <input type="text" id="hash" placeholder="Hash de transacción"><br><br>

  <button onclick="verificarPago()">Confirmar</button>
</div>

<div id="exito">
  <h2>✅ ACCESO CONCEDIDO</h2>
  <h3>📦 ENVÍO EXITOSO</h3>
</div>

<script>
function comprar(nombre, valor) {
  let trm = valor * 0.08;
  let total = valor + trm;

  document.getElementById("productos").style.display = "none";
  document.getElementById("pago").style.display = "block";

  document.getElementById("detalle").innerHTML =
    "Producto: " + nombre + "<br>" +
    "Precio: $" + valor.toFixed(2) + "<br>" +
    "TRM (8%): $" + trm.toFixed(2) + "<br>" +
    "<strong>Total: $" + total.toFixed(2) + "</strong>";
}

function verificarPago() {
  let hash = document.getElementById("hash").value;

  if(hash.length < 5){
    alert("Hash inválido");
    return;
  }

  document.getElementById("pago").style.display = "none";
  document.getElementById("exito").style.display = "block";
}
</script>

</body>
</html>