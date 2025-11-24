<h1 class="galeria-title">Galería de Obras</h1>

<div class="galeria-grid">
    @foreach ($pintores as $pintor)
        @foreach ($pintor->pinturas as $obra)
            <div class="galeria-card">

                <!-- Imagen del cuadro -->
                <img src="{{ asset($obra->cuadro) }}" 
                     alt="{{ $obra->titulo }}" 
                     class="obra-img">

                <div class="galeria-info">
                    <h3 class="obra-title">{{ $obra->titulo }}</h3>
                    <p class="obra-author">{{ $pintor->nombre }}</p>
                </div>

            </div>
        @endforeach
    @endforeach
</div>


<style>
/* ======= TÍTULO DE SECCIÓN ======= */
.galeria-title {
    text-align: center;
    font-size: 2.4rem;
    font-weight: 700;
    margin: 40px 0;
    color: #222;
    font-family: "Inter", sans-serif;
}

/* ======= GRID DE TARJETAS ======= */
.galeria-grid {
    max-width: 1300px;
    margin: auto;
    padding: 10px;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 25px;
}

/* ======= TARJETA ======= */
.galeria-card {
    background: #ffffff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transition: transform .25s ease, box-shadow .25s ease;
}

.galeria-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

/* ======= IMAGEN DEL CUADRO ======= */
.obra-img {
    width: 100%;
    height: 280px;       /* Todas uniformes */
    object-fit: cover;   /* No se deforman, se recortan suavemente */
    display: block;
}

/* ======= INFORMACIÓN ======= */
.galeria-info {
    padding: 15px;
    text-align: center;
}

.obra-title {
    font-size: 1.2rem;
    font-weight: 700;
    margin-bottom: 5px;
    color: #222;
}

.obra-author {
    font-size: 1rem;
    color: #666;
    margin: 0;
}



</style>