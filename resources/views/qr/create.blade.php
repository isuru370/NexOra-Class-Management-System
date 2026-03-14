@extends('layouts.app')

@section('title', 'Generate Temporary ID Cards')
@section('content')

<style>
    /* Simple and Clean Styles */
    .tmp-card {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    
    .preview-card {
        width: 100%;
        max-width: 341px; /* 9cm = 341px roughly */
        margin: 0 auto;
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        border-radius: 12px;
        padding: 15px;
        color: white;
        box-shadow: 0 15px 30px rgba(0,0,0,0.2);
    }
    
    .qr-placeholder {
        width: 80px;
        height: 80px;
        background: white;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .qr-placeholder::after {
        content: 'QR';
        color: #4e73df;
        font-weight: bold;
        font-size: 14px;
    }
    
    .calculation-box {
        background: #f8f9fc;
        border-radius: 10px;
        padding: 15px;
        border-left: 4px solid #4e73df;
    }
    
    .number-highlight {
        font-size: 28px;
        font-weight: 700;
        color: #4e73df;
        line-height: 1.2;
    }
    
    .input-group-custom .input-group-text {
        background-color: #4e73df;
        color: white;
        border: none;
        font-weight: 600;
    }
    
    .input-group-custom .form-control {
        border: 2px solid #e3e6f0;
        border-left: none;
    }
    
    .input-group-custom .form-control:focus {
        border-color: #4e73df;
        box-shadow: none;
    }
    
    .btn-generate {
        background: #4e73df;
        color: white;
        border: none;
        padding: 12px 30px;
        font-weight: 600;
        border-radius: 10px;
        transition: all 0.3s;
    }
    
    .btn-generate:hover {
        background: #224abe;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
    }
    
    .info-badge {
        background: #f8f9fc;
        border-radius: 20px;
        padding: 8px 15px;
        color: #4e73df;
        font-size: 14px;
    }
    
    /* Warning style for large numbers */
    .warning-text {
        color: #856404;
        background-color: #fff3cd;
        border: 1px solid #ffeeba;
        border-radius: 5px;
        padding: 5px 10px;
        font-size: 14px;
        margin-top: 10px;
    }
</style>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <!-- Header -->
            <div class="text-center mb-4">
                <h2 class="fw-bold text-primary">🎫 Temporary ID Card Generator</h2>
                <p class="text-muted">Generate unlimited ID cards with QR codes</p>
            </div>

            <!-- Main Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    
                    <!-- Success/Error Messages -->
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Info Alert -->
                    <div class="alert alert-info bg-light border-0 d-flex align-items-center mb-4">
                        <i class="fas fa-info-circle text-primary me-3 fs-4"></i>
                        <div>
                            <strong>Quick Guide:</strong><br>
                            Enter number range (e.g., 001 to 9999). No limit on cards!
                        </div>
                    </div>

                    <!-- Form -->
                    <form method="POST" action="{{ route('temporary-qr.temporary-id-cards.generate') }}" id="generateForm">
                        @csrf
                        
                        <div class="row g-4 mb-4">
                            <!-- Start Code -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-play-circle text-primary me-1"></i> Start Number
                                </label>
                                <div class="input-group input-group-custom">
                                    <span class="input-group-text">TMP</span>
                                    <input type="text" 
                                           class="form-control form-control-lg @error('start') is-invalid @enderror" 
                                           name="start" 
                                           placeholder="001" 
                                           value="{{ old('start', '001') }}"
                                           maxlength="6"
                                           pattern="[0-9]+"
                                           required>
                                </div>
                                <small class="text-muted">3-6 digits (001, 999999)</small>
                                @error('start')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- End Code -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-stop-circle text-danger me-1"></i> End Number
                                </label>
                                <div class="input-group input-group-custom">
                                    <span class="input-group-text">TMP</span>
                                    <input type="text" 
                                           class="form-control form-control-lg @error('end') is-invalid @enderror" 
                                           name="end" 
                                           placeholder="012" 
                                           value="{{ old('end', '012') }}"
                                           maxlength="6"
                                           pattern="[0-9]+"
                                           required>
                                </div>
                                <small class="text-muted">Must be greater than start</small>
                                @error('end')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Live Calculation -->
                        <div class="calculation-box mb-4">
                            <div class="row text-center">
                                <div class="col-4">
                                    <div class="text-muted small">Total Cards</div>
                                    <div class="number-highlight" id="totalCards">12</div>
                                </div>
                                <div class="col-4">
                                    <div class="text-muted small">Pages (A4)</div>
                                    <div class="number-highlight text-success" id="totalPages">1</div>
                                </div>
                                <div class="col-4">
                                    <div class="text-muted small">Per Page</div>
                                    <div class="number-highlight text-info">12</div>
                                </div>
                            </div>
                            
                            <!-- Warning for large numbers -->
                            <div id="largeNumberWarning" class="warning-text mt-3" style="display: none;">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <span id="warningMessage"></span>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-generate w-100" id="submitBtn">
                            <i class="fas fa-id-card me-2"></i> Generate ID Cards
                        </button>
                    </form>
                </div>
            </div>

            <!-- Preview Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="mb-3"><i class="fas fa-eye text-primary me-2"></i>Card Preview</h5>
                    
                    <div class="preview-card">
                        <!-- Card Header -->
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-white rounded-circle p-2 me-2">
                                <span class="text-primary fw-bold">🏢</span>
                            </div>
                            <span class="fw-bold">TEMP ID</span>
                        </div>
                        
                        <!-- Card Body -->
                        <div class="d-flex gap-3">
                            <div class="qr-placeholder"></div>
                            <div>
                                <div class="fw-bold fs-4">TMP001</div>
                                <div class="small opacity-75">#0001</div>
                                <div class="badge bg-white text-primary mt-2">Valid: 30 days</div>
                            </div>
                        </div>
                        
                        <!-- Card Footer -->
                        <div class="text-center small mt-3 pt-2 border-top border-white border-opacity-25">
                            Temporary ID • Valid 30 days
                        </div>
                    </div>
                    
                    <p class="text-muted small text-center mt-3 mb-0">
                        <i class="fas fa-ruler me-1"></i> Actual size: 9cm × 5cm
                    </p>
                </div>
            </div>

            <!-- Instructions -->
            <div class="d-flex flex-wrap gap-2 justify-content-center mt-4">
                <span class="info-badge"><i class="fas fa-check-circle me-1"></i> 3-6 digits</span>
                <span class="info-badge"><i class="fas fa-check-circle me-1"></i> Unlimited cards</span>
                <span class="info-badge"><i class="fas fa-check-circle me-1"></i> 12 per page</span>
                <span class="info-badge"><i class="fas fa-check-circle me-1"></i> 9cm × 5cm</span>
                <span class="info-badge"><i class="fas fa-check-circle me-1"></i> QR included</span>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const startInput = document.querySelector('input[name="start"]');
    const endInput = document.querySelector('input[name="end"]');
    const totalCardsSpan = document.getElementById('totalCards');
    const totalPagesSpan = document.getElementById('totalPages');
    const warningDiv = document.getElementById('largeNumberWarning');
    const warningMessage = document.getElementById('warningMessage');
    const submitBtn = document.getElementById('submitBtn');

    function updateCalculation() {
        // Get values - remove non-digits
        let startVal = startInput.value.replace(/\D/g, '');
        let endVal = endInput.value.replace(/\D/g, '');
        
        // Update input fields with clean values
        startInput.value = startVal;
        endInput.value = endVal;
        
        // Parse numbers
        let start = startVal ? parseInt(startVal) : 1;
        let end = endVal ? parseInt(endVal) : 12;
        
        // Validate
        if (isNaN(start) || start < 1) start = 1;
        if (isNaN(end) || end < start) end = start;
        
        // Calculate
        const total = (end - start) + 1;
        const pages = Math.ceil(total / 12);
        
        // Update display
        totalCardsSpan.textContent = total.toLocaleString();
        totalPagesSpan.textContent = pages.toLocaleString();
        
        // Show warning for large numbers (over 1000 cards)
        if (total > 1000) {
            warningDiv.style.display = 'block';
            warningMessage.textContent = `You're generating ${total.toLocaleString()} cards (${pages.toLocaleString()} pages). This may take a moment.`;
            
            // Change button color to warning
            submitBtn.classList.remove('btn-generate');
            submitBtn.style.background = '#fd7e14';
            submitBtn.style.borderColor = '#fd7e14';
        } else {
            warningDiv.style.display = 'none';
            submitBtn.classList.add('btn-generate');
            submitBtn.style.background = '';
            submitBtn.style.borderColor = '';
        }
        
        // Add animation to numbers
        totalCardsSpan.style.transform = 'scale(1.1)';
        totalPagesSpan.style.transform = 'scale(1.1)';
        setTimeout(() => {
            totalCardsSpan.style.transform = 'scale(1)';
            totalPagesSpan.style.transform = 'scale(1)';
        }, 200);
    }

    // Add event listeners
    startInput.addEventListener('input', updateCalculation);
    endInput.addEventListener('input', updateCalculation);
    
    // Initial calculation
    updateCalculation();
    
    // Confirm for very large numbers (over 5000 cards)
    document.getElementById('generateForm').addEventListener('submit', function(e) {
        const total = parseInt(totalCardsSpan.textContent.replace(/,/g, ''));
        if (total > 5000) {
            if (!confirm(`⚠️ You are about to generate ${total.toLocaleString()} cards. This will create a large PDF file and may take some time. Do you want to continue?`)) {
                e.preventDefault();
            }
        } else if (total > 1000) {
            if (!confirm(`You are generating ${total.toLocaleString()} cards. Continue?`)) {
                e.preventDefault();
            }
        }
    });
});
</script>

@endsection