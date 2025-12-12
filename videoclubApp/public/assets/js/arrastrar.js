// Añade este JavaScript al final de tu vista edit.blade.php o en un archivo JS separado

document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('portada');
    const dropZone = document.getElementById('dropZone');
    const preview = document.getElementById('imagePreview');
    
    // Prevenir comportamiento por defecto en toda la zona
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    // Añadir clase cuando se arrastra sobre la zona
    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, highlight, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, unhighlight, false);
    });
    
    function highlight() {
        dropZone.classList.add('drag-over');
    }
    
    function unhighlight() {
        dropZone.classList.remove('drag-over');
    }
    
    // Manejar el drop
    dropZone.addEventListener('drop', handleDrop, false);
    
    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        
        if (files.length > 0) {
            fileInput.files = files;
            handleFiles(files);
        }
    }
    
    // También manejar el input tradicional
    fileInput.addEventListener('change', function(e) {
        handleFiles(e.target.files);
    });
    
    function handleFiles(files) {
        if (files.length === 0) return;
        
        const file = files[0];
        
        // Validar que sea una imagen
        if (!file.type.startsWith('image/')) {
            alert('Por favor, selecciona un archivo de imagen válido');
            return;
        }
        
        // Validar tamaño (2MB máximo)
        if (file.size > 2048 * 1024) {
            alert('La imagen no debe superar los 2MB');
            return;
        }
        
        // Mostrar preview
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <img src="${e.target.result}" alt="Preview" style="max-width: 100%; max-height: 300px; border-radius: 8px;">
                <p style="margin-top: 10px; color: #28a745; font-weight: 500;">✓ Imagen cargada: ${file.name}</p>
            `;
            dropZone.classList.add('has-image');
        };
        reader.readAsDataURL(file);
    }
    
    // Click en la zona para abrir selector
    dropZone.addEventListener('click', function() {
        fileInput.click();
    });
});