<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Laboratorio - Editor de Rostro Móvil</title>
    <style>
        * {
            box-sizing: border-box;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            margin: 0;
            padding: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            max-width: 500px;
            width: 100%;
            background: white;
            border-radius: 28px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            overflow: hidden;
            padding: 16px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 4px;
            font-size: 22px;
        }

        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 20px;
            font-size: 12px;
        }

        .workspace {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .canvas-area {
            background: #f0f0f0;
            border-radius: 20px;
            padding: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .canvas-wrapper {
            position: relative;
            background: #2c2c2c;
            border-radius: 16px;
            overflow: hidden;
            width: 100%;
            aspect-ratio: 6 / 5;
        }

        #imageCanvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: block;
            cursor: move;
            background: #1a1a1a;
            touch-action: none;
        }

        .controls-info {
            margin-top: 10px;
            text-align: center;
            font-size: 11px;
            color: #555;
            background: #e9ecef;
            padding: 8px;
            border-radius: 12px;
        }

        .controls-panel {
            background: #f8f9fa;
            border-radius: 20px;
            padding: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .control-group {
            margin-bottom: 18px;
        }

        .control-group label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 13px;
        }

        input[type="range"] {
            width: 100%;
            height: 6px;
            border-radius: 5px;
            background: #ddd;
            outline: none;
            -webkit-appearance: none;
        }

        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: #667eea;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            border: 2px solid white;
        }

        .value-display {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 2px 12px;
            border-radius: 20px;
            font-size: 11px;
        }

        .button-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 10px;
        }

        .upload-btn, .download-btn, .reset-btn {
            border: none;
            padding: 14px 20px;
            border-radius: 50px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            width: 100%;
            transition: transform 0.2s, opacity 0.2s;
            touch-action: manipulation;
        }

        .upload-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .download-btn {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
        }

        .reset-btn {
            background: #dc3545;
            color: white;
        }

        .upload-btn:active, .download-btn:active, .reset-btn:active {
            transform: scale(0.97);
            opacity: 0.9;
        }

        .coord-inputs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 10px;
        }

        .coord-inputs input {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 12px;
            text-align: center;
            font-size: 13px;
            background: white;
        }

        hr {
            margin: 16px 0;
            border: none;
            border-top: 1px solid #ddd;
        }

        .info-badge {
            background: #667eea20;
            border-left: 4px solid #667eea;
            padding: 10px;
            margin-top: 12px;
            border-radius: 10px;
            font-size: 11px;
            color: #555;
            text-align: center;
        }

        /* Ocultar file input */
        #imageUpload {
            display: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>🎓 Editor de Rostro</h1>
    <div class="subtitle">Ajusta la foto y descárgala sin marcas</div>

    <div class="workspace">
        <div class="canvas-area">
            <div class="canvas-wrapper" id="canvasWrapper">
                <canvas id="imageCanvas" width="500" height="416"></canvas>
            </div>
            <div class="controls-info">
                👆 Arrastra la imagen con tu dedo | Usa los controles para ajustar
            </div>
        </div>

        <div class="controls-panel">
            <button class="upload-btn" id="uploadBtn">📸 Subir foto del estudiante</button>
            <input type="file" id="imageUpload" accept="image/jpeg,image/png,image/jpg">

            <div class="control-group">
                <label>
                    <span>🔍 Escala (Zoom)</span>
                    <span id="scaleValue" class="value-display">1.00</span>
                </label>
                <input type="range" id="scaleSlider" min="0.3" max="3" step="0.01" value="1">
            </div>

            <div class="control-group">
                <label>
                    <span>🔄 Rotación</span>
                    <span id="rotateValue" class="value-display">0°</span>
                </label>
                <input type="range" id="rotateSlider" min="-180" max="180" step="1" value="0">
            </div>

            <div class="control-group">
                <label>
                    <span>📐 Posición X</span>
                    <span id="posXValue" class="value-display">0</span>
                </label>
                <input type="range" id="posXSlider" min="-250" max="250" step="1" value="0">
            </div>

            <div class="control-group">
                <label>
                    <span>📏 Posición Y</span>
                    <span id="posYValue" class="value-display">0</span>
                </label>
                <input type="range" id="posYSlider" min="-250" max="250" step="1" value="0">
            </div>

            <div class="coord-inputs">
                <input type="number" id="offsetX" placeholder="Offset X" step="1">
                <input type="number" id="offsetY" placeholder="Offset Y" step="1">
            </div>

            <hr>

            <div class="button-group">
                <button class="download-btn" id="downloadBtn">💾 Descargar imagen (SIN óvalo)</button>
                <button class="reset-btn" id="resetBtn">🔄 Restablecer ajustes</button>
            </div>
            
            <div class="info-badge">
                ⚡ La imagen descargada mantiene los ajustes pero SIN el marco de guía
            </div>
        </div>
    </div>
</div>

<script>
    // Elementos del DOM
    const canvas = document.getElementById('imageCanvas');
    const ctx = canvas.getContext('2d');
    const wrapper = document.getElementById('canvasWrapper');
    
    // Variables de imagen
    let originalImage = null;
    let imgWidth = 0, imgHeight = 0;
    
    // Variables de transformación
    let scale = 1;
    let rotation = 0;
    let offsetX = 0;
    let offsetY = 0;
    
    // Variables para arrastrar con touch
    let isDragging = false;
    let dragStartX = 0, dragStartY = 0;
    let dragStartOffsetX = 0, dragStartOffsetY = 0;
    
    // Dimensiones del canvas
    let canvasWidth = 500, canvasHeight = 416;
    const centerX = 250;
    const centerY = 208;
    
    // Configurar canvas
    canvas.width = canvasWidth;
    canvas.height = canvasHeight;
    
    // ========== FUNCIONES DE DIBUJADO ==========
    
    function drawGuides() {
        // Guías visuales de referencia (solo en pantalla, NO en descarga)
        
        // Línea horizontal central
        ctx.beginPath();
        ctx.moveTo(0, centerY);
        ctx.lineTo(canvasWidth, centerY);
        ctx.strokeStyle = '#ffffff40';
        ctx.lineWidth = 1.5;
        ctx.setLineDash([6, 6]);
        ctx.stroke();
        
        // Línea vertical central
        ctx.beginPath();
        ctx.moveTo(centerX, 0);
        ctx.lineTo(centerX, canvasHeight);
        ctx.stroke();
        
        // Óvalo guía
        ctx.beginPath();
        ctx.ellipse(centerX, centerY, 140, 175, 0, 0, Math.PI * 2);
        ctx.strokeStyle = '#00ff88';
        ctx.lineWidth = 2.5;
        ctx.setLineDash([8, 6]);
        ctx.stroke();
        
        // Texto indicador
        ctx.font = 'bold 11px -apple-system, BlinkMacSystemFont, "Segoe UI"';
        ctx.fillStyle = '#00ff88cc';
        ctx.shadowBlur = 0;
        ctx.fillText('🎯 Centra el rostro aquí', centerX - 70, centerY - 185);
        
        ctx.setLineDash([]);
    }
    
    function drawImageWithTransform() {
        if (!originalImage) {
            // Fondo con mensaje
            ctx.fillStyle = '#2c2c2c';
            ctx.fillRect(0, 0, canvasWidth, canvasHeight);
            ctx.fillStyle = '#aaa';
            ctx.font = 'bold 16px -apple-system';
            ctx.textAlign = 'center';
            ctx.fillText('📸 Sube una foto', canvasWidth/2, canvasHeight/2 - 15);
            ctx.font = '12px -apple-system';
            ctx.fillText('Toca el botón "Subir foto"', canvasWidth/2, canvasHeight/2 + 20);
            ctx.textAlign = 'left';
            drawGuides();
            return;
        }
        
        // Limpiar canvas
        ctx.fillStyle = '#1a1a1a';
        ctx.fillRect(0, 0, canvasWidth, canvasHeight);
        
        // Guardar contexto
        ctx.save();
        
        // Aplicar transformaciones
        ctx.translate(centerX + offsetX, centerY + offsetY);
        ctx.rotate(rotation * Math.PI / 180);
        ctx.scale(scale, scale);
        
        // Dibujar imagen
        ctx.drawImage(originalImage, -imgWidth/2, -imgHeight/2, imgWidth, imgHeight);
        
        // Restaurar contexto
        ctx.restore();
        
        // Dibujar guías
        drawGuides();
        
        // Información
        ctx.font = '9px monospace';
        ctx.fillStyle = '#aaa';
        ctx.fillText(`Escala: ${scale.toFixed(2)} | Rotación: ${rotation}°`, 8, 18);
    }
    
    // ========== ACTUALIZAR TODO ==========
    function updateAll() {
        document.getElementById('scaleValue').innerText = scale.toFixed(2);
        document.getElementById('rotateValue').innerText = rotation + '°';
        document.getElementById('posXValue').innerText = offsetX;
        document.getElementById('posYValue').innerText = offsetY;
        document.getElementById('offsetX').value = offsetX;
        document.getElementById('offsetY').value = offsetY;
        
        // Actualizar sliders
        const scaleSlider = document.getElementById('scaleSlider');
        const rotateSlider = document.getElementById('rotateSlider');
        const posXSlider = document.getElementById('posXSlider');
        const posYSlider = document.getElementById('posYSlider');
        
        if (scaleSlider.value != scale) scaleSlider.value = scale;
        if (rotateSlider.value != rotation) rotateSlider.value = rotation;
        if (posXSlider.value != offsetX) posXSlider.value = offsetX;
        if (posYSlider.value != offsetY) posYSlider.value = offsetY;
        
        drawImageWithTransform();
    }
    
    // ========== MANEJO DE IMAGEN ==========
    function loadImage(file) {
        if (!file) return;
        
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = new Image();
            img.onload = function() {
                originalImage = img;
                imgWidth = img.width;
                imgHeight = img.height;
                
                // Resetear transformaciones
                scale = 1;
                rotation = 0;
                offsetX = 0;
                offsetY = 0;
                
                // Ajuste inicial para móvil
                const maxDimension = Math.max(imgWidth, imgHeight);
                const targetSize = 280;
                if (maxDimension > targetSize * 1.2) {
                    scale = targetSize / maxDimension;
                }
                
                updateAll();
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
    
    // ========== DESCARGAR IMAGEN SIN ÓVALO ==========
    function downloadImageWithoutOval() {
        if (!originalImage) {
            alert('⚠️ Primero sube una foto');
            return;
        }
        
        const exportCanvas = document.createElement('canvas');
        exportCanvas.width = canvasWidth;
        exportCanvas.height = canvasHeight;
        const exportCtx = exportCanvas.getContext('2d');
        
        // Fondo blanco
        exportCtx.fillStyle = '#ffffff';
        exportCtx.fillRect(0, 0, canvasWidth, canvasHeight);
        
        // Dibujar solo la imagen transformada (SIN guías)
        exportCtx.save();
        exportCtx.translate(centerX + offsetX, centerY + offsetY);
        exportCtx.rotate(rotation * Math.PI / 180);
        exportCtx.scale(scale, scale);
        exportCtx.drawImage(originalImage, -imgWidth/2, -imgHeight/2, imgWidth, imgHeight);
        exportCtx.restore();
        
        // Descargar
        const link = document.createElement('a');
        link.download = `foto_ajustada_${Date.now()}.png`;
        link.href = exportCanvas.toDataURL('image/png');
        link.click();
    }
    
    // ========== EVENTOS TÁCTILES (ARRastrar con dedo) ==========
    function getTouchCoords(e) {
        const rect = canvas.getBoundingClientRect();
        const scaleX = canvasWidth / rect.width;
        const scaleY = canvasHeight / rect.height;
        
        let clientX, clientY;
        
        if (e.touches) {
            clientX = e.touches[0].clientX;
            clientY = e.touches[0].clientY;
        } else {
            clientX = e.clientX;
            clientY = e.clientY;
        }
        
        // Asegurar que las coordenadas estén dentro del canvas
        let canvasX = (clientX - rect.left) * scaleX;
        let canvasY = (clientY - rect.top) * scaleY;
        
        canvasX = Math.min(Math.max(canvasX, 0), canvasWidth);
        canvasY = Math.min(Math.max(canvasY, 0), canvasHeight);
        
        return { x: canvasX, y: canvasY };
    }
    
    function handleDragStart(e) {
        if (!originalImage) return;
        e.preventDefault();
        
        const coords = getTouchCoords(e);
        isDragging = true;
        dragStartX = coords.x;
        dragStartY = coords.y;
        dragStartOffsetX = offsetX;
        dragStartOffsetY = offsetY;
        
        canvas.style.cursor = 'grabbing';
    }
    
    function handleDragMove(e) {
        if (!isDragging || !originalImage) return;
        e.preventDefault();
        
        const coords = getTouchCoords(e);
        const deltaX = coords.x - dragStartX;
        const deltaY = coords.y - dragStartY;
        
        offsetX = dragStartOffsetX + deltaX;
        offsetY = dragStartOffsetY + deltaY;
        
        // Limitar offset
        offsetX = Math.min(Math.max(offsetX, -280), 280);
        offsetY = Math.min(Math.max(offsetY, -250), 250);
        
        updateAll();
    }
    
    function handleDragEnd(e) {
        isDragging = false;
        canvas.style.cursor = 'move';
        e.preventDefault();
    }
    
    // Eventos táctiles y mouse
    canvas.addEventListener('touchstart', handleDragStart, { passive: false });
    canvas.addEventListener('touchmove', handleDragMove, { passive: false });
    canvas.addEventListener('touchend', handleDragEnd);
    canvas.addEventListener('touchcancel', handleDragEnd);
    
    canvas.addEventListener('mousedown', handleDragStart);
    window.addEventListener('mousemove', handleDragMove);
    window.addEventListener('mouseup', handleDragEnd);
    
    // ========== EVENTOS DE CONTROLES ==========
    document.getElementById('scaleSlider').addEventListener('input', (e) => {
        scale = parseFloat(e.target.value);
        updateAll();
    });
    
    document.getElementById('rotateSlider').addEventListener('input', (e) => {
        rotation = parseInt(e.target.value);
        updateAll();
    });
    
    document.getElementById('posXSlider').addEventListener('input', (e) => {
        offsetX = parseInt(e.target.value);
        updateAll();
    });
    
    document.getElementById('posYSlider').addEventListener('input', (e) => {
        offsetY = parseInt(e.target.value);
        updateAll();
    });
    
    document.getElementById('offsetX').addEventListener('change', (e) => {
        offsetX = parseInt(e.target.value) || 0;
        updateAll();
    });
    
    document.getElementById('offsetY').addEventListener('change', (e) => {
        offsetY = parseInt(e.target.value) || 0;
        updateAll();
    });
    
    // ========== BOTONES ==========
    document.getElementById('uploadBtn').addEventListener('click', () => {
        document.getElementById('imageUpload').click();
    });
    
    document.getElementById('imageUpload').addEventListener('change', (e) => {
        if (e.target.files && e.target.files[0]) {
            loadImage(e.target.files[0]);
        }
    });
    
    document.getElementById('downloadBtn').addEventListener('click', downloadImageWithoutOval);
    
    document.getElementById('resetBtn').addEventListener('click', () => {
        if (!originalImage) {
            alert('No hay imagen para restablecer');
            return;
        }
        scale = 1;
        rotation = 0;
        offsetX = 0;
        offsetY = 0;
        updateAll();
    });
    
    // ========== AJUSTAR TAMAÑO DEL CANVAS SEGÚN DISPOSITIVO ==========
    function adjustCanvasSize() {
        const wrapperRect = wrapper.getBoundingClientRect();
        const containerWidth = wrapperRect.width;
        
        // Mantener proporción 6:5
        const newHeight = containerWidth * (5 / 6);
        
        canvas.style.width = containerWidth + 'px';
        canvas.style.height = newHeight + 'px';
        
        // Actualizar dimensiones internas si es necesario
        // Mantener las mismas coordenadas lógicas
        drawImageWithTransform();
    }
    
    // Observer para cambios de tamaño
    const resizeObserver = new ResizeObserver(() => {
        adjustCanvasSize();
    });
    resizeObserver.observe(wrapper);
    
    window.addEventListener('resize', () => {
        setTimeout(adjustCanvasSize, 100);
    });
    
    // Inicializar
    canvas.style.cursor = 'move';
    adjustCanvasSize();
    drawImageWithTransform();
</script>

</body>
</html>
