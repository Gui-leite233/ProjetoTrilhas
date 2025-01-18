<!-- tcc.blade.php -->
<div class="card h-100 border-0 shadow-sm hover-shadow">
    <div class="card-body position-relative overflow-hidden">
        <!-- Add subtle pattern background -->
        <div class="pattern-background"></div>
        
        <!-- Add hover effect -->
        <div class="card-hover-overlay"></div>
        
        <!-- Your existing card content -->
        // ...existing code...
    </div>
</div>

<!-- prova.blade.php -->
<div class="card h-100 border-0 shadow-sm hover-shadow">
    <div class="card-body position-relative overflow-hidden">
        <!-- Add subtle pattern background -->
        <div class="pattern-background"></div>
        
        <!-- Add hover effect -->
        <div class="card-hover-overlay"></div>
        
        <!-- Your existing card content -->
        // ...existing code...
    </div>
</div>

<!-- projeto.blade.php -->
<div class="card h-100 border-0 shadow-sm hover-shadow">
    <div class="card-body position-relative overflow-hidden">
        <!-- Add subtle pattern background -->
        <div class="pattern-background"></div>
        
        <!-- Add hover effect -->
        <div class="card-hover-overlay"></div>
        
        <!-- Your existing card content -->
        // ...existing code...
    </div>
</div>

<!-- curso.blade.php -->
<div class="card h-100 border-0 shadow-sm hover-shadow">
    <div class="card-body position-relative overflow-hidden">
        <!-- Add subtle pattern background -->
        <div class="pattern-background"></div>
        
        <!-- Add hover effect -->
        <div class="card-hover-overlay"></div>
        
        <!-- Your existing card content -->
        // ...existing code...
    </div>
</div>

<style>
.pattern-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    opacity: 0.05;
    background-image: radial-gradient(#000 1px, transparent 1px);
    background-size: 20px 20px;
}

.card-hover-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at center, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0) 70%);
    opacity: 0;
    transition: opacity var(--transition-speed) ease;
}

.card:hover .card-hover-overlay {
    opacity: 1;
}

/* Improved typography */
.card-title {
    font-weight: 600;
    letter-spacing: -0.5px;
}

.card-text {
    line-height: 1.6;
}

/* Enhanced buttons */
.btn {
    border-radius: 6px;
    text-transform: uppercase;
    font-size: 0.875rem;
    letter-spacing: 0.5px;
    font-weight: 500;
}

/* Status badges */
.badge {
    padding: 0.5em 1em;
    border-radius: 30px;
    font-weight: 500;
}
</style>
