<h1 class="autores-title">Autores del Museo</h1>

<div class="autores-grid">
    @foreach($pintores as $pintor)
        <div class="autor-card">

            <img src="{{ asset($pintor->pintor_foto) }}" 
                 alt="{{ $pintor->nombre }}" 
                 class="autor-img">

            <div class="autor-body">
                <h3 class="autor-name">{{ $pintor->nombre }}</h3>

                <p class="autor-info">
                    <strong>Biografía:</strong> {{ $pintor->bio }}
                </p>

                <p class="autor-info">
                    <strong>Obras:</strong> {{ $pintor->pinturas->count() }}
                </p>
            </div>

        </div>
    @endforeach
</div>

<style>
    /* ======= TÍTULO ======= */
.autores-title {
    text-align: center;
    font-size: 2.3rem;
    font-weight: 700;
    margin-bottom: 40px;
    color: #2c2c2c;
    font-family: "Inter", sans-serif;
}

/* ======= GRID ======= */
.autores-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 25px;
    max-width: 1200px;
    margin: auto;
    padding: 10px;
}

/* ======= CARD ======= */
.autor-card {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    overflow: hidden;
    transition: transform .2s ease, box-shadow .2s ease;
}

.autor-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
}

/* ======= IMAGEN ======= */
.autor-img {
    width: 100%;
    height: 230px;        /* Todas igual tamaño */
    object-fit: cover;    /* No se deforman */
    display: block;
}

/* ======= CUERPO ======= */
.autor-body {
    padding: 15px;
}

.autor-name {
    font-size: 1.3rem;
    margin-bottom: 8px;
    font-weight: 700;
    color: #222;
}

.autor-info {
    font-size: 0.95rem;
    color: #555;
    margin: 3px 0;
}

</style>