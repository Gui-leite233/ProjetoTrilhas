@extends('templates.main', ['menu' => "admin", 'submenu' => "tccs", 'rota' => "tcc.create"])

@section('titulo') TCCs @endsection

@section('conteudo')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 mb-0">Trabalhos de Conclusão de Curso</h2>
        <a href="{{ route('tcc.create') }}" class="btn btn-dark">
            <i class="bi bi-plus-circle me-2"></i>Novo TCC
        </a>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
        @foreach ($tccs as $item)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-header bg-dark text-white py-3">
                        <h5 class="card-title mb-0 text-truncate" title="{{ $item->titulo }}">{{ $item->titulo }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text text-muted small mb-3">
                            <i class="bi bi-people-fill me-2"></i>
                            {{ $item->users->pluck('nome')->join(', ') }}
                        </p>
                        <p class="card-text" style="height: 4.5em; overflow: hidden;">
                            {{ Str::limit($item->descricao, 120) }}
                        </p>
                    </div>
                    <div class="card-footer bg-light border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="{{ route('tcc.edit', $item->id) }}" class="btn btn-outline-dark btn-sm" data-bs-toggle="tooltip" title="Editar TCC">
                                    <i class="bi bi-pencil-square fs-5"></i>
                                </a>
                                @if ($item->documento)
                                    <a href="{{ route('tcc.viewPdf', $item->id) }}" class="btn btn-outline-dark btn-sm" data-bs-toggle="tooltip" title="Visualizar PDF" target="_blank">
                                        <i class="bi bi-file-earmark-pdf fs-5"></i>
                                    </a>
                                    <a href="{{ asset('storage/' . $item->documento) }}" class="btn btn-outline-dark btn-sm" data-bs-toggle="tooltip" title="Baixar PDF" download>
                                        <i class="bi bi-download fs-5"></i>
                                    </a>
                                @else
                                    <span class="badge bg-secondary ms-2" data-bs-toggle="tooltip" title="Nenhum documento anexado">
                                        <i class="bi bi-file-earmark-x fs-5"></i>
                                    </span>
                                @endif
                            </div>
                            <form action="{{ route('tcc.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip" title="Excluir TCC"
                                    onclick="return confirm('Tem certeza que deseja excluir este TCC?')">
                                    <i class="bi bi-trash fs-5"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($tccs->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-journal-x display-1 text-muted"></i>
            <p class="h4 text-muted mt-3">Nenhum TCC encontrado</p>
            <a href="{{ route('tcc.create') }}" class="btn btn-dark mt-3">
                <i class="bi bi-plus-circle me-2"></i>Criar Primeiro TCC
            </a>
        </div>
    @endif
</div>

<!-- Modal para visualização do PDF -->
<div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="pdfModalLabel"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div id="pdfViewerContainer" style="width: 100%; height: 80vh; overflow: auto;">
                    <canvas id="pdfViewer" style="width: 100%;"></canvas>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <div class="btn-group">
                    <button id="prevPage" class="btn btn-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                        </svg>
                    </button>
                    <button id="nextPage" class="btn btn-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </button>
                </div>
                <span id="pageInfo" class="mx-3">Página <span id="currentPage">0</span> de <span id="totalPages">0</span></span>
                <div class="btn-group">
                    <button id="zoomOut" class="btn btn-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-zoom-out" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                            <path d="M10.344 11.742c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1 6.538 6.538 0 0 1-1.398 1.4z"/>
                            <path fill-rule="evenodd" d="M3 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                    </button>
                    <button id="zoomIn" class="btn btn-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-zoom-in" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                            <path d="M10.344 11.742c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1 6.538 6.538 0 0 1-1.398 1.4z"/>
                            <path fill-rule="evenodd" d="M6.5 3a.5.5 0 0 1 .5.5V6h2.5a.5.5 0 0 1 0 1H7v2.5a.5.5 0 0 1-1 0V7H3.5a.5.5 0 0 1 0-1H6V3.5a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                    </button>
                </div>
                <a id="pdfDownloadLink" href="" download class="btn btn-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                    </svg>
                    Baixar PDF
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<style>
    /* Enhanced Card Styles */
    .card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 12px;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 20px rgba(0,0,0,0.15) !important;
    }

    .card-header {
        border: none;
        background: linear-gradient(45deg, #212529, #343a40);
        padding: 1.2rem;
    }

    .card-title {
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .card-body {
        padding: 1.5rem;
    }

    /* Button Styles */
    .btn {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 8px;
        padding: 0.6rem 1rem;
    }

    .btn-group .btn {
        border-radius: 6px;
        margin: 0 2px;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .btn:active {
        transform: translateY(0);
    }

    .btn-dark {
        background: linear-gradient(45deg, #212529, #343a40);
    }

    /* Badge Styles */
    .badge {
        padding: 0.5rem 0.8rem;
        border-radius: 6px;
        font-weight: 500;
    }

    /* Empty State Styles */
    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
        background: linear-gradient(to bottom, rgba(33,37,41,0.03), rgba(33,37,41,0.02));
        border-radius: 16px;
        margin: 2rem 0;
    }

    .empty-state .bi {
        font-size: 4rem;
        margin-bottom: 1.5rem;
        color: #6c757d;
    }

    /* Icon Animations */
    .bi {
        transition: transform 0.3s ease;
    }

    .btn:hover .bi {
        transform: scale(1.2);
    }

    /* Card Content Animation */
    .card-text {
        transition: color 0.3s ease;
    }

    .card:hover .card-text {
        color: #212529;
    }

    /* Modal Enhancements */
    .modal-content {
        border-radius: 16px;
        border: none;
    }

    .modal-header {
        background: linear-gradient(45deg, #212529, #343a40);
        color: white;
        border-radius: 16px 16px 0 0;
    }

    .modal-footer {
        border-top: 1px solid rgba(0,0,0,0.1);
    }
</style>
@endpush

@section('script')
<script>
    const pdfModal = new bootstrap.Modal(document.getElementById('pdfModal'));
    let pdfDoc = null;
    let pageNum = 1;
    let pageRendering = false;
    let pageNumPending = null;
    let scale = 1.5;
    const canvas = document.getElementById('pdfViewer');
    const ctx = canvas.getContext('2d');

    function renderPage(num) {
        pageRendering = true;
        pdfDoc.getPage(num).then(function(page) {
            const viewport = page.getViewport({scale: scale});
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            const renderContext = {
                canvasContext: ctx,
                viewport: viewport
            };
            const renderTask = page.render(renderContext);

            renderTask.promise.then(function() {
                pageRendering = false;
                if (pageNumPending !== null) {
                    renderPage(pageNumPending);
                    pageNumPending = null;
                }
                document.getElementById('currentPage').textContent = num;
            });
        });
    }

    function queueRenderPage(num) {
        if (pageRendering) {
            pageNumPending = num;
        } else {
            renderPage(num);
        }
    }

    function onPrevPage() {
        if (pageNum <= 1) return;
        pageNum--;
        queueRenderPage(pageNum);
    }

    function onNextPage() {
        if (pageNum >= pdfDoc.numPages) return;
        pageNum++;
        queueRenderPage(pageNum);
    }

    function onZoomIn() {
        scale *= 1.2;
        queueRenderPage(pageNum);
    }

    function onZoomOut() {
        scale /= 1.2;
        queueRenderPage(pageNum);
    }

    // Attach event listeners
    document.getElementById('prevPage').addEventListener('click', onPrevPage);
    document.getElementById('nextPage').addEventListener('click', onNextPage);
    document.getElementById('zoomIn').addEventListener('click', onZoomIn);
    document.getElementById('zoomOut').addEventListener('click', onZoomOut);
    
    function showPDF(url, title) {
        document.getElementById('pdfModalLabel').textContent = title;
        document.getElementById('pdfDownloadLink').href = url;
        
        // Reset variables
        pageNum = 1;
        scale = 1.5;
        
        // Load and render PDF
        pdfjsLib.getDocument(url).promise.then(function(pdf) {
            pdfDoc = pdf;
            document.getElementById('totalPages').textContent = pdf.numPages;
            renderPage(pageNum);
        });
        
        pdfModal.show();
    }
</script>
@push('scripts')
<script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
@endpush
@endsection